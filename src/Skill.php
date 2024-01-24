<?php

declare(strict_types=1);

namespace App;

class Skill
{
    public function __construct(public string $name, public int $value)
    {
    }
}

/* //weapon skill stats
    private int $swords = 0;
    private int $axes = 0;
    private int $hammers = 0;
    private int $spears = 0;
    private int $daggers = 0;
    //other skill stats
    private int $evasion = 0;
    private int $initiative = 0;
    private int $block = 0; */
