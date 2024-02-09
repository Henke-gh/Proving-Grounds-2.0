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
