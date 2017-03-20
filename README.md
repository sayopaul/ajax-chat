Blazeh Chat 🔥🔥🔥
===================
![blazeh chat screenshot](http://fs5.directupload.net/images/170320/x7l7ynhq.png "blazeh chat screenshot")

![blazeh chat login page](http://fs5.directupload.net/images/170320/o66ob7lx.png "blazeh chat screenshot")



DESCRIPTION
----------
Mini chat application that helps to deepen communication between KOS Courier deliverers and buyers hence making the delivery process sweeter and less painful for the both parties.

MOTIVATION
----------
When I ordered something from Konga about a month ago, I found it a bit annoying that I had to call the delivery man to know where exactly my package was and what time it would be delivered (on the day of delivery ).

For people staying far from the west like me ( PortHarcourt ) , its a real challenge because deliveries usually take 3 days +, And hence we can get impatient ( since we don't know where it is exactly ) .

There's already the konga track order which helps to cool our temper, but this platform goes deeper than track order. It offers ability for the delivery guys to check in at locations , hence you know where exactly they are and when they'll be coming .

To add to the dilemma, the delivery man had a challenge whilst delivering my order. He parked in a wrong spot , Hence traffic guys made him pay a fine. About 1k or 2k 🤔 and he ended up blaming me lowkey .

If this platform existed, apart from me knowing his location , we would've been able to communicate better and hence that would have been avoided.

HOW IT WORKS
----------
Whenever buyers make orders on Konga.com , the ordered good is assigned a specific tracking
number and that tracking number is given to the buyer. With our platform, that tracking number would also be assigned to whatever deliverer( driver, okada man etc ) that is assigned to deliver the package.

An email is then sent to the buyer with a randomly generated one time password . The user goes on our platform, and is now able to login with their email , password( the one we sent ) and
the tracking number for that package. Once they login , they’re automatically put in a chat with the deliverer assigned to that package . An alert (SMS or email ) is sent to the deliverer so that he knows the buyer would like to talk to him . Konga.com doesn’t offer anything more descriptive when it comes to locations and hence drivers usually have a little mix-up ( like my example where road safety people held him down for wrong parking ) . As time goes on, the buyer can feel free to engage the deliverer in a chat and they can input addresses . Our system detects them and gives a mini street view map using the google maps API  <i class="icon-provider-g"></i> **Google Drive** ( although a lot of improvement can be done in this line :D ).


INSTALLATION
-------------
Blazeh Chat was built with PHP, mySQL,HTML,CSS,JavaScript

It utilizes AJAX requests to automatically update the chat ( We wanted to use Websockets, but ... resources ) .

> **Requirements:**

> - PHP 5.3 + although it was tested with PHP 7.1 .
> - web server ( preferably apache ) and mysql installed.
> - It uses the Slim PHP Microframework

So first things first , create a database and then update the config.php file <i class="icon-file"></i>
```
<?php
session_start();
define("mysqlServer","localhost"); 
//name of the database
define("mysqlDB","YOUR_DB_NAME"); 

//user and password info
define("mysqlUser","YOUR_USERNAME"); 
define("mysqlPass","YOUR_PASSWORD");
define("NAME","Blazeh Chat");
define("DSN","mysql:host=localhost;dbname=YOUR_DB_NAME");


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
```
After that, run/import the two sql files named "packages" and "deliverer" . These contain the deafult assumed values that we'll be using.

> **Note:**
> If you use an alternative name for the packages table, remember to update the config.php file ! 

After that , start your web server and navigate to ajax-chat-conf/index.php

> **LOGIN DETAILS:**

> - Default login for the buyer is username-"sayo@blazeh.com", password-"blazeh", tracking number = "blazeh123" .
> - Default login for the deliverer is username-"okonkwo@konga.com", password-"okonkwo" .



START CHATTING !!
-------------------
----------
### Development
Want to contribute? Great! Please star and help to identify areas to improve. Thanks

---------
### LICENSE
MIT










