<?php

return [
    'name' => 'Shnikh Platform',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => getenv('APP_DEBUG') === 'true',
    'url' => getenv('APP_URL') ?: 'https://example.com',
    'timezone' => 'Asia/Kolkata',
];
