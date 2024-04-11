<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $uri = 'http://localhost:5000/';
    protected function uri()
    {
        return $this->uri;
    }
}
