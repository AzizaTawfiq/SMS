
    @foreach($getChat as $chat)
    @if($chat->sender_id == Auth::user()->id)
    <li class="clearfix">
        <div class="message-data text-right">
            <img src="{{$chat->getReceiver->getProfileDirect()}}"
                 alt="Sender img"
                 class="chat-avatar">
            <span class="message-data-time">{{Carbon\Carbon::parse($chat->created_date)->diffForHumans()}}</span>
        </div>
        <div class="message other-message float-right">
            <div>{!! $chat->message !!}</div>
        </div>
    </li>
    @else
    <li class="clearfix">
        <div class="message-data">
            <img src="{{$chat->getSender->getProfileDirect()}}"
                 alt="Receiver img"
                 class="chat-avatar">
            <span class="message-data-time">{{Carbon\Carbon::parse($chat->created_date)->diffForHumans()}}</span>
        </div>
        <div class="message my-message">{!! $chat->message !!}</div>
    </li>
    @endif
    @endforeach
