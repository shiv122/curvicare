@forelse ($chats as $chat)
    <li data-user="{{ $chat->user_id }}">

        @if ($chat->user->image)
            <span class="avatar"><img src="{{ asset($chat->user->image) }}" height="42" width="42"
                    alt="Generic placeholder image" />
            </span>
        @else
            <div class="avatar bg-primary">
                <div class="avatar-content">PI</div>
            </div>
        @endif
        <div class="chat-info flex-grow-1">
            <h5 class="mb-0">{{ $chat->user->name }}</h5>
            <p class="card-text text-truncate">
                {{ $chat->message }}
            </p>
        </div>
        <div class="chat-meta text-nowrap">
            {{-- <small class="float-right mb-25 chat-time">{{ $chat->created_at->format('d-m H:i A') }}</small> --}}
            @if ($chat->user->unread > 0)
                <span data-unread class="badge badge-danger badge-pill float-right">{{ $chat->user->unread }}</span>
            @endif
        </div>
    </li>
@empty
@endforelse
