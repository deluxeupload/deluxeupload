let link = document.getElementById('download');
link.style.display = "none";
let div = document.getElementById('prepare_link');
let timer = document.getElementById('timer');
let seconds = 5;
const interval = setInterval(() => {
    seconds -- ;
    timer.textContent = "انتظر بضع ثواني "+seconds+" ثانية";
    if(seconds <= 0){
        clearInterval(interval);
        link.style.display = "block";
        div.style.display = "none";
        timer.innerHTML = "";
        link.textContent = "الرابط جاهز";
    }
},1000);