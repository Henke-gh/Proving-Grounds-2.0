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
$cowardlyCultist->setSpeed(10);
$cowardlyCultist->setVitality(10);
$cowardlyCultist->setSkill("Spears", 10);
$cowardlyCultist->setFatigue();
$cowardlyCultist->setCurrentHP($cowardlyCultist->getHP());
$cowardlyCultist->weapon = new Weapon("Crooked Cane", "Spears", 0, 10, 2, 3, 5);
$cowardlyCultist->setDescription("He won't even look you in the eyes");
$monsterLibrary->addMonster($cowardlyCultist);

$goblin = new Monster("Goblin", 20);
$goblin->setLevel(1);
$goblin->setStrength(10);
$goblin->setSpeed(5);
$goblin->setVitality(10);
$goblin->setSkill("Swords", 12);
$goblin->setFatigue();
$goblin->setCurrentHP($goblin->getHP());
$goblin->weapon = new Weapon("Chipped Blade", "Swords", 0, 10, 2, 3, 5);
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

$greywolf = new Monster("Grey Wolf", 25);
$greywolf->setLevel(2);
$greywolf->setStrength(20);
$greywolf->setSpeed(10);
$greywolf->setVitality(10);
$greywolf->setSkill("Initiative", 15);
$greywolf->setSkill("Evasion", 5);
$greywolf->setFatigue();
$greywolf->setCurrentHP($greywolf->getHP());
$greywolf->weapon = new Weapon("Sharp teeth", "Unarmed", 0, 0, 2, 3, 0);
$greywolf->setDescription("A pair of yellow eyes stare back at you from the gloom.");
$monsterLibrary->addMonster($greywolf);

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

$starvinglion = new Monster("Starved Lion", 30);
$starvinglion->setLevel(10);
$starvinglion->setStrength(30);
$starvinglion->setSpeed(20);
$starvinglion->setVitality(40);
$starvinglion->setSkill("Initiative", 35);
$starvinglion->setSkill("Evasion", 25);
$starvinglion->setFatigue();
$starvinglion->setCurrentHP($starvinglion->getHP());
$starvinglion->weapon = new Weapon("Claws", "Unarmed", 0, 0, 5, 10, 0);
$starvinglion->setDescription("This might prove to be a bad idea..");
$monsterLibrary->addMonster($starvinglion);

$fatfred = new Monster("Corpulent Bandit", 30);
$fatfred->setLevel(12);
$fatfred->setStrength(30);
$fatfred->setSpeed(20);
$fatfred->setVitality(125);
$fatfred->setSkill("Hammers", 50);
$fatfred->setFatigue();
$fatfred->setCurrentHP($fatfred->getHP());
$fatfred->weapon = $flail;
$fatfred->setDescription("A huge man with small evil eyes.");
$monsterLibrary->addMonster($fatfred);

$anointedCultist = new Monster("Anointed Cultist", 30);
$anointedCultist->setLevel(12);
$anointedCultist->setStrength(80);
$anointedCultist->setSpeed(10);
$anointedCultist->setVitality(35);
$anointedCultist->setSkill("Initiative", 40);
$anointedCultist->setSkill("Axes", 50);
$anointedCultist->setFatigue();
$anointedCultist->setCurrentHP($anointedCultist->getHP());
$anointedCultist->weapon = new Weapon("Cleaver", "Axes", 0, 40, 5, 15, 0);
$anointedCultist->armour = new Armour("Cultist Hooded Robes", "Armour", 0, 0, 0);
$anointedCultist->setDescription("Assigned to deal with cult dissidents. Swiftly.");
$monsterLibrary->addMonster($anointedCultist);

$berserker = new Monster("Vorthun Berserker", 35);
$berserker->setLevel(14);
$berserker->setStrength(55);
$berserker->setSpeed(25);
$berserker->setVitality(80);
$berserker->setSkill("Axes", 75);
$berserker->setSkill("Initiative", 40);
$berserker->setSkill("Block", 40);
$berserker->setFatigue();
$berserker->setCurrentHP($berserker->getHP());
$berserker->weapon = new Weapon("Reaver's Ax", "Axes", 0, 55, 8, 18, 15);
$berserker->shield = new Shield("Painted Round-shield", "Shield", 0, 35, 10);
$berserker->shield->setDmgReduction(4);
$berserker->armour = new Armour("Reaver's Garb", "Armour", 0, 0, 10);
$berserker->armour->setDmgReduction(2);
$berserker->setDescription("Frenzied and bloodthirsty. Fear him.");
$monsterLibrary->addMonster($berserker);

$goblinchief = new Monster("Goblin War-Chief", 35);
$goblinchief->setLevel(14);
$goblinchief->setStrength(50);
$goblinchief->setSpeed(25);
$goblinchief->setVitality(70);
$goblinchief->setSkill("Spears", 85);
$goblinchief->setSkill("Initiative", 30);
$goblinchief->setSkill("Block", 60);
$goblinchief->setFatigue();
$goblinchief->setCurrentHP($goblinchief->getHP());
$goblinchief->weapon = new Weapon("Carved Bone-Spear", "Spears", 0, 50, 7, 16, 15);
$goblinchief->shield = new Shield("Black Steel Targe", "Shield", 0, 35, 10);
$goblinchief->shield->setDmgReduction(5);
$goblinchief->armour = new Armour("Blackened Plates", "Armour", 0, 0, 10);
$goblinchief->armour->setDmgReduction(2);
$goblinchief->setDescription("Seems quite tall for such a lil' fella.");
$monsterLibrary->addMonster($goblinchief);

$monk = new Monster("Monk of Zhe", 35);
$monk->setLevel(16);
$monk->setStrength(50);
$monk->setSpeed(30);
$monk->setVitality(85);
$monk->setSkill("Daggers", 75);
$monk->setSkill("Evasion", 70);
$monk->setFatigue();
$monk->setCurrentHP($monk->getHP());
$monk->weapon = new Weapon("Steel Claws", "Daggers", 0, 50, 5, 18, 0);
$monk->armour = new Armour("Flowing Robes", "Armour", 0, 0, 0);
$monk->setDescription("A warrior monk from far away lands.");
$monsterLibrary->addMonster($monk);

$wyrm = new Monster("Scaled Wyrm", 40);
$wyrm->setLevel(20);
$wyrm->setStrength(70);
$wyrm->setSpeed(25);
$wyrm->setVitality(90);
$wyrm->setSkill("Initiative", 45);
$wyrm->setSkill("Evasion", 40);
$wyrm->setSkill("Block", 60);
$wyrm->setFatigue();
$wyrm->setCurrentHP($wyrm->getHP());
$wyrm->weapon = new Weapon("Spear-point Tail", "Unarmed", 0, 0, 10, 20, 0);
$wyrm->shield = new Shield("Scaled Wing", "Shield", 0, 30, 0);
$wyrm->shield->setDmgReduction(6);
$wyrm->armour = new Armour("Golden Scales", "Armour", 0, 0, 0);
$wyrm->armour->setDmgReduction(4);
$wyrm->setDescription("Its scales shine golden, its size dwarfs you.");
$monsterLibrary->addMonster($wyrm);
