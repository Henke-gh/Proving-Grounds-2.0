document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("showItem")) {
      //let itemDetails = event.target.nextElementSibling;
      let itemSelect = event.target.closest(".itemSelect");

      let itemDetails = itemSelect.nextElementSibling;

      itemDetails.classList.toggle("hidden");

      event.target.textContent = itemDetails.classList.contains("hidden") ? "Show" : "Hide";
    }
  });
});
