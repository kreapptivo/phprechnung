<?php

/*
	position_sales.php

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
CheckAdminGroup3();
CheckSession();

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
	$smarty->assign("Sort","$Sort");
}

if(empty($Order) || $Order !== 'V.POSITIONID' && $Order !== 'POS_DESC' && $Order !== 'POS_QUANTITY' && $Order !== 'POS_PRICE' && $Order !== 'V.POS_QUANTITY*V.POS_PRICE')
{
	$Order = "V.POS_QUANTITY*V.POS_PRICE DESC";
	$Sort = "";
	$smarty->assign("Order","$Order");
	$smarty->assign("Sort","$Sort");
}

$smarty->assign("Title","$a[reports] - $a[position_sales]");
$smarty->assign("SearchResult","$a[position_sales]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionQuantity","$a[pos_quantity]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionAmount","$a[pos_amount]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");

// Database connection
//
DBConnect();

// Get lines per page and currency from settings table
//
$smarty->assign("Currency","$CompanyCurrency");

$intCursor = ($page - 1) * $EntrysPerPage;

$DateFrom = German_Mysql_Date($DateFrom);
$DateTill = German_Mysql_Date($DateTill);

$query = $db->Execute("SELECT I.INVOICEID, I.CANCELED, I.INVOICE_DATE, P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.POS_QUANTITY, V.POS_PRICE, V.POS_GROUP, V.INVOICEID, V.INVOICEPOSID FROM {$TBLName}invoice AS I, {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE I.INVOICEID=V.INVOICEID AND I.CANCELED=2 AND P.POSITIONID=V.POSITIONID AND I.INVOICE_DATE >= '$DateFrom' AND I.INVOICE_DATE <= '$DateTill' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count PageRows
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows depend on searchstring
	//
	$query1 = $db->Execute("SELECT I.INVOICEID, I.CANCELED, I.INVOICE_DATE, P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.POS_QUANTITY, V.POS_PRICE, V.POS_GROUP, V.INVOICEID, V.INVOICEPOSID FROM {$TBLName}invoice AS I, {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE I.INVOICEID=V.INVOICEID AND I.CANCELED=2 AND P.POSITIONID=V.POSITIONID AND I.INVOICE_DATE >= '$DateFrom' AND I.INVOICE_DATE <= '$DateTill'");
	$numrows = $query1->RecordCount();

	$TotalAmount = 0;

	foreach($query1 as $result1)
	{
		$TotalAmount += $result1['POS_QUANTITY']*$result1['POS_PRICE'];
		$smarty->assign("TOTAL_AMOUNT",$TotalAmount);
	}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$TotalPage = 0;

	foreach($query as $result)
	{
		$Positions[] = $result;
		$TotalPage += $result['POS_QUANTITY']*$result['POS_PRICE'];
		$smarty->assign("TOTAL_PAGE",$TotalPage);
	}

	if(isset($Positions))
	 	$smarty->assign('Positions', $Positions);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

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

$smarty->display('reports/position_sales.tpl');

?>
