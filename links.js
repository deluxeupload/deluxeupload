const links = document.querySelectorAll("#ul3 #link");
links.forEach(link => {
    link.addEventListener('click',function(){
        links.forEach(l => {
            l.classList.remove("active");
            this.classList.add("active");
        })
    })
})