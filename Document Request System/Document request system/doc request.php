<?php include ("connection.php"); ?>

<!DOCTYPE html>    
<html lang ="en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale= 1.0">
        <title>Document Request</title>
        <link rel="stylesheet" href="style.css">
        
</head>

   <nav>
    <h1>SK+F</h1>
   </nav>

<body>
        <div class="container">
            <form id ="myForm" action="email.php" method="POST" enctype="multipart/form-data">
             
                <h3> Document Upload Form</h3>
                <input type="text" id="name" placeholder="Vendor name" name ="fname" required>
                <input type="text" id="email" placeholder="Email" name ="femail" required>
                <textarea id="message" placeholder="Document details" name ="fmessage" required></textarea>
                
                <div class="file-upload" required>
                <input class = "file-upload__input" type="file" name="myFile[]" id="myFile" multiple>
                <button class="file-upload__button" type="button"> Choose File(s)</button>
                <span class="file-upload__label">No file(s)selected </span>
                </div>
                
                <button type="submit" name ="register"> Send</button>
            </form>
        </div>
        
<script  src="script.js"> </script>

</body>      
</html>


<?php

if(isset($_POST['register'])){
    $fname = $_POST['fname'];
    $femail = $_POST['femail'];
    $fmessage = $_POST['fmessage'];

    try {
    
    // Upload files
    $fileNames = array_filter($_FILES['myFile']['name']);
    if(!empty($fileNames)){
        foreach($_FILES['myFile']['tmp_name'] as $key=>$tmp_name ){
            $file_name = $key.$_FILES['myFile']['name'][$key];
            $file_size =$_FILES['myFile']['size'][$key];
            $file_tmp =$_FILES['myFile']['tmp_name'][$key];
            $file_type=$_FILES['myFile']['type'][$key];

            $file_path = "uploads/".$file_name;
            move_uploaded_file($file_tmp,$file_path);

            // Insert file details into database
            $sql = "INSERT INTO doc (vendor_name, email, details, file_name, file_size, file_path, file_type)
                    VALUES ('$fname', '$femail', '$fmessage', '$file_name', '$file_size', '$file_path', '$file_type')";
            mysqli_query($conn, $sql);
        }
    }

    } catch (Exception $e) {
        // Handle the exception
        echo 'Caught exception:' , $e->getMessage() ,"\n";
        
    }

    mysqli_close($conn);
}

?>

