<?php

/*
	print_pdf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2010 Edy Corak < edy at loenshotel dot de >

	phpRechnung benutzt die FPDF Bibliothek um PDF Dateien zu generieren.
	Copyright (C) Olivier PLATHEY, http://fpdf.org/ License: Freeware.

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

require_once('../../include/phprechnung.inc.php');

CheckUser();
CheckAdminGroup3();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

$DateFromF = German_Mysql_Date($DateFrom);
$DateTillF = German_Mysql_Date($DateTill);

// Database connection
//
DBConnect();

if(isset($Type) && $Type == 'Booking_Details')
{
	$Subject = "$a[reports] - $a[booking_details], $a[date_text]: $DateFrom $a[date_till] $DateTill";

	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
		WHERE P.CANCELED=1 AND A.MYID=P.MYID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
		WHERE A.MYID=P.MYID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
		WHERE P.CANCELED=2 AND A.MYID=P.MYID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
}
else if(isset($Type) && $Type == 'Customer_Booking_Details')
{
	$Subject = "$a[reports] - $a[booking_details], $a[date_text]: $DateFrom $a[date_till] $DateTill";

	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY,  P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
			WHERE P.CANCELED=1 AND A.MYID=$myID AND P.MYID=$myID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY,  P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
			WHERE A.MYID=$myID AND P.MYID=$myID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY,  P.CREATEDBY, P.PAYMENTID, P.INVOICEID, P.MYID, DATE_FORMAT(P.PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE, P.SUM_PAID, P.METHOD_OF_PAY, P.CANCELED FROM {$TBLName}payment AS P, {$TBLName}addressbook AS A
			WHERE P.CANCELED=2 AND A.MYID=$myID AND P.MYID=$myID AND P.PAYMENT_DATE >= '$DateFromF' AND P.PAYMENT_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
}
else if(isset($Type) && $Type == 'Cashbook')
{
	$Subject = "$a[reports] - $a[cashbook], $a[date_text]: $DateFrom $a[date_till] $DateTill";

	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CANCELED=1 AND CASHBOOK_DATE >= '$DateFromF' AND CASHBOOK_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if (isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CASHBOOK_DATE >= '$DateFromF' AND CASHBOOK_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT CASHBOOKID, MYID, DATE_FORMAT(CASHBOOK_DATE,'%d.%m.%Y') AS CASHBOOK_DDATE, CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASH_IN_HAND, DESCRIPTION, CANCELED FROM {$TBLName}cashbook
		WHERE CANCELED=2 AND CASHBOOK_DATE >= '$DateFromF' AND CASHBOOK_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}

	// Get min date from cashbook
	//
	$query2 = $db->GetRow("SELECT MIN(CASHBOOK_DATE) AS MIN_CASHBOOK_DATE FROM {$TBLName}cashbook");
	if (!$query2)
		print($db->ErrorMsg());
	else
		$Min_Cashbook_Date = $query2['MIN_CASHBOOK_DATE'];

	$posquery2 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2 AND CASHBOOK_DATE >= '$Min_Cashbook_Date' AND CASHBOOK_DATE < '$DateFromF'");
	$posquery3 = $db->Execute("SELECT CASH_IN_HAND_STARTING_WITH, TAKINGS, EXPENDITURES, CASHBOOK_DATE FROM {$TBLName}cashbook WHERE CANCELED=2 AND CASHBOOK_DATE >= '$Min_Cashbook_Date' AND CASHBOOK_DATE <= '$DateTillF'");

}
else if(isset($Type) && $Type == 'Customer_Invoices')
{
	$Subject = "$a[reports] - $a[customer_sales], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=1 AND A.MYID=$myID AND I.MYID=$myID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE A.MYID=$myID AND I.MYID=$myID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=2 AND A.MYID=$myID AND I.MYID=$myID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
}
else if(isset($Type) && $Type == 'Invoice_Ledger')
{
	$Subject = "$a[reports] - $a[customer_sales], $a[date_text]: $DateFrom $a[date_till] $DateTill";

	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=1 AND A.MYID=I.MYID
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE A.MYID=I.MYID
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=2 AND A.MYID=I.MYID
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
}
else if(isset($Type) && $Type == 'Invoice_Ledger_Summary')
{
	$Subject = "$a[reports] - $a[customer_sales] - $a[summary], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, SUM(I.TOTAL_AMOUNT) AS TOTAL_AMOUNT, I.PAID, SUM(I.SUM_PAID) AS SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE A.MYID=I.MYID AND I.CANCELED=2
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' GROUP BY I.MYID ORDER BY $Order $Sort");

	$TotalInvoiceSum = 0;
	$TotalSumPaid = 0;
	$TotalInvoiceOpenAmount = 0;

	foreach($posquery as $posresult)
	{
		$TotalInvoiceSum += $posresult['TOTAL_AMOUNT'];
		$TotalSumPaid += $posresult['SUM_PAID'];
		$TotalInvoiceOpenAmount = $TotalInvoiceSum-$TotalSumPaid;
	}
}
else if (isset($Type) && $Type == 'Customer_Outstanding_Accounts')
{
	$Subject = "$a[reports] - $a[open_invoice], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=2 AND I.PAID=2 AND A.MYID=$myID AND I.MYID=$myID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
}
else if (isset($Type) && $Type == 'User_Outstanding_Accounts')
{
	$Subject = "$a[reports] - $a[open_invoice], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=2 AND I.PAID=2 AND I.CREATEDBY='$_SESSION[Username]' AND A.MYID=I.MYID
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
}
else if (isset($Type) && $Type == 'Outstanding_Accounts')
{
	$Subject = "$a[reports] - $a[open_invoice], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE I.CANCELED=2 AND I.PAID=2 AND A.MYID=I.MYID
			AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
}
else if (isset($Type) && $Type == 'Outstanding_Offers')
{
	$Subject = "$a[reports] - $a[offer] - $offer_status[1], $a[date_text]: $DateFrom $a[date_till] $DateTill";

	if(isset($Canceled) && $Canceled == 1)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE O.CANCELED=1 AND A.MYID=O.MYID AND O.STATUS=1
			AND O.OFFER_DATE >= '$DateFromF' AND O.OFFER_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE A.MYID=O.MYID AND O.STATUS=1
			AND O.OFFER_DATE >= '$DateFromF' AND O.OFFER_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
	else
	{
		$posquery = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=1
			AND O.OFFER_DATE >= '$DateFromF' AND O.OFFER_DATE <= '$DateTillF' ORDER BY $Order $Sort");
	}
}
else if(isset($Type) && $Type == 'Position_Sales')
{
	$Subject = "$a[reports] - $a[position_sales], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT I.INVOICEID, I.CANCELED, I.INVOICE_DATE, P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.POS_QUANTITY, V.POS_PRICE, V.POS_GROUP, V.INVOICEID, V.INVOICEPOSID FROM {$TBLName}invoice AS I, {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE I.INVOICEID=V.INVOICEID AND I.CANCELED=2 AND P.POSITIONID=V.POSITIONID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' ORDER BY $Order $Sort");
}
else if(isset($Type) && $Type == 'Position_Sales_Summary')
{
	$Subject = "$a[reports] - $a[position_sales] - $a[summary], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$posquery = $db->Execute("SELECT I.INVOICEID, I.CANCELED, I.INVOICE_DATE, P.POSITIONID, P.POS_NAME, P.POS_DESC, V.POSITIONID, SUM(V.POS_QUANTITY) AS POS_QUANTITY, SUM(V.POS_QUANTITY*V.POS_PRICE) AS POS_AMOUNT, V.POS_GROUP, V.INVOICEID, V.INVOICEPOSID FROM {$TBLName}invoice AS I, {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE I.INVOICEID=V.INVOICEID AND I.CANCELED=2 AND P.POSITIONID=V.POSITIONID AND I.INVOICE_DATE >= '$DateFromF' AND I.INVOICE_DATE <= '$DateTillF' GROUP BY V.POSITIONID ORDER BY $Order $Sort");

	$TotalPosAmount = 0;

	foreach($posquery as $posresult)
	{
		$TotalPosAmount += $posresult['POS_AMOUNT'];
	}
}
else if(isset($Type) && $Type == 'Tax_Report')
{
	$Subject = "$a[reports] - $a[tax_report], $a[date_text]: $DateFrom $a[date_till] $DateTill";
	$sql="SELECT YEAR( PAYMENT_DATE ) AS YEAR, QUARTER( PAYMENT_DATE ) AS QUARTER, MONTH( PAYMENT_DATE ) AS MONTH , 
	sum( TAX1_TOTAL ) AS TAX1_TOTAL, SUM( SUBTOTAL1 ) AS SUBTOTAL1, 
	sum( TAX2_TOTAL ) AS TAX2_TOTAL, SUM( SUBTOTAL2 ) AS SUBTOTAL2, 
	sum( TAX3_TOTAL ) AS TAX3_TOTAL, SUM( SUBTOTAL3 ) AS SUBTOTAL3, 
	sum( TAX4_TOTAL ) AS TAX4_TOTAL, SUM( SUBTOTAL4 ) AS SUBTOTAL4, 
	sum( TOTAL_AMOUNT ) AS TOTAL_AMOUNT, sum( Z.SUM_PAID ) AS SUM_PAID
	FROM invoice AS I
	JOIN payment AS Z
	USING ( INVOICEID )
	WHERE I.CANCELED =2
	AND I.INVOICE_DATE >= '".$DateFromF."'
	AND I.INVOICE_DATE <= '".$DateTillF."'
	GROUP BY YEAR( PAYMENT_DATE ) ASC , QUARTER( PAYMENT_DATE ) ASC , MONTH( PAYMENT_DATE ) ASC
	WITH ROLLUP";
	$posquery = $db->Execute($sql);

}


require_once('pdf.inc.php');

?>
