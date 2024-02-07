<?php

declare(strict_types=1);

namespace App;

class Skill
{
    public function __construct(public string $name, public int $value)
    {
    }
}
