<div class="chat-header clearfix">
@include('chat._header')
</div>
<div class="chat-history">
@include('chat._chat')
</div>
<div class="chat-message clearfix">
    <form action="" id="submit_message" method="post" class="mb-0">
        <input type="hidden" name="receiver_id" value="{{$getReceiver->id}}"/>
    {{ csrf_field() }}
        <div>
            <textarea name="message" id="clearMessage" class="form-control"></textarea>
        </div>
        <div class="row">
        <div class="col-md-6 hidden-sm  mt-3">
        <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
    </div>
            <div class="col-md-6 text-end mt-3">
                <button class="btn btn-primary" type="submit">send</button>
            </div>
        </div>

    </form>
</div>

