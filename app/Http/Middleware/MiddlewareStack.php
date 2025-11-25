<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Closure;

final class MiddlewareStack
{
    private array $middleware;
    private Closure $destination;

    public function __construct(array $middleware, Closure $destination)
    {
        $this->middleware = $middleware;
        $this->destination = $destination;
    }

    public function handle(Request $request): Response
    {
        $next = array_reduce(
            array_reverse($this->middleware),
            function (Closure $next, $middleware): Closure {
                return function (Request $request) use ($next, $middleware) {
                    if (is_string($middleware)) {
                        $instance = new $middleware();
                        return $instance->handle($request, $next);
                    }

                    if ($middleware instanceof Closure) {
                        return $middleware($request, $next);
                    }

                    throw new \RuntimeException('Invalid middleware provided.');
                };
            },
            $this->destination
        );

        return $next($request);
    }
}
