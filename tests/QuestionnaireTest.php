<?php

namespace App\Tests;

use App\Questionnaire;
use App\QuToken;
use PHPUnit\Framework\TestCase;

class QuestionnaireTest extends TestCase {

    private Questionnaire $questionnaire;

    public function setup(): void{
        $this->questionnaire = Questionnaire::default();
    }

    function testDefaultCreation(): void {
        $questionnaire = Questionnaire::default(); self::assertInstanceOf(Questionnaire::class, $questionnaire);
    }

    function testStartTraining(): void {
        $token = $this->questionnaire->startTraining(topic: "PHP", num: 10, time: 10, unit: Questionnaire::MINUTES);
        self::assertInstanceOf(QuToken::class, $token);
    }
}
