<?php

include "../dbinclude.php";

$email = $_POST['email'];
 
$sql = "SELECT * from user_details where User_email = '$email'";
 
$res = mysqli_query($con,$sql);
 
$check = mysqli_fetch_array($res);
 
if(isset($check)){
echo 'failure';
}else{
echo 'success';
}
 
mysqli_close($con);

?>