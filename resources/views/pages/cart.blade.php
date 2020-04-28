@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="#">Trang Chủ</a></li>
                    <li class="item__url--component"><a> Giỏ hàng </a></li>
                </ul>
            </div>
            <h4 class="main__title--component mb-5"> Giỏ Hàng Của Bạn</h4>
            <div class="cart__content">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-2 col-xl-5 font-weight-bold">Tên Sản Phẩm</div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 font-weight-bold">Số Lượng</div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 font-weight-bold">Thành Tiền</div>
                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-2 col-xl-1 font-weight-bold"></div>
                </div>
                <div class="col__content-cart cart_component">
                    {{--show by js --}}
                </div>
            </div>
            <div class="cart__checkout mt-5">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 d-flex justify-content-center align-items-end flex-column">
                        {{--<h5> Tổng Tiền: <strong>120.000 VND</strong> </h5>--}}
                        <div class="show_total_price"></div>
                        <div class="d-flex">
                            <a href="{{route('home')}}"><button class="btn mx-2"> Tiếp Tục Mua Hàng </button></a>
                            <a id="auto-hide" href="{{route('checkOuts')}}"><button class="btn"> Đặt hàng </button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div style="height: 50vh" class="cart__content">-->
            <!--<h2 style="color: #545454; font-size: 24px;"> Giỏ Hàng Trống ( 0 Sản Phẩm)-->
            <!--<i class="fa fa-frown-o" aria-hidden="true"></i>-->
            <!--</h2>-->
            <!--</div>-->
        </div>
    </div>
@endsection
@section('js')
    {{--<script src="/frontend/js/cartComponent.js"></script>--}}
    <script src="/frontend/js/cart.js"></script>
@endsection