<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginFormRequest $request)
    {
        if (!$token = Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => [
                        'Email ou mot de passe incorrect.'
                    ]
                ]
            ], 422);
        }

        return response()->json([
            'data' => compact('token')
        ]);
    }
}
