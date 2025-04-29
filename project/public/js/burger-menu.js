document.addEventListener('DOMContentLoaded', () => {
    const burgerMenuButton = document.getElementById('burger-menu-button');
    const navbarMenu = document.getElementById('navbar-menu');
    const sidebarMenu = document.getElementById('sidebar-menu');

    // Toggle navbar and sidebar visibility
    burgerMenuButton.addEventListener('click', () => {
        console.log('heere')
        navbarMenu.classList.toggle('hidden');
        navbarMenu.classList.toggle('flex');

        // Toggle sidebar visibility
        sidebarMenu.classList.toggle('hidden');
        sidebarMenu.classList.toggle('block');
    });
});