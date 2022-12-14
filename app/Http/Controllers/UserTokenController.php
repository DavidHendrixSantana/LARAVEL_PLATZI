<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserTokenController extends Controller
{
    public function __invoke(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
            'device_name' => 'required'
        ]);
        /** @var User $user */
        $user = User::where('email', $request->email)->first();

        if(!$user && !Hash::check($request->password, $user->password)){
            throw ValidationEception::withMessages([
                'email'=> 'El email no existe o no coincide con los datos'
            ]);
        }

        return response()->json([
            'token'=> $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
