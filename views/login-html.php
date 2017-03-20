<?php 
	

	//we want to display the failed log in message
	$message=(isset($_GET['fail']) ? "<section class='alert alert-danger'> There was an error logging in. Please ensure you typed in the correct details </section>" : ""  );
	//view file that returns the login form
	$output="
		
		<section style='font-size:2.5em;' class='center-text'> Login to know How Far </section>
		$message
		<center>
		<button id='buyer-btn' class='btn my-btn'> BUYER </button> <br> OR <br><button style='margin-bottom:10px;' id='deliverer-btn' class='btn my-btn'> DELIVERER </button>
		</center>
		<section id='login-form'> </section>
		<div id='hide-buyer-form' style='display:none;'>
		<div id='buyer-form' >
			<form class='login-form' action='$link/index.php?page=login' method='post'>
			<div class='form-group h-mh-0 '>
			            <div class='input-group'>
			                <span class='input-group-addon'>@</span>
			                <input class='form-control js-remember' id='email' maxlength='' name='email' placeholder='Email' type='text' value='' type='email' required>
			            </div>
					</div>

			        <div class='form-group h-mh-0 '>
			            <div class='input-group'>
			                <span class='input-group-addon'>
			                    <span class='glyphicon glyphicon-lock h-width-14'></span>
			                </span>
			                <input class='form-control' id='password' name='password' placeholder='Your Password' type='password' value='' required>

			                
			            </div>
		            </div>

			            <div class='form-group h-mh-0 '>
				            <div class='input-group'>
				                <span class='input-group-addon'>
				                    <span class='glyphicon glyphicon-lock h-width-14'></span>
				                </span>
				                <input class='form-control' id='waybill' name='waybill' placeholder='Your Waybill Number' type='text' value='' required>

				                
				            </div>
			            </div>

			            <div class='form-group h-mh-0 '>
			            	<input style='margin:0px auto; margin-top:15px; border:1px solid white' name='submitted' value=' LOG IN ' type='submit' class='btn my-button'>
			            
			    
			    


		        	</div>
		</form>
		</div>
		</div>

		<div id='hide-deliverer-form' style='display:none;'>
		<div id='deliverer-form' >
			<form class='login-form'action='$link/index.php?page=login-deliverer' method='post'>
			<div class='form-group h-mh-0 '>
			            <div class='input-group'>
			                <span class='input-group-addon'>@</span>
			                <input class='form-control js-remember' id='email' maxlength='' name='email' placeholder='Email' type='text' value='' type='email' required>
			            </div>
					</div>

			        <div class='form-group h-mh-0 '>
			            <div class='input-group'>
			                <span class='input-group-addon'>
			                    <span class='glyphicon glyphicon-lock h-width-14'></span>
			                </span>
			                <input class='form-control' id='password' name='password' placeholder='Your Password' type='password' value='' required>

			                
			            </div>
		            </div>

			           
			            <div class='form-group h-mh-0 '>
			            	<input style='margin:0px auto; margin-top:15px; border:1px solid white' name='submitted' value=' LOG IN ' type='submit' class='btn my-button'>
			            
			    
			    


		        	</div>
		</form>
		</div>
		</div>
		<section id='bg'>
		</section>
		
	";

return $output;