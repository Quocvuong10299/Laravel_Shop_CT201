@extends('master')
@section('content')
    @include('slide')
    <div class="main mt-5 container-fluid">
        <!--banner gender-->
        <div class="container">
            <div class="row">
                @foreach($gender as $prod_gender)
                <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 gender__component">
                    <div class="gender__component--image my-2">
                        <img src="/frontend/images/{{($prod_gender->category_gender_id===1) ? 'image1.webp' : 'image2.jpg'}}"/>
                        <a href="{{route('pageProductGender',$prod_gender->category_gender_id)}}">
                            <div class="overlay-image">
                                <div class="gender__component--title btn_1">
                                    <h5 class="text-dark font_1"> {{$prod_gender->category_gender_name}} </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 gender__component">
                        <div class="gender__component--image my-2">
                            <img src="/frontend/images/image3.webp"/>
                            <a href="{{route('getProductSale')}}">
                                <div class="overlay-image">
                                    <div class="gender__component--title btn_1">
                                        <h5 class="text-dark font_1"> Giảm Giá </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
            </div>
        </div>
        <!--end banner gender-->
        <!--sale products-->
        <div class="container mt-5">
            <h4 class="main__title--component"> Sản Phẩm Giảm Giá </h4>
            <div class="slider__products my-5">
                @foreach($data_sale as $sale)
                    <div class="slider__products--component position-relative">
                        <a href="{{route('productDetail', $sale->product_id)}}">
                            <div class="label-sale mx-2 my-3">
                                <p>-{{$sale->percent_value}}%</p>
                            </div>
                            <img style="height: 192px;" src="/storage/uploads/{{$sale->product_image}}"/>
                            <div class="info__products--component">
                                <h5>{{substr($sale->product_name,0,15).' . . .'}}</h5>
                                <div class="show__price d-flex">
                                    @if($sale->promotion_price > 0)
                                        <p class="header--price_1">{{number_format($sale->unit_price)}}
                                            <small>đ</small>
                                        </p>
                                        <p class="header--price_2">{{number_format($sale->promotion_price)}}
                                            <small>đ</small>
                                        </p>
                                    @else
                                        <p class="header--price_2">{{number_format($sale->unit_price)}}
                                            <small>đ</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!--end sale product-->
        <!--new products-->
        <div class="container my-5">
            <h4 class="main__title--component mb-5"> Sản Phẩm Mới</h4>
            <div class="row">
                @foreach($data as $product_data)
                    <div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                        <div class="label-sale mx-2 my-3 z-99">
                            <p>new</p>
                        </div>
                        <a href="{{route('productDetail', $product_data->product_id)}}" class="w-100">
                            <div class="scale__image overflow-hidden">
                                <img style="width:255px;height: 255px;" src="/storage/uploads/{{$product_data->product_image}}" class="product_hover"/>
                            </div>
                            <div class="info__products--component">
                                <h5>{{substr($product_data->product_name,0,15).' . . .'}}</h5>
                                <div class="show__price d-flex">
                                    @if($product_data->promotion_price > 0)
                                        <p class="header--price_1">{{number_format($product_data->unit_price)}}
                                            <small>đ</small>
                                        </p>
                                        <p class="header--price_2">{{number_format($product_data->promotion_price)}}
                                            <small>đ</small>
                                        </p>
                                    @else
                                        <p class="header--price_2">{{number_format($product_data->unit_price)}}
                                            <small>đ</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!--end new products-->
{{--        out client--}}
        <div class="container mt-5">
            @include('out_client')
        </div>
{{--        end out client--}}
        <!--start news-->
        <div class="container my-5">
            <h4 class="main__title--component mb-5">Bộ Sưu Tập</h4>
            <div class="row">
                <div class="col-12 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                    <img src="/frontend/images/gallery_item_4.webp"/>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                    <img src="/frontend/images/block_home_category2.webp"/>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                    <img src="/frontend/images/gallery_item_4.webp"/>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                    <img src="/frontend/images/gallery_item_4.webp"/>
                </div>
            </div>
        </div>
        <!--end news-->
    </div>
@endsection
