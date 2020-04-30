<?php

namespace MaureenBruihier\Projet4\Lib;

class Router
{
    protected $routes = [];
    protected $names = [];
    protected $current;
    protected $matched_parameters = [];
    protected $parameters_pattern = '/{:\w+}/';
    protected $parameters = [
        '{:num}'   => '([0-9]+)',
        '{:alpha}' => '([a-z]+)',
        '{:any}'   => '([a-z0-9\_\.\:\,\-]+)',
        '{:slug}'  => '([a-z0-9\-]+)',
    ];
    protected $name;
    protected $dispatch_default;
    protected $methods = [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE'
    ];

    public function listen($request_uri = null, $request_method = null)
    {
        $method = $this->getRequestMethod($request_method);
        $uri    = $this->getRequestUri($request_uri);

        $this->matched_parameters = [];
        $this->current            = null;

        if (count($this->routes) > 0) {
            foreach ($this->routes as $key => $route) {
                if ($this->routeMatch($key, $uri, $method) === true) {
                    return $this->dispatchCurrent();
                }
            }

            return $this->dispatchDefault();
        }

        return $this;
    }

    public function link($name, $params = [])
    {
        $route = is_int($name) ? $this->getIndexedRoute($name) : $this->getNamedRoute($name);
        $uri = $route['uri'];

        if ($route['bindings'] === true) {
            $uri    = $route['original'];
            $params = is_array($params) ? $params : [$params];

            while ($this->routeHasBindings($uri) === true || count($params) > 0) {
                $uri = preg_replace($this->parameters_pattern, $params[0], $uri, 1);
                array_shift($params);
            }
        }

        return '/' . $uri;
    }

    public function routes(callable $callback = null)
    {
        if (is_null($callback)) {
            return $this->routes;
        }

        $callback($this);

        return $this;
    }

    public function add(array $methods, $uri, $action, $as = null)
    {
        $original = $uri;
        $methods  = $this->validateRouteMethods($methods);
        $bindings = $this->routeHasBindings($uri);
        $uri      = $this->validateRouteUri($uri);
        $index    = count($this->routes) + 1;

        $this->routes[$index] = [
            'methods'  => $methods,
            'uri'      => $uri,
            'original' => $original,
            'action'   => $action,
            'bindings' => $bindings
        ];

        if (is_null($as) === false) {
            $as = $this->validateRouteNamed($as);
            $this->names[$index] = $as;
        }

        return $this;
    }

    public function getNamedRoute($name)
    {
        if (false !== $index = array_search($name, $this->names)) {
            return $this->getIndexedRoute($index);
        }

        throw new \RuntimeException("Aucune route nommée $route");
    }

    public function getIndexedRoute($index)
    {
        if (array_key_exists($index, $this->routes)) {
            return $this->routes[$index];
        }

        throw new \RuntimeException("Aucune route $index");
    }

    protected function validateRouteMethods($methods)
    {
        if (is_array($methods)) {
            foreach ($methods as &$method) {
                $method = $this->validateRouteMethods($method);
            }

            unset($method);
            return $methods;
        } else {
            $method = strtoupper($methods);

            if (in_array($method, $this->methods)) {
                return $method;
            }
        }

        throw new \InvalidArgumentException("Méthode $method invalide");
    }

    protected function routeHasBindings($uri)
    {
        if (is_array($uri)) {
            return $uri['bindings'] === true;
        } else {
            return preg_match($this->parameters_pattern, $uri) >= 1;
        }
    }

    protected function validateRouteUri($uri)
    {
        $uri = trim($uri, '/');
        $uri = str_replace([
            '.',
            '?',
            '&',
        ], [
            '\.',
            '\?',
            '\&',
        ], $uri);

        while ($this->routeHasBindings($uri) === true) {
            foreach ($this->parameters as $key => $pattern) {
                $uri = preg_replace("/$key/iu", $pattern, $uri);
            }
        }

        return $uri;
    }

    protected function validateRouteNamed($as)
    {
        if (in_array($as, $this->names) === false) {
            return $as;
        }

        throw new \InvalidArgumentException("Route $as déjà existante");
    }

    protected function routeMatch($index, $uri = '', $method = 'GET')
    {
        $route = $this->getIndexedRoute($index);
        $pattern = '#^' . $route['uri'] . '$#iu';
        $matches = [];

        if (preg_match_all($pattern, $uri, $matches) > 0 && in_array($method, $route['methods'])) {
            if (count($matches) > 1) {
                array_shift($matches);

                foreach ($matches as $match) {
                    $this->matched_parameters[] = $match[0];
                }
            }

            $this->current = $index;
            return true;
        }

        return false;
    }

    protected function dispatchCurrent()
    {
        if (is_null($this->current)) {
            throw new \RuntimeException("Aucune route");
        }

        return $this->dispatchFromRoute($this->current);
    }

    protected function dispatchDefault()
    {
        if (is_null($this->dispatch_default) === false) {
            return $this->dispatch($this->dispatch_default);
        }

        return $this;
    }

    protected function dispatchFromRoute($id)
    {
        $route = is_int($id) ? $this->getIndexedRoute($id) : $id;
        return $this->dispatch($route['action']);
    }

    protected function dispatch($action)
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $this->matched_parameters);
        }

        $call       = explode('@', $action);
        $className  = $call[0];
        $methodName = $call[1];

        if (class_exists($className)) {
            $class = new $className;

            if (method_exists($class, $methodName)) {
                return call_user_func_array([
                    $class,
                    $methodName
                ], $this->matched_parameters);
            }
        }

        throw new \RuntimeException("Action de la route invalide");
    }

    public function whenNotFound($callback)
    {
        $this->dispatch_default = $callback;
        return $this;
    }

    protected function getRequestMethod($default = null)
    {
        $method = is_null($default) ? $_SERVER['REQUEST_METHOD'] : $default;
        return strtoupper($method);
    }

    protected function getRequestUri($default = null)
    {
        $uri = is_null($default) ? $_SERVER['REQUEST_URI'] : $default;
        return trim($uri, '/');
    }

    public function __call($method, $args = [])
    {
        if (in_array(strtoupper($method), $this->methods)) {
            $as = !empty($args[2]) ? $args[2] : null;
            return $this->add([$method], $args[0], $args[1], $as);
        }
    }
}