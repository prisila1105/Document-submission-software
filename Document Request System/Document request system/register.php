<?php

session_start(); // start the session
include("connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // User successfully added to the database
      // Set a session variable to indicate that the user is logged in
      $_SESSION['login_user'] = $username;

      // Redirect the user to the dashboard or home page
      header("Location: index.php");
      exit(); // Exit the script after redirect
    } else {
      // Error adding user to the database
      echo "Error: " . mysqli_error($conn);
      exit(); // Exit the script after redirect

	}
}

?>