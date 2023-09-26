<?php
include "ConnectMysql.php";
$NoticeID=$_POST['NoticeID'];
$response=$_POST['response'];
$query="SELECT UserID FROM notice where NoticeID = '". $NoticeID ."'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$ToUserID = $row['UserID'];
$ByUserID = $_COOKIE['UserID'];
$ResTime=date("Y-m-d");
$sql = "INSERT INTO response VALUES ('$NoticeID','$response','$ToUserID','$ByUserID','$ResTime')";
if($connect->query($sql)===true){
    $sql = "UPDATE notice SET Status = 1 WHERE NoticeID ='". $NoticeID ."'";
    if($connect->query($sql)===true){
        echo "<script>location.href ='../php/ViewNoticesNew.php?type=1&msg=Successfully response to a notice!'; </script>";
    }
}
else
    echo $connect->error;
?>