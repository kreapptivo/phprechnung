<?php

/*
 * change_statusf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
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

if (! isset ( $invoiceID ) || ! is_numeric ( $invoiceID ) || $invoiceID <= 0) {
	$invoiceID = "";
}

if (isset ( $infoID ) && $infoID == '9') {
	$Searchstring = "OfferID1=$OfferID1&CustomerID1=$CustomerID1&OfferID1=$OfferID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
}

// Database connection
//
DBConnect ();

// Get Offer Information
//
$query = $db->Execute ( "SELECT OFFERID, INVOICEID, CREATEDBY, MESSAGEID, METHODOFPAYID, NOTE FROM {$TBLName}offer WHERE CANCELED=2 AND OFFERID=$offerID" );

// If an error has occurred, display the error message
//
if (! $query)
	print ($db->ErrorMsg ()) ;
else
	foreach ( $query as $f ) {
		$OfferID = $f ['OFFERID'];
		$invoiceID = $f ['INVOICEID'];
		$CreatedBy = $f ['CREATEDBY'];
		$MESSAGEID = $f ['MESSAGEID'];
		$METHODOFPAYID = $f ['METHODOFPAYID'];
		$NOTE = $f ['NOTE'];
	}

if (! is_Superuser () && ! is_Admin () && ! is_Manager () && $_SESSION ['Username'] != $CreatedBy) {
	$_SESSION ['LastSite'] = $_SERVER ['PHP_SELF'] . '?' . $_SERVER ['QUERY_STRING'];
	$_SESSION ['logoutid'] = "5";
	Header ( "Location: $web/login/sustart.php?$sessname=$sessid" );
} else {
	// Check if there are any saved invoices
	//
	$query1 = $db->Execute ( "SELECT INVOICEID FROM {$TBLName}invoice WHERE CANCELED=2 AND INVOICEID=$invoiceID" );
	$numrows1 = $query1->RowCount ();
	if (! $numrows1) {
		if ($OfferStatus == '2') {
			Header ( "Location: $web/offer/print_pdf.php?myID=$myID&offerID=$offerID&OfferStatus=$OfferStatus&Type=Order&$sessname=$sessid" );
		} else if ($OfferStatus == '3') {
			Header ( "Location: $web/invoice/new.php?myID=$myID&offerID=$offerID&tmpID=$offerID&newofferID=$offerID&MethodOfPayment=$METHODOFPAYID&Note=$NOTE&messageID=$MESSAGEID&$sessname=$sessid" );
		} else {
			$query3 = "UPDATE {$TBLName}offer SET STATUS='$OfferStatus', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE OFFERID=$offerID";
			if ($db->Execute ( $query3 ) === false) {
				die ( $db->ErrorMsg () );
			}
		}
		if ($infoID == '9' && $OfferStatus != '3' && $OfferStatus != '2')
			Header ( "Location: $web/offer/searchlist.php?page=$page&$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
		if (empty ( $infoID ) && $OfferStatus != '3' && $OfferStatus != '2')
			Header ( "Location: $web/offer/list.php?page=$page&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
	} else {
		// Display message invoice issued
		//
		$smarty->assign ( "FieldError", "$a[invoice_issued]" );
		$smarty->display ( 'offer/change_statusf.tpl' );
	}
}

?>
