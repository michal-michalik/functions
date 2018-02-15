<?php

require_once(__DIR__ . '/../src/Slownie.php');

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testLiczbaRightAnswer()
    {
        $slownie = new Slownie();
        $number = $slownie->liczba(0);

        $this->assertEquals('zero', $number);

        $number = $slownie->liczba(5);

        $this->assertEquals('pięć', $number);
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
