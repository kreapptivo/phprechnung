<?php
/*
	invoicef.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2008 Edy Corak < phprechnung at ecorak dot net >

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
require_once('../include/company_settings.inc.php');

CheckUser();
CheckAdmin();
CheckSession();

// Database connection
//
DBConnect();

$query = $db->Execute("SELECT * FROM rechnung");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$InvoiceDate = $query->fields['DATUM'];
		$myID = $query->fields['MYID'];
		$InvoiceAmount = $query->fields['RE_SUMME'];
		$Paid = $query->fields['BEZAHLT'];
		$messageID = $query->fields['MITTEILUNGTXT'];
		$invoiceID = $query->fields['RECHNUNGID'];
		$Sum_Paid = $query->fields['RE_OFFEN'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		if($Paid == "N")
		{
			$Paid = "2";
		}
		else if ($Paid == "J")
		{
			$Paid = "1";
			$Sum_Paid = $InvoiceAmount;
		}
		else
		{
			$Paid = "1";
			$Sum_Paid = $InvoiceAmount;
		}

		$query1 = $db->GetAll("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");

		foreach($query1 as $f1)
		{
			$Message_Desc = $f1['DESCRIPTION'];
		}

		$query2 = $db->GetAll("SELECT ZHLGWEISE FROM zahlung WHERE RECHNUNGID=$invoiceID");

		foreach($query2 as $f2)
		{
			$MethodOfPayment = $f2['ZHLGWEISE'];
		}

		$query3 = $db->GetAll("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

		foreach($query3 as $f3)
		{
			$MethodOfPayment_Desc = $f3['DESCRIPTION'];
		}

		$Message_Desc = ereg_replace("'", "\'", $Message_Desc);
		$MethodOfPayment_Desc = ereg_replace("'", "\'", $MethodOfPayment_Desc);

		$query5 = "INSERT INTO {$TBLName}invoice (INVOICEID, MYID, INVOICE_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE, PAID, SUM_PAID, DELIVERY_NOTE_PRINTED, DELIVERY_NOTE_MAILED, INVOICE_PRINTED, INVOICE_MAILED, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query5 .= "VALUES ($invoiceID, '$myID', '$InvoiceDate', '$messageID', '$Message_Desc', '$MethodOfPayment', '$MethodOfPayment_Desc', '$MethodOfPaymentDate', '$Tax1', '$Tax2', '$Tax3', '$Tax4', '$Tax1_Desc', '$Tax2_Desc', '$Tax3_Desc', '$Tax4_Desc', '$Subtotal1', '$Subtotal2', '$Subtotal3', '$Subtotal4', '$InvoiceAmount', '$Note', '$Paid', '$Sum_Paid', '2', '2', '2', '2', '2', '$CreatedBy', '$ModifiedBy', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query5) === false)
		{
			die($db->ErrorMsg());
		}
	
 		$query->MoveNext();

		Header("Location: $web/updatetable/offerposf.php?$sessname=$sessid");
	}

?>
