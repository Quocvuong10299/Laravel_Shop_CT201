@extends('master')
@section('content')
    <!--start main-->
    <div class="main mt-5 container-fluid">
        <div class="container my-5">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="#">Trang Chủ</a></li>
                    <li class="item__url--component"><a href="#"> Sản Phẩm </a></li>
                    <li class="item__url--component"><a href="#"> A </a></li>
                </ul>
            </div>

            <div class="left__main">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="row">
                            @foreach($data_products as $data_product)
                                <div class="col-6 col-lg-3 col-md-3 col-xl-3 col-xs-6 col-sm-6 product__layout">
                                    <a href="{{route('productDetail', $data_product->product_id)}}" class="w-100">
                                        <div class="scale__image">
                                            <img style="width:100%;height: 183.75px;" src="{{$data_product->product_image}}"/>
                                        </div>
                                        <div class="info__products--component mt-2 p-0">
                                            <h5>{{substr($data_product->product_name,0,15).' . . .'}}</h5>
                                            <div class="show__price d-flex">
                                                @if($data_product->promotion_price > 0)
                                                    <p class="header--price_1">{{number_format($data_product->unit_price)}}
                                                        <small>đ</small>
                                                    </p>
                                                    <p class="header--price_2">{{number_format($data_product->promotion_price)}}
                                                        <small>đ</small>
                                                    </p>
                                                @else
                                                    <p class="header--price_2">{{number_format($data_product->unit_price)}}
                                                        <small>đ</small>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{$data_products->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection