<?php
//returns the page template



         
        

          
return "
	<!doctype html>
		<html lang='en'>
     		<head>
     		   <meta charset='utf-8'>
                  <meta http-equiv='x-ua-compatible' content='ie=edge'>
     		   <title> $pageData->title </title>
                  <meta name='description' content=' $pageData->description '>
     	        <meta name='viewport' content='width=device-width, initial-scale=1'>
     	        <meta name='theme-color' content='#594b72'>
     	        <meta name='msapplication-navbutton-color' content='#594b72'>
     	        <meta name='apple-mobile-web-app-status-bar-style' content='#594b72'>
     	        <meta property='og:url'           content='$pageData->url'/>
     	        <meta property='og:type'          content='website' />
     	        <meta property='og:title'         content=' $pageData->title ' />
     	        <meta property='og:description'   content='$pageData->desc ' />
     	        <meta property='og:image'         content='$pageData->img' />

     	        <link rel='apple-touch-icon' href='".$link."/assets/images/mascot-head.png'>
     	        <link rel='icon' href='".$link."/assets/images/mascot-head.png'>
                  
              <!-- regular one for desktops -->
              <link rel='stylesheet' href='".$link."/css/main.css'/>
              <link rel='stylesheet' href='".$link."/css/bootstrap.min.css'/>
             

              <!-- Latest compiled and minified CSS 
                  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
                   Optional theme 
                  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'> -->
                  
                 

                
                    
                  
                  




                  
                  
                  

                  



                  <style>
                  *{
                    font-family:Raleway;
                }
                      
                                            
                    </style>
                    <!-- include html shiv thingy -->
                    <!--[if lt IE 9]>
    <script src='bower_components/html5shiv/dist/html5shiv.js'></script>
<![endif]-->
             </head>
             <body>
             
                    
	                    $pageData->content
                       
             </body>

	                     <!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script> -->
	                    
                      <script src='".$link."/js/jquery.min.js'></script>
                      <script src='".$link."/js/main.js'></script>
                      <script>
                            //gooogle maps thingy here. remember that htis time we ould use jquery to get the info from lat and long via the hidden field and the class
  
         
        
      var map;

      function initMap() {
         
            
            lati = Number($('#lat-".$_SESSION['user']['insertID']." ').val());
            console.log(lati);
            longi = Number($('#long-".$_SESSION['user']['insertID']."').val());
            mapID ='map-".$_SESSION['user']['insertID']."';

            map = new google.maps.Map(document.getElementById(mapID), {
              center: {lat:lati , lng: longi},
              zoom: 25
          



            });
              var marker = new google.maps.Marker({
              position: {lat: lati , lng: longi},
              map: map
            });

           
      
      
      }


                      </script>
                      <script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA5QUXPYJ4OIXmAo789Qhcg1FJ_wRxoVeM&callback=initMap&sensor=false'></script>
                      <!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
	                    <script src='".$link."/assets/js/custom-file-input.js'></script> -->





    


     	</html>

     ";
   




?>
