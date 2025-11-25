<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\BrandPageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;

$router->middleware('auth', [
    AuthMiddleware::class,
]);

$router->middleware('superadmin', [
    fn ($request, $next) => (new RoleMiddleware())->handle($request, $next, 'SUPER_ADMIN'),
]);

// Public routes
$router->get('/', [LandingController::class, 'index']);
$router->post('/lead', [LandingController::class, 'lead']);

$router->group([], function ($router) {
    $router->get('/{brand}/home', [BrandPageController::class, 'home']);
    $router->get('/{brand}/about', fn ($request, $brand) => (new BrandPageController())->page($request, $brand, 'about'));
    $router->get('/{brand}/services', fn ($request, $brand) => (new BrandPageController())->page($request, $brand, 'services'));
    $router->get('/{brand}/products', [BrandPageController::class, 'products']);
    $router->get('/{brand}/products/{slug}', [BrandPageController::class, 'productDetail']);
    $router->get('/{brand}/r-and-d', fn ($request, $brand) => (new BrandPageController())->page($request, $brand, 'r-and-d'));
    $router->get('/{brand}/science', fn ($request, $brand) => (new BrandPageController())->page($request, $brand, 'science'));
    $router->get('/{brand}/blog', [BrandPageController::class, 'blog']);
    $router->get('/{brand}/blog/{slug}', [BrandPageController::class, 'blogDetail']);
    $router->get('/{brand}/contact', [BrandPageController::class, 'contact']);
    $router->get('/{brand}/faq', [BrandPageController::class, 'faq']);

    $router->get('/{brand}/cart', [BrandPageController::class, 'cart']);
    $router->post('/{brand}/cart/add', [BrandPageController::class, 'addToCart']);
    $router->post('/{brand}/cart/update', [BrandPageController::class, 'updateCart']);
    $router->post('/{brand}/cart/remove/{slug}', [BrandPageController::class, 'removeFromCart']);

    $router->get('/{brand}/checkout', [CheckoutController::class, 'index']);
    $router->post('/{brand}/checkout', [CheckoutController::class, 'place']);

    $router->get('/{brand}/order-track', [OrderController::class, 'track']);
});

// Admin routes
$router->get('/admin/login', [AdminAuthController::class, 'showLogin']);
$router->post('/admin/login', [AdminAuthController::class, 'login']);
$router->post('/admin/logout', [AdminAuthController::class, 'logout']);

$router->group(['middleware' => ['auth']], function ($router) {
    $router->get('/admin', [DashboardController::class, 'index']);

    $router->get('/admin/brands', [AdminBrandController::class, 'index']);
    $router->get('/admin/brands/{id}', [AdminBrandController::class, 'edit']);
    $router->post('/admin/brands/{id}', [AdminBrandController::class, 'update']);

    $router->get('/admin/products', [AdminProductController::class, 'index']);
    $router->get('/admin/products/create', [AdminProductController::class, 'create']);
    $router->post('/admin/products', [AdminProductController::class, 'store']);
    $router->get('/admin/products/{id}/edit', [AdminProductController::class, 'edit']);
    $router->post('/admin/products/{id}', [AdminProductController::class, 'update']);
    $router->post('/admin/products/{id}/delete', [AdminProductController::class, 'destroy']);

    $router->get('/admin/blog', [AdminBlogController::class, 'index']);
    $router->get('/admin/blog/create', [AdminBlogController::class, 'create']);
    $router->post('/admin/blog', [AdminBlogController::class, 'store']);
    $router->get('/admin/blog/{id}/edit', [AdminBlogController::class, 'edit']);
    $router->post('/admin/blog/{id}', [AdminBlogController::class, 'update']);
    $router->post('/admin/blog/{id}/delete', [AdminBlogController::class, 'destroy']);

    $router->get('/admin/faqs', [AdminFaqController::class, 'index']);
    $router->get('/admin/faqs/create', [AdminFaqController::class, 'create']);
    $router->post('/admin/faqs', [AdminFaqController::class, 'store']);
    $router->get('/admin/faqs/{id}/edit', [AdminFaqController::class, 'edit']);
    $router->post('/admin/faqs/{id}', [AdminFaqController::class, 'update']);
    $router->post('/admin/faqs/{id}/delete', [AdminFaqController::class, 'destroy']);

    $router->get('/admin/orders', [AdminOrderController::class, 'index']);
    $router->get('/admin/orders/{id}', [AdminOrderController::class, 'show']);
    $router->post('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus']);

    $router->get('/admin/pages', [AdminPageController::class, 'index']);
    $router->get('/admin/pages/create', [AdminPageController::class, 'create']);
    $router->post('/admin/pages', [AdminPageController::class, 'store']);
    $router->get('/admin/pages/{id}/edit', [AdminPageController::class, 'edit']);
    $router->post('/admin/pages/{id}', [AdminPageController::class, 'update']);
    $router->post('/admin/pages/{id}/delete', [AdminPageController::class, 'destroy']);

    $router->get('/admin/users', [AdminUserController::class, 'index']);
    $router->get('/admin/users/create', [AdminUserController::class, 'create']);
    $router->post('/admin/users', [AdminUserController::class, 'store']);
    $router->get('/admin/users/{id}/edit', [AdminUserController::class, 'edit']);
    $router->post('/admin/users/{id}', [AdminUserController::class, 'update']);
    $router->post('/admin/users/{id}/delete', [AdminUserController::class, 'destroy']);
});
