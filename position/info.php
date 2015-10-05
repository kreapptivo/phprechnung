<?php

/*
	info.php

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
CheckSession();
UserSite();

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

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "Pos_Name1=$Pos_Name1&amp;Pos_Desc1=$Pos_Desc1&amp;Pos_Price1=$Pos_Price1&amp;Pos_Active1=$Pos_Active1";
	$smarty->assign("Searchstring","$Searchstring");
}

$smarty->assign("Title","$a[position] - $a[info]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionActive","$a[pos_active]");
$smarty->assign("PositionGroup","$a[pos_group]");
$smarty->assign("NoteMsg","$a[note]");
$smarty->assign("CloseWindow","$a[close_window]");

// Database connection
//
DBConnect();

// Get the currency from settings table
//
$smarty->assign("Currency",$CompanyCurrency);

// Get entrys from position table
//
$query = $db->Execute("SELECT P.POSITIONID, P.POS_ACTIVE, P.POS_NAME, P.POS_DESC, P.POS_PRICE, P.POS_TAX, P.POS_GROUP, P.NOTE, T.TAXID, T.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}tax AS T WHERE P.POS_TAX=T.TAXID AND POSITIONID=$posID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$pa = $f['POS_ACTIVE'];
		$smarty->assign("PosActive","$choice_yes_no[$pa]");
		$smarty->assign("Pos_Name",$f['POS_NAME']);
		$smarty->assign("Pos_Desc",$f['POS_DESC']);
		$smarty->assign("Pos_Price",$f['POS_PRICE']);
		$smarty->assign("Pos_Group",$f['POS_GROUP']);
		$smarty->assign("Pos_Tax",$f['TAX_DESC']);
		$smarty->assign("Note",$f['NOTE']);
	}

$smarty->assign("CurrentPosID","$posID");

// Get the first entry from table 'position'
//
$query3 = $db->GetRow("SELECT MIN(POSITIONID) AS MIN_POSITIONID FROM {$TBLName}article");
if (!$query3)
	die($db->ErrorMsg());
else
	$minPosID = $query3['MIN_POSITIONID'];
	$smarty->assign("MinPosID","$minPosID");

// Get the last entry from table 'position'
//
$query4 = $db->GetRow("SELECT MAX(POSITIONID) AS MAX_POSITIONID FROM {$TBLName}article");
if (!$query4)
	die($db->ErrorMsg());
else
	$maxPosID = $query4['MAX_POSITIONID'];

	$smarty->assign("MaxPosID","$maxPosID");

// If we are not on first page then display
// first page, previous page link
//
if ($posID > $minPosID)
{
	$CurrentPosID = $posID - 1;
	$smarty->assign('PrevPosID', "$CurrentPosID");
}

// If we are not on the last page then display
// next page, last page link
//
if ($posID < $maxPosID)
{
	$CurrentPosID = $posID + 1;
	$smarty->assign('NextPosID', "$CurrentPosID");
}

$smarty->display('position/info.tpl');

?>
