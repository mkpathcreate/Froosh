<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
<body>
	<form accept-charset="utf-8" id="formID" method="post" action="" name="formID">
	<input type=text name="uname" id="uname" value=""><br>
	<input type="submit" value="Register" id="subutton">
	
	</form>
	
<?php
if(isset($_POST)){
$x=$_POST['uname'];
send_html_mail($x);
}
function send_html_mail($sub)
{
	$to  = "gobisn@gmail.com";;
	$subject = "sample";

	$message = $sub;

	$s_header = "";
	$s_header = $s_header . "MIME-Version: 1.0\r\n";
	$s_header = $s_header . "From: from@from.com\r\n"; ;
	$s_header = $s_header . "Reply-To: reply@reply.com\r\n"; ;
	$s_header = $s_header . "Content-type: text/html; charset=JIS\r\n";
	$s_header = $s_header . "Content-Transfer-Encoding:7bit\r\n";
	
	mb_language("ja");
	$subject = mb_convert_encoding($subject, "JIS","AUTO");
	$subject = mb_encode_mimeheader($subject);

        $message = mb_convert_encoding($message, "JIS", "AUTO");

	mail($to, $subject, $message, $s_header);
}