<?php

/*
	outstanding_offers.php

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

if(empty($Order) || $Order !== 'OFFERID' && $Order !== 'LASTNAME,FIRSTNAME,COMPANY' && $Order !== 'O.OFFER_DATE' && $Order !== 'O.TOTAL_AMOUNT' && $Order !== 'STATUS')
{
	$Order = "O.OFFER_DATE ASC";
	$Sort = "";
	$smarty->assign("Order","$Order");
	$smarty->assign("Sort","$Sort");
}

$smarty->assign("Title","$a[reports] - $a[offer] - $offer_status[1]");
$smarty->assign("SearchResult","$offer_status[1]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Issue_Invoice","$a[issue_invoice]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("NewEntry","$a[new_entry]");
$smarty->assign("EntryChanged","$a[entry_changed]");
$smarty->assign("EntryCanceled","$a[entry_canceled]");
$smarty->assign("Email_OK","$a[email_ok]");
$smarty->assign("Email_Error","$a[email_error]");
$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("Offer_Amount","$a[offer_amount]");
$smarty->assign("Offer_Status","$a[status]");
$smarty->assign("Print_Offer","$a[print_offer]");
$smarty->assign("Offer_Amount","$a[offer_amount]");
$smarty->assign("Offer_Not_Accepted",$offer_status[1]);
$smarty->assign("Offer_Confirmation",$offer_status[2]);
$smarty->assign("Offer_Invoice",$offer_status[3]);
$smarty->assign("Date_From","$a[date_from]");
$smarty->assign("Date_Till","$a[date_till]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Offer_Currency",$CompanyCurrency);

$intCursor = ($page - 1) * $EntrysPerPage;

$DateFrom = German_Mysql_Date($DateFrom);
$DateTill = German_Mysql_Date($DateTill);

$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=1
			AND O.OFFER_DATE >= '$DateFrom' AND O.OFFER_DATE <= '$DateTill' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count PageRows
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows
	//
	$query1 = $db->Execute("SELECT A.MYID, O.MYID, O.TOTAL_AMOUNT FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=1
			AND O.OFFER_DATE >= '$DateFrom' AND O.OFFER_DATE <= '$DateTill'");

	if (!$query1)
		print($db->ErrorMsg());
	else
		$numrows = $query1->RecordCount();

		$Total_Amount = 0;

		foreach($query1 as $result1)
		{
			// Calculate total amount by searchresult
			//
			$Total_Amount += $result1['TOTAL_AMOUNT'];
			$smarty->assign("TOTAL_AMOUNT",$Total_Amount);
		}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$Total_Page = 0;

	// Save all entrys in $OfferData array
	//
	foreach($query as $result)
	{
		$OfferData[] = $result;

		// Calculate total amount per page
		//
		$Total_Page += $result['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_PAGE",$Total_Page);
	}

	if(isset($OfferData))
		$smarty->assign('OfferData', $OfferData);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

	// Put avaiable status messages in $active_status
	//
	$smarty->assign("active_status",array($offer_status));

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

$smarty->display('reports/outstanding_offers.tpl');

?>
