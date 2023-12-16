function handleClick(element) {
    var id = element.id;
    console.log(id);
    $(".dayBranch").attr("style", "display: none");
    $("#dayBranch" + id).attr("style", "display: block");
}

(function ($) {
    "use strict";

    $(window).on('load', function(){
        //===== Prealoder
        $("#preloader").delay(400).fadeOut();
    });

    $(document).on("click",".clickedBranch",function(){
        var id = $(this).attr("id");
        console.log(id);
        $(".dayBranch").attr("style", "display: none");
        $("#dayBranch" + id).attr("style", "display: block");
    })

    $(document).ready(function () {
        //05. sticky header
        function sticky_header(){
            var wind = $(window);
            var sticky = $('header');
            wind.on('scroll', function () {
                var scroll = wind.scrollTop();
                if (scroll < 30) {
                    sticky.removeClass('sticky');
                } else {
                    sticky.addClass('sticky');
                }
            });
        }
        sticky_header();
        //===== Back to top

        // Show or hide the sticky footer button
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 600) {
                $('.back-to-top').fadeIn(200)
            } else {
                $('.back-to-top').fadeOut(200)
            }
        });

        //Animate the scroll to yop
        $('.back-to-top').on('click', function (event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: 0,
            }, 900);
        });

        // Hamburger-menu
        $('.hamburger-menu').on('click', function () {
            $('.hamburger-menu .line-top, #menu').toggleClass('current');
            $('.hamburger-menu .line-center').toggleClass('current');
            $('.hamburger-menu .line-bottom').toggleClass('current');
        });

        // Slider Initialize
        $('.owl-carousel.slider1').owlCarousel({
            loop: true,
            margin: 50,
            items: 1,
            nav: true,
            dots: false,
            navText: [
            '<i class="fas fa-arrow-alt-left"></i>',
            '<i class="fas fa-arrow-alt-right"></i>'
            ],
        });        

        // Slider Initialize
        $('.owl-carousel.slider2').owlCarousel({
            loop: true,
            margin: 50,
            items: 1,
            rtl: true,
            nav: true,
            dots: false,
            navText: [
            '<i class="fas fa-arrow-alt-left"></i>',
            '<i class="fas fa-arrow-alt-right"></i>'
            ],
        });

        //03. Smoot Scroll Effect
        $('#menu li .nav-link').bind('click', function(event) {
            var $anchor = $(this);
            var headerH = '100';
            $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
            }, 600, 'easeInSine');
            event.preventDefault();
        });
        //Counter Number
        $('.facts_area').on('inview', function(event, visible) {
            if (visible) {
                $(this).find('.counter').each(function () {
                    var $this = $(this);
                    $({ Counter: 0 }).animate({ Counter: $this.text() }, {
                
                        duration: 1500,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.ceil(this.Counter));
                        }
                    });
                });
                $(this).unbind('inview');
            }
        });

        // language
        new JLang({
            id: 'languages',
            framework: 'bootstrap4',
            cookieExp: 30,
            cookieLangName: 'name',
            cookieLangCode: 'code',
            abbreviation: true,
            reload: false,
            alignment: 'left',
            hover: true
        });
    });

})(jQuery);