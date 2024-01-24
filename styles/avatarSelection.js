// Get all avatar images with the class 'avatar-image'
const avatarImages = document.querySelectorAll(".avatarImage");

// Add an event listener to each avatar image
avatarImages.forEach((avatarImage) => {
  avatarImage.addEventListener("click", () => {
    const avatarId = avatarImage.getAttribute("data-avatar-id");

    // Set the selected avatar's ID in the hidden input
    document.getElementById("selectedAvatar").value = avatarId;

    // Unselect all other avatar images
    avatarImages.forEach((otherAvatarImage) => {
      otherAvatarImage.classList.remove("selected");
    });

    // Add a 'selected' class to the clicked avatar image
    avatarImage.classList.add("selected");
  });

  // Add hover effect
  avatarImage.addEventListener("mouseenter", () => {
    avatarImage.classList.add("hover");
  });

  avatarImage.addEventListener("mouseleave", () => {
    avatarImage.classList.remove("hover");
  });
});
