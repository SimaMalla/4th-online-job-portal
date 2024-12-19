const swiperFull = new Swiper(".swiper-full", {
  autoplay: {
    delay: 3000,
  },
  slidesPerView: "auto",
  centeredSlides: true,
  spaceBetween: 32,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    // dynamicBullets: true,
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
$(".swiper-full").mouseenter(function () {
  swiperFull.autoplay.stop();
});
$(".swiper-full").mouseleave(function () {
  swiperFull.autoplay.start();
});
