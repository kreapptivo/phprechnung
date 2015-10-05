<?php

/*
	newf.php

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
CheckAdminGroup1();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(isset($Pos_Price))
	$Pos_Price = FormatDBNumber($Pos_Price);

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($Pos_Name))
{
	$smarty->assign("FieldError","$a[pos_name] - $a[field_error]");
	UserInput("Pos_Name");
	$smarty->display('position/newf.tpl');
}
else if (empty($Pos_Desc))
{
	$smarty->assign("FieldError","$a[pos_text] - $a[field_error]");
	UserInput("Pos_Desc");
	$smarty->display('position/newf.tpl');
}
else if ($Pos_Price == "")
{
	$smarty->assign("FieldError","$a[pos_price] - $a[field_error]");
	UserInput("Pos_Price");
	$smarty->display('position/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	// Get the Pos_Group from posgroup table
	//
	$query = $db->Execute("SELECT POSGROUPID, DESCRIPTION FROM {$TBLName}posgroup WHERE POSGROUPID=$PosGroupID");

	// If an error has occurred, display the error message
	//
	if (!$query)
		print($db->ErrorMsg());
	else
		// Save position group in $Pos_Group
		//
		foreach ( $query as $f1 )
		{
			$Pos_Group = $f1['DESCRIPTION'];
		}

	$query1 = $db->Execute("SELECT POS_NAME FROM {$TBLName}article WHERE POS_NAME='$Pos_Name'");
	$numrows1 = $query1->RowCount();

	if ($numrows1)
	{
		$smarty->assign("FieldError","$a[entry_exist] - '$Pos_Name'");
		UserInput("Pos_Name");
		$smarty->display('position/newf.tpl');
	}
	else
	{
		$query2 = "INSERT INTO {$TBLName}article (POSITIONID, POS_ACTIVE, POS_NAME, POS_DESC, POS_PRICE, POS_TAX, POSGROUPID, POS_GROUP, NOTE, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES(NULL, '$Pos_Active', '$Pos_Name', '$Pos_Desc', '$Pos_Price', '$Pos_Tax', '$PosGroupID', '$Pos_Group', '$Note', '$_SESSION[Username]', '$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['NewID'] = "1";

		Header("Location: $web/position/new.php?$sessname=$sessid");
	}
}

?>
