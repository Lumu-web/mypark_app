<?php


$follower_id = $_POST['IN_follower_id'];
$followed_id = $_POST['IN_followed_id'];


include "../dbinclude.php";

$resultarray = array();
$result = "failure";
$follow_sql = "INSERT INTO following(following_flg_user_id,following_fld_user_id) VALUES('$follower_id','$followed_id')";
$follow2_sql = "INSERT INTO followed(followed_flg_user_id,followed_fld_user_id) VALUES('$follower_id','$followed_id')";
$follownotify_sql = "INSERT INTO notifications(Notifier_user_id,Notified_user_id,Notification_desc,Notification_status) VALUES('$follower_id','$followed_id','$notification_desc','unchecked')";

if(mysqli_query($con,$follow_sql))
{

mysqli_query($con,$follow2_sql);

mysqli_query($con,$follownotify_sql);

$result = "success";

}

$resultarray = array("functionResult"=>$result);   
echo json_encode($resultarray);
 
mysqli_close($con);

?>