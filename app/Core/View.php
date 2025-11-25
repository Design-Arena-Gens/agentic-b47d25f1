<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Exceptions\ViewNotFoundException;

final class View
{
    public static function render(string $view, array $data = []): string
    {
        $path = __DIR__ . '/../../resources/views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($path)) {
            throw new ViewNotFoundException(sprintf('View [%s] not found.', $view));
        }

        extract($data, EXTR_OVERWRITE);

        ob_start();
        include $path;
        return (string) ob_get_clean();
    }
}
