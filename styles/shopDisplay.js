//controls shop view, which Item category to display.

document.addEventListener("DOMContentLoaded", function () {
  let buttons = document.querySelectorAll(".shopSelector");

  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      let allDivs = document.querySelectorAll(".shopDisplay");
      allDivs.forEach(function (div) {
        div.style.display = "none";
      });
      let defaultView = document.getElementById("shopDefault");
      defaultView.style.display = "none";

      let divId = button.id.replace("Btn", "Container");

      let div = document.getElementById(divId);

      if (div.style.display === "none" || div.style.display === "") {
        div.style.display = "block";
      } else {
        div.style.display = "none";
      }
    });
  });
});
