<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\Brand;
use App\Core\Session;

final class BrandController extends Controller
{
    private Brand $brands;

    public function __construct()
    {
        $this->brands = new Brand();
    }

    public function index(): Response
    {
        return $this->view('admin.brands.index', [
            'brands' => $this->brands->all(),
        ]);
    }

    public function edit(Request $request, string $id): Response
    {
        return $this->view('admin.brands.form', [
            'brand' => $this->brands->find((int) $id),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $this->brands->update((int) $id, $request->all());
        Session::flash('brand_success', 'Brand updated.');
        return Response::redirect('/admin/brands');
    }
}
