@extends('master')
@section('content')
    <div class="container">
        <form style="min-height: 60vh" action="{{route('postforgot')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email của bạn</label>
                <input type="email" name="emailforgot" class="form-control" id="emailforgot" aria-describedby="emailHelp" placeholder="Nhập địa chỉ email">
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
    </div>
@endsection
