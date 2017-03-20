<?php


     require ('config.php');
     $link="http://localhost/ajax-chat-conf";
     error_reporting(E_ALL ^ E_NOTICE);
     ini_set('display_errors', On);
     
     //instantiate new class to allow for dynamic page variables.
     $pageData = new stdClass();
     $pageData->title = NAME ." | Deliveries dont have to be frustrating. ";
     //description for search engines
     $pageData->description= " Description is here ";
     //description for meta tags
     $pageData->desc= " Description is here ";
     //image for meta tags
     // $pageData->img= "https://funaab.kilenra.com/assets/images/mascot-head.png";
     $pageData->url=$link . $_SERVER['PHP_SELF'];
     //include the navbar
     $pageData->content=include "views/nav.php";
     //include a controller that will serve as content
     $ctrl =(isset($_GET['page']))?($_GET['page']):"home";

     //404 engine to ensure we're loading the right something :D
     $included=((file_exists("controllers/".$ctrl.".php")) ? "controllers/".$ctrl.".php" : "controllers/404.php");
     $pageData->content.=include $included ;
    
     //include the footer
     $pageData->content.= include "views/footer.php";
     //include page template and then echo it out
     $page= include "views/page.php";

     echo $page;

     
 ?>