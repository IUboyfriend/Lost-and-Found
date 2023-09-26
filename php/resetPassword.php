<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/png" href="../resources/Img/PolyU.png">
    <title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="../resources/UserLogin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="../resources/UserLogin/css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="../resources/css/toggle.css">
<!-- pop up window -->
<script src='../resources/toastr/jquery.min.js'></script>
<link href='../resources/toastr/toastr.min.css' rel='stylesheet' type='text/css' />
<script src='../resources/toastr/toastr.min.js'></script>
<script src="../js/popup.js"></script>
<!-- pop up window -->
</head>


<?php
if(isset($_POST['UserID'])){
    $UserID = $_POST['UserID'];
	include "ConnectMysql.php";
	$query ="SELECT * from UserInfo where UserID='".$UserID."'";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result)==0){
		echo "<script>location.href ='../html/Forgetpassword.html?msg=The id does not exist!'; </script>";
	}else{
		include "sendEmail.php";
	}

}else if(isset($_GET['UserID'])){
    $UserID = $_GET['UserID'];
}


    ?>
<body>
	<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../resources/Img/loseWallet.jpg');">
			<div class="wrap-login100">
				<form id = "1" class="login100-form validate-form" action="../php/CheckTokenAndReset.php" method="post">
					<span class="login100-form-logo">
                        <image src="../resources/Img/PolyU.png" style="width:70%">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Forget password
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter User ID">
						<input id="UserID" class="input100" type="text" name="UserID"  value="<?php echo $UserID ?>">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

                    <div id="token"  class="wrap-input100 validate-input" data-validate = "Enter Validation code">
						<input class="input100" type="text" name="Token" placeholder="Token">
						<span class="focus-input100" data-placeholder="&#xf187;"></span>
					</div>

                    <div id="password"  class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="Password" placeholder="New Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
	
                    
					<div id= "confirm" class="container-login100-form-btn">
						<button type="submit" name = "confirm"  class="login100-form-btn">
							Confirm
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/bootstrap/js/popper.js"></script>
	<script src="../resources/UserLogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/daterangepicker/moment.min.js"></script>
	<script src="../resources/UserLogin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../resources/UserLogin/js/main.js"></script>

</body>
</html>