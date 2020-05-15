
//stating jquery
$(document).ready(function(){
    $('.add_active .nav-link').click(function () {

        var checkElement = $(this).next();
        if(checkElement.hasClass('sub__menu')){
            $(this).children("i:last-child").toggleClass('rotate');
            // console.log('ok');
            // $('.sub__menu').toggle('low');
            checkElement.toggle('low');
            // $('.fa-angle-left').toggleClass('rotate');
            // $('.fa-angle-left').toggleClass('rotate');
            // $('.sub__menu').removeClass('show_sub');
        }
    })
});