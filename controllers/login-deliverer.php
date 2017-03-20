<?php
	

	//if the login form has been submitted
	if (isset($_POST['submitted'])){
		
		//collect form data
		$email=strip_tags($_POST['email']);
		$password=strip_tags($_POST['password']);
		



		

		/**
		 * logIn function
		 *
		 * Takes the form data as parameters and checks if login is valid, then creates session to store chat info
		 *
		 * @param email, password, waybill no. and the db pdo object
		 * @return bool
 		*/

		function logIn($email,$password,$db){
				
				$sql= "SELECT * FROM deliverer WHERE deliverer_email = ?";
				$prepared=$db->prepare($sql);
				$data=[$email];
				$prepared->execute($data);
				$obj = $prepared->fetchObject();
				 


				//if we get an email match, then lets verify the password
				if( $prepared->rowCount() > 0 && password_verify($password,$obj->deliverer_password)){
					$sql= "SELECT tracking_number FROM packages WHERE deliverer = ? AND state = 'active' ORDER BY (package_id ) DESC LIMIT 1";
					$prepared=$db->prepare($sql);
					$data=[$obj->deliverer_user_name];
					$prepared->execute($data);
					$objd = $prepared->fetchObject();
						session_regenerate_id();
						$_SESSION['user']= [
								"name"=>$obj->deliverer_user_name,
								"email"=>$obj->deliverer_email,
								"role"=>"deliverer",
								"color"=>'#f8a350'
								// ##54a5ef
								
								 ];
						return true;
						
				}else{

					
					return false;
			
		}


			
		
				

			
		}
		//lets check if the user logged in succesfully or not and then redirect them to the chat
		$logged= logIn($email,$password,$db);


		//if we get logged in lets go to the chat 
		if($logged){
			header("Location:$link/index.php?page=home");
		}else{
			//since it didnt return true, then we know it returned the array containing the bool false and the erro message
			header("Location:$link/index.php?page=home&fail=true");	
						
		}

	}else{
		//in case they try to enter the chat page directly
		header("Location:$link/index.php?page=home");	
	}

	
?>