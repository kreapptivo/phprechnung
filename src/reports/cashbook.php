<?php

/*
	cashbook.php

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
	$smarty->assign("Sort","$Sort");
}

if(empty($Order) || $Order !== 'CASHBOOKID' && $Order !== 'TAKINGS' && $Order !== 'EXPENDITURES' && $Order !== 'CASH_IN_HAND' && $Order !== 'CASHBOOK_DATE' && $Order !== 'DESCRIPTION')
{
	$Order = "CASHBOOK_DATE DESC,CASHBOOKID DESC";
	$Sort = "";
	$smarty->assign("Order","$Order");
	$smarty->assign("Sort","$Sort");
}

$smarty->assign("Title","$a[cashbook] - $a[searchresult]");
$smarty->assign("Cashbook_No","$a[cashbook_number]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
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

$DateFrom = German_Mysql_Date($DateFrom);
$DateTill = German_Mysql_Date($DateTill);

if(isset($Canceled) && $Canceled == 1)
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CANCELED=1 AND CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else if(isset($Canceled) && $Canceled == 3)
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else
{
	$query = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CANCELED=2 AND CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
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
		$query1 = $db->Execute("SELECT TAKINGS, EXPENDITURES FROM {$TBLName}cashbook WHERE CANCELED=1 AND CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill'");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$query1 = $db->Execute("SELECT TAKINGS, EXPENDITURES FROM {$TBLName}cashbook WHERE CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill'");
	}
	else
	{
		$query1 = $db->Execute("SELECT TAKINGS, EXPENDITURES FROM {$TBLName}cashbook WHERE CANCELED=2 AND CASHBOOK_DATE >= '$DateFrom' AND CASHBOOK_DATE <= '$DateTill'");
	}

	if (!$query1)
		print($db->ErrorMsg());
	else
		$numrows = $query1->RecordCount();

		$TotalExpendituresSearch = 0;
		$TotalTakingsSearch = 0;

		foreach($query1 as $result1)
		{
			$TotalExpendituresSearch += $result1['EXPENDITURES'];
			$TotalTakingsSearch += $result1['TAKINGS'];
		}

		$smarty->assign("TOTAL_TAKINGS",$TotalTakingsSearch);
		$smarty->assign("TOTAL_EXPENDITURES",$TotalExpendituresSearch);

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
		$TotalPageTakings += $result['TAKINGS'];
		$TotalPageExpenditures += $result['EXPENDITURES'];
	}

	if(isset($CashbookData))
		$smarty->assign('CashbookData', $CashbookData);

	$smarty->assign("TOTAL_PAGE_TAKINGS",$TotalPageTakings);
	$smarty->assign("TOTAL_PAGE_EXPENDITURES",$TotalPageExpenditures);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

// Get min date from cashbook
//
$query4 = $db->GetRow("SELECT MIN(CASHBOOK_DATE) AS MIN_CASHBOOK_DATE FROM {$TBLName}cashbook");
if (!$query4)
	print($db->ErrorMsg());
else
	$Min_Cashbook_Date = $query4['MIN_CASHBOOK_DATE'];

// Calculate total takings / expenditures depend on $DateFrom and $DateTill
//
$query5 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2 AND CASHBOOK_DATE >= '$Min_Cashbook_Date' AND CASHBOOK_DATE <= '$DateTill'");

$Cash_In_Hand_Starting_With = 0;
$TotalExpenditures = 0;
$TotalTakings = 0;

// If an error has occurred, display the error message
//
if (!$query5)
	print($db->ErrorMsg());
else
	foreach($query5 as $result5)
	{
		$Cash_In_Hand_Starting_With += $result5['CASH_IN_HAND_STARTING_WITH'];
		$TotalExpenditures += $result5['EXPENDITURES'];
		$TotalTakings += $result5['TAKINGS'];
	}

	$smarty->assign("CASH_IN_HAND",$TotalTakings-$TotalExpenditures+$Cash_In_Hand_Starting_With);

// Calculate total takings / expenditures depend on $DateFrom and $DateTill
//
$query6 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2 AND CASHBOOK_DATE >= '$Min_Cashbook_Date' AND CASHBOOK_DATE < '$DateFrom'");

$Cash_In_Hand_Starting_With1 = 0;
$TotalExpenditures1 = 0;
$TotalTakings1 = 0;

// If an error has occurred, display the error message
//
if (!$query6)
	print($db->ErrorMsg());
else
	foreach($query6 as $result6)
	{
		$Cash_In_Hand_Starting_With1 += $result6['CASH_IN_HAND_STARTING_WITH'];
		$TotalExpenditures1 += $result6['EXPENDITURES'];
		$TotalTakings1 += $result6['TAKINGS'];
	}

	$smarty->assign("CASH_IN_HAND_STARTING_WITH",$TotalTakings1-$TotalExpenditures1+$Cash_In_Hand_Starting_With1);

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

$smarty->display('reports/cashbook.tpl');

?>
