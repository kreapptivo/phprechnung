<?php

/*
	editf.php

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

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "InvoiceID1=$InvoiceID1&CustomerID1=$CustomerID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
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

if (empty($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$smarty->assign("FieldError","$a[customer] - $a[field_error]");
	UserInput("Edit.Customer");
	$smarty->display('invoice/editf.tpl');
}
else if (empty($InvoiceDate) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("InvoiceD.InvoiceDate");
	$smarty->display('invoice/editf.tpl');
}
else if(!empty($MethodOfPaymentDate) && $MethodOfPaymentDate != 0 && !checkdate($month1, $day1, $year1))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("MethodOfPayD.MethodOfPaymentDate");
	$smarty->display('invoice/editf.tpl');
}
else if($MaxRows <= 0)
{
	$smarty->assign("FieldError","$a[pos_name] - $a[field_error]");
	UserInput("");
	$smarty->display('invoice/newf.tpl');
}
else if(!is_Superuser() && !is_Admin() && !is_Manager() && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
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

	$db->Execute("DELETE FROM {$TBLName}invoicepos WHERE INVOICEID=$invoiceID");

	$query2 = $db->Execute("SELECT TMP_INVOICEID, POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]' ORDER BY TMP_INVOICEID");

	if (!$query2)
		print($db->ErrorMsg());
	else
		foreach($query2 as $f)
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

			$query3 = "INSERT INTO {$TBLName}invoicepos (INVOICEPOSID, MYID, INVOICEID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)";
			$query3 .= "VALUES (NULL, '$myID', '$invoiceID', '$PosID', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Desc', '$Tax_Multi', '$Tax_Divide')";

			if ($db->Execute($query3) === false)
			{
				die($db->ErrorMsg());
			}

			$_SESSION['EditID'] = "1";
		}

	$db->Execute("DELETE FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]'");

	$query4 = "UPDATE {$TBLName}invoice SET MYID='$myID', INVOICE_DATE='$InvoiceDate', MESSAGEID='$messageID', MESSAGE_DESC='$Message_Desc', METHODOFPAYID='$MethodOfPayment', METHOD_OF_PAY='$MethodOfPayment_Desc', METHOD_OF_PAY_DATE='$MethodOfPaymentDate', TAX1_TOTAL='$Tax1Total', TAX2_TOTAL='$Tax2Total', TAX3_TOTAL='$Tax3Total', TAX4_TOTAL='$Tax4Total', TAX1_DESC='$Tax1Desc', TAX2_DESC='$Tax2Desc', TAX3_DESC='$Tax3Desc', TAX4_DESC='$Tax4Desc', SUBTOTAL1='$InvoiceSubtotal1', SUBTOTAL2='$InvoiceSubtotal2', SUBTOTAL3='$InvoiceSubtotal3', SUBTOTAL4='$InvoiceSubtotal4', TOTAL_AMOUNT='$InvoiceAmount', NOTE='$Note', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE INVOICEID=$invoiceID";

	if ($db->Execute($query4) === false)
	{
		die($db->ErrorMsg());
	}

	if($infoID == '9')
	{
		Header("Location: $web/invoice/searchlist.php?page=$page&myID=$myID&invoiceID=$invoiceID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$Searchstring&$sessname=$sessid#$invoiceID");
	}
	else
	{
		Header("Location: $web/invoice/list.php?page=$page&myID=$myID&invoiceID=$invoiceID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$invoiceID");
	}
}

?>
