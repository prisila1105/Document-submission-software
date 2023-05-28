<?php
$servername = "localhost";
$username = "root";
$password = "NO";
$dbname = "document _request";

$conn = mysqli_connect ($servername,$username,$password,$dbname);

if ($conn)
{
    //echo "Connection successful";
}
else {
    echo "Connecton failed".mysqli_connect_error();

}

?>






