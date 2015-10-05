<?php

/*
	editf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

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
CheckAdminGroup2();
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

if(isset($Pos_Price))
	$Pos_Price = FormatDBNumber($Pos_Price);

// Database connection
//
DBConnect();

// Get the Pos_Group from posgroup table
//
$query1 = $db->Execute("SELECT POSGROUPID, DESCRIPTION FROM {$TBLName}posgroup WHERE POSGROUPID=$PosGroupID");

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	// Save position group in $Pos_Group
	//
	foreach ( $query1 as $f1 )
	{
		$Pos_Group = $f1['DESCRIPTION'];
	}

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($Pos_Name))
{
	$smarty->assign("FieldError","$a[pos_name] - $a[field_error]");
	UserInput("Pos_Name");
	$smarty->display('position/editf.tpl');
}
else if (empty($Pos_Desc))
{
	$smarty->assign("FieldError","$a[pos_text] - $a[field_error]");
	UserInput("Pos_Desc");
	$smarty->display('position/editf.tpl');
}
else if ($Pos_Price == "")
{
	$smarty->assign("FieldError","$a[pos_price] - $a[field_error]");
	UserInput("Pos_Preis");
	$smarty->display('position/editf.tpl');
}
else
{
	$query2 = $db->Execute("SELECT POSITIONID, POS_NAME FROM {$TBLName}article WHERE POS_NAME='$Pos_Name' AND POSITIONID != $posID");
	$numrows2 = $query2->RowCount();

	if ($numrows2)
	{
		$smarty->assign("FieldError","$a[entry_exist] - '$Pos_Name'");
		UserInput("Pos_Name");
		$smarty->display('position/editf.tpl');
	}
	else
	{
		$query3 = "UPDATE {$TBLName}article SET POS_ACTIVE='$Pos_Active', POS_NAME='$Pos_Name', POS_DESC='$Pos_Desc', POS_PRICE='$Pos_Price', POS_TAX='$Pos_Tax', POSGROUPID='$PosGroupID', POS_GROUP='$Pos_Group', NOTE='$Note', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE POSITIONID=$posID";

		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['EditID'] = "1";

		if($infoID == '9')
		{
			Header("Location: $web/position/searchlist.php?posID=$posID&page=$page&Pos_Name1=$Pos_Name1&Pos_Desc1=$Pos_Desc1&Pos_Price1=$Pos_Price1&Order=$Order&Sort=$Sort&Pos_Active1=$Pos_Active1&$sessname=$sessid#$posID");
		}
		else
		{
			Header("Location: $web/position/list.php?posID=$posID&page=$page&Order=$Order&Sort=$Sort&Pos_Active1=$Pos_Active1&$sessname=$sessid#$posID");
		}
	}
}

?>
