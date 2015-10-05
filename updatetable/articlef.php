<?php
/*
	articlef.php

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

$query = $db->Execute("SELECT * FROM position ORDER BY POSITIONID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$posID = $query->fields['POSITIONID'];
		$Pos_Active = $query->fields['POS_AKTIV'];
		$Pos_Name = $query->fields['POS_NAME'];
		$Pos_Desc = $query->fields['POS_TEXT'];
		$Pos_Price = $query->fields['POS_PREIS'];
		$Pos_Tax = $query->fields['POS_MWST'];
		$Note = $query->fields['NOTE'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		if($Pos_Active == '0')
		{
			$Pos_Active = '1';
		}
		else if ($Pos_Active == '1')
		{
			$Pos_Active = '2';
		}
		else
		{
			$Pos_Active = '1';
		}

		$Pos_Name = ereg_replace("'", "\'", $Pos_Name);
		$Pos_Desc = ereg_replace("'", "\'", $Pos_Desc);
		$Note = ereg_replace("'", "\'", $Note);

		$query2 = "INSERT INTO {$TBLName}article (POSITIONID, POS_ACTIVE, POS_NAME, POS_DESC, POS_PRICE, POS_TAX, POSGROUPID, POS_GROUP, NOTE, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES($posID, '$Pos_Active', '$Pos_Name', '$Pos_Desc', '$Pos_Price', '$Pos_Tax', '3', 'Hotel', '$Note', '$CreatedBy', '$ModifiedBy', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		Header("Location: $web/updatetable/addressbookf.php?$sessname=$sessid");
	}

?>
