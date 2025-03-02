<div class="card">
    <div class="card-header">Replies</div>
    <div class="card-body" id="chat-box">
        @foreach ($replies as $reply)
            <div class="message">{{ $reply->reply_message }}</div>
        @endforeach
    </div>
    <div class="card-footer">
        <form id="message-form">
            <div class="input-group">
            </div>
        </form>
    </div>
</div>