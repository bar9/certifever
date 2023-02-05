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
        $questions = [];
        //TODO tbd: how do we pass the questions to the token? uuids?
        $token = new QuToken($duration, $questions);
        return $token;
    }
}

