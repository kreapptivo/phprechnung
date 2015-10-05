<?php

/*
 * info.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
require_once ("../include/phprechnung.inc.php");
require_once ("../include/smarty.inc.php");

CheckUser ();
CheckSession ();

$ArrayValue = CheckArrayValue ( $_REQUEST );

foreach ( $ArrayValue as $key => $val ) {
	$$key = $val;
	$smarty->assign ( "$key", $val );
}

if (! is_numeric ( $offerID ) || $offerID <= 0) {
	die ( header ( "Location: $web" ) );
}

if (isset ( $infoID ) && $infoID == '9') {
	$Searchstring = "&amp;OfferID1=$OfferID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign ( "Searchstring", "$Searchstring" );
}

// Assign needed text from language file
//
$smarty->assign ( "Title", "$a[offer] - $a[info]" );
$smarty->assign ( "Print", "$a[print]" );
$smarty->assign ( "Print_Offer", "$a[print_offer]" );
$smarty->assign ( "Copy_Offer", "$a[copy_offer]" );
$smarty->assign ( "Email_Offer", "$a[email_offer]" );
$smarty->assign ( "Email_Order", "$a[email_order]" );
$smarty->assign ( "OOrder", "$a[order]" );

$smarty->assign ( "OfferNo", "$a[offer_number]" );
$smarty->assign ( "OfferInitials", "$a[offer_initials]" );
$smarty->assign ( "CustomerNoInitials", "$a[customer_no_initials]" );

$smarty->assign ( "First_Name", "$a[firstname]" );
$smarty->assign ( "Last_Name", "$a[lastname]" );
$smarty->assign ( "Company_Name", "$a[company]" );
$smarty->assign ( "Issue_Invoice", "$a[issue_invoice]" );
$smarty->assign ( "Customer_No", "$a[customer_no]" );
$smarty->assign ( "Customer", "$a[customer]" );
$smarty->assign ( "Offer_No", "$a[offer_number]" );
$smarty->assign ( "Offer_Amount", "$a[offer_amount]" );
$smarty->assign ( "Offer_Status", "$a[status]" );
$smarty->assign ( "Print_Offer", "$a[print_offer]" );
$smarty->assign ( "Print_Order", "$a[print_order]" );
$smarty->assign ( "Offer_Amount", "$a[offer_amount]" );
$smarty->assign ( "Offer_Not_Accepted", $offer_status [1] );
$smarty->assign ( "Offer_Confirmation", $offer_status [2] );
$smarty->assign ( "Offer_Invoice", $offer_status [3] );
$smarty->assign ( "Offer_Tax1", "$a[offer_tax1]" );
$smarty->assign ( "Offer_Tax2", "$a[offer_tax2]" );
$smarty->assign ( "Offer_Tax3", "$a[offer_tax3]" );
$smarty->assign ( "Offer_Subtotal", "$a[offer_subtotal]" );
$smarty->assign ( "PositionName", "$a[pos_name]" );
$smarty->assign ( "PositionText", "$a[pos_text]" );
$smarty->assign ( "PositionQuantity", "$a[pos_quantity]" );
$smarty->assign ( "PositionPrice", "$a[pos_price]" );
$smarty->assign ( "PositionAmount", "$a[pos_amount]" );
$smarty->assign ( "Offer_Note", "$a[note]" );
$smarty->assign ( "Entry_Canceled", "$a[entry_canceled]" );
$smarty->assign ( "Date_Till", "$a[date_till]" );
$smarty->assign ( "CloseWindow", "$a[close_window]" );

// Database connection
//
DBConnect ();

// Get data from company_settings.inc.php
//
$smarty->assign ( "Offer_Currency", $CompanyCurrency );
$smarty->assign ( "Country", $CompanyCountry );
$smarty->assign ( "TaxFree", $TaxFree );

// Get Offer Information
//
$query = $db->Execute ( "SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
	A.CITY, A.COUNTRY, A.METHODOFPAY, A.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.OFFERID, O.TOTAL_AMOUNT, O.MYID,
	O.CREATEDBY, O.STATUS, O.MESSAGEID, O.MESSAGE_DESC, O.METHODOFPAYID, O.METHOD_OF_PAY, O.TAX1_TOTAL, O.TAX2_TOTAL, O.TAX3_TOTAL, O.TAX4_TOTAL, O.TAX1_DESC, O.TAX2_DESC, O.TAX3_DESC, O.TAX4_DESC, O.SUBTOTAL1, O.SUBTOTAL2, O.SUBTOTAL3, O.SUBTOTAL4, O.NOTE,
	O.CANCELED, DATE_FORMAT(O.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE A.MYID=O.MYID AND O.OFFERID=$offerID" );

// If an error has occurred, display the error message
//
if (! $query)
	print ($db->ErrorMsg ()) ;
else
	foreach ( $query as $f ) {
		$OfferDate = $f ['OFFER_DATE'];
		$OfferID = $f ['OFFERID'];
		$CreatedBy = $f ['CREATEDBY'];
		$status = $f ['STATUS'];
		$smarty->assign ( "MYID", $f ['MYID'] );
		$smarty->assign ( "TITLE", $f ['TITLE'] );
		$smarty->assign ( "PREFIX", $f ['PREFIX'] );
		$smarty->assign ( "FIRSTNAME", $f ['FIRSTNAME'] );
		$smarty->assign ( "LASTNAME", $f ['LASTNAME'] );
		$smarty->assign ( "COMPANY", $f ['COMPANY'] );
		$smarty->assign ( "ADDRESS", $f ['ADDRESS'] );
		$smarty->assign ( "CITY", $f ['CITY'] );
		$smarty->assign ( "POSTALCODE", $f ['POSTALCODE'] );
		$smarty->assign ( "COUNTRY", $f ['COUNTRY'] );
		$smarty->assign ( "PRINT_NAME", $f ['PRINT_NAME'] );
		$smarty->assign ( "CREATED", $CreatedBy );
		$smarty->assign ( "METHOD_OF_PAY", $f ['METHOD_OF_PAY'] );
		$smarty->assign ( "METHOD_OF_PAY_DATE", $f ['METHOD_OF_PAY_DATE'] );
		$smarty->assign ( "METHODOFPAYID", $f ['METHODOFPAYID'] );
		$smarty->assign ( "TOTAL_AMOUNT", $f ['TOTAL_AMOUNT'] );
		$smarty->assign ( "STATUS", $f ['STATUS'] );
		$smarty->assign ( "OFFER_STATUS", $offer_status [$status] );
		$smarty->assign ( "MESSAGEID", $f ['MESSAGEID'] );
		$smarty->assign ( "MESSAGE_DESC", $f ['MESSAGE_DESC'] );
		$smarty->assign ( "NOTE", $f ['NOTE'] );
		$smarty->assign ( "CANCELED", $f ['CANCELED'] );
	}

$PrintD = Print_Date ( $OfferDate );
$smarty->assign ( "PrintDate", $PrintD . '-' . $OfferID );
$smarty->assign ( "OFFER_DATE", $OfferDate );

$posquery = $db->Execute ( "SELECT P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC, V.POS_QUANTITY, V.POS_PRICE, V.OFFERID, V.OFFERPOSID, V.TAX, V.TAX_MULTI, V.TAX_DIVIDE, V.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}offerpos AS V WHERE P.POSITIONID=V.POSITIONID AND V.OFFERID=$offerID ORDER BY V.POS_GROUP ASC, V.POS_DESC ASC" );

// $numrows = count($posquery);
$numrows = $posquery->RecordCount ();

// Calculate positions
//
require_once ('../include/pos.inc.php');

$smarty->assign ( "MaxRows", "$numrows" );
$smarty->assign ( "CurrentOfferID", "$offerID" );

// Get the first entry from table 'angebot'
//
$query3 = $db->GetRow ( "SELECT MIN(OFFERID) AS MIN_OFFERID FROM {$TBLName}offer" );
if (! $query3)
	die ( $db->ErrorMsg () );
else
	$minOfferID = $query3 ['MIN_OFFERID'];
$smarty->assign ( "MinOfferID", "$minOfferID" );

// Get the last entry from table 'angebot'
//
$query4 = $db->GetRow ( "SELECT MAX(OFFERID) AS MAX_OFFERID FROM {$TBLName}offer" );
if (! $query4)
	die ( $db->ErrorMsg () );
else
	$maxOfferID = $query4 ['MAX_OFFERID'];

$smarty->assign ( "MaxOfferID", "$maxOfferID" );

// If we are not on first page then display
// first page, previous page link
//
if ($offerID > $minOfferID) {
	$CurrentOfferID = $offerID - 1;
	$smarty->assign ( 'PrevOfferID', "$CurrentOfferID" );
}

// If we are not on the last page then display
// next page, last page link
//
if ($offerID < $maxOfferID) {
	$CurrentOfferID = $offerID + 1;
	$smarty->assign ( 'NextOfferID', "$CurrentOfferID" );
}

if (! is_Superuser () && ! is_Admin () && ! is_Manager () && $_SESSION ['Username'] != $CreatedBy) {
	$_SESSION ['LastSite'] = $_SERVER ['PHP_SELF'] . '?' . $_SERVER ['QUERY_STRING'];
	$_SESSION ['logoutid'] = "5";
	Header ( "Location: $web/login/sustart.php?$sessname=$sessid" );
} else {
	// Save last page visited by user
	//
	UserSite ();
	$smarty->display ( 'offer/info.tpl' );
}

?>
