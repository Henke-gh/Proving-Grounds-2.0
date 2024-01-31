function showDetails(itemID, itemName, cost, minDmg, maxDmg, itemDescription, itemType, itemIndex) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=#>" +
    "<h3>" +
    itemName +
    "</h3><p>Damage: " +
    minDmg +
    "-" +
    maxDmg +
    "</p><p>Cost: " +
    cost +
    " gold</p>" +
    "<p class=cursive>" +
    itemDescription +
    "</p><input type=hidden name=item[] value=" +
    itemType +
    "><input type=hidden name=item[] value=" +
    itemIndex +
    "><button type=submit name=purchase>Purchase</button></form>";
  /* This form post contains an array, ['item'] containing the values [0]itemType and [1]itemIndex. These are used to
get the correct weapon/item information when processing the item bought. */
  overlay.style.display = "block";
}

document.getElementById("overlay").onclick = function () {
  this.style.display = "none";
};