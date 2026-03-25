<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        return match($user->role) {
            'empresa' => redirect()->route('empresa.dashboard'),
            'cliente' => redirect()->route('cliente.dashboard'),
            default   => redirect('/'),
        };
    }
}