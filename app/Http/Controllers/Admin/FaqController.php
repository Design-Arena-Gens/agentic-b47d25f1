<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\Faq;
use App\Models\Brand;
use App\Core\Session;

final class FaqController extends Controller
{
    private Faq $faqs;
    private Brand $brands;

    public function __construct()
    {
        $this->faqs = new Faq();
        $this->brands = new Brand();
    }

    public function index(): Response
    {
        return $this->view('admin.faq.index', [
            'faqs' => $this->faqs->all(),
        ]);
    }

    public function create(): Response
    {
        return $this->view('admin.faq.form', [
            'faq' => null,
            'brands' => $this->brands->all(),
        ]);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $this->faqs->create($data);
        Session::flash('faq_success', 'FAQ created.');
        return Response::redirect('/admin/faqs');
    }

    public function edit(Request $request, string $id): Response
    {
        return $this->view('admin.faq.form', [
            'faq' => $this->faqs->find((int) $id),
            'brands' => $this->brands->all(),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $this->faqs->update((int) $id, $data);
        Session::flash('faq_success', 'FAQ updated.');
        return Response::redirect('/admin/faqs');
    }

    public function destroy(Request $request, string $id): Response
    {
        $this->faqs->delete((int) $id);
        Session::flash('faq_success', 'FAQ removed.');
        return Response::redirect('/admin/faqs');
    }
}
