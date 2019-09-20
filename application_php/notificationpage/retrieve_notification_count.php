<?php

$user_id = $_GET['userid'];

include "../dbinclude.php";
 
$sql = "SELECT * FROM notifications WHERE  Notified_user_id = '$user_id' AND Notifier_user_id != '$user_id' AND Notification_status = 'unchecked'";
 
$res = mysqli_query($con,$sql);



 $response = $con->query($sql);

$result =  mysqli_num_rows($response);	


 
 $resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);



 
?>