<?php

/*
	list.php

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
CheckAdminGroup3();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!isset($page) || !is_numeric($page) || $page <= 0 )
{
	$page = 1;
}

if(!isset($Sort) || $Sort !== 'ASC' && $Sort !== 'DESC')
{
	$Sort = "";
}

if(empty($Order) || $Order !== 'CASHBOOKID' && $Order !== 'TAKINGS' && $Order !== 'EXPENDITURES' && $Order !== 'CASH_IN_HAND' && $Order !== 'CASHBOOK_DATE' && $Order !== 'DESCRIPTION')
{
	$Order = "CASHBOOK_DATE DESC,CASHBOOKID DESC";
	$Sort = "";
}

$smarty->assign("Title","$a[cashbook] - $a[list]");
$smarty->assign("EntryCanceled","$a[entry_canceled]");
$smarty->assign("NewEntry","$a[new_entry]");
$smarty->assign("Cashbook_No","$a[cashbook_number]");
$smarty->assign("Takings","$a[takings]");
$smarty->assign("Expenditures","$a[expenditures]");
$smarty->assign("Cash_In_Hand","$a[cash_in_hand]");
$smarty->assign("Starting_With","$a[starting_with]");
$smarty->assign("Cashbook_Description","$a[cashbook_description]");


// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Cashbook_Currency",$CompanyCurrency);

$intCursor = ($page - 1) * $EntrysPerPage;

// Get Cashbook Information
//
if(isset($Canceled) && $Canceled == 1)
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook WHERE CANCELED=1 ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else if(isset($Canceled) && $Canceled == 3)
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook WHERE CANCELED=2 ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count PageRows
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows
	//
	if(isset($Canceled) && $Canceled == 1)
	{
		$query1 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES FROM {$TBLName}cashbook WHERE CANCELED=1");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$query1 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES FROM {$TBLName}cashbook");
	}
	else
	{
		$query1 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES FROM {$TBLName}cashbook WHERE CANCELED=2");
	}

	$numrows = $query1->RecordCount();

	$TotalTakings = 0;
	$TotalExpenditures = 0;
	$Cash_In_Hand_Starting_With = 0;

	foreach($query1 as $result1)
	{
		// Calculate total takings
		//
		$TotalTakings += $result1['TAKINGS'];
		$smarty->assign("TOTAL_TAKINGS",$TotalTakings);

		// Calculate Total Expenditures per Page
		//
		$TotalExpenditures += $result1['EXPENDITURES'];
		$smarty->assign("TOTAL_EXPENDITURES",$TotalExpenditures);

		// Calculate cash in hand
		//
		$Cash_In_Hand_Starting_With += $result1['CASH_IN_HAND_STARTING_WITH'];
		$smarty->assign("CASH_IN_HAND_STARTING_WITH",$Cash_In_Hand_Starting_With);
		$smarty->assign("CASH_IN_HAND",$TotalTakings - $TotalExpenditures + $Cash_In_Hand_Starting_With);
	}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$TotalPageTakings = 0;
	$TotalPageExpenditures = 0;

	// Save all entrys in $CashbookData array
	//
	foreach($query as $result)
	{
		$CashbookData[] = $result;

		// Calculate total takings
		//
		$TotalPageTakings += $result['TAKINGS'];
		$smarty->assign("TOTAL_PAGE_TAKINGS",$TotalPageTakings);

		// Calculate Total Expenditures per Page
		//
		$TotalPageExpenditures += $result['EXPENDITURES'];
		$smarty->assign("TOTAL_PAGE_EXPENDITURES",$TotalPageExpenditures);
	}

	if(isset($CashbookData))
		$smarty->assign('CashbookData', $CashbookData);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

// Display pager only if $numrows > $EntrysPerPage ( lines per page )
// from settings menu
//
if ($numrows > $EntrysPerPage)
{
	$smarty->assign('CurrentPage', "$page");
	$smarty->assign('MaxPages', "$intPages");
	$smarty->assign('AddCurrentPage', "page=$page&amp;");

	// If we are not on first page then display
	// first page, previous page link
	//
	if ($page > 1)
	{
		$Page = $page - 1;
		$smarty->assign('PrevPage', "$Page");
	}

	// If we are not on the last page then display
	// next page, last page link
	//
	if ($page < $intPages)
	{
		$Page = $page + 1;
		$smarty->assign('NextPage', "$Page");
	}
}

$smarty->display('cashbook/list.tpl');

unset($_SESSION['CancelID']);
unset($_SESSION['NewID']);

?>
