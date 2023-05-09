@forelse ($messages as $msg)
    @if ($msg->from === 'user')
        <div class="chat chat-left">
            <div class="chat-avatar">
                <span class="avatar box-shadow-1 cursor-pointer">
                    <img src="{{ $msg->user->image ? asset($msg->user) : 'https://ui-avatars.com/api/?name=' . $msg->user->name }}"
                        alt="avatar" height="36" width="36" />
                </span>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>
                        {{ $msg->message }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="chat ">
            <div class="chat-avatar">
                <span class="avatar box-shadow-1 cursor-pointer">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="avatar" height="36" width="36" />
                </span>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>
                        {{ $msg->message }}
                    </p>
                </div>
            </div>
        </div>
    @endif
@empty
@endforelse
