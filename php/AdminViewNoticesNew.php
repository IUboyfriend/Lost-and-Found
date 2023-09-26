<!DOCTYPE html>
<html>
    <head>
        <title>View Notices</title>
    </head>
    <?php include "../html/LinkResources.html"; ?>

    <body>
    <?php include "../html/AdminPreloadAndHeader.html";?>
    <div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
                    <p>View list of notices</p>
                        <?php  
                        $Status=$_GET['Status'];
                        if($Status == 0){
                            echo "<h1>View Pending Notices</h1>";
                        }else{
                            echo "<h1>View Completed Notices</h1>";
                        }?>
					</div>
				</div>
			</div> 
		</div>
	</div>
        <?php
            include "ConnectMysql.php";
            $current=0;
            $query = "SELECT * FROM Notice WHERE Status=". $Status;
            $result = mysqli_query($connect, $query);
            $numOfRows = mysqli_num_rows($result);
            if (!$result)
                die("Could not successfully run query." . mysqli_error($connect) );
            if(mysqli_num_rows($result)==0){
                echo("No Results.");
            }else{
                echo '
                <div class="latest-news mt-150 mb-150">
                    <div class="container">
                        <div class="row">';
                //paging
                include "getPage.php";
                $queryPageData = "SELECT * FROM Notice WHERE Status=" .$Status." ORDER BY Date LIMIT ".$startSize.", ".$pageSize.";";
                $resultPage = mysqli_query($connect, $queryPageData);

                while($row=mysqli_fetch_assoc($resultPage)){
                    $NoticeID = $row['NoticeID'];
                    $Image=$row['Image'];
                    $Type = $row['Type']==0?'Lost':'Found';
                    $timestamp = strtotime($row['Date']);
                    $StatusString = $row['Status']==0?'Pending':'Completed';
                    $Date = date("Y-M-d",$timestamp);
                    $current++;

                    echo
                    '
                            <div class="col-lg-4 col-md-6">
                                <div class="single-latest-news">
                                    <div class="latest-news-bg" style="background-image:url('. $Image .')"></div>
                                        <div class="news-text-box">
                                            <h3>'. $Type .' Item</h3>
                                            <p class="blog-meta" >
                                                <span class="date" id="date1"><i class="fas fa-calendar"></i>'. $Date .'</span>
                                                <span class="author"  >Status: ' .$StatusString . '</span>
                                            </p>
                                            <a  class="read-more-btn" onclick="getElementById(\''. $current . '\').submit();" style="margin-left:160px;">View detail<i class="fas fa-angle-right"></i></a>
                                            <form action="ViewDetailNew.php?Admin=1" method = "post" id="' .$current .'">
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
                    $pageUrl="../php/AdminViewNoticesNew.php?Status=".$Status."&pageNo=".$prevNo;
                    $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>Prev</a></li>";
                }
                else{
                    $pageHtml = $pageHtml."<li><a >Prev</a></li>";
                }
                
                 for($i=1;$i<=$pageNum;$i++)   {
                    $pageUrl="../php/AdminViewNoticesNew.php?Status=".$Status."&pageNo=".$i;
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
                $pageUrl="../php/AdminViewNoticesNew.php?Status=".$Status."&pageNo=".$nextNo;
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
        <?php include"../html/LinkScript.html"; ?>      
    </body>
</html>

