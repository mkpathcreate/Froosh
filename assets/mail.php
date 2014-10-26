<?php
function send_html_mail()
{
	$to  = "gobisn@gmail.com";;
	$subject = "sample";

	$message = "??????????R U";

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

send_html_mail();






