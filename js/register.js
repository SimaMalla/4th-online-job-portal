const form = document.getElementById("registrationForm");
const username = document.getElementById("name");
const email = document.getElementById("email1");
const password = document.getElementById("pass");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  if (validateInputs()) {
    form.submit();
  }
});

const setError = (element, message) => {
  const formgroup = element.parentElement;
  const errorDisplay = formgroup.querySelector(".error");

  errorDisplay.innerText = message;
  formgroup.classList.add("error");
  formgroup.classList.remove("success");
};

const setSuccess = (element) => {
  const formgroup = element.parentElement;
  const errorDisplay = formgroup.querySelector(".error");

  errorDisplay.innerText = "";
  formgroup.classList.add("success");
  formgroup.classList.remove("error");
};

const isValidEmail = (email) => {
  const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return re.test(String(email).toLowerCase());
};

const validateInputs = () => {
  const usernameValue = username.value.trim();
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();

  let isValid = true;

  if (usernameValue == "") {
    setError(username, "Username is required");
    isValid = false;
  } else {
    setSuccess(username);
  }

  if (emailValue == "") {
    setError(email, "Email is required");
    isValid = false;
  } else if (!isValidEmail(emailValue)) {
    setError(email, "Provide a valid email address");
    isValid = false;
  } else {
    setSuccess(email);
  }

  if (passwordValue === "") {
    setError(password, "Password is required");
    isValid = false;
  } else if (passwordValue.length < 8) {
    setError(password, "Password must be at least 8 characters.");
    isValid = false;
  } else {
    setSuccess(password);
  }

  return isValid;
};
