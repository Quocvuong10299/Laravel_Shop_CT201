@extends('master')
@section('content')
    <div class="main mt-5 container-fluid pt-2">
        <div class="container my-5 cart">
            <div class="line__url--component">
                <ul class="d-flex list__url--component px-2">
                    <li class="item__url--component"><a href="#">Trang Chủ</a></li>
                    <li class="item__url--component"><a> Liên hệ </a></li>
                </ul>
            </div>
            <h4 class="main__title--component mb-5"> Liên hệ</h4>
            <form>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7 col-xs-12 col-xl-7">
                        <h3 class="mb-3"><strong>Bản đồ</strong></h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8299322948283!2d105.76681311418825!3d10.030888975255351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883d2192b0f1%3A0x4c90a391d232ccce!2zS2hvYSBDw7RuZyBOZ2jhu4cgVGjDtG5nIFRpbiB2w6AgVHJ1eeG7gW4gVGjDtG5nIChDVFUp!5e0!3m2!1svi!2s!4v1586706745881!5m2!1svi!2s" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 col-xs-12 col-xl-5">
                        <h3 class="mb-3"><strong>Liên Hệ</strong></h3>
                        <h4 class="mb-3"> Địa chỉ chúng tôi</h4>
                        <p class="pl-1">DI17Z6A1 - CTU - TPCT</p>
                        <h4 class="mb-3"> Email chúng tôi</h4>
                        <p class="pl-1">vuongB1709583@student.ctu.edu.vn</p>
                        <h4 class="mb-3"> Điện thoại</h4>
                        <p class="pl-1">0363525336</p>
                        <h4 class="mb-3"> Thời gian làm việc</h4>
                        <p class="pl-1">9:30 đến 21:00 (Tất cả các ngày trong tuần)</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection