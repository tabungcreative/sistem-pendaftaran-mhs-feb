<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('home.index');
    }

    public function daftar($nim)
    {
        return view('home.daftar', compact('nim'));
    }
}
