<?php

include "../dbinclude.php";

$userId = $_POST['userid'];
$statusId = $_POST['statusid'];
 
$sql = "Delete from status_post where Status_id = '$statusId' and User_id = '$userId'";
 $result = "failure";
if(mysqli_query($con,$sql))
{
	$sql = "Delete from likes where Status_id = '$statusId'";
	if(mysqli_query($con,$sql))
	{
	$result = "completed";
	}
}
else
{
	$result = "failure";
};
 
 $resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);

?>
