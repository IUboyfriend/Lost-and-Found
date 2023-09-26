<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Information Update</title>

	<?php include "../html/LinkResources.html"; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/dialog.css">

    <style>
        nav.main-menu ul li a {
            color: #fff;
            font-weight: 700;
            display: block;
            padding: 15px;
            font-size: 21px
        }

        .contact-form form p{
            font-size:20px;
            margin: 20px 0px 26px;
        }
        .contact-form form  p input,select{
            width: 100%;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;

        }
    </style>
<!-- pop up window -->
<script src='../resources/toastr/jquery.min.js'></script>
<link href='../resources/toastr/toastr.min.css' rel='stylesheet' type='text/css' />
<script src='../resources/toastr/toastr.min.js'></script>
<script src="../js/popup.js"></script>
<!-- pop up window -->

</head>
<body>                   
    <?php include"../html/UserPreloadAndHeader.html";?>
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>View and Update your personal information</p>
						<h1>Information Update</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
    <?php
        include "ConnectMysql.php";
        $UserID = $_COOKIE['UserID'];
        $query = "SELECT * FROM userInfo WHERE UserID = '". $UserID ."'";
        $result = mysqli_query($connect, $query);
        $row=mysqli_fetch_assoc($result);
        $NickName = $row['NickName'];
        $Gender = $row['Gender'];
        if($Gender==0)
        $selectGender = '<select  disabled="disabled" name="Gender" id="Gender" ><option>Male</option><option>Female</option></select>';
        else
        $selectGender = '<select  disabled="disabled" name="Gender" id="Gender" ><option>Female</option><option>Male</option></select>';
        $Email = $row['Email'];
        $Birthday = $row['Birthday'];
        $ProfileImage = $row['ProfileImage'];
echo '
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="single-product-img">
                        <img id="image" src="' . $ProfileImage . '">
                    </div>
                </div>
                <div class="col-md-3"></div>

                <br><br>
                <div class="col-md-3"></div>
                <div class="col-md-6">

                <div class="contact-form">
						<form action= "PersonalInformation.php" method="post" id="fruitkha-contact" enctype ="multipart/form-data" >
                            <input disabled="disabled" type="file" name="file" id="file" >
                            <p>Nick Name: <input disabled="disabled" type="text" name="NickName" id="NickName"  value="'.$NickName . '" required oninvalid="setCustomValidity(\'Your nick name is required!\')" oninput="setCustomValidity(\'\')" > </p>
                            <p>Gender: '.$selectGender.'</p>
							<p>Email: <input disabled="disabled" type="email" name="Email" id="Email" value="'.$Email.'" required oninvalid="setCustomValidity(\'Your email is required!\')" oninput="setCustomValidity(\'\')"></p>
                            <p>Birthday: <input  disabled="disabled" type="date" name="Birthday" id="Birthday" value="'.$Birthday.'" required oninvalid="setCustomValidity(\'Your birthday is required!\')" oninput="setCustomValidity(\'\')"></p>                           
                            <a  class="btn btn-info btn-lg" style="padding:11px 19px;" onclick="edit();">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                            <input type="submit" id= "update" disabled="disabled" name="update" value="Submit" style="margin-left:333px;">
						</form>
                        </div>	';
                    
            echo '
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>';


include "../html/UserFooter.html";
    ?>
	

	
	<?php include "../html/LinkScript.html"; ?>    
    
    <script src= "../js/dialog.js"></script>
    <script src= "../js/EditButton.js"></script>
    <script src= "../js/UserRegistration.js"></script>

</body>
</html>

