document.addEventListener("DOMContentLoaded", function () {
  const loginOptions = document.querySelectorAll(".login-option");
  const loginPanels = document.querySelectorAll(".login-panel");

  loginOptions.forEach((option) => {
    option.addEventListener("click", function () {
      const type = this.dataset.type;
      loginOptions.forEach((opt) => opt.classList.remove("active"));
      this.classList.add("active");
      loginPanels.forEach((panel) => panel.classList.remove("active"));
      document.getElementById(type + "Login").classList.add("active");
    });
  });

  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function (e) {
      const email = this.querySelector('input[type="email"]');
      const password = this.querySelector('input[type="password"]');
      let valid = true;

      if (!email.value || !email.value.includes("@")) {
        email.nextElementSibling.textContent = "Please enter a valid email";
        email.nextElementSibling.style.display = "block";
        valid = false;
      } else {
        email.nextElementSibling.style.display = "none";
      }

      if (!password.value || password.value.length < 6) {
        password.nextElementSibling.textContent = "Password must be at least 6 characters";
        password.nextElementSibling.style.display = "block";
        valid = false;
      } else {
        password.nextElementSibling.style.display = "none";
      }

      if (!valid) e.preventDefault();
    });
  });
});
