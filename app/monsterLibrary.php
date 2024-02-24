<?php

declare(strict_types=1);

namespace App;

use App\Monster;
use App\MonsterCollection;
use Shmop;

require __DIR__ . "/../functions/armory.php";

$monsterLibrary = new MonsterCollection;

$cowardlyCultist = new Monster("Cowardly Cultist", 15);
$cowardlyCultist->setLevel(1);
$cowardlyCultist->setStrength(5);
$cowardlyCultist->setSpeed(5);
$cowardlyCultist->setVitality(10);
$cowardlyCultist->setSkill("Spears", 15);
$cowardlyCultist->setSkill("Evasion", 5);
$cowardlyCultist->setFatigue();
$cowardlyCultist->setCurrentHP($cowardlyCultist->getHP());
$cowardlyCultist->weapon = new Weapon("Crooked Cane", "Spears", 0, 10, 2, 4, 5);
$cowardlyCultist->setDescription("He won't even look you in the eyes");
$monsterLibrary->addMonster($cowardlyCultist);

$goblin = new Monster("Goblin", 20);
$goblin->setLevel(1);
$goblin->setStrength(10);
$goblin->setSpeed(5);
$goblin->setVitality(10);
$goblin->setSkill("Swords", 15);
$goblin->setFatigue();
$goblin->setCurrentHP($goblin->getHP());
$goblin->weapon = new Weapon("Chipped Blade", "Swords", 0, 10, 2, 4, 5);
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
$bandit->setDescription("Your gold.. or your life. Actually, I'll have both.");
$monsterLibrary->addMonster($bandit);

$goblinRaider = new Monster("Goblin Raider", 25);
$goblinRaider->setLevel(4);
$goblinRaider->setStrength(10);
$goblinRaider->setSpeed(10);
$goblinRaider->setVitality(20);
$goblinRaider->setSkill("Swords", 30);
$goblinRaider->setSkill("Block", 25);
$goblinRaider->setFatigue();
$goblinRaider->setCurrentHP($goblinRaider->getHP());
$goblinRaider->weapon = new Weapon("Blackened Blade", "Swords", 0, 20, 2, 6, 5);
$goblinRaider->shield = new Shield("Spiked Buckler", "Shield", 0, 15, 0);
$goblinRaider->shield->setDmgReduction(2);
$goblinRaider->setDescription("They loot and pillage. It's all they know..");
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

$legionnairescout = new Monster("Legionnaire Scout", 25);
$legionnairescout->setLevel(6);
$legionnairescout->setStrength(15);
$legionnairescout->setSpeed(10);
$legionnairescout->setVitality(20);
$legionnairescout->setSkill("Swords", 40);
$legionnairescout->setSkill("Evasion", 30);
$legionnairescout->setFatigue();
$legionnairescout->setCurrentHP($legionnairescout->getHP());
$legionnairescout->weapon = $scimitar;
$legionnairescout->setDescription("Forward scout of the Red Legion");
$monsterLibrary->addMonster($legionnairescout);

$youngtroll = new Monster("Young Troll", 25);
$youngtroll->setLevel(8);
$youngtroll->setStrength(30);
$youngtroll->setSpeed(8);
$youngtroll->setVitality(30);
$youngtroll->setSkill("Hammers", 45);
$youngtroll->setSkill("Evasion", 15);
$youngtroll->setFatigue();
$youngtroll->setCurrentHP($youngtroll->getHP());
$youngtroll->weapon = new Weapon("Heavy Club", "Hammers", 0, 35, 4, 10, 10);
$youngtroll->armour = new Armour("Thick Hide", "Armour", 0, 0, 0);
$youngtroll->armour->setDmgReduction(1);
$youngtroll->setDescription("The offspring of something much larger..");
$monsterLibrary->addMonster($youngtroll);

$commander = new Monster("Legionnaire Commander", 30);
$commander->setLevel(10);
$commander->setStrength(25);
$commander->setSpeed(15);
$commander->setVitality(50);
$commander->setSkill("Swords", 55);
$commander->setSkill("Initiative", 30);
$commander->setSkill("Evasion", 20);
$commander->setSkill("Block", 45);
$commander->setFatigue();
$commander->setCurrentHP($commander->getHP());
$commander->weapon = $longsword;
$commander->shield = $kiteshield;
$commander->armour = new Armour("Legion Gambeson", "Armour", 0, 0, 5);
$commander->setDescription("Acknowledge only victory.");
$monsterLibrary->addMonster($commander);

$berserker = new Monster("Vorthun Berserker", 40);
$berserker->setLevel(14);
$berserker->setStrength(55);
$berserker->setSpeed(25);
$berserker->setVitality(80);
$berserker->setSkill("Axes", 75);
$berserker->setSkill("Initiative", 30);
$berserker->setSkill("Block", 55);
$berserker->setFatigue();
$berserker->setCurrentHP($berserker->getHP());
$berserker->weapon = new Weapon("Reaver's Ax", "Axes", 0, 55, 8, 20, 15);
$berserker->shield = new Shield("Painted Round-shield", "Shield", 0, 35, 10);
$berserker->shield->setDmgReduction(4);
$berserker->armour = new Armour("Reaver's Garb", "Armour", 0, 0, 10);
$berserker->armour->setDmgReduction(2);
$berserker->setDescription("Frenzied and bloodthirsty. Fear him.");
$monsterLibrary->addMonster($berserker);

/* 

//Only for testing
$giftborn = new Monster("Gift-Born", 100, 1, 500, new Weapon("Palm", "Accuracy", 0, 0, 0, 0, 0));
$giftborn->setSkill("Accuracy", 5);
$giftborn->setDescription("Press \'E\' to gain Experience..");
$monsterLibrary->addMonster($giftborn); */
