<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\Page;
use App\Models\Brand;
use App\Core\Session;

final class PageController extends Controller
{
    private Page $pages;
    private Brand $brands;

    public function __construct()
    {
        $this->pages = new Page();
        $this->brands = new Brand();
    }

    public function index(): Response
    {
        return $this->view('admin.pages.index', [
            'pages' => $this->pages->all(),
        ]);
    }

    public function create(): Response
    {
        return $this->view('admin.pages.form', [
            'page' => null,
            'brands' => $this->brands->all(),
        ]);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['slug'] = $data['slug'] ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', $data['title']));
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $this->pages->create($data);
        Session::flash('page_success', 'Page created.');
        return Response::redirect('/admin/pages');
    }

    public function edit(Request $request, string $id): Response
    {
        return $this->view('admin.pages.form', [
            'page' => $this->pages->find((int) $id),
            'brands' => $this->brands->all(),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $this->pages->update((int) $id, $data);
        Session::flash('page_success', 'Page updated.');
        return Response::redirect('/admin/pages');
    }

    public function destroy(Request $request, string $id): Response
    {
        $this->pages->delete((int) $id);
        Session::flash('page_success', 'Page deleted.');
        return Response::redirect('/admin/pages');
    }
}
