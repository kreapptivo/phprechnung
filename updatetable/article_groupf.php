<?php
/*
	article_groupf.php

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

$query = $db->Execute("SELECT POSITIONID, POS_GROUP FROM article ORDER BY POSITIONID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$posID = $query->fields['POSITIONID'];
		$Pos_Group = $query->fields['POS_GROUP'];

		$Pos_Group = ereg_replace("'", "\'", $Pos_Group);


		$query1 = $db->Execute("UPDATE {$TBLName}invoicepos SET POS_GROUP='$Pos_Group' WHERE POSITIONID=$posID");

		$query->MoveNext();

		Header("Location: $web/updatetable/index.php?$sessname=$sessid");
	}

?>
