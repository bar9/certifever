<?php

namespace App\Tests;

use App\Questionnaire;
use App\QuToken;
use App\Kernel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Dotenv\Dotenv;

class QuestionnaireTest extends KernelTestCase {

    private Questionnaire $questionnaire;

    public function setup(): void{
        $this->questionnaire = Questionnaire::default();
    }

    function testDefaultCreation(): void {
        $questionnaire = Questionnaire::default(); self::assertInstanceOf(Questionnaire::class, $questionnaire);
    }

    function testStartTraining(): void {
        $token = $this->questionnaire->startTraining(topic: "PHP", num: 3, duration: 10, unit: Questionnaire::MINUTES);
        self::assertInstanceOf(QuToken::class, $token);
        $decodedToken = JWT::decode($token->getJwt(), new Key($_ENV['APP_SECRET'], 'HS256'));
        self::assertCount(3, $decodedToken->questions);
        self::assertUuid($decodedToken->questions[0]);
    }

    private static function assertUuid(string $uuid): void {
        self::assertIsString($uuid);
        self::assertEquals(36, strlen($uuid));
    }
}
