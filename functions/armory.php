<?php

declare(strict_types=1);
//Instantiates all item objects and sorts them into category specific arrays for easier access.

use App\Weapon;
use App\Shield;

$weapons = [
    'Swords' => [],
    'Spears' => [],
    'Axes' => [],
    'Hammers' => [],
    'Daggers' => []
];

$shields = [];

$armour = [];

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
$buckler = new Shield("Buckler", "Shield", 30, 5, 1, 0);
$buckler->setItemDescription("It\'s basically a platter.");
$buckler->addToArmory($shields);

//Armour

//Trinkets
