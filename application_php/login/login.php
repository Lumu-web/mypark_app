<?php

$con = mysqli_connect("localhost", "myparkco_my_park", "+DE[Gu^z}ctW?QnAX6", "myparkco_mypark");

$username =$_POST['loginname'];
$password =$_POST['password'];
 
$sql = "SELECT * FROM login_user inner join user_details on login_user.User_id = user_details.User_id WHERE (login_user.login_name = '$username' OR user_details.User_email = '$username' ) AND login_user.login_password = '$password'";
 $result ='failure';
$res = mysqli_query($con,$sql);
 
$check = mysqli_fetch_array($res);
 $response = $con->query($sql);
if(isset($check)){
	while ($row = $response->fetch_assoc()) {
	$user_id = $row['User_id'];}
$result = $user_id;
}else{
$result ='failure';
}

$resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
 
mysqli_close($con);

?>