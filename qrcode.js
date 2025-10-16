let prepare = document.getElementById('timer_qr');
prepare.style.display = "none";
let para_qr = document.getElementById('para_qr');
para_qr.style.display = "none";
document.getElementById('qrcodeLink').style.display = "none";
let secondsQr = 6;
function create_qr_code(link) {
    const interval = setInterval(() => {
        secondsQr --;
        prepare.style.display = "block";
        document.querySelector('.qrcodeButton').style.display = "none";
        if(document.body.lang == "en"){
            prepare.textContent = "Wait a few seconds for prepare qr code "+secondsQr+"s";
        }else{
            prepare.textContent = "إنتظر لتهيئة الكود  "+secondsQr+" ثانية";
        }
        if(secondsQr <= 0){
            clearInterval(interval);
            prepare.innerHTML = "";
            prepare.style.display = "none";
            para_qr.style.display = "block";
            if(document.body.lang == "en"){
                para_qr.textContent = "Thanks for waiting !";
            }else{
                para_qr.textContent = "شكرا لإنتظارك !";
            }
            document.getElementById('qrcodeLink').style.display = "block";
            new QRCode(document.getElementById('qrcodeLink'), {
                text: link,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    },1000)
}