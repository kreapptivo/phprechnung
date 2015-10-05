<?php
/*
	cashbookf.php

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

$query = $db->Execute("SELECT * FROM kasse ORDER BY KASSEID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$cashbookID = $query->fields['KASSEID'];
		$CashbookDate = $query->fields['DATUM'];
		$Takings = $query->fields['EINNAHMEN'];
		$Expenditures = $query->fields['AUSGABEN'];
		$StartingWith = $query->fields['BESTAND'];
		$Description = $query->fields['BESCHREIBUNG'];
		$myID = $query->fields['MYID'];
		$invoiceID = $query->fields['RECHNUNGID'];
		$paymentID = $query->fields['ZAHLUNGID'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		$Description = ereg_replace("'", "\'", $Description);

		// Get last CASH_IN_HAND value from cashbook
		//
		$query1 = $db->GetRow("SELECT CASHBOOKID, CASH_IN_HAND FROM {$TBLName}cashbook ORDER BY CASHBOOKID DESC LIMIT 1");

		$Cash_In_Hand = $query1['CASH_IN_HAND'];

		$Cash_In_Hand_Day = $Cash_In_Hand + $StartingWith + ( $Takings - $Expenditures );
		$Cash_In_Hand_Day = ereg_replace(",", ".", $Cash_In_Hand_Day);

		$query2 = "INSERT INTO {$TBLName}cashbook (CASHBOOKID, MYID, INVOICEID, PAYMENTID, DESCRIPTION, CASHBOOK_DATE, TAKINGS, EXPENDITURES, CASH_IN_HAND, CASH_IN_HAND_STARTING_WITH, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES($cashbookID, '$myID', '$invoiceID', '$paymentID', '$Description', '$CashbookDate', '$Takings', '$Expenditures', '$Cash_In_Hand_Day', '$StartingWith', '2', '$CreatedBy', '$ModifiedBy', '1', '2', '$CurrentDateTime','$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		Header("Location: $web/updatetable/paymentf.php?$sessname=$sessid");
	}

?>
