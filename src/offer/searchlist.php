<?php

/*
	searchlist.php

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

if(!isset($page) || !is_numeric($page) || $page <= 0 )
{
	$page = 1;
}

if(!isset($Sort) || $Sort !== 'ASC' && $Sort !== 'DESC')
{
	$Sort = "";
}

if(empty($Order) || $Order !== 'OFFERID' && $Order !== 'LASTNAME,FIRSTNAME,COMPANY' && $Order !== 'O.OFFER_DATE' && $Order !== 'TOTAL_AMOUNT' && $Order !== 'STATUS')
{
	$Order = "O.OFFER_DATE DESC,OFFERID DESC";
	$Sort = "";
}

$Searchstring = "OfferID1=$OfferID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
$smarty->assign("Searchstring","$Searchstring");

$smarty->assign("Title","$a[offer] - $a[searchresult]");
$smarty->assign("SearchResult","$a[searchresult]");
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
$smarty->assign("DateFrom","$a[date_from]");
$smarty->assign("DateTill","$a[date_till]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Offer_Currency",$CompanyCurrency);

$intCursor = ($page - 1) * $EntrysPerPage;

// Get Offer Information
//
$DateFrom1 = German_Mysql_Date($DateFrom1);
$DateTill1 = German_Mysql_Date($DateTill1);

if(isset($Canceled) && $Canceled == 1)
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE O.CANCELED=1 AND A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%'
			AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else if(isset($Canceled) && $Canceled == 3)
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%'
			AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.CREATEDBY, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.TOTAL_AMOUNT, O.STATUS, O.CANCELED, O.METHODOFPAYID, O.NOTE, O.MESSAGEID FROM {$TBLName}offer AS O, {$TBLName}addressbook AS A WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%'
			AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count only PageRows
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows
	//
	if(isset($Canceled) && $Canceled == 1)
	{
		$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.OFFERID, O.MYID, O.TOTAL_AMOUNT FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=1 AND A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$query1 = $db->Execute("SELECT A.MYID, cO.OFFERID, O.MYID, O.TOTAL_AMOUNT FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");
	}
	else
	{
		$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.OFFERID, O.MYID, O.TOTAL_AMOUNT FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");
	}

	$numrows = $query1->RecordCount();

	$Total_Amount = 0;

	foreach($query1 as $result1)
	{
		// Calculate total amount
		//
		$Total_Amount += $result1['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_OFFER",$Total_Amount);
	}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$TotalPage = 0;

	// Save all entrys in $OfferData array
	//
	foreach($query as $result)
	{
		$OfferData[] = $result;

		// Calculate total amount per page
		//
		$TotalPage += $result['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_PAGE",$TotalPage);
	}

	if(isset($OfferData))
		$smarty->assign('OfferData', $OfferData);
	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

	// Put avaiable status messages in $active_status
	//
	$smarty->assign("active_status",array($offer_status));

// Get information from selected customer
//
if(isset($myID) && is_numeric($myID))
{
	$query4 = $db->Execute("SELECT LASTNAME, FIRSTNAME, COMPANY, MYID from {$TBLName}addressbook WHERE MYID='$myID'");

	// If an error has occurred, display the error message
	//
	if (!$query4)
		print($db->ErrorMsg());
	else
		foreach($query4 as $result4)
		{
			$smarty->assign("FIRSTNAME","$result4[FIRSTNAME]");
			$smarty->assign("LASTNAME","$result4[LASTNAME]");
			$smarty->assign("COMPANY","$result4[COMPANY]");
			$smarty->assign("MYID","$result4[MYID]");
		}
}

// Calculate total amount Not accepted
//
$query5 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.TOTAL_AMOUNT, O.STATUS, O.MYID FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=1 AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");

$TotalNA = 0;

// If an error has occurred, display the error message
//
if (!$query5)
	print($db->ErrorMsg());
else
	foreach($query5 as $result5)
	{
		$TotalNA += $result5['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_NA",$TotalNA);
	}

// Calculate total amount Confirmation of order
//
$query6 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.TOTAL_AMOUNT, O.STATUS, O.MYID FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=2 AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");

$TotalC = 0;

// If an error has occurred, display the error message
//
if (!$query6)
	print($db->ErrorMsg());
else
	foreach($query6 as $result6)
	{
		$TotalC += $result6['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_C",$TotalC);
	}

// Calculate total amount invoice
//
$query7 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, O.TOTAL_AMOUNT, O.STATUS, O.MYID FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE O.CANCELED=2 AND A.MYID=O.MYID AND O.STATUS=3 AND O.OFFERID LIKE '%$OfferID1%' AND O.MYID LIKE '%$CustomerID1' AND O.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND O.OFFER_DATE >= '$DateFrom1' AND O.OFFER_DATE <= '$DateTill1'");

$TotalIn = 0;

// If an error has occurred, display the error message
//
if (!$query7)
	print($db->ErrorMsg());
else
	foreach($query7 as $result7)
	{
		$TotalIn += $result7['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_IN",$TotalIn);
	}

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

$smarty->display('offer/searchlist.tpl');

unset($_SESSION['NewID']);
unset($_SESSION['EditID']);
unset($_SESSION['CancelID']);
unset ($_SESSION['emailID']);

?>
