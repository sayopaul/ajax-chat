<?php 
/**
 * Chat class
 *
 * All the chat magic happens here
 *
 * @param email, password, waybill no. and the db pdo object
 * @return bool
*/

namespace \blazeh;

class Chat {
	private $chatText;
	private $botReply;

	/*public function __construct($chattext,$justEntered){
		$this->parseText($chattext,$justEntered);
	}*/



	private function parseText($chatText,$justEntered=NULL){
		$this->botReply=(isset($justEntered) && $justEntered == true ?  " Hello, welcome to ");
	}


/**
 * Retrieves the buyer assigned from the databse and then inserts a new welcome message into the chat table . 
 *Creates a new table that would be used for this chat
 * @param string whatever is inputted into the chat box
 * 
 * @return bool 
 */


	public function newChat(){
		$sql = " CREATE TABLE chat_";
	}
}