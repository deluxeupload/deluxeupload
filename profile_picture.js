const uploadFile = document.getElementById("profilePicture");
const btn = document.getElementById("pPicture");
const img = document.getElementById("image");
const p = document.getElementById('para');
const p1 = document.getElementById('para1');
const div = document.getElementById('filename');
const profileIcon = document.getElementById('profileIcon');
div.style.display = "none";
p1.style.display = "none";

uploadFile.addEventListener("change",function(event){
    event.preventDefault();
    const file = this.files[0];
    p1.style.display = "block";
    profileIcon.style.display = "none";
    if(document.body.lang == "en"){
        p1.textContent = "Selected file : "+this.files[0].name;
    }else{
        p1.textContent = "الملف المحدد : "+this.files[0].name;
    }
    div.style.display = "block";
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
        btn.style.padding = "0px";
        p.style.display = "none";
    }
})

btn.addEventListener('click',function(){
    document.getElementById('profilePicture').click();
});

function uploadFileBtn() {
    const fileInput = document.getElementById("img");
    if (fileInput.files.length === 0) {
        alert("Please choose a file first.");
        return;
    }
    fileInput.closest("form").submit();
}