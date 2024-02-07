<?php

declare(strict_types=1);

namespace App;

use App\Shield;

$shields = [
    $buckler = new Shield("Buckler", "Shield", 5, 2, 0, 30),
    $smallShield = new Shield("Small Shield", "Shield", 15, 3, 5, 50),
    $roundShield = new Shield("Round Shield", "Shield", 35, 5, 10, 70)
];

$buckler->setItemDescription("A small circular disc with a couple of dents.");

$smallShield->setBlockBonus(5);
$smallShield->setItemDescription("A very light, wooden shield. It's better than nothing.");

$roundShield->setBlockBonus(10);
$roundShield->setItemDescription("Decorated and very round. Nice!");
