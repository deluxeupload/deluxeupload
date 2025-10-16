let link = document.getElementById('download');
link.style.display = "none";
let div = document.getElementById('prepare_link');
let timer = document.getElementById('timer_download');
let seconds = 6;
const interval = setInterval(() => {
    seconds -- ;
    if(document.body.lang == "en"){
        timer.textContent = "Wait a few seconds "+seconds+"s";
    }else{
        timer.textContent = "انتظر بضع ثواني "+seconds+" ثانية";
    }
    if(seconds <= 0){
        clearInterval(interval);
        link.style.display = "block";
        div.style.display = "none";
        timer.innerHTML = "";
        if(document.body.lang == "en"){
            link.textContent = "Download now";
        }else{
            link.textContent = "الرابط جاهز";
        }
    }
},1000);