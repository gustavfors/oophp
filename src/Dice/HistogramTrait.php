<?php

namespace Gufo\Dice;

trait HistogramTrait
{
    private $serie = [];

    public function getHistogramSerie()
    {
        
        return $this->serie;
    }

    public function updateHistogram(array $lastRoll)
    {
        array_push($this->serie, $lastRoll);
    }

    public function printHistogram()
    {
        $diceSides = [
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => []
        ];

        $output = "\n";
        $count = 1;

        foreach ($this->serie as $numbers) {
            foreach ($numbers as $number) {
                if (array_key_exists($number, $diceSides)) {
                    array_push($diceSides[$number], "*");
                }
            }
        }

        foreach ($diceSides as $numbers) {
            $output = $output . strval($count) . ": " . implode("", $numbers) . "\n";
            $count++;
        }

        return $output;
    }
}
