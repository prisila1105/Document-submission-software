<?php include ("connection.php"); ?>

<?php
    session_start(); // start the session

    if(!isset($_SESSION['login_user'])){ // if the user is not logged in
        header("location: login.php"); // redirect to login page
    }
?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale= 1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Dashboard | SK+F </title>
</head>

      
<body>

    <nav>
    <h1>SK+F</h1>
    </nav>
    <!--sidebar start-->
        
    <div class="sidebar">
        
    <div class="menu">
    <h2>DashBoard</h2>
            
    <div class="item"><a href = "#"><i class="fa-solid fa-user"></i>  <?php echo $_SESSION['login_user']; ?> </a></div>
    <div class="item"><a href = "doc request.php"><i class="fa-solid fa-file"></i> Document Request </a></div>
    <div class="item"><a href = "#"><i class="fa-solid fa-envelope"></i> Notification </a></div>
    <div class="item"><a href = "#"><i class="fa-solid fa-right-from-bracket"></i> LogOut </a></div>
                    
    </div>


  
    <!--sidebar end-->
     
    </body>
    
    </html>
    


    


