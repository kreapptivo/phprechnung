<?php

/*
	deletef.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
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

if(!is_numeric($posID) || $posID <= 0 )
{
	die(header("Location: $web"));
}
else
{
	// Database connection
	//
	DBConnect();

	// Check if this position in used in invoices or offers
	//
	$query1 = $db->Execute("SELECT POSITIONID FROM {$TBLName}invoicepos WHERE POSITIONID=$posID");
	$query2 = $db->Execute("SELECT POSITIONID FROM {$TBLName}offerpos WHERE POSITIONID=$posID");
	$numrows1 = $query1->RowCount();
	$numrows2 = $query2->RowCount();

	if ($numrows1 || $numrows2)
	{
		$smarty->assign("FieldError","$a[position] - $a[entry_not_deleted] - $a[number] $posID - $a[position_used]");
		$smarty->display('position/deletef.tpl');
	}
	else
	{
		$query4 = "DELETE FROM {$TBLName}article WHERE POSITIONID=$posID";

		if ($db->Execute($query4) === false)
		{
			die($db->ErrorMsg());
		}

		$query5 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query5 .= "VALUES(NULL, '$CurrentDateTime', 'Position-No.: $posID was DELETED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress', 'admin', '1', '2')";
		if ($db->Execute($query5) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['DeleteID'] = "1";

		if($infoID == '9')
			Header("Location: $web/position/searchlist.php?posID=$posID&page=$page&Order=$Order&Sort=$Sort&Pos_Active1=$Pos_Active1&Pos_Name1=$Pos_Name1&Pos_Desc1=$Pos_Desc1&Pos_Price1=$Pos_Price1&$sessname=$sessid#$posID");
		else
			Header("Location: $web/position/list.php?posID=$posID&page=$page&Order=$Order&Sort=$Sort&Pos_Active1=$Pos_Active1&$sessname=$sessid#$posID");
	}
}

?>
