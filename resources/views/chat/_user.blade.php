@foreach ($getChatUser as $user)
<li class="clearfix getChatWindows" id="{{$user['user_id']}}">
        <img src="{{$user['profile_pic']}}" alt="avatar">
        <div class="about">
            <div class="name">{{$user['name']}}
                @if(!empty($user['messageCount']))
                <span id="clearMessage{{$user['user_id']}}" class="bg-primary text-white" style="border-radius:5px; padding:1px 7px">{{$user['messageCount']}}</span>
                @endif
            </div>
            <div class="status"> <i class="fa fa-circle offline"></i> {{Carbon\Carbon::parse($user['created_date'])->diffForHumans()}} </div>
        </div>
</li>
@endforeach
<!-- <li class="clearfix active">
    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
    <div class="about">
        <div class="name">Aiden Chavez</div>
        <div class="status"> <i class="fa fa-circle online"></i> online </div>
    </div>
</li> -->
