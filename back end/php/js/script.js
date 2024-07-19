
const toggleIcon = document.querySelector(".toggle-icon");
const menuBar = document.querySelector(".menu-bar");


toggleIcon.onclick = function () {
    menuBar.classList.toggle("right");
}



// Get the form elements
const form = document.querySelector('form');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');

// Define the validateUsername function
function validateUsername(username) {
  // Simple email validation (you can improve this)
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailRegex.test(username);
}

// Add event listener to the form submit event
form.addEventListener('submit', (e) => {
  e.preventDefault();

  // Validate the username
  if (!validateUsername(usernameInput.value)) {
    usernameInput.setCustomValidity('Please enter a valid email address.');
    usernameInput.reportValidity();
  } else {
    usernameInput.setCustomValidity('');
  }

  // Validate the password
  if (passwordInput.value === '') {
    passwordInput.setCustomValidity('Please enter a password.');
    passwordInput.reportValidity();
  } else {
    passwordInput.setCustomValidity('');
  }
});
