<?php
/*
	paymentf.php

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

CheckUser();
CheckAdmin();
CheckSession();

// Database connection
//
DBConnect();

$query = $db->Execute("SELECT MYID, DATUM, ZHLGWEISE, RECHNUNGID,
		ZHLG_SUMME, ZAHLUNGID, ERSTELLT, DECODE(KARTENNR,'$pkey') AS KARTENNR, DECODE(GUELTIG_BIS,'$pkey') AS GUELTIG_BIS
		FROM zahlung ORDER BY ZAHLUNGID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$myID = $query->fields['MYID'];
		$PaymentDate = $query->fields['DATUM'];
		$MethodOfPayment = $query->fields['ZHLGWEISE'];
		$invoiceID = $query->fields['RECHNUNGID'];
		$Sum_Paid = $query->fields['ZHLG_SUMME'];
		$Card_Number = $query->fields['KARTENNR'];
		$Valid_Thru = $query->fields['GUELTIG_BIS'];
		$paymentID = $query->fields['ZAHLUNGID'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		$query1 = $db->GetAll("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

		if (!$query1)
			print($db->ErrorMsg());
		else
			foreach($query1 as $f1)
			{
				$MethodOfPayment_Desc = $f1['DESCRIPTION'];
			}

		// Insert new payment
		//
		$query2 = "INSERT INTO {$TBLName}payment (PAYMENTID, MYID, INVOICEID, PAYMENT_DATE, METHODOFPAYID, METHOD_OF_PAY, CARDNR, VALIDTHRU, SUM_PAID, NOTE, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES ($paymentID, '$myID', '$invoiceID', '$PaymentDate', '$MethodOfPayment', '$MethodOfPayment_Desc', '$Card_Number', '$Valid_Thru', '$Sum_Paid', '$Note', '2', '$CreatedBy', '$ModifiedBy', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		Header("Location: $web/updatetable/invoiceposf.php?$sessname=$sessid");
	}

?>
