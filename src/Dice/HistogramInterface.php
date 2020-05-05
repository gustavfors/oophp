<?php

namespace Gufo\Dice;

interface HistogramInterface
{
    public function getHistogramSerie();
    public function updateHistogram(array $lastRoll);
    public function printHistogram();
}
