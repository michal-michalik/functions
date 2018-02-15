<?php

require_once(__DIR__ . '/../src/Slownie.php');

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testLiczbaRightAnswer()
    {
        $slownie = new Slownie();
        $number = $slownie->integerToText(0);

        $this->assertEquals('zero', $number);

        $number = $slownie->integerToText(5);

        $this->assertEquals('pięć', $number);
    }

    public function testThrowingExceptionOnInvalidArgument()
    {
        $slownie = new Slownie();

        try {
            $number = $slownie->integerToText("not a number");
        } catch (Exception $e) {

        }

        $this->fail('Exception not thrown when it\'s needed');
    }
}
