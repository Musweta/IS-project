// login.js

// Wait for the DOM to fully load
document.addEventListener("DOMContentLoaded", function () {
  // Get references to form elements
  const loginButton = document.querySelector(".btn-primary");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");

  // Optional: Create an error message container
  const errorContainer = document.createElement("p");
  errorContainer.style.color = "red";
  errorContainer.style.textAlign = "center";
  errorContainer.style.marginTop = "10px";
  loginButton.parentElement.appendChild(errorContainer);

  // Add click event listener to the login button
  loginButton.addEventListener("click", function (event) {
    // Prevent default form submission
    event.preventDefault();

    // Clear previous error messages
    errorContainer.textContent = "";

    // Get input values
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    // Basic validation
    if (!email || !password) {
      errorContainer.textContent = "Please fill in both email and password.";
      return;
    }

    // Simple email format check
    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (!emailPattern.test(email)) {
      errorContainer.textContent = "Please enter a valid email address.";
      return;
    }

    // If validation passes, submit the form (or redirect)
    // You can replace this with actual form submission logic
    document.querySelector("form")?.submit(); // If using a <form> tag
    // Or call your login handler if using AJAX or PHP
  });
});
