<?php

namespace App;

use Firebase\JWT\JWT;

class QuToken
{
    private string $jwt;
    public function __construct(int $duration, array $questions) {
        $appSecret = $_ENV["APP_SECRET"]; //todo read this from symfony config
        // create a JWT with start and end time as a payload (or the possibility to validate / invalidate times, and a list of UUIDs for the questions.
        $now = time(); //epoch seconds
        $payload = [
            'iss' => 'certifever.com',
            'aud' => 'certifever.com',
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + $duration,
            'questions' => $questions
        ];
        $this->jwt = JWT::encode($payload, $appSecret, 'HS256');
    }

    public function getJwt() {
        return $this->jwt;
    }
}
