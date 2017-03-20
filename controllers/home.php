<?php 
	//i will still move this session initialization to the model
	
	if(!isset($_SESSION['user'])){
		$print = include "views/login-html.php";
		
	}else{
		
		$print = include "views/chat-html.php";
		

	}

	return $print;