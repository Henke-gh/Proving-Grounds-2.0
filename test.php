<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/functions/armory.php";

echo '<pre>';
var_dump($weapons);
echo '</pre>';


/* 
 onclick="showShieldDetails(<?= $shieldID; ?>,
                '<?= $shield->name; ?>',
                '<?= $shield->cost; ?>',
                '<?= $shield->skillRequirement; ?>',
                '<?= $shield->damageReduction; ?>',
                '<?= $shield->getItemDescription; ?>',
                '<?= $shield->type; ?>')"
            */

            /* 
            function showShieldDetails(itemID, itemName, cost, skillReq, dmgReduce, itemDescription, itemType) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=/../app/shopCheckout.php>" +
    "<h3>" +
    itemName +
    "</h3><p>Block Reduction: " +
    dmgReduce +
    "</p><p>Requires: (" +
    skillReq +
    ") in " +
    itemType +
    ".</p><p>Cost: " +
    cost +
    " gold</p>" +
    "<p class=cursive>" +
    itemDescription +
    "</p><input type=hidden name=item[] value=" +
    itemType +
    "><input type=hidden name=item[] value=" +
    itemID +
    "><button type=submit name=purchaseShield>Purchase</button></form>";
  overlay.style.display = "block";
} */