<!DOCTYPE html>
<html>
    <head>
        <title>Notices of a user</title>
        <link rel="stylesheet" href="../resources/css/SearchBarStyle.css">
    </head>
    <?php include "../html/LinkResources.html"; ?>

    <body>
    <?php include "../html/AdminPreloadAndHeader.html";?>
    <div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
                    <p>Notices created/responsed by a user</p>
                    <h1>Notices of A User</h1>
					</div>
				</div>
			</div> 
            <div>
                <div id="cover" style="width: 470px;padding: -23px;margin: 24px auto -110px;">
                    <form action='ViewListOfAUserNew.php' method = 'post'>
                        <div class="tb">
                        <div class="td"><input type="text" style="font-size:30px;" name ="UserID" placeholder="Input the User ID here" required required oninvalid="setCustomValidity('The input field cannot be empty!')" oninput="setCustomValidity('')"></div>
                        <div class="td" id="s-cover" >
                            <button type="submit" name = "Search" value="Search">
                            <div id="s-circle"></div>
                            <span></span>
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>

        <?php
            if(isset($_POST['UserID'])||isset($_GET['UserID'])){
                include "ConnectMysql.php";
                $current=0;
                if(isset($_POST['UserID'])){
                    $UserID = $_POST['UserID'];
                }else{
                    $UserID = $_GET['UserID'];
                }
                $query = "SELECT * FROM Notice where UserID = '". $UserID . "' OR NoticeID IN (SELECT NoticeID FROM response WHERE ByUserID ='". $UserID ."')";
                $result = mysqli_query($connect, $query);
                if (!$result)
                    die("Could not successfully run query." . mysqli_error($connect));
                $numOfRows = mysqli_num_rows($result);
                if(mysqli_num_rows($result)==0){
                    echo "<p style='font-size: 40px; text-align: center;'>No results!</p>";
                }else{
                    echo '
                    <div class="latest-news mt-150 mb-150">
                        <div class="container">
                            <div class="row">';

                    include "getPage.php";
                    $queryPageData = "SELECT * FROM Notice where UserID = '". $UserID . "' OR NoticeID IN (SELECT NoticeID FROM response WHERE ByUserID ='". $UserID ."') LIMIT ".$startSize.", ".$pageSize.";";
                    $resultPage = mysqli_query($connect, $queryPageData);

                    while($row=mysqli_fetch_assoc($resultPage)){
                        $NoticeID = $row['NoticeID'];
                        $Image=$row['Image'];
                        $Type = $row['Type']==0?'Lost':'Found';
                        $timestamp = strtotime($row['Date']);
                        $Status = $row['Status']==0?'Pending':'Completed';
                        $Date = date("Y-m-d",$timestamp);
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
                                                    <span class="author"  >Status: ' .$Status . '</span>
                                                </p>
                                                <a  class="read-more-btn" onclick="getElementById(\''. $current . '\').submit();" style="margin-left:160px;">View detail<i class="fas fa-angle-right"></i></a>
                                                <form hidden="hidden" action="ViewDetailNew.php?Admin=1" method = "post" id="' .$current .'">
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
                        $pageUrl="../php/ViewListOfAUserNew.php?UserID=".$UserID."&pageNo=".$prevNo;
                        $pageHtml = $pageHtml."<li><a href='".$pageUrl."'>Prev</a></li>";
                    }
                    else{
                        $pageHtml = $pageHtml."<li><a >Prev</a></li>";
                    }
                    
                     for($i=1;$i<=$pageNum;$i++)   {
                        $pageUrl="../php/ViewListOfAUserNew.php?UserID=".$UserID."&pageNo=".$i;
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
                    $pageUrl="../php/ViewListOfAUserNew.php?UserID=".$UserID."&pageNo=".$nextNo;
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

            include "../html/UserFooter.html";
                }   

            }

        ?>
 
        <?php include "../html/LinkScript.html"; ?>    


    </body>
</html>

