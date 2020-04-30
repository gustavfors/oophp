<?php

namespace Gufo\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class PlayerTest extends TestCase
{
    public function testCreateObject()
    {
        $player = new Player("John");
        $this->assertInstanceOf("\Gufo\Dice100\Player", $player);

        $name = $player->getName();
        $this->assertEquals("John", $name);
    }

    public function testSetGetCurrentScore()
    {
        $player = new Player("John");
        $player->setCurrentScore(100);
        
        $currentScore = $player->getCurrentScore();

        $this->assertEquals(100, $currentScore);
    }

    public function testSetGetRoundScore()
    {
        $player = new Player("John");
        $player->setCurrentScore(100);
        
        $player->setRoundScore();
        $roundScore = $player->getRoundScore();

        $this->assertEquals([100], $roundScore);
    }

    public function testGetTotalScore()
    {
        $player = new Player("John");
        $player->setCurrentScore(100);
        
        $player->setRoundScore();

        $totalScore = $player->getTotalScore();

        $this->assertEquals(100, $totalScore);
    }
}
