// PARALLAX

let stars = document.getElementById('stars');
let moon = document.getElementById('moon');
let mountains_behind = document.getElementById('mountains_behind');
let text = document.getElementById('header__text');
let btn = document.getElementById('btn_header');
let mountains_front = document.getElementById('mountains_front');

window.addEventListener('scroll', () => {

    let value = window.scrollY;

    stars.style.left = value * 0.25 + 'px';
    moon.style.top = value * 1.05 + 'px';
    mountains_behind.style.top = value * 0.5 + 'px';
    mountains_front.style.top = value * 0 + 'px';
    text.style.marginRight = value * 4 + 'px';
    text.style.marginTop = value * 1.5 + 'px';
    btn.style.marginTop = value * 1.5 + 'px';
});

// WORLD HIDE

const worlds = document.querySelectorAll('.world');

worlds.forEach(world => {
    world.addEventListener('click', () => {
        world.classList.toggle('openw');
    });
});

// HOYO HIDE 

const hoyos = document.querySelectorAll('.hoyoverse');

hoyos.forEach(hoyo => {
    hoyo.addEventListener('click', () => {
        hoyo.classList.toggle('open');
    });
});

// GAME SLIDE

let slides = document.querySelectorAll('.slide');
let btns = document.querySelectorAll('.slider__btn');
let currentSlide = 1;

const manualNav = (manual) => {

    slides.forEach((slide) => {
        slide.classList.remove('active');

        btns.forEach((btn) => {
            btn.classList.remove('active');
        });
    });

    slides[manual].classList.add('active');
    btns[manual].classList.add('active');
};

btns.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
    });
});

const repeat = (activeClass) => {
    let active = document.getElementsByClassName('active');
    let i = 1;

    const repeater = () => {
        setTimeout(() => {
            [...active].forEach((activeSlide) => {
                activeSlide.classList.remove('active');
            });

            slides[i].classList.add('active');
            btns[i].classList.add('active');
            i++;

            if(slides.length == i) {
                i = 0;
            }
            if(i >= slides.length) {
                return;
            }
            repeater();
        }, 10000);
    }
    repeater();
}
repeat();