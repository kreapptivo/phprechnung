<?php

/*
	cancelf.php

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

if(!is_numeric($paymentID) || $paymentID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "CustomerNo_1=$CustomerNo_1&InvoiceNo_1=$InvoiceNo_1&PaymentNo_1=$PaymentNo_1&SumPaid_1=$SumPaid_1&DateFrom_1=$DateFrom_1&DateTill_1=$DateTill_1&MethodOfPay_1=$MethodOfPay_1";
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

// Calculate payment in cashbook
//
$query1 = $db->Execute("SELECT TAKINGS, EXPENDITURES, PAYMENTID FROM {$TBLName}cashbook WHERE CANCELED=2 AND PAYMENTID=$paymentID");

$PaymentTakings = 0;
$PaymentExpenditures = 0;

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $result1)
	{
		$PaymentTakings += $result1['TAKINGS'];
		$PaymentExpenditures += $result1['EXPENDITURES'];
	}
	$TotalPayment = $PaymentTakings-$PaymentExpenditures;

$query2 = $db->Execute("SELECT PAYMENTID, INVOICEID, SUM_PAID FROM {$TBLName}payment WHERE CANCELED=2 AND PAYMENTID=$paymentID");

// If an error has occurred, display the error message
//
if (!$query2)
	print($db->ErrorMsg());
else
	foreach($query2 as $f2)
	{
		$INVOICEID = $f2['INVOICEID'];
		$PAYMENTID = $f2['PAYMENTID'];
		$SUM_PAID = $f2['SUM_PAID'];
	}

if (($Cash_In_Hand - $TotalPayment) < 0 )
{
	$smarty->assign("FieldError","$a[entry_not_canceled] <br />$a[cashbook_expenditures]");
	$smarty->display('payment/cancelf.tpl');
}
else
{
	// Cancel the selected payment entry
	//
	$query4 = "UPDATE {$TBLName}payment SET CANCELED=1 WHERE PAYMENTID=$paymentID";

	if ($db->Execute($query4) === false)
	{
		die($db->ErrorMsg());
	}
	
	// Cancel the selected cashbook entry
	//
	$query5 = "UPDATE {$TBLName}cashbook SET CANCELED=1 WHERE PAYMENTID=$paymentID";

	if ($db->Execute($query5) === false)
	{
		die($db->ErrorMsg());
	}

	// Update SumPaid for the selected invoice
	//
	$query6 = $db->Execute("SELECT SUM_PAID FROM {$TBLName}invoice WHERE CANCELED=2 AND INVOICEID=$INVOICEID");
	
	// If an error has occurred, display the error message
	//
	if (!$query6)
		print($db->ErrorMsg());
	else
		foreach($query6 as $f6)
		{
			$TOTAL_SUM_PAID = $f6['SUM_PAID'];
		}

	$TotalSumPaid = number_format($TOTAL_SUM_PAID-$SUM_PAID, 2, '.', '');
	
	$query7 = "UPDATE {$TBLName}invoice SET PAID='2', SUM_PAID='$TotalSumPaid' WHERE INVOICEID=$INVOICEID";

	if ($db->Execute($query7) === false)
	{
		die($db->ErrorMsg());
	}

	$query8 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query8 .= "VALUES(NULL, '$CurrentDateTime', 'Payment-No.: $PAYMENTID for Invoice-No.: $INVOICEID was CANCELED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress.', 'admin', '1', '2')";
	if ($db->Execute($query8) === false)
	{
		die($db->ErrorMsg());
	}

	$_SESSION['CancelID'] = "1";

	if($infoID == '9')
		Header("Location: $web/payment/searchlist.php?page=$page&paymentID=$paymentID&$Searchstring&Order=$Order&Sort=$Sort&$sessname=$sessid");
	if(empty($infoID))
		Header("Location: $web/payment/list.php?page=$page&paymentID=$paymentID&Order=$Order&Sort=$Sort&$sessname=$sessid");
}

?>
