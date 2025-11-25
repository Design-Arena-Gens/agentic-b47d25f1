<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class User extends Model
{
    protected string $table = 'users';
    protected array $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'last_login_at',
    ];

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function recordLogin(int $id): void
    {
        $stmt = $this->connection()->prepare("UPDATE {$this->table} SET last_login_at = NOW() WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function allWithRoles(): array
    {
        $stmt = $this->connection()->query("SELECT users.*, roles.name AS role_name FROM users LEFT JOIN roles ON users.role_id = roles.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
