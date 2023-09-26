<!DOCTYPE html>
<html>
    <head>
        <title>System Statistics</title>
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
                     <h1>System Statistics</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>
<?php
include "ConnectMysql.php";
 $query = "SELECT * FROM UserInfo";
 $result = mysqli_query($connect, $query);
 $group = array(0,0,0,0,0,0);
 while($row=mysqli_fetch_assoc($result)){
    $UserID= $row['UserID'];
    $earlier = new DateTime($row['Birthday']);
    $later = new DateTime();
    $diff = $later->diff($earlier)->format("%a");
    $query1= "SELECT * from notice where UserID = '". $UserID. "'";
    $result1 = mysqli_query($connect, $query1);
    $noticeCreated = mysqli_num_rows($result1);
    //<10 3650
    if($diff<3650)
        $group[1] +=$noticeCreated;

    //10,30  3650,10950
    if($diff>3650&&$diff<10950)
        $group[2] +=$noticeCreated;

    //30,50   10950,18250
    if($diff>10950&&$diff<18250)
        $group[3] +=$noticeCreated;
    //50,70   18250,25550
    if($diff>18250&&$diff<25550)
        $group[4] +=$noticeCreated;

    //>70     25550
    if($diff>25550)
        $group[5] +=$noticeCreated;    

 }

$dataPoints = array(
	array("label"=> "<10", "y"=> $group[1] ),
	array("label"=> "[10,30]", "y"=> $group[2]),
	array("label"=> "[30,50]", "y"=> $group[3]),
	array("label"=> "[50,70]", "y"=> $group[4]),
	array("label"=> ">70", "y"=> $group[5]),
);


?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Number of Notices in Different Age Ranges among Users"
	},
    subtitles: [{
         text: "Bar Chart"
     }],
    axisY: {
		title: "Number of Notices",
		includeZero: true,

	},
    axisX: {
		title: "Age range of Users",
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points

		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 

 
 var chart = new CanvasJS.Chart("chartContainer1", {
     animationEnabled: true,
     exportEnabled: true,
     title:{
         text: "Number of Notices in Different Age Ranges among Users"
     },
     subtitles: [{
         text: "Pie Chart"
     }],
     data: [{
         type: "pie",
         showInLegend: "true",
         legendText: "{label}",
         indexLabelFontSize: 16,
         indexLabel: "{label} - #percent%",
         yValueFormatString: "#,##0",
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; width: 60%;  margin: 120px auto;"></div>
<div id="chartContainer1" style="height: 500px; width: 60%;  margin: 120px auto;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php include"../html/UserFooter.html";?>
<?php include"../html/LinkScript.html"; ?>     

</body>
</html>                              