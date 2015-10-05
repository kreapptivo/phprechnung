<?php

/*
	info.php

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

if(!is_numeric($invoiceID) || $invoiceID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == "9")
{
	$Searchstring = "&amp;InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[invoice] - $a[info]");
$smarty->assign("Print","$a[print]");
$smarty->assign("Print_Invoice","$a[print_invoice]");
$smarty->assign("Print_Delivery_Note","$a[print_delivery_note]");
$smarty->assign("Copy_Invoice","$a[copy_invoice]");
$smarty->assign("Email_Invoice","$a[email_invoice]");
$smarty->assign("Email_Delivery_Note","$a[email_delivery_note]");
$smarty->assign("Delivery_Note","$a[delivery_note]");
$smarty->assign("InvoiceInitials","$a[invoice_initials]");
$smarty->assign("CustomerNoInitials","$a[customer_no_initials]");

$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Date_Till","$a[date_till]");

$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("Invoice_Amount","$a[invoice_amount]");

$smarty->assign("Invoice_Tax1","$a[invoice_tax1]");
$smarty->assign("Invoice_Tax2","$a[invoice_tax2]");
$smarty->assign("Invoice_Tax3","$a[invoice_tax3]");
$smarty->assign("Invoice_Subtotal","$a[invoice_subtotal]");
$smarty->assign("Transaction","$a[transaction]");
$smarty->assign("Invoice_Transaction","$a[invoice_transaction]");
$smarty->assign("Open_Account","$a[open_account]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionQuantity","$a[pos_quantity]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionAmount","$a[pos_amount]");
$smarty->assign("Invoice_Note","$a[note]");
$smarty->assign("PaymentSum","$a[payment_sum]");
$smarty->assign("Entry_Canceled","$a[entry_canceled]");
$smarty->assign("CloseWindow","$a[close_window]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Invoice_Currency",$CompanyCurrency);
$smarty->assign("Country",$CompanyCountry);
$smarty->assign("TaxFree",$TaxFree);

// Get Invoice Information
//
$query = $db->Execute("SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
	A.CITY, A.COUNTRY, A.METHODOFPAY, A.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.INVOICEID, I.TOTAL_AMOUNT, I.MYID,
	I.CREATEDBY, I.PAID, I.SUM_PAID, I.NOTE, I.MESSAGE_DESC, I.METHOD_OF_PAY, DATE_FORMAT(I.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE,
	I.TAX1_TOTAL, I.TAX2_TOTAL, I.TAX3_TOTAL, I.TAX4_TOTAL, I.TAX1_DESC, I.TAX2_DESC, I.TAX3_DESC, I.TAX4_DESC, I.SUBTOTAL1, I.SUBTOTAL2, I.SUBTOTAL3, I.SUBTOTAL4, I.CANCELED
	FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=I.MYID AND I.INVOICEID=$invoiceID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$InvoiceDate = $f['INVOICE_DATE'];
		$InvoiceID = $f['INVOICEID'];
		$CreatedBy = $f['CREATEDBY'];
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("TITLE",$f['TITLE']);
		$smarty->assign("PREFIX",$f['PREFIX']);
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("ADDRESS",$f['ADDRESS']);
		$smarty->assign("CITY",$f['CITY']);
		$smarty->assign("POSTALCODE",$f['POSTALCODE']);
		$smarty->assign("COUNTRY",$f['COUNTRY']);
		$smarty->assign("PRINT_NAME",$f['PRINT_NAME']);
		$smarty->assign("METHOD_OF_PAY",$f['METHOD_OF_PAY']);
		$smarty->assign("METHOD_OF_PAY_DATE",$f['METHOD_OF_PAY_DATE']);
		$smarty->assign("TOTAL_AMOUNT",$f['TOTAL_AMOUNT']);
		$smarty->assign("NOTE",$f['NOTE']);
		$smarty->assign("PAID",$f['PAID']);
		$smarty->assign("SUM_PAID",$f['SUM_PAID']);
		$smarty->assign("OPEN_ACCOUNT",$f['TOTAL_AMOUNT'] - $f['SUM_PAID']);
		$smarty->assign("MESSAGEID",$f['MESSAGE_DESC']);
		$smarty->assign("CANCELED",$f['CANCELED']);
	}
$PrintD = Print_Date($InvoiceDate);
$smarty->assign("PrintDate",$PrintD.'-'.$InvoiceID);
$smarty->assign("INVOICE_DATE",$InvoiceDate);

$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.POS_QUANTITY, V.POS_PRICE, V.POS_GROUP, V.INVOICEID, V.INVOICEPOSID, V.TAX, V.TAX_DIVIDE, V.TAX_MULTI, V.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE P.POSITIONID=V.POSITIONID AND V.INVOICEID=$invoiceID ORDER BY V.POS_GROUP ASC, V.INVOICEPOSID ASC");
$numrows = $posquery->RecordCount();

// Calculate positions
//
require_once('../include/pos.inc.php');

// Print text if invoice is paid
//
$paid = $db->Execute("SELECT METHOD_OF_PAY, INVOICEID, SUM_PAID, DATE_FORMAT(PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE
		FROM {$TBLName}payment WHERE CANCELED=2 AND INVOICEID=$invoiceID");

// Save all entrys in $PaymentData array
//
foreach($paid as $paidresult)
{
	$PaymentData[] = $paidresult;
}

if(isset($PaymentData))
	$smarty->assign('PaymentData', $PaymentData);

$smarty->assign("MaxRows","$numrows");
$smarty->assign("CurrentInvoiceID","$invoiceID");

// Get the first entry from table 'invoice'
//
$query3 = $db->GetRow("SELECT MIN(INVOICEID) AS MIN_INVOICEID FROM {$TBLName}invoice");
if (!$query3)
	die($db->ErrorMsg());
else
	$minInvoiceID = $query3['MIN_INVOICEID'];
	$smarty->assign("MinInvoiceID","$minInvoiceID");

// Get the last entry from table 'invoice'
//
$query4 = $db->GetRow("SELECT MAX(INVOICEID) AS MAX_INVOICEID FROM {$TBLName}invoice");
if (!$query4)
	die($db->ErrorMsg());
else
	$maxInvoiceID = $query4['MAX_INVOICEID'];

	$smarty->assign("MaxInvoiceID","$maxInvoiceID");

// If we are not on first page then display
// first page, previous page link
//
if ($invoiceID > $minInvoiceID)
{
	$CurrentInvoiceID = $invoiceID - 1;
	$smarty->assign('PrevInvoiceID', "$CurrentInvoiceID");
}

// If we are not on the last page then display
// next page, last page link
//
if ($invoiceID < $maxInvoiceID)
{
	$CurrentInvoiceID = $invoiceID + 1;
	$smarty->assign('NextInvoiceID', "$CurrentInvoiceID");
}

if(!is_Superuser() && !is_Admin() && !is_Manager() && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	// Save last page visited by user
	//
	UserSite();
	$smarty->display('invoice/info.tpl');
}

?>
