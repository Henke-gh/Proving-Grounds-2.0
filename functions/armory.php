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
//Default (unarmed) added to the bottom of this file
$fists = new Weapon("Fists", "Unarmed", 0, 0, 1, 2, 0);
$fists->setItemDescription("They're your flesh mittens, champ. Might wanna invest in something for them to swing.");
//Swords
$shortsword = new Weapon("Short Sword", "Swords", 50, 10, 2, 4, 5);
$shortsword->setItemDescription("Lil' pointy");
$shortsword->addToArmory($weapons['Swords']);

$scimitar = new Weapon("Scimitar", "Swords", 130, 30, 2, 7, 5);
$scimitar->setItemDescription("A curved classic.");
$scimitar->addToArmory($weapons['Swords']);

$longsword = new Weapon("Long Sword", "Swords", 450, 50, 5, 12, 10);
$longsword->setInitiativeBonus(5);
$longsword->setItemDescription("Finely crafted with a keen edge.");
$longsword->addToArmory($weapons['Swords']);
//Spears
$shortspear = new Weapon("Short Spear", "Spears", 50, 10, 1, 6, 5);
$shortspear->setItemDescription("Stick with pointy end.");
$shortspear->addToArmory($weapons['Spears']);

$huntingspear = new Weapon("Hunting Spear", "Spears", 140, 30, 2, 8, 6);
$huntingspear->setItemDescription("A long spear, used for game hunting.");
$huntingspear->setInitiativeBonus(5);
$huntingspear->addToArmory($weapons['Spears']);

$boarlance = new Weapon("Boar Lance", "Spears", 400, 65, 2, 14, 10);
$boarlance->setInitiativeBonus(10);
$boarlance->setItemDescription("Popular in the Royal Huntsmen's Guild");
$boarlance->addToArmory($weapons['Spears']);
//Axes
$handaxe = new Weapon("Hand Axe", "Axes", 50, 10, 2, 5, 5);
$handaxe->setItemDescription("Chop, chop..");
$handaxe->addToArmory($weapons['Axes']);

$broadax = new Weapon("Broad Axe", "Axes", 150, 35, 3, 8, 8);
$broadax->setItemDescription("Comes with a heavier, broader axe-head.");
$broadax->addToArmory($weapons['Axes']);

$waraxe = new Weapon("War Axe", "Axes", 380, 45, 5, 12, 12);
$waraxe->setItemDescription("Balanced and deadly.");
$waraxe->addToArmory($weapons['Axes']);

//Hammers
$club = new Weapon("Wooden Club", "Hammers", 50, 10, 1, 7, 5);
$club->setItemDescription("Let's be real, it's a large stick.");
$club->addToArmory($weapons['Hammers']);

$mace = new Weapon("Mace", "Hammers", 150, 30, 3, 7, 8);
$mace->setItemDescription("A steel mace with a flanged head.");
$mace->addToArmory($weapons['Hammers']);

$flail = new Weapon("Flail", "Hammers", 400, 50, 2, 16, 15);
$flail->setItemDescription("The ball at the end of the chain is covered in spikes.");
$flail->addToArmory($weapons['Hammers']);
//Daggers
$dagger = new Weapon("Dagger", "Daggers", 35, 10, 1, 4, 0);
$dagger->setItemDescription("Good for carving steaks.");
$dagger->addToArmory($weapons['Daggers']);

$twisteddagger = new Weapon("Twisted Dagger", "Daggers", 150, 35, 3, 6, 2);
$twisteddagger->setEvasionBonus(10);
$twisteddagger->setItemDescription("A wicked little thing.");
$twisteddagger->addToArmory($weapons['Daggers']);

$wristblade = new Weapon("Wrist Blade", "Dagger", 450, 55, 4, 11, 5);
$wristblade->setEvasionBonus(10);
$wristblade->setItemDescription("The handle runs perpendicular to the blade.");
$wristblade->addToArmory($weapons['Daggers']);

//Shields
//Added to default array at the bottom of this file
$none = new Shield("None", "Shield", 0, 100, 0);
$none->setDmgReduction(0);
$none->setItemDescription("It's really not ideal but you could probably deflect a blow or two with your elbow.");

$buckler = new Shield("Buckler", "Shield", 35, 5, 0);
$buckler->setDmgReduction(1);
$buckler->setItemDescription("It's basically a platter.");
$buckler->addToArmory($shields);

$roundshield = new Shield("Round Shield", "Shield", 150, 30, 5);
$roundshield->setDmgReduction(3);
$roundshield->setBlockBonus(5);
$roundshield->setItemDescription("A winged snake is coiled along the edge of the shield rim.");
$roundshield->addToArmory($shields);

$kiteshield = new Shield("Kite Shield", "Shield", 300, 50, 15);
$kiteshield->setDmgReduction(5);
$kiteshield->setBlockBonus(8);
$kiteshield->setItemDescription("A Knight's Shield. Emblazoned with a golden griffon.");
$kiteshield->addToArmory($shields);

$parrydagger = new Shield("Parry Dagger", "Shield", 450, 10, 5);
$parrydagger->setDmgReduction(1);
$parrydagger->setEvasionBonus(10);
$parrydagger->setItemDescription("A pronged dagger for catching blades.");
$parrydagger->addToArmory($shields);

$towershield = new Shield("Aegis", "Shield", 500, 70, 25);
$towershield->setDmgReduction(7);
$towershield->setBlockBonus(14);
$towershield->setItemDescription("It's enormous. You could camp underneath this thing.");
$towershield->addToArmory($shields);

//Armour
//Added to default array
$tunic = new Armour("Tunic", "Armour", 0, 0, 0);
$tunic->setDmgReduction(0);
$tunic->setItemDescription("The merchant said it's a nice tunic. Looks more like rags to you.");

$gladleather = new Armour("Gladiator Leathers", "Armour", 100, 0, 2);
$gladleather->setEvasionBonus(5);
$gladleather->setDmgReduction(0);
$gladleather->setItemDescription("A set of light leather plates and straps");
$gladleather->addToArmory($armours);

$ringmail = new Armour("Ring Mail", "Armour", 300, 0, 20);
$ringmail->setDmgReduction(3);
$ringmail->setItemDescription("Fits you like a glove.");
$ringmail->addToArmory($armours);

$roguegarb = new Armour("Rogue's Tunic", "Armour", 400, 0, 5);
$roguegarb->setEvasionBonus(10);
$roguegarb->setInitiativeBonus(5);
$roguegarb->setDmgReduction(0);
$roguegarb->setItemDescription("Move unhindered, black as night.");
$roguegarb->addToArmory($armours);

$scalemail = new Armour("Scale Mail", "Armour", 600, 0, 35);
$scalemail->setDmgReduction(5);
$scalemail->setItemDescription("Shimmering scales overlap each other.");
$scalemail->addToArmory($armours);

//Trinkets
$bloodybrick = new Trinket("Bloody Brick", "Trinket", 340, 0, 0);
$bloodybrick->setMaxHP(10);
$bloodybrick->setItemDescription("It's dripping..");
$bloodybrick->addToArmory($trinkets);

$zehirStone = new Trinket("Stone of Zehir", "Trinket", 450, 0, 0);
$zehirStone->setInitiativeBonus(10);
$zehirStone->setItemDescription("Time slows down.");
$zehirStone->addToArmory($trinkets);

$engravedmedal = new Trinket("Engraved Medal", "Trinket", 500, 0, 0);
$engravedmedal->setBlockBonus(10);
$engravedmedal->setItemDescription("It's a small ornate shield.");
$engravedmedal->addToArmory($trinkets);

$brokenfang = new Trinket("Szhlint's Fang", "Trinket", 500, 0, 0);
$brokenfang->setEvasionBonus(10);
$brokenfang->setItemDescription("Torn from hideous jaws.");
$brokenfang->addToArmory($trinkets);

$prism = new Trinket("Solohel Prism", "Trinket", 1000, 0, 0);
$prism->setInitiativeBonus(5);
$prism->setEvasionBonus(5);
$prism->setBlockBonus(5);
$prism->setMaxHP(5);
$prism->setItemDescription("Looking through it one can see a bit of everything.");
$prism->addToArmory($trinkets);


//default items, if unequipped
$defaultItems = [
    'weapon' => $fists,
    'armour' => $tunic,
    'shield' => $none
];
