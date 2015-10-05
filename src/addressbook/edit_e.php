<?php

/*
	edit.php

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
$smarty->assign("Title","$a[addressbook] - $a[edit] - $a[extended_info]");
$smarty->assign("Phonehome","$a[phonehome]");
$smarty->assign("Mobile","$a[mobile]");
$smarty->assign("Fax","$a[fax]");
$smarty->assign("Email","$a[email]");
$smarty->assign("Url","$a[url]");
$smarty->assign("Phonework","$a[phonework]");
$smarty->assign("Phoneoffi","$a[phoneoffi]");
$smarty->assign("Phoneothe","$a[phoneothe]");
$smarty->assign("Pager","$a[pager]");
$smarty->assign("Url2","$a[url2]");
$smarty->assign("Email2","$a[email2]");
$smarty->assign("AltField1","$a[altfield1]");
$smarty->assign("AltField2","$a[altfield2]");
$smarty->assign("Select_All","$a[select_all]");
$smarty->assign("Select_Report","$a[select_report]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Bank_Name","$a[bank_name]");
$smarty->assign("Bank_Account","$a[bank_account]");
$smarty->assign("Bank_Number","$a[bank_number]");
$smarty->assign("Bank_Iban","$a[bank_iban]");
$smarty->assign("Bank_Bic","$a[bank_bic]");
$smarty->assign("Tax_Free","$a[company_tax_free]");
$smarty->assign("Tax_No","$a[company_taxnr]");
$smarty->assign("Business_Tax_No","$a[business_taxnr]");
$smarty->assign("Basic_Info","$a[basic_info]");
$smarty->assign("Extended_Info","$a[extended_info]");
$smarty->assign("Auth_Info","$a[auth_info]");

// Database connection
//
DBConnect();

// Get the information about selected customer
//
$query = $db->Execute("SELECT PHONEHOME, PHONEOFFI, PHONEOTHE, PHONEWORK, MOBILE, PAGER, FAX, EMAIL,
	URL, URL2, EMAIL2, ALTFIELD1, ALTFIELD2, CREATEDBY, BANKNAME, BANKACCOUNT, BANKNUMBER, BANKIBAN,
	BANKBIC, MYID, TAX_FREE, TAXNR, BUSINESS_TAXNR FROM {$TBLName}addressbook WHERE MYID=$myID");

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($query as $f)
	{
		$CreatedBy = $f['CREATEDBY'];
		$smarty->assign("MYID",$f['MYID']);

		if(empty($Phonehome))
		{
			$smarty->assign("PHONEHOME",$f['PHONEHOME']);
		}
		else
		{
			$smarty->assign("PHONEHOME",$Phonehome);
		}
		if(empty($Phoneoffi))
		{
			$smarty->assign("PHONEOFFI",$f['PHONEOFFI']);
		}
		else
		{
			$smarty->assign("PHONEOFFI",$Phoneoffi);
		}
		if(empty($Phoneothe))
		{
			$smarty->assign("PHONEOTHE",$f['PHONEOTHE']);
		}
		else
		{
			$smarty->assign("PHONEOTHE",$Phoneothe);
		}
		if(empty($Phonework))
		{
			$smarty->assign("PHONEWORK",$f['PHONEWORK']);
		}
		else
		{
			$smarty->assign("PHONEWORK",$Phonework);
		}
		if(empty($Fax))
		{
			$smarty->assign("FAX",$f['FAX']);
		}
		else
		{
			$smarty->assign("FAX",$Fax);
		}
		if(empty($Mobile))
		{
			$smarty->assign("MOBILE",$f['MOBILE']);
		}
		else
		{
			$smarty->assign("MOBILE",$Mobile);
		}
		if(empty($Pager))
		{
			$smarty->assign("PAGER",$f['PAGER']);
		}
		else
		{
			$smarty->assign("PAGER",$Pager);
		}
		if(empty($Email))
		{
			$smarty->assign("EMAIL",$f['EMAIL']);
		}
		else
		{
			$smarty->assign("EMAIL",$Email);
		}
		if(empty($Url))
		{
			$smarty->assign("URL",$f['URL']);
		}
		else
		{
			$smarty->assign("URL",$Url);
		}
		if(empty($Url2))
		{
			$smarty->assign("URL2",$f['URL2']);
		}
		else
		{
			$smarty->assign("URL2",$Url2);
		}
		if(empty($Email2))
		{
			$smarty->assign("EMAIL2",$f['EMAIL2']);
		}
		else
		{
			$smarty->assign("EMAIL2",$Email2);
		}
		if(empty($AltField1))
		{
			$smarty->assign("ALTFIELD1",$f['ALTFIELD1']);
		}
		else
		{
			$smarty->assign("ALTFIELD1",$AltField1);
		}
		if(empty($AltField2))
		{
			$smarty->assign("ALTFIELD2",$f['ALTFIELD2']);
		}
		else
		{
			$smarty->assign("ALTFIELD2",$AltField2);
		}

		$smarty->assign("CREATEDBY",$CreatedBy);

		if(empty($D_Bank_Name))
		{
			$smarty->assign("BANKNAME",$f['BANKNAME']);
		}
		else
		{
			$smarty->assign("BANKNAME",$D_Bank_Name);
		}
		if(empty($D_Bank_Account))
		{
			$smarty->assign("BANKACCOUNT",$f['BANKACCOUNT']);
		}
		else
		{
			$smarty->assign("BANKACCOUNT",$D_Bank_Account);
		}
		if(empty($D_Bank_Number))
		{
			$smarty->assign("BANKNUMBER",$f['BANKNUMBER']);
		}
		else
		{
			$smarty->assign("BANKNUMBER",$D_Bank_Number);
		}
		if(empty($D_Bank_Iban))
		{
			$smarty->assign("BANKIBAN",$f['BANKIBAN']);
		}
		else
		{
			$smarty->assign("BANKIBAN",$D_Bank_Iban);
		}
		if(empty($D_Bank_Bic))
		{
			$smarty->assign("BANKBIC",$f['BANKBIC']);
		}
		else
		{
			$smarty->assign("BANKBIC",$D_Bank_Bic);
		}
		if(empty($D_Tax_Free))
		{
			$smarty->assign("TAX_FREE",$f['TAX_FREE']);
		}
		else
		{
			$smarty->assign("TAX_FREE",$D_Tax_Free);
		}
		if(empty($D_Taxnr))
		{
			$smarty->assign("TAXNR",$f['TAXNR']);
		}
		else
		{
			$smarty->assign("TAXNR",$D_Taxnr);
		}
		if(empty($D_Business_Taxnr))
		{
			$smarty->assign("BUSINESS_TAXNR",$f['BUSINESS_TAXNR']);
		}
		else
		{
			$smarty->assign("BUSINESS_TAXNR",$D_Business_Taxnr);
		}
	}

// Get the choice array from language file
//
$smarty->assign("choice_yes_no",array($choice_yes_no));

$smarty->assign("CurrentMyID","$myID");

// Get the first entry from table 'addressbook'
//
$query4 = $db->GetRow("SELECT MIN(MYID) AS MIN_MYID FROM {$TBLName}addressbook");
if (!$query4)
	die($db->ErrorMsg());
else
	$minMyID = $query4['MIN_MYID'];
	$smarty->assign("MinMyID","$minMyID");

// Get the last entry from table 'addressbook'
//
$query5 = $db->GetRow("SELECT MAX(MYID) AS MAX_MYID FROM {$TBLName}addressbook");
if (!$query5)
	die($db->ErrorMsg());
else
	$maxMyID = $query5['MAX_MYID'];

	$smarty->assign("MaxMyID","$maxMyID");

// If we are not on first page then display
// first page, previous page link
//
if ($myID > $minMyID)
{
	$CurrentMyID = $myID - 1;
	$smarty->assign('PrevMyID', "$CurrentMyID");
}

// If we are not on the last page then display
// next page, last page link
//
if ($myID < $maxMyID)
{
	$CurrentMyID = $myID + 1;
	$smarty->assign('NextMyID', "$CurrentMyID");
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

	$smarty->display('addressbook/edit_e.tpl');
}

?>
