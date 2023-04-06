const hamburgerBtn = document.getElementById('hamburger-btn');
const sideBar = document.getElementById('nav');

hamburgerBtn.addEventListener('click', function() {
  this.classList.toggle('active');
  sideBar.classList.toggle('active');
});