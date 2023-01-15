<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class ExampleTest extends TestCase
{
    public function testRequest() {
        $parsed = Yaml::parse(
            file_get_contents("https://raw.githubusercontent.com/certificationy/symfony-pack/master/data/config.yml")
        );
        self::assertTrue(true);
    }
}
