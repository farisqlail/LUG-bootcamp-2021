<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'nama' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'alamat' => 'required|max:255',
            'nohp' => 'required|max:13',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|max:255|min:5',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }else{
            $user = new User();
            $user->nama =$request->get('nama');
            $user->username =$request->get('username');
            $user->alamat =$request->get('alamat');
            $user->nohp =$request->get('nohp');
            $user->email =$request->get('email');
            $user->password =Hash::make($request->get('password'));
            $user->role = 'customer';
            $user->save();
            return redirect('/auth/login')->with('success', 'Registrasi Berhasil!!, Silakan Login');
        }
    }
}
