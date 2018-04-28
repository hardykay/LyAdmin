<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function nopage()
    {
        return view('errors.404');
    }
}