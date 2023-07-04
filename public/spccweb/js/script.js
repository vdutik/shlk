function toggleNavResponsive() {
    let siteNav = document.getElementById('siteNav');
    let siteHeader = document.getElementsByClassName('site-header')[0];

    if (siteNav.className === 'site-nav') {
        siteHeader.className += ' site-header-scrollable'
        siteNav.className += ' responsive';
    } else {
        siteHeader.className = 'site-header'
        siteNav.className = 'site-nav';
    }

    let navIcon = document.getElementById('navIcon');

    if (navIcon.className === 'fa fa-2x fa-bars') {
        navIcon.className = ' fa fa-2x fa-times';
    } else {
        navIcon.className = 'fa fa-2x fa-bars';
    }
}

$('.tab-nav a').click(function (e) {
    e.preventDefault();
    const target = $(this).data("target");
    $('.tab-content > div').removeClass("tab-current");
    $(target).addClass("tab-current");
});

(() => {
    'use strict';

    // Particles.js - Site header bg config
    let particles = Particles.init({
        selector: '.particles-background',
        color: '#f2f2f2',
        connectParticles: true,
        maxParticles: 100,
        responsive: [{
                breakpoint: 1023,
                options: {
                    maxParticles: 50
                }
            },
            {
                breakpoint: 500,
                options: {
                    maxParticles: 30,
                    connectParticles: false
                }
            },
            {
                breakpoint: 320,
                options: {
                    maxParticles: 0
                }
            }
        ]
    });

})();

$(document).ready(function() {
    const swiper = new Swiper('.image-slider', {
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev' //кнопки
      },

      pagination: {
          el: '.swiper-pagination', //пагінація

      },

      type: 'fraction',
      renderFraction: function(currentClass, totalClass) {
          return 'Фото <span class="' + currentClass + '">' +
          ' з ' +
          '<span class="' + totalClass + '"></span>'; //вивід фракції
      },

      simulateTouch: true, //перетаскування на ПК

      keyboard:{
          enabled: true,
          pageUpDown: true, //керування клавіатурою
      },

      mouseWheel:{
          sensitivity: 1, //прокрутка мишкою
      },

      autoHeight: true, //автовисота картинок

      loop: true, // безкінечний свайп

      speed: 800,

      effect: 'fade',
      fadeEffect: {
          crossFade: true,
      },

      breakpoints: {
          320: {
              slidePerView: 1
          },
          480: {
              slidePerView: 1
          },
          922: {
              slidePerView: 1
          },
      },

      zoom: {
          maxRatio: 2,
          minRatio: 1,
      },


  //Завантаження сладій в з бд
     /** virtual: {
          slides: (function (){
              let slide = []
              for (let i = 0; i < 30; i++){
                  slide.push(`<div class="image-slider">Слайд №${i}<>/div`);
              }
              return slide;
          }()),
      },*/

      on: {
          init: function(){
              console.log('start');
          },
          slideChange: function(){
              console.log('change');
          },
      },
  });
  });


jQuery(document).ready(function ($) {

    // $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 6000);
    // });

    var slideCount = $('#slider-main ul li').length;
    var slideWidth = $('#slider-main ul li').width();
    var slideHeight = $('#slider-main ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider-main').css({ width: slideWidth, height: slideHeight });

    $('#slider-main ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

    $('#slider-main ul li:last-child').prependTo('#slider-main ul');

    function moveLeft() {
        $('#slider-main ul').animate({
            left: + slideWidth
        }, 500, function () {
            $('#slider-main ul li:last-child').prependTo('#slider-main ul');
            $('#slider-main ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider-main ul').animate({
            left: - slideWidth
        }, 500, function () {
            $('#slider-main ul li:first-child').appendTo('#slider-main ul');
            $('#slider-main ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});
