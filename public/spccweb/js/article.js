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



$(document).ready(function(){
    if ($('.photo-slider div').length > 0) {
        $('.photo-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.photo-slider-nav',
            adaptiveHeight: true, // додано для адаптивної висоти
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                }
            ]
        });

        $('.photo-slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.photo-slider',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });

        $('.photo-slider img').on('click', function(){
            $(this).toggleClass('enlarged');
        });
    } else {
        $('.photo-slider-container').hide(); // приховати контейнер, якщо немає фотографій
    }
});
