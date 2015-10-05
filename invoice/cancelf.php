<?php

/*
	cancelf.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
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
	$Searchstring = "InvoiceID1=$InvoiceID1&CustomerID1=$CustomerID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
}

// Database connection
//
DBConnect();

// Check if there are any payment for this invoice
//
$query1 = $db->Execute("SELECT INVOICEID from {$TBLName}payment WHERE CANCELED=2 AND INVOICEID=$invoiceID");
$numrows1 = $query1->RowCount();

if (!$numrows1)
{
	// Cancel the selected invoice
	//
	$query2 = "UPDATE {$TBLName}invoice SET CANCELED=1 WHERE INVOICEID=$invoiceID";

	if ($db->Execute($query2) === false)
	{
		die($db->ErrorMsg());
	}

	$query3 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query3 .= "VALUES(NULL, '$CurrentDateTime', 'Invoice-No.: $invoiceID for Customer-No.: $myID was CANCELED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress.', 'admin', '1', '2')";
	if ($db->Execute($query3) === false)
	{
		die($db->ErrorMsg());
	}

	$_SESSION['CancelID'] = "1";

	if($infoID == '9')
		Header("Location: $web/invoice/searchlist.php?page=$page&invoiceID=$invoiceID&myID=$myID&$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$invoiceID");
	if(empty($infoID))
		Header("Location: $web/invoice/list.php?page=$page&invoiceID=$invoiceID&myID=$myID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$invoiceID");
}
else
{
	// Display message payment available
	//
	$smarty->assign("FieldError","$a[entry_not_deleted] <br />$a[payment_issued]");
	$smarty->display('invoice/cancelf.tpl');
}

?>
