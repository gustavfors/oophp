<?php

namespace Gufo\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $this->assertInstanceOf("\Gufo\Dice100\Game", $game);
    }

    public function testGetRound()
    {
        $game = new Game();
        $round = $game->getRound();
        $this->assertEquals(0, $round);
    }

    public function testCreateObjectWithArguments()
    {
        $game = new Game(5, 5);
        $players = $game->getPlayers();
        $this->assertEquals(5, count($players));
    }

    public function testGetCurrentPlayer()
    {
        $game = new Game();
        $player = $game->getCurrentPlayer();

        $this->assertInstanceOf("\Gufo\Dice100\Player", $player);
    }

    public function testSimulateWin()
    {
        $game = new Game(2, 2);

        $winner = $game->getCurrentPlayer();

        $winner->setCurrentScore(100);
        $winner->setRoundScore();

        $game->gameOver();

        $winners = $game->getWinners();

        $this->assertEquals([$winner->getName()], $winners);
    }

    public function testDiceRoll()
    {
        $game = new Game(2, 5);
        
        $game->rollDices();
        $lastRoll = $game->getLastRoll();

        $this->assertEquals(5, count($lastRoll));
    }
}
