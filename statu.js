const list = document.querySelectorAll('.card-body .statu');
const links = document.querySelectorAll('#delRep');
const statuImage = document.querySelectorAll('.statu #statuImg');
for (let i = 0; i < list.length; i++) {
    let status = list[i].textContent.trim().toLowerCase();
    let link = links[i];
    switch (status) {
        case "pending":
            list[i].style = "background-color:#ffc107;color:black;";
            statuImage[i].className = "fas fa-clock";
            if (link) link.style.display = "none";
            break;
        case "rejected":
            list[i].style = "background-color: #dc3545;";
            statuImage[i].className = "fas fa-times-circle";
            if (link) link.style.display = "block";
            break;
        case "resolved":
            list[i].style = "background-color:#28a745;";
            statuImage[i].className = "fas fa-check-circle";
            if (link) link.style.display = "block";
            break;
        case "in_progress":
            list[i].style = "background-color: #17a2b8;width:max-content;";
            statuImage[i].className = "fas fa-spinner fa-spin";
            if (link) link.style.display = "none";
            break;
    }
}