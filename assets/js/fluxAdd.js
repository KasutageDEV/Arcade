const fluxBtn = document.querySelector('.flux__btn');
const fluxAdd = document.querySelector('.flux__add');

fluxBtn.addEventListener('click', () => {
    fluxAdd.classList.toggle('active');
})

$(function() {
    const screenWidth = $(window).width();
    const screenHeight = $(window).height();

    $("#flux__add").draggable({
        containment: [0, 0, screenWidth - 300, screenHeight - 310]
    });
});