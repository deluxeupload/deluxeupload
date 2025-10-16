const div = document.getElementById('background');
let arr = ['outils/backgrounds/my backgrounds/IMG-20250420-114026.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114052.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114107.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114207.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114251.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114301.jpg', 'outils/backgrounds/my backgrounds/IMG-20250420-114313.jpg', 'outils/backgrounds/background35.jpg', 'outils/backgrounds/background36.jpg', 'outils/backgrounds/pexels-eberhardgross-1074428.jpg', 'outils/backgrounds/pexels-pixabay-414659.jpg', 'outils/backgrounds/background34.jpg', 'outils/backgrounds/background35.jpg', 'outils/backgrounds/background36.jpg','outils/backgrounds/background37.jpg','outils/backgrounds/background38.jpg','outils/backgrounds/background39.jpg','outils/backgrounds/background40.jpg','outils/backgrounds/background41.jpg','outils/backgrounds/background42.jpg','outils/backgrounds/background43.jpg','outils/backgrounds/background44.jpg','outils/backgrounds/background45.jpg','outils/backgrounds/background46.jpg','outils/backgrounds/background47.jpg','outils/backgrounds/background48.jpg'];

/* let change_image = setInterval(() => {
    let randomBack = Math.floor(Math.random() * arr.length);
    div.style.backgroundImage = `url('${randomBack}')`;
    let background = arr[randomBack];
    div.style.backgroundImage = `url('${background}')`;
    div.style.transition = "background-image 1s ease-in-out";
    }, 5000) */
function changeBack(){
    let randomBack = Math.floor(Math.random() * arr.length);
    div.style.backgroundImage = `url('${randomBack}')`;
    let background = arr[randomBack];
    div.style.backgroundImage = `url('${background}')`;
}

window.onload = changeBack();