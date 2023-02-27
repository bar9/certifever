<?php

namespace App;

class Questionnaire
{
    public const MINUTES = 60;
    public const SECONDS = 1;

    public static function default(): self
    {
        return new self;
    }

    public function startTraining(string $topic, int $num, int $duration, int $unit = self::SECONDS): QuToken
    {
        $duration *= $unit; // all times in seconds in here
        $questions = [
            '5428c30b-5efb-4ea4-b764-0aa4b4db0da9',
            'e6560cb9-fdd9-4c55-85ed-794819036788',
            '0285b9fa-4d8a-4b73-8dda-d6908b77d6c8'
        ];
        $token = new QuToken($duration, $questions);
        return $token;
    }
}

