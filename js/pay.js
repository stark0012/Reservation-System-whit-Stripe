document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const nav = document.getElementById('nav');
    const closeMenu = document.getElementById('close-menu');

    menuToggle.addEventListener('click', function() {
        nav.classList.toggle('open');
    });

    closeMenu.addEventListener('click', function() {
        nav.classList.remove('open');
    });
});

function back() {
    window.location.href = "index.php";
}