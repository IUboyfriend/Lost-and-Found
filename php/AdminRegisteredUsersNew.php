<!DOCTYPE html>
<html>
    <head>
        <title>Registered Users</title>
        <?php include "../html/LinkResources.html"; ?>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="../resources/TableResources/css/style.css">


<style>
        .table tbody td.status span {
            margin-left: 50px;
        }
        .breadcrumb-bg {
        background-image: url(../resources/Img/management.jpg);
        }
        .table thead tr {
            background: #F28123;
            border-bottom: 4px solid #eceffa;
        }
        .table thead tr th {
            border: none;
            padding: 30px;
            font-size: 19px;
            font-weight: 500;
            color: #051922;
            font-weight: bold;
        }
        nav.main-menu ul li a {
            font-size: 23px;
        }
    </style>
    </head>

    <body>

        <?php include "../html/AdminPreloadAndHeader.html";?>

        <div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Check User Information</p>
						<h1>Registered Users</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
    <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-responsive-xl">
						  <thead>
						    <tr>
								<th>NickName</th><th>Information</th><th>Notices created</th><th>Notices responded</th>
						    </tr>
						  </thead>
						  <tbody>
        <?php
            include "ConnectMysql.php";
            $query = "SELECT * FROM UserInfo Order By NickName";
            $result = mysqli_query($connect, $query);
            if (!$result)
                die("Could not successfully run query." . mysqli_error($connect));
            if(mysqli_num_rows($result)==0){
                echo "No results";
            }else{
                while($row=mysqli_fetch_assoc($result)){
                    //find the number of notices created by the user 
                    $NickName = $row['NickName'];
                    $UserID = $row['UserID'];
                    $Email = $row['Email'];
                    $Gender = $row['Gender']==0?'Male':'Female';
                    $Birthday=$row['Birthday'];
                    $ProfileImage=$row['ProfileImage'];
                    $query = "SELECT * FROM Notice where UserID = '". $UserID ."'";
                    $result1 = mysqli_query($connect, $query);
                    if(!$result1){
                        die("Could not successfully run query." . mysqli_error($connect) );
                    }
                    $createdNum=mysqli_num_rows($result1);

                    //find the number of notices responded by the user
                    $query = "SELECT * FROM response where ByUserID = '". $UserID ."'";
                    $result2 = mysqli_query($connect, $query);
                    if(!$result2){
                        die("Could not successfully run query." . mysqli_error($connect) );
                    }
                    $responsedNum=mysqli_num_rows($result2);

                    echo '<tr class="alert" role="alert">
                            <td>'.$NickName. '</td>
                            <td class="d-flex align-items-center">
                                <div class="img" style="height:75px; width:75px; border:2px solid; background-image: url('.$ProfileImage.');"></div>
                                <div class="pl-3 email">
                                    <span>'.$Email.'</span>
                                    <span>ID:'.$UserID .'</span>
                                    <span>Birthday:'.$Birthday.'</span>
                                </div>
                            </td>
                            <td class="status"><span class="active">'.$createdNum.'</span></td>
                            <td class="status"><span class="waiting">'.$responsedNum.'</span></td>
                        </tr>';

                    
                }
            }   
        ?>    
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

    <?php include"../html/UserFooter.html";?>

    <?php include"../html/LinkScript.html"; ?>      
    <script src="../resources/TableResources/js/jquery.min.js"></script>
    <script src="../resources/TableResources/js/popper.js"></script>
    <script src="../resources/TableResources/js/bootstrap.min.js"></script>
    <script src="../resources/TableResources/js/main.js"></script>


    </body>
</html>

