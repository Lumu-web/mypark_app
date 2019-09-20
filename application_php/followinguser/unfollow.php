<?php


$follower_id = $_POST['IN_follower_id'];
$followed_id = $_POST['IN_followed_id'];


include "../dbinclude.php";
$result = "failure";

$follow = "DELETE FROM following WHERE following_flg_user_id = '$follower_id' AND Following_fld_user_id = '$followed_id'";

$follow2 = "DELETE FROM followed WHERE followed_fld_user_id = '$followed_id' AND followed_flg_user_id = '$follower_id'";

if(mysqli_query($con,$follow))
{
	mysqli_query($con,$follow2);
	$result = "success";
}

$resultarray = array("functionResult"=>$result);   
echo json_encode($resultarray);
 
mysqli_close($con);

?>