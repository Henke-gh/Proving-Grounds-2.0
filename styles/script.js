//Dynamically adjusts the main elements marginTop-value based on present Nav-menu configuration. This was rough.
let heroSummary = document.getElementById("heroSum");
let mainElement = document.querySelector("main");
let topAdjustment;

if (heroSummary && window.getComputedStyle(heroSummary).flexDirection !== "column") {
  var heroSumHeight = heroSummary.offsetHeight;
  if (window.innerWidth >= 768) {
    topAdjustment = heroSumHeight + 0; // Adjustments for desktop
  } else {
    topAdjustment = heroSumHeight + 50; // Adjustments for mobile
  }
  mainElement.style.marginTop = topAdjustment + "px";
} else {
  if (window.innerWidth >= 768) {
    mainElement.style.marginTop = 98 + "px"; // Default adjustments for desktop
  } else {
    mainElement.style.marginTop = 50 + "px"; // Default adjustments for mobile
  }
}

//Hide/ Show site nav for mobile
document.addEventListener("DOMContentLoaded", function () {
  let menuToggle = document.querySelector(".burgerIcon");
  let mobileMenu = document.querySelector(".mobileMenu");

  mobileMenu.style.display = "none";

  menuToggle.addEventListener("click", function () {
    if (mobileMenu.style.display === "none" || mobileMenu.style.display === "") {
      mobileMenu.style.display = "flex";
    } else {
      mobileMenu.style.display = "none";
    }
  });
  //closes mobile menu if user clicks outside the menu element.
  document.body.addEventListener("click", function (event) {
    if (!mobileMenu.contains(event.target) && event.target !== menuToggle) {
      mobileMenu.style.display = "none";
    }
  });
});

//Inspect item modal, playerHero.php
const dialogs = document.querySelectorAll(".inspect");
const buttons = document.querySelectorAll(".showInspect");
const closeButtons = document.querySelectorAll(".closeInspect");

// "Show the dialog" button opens the dialog modally
buttons.forEach((button, index) => {
  button.addEventListener("click", () => {
    dialogs[index].showModal();
  });
});

// "Close" button closes the dialog
closeButtons.forEach((closeButton, index) => {
  closeButton.addEventListener("click", () => {
    dialogs[index].close();
  });
});

dialogs.forEach((dialog) => {
  dialog.addEventListener("click", (event) => {
    if (event.target === dialog) {
      dialog.close();
    }
  });
});
