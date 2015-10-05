<?php

/*
	include/mail.inc.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	@version 1.8

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


// Mailserver hostname or IP
$Smtp["host"] = "localhost";

// The value to give when sending EHLO or HELO. Default is localhost
//$Smtp["localhost"] = "localhost";

// Mailserver port
$Smtp["port"] = "25";

// Debug mode
$Smtp["debug"] = false;

// Set to true if your mailserver needs authentification
// Default false
#$Smtp["auth"] = true;
$Smtp["auth"] = false;

// If above set to true you need to enter your username
//$Smtp["username"] = "user";

// and your password
//$Smtp["password"] = "password";

mb_internal_encoding($_SESSION['Charset']);


function Email( $EmailTo, $EmailCc, $EmailBcc, $Priority, $Subject, $Message, $FileName='', $FileContent='') {
    global $a, $Smtp, $CompanyName, $CompanyEmail;

    require_once('PHPMailer/class.phpmailer.php');
    //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded   

    try {
		
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = $Smtp['debug'];                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = $Smtp['auth'];                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";
	$mail->Host       = $Smtp['host']; // sets the SMTP server
	$mail->Hostname   = $Smtp['localhost']; // sets the hostname for ehlo and message-id
	$mail->Port       = $Smtp['port']; // set the SMTP port for the Mail Server
	$mail->Username   = $Smtp['username']; // SMTP account username
	$mail->Password   = $Smtp['password'];        // SMTP account password
	
	//$mail->CharSet = 'utf-8';
	$mail->WordWrap = 75;

	//$mail->Sign('cert.pem','key.pem',''); //S-MIME Sign
  
	//Set Headers
	$mail->AddReplyTo($CompanyEmail, $CompanyName);
	$mail->SetFrom($CompanyEmail, $CompanyName);
	$mail->Priority=$Priority;
	switch ($Priority) {
	    case 1:	
		$mail->Priority=1;
		// MS Outlook custom header
		// May set to "Urgent" or "Highest" rather than "High"
		$mail->AddCustomHeader("X-MSMail-Priority: Highest");
		// Not sure if Priority will also set the Importance header:
		$mail->AddCustomHeader("Importance: High");
		break;
	    case 5:
		//Lowest
		$mail->Priority=5;
		// MS Outlook custom header
		$mail->AddCustomHeader("X-MSMail-Priority: Low");
		// Not sure if Priority will also set the Importance header:
		$mail->AddCustomHeader("Importance: Low");

		break;
	    default:
		//Normal
		$mail->Priority=3;
		// MS Outlook custom header
		$mail->AddCustomHeader("X-MSMail-Priority: Normal");
		// Not sure if Priority will also set the Importance header:
		$mail->AddCustomHeader("Importance: Normal");

	}
	$mail->AddCustomHeader("Sensitivity: Company-Confidential");
	//Pretend to be MS Outlook (against ANTi-Spam-Software!)
	$mail->AddCustomHeader("X-MimeOLE: X-Mailer: Microsoft Outlook, Build 12.0.4210");
	$mail->AddCustomHeader("X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1165");

	$mail->set('Organization',$CompanyName);
	
	//Set Personalization
	$mail->AddAddress($EmailTo);
	if ($EmailCC) $mail->AddCC($EmailCC);
	if ($EmailBCC) $mail->AddBCC($EmailBCC);
	$mail->Subject = $Subject;

	//Set Content
	//$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
	//Convert Line-Breaks...
	/***
	$crlf = "<br>\n";
	if (!empty($Message)) {
		$Message = '<pre>'."\n".str_replace("\\r\\n",$crlf, $Message)."\n".'</pre>';
	}
	$mail->MsgHTML($Message);
	***/
	$mail->Body = $Message;

	if (!empty($FileName) && (!empty($FileContent))) {
	    //Add Attachment
	    $mail->AddStringAttachment($FileContent, $FileName, 'base64',getMimeType($FileContent));
	}

	$mail->Send();

	//Everything is OK
	return $_SESSION['emailID'] = '1';

    } catch (Exception $e) {
	//Wohoo, ERROR?!
	die($e->getMessage());
    }
}


function getMimeType($buffer) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($buffer);
}
?>