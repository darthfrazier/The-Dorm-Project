<?php
//email signup ajax call
if($_GET['action'] == 'signup'){
	
	mysql_connect('localhost','root','root');  
	mysql_select_db('Testes');
	
	//sanitize data
	$email = mysql_real_escape_string($_POST['signup-email']);
	
	//validate email address - check if input was empty
	if(empty($email)){
		$status = "error";
		$message = "You did not enter an email address!";
	}
	else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.edu/', $email)){ //validate email address - check if is a valid email address
			$status = "error";
			$message = "You have entered an invalid email address!";
	}
	else {
		$existingSignup = mysql_query("SELECT * FROM signups WHERE signup_email_address='$email'");   
		if(mysql_num_rows($existingSignup) < 1){
			
			$date = date('Y-m-d');
			$time = date('H:i:s');
			$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
			
			$insertSignup = mysql_query("INSERT INTO signups (signup_email_address, signup_date, signup_time, hash) VALUES ('$email','$date','$time','$hash')");
			if($insertSignup){ //if insert is successful
				$status = "success";
				$message = 'Your account has been made! Please verify it by clicking the activation link that has been send to your email';
				
				$to      = $email; //Send email to our user
				$subject = 'Signup | Verification'; //// Give the email a subject 
				$message = '

					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

					------------------------
					Username: '.$name.'
					Password: '.$password.'
					------------------------

					Please click this link to activate your account:
					http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

					'; // Our message above including the link
					
				$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
				mail($to, $subject, $message, $headers); // Send the email
					
			}
			else { //if insert fails
				$status = "error";
				$message = "Ooops, Theres been a technical error!";	
			}
		}
		else { //if already signed up
			$status = "error";
			$message = "This email address has already been registered!";
		}
	}
	
	//return json response
	$data = array(
		'status' => $status,
		'message' => $message
	);
	
	echo json_encode($data);
	exit;
}
?>