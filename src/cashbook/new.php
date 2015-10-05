<?php

/*
	new.php

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
CheckAdminGroup1();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(empty($cashbookdate))
{
	$cashbookdate = date('d.m.Y');
	$smarty->assign("cashbookdate",$cashbookdate);
}

$smarty->assign("Title","$a[cashbook] - $a[new]");
$smarty->assign("Cashbook_Number","$a[cashbook_number]");
$smarty->assign("Takings","$a[takings]");
$smarty->assign("Expenditures","$a[expenditures]");
$smarty->assign("Cashbook_Description","$a[cashbook_description]");
$smarty->assign("Cash_In_Hand","$a[cash_in_hand]");
$smarty->assign("Starting_With","$a[starting_with]");
$smarty->assign("NoteMsg","$a[note]");
$smarty->assign("NewEntry","$a[new_entry]");

// Database connection
//
DBConnect();

$smarty->assign("Currency","$CompanyCurrency");

$query = $db->GetRow("SELECT MAX(CASHBOOKID) AS MAX_CASHBOOKID FROM {$TBLName}cashbook");
if (!$query)
	print($db->ErrorMsg());
else
	$CashbookID = $query['MAX_CASHBOOKID'];

	$smarty->assign("CashbookID",$CashbookID);

// Calculate cash in hand starting with
//
$query1 = $db->Execute("SELECT SUM(CASH_IN_HAND_STARTING_WITH) AS CASH_IN_HAND_STARTING_WITH FROM {$TBLName}cashbook WHERE CANCELED=2");

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $result1)
	{
		$Cash_In_Hand_Starting_With = $result1['CASH_IN_HAND_STARTING_WITH'];
	}
	$smarty->assign("CASH_IN_HAND_STARTING_WITH",$Cash_In_Hand_Starting_With);

$smarty->display('cashbook/new.tpl');

unset($_SESSION['NewID']);

?>
