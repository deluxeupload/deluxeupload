const uploadFile = document.getElementById("file");
const zoneClick = document.querySelector(".card-body");
const fileName = document.getElementById("show-file");
fileName.style.display = "none";
zoneClick.addEventListener("change",function(){
    if(uploadFile.files.length > 0){
        fileName.style.display = "block";
        if(document.body.lang == "en"){
            fileName.textContent = "Selected File : "+uploadFile.files[0].name;
        }else{
            fileName.textContent = "الملف المحدد : "+uploadFile.files[0].name;
        }
    }else{
        fileName.textContent = "";
    }
})
zoneClick.addEventListener('click',function(){
    uploadFile.click();
});

function uploadFileBtn() {
    const fileInput = document.getElementById("file");
    if (fileInput.files.length === 0) {
        if(document.body.lang === "en"){
            /* alert("Please choose a file first."); */
            Swal.fire({
                icon : "error",
                title : "Error",
                text : "Please choose a file first",
            })
        }else{
            /* alert("اختر الملف أولا"); */
            Swal.fire({
                icon : "error",
                title : "خطأ",
                text : "اختر الملف أولا",
            });
        }
        return;
    }
    fileInput.closest("form").submit();
}