/* let copy = "";
const mess = document.getElementById('alertmess'); */
function copyToClipboard(event, text) {
    event.preventDefault();
    navigator.clipboard.writeText(text).then(() => {
        /* copy = "Copied successfully";
        mess.innerHTML = `<div class="alert alert-success">${copy}<button type="button" class="btn btn-close" style="float:right;" data-bs-dismiss="alert"></button></div>`; */
        if (document.body.lang == "en") {
            Swal.fire({
                title: "Copied",
                text: "Link has copied successfully",
                icon: "success",
                confirmButtonColor : "rgb(19,94,196)"
            });
        } else {
            Swal.fire({
                title: "تم النسخ",
                text: "تم نسخ الرابط بنجاح",
                icon: "success",
                confirmButtonText : "حسنا",
                confirmButtonColor : "rgb(19,94,196)"
            });
        }
    });
}