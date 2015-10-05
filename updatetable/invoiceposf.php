<?php
/*
	invoiceposf.php

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

$query = $db->Execute("SELECT P.POSITIONID, P.POS_MWST, V.MYID, V.RECHNUNGID, V.POSITIONID, V.POS_TEXT,
			V.POS_MENGE, V.POS_PREIS, V.VERKAUFID, M.MWSTID, M.MWST_DIVID, M.MWST_MULTI, M.MWST_TEXT, R.RECHNUNGID, R.DATUM FROM verkauf AS V, position AS P, mwst AS M, rechnung AS R
			WHERE P.POS_MWST=M.MWSTID AND P.POSITIONID=V.POSITIONID AND V.RECHNUNGID=R.RECHNUNGID ORDER BY V.VERKAUFID ASC");


if (!$query)
	print($db->ErrorMsg());
else
 	while (!$query->EOF)
	{
		$posID = $query->fields['POSITIONID'];
		$myID = $query->fields['MYID'];
		$invoiceID = $query->fields['RECHNUNGID'];
		$InvoiceDate = $query->fields['DATUM'];
		$Pos_Desc = $query->fields['POS_TEXT'];
		$Pos_Quantity = $query->fields['POS_MENGE'];
		$Pos_Price = $query->fields['POS_PREIS'];
		$invoicePosID = $query->fields['VERKAUFID'];
		$Tax = $query->fields['MWSTID'];
		$Tax_Desc = $query->fields['MWST_TEXT'];
		$Tax_Multi = $query->fields['MWST_MULTI'];
		$Tax_Divide = $query->fields['MWST_DIVID'];
		
		if($Tax == "1" && $InvoiceDate < "2007-01-01")
		{
			$Tax_Multi = "0.16000";
			$Tax_Divide = "1.16000";
			$Tax_Desc = "16.00 %";
		}

		$Pos_Desc = ereg_replace("'", "\'", $Pos_Desc);
		$Tax_Desc = ereg_replace("'", "\'", $Tax_Desc);

		$Pos_Group = "Hotel";

		$query6 = "INSERT INTO {$TBLName}invoicepos (INVOICEPOSID, MYID, INVOICEID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)";
		$query6 .= "VALUES ($invoicePosID, '$myID', '$invoiceID', '$posID', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Desc', '$Tax_Multi', '$Tax_Divide')";

		if ($db->Execute($query6) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		Header("Location: $web/updatetable/invoicef.php?$sessname=$sessid");
	}

?>
