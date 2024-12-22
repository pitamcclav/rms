<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class AuthController
{
    public function login(Request $request)
    {
        try {
            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if (auth()->attempt($request->only('email', 'password'))) {
            if(auth()->user()->hasRole('Admin')){
                return redirect()->route('admin');
            }
            if(auth()->user()->hasRole('LandLord')){
                return redirect()->route('landlord');
            }
            if(auth()->user()->hasRole('Tenant')) {
                return redirect()->route('tenant');
            }
            }

            return back()->with('status', 'Invalid login details');
        }catch (\Exception $exception){
            return back()->with('status', 'Invalid login details');
        }


    }


}
