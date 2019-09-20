<?php

$user_id = $_GET['statusid'];

include "../dbinclude.php";
 
$sql = "SELECT comments_posts . * , (

SELECT images_files.Image_Name
FROM images_files
WHERE images_files.User_id = comments_posts.User_id
AND images_files.Image_Status = 'Active'
) AS propic,(

SELECT status_post.User_id
FROM status_post
WHERE status_post.Status_id = comments_posts.Status_id
) AS useridforstatus,(

SELECT login_user.Login_name
FROM login_user
WHERE login_user.User_id = comments_posts.User_id
) AS comment_user_name,(

SELECT user_details.User_specialty
FROM user_details
WHERE user_details.User_id = comments_posts.User_id
) AS comment_user_specialty
FROM comments_posts
WHERE Status_id ='$user_id'";
 




 $response = $con->query($sql);


	

$result = array();
 
while ($row = $response->fetch_assoc()) {
	$comment_id = $row['Comment_id'];
    $comment_text = $row['Comment_text'];
	$comment_time = $row['Comment_time'];
	$comment_user_id = $row['User_id'];
	$comment_user_propic = $row['propic'];
	$comment_status_user_id = $row['useridforstatus'];
	$comment_user_name = $row['comment_user_name'];
	$comment_user_specialty = $row['comment_user_specialty'];
	
	
array_push($result,
array('CommentID'=>$comment_id,'CommentText'=>$comment_text,'CommentTime'=>$comment_time,'CommentUserID'=>$comment_user_id,'CommentUserProPic'=>$comment_user_propic,'CommentStatusUserID'=>$comment_status_user_id,'CommentUserName'=>$comment_user_name,'CommentUserSpecialty'=>$comment_user_specialty
));
}
 
echo json_encode($result);
 
mysqli_close($con);
 
?>