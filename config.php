<?php
session_start();
define("mysqlServer","localhost"); 
//name of the database
define("mysqlDB","chatter"); 

//user and password info
define("mysqlUser","YOUR USERNAME"); 
define("mysqlPass","YOUR PASSWORD");
define("NAME","Blazeh Chat");
define("DSN","mysql:host=localhost;dbname=chatter");


// name of table where konga orders are logged
define("TABLE_NAME","packages");
//database connection details

     try{

          $db=new PDO(DSN,mysqlUser,mysqlPass);
          // var_dump($db);
          $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     }catch(Exception $e){
          die(" There is an error couldn't connect to the database because of $e . Please report to the admin");
     }
?>