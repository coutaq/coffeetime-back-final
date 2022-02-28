<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{       
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required'],
            'code' => ['required'],
        ]);
        $user = User::where('phone', $credentials['phone'])->first();
           
            if ($user && $credentials['code'] == $user->code) {
                Auth::login($user, $remember = true);
                // $user->code = null;
                // $user->save();
                return $user;
            }

            return response()->json([
                'error' => 'Неверные данные'
            ], 419); 
    }
}
