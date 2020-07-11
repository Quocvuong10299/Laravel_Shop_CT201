<div class="header container-fluid d-flex w-100 ">
    <!--header-->
    <div class="container position-relative">
        <div class="header__wrapper d-flex justify-content-between">
            <div class="header__logo">
                <a href="{{route('home')}}">King's</a>
            </div>
            <div class="header__main-nav d-none d-lg-block position-relative">
                <nav>
                    <ul class="d-flex justify-content-center align-items-center my-0 px-0">
                        <div id="close"><i class="fa fa-times font-size25" aria-hidden="true"></i></div>
                        <li class="{{ request()->is('/*') ? 'active-menu' : '' }}">
                            <a href="{{route('home')}}"> Trang Chủ</a></li>
                        @foreach($category_gender as $cats_gender)
                            <li class="position-relative header__parent--sub {{ request()->is('/collections/1/6') ? 'active-menu' : '' }}"><a href="#">{{$cats_gender->category_gender_name}}</a>
                                @if($cats_gender->category_gender_id === 1)
                                    <ul class="header__sub p-3 rounded-bottom">
                                        @foreach($menus_men as $menu_men)
                                            @if($menu_men->childs->count() > 0)
                                                <li><strong>{{$menu_men->category_name }}</strong>
                                                    <ul class="header__sub--childs">
                                                        @foreach($menu_men->childs as $submenu)
                                                            @if($submenu->category_show === 1)
                                                                <li><a href="{{route('pageShowAllProduct',[$cats_gender->category_gender_id,$submenu->category_id])}}">
                                                                        {{$submenu->category_name}}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><strong>{{$menu_men->category_name }}</strong></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="header__sub p-3 rounded-bottom">
                                        @foreach($menus_women as $menu_women)
                                            @if($menu_men->childs->count() > 0)
                                                <li><strong>{{$menu_women->category_name }}</strong>
                                                    <ul class="header__sub--childs">
                                                        @foreach($menu_women->childs as $submenu)
                                                            @if($submenu->category_show === 1)
                                                                <li><a href="{{route('pageShowAllProduct',[$cats_gender->category_gender_id,$submenu->category_id])}}">
                                                                        {{$submenu->category_name}}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><strong>{{$menu_women->category_name }}</strong></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li><a href="#"> Giảm Giá </a></li>
                        <li class="{{ request()->is('more/*') ? 'active-menu' : '' }}"><a href="{{route('contactUS')}}"> Liên Hệ </a></li>
                    </ul>
                </nav>
            </div>
            <div class="header__icons d-flex">
                <div class="container-fluid d-flex header__pd--cart position-relative">
                    <div class="header__cart">
                        <i class="fa fa-shopping-bag position-relative" aria-hidden="true">
                            <span class="header--notify number_item"></span>
                        </i>

                        <div class="header__show-cart shadow-sm p-3 mb-5 bg-white rounded">
                            <div class="carts" style="width: 100%; height: 100px;overflow-y: auto"></div>
                            {{--show cart--}}
                            <div class="container-fluid total_cart px-0">
                                {{--show total cart--}}
                            </div>
                        </div>
                    </div>
                    <div class="header__search">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div class="header__user">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        @if(Auth::check() && Auth::user()->user_role == 0)
                            <div style="height: 50px;" class="header__user--show rounded-bottom bg-white">
                                <ul class="header__user--component w-100 px-0 my-0">
                                    <li><a href="{{route('getlogout')}}">Đăng xuất {{Auth::user()->user_name}}</a></li>
                                </ul>
                            </div>
                        @else
                            <div class="header__user--show rounded-bottom bg-white">
                                <ul class="header__user--component w-100 px-0 my-0">
                                    <li><a href="{{route('getlogin')}}">Đăng Nhập</a></li>
                                    <li><a href="{{route('getregister')}}">Đăng Kí</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="icon-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <!--search overlay-->
        <div class="header__overlay">
            <div class="overlay"></div>
            <div class="header__search--content position-relative w-75">
                <form action="{{route('search_content')}}" method="GET" class="form-inline d-flex justify-content-center">
                    <input class="form-control form-control-sm w-100" type="text" placeholder=" Tìm kiếm "
                           aria-label="Search" name="search" id="search">
                </form>
                <div id="show_search_content" class="invisible bg bg-light" style="width: 100%; height: 200px; overflow-y: auto">

                </div>
            </div>
        </div>
        <!--end search overlay-->
    </div>
    <!--end header-->
</div>
@section('js')
<script src="/frontend/js/cart.js"></script>
@endsection
