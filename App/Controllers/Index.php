<?php


namespace App\Controllers;


use App\Libraries\Controller;

class Index extends Controller
{
    public function Main()
    {
        $this->view('index/index');
    }
}