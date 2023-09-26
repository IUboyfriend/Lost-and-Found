<?php
      $pageNo=1;
      if(isset($_GET["pageNo"])){
          $pageNo = $_GET["pageNo"];
      }
      $pageSize = 6;
      $pageNum = $numOfRows/$pageSize;
      if ($numOfRows % $pageSize > 0)
      {
          $pageNum +=1;
      }
      $startSize = ($pageNo-1) * $pageSize;

?>