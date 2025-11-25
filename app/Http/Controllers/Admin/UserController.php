<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\User;
use App\Models\Role;
use App\Core\Session;

final class UserController extends Controller
{
    private User $users;
    private Role $roles;

    public function __construct()
    {
        $this->users = new User();
        $this->roles = new Role();
    }

    public function index(): Response
    {
        return $this->view('admin.users.index', [
            'users' => $this->users->allWithRoles(),
        ]);
    }

    public function create(): Response
    {
        return $this->view('admin.users.form', [
            'user' => null,
            'roles' => $this->roles->all(),
        ]);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['password'] = password_hash($data['password'], PASSWORD_ARGON2ID);
        $this->users->create($data);
        Session::flash('user_success', 'User created.');
        return Response::redirect('/admin/users');
    }

    public function edit(Request $request, string $id): Response
    {
        return $this->view('admin.users.form', [
            'user' => $this->users->find((int) $id),
            'roles' => $this->roles->all(),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_ARGON2ID);
        } else {
            unset($data['password']);
        }
        $this->users->update((int) $id, $data);
        Session::flash('user_success', 'User updated.');
        return Response::redirect('/admin/users');
    }

    public function destroy(Request $request, string $id): Response
    {
        $this->users->delete((int) $id);
        Session::flash('user_success', 'User removed.');
        return Response::redirect('/admin/users');
    }
}
