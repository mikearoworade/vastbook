// Function to toggle sidebar visibility
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("main-content");
  const navbar = document.getElementById("navbar");

  // Toggle the 'minimized' class
  sidebar.classList.toggle("minimized");
  mainContent.classList.toggle("minimized");
  navbar.classList.toggle("minimized");
}

// Close the dropdown if clicked outside
window.addEventListener("click", function (event) {
  const dropdown = document.querySelector(".profile-dropdown");
  const dropdownMenu = document.querySelector(".dropdown-menu");

  // If the click was outside of the dropdown or the dropdown button
  if (!dropdown.contains(event.target)) {
    // Hide the dropdown
    if (dropdownMenu.style.display === "block") {
      dropdownMenu.style.display = "none";
    }
  }
});

// Toggle dropdown visibility when the button is clicked
document
  .querySelector(".profile-dropdown")
  .addEventListener("click", function (event) {
    const dropdownMenu = document.querySelector(".dropdown-menu");

    // Prevent the click event from propagating to the window (which would trigger the global click listener)
    event.stopPropagation();

    // Toggle the dropdown visibility
    dropdownMenu.style.display =
      dropdownMenu.style.display === "block" ? "none" : "block";
  });
