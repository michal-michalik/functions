<?php

require_once(__DIR__ . '/../src/Slownie.php');

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testLiczbaRightAnswerOnIntegerParameter()
    {
        $slownie = new Slownie();

        $number = $slownie->liczba(0);
        $this->assertEquals('zero', $number);

        $number = $slownie->liczba(5);
        $this->assertEquals('pięć', $number);

        $number = $slownie->liczba(-5);
        $this->assertEquals('minus pięć', $number);

        $number = $slownie->liczba(-976);
        $this->assertEquals('minus dziewięćset siedemdziesiąt sześć', $number);

        $number = $slownie->liczba("-670037000288");
        $this->assertEquals('minus sześćset siedemdziesiąt miliardów trzydzieści siedem milionów dwieście osiemdziesiąt osiem', $number);
    }

    public function testThrowingExceptionOnInvalidArgument()
    {
        $slownie = new Slownie();

        try {
            $slownie->liczba("not a number");
            $this->fail('Exception not thrown when it\'s needed');
        } catch (Exception $e) {

        }
    }
}
