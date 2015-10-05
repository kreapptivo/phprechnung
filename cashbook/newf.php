<?php

/*
	newf.php

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
CheckAdminGroup1();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(isset($startingwith))
{
	$startingwith = FormatDBNumber($startingwith);
}
if(isset($takings))
	$takings = FormatDBNumber($takings);
if(isset($expenditures))
	$expenditures = FormatDBNumber($expenditures);

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

if(isset($startingwith))
{
	$Cash_In_Hand = $StartingWith + $Cash_In_Hand_Starting_With + ( $TotalTakings - $TotalExpenditures );
}
else
{
	$Cash_In_Hand = $Cash_In_Hand_Starting_With + ( $TotalTakings - $TotalExpenditures );
}

// Get min date from cashbook
//
$query2 = $db->GetRow("SELECT MIN(CASHBOOK_DATE) AS MIN_CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2");
if (!$query2)
	print($db->ErrorMsg());
else
	$Min_Cashbook_Date = $query2['MIN_CASHBOOK_DATE'];

// Calculate total takings / expenditures depend on $Min_Cashbook_Date and $CashbookDate
//
$CashbookDate_Till = German_Mysql_Date($cashbookdate);

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

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if(!empty($cashbookdate))
	list($day, $month, $year) = explode(".", $cashbookdate);

if (empty($cashbookdate) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("cashbookdate");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($startingwith) && $startingwith <= 0)
{
	$smarty->assign("FieldError","$a[starting_with] - $a[field_error]");
	UserInput("startingwith");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($takings) && $takings === "" && (isset($expenditures) && $expenditures === ""))
{
	$smarty->assign("FieldError","$a[takings] / $a[expenditures] - $a[field_error]");
	UserInput("takings");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($takings) && $takings === "0.00" && (isset($expenditures) && $expenditures === "0.00"))
{
	$smarty->assign("FieldError","$a[takings] / $a[expenditures] - $a[field_error]");
	UserInput("takings");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($takings) && $takings > 0 && (isset($expenditures) && $expenditures > 0))
{
	$smarty->assign("FieldError","$a[takings_expenditures_error] - $a[field_error]");
	UserInput("takings");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($takings) && $takings < 0)
{
	$smarty->assign("FieldError","$a[takings] - $a[field_error]");
	UserInput("takings");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($expenditures) && $expenditures < 0)
{
	$smarty->assign("FieldError","$a[expenditures] - $a[field_error]");
	UserInput("expenditures");
	$smarty->display('cashbook/newf.tpl');
}
else if (empty($description))
{
	$smarty->assign("FieldError","$a[cashbook_description] - $a[field_error]");
	UserInput("description");
	$smarty->display('cashbook/newf.tpl');
}
else if (isset($startingwith) && ($startingwith + $Cash_In_Hand - $expenditures) < 0)
{
	$smarty->assign("FieldError","$a[cashbook_expenditures]");
	UserInput("expenditures");
	$smarty->display('cashbook/newf.tpl');
}
// This is to prevent to spend more money you have if you enter date in the past
//
else if (($Cash_In_Hand_Till - $expenditures) < 0)
{
	$smarty->assign("FieldError","$a[cashbook_expenditures]");
	UserInput("expenditures");
	$smarty->display('cashbook/newf.tpl');
}
else
{
	$Cash_In_Hand_Day = $Cash_In_Hand + ( $takings - $expenditures );
	$Cash_In_Hand_Day = FormatDBNumber($Cash_In_Hand_Day);

	$cashbookdate = German_Mysql_Date($cashbookdate);

	$query4 = "INSERT INTO {$TBLName}cashbook (CASHBOOKID, MYID, INVOICEID, PAYMENTID, DESCRIPTION, CASHBOOK_DATE, TAKINGS, EXPENDITURES, CASH_IN_HAND, CASH_IN_HAND_STARTING_WITH, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
	$query4 .= "VALUES(NULL, '', '', '', '$description', '$cashbookdate', '$takings', '$expenditures', '$Cash_In_Hand_Day', '$startingwith', '2', '$_SESSION[Username]', '$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime','$CurrentDateTime')";

	if ($db->Execute($query4) === false)
	{
		die($db->ErrorMsg());
	}

	$_SESSION['NewID'] = "1";

	Header("Location: $web/cashbook/new.php?page=$page&infoID=$infoID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid");
}

?>
