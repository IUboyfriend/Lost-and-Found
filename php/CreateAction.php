<?php
include "ConnectMysql.php";
$UserID = $_COOKIE['UserID'];
$Type = $_POST['Type']=="Lost"?0:1;
$Date = $_POST['Date'];
$Venue = $_POST['Venue'];
$Contact = $_POST['Contact'];
$Description = $_POST['Description'];

include "StorePicture.php";
$NoticeID = random(10);

$sql = "INSERT INTO Notice VALUES ('$NoticeID','$UserID',$Type,'$Date','$Venue','$Contact','$Description','$uploadfile',0)";
if($connect->query($sql)===true){
    echo "<script>location.href ='../php/ViewNoticesNew.php?type=1&msg=Successfully create a new notice!'; </script>";
}
else
    echo $connect->error;

mysqli_close($connect); 


?>