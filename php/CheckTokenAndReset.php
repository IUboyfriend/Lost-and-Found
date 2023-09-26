<?php
include "ConnectMysql.php";
$UserID = $_POST['UserID'];
$Token = $_POST['Token'];
$Password = $_POST['Password'];
$query = "SELECT * FROM Account WHERE ID='".$UserID."'";
$result = mysqli_query($connect, $query);
$row=mysqli_fetch_assoc($result);
if($row['Token']==$Token){
    $sql = "UPDATE Account SET Password = '$Password' WHERE ID = '".$UserID."'";
    $connect->query($sql);
    echo "<script>location.href ='../html/UserLogin.html?type=1&msg=Successfully reset your password!'; </script>";
}else{
    echo "<script>location.href ='../php/resetPassword.php?UserID=$UserID&msg=Wrong token!'; </script>";
}

?>