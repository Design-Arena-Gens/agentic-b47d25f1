<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;
use App\Core\Session;
use App\Models\User;
use App\Models\Role;

final class AuthService
{
    private User $users;
    private Role $roles;

    public function __construct()
    {
        $this->users = new User();
        $this->roles = new Role();
    }

    public function attempt(string $email, string $password): bool
    {
        $user = $this->users->findByEmail($email);
        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        $role = $this->roles->find((int) $user['role_id']);
        $user['role_slug'] = $role['slug'] ?? null;

        Session::put(Config::get('auth.session_key', 'auth_user'), $user);
        $this->users->recordLogin((int) $user['id']);

        return true;
    }

    public function user(): ?array
    {
        return Session::get(Config::get('auth.session_key', 'auth_user'));
    }

    public function logout(): void
    {
        Session::forget(Config::get('auth.session_key', 'auth_user'));
    }
}
