<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Create Notice</title>

	<?php include"../html/LinkResources.html"; ?>


</head>
<body>                   
<?php include"../html/UserPreloadAndHeader.html";?>

	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Create a lost/found Notice</p>
						<h1>Create Notice</h1>
					</div>
				</div>
			</div> 
		</div>
	</div>


    <!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-title">
						<h2>Basic Information</h2>
						<p>Please fill in the following form to describe your notice! Kindly remind that each field is required!</p>
					</div>
					<div class="contact-form">
						<form action= "CreateAction.php" method="post" id="fruitkha-contact" enctype ="multipart/form-data">
							<p>
                                <select  name="Type" id="Type" required oninvalid="setCustomValidity('You have to select your notice type!')" oninput="setCustomValidity('')">
                                    <option disabled="disabled" >Select your notice type...</option>
                                    <option>Lost</option><option>Found</option>
                                </select>
                                <input type="date" placeholder="Please specify the lost/found date" name="Date" id="Date" required oninvalid="setCustomValidity('You have to specify the lost/found date!')" oninput="setCustomValidity('')">
							</p>
							<p>
								<input type="text" placeholder="Venue" name="Venue" id="Venue" required oninvalid="setCustomValidity('You have to specify the venue!')" oninput="setCustomValidity('')">
								<input type="text" placeholder="Contact" name="Contact" id="Contact" required oninvalid="setCustomValidity('You have to provide your contact information!')" oninput="setCustomValidity('')">
							</p>
							<p><textarea name="Description" id="Description" cols="30" rows="10" placeholder="Please leave a brief description here..." required oninvalid="setCustomValidity('You have to leave a brief description here!')" oninput="setCustomValidity('')"></textarea></p>
                            <p><span>Upload Item Image: </span><br><input type="file" name="file" id="file" required oninvalid="setCustomValidity('Please upload an image of the item!')" oninput="setCustomValidity('')"></p>
                            <img id="image">
                            <p><input type="submit" value="Submit"></p>
						</form>
       
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- end contact form -->
   
	
    <?php include"../html/UserFooter.html";?>
	<?php include"../html/LinkScript.html"; ?>     
    <script src="../js/UserRegistration.js"></script>

    

</body>
</html>

