<?php

declare(strict_types=1);

namespace App;

use App\Weapon;
use App\Monster;
use App\MonsterCollection;

$monsterLibrary = new MonsterCollection;

$goblin = new Monster("Goblin", 1, 15, 20, new Weapon("Crooked Blade", "Accuracy", 15, 2, 4, 5));
$goblin->setSkill("Accuracy", 15);
$goblin->setSkill("Evasion", 5);
$goblin->setDescription("The foul smelling little shits are everywhere..");
$monsterLibrary->addMonster($goblin);


$cowardlyCultist = new Monster("Cowardly Cultist", 1, 12, 200, new Weapon("Iron Cane", "Accuracy", 10, 1, 5, 5));
$cowardlyCultist->setSkill("Accuracy", 12);
$cowardlyCultist->setSkill("Evasion", 8);
$cowardlyCultist->setDescription("He won\'t even look you in the eyes.");
$monsterLibrary->addMonster($cowardlyCultist);

$bandit = new Monster("Bandit", 2, 20, 25, new Weapon("Short Sword", "Accuracy", 20, 2, 5, 5));
$bandit->setSkill("Accuracy", 15);
$bandit->setSkill("Initiative", 10);
$bandit->setDescription("Your gold.. or your life. Actually, I\'ll have both.");
$monsterLibrary->addMonster($bandit);
