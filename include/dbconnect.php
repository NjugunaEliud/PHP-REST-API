<?php
$conn=mysqli_connect('localhost','root','','phpApi');
if($conn){
    // echo"Connection successful";  
}
else
{
    die("Connection failed" . mysqli.connect_error());   
}

?>