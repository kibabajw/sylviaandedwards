<!Doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>chat</title>
	<link href="<?php echo base_url(); ?>chat/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row chat-window col-xs-5 col-md-4 col-sm-6" style="margin-bottom:30px;">
        <div class="contacts_list"></div>
    </div>
    <div class="row chat-window col-xs-5 col-md-4 col-sm-6" id="chat_window_1" style="margin-left:10px;right:0;margin-bottom:50px;">
        <div class="col-xs-12 col-md-12 col-sm-12">
        	<div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title" id="chat_recipient"></h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><i class="fa fa-times icon_close" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <div class="row msg_container base_sent">
                            <!-- sent messages go here -->
                            <div class="base_sent_content"></div>
                    </div>
                    <div class="row msg_container base_receive">
                            <!-- received messages go here -->
                    </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-md chat_input" placeholder="Write your message here..." style="width:100%;" />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>   
</div>
<script src="<?php echo base_url(); ?>chat/jQuery-min-3.3.1.js"></script>
<script>
    $(document).ready(function(){
        var chat = {}
        chat.fetch_contacts = function(){
            var cont_url = '<?php echo base_url() ?>index.php/Chat_Controller/contacts';
            $.get(cont_url, function(response){
                $(".contacts_list").html(response);
            });
        }
        chat.fetch_my_msg = function(){
            to_who = $("#chat_recipient").html();
            $.ajax({
            url: '<?php echo base_url() ?>index.php/Chat_Controller/get_my_msg',
            type: 'post',
            data: {to_who: to_who},
            success: function(response){
                $(".base_sent_content").html(response);
            }
            });
            // var cont_url = '<?php echo base_url() ?>index.php/Chat_Controller/get_my_msg';
            // $.get(cont_url, function(response){
            //     $(".base_sent").html(response);
            // });
        }
        chat.fetch_other_msg = function(){
            sender = $("#chat_recipient").html();
            $.ajax({
            url: '<?php echo base_url() ?>index.php/Chat_Controller/get_other_msg',
            type: 'post',
            data: {sender: sender},
            success: function(response){
                $(".base_receive").html(response);
            }
            });
            // var cont_url = '<?php echo base_url() ?>index.php/Chat_Controller/get_other_msg';
            // $.get(cont_url, function(response){
            //     $(".base_receive").html(response);
            // });
        }

        chat.interval = setInterval(chat.fetch_contacts, 3000);
        chat.fetch_contacts();
        chat.interval = setInterval(chat.fetch_my_msg, 3000);
        chat.fetch_my_msg();
        // chat.interval = setInterval(chat.fetch_other_msg, 3000);
        // chat.fetch_other_msg();
    });

    chat.throwMessage = function(recipient, message){
        if ($.trim(recipient).length != 0 && $.trim(message).length != 0) {
            var dataString = 'recipient='+recipient+'+message='+message;
            $.ajax({
            url: '<?php echo base_url() ?>index.php/Chat_Controller/insert_msg',
            type: 'post',
            data: {recipient: recipient, message: message},
            success: function(data){
                chat.entry.val('');
                // chat.fetch_msg();
            }
            });
        } else{
            alert('Message should be complete');
        }
    }

    chat.entry = $('.chat_input');
    chat.entry.bind('keydown', function(e){
        if (e.keyCode === 13 && e.shiftKey === false) {
            recipient = $("#chat_recipient").html();
            chat.throwMessage(recipient, $(this).val());
            e.preventDefault();
        }
    });

    function set_recipient(data){
        $("#chat_recipient").text(data);
    }
</script>
<script src="<?php echo base_url(); ?>chat/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>chat/chat-script.js"></script>
</body>
</html>