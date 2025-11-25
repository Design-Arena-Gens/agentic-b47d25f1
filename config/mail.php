<?php

return [
    'driver' => getenv('MAIL_DRIVER') ?: 'smtp',
    'host' => getenv('MAIL_HOST') ?: 'smtp.hostinger.com',
    'port' => (int) (getenv('MAIL_PORT') ?: 587),
    'username' => getenv('MAIL_USERNAME') ?: '',
    'password' => getenv('MAIL_PASSWORD') ?: '',
    'encryption' => getenv('MAIL_ENCRYPTION') ?: 'tls',
    'from_name' => getenv('MAIL_FROM_NAME') ?: 'Shnikh Platform',
    'from_address' => getenv('MAIL_FROM_ADDRESS') ?: 'no-reply@example.com',
];
