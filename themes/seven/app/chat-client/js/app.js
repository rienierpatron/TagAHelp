$(document).ready(function(){
	var Globalvars = {
		'client_id' : '7461675f68785f69e65',
		'client_secret' : '746167626f6e645f686966785f6970686f6',
		'api_url' : 'https://api.tagbond.com/',
		'socket' : null,
		'socketServerUrl' : 'http://vm:2000',
		'nodeServerUrl' : 'http://vm:2011',
		'templates' : [],
		'me' : null,
		'activeChatter' : {},
		'loggedIn' : false
	}

	var Methods = {
		'initialize' : function(){
			Methods.compileTemplates();
			Globalvars.socket = io.connect(Globalvars.socketServerUrl);			
			//Methods.hideUserList();
			//Methods.hideChatBox();
			$('#login-form').submit(Handlers.handleLoginSubmit);
			$('#userlist-page').on('click', '.user-online', Handlers.handleUserClick);
			$('#chat-text-field').on('keyup', Handlers.handleMessageEnter);
			$('.navbar-brand').click(Handlers.handleLogoClick);
		},

		'redrawUserList' : function(userList){
			listHtml = '';
			for(i = 0; i < userList.length; i++){
				if(userList[i].id != Globalvars.me.id){
					userList[i].image = Globalvars.api_url + 'image/avatar/' + userList[i].id + '?access_token=' + Globalvars.me.access_token;
					listHtml += Globalvars.templates.onlineUserTemplate.render(userList[i]);
				}
			}

			if(listHtml == ''){
				$("#userlist-page ul").append('<li>No users online</li>');
			}
			else{
				$("#userlist-page ul").html(listHtml);				
			}

		},

		'showLoader' : function(){
			$('#ajax-loader').show();
		},

		'hideLoader' : function(){
			$('#ajax-loader').hide();
		},

		'showUserList' : function(){
			$('#login-page').hide();
			$('#chat-page').hide();
			$('#userlist-page').show();
		},		

		'showChatBox' : function(id, name){
			$('#login-page').hide();
			$('#userlist-page').hide();
			$('#chat-page').show();
			$('#chat-list').html();
			$('#chat-text-field').attr('data-id', id);
			$('#chat-text-field').attr('data-name', name);
			Globalvars.activeChatter.id = id;
			Globalvars.activeChatter.name = name;
			Methods.fetchMessageList(id);
		},

		'processMessage' : function(message){
			processedMessage = {};
			processedMessage.id = message.sender_id;
			processedMessage.name = message.sender_name;
			processedMessage.message = message.message_text;
			processedMessage.time = message.message_time;
			processedMessage.image = Globalvars.api_url + 'image/avatar/' + message.sender_id + '?access_token=' + Globalvars.me.access_token;

			if(message.sender_id == Globalvars.me.id){
				processedMessage.alignment = 'right';
			}
			else{
				processedMessage.alignment = 'left';
			}

			return processedMessage;
		},

		'drawMessageList' : function(messages){
			listHtml = '';
			for(i = 0; i < messages.length; i++){
				listHtml += Globalvars.templates.chatMessageTemplate.render(Methods.processMessage(messages[i]));
			}

			$("#chat-list").html(listHtml);
			$('#chat-list').scrollTop($('#chat-list')[0].scrollHeight);	
		},

		'fetchMessageList' : function(id){
			$.ajax({
				url : Globalvars.nodeServerUrl + '/messages',
				type : 'GET',
				data : {
					'my_id' : Globalvars.me.id,
					'other_id' :id
				},
				success : function(data){
					Methods.drawMessageList(data);
				}
			});
		},

		'showUnreadAlert' : function(userId){
			$( ".user-online[data-id='" + userId +"']" ).addClass("unread");
		},

		'hideUnreadAlert' : function(userId){
			$( ".user-online[data-id='" + userId +"']" ).removeClass("unread");
		},

		'compileTemplates' : function(){
			Globalvars.templates.onlineUserTemplate = Hogan.compile($('#user-online-template').html());
			Globalvars.templates.chatMessageTemplate = Hogan.compile($('#chat-message-template').html());
		},
	}

	var Handlers = {
		'handleLogoClick' : function(){
			if(Globalvars.loggedIn){
				Methods.showUserList();
			}
		},

		'handleUserClick' : function(e){
			id = $(this).attr('data-id');
			name = $(this).attr('data-name');
			Methods.showChatBox(id, name);
			e.preventDefault();
		},

		'handleMessageEnter' : function(e){
			if(e.keyCode == 13 && $(this).val() != ''){
				receiver_id = $(this).attr('data-id');
				receiver_name = $(this).attr('data-name');
				message_text = $(this).val();

				var message = {
					'sender_id' : Globalvars.me.id,
					'sender_name' : Globalvars.me.first_name + ' ' + Globalvars.me.last_name,
					'receiver_id' : receiver_id,
					'receiver_name' : receiver_name,
					'message_text' : message_text
				}

				//Emit this message to the server
				Globalvars.socket.emit('message', message);
				console.log("sending message");
				console.log(message);

				$("#chat-list").append(Globalvars.templates.chatMessageTemplate.render(Methods.processMessage(message)));
				$('#chat-list').scrollTop($('#chat-list')[0].scrollHeight);	
				$(this).val('');
				e.preventDefault();
			}
		},

		'handleMessageReceived' : function(message){
			console.log(message);
			if($('#chat-page').is(':visible')){
				//if user is in the chat page
				if(Globalvars.activeChatter.id == message.sender_id){
					//If the message was sent by the same person with which this user is having the conversation
					$("#chat-list").append(Globalvars.templates.chatMessageTemplate.render(Methods.processMessage(message)));
					$('#chat-list').scrollTop($('#chat-list')[0].scrollHeight);			
				}
				else{
					Methods.showUnreadAlert(message.sender_id);					
				}
			}
			else if($('#userlist-page').is(':visible')){
				Methods.showUnreadAlert(message.sender_id);
			}
		},

		'handleUserListUpdate' : function(userList){
			Methods.redrawUserList(userList);
		},

		'handleLoginSubmit' : function(e){
			$.ajax({
				url : Globalvars.api_url + 'oauth/accesstoken',
				type : 'POST',
				data : {
					'client_id' : Globalvars.client_id,
					'client_secret' : Globalvars.client_secret,
					'grant_type' : 'password',
					'username' : $('#login-form-email').val(),
					'password' : $('#login-form-password').val()
				},

				'beforeSend' : function(){
					Methods.showLoader();
				},

				success : function(data){
					if(data.status == "success") {
						$.cookie("token", data.result.access_token);
						$.cookie("name",data.result.user_firstname+" "+data.result.user_lastname);
						console.log(data);
						Globalvars.me = {
							'id' : data.result.id,
							'first_name' : data.result.user_firstname,
							'last_name' : data.result.user_lastname,
							'access_token' : data.result.access_token
						}

						//After login
						//Inform the node server of the login
						Globalvars.socket.emit('login', Globalvars.me);
						//Listen to any changes in the user list
						Globalvars.socket.on('userchannel', Handlers.handleUserListUpdate);
						//Listen to messages
						Globalvars.socket.on('message', Handlers.handleMessageReceived);

						Globalvars.loggedIn = true;

						Methods.showUserList();
					} else{
						alert('Invalid username or password. Please try again');
					}
				}, 

				error : function(){
					alert('Invalid username or password. Please try again');
				},

				complete : function(){
					Methods.hideLoader();
				}

			});

			e.preventDefault();
		}
	}


	//We start the program from here using the initialize function
	Methods.initialize();
	//Methods.hideLogin();
	//Methods.showUserList();
});