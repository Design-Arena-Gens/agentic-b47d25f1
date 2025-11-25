<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\View;
use App\Http\Response;

abstract class Controller
{
    protected function view(string $view, array $data = []): Response
    {
        return Response::view($view, $data);
    }

    protected function redirect(string $url): Response
    {
        return Response::redirect($url);
    }

    protected function json(array $payload, int $status = 200): Response
    {
        return Response::json($payload, $status);
    }
}
