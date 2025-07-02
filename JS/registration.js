document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const passwordInput = document.getElementById("regPassword");
  const confirmPasswordInput = document.getElementById("confirmPassword");

  form.addEventListener("submit", function (e) {
    // Check required fields
    const requiredFields = ["fullName", "regEmail", "regPassword", "confirmPassword"];
    let allFilled = true;

    requiredFields.forEach(function (id) {
      const field = document.getElementById(id);
      if (!field || field.value.trim() === "") {
        allFilled = false;
        field.classList.add("border-red-500"); // Highlight empty fields
      } else {
        field.classList.remove("border-red-500");
      }
    });

    if (!allFilled) {
      e.preventDefault();
      alert("Please fill in all required fields.");
      return;
    }

    // Check if passwords match
    if (passwordInput.value !== confirmPasswordInput.value) {
      e.preventDefault();
      alert("Passwords do not match!");
      confirmPasswordInput.classList.add("border-red-500");
    } else {
      confirmPasswordInput.classList.remove("border-red-500");
    }
  });
});
