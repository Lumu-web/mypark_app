<?php
include "../dbinclude.php";

$status_id = $_POST['statusid'];
$user_id = $_POST['userid'];
$notified_id = $_POST['notifieduserid'];


$status_comment_text = mysqli_real_escape_string($con,$_POST['comment_text']);
 $status_comment_time = date('y-m-d H:i:s');
	
$sql_commentinsert= "INSERT INTO comments_posts(Comment_text,Comment_time, User_id, Status_id) VALUES('$status_comment_text','$status_comment_time','$user_id','$status_id')"; 

$sql_notificationinsert = "INSERT INTO notifications(Notifier_user_id,Notified_user_id,Notification_desc,Status_id,Notification_status) VALUES('$user_id','$notified_id','like comment','$status_id','unchecked')";
		
 $result = "success";
if(mysqli_query($con,$sql_commentinsert))
{
	if(mysqli_query($con,$sql_notificationinsert))
	{
	};
}
else
{
	$result = "failure";
}
$resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);



 
mysqli_close($con);
 
?>