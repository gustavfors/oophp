<?php

namespace Gufo\Dice100;

class Game
{
    private $players = [];
    private $dices = [];
    private $currentPlayer = 0;
    private $round = 0;
    private $lastRoll = [];
    private $playerRoundOver = false;
    private $gameOver = false;
    private $winners = [];

    public function __construct(int $players = 1, int $dices = 1)
    {
        for ($i = 1; $i <= $players; $i++) {
            $name = "Player " . ($i);
            if ($i == 1) {
                $name = "Player " . ($i) . " (You)";
            }
            array_push($this->players, new Player($name));
        }
        
        
        for ($i = 0; $i < $dices; $i++) {
            array_push($this->dices, new Dice(6));
        }
    }

    public function getRound()
    {
        return $this->round;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getCurrentPlayer()
    {
        return $this->players[$this->currentPlayer];
    }

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    public function aiPlay()
    {
        for ($i = 1; $i < count($this->players); $i++) {
            $this->rollDices();
            $this->endTurn();
        }
    }

    public function rollDices()
    {
        $this->lastRoll = [];

        foreach ($this->dices as $dice) {
            array_push($this->lastRoll, $dice->roll());
        }

        if (!in_array(1, $this->lastRoll)) {
            $this->getCurrentPlayer()->setCurrentScore(
                $this->getCurrentPlayer()->getCurrentScore() + array_sum($this->lastRoll)
            );
        } else {
            $this->getCurrentPlayer()->setCurrentScore(0);
            $this->playerRoundOver = true;
        }
    }

    public function endTurn()
    {
        $this->lastRoll = [];
        $this->getCurrentPlayer()->setRoundScore();
        $this->getCurrentPlayer()->setCurrentScore(0);
        if ($this->currentPlayer < count($this->players) -1) {
            $this->currentPlayer += 1;
        } else {
            $this->currentPlayer = 0;
            $this->round += 1;
            $this->playerRoundOver = false;
        }
    }

    public function getPlayerRoundOver()
    {
        return $this->playerRoundOver;
    }

    public function gameOver()
    {
        foreach ($this->players as $player) {
            if ($player->getTotalScore() >= 100) {
                array_push($this->winners, $player->getName());
            }
        }
        if ($this->winners) {
            $this->gameOver = true;
        }

        return $this->gameOver;
    }

    public function getWinners()
    {
        return $this->winners;
    }
}
