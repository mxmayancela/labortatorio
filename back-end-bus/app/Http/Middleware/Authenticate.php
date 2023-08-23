<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        } else {
            // Puedes personalizar el mensaje y la respuesta según tus necesidades
            abort(401, 'Unauthorized');
        }
    }
}
