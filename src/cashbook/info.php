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
CheckAdminGroup3();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($cashbookID) || $cashbookID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == "9")
{
	$Searchstring = "CashbookNo_1=$CashbookNo_1&amp;DateFrom_1=$DateFrom_1&amp;DateTill_1=$DateTill_1&amp;Takings_1=$Takings_1&amp;Expenditures_1=$Expenditures_1&amp;Description_1=$Description_1";
	$smarty->assign("Searchstring","$Searchstring");
}

$smarty->assign("Title","$a[cashbook] - $a[info]");
$smarty->assign("CashbookNo","$a[cashbook_number]");
$smarty->assign("CashInHand","$a[cash_in_hand]");
$smarty->assign("Starting_With","$a[starting_with]");
$smarty->assign("Takings","$a[takings]");
$smarty->assign("Expenditures","$a[expenditures]");
$smarty->assign("Description","$a[cashbook_description]");
$smarty->assign("CustomerNo","$a[customer_no]");
$smarty->assign("InvoiceNo","$a[invoice_number]");
$smarty->assign("PaymentNo","$a[payment_number]");
$smarty->assign("CloseWindow","$a[close_window]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Cashbook_Currency",$CompanyCurrency);

// Get entrys from cashbook table
//
$query = $db->Execute("SELECT CASHBOOKID, MYID, INVOICEID, PAYMENTID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DATE, TAKINGS, EXPENDITURES, DESCRIPTION, CASH_IN_HAND, CASH_IN_HAND_STARTING_WITH, CANCELED FROM {$TBLName}cashbook WHERE CASHBOOKID=$cashbookID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("INVOICEID",$f['INVOICEID']);
		$smarty->assign("PAYMENTID",$f['PAYMENTID']);
		$smarty->assign("CASHBOOK_DATE",$f['CASHBOOK_DATE']);
		$smarty->assign("TAKINGS",$f['TAKINGS']);
		$smarty->assign("EXPENDITURES",$f['EXPENDITURES']);
		$smarty->assign("DESCRIPTION",$f['DESCRIPTION']);
		$smarty->assign("CASH_IN_HAND",$f['CASH_IN_HAND']);
		$smarty->assign("CASH_IN_HAND_STARTING_WITH",$f['CASH_IN_HAND_STARTING_WITH']);
		$smarty->assign("CANCELED",$f['CANCELED']);
	}

$smarty->assign("CurrentCashbookID","$cashbookID");

// Get the first entry from table 'cashbook'
//
$query3 = $db->GetRow("SELECT MIN(CASHBOOKID) AS MIN_CASHBOOKID FROM {$TBLName}cashbook");
if (!$query3)
	die($db->ErrorMsg());
else
	$minCashbookID = $query3['MIN_CASHBOOKID'];
	$smarty->assign("MinCashbookID","$minCashbookID");

// Get the last entry from table 'cashbook'
//
$query4 = $db->GetRow("SELECT MAX(CASHBOOKID) AS MAX_CASHBOOKID FROM {$TBLName}cashbook");
if (!$query4)
	die($db->ErrorMsg());
else
	$maxCashbookID = $query4['MAX_CASHBOOKID'];

	$smarty->assign("MaxCashbookID","$maxCashbookID");

// If we are not on first page then display
// first page, previous page link
//
if ($cashbookID > $minCashbookID)
{
	$CurrentCashbookID = $cashbookID - 1;
	$smarty->assign('PrevCashbookID', "$CurrentCashbookID");
}

// If we are not on the last page then display
// next page, last page link
//
if ($cashbookID < $maxCashbookID)
{
	$CurrentCashbookID = $cashbookID + 1;
	$smarty->assign('NextCashbookID', "$CurrentCashbookID");
}

$smarty->display('cashbook/info.tpl');

?>
