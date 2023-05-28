<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include ("connection.php"); 

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Check if form is submitted
if(isset($_POST['register'])){

    // Get form data
    $fname = $_POST['fname'];
    $femail = $_POST['femail'];
    $fmessage = $_POST['fmessage'];

    // Upload files
    $fileNames = array_filter($_FILES['myFile']['name']);
    if(!empty($fileNames)){
        foreach($_FILES['myFile']['tmp_name'] as $key=>$tmp_name ){
            $file_name = $key.$_FILES['myFile']['name'][$key];
            $file_size = $_FILES['myFile']['size'][$key];
            $file_tmp = $_FILES['myFile']['tmp_name'][$key];
            $file_type = $_FILES['myFile']['type'][$key];

            $file_path = "uploads/".$file_name;
            move_uploaded_file($file_tmp,$file_path);
           

            // Insert file details into database
            $sql = "INSERT INTO doc (vendor_name, email, details, file_name, file_size, file_path, file_type)
                    VALUES ('$fname', '$femail', '$fmessage', '$file_name', '$file_size', '$file_path', '$file_type')";
            mysqli_query($conn, $sql);

        }
    }

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'skf123pharma@gmail.com';               // SMTP username
            $mail->Password   = 'misnwqzddldoxued';                     // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            // Recipients
            $mail->setFrom('skf123pharma@gmail.com', 'Skf pharmaceutical ltd');
            $mail->addAddress($femail);     // Add a recipient

            // Attach files
            if(!empty($fileNames)){
            foreach($_FILES['myFile']['tmp_name'] as $key=>$tmp_name ){
                $file_name = $key.$_FILES['myFile']['name'][$key];
                $file_path = "uploads/".$file_name;
                $mail->addAttachment($file_path,$file_name);         // Add attachments

            }
         }

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Request for document submission';
            $mail->Body = "<p><h4>$fmessage Please visit this link to access the form: <a href='http://localhost/Document%20request%20system/doc%20request.php'>http://localhost/Document request system/doc request.php</a></p>";
   

            $mail->send();
            echo 'Message has been sent';


        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    

    mysqli_close($conn);
}

?>
