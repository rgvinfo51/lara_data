///// Footer


jQuery(document).ready(function() {


  var owl = jQuery('#photogallery');
  owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 15,
    autoplay: false,
    lazyLoad:true,
    smartSpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: false,
    nav: false,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 3
      },
      1199: {
        items: 1
      }
    }
  });
  $('.prev').click(function() {
    owl.trigger('owl.prev')
  })

  $('.next').click(function() {
    owl.trigger('owl.next')
  })

})

jQuery(document).ready(function() {


  var owl = jQuery('#footer-gov');
  owl.owlCarousel({
    items: 6,
    loop: true,
    margin: 15,
    autoplay: true,
    lazyLoad:true,
    smartSpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: false,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 3
      },
      1199: {
        items: 6
      }
    }
  });
  $('.prev').click(function() {
    owl.trigger('owl.prev')
  })

  $('.next').click(function() {
    owl.trigger('owl.next')
  })

})



$(function () {

    //animate on scroll
    new WOW().init();
});


$(document).ready(function() {
    var dd = $('.vticker').easyTicker({
        direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 3000,
        height: '320',
        visible: 4,
        mousePause: 1,
        controls: {
            up: '.btnUp',
            down: '.btnDown',
            toggle: '.btnToggle'
        }


    }).data('easyTicker');

});
