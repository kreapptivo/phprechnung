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
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

if(!isset($offerID) || !is_numeric($offerID) || $offerID <= 0 )
{
	$offerID = "";
}

if(isset($InvoiceAmount))
{
	$InvoiceAmount = FormatDBNumber($InvoiceAmount);
}
if(isset($Tax1Total))
{
	$Tax1Total = FormatDBNumber($Tax1Total);
}
if(isset($Tax2Total))
{
	$Tax2Total = FormatDBNumber($Tax2Total);
}
if(isset($Tax3Total))
{
	$Tax3Total = FormatDBNumber($Tax3Total);
}
if(isset($Tax4Total))
{
	$Tax4Total = FormatDBNumber($Tax4Total);
}
if(isset($InvoiceSubtotal1))
{
	$InvoiceSubtotal1 = FormatDBNumber($InvoiceSubtotal1);
}
if(isset($InvoiceSubtotal2))
{
	$InvoiceSubtotal2 = FormatDBNumber($InvoiceSubtotal2);
}
if(isset($InvoiceSubtotal3))
{
	$InvoiceSubtotal3 = FormatDBNumber($InvoiceSubtotal3);
}
if(isset($InvoiceSubtotal4))
{
	$InvoiceSubtotal4 = FormatDBNumber($InvoiceSubtotal4);
}

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if(!empty($InvoiceDate))
	list($day, $month, $year) = explode(".", $InvoiceDate);
if(!empty($MethodOfPaymentDate))
	list($day1, $month1, $year1) = explode(".", $MethodOfPaymentDate);

if (empty($myID))
{
	$smarty->assign("FieldError","$a[customer] - $a[field_error]");
	UserInput("New.Customer");
	$smarty->display('invoice/newf.tpl');
}
else if (empty($InvoiceDate) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("InvoiceD.InvoiceDate");
	$smarty->display('invoice/newf.tpl');
}
else if(!empty($MethodOfPaymentDate) && !checkdate($month1, $day1, $year1))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("MethodOfPayD.MethodOfPaymentDate");
	$smarty->display('invoice/newf.tpl');
}
else if($MaxRows <= 0)
{
	$smarty->assign("FieldError","$a[pos_name] - $a[field_error]");
	UserInput("");
	$smarty->display('invoice/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	$InvoiceDate = German_Mysql_Date($InvoiceDate);
	$MethodOfPaymentDate = German_Mysql_Date($MethodOfPaymentDate);

	$query = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");

	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$Message_Desc = $f['DESCRIPTION'];
		}

	$query1 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

	if (!$query1)
		print($db->ErrorMsg());
	else
		foreach($query1 as $f1)
		{
			$MethodOfPayment_Desc = $f1['DESCRIPTION'];
		}

	$query2 = "INSERT INTO {$TBLName}invoice (INVOICEID, MYID, INVOICE_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE, PAID, SUM_PAID, DELIVERY_NOTE_PRINTED, DELIVERY_NOTE_MAILED, INVOICE_PRINTED, INVOICE_MAILED, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
	$query2 .= "VALUES (NULL, '$myID', '$InvoiceDate', '$messageID', '$Message_Desc', '$MethodOfPayment', '$MethodOfPayment_Desc', '$MethodOfPaymentDate', '$Tax1Total', '$Tax2Total', '$Tax3Total', '$Tax4Total', '$Tax1Desc', '$Tax2Desc', '$Tax3Desc', '$Tax4Desc', '$InvoiceSubtotal1', '$InvoiceSubtotal2', '$InvoiceSubtotal3', '$InvoiceSubtotal4', '$InvoiceAmount', '$Note', '2', '', '2', '2', '2', '2', '2', '$_SESSION[Username]', '$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";

	if ($db->Execute($query2) === false)
	{
		die($db->ErrorMsg());
	}

	// Get the last entry from 'rechnung'
	//
	$query3 = $db->GetRow("SELECT MAX(INVOICEID) AS MAX_INVOICEID FROM {$TBLName}invoice");
	if (!$query3)
		print($db->ErrorMsg());
	else
		$maxInvoiceID = $query3['MAX_INVOICEID'];

	$query4 = $db->Execute("SELECT POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]' ORDER BY TMP_INVOICEID");

	if (!$query4)
		print($db->ErrorMsg());
	else
		foreach($query4 as $f4)
		{
			$PosID = $f4['POSITIONID'];
			$Pos_Desc = $f4['POS_DESC'];
			$Pos_Quantity = $f4['POS_QUANTITY'];
			$Pos_Price = $f4['POS_PRICE'];
			$Pos_Group = $f4['POS_GROUP'];
			$Tax = $f4['TAX'];
			$Tax_Multi = $f4['TAX_MULTI'];
			$Tax_Divide = $f4['TAX_DIVIDE'];
			$Tax_Desc = $f4['TAX_DESC'];

			$query5 = "INSERT INTO {$TBLName}invoicepos (INVOICEPOSID, MYID, INVOICEID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)";
			$query5 .= "VALUES (NULL, '$myID', '$maxInvoiceID', '$PosID', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Desc', '$Tax_Multi', '$Tax_Divide')";

			if ($db->Execute($query5) === false)
			{
				die($db->ErrorMsg());
			}

			$_SESSION['NewID'] = "1";
		}

		if(!empty($newofferID))
		{
			$query6 = "UPDATE {$TBLName}offer SET STATUS='3', INVOICEID='$maxInvoiceID', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE OFFERID=$newofferID";
			if ($db->Execute($query6) === false)
			{
				die($db->ErrorMsg());
			}
		}

$db->Execute("DELETE FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]'");
Header("Location: $web/invoice/new.php?invoiceID=$maxInvoiceID&$sessname=$sessid");
}

?>
