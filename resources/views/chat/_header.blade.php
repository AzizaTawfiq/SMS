<div class="row">
    <div class="col-lg-6">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
            <img src="{{$getReceiver->getProfileDirect()}}" alt="avatar">
        </a>
        <div class="chat-about">
            <h6 class="m-b-0">{{$getReceiver->name}} {{$getReceiver->last_name}}</h6>
            <small>Last seen: {{Carbon\Carbon::parse($getReceiver->updated_at)->diffForHumans()}}</small>
        </div>
    </div>
</div>

