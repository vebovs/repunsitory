<?php

return [
    'url' => env('FRONTEND_URL', 'https://repunsitory.herokuapp.com'),
    // path to my frontend page with query param queryURL(temporarySignedRoute URL)
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/verify-email?queryURL='),
];