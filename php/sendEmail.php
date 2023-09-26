<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../resources/PHPMailer-master/src/Exception.php';
require '../resources/PHPMailer-master/src/PHPMailer.php';
require '../resources/PHPMailer-master/src/SMTP.php';

$UserID=$_POST['UserID'];
$query ="SELECT Email,NickName from UserInfo where UserID='".$UserID."'";
$result = mysqli_query($connect, $query);
$row=mysqli_fetch_assoc($result);

//generate four-digit random token
$length = 4;
$start = pow(10, $length - 1);
$end   = pow(10, $length) - 1;
$randomNum= rand($start, $end);
$sql = "UPDATE Account SET Token = $randomNum WHERE ID = '".$UserID."'";
$connect->query($sql);


$mail = new PHPMailer(true);                           
try {
    //configuration
    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                             
    $mail->Host = 'smtp.mxhichina.com';                
    $mail->SMTPAuth = true;                   
    $mail->Username = 'huhai@hantek.com';             
    $mail->Password = 'hantek..123';            
    $mail->SMTPSecure = 'ssl';                    
    $mail->Port = 465;                           

    $mail->setFrom('huhai@hantek.com', 'Mailer');  
    $mail->addAddress($row['Email']);  

    //Content
    $mail->isHTML(true);                              
    $mail->Subject = 'Reset Password: PolyU Lost And Found';
    

    $output='<p>Dear, '.$row['NickName'].'</p>';
    $output.='<p>Please use the following token to reset your password.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='Token: '. $randomNum;
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>The Token will expire after 1 day for security reason. Please reset your password in time.</p>';
    $output.='<p>Thanks,</p>';
    $output.='<p>PolyU Lost And Found</p>';
    $mail->Body    = $output. date('Y-m-d H:i:s');

    $mail->send();
    echo "<script>location.href ='../php/resetPassword.php?UserID=$UserID&type=1&msg=An email is sent to your email with a validation code.'; </script>";
} catch (Exception $e) {
    echo "<script>alert($mail->ErrorInfo)</script>";
}