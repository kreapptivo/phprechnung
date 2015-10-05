<?php

/*
	edit.php

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

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&amp;InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[invoice] - $a[edit]");
$smarty->assign("Print","$a[print]");
$smarty->assign("Print_Invoice","$a[print_invoice]");

$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("Find_Customer","$a[find_customer]");
$smarty->assign("Choose_Customer","$a[choose_customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Date_Till","$a[date_till]");

$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("InvoiceInitials","$a[invoice_initials]");
$smarty->assign("CustomerNoInitials","$a[customer_no_initials]");
$smarty->assign("Invoice_Amount","$a[invoice_amount]");

$smarty->assign("Invoice_Tax1","$a[invoice_tax1]");
$smarty->assign("Invoice_Tax2","$a[invoice_tax2]");
$smarty->assign("Invoice_Tax3","$a[invoice_tax3]");
$smarty->assign("Invoice_Subtotal","$a[invoice_subtotal]");
$smarty->assign("PositionNew","$a[pos_new]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionQuantity","$a[pos_quantity]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionAmount","$a[pos_amount]");
$smarty->assign("Invoice_Note","$a[invoice] - $a[note]");
$smarty->assign("Change_Invoice","$a[change_invoice]");
$smarty->assign("Change","$a[change]");
$smarty->assign("Choose_Message","$a[choose_message]");
$smarty->assign("Choose","$a[choose]");
$smarty->assign("ChangeEntry","$a[entry_changed]");
$smarty->assign("Entry_Canceled","$a[entry_canceled]");

// Database connection
//
DBConnect();

if(!isset($tmpID))
{
	$db->Execute("DELETE FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]'");

	$query = $db->Execute("SELECT INVOICEPOSID, MYID, INVOICEID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE FROM {$TBLName}invoicepos WHERE INVOICEID=$invoiceID ORDER BY POS_GROUP ASC, INVOICEPOSID ASC");

	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$PosID = $f['POSITIONID'];
			$Pos_Desc = $f['POS_DESC'];
			$Pos_Quantity = $f['POS_QUANTITY'];
			$Pos_Price = $f['POS_PRICE'];
			$Pos_Group = $f['POS_GROUP'];
			$Tax = $f['TAX'];
			$Tax_Multi = $f['TAX_MULTI'];
			$Tax_Divide = $f['TAX_DIVIDE'];
			$Tax_Desc = $f['TAX_DESC'];

			$query1 = "INSERT INTO {$TBLName}tmp_invoice (TMP_INVOICEID, MYID, INVOICEID, POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC)";
			$query1 .= "VALUES (NULL, '$myID', '$invoiceID', '$PosID', '$_SESSION[Username]', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Multi', '$Tax_Divide', '$Tax_Desc')";

			if ($db->Execute($query1) === false)
			{
				die($db->ErrorMsg());
			}
		}
}

$query1 = $db->Execute("SELECT MYID, INVOICEID FROM {$TBLName}invoice WHERE INVOICEID=$invoiceID");

if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $f)
	{
		if(empty($myID))
		{
			$myID = $f['MYID'];
		}
		else
		{
			$myID = $myID;
		}
	}

// Get company data from company_settings.inc.php
//
$smarty->assign("Invoice_Currency",$CompanyCurrency);
$smarty->assign("Country",$CompanyCountry);
$smarty->assign("TaxFree",$TaxFree);

// Get Invoice Information
//
$query2 = $db->Execute("SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME, A.CITY, A.COUNTRY,
	A.METHODOFPAY, A.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.INVOICEID, I.TOTAL_AMOUNT, I.MYID, I.CANCELED,
	I.CREATEDBY, I.PAID, I.MESSAGEID, I.METHODOFPAYID, I.METHOD_OF_PAY, DATE_FORMAT(I.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE,
	I.TAX1_TOTAL, I.TAX2_TOTAL, I.TAX3_TOTAL, I.TAX4_TOTAL, I.TAX1_DESC, I.TAX2_DESC, I.TAX3_DESC, I.TAX4_DESC, I.SUBTOTAL1, I.SUBTOTAL2, I.SUBTOTAL3, I.SUBTOTAL4, I.NOTE
	FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=$myID AND I.INVOICEID=$invoiceID");

// If an error has occurred, display the error message
//
if (!$query2)
	print($db->ErrorMsg());
else
	foreach($query2 as $f)
	{
		if(empty($InvoiceDate))
		{
			$InvoiceDate = $f['INVOICE_DATE'];
			$smarty->assign("INVOICE_DATE",$f['INVOICE_DATE']);
		}
		else
		{
			$InvoiceDate = $InvoiceDate;
			$smarty->assign("INVOICE_DATE",$InvoiceDate);
		}
		$CreatedBy = $f['CREATEDBY'];
		if(empty($myID))
		{
			$smarty->assign("MYID",$f['MYID']);
		}
		else
		{
			$smarty->assign("MYID",$myID);
		}
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
		$smarty->assign("PAID",$f['PAID']);
		$smarty->assign("CANCELED",$f['CANCELED']);
		if(empty($MethodOfPayment))
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$f['METHODOFPAYID']);
		}
		else
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$MethodOfPayment);
		}
		if(empty($MethodOfPaymentDate))
		{
			$smarty->assign("METHOD_OF_PAYMENT_DATE",$f['METHOD_OF_PAY_DATE']);
		}
		else
		{
			$smarty->assign("METHOD_OF_PAYMENT_DATE",$MethodOfPaymentDate);
		}
		if(!isset($messageID))
		{
			$smarty->assign("MESSAGEID",$f['MESSAGEID']);
		}
		else
		{
			$smarty->assign("MESSAGEID",$messageID);
		}
		if(empty($Note))
		{
			$smarty->assign("NOTE",$f['NOTE']);
		}
		else
		{
			$smarty->assign("NOTE",$Note);
		}
	}
$PrintD = Print_Date($InvoiceDate);
$smarty->assign("PrintDate",$PrintD.'-'.$invoiceID);
$smarty->assign("CurrentInvoiceID","$invoiceID");
$smarty->assign("CreatedBy","$CreatedBy");

$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, T.USERNAME, T.POSITIONID, T.POS_DESC, T.POS_QUANTITY, T.POS_PRICE, T.INVOICEID, T.TMP_INVOICEID, T.TAX, T.TAX_DIVIDE, T.TAX_MULTI, T.TAX_DESC, T.POS_GROUP FROM {$TBLName}article AS P, {$TBLName}tmp_invoice AS T WHERE P.POSITIONID=T.POSITIONID AND T.INVOICEID=$invoiceID ORDER BY T.POS_GROUP ASC, T.TMP_INVOICEID ASC");
$numrows = $posquery->RecordCount();

// Calculate positions
//
require_once('../include/pos.inc.php');

// Get the first entry from table 'invoice'
//
$query4 = $db->GetRow("SELECT MIN(INVOICEID) AS MIN_INVOICEID FROM {$TBLName}invoice");
if (!$query4)
	print($db->ErrorMsg());
else
	$minInvoiceID = $query4['MIN_INVOICEID'];
	$smarty->assign("MinInvoiceID","$minInvoiceID");

// Get the last entry from table 'invoice'
//
$query5 = $db->GetRow("SELECT MAX(INVOICEID) AS MAX_INVOICEID FROM {$TBLName}invoice");
if (!$query5)
	print($db->ErrorMsg());
else
	$maxInvoiceID = $query5['MAX_INVOICEID'];

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

// Get the method of payment from database
//
$query6 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

// Get the message from database
//
$query7 = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if (!$query6 && !$query7)
	print $db->ErrorMsg();
else
	foreach($query6 as $result6)
	{
		$PaymentData[] = $result6;
	}

	if(isset($PaymentData))
		$smarty->assign("PaymentData",$PaymentData);

	foreach($query7 as $result7)
	{
		$MessageData[] = $result7;
	}

	if(isset($MessageData))
		$smarty->assign("MessageData",$MessageData);

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
		$smarty->display('invoice/edit.tpl');
	}

?>
