<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Core\Session;

final class BlogController extends Controller
{
    private BlogPost $posts;
    private Brand $brands;

    public function __construct()
    {
        $this->posts = new BlogPost();
        $this->brands = new Brand();
    }

    public function index(): Response
    {
        return $this->view('admin.blog.index', [
            'posts' => $this->posts->all(),
        ]);
    }

    public function create(): Response
    {
        return $this->view('admin.blog.form', [
            'post' => null,
            'brands' => $this->brands->all(),
        ]);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['slug'] = $data['slug'] ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', $data['title']));
        $this->posts->create($data);
        Session::flash('blog_success', 'Post created.');
        return Response::redirect('/admin/blog');
    }

    public function edit(Request $request, string $id): Response
    {
        return $this->view('admin.blog.form', [
            'post' => $this->posts->find((int) $id),
            'brands' => $this->brands->all(),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();
        $this->posts->update((int) $id, $data);
        Session::flash('blog_success', 'Post updated.');
        return Response::redirect('/admin/blog');
    }

    public function destroy(Request $request, string $id): Response
    {
        $this->posts->delete((int) $id);
        Session::flash('blog_success', 'Post deleted.');
        return Response::redirect('/admin/blog');
    }
}
