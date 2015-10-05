<?php
/*
	offerf.php

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

$query = $db->Execute("SELECT * FROM angebot");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$OfferDate = $query->fields['DATUM'];
		$myID = $query->fields['MYID'];
		$invoiceID = $query->fields['RECHNUNGID'];
		$OfferAmount = $query->fields['ANGEBOT_SUMME'];
		$messageID = $query->fields['MITTEILUNGTXT'];
		$offerID = $query->fields['ANGEBOTID'];
		$OfferStatus = $query->fields['STATUS'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		if($OfferStatus == "0")
		{
			$OfferStatus = "1";
		}
		else if ($OfferStatus == "1")
		{
			$OfferStatus = "2";
		}
		else if ($OfferStatus == "2")
		{
			$OfferStatus = "3";
		}
		else
		{
			$OfferStatus = "1";
		}

		$query1 = $db->GetAll("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");

		foreach($query1 as $f1)
		{
			$Message_Desc = $f1['DESCRIPTION'];
		}

		$query2 = $db->GetAll("SELECT ZHLGB FROM address WHERE MYID=$myID");

		foreach($query2 as $f2)
		{
			$MethodOfPayment = $f2['ZHLGB'];
		}

		if($MethodOfPayment == "0")
		{
			$MethodOfPayment = "10";
		}
		else if ($MethodOfPayment == "1")
		{
			$MethodOfPayment = "11";
		}
		else if ($MethodOfPayment == "2")
		{
			$MethodOfPayment = "12";
		}
		else if ($MethodOfPayment == "3")
		{
			$MethodOfPayment = "8";
		}
		else
		{
			$MethodOfPayment = "12";
		}

		$query3 = $db->GetAll("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

		foreach($query3 as $f3)
		{
			$MethodOfPayment_Desc = $f3['DESCRIPTION'];
		}

		$Message_Desc = ereg_replace("'", "\'", $Message_Desc);
		$MethodOfPayment_Desc = ereg_replace("'", "\'", $MethodOfPayment_Desc);

		
		$query2 = "INSERT INTO {$TBLName}offer (OFFERID, MYID, INVOICEID, OFFER_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, STATUS, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE, ORDER_PRINTED, ORDER_MAILED, OFFER_PRINTED, OFFER_MAILED, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES ($offerID, '$myID', '$invoiceID', '$OfferDate', '$messageID', '$Message_Desc', '$MethodOfPayment', '$MethodOfPayment_Desc', '$MethodOfPaymentDate', '$OfferStatus', '$Tax1Total', '$Tax2Total', '$Tax3Total', '$Tax4Total', '$Tax1Desc', '$Tax2Desc', '$Tax3Desc', '$Tax4Desc', '$OfferSubtotal1', '$OfferSubtotal2', '$OfferSubtotal3', '$OfferSubtotal4', '$OfferAmount', '$Note', '2', '2', '2', '2', '2', '$CreatedBy','$ModifiedBy', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		$query4 = $db->Execute("UPDATE {$TBLName}updatetable SET TABLEUPDATE='1', CREATED='$CurrentDateTime' WHERE UPDATEID=1");

		Header("Location: $web/updatetable/index.php?$sessname=$sessid");
	}

?>
