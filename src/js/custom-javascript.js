// Add your custom JS here.

// Animate on scroll
AOS.init({
  easing: "ease-out",
  once: true,
  duration: 600,
});

/*
// Header hide on scroll
(function () {
  var doc = document.documentElement;
  var w = window;
  var prevScroll = w.scrollY || doc.scrollTop;
  var curScroll;
  var direction = 0;
  var prevDirection = 0;
  var header = document.getElementById("wrapper-navbar");
  var checkScroll = function () {
    curScroll = w.scrollY || doc.scrollTop;
    if (curScroll > prevScroll) {
      direction = 2;
    } else if (curScroll < prevScroll) {
      direction = 1;
    }
    if (direction !== prevDirection) {
      toggleHeader(direction, curScroll);
    }
    prevScroll = curScroll;
  };
  var toggleHeader = function (direction, curScroll) {
    if (direction === 2 && curScroll > 125) {
      if (!document.getElementById("navbar").classList.contains("show")) {
        header.classList.add("hide");
        prevDirection = direction;
      }
    } else if (direction === 1) {
      header.classList.remove("hide");
      prevDirection = direction;
    }
  };
  window.addEventListener("scroll", checkScroll);
})();
*/
