<?php
		
	session_start();
	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	
?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
 		
  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Logged Out | Travel Buddies</title> 
    
    	<link href="css/main.css" rel="stylesheet">
    	
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	
    		
	</head>
	
	<body>
		
			<div class="container-fluid">
		
				<div class="col-sm-12 messages">
						
					<div class="col-sm-12 text-center">
							
						<div class="col-sm-12 heading">
							Log Out Successfull
						</div>
								
					</div>
					
					<div class="col-sm-3"></div> <!-- empty class -->
					
						<div class="col-sm-6 containerBox">
						
							<div class="col-sm-12 text">
								
								You've logged out successfully.
								
							</div>
							
							<div class="col-sm-12 text-center">
								<a href="index.php"> <!-- change it to index.php when it is done -->
									<input type="button" class="button" name="home" value="Home Page">
								</a>
							</div>
							
						</div>
					
					<div class="col-sm-3"></div> <!-- empty class -->
						
				</div>
		
			</div> <!-- container-fluid -->
	</body>
	
</html>
	
	