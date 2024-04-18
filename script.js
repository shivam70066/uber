function validateForm() {
    var nameValid = validateName();
    var emailValid = validateEmail();
    // var confirmPasswordValid = validateConfirmPassword();
    var mobileValid = validateMobileNumber();
    var subjectValid = validateSubject();
    var messageValid = validateMessage();
    if (nameValid && emailValid && mobileValid && subjectValid && messageValid) {
        return true; // Stop form submission
    }
    return false;
}

function validateSubject() {
    var subjectInput1 = document.getElementById("subject");
    var subjectInput = subjectInput1.value.trim();

    if (subjectInput === "") {
        document.getElementById("subjectmsg").innerHTML =
            "Please enter a subject.";
            subjectInput1.style.borderColor = "red";
        return false;
    } else if (subjectInput.length<2) {
        document.getElementById("subjectmsg").innerHTML = "Please enter a valid subject of min length 2.";
        subjectInput1.style.borderColor = "red";
        return false;
    } else {
        document.getElementById("subjectmsg").innerHTML = "";
        subjectInput1.style.borderColor = "black";
        return true;
    }
}

function validateMessage() {
    var messageInput1 = document.getElementById("message");
    var messageInput = messageInput1.value.trim();
    if (messageInput === "") {
        document.getElementById("messagemsg").innerHTML =
            "Please enter a message.";
            messageInput1.style.borderColor = "red";
        return false;
    } else if (messageInput.length<10) {
        document.getElementById("messagemsg").innerHTML = "Please enter a valid message of min length 10.";
        messageInput1.style.borderColor = "red";
        return false;
    } else {
        document.getElementById("messagemsg").innerHTML = "";
        messageInput1.style.borderColor = "black";
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
            emailInput.style.borderColor = "red";
        return false;
    } else if (!emailRegex.test(email)) {
        document.getElementById("emailmsg").innerHTML = "Please enter a valid email address.";
        emailInput.style.borderColor = "red";
        return false;
    } else {
        document.getElementById("emailmsg").innerHTML = "";
        emailInput.style.borderColor = "black";
        return true;
    }
}

function validateName() {
    var nameInput = document.getElementById("name");
    var name = nameInput.value.trim();
    var nameRegex = /^[a-zA-Z ]+$/;

    if (name === "") {
        document.getElementById("namemsg").innerHTML = "Please enter a name.";
        nameInput.style.borderColor = "red";
        return false;
    } else if (!nameRegex.test(name)) {
        nameInput.style.borderColor = "red";
        document.getElementById("namemsg").innerHTML =
            "Please enter a valid name(letters and spaces only).";
        return false;
    } else {
        document.getElementById("namemsg").innerHTML = "";
        nameInput.style.borderColor = "black";
        return true;
    }
}



function validateMobileNumber() {
    var mobileInput = document.getElementById("number");
    var mobileNumber = mobileInput.value;


    if (mobileNumber.length !== 10 || isNaN(mobileNumber)) {
        document.getElementById("numbermsg").innerHTML =
            "Please enter a valid mobile number of length 10.";
            mobileInput.style.borderColor = "red";
        return false;
    } else {
        document.getElementById("numbermsg").innerHTML = "";
        mobileInput.style.borderColor = "black";
        return true;
    }
}