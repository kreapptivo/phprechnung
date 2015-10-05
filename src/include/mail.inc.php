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
//
$Smtp["host"] = "localhost";

// The value to give when sending EHLO or HELO. Default is localhost
//
$Smtp["localhost"] = "localhost";

// Mailserver port
//
$Smtp["port"] = "25";

// Debug mode
//
$Smtp["debug"] = false;

// Set to true if your mailserver needs authentification
// Default false
//
$Smtp["auth"] = false;

// If above set to true you need to enter your username
//
$Smtp["username"] = "";

// and your password
//
$Smtp["password"] = "";

mb_internal_encoding($_SESSION['Charset']);

function PEAR_Email_PlainText ( $EmailTo, $EmailCc, $EmailBcc, $Priority, $Subject, $Message, $Charset )
{
	global $a, $Smtp, $CompanyName, $CompanyEmail;

	require_once('PEAR.php');
	require_once('Mail.php');
	require_once('Mail/mime.php');

	if (!class_exists('Mail'))
	{
		die("Unable to load class: Mail. Please install PHP PEAR::Mail and all dependencies.<br /><br />
		For manual installation see Link: <a href='http://pear.php.net/manual/en/installation.shared.php' target='_blank'>http://pear.php.net/manual/en/installation.shared.php</a>");
	}

	if(!empty($EmailCc))
	{
		$Recipient = "$EmailTo,$EmailCc,$EmailBcc";
	}
	else
	{
		$Recipient = "$EmailTo,$EmailBcc";
	}

	$crlf = "\n";

	$hdrs = array(
		"From" => "{$CompanyName} <{$CompanyEmail}>",
		"To" => "{$EmailTo}",
		"Cc" => "{$EmailCc}",
		"Subject" => "{$Subject}",
		"Reply-To" => "{$CompanyName} <{$CompanyEmail}>",
		"Organization" => "{$CompanyName}",
		"X-Priority" => "{$Priority}",
		"X-Mailer" => "$a[programname]"
	);

	$mime = new Mail_mime($crlf);

	$mime->setTXTBody($Message);

	$body = $mime->get(array("text_encoding" => "8bit", "text_charset" => "{$Charset}", "head_charset" => "{$Charset}") );
	$hdrs = $mime->headers($hdrs);

	$mail =& Mail::factory('smtp',$Smtp);
	$result = $mail->send($Recipient, $hdrs, $body);

	if(PEAR::isError($result))
	{
		die ($a['email_error'].' '.$result->getMessage());
	}
	else
	{
		return $_SESSION['emailID'] = '1';
	}
}

function PEAR_Email_Attachment ( $EmailTo, $EmailCc, $EmailBcc, $Priority, $Subject, $Message, $File, $Charset )
{
	global $a, $Smtp, $CompanyName, $CompanyEmail;

	require_once('PEAR.php');
	require_once('Mail.php');
	require_once('Mail/mime.php');
	

	if (!class_exists('Mail'))
	{
		die("Unable to load class: Mail. Please install PHP PEAR::Mail and all dependencies.<br /><br />
		For manual installation see Link: <a href='http://pear.php.net/manual/en/installation.shared.php' target='_blank'>http://pear.php.net/manual/en/installation.shared.php</a>");
	}

	if(!empty($EmailCc))
	{
		$Recipient = "$EmailTo,$EmailCc,$EmailBcc";
	}
	else
	{
		$Recipient = "$EmailTo,$EmailBcc";
	}

	$crlf = "\n";

	$hdrs = array(
		"From" => "{$CompanyName} <{$CompanyEmail}>",
		"To" => "{$EmailTo}",
		"Cc" => "{$EmailCc}",
		"Subject" => "{$Subject}",
		"Reply-To" => "{$CompanyName} <{$CompanyEmail}>",
		"Organization" => "{$CompanyName}",
		"X-Priority" => "{$Priority}",
		"X-Mailer" => "$a[programname]"
	);

	$mime = new Mail_mime($crlf);

	$mime->setTXTBody($Message);
	$mime->addAttachment($File, mime_content_type($File));

	$body = $mime->get(array("text_encoding" => "8bit", "text_charset" => "{$Charset}", "head_charset" => "{$Charset}") );
	$hdrs = $mime->headers($hdrs);

	$mail =& Mail::factory('smtp',$Smtp);
	$result = $mail->send($Recipient, $hdrs, $body);

	if(PEAR::isError($result))
	{
		die ($a['email_error'].' '.$result->getMessage());
	}
	else
	{
		return $_SESSION['emailID'] = '1';
	}
}

function Email_PlainText ( $EmailTo, $EmailCc, $EmailBcc, $Priority, $Subject, $Message, $Charset )
{
	global $a, $CompanyName, $CompanyEmail;
	
	$CompanyName = mb_encode_mimeheader($CompanyName, $Charset, "Q");
	$Subject = mb_encode_mimeheader($Subject, $Charset, "Q");
	$Message = mb_convert_encoding($Message, $Charset);

	$header = "From: {$CompanyName} <{$CompanyEmail}>\n";
	if(!empty($EmailCc))
		$header .= "Cc: {$EmailCc}\n";
	if(!empty($EmailBcc))
		$header .= "Bcc: {$EmailBcc}\n";
	$header .= "Reply-To: {$CompanyName} <{$CompanyEmail}>\n";
	$header .= "Organization: {$CompanyName}\n";
	$header .= "To: ".$EmailTo."\n";
	$header .= "X-Priority: {$Priority}\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: text/plain; charset=\"$Charset\"\n";
	$header .= "Content-Transfer-Encoding: 8bit\n";
	$header .= "X-Mailer: {$a['programname']} - PHP ".PHP_VERSION."\n";
	
	// If you have safe_mode = On, please delete ,"-f$CompanyEmail"
	// because the fifth parameter is not allowed in safe_mode
	//
	if(mail($EmailTo, $Subject, $Message, $header,"-f$CompanyEmail"))
	{
		return $_SESSION['emailID'] = '1';
	}
	else
	{
		die($a['email_error'].' '.$php_errormsg);
	}
}

function Email_Attachment ( $EmailTo, $EmailCc, $EmailBcc, $Priority, $Subject, $Message, $File, $Charset )
{
	global $a, $CompanyName, $CompanyEmail;

	$CompanyName = mb_encode_mimeheader($CompanyName, $Charset, "Q");
	$Subject = mb_encode_mimeheader($Subject, $Charset, "Q");
	$Message = mb_convert_encoding($Message, $Charset);

	$boundary = md5(uniqid(mt_rand(), true));
	$data = chunk_split(base64_encode(file_get_contents($File)));

	$header = "From: {$CompanyName} <{$CompanyEmail}>\n";
	if(!empty($EmailCc))
		$header .= "Cc: {$EmailCc}\n";
	if(!empty($EmailBcc))
		$header .= "Bcc: {$EmailBcc}\n";
	$header .= "Reply-To: {$CompanyName} <{$CompanyEmail}>\n";
	$header .= "Organization: {$CompanyName}\n";
	$header .= "To: {$EmailTo}\n";
	$header .= "X-Priority: {$Priority}\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/mixed;\n";
	$header .= " boundary=\"".$boundary."\"\n";
	$header .= "X-Mailer: {$a['programname']} - PHP ".PHP_VERSION."\n";

	$content = "This is a multipart message in MIME format.\n\n";
	$content .= "--".$boundary."\n";
	$content .= "Content-Type: text/plain; charset=\"$Charset\"\n";
	$content .= "Content-Transfer-Encoding: 8bit\n\n";
	$content .= $Message."\n";
	$content .= "--".$boundary."\n";
	$content .= "Content-Type: ".mime_content_type($File)."; name=\"".$File."\"\n";
	$content .= "Content-Transfer-Encoding: base64\n";
	$content .= "Content-Disposition: attachment; filename=\"".$File."\"\n\n";
	$content .= $data."\n";
	$content .= "--".$boundary."--"."\n";

	// If you have safe_mode = On, please delete ,"-f$CompanyEmail"
	// because the fifth parameter is not allowed in safe_mode
	//
	if(mail($EmailTo, $Subject, $content, $header,"-f$CompanyEmail"))
	{
		return $_SESSION['emailID'] = '1';
	}
	else
	{
		die($a['email_error'].' '.$php_errormsg);
	}
}

?>
