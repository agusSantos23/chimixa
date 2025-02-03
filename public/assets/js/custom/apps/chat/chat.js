"use strict";

var KTAppChat = function() {
    var handleSendMessage = function(e) {
        var messagesContainer = e.querySelector('[data-kt-element="messages"]');
        var inputElement = e.querySelector('[data-kt-element="input"]');

        if (inputElement.value.length !== 0) {
            var outgoingMessageTemplate = messagesContainer.querySelector('[data-kt-element="template-out"]');
            var incomingMessageTemplate = messagesContainer.querySelector('[data-kt-element="template-in"]');
            var newMessage;

            // Clone and update the outgoing message template
            newMessage = outgoingMessageTemplate.cloneNode(true);
            newMessage.classList.remove("d-none");
            newMessage.querySelector('[data-kt-element="message-text"]').innerText = inputElement.value;
            inputElement.value = "";
            messagesContainer.appendChild(newMessage);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            // Simulate receiving an incoming message after a delay
            setTimeout(function() {
                newMessage = incomingMessageTemplate.cloneNode(true);
                newMessage.classList.remove("d-none");
                newMessage.querySelector('[data-kt-element="message-text"]').innerText = "Thank you for your awesome support!";
                messagesContainer.appendChild(newMessage);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }, 2000);
        }
    };

    return {
        init: function(e) {
            var initializeChat = function(chatElement) {
                if (chatElement) {
                    // Handle sending a message on Enter key press
                    KTUtil.on(chatElement, '[data-kt-element="input"]', "keydown", function(event) {
                        if (event.keyCode === 13) {
                            handleSendMessage(chatElement);
                            event.preventDefault();
                            return false;
                        }
                    });

                    // Handle sending a message on Send button click
                    KTUtil.on(chatElement, '[data-kt-element="send"]', "click", function() {
                        handleSendMessage(chatElement);
                    });
                }
            };

            initializeChat(e);
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTAppChat.init(document.querySelector("#kt_chat_messenger"));
    KTAppChat.init(document.querySelector("#kt_drawer_chat_messenger"));
});
