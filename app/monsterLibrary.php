<?php

declare(strict_types=1);

namespace App;

use App\Weapon;
use App\Monster;
use App\MonsterCollection;

require __DIR__ . "/../functions/armory.php";

$monsterLibrary = new MonsterCollection;

$cowardlyCultist = new Monster("Cowardly Cultist", 1, 12, 20, new Weapon("Iron Cane", "Accuracy", 0, 5, 2, 3, 0));
$cowardlyCultist->setSkill("Accuracy", 12);
$cowardlyCultist->setSkill("Evasion", 8);
$cowardlyCultist->setDescription("He won\'t even look you in the eyes.");
$monsterLibrary->addMonster($cowardlyCultist);

$goblin = new Monster("Goblin", 1, 15, 20, new Weapon("Crooked Blade", "Accuracy", 0, 5, 1, 4, 0));
$goblin->setSkill("Accuracy", 15);
$goblin->setSkill("Evasion", 5);
$goblin->setDescription("The foul smelling little shits are everywhere..");
$monsterLibrary->addMonster($goblin);

$bandit = new Monster("Bandit", 2, 20, 25, new Weapon("Short Sword", "Accuracy", 0, 15, 2, 6, 0));
$bandit->setSkill("Accuracy", 15);
$bandit->setSkill("Initiative", 10);
$bandit->setDescription("Your gold.. or your life. Actually, I\'ll have both.");
$monsterLibrary->addMonster($bandit);

$goblinRaider = new Monster("Goblin Raider", 4, 35, 30, new Weapon("Blackened Axe", "Accuracy", 0, 25, 4, 8, 0));
$goblinRaider->setSkill("Accuracy", 35);
$goblinRaider->setSkill("Initiative", 5);
$goblinRaider->setDescription("They loot and pillage. It\'s all they know..");
$monsterLibrary->addMonster($goblinRaider);

$angvarBull = new Monster("Angvarian Bull", 6, 45, 35, new Weapon("Wicked Horns", "Accuracy", 0, 10, 4, 15, 0));
$angvarBull->setSkill("Accuracy", 40);
$angvarBull->setSkill("Initiative", 25);
$angvarBull->setDescription("A ferocious bull from the southern plains.");
$monsterLibrary->addMonster($angvarBull);

$legionnairescout = new Monster("Legionnaire Scout", 6, 40, 35, new Weapon("Scimitar", "Accuracy", 0, 30, 3, 9, 0));
$legionnairescout->setSkill("Accuracy", 50);
$legionnairescout->setSkill("Evasion", 35);
$legionnairescout->setDescription("Forward scout of the Red Legion");
$monsterLibrary->addMonster($legionnairescout);

$yountroll = new Monster("Young Troll", 8, 55, 35, new Weapon("Heavy Club", "Accuracy", 0, 20, 4, 10, 0));
$yountroll->setSkill("Accuracy", 40);
$yountroll->setDmgReduction(1);
$yountroll->setDescription("The offspring of something much larger..");
$monsterLibrary->addMonster($yountroll);

$commander = new Monster("Legionnaire Commander", 10, 70, 40, new Weapon("Long Sword", "Accuracy", 0, 40, 5, 12, 0));
$commander->setSkill("Accuracy", 60);
$commander->setSkill("Evasion", 20);
$commander->setSkill("Initiative", 10);
$commander->setDmgReduction(1);
$commander->setDescription("Acknowledge only victory.");
$monsterLibrary->addMonster($commander);

//Only for testing
$giftborn = new Monster("Gift-Born", 100, 1, 500, new Weapon("Palm", "Accuracy", 0, 0, 0, 0, 0));
$giftborn->setSkill("Accuracy", 5);
$giftborn->setDescription("Press \'E\' to gain Experience..");
$monsterLibrary->addMonster($giftborn);
