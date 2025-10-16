document.addEventListener("DOMContentLoaded", function () {
    const signUpForm = document.getElementById("editForm");
    signUpForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let isValid = true;
        let errNameSign = document.getElementById("errNameSign");
        let errPassSign = document.getElementById("errPassSign");
        const signName = document.getElementById("username_signup").value.trim();
        const signPass = document.getElementById("pwdSign").value.trim();
        if (signName == "") {
            errNameSign.textContent = "* Full name is obligatory";
            isValid = false;
        }
        else {
            errNameSign.textContent = "";
        }
        const passPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[&$]).{6,}$/;
        if (signPass == "") {
            errPassSign.textContent = "* Password is obligatory";
            isValid = false;
        }

        else if (!passPattern.test(signPass)) {
            errPassSign.textContent = "* Tape a correct password";
            isValid = false;
        }
        else {
            errPassSign.textContent = "";
        }
        if (!isValid) return;
        //const formData = new FormData(signUpForm);
        else window.location.href = "deluxeupload.php";
        /* fetch("edit.php?id="+formData.get("nuserid"), {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    window.location.href = "deluxeupload.php";
                }else{
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            }); */
    })
})