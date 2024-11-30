document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    // Clear previous error messages
    document.getElementById("emailError").innerText = "";
    document.getElementById("passwordError").innerText = "";

    // Get form values
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    let isValid = true;

    // Validate email
    if (email === "") {
      document.getElementById("emailError").innerText = "*Email is required.";
      isValid = false;
    } else if (!validateEmail(email)) {
      document.getElementById("emailError").innerText =
        "*Invalid email format.";
      isValid = false;
    }

    // Validate password
    if (password === "") {
      document.getElementById("passwordError").innerText =
        "*Password is required.";
      isValid = false;
    }
    // else if (password.length < 6) {
    //   document.getElementById("passwordError").innerText =
    //     "Password must be at least 6 characters long.";
    //   isValid = false;
    // }

    // Prevent form submission if validation fails
    if (!isValid) {
      event.preventDefault();
    }
  });

// Function to validate email format
function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
