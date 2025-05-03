<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
        return view('layout/register'); // this will load app/Views/dashboard.php
    }
}
