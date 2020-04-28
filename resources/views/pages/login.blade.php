@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <h4 class="main__title--component mb-5"> Đăng nhập</h4>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="alert">
                        @if(session('mess_login'))
                            <div class="alert alert-danger bg-danger text-white b alert-dismissable">
                                <button type="button" class="close" aria-hidden="true">&times;</button>
                                <p>{{session('mess_login')}}</p>
                            </div>
                        @endif
                            @if(session('mess_register'))
                                <div class="alert alert-success bg-success text-white b alert-dismissable">
                                    <button type="button" class="close" aria-hidden="true">&times;</button>
                                    <p>{{session('mess_register')}}</p>
                                </div>
                            @endif
                    </div>
                    <form action="{{route('postlogin')}}" method="POST" id="login_form" name="registration">
                        @csrf
                        <div class="fieldset">
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_full_name">Email đăng nhập</label>
                                    <input placeholder="Email đăng nhập" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="text" id="login_email" name="login_email" value="">
                                </div>
                            </div>
                            <div class="field field-required field-error ">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_address1">Password</label>
                                    <input placeholder="Mật khẩu" autocapitalize="off" spellcheck="false" class="field-input" type="password" id="login_password" name="login_password" value="">
                                </div>
                            </div>
                        </div>
                        <button id="loginBtn" class="btn mt-5" type="submit">Đăng nhập</button>
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
        $("form[name='registration']").validate({
            rules: {
                login_email: {
                    required: true,
                    email: true
                },
                login_password: {
                    required: true
                }
            },
            messages: {
                login_password: {
                    required: "*Password không được để trống!"
                },
                login_email: "*Email không được để trống! 'vd: ABC@gmail.com'"
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