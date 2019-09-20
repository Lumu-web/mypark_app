<?php

include "../dbinclude.php";


$statusId = $_POST['statusid'];
$userId = $_POST['userid'];


$sql = "Select * from likes where User_id='$userId' and Status_id = '$statusId'";

$resultarray = array();
$result;
 $result= "failure";
 if($res =  mysqli_query($con,$sql))
	{
		
		
 		

	
	
		if(mysqli_num_rows($res) > 0  )
 			{
	 			$result= "failure";
			}
 		else
 			{
				
				
				
				
				$sql = "INSERT INTO likes(Likes_type,User_id,Status_id) VALUES('like','$userId','$statusId')";
 
				if(mysqli_query($con,$sql))
				{

				$sql = "SELECT COUNT(Status_id) AS likes_amount FROM likes WHERE Status_id ='$statusId' ";

				
					 $response = $con->query($sql);
					while ($row = $response->fetch_assoc()) {
$result = $row['likes_amount'];
					}
				
				}
				else
				{
				
					$result= "failure";
				}
				
				
				
				
 			}
	
	
	
	
	
	
	
	
	
	
	}
	else
	{
		
	$result= "failure";
	}
 
$resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);

?>
