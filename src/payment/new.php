<?php

/*
	new.php

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

if(!isset($invoiceID) || !is_numeric($invoiceID) || $invoiceID <= 0 )
{
	$invoiceID = "";
}

if(empty($PaymentDate))
	$PaymentDate = date('d.m.Y');
if(isset($Card_Number))
	$smarty->assign("CARD_NUMBER","$Card_Number");
if(isset($Valid_Thru))
	$smarty->assign("VALID_THRU","$Valid_Thru");
if(isset($Note))
	$smarty->assign("NOTE","$Note");
if(isset($Sum_Paid))
	$Sum_Paid = FormatDBNumber($Sum_Paid);

$smarty->assign("Title","$a[payment] - $a[new]");
$smarty->assign("Payment_No","$a[payment_number]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Choose_Customer","$a[choose_customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Choose","$a[choose]");
$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("Invoice_Amount","$a[invoice_amount]");
$smarty->assign("Open_Invoice","$a[open_invoice]");
$smarty->assign("Card_Number","$a[card_number]");
$smarty->assign("Valid_Thru","$a[valid_thru]");
$smarty->assign("Outstanding_Payment","$a[outstanding_payment]");
$smarty->assign("NoteMsg","$a[note]");
$smarty->assign("NewEntry","$a[new_entry]");
$smarty->assign("CloseWindow","$a[close_window]");

if(isset($PaymentDate))
	$smarty->assign("PAYMENT_DATE",$PaymentDate);

// Database connection
//
DBConnect();

$smarty->assign("Currency","$CompanyCurrency");

// Get the customer with open invoices
//
$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.MYID, I.INVOICEID, I.PAID, I.TOTAL_AMOUNT, I.SUM_PAID, I.METHODOFPAYID FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED='2' AND I.PAID='2' AND A.MYID=I.MYID ORDER BY I.INVOICEID, A.LASTNAME, A.FIRSTNAME, A.COMPANY");

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $result1)
	{
		$OpenInvoiceData[] = $result1;
	}

	if(isset($OpenInvoiceData))
		$smarty->assign("OpenInvoiceData",$OpenInvoiceData);

// Get invoice data
//
if(!empty($invoiceID))
{
	$query2 = $db->Execute("SELECT MYID, INVOICEID, PAID, TOTAL_AMOUNT, SUM_PAID, METHODOFPAYID FROM {$TBLName}invoice WHERE INVOICEID='$invoiceID' AND CANCELED='2' AND PAID='2'");

// If an error has occurred, display the error message
//
if (!$query2)
	print($db->ErrorMsg());
else
	foreach($query2 as $result2)
	{
		$Total_Amount = $result2['TOTAL_AMOUNT'];
		$SSum_Paid = $result2['SUM_PAID'];
		$smarty->assign("TOTAL_SUM_PAID",$SSum_Paid);
		$smarty->assign("OPEN_INVOICE_SUM",$Total_Amount-$SSum_Paid);
		$smarty->assign("MYID",$result2['MYID']);
		$smarty->assign("INVOICEID",$result2['INVOICEID']);

		$smarty->assign("TOTAL_AMOUNT",$Total_Amount);
		if(empty($Sum_Paid))
		{
			$smarty->assign("SUM_PAID",$Total_Amount-$SSum_Paid);
		}
		else
		{
			$smarty->assign("SUM_PAID",$Sum_Paid);
		}
		if(empty($MethodOfPayment))
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$result2['METHODOFPAYID']);
		}
		else
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$MethodOfPayment);
		}

	}
}

// Get the last payment entry
//
$query3 = $db->GetRow("SELECT MAX(PAYMENTID) AS MAX_PAYMENTID FROM {$TBLName}payment");
if (!$query3)
	print($db->ErrorMsg());
else
	$PaymentID = $query3['MAX_PAYMENTID'];

	$smarty->assign("PaymentID",$PaymentID);

// Get the method of payment from database
//
$query4 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if (!$query4)
	print($db->ErrorMsg());
else
	foreach($query4 as $result4)
	{
		$PaymentData[] = $result4;
	}

	if(isset($PaymentData))
		$smarty->assign("PaymentData",$PaymentData);

$smarty->display('payment/new.tpl');

unset($_SESSION['NewID']);

?>
