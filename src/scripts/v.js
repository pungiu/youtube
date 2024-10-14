 document.getElementById("komtext").onchange = function() {
    document.getElementById("koms").submit();
};

function likeForm() {
    document.getElementById("like").submit();
}

if (localStorage.theme === 'light') {
    body.classList.replace('bg-darkMode','bg-whitemode');
}

const userTheme = localStorage.getItem("theme");
var body = document.getElementById('bodyd');
if (userTheme === 'dark') {
    body.classList.replace('bg-darkMode','bg-whiteback');
    body.classList.replace('text-white','text-black');
}
