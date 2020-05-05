<?php

namespace Gufo\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Gufo\Dice\Dice", $dice);
    }

    public function testCreateObjectWithArguments()
    {
        $dice = new Dice(6);
        $this->assertInstanceOf("\Gufo\Dice\Dice", $dice);
    }

    public function testRoll()
    {
        $dice = new Dice(6);
        $val = $dice->roll();

        $this->assertInternalType("int", $val);
    }
}
