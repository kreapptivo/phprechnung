<?php

/*
	new.php

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

$smarty->assign("Title","$a[position] - $a[new]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionActive","$a[pos_active]");
$smarty->assign("PositionGroup","$a[pos_group]");
$smarty->assign("NoteMsg","$a[note]");
$smarty->assign("NewEntry","$a[new_entry]");

// Database connection
//
DBConnect();

$smarty->assign("Currency","$CompanyCurrency");

// Save options in $pos_active_values
//
$smarty->assign("pos_active_values",array($choice_yes_no));

// Select the tax
//
$query1 = $db->Execute("SELECT TAXID, TAX_DESC from {$TBLName}tax ORDER BY TAX_DESC");

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	// Save all entrys in $TaxArray
	//
	foreach ( $query1 as $f1 )
	{
		$TaxArray[] = $f1;
	}

	if(isset($TaxArray))
		$smarty->assign("TaxArray",$TaxArray);

// Select the position group
//
$query2 = $db->Execute("SELECT POSGROUPID, DESCRIPTION from {$TBLName}posgroup ORDER BY DESCRIPTION");

// If an error has occurred, display the error message
//
if (!$query2)
	print($db->ErrorMsg());
else
	// Save all entrys in $PosGroupArray
	//
	foreach ( $query2 as $f1 )
	{
		$PosGroupArray[] = $f1;
	}

	if(isset($PosGroupArray))
		$smarty->assign("PosGroupArray",$PosGroupArray);

$query3 = $db->GetRow("SELECT MAX(POSITIONID) AS MAX_POSITIONID FROM {$TBLName}article");
if (!$query3)
	print($db->ErrorMsg());
else
	$PositionID = $query3['MAX_POSITIONID'];

	$smarty->assign("PositionID",$PositionID);

$smarty->display('position/new.tpl');

unset($_SESSION['NewID']);

?>
