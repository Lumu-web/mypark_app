<?php

$user_id = $_POST['userid'];

include "../dbinclude.php";
 
$sql = "SELECT n.*, l.Login_name, i.Image_Name
FROM notifications AS n
INNER JOIN login_user AS l ON n.Notifier_user_id = l.User_id
INNER JOIN images_files as i ON n.Notifier_user_id = i.User_id
WHERE n.Notified_user_id = '$user_id'
AND n.Notifier_user_id != '$user_id'
AND n.Notification_status = 'unchecked'
AND i.Image_Status = 'Active'
ORDER BY n.Notification_time DESC
";
 
$res = mysqli_query($con,$sql);



 $response = $con->query($sql);


$result = array();
 
while ($row = $response->fetch_assoc()) {
	$Notification_id = $row['Notification_id'];
    $Notifier_id = $row['Notifier_user_id'];
	$Notified_id = $row['Notified_user_id'];
	$Notification_desc = $row['Notification_desc'];
	$Notification_status = $row['Notification_status'];
	
	$show_time= $row['Notification_time'];
	$Status_id = $row['Status_id'];
	$Notifier_username = $row['Login_name'];
	$Notifier_Propic = $row['Image_Name'];
	
	$time = floor(time() - strtotime($show_time));
                                    $days = 0;

                                    if ($time < 60) {
                                        if ($time == 1 OR $time == 0) {
                                            $show_date = "just now";
                                        } else {
                                            $show_date = $time . " seconds ago";
                                        }
                                    } elseif ($time < 3600) {

                                        $min = floor($time / 60);
                                        $sec = $time - ($min * 60);
                                        if ($min == 1) {
                                            $show_date = $min . "m";
                                        } else {
                                            $show_date = $min . "m";
                                        }
                                    } elseif ($time < 86400) {
                                        $hours = floor($time / 3600);

                                        if ($hours == 1) {
                                            $show_date = $hours . "h";
                                        } else {
                                            $show_date = $hours . "h";
                                        }
                                    } elseif ($time < 604800) {

                                        $days = floor($time / 86400);

                                        if ($days == 1) {
                                            $show_date = $days . "d";
                                        } else {
                                            $show_date = $days . "d";
                                        }
                                         } elseif ($time < 2419200) {

                                $weeks = floor($time / 604800);

                                if ($weeks == 1) {
                                    $show_date = $weeks . "w";
                                } else {
                                    $show_date = $weeks . "w";
                                }
                                    } else {

                                       $postdate = date_create($show_time);
										
                                        $show_date = date_format($postdate,"d M y");
                                    }
						$Notification_time = $show_date;	
	
array_push($result,
array('NotificationId'=>$Notification_id,'NotifierUserId'=>$Notifier_id,'NotifiedUserId'=>$Notified_id,'NotificationDesc'=>$Notification_desc,'NotificationStatus'=>$Notification_status,'NotificationTime'=>$Notification_time,'StatusId'=>$Status_id,'Notifier_username'=>$Notifier_username,'Notifier_propic'=>$Notifier_Propic
));
}
 
echo json_encode($result);	

mysqli_close($con);
 
?>
