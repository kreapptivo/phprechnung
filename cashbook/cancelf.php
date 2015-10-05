<?php

/*
	cancelf.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
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

if(!is_numeric($cashbookID) || $cashbookID <= 0 )
{
	die(header("Location: $web"));
}

$CCash_In_Hand_Starting_With = ereg_replace(",", ".", $_REQUEST['CCash_In_Hand_Starting_With']);

if(isset($infoID) && $infoID == "9")
{
	$Searchstring = "&CashbookNo_1=$CashbookNo_1&DateFrom_1=$DateFrom_1&DateTill_1=$DateTill_1&Takings_1=$Takings_1&Expenditures_1=$Expenditures_1&Description_1=$Description_1";
}

// Database connection
//
DBConnect();

// Calculate cash in hand
//
$query = $db->Execute("SELECT TAKINGS, EXPENDITURES, CASH_IN_HAND_STARTING_WITH FROM {$TBLName}cashbook WHERE CANCELED=2");

$TotalTakings = 0;
$TotalExpenditures = 0;
$Cash_In_Hand_Starting_With = 0;

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $result)
	{
		$TotalTakings += $result['TAKINGS'];
		$TotalExpenditures += $result['EXPENDITURES'];
		$Cash_In_Hand_Starting_With += $result['CASH_IN_HAND_STARTING_WITH'];
	}
	$Cash_In_Hand = $Cash_In_Hand_Starting_With + ( $TotalTakings - $TotalExpenditures );

// Get min date from cashbook
//
$query2 = $db->GetRow("SELECT MIN(CASHBOOK_DATE) AS MIN_CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2");
if (!$query2)
	print($db->ErrorMsg());
else
	$Min_Cashbook_Date = $query2['MIN_CASHBOOK_DATE'];

// Calculate total takings / expenditures depend on $Min_Cashbook_Date and $CashbookDate
//
$CashbookDate_Till = German_Mysql_Date($CashbookDate);

$query3 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2 AND TO_DAYS(CASHBOOK_DATE) BETWEEN TO_DAYS('$Min_Cashbook_Date') AND TO_DAYS('$CashbookDate_Till')");

$Cash_In_Hand_Starting_With_Till = 0;
$TotalExpenditures_Till = 0;
$TotalTakings_Till = 0;

// If an error has occurred, display the error message
//
if (!$query3)
	print($db->ErrorMsg());
else
	foreach($query3 as $result3)
	{
		$Cash_In_Hand_Starting_With_Till += $result3['CASH_IN_HAND_STARTING_WITH'];
		$TotalExpenditures_Till += $result3['EXPENDITURES'];
		$TotalTakings_Till += $result3['TAKINGS'];
	}

	$Cash_In_Hand_Till = $Cash_In_Hand_Starting_With_Till + ( $TotalTakings_Till-$TotalExpenditures_Till );


if (($Cash_In_Hand - $Takings ) < 0 )
{
	$smarty->assign("FieldError","$a[entry_not_canceled] <br />$a[cashbook_expenditures]");
	$smarty->display('cashbook/cancelf.tpl');
}
// This is to prevent to spend more money you have if you enter date in the past
//
else if (($Cash_In_Hand_Till - $Takings) < 0)
{
	$smarty->assign("FieldError","$a[entry_not_canceled] <br />$a[cashbook_expenditures]");
	$smarty->display('cashbook/cancelf.tpl');
}
else
{
	// Check if there are any payment for this cashbook entry
	//
	$query1 = $db->Execute("SELECT PAYMENTID from {$TBLName}payment WHERE CANCELED=2 AND PAYMENTID=$paymentID");
	$numrows1 = $query1->RowCount();
	if (!$numrows1)
	{
		// Cancel the selected cashbook entry
		//
		$query2 = "UPDATE {$TBLName}cashbook SET CANCELED=1 WHERE CASHBOOKID=$cashbookID";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query3 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query3 .= "VALUES(NULL, '$CurrentDateTime', 'Cashbook-No.: $cashbookID was CANCELED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress.', 'admin', '1', '2')";
		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['CancelID'] = "1";

		if($infoID == '9')
			Header("Location: $web/cashbook/searchlist.php?page=$page&cashbookID=$cashbookID$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid");
		if(empty($infoID))
			Header("Location: $web/cashbook/list.php?page=$page&cashbookID=$cashbookID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid");
	}
	else
	{
		// Display message payment available
		//
		$smarty->assign("FieldError","$a[entry_not_canceled] <br />$a[payment_issued]");
		$smarty->display('cashbook/cancelf.tpl');
	}
}

?>
