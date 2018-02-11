<?php

require_once('src/Slownie.php');

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testLiczbaRightAnswer()
    {
        $slownie = new Slownie();
        $number = $slownie->liczba(0);

        $this->assertEquals(
            'zero',
            $number
        );

        $number = $slownie->liczba(1);

        $this->assertEquals(
            'jeden',
            $number
        );
    }
}
