<?php

declare(strict_types=1);

namespace App;

use App\Weapon;

$weapons = [
    'Swords' => [
        $shortsword = new Weapon("Short Sword", "Swords", 2, 4, 50),
    ],
    'Axes' => [
        $handaxe = new Weapon("Hand Axe", "Axe", 2, 5, 50),
    ],
    'Spears' => [
        $shortspear = new Weapon("Short Spear", "Spear", 1, 6, 50),
    ],
    'Hammers' => [
        $club = new Weapon("Club", "Hammers", 1, 7, 50),
    ],
    'Daggers' => [
        $twindaggers = new Weapon("Twin Daggers", "Daggers", 3, 7, 50),
    ],

];

//Monster weapons should probably be generated on a per monster-instance basis when the monster instance is created.
$monsterWeapons = [];
