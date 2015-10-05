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

if(!is_numeric($myID) || $myID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == "10")
{
	$Searchstring = "&amp;CustomerID=$CustomerID&amp;Prefix1=$Prefix1&amp;Title11=$Title11&amp;Firstname1=$Firstname1&amp;Initials1=$Initials1&amp;Lastname1=$Lastname1&amp;Phonehome1=$Phonehome1&amp;Salutation1=$Salutation1&amp;Mobile1=$Mobile1&amp;Address1=$Address1&amp;Fax1=$Fax1&amp;Stateprov1=$Stateprov1&amp;Email1=$Email1&amp;Postalcode1=$Postalcode1&amp;City1=$City1&amp;Url1=$Url1&amp;Company1=$Company1&amp;Phonework1=$Phonework1&amp;Department1=$Department1&amp;Phoneoffi1=$Phoneoffi1&amp;Position11=$Position11&amp;Phoneothe1=$Phoneothe1&amp;Pager1=$Pager1&amp;Note1=$Note1&amp;Country1=$Country1&amp;Date_From1=$Date_From1&amp;Date_Till1=$Date_Till1&amp;Birthday1=$Birthday1&amp;Category1=$Category1&amp;MethodOfPayment1=$MethodOfPayment1&amp;PrintName1=$PrintName1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from selected language file
//
$smarty->assign("Title","$a[addressbook] - $a[email]");
$smarty->assign("Email","$a[email]");
$smarty->assign("Email_From","$a[email_from]");
$smarty->assign("Email_To","$a[email_to]");
$smarty->assign("Email_Cc","$a[email_cc]");
$smarty->assign("Email_Bcc","$a[email_bcc]");
$smarty->assign("Email_Subject","$a[email_subject]");
$smarty->assign("Email_Priority","$a[email_priority]");
$smarty->assign("Email_Text","$a[email_text]");
$smarty->assign("Email_Send","$a[email_send]");
$smarty->assign("Customer_No","$a[customer_no]");

// Get the choice array from language file
//
$smarty->assign("email_priority",array($email_priority));

// Database connection
//
DBConnect();

// Get customer information and company settings 
//
$query = $db->Execute("SELECT FIRSTNAME, LASTNAME, COMPANY, SALUTATION,
	EMAIL, ALTFIELD2, CREATEDBY, MYID FROM {$TBLName}addressbook WHERE MYID=$myID");
$row = $query->GetRows();

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($row as $f)
	{
		$CreatedBy = $f['CREATEDBY'];
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("COMPANYNAME",$CompanyName);
		$smarty->assign("COMPANYEMAIL",$CompanyEmail);

		if(empty($EmailTo) && $e_mailID == 1)
		{
			$smarty->assign("EMAIL_TO",$f['EMAIL']);
		}
		else if(empty($EmailTo) && $e_mailID == 2)
		{
			$smarty->assign("EMAIL_TO",$f['ALTFIELD2']);
		}
		else
		{
			$smarty->assign("EMAIL_TO",$EmailTo);
		}

		if($EmailUseSignature == 1)
		{
			$EMAILTEXT = $f['SALUTATION'].' '.$f['FIRSTNAME'].' '.$f['LASTNAME']."\n\n\n".$EmailSignature;
		}
		else
		{
			$EMAILTEXT = $f['SALUTATION'].' '.$f['FIRSTNAME'].' '.$f['LASTNAME'];
		}

		if(empty($EmailText))
		{
			$smarty->assign("EMAIL_TEXT",$EMAILTEXT);
		}
		else
		{
			$smarty->assign("EMAIL_TEXT",$EmailText);
		}
	}

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

	$smarty->display('addressbook/email.tpl');
}

?>
