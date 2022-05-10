function toggleNavResponsive() {
  let siteNav = document.getElementById('siteNav');

  if (siteNav.className === 'site-nav') {
      siteNav.className += ' responsive';
  } else {
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


$(document).ready(function() {

  const swiper = new Swiper(".image-slider", {
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    loop: true, 

    speed: 500,

    effect: 'fade',
    fadeEffect: {
        crossFade: true,
    },

    zoom: {
        maxRatio: 2,
        minRatio: 1,
    },
        keyboard:{
        enabled: true,
        pageUpDown: true, 
    },
    
    on: {
        init: function(){
            console.log('start');
            },
        slideChange: function(){
            console.log('change');
            },
        },
      });
//   const swiper = new Swiper('.image-slider', {
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev' //кнопки
//     },

//     pagination: {
//         el: '.swiper-pagination',
//         type: 'bullets',
//         clickable: true,
//         dynamicMainBullets: true,
//          //пагінація
        
//     },


//     simulateTouch: true, //перетаскування на ПК 
    
//     keyboard:{
//         enabled: true,
//         pageUpDown: true, //керування клавіатурою 
//     },


//     autoHeight: true, //автовисота картинок 

//     loop: true, // безкінечний свайп

//     speed: 500,

//     effect: 'fade',
//     fadeEffect: {
//         crossFade: true,
//     },

//     breakpoints: {
//         320: {
//             slidePerView: 1
//         },
//         480: {
//             slidePerView: 1
//         },
//         922: {
//             slidePerView: 1
//         },
//     },

//   slidesPerView: 3,

//    spaceBetween: 20,
    
//     zoom: {
//         maxRatio: 2,
//         minRatio: 1,
//     },

    

// //Завантаження сладій в з бд
//    /** virtual: {
//         slides: (function (){
//             let slide = []
//             for (let i = 0; i < 30; i++){
//                 slide.push(`<div class="image-slider">Слайд №${i}<>/div`);
//             }
//             return slide;
//         }()),
//     },*/

//     on: {
//         init: function(){
//             console.log('start');
//         },
//         slideChange: function(){
//             console.log('change');
//         },
//     },
// });
});
