<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>View My Notices</title>

    <?php include"../html/LinkResources.html"; ?>

</head>
<body>                   
    <?php include"../html/UserPreloadAndHeader.html";?>


	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See All Notices Created or Reponsed by you</p>
						<h1>View My Notices</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
    <?php

        include "ConnectMysql.php";
        $current=0;
        $query = "SELECT * FROM Notice where UserID = '". $_COOKIE['UserID'] . "' OR NoticeID in (SELECT NoticeID FROM response WHERE ByUserID ='". $_COOKIE['UserID'] ."')";
        $result = mysqli_query($connect, $query);
        if (!$result)
            die("Could not successfully run query." . mysqli_error($connect) );
        $numOfRows = mysqli_num_rows($result);
        if(mysqli_num_rows($result)==0){
            echo "<p style='font-size: 40px; text-align: center;'>No results!</p>";
        }else{
                echo '
                <div class="latest-news mt-150 mb-150">
                    <div class="container">
                        <div class="row">';

                include "getPage.php";
                $queryPageData = "SELECT * FROM Notice where UserID = '". $_COOKIE['UserID'] . "' OR NoticeID in (SELECT NoticeID FROM response WHERE ByUserID ='". $_COOKIE['UserID'] ."')LIMIT ".$startSize.", ".$pageSize.";";
                $resultPage = mysqli_query($connect, $queryPageData);
                while($row=mysqli_fetch_assoc($resultPage)){
                    $NoticeID = $row['NoticeID'];
                    $ToUserID = $row['UserID'];
                    $Action = $ToUserID==$_COOKIE['UserID']?"Created ":"Responded ";
                    $Image=$row['Image'];
                    $Type = $row['Type']==0?'Lost':'Found';
                    $timestamp = strtotime($row['Date']);
                    $Status = $row['Status']==0?'Pending':'Completed';
                    $current++;

                    echo
                    '        <div class="col-lg-4 col-md-6">
                                <div class="single-latest-news">
                                    <div class="latest-news-bg" style="background-image:url('. $Image .')"></div>
                                        <div class="news-text-box">
                                            <h3>'. $Type .' Item <span></span></h3>
                                            <p class="blog-meta" >
                                                <span class="author"  >Status: ' .$Status . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span> 
                                                <span class="author"  >' .$Action . 'by you</span> 
                                            </p>
                
                                            <a  hidden="hidden" onclick="handleClick()" class="read-more-btn" > Response<i class="fas fa-angle-right"></i></a>
                                            <a  class="read-more-btn" onclick="getElementById(\''. $current . '\').submit();" ">View detail<i class="fas fa-angle-right"></i></a>
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
                    $pageUrl="../php/ViewMyNoticesNew.php?pageNo=".$prevNo;
                    $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>Prev</a></li>";
                }
                else{
                    $pageHtml = $pageHtml."<li><a >Prev</a></li>";
                }
                
                 for($i=1;$i<=$pageNum;$i++)   {
                    $pageUrl="../php/ViewMyNoticesNew.php?pageNo=".$i;
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
                $pageUrl="../php/ViewMyNoticesNew.php?pageNo=".$nextNo;
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
    <?php include "../html/UserFooter.html";?>
    <?php include "../html/LinkScript.html"; ?>     

    <script src= "../js/ViewNotices.js"></script>
    

</body>
</html>

