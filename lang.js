function changeLanguage(value) {
    if (value == "English") {
        window.open('deluxeupload.php', '_self')
    }
    if (value == "Arabic") {
        window.open('deluxeuploadAr.php', '_self')
    }
    if (value == "French") {
        alert("French is not available");
    }
}