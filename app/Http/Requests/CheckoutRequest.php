<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Request;

final class CheckoutRequest
{
    public static function validate(Request $request): array
    {
        $required = [
            'name',
            'email',
            'phone',
            'address',
            'city',
            'state',
            'zip',
            'country',
            'payment_method',
        ];

        $data = [];
        foreach ($required as $field) {
            $value = trim((string) $request->input($field, ''));
            if ($value === '') {
                throw new \InvalidArgumentException("Field {$field} is required.");
            }
            $data[$field] = $value;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('A valid email is required.');
        }

        $data['notes'] = trim((string) $request->input('notes', ''));
        return $data;
    }
}
