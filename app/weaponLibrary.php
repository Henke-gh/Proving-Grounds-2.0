<?php

declare(strict_types=1);

namespace App;

use App\Weapon;

$weapons = [
    'Swords' => [
        $shortsword = new Weapon("Short Sword", "Swords", 10, 2, 4, 50),
        $scimitar = new Weapon("Scimitar", "Swords", 25, 2, 7, 150),
    ],
    'Axes' => [
        $handaxe = new Weapon("Hand Axe", "Axe", 10, 2, 5, 50),
    ],
    'Spears' => [
        $shortspear = new Weapon("Short Spear", "Spear", 10, 1, 6, 50),
    ],
    'Hammers' => [
        $club = new Weapon("Club", "Hammers", 10, 1, 7, 50),
    ],
    'Daggers' => [
        $huntingknife = new Weapon("Hunting Knife", "Daggers", 10, 1, 4, 35),
        $twindaggers = new Weapon("Twin Daggers", "Daggers", 35, 3, 7, 200),
    ],

];

//Monster weapons should probably be generated on a per monster-instance basis when the monster instance is created.
$monsterWeapons = [];
