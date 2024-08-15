<?php

namespace controllers;

use core\Controller;

class ErrorsController extends Controller
{
    public function action404()
    {
        return $this->render();
    }
}