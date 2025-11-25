<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Core\Session;
use App\Http\Request;
use App\Http\Response;
use Closure;

final class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Session::get('auth_user');

        if (!$user || ($user['role_slug'] ?? null) !== $role) {
            return Response::redirect('/admin');
        }

        return $next($request);
    }
}
