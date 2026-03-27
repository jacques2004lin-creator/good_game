// Slider pour nouveaux jeux
const swiperNouveaux = new Swiper('.sliderNouveaux', {
    slidesPerView: 'auto',
    centeredSlides: true,
    loop: true,
    spaceBetween: 15,

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

// Responsive
let swiperJeux;

function gestionSlider() {
    let largeur = window.innerWidth;

    if (largeur <= 480) {
        if (!swiperJeux) {
            swiperJeux = new Swiper('.sliderJeux', {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 10,
                loop: true,
            });
        }
    } else {
        if (swiperJeux) {
            swiperJeux.destroy(true, true);
            swiperJeux = null;
        }
    }
}

window.addEventListener('resize', gestionSlider);

gestionSlider();

// Gestion de slider page jeux
// Initialise le slider des miniatures (en bas)
var swiperThumbs = new Swiper(".thumbSwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

// Initialise le slider principal (en haut) et le lie aux miniatures
var swiperMain = new Swiper(".mainSwiper", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiperThumbs,
    },
});