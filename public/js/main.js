const menuToggle = document.getElementById('menuToggle');
const menuList = document.querySelector('.menu ul');

menuToggle.addEventListener('click', () => {
    menuList.classList.toggle('active');
    if (menuList.classList.contains('active')) {
        menuToggle.textContent = '✖';
    } else {
        menuToggle.textContent = '☰';
    }

});

