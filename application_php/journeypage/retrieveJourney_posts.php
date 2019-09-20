<?php

$user_id = $_POST['userid'];

include "../dbinclude.php";
 
$sql = " 
SELECT status_post.Status_id, status_post.Status_text, status_post.Status_type, status_post.Status_time, status_post.User_id, status_post.hashtag, status_post.Youtube_embed, images_files.Image_Name, music.Music_File_Name, music.Music_track, music.Music_album, music.Music_artist, music.Music_cover, login_user.Login_name, user_details.User_specialty, user_details.User_id,  (

SELECT images_files.Image_Name
FROM images_files
WHERE images_files.User_id = status_post.User_id
AND images_files.Image_Status = 'Active'
) AS propic,(

SELECT COUNT(likes.Status_id)
FROM likes
WHERE likes.Status_id = status_post.Status_id
) AS likes_amount

,(

SELECT COUNT(likes.Status_id)
FROM likes
WHERE likes.Status_id = status_post.Status_id
    and
    likes.User_id = '$user_id'
) AS your_like
FROM status_post
LEFT JOIN images_files ON status_post.Status_id = images_files.Status_id
LEFT JOIN music ON  status_post.Status_id = music.Status_id
LEFT JOIN login_user ON status_post.User_id = login_user.User_id
LEFT JOIN user_details ON status_post.User_id = user_details.User_id
WHERE status_post.User_id ='$user_id' order by Status_time DESC
Limit 0,10";
 
$res = mysqli_query($con,$sql);



 $response = $con->query($sql);


	

$result = array();
 
while ($row = $response->fetch_assoc()) {
	$posted_status_id = $row['Status_id'];
    $posted_status_type = $row['Status_type'];
	$posted_status_text = $row['Status_text'];
	$posted_status_time = $row['Status_time'];
	$posted_Youtube_embed = $row['Youtube_embed'];
	$posted_Image = $row['Image_Name'];
	$posted_Music = $row['Music_File_Name'];
	$posted_Username = $row['Login_name'];
	$posted_user_Speciality = $row['User_specialty'];
	$posted_user_id = $row['User_id'];
	$posted_user_pro_pic = $row['propic'];
	$posted_status_like_amount= $row['likes_amount'];
	$posted_Status_your_like = $row['your_like'];
	$posted_Music_artist = $row['Music_artist'];
	$posted_Music_track = $row['Music_track'];
	$posted_Music_album = $row['Music_album'];
	$posted_Music_cover = $row['Music_cover'];
	
array_push($result,
array('StatusID'=>$posted_status_id,'StatusType'=>$posted_status_type,'StatusText'=>$posted_status_text,'StatusTime'=>$posted_status_time,'StatusYoutube'=>$posted_Youtube_embed,'StatusImage'=>$posted_Image,'StatusMusic'=>$posted_Music,'StatusUsername'=>$posted_Username,'StatusUserSpeciality'=>$posted_user_Speciality,'StatusUserID'=>$posted_user_id,'StatusUserProPic' => $posted_user_pro_pic,'StatusLikes' => $posted_status_like_amount,'StatusYourLike' => $posted_Status_your_like,'MusicArtist' => $posted_Music_artist,'MusicTrack' => $posted_Music_track,'MusicAlbum' => $posted_Music_album,'MusicCover' => $posted_Music_cover, 'MusicFileName' => $posted_Music
));
}
 
echo json_encode($result);
 
mysqli_close($con);
 
?>