<?php

/*
	list.php

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

if(!isset($page) || !is_numeric($page) || $page <= 0 )
{
	$page = 1;
}

if(!isset($Sort) || $Sort !== 'ASC' && $Sort !== 'DESC')
{
	$Sort = "";
}

if(empty($Order) || $Order !== 'POS_NAME' && $Order !== 'POS_DESC' && $Order !== 'POS_GROUP' && $Order !== 'POS_PRICE')
{
	$Order = "POS_GROUP ASC,POS_DESC ASC";
	$Sort = "";
}

$smarty->assign("Title","$a[position] - $a[list]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionGroup","$a[pos_group]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionActive","$a[pos_active]");
$smarty->assign("PositionInactive","$a[pos_inactive]");
$smarty->assign("ShowAllPositions","$a[pos_all]");
$smarty->assign("EntryChanged","$a[entry_changed]");
$smarty->assign("EntryDeleted","$a[entry_deleted]");

// Database connection
//
DBConnect();

$intCursor = ($page - 1) * $EntrysPerPage;

// Display active, inactive or all positions
// Default is to display only active positions
//
if(isset($Pos_Active1) && $Pos_Active1 == '1')
{
	$query = $db->Execute("SELECT POSITIONID, POS_NAME, POS_DESC, POS_GROUP, POS_PRICE, POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

	$query1 = $db->Execute("SELECT POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='1'");
}
else if(isset($Pos_Active1) && $Pos_Active1 == '2')
{
	$query = $db->Execute("SELECT POSITIONID, POS_NAME, POS_DESC, POS_GROUP,  POS_PRICE, POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='2' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

	$query1 = $db->Execute("SELECT POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='2'");
}
else if(isset($Pos_Active1) && $Pos_Active1 == '3')
{
	$query = $db->Execute("SELECT POSITIONID, POS_NAME, POS_DESC, POS_GROUP,  POS_PRICE, POS_ACTIVE FROM {$TBLName}article ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

	$query1 = $db->Execute("SELECT POSITIONID FROM {$TBLName}article");
}
else
{
	$query = $db->Execute("SELECT POSITIONID, POS_NAME, POS_DESC, POS_GROUP,  POS_PRICE, POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

	$query1 = $db->Execute("SELECT POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE='1'");
}

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count only PageRows depend on active positions
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows depend on active positions
	//
	$numrows = $query1->RecordCount();

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	// Save all entrys in $Position array
	//
	foreach($query as $result)
	{
		$Position[] = $result;
	}

	if(isset($Position))
		$smarty->assign('Positions', $Position);
	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");
	$smarty->assign("Currency","$CompanyCurrency");

// Display pager only if $numrows > $EntrysPerPage ( lines per page )
// from settings menu
//
if ($numrows > $EntrysPerPage)
{
	$smarty->assign('CurrentPage', "$page");
	$smarty->assign('MaxPages', "$intPages");
	$smarty->assign('AddCurrentPage', "page=$page&amp;");

	// If we are not on first page then display
	// first page, previous page link
	//
	if ($page > 1)
	{
		$Page = $page - 1;
		$smarty->assign('PrevPage', "$Page");
	}

	// If we are not on the last page then display
	// next page, last page link
	//
	if ($page < $intPages)
	{
		$Page = $page + 1;
		$smarty->assign('NextPage', "$Page");
	}
}

$smarty->display('position/list.tpl');

unset($_SESSION['EditID']);
unset($_SESSION['DeleteID']);

?>
