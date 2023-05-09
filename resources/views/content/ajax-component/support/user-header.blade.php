    <div class="d-flex align-items-center">
        <div class="sidebar-toggle d-block d-lg-none mr-1">
            <i data-feather="menu" class="font-medium-5"></i>
        </div>
        <div class="avatar avatar-border user-profile-toggle m-0 mr-1">
            <img src="{{ $user->image ? asset($user) : 'https://ui-avatars.com/api/?name=' . $user->name }}"
                alt="avatar" height="36" width="36" />
        </div>
        <h6 class="mb-0">{{ $user->name }}</h6>
    </div>
    <div class="d-flex align-items-center">

    </div>
