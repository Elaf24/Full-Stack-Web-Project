document.addEventListener("DOMContentLoaded", (event) => {
  var container = document.getElementById("swiper-container");

  var swiperContainer = document.createElement("div");
  swiperContainer.className = "swiper-container";

  var swiperWrapper = document.createElement("div");
  swiperWrapper.className = "swiper-wrapper";
  swiperContainer.appendChild(swiperWrapper);

  for (var i = 1; i <= 10; i++) {
    var swiperSlide = document.createElement("div");
    swiperSlide.className = "swiper-slide";
    swiperSlide.setAttribute("data-src", "img/" + i + ".jpg");

    var contentWrapper = document.createElement("div");
    contentWrapper.className = "swiper-slide-content";

    var img = document.createElement("img");
    img.src = "img/" + i + ".jpg";

    contentWrapper.appendChild(img);
    swiperSlide.appendChild(contentWrapper);
    swiperWrapper.appendChild(swiperSlide);
  }

  var swiperPagination = document.createElement("div");
  swiperPagination.className = "swiper-pagination";
  swiperContainer.appendChild(swiperPagination);

  var swiperButtonNext = document.createElement("div");
  swiperButtonNext.className = "swiper-button-next";
  swiperContainer.appendChild(swiperButtonNext);

  var swiperButtonPrev = document.createElement("div");
  swiperButtonPrev.className = "swiper-button-prev";
  swiperContainer.appendChild(swiperButtonPrev);

  container.appendChild(swiperContainer);

  var swiper = new Swiper(".swiper-container", {
    slidesPerView: 1,
    centeredSlides: true,
    spaceBetween: 10,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    on: {
      slideChange: function () {
        var currentSlide = this.slides[this.activeIndex];
        var imageUrl = currentSlide.getAttribute("data-src");
        swiperContainer.style.setProperty(
          "--background-url",
          "url(" + imageUrl + ")"
        );
      },
    },
  });
  swiper.emit("slideChange");
});
