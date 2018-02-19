<?php

require_once(__DIR__ . '/../src/Slownie.php');

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testLiczbaRightAnswerOnIntegerNumberParameter()
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

    public function testLiczbaRightAnswerOnRealNumberParameter()
    {
        $slownie = new Slownie();

        $number = $slownie->liczba(0.0001);
        $this->assertEquals('zero i jedna dziesięciotysięczna', $number);

        $number = $slownie->liczba(0.00002);
        $this->assertEquals('zero i dwie stutysięczne', $number);

        $number = $slownie->liczba(0.13);
        $this->assertEquals('zero i trzynaście setnych', $number);

        $number = $slownie->liczba('-0.13');
        $this->assertEquals('minus zero i trzynaście setnych', $number);

        $number = $slownie->liczba(12.9461);
        $this->assertEquals('dwanaście i dziewięć tysięcy czterysta sześćdziesiąt jeden dziesięciotysięcznych', $number);

        $number = $slownie->liczba('9943.12000000');
        $this->assertEquals('dziewięć tysięcy dziewięćset czterdzieści trzy i dwanaście setnych', $number);

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
