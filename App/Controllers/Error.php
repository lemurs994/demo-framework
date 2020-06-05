<?php


namespace App\Controllers;


use App\Libraries\Controller;

class Error extends Controller
{
    public function index()
    {
        $this->view('errors/index');
    }
}