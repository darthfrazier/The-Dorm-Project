<?php include ('signup.php')?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Blackshark</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content='' />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#emailsignup').submit(function(){
				
				//check the form is not currently submitting
				if($(this).data('formstatus') !== 'submitting'){
				
					//setup variables
					var form = $(this),
						formData = form.serialize(),
						formUrl = form.attr('action'),
						formMethod = form.attr('method'), 
						responseMsg = $('#signup-response');
					
					//add status data to form
					form.data('formstatus','submitting');
					
					//show response message - waiting
					responseMsg.hide()
							   .addClass('response-waiting')
							   .text('Please Wait...')
							   .fadeIn(200);
					
					//send data to server for validation
					$.ajax({
						url: formUrl,
						type: formMethod,
						data: formData,
						success:function(data){
							
							//setup variables
							var responseData = jQuery.parseJSON(data), 
								klass = '';
							
							//response conditional
							switch(responseData.status){
								case 'error':
									klass = 'response-error';
								break;
								case 'success':
									klass = 'response-success';
								break;	
							}
							
							//show reponse message
							responseMsg.fadeOut(200,function(){
								$(this).removeClass('response-waiting')
									   .addClass(klass)
									   .text(responseData.message)
									   .fadeIn(200,function(){
										   //set timeout to hide response message
										   setTimeout(function(){
											   responseMsg.fadeOut(200,function(){
											       $(this).removeClass(klass);
												   form.data('formstatus','idle');
											   });
										   },3000)
										});
							});
						}
					});
				}
				
				//prevent form from submitting
				return false;
			});
		});
		</script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
<body>

		<!-- Header -->
			<section id="header" class="dark">
				<header>
                	<div class= "transbox">
					<h1>Welcome to BlackShark</h1>
					<p>A Random College Chat Site by <a href="file:///Volumes/Macintosh%20HD/Users/Karl%20Frazier/Documents/Academics/Project%20Blackshark/test_page.html">Team Rocket</a></p>
					</div>
			</header>
			<footer>
                  <form id="emailsignup" action="?action=signup" method="post">
           			<input name="signup-email" id="signup-email" type="text" placeholder="student@ivyleagueuniversity.edu" required/>
                	<input name="enter" id="signup-button" type="submit" class="submit_button" value="Verify E-mail"/> 	
              		<p id="signup-response"></p>
              		<form>
                    <br><br><br>
             <!--<a href="#first" class="button scrolly">Learn More</a>-->  
            </footer>
             </section>
			
		<!-- First -->
			<section id="first" class="main">
				<header style="background:white">
					<div class="container">
						<h2><strong>Blackshark is the Future of Random Chat</strong></h2>
						<p>Meet other students within the Ivy league either randomly, or on your own terms</p>
					</div>
				</header>
				<div class="content dark style1 featured">
					<div class="container">
						<div class="row">
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-video-camera"></span></span>
									<header>
										<h3>Meet New People</h3>
									</header>
									<p>Talk with other students from the other Ivy League Schools.  Have legitimate conversations, or just chat.  Its up to you!<span style="color: black"></span></p>
								</section>
							</div>
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-search"></span></span>
									<header>
										<h3>Customize Your Randomness</h3>
									</header>
									<p>Use the search filters to target what type of person you want to talk to. You can search by school, by major, or even by location.</p>
								</section>
							</div>
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-lock"></span></span>
									<header>
										<h3>Anonymity</h3>
									</header>
									<p>The entire chat is 100% anonymous. You do not have to worry about your chat partner knowing who you are. Unless of course you want to, in which case you can use the share buttons.</p>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<footer>
                    			<p>Just enter your .edu Ivy League email address above to get started.  No accounts, no passwords, no hassle!<p>
                    
								</footer>
							</div>
						</div>
					</div>
				</div>
</section>

		
			
		
	
		
		
			
		<!-- Footer -->
			<section id="footer">
				<ul class="icons">
					<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
					<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
					<li><a href="#" class="fa fa-google-plus solo"><span>Google+</span></a></li>
				</ul>
				<div class="copyright">
					<ul class="menu">
						<li>&copy; Team Rocket. All rights reserved.</li>
						<li>Design: <a href="http://html5up.net/">Karl Frazier & HTML5 UP</a></li>
					</ul>
				</div>
			</section>

</body>
</html>