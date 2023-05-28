<?php
    session_start(); // start the session
    include("connection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
      
        $myusername = mysqli_real_escape_string($conn,$_POST['username']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
        $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
      
        // If result matched $myusername and $mypassword, table row must be 1 row
      
        //if($count == 1) {
            $_SESSION['login_user'] = $myusername; // Store the username in session variable
            header("location: index.php"); // Redirect to dashboard page
            exit(); // Exit the script after redirect
        }else {
            $error = "Your Login Name or Password is invalid";
        }
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<div class="container">
	<form action="" method="POST">
	<h1>Login</h1>
	<input type="text" id="username" name="username" placeholder="Username" required>
			
	<input type="password" id="password" name="password" placeholder="Password" required>

	<input type="submit" value="Login">
    
	</form>
	</div>
</body>
</html>
