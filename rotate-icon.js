const icon = document.getElementById('drpIcon');
const dropdownIcon = document.getElementById('dropdownIcon');
dropdownIcon.addEventListener('shown.bs.dropdown',function(){
    icon.classList.remove('fa-chevron-down');
    icon.classList.add('fa-chevron-up');
});

dropdownIcon.addEventListener('hidden.bs.dropdown',function(){
    icon.classList.remove('fa-chevron-up');
    icon.classList.add('fa-chevron-down');
});