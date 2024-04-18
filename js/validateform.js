function validateForm() {
  var nameValid = validateName();
  var emailValid = validateEmail();
  var passwordValid = validatePassword()
  var confirmPasswordValid = validateConfirmPassword();
  var mobileValid = validateMobileNumber();
  var dobvalid = validateDOB();

  var genderValid = validateGender();
  var locValid = validateLocation();

  if (nameValid && emailValid && mobileValid && genderValid && locValid && passwordValid && confirmPasswordValid && dobvalid)
    return true;

  return false;
}


function validateDOB() {
  var dobInput = document.getElementById("dob");
  var dob = new Date(dobInput.value);
  var now = new Date();

  var eighteenYearsAgo = new Date(now.getFullYear() - 18, now.getMonth(), now.getDate());
  if (isNaN(dob.getTime())) {
    // dobInput.style.border = "1px solid red";
    document.getElementById("dobmsg").innerHTML = "Please enter a valid date of birth.";
    return false;
  }
  if (dob >= now) {
    // dobInput.style.border = "1px solid red";
    document.getElementById("dobmsg").innerHTML = "Date of birth cannot be in the future.";
    return false;
  } else if (dob >= eighteenYearsAgo) {
    // dobInput.style.border = "1px solid red";
    document.getElementById("dobmsg").innerHTML = "You must be at least 18 years old.";
    return false;
  } else {
    // dobInput.style.border = "none";
    document.getElementById("dobmsg").innerHTML = "";
    return true;
  }
}

function validateLocation() {
  var countrySelect = document.getElementById("countrySelect");
  var stateSelect = document.getElementById("stateSelect");

  var countryValue = countrySelect.value;
  var stateValue = stateSelect.value;

  // Check if any of the selects have default value
  if (countryValue == "select" || stateValue == "select") {
    if (countryValue == "select") {
      countrySelect.style.border = "1px solid red";
    } else {
      countrySelect.style.border = "none";
    }
    if (countryValue != "select" && stateValue == "select") {
      stateSelect.style.border = "1px solid red";
    } else
      stateSelect.style.border = "none";

    document.getElementById("locmsg").innerHTML =
      "Please select a location.";
    return false;
  } else {
    countrySelect.style.border = "1px solid black";
    stateSelect.style.border = "1px solid black";
    document.getElementById("locmsg").innerHTML =
      "";
    return true;
  }
}

function validateGender() {
  var genderOptions = document.getElementsByName('gender');
  var genderError = document.getElementById('genderError');
  var genderSelected = false;

  for (var i = 0; i < genderOptions.length; i++) {
    if (genderOptions[i].checked) {
      genderSelected = true;
      break;
    }
  }

  if (!genderSelected) {
    genderError.textContent = "Please select a gender";
    return false;
  } else {
    genderError.textContent = "";
    return true;
  }
}



function validateEmail() {
  var emailInput = document.getElementById("email");
  var email = emailInput.value.trim();
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (email === "") {
    document.getElementById("emailmsg").innerHTML =
      "Please enter an email address.";
    return false;
  } else if (!emailRegex.test(email)) {
    document.getElementById("emailmsg").innerHTML = "Please enter a valid email address.";
    return false;
  } else {
    // document.getElementById("emailmsg").innerHTML = "";
    return true;
  }
}
function validatePassword() {
  var passwordInput = document.getElementById("password");
  var password = passwordInput.value;

  // Regular expression to match password requirements
  var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z]).{8,}$/;

  if (!passwordRegex.test(password)) {
    document.getElementById("passwordmsg").innerHTML = "Password: 8+ chars, special char, number, uppercase.";
    return false;
  } else {
    document.getElementById("passwordmsg").innerHTML = "";
    return true;
  }
}
function validateConfirmPassword() {
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("cpassword");
  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  if (password !== confirmPassword) {
    document.getElementById("cpassmsg").innerHTML = "Passwords do not match.";
    return false;
  } else {
    document.getElementById("cpassmsg").innerHTML = "";
    return true;
  }
}

function validateName() {
  var nameInput = document.getElementById("name");
  var name = nameInput.value.trim();
  var nameRegex = /^[a-zA-Z ]+$/;

  if (name === "") {
    document.getElementById("namemsg").innerHTML = "Please enter a name.";
    return false;
  } else if (!nameRegex.test(name)) {
    document.getElementById("namemsg").innerHTML =
      "Please enter a valid name(letters and spaces only).";
    return false;
  } else {
    document.getElementById("namemsg").innerHTML = "";
    return true;
  }
}



function validateMobileNumber() {
  var mobileInput = document.getElementById("number");
  var mobileNumber = mobileInput.value;

  if (mobileNumber.length !== 10 || isNaN(mobileNumber)) {
    document.getElementById("numbermsg").innerHTML =
      "Please enter a valid mobile number.";
    return false;
  } else {
    document.getElementById("numbermsg").innerHTML = "";
    return true;
  }
}



