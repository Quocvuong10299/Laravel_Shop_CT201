(function ($) {
    //slider menu
    $('.slider .slider__content').slick({
        dots: true,
        fade: true,
        infinite: true,
        autoplay:true,
        adaptiveHeight: true,
        speed: 1100,
        slidesToShow: 1,
        slidesToScroll:1,
        autoplaySpeed: 3000,
        prevArrow: false,
        nextArrow: false,
        cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
        easing:'swing'
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
            $('.header').addClass("dropdown");
            $('.header').removeClass("clear_dropdown");
        }else {
            $('.header').removeClass("header__scroll--component");
            $('.header').removeClass("dropdown");
            $('.header').addClass("clear_dropdown");
        }
    });

//    search
    $('.header__search').click(function () {
       $('.header__overlay').addClass("header__search--component");
    });
    $('.overlay').click(function () {
        $('.header__overlay').removeClass("header__search--component");
    });
//    click choose color product
    $('.color').eq(0).addClass('active_color');
    $('.click_color').click(function () {
        let parent = $(this).parent();
        if(parent.hasClass('active_color')){
            return;
        }else{
            $('.color').removeClass('active_color');
            parent.addClass('active_color');
        }
    });
//    live search ajax
    $('#search').on('keyup', function () {
        let value = $(this).val().toLowerCase().trim();
        $('#show_search_content').empty();
        $.get('/search?value='+value, function (data) {
          $.each(data, function (key, values) {
              if(value.length > 0){
                  $('#show_search_content').removeClass('invisible');
                  $('#show_search_content').append(
                      ` <a href="/san-pham/${values.product_id}">
                       <div style="width: 100%; height: 80px;" class="d-flex justify-content-between align-items-center p-3">
                           <p>${values.product_name}</p>
                           <img src="${values.product_image}" style="width: 70px; height: 70px;">
                       </div>
                   </a>`
                  )
              }else {
                  $('#show_search_content').addClass('invisible');
              }
          });
        });
    });

})(jQuery);
