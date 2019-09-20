<?php

include "../dbinclude.php";


	$user_id = $_POST['userid'];
	

$result = "failure";

			
if(isset($_POST['userid']))
{
 
 
 //get file
 $file = $_FILES['userfile']["tmp_name"];

//check if file is there
 //check if file is image
	 $checkfileasimage = getimagesize($file);
	
	if ($checkfileasimage !== false) {
		
		$result=uploadphoto($con,$user_id,$file);
			
	}
	else
	{
		$result="not a picture";
	} 
 
 }
 

	
			function uploadphoto($con,$user_id,$file)
			{
				
				$target_dir = '../../uploads/images/';
    $target_file = $target_dir . basename($file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
     
	$imageFileName = "profile_image";
	 $image_time = date('y-m-d H:i:s');
	 
	 
   
 
	$status_post_time = $image_time;
	$saveName = $user_id.$imageFileName;
  $saveName = str_replace(" ","_",$saveName);
  $saveName = str_replace(":","_",$saveName);
$saveName = $saveName.".jpg";
if(file_exists($target_dir.$saveName)) unlink($target_dir.$saveName);
    if (move_uploaded_file($file,$target_dir.$saveName)) {   
  
    //$Ialbum = mysql_real_escape_string($con,$_POST['Ialbum']);
   



  
   if ( mysqli_query($con,"INSERT INTO status_post(Status_text,Status_type,Status_time,User_id) VALUES('Changed profile picture...','picture status','$status_post_time','$user_id')")) {
	   
	  
	   
	    $query = "SELECT * FROM status_post WHERE Status_time = '$status_post_time' AND User_id = '$user_id' ";

    $response = mysqli_query($con,$query);
  
 $statusid= null;
    while ($row = mysqli_fetch_assoc($response)) {
       $statusid = $row['Status_id'];
    }
	
	mysqli_query($con,"Update images_files set Image_Name = '$saveName' , Image_date = '$image_time', Status_id = '$statusid' where User_id ='$user_id' and Image_Status = 'Active'");
	
	   
               return "success";     
					
			}else{return "could not add to database";};
	}else{return "could not upload";}
			}
	
			
			

$resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);



			?>