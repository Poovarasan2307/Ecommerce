const slides = document.querySelector('.slides');
const slide = document.querySelectorAll('.slide');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
let index = 0;

function showSlide(index) {
  const offset = -index * 100;
  slides.style.transform = `translateX(${offset}%)`;
}

prev.addEventListener('click', () => {
  index = (index > 0) ? index - 1 : slide.length - 1;
  showSlide(index);
});

next.addEventListener('click', () => {
  index = (index < slide.length - 1) ? index + 1 : 0;
  showSlide(index);
});

setInterval(() => {
  index = (index < slide.length - 1) ? index + 1 : 0;
  showSlide(index);
}, 3000);
