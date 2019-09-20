<?php

$user_id = $_POST['userid'];

include "../dbinclude.php";
 
$sql = "SELECT * FROM notifications WHERE  Notified_user_id = '$user_id' AND Notifier_user_id != '$user_id' AND Notification_status = 'unchecked";
 
$res = mysqli_query($con,$sql);



 $response = $con->query($sql);

$notifyamount = mysqli_num_rows($response);
	if (empty($notifyamount) || $notifyamount ==0 )
	{
		echo 0;
	}
	else
	{
		echo $notifyamount;
	}

 

 
mysqli_close($con);
 
?>