<?php

include "../dbinclude.php";

$statusId = $_POST['statusid'];
$userId = $_POST['userid'];
 
$sql = "Delete from likes where Status_id = '$statusId' and User_id = '$userId'";
 $result = "failure";
if(mysqli_query($con,$sql)){
$deleted =  mysqli_affected_rows($con);

if($deleted > 0 )
{
$sql = "SELECT Count(Status_id) AS likes_amount
FROM likes
WHERE Status_id ='$statusId'
";	
	
$response = $con->query($sql);
					while ($row = $response->fetch_assoc()) {
$result = $row['likes_amount'];
					}


}



}
else
{
	$result = "failure";
}
 
 $resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);




?>
