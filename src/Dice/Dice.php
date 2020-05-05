<?php

namespace Gufo\Dice;

class Dice
{
    private $sides;

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    public function roll()
    {
        return rand(1, $this->sides);
    }
}
