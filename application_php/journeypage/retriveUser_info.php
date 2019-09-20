<?php

$user_id = $_GET['userid'];
$myuser_id = $_GET['myuserid'];

include "../dbinclude.php";
 
$sql = "SELECT Login_name,(

SELECT User_specialty
FROM user_details
WHERE User_id = '$user_id'
) AS speciality, (

SELECT Image_Name
FROM images_files
WHERE Cover_image = 'true'
AND User_id = '$user_id'
) AS coverimage, (

SELECT Image_Name
FROM images_files
WHERE Image_Status = 'active'
AND User_id = '$user_id'
) AS propic
, (

SELECT count(followed_fld_user_id)
FROM followed
WHERE followed_fld_user_id = '$user_id' and followed_flg_user_id != '$user_id'
) AS followercount
, (

SELECT count(following_flg_user_id)
FROM following
WHERE following_flg_user_id = '$user_id' and following_fld_user_id != '$user_id'
) AS followingcount,
(SELECT count(following_flg_user_id)
FROM following
WHERE following_flg_user_id = '$myuser_id' and following_fld_user_id = '$user_id' and '$myuser_id' != '$user_id'
) AS followingthisuser

FROM login_user
WHERE User_id = '$user_id'";
 
$res = mysqli_query($con,$sql);



 $response = $con->query($sql);


	

$result = array();
 
$row = $response->fetch_assoc();
	$user_login_name = $row['Login_name'];
	$user_speciality = $row['speciality'];
	$user_cover_image = $row['coverimage'];
	$user_propic = $row['propic'];
	$user_follwers_count = $row['followercount'];
	$user_following_count = $row['followingcount'];
	$user_is_being_followed_by_me = $row['followingthisuser'];
 
	


 $resultarray = array("LoginName"=>$user_login_name,"UserSpeciality"=>$user_speciality,"UserCoverImage"=>$user_cover_image,"UserProPic"=>$user_propic,"FollowersCount"=>$user_follwers_count,"FollowingCount"=>$user_following_count,"Followingbool"=>$user_is_being_followed_by_me);
echo json_encode($resultarray);
 
mysqli_close($con);
 
?>