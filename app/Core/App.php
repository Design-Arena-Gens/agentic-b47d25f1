<?php

declare(strict_types=1);

namespace App\Core;

use App\Http\Router;
use App\Http\Request;
use App\Http\Response;
use Throwable;

final class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->registerRoutes();
    }

    public function run(): void
    {
        $request = Request::capture();

        try {
            $response = $this->router->dispatch($request);
        } catch (Throwable $exception) {
            $this->report($exception);
            $response = $this->renderException($exception);
        }

        $response->send();
    }

    private function registerRoutes(): void
    {
        $routesFile = __DIR__ . '/../Http/routes.php';
        if (!file_exists($routesFile)) {
            return;
        }

        (function (Router $router) use ($routesFile): void {
            require $routesFile;
        })($this->router);
    }

    private function report(Throwable $exception): void
    {
        $logDir = __DIR__ . '/../../storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0775, true);
        }

        $message = sprintf(
            "[%s] %s in %s:%d\nStack trace:\n%s\n\n",
            date('Y-m-d H:i:s'),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString()
        );

        file_put_contents($logDir . '/app.log', $message, FILE_APPEND);
    }

    private function renderException(Throwable $exception): Response
    {
        $debug = Env::get('APP_DEBUG', 'false') === 'true';

        if ($debug) {
            $content = '<h1>Application Error</h1>';
            $content .= sprintf('<p>%s</p>', htmlspecialchars($exception->getMessage(), ENT_QUOTES));
            $content .= sprintf('<p>%s:%d</p>', $exception->getFile(), $exception->getLine());
            $content .= sprintf('<pre>%s</pre>', htmlspecialchars($exception->getTraceAsString(), ENT_QUOTES));
        } else {
            $content = View::render('errors/500', [
                'message' => 'We encountered an unexpected error. Please try again later.',
            ]);
        }

        return Response::make($content, 500);
    }
}
