<?php

declare(strict_types=1);

namespace App\Http;

use App\Core\Session;

final class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $files;
    private array $cookies;

    private function __construct(array $get, array $post, array $server, array $files, array $cookies)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->files = $files;
        $this->cookies = $cookies;
    }

    public static function capture(): self
    {
        return new self($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        $questionPos = strpos($uri, '?');
        return $questionPos === false ? $uri : substr($uri, 0, $questionPos);
    }

    public function input(string $key = null, $default = null)
    {
        if ($key === null) {
            return $this->post + $this->get;
        }

        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->post + $this->get;
    }

    public function file(string $key): ?array
    {
        return $this->files[$key] ?? null;
    }

    public function cookie(string $key, $default = null)
    {
        return $this->cookies[$key] ?? $default;
    }

    public function session(): Session
    {
        return new Session();
    }

    public function wantsJson(): bool
    {
        $accept = $this->server['HTTP_ACCEPT'] ?? '';
        return str_contains($accept, 'application/json');
    }
}
