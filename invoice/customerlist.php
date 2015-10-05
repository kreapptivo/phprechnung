<?php

/*
	customerlist.php

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

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!isset($CustPage) || !is_numeric($CustPage) || $CustPage <= 0 )
{
	$CustPage = 1;
}

if(!isset($CustSort) || $CustSort !== 'ASC' && $CustSort !== 'DESC')
{
	$CustSort = "";
}

if(empty($CustOrder) || $CustOrder !== 'LASTNAME' && $CustOrder !== 'FIRSTNAME' && $CustOrder !== 'COMPANY')
{
	$CustOrder = "LASTNAME,FIRSTNAME,COMPANY";
	$CustSort = "";
}

$smarty->assign("NR_METHOD_OF_PAYMENT","$MethodOfPayment");

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&amp;InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

$smarty->assign("Title","$a[addressbook] - $a[searchresult]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Issue_Invoice","$a[issue_invoice]");
$smarty->assign("Customer_No","$a[customer_no]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Currency","$CompanyCurrency");

$intCursor = ($CustPage - 1) * $EntrysPerPage;

// Get Customer Information
//
$query = $db->Execute("SELECT LASTNAME, FIRSTNAME, COMPANY, MYID FROM {$TBLName}addressbook
		WHERE FIRSTNAME LIKE '%$Customer%' OR LASTNAME LIKE '%$Customer%' OR COMPANY LIKE '%$Customer%'
		ORDER BY $CustOrder $CustSort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count only PageRows depend on search result
	//
	$pagenumrows = $query->RecordCount();

	// Count search result
	//
	$query1 = $db->Execute("SELECT LASTNAME, FIRSTNAME, COMPANY, MYID FROM {$TBLName}addressbook
		WHERE FIRSTNAME LIKE '%$Customer%' OR LASTNAME LIKE '%$Customer%' OR COMPANY LIKE '%$Customer%'");

	$numrows = $query1->RecordCount();

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	// Save all entrys in $CustomerData array
	//
	foreach($query as $result)
	{
		$CustomerData[] = $result;
	}

	if(isset($CustomerData))
		$smarty->assign('CustomerData', $CustomerData);
	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

// Display pager only if $numrows > $EntrysPerPage ( lines per page )
// from settings menu
//
if ($numrows > $EntrysPerPage)
{
	$smarty->assign('CurrentPage', "$CustPage");
	$smarty->assign('MaxPages', "$intPages");
	$smarty->assign('AddCurrentPage', "CustPage=$CustPage&amp;");

	// If we are not on first page then display
	// first page, previous page link
	//
	if ($CustPage > 1)
	{
		$CustPage = $CustPage - 1;
		$smarty->assign('PrevPage', "$CustPage");
	}

	// If we are not on the last page then display
	// next page, last page link
	//
	if ($CustPage < $intPages)
	{
		$CustPage = $CustPage + 1;
		$smarty->assign('NextPage', "$CustPage");
	}
}

$smarty->display('invoice/customerlist.tpl');

?>
