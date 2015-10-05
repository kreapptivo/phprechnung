<?php

/*
	search_e.php

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

$smarty->assign("CompanyDate",$CompanyDate);

// Assign needed text from selected language file
//
$smarty->assign("Title","$a[addressbook] - $a[search]");
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

$smarty->assign("Country","$a[country]");
$smarty->assign("CDate","$a[date_text]");
$smarty->assign("Birthday","$a[birthday]");
$smarty->assign("Category","$a[category]");
$smarty->assign("Envelope","$a[envelope]");
$smarty->assign("Select_All","$a[select_all]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Select_Report","$a[select_report]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Select_All","$a[select_all]");

// Get the choice array from language file
//
$smarty->assign("choice_yes_no",array($choice_yes_no));

// Database connection
//
DBConnect();

// Get the category and payment descriptions from database
//
$query1 = $db->Execute("SELECT CATEGORYID, DESCRIPTION FROM {$TBLName}category ORDER BY DESCRIPTION ASC");
$query2 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if ((!$query1) || (!$query2))
	print $db->ErrorMsg();
else
	foreach($query1 as $result1)
	{
		$CategoryData[] = $result1;
	}

	if(isset($CategoryData))
		$smarty->assign("CategoryData",$CategoryData);
	
	foreach($query2 as $result2)
	{
		$PaymentData[] = $result2;
	}

	if(isset($PaymentData))
		$smarty->assign("PaymentData",$PaymentData);
	
UserSite();

$smarty->display('addressbook/search_e.tpl');

?>
