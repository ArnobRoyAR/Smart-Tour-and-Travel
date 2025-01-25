<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
	
  		<meta charset="UTF-8">
  		
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Login | travel_management</title>
    
    	<link href="css/logincss.css" rel="stylesheet">
    	
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    
    		
	</head>
	
	<!-- HEAD TAG ENDS -->
	
	<!-- BODY TAG STARTS -->
	
	<body>
	
		<div class="container-fluid">
		
		<div class="login">
				
			<div class="col-sm-12">
					
				<div class="heading text-center">
					Login
				</div>
						
			</div>
			
			<div class="col-sm-6 col-sm-offset-3">
				
				<div class="containerBox">
				
				<form action="loginAction.php" method="POST">
					
					<label for="username">Username:</label>
					<input type="text" class="input" name="username" placeholder="Enter username here" required>
					
					<label for="password">Password:</label>
					<input type="password" class="input" name="password" placeholder="Enter password here" required>
					
					<div class="col-sm-12 text-center">
					<input type="submit" class="button" name="login" value="Login">
					</div>
					
					<!-- <a href="forgotPassword.php"><p class="col-xs-12 dots" style="color: white; font-size: 1.1em; margin-top: 1em; text-align: center;">Forgot Password?</p></a> -->
					<?php
// Example PHP logic
$showForgotPassword = true;

if ($showForgotPassword): ?>
    <a href="forgotPassword.php">
        <p class="col-xs-12 dots">Forgot Password?</p>
    </a>
<?php endif; ?>

				</form>
				
					<div class="col-sm-12 text-center">
						<div class="signupPrompt">
							New user? <a href="signup.php"><span class="dots">Sign Up</span></a> instead.
							<br>
							<a href="Management/adminLogin.php"><span class="dots">Admin Login</span></a> instead.

						</div>
					</div>
				
				</div>
				
			</div>
			
		</div>
		
		</div> <!-- container-fluid -->
		
	</body>
	

	<!-- BODY TAG ENDS -->
	
</html>
	