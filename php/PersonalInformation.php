
<?php
include "ConnectMysql.php";
if(isset($_POST['update'])){
    include "StorePicture.php";//got $uploadfile here
    $NickName = $_POST['NickName'];
    $Email = $_POST['Email'];
    $GenderNum = $_POST['Gender']=="Male"?0:1;
    $Birthday = $_POST['Birthday'];
    if(isset($uploadfile)){
        $sql = "UPDATE userinfo SET NickName = '$NickName', Email = '$Email', Gender=$GenderNum, Birthday = '$Birthday', ProfileImage='$uploadfile'
        WHERE UserID = '".$_COOKIE['UserID']."'";
    }
    else{
        $sql = "UPDATE userinfo SET NickName = '$NickName', Email = '$Email', Gender=$GenderNum, Birthday = '$Birthday'
        WHERE UserID = '".$_COOKIE['UserID']."'";
    }
    if($connect->query($sql)===true)
        echo "<script>location.href ='../php/InformationUpdateNew.php?type=1&msg=Successfully Update your information!'; </script>";
    else
        echo $connect->error;
}              
?> 