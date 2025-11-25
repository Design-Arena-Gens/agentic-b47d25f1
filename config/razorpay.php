<?php

return [
    'key' => getenv('RAZORPAY_KEY') ?: '',
    'secret' => getenv('RAZORPAY_SECRET') ?: '',
    'currency' => 'INR',
    'capture' => true,
];
