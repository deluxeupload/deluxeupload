const dateNow = new Date();
const yearNow = dateNow.getFullYear();
const copyEn = document.querySelectorAll("#copyrightText");
if (copyEn) {
    copyEn.forEach(el => el.textContent += `${yearNow} deluxe upload all rights reserved.`);
}
const copyAr = document.querySelectorAll("#copyrightTextAr");
if (copyAr) {
    copyAr.forEach(el => el.textContent += `جميع الحقوف محفوظة لدى ديلوكس أبلود. ${yearNow}`);
}