@extends('layouts/contentLayoutMaster')

@section('title', 'Chat Application')

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-chat-list.css')) }}">
    <style>
        .chat-application .sidebar-content .chat-user-list-wrapper .avatar {
            height: 42px;
            width: 42px;
        }

        .chat-application .sidebar-content .avatar .avatar-content {
            height: 42px;
            width: 42px;
        }
    </style>
@endsection
@include('content/pages/support/chat-sidebar')
@section('content')
    <div class="body-content-overlay"></div>
    <!-- Main chat area -->
    <section class="chat-app-window">
        <!-- To load Conversation -->
        <div class="start-chat-area">
            <div class="mb-1 start-chat-icon">
                <i data-feather="message-square"></i>
            </div>
            <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
        </div>
        <!--/ To load Conversation -->

        <!-- Active Chat -->
        <div class="active-chat d-none">
            <!-- Chat Header -->
            <div id="chat-header" class="chat-navbar">
                <header class="chat-header">
                </header>
            </div>
            <!--/ Chat Header -->

            <!-- User Chat messages -->
            <div style="overflow-x: auto;" class="user-chats">
                <div id="user-chats" class="chats">


                </div>
            </div>
            <!-- User Chat messages -->

            <!-- Submit Chat form -->
            <form class="chat-app-form" id="send-message-form">
                @csrf
                <div class="input-group input-group-merge mr-1 form-send-message">
                    <input type="text" class="form-control message" name="message" id="message"
                        placeholder="Type your message or use speech to text" />

                    {{-- <div class="input-group-append">
                        <span class="input-group-text">
                            <label for="attach-doc" class="attachment-icon mb-0">
                                <i data-feather="image" class="cursor-pointer lighten-2 text-secondary"></i>
                                <input name="file" accept="image/*" type="file" id="attach-doc" hidden />
                            </label></span>
                    </div> --}}
                </div>
                <button type="submit" class="btn btn-primary send">
                    <i data-feather="send" class="d-lg-none"></i>
                    <span class="d-none d-lg-block">Send</span>
                </button>
            </form>
            <!--/ Submit Chat form -->
        </div>
        <!--/ Active Chat -->
    </section>
    <!--/ Main chat area -->


@endsection

@section('page-script')
    <!-- Page js files -->
    <script>
        let pagination = 1;
        let current_user;
        let loading = false;
        let is_last_page = false;






        $(document).on('click', '.chat-users-list > li', function() {

            if ($(this).hasClass('custom-active')) {
                return;
            } else {
                $('.chat-users-list > li').removeClass('active custom-active');
                $(this).addClass('active custom-active');
            }

            const user = $(this).data('user');
            current_user = user;
            is_last_page = false;
            loading = false;
            pagination = 1;
            fetchMessage(user, 1);
        });

        function fetchMessage(user, page = 1, reset = true) {

            if (loading) {
                return
            }
            if (is_last_page) {
                // snb('warning', 'No more message', 'There are no messages lest to show');
                return;
            }

            loading = true;
            blockDiv('.active-chat');
            $.ajax({
                type: "get",
                url: "{{ route('admin.chat.by-user') }}",
                data: {
                    user: user,
                    page: page
                },
                success: function(response) {
                    // console.log(response);
                    unblockDiv('.active-chat');
                    is_last_page = response.is_last_page
                    $('#chat-header header').html(response.header);
                    if (reset) {

                        $('#user-chats').html(response.messages);
                    } else {

                        $('#user-chats').prepend(response.messages);
                    }
                    loading = false;

                },
                error: function(error) {
                    loading = false;
                    unblockDiv('.active-chat');
                    console.error(error);
                }
            });
        }


        $('#send-message-form').submit(function(e) {
            e.preventDefault();
            const user = $('.chat-users-list > li.active').data('user');
            const image = $('#file')[0];
            const message = $('#message').val();
            let formData = new FormData($(this)[0]);
            formData.append('user', user);
            appendMessage(message)
            $(this)[0].reset();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.chat.send') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.error(response);
                }
            });
        });



        function appendMessage(msg, img = null) {
            let message = `<div class="chat">
                                <div class="chat-avatar">
                                    <span class="avatar box-shadow-1 cursor-pointer">
                                        <img src="{{ asset('images/logo/logo.png') }}" alt="avatar" height="36" width="36" />
                                    </span>
                                </div>
                                <div class="chat-body">
                                    <div class="chat-content">
                                        <p>
                                            ${msg}
                                        </p>
                                    </div>
                                </div>
                            </div>`;

            $("#user-chats").append(message);

            const $divElement = $('.user-chats');


            $divElement.animate({
                scrollTop: $divElement.prop('scrollHeight')
            }, 500);
        }

        $('.user-chats').scroll(function(event) {
            var scroll = $('.user-chats').scrollTop();
            if (scroll === 0) {
                fetchMessage(current_user, ++pagination, false)
            }
        });


        // function refetchUsers() {

        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('admin.chat.index') }}",
        //         data: "",
        //         success: function(response) {
        //             if ($('#users-list .chat-users-list').html() !== response) {

        //                 $('#users-list .chat-users-list').html(response);
        //             }
        //         },
        //         error: function(response) {
        //             snb('error', 'Error', 'Somting went wrong while updating users list');
        //         }
        //     });


        //     setTimeout(() => {
        //         // refetchUsers()
        //     }, 5000);
        // }
        // refetchUsers();
    </script>
    <script defer src="{{ asset(mix('js/scripts/pages/app-chat.js')) }}"></script>
@endsection
