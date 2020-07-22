@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="{{route('home')}}">Trang Chủ</a></li>
                    <li class="item__url--component"><a href="#">san-pham</a></li>
                    @foreach($price_detail as $detail)
                        <li class="item__url--component"><a>{{$detail->product_slug}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="main_detail mt-5">
                <div class="row">
                    @foreach($price_detail as $detail)
                        <div class="col-sm-12 col-md-6 col-lg-6 xs-12 col-xl-6">
                            <img id="prodImage" style="width: 100%; height: 100%" src="/storage/uploads/{{$detail->product_image}}"/>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 xs-12 col-xl-6">
                            <h4><strong id="prodName">{{$detail->product_name}}</strong></h4>
                            <small class="text-muted">SKU:<span id="sku" class="mx-2"></span></small>
                            <p class="m-0 text-success">còn hàng:<span id="sl"></span></p>
                            <div style="border: 1px dashed #DDD"></div>
                            <div class="mt-2 d-flex">
                                @if($detail->promotion_price > 0)
                                <p id="prodPrice" class="mr-3 my-0 has_sale">{{($detail->promotion_price)}} <small>đ</small></p>
                                    <p>Sale: -<span id="get_sale_value">{{$detail->percent_value}}</span>%</p>
                                <small class="ml-2 has_sale">
                                    <del id="get_sale_price">{{($detail->unit_price)}} <small>đ</small></del>
                                </small>
                                @else
                                    <p id="prodPrice" class="m-0">{{($detail->unit_price)}}</p><small>đ</small>
                                @endif
                            </div>
                            <div style="border: 1px dashed #DDD"></div>
                                <div class="mt-3">
                                    <p>Màu Sắc: <span class="ml-2" id="name_color"></span></p>
                                    <div class="colors__component">
                                        @foreach($uniqueColor as $key => $color)
                                            <input class="color--picker" {{$key == 0? 'checked' : ''}} id="{{$color->color_value}}" type="radio" name="color"
                                                   value="{{$color->color_value}}">
                                            <label class="mx-1 color" for="{{$color->color_value}}">
                                                <span class="click_color" style="background: {{$color->color_value}}"></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            <div style="border: 1px dashed #DDD"></div>
                            <form action='/select-size' method="get">
                               <div class="mt-3 d-flex">
                                   <p>Size:<span id="size_selected"></span></p>
                                   <div class="form-group select__component ml-3" style="width: 65px">
                                       <select id="selSize" class="form-control" name="size"></select>
                                   </div>
                               </div>
                            </form>
                            <div style="border: 1px dashed #DDD"></div>
                            <div class="input_quantity">
                                <p>Số Lượng:</p>
                               <div class="quantity">
                                   <button class="button">-</button>
                                   <input id="input_quantity" name="qty" type="number" max="" min="1" value="1" readonly="readonly">
                                   <button class="button">+</button>
                               </div>
                            </div>
                            <div id="add_to_cart" class="btn my-5">Thêm Vào Giỏ Hàng</div>

                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                   {!! $detail->product_description !!}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container my-5">
                <h4 class="main__title--component mb-5"> Bình Luận</h4>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-md-12 col-xl-12">
                        <div class="around__comment--component bg-light">
                           <div style="background: #fff" class="box-comment w-100 mb-3" id="show_comment">
                               {{--@foreach($comment as $cmt)--}}
                                   {{--<div class="d-flex mb-1 cmt_content">--}}
                                       {{--<div class="avatar d-flex justify-content-center align-items-center">--}}
                                           {{--<strong>V</strong>--}}
                                       {{--</div>--}}
                                       {{--<div>--}}
                                           {{--<div class="ml-3 content__comment--component">--}}
                                               {{--<small><strong>{{$cmt->User->user_name}}</strong></small>--}}
                                               {{--<div class="content__comments">--}}
                                                   {{--<span>{{$cmt->comment_content}}</span>--}}
                                               {{--</div>--}}
                                           {{--</div>--}}
                                           {{--<div class="time__post text-right">--}}
                                               {{--<small class="text-muted">{{\Carbon\Carbon::parse($cmt->created_at)->diffForHumans()}}</small>--}}
                                               {{--<small class="text-muted">{{getTimePost($cmt->created_at)}}</small>--}}
                                           {{--</div>--}}
                                       {{--</div>--}}
                                   {{--</div>--}}
                               {{--@endforeach--}}
                           </div>
                            <div id="pagination" class="d-flex justify-content-center my-2"></div>
                            <div>
                                @if(Auth::check() && Auth::user()->user_role == 0)
                                    <form action="{{route('postComment',request()->route('id'))}}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group d-flex">
                                            <textarea class="form-control" name="comment" id="comment"></textarea>
                                            <button type="submit" class="btn btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div>
                                    </form>

                                @else
                                    <p>Hãy đăng nhập để bình luận. <a href="{{route('getlogin')}}">Đăng nhập</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <div id="dataContainer"></div>
                <div id="demo"></div>
                {{--<div id="demo"></div>--}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/frontend/js/ajaxProductOption.js"></script>
    <script src="/frontend/js/cart.js"></script>
@endsection
