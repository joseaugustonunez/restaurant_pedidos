<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistroControlador extends Controller{
    
    public function create(){
        
        return view('auth.register');
    }
    public function index(){

        $user = User::all();
        return view('usuario.index', compact('user'));
    }
    public function store(){

        $this->validate(request(),[
            'name' =>'required',
            'email' =>'required|email',
            'password' =>'required|confirmed',
            

        ]);


        $user = User::create(request(['name','email','password']));

        auth()->login($user);
        return redirect()->to('/');
    }
    public function edit($id){

        $user= User::find($id);

        return view('editar.editar', compact('user'));
    }
    

}
