<div class="slider position-relative w-100">
    <div class="slider__content w-100 container-fluid">
        @foreach($slides as $slide)
            <div class="slider__content--component">
                <img src="{{asset('storage/uploads/'.$slide->slide_link)}}">
            </div>
        @endforeach
    </div>
</div>