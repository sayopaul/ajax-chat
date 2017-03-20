<?php 
/**
 * Chat class
 *
 * All the chat magic happens here
 *
 * @param email, password, waybill no. and the db pdo object
 * @return bool
*/

namespace blazeh;

class Chat {
	private $chatText;
	private $botReply;
	private $db;
	private $waybill;
	private $sender;
	private $color;
	private $role;

	public function __construct($db,$user){
		$this->db=$db;
		$this->waybill=$user['waybill'];
		$this->sender=$user['name'];
		$this->color=$user['color'];
		$this->role=$user['role'];
	}


/*
	private function parseText($chatText,$justEntered=NULL){
		$this->botReply=(isset($justEntered) && $justEntered == true ?  " Hello, welcome to ");
	}
*/

	/**
	 * Retrieves the buyer assigned from the databse and then inserts a new welcome message into the chat table . 
	 *Creates a new table that would be used for this chat
	 * 
	 * 
	 * 
	 */


	public function newChat(){
		$sql = " CREATE TABLE IF NOT EXISTS chat_".$this->waybill."(
		    id int(11) NOT NULL AUTO_INCREMENT,
		  sender varchar(150) NOT NULL,
		  color varchar(150) NOT NULL,
		  chat_text varchar(2500) NOT NULL,
		  chat_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  mapped varchar(20)  NULL DEFAULT NULL,
		  PRIMARY KEY (id)) ";
	  	$prepared=$this->db->prepare($sql);
	  	$created = $prepared->execute();

	  	if($created){
	  		$_SESSION['user']['created']="true";
	  		$this->insertWelcomeMsg();
	  	}
	}

	/**
	 * Inserts the welcome message into the table
	 *
	 * 
	 * 
	 *  
	 */

	private function insertWelcomeMsg(){
		switch($this->role){
			case "buyer":
				$sql=" SELECT deliverer FROM packages WHERE tracking_number = '".$this->waybill."'";
			break;
			case "deliverer":
				$sql=" SELECT buyer_name FROM packages WHERE deliverer = '".$this->sender."'";
			break;
		}
		
		$prepared=$this->db->prepare($sql);
	  	$prepared->execute();
	  	$obj = $prepared->fetchObject();
	  	$deliverer=$obj->deliverer;

	  	switch($this->role){
			case "buyer":
				$statement="INSERT INTO chat_".$this->waybill." (sender,color,chat_text) VALUES(
				'BlazehBot',
				'#f8a350',
				'Hello there, welcome to blazeh chat.  You have been put in a chat with ( ".$deliverer." ) the deliverer assigned to your package. Please feel free to engage him/her , Thanks. 
					Enter your address by typing \" Address  \" followed by your current address in details seperated by commas . An example is \n \"address , funaab, Alabata road, Abeokuta , Ogun state\"'


	  		)";
			break;
			case "deliverer":
				$statement="INSERT INTO chat_".$this->waybill." (sender,color,chat_text) VALUES(
				'BlazehBot',
				'#f8a350',
				'Hello there, welcome to blazeh chat.  You have been put in a chat with  the buyer assigned to your package. Please feel free to engage him/her , Thanks .
					Enter your address by typing \" Address  \" followed by your current address in details seperated by commas . An example is \n \"address , funaab, Alabata road, Abeokuta , Ogun state\"'


	  		)";
			break;
		}
	
	  	
  		$prepare=$this->db->prepare($statement);
	  	$prepare->execute();


	}

	/**
	 * The main method . Inserts user's name into the chat field
	 * After inserting the chat text into the database,
	 * @param string whatever is inputted into the chat box
	 * 
	 * @return bool 
	 */

	public function insertMessage($text){

		//remember that this is where i stopped. for some reason , the text isnt even inserting aymore but i have got to figure that out firstly, then do this other stuff which is to ensure the map is inserted into the databse and do the jquery part
		
		$sql="INSERT INTO chat_".$this->waybill." (sender,color,chat_text) VALUES (?,?,?)" ;
		$data=[$this->sender,$this->color,$text];
		$prepared=$this->db->prepare($sql);
		$prepared->execute($data);
		$insertID = $this->db->lastInsertId();
		$this->parseText($text,$insertID);
		
		
	}

	/**
	 * Fetches the inserted messages from the database and sends them i json format to the client
	 * 
	 * @param the last inserted
	 * 
	 * @return json object 
	 */



	public function getMessages($id){
		$arr=[];
		$sql="SELECT id, sender, color, chat_text, chat_time FROM chat_".$this->waybill." WHERE id = ? +1  ";

		$prepared=$this->db->prepare($sql);
		$data=[$id];
		$prepared->execute($data);
		$obj=$prepared->fetchObject();

		if ($prepared->rowCount() > 0){
			$timestamp=!empty($obj->chat_time) ? strtotime($obj->chat_time)  : "";
			$obj->chat_time=date('H:i:s',$timestamp);

			
			$jsonData = '{"results":[';
			$arr[] =json_encode($obj);

			$jsonData .= implode(",", $arr); 
			$jsonData .= ']}';
			return $jsonData;
			
		}else{
			// return $this->waybill;
		}

      	
	}


	/**
	 * Fetches the inserted messages from the database and sends them in json format to the client
	 * 
	 * @param the last inserted
	 * 
	 * @return json object 
	 */
	
	public function getOnlinebuyers($id){
		$arr=[];
		$prepared=$this->db->prepare( " SELECT * FROM packages WHERE state = 'active' AND package_id = ? + 1 ");
		$prepared->execute([$id]);
		
		$obj=$prepared->fetchObject();

		if ($prepared->rowCount() > 0){

			$jsonData = '{"results":[';
			$arr[] =json_encode($obj);

			$jsonData .= implode(",", $arr); 
			$jsonData .= ']}';
			return $jsonData;
		}
		
	}

	public 	function parseText($text,$insertID){
		//case insensitive search for address in user's input
		if ( stristr($text,'address') != FALSE ){
			
			 //we want to remove the word "address" from the text
			 $m = explode("address ",$text);
			 $text=$m[1];

			 
			 
			 //we want to match every word up until state
			 preg_match_all('/.+?(?=state)/', $text, $matched);
			
			
			 
			 $address= explode(",",$matched[0][0]);
			 
			 $city=urlencode($address[0]);
			 $state=urlencode($address[1]);
			 $extra= "";
			 for ($i=1; $i < count($address); $i++){
			 	$extra .= urlencode($address[$i] . ","); 
			 }
			 
			 

	    	
	    	
			$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyA5QUXPYJ4OIXmAo789Qhcg1FJ_wRxoVeM&address='.$extra);
			$output= json_decode($geocode); 
			print_r($output);
			
			
			


			 

			if($output->status == 'OK'){ 
				$_SESSION['user']['insertID']=$insertID;
				$map = "<input type='hidden' id='lat-".$insertID."' value='".$output->results[0]->geometry->location->lat . "'>";
				$map .= "<input type='hidden' id='long-".$insertID."'value='".$output->results[0]->geometry->location->lng . "'>"; 
				$map.= "<div id='map-".$insertID ."' style='height:250px; width:300px;'>";
				$map .= "</div>";
			}else{
				$map=" Sadly, I couldn't get any map data with the address you provided. Please try to be more clear. Ensure you used commas to sperate landmarks, cities, states.";
			}

				$sql="INSERT INTO chat_".$this->waybill." (sender,color,chat_text,mapped) VALUES (?,?,?,?)" ;
				$data=["Blazehbot","rgba(248,163,80,0.5);color:black;","Here is a map of where you are according to your address. Please zoom in for more clarity :" .$map,"true"];
				$prepared=$this->db->prepare($sql);
				$prepared->execute($data);

			

				

				

				

				
		
	}else{
		return false;
	}


	}
}