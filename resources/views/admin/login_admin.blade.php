<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>admin kings-store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .field-input-wrapper.has-error input{
            border: 1px solid red!important;
        }
        .field-input-wrapper input{
            width: 30rem;
            height: 50px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .field-input-wrapper input:focus{
            border: 1px solid #1b1e21;
            outline: none;
        }
        .error{
            color: red;
        }
        .field-label{
            visibility: hidden;
        }
        .formset{
            top:50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .btn{
            border: 1px solid #ddd;
            background: #ddd;
            color: #fff;
        }
        .btn:hover{
            background: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <h4 class="main__title--component mb-5"> Đăng nhập Admin</h4>
            <div class="row">
                <div style="height: 50vh;" class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 position-relative">
                    <form action="{{route('postAdminLogin')}}" method="POST" name="admin_login">
                        @csrf
                        <div class="formset position-absolute">
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label">Email đăng nhập</label>
                                    <input placeholder="Email đăng nhập" autocapitalize="off" spellcheck="false" class="field-input" type="text" id="email" name="admin_email">
                                </div>
                            </div>
                            <div class="field field-required field-error ">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_address1">Password</label>
                                    <input placeholder="Mật khẩu" autocapitalize="off" spellcheck="false" class="field-input" type="password" id="login_password" name="admin_password">
                                </div>
                            </div>
                            <button id="loginBtn" class="btn mt-5" type="submit">Đăng nhập</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--@yield('content')--}}
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/frontend/js/jquery.validate.min.js"></script>
<script>
    $("form[name='admin_login']").validate({
        rules: {
            admin_email: {
                required: true,
                email: true
            },
            admin_password: {
                required: true
            }
        },
        messages: {
            admin_password: {
                required: "*Password không được để trống!"
            },
            admin_email: "*Email không được để trống! 'vd: admin@gmail.com'"
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
</body>
</html>