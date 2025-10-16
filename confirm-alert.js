function delete_file(lang,fileId) {
    if (lang == "en") {
        Swal.fire({
            title: "Are you sure for delete file ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "Yes, delete it",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted",
                    text: "Your file has been deleted",
                    icon: "success"
                });
                document.getElementById('fileForm'+fileId).submit();
            }
        });
        return false;
    } else {
        Swal.fire({
            title: "هل أنت متأكد لحذف الملف ؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "نعم إحذفه",
            cancelButtonText: "تراجع"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "تم الحذف",
                    text: "تم حذف الملف بنجاح",
                    icon: "success"
                });
                document.getElementById('fileForm'+fileId).submit();
            }
        });
        return false;
    }
}

function delete_report(lang,fileId) {
    if (lang == "en") {
        Swal.fire({
            title: "Are you sure for delete report ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "Yes, delete it",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted",
                    text: "Your report has been deleted",
                    icon: "success"
                });
                document.getElementById('formRep'+fileId).submit();
            }
        });
        return false;
    } else {
        Swal.fire({
            title: "هل أنت متأكد لحذف البلاغ ؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "نعم إحذفه",
            cancelButtonText: "تراجع"
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: "تم الحذف",
                    text: "تم حذف البلاغ بنجاح",
                    icon: "success"
                });
                document.getElementById('formRep'+fileId).submit();
            }
        });
        return false;
    }
}

function delete_profile_picture(lang) {
    if (lang == "en") {
        Swal.fire({
            title: "Are you sure for delete profile picture ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "Yes, delete it",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted",
                    text: "Your profile picture has been deleted",
                    icon: "success"
                });
                document.getElementById('alertFormProfile').submit();
            }
        });
        return false;
    } else {
        Swal.fire({
            title: "هل تريد حقا حذف الصورة الشخصية ؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "نعم إحذفه",
            cancelButtonText: "تراجع"
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: "تم الحذف",
                    text: "تم حذف الصورة الشخصية بنجاح",
                    icon: "success"
                });
                document.getElementById('alertFormProfile').submit();
            }
        });
        return false;
    }
}
function delete_account(lang) {
    if (lang == "en") {
        Swal.fire({
            title: "Are you sure for delete your account ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "Yes, delete it",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('alertFormDelAcc').submit();
                window.location.href = 'delete_account_page.php';
            }
        });
        return false;
    } else {
        Swal.fire({
            title: "هل تريد حقا حذف حسابك ؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "rgb(19,94,196)",
            cancelButtonColor: "#494949",
            confirmButtonText: "نعم إحذفه",
            cancelButtonText: "تراجع"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('alertFormDelAcc').submit();
                window.location.href = 'delete_account_page.php';
            }
        });
        return false;
    }
}