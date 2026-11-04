document.addEventListener('DOMContentLoaded', function () {
    const btnMenu = document.getElementById('btn-menu-mobile');
    const menu = document.getElementById('menu-desplegable-mobile');

    if (btnMenu && menu) {
        btnMenu.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    }
});