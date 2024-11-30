// Edit Model
// Get all edit links
const editLinks = document.querySelectorAll(".edit-link");

// Add click event to each link
editLinks.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default anchor behavior

    // Get data attributes from the clicked link
    const id = this.dataset.id;
    const name = this.dataset.name;

    // Populate the modal fields
    document.getElementById("categoryId").value = id;
    document.getElementById("categoryName").value = name;

    // Display the modal
    document.getElementById("editModal").style.display = "block";
  });
});

// Close modal function
function closeModal() {
  document.getElementById("editModal").style.display = "none";
}

// Close modal when clicking outside of it
window.onclick = function (event) {
  const modal = document.getElementById("editModal"); // Get the modal element by its ID
  if (event.target === modal) {
    // Check if the clicked target is the modal itself (not the modal content)
    closeModal(); // If yes, call the closeModal() function to hide the modal
  }
};

//Delete Modal
// Get all edit links
const deleteLinks = document.querySelectorAll(".delete-link");

// Add click event to each link
deleteLinks.forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default anchor behavior

    // Get data attributes from the clicked link
    const id = this.dataset.id;
    const name = this.dataset.name;

    // Populate the modal fields
    document.getElementById("categoryIdDelete").value = id;
    document.getElementById("categoryNameDelete").value = name;

    // Display the modal
    document.getElementById("deleteModal").style.display = "block";
  });
});

// Close modal function
function closeModalDelete() {
  document.getElementById("deleteModal").style.display = "none";
}

// Close modal when clicking outside of it
window.onclick = function (event) {
  const modal = document.getElementById("deleteModal"); // Get the modal element by its ID
  if (event.target === modal) {
    // Check if the clicked target is the modal itself (not the modal content)
    closeModalDelete(); // If yes, call the closeModal() function to hide the modal
  }
};
