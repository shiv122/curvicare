@section('content-sidebar')
    <div class="chat-profile-sidebar">
        <header class="chat-profile-header">
            <span class="close-icon">
                <i data-feather="x"></i>
            </span>
            <div class="header-profile-sidebar">
                <div class="avatar box-shadow-1 avatar-xl avatar-border">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="user_avatar" />
                </div>
                <h4 class="chat-user-name">John Doe</h4>
                <span class="user-post">Admin</span>
            </div>
        </header>
        {{-- <div class="profile-sidebar-area">
            <h6 class="section-label mb-1">About</h6>
            <div class="about-user">
                <textarea data-length="120" class="form-control char-textarea" id="textarea-counter" rows="5"
                    placeholder="About User">Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.</textarea>
                <small class="counter-value float-right"><span class="char-count">108</span> / 120 </small>
            </div>
            <h6 class="section-label mb-1 mt-3">Status</h6>
            <ul class="list-unstyled user-status">
                <li class="pb-1">
                    <div class="custom-control custom-control-success custom-radio">
                        <input type="radio" id="activeStatusRadio" name="userStatus" class="custom-control-input"
                            value="online" checked />
                        <label class="custom-control-label ml-25" for="activeStatusRadio">Active</label>
                    </div>
                </li>
                <li class="pb-1">
                    <div class="custom-control custom-control-danger custom-radio">
                        <input type="radio" id="dndStatusRadio" name="userStatus" class="custom-control-input"
                            value="busy" />
                        <label class="custom-control-label ml-25" for="dndStatusRadio">Do Not Disturb</label>
                    </div>
                </li>
                <li class="pb-1">
                    <div class="custom-control custom-control-warning custom-radio">
                        <input type="radio" id="awayStatusRadio" name="userStatus" class="custom-control-input"
                            value="away" />
                        <label class="custom-control-label ml-25" for="awayStatusRadio">Away</label>
                    </div>
                </li>
                <li class="pb-1">
                    <div class="custom-control custom-control-secondary custom-radio">
                        <input type="radio" id="offlineStatusRadio" name="userStatus" class="custom-control-input"
                            value="offline" />
                        <label class="custom-control-label ml-25" for="offlineStatusRadio">Offline</label>
                    </div>
                </li>
            </ul>

            <h6 class="section-label mb-1 mt-2">Settings</h6>
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between align-items-center mb-1">
                    <div class="d-flex align-items-center">
                        <i data-feather="check-square" class="mr-75 font-medium-3"></i>
                        <span class="align-middle">Two-step Verification</span>
                    </div>
                    <div class="custom-control custom-switch mr-0">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked />
                        <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-1">
                    <div class="d-flex align-items-center">
                        <i data-feather="bell" class="mr-75 font-medium-3"></i>
                        <span class="align-middle">Notification</span>
                    </div>
                    <div class="custom-control custom-switch mr-0">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" />
                        <label class="custom-control-label" for="customSwitch2"></label>
                    </div>
                </li>
                <li class="mb-1 d-flex align-items-center cursor-pointer">
                    <i data-feather="user" class="mr-75 font-medium-3"></i>
                    <span class="align-middle">Invite Friends</span>
                </li>
                <li class="d-flex align-items-center cursor-pointer">
                    <i data-feather="trash" class="mr-75 font-medium-3"></i>
                    <span class="align-middle">Delete Account</span>
                </li>
            </ul>

            <div class="mt-3">
                <button class="btn btn-primary">
                    <span>Logout</span>
                </button>
            </div>
        </div> --}}
    </div>

    <div class="sidebar-content">
        <span class="sidebar-close-icon">
            <i data-feather="x"></i>
        </span>
        <div class="chat-fixed-search">
            <div class="d-flex align-items-center w-100">
                <div class="sidebar-profile-toggle">
                    <div class="avatar avatar-border">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="user_avatar" height="42" width="42" />
                    </div>
                </div>
                <div class="input-group input-group-merge ml-1 w-100">
                    <div class="input-group-prepend">
                        <span class="input-group-text round"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                    <input type="text" class="form-control round" id="chat-search"
                        placeholder="Search or start a new chat" aria-label="Search..." aria-describedby="chat-search" />
                </div>
            </div>
        </div>

        <div id="users-list" class="chat-user-list-wrapper list-group">
            <h4 class="chat-list-title">Chats</h4>
            <ul class="chat-users-list chat-list media-list">
                @forelse ($chats as $chat)
                    <li data-user="{{ $chat->user_id }}">
                        <span class="avatar"><img
                                src="{{ $chat->user->image ? asset($chat->user) : 'https://ui-avatars.com/api/?name=' . $chat->user->name }}"
                                height="42" width="42" alt="Generic placeholder image" />
                        </span>
                        <div class="chat-info flex-grow-1">
                            <h5 class="mb-0">{{ $chat->user->name }}</h5>
                            <p class="card-text text-truncate">
                                {{ $chat->message }}
                            </p>
                        </div>
                        <div class="chat-meta text-nowrap">
                            {{-- <small class="float-right mb-25 chat-time">{{ $chat->created_at->format('d-m H:i A') }}</small> --}}
                            @if ($chat->user->unread > 0)
                                <span data-unread
                                    class="badge badge-danger badge-pill float-right">{{ $chat->user->unread }}</span>
                            @endif
                        </div>
                    </li>
                @empty
                @endforelse
            </ul>

        </div>
    </div>
@endsection
