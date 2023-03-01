const navBar = document.querySelector('.header__container--nav');
const navBtn = document.querySelector('.header__container--btn i');

function toggleNav() {
    navBtn.classList.toggle('fa-bars');
    navBtn.classList.toggle('fa-times');
    navBar.classList.toggle('header__container--nav');
    navBar.classList.toggle('nav-active');
}

navBtn.addEventListener('click', function() {
    toggleNav();
});