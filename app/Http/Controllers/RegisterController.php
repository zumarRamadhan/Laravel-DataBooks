<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[

        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);

        $data = User::create($request->all());

        return redirect('/book/all')->with('success', 'Register Success');
    }
}
