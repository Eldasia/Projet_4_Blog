<?php 

namespace MaureenBruihier\Projet4\Lib;

class Validation 
{
    public static $instance;
    protected $data = [];
    protected $rules = [];
    protected $errors = [];

    public function __construct(array $data = [], array $rules = [])
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public static function make(array $data, array $rules) 
    {
        if (self::$instance == null)
        {
            self::$instance = new self($data, $rules);
        }

        return self::$instance;
    }

    public function hasError(string $key) : bool
    {
        return array_key_exists($key, $this->errors);
    }

    public function getError(string $key) : ?string
    {
        if ($this->hasError($key))
        {
            $parts = explode(':', $this->errors[$key][0]);
            $rule = $parts[0];
            $param = $parts[1];

            switch ($rule) 
            {
                case 'required' :
                    return 'Le champ est requis.';
                    break;

                case 'min' :
                    return 'Le champ doit faire plus de ' . $param .  ' caractères.';
                    break;

                case 'max' :
                    return 'Le champ doit faire moins de ' . $param .  ' caractères.';
                    break;
                
                default :
                    return 'Erreur inconnue.';
                    break;
            }
        }

        return null;
    }

    public function getOldValue(string $key) : ?string
    {
        if ($this->hasError($key))
        {
            return $this->errors[$key][1];
        }

        return null;
    }

    public function isValid() : bool
    {
        foreach ($this->data as $key=>$value)
        {
            $this->validateAttr($key, $value);
        }

        return count($this->errors) == 0;
    }

    protected function validateAttr($attr, $value) : void
    {
        foreach ($this->rules[$attr] as $rule)
        {
            if ($this->rule($rule, $value) == false)
            {
                $this->errors[$attr] = [$rule, $value];
                return;
            }
        }

        return;
    }

    protected function rule($rule, $value) : bool
    {
        if (stripos($rule, ':') === false) 
        {
            $method = 'rule' . ucfirst($rule);
            return $this->{$method}($value);
        } 

        $parts = explode(':', $rule);
        $method = 'rule' . ucfirst($parts[0]);

        return $this->{$method}($value, $parts[1]);
    }

    protected function ruleRequired($value) : bool
    {
        return !empty($value);
    }

    protected function ruleMin($value, $param) : bool
    {
        return strlen($value) >= $param;
    }

    protected function ruleMax($value, $param) : bool
    {
        return strlen($value) <= $param;
    }

}