//remember to replace the links below with whatever the url is
 // lastTimeID = 0;
$(document).ready(function() {
		//to show the appropariate login form for buyer or deliverer
		lastTimeID = $('#lastID').val();
		
		/*$('.active-users').click(function() {
    		location.href=location.href;
    		console.log('clicked');
		});*/
		
		$('#buyer-btn').click(function(){

			$form=$('#buyer-form').html();
			
			$('#login-form').html($form);

		});
		//if the deliverer button is pressed ...
		$('#deliverer-btn').click(function(){

			$form=$('#deliverer-form').html();
			
			$('#login-form').html($form);

		});

		$('#btnSend').click(function(){
			sendChatText();
			$('#chatInput').val("");
		});
		startChat();
		getWelcome();

	function getWelcome(){
		//if we are in the chat and the chat box is empty, we can know that we are in a chat with the person
		if($('#view_ajax').text() == ""){
			
			$.ajax({
				type:"GET",
				url:"http://localhost/ajax-chat-conf/api.php/hello"


			});
		}
	}

	//sets the interval to refresh the chat box every 2 seconds
	function startChat(){
		setInterval(function(){ getChatText(); }, 1500);
		// getChatText();
		if ($('#online-buyers').html()){
			// setInterval(function(){ getActiveBuyers(); }, 10000);
		}
	}

	function getChatText(){
		$.ajax({
			type: "GET",
			url: "http://localhost/ajax-chat-conf/api.php?lastTimeID="+lastTimeID
		}).done(function( data )
		{	
			// console.log(data);
			jsonData = JSON.parse(data);
			
			if (jsonData !== null  ){
				var jsonLength = jsonData.results.length;
				// console.log(jsonLength);
				var html = "";
				//i will have to edit and style the output
				for (var i = 0; i < jsonLength; i++) {
					
					var result = jsonData.results[i];

					if (result.chat_time != false) {
						html += '<div class="bubble" style="background-color:'+result.color+'" id="'+result.id+'">' + '<b>' + result.sender +'</b>: '+result.chat_text+ "<br> <small>" + result.chat_time +"</small>" + '</div>';
						if (result.id > 0) {
							lastTimeID = result.id;

						}
				}
				}
				$('#view_ajax').append(html);
			}
			

		});
	}

	function sendChatText(){
		var chatInput = $('#chatInput').val();
		//remember to validate chatInput()
		
		if(chatInput != ""){

			$.ajax({
				type: "POST",
				data: chatInput,
				url: "http://localhost/ajax-chat-conf/api.php"
			});
		}
	}


	lastBuyerID=$('#active').val();
	html = "<ul> ";
	function getActiveBuyers(){
		$.ajax({
			type:"GET",
			url:"http://localhost/ajax-chat-conf/api.php/buyers?lastBuyerID=" + lastBuyerID
		}).done(function (data){
					var dataa = JSON.parse(data); 
					var jsonLength = dataa.results.length;
					for (var i = 0; i < jsonLength; i++){
						var result = dataa.results[i];
						html +=  "<li style='margin-left:10px; text-decoration:none; list-style:none;'>" +  result.buyer_name + "</li>";
						if (result.package_id > 0) {
							lastBuyerID = result.package_id;

						}
						
						
					}
					$("#online-buyers").append(html);
					location.reload();
			});
	}
	html += "</li> </ul>";

		





});