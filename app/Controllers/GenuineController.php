<?php

namespace App\Controllers;

if (!defined("BASEPATH") && session()->has('aIdx') == "") {
    exit("No direct script access allowed");
}

class GenuineController extends BaseController
{
    public function index()
    {
        echo view('genuine/templates/header');
        echo view('genuine/genuine_out');
        echo view('genuine/templates/footer');
    }
}