<?php
	

	//if the login form has been submitted
	if (isset($_POST['submitted'])){
		
		//collect form data
		$email=strip_tags($_POST['email']);
		$password=strip_tags($_POST['password']);
		$waybill=strip_tags($_POST['waybill']);



		

		/**
		 * logIn function
		 *
		 * Takes the form data as parameters and checks if login is valid, then creates session to store chat info
		 *
		 * @param email, password, waybill no. and the db pdo object
		 * @return bool
 		*/

		function logIn($email,$password,$waybill,$db){
				
				$sql= "SELECT * FROM ". TABLE_NAME . " WHERE buyer_email = ? AND tracking_number = ?";
				$prepared=$db->prepare($sql);
				$data=[$email,$waybill];
				$prepared->execute($data);
				$obj = $prepared->fetchObject();

				//if we get an email match, then lets verify the password
				if( $prepared->rowCount() > 0 && password_verify($password,$obj->password)){
					
					
					$db->prepare("UPDATE packages SET state = 'active' WHERE buyer_name = ? ")->execute([$obj->buyer_name]);
					session_regenerate_id();
					$_SESSION['user']= [
							"name"=>$obj->buyer_name,
							"email"=>$obj->buyer_email,
							"package_id"=>$obj->package_id,
							"waybill"=>$obj->tracking_number,
							"color"=>'#19334e',
							"role"=>'buyer'
							// ##54a5ef
							
							 ];
						return true;
						
				}else{

					
					return false;
			
		}


			

			
				

			
		}
		//lets check if the user logged in succesfully or not and then redirect them to the chat
		$logged= logIn($email,$password,$waybill,$db);

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