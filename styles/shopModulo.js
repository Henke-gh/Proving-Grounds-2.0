function showWeaponDetails(itemID, itemName, cost, skillReq, minDmg, maxDmg, itemDescription, itemType) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=/../app/shopCheckout.php>" +
    "<h3>" +
    itemName +
    "</h3><p>Damage: " +
    minDmg +
    "-" +
    maxDmg +
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
    "><button type=submit name=purchaseWeapon>Purchase</button></form>";
  /* This form post contains an array, ['item'] containing the values [0]itemType and [1]itemIndex. These are used to
get the correct weapon/item information when processing the item bought. */
  overlay.style.display = "block";
}

function showShield(shieldID, shieldName, shieldCost, dmgRed, skillReq, shieldDescription, type) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=/../app/shopCheckout.php><h3>" +
    shieldName +
    "</h3><p>Block Value: " +
    dmgRed +
    "</p><p>Requires: (" +
    skillReq +
    ") in Block.</p><p>Cost: " +
    shieldCost +
    " gold</p><p class=cursive>" +
    shieldDescription +
    "</p><input type=hidden name=item[] value=" +
    type +
    "><input type=hidden name=item[] value=" +
    shieldID +
    "><button type=submit name=purchaseShield>Purchase</button></form>";

  overlay.style.display = "block";
}

function showArmour(armourID, armourName, armourCost, dmgRed, EvasionBonus, itemDescription, type) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=/../app/shopCheckout.php><h3>" +
    armourName +
    "</h3><p>Damage Reduction: " +
    dmgRed +
    "</p><p>Evasion Bonus: " +
    EvasionBonus +
    "</p><p>Cost: " +
    armourCost +
    " gold.</p><p class=cursive>" +
    itemDescription +
    "</p><input type=hidden name=item[] value=" +
    type +
    "><input type=hidden name=item[] value=" +
    armourID +
    "><button type=submit name=purchaseArmour>Purchase</button></form>";

  overlay.style.display = "block";
}

function showTrinket(
  trinketID,
  trinketName,
  trinketCost,
  trinketDescription,
  iniBonus,
  evaBonus,
  blockBonus,
  type
) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  var inputHTML = "<form method=post action=/../app/shopCheckout.php><h3>" + trinketName + "</h3>";

  if (iniBonus > 0) {
    inputHTML += "<p>Initiative: +" + iniBonus + "</p>";
  }
  if (evaBonus > 0) {
    inputHTML += "<p>Evasion: +" + evaBonus + "</p>";
  }

  if (blockBonus > 0) {
    inputHTML += "<p>Block: +" + blockBonus + "</p>";
  }

  inputHTML +=
    "<p>Cost: " +
    trinketCost +
    " gold</p><p class=cursive>" +
    trinketDescription +
    "</p><input type=hidden name=item[] value=" +
    type +
    "><input type=hidden name=item[] value=" +
    trinketID +
    "><button type=submit name=purchaseTrinket>Purchase</button></form>";

  details.innerHTML = inputHTML;
  overlay.style.display = "block";
}

document.getElementById("overlay").onclick = function () {
  this.style.display = "none";
};
