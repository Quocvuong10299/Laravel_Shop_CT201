$('.sub__menu');
//stating jquery
$(document).ready(function(){
    $('.add_active .nav-link').click(function () {
        if($(this).next().hasClass('sub__menu')){
            // console.log('ok');
            $('.sub__menu').toggle('low');
            $('.fa-angle-left').toggleClass('rotate');
        }
    })
});