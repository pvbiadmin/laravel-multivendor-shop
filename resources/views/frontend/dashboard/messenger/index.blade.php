@extends( 'frontend.dashboard.layouts.master' )

@section( 'title' )
    {{ $settings->site_name }} || Messages
@endsection

@section( 'content' )
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include( 'frontend.dashboard.layouts.sidebar' )
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fas fa-comments-alt" aria-hidden="true"></i> Messages</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start" style="height: 516px">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                             aria-orientation="vertical">
                                            <h2>Seller List</h2>
                                            <div class="wsus__chatlist_body overflow-auto"
                                                 style="width: auto; max-height: 400px;">
                                                @foreach ( $chatUsers as $chatUser )
                                                    @php
                                                        $unseenMessages = \App\Models\Chat::query()
                                                            ->where([
                                                                'sender_id' => $chatUser->receiverProfile->id,
                                                                'receiver_id' => auth()->user()->id,
                                                                'seen' => 0
                                                            ])->exists();
                                                    @endphp
                                                    <button class="nav-link chat-user-profile"
                                                            data-id="{{ $chatUser->receiverProfile->id }}"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                                            aria-controls="v-pills-home" aria-selected="true">
                                                        <div
                                                            class="wsus_chat_list_img {{ $unseenMessages
                                                                ? 'msg-notification' : ''}}">
                                                            <img src="{{ asset($chatUser->receiverProfile->image) }}"
                                                                 alt="user" class="img-fluid">
                                                            <span class="pending d-none" id="pending-6">0</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4>{{ $chatUser->receiverProfile->vendor->shop_name }}</h4>
                                                        </div>
                                                    </button>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area" style="height: 516px">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                                 aria-labelledby="v-pills-home-tab">
                                                <div id="chat_box">
                                                    <div class="wsus__chat_area" style="position: relative;
                                                        height: 70vh;">

                                                        <div class="wsus__chat_area_header">
                                                            <h2 id="chat-inbox-title"></h2>
                                                        </div>

                                                        <div class="wsus__chat_area_body overflow-auto" data-inbox=""
                                                             style="width: auto; max-height: 400px;"></div>

                                                        <div class="wsus__chat_area_footer"
                                                             style="position: absolute; width: 100%; bottom: 0;">
                                                            <form id="message-form">
                                                                @csrf
                                                                <input type="text" placeholder="Type Message"
                                                                       class="message-box" autocomplete="off"
                                                                       name="message" aria-label="message">
                                                                <input type="hidden" name="receiver_id"
                                                                       id="receiver_id">
                                                                <button type="submit">
                                                                    <i class="fas fa-paper-plane send-button"
                                                                       aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push ( 'scripts' )
    <script>
        ($ => {
            $(() => {
                const $body = $("body");
                const $mainChatInbox = $(".wsus__chat_area_body");
                const $messageBox = $(".message-box");

                const formatDateTime = dateTimeString => {
                    const options = {
                        year: 'numeric',
                        month: 'short',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit'
                    }

                    return new Intl.DateTimeFormat('en-Us', options)
                        .format(new Date(dateTimeString));
                }

                const scrollToBottom = () => {
                    $mainChatInbox.scrollTop($mainChatInbox.prop("scrollHeight"));
                }

                const viewChat = () => {
                    $body.on("click", ".chat-user-profile", e => {
                        const $this = $(e.currentTarget);

                        const receiverId = $this.data("id");
                        const senderImage = $this.find("img").attr("src");
                        const chatUserName = $this.find("h4").text();

                        $mainChatInbox.attr("data-inbox", receiverId);

                        $("#receiver_id").val(receiverId);
                        $this.find(".wsus_chat_list_img").removeClass("msg-notification");

                        $.ajax({
                            method: "GET",
                            url: '{{ route("user.get-messages") }}',
                            data: {
                                receiver_id: receiverId
                            },
                            beforeSend: () => {
                                $mainChatInbox.html("");
                                $("#chat-inbox-title").text(`Chat With ${chatUserName}`)
                            },
                            success: response => {
                                $.each(response, (index, value) => {
                                    const {USER} = window;
                                    const {sender_id, message, created_at} = value;

                                    let chat;

                                    if (sender_id.toString() === USER.id.toString()) {
                                        chat = `<div class="wsus__chat_single single_chat_2">
                                                <div class="wsus__chat_single_img">
                                                    <img src="${USER.image}"
                                                        alt="user" class="img-fluid">
                                                </div>
                                                <div class="wsus__chat_single_text">
                                                    <p>${message}</p>
                                                    <span>${formatDateTime(created_at)}</span>
                                                </div>
                                            </div>`;
                                    } else {
                                        chat = `<div class="wsus__chat_single">
                                                <div class="wsus__chat_single_img">
                                                    <img src="${senderImage}"
                                                        alt="user" class="img-fluid">
                                                </div>
                                                <div class="wsus__chat_single_text">
                                                    <p>${message}</p>
                                                    <span>${formatDateTime(created_at)}</span>
                                                </div>
                                            </div>`;
                                    }

                                    $mainChatInbox.append(chat);
                                });

                                scrollToBottom();
                            },
                            error: (xhr, status, error) => {
                                console.log(xhr, status, error);
                            },
                            complete: () => {

                            }
                        });
                    });
                }

                const sendChat = () => {
                    $body.on("submit", "#message-form", e => {
                        e.preventDefault();

                        const $this = $(e.currentTarget);
                        const formData = $this.serialize();
                        const messageData = $messageBox.val();

                        let formSubmitting = false;

                        if (formSubmitting || messageData === "") {
                            return;
                        }

                        const {USER} = window;

                        let message = `<div class="wsus__chat_single single_chat_2">
                                <div class="wsus__chat_single_img mb-2">
                                    <img src="${USER.image}"
                                        alt="user" class="img-fluid">
                                </div>
                                <div class="wsus__chat_single_text">
                                    <p>${messageData}</p>
                                </div>
                            </div>`;

                        $mainChatInbox.append(message);
                        $messageBox.val("");
                        scrollToBottom()

                        $.ajax({
                            method: "POST",
                            url: '{{ route("user.send-message") }}',
                            data: formData,
                            beforeSend: () => {
                                $(".send-button").prop("disabled", true);
                                formSubmitting = true;
                            },
                            success: () => {
                            },
                            error: (xhr, status, error) => {
                                console.log(xhr, status, error);
                                toastr.error(error);
                                $(".send-button").prop("disabled", false);
                                formSubmitting = false;
                            },
                            complete: () => {
                                $(".send-button").prop("disabled", false);
                                formSubmitting = false;
                            }
                        });
                    });
                }

                viewChat();
                sendChat();
            });
        })(jQuery);
    </script>
@endpush
