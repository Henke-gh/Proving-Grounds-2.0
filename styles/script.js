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
});
