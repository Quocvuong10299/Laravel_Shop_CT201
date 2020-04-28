@foreach($comment as $cmt)
<div class="d-flex mb-1 cmt_content">
<div class="avatar d-flex justify-content-center align-items-center">
<strong>V</strong>
</div>
<div>
<div class="ml-3 content__comment--component">
<small><strong>{{$cmt->user_name}}</strong></small>
<div class="content__comments">
<span>{{$cmt->comment_content}}</span>
</div>
</div>
<div class="time__post text-right">
<small class="text-muted">{{\Carbon\Carbon::parse($cmt->created_at)->diffForHumans()}}</small>
<small class="text-muted">{{getTimePost($cmt->created_at)}}</small>
</div>
</div>
</div>
@endforeach