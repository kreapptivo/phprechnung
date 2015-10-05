<?php

/*
	info.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2010 Edy Corak < edy at loenshotel dot de >

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
UserSite();

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

// Assign needed text from language file
//
$smarty->assign("Title","$a[addressbook] - $a[extended_info]");
$smarty->assign("Print_Name","$a[print_name]");
$smarty->assign("Prefix","$a[prefix]");
$smarty->assign("CTitle","$a[title]");
$smarty->assign("Firstname","$a[firstname]");
$smarty->assign("Lastname","$a[lastname]");
$smarty->assign("Initials","$a[initials]");
$smarty->assign("Phonehome","$a[phonehome]");
$smarty->assign("Salutation","$a[salutation]");
$smarty->assign("Mobile","$a[mobile]");
$smarty->assign("Address","$a[address]");
$smarty->assign("Fax","$a[fax]");
$smarty->assign("Stateprov","$a[stateprov]");
$smarty->assign("Email","$a[email]");
$smarty->assign("Postalcode","$a[postalcode]");
$smarty->assign("City","$a[city]");
$smarty->assign("Url","$a[url]");
$smarty->assign("Company","$a[company]");
$smarty->assign("Phonework","$a[phonework]");
$smarty->assign("Department","$a[department]");
$smarty->assign("Phoneoffi","$a[phoneoffi]");
$smarty->assign("CPosition","$a[position1]");
$smarty->assign("Phoneothe","$a[phoneothe]");
$smarty->assign("Pager","$a[pager]");
$smarty->assign("Note","$a[note]");
$smarty->assign("AltField1","$a[altfield1]");
$smarty->assign("AltField2","$a[altfield2]");
$smarty->assign("Url2","$a[url2]");
$smarty->assign("Email2","$a[email2]");
$smarty->assign("Country","$a[country]");
$smarty->assign("CDate","$a[date_text]");
$smarty->assign("Birthday","$a[birthday]");
$smarty->assign("Category","$a[category]");
$smarty->assign("Envelope","$a[envelope]");
$smarty->assign("Select_All","$a[select_all]");
$smarty->assign("MathodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Select_Report","$a[select_report]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("Issue_Invoice","$a[issue_invoice]");
$smarty->assign("Issue_Offer","$a[issue_offer]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Print","$a[print]");
$smarty->assign("Email_OK","$a[email_ok]");
$smarty->assign("Email_Error","$a[email_error]");
$smarty->assign("Bank_Name","$a[bank_name]");
$smarty->assign("Bank_Account","$a[bank_account]");
$smarty->assign("Bank_Number","$a[bank_number]");
$smarty->assign("Bank_Iban","$a[bank_iban]");
$smarty->assign("Bank_Bic","$a[bank_bic]");
$smarty->assign("Tax_Free","$a[company_tax_free]");
$smarty->assign("Tax_No","$a[company_taxnr]");
$smarty->assign("Business_Tax_No","$a[business_taxnr]");
$smarty->assign("User_Active","$a[user_active]");
$smarty->assign("Username","$a[username]");
$smarty->assign("Language","$a[language]");
$smarty->assign("CloseWindow","$a[close_window]");
$smarty->assign("Basic_Info","$a[basic_info]");
$smarty->assign("Extended_Info","$a[extended_info]");
$smarty->assign("Auth_Info","$a[auth_info]");

// Database connection
//
DBConnect();

// Get all information about selected customer
//
$query = $db->Execute("SELECT PHONEHOME, PHONEOFFI, PHONEOTHE, PHONEWORK, MOBILE, PAGER, FAX, EMAIL,
	URL, URL2, EMAIL2, ALTFIELD1, ALTFIELD2, CREATEDBY, MYID, BANKNAME, BANKACCOUNT, BANKNUMBER,
	BANKIBAN, BANKBIC, TAX_FREE, TAXNR, BUSINESS_TAXNR FROM {$TBLName}addressbook WHERE MYID=$myID");

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($query as $f)
	{
		$CreatedBy = $f['CREATEDBY'];
		$TaxFree = $f['TAX_FREE'];
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("PHONEHOME",$f['PHONEHOME']);
		$smarty->assign("PHONEOFFI",$f['PHONEOFFI']);
		$smarty->assign("PHONEOTHE",$f['PHONEOTHE']);
		$smarty->assign("PHONEWORK",$f['PHONEWORK']);
		$smarty->assign("FAX",$f['FAX']);
		$smarty->assign("MOBILE",$f['MOBILE']);
		$smarty->assign("PAGER",$f['PAGER']);
		$smarty->assign("EMAIL",$f['EMAIL']);
		$smarty->assign("URL",$f['URL']);
		$smarty->assign("URL2",$f['URL2']);
		$smarty->assign("EMAIL2",$f['EMAIL2']);
		$smarty->assign("ALTFIELD1",$f['ALTFIELD1']);
		$smarty->assign("ALTFIELD2",$f['ALTFIELD2']);
		$smarty->assign("CREATOR",$CreatedBy);
		$smarty->assign("EMAIL_INTERNAL",$EmailInternal);
		$smarty->assign("BANKNAME",$f['BANKNAME']);
		$smarty->assign("BANKACCOUNT",$f['BANKACCOUNT']);
		$smarty->assign("BANKNUMBER",$f['BANKNUMBER']);
		$smarty->assign("BANKIBAN",$f['BANKIBAN']);
		$smarty->assign("BANKBIC",$f['BANKBIC']);
		$smarty->assign("TAX_FREE",$choice_yes_no[$TaxFree]);
		$smarty->assign("TAXNR",$f['TAXNR']);
		$smarty->assign("BUSINESS_TAXNR",$f['BUSINESS_TAXNR']);
	}
	
// Put all available customer reports in $choose_customer_report
//
$smarty->assign("choose_customer_report",array($customer_reports));

$smarty->assign("CurrentMyID","$myID");

// Get the first entry from table 'addressbook'
//
$query3 = $db->GetRow("SELECT MIN(MYID) AS MIN_MYID FROM {$TBLName}addressbook");
if (!$query3)
	die($db->ErrorMsg());
else
	$minMyID = $query3['MIN_MYID'];
	$smarty->assign("MinMyID","$minMyID");

// Get the last entry from table 'addressbook'
//
$query4 = $db->GetRow("SELECT MAX(MYID) AS MAX_MYID FROM {$TBLName}addressbook");
if (!$query4)
	die($db->ErrorMsg());
else
	$maxMyID = $query4['MAX_MYID'];

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

$smarty->display('addressbook/info_e.tpl');

?>
