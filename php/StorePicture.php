<?php
//if the picture is an item image, store the file to a folder called uploadItemImg
//if the picture is a user image, store the file to a folder called UploadImg
if(isset($_POST['NewItem']))
$uploaddir = "../UploadItemImg/";
else
$uploaddir = "../UploadImg/";
$type=array("jpg","gif","bmp","jpeg","png");
//judge file type
if(!in_array(strtolower(fileext($_FILES['file']['name'])),$type)) 
{ 
    $text=implode(",",$type); 
    echo "You can only upload following types of files: ",$text,"<br>"; 
} 
//generate the file name
else{ 
    $filename=explode(".",$_FILES['file']['name']); 
do 
{ 
    $filename[0]=random(10); 
    $name=implode(".",$filename); 
    $uploadfile=$uploaddir.$name; 
} while(file_exists($uploadfile)); 

if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile)) 
{ 
    if(is_uploaded_file($_FILES['file']['tmp_name'])) 
    {
        echo "Upload fails!"; 
    } 
} 
} 
//Gets the file suffix function
function fileext($filename) 
{ 
    return substr(strrchr($filename, '.'), 1); 
} 
//Generates a random filename
function random($length) 
{ 
    $hash = 'CR-'; 
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 
    $max = strlen($chars) - 1; 
    mt_srand((double)microtime() * 1000000); 
    for($i = 0; $i < $length; $i++) 
        $hash .= $chars[mt_rand(0, $max)]; 
    return $hash; 
} 
?>