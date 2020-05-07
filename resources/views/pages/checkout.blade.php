@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="#">Trang Chủ</a></li>
                    <li class="item__url--component"><a> Đặt hàng </a></li>
                </ul>
            </div>
            <h4 class="main__title--component mb-5"> Đặt hàng</h4>
            <div id="mess_checkout">

            </div>
            <form action="{{route('postCheckOuts')}}" method="POST" id="form_checkout" name="form_checkout">
                @csrf
                <div class="row w-100">

                        <div class="w-100 col-sm-12 col-md-8 col-lg-8 col-xs-12 col-xl-8">
                        <h4 class=""> Thông tin đơn hàng</h4>
                        {{--<p>Bạn đã có tài khoản? <a href="#"><strong>Đăng nhập</strong></a></p>--}}
                        <div class="fieldset">
                            <div class="field field-required field-error">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_full_name">Họ và tên</label>
                                    <input placeholder="Họ và tên" autocapitalize="off" spellcheck="false" class="field-input" type="text" id="order_name" name="order_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 col-xl-6 field  field-two-thirds field-error">
                                    <div class="field-input-wrapper">
                                        <label class="field-label" for="checkout_user_email">Email</label>
                                        <input placeholder="Email" autocapitalize="off" spellcheck="false" class="field-input" type="email" id="order_email" name="order_email">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 col-xl-6 field field-required field-third field-error ">
                                    <div class="field-input-wrapper">
                                        <label class="field-label" for="billing_address_phone">Số điện thoại</label>
                                        <input placeholder="Số điện thoại" autocapitalize="off" spellcheck="false" class="field-input" type="tel" id="order_phone" name="order_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="field field-required field-error ">
                                <div class="field-input-wrapper">
                                    <label class="field-label" for="billing_address_address1">Địa chỉ</label>
                                    <input placeholder="Địa chỉ" autocapitalize="off" spellcheck="false" class="field-input" type="text" id="order_address" name="order_address">
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-12 col-md-4 col-lg-4 col-xs-12 col-xl-4 fields field-show-floating-label field-required field-third">--}}
                                    {{--<div class="field-input-wrapper field-input-wrapper-select">--}}
                                        {{--<select id="city" name="city">--}}
                                            {{--<option data-code="null" value="" selected="">  Chọn tỉnh / thành </option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-12 col-md-4 col-lg-4 col-xs-12 col-xl-4 fields field-show-floating-label field-required field-third">--}}
                                    {{--<div class="field-input-wrapper field-input-wrapper-select">--}}
                                        {{--<select>--}}
                                            {{--<option data-code="null" value="" selected="" id="district">  Chọn quận / huyện </option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-12 col-md-4 col-lg-4 col-xs-12 col-xl-4 fields field-show-floating-label field-required field-third">--}}
                                    {{--<div class="field-input-wrapper field-input-wrapper-select">--}}
                                        {{--<select>--}}
                                            {{--<option data-code="null" value="" selected="" id="ward">  Chọn phường / xã </option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <h4 class="mt-5"> Phương thức thanh toán</h4>
                        <div class="section-content">
                            <div class="content-box">
                                <div class="radio-wrapper content-box-row">
                                    @foreach($payment as $choosepay)
                                        <label class="radio-label d-flex">
                                            <div class="radio-input">
                                                <input id="order_payment" class="input-radio" name="order_payment" type="radio" value="{{$choosepay->payment_id}}" checked="">
                                            </div>
                                            <span class="radio-label-primary">{{$choosepay->payment_content}}</span>
                                        </label>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <h4 class="mt-5"> Ghi chú</h4>
                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label style="opacity: 0" for="exampleFormControlTextarea1"> Ghi chú: </label>
                                    <textarea id="order_note" name="order_note" class="form-control p-2"></textarea>
                                </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 col-xl-12">
                            <div style="border: 1px solid #DDDDDD;" class="mt-4"></div>
                            <div class="d-flex justify-content-between">
                                <div class="mt-5">
                                    <h5>Tổng cộng:VND <input style="border: 0" readonly="readonly" value="" id="order_total" name="order_total"></h5>
                                </div>
                                <button type="submit" class="btn mt-4" id="btn-submit_checkouts">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4 col-lg-4 col-xs-12 col-xl-4">
                        <h4 class=""> Sản phẩm mua</h4>
                        <div class="bg bg-light" id="render_lastcart" style="height:100vh; overflow-y: auto">
                           {{--show by jquery--}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="/frontend/js/jquery.validate.min.js"></script>
    <script src="/frontend/js/cart.js"></script>
    <script>
        $("#form_checkout").validate({
            rules: {
                order_email: {
                    required: true,
                    email: true
                },
                order_name: {
                    required: true,
                    maxlength:30
                },
                order_phone: {
                    required: true,
                    digits: true,
                    maxlength:11,
                },
                order_address: {
                    required: true
                },
            },
            messages: {
                order_name: {
                    required: "*Password không được để trống!",
                    maxlength:"*Tên không được vượt quá 30 kí tự",
                },
                order_email: "*Email không được để trống! 'vd: ABC@gmail.com'",
                order_address:"*Địa chỉ không được để trống",
                order_phone:{
                    digits:"Số điện thoại phải là số",
                    required: "Số điện thoại không được để trống",
                    maxlength: "Số điện thoại không được quá 11 số",
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
    {{--<script src="/frontend/js/ajaxChooseCity.js"></script>--}}
@endsection