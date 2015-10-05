<?php

/*
	print_pdf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

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

require_once('../include/phprechnung.inc.php');

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
}

if(!is_numeric($invoiceID) || $invoiceID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($InvoiceDate))
	$Date = $InvoiceDate;


// Database connection
//
DBConnect();

// Get Invoice Information
//
if(isset($tmpPos) && $tmpPos == '1')
{


	if(isset($MethodOfPayment))
	{
		$query = $db->GetRow("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");
		$METHOD_OF_PAY = $query['DESCRIPTION'];
	}

	if(isset($messageID))
	{
		$query1 = $db->GetRow("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");
		$MESSAGEID = $query1['DESCRIPTION'];
	}

	if(isset($MethodOfPaymentDate))
		$METHOD_OF_PAY_DATE = $MethodOfPaymentDate;

	if(isset($myID) && is_numeric($myID))
	{
		$query2 = $db->Execute("SELECT PREFIX, TITLE, FIRSTNAME, LASTNAME, ADDRESS, COMPANY, POSTALCODE, PRINT_NAME,
			CITY, COUNTRY, MYID FROM {$TBLName}addressbook WHERE MYID=$myID");
	}

	// If an error has occurred, display the error message
	//
	if (!$query2)
		print($db->ErrorMsg());
	else
		foreach($query2 as $f)
		{
			$Print_Company_Name = $f['PRINT_NAME'];
			$ID = $invoiceID;
			$CreatedBy = $_SESSION['Username'];
			$MYID = $f['MYID'];
			$TITLE = $f['TITLE'];
			$PREFIX = $f['PREFIX'];
			$FIRSTNAME = $f['FIRSTNAME'];
			$LASTNAME = $f['LASTNAME'];
			$COMPANY = $f['COMPANY'];
			$ADDRESS = $f['ADDRESS'];
			$CITY = $f['CITY'];
			$POSTALCODE = $f['POSTALCODE'];
			$COUNTRY = $f['COUNTRY'];
		}
}
else
{

	$query = $db->Execute("SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
		A.CITY, A.COUNTRY, A.METHODOFPAY, A.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.INVOICEID, I.PAID, I.SUM_PAID, I.TOTAL_AMOUNT, I.MYID,
		I.CREATEDBY, I.MESSAGE_DESC, I.METHOD_OF_PAY, DATE_FORMAT(I.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE, I.TAX1_TOTAL, I.TAX2_TOTAL, I.TAX3_TOTAL, I.TAX4_TOTAL, I.TAX1_DESC, I.TAX2_DESC, I.TAX3_DESC, I.TAX4_DESC, I.SUBTOTAL1, I.SUBTOTAL2, I.SUBTOTAL3, I.SUBTOTAL4
		FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=I.MYID AND I.INVOICEID=$invoiceID");

	// If an error has occurred, display the error message
	//
	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$Print_Company_Name = $f['PRINT_NAME'];
			$Date = $f['INVOICE_DATE'];
			$ID = $f['INVOICEID'];
			$CreatedBy = $f['CREATEDBY'];
			$MYID = $f['MYID'];
			$TITLE = $f['TITLE'];
			$PREFIX = $f['PREFIX'];
			$FIRSTNAME = $f['FIRSTNAME'];
			$LASTNAME = $f['LASTNAME'];
			$COMPANY = $f['COMPANY'];
			$ADDRESS = $f['ADDRESS'];
			$CITY = $f['CITY'];
			$POSTALCODE = $f['POSTALCODE'];
			$COUNTRY = $f['COUNTRY'];
			$PAID = $f['PAID'];
			$SUM_PAID = $f['SUM_PAID'];
			$METHOD_OF_PAY = $f['METHOD_OF_PAY'];
			$METHOD_OF_PAY_DATE = $f['METHOD_OF_PAY_DATE'];
			$TOTAL = $f['TOTAL_AMOUNT'];
			$MESSAGEID = $f['MESSAGE_DESC'];
		}
}

$PrintD = Print_Date($Date);

if(isset($Type) && $Type == 'Invoice')
{
	$Subject = "$a[invoice] - $a[invoice_number]: $a[invoice_initials]-$PrintD-$ID, $a[customer_no]: $MYID, $a[date_text]: $Date";
}
else
{
	$Subject = "$a[delivery_note] - $a[delivery_note_number]: $a[delivery_note_initials]-$PrintD-$ID, $a[customer_no]: $MYID, $a[date_text]: $Date";
}

if(isset($tmpPos) && $tmpPos == '1')
{
	$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, T.USERNAME, T.POSITIONID, T.POS_DESC, T.POS_QUANTITY, T.POS_PRICE, T.TAX, T.TAX_DIVIDE, T.TAX_MULTI, T.TAX_DESC, T.POS_GROUP, T.TMP_INVOICEID FROM {$TBLName}article AS P, {$TBLName}tmp_invoice AS T WHERE P.POSITIONID=T.POSITIONID AND T.USERNAME='$_SESSION[Username]' ORDER BY T.POS_GROUP ASC, T.TMP_INVOICEID ASC");
}
else
{
	$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.INVOICEPOSID,
	V.POS_QUANTITY, V.POS_PRICE, V.POS_GROUP, V.INVOICEID, V.TAX, V.TAX_DIVIDE, V.TAX_MULTI, V.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE P.POSITIONID=V.POSITIONID AND V.INVOICEID=$invoiceID ORDER BY V.POS_GROUP ASC, V.INVOICEPOSID ASC");
}

// Print text if invoice is paid
//
$paid = $db->Execute("SELECT METHOD_OF_PAY, INVOICEID, SUM_PAID, DATE_FORMAT(PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE
		FROM {$TBLName}payment WHERE CANCELED=2 AND INVOICEID=$invoiceID");

if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	require_once('../include/pdf.inc.php');
}

?>
