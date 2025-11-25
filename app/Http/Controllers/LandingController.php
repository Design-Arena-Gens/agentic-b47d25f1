<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Setting;
use App\Http\Request;
use App\Http\Response;

final class LandingController extends Controller
{
    public function index(): Response
    {
        $brands = (new Brand())->all();
        $settings = (new Setting());

        return $this->view('landing/index', [
            'brands' => $brands,
            'seo' => [
                'title' => $settings->get('seo.home_title', 'Shnikh Agrobiotech & Cordygen'),
                'description' => $settings->get('seo.home_description', 'Innovative agri-biotech and cordyceps wellness.'),
            ],
        ]);
    }

    public function lead(Request $request): Response
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $brand = $request->input('brand');
        $message = $request->input('message');

        if (!$name || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Response::redirect('/?error=missing_fields');
        }

        $validBrands = array_map(fn ($item) => $item['slug'], brand_cache());
        if (!in_array($brand, $validBrands, true)) {
            $brand = $validBrands[0] ?? 'shnikh';
        }

        $leadDir = __DIR__ . '/../../../storage/leads';
        if (!is_dir($leadDir)) {
            mkdir($leadDir, 0775, true);
        }

        $payload = json_encode([
            'name' => $name,
            'email' => $email,
            'brand' => $brand,
            'message' => $message,
            'submitted_at' => date(DATE_ATOM),
        ], JSON_PRETTY_PRINT);

        file_put_contents($leadDir . '/' . time() . '_' . md5($email) . '.json', $payload);

        return Response::redirect('/?success=1');
    }
}
