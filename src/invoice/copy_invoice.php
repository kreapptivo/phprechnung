<?php

/*
	copy_invoice.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
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

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&amp;InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from selected language file
//
$smarty->assign("Title","$a[invoice] - $a[copy_invoice]");
$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("InvoiceInitials","$a[invoice_initials]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Copy_Invoice","$a[copy_invoice]");

// Database connection
//
DBConnect();

// Get Invoice Information
//
$query = $db->Execute("SELECT A.FIRSTNAME, A.LASTNAME, A.COMPANY, A.MYID, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE,
	I.CREATEDBY FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=I.MYID AND I.INVOICEID=$invoiceID");

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
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("INVOICEID",$InvoiceID);
		$smarty->assign("CREATED",$CreatedBy);
	}

$PrintD = Print_Date($InvoiceDate);
$smarty->assign("PrintDate",$PrintD.'-'.$InvoiceID);

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
	$smarty->display('invoice/copy_invoice.tpl');
}

?>
