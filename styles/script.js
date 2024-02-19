document.addEventListener("DOMContentLoaded", function () {
  let menuToggle = document.querySelectorAll(".burgerIcon");
  let mobileMenu = document.querySelectorAll(".mobileMenu");

  mobileMenu.display.style = "none";

  menuToggle.addEventListener("click", function () {
    if (mobileMenu.style.display === "none") {
      mobileMenu.style.display = "box";
    } else {
      mobileMenu.style.display = "none";
    }
  });
});
