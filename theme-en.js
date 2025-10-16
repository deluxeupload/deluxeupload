const acc = document.querySelectorAll('#imgAcc');
const acc2 = document.querySelectorAll('#imgAcc2');
const logo = document.querySelectorAll('#logo');
const themeIcon = document.querySelectorAll('#themeIcon');
const offcnv = document.getElementById('imgOffcnv');
const arrow_up = document.querySelectorAll('.dv8 .dv8-1 #arrow');
window.addEventListener('DOMContentLoaded', function () {
    const theme = document.getElementById('changeTheme');
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.add(savedTheme);
    } else {
        document.body.classList.add('light');
    }

    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === "dark") {
        document.body.classList.add("dark");
        theme.checked = true;
        logo.forEach(el => el.src = "outils/icons/logo-dark.png");
        /* acc.forEach(el => el.src = "outils/icons/useracc.png"); */
        acc2.forEach(el => el.src == "outils/icons/useracc.png");
        arrow_up.forEach(el => el.src = "outils/svg/arrow_upward_light.svg");
        offcnv.src = "outils/icons/offcnva-dark.png";
        /* themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun'); */
        themeIcon.forEach(el => el.classList.remove('fa-moon'));
        themeIcon.forEach(el => el.classList.add('fa-sun'));
    }
    else {
        document.body.classList.add("light");
        theme.checked = false;
        logo.forEach(el => el.src = "outils/icons/LOGO.png");
        /* acc.forEach(el => el.src = "outils/icons/useracc1.png"); */
        acc2.forEach(el => el.src = "outils/icons/useracc1.png");
        arrow_up.forEach(el => el.src = "outils/svg/arrow_upward.svg");
        offcnv.src = "outils/icons/offcanvas-icon.png";
        /* themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon'); */
        themeIcon.forEach(el => el.classList.remove('fa-sun'));
        themeIcon.forEach(el => el.classList.add('fa-moon'));
    }

    theme.addEventListener("change", () => {
        if (theme.checked) {
            document.body.classList.replace('light', 'dark');
            localStorage.setItem('theme', 'dark');
            logo.forEach(el => el.src = "outils/icons/logo-dark.png");
            /* acc.forEach(el => el.src = "outils/icons/useracc.png"); */
            acc2.forEach(el => el.src = "outils/icons/useracc.png");
            arrow_up.forEach(el => el.src = "outils/svg/arrow_upward_light.svg");
            offcnv.src = "outils/icons/offcnva-dark.png";
            /* themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun'); */
            themeIcon.forEach(el => el.classList.remove('fa-moon'));
            themeIcon.forEach(el => el.classList.add('fa-sun'));
        }
        else {
            document.body.classList.replace('dark', 'light');
            localStorage.setItem('theme', 'light');
            logo.forEach(el => el.src = "outils/icons/LOGO.png");
            /* acc.forEach(el => el.src = "outils/icons/useracc1.png"); */
            acc2.forEach(el => el.src = "outils/icons/useracc1.png");
            arrow_up.forEach(el => el.src = "outils/svg/arrow_upward.svg");
            offcnv.src = "outils/icons/offcanvas-icon.png";
            /* themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon'); */
            themeIcon.forEach(el => el.classList.remove('fa-sun'));
            themeIcon.forEach(el => el.classList.add('fa-moon'));
        }
    })
})