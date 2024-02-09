<?php

declare(strict_types=1);
//Instantiates all item objects and sorts them into category specific arrays for easier access.

use App\Armour;
use App\Weapon;
use App\Shield;
use App\Trinket;

$weapons = [
    'Swords' => [],
    'Spears' => [],
    'Axes' => [],
    'Hammers' => [],
    'Daggers' => []
];

$shields = [];

$armours = [];

$trinkets = [];

//Weapons by Weapon Type
//Swords
$shortsword = new Weapon("Short Sword", "Swords", 50, 10, 2, 4, 5);
$shortsword->setItemDescription("Lil\' pointy");
$shortsword->addToArmory($weapons['Swords']);

$scimitar = new Weapon("Scimitar", "Swords", 100, 25, 2, 7, 5);
$scimitar->setItemDescription("A curved classic.");
$scimitar->addToArmory($weapons['Swords']);
//Spears
$shortspear = new Weapon("Short Spear", "Spears", 50, 10, 1, 6, 5);
$shortspear->setItemDescription("Stick with pointy end.");
$shortspear->addToArmory($weapons['Spears']);

$boarlance = new Weapon("Boar Lance", "Spears", 300, 50, 5, 20, 10);
$boarlance->setItemDescription("Popular in the Royal Huntsmen\'s Guild");
$boarlance->addToArmory($weapons['Spears']);
//Axes
$handaxe = new Weapon("Hand Axe", "Axes", 50, 10, 2, 5, 5);
$handaxe->setItemDescription("Chop, chop..");
$handaxe->addToArmory($weapons['Axes']);
//Hammers
$club = new Weapon("Wooden Club", "Hammers", 50, 10, 1, 7, 5);
$club->setItemDescription("Let\'s be real, it\'s a large stick.");
$club->addToArmory($weapons['Hammers']);
//Daggers
$dagger = new Weapon("Dagger", "Daggers", 35, 10, 1, 4, 0);
$dagger->setItemDescription("Good for carving steaks.");
$dagger->addToArmory($weapons['Daggers']);

$twisteddagger = new Weapon("Twisted Dagger", "Daggers", 150, 35, 3, 7, 2);
$twisteddagger->setItemDescription("A wicked little thing.");
$twisteddagger->addToArmory($weapons['Daggers']);

//Shields
$buckler = new Shield("Buckler", "Shield", 35, 5, 0);
$buckler->setDmgReduction(1);
$buckler->setItemDescription("It\'s basically a platter.");
$buckler->addToArmory($shields);

//Armour
$tunic = new Armour("Tunic", "Armour", 0, 0, 0);
$tunic->setItemDescription("The merchant said it\s a nice tunic. Looks more like rags to you.");

$gladleather = new Armour("Gladiator Leathers", "Armour", 50, 0, 5);
$gladleather->setEvasionBonus(2);
$gladleather->setDmgReduction(1);
$gladleather->setItemDescription("A set of light leather plates and straps");
$gladleather->addToArmory($armours);

//Trinkets
$zehirStone = new Trinket("Stone of Zehir", "Trinket", 450, 0, 0);
$zehirStone->setInitiativeBonus(10);
$zehirStone->setItemDescription("Time slows down..");
$zehirStone->addToArmory($trinkets);
