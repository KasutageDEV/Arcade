// OpenLoginModal
const openLoginBtn = document.querySelector('#openLoginModal');
const modalLoginOpen = document.querySelector('#modalLogin');

openLoginBtn.addEventListener('click', () => {
    modalLoginOpen.classList.add('active');
    modalLoginOpen.classList.add('modal__animation');
})

// CloseLoginModal
const closeLoginBtn = document.querySelector('#closeLoginModal');
const modalLoginClose = document.querySelector('#modalLogin');

closeLoginBtn.addEventListener('click', () => {
    modalLoginClose.classList.remove('active');
    modalLoginOpen.classList.remove('modal__animation');
})

// OpenRegisterModal
const openRegisterBtn = document.querySelector('#openRegisterModal');
const modalRegisterOpen = document.querySelector('#modalRegister');

openRegisterBtn.addEventListener('click', () => {
    modalRegisterOpen.classList.add('active');
    modalRegisterOpen.classList.add('modal__animation');
})

// CloseRegisterModal
const closeRegisterBtn = document.querySelector('#closeRegisterModal');
const modalRegisterClose = document.querySelector('#modalRegister');

closeRegisterBtn.addEventListener('click', () => {
    modalRegisterClose.classList.remove('active');
    modalRegisterClose.classList.remove('modal__animation');
})