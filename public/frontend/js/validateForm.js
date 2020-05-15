$(document).ready(function(){
    $(".alert button.close").click(function (e) {
        $(this).parent().hide();
    });
//   confirm pass and re_pass
    $('#repassword').on('keyup', function(){
        let password = $('#password').val();
        let repassword = $('#repassword').val();
        if(repassword === password){
            $('#success_pass').html('Khớp mật khẩu');
            $('#success_pass').removeClass('text-danger');
            $('#success_pass').addClass('text-success');
        }else{
            $('#success_pass').html('Không khớp mật khẩu');
            $('#success_pass').removeClass('text-success');
            $('#success_pass').addClass('text-danger');
        }
    });
//    toggle show  hide password
    $('.eye').click(function () {
        let value_password = $('#password').attr('type');
        console.log(value_password);
        if(value_password === 'password'){
            $('#password').attr('type','text');
            $('.fa-eye').addClass('eye-hide');
        }else{
            $('#password').attr('type','password');
            $('.fa-eye').removeClass('eye-hide');
        }
    })
});