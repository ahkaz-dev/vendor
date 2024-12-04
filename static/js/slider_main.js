  document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".infinite-slider");
    const slides = document.querySelectorAll(".slide");
    const prevButton = document.querySelector(".slider-btn.left-btn");
    const nextButton = document.querySelector(".slider-btn.right-btn");

    let slideWidth = slides[0].offsetWidth + 20; // Ширина слайда + gap

    // Дублируем слайды для бесконечного эффекта
    const sliderChildren = Array.from(slider.children);
    slider.append(...sliderChildren.map((el) => el.cloneNode(true)));

    // Устанавливаем начальную позицию
    slider.style.transform = `translateX(-${slideWidth}px)`;

    // Перемещает слайд в конец (при прокрутке влево)
    function moveSlideToEnd() {
      const firstSlide = slider.children[0];
      slider.append(firstSlide);
      slider.style.transition = "none";
      slider.style.transform = `translateX(-${slideWidth}px)`;
      setTimeout(() => {
        slider.style.transition = "transform 0.4s ease-in-out";
      });
    }

    // Перемещает слайд в начало (при прокрутке вправо)
    function moveSlideToStart() {
      const lastSlide = slider.children[slider.children.length - 1];
      slider.prepend(lastSlide);
      slider.style.transition = "none";
      slider.style.transform = `translateX(-${slideWidth}px)`;
      setTimeout(() => {
        slider.style.transition = "transform 0.4s ease-in-out";
      });
    }

    // Логика для кнопок
    prevButton.addEventListener("click", () => {
      slider.style.transform = `translateX(0px)`;
      slider.addEventListener("transitionend", moveSlideToStart, { once: true });
    });

    nextButton.addEventListener("click", () => {
      slider.style.transform = `translateX(-${2 * slideWidth}px)`;
      slider.addEventListener("transitionend", moveSlideToEnd, { once: true });
    });

    // Автопрокрутка
    setInterval(() => {
      nextButton.click();
    }, 3000);
  });
