function validateRegistrationForm(pForm) {
    const name = pForm.name.value.trim();
    const email = pForm.email.value.trim();
    const password = pForm.password.value.trim();
    const conPassword = pForm.con_password.value.trim();
    const contact = pForm.contact.value.trim();
    const genderMale = pForm.gender.value === "male";
    const genderFemale = pForm.gender.value === "female";

    // Error elements
    let e1 = document.getElementById("name_err");
    let e2 = document.getElementById("email_err");
    let e3 = document.getElementById("password_err");
    let e4 = document.getElementById("con_password_err");
    let e5 = document.getElementById("contact_err");
    let e6 = document.getElementById("gender_err");

    // Clear previous errors
    e1.innerHTML = "";
    e2.innerHTML = "";
    e3.innerHTML = "";
    e4.innerHTML = "";
    e5.innerHTML = "";
    e6.innerHTML = "";

    let isValid = true;

    // Name validation
    if (name === "") {
        e1.innerHTML = "Please provide your full name";
        isValid = false;
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        e2.innerHTML = "Please provide your email address";
        isValid = false;
    } else if (!emailPattern.test(email)) {
        e2.innerHTML = "Please enter a valid email address";
        isValid = false;
    }

    // Password validation
    if (password === "") {
        e3.innerHTML = "Please provide a password";
        isValid = false;
    } else if (password.length < 6) {
        e3.innerHTML = "Password must be at least 6 characters long";
        isValid = false;
    }

    // Confirm Password validation
    if (conPassword === "") {
        e4.innerHTML = "Please confirm your password";
        isValid = false;
    } else if (conPassword !== password) {
        e4.innerHTML = "Passwords do not match";
        isValid = false;
    }

    // Contact validation
    const contactPattern = /^\d{13}$/; // Assuming a 13-digit contact number
    if (contact === "") {
        e5.innerHTML = "Please provide your contact number";
        isValid = false;
    } else if (!contactPattern.test(contact)) {
        e5.innerHTML = "Please enter a valid 13-digit contact number";
        isValid = false;
    }

    // Gender validation
    if (!genderMale && !genderFemale) {
        e6.innerHTML = "Please select your gender";
        isValid = false;
    }

    return isValid;
}
