const acc = document.querySelectorAll('#imgAcc');
const acc2 = document.querySelectorAll('#imgAcc2');
const logo = document.querySelectorAll('#logo');
window.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.add(savedTheme);
    } else {
        document.body.classList.add('light');
    }

    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === "dark") {
        document.body.classList.add("dark");
        logo.forEach(el => el.src = "outils/icons/logo-dark.png");
        /* acc.forEach(el => el.src = "outils/icons/useracc.png"); */
        acc2.forEach(el => el.src == "outils/icons/useracc.png");
    } 
    else {
        document.body.classList.add("light");
        logo.forEach(el => el.src = "outils/icons/LOGO.png");
        /* acc.forEach(el => el.src = "outils/icons/useracc1.png"); */
        acc2.forEach(el => el.src  = "outils/icons/useracc1.png");
    }
})