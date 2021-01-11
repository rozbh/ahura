jQuery(document).ready(function ($) {
    $('.owl-car1').owlCarousel({
      center: false,
      loop: true,
      items: 6,
      lazyLoad: true,
      margin: 25,
      navigation:true,
      navText : ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"],
      rtl: true,
      responsive:{
              0:{
                  items:1
              },
              400:{
                  items:2
              },
              600:{
                  items:3
              },
              1000:{
                  items:4
              }
          }
    });

    $('.owl-car2').owlCarousel({
      center: false,
      loop: true,
      items: 6,
      lazyLoad: true,
      margin: 0,
      navigation:true,
      navText : ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"],
      rtl: true,
      responsive:{
              0:{
                  items:1
              },
              400:{
                  items:2
              },
              600:{
                  items:3
              },
              1000:{
                  items:4
              }
          }
    });

    $(".post-carousel-3 .slide_box .owl-carousel").owlCarousel({
        center: false,
        loop: true,
        items: 3,
        lazyLoad: true,
        margin: 20,
        navigation: false,
        navText: ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"],
        rtl: true,
        responsive: {
            0:{
                items: 1
            },
            400:{
                items: 2
            },
            600: {
                items: 3
            }
        }
    });

    $('.owl-slider').owlCarousel({
      center: false,
      loop: true,
      lazyLoad: true,
      items: 1,
      autoplay: true,
      autoplaytimeout: 4000,
      margin:0,
      navigation:true,
      navText : ["<i class='fa fa-3x fa-chevron-left'></i>","<i class='fa fa-3x fa-chevron-right'></i>"],
      rtl: true
    });
});