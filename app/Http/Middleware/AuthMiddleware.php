<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Session;
use App\Http\Request;
use App\Http\Response;
use Closure;

final class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Session::get('auth_user');

        if (!$user) {
            return Response::redirect('/admin/login');
        }

        return $next($request);
    }
}
