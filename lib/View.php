<?php

namespace MaureenBruihier\Projet4\Lib;

use MaureenBruihier\Projet4\lib\Validation;

class View 
{
    public $view;
    public $params = [];
    public $content;

    public function __construct ($view, array $params = []) 
    {
        $this->view = 'views/' . $view . '.php';
        $this->params = $params;
        $this->params['validation'] = Validation::$instance ?? new Validation;
    }

    public static function make($view, array $params = [])
    {
        return (new static($view, $params))->send();
    }

    public function send ()
    {
        ob_start();
        extract($this->params);
        $content = $this->compile();
        require 'views/template.php';
        return ob_get_clean();
    }

    protected function compile () 
    {
        ob_start();
        extract($this->params);
        require $this->view;
        return ob_get_clean();
    }
}