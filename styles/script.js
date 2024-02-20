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
