<?php

namespace Gufo\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTraitTest extends TestCase
{
    public function testAccessTraitMethodGet()
    {
         $player = new player("test");
         $this->assertIsArray($player->getHistogramSerie());
    }

    public function testAccessTraitMethodUpdate()
    {
        $player = new player("test");

        $player->updateHistogram([1, 2, 3]);

        $this->assertEquals([[1, 2, 3]], $player->getHistogramSerie());
    }

    public function testAccessTraitMethodPrint()
    {
        $player = new player("test");

        $player->updateHistogram([1, 2, 3]);

        $this->assertIsString($player->printHistogram());
    }
}
