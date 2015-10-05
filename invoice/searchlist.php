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

if(empty($Order) || $Order !== 'INVOICEID' && $Order !== 'LASTNAME,FIRSTNAME,COMPANY' && $Order !== 'I.INVOICE_DATE' && $Order !== 'TOTAL_AMOUNT' && $Order !== 'TOTAL_AMOUNT-SUM_PAID')
{
	$Order = "I.INVOICE_DATE DESC,I.INVOICEID DESC";
	$Sort = "";
}

$Searchstring = "InvoiceID1=$InvoiceID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
$smarty->assign("Searchstring","$Searchstring");

$smarty->assign("Title","$a[invoice] - $a[searchresult]");
$smarty->assign("SearchResult","$a[searchresult]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("EntryChanged","$a[entry_changed]");
$smarty->assign("EntryCanceled","$a[entry_canceled]");
$smarty->assign("NewEntry","$a[new_entry]");
$smarty->assign("Email_OK","$a[email_ok]");
$smarty->assign("Email_Error","$a[email_error]");
$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("Delivery_Note_No","$a[delivery_note_number]");
$smarty->assign("Invoice_Amount","$a[invoice_amount]");
$smarty->assign("Invoice_Transaction","$a[invoice_transaction]");
$smarty->assign("Open_Account","$a[open_account]");
$smarty->assign("Print_Invoice","$a[print_invoice]");
$smarty->assign("Print_Delivery_Note","$a[print_delivery_note]");
$smarty->assign("DateFrom","$a[date_from]");
$smarty->assign("DateTill","$a[date_till]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Invoice_Currency",$CompanyCurrency);

$intCursor = ($page - 1) * $EntrysPerPage;

$DateFrom1 = German_Mysql_Date($DateFrom1);
$DateTill1 = German_Mysql_Date($DateTill1);

if(isset($Canceled) && $Canceled == 1)
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE CANCELED=1 AND A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%'
			AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else if(isset($Canceled) && $Canceled == 3)
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%'
			AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}
else
{
	$query = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.CREATEDBY, I.INVOICEID, I.MYID, DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.TOTAL_AMOUNT, I.PAID, I.SUM_PAID, I.CANCELED FROM {$TBLName}invoice AS I, {$TBLName}addressbook AS A WHERE CANCELED=2 AND A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%'
			AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%' AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1' ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");
}

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
	if(isset($Canceled) && $Canceled == 1)
	{
		$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.INVOICEID, I.MYID, I.TOTAL_AMOUNT, I.SUM_PAID FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE I.CANCELED=1 AND A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%' AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1'");
	}
	else if(isset($Canceled) && $Canceled == 3)
	{
		$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.INVOICEID, I.MYID, I.TOTAL_AMOUNT, I.SUM_PAID FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%' AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1'");
	}
	else
	{
		$query1 = $db->Execute("SELECT A.MYID, A.FIRSTNAME, A.LASTNAME, A.COMPANY, I.INVOICEID, I.MYID, I.TOTAL_AMOUNT, I.SUM_PAID FROM {$TBLName}addressbook AS A, {$TBLName}invoice AS I WHERE I.CANCELED=2 AND A.MYID=I.MYID AND I.INVOICEID LIKE '%$InvoiceID1%' AND I.MYID LIKE '%$CustomerID1' AND I.TOTAL_AMOUNT LIKE '%$Total1%'
			AND ( A.FIRSTNAME LIKE '%$Customer1%' OR A.LASTNAME LIKE '%$Customer1%' OR A.COMPANY LIKE '%$Customer1%' )
			AND I.INVOICE_DATE >= '$DateFrom1' AND I.INVOICE_DATE <= '$DateTill1'");
	}

	$numrows = $query1->RecordCount();

	$Total_Amount = 0;
	$Sum_Paid = 0;

	if (!$query1)
		print($db->ErrorMsg());
	else
		foreach($query1 as $result1)
		{
			// Calculate total amount by searchresult
			//
			$Total_Amount += $result1['TOTAL_AMOUNT'];
			$smarty->assign("TOTAL_AMOUNT",$Total_Amount);

			// Calculate total open amount by searchresult
			//
			$Sum_Paid += $result1['SUM_PAID'];
			$smarty->assign("OPEN_ACCOUNT",$Total_Amount-$Sum_Paid);
		}

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	$TotalPage = 0;

	// Save all entrys in $InvoiceData array
	//
	foreach($query as $result)
	{
		$InvoiceData[] = $result;

		// Calculate total amount per page
		//
		$TotalPage += $result['TOTAL_AMOUNT'];
		$smarty->assign("TOTAL_PAGE",$TotalPage);
	}

	if(isset($InvoiceData))
		$smarty->assign('InvoiceData', $InvoiceData);

	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

// Get information from selected customer
//
if(isset($myID) && is_numeric($myID))
{
	$query3 = $db->Execute("SELECT LASTNAME, FIRSTNAME, COMPANY, MYID FROM {$TBLName}addressbook WHERE MYID='$myID'");

	// If an error has occurred, display the error message
	//
	if (!$query3)
		print($db->ErrorMsg());
	else
		foreach($query3 as $result3)
		{
			$smarty->assign("FIRSTNAME","$result3[FIRSTNAME]");
			$smarty->assign("LASTNAME","$result3[LASTNAME]");
			$smarty->assign("COMPANY","$result3[COMPANY]");
			$smarty->assign("MYID","$result3[MYID]");
		}
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

$smarty->display('invoice/searchlist.tpl');

unset($_SESSION['EditID']);
unset($_SESSION['CancelID']);
unset($_SESSION['NewID']);
unset($_SESSION['emailID']);
unset($_SESSION['Type']);

?>
