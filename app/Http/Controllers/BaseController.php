<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function __construct()
    {
        request()->headers->set('Accept', 'application/json');
    }
}