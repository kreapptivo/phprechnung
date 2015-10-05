<?php
/*
	messagef.php

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

$query = $db->Execute("SELECT * FROM mitteilung ORDER BY MITTEILUNGID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$messageID = $query->fields['MITTEILUNGID'];
		$Description = $query->fields['MITTEILUNG_TXT'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		$Description = ereg_replace("'", "\'", $Description);

		$query2 = "INSERT INTO {$TBLName}message (MESSAGEID, DESCRIPTION, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES($messageID, '$Description','$CreatedBy','$ModifiedBy', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query->MoveNext();

		Header("Location: $web/updatetable/articlef.php?$sessname=$sessid");
	}

?>
