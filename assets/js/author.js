document.getElementById("authorForm").addEventListener("submit", function (e) {
  // Prevent form submission
  e.preventDefault();

  // Clear previous errors
  document
    .querySelectorAll(".error")
    .forEach((error) => (error.textContent = ""));

  // Get form field values
  const firstname = document.getElementById("firstname").value.trim();
  const lastname = document.getElementById("lastname").value.trim();
  const email = document.getElementById("email").value.trim();
  const bio = document.getElementById("bio").value.trim();
  const image = document.getElementById("image").files[0];

  let isValid = true;

  // Validate First Name
  if (firstname === "") {
    document.getElementById("firstnameError").textContent =
      "First name is required.";
    isValid = false;
  } else if (firstname.length < 2) {
    document.getElementById("firstnameError").textContent =
      "First name must be at least 2 characters.";
    isValid = false;
  }

  // Validate Last Name
  if (lastname === "") {
    document.getElementById("lastnameError").textContent =
      "Last name is required.";
    isValid = false;
  } else if (lastname.length < 2) {
    document.getElementById("lastnameError").textContent =
      "Last name must be at least 2 characters.";
    isValid = false;
  }

  // Validate Email
  const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
  if (email === "") {
    document.getElementById("emailError").textContent = "Email is required.";
    isValid = false;
  } else if (!emailPattern.test(email)) {
    document.getElementById("emailError").textContent =
      "Please enter a valid email address.";
    isValid = false;
  }

  // Validate Bio
  if (bio === "") {
    document.getElementById("bioError").textContent = "Bio is required.";
    isValid = false;
  } else if (bio.length > 250) {
    document.getElementById("bioError").textContent =
      "Bio must not exceed 250 characters.";
    isValid = false;
  }

  // Validate Image
  if (!image) {
    document.getElementById("imageError").textContent =
      "Please upload an image.";
    isValid = false;
  } else if (!["image/jpeg", "image/png", "image/gif"].includes(image.type)) {
    document.getElementById("imageError").textContent =
      "Only JPEG, PNG, and GIF formats are allowed.";
    isValid = false;
  } else if (image.size > 2 * 1024 * 1024) {
    document.getElementById("imageError").textContent =
      "Image size must not exceed 2MB.";
    isValid = false;
  }

  // Submit form if valid
  if (isValid) {
    // alert("Form submitted successfully!");
    // Optionally submit the form using AJAX or proceed to the backend.
    e.target.submit();
  }
});
