<?php

declare(strict_types=1);

namespace App\Http;

use App\Core\View;
use App\Http\Middleware\MiddlewareStack;
use Closure;

final class Router
{
    private array $routes = [];
    private array $middlewareGroups = [];
    private array $currentGroupStack = [];

    public function get(string $uri, $action): self
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): self
    {
        return $this->addRoute('POST', $uri, $action);
    }

    public function put(string $uri, $action): self
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    public function delete(string $uri, $action): self
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function group(array $attributes, Closure $callback): void
    {
        $this->currentGroupStack[] = $attributes;
        $callback($this);
        array_pop($this->currentGroupStack);
    }

    public function middleware(string $name, array $middleware): void
    {
        $this->middlewareGroups[$name] = $middleware;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method();
        $path = rtrim($request->path(), '/') ?: '/';

        foreach ($this->routes as $route) {
            if (!in_array($method, $route['methods'], true)) {
                continue;
            }

            $pattern = $route['pattern'];
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $handler = $route['action'];
                $middleware = $route['middleware'];

                $stack = new MiddlewareStack($middleware, function (Request $request) use ($handler, $params): Response {
                    if (is_array($handler)) {
                        [$controller, $method] = $handler;
                        $instance = new $controller();
                        return $instance->$method($request, ...array_values($params));
                    }

                    if (is_callable($handler)) {
                        return $handler($request, ...array_values($params));
                    }

                    if (is_string($handler) && str_starts_with($handler, 'view:')) {
                        $view = substr($handler, 5);
                        return Response::view($view);
                    }

                    throw new \RuntimeException('Invalid route action.');
                });

                return $stack->handle($request);
            }
        }

        return Response::make(View::render('errors/404'), 404);
    }

    private function addRoute(string $method, string $uri, $action): self
    {
        $uri = rtrim($uri, '/') ?: '/';
        $pattern = $this->convertUriToPattern($uri);
        $middleware = $this->resolveGroupMiddleware();

        $this->routes[] = [
            'methods' => [$method],
            'uri' => $uri,
            'pattern' => $pattern,
            'action' => $action,
            'middleware' => $middleware,
        ];

        return $this;
    }

    private function convertUriToPattern(string $uri): string
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_-]*)\}#', '(?P<$1>[^/]+)', $uri);
        return '#^' . $pattern . '$#';
    }

    private function resolveGroupMiddleware(): array
    {
        $middleware = [];

        foreach ($this->currentGroupStack as $group) {
            if (isset($group['middleware'])) {
                foreach ((array) $group['middleware'] as $name) {
                    $middleware = array_merge($middleware, $this->middlewareGroups[$name] ?? [$name]);
                }
            }
        }

        return $middleware;
    }
}
