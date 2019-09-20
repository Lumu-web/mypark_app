<?php


include "../dbinclude.php";
 
$sql = "select * from locations";
 
$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = mysqli_fetch_array($res)){
	
	$city=trim($row[1]);
	$province = trim($row[2]);
	$location = $city.", ".$province;
array_push($result,
array('location'=>$location
));
}
 
echo json_encode($result);
 
mysqli_close($con);
 
?>