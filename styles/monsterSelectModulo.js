function showDetails(monsterID, monsterName, monsterLevel, weapon, description) {
  var overlay = document.getElementById("overlay");
  var details = document.getElementById("details");
  /* Creates a Form containing Monster Info aswell as options for Combat Stance and which %-hp value the 
  player wishes to retreat at. */
  details.innerHTML =
    "<form method=post><h3 class=underline>" +
    monsterName +
    " [Lvl " +
    monsterLevel +
    "]</h3><p>Weapon: " +
    weapon +
    "</p><p class=cursive>" +
    description +
    "</p><label for=combatStance>Combat Stance</label>" +
    "<select name=combatStance id=combatStance>" +
    "<option value=light>Fast Attacks</option>" +
    "<option value=balanced selected>Balanced</option>" +
    "<option value=defensive>Heavy Guard</option>" +
    "</select><label for=hpSelect>Retreat at:</label>" +
    "<select name=retreatValue id=hpSelect>" +
    "</select><button type=submit name=fight value=" +
    monsterID +
    ">Fight</button></form>";
  setRetreatValues();
  overlay.style.display = "block";
}

document.getElementById("closeOverlay").onclick = function () {
  document.getElementById("overlay").style.display = "none";
};

function setRetreatValues() {
  var retreatSelect = document.getElementById("hpSelect");
  retreatSelect.innerHTML = "";
  let retreat = 100;
  for (let index = 0; index < 11; index++) {
    let option = document.createElement("option");

    option.value = retreat;
    option.textContent = retreat + "% HP";

    if (retreat === 50) {
      option.selected = true;
    }

    retreatSelect.appendChild(option);
    retreat = retreat - 10;
  }
}
