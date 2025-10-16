document.addEventListener("DOMContentLoaded", function () {
    const signUpForm = document.getElementById("signupForm");
    signUpForm.addEventListener('submit', function (event) {
        let isValid = true;
        let errNameSign = document.getElementById("errNameSign");
        let errEmailSign = document.getElementById("errEmailSign");
        let errPassSign = document.getElementById("errPassSign");
        const signName = document.getElementById("username_signup").value.trim();
        const signEmail = document.getElementById("useremail_signup").value.trim();
        const signPass = document.getElementById("pwdSign").value.trim();
        if (signName == "") {
            errNameSign.textContent = "* Full name is obligatory";
            isValid = false;
        }
        else {
            errNameSign.textContent = "";
        }
        const emailPattern = /^[a-zA-Z0-9]+@(gmail\.com|yahoo\.com|hotmail\.com)|[a-zA-Z0-9]\.(ma|org)$/;
        if (signEmail == "") {
            errEmailSign.textContent = "* Email is obligatory";
            isValid = false;
        } else {
            if (!emailPattern.test(signEmail)) {
                errEmailSign.textContent = "* Type a correct email";
                isValid = false;
            } else {
                errEmailSign.textContent = "";
            }
        }
        const passPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[&|$]).{6,}$/;
        if (signPass == "") {
            errPassSign.textContent = "* Password is obligatory";
            isValid = false;
        }

        else if (!passPattern.test(signPass)) {
            errPassSign.textContent = "* Type a correct password";
            isValid = false;
        }
        else {
            errPassSign.textContent = "";
        }
        if (!isValid) return;
        const formData = new FormData(signUpForm);

        fetch("signup.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log("Response:", data);
                window.location.href = "deluxeupload.php";
            })
            .catch(error => {
                console.error("Error:", error);
            });
    })
})