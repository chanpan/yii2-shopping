// Settings
var base_path = window.location.origin + "/api/chat/rest"; // path to API
var enableChatInvitation = true; // true for enable chat invitation
var chat_inv_time = '20000'; // Time to display chat invitation
var org_id = '00D28000000aMjq'; //PROD:00D28000000aMjq TEST:00DO0000005507G UAT:s00D0k000000CsTa
var deployment_id = '57228000000L3Yn';
var button_id = (langjs == "th") ? '573280000004HeT' : '573280000004H3t';
var screenWidth = $(document).width();

// Others
var chatWindowState = 'hidden';
var notification = 0;
var sfversion = '38';
var sfToken = '';
var sfKey = '';
var sfId = '';
var sequence = 1;
var ack = -1;
var standardChatButton = [];
var inviteChatButton = [];
var standard_button_id = '';
var inv_button_id = '';
var currentChatter;
var AgentTypingTimeout;
var typingTimeout;
var typingInterval;
var chat_inv_init;
var typing = false;

function getSettings() {
    $.ajax({
        method: "POST",
        url: base_path + "/Visitor/Settings",
        data: {
            'X-LIVEAGENT-API-VERSION': sfversion,
            'org_id': org_id,
            'deployment_id': deployment_id,
            'Settings.buttonIds': button_id,
            'Settings.updateBreadcrumb': window.location.href
        }
    })
    .done(function (data) {
		console.log(data);
        for (i = 0; i < data.messages.length; i++) {
            for (b = 0; b < data.messages[i].message.buttons.length; b++) {
                var button = data.messages[i].message.buttons[b];
                if (langjs == 'th') {
                    if (button.language == 'th' && button.type == 'Standard') {
                        standardChatButton.push(button.id);
                    } else if (button.language == 'th' && button.type == 'Invite') {
                        inviteChatButton.push(button.id);
                    }
                } else {
                    if (button.language == 'en_US' && button.type == 'Standard') {
                        standardChatButton.push(button.id);
                    } else if (button.language == 'en_US' && button.type == 'Invite') {
                        inviteChatButton.push(button.id);
                    }
                }
            }
        };

        if (standardChatButton.length > 0) {
            CheckAvailability(standardChatButton, 'Standard');
        } else {
            console.log('standard not available');
        }

        if (inviteChatButton.length > 0) {
            CheckAvailability(inviteChatButton, 'Invite');
        } else {
            console.log('invite not available');
        }
    });
}

function CheckAvailability(id, type) {
    $.ajax({
        method: "POST",
        url: base_path + "/Visitor/Availability",
        data: {
            'X-LIVEAGENT-API-VERSION': sfversion,
            'org_id': org_id,
            'deployment_id': deployment_id,
            'Availability.ids': id.toString().replace(/"/g, '')
        }
    })
    .done(function (data) {
        for (i = 0; i < data.messages.length; i++) {
            for (b = 0; b < data.messages[i].message.results.length; b++) {
                var button = data.messages[i].message.results[b];
                switch (type) {
                    case 'Standard':
                        if (button.isAvailable == true) {
                            standard_button_id = button.id;
                            button_id = standard_button_id;
                            $('.chatbutton').show();
                        }
                        break;
                    case 'Invite':
                        if (enableChatInvitation == true) {
                            if (!sessionStorage.alreadyInvite) {
                                if (button.isAvailable == true) {
                                    inv_button_id = button.id;
                                    chat_inv_init = setTimeout(function () {
                                        $('.chatinvite').show();
                                        button_id = inv_button_id;
                                    }, chat_inv_time);
                                    sessionStorage.alreadyInvite = 1;
                                }
                            }
                            break;
                        }
                }
            }
        };
    });
}

function GetVisitorID(id) {
    $.ajax({
        method: "POST",
        url: base_path + "/Visitor/VisitorId",
        data: {
            'X-LIVEAGENT-API-VERSION': sfversion,
            'org_id': org_id,
            'deployment_id': deployment_id
        }
    })
    .done(function (data) {
        console.log("Visitor ID", data)
    });
}

function setCookie(name, value, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return;
}

function checkCookie() {
    sfToken = getCookie("sfToken");
    sfKey = getCookie("sfKey");
    sfId = getCookie("sfId");
	
	if (sfToken != null) {
		if (!sessionStorage.ChatEstablished) {
			deleteCookie();
			getSettings();
		} else {
			restoreChat();
		}
	} else {
		getSettings();
	}
}

function ChatInit() {
    $.ajax({
        method: "POST",
        url: base_path + "/System/SessionId",
        data: {
            'X-LIVEAGENT-API-VERSION': sfversion,
            'X-LIVEAGENT-AFFINITY': 'null'
        }
    })
    .done(function (data) {
        setCookie('sfToken', data.affinityToken, 1);
        setCookie('sfKey', data.key, 1);
        setCookie('sfId', data.id, 1);
        sfToken = getCookie("sfToken");
        sfKey = getCookie("sfKey");
        sfId = getCookie("sfId");
        ChasitorInit();
    });
}

function ChasitorInit() {
    var data = {
        "X-LIVEAGENT-API-VERSION": sfversion,
        "X-LIVEAGENT-AFFINITY": sfToken,
        "X-LIVEAGENT-SESSION-KEY": sfKey,
        "X-LIVEAGENT-SEQUENCE": sequence,
        "organizationId": org_id,
        "deploymentId": deployment_id,
        "buttonId": button_id,
        "sessionId": sfId,
        "userAgent": navigator.userAgent,
        "language": navigator.language,
        "screenResolution": screen.width + "x" + screen.height,
        "visitorName": (visitorName == "" ? 'Guest' : visitorName),
        "receiveQueueUpdates": true,
        "isPost": true,
    };

    $.ajax({
        method: "POST",
        url: base_path + "/Chasitor/ChasitorInit",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (data) {
        if (data.errorMessage == "Session required but was invalid or not found") {
            deleteCookie();
            checkCookie();
        } else if (data.errorMessage) {
            console.log(data.errorMessage)
            deleteCookie();
        } else {
            Messages();
            sequence += 1;
        }
    });
}

function Messages() {

    var data = {
        'X-LIVEAGENT-API-VERSION': sfversion,
        'X-LIVEAGENT-AFFINITY': sfToken,
        'X-LIVEAGENT-SESSION-KEY': sfKey,
        'ack': ack
    };

    $.ajax({
        method: "POST",
        url: base_path + "/System/Messages",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (result) {
        if (result.messages != null) {
            for (i = 0; i < result.messages.length; i++) {
                switch (result.messages[i].type) {
                    case 'ChatRequestFail':
                        if (result.messages[i].message.reason == "Unavailable") {
                            $('.chat-connecting').remove();
                            $('.chat-status-bar').empty().append('<span style="display: block; text-align: center;">No Agents Available</span>');
							$('.chat-body-content').remove();
                            $('.chat-no-agent').show();
							 disableTyping();
                        } else {
                            $('.chat-body-content').append('<p>' + result.messages[i].message.reason + '</p>');
                        }
                        deleteCookie();
                        return;

                    case 'ChatRequestSuccess':
						if(langjs == "th")
						{
							msg = "เชื่อมต่อสำเร็จ กำลังรอเจ้าหน้าที่";
						}
						else
						{
							msg = "Connection established, waiting for agent to accept ";
						}
                        $('.chat-status-bar').empty().append('<span style="display: block; text-align: center;">'+ msg +'</span>');
                        break;

                    case 'QueueUpdate':
                        // $('.chat-body-content').append('<p data-sequence='+ result.sequence +' >You are at position: ' + result.messages[i].message.position + '</p>');
                        // console.log(result.messages[i]);
                        break;

                    case 'ChatEstablished':
                        $('.chat-connecting').remove();
						var msg = ""
						if(langjs == "th")
						{
							msg = "กำลังสนทนากับ " + result.messages[i].message.name;
						}
						else
						{
							msg = "You are now chatting with " + result.messages[i].message.name;
						}
                        $('.chat-status-bar').empty().append('<span style="display: block; text-align: left;">' + msg + '</b></span>');
                        sessionStorage.ChatEstablished = 1;
                        enableTyping();
                        break;

                    case 'ChatMessage':
                        if (currentChatter == 'agent') {
                            $('.chat-body-content .chat-box:last-child').find('.chat-stacked').append('\
                                        <div class="bubble" data-sequence='+ result.sequence + '>\
                                            <p>' + AddLink(result.messages[i].message.text) + '</p>\
                                        </div>\
                                        <div class="clear"></div>'
                            );
                        } else {
                            $('.chat-body-content').append('\
                                        <div class="chat-box reply" data-sequence='+ result.sequence + '>\
                                            <div class="chat-content">\
                                                <div class="chat-stacked">\
                                                    <div class="bubble">\
                                                        <p>' + AddLink(result.messages[i].message.text) + '</p>\
                                                    </div>\
                                                    <div class="clear"></div>\
                                                </div>\
                                            </div>\
                                            <div class="chatsitor-img">\
                                                <img src="https://www.1112.com/img/tpc-logo.svg"/>\
                                            </div>\
                                            <div class="chatsitor-info">\
                                                <div class="agent-name">\
                                                    ' + result.messages[i].message.name + '\
                                                </div>\
                                                <div class="agent-timestamp">\
                                                    ' + new Date().toLocaleTimeString() + '\
                                                </div>\
                                            </div>\
                                        </div>'
                            );
                            currentChatter = 'agent';
                        }

                        if (chatWindowState == 'hidden') {
                            notification += 1;
                            $('.notification').html(notification);
                            updateUnread();
                        }

                        updateChatStorage();
                        updateSequence();
                        $('.chat-body').animate({ scrollTop: $('.chat-body').prop("scrollHeight") }, 300);
                        break;

                    case 'AgentTyping':
                        $('.typingIndicator').addClass('active');
                        clearTimeout(AgentTypingTimeout);
                        AgentTypingTimeout = setTimeout(function () {
                            $('.typingIndicator').removeClass('active');
                        }, 2000);
                        break;

                    case 'ChatEnded':
                        $('.chat-body-content').append('<div class="chat-ended" data-sequence=' + result.sequence + ' >Chat Ended</div>');
                        $('.chat-body').animate({ scrollTop: $('.chat-body').prop("scrollHeight") }, 300);
                        disableTyping();
                        deleteCookie();
                        return;

                    default:
                        console.log(result);
                }
            }
        }
        ack += 1;
        updateAck();
        Messages();
    });
}

function ChatMessage() {

    var chattxt = $('#chatInput').val();

    if (chattxt == '') {
        return;
    }

    disableTyping();

    var data = {
        'X-LIVEAGENT-API-VERSION': sfversion,
        'X-LIVEAGENT-AFFINITY': sfToken,
        'X-LIVEAGENT-SESSION-KEY': sfKey,
        'X-LIVEAGENT-SEQUENCE': sequence,
        'text': chattxt
    }

    $.ajax({
        method: "POST",
        url: base_path + "/Chasitor/ChatMessage",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (result) {
        if (result.resutMessage == 'OK') {
            if (currentChatter == 'user') {
                $('.chat-body-content .chat-box:last-child').find('.chat-stacked').append('\
                            <div class="bubble" data-sequence='+ ack + '>\
                                <p>' + AddLink(chattxt) + '</p>\
                            </div>\
                            <div class="clear"></div>'
                );
            } else {
                $('.chat-body-content').append('\
                            <div class="chat-box sent">\
                                <div class="chat-content">\
                                    <div class="chat-stacked">\
                                        <div class="bubble" data-sequence='+ ack + '>\
                                            <p>' + AddLink(chattxt) + '</p>\
                                        </div>\
                                        <div class="clear"></div>\
                                    </div>\
                                    <div class="clear"></div>\
                                </div>\
                                <div class="chatsitor-img">\
                                    <img src="https://dev.1112.com/img/user.png"/>\
                                </div>\
                                <div class="chatsitor-info">\
                                    <div class="customer-name">\
                                        ' + 'Me' + '\
                                    </div>\
                                    <div class="customer-timestamp">\
                                        ' + new Date().toLocaleTimeString() + '\
                                    </div>\
                                </div>\
                            </div>'
                );
                currentChatter = 'user';
            }

            $('.chat-body').animate({ scrollTop: $('.chat-body').prop("scrollHeight") }, 300);
            enableTyping();
            updateChatStorage();
            $('#chatInput').val('').focus();
            sequence += 1;
            updateSequence();
        } else {
            $('.chat-body-content').append('<p>Error occoured.</p>');
        }
    });
}

function ChasitorTyping() {
    var chattxt = $('#chatInput').val();
    var data = {
        'X-LIVEAGENT-API-VERSION': sfversion,
        'X-LIVEAGENT-AFFINITY': sfToken,
        'X-LIVEAGENT-SESSION-KEY': sfKey,
        'X-LIVEAGENT-SEQUENCE': sequence
    }

    sequence += 1;
    updateSequence();

    $.ajax({
        method: "POST",
        url: base_path + "/Chasitor/ChasitorTyping",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (result) {
        if (result.errorMessage) {
            var str = result.errorMessage.split(' ');
            var resyncNum = str[5].replace('.', '');
            sequence = resyncNum + 1;
        }
    });
}

function ChatSneakPeek() {
    var chattxt = $('#chatInput').val();
    var data = {
        'X-LIVEAGENT-API-VERSION': sfversion,
        'X-LIVEAGENT-AFFINITY': sfToken,
        'X-LIVEAGENT-SESSION-KEY': sfKey,
        'X-LIVEAGENT-SEQUENCE': sequence,
        'text': chattxt,
        'position': 0
    }

    sequence += 1;
    updateSequence();

    $.ajax({
        method: "POST",
        url: base_path + "/Chasitor/ChasitorSneakPeek",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (result) {
        if (result.errorMessage) {
            var str = result.errorMessage.split(' ');
            var resyncNum = str[5].replace('.', '');
            sequence = resyncNum + 1;
        }
    });
}

function deleteCookie() {
    document.cookie = "sfToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sfKey=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "sfId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    sessionStorage.clear();
}

function AddLink(message) {
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
    return message.replace(exp, "<a href='$1'>$1</a>");
}

function updateChatStorage() {
    var data = $('.chat-body').html();
    sessionStorage.setItem("chatSessionData", data);
}

function updateSequence() {
    sessionStorage.setItem("sequence", sequence);
}

function updateAck() {
    sessionStorage.setItem("ack", ack);
}

function updateUnread() {
    sessionStorage.setItem("notification", notification);
}

function restoreChat() {

    $('.chatbutton').show();
    $('.chat-body').empty().append(sessionStorage.chatSessionData);
    $('.chat-body').animate({ scrollTop: $('.chat-body').prop("scrollHeight") }, 300);

    if ($('.chat-body-content .chat-box:last-child').hasClass('sent')) {
        currentChatter = 'user';
    } else {
        currentChatter = 'agent';
    }

    sequence = parseInt(sessionStorage.sequence);
    ack = parseInt(sessionStorage.ack);
    notification = parseInt(sessionStorage.notification);

    if (notification != 0) {
        $('.notification').html(notification);
    }

    Messages();
    enableTyping();
}

function ChatEnd() {
    var data = {
        'X-LIVEAGENT-API-VERSION': sfversion,
        'X-LIVEAGENT-AFFINITY': sfToken,
        'X-LIVEAGENT-SESSION-KEY': sfKey,
        'X-LIVEAGENT-SEQUENCE': sequence,
        'ChatEndReason': 'Close Window'
    }

    sequence += 1;
    updateSequence();

    $.ajax({
        method: "POST",
        url: base_path + "/Chasitor/ChatEnd",
        data: data,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        error: function (error) {
            console.log(error);
        }
    }).done(function (result) {
        deleteCookie();
    });
};

function enableTyping() {
    $('#chatInput').prop('disabled', false);
    $('#sendChatBtn').prop('disabled', false);
}

function disableTyping() {
    $('#chatInput').prop('disabled', true);
    $('#sendChatBtn').prop('disabled', true);
}

if (screenWidth > 768) {
	checkCookie();
}

$('.chatbutton').click(function () {
    $(this).toggleClass('active');
    $('.notification').empty();
    notification = 0;
    updateUnread();
    $('.chatinvite').hide();
    $('.chat-container').toggleClass('active');

    if ($('.chatbutton').hasClass('active')) {
        chatWindowState = 'show';
    } else {
        chatWindowState = 'hidden';
    }
});

$('.closeChat').click(function () {
    $('.chatbutton').removeClass('active');
    $('.notification').empty();
    $('.chatinvite').hide();
    $('.chat-container').removeClass('active');
    $('.chat-container').removeClass('active');
});

$('.chatinvite a').click(function () {
    $(this).hide();
    $('.chatbutton').click();
});

$('.closeInvite').click(function () {
    $('.chatinvite').hide();
    button_id = standard_button_id;
});

if (sfToken == null) {
    $('.chatbutton').one('click', function () {
        clearTimeout(chat_inv_init);
        ChatInit();
    });
}

$('#deleteCookie').click(function () {
    deleteCookie();
});

$('#sendChatBtn').click(function () {
    ChatMessage();
});

$('#chatInput').keyup(function (event) {
    if (event.keyCode == 13) {
        clearTimeout(typingTimeout);
        clearInterval(typingInterval);
        typing = false;
        ChatMessage();
    } else {
        if (typing == false) {
            typing = true;
            ChasitorTyping();
            typingInterval = setInterval(function () {
                ChatSneakPeek();
            }, 5000);
            return;
        }

        clearTimeout(typingTimeout);
        typingTimeout = setTimeout(function () {
            clearInterval(typingInterval);
            typing = false;
        }, 3000);
    }
});