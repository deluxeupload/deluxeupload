const loginForm = document.getElementById("loginForm");
let isvalid = true;
loginForm.addEventListener('submit',function(event){
    //event.preventDefault();
    let errNameLogin = document.getElementById("errNameLogin");
    let errEmailLogin = document.getElementById("errEmailLogin");
    let errPassLogin = document.getElementById("errPassLogin");
    const loginName = document.getElementById("nameLogin").value.trim();
    const loginEmail = document.getElementById("emailLogin").value.trim();
    const loginPass = document.getElementById("pwdLogin").value.trim();
    if(loginName == ""){
        errNameLogin.innerHTML = "* Name is obligatory";
        isvalid = false;
    }
    else{
        errNameLogin.innerHTML = "";
        localStorage.setItem('username',loginName);
    }
    if(loginEmail == ""){
        errEmailLogin.innerHTML = "* Email is obligatory";
        isvalid = false;
    }
    else{
        errEmailLogin.innerHTML = "";
        localStorage.setItem('useremail',loginEmail);
    }
    if(loginPass == ""){
        errPassLogin.innerHTML = "* Password is obligatory";
        isvalid = false;
    }
    else{
        errPassLogin.innerHTML = "";
        localStorage.setItem('userpass',loginPass);
    }
});