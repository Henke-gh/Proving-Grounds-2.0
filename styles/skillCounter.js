document.addEventListener("DOMContentLoaded", function () {
  const attributeInputs = document.querySelectorAll(".attribute");
  const skillInputs = document.querySelectorAll(".skill");
  const skillPointCounter = document.getElementById("skillPointCounter");
  let totalSkillPoints = document.getElementById("maxPoints").value;

  function updateUnusedSkillPointCounter() {
    let totalUsedPoints = 0;
    attributeInputs.forEach(function (input) {
      totalUsedPoints += parseInt(input.value) || 0;
    });
    skillInputs.forEach(function (input) {
      totalUsedPoints += parseInt(input.value) || 0;
    });
    skillPointCounter.textContent = "Skill Points left: " + (totalSkillPoints - totalUsedPoints);
    if (totalSkillPoints - totalUsedPoints < 0) {
      skillPointCounter.textContent = "Not enough skill points!";
    }
  }

  attributeInputs.forEach(function (input) {
    input.addEventListener("input", updateUnusedSkillPointCounter);
  });

  skillInputs.forEach(function (input) {
    input.addEventListener("input", updateUnusedSkillPointCounter);
  });
});
