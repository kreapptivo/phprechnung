<?php

/*
	poslist.php

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

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!isset($PosPage) || !is_numeric($PosPage) || $PosPage <= 0 )
{
	$PosPage = 1;
}

if(!isset($PosSort) || $PosSort !== 'ASC' && $PosSort !== 'DESC')
{
	$PosSort = "";
}

if(empty($PosOrder) || $PosOrder !== 'POS_NAME' && $PosOrder !== 'POS_DESC' && $PosOrder !== 'POS_GROUP' && $PosOrder !== 'POS_PRICE')
{
	$PosOrder = "POS_GROUP ASC,POS_DESC ASC";
	$PosSort = "";
}

if(isset($infoID) && $infoID == "9")
{
	$Searchstring = "InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

$smarty->assign("Title","$a[position] - $a[searchresult]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionGroup","$a[pos_group]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionChoose","$a[pos_choose]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Currency","$CompanyCurrency");

$intCursor = ($PosPage - 1) * $EntrysPerPage;

// Display active, inactive or all positions
// Default is to display only active positions
//
	$query = $db->Execute("SELECT POSITIONID, POS_NAME, POS_DESC, POS_PRICE, POS_GROUP, POS_ACTIVE FROM {$TBLName}article WHERE POS_ACTIVE=1 AND (POS_NAME LIKE '%$PosID%' OR POS_DESC LIKE '%$PosID%') ORDER BY $PosOrder $PosSort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count only PageRows depend on active positions
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows depend on active positions and searchstring
	//
	$query1 = $db->Execute("SELECT POS_ACTIVE, POS_NAME, POS_DESC FROM {$TBLName}article WHERE POS_ACTIVE=1 AND (POS_NAME LIKE '%$PosID%' OR POS_DESC LIKE '%$PosID%')");

	$numrows = $query1->RecordCount();

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	// Save all entrys in $Position
	//
	foreach($query as $result)
	{
		$Position[] = $result;
	}

	if(isset($Position))
		$smarty->assign('Positions', $Position);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

// Display pager only if $numrows > $EntrysPerPage ( lines per page )
// from settings menu
//
if ($numrows > $EntrysPerPage)
{
	$smarty->assign('CurrentPage', "$PosPage");
	$smarty->assign('MaxPages', "$intPages");
	$smarty->assign('AddCurrentPage', "PosPage=$PosPage&amp;");

	// If we are not on first page then display
	// first page, previous page link
	//
	if ($PosPage > 1)
	{
		$PosPage = $PosPage - 1;
		$smarty->assign('PrevPage', "$PosPage");
	}

	// If we are not on the last page then display
	// next page, last page link
	//
	if ($PosPage < $intPages)
	{
		$PosPage = $PosPage + 1;
		$smarty->assign('NextPage', "$PosPage");
	}
}

$smarty->display('invoice/poslist.tpl');

unset($_SESSION['EditID']);
unset($_SESSION['DeleteID']);

?>
