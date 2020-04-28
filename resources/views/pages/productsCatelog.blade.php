@extends('master')
@section('content')
    <!--start main-->
    <div class="main mt-5 container-fluid">
        <div class="container my-5">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="#">Trang Chủ</a></li>
                    <li class="item__url--component"><a href="#"> All products </a></li>
                </ul>
            </div>

            <div class="left__main">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                        <div class="select__component">
                            <select name="select_sort" class="custom-select custom-select-sm" id="select_sort">
                                <option selected>chọn lọc </option>
                                <option value="asc"> Giá thấp đến cao </option>
                                <option value="desc"> Giá cao đến thấp </option>
                                {{--<option value="3"> Nhiều lượt xem </option>--}}
                            </select>
                        </div>
                        <div class="select-colors__component">
                            <p><strong>Thương Hiệu:</strong></p>
                            <div id="show_supplier" class="px-3 w-100" style="height: 200px; overflow-y: auto">
                                @foreach($uniqueSupplier as $supplier)
                                    <div>
                                        <input id="supplier_id" type="radio" name="check_supplier" value="{{$supplier->supplier_id}}">
                                        <label>{{$supplier->supplier_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                        <div class="row show_component" id="supplier_component">
                            {{--@foreach($product_gender as $data_product)--}}
                                {{--<div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">--}}
                                    {{--<a href="{{route('productDetail', $data_product->product_id)}}" class="w-100">--}}
                                        {{--<div class="scale__image">--}}
                                            {{--<img style="width:100%;height: 183.75px;" src="{{$data_product->product_image}}"/>--}}
                                        {{--</div>--}}
                                        {{--<div class="info__products--component mt-2 p-0">--}}
                                            {{--<h5>{{substr($data_product->product_name,0,15).' . . .'}}</h5>--}}
                                            {{--<div class="show__price d-flex">--}}
                                                {{--@if($data_product->promotion_price > 0)--}}
                                                    {{--<p class="header--price_1">{{number_format($data_product->unit_price)}}--}}
                                                        {{--<small>đ</small>--}}
                                                    {{--</p>--}}
                                                    {{--<p class="header--price_2">{{number_format($data_product->promotion_price)}}--}}
                                                        {{--<small>đ</small>--}}
                                                    {{--</p>--}}
                                                {{--@else--}}
                                                    {{--<p class="header--price_2">{{number_format($data_product->unit_price)}}--}}
                                                        {{--<small>đ</small>--}}
                                                    {{--</p>--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        </div>
                        {{--{{$product_gender->links()}}--}}
                        <div class="d-flex justify-content-center" id="pagination_gender"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="/frontend/js/cart.js"></script>
    <script src="/frontend/js/ajaxChooseSupplier.js"></script>
@endsection