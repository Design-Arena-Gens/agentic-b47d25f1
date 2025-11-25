<?php

declare(strict_types=1);

namespace App\Core;

final class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function put(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function flash(string $key, $value): void
    {
        self::put('_flash.' . $key, $value);
    }

    public static function pullFlash(string $key, $default = null)
    {
        $flashKey = '_flash.' . $key;
        $value = $_SESSION[$flashKey] ?? $default;
        unset($_SESSION[$flashKey]);
        return $value;
    }
}
