<?php

/*
	cancel.php

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
	$Searchstring = "&amp;CustomerNo_1=$CustomerNo_1&InvoiceNo_1=$InvoiceNo_1&PaymentNo_1=$PaymentNo_1&SumPaid_1=$SumPaid_1&DateFrom_1=$DateFrom_1&DateTill_1=$DateTill_1&MethodOfPay_1=$MethodOfPay_1";
	$smarty->assign("Searchstring",$Searchstring);
}

$smarty->assign("Title","$a[payment] - $a[cancel]");
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

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Payment_Currency",$CompanyCurrency);

// Get entrys from payment table
//
$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, P.PAYMENTID, P.MYID, P.INVOICEID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHODOFPAYID,
		P.CARDNR, P.VALIDTHRU, P.SUM_PAID, P.NOTE, P.CANCELED, P.CREATEDBY, P.USERGROUP1, P.USERGROUP2, M.METHODOFPAYID, M.DESCRIPTION FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A,
		{$TBLName}methodofpay AS M WHERE A.MYID=P.MYID AND M.METHODOFPAYID=P.METHODOFPAYID AND P.PAYMENTID=$paymentID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("INVOICEID",$f['INVOICEID']);
		$smarty->assign("PAYMENTID",$f['PAYMENTID']);
		$smarty->assign("PAYMENT_DATE",$f['PAYMENT_DATE']);
		$smarty->assign("SUM_PAID",$f['SUM_PAID']);
		$smarty->assign("METHODOFPAY",$f['DESCRIPTION']);
		$smarty->assign("CARDNR",$f['CARDNR']);
		$smarty->assign("VALIDTHRU",$f['VALIDTHRU']);
		$smarty->assign("NOTE",$f['NOTE']);
		$smarty->assign("USERGROUP1",$f['USERGROUP1']);
		$smarty->assign("USERGROUP2",$f['USERGROUP2']);
		$smarty->assign("CANCELED",$f['CANCELED']);
	}

$smarty->display('payment/cancel.tpl');

?>
