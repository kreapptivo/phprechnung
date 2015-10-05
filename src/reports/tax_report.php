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

$smarty->assign("Title","$a[reports] - $a[tax_report]");
$smarty->assign("SearchResult","$a[tax_report]");

$smarty->assign("TaxYear","$a[year]");
$smarty->assign("TaxQuarter","$a[quarter]");
$smarty->assign("TaxMonth","$a[month]");
$smarty->assign("TaxClass1","Umsatzsteuer 19%");
$smarty->assign("TaxClass2","Umsatzsteuer 7%");
$smarty->assign("TaxSubtotal1","Nettosumme 19%");
$smarty->assign("TaxSubtotal2","Nettosumme 7%");
$smarty->assign("TaxTotal","$a[invoice_amount]");
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("TaxPageAmount","$a[amount]");

// Database connection
//
DBConnect();

// Get lines per page and currency from settings table
//
$smarty->assign("Currency","$CompanyCurrency");

$intCursor = ($page - 1) * $EntrysPerPage;

$DateFrom = German_Mysql_Date($DateFrom);
$DateTill = German_Mysql_Date($DateTill);

$sql="SELECT YEAR(PAYMENT_DATE) as YEAR, QUARTER(PAYMENT_DATE) as QUARTER, MONTH(PAYMENT_DATE) as MONTH,
 sum(TAX1_TOTAL) as TAX1_TOTAL, TAX1_DESC, SUM(SUBTOTAL1) as SUBTOTAL1,
 sum(TAX2_TOTAL) as TAX2_TOTAL, TAX2_DESC, SUM(SUBTOTAL2) as SUBTOTAL2,
 sum(TAX3_TOTAL) as TAX3_TOTAL, TAX3_DESC, SUM(SUBTOTAL3) as SUBTOTAL3,
 sum(TAX4_TOTAL) as TAX4_TOTAL, TAX4_DESC, SUM(SUBTOTAL4) as SUBTOTAL4,
 sum(TOTAL_AMOUNT) as TOTAL_AMOUNT, sum(Z.SUM_PAID) as SUM_PAID
FROM invoice AS I join payment as Z using (INVOICEID)
WHERE 
I.CANCELED=2 AND
I.INVOICE_DATE >= '".$DateFrom."' AND I.INVOICE_DATE <= '".$DateTill."'
GROUP BY YEAR(PAYMENT_DATE) ASC, QUARTER(PAYMENT_DATE) ASC, MONTH(PAYMENT_DATE) ASC";

$query = $db->Execute($sql." WITH ROLLUP LIMIT ".$intCursor.", ".$EntrysPerPage);

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
	$query1 = $db->Execute($sql);
	$numrows = $query1->RecordCount();

	$TotalAmount = 0;

	foreach($query1 as $result1)
	{
		$TotalAmount += $result1['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_AMOUNT",$TotalAmount);
	}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$TotalPage = 0;

	foreach($query as $result)
	{
		$Tax[] = $result;
		$TotalPage += $result['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_PAGE",$TotalPage);
	}

	if(isset($Tax)) $smarty->assign('Tax',$Tax);
	
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

$smarty->display('reports/tax_report.tpl');

?>
