function signUp() {
    window.open('sign-up.php', '_self');
}

function login() {
    window.open('login.php', '_self');
}

function upload(value) {
    if (value) {
        window.open('upload.php', '_self');
    } else {
        window.open('login.php', '_self');
    }
}
function upload_ar(value) {
    if (value) {
        window.open('uploadAr.php', '_self');
    } else {
        window.open('login.php', '_self');
    }
}

function cookie() {
    window.open('cookies.php', '_self');
}

function scrollToTop(){
    window.scrollTo({
        top : 0,
        behavior :"smooth"
    });
}

const parent = document.getElementById('nav2');
function navbarHover(){
    parent.style.backgroundColor = "#0D1B2A";
}

function navbarOut(){
    parent.style.backgroundColor = "rgb(19, 94, 196)";
}

window.addEventListener('scroll',function(){
    var icon = this.document.querySelector('.dv8');
    if(this.window.scrollY > 300){
        icon.style.display = "block";
    }else{
        icon.style.display = "none";
    }
});
/* function uploadIconChange(){
    const button = document.querySelector('#uploadButton #element');
    button.classList = "fas fa-cloud-upload-alt";
}

function uploadIconLeave(){
    const button = document.querySelector('#uploadButton #element');
    button.classList = "";
} */