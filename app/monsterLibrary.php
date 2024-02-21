<?php

declare(strict_types=1);

namespace App;

use App\Monster;
use App\MonsterCollection;

require __DIR__ . "/../functions/armory.php";

$monsterLibrary = new MonsterCollection;

$cowardlyCultist = new Monster("Cowardly Cultist", 15);
$cowardlyCultist->setLevel(1);
$cowardlyCultist->setStrength(5);
$cowardlyCultist->setSpeed(5);
$cowardlyCultist->setVitality(10);
$cowardlyCultist->setSkill("Swords", 15);
$cowardlyCultist->setSkill("Evasion", 5);
$cowardlyCultist->setFatigue();
$cowardlyCultist->setCurrentHP($cowardlyCultist->getHP());
$cowardlyCultist->weapon = $shortsword;
$cowardlyCultist->shield = $none;
$cowardlyCultist->setDescription("He won\'t even look you in the eyes");
$monsterLibrary->addMonster($cowardlyCultist);

$goblin = new Monster("Goblin", 20);
$goblin->setLevel(1);
$goblin->setStrength(10);
$goblin->setSpeed(5);
$goblin->setVitality(10);
$goblin->setSkill("Axes", 15);
$goblin->setFatigue();
$goblin->setCurrentHP($goblin->getHP());
$goblin->weapon = $handaxe;
$goblin->shield = $none;
$goblin->setDescription("The foul smelling little shits are everywhere..");
$monsterLibrary->addMonster($goblin);

$bandit = new Monster("Bandit", 25);
$bandit->setLevel(2);
$bandit->setStrength(10);
$bandit->setSpeed(10);
$bandit->setVitality(10);
$bandit->setSkill("Swords", 20);
$bandit->setSkill("Initiative", 10);
$bandit->setSkill("Block", 5);
$bandit->setFatigue();
$bandit->setCurrentHP($bandit->getHP());
$bandit->weapon = $shortsword;
$bandit->shield = $buckler;
$bandit->setDescription("Your gold.. or your life. Actually, I\'ll have both.");
$monsterLibrary->addMonster($bandit);

$goblinRaider = new Monster("Goblin Raider", 25);
$goblinRaider->setLevel(4);
$goblinRaider->setStrength(10);
$goblinRaider->setSpeed(10);
$goblinRaider->setVitality(10);
$goblinRaider->setSkill("Swords", 30);
$goblinRaider->setSkill("Block", 20);
$goblinRaider->setFatigue();
$goblinRaider->setCurrentHP($goblinRaider->getHP());
$goblinRaider->weapon = $scimitar;
$goblinRaider->shield = $buckler;
$goblinRaider->setDescription("They loot and pillage. It\'s all they know..");
$monsterLibrary->addMonster($goblinRaider);

$angvarBull = new Monster("Angvarian Bull", 25);
$angvarBull->setLevel(6);
$angvarBull->setStrength(20);
$angvarBull->setSpeed(15);
$angvarBull->setVitality(25);
$angvarBull->setSkill("Initiative", 15);
$angvarBull->setSkill("Evasion", 20);
$angvarBull->setFatigue();
$angvarBull->setCurrentHP($angvarBull->getHP());
$angvarBull->weapon = new Weapon("Wicked Horns", "Unarmed", 0, 20, 3, 12, 0);
$angvarBull->setDescription("A ferocious bull from the southern plains.");
$monsterLibrary->addMonster($angvarBull);

/* 
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
$monsterLibrary->addMonster($giftborn); */
