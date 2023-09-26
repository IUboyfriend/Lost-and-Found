
<link href="../testing/CodeSeven-toastr-2.1.4-7-g50092cc/CodeSeven-toastr-50092cc/build/toastr.min.css" rel="stylesheet" type="text/css"/>
<script src="../resources/assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../testing/CodeSeven-toastr-2.1.4-7-g50092cc/CodeSeven-toastr-50092cc/toastr.js" ></script>


<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<?php
include "ConnectMysql.php";
$UserID = $_POST['UserID'];
$Password = $_POST['Password'];
$NickName = $_POST['NickName'];
$Email = $_POST['Email'];
$Gender = $_POST['GenderVal'];
$Birthday = $_POST['Birthday'];


//Store the uploaded picture to the server's folder
include "StorePicture.php";

//Upload the Account table
$query = "SELECT * FROM account WHERE ID = '" .$UserID. "'";
$result = mysqli_query($connect, $query);
if (!$result)
    die("Could not successfully run query." . mysqli_error($connect) );
if(mysqli_num_rows($result)==0){
    $sql = "INSERT INTO account VALUES ('$UserID','$Password', 0,null)";
    if($connect->query($sql)===true){
        UpdateUserInfoTable();
    }
    else
        die($connect->error);
}else
    echo "<script>location.href ='../html/UserRegistration.html?msg=The id has already existed!'; </script>";

//Upload the UserInfo table
function UpdateUserInfoTable(){
    global $UserID,$NickName,$Email,$Gender,$Birthday,$uploadfile,$connect;
    $GenderNum = $Gender == 'Male'? 0:1;
    $sql = "INSERT INTO userinfo VALUES ('$UserID','$NickName','$Email','$uploadfile',$GenderNum,'$Birthday')";
    if($connect->query($sql)===true)
        echo "<script>location.href ='../html/UserLogin.html?type=1&msg= Register new user $NickName!'; </script>";
      
    else
        die($connect->error);
}
mysqli_close($connect); 


?>