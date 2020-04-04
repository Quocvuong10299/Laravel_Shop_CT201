@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="{{route('home')}}">Trang Chủ</a></li>
                    <li class="item__url--component"><a href="#">{{request()->path()}}</a></li>
                </ul>
            </div>
            <div class="main_detail mt-5">
                <div class="row">
                    @foreach($product_detail as $detail)
                        <div class="col-sm-12 col-md-6 col-lg-6 xs-12 col-xl-6">
                            <img style="width: 100%; height: 100%" src="{{$detail->product_image}}"/>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 xs-12 col-xl-6">

                            <h4><strong>{{$detail->product_name}}</strong></h4>

                            <small class="text-muted">SKU:<span id="sku" class="mx-2"></span></small>
                            <p class="m-0">còn hàng:<span id="sl"></span></p>
                            <div class="d-flex">
                                <p class="mr-3 my-0">Giá: 210,000₫</p>
                                <small>
                                    <del>150,000đ</del>
                                </small>
                            </div>
                            <p>Giảm giá: ?%</p>
                            {{--<form action="{{route('selectColor')}}" method="GET">--}}
                                <div class="">
                                    <p>Màu Sắc:</p>
                                    <div class="colors__component">
                                        @foreach($uniqueColor as $key => $color)
                                            <input class="color--picker" {{$key == 0? 'checked' : ''}} id="{{$color->color_value}}" type="radio" name="color"
                                                   value="{{$color->color_value}}">
                                            <label class="active_color" for="{{$color->color_value}}">
                                                <span style="background: {{$color->color_value}}"></span>
                                            </label>

                                        @endforeach
                                    </div>
                                </div>
                               <div class="d-flex">
                                   <label>Kích Thước:</label>
                                   <div class="form-group select__component ml-3" style="width: 65px">
                                       <select id="selSize" class="form-control" name="size"></select>
                                   </div>
                               </div>
                            {{--</form>--}}
                            <div class="input_quantity">
                                <button>-</button>
                                <input type="number" max="100" min="1" value="1">
                                <button>+</button>
                            </div>
                            <div class="btn btn-success my-5">Thêm Vào Giỏ Hàng</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/frontend/js/ajaxProductOption.js"></script>
@endsection