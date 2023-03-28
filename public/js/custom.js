///// Footer

jQuery(document).ready(function() {
  var owl = jQuery('#facilites');
  owl.owlCarousel({
    items: 3,
    loop: true,
    margin: 0,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1199: {
        items: 3
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
  var owl = jQuery('#indialandfestivals');
  owl.owlCarousel({
    items: 4,
    slideBy: 4,
    //loop: true,
    margin: 0,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1199: {
        items: 4
      }
    }
  });
  $('.prev').click(function() {
    owl.trigger('owl.prev')
  })

  $('.next').click(function() {
    owl.trigger('owl.next')
  })

});
jQuery(document).ready(function() {
  var owl = jQuery('#indialandfestivals2');
  owl.owlCarousel({
    items: 3,
    slideBy: 3,
    //loop: true,
    margin: 0,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1199: {
        items: 3
      }
    }
  });
  $('.prev').click(function() {
    owl.trigger('owl.prev')
  })

  $('.next').click(function() {
    owl.trigger('owl.next')
  })

});


jQuery(document).ready(function() {
  var owl = jQuery('#othermightlike');
  owl.owlCarousel({
    items: 4,
    slideBy: 4,
    //loop: true,
    margin: 0,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1199: {
        items: 4
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
  var owl = jQuery('#ongoingfestival');
  owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 0,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
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


jQuery(window).on('load', function() {
	//document-repository left Filter List Toggle
	var listViewTrigger = jQuery("ul.downli-checkboxes > li");
	/* jQuery(listViewTrigger).append( "<span class='iconBox'></span>" ); */
	jQuery('ul.downli-checkboxes li').on('click', '.iconBox', function() {
		jQuery(this).closest(listViewTrigger).toggleClass('open');
	});
});

$('.readmore-link').click(function() {
  $('.readmore-text').slideToggle();
  if ($('.readmore-link').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});

$(window).scroll(function() {
  if ($("#wrapperNav").length) {
    //On scroll Navigation Fixed
    var headerFix = $('#wrapperNav');
    $(window).scroll(function() {
      if ($(this).scrollTop() > 40) {
        //alert('hi');  
        headerFix.addClass("headFix");
      } else {
        headerFix.removeClass("headFix");
      }

    })
  }
});


 $(window).scroll(function() {
   if ($("#wrapperNav").length) {
       //On scroll Navigation Fixed
        var headerFix = $('#wrapperNav');
        $(window).scroll(function () {
          if ($(this).scrollTop() > 40) {
            //alert('hi');  
            headerFix.addClass("headFix");
          } else {
            headerFix.removeClass("headFix");
          }
                             
      })
    }
  });


$(function () {

    //animate on scroll
    new WOW().init();
});


$(document).ready(function() {
    var dd = $('.vticker').easyTicker({
        direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 2000,
        height: '280',
        visible: 4,
        mousePause: 1,
        controls: {
            up: '.btnUp',
            down: '.btnDown',
            toggle: '.btnToggle'
        }


    }).data('easyTicker');

});


/* Gallery Slider */
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

$(document).on('keypress mouseenter mouseleave', '.decimalonly', function(event) {
        return isNumber(event, this);
    });

    function isNumber(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57) && charCode != 8)
            return false;

        return true;
    }
/* Gallery Slider */
