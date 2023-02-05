<?php

namespace App;

use Firebase\JWT\JWT;

class QuToken
{
    public function __construct(int $duration, $appSecret) {
        // create a JWT with start and end time as a payload (or the possibility to validate / invalidate times, and a list of UUIDs for the questions.
        $now = time(); //epoch seconds
        $payload = [
            'iss' => 'certifever.com',
            'aud' => 'certifever.com',
            'iss' => $now,
            'nbf' => $now,
            'exp' => $now + $duration
        ];
        $jwt = JWT::encode($payload, $appSecret, 'HS256');
    }
}
