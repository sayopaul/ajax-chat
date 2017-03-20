<?php

/**
 * backend API that powers the chat. Uses Slim framework
 *
 * Did this in case we want to build an android app, etc
 * 
 * 
 * 
 * 
 * @author Team Blazeh
 * 
 */
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require 'vendor/autoload.php';

	//settings for this app
	$config['displayErrorDetails'] = true;
	$config['addContentLengthHeader'] = false;
	$config['db']=[
		"host"=>"localhost",
		"user"=>"root",
		"pass"=>"jesussaves",
		"dbname"=>"chatter"
	];





	//we create a new slim app object
	$app = new \Slim\App(["settings"=>$config]);

	//create the container for dependency injection
	$container = $app->getContainer();

	//database connection
	$container['db']= function ($c) {
		$db=$c['settings']['db'];
		try{
			$pdo = new PDO("mysql:host=".$db['host'].";dbname=".$db['dbname'],$db['user'],$db['pass']);
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			return $pdo;
		}catch(PDOException $e){
			return "your connection did not work because of  --> " . $e->getMessage();
		}

	};

	
	session_start();



	/**
	 * Alerts the bot that a new chat just started
	 *
	 * @param string
	 * 
	 *  
	 */
	
	$app->get('/hello',function (Request $request, Response $response){
		
		$chatObj = new \blazeh\Chat($this->db,$_SESSION['user']);
		$chatObj->newChat();
		
		
	});


// <button id='buyer-btn'> BUYER </button> <br> OR <button id='deliverer-btn'> DELIVERER </button>

/**
 * Finds and returns user by ID or username
 *
 * @param string whatever is inputted into the chat box
 * 
 * @return bool 
 */
	$app->post('/',function(Request $request, Response $response){

			//i have tested to ensure that everything works proper
			$text= $request->getParsedBody();
			$chatObj = new \blazeh\Chat($this->db,$_SESSION['user']);
			
			foreach($text as $key=>$value){
				//slim changes spaces to underscores hence we change them back to the normal ting :D 
				$texted = str_replace("_"," ",$key);
				$chatObj->insertMessage($texted);
				break;
			}
			
			
			

			

	});

	/**
	 * Finds and returns user by ID or username
	 *
	 * @param string whatever is inputted into the chat box
	 * 
	 * @return bool 
	 */

	$app->get('/',function(Request $request, Response $response){
		$params=$request->getQueryParams();
		$id=(($params['lastTimeID'] > 0) ? $params['lastTimeID'] : 0);
		
		$chatObj = new \blazeh\Chat($this->db,$_SESSION['user']);
		$obj=$chatObj->getMessages($id);
		return  $obj ;

	});	

	/**
		 * Returns the number of active buyers for the deliverer
		 *
		 * @param string whatever is inputted into the chat box
		 * 
		 * @return bool 
		 */




	$app->get('/buyers',function(Request $request, Response $response){
		$params=$request->getQueryParams();
		$id=(($params['lastBuyerID'] > 0) ? $params['lastBuyerID'] : 0);
		
		$chatObj = new \blazeh\Chat($this->db,$_SESSION['user']);
		$obj=$chatObj->getOnlineBuyers($id);
		return $obj;

	});


//we run the app
$app->run();