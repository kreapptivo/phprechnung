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
$smarty->assign("Title","$a[addressbook] - $a[edit] - $a[basic_info]");
$smarty->assign("Print_Name","$a[print_name]");
$smarty->assign("Prefix","$a[prefix]");
$smarty->assign("CTitle","$a[title]");
$smarty->assign("Firstname","$a[firstname]");
$smarty->assign("Lastname","$a[lastname]");
$smarty->assign("Initials","$a[initials]");
$smarty->assign("Salutation","$a[salutation]");
$smarty->assign("Address","$a[address]");
$smarty->assign("Stateprov","$a[stateprov]");
$smarty->assign("Postalcode","$a[postalcode]");
$smarty->assign("City","$a[city]");
$smarty->assign("Company","$a[company]");
$smarty->assign("Department","$a[department]");
$smarty->assign("CPosition","$a[position1]");
$smarty->assign("Note","$a[note]");
$smarty->assign("Country","$a[country]");
$smarty->assign("CDate","$a[date_text]");
$smarty->assign("Birthday","$a[birthday]");
$smarty->assign("Category","$a[category]");
$smarty->assign("Select_All","$a[select_all]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Select_Report","$a[select_report]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Choose_Message","$a[choose_message]");
$smarty->assign("CustMessage","$a[message]");
$smarty->assign("Basic_Info","$a[basic_info]");
$smarty->assign("Extended_Info","$a[extended_info]");
$smarty->assign("Auth_Info","$a[auth_info]");

// Database connection
//
DBConnect();

// Get the information about selected customer
//
$query = $db->Execute("SELECT PREFIX, FIRSTNAME, LASTNAME, TITLE, COMPANY, DEPARTMENT, ADDRESS,
	CITY, STATEPROV, POSTALCODE, COUNTRY, POSITION, INITIALS, SALUTATION, NOTE, CATEGORY,
	PRINT_NAME, CREATEDBY, METHODOFPAY, CREATED, DATE_FORMAT(BIRTHDAY,'%d.%m.%Y') AS BIRTHDAY,
	MESSAGE, MYID FROM {$TBLName}addressbook WHERE MYID=$myID");
$row = $query->GetRows();

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($row as $f)
	{
		$CreatedBy = $f['CREATEDBY'];
		$smarty->assign("MYID",$f['MYID']);
		if(empty($Title1))
		{
			$smarty->assign("TITLE",$f['TITLE']);
		}
		else
		{
			$smarty->assign("TITLE",$Title1);
		}
		if(empty($Prefix))
		{
			$smarty->assign("PREFIX",$f['PREFIX']);
		}
		else
		{
			$smarty->assign("PREFIX",$Prefix);
		}
		if(empty($Firstname))
		{
			$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		}
		else
		{
			$smarty->assign("FIRSTNAME",$Firstname);
		}
		if(empty($Lastname))
		{
			$smarty->assign("LASTNAME",$f['LASTNAME']);
		}
		else
		{
			$smarty->assign("LASTNAME",$Lastname);
		}
		if(empty($Company))
		{
			$smarty->assign("COMPANY",$f['COMPANY']);
		}
		else
		{
			$smarty->assign("COMPANY",$Company);
		}
		if(empty($Department))
		{
			$smarty->assign("DEPARTMENT",$f['DEPARTMENT']);
		}
		else
		{
			$smarty->assign("DEPARTMENT",$Department);
		}
		if(empty($Address))
		{
			$smarty->assign("ADDRESS",$f['ADDRESS']);
		}
		else
		{
			$smarty->assign("ADDRESS",$Address);
		}
		if(empty($City))
		{
			$smarty->assign("CITY",$f['CITY']);
		}
		else
		{
			$smarty->assign("CITY",$City);
		}
		if(empty($Stateprov))
		{
			$smarty->assign("STATEPROV",$f['STATEPROV']);
		}
		else
		{
			$smarty->assign("STATEPROV",$Stateprov);
		}
		if(empty($Postalcode))
		{
			$smarty->assign("POSTALCODE",$f['POSTALCODE']);
		}
		else
		{
			$smarty->assign("POSTALCODE",$Postalcode);
		}
		if(empty($Country))
		{
			$smarty->assign("COUNTRY",$f['COUNTRY']);
		}
		else
		{
			$smarty->assign("COUNTRY",$Country);
		}
		if(empty($Position1))
		{
			$smarty->assign("POSITION",$f['POSITION']);
		}
		else
		{
			$smarty->assign("POSITION",$Position1);
		}
		if(empty($Initials))
		{
			$smarty->assign("INITIALS",$f['INITIALS']);
		}
		else
		{
			$smarty->assign("INITIALS",$Initials);
		}
		if(empty($Salutation))
		{
			$smarty->assign("SALUTATION",$f['SALUTATION']);
		}
		else
		{
			$smarty->assign("SALUTATION",$Salutation);
		}

		if(empty($Note))
		{
			$smarty->assign("NOTE",$f['NOTE']);
		}
		else
		{
			$smarty->assign("NOTE",$Note);
		}

		if(empty($Category))
		{
			$smarty->assign("NR_CATEGORY",$f['CATEGORY']);
		}
		else
		{
			$smarty->assign("NR_CATEGORY",$Category);
		}
		if(empty($PrintName))
		{
			$smarty->assign("PRINT_NAME",$f['PRINT_NAME']);
		}
		else
		{
			$smarty->assign("PRINT_NAME",$PrintName);
		}
		$smarty->assign("CREATEDBY",$CreatedBy);
		if(empty($MethodOfPayment))
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$f['METHODOFPAY']);
		}
		else
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$MethodOfPayment);
		}
		if(empty($Message))
		{
			$smarty->assign("MESSAGE",$f['MESSAGE']);
		}
		else
		{
			$smarty->assign("MESSAGE",$Message);
		}
		$smarty->assign("CREATED",$f['CREATED']);
		if(empty($Birthday))
		{
			$smarty->assign("BIRTHDAY",$f['BIRTHDAY']);
		}
		else
		{
			$smarty->assign("BIRTHDAY",$Birthday);
		}
	}

	// Get the choice array from language file
	//
	$smarty->assign("choice_yes_no",array($choice_yes_no));

	// Get the category and payment descriptions from database
	//
	$query1 = $db->Execute("SELECT CATEGORYID, DESCRIPTION FROM {$TBLName}category ORDER BY DESCRIPTION ASC");
	$query2 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

	// If an error has occurred, display the error message
	//
	if ((!$query1) || (!$query2))
		print$db->ErrorMsg();
	else
		foreach($query1 as $result1) {
			$CategoryData[] = $result1;
		}
		if(isset($CategoryData))
			$smarty->assign("CategoryData",$CategoryData);

		foreach($query2 as $result2) {
			$PaymentData[] = $result2;
		}
		if(isset($PaymentData))
			$smarty->assign("PaymentData",$PaymentData);

	$query3 = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message ORDER BY DESCRIPTION ASC");

	foreach($query3 as $result3)
	{
		$MessageData[] = $result3;
	}
	if(isset($MessageData))
		$smarty->assign("MessageData",$MessageData);

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

if(!is_Superuser() && !is_Admin() && !is_Manager() && $_SESSION['Username'] != $CreatedBy)
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
	$smarty->display('addressbook/edit.tpl');
}

?>
