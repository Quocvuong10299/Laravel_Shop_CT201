@extends('master')
@section('content')
    <div class="container">
        <h3>Có {{count($data_search)}} kết quả được tìm thấy</h3>
        <div class="row">
            @foreach($data_search as $product_data)
                <div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                    <a href="{{route('productDetail', $product_data->product_id)}}" class="w-100">
                        <div class="scale__image overflow-hidden">
                            <img style="width:255px;height: 255px;" src="{{$product_data->product_image}}" class="product_hover"/>
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
@endsection
