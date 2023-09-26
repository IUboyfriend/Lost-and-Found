<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Notice Detail</title>
	<?php include"../html/LinkResources.html"; ?>
    <link rel="stylesheet" href="../resources/css/dialog.css">
</head>
<body>                   
	
    <?php 
	if(isset($_GET['Admin']))
	include  "../html/AdminPreloadAndHeader.html";
	else
	include "../html/UserPreloadAndHeader.html";?>
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>information of a Notice</p>
						<h1>View Detail</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
    <?php
        include "ConnectMysql.php";
        $NoticeID = $_POST['NoticeID'];
        $query = "SELECT * FROM notice WHERE NoticeID = '". $NoticeID ."'";
        $result = mysqli_query($connect, $query);
        $row=mysqli_fetch_assoc($result);
        $NoticeID = $row['NoticeID'];
        $UserID = $row['UserID'];
        $query1 = "SELECT NickName FROM UserInfo WHERE UserID = '". $UserID ."'";
        $result1 = mysqli_query($connect, $query1);
        $row1=mysqli_fetch_assoc($result1);
        $NickName1 = $row1['NickName'];
        $Image=$row['Image'];
        $Type = $row['Type']==0?'Lost':'Found';
        $timestamp = strtotime($row['Date']);
        $Date1 = date("Y-M-d",$timestamp);
        $Status = $row['Status']==0?'Pending':'Completed';
        $Venue = $row['Venue'];
        $Contact = $row['Contact'];
        $Description = $row['Description'];
echo '
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="' . $Image . '">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3 style="font-size:30px;">'. $Type .' Item (status: '. $Status .')</h3>
                        <table style="font-size: 22px; ">
                            <tr><th>Issued by: </th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$NickName1.'</td></tr>
                            <tr><th>Issued Date: </th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$Date1.'</td></tr>
                            <tr><th>Venue: </th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$Venue.'</td></tr>
                            <tr><th>Contact: </th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$Contact.'</td></tr>

                        </table>
                        <p style="font-size:20px;color:darkcyan"><b>Description: </b>'.$Description.'</p>
                        <br>';

        //if it has been responded, get the response
        if($row['Status']==1){
            $query = "SELECT * FROM response WHERE NoticeID = '". $NoticeID ."'";
            $result = mysqli_query($connect, $query);
            $response=mysqli_fetch_assoc($result);
            $content = $response['Response'];
            $ByUserID = $response['ByUserID'];
            $ResTimestamp = $response['ResTime'];
            $Date2 = date("Y-M-d",$timestamp);
            $query2 = "SELECT NickName FROM UserInfo WHERE UserID = '". $ByUserID ."'";
            $result2 = mysqli_query($connect, $query2);
            $row2=mysqli_fetch_assoc($result2);
            $NickName2 = $row2['NickName'];
            echo                        
			'<table style="font-size: 22px;">
                <tr><th>Responded by:</th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$NickName2.'</td></tr>
                <tr><th>Responded Date:</th><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>'.$Date2.'</td></tr>
			</table>
			<p style="font-size:20px;color:darkblue"><b>Response: </b>'.$content.'</p>';
        }
            echo '</div>
            </div>
        </div>
    </div>
</div>';

    ?>
	
	<?php include"../html/UserFooter.html";?>
    <?php include"../html/LinkScript.html"; ?>    
	<script src="../resources/assets/js/main.js"></script>

    <script src= "../js/ViewNotices.js"></script>

    
    <script src= "../js/dialog.js"></script>

</body>
</html>

