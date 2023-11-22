<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControlador extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
