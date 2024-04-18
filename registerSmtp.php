<?php
include('smtp/PHPMailerAutoload.php');
include 'connection.php';
$qry = "select * from email_templates";
$data = mysqli_query($con, $qry);
$row = mysqli_fetch_array($data);
echo $row[0];
// $html = '<!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Welcome to Our Website!</title>
//     <style>
//         body {
//             font-family: Arial, sans-serif;
//             background-color: #f4f4f4;
//             margin: 0;
//             padding: 0;
//         }
//         .container {
//             max-width: 600px;
//             margin: 0 auto;
//             padding: 20px;
//             background-color: #fff;
//             border-radius: 5px;
//             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
//         }
//         h1 {
//             color: #333;
//         }
//         p {
//             color: #555;
//         }
//         .footer {
//             margin-top: 20px;
//             text-align: center;
//         }
//         .login-link {
//             color: #007bff;
//             text-decoration: none;
//         }

//     </style>
// </head>
// <body>
//     <div class="container">
//         <img src="https://arcsinfotech.com/wp-content/uploads/2024/01/black-logo.png" height="100px" alt="">
//         <div style="display: flex; align-items:center; justify-content:space-around;">
//             <h1>Welcome to Our Team!</h1>
//         </div>
//         <p>Dear '.$name .',</p>
//         <p>Welcome to our team. We are excited to have you on board!</p>
//         <p>You have registered with the email address: '.$email.'</p>
//         <p>You can log in to your account <a href="http://localhost/arcsfrontend/login.php" class="login-link">here</a>.</p>
//         <p>Best regards,</p>
//         <p>Arcs Infotech Team</p>
//     </div>
//     <div class="footer">
//         <p>&copy; 2024 Arcs Infotech. All rights reserved.</p>
//     </div>
// </body>
// </html>';
// echo smtp_mailer($email,'Successfully Registered.',$html);
// function smtp_mailer($to,$subject, $msg){
// 	$mail = new PHPMailer(); 
// 	$mail->IsSMTP(); 
// 	$mail->SMTPAuth = true; 
// 	$mail->SMTPSecure = 'tls'; 
// 	$mail->Host = "smtp.gmail.com";
// 	$mail->Port = 587; 
// 	$mail->IsHTML(true);
// 	$mail->CharSet = 'UTF-8';
// 	//$mail->SMTPDebug = 2; 
// 	$mail->Username = "donotreply.xorosoft@gmail.com";
// 	$mail->Password = "fjpbxtobarjyqsrc";
// 	$mail->SetFrom("donotreply.xorosoft@gmail.com");
// 	$mail->Subject = $subject;
// 	$mail->Body =$msg;
// 	$mail->AddAddress($to);
// 	$mail->SMTPOptions=array('ssl'=>array(
// 		'verify_peer'=>false,
// 		'verify_peer_name'=>false,
// 		'allow_self_signed'=>false
// 	));
// 	if(!$mail->Send()){
// 		echo $mail->ErrorInfo;
// 	}else{
// 		return '';
// 	}
// }
?>