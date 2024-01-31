function showDetails(monsterID, monsterName, monsterLevel, weapon, description) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  details.innerHTML =
    "<form method=post action=><h3 class=underline>" +
    monsterName +
    " [Lvl " +
    monsterLevel +
    "]</h3><p>Weapon: " +
    weapon +
    "</p><p class=cursive>" +
    description +
    "</p><button type=submit name=fight value=" +
    monsterID +
    ">Fight</button></form>";
  /* This form post contains an array, ['item'] containing the values [0]itemType and [1]itemIndex. These are used to
  get the correct weapon/item information when processing the item bought. */
  overlay.style.display = "block";
}

document.getElementById("overlay").onclick = function () {
  this.style.display = "none";
};
