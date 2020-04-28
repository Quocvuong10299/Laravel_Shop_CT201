@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <h4 class="main__title--component mb-5"> Đăng Kí</h4>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <form action="{{route('postregister')}}" method="POST" name="register">
                        @csrf
                        <div class="fieldset">
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_full_name">Họ và tên</label>
                                    <input placeholder="Họ và tên" autocapitalize="off" spellcheck="false" class="field-input" type="text" id="name" name="name">
                                </div>
                            </div>
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_full_name">Email</label>
                                    <input placeholder="Email" autocapitalize="off" spellcheck="false" class="field-input" type="email" id="email" name="email">
                                </div>
                            </div>
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_full_name">SDT</label>
                                    <input placeholder="Số điện thoại (+84)" autocapitalize="off" spellcheck="false" class="field-input" type="text" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="field field-required field-error ">
                                <div class="field-input-wrapper position-relative">
                                    <label class="field-label" for="billing_address_address1">Password</label>
                                    <input placeholder="Mật khẩu" autocapitalize="off" spellcheck="false" class="field-input" type="password" id="password" name="password">
                                    <div class="position-absolute eye" style="top:46px; right: 10px; cursor: pointer">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="field field-required field-error ">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_address1">RePassword</label>
                                    <input placeholder="Nhập lại mật khẩu" autocapitalize="off" spellcheck="false" class="field-input" type="password" id="repassword" name="repassword">
                                    <p class="" id="success_pass"></p>
                                </div>
                            </div>
                        </div>
                        <button class="btn mt-5" type="submit">Đăng kí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/frontend/js/jquery.validate.min.js"></script>
    <script src="/frontend/js/cart.js"></script>
    <script>
        $("form[name='register']").validate({
            rules: {
                email: {
                    required: true,
                    maxlength:50,
                    email: true
                },
                name: {
                    required: true,
                    maxlength:16,
                },
                phone: {
                    required: true,
                    digits: true
                },
                password:{
                    required: true,
                    minlength:3,
                    maxlength:16
                } ,
                repassword:{
                    equalTo: "#password",
                    required: true,
                }
            },
            messages: {
                password: {
                    required: "*Password không được để trống",
                    minlength: "*Password quá ngắn! Hãy nhập trên 3 kí tự",
                    maxlength: "*Password không được quá 16 kí tự"
                },
                repassword: {
                    equalTo: "*Không khớp mật khẩu!",
                    required: "*Trường này không được để trống",
                },
                email: "*Email không được để trống",
                name: {
                  required: "Tên không được để trống",
                  maxlength:"Tên không quá 16 kí tự",
                },
                phone:{
                    required:  "Số điện thoại không được để trống",
                    digits: "Trường này chỉ bao gồm các số"
                }
            },
            highlight: function(element) {
                $(element).parent().addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass('has-error');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <script src="/frontend/js/validateForm.js"></script>
@endsection