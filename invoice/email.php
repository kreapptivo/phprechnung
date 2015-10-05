<?php

/*
	email.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require_once("../include/phprechnung.inc.php");
require_once("../include/smarty.inc.php");

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($invoiceID) || $invoiceID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&amp;InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[delivery_note] / $a[invoice] - $a[email]");
$smarty->assign("Email_Invoice","$a[email_invoice]");
$smarty->assign("Email_Delivery_Note","$a[email_delivery_note]");
$smarty->assign("Delivery_Note","$a[delivery_note]");

$smarty->assign("InvoiceInitials","$a[invoice_initials]");
$smarty->assign("DeliveryNoteInitials","$a[delivery_note_initials]");

$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("Delivery_Note_No","$a[delivery_note_number]");
$smarty->assign("Customer_No","$a[customer_no]");

$smarty->assign("Email_From","$a[email_from]");
$smarty->assign("Email_To","$a[email_to]");
$smarty->assign("Email_Cc","$a[email_cc]");
$smarty->assign("Email_Bcc","$a[email_bcc]");
$smarty->assign("Email_Priority","$a[email_priority]");
$smarty->assign("Email_Text","$a[email_text]");

$pattern[0] = '/&/i';
$replacement[0] = '&amp;';
$CompanyName = preg_replace($pattern,$replacement,$CompanyName);
$smarty->assign("COMPANYNAME",$CompanyName);
$smarty->assign("COMPANYEMAIL",$CompanyEmail);

// Get the choice array from language file
//
$smarty->assign("email_priority",array($email_priority));

// Database connection
//
DBConnect();

// Get Invoice Information
//
$query = $db->Execute("SELECT A.FIRSTNAME, A.LASTNAME, A.COMPANY, A.MYID, A.SALUTATION, A.EMAIL, I.INVOICEID, I.MYID,
	DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.CREATEDBY FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=I.MYID AND I.INVOICEID=$invoiceID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$InvoiceDate = $f['INVOICE_DATE'];
		$InvoiceID = $f['INVOICEID'];
		$CreatedBy = $f['CREATEDBY'];
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("EMAIL_TO",$f['EMAIL']);

		if(!empty($f['LASTNAME']))
		{
			$smarty->assign("SALUTATION",$f['SALUTATION'].' '.$f['FIRSTNAME'].' '.$f['LASTNAME'].",\n\n");
		}
		else
		{
			$smarty->assign("SALUTATION",$f['SALUTATION'].",\n\n");
		}
	}

$PrintD = Print_Date($InvoiceDate);
$smarty->assign("PrintDate",$PrintD.'-'.$InvoiceID);

$patterns[0] = '/{NUMBER}/i';
$patterns[1] = '/{DATE}/i';
$patterns[2] = '/&/i';
$patterns[3] = '/{TYPE}/i';
$replacements[0] = $PrintD.'-'.$InvoiceID;
$replacements[1] = $InvoiceDate;
$replacements[2] = '&amp;';
if ($SendEmail == 1)
{
	$replacements[3] = $a['invoice'];
}
else
{
	$replacements[3] = $a['delivery_note'];
}
$PDFAttachmentText = preg_replace($patterns,$replacements,$PDFAttachmentText);

$smarty->assign("COMPANY_PDF_ATTACHMENT_TEXT",$PDFAttachmentText);

if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Usergroup1'] != $admingroup_1 && $_SESSION['Usergroup2'] != $admingroup_2 && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	// Save last page visited by user
	//
	UserSite();
	$smarty->display('invoice/email.tpl');
}

?>
