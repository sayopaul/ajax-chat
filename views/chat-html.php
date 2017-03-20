<?php 
	//view file that returns the chat page

	//if the end chat button has been pressed, let us log out
	if (isset($_GET['end']) && $_GET['end'] == "true" ){
		
		
			//destroy the current session
			//change the state to diasbled beacause we assume it has been delivered
			/*$db->prepare("UPDATE packages SET state = 'inactive' WHERE buyer_name = ? ")->execute([$_SESSION['user']['name']]);*/
			$_SESSION['user']=null;
			session_regenerate_id();
			header("Location:". $_SERVER['PHP_SELF']);
		
	}else{

		
		$buyer_name = (isset($_GET['buyer-name']) ? $_GET['buyer-name'] : "");
		
			

		

		//if the logged in user is a buyer
		if ($_SESSION['user']['role'] == 'buyer'){


		
		//we want to load previous messages sent if there are already any in the database
		if($_SESSION['user']['created']){
		$prepared=$db->prepare("SELECT id, sender, color, chat_text, chat_time FROM chat_".$_SESSION['user']['waybill']." WHERE id  > 0  ");
		$prepared->execute();

		//get the number of rows so that we can pass it to the js script and hence get only newer messages from the database
		
		$num= $prepared->rowCount();
		$lastID = $num;


		$messages='<input type="hidden" value="'.$lastID.'" id="lastID" >';
		while ($obj=$prepared->fetchObject()){
			//format the time properly
			$obj->chat_time=date('H:i:s',strtotime($obj->chat_time));
			$messages.='<div class="bubble" style="background-color:'.$obj->color.'" id="'.$obj->id.'">' . '<b>' . $obj->sender .'</b>: '.$obj->chat_text. "<br> <small>" . $obj->chat_time ."</small>" . '</div>';
			
		}
		}
		
			
			$output='
			
				<div id="view_ajax" style="margin: 0px auto; width: 60%; ">'.$messages.'</div>
				<div id="ajaxForm" style="margin: 0px auto;">
					
					<!-- <form method="post" action=""> -->
					<textarea rows="4" cols="70" class="form-control" id="chatInput" name="chat-text" required>

					</textarea>
					<input type="button" class="btn" value="Send" id="btnSend" >
					 <a href="'.$_SERVER['PHP_SELF'] .'?end=true"> <button class="btn" id="btnEnd">End Chat  </button></a>
				</div>'
			;
		}else{
				//changes the person we are currently chatting with by the click
			

			$prep = $db->prepare("SELECT tracking_number FROM packages WHERE deliverer = ? AND state= 'active' AND buyer_name= ? ");
			$prep->execute([$_SESSION['user']['name'], $buyer_name ]);
			$obj=$prep->fetchObject();
			$_SESSION['user']['waybill']=$obj->tracking_number;
			
			$prepared=$db->prepare("SELECT * FROM packages WHERE state = 'active'");
				$prepared->execute();
				$num= $prepared->rowCount();
				$active = '<input type="hidden" value="'.$num.'" id="active" >';
				while( $obj = $prepared->fetchObject()){
					$active.="<li style='margin-left:10px; text-decoration:none; list-style:none;'> <a href='http://localhost/ajax-chat-conf/index.php?page=home&buyer-name={$obj->buyer_name}' class='active-users'>". $obj->buyer_name . "</a></li>";
				}
			$output="<div id='online-buyers'> <p> Active Buyers </p>". $active . " </div><h3> Please select a buyer to chat with </h3>";
			if(!empty($buyer_name)){ 

			
			//we want to load previous messages sent if there are already any in the database
			$prepared=$db->prepare("SELECT id, sender, color, chat_text, chat_time FROM chat_".$_SESSION['user']['waybill']." WHERE id  > 0  ");
			$prepared->execute();

			//get the number of rows so that we can pass it to the js script and hence get only newer messages from the database
			
			$num= $prepared->rowCount();
			$lastID = $num; 


			$messages='<input type="hidden" value="'.$lastID.'" id="lastID" >';
			while ($obj=$prepared->fetchObject()){

				//format the time properly
				$obj->chat_time=date('H:i:s',strtotime($obj->chat_time));
				$messages.='<div class="bubble" style="background-color:'.$obj->color.'" id="'.$obj->id.'">' . '<b>' . $obj->sender .'</b>: '.$obj->chat_text. "<br> <small>" . $obj->chat_time ."</small>" . '</div>';
			}
			
					

					$output='
						<div id="online-buyers"> <p> Active Buyers </p>'. $active . ' </div>
						<div id="view_ajax" style="float:left;">'
						.$messages.' </div>
						<div id="ajaxForm" style="clear:both; margin-left:150px;">
							
							<textarea rows="4" cols="70" id="chatInput" name="chat-text" > </textarea>
							<input type="button" class="btn" value="Send" id="btnSend" >
							 <a href="'.$_SERVER['PHP_SELF'] .'?end=true"> <button class="btn" id="btnEnd">End Chat  </button></a>
						</div>';	
				}
			
			}
	}

return $output;