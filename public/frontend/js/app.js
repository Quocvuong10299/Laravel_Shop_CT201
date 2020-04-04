(function ($) {
    //slider menu
    $('.slider__content').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow: false,
        nextArrow: false
    });

    //slider products
    $('.slider__products').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 2,
        adaptiveHeight: true,
        prevArrow:'<div class="btn__prev-next prev__custom"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
        nextArrow:'<div class="btn__prev-next next__custom"><i class="fa fa-angle-right" aria-hidden="true"></i></div>'
    });

    //scroll event
    $(window).scroll(function () {
        const scrollHeader = $(window).scrollTop();
        if(scrollHeader > 70){
            $('.header').addClass("header__scroll--component");
        }else {
            $('.header').removeClass("header__scroll--component");
        }
    });

//    search
    $('.header__search').click(function () {
       $('.header__overlay').addClass("header__search--component");
    });
    $('.overlay').click(function () {
        $('.header__overlay').removeClass("header__search--component");
    });
})(jQuery);