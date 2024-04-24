($ => {
    $(() => {
        const mainChatInbox = $(".wsus__chat_area_body");

        const formatDateTime = dateTimeString => {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            }

            return new Intl.DateTimeFormat('en-Us', options).format(new Date(dateTimeString));
        }

        const scrollToBottom = () => {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
        }

        let {Echo, USER} = window;

        Echo.private("message." + USER.id).listen(
            "ChatMessageEvent",
            e => {
                console.log(e);

                const {sender_id, sender_image, message, date_time} = e;

                if (mainChatInbox.attr('data-inbox').toString() === sender_id.toString()) {
                    const chat = `<div class="wsus__chat_single">
                            <div class="wsus__chat_single_img">
                                <img src="${sender_image}" alt="user" class="img-fluid">
                            </div>
                            <div class="wsus__chat_single_text">
                                <p>${message}</p>
                                <span>${formatDateTime(date_time)}</span>
                            </div>
                        </div>`;

                    mainChatInbox.append(chat);
                    scrollToBottom();

                    // add notification circle in profile
                    $(".chat-user-profile").each(e => {
                        const $this = $(e.currentTarget);
                        const profileUserId = $this.data("id");

                        if (profileUserId.toString() === sender_id.toString()) {
                            $this.find(".wsus_chat_list_img").addClass("msg-notification");
                        }
                    });
                }
            }
        );
    });
})(jQuery);
