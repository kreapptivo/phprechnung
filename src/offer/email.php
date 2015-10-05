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

if(!is_numeric($offerID) || $offerID <= 0 )
{
	die(header("Location: $web"));
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[offer] / $a[order] - $a[email]");
$smarty->assign("Email_Offer","$a[email_offer]");
$smarty->assign("Email_Order","$a[email_order]");
$smarty->assign("OOrder","$a[order]");

$smarty->assign("OfferInitials","$a[offer_initials]");
$smarty->assign("OrderInitials","$a[order_initials]");

$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("Order_No","$a[order_number]");
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

// Get Offer Information
//
$query = $db->Execute("SELECT A.FIRSTNAME, A.LASTNAME, A.COMPANY, A.MYID, A.SALUTATION, A.EMAIL, O.OFFERID, O.MYID,
	DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.CREATEDBY FROM {$TBLName}addressbook AS A, offer AS O WHERE A.MYID=O.MYID AND O.OFFERID=$offerID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$OfferDate = $f['OFFER_DATE'];
		$OfferID = $f['OFFERID'];
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

$PrintD = Print_Date($OfferDate);
$smarty->assign("PrintDate",$PrintD.'-'.$OfferID);

$patterns[0] = '/{NUMBER}/i';
$patterns[1] = '/{DATE}/i';
$patterns[2] = '/&/i';
$patterns[3] = '/{TYPE}/i';
$replacements[0] = $PrintD.'-'.$OfferID;
$replacements[1] = $OfferDate;
$replacements[2] = '&amp;';
if ($SendEmail == 1)
{
	$replacements[3] = $a['offer'];
}
else
{
	$replacements[3] = $a['order'];
}
$PDFAttachmentText = preg_replace($patterns,$replacements,$PDFAttachmentText);

$smarty->assign("COMPANY_PDF_ATTACHMENT_TEXT",$PDFAttachmentText);

if(isset($_SESSION['Usergroup2'], $_SESSION['Username']) && $_SESSION['Usergroup2'] != $admingroup_2 && $_SESSION['Usergroup2'] != $admingroup_3 && $_SESSION['Username'] != $CreatedBy)
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
	$smarty->display('offer/email.tpl');
}

?>
