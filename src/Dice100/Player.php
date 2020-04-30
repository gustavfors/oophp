<?php

namespace Gufo\Dice100;

class Player
{
    private $roundScore = [];
    private $currentScore = 0;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTotalScore()
    {
        return array_sum($this->roundScore);
    }

    public function getRoundScore()
    {
        return $this->roundScore;
    }

    public function setRoundScore()
    {
        array_push($this->roundScore, $this->currentScore);
    }

    public function getCurrentScore()
    {
        return $this->currentScore;
    }

    public function setCurrentScore(int $score)
    {
        return $this->currentScore = $score;
    }
}
