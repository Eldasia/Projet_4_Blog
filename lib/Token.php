<?php

namespace MaureenBruihier\Projet4\Lib;

class Token
{
    public static $instance;
    public $current;
    public $previous;

    private function __construct()
    {
        $this->current = $this->generate();
        $this->previous = $this->read();
    }

    public static function make() : self
    {
        if (self::$instance == null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    protected function generate(int $size = 128) : string
    {
        $list = 'abcdefghijklmopqrstuvwxyz1234567890';
        $token = '';

        while(strlen($token) < $size)
        {
            $index = rand(0, strlen($list) - 1);
            $token .= $list[$index];
        }

        return $token;
    }

    protected function write() : void
    {
        $_SESSION['_token'] = $this->current;
    }

    protected function read() : ?string
    {
        return isset($_SESSION['_token']) ? $_SESSION['_token'] : null;
    }

    public function input() : string
    {
        $this->write();
        return sprintf('<input type="hidden" name="_token" value="%s"/>', $this->current);
    }

    public function verify(string $token) : bool
    {
        return $this->previous == $token;
    }
}