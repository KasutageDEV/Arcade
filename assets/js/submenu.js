const navLink = document.querySelector('.dropdown');
const submenu = document.querySelector('.submenu');

navLink.addEventListener('click', () => {
    submenu.classList.toggle('active');
})