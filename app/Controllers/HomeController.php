<?php

namespace App\Controllers;

use App\Models\User;
use CatPHP\Http\Request;
use CatPHP\Validation\ValidatorFacade;

class HomeController
{
    /**
     * Display welcome page of our awesome application.
     *
     * @param \CatPHP\Http\Request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return view('welcome');
    }
}