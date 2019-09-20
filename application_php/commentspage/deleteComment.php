<?php

include "../dbinclude.php";


$commentid = $_POST['commentid'];
 
$sql = "Delete from comments_posts where Comment_id = '$commentid'";
 $result = "failure";
if(mysqli_query($con,$sql))
{
	$affected = mysqli_affected_rows($con);
	if($affected > 0)
	{
	$result = "completed";
	}
	else
	{
		$result = "failure";
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