<?php

/*
	searchlist_e.php

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

if(empty($Order) || $Order !== 'LASTNAME' && $Order !== 'FIRSTNAME' && $Order !== 'COMPANY' && $Order !== 'PHONEWORK')
{
	$Order = "LASTNAME,FIRSTNAME,COMPANY";
	$Sort = "";
}

$Searchstring = "CustomerID=$CustomerID&amp;Prefix1=$Prefix1&amp;Title11=$Title11&amp;Firstname1=$Firstname1&amp;Initials1=$Initials1&amp;Lastname1=$Lastname1&amp;Phonehome1=$Phonehome1&amp;Salutation1=$Salutation1&amp;Mobile1=$Mobile1&amp;Address1=$Address1&amp;Fax1=$Fax1&amp;Stateprov1=$Stateprov1&amp;Email1=$Email1&amp;Postalcode1=$Postalcode1&amp;City1=$City1&amp;Url1=$Url1&amp;Company1=$Company1&amp;Phonework1=$Phonework1&amp;Department1=$Department1&amp;Phoneoffi1=$Phoneoffi1&amp;Position11=$Position11&amp;Phoneothe1=$Phoneothe1&amp;Pager1=$Pager1&amp;Note1=$Note1&amp;Country1=$Country1&amp;Date_From1=$Date_From1&amp;Date_Till1=$Date_Till1&amp;Birthday1=$Birthday1&amp;Category1=$Category1&amp;MethodOfPayment1=$MethodOfPayment1&amp;PrintName1=$PrintName1";
$smarty->assign("Searchstring","$Searchstring");

$smarty->assign("Order","$Order");

$smarty->assign("Title","$a[addressbook] - $a[searchresult]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Phone_Work","$a[phonework]");
$smarty->assign("Issue_Invoice","$a[issue_invoice]");
$smarty->assign("Issue_Offer","$a[issue_offer]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("EntryChanged","$a[entry_changed]");
$smarty->assign("EntryDeleted","$a[entry_deleted]");
$smarty->assign("Email_OK","$a[email_ok]");
$smarty->assign("Email_Error","$a[email_error]");
$smarty->assign("DateFrom","$a[date_from]");
$smarty->assign("DateTill","$a[date_till]");

// Database connection
//
DBConnect();

$intCursor = ($page - 1) * $EntrysPerPage;

if (!empty($PrintName1))
{
	$PrintName1 = "AND PRINT_NAME=$PrintName1";
}
if (!empty($Category1))
{
	$Category1 = "AND CATEGORY=$Category1";
}
if (!empty($MethodOfPayment1))
{
	$MethodOfPayment1 = "AND METHODOFPAY=$MethodOfPayment1";
}

$Date_From1 = German_Mysql_Date($Date_From1);
$Date_Till1 = German_Mysql_Date($Date_Till1);
$Birthday1 = German_Mysql_Date($Birthday1);

// Get Customer Information
//
$query = $db->Execute("SELECT FIRSTNAME, LASTNAME, COMPANY, PHONEWORK, CREATED, MYID FROM {$TBLName}addressbook
		WHERE MYID LIKE '%$CustomerID%' AND PREFIX LIKE '%$Prefix1%' AND FIRSTNAME LIKE '%$Firstname1%'
		AND LASTNAME LIKE '%$Lastname1%' AND TITLE LIKE '%$Title11%' AND COMPANY LIKE '%$Company1%'
		AND DEPARTMENT LIKE '%$Department1%' AND ADDRESS LIKE '%$Address1%' AND CITY LIKE '%$City1%'
		AND STATEPROV LIKE '%$Stateprov1%' AND POSTALCODE LIKE '%$Postalcode1%' AND COUNTRY LIKE '%$Country1%'
		AND POSITION LIKE '%$Position11%' AND INITIALS LIKE '%$Initials1%' AND SALUTATION LIKE '%$Salutation1%'
		AND PHONEHOME LIKE '%$Phonehome1%' AND PHONEOFFI LIKE '%$Phoneoffi1%' AND PHONEOTHE LIKE '%$Phoneothe1%'
		AND PHONEWORK LIKE '%$Phonework1%' AND MOBILE LIKE '%$Mobile1%' AND PAGER LIKE '%$Pager1%'
		AND FAX LIKE '%$Fax1%' AND EMAIL LIKE '%$Email1%' AND URL LIKE '%$Url1%' AND NOTE LIKE '%$Note1%'
		AND BIRTHDAY LIKE '%$Birthday1%' AND CREATED >= '$Date_From1' AND CREATED <= '$Date_Till1'
		$Category1 $MethodOfPayment1 $PrintName1 ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	// Count only PageRows depend on search result
	//
	$pagenumrows = $query->RecordCount();

	// Count search result
	//

	$query1 = $db->Execute("SELECT FIRSTNAME, LASTNAME, COMPANY, PHONEWORK, CREATED, MYID FROM {$TBLName}addressbook
		WHERE MYID LIKE '%$CustomerID%' AND PREFIX LIKE '%$Prefix1%' AND FIRSTNAME LIKE '%$Firstname1%'
		AND LASTNAME LIKE '%$Lastname1%' AND TITLE LIKE '%$Title11%' AND COMPANY LIKE '%$Company1%'
		AND DEPARTMENT LIKE '%$Department1%' AND ADDRESS LIKE '%$Address1%' AND CITY LIKE '%$City1%'
		AND STATEPROV LIKE '%$Stateprov1%' AND POSTALCODE LIKE '%$Postalcode1%' AND COUNTRY LIKE '%$Country1%'
		AND POSITION LIKE '%$Position11%' AND INITIALS LIKE '%$Initials1%' AND SALUTATION LIKE '%$Salutation1%'
		AND PHONEHOME LIKE '%$Phonehome1%' AND PHONEOFFI LIKE '%$Phoneoffi1%' AND PHONEOTHE LIKE '%$Phoneothe1%'
		AND PHONEWORK LIKE '%$Phonework1%' AND MOBILE LIKE '%$Mobile1%' AND PAGER LIKE '%$Pager1%'
		AND FAX LIKE '%$Fax1%' AND EMAIL LIKE '%$Email1%' AND URL LIKE '%$Url1%' AND NOTE LIKE '%$Note1%'
		AND BIRTHDAY LIKE '%$Birthday1%' AND CREATED >= '$Date_From1' AND CREATED <= '$Date_Till1'
		$Category1 $MethodOfPayment1 $PrintName1 ORDER BY $Order $Sort");

	$numrows = $query1->RecordCount();

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	// Save all entrys in $CustomerData array
	//
	foreach($query as $result)
	{
		$CustomerData[] = $result;
	}

	if(isset($CustomerData))
		$smarty->assign('CustomerData', $CustomerData);

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
		print $db->ErrorMsg();
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

$smarty->display('addressbook/searchlist_e.tpl');

unset($_SESSION['EditID']);
unset($_SESSION['DeleteID']);
unset ($_SESSION['emailID']);

?>
