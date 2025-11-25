<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Services\AuthService;
use App\Core\Session;

final class AuthController extends Controller
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function showLogin(): Response
    {
        return $this->view('admin.auth.login');
    }

    public function login(Request $request): Response
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!$email || !$password) {
            Session::flash('auth_error', 'Email and password are required.');
            return Response::redirect('/admin/login');
        }

        if (!$this->auth->attempt($email, $password)) {
            Session::flash('auth_error', 'Invalid credentials.');
            return Response::redirect('/admin/login');
        }

        return Response::redirect('/admin');
    }

    public function logout(): Response
    {
        $this->auth->logout();
        return Response::redirect('/admin/login');
    }
}
