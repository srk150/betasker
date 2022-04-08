<?php
// get database connection
include_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){   

date_default_timezone_set('Asia/Kolkata');
$date       =  date('d-m-Y H:i');
$time       = date('H:i:s');

//$account_id  = $_COOKIE['id'];

//$room_id     = uniqid();

$task_creator       = $_COOKIE['id'];

$task_receiver      = mysqli_escape_string($con,$_POST['task_receiver']);

$task_id            = mysqli_escape_string($con,$_POST['task_id']);

$task_currency      = mysqli_escape_string($con,$_POST['task_currency']);

$task_budget        = mysqli_escape_string($con,$_POST['task_budget']);

$task_uniqid	    = uniqid();

$name_receiver      = mysqli_escape_string($con,$_POST['name']);

//get task details
$gettask = mysqli_query($con,"SELECT * FROM task_create WHERE task_id='$task_id'");

$gettask = mysqli_fetch_array($gettask);

$task_title = $gettask['task_title'];

//get user data
$getu = mysqli_query($con,"SELECT * FROM account WHERE account_id='$task_receiver'");

$user = mysqli_fetch_array($getu);

$username = $user['fullname'];
$email    = $user['email_address'];

//create chat 
$access = $task_receiver.','.$task_creator;

$check2 = mysqli_query($con,"SELECT * FROM chat_room WHERE access_id='$access' AND task_id='$task_id'");

$count2 = mysqli_num_rows($check2);

if($count2 =='0'){

$room_id     = uniqid();

$chat = mysqli_query($con,"INSERT INTO chat_room(timestamp,room_id,task_creator,user_id,room_title,access_id,status,task_title,task_id) VALUES('$date','$room_id','$task_creator','$task_receiver','$username','$access','0','$task_title','$task_id')");

}


$sql = mysqli_query($con,"INSERT INTO task_award(timestmap,task_creator,task_receiver,task_id,task_uniqid,task_currency,task_budget) VALUES('$date','$task_creator','$task_receiver','$task_id','$task_uniqid','$task_currency','$task_budget')");


$update  = mysqli_query($con,"UPDATE task_apply SET status='0' WHERE account_id='$task_receiver'");
$update2 = mysqli_query($con,"UPDATE task_create SET task_status='0',status='assign',task_budget='$task_budget' WHERE task_id='$task_id'");

//mail func

require('mailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "aqeeqecommerce@gmail.com";
$mail->Password = "arpit@123";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("db.rahulpatwari@gmail.com",    "Betasker");
$mail->AddReplyTo("db.rahulpatwari@gmail.com", "Betasker");
$mail->AddAddress($email);
$mail->Subject = "Accept Proposal";

 $link1 = "https://sharukh.dbtechserver.online/betasker/controller/api/approval_from_receiver.php?task_id=".$task_id."&acc=".$task_receiver."&status=1";
 $link2 = "https://sharukh.dbtechserver.online/betasker/controller/api/approval_from_receiver.php?task_id=".$task_id."&acc=".$task_receiver."&status=0";

// get data task 
$content="<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='x-apple-disable-message-reformatting'>
<!--[if !mso]><!-->
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<!--<![endif]-->
<title></title>

<style type='text/css'>
a {
color: #0000ee;
text-decoration: underline;
}

@media only screen and (min-width: 620px) {
.u-row {
width: 600px !important;
}
.u-row .u-col {
vertical-align: top;
}
.u-row .u-col-100 {
width: 600px !important;
}
}

@media (max-width: 620px) {
.u-row-container {
max-width: 100% !important;
padding-left: 0px !important;
padding-right: 0px !important;
}
.u-row .u-col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.u-row {
width: calc(100% - 40px) !important;
}
.u-col {
width: 100% !important;
}
.u-col>div {
margin: 0 auto;
}
}

body {
margin: 0;
padding: 0;
}

table,
tr,
td {
vertical-align: top;
border-collapse: collapse;
}

p {
margin: 0;
}

.ie-container table,
.mso-container table {
table-layout: fixed;
}

* {
line-height: inherit;
}

a[x-apple-data-detectors='true'] {
color: inherit !important;
text-decoration: none !important;
}
</style>

<link href='https://fonts.googleapis.com/css?family=Cabin:400,700' rel='stylesheet' type='text/css'>

</head>

<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9f9'>
<!--[if IE]><div class='ie-container'><![endif]-->
<!--[if mso]><div class='mso-container'><![endif]-->
<table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%' cellpadding='0' cellspacing='0'>
<tbody>
<tr style='vertical-align: top'>
<td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
<div class='u-row-container' style='padding: 0px;background-color: transparent'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
<div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!-->
<div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
<!--<![endif]-->

<table style='font-family:'Cabin',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:'Cabin',sans-serif;' align='left'>

<table width='100%' cellpadding='0' cellspacing='0' border='0'>
<tr>
<td style='padding-right: 0px;padding-left: 0px;background-color:#0090b5;' align='center'>

<img align='center' border='0' src='https://sharukh.dbtechserver.online/betasker/img/logo-mail.jpg' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 32%;max-width: 179.2px;'
width='179.2' />

</td>
</tr>
</table>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #008fb4;'>
<div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>

<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>

<div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>

<table style='font-family:'Cabin',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;font-family:'Cabin',sans-serif;' align='left'>

<table width='100%' cellpadding='0' cellspacing='0' border='0'>
<tr>
<td style='padding:40px 10px 10px;' align='center'>

<img align='center' border='0' src='https://cdn.templates.unlayer.com/assets/1597218650916-xxxxc.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 26%;max-width: 150.8px;'
width='150.8' />

</td>
</tr>
</table>

</td>
</tr>
</tbody>
</table>

<table style='font-family:'Cabin',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;padding:0px 10px 31px;font-family:'Cabin',sans-serif;' align='left'>

<div style='color: #e5eaf5; line-height: 140%; text-align: center; word-wrap: break-word;'>
<p style='font-size: 14px; line-height: 140%;'><span style='font-size: 28px; line-height: 39.2px;'><strong><span style='line-height: 39.2px; font-size: 28px;'>Proposal Request</span></strong>
</span>
</p>
</div>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>



<div class='u-row-container' style='padding: 0px;background-color: transparent'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
<div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>

<table style='font-family:'Cabin',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;padding:33px 55px;font-family:'Cabin',sans-serif;' align='left'>

<div style='color: #000000;background-color:#e8faff;line-height: 160%; text-align: center; word-wrap: break-word;'>
<p style='font-size: 14px; line-height: 160%;padding-top:10px;'><span style='font-size: 22px; line-height: 35.2px;'>Hi $username, </span></p>
<p style='font-size: 14px; line-height: 160%;'><span style='font-size: 18px; line-height: 28.8px;'>  Please Verify from your side accept the proposal request.<br> </span></p>


<a href='$link1'>Accept</a>
<a href='$link2'>Decline</a>
</div>

</td>
</tr>
</tbody>
</table>

<table style='font-family:'Cabin',sans-serif;background-color: #e8faff;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;padding:15px 55px 15px;font-family:'Cabin',sans-serif;' align='left'>

<div style='color: #000000; line-height: 160%; text-align: center;background-color:#e8faff; padding-top:10px;word-wrap: break-word;'>
<p style='line-height: 160%; font-size: 14px;'><span style='font-size: 18px; line-height: 28.8px;'>Thanks,</span></p>
</div>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


<div class='u-row-container' style='padding: 0px;background-color: transparent'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000;'>
<div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'>
<table style='font-family:'Cabin',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
<tr>
<td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Cabin',sans-serif;' align='left'>

<div style='color: #fafafa; line-height: 180%; text-align: center; word-wrap: break-word;'>
<p style='font-size: 14px; line-height: 180%;'><span style='font-size: 11px; line-height: 28.8px;'>© 2021 - 2025 | Betasker | All Rights Reserved | Designed &amp; Developed By<a href='https://www.developerbazaar.com'><span style='color: red;'> Developer </span><span style='color: limegreen;'> Bazaar</span> <span style='color: red;'> Technologies </span></a></span></p>
</div>

</td>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>

</html>";


$mail->MsgHTML($content);
$mail->IsHTML(true);
$mail->Send();

// mail function end



header('Location : ../../thakyou.php?aid='.$task_uniqid.'&name='.$name_receiver);

//  }

}



?>



