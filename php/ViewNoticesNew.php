<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>View Detail</title>

    <?php include"../html/LinkResources.html"; ?>

    <link rel="stylesheet" href="../resources/css/dialog.css">
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
						<p>See All Pending Notices</p>
						<h1>View Notices</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
    <?php
            include "ConnectMysql.php";
            $current=0;
            $query = "SELECT * FROM notice Where Status = 0";
            $result = mysqli_query($connect, $query);
            $numOfRows = mysqli_num_rows($result);
            if (!$result)
                die("Could not successfully run query." . mysqli_error($connect) );
            if(mysqli_num_rows($result)==0){
                echo("No Notice in the database.");
            }else{
                echo '
                <div class="latest-news mt-150 mb-150">
                    <div class="container">
                        <div class="row">';
                
                include "getPage.php";
                $queryPageData = "SELECT * FROM notice Where Status = 0  order by date desc LIMIT ".$startSize.", ".$pageSize.";";
                $resultPage = mysqli_query($connect, $queryPageData);

                while($row=mysqli_fetch_assoc($resultPage)){
                    $NoticeID = $row['NoticeID'];
                    $ToUserID = $row['UserID'];
                    $Image=$row['Image'];
                    $Type = $row['Type']==0?'Lost':'Found';
                    $timestamp = strtotime($row['Date']);
                    $Status = $row['Status']==0?'Pending':'Completed';
                    $Date = date("Y-M-d",$timestamp);
                    $query2 = "SELECT * FROM UserInfo Where UserID = '". $ToUserID ."'";
                    $result2 = mysqli_query($connect, $query2);
                    $row2=mysqli_fetch_assoc($result2);
                    $NickName = $row2['NickName'];
                    $current++;

                    echo
                    '
                            <div class="col-lg-4 col-md-6">
                                <div class="single-latest-news">
                                    <div class="latest-news-bg" style="background-image:url('. $Image .')"></div>
                                        <div class="news-text-box">
                                            <h3>'. $Type .' Item</h3>
                                            <p class="blog-meta" >
                                                <span class="author"  ><i class="fas fa-user"></i>' .$NickName . '</span>
                                                <span class="date" id="date1"><i class="fas fa-calendar"></i>'. $Date .'</span>
                                            </p>
                
                                            <a  onclick="handleClick(\''.$NoticeID .'\')" class="read-more-btn" > Response<i class="fas fa-angle-right"></i></a>
                                            <a  class="read-more-btn" onclick="getElementById(\''. $current . '\').submit();" style="margin-left:45px;">View detail<i class="fas fa-angle-right"></i></a>
                                            <form action="ViewDetailNew.php" method = "post" id="' .$current .'">
                                            <input type="text" name="NoticeID" hidden="hidden" value="'. $NoticeID  .'">
                                            </form>  
                                        </div>
                                </div>
                            </div>';

                        
                }


                $pageHtml = "";
                $prevNo = $pageNo - 1;
                if ($prevNo >=1)
                {
                    $pageUrl="../php/ViewNoticesNew.php?pageNo=".$prevNo;
                    $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>Prev</a></li>";
                }
                else{
                    $pageHtml = $pageHtml."<li><a >Prev</a></li>";
                }
                
                 for($i=1;$i<=$pageNum;$i++)   {
                     $pageUrl="../php/ViewNoticesNew.php?pageNo=".$i;
                     if ($i == $pageNo)
                     {
                        $pageHtml = $pageHtml."<li><a class='active' href='".$pageUrl."'>".$i."</a></li>";
                     }
                     else
                     {
                        $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>".$i."</a></li>";
                     }
                     
                 }

                 $nextNo = $pageNo + 1;
                 if ($nextNo > $pageNum)
                 {
                    $pageHtml = $pageHtml ."<li><a >Next</a></li>";
                 }
               else{
                $pageUrl="../php/ViewNoticesNew.php?pageNo=".$nextNo;
                $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>Next</a></li>";       
               }


                echo '</div>
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="pagination-wrap">
                                    <ul>'.$pageHtml.'</ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
            }
        ?>
	
	<?php include"../html/UserFooter.html";?>

	<div id="overlap" class="overlap" ></div>
	<div id="dialog_wrapper"  class="dialog_wrapper" ></div>	
	
    <?php include"../html/LinkScript.html"; ?>      
    
    <script src= "../js/dialog.js"></script>
    

</body>
</html>

