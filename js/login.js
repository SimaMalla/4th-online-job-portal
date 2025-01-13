// Form validation function
document.getElementById("login").addEventListener("submit", function (event) {
  // Get the input values
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email) {
    alert("Email is required.");
    event.preventDefault(); // Prevent form submission
    return;
  } else if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    event.preventDefault();
    return;
  }

  // Password validation
  if (!password) {
    alert("Password is required.");
    event.preventDefault();
    return;
  } else if (password.length < 6) {
    alert("Password must be at least 6 characters long.");
    event.preventDefault();
    return;
  }

  // If all validations pass, allow the form to submit
});
