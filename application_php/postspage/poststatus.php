<?php

include "../dbinclude.php";


	$user_id = $_POST['userid'];
	$statustype = $_POST['statustype'];
$status_post_text = mysqli_real_escape_string($con,$_POST['statustext']);
$status_post_text = str_replace("'","\'",$status_post_text);

$result = "mistake";

			
if(isset($_POST['userid']))
{
 
 
 //get file
 $file = $_FILES['userfile']["tmp_name"];
 
$hashtag = gethashtags($status_post_text);

//check if file is there
 if($statustype=="imagestatus")
 	{
	 //check if file is image
	 $checkfileasimage = getimagesize($file);
	
	if ($checkfileasimage !== false) {
		
		$result=uploadphoto($con,$user_id,$status_post_text,$hashtag,$file);
			
	}
	else
	{
		$result="could not receive picture";
	}
 }elseif ($statustype=="musicstatus")
 {
 $musicFileType = pathinfo($file, PATHINFO_EXTENSION);
 
//if($musicFileType == "mp3" or
  //          $musicFileType == "mp4" or
    //        $musicFileType == "wave") {
				
				
			$result=uploadmusic($con,$user_id,$status_post_text,$hashtag,$file,$type);	
	
			
			
			
 
 }elseif($statustype=="normalstatus")
 {
	 if($status_post_text!=NULL || $status_post_text != "")
	 {
	 $result=postsimpletext($con,$user_id,$status_post_text);
	 }else
			{
				return "failure";
			}
	 
 }
 else
 {
	return  "failure";
}


 

 
 
 }
else
{
	return  "failure";



}
 

			
			
			
			function postsimpletext($con,$user_id,$status_post_text)
			{
				$status_post_time = date('y-m-d H:i:s');
				if (mysqli_query($con,"INSERT INTO status_post(Status_text,Status_type,Status_time,User_id) VALUES('$status_post_text','normal message','$status_post_time','$user_id')"))
				{
					return "success";
				};
			};
			
			
			function uploadphoto($con,$user_id,$status_post_text,$hashtag,$file)
			{
				
				$target_dir = '../../uploads/images/';
    $target_file = $target_dir . basename($file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
     
	$imageFileName = basename($file);
	 $image_time = date('y-m-d H:i:s');
	 
	 
   
 
	
	$saveName = $user_id.$image_time.$imageFileName;
  $saveName = str_replace(" ","_",$saveName);
  $saveName = str_replace(":","_",$saveName);
$saveName = $saveName.".jpg";
    if (move_uploaded_file($file,$target_dir.$saveName)) {
        
		
		$status_post_text = str_replace("'","\'",strip_tags(trim($status_post_text)));
		$status_post_text =  nl2br($status_post_text);

    $status_post_type = 'picture status';
    $status_post_time = date('y-m-d H:i:s');
    
  
    //$Ialbum = mysql_real_escape_string($con,$_POST['Ialbum']);
   
    
    If ($Ialbum == ''){
        $Ialbum = 'unsorted album';
    }
    
if (mysqli_query($con,"INSERT INTO status_post(Status_text,Status_type,Status_time,User_id,hashtag) VALUES('$status_post_text','$status_post_type','$status_post_time','$user_id','$hashtag')")) {
        
$conn = new mysqli("localhost", "myparkco_my_park", "+DE[Gu^z}ctW?QnAX6", "myparkco_mypark");
$query = "SELECT * FROM status_post WHERE User_id = '$user_id' AND Status_time = '$status_post_time'";

$response = $conn->query($query);

while ($row = $response->fetch_assoc()) {
  $status_post_id = $row['Status_id'];}
   $imageFileName = $saveName;
   
  
   if (mysqli_query($con,"INSERT INTO images_files (Image_Name,Image_date, Image_named, Image_Album, Image_Description, Image_Status, User_id,Status_id) VALUES ('$imageFileName','$image_time','$Iname', '$Ialbum', '$Idesc', 'Deactivated', '$user_id',$status_post_id);")) {
               return "success";     
					
			};
	}return "success";
			}
			else
			{
				return "picture not uploaded";
			}
			return "success";
			}
			
			
			
			function uploadmusic($con,$user_id,$status_post_text,$hashtag,$file,$type)
			{
				$type = mysqli_real_escape_string($con,$_POST['mytype']);
				
				$target_dir = '../../uploads/music/';
$status_post_time = date('y-m-d H:i:s');
$status_post_time_next = str_replace(':','_',$status_post_time);
    $target_file = str_replace(' ','_',$target_dir.$user_id.$status_post_time_next.basename($file).'.'.$type);
   
    $musicFileName = basename($file);



   
        if (move_uploaded_file($file, $target_file)) {
          
            $Talbum = mysqli_real_escape_string($con,$_POST['trackalbum']);
            $Tname = mysqli_real_escape_string($con,$_POST['tracktitle']);
            $Tartist = mysqli_real_escape_string($con,$_POST['trackartist']);
            $Treleasedate = date('y-m-d H:i:s');;
			$albumcover = getimagesize($_FILES['inputalbumart']["tmp_name"]);;
            $status_post_type = 'music status';
            $musicSaveName = str_replace(' ','_',$user_id.$status_post_time_next.basename($file).'.'.$type);
			$saveName = '';
			$Tdownload = mysqli_real_escape_string($con,$_POST['allowdownload']);
		

            if (mysqli_query($con,"INSERT INTO status_post(Status_text,Status_type,Status_time,User_id) VALUES('$status_post_text','$status_post_type','$status_post_time','$user_id')")) {

               
                $query = "SELECT * FROM status_post WHERE User_id = '$user_id' AND Status_time = '$status_post_time'";

                $response = $con->query($query);

                while ($row = $response->fetch_assoc()) {
                    $status_post_id = $row['Status_id'];
                }
                
               if ($Talbum == ''){
                   $Talbum = 'untitled';
               }
			 
			   if ($albumcover !== false)
			   {
				   $target_dir = '../../uploads/images/';
    $target_file = $target_dir . basename($_FILES ['inputalbumart']['name']);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$imageFileName = basename($_FILES ['inputalbumart']['name']);
	 $image_time = date('y-m-d H:i:s');
	 $image_time = str_replace(":","_",$image_time);
	 $image_time = str_replace(" ","_",$image_time);
	

    $check = getimagesize($_FILES['inputalbumart']["tmp_name"]);


   
$saveName = $user_id.$image_time.$imageFileName;
        if (move_uploaded_file($_FILES['inputalbumart']['tmp_name'], $target_dir.$saveName)) {
            
	}
	
			   }
			   else
			   {
				  $saveName =''; 
			   }
			   
               if ($Tname == ''){
                   $Tname = 'unknown';
               }
			   
			   
               if ($Tartist == ''){
                   $Tartist = 'unknown';
               }

                if (mysqli_query($con,"INSERT INTO music (Music_File_Name,Music_File_Type, Music_track, Music_album, Music_artist, Music_Release, Uploaded_date,User_id, Status_id, Music_cover,Music_download) 
                VALUES ('$musicSaveName','$musicFileType','$Tname', '$Talbum', '$Tartist', '$Treleasedate','$status_post_time','$user_id',$status_post_id, '$saveName', '$Tdownload')")) {
                   
       
        
                    
          
		   return "success";    }
            }
			else
			{
				return "failure";
			}
            
}


			};
			
			 function gethashtags($text)
{
  //Match the hashtags
  preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
  $hashtag = '';
  // For each hashtag, strip all characters but alpha numeric
  if(!empty($matchedHashtags[0])) {
	  foreach($matchedHashtags[0] as $match) {
		  $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
	  }
  }
    //to remove last comma in a string
return rtrim($hashtag, ',');
}

$resultarray = array("functionResult"=>$result);
 echo json_encode($resultarray);
mysqli_close($con);



			?>



