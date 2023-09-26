
<?php
include "ConnectMysql.php";
$UserID = $_POST['UserID'];
$Password = $_POST['Password'];
$role = $_POST['role']=="user"?0:1;
$query = "SELECT * from Account where ID = '". $UserID ."' AND Role =". $role;
$result = mysqli_query($connect, $query);
if (!$result){
    die("Could not successfully run query." . mysqli_error($connect) );
}
if(mysqli_num_rows($result)==0){
echo "<script>location.href ='../html/UserLogin.html?msg=The User ID does not exist!'; </script>";
}else{
    $row = mysqli_fetch_assoc($result);
    if($row['Password'] == $Password){
        setcookie("UserID",$UserID,time()+60*60*2,"/");
        // setcookie("Role",$role,time()+60*60*2,"/");
        // $query = "SELECT * from UserInfo where UserID = '". $UserID ."'";
        // $result = mysqli_query($connect, $query);
        // $row = mysqli_fetch_assoc($result);
        // $NickName = $row['NickName'];
        // setcookie("NickName",$NickName,time()+60*60*2,"/");
        if($role==0)
            echo "<script>location.href='../php/ViewNoticesNew.php';</script>";
        else
            echo "<script>location.href='../php/AdminRegisteredUsersNew.php';</script>";
    }else{
        echo "<script>location.href ='../html/UserLogin.html?msg=Wrong password!'; </script>";
    }
}

?>