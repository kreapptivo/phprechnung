<?php

/*
 * cancelf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
require_once ("../include/phprechnung.inc.php");
require_once ("../include/smarty.inc.php");

CheckUser ();
CheckAdminGroup1 ();
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
	$Searchstring = "OfferID1=$OfferID1&CustomerID1=$CustomerID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
}

// Database connection
//
DBConnect ();

// Get Offer Information
//
$query = $db->Execute ( "SELECT OFFERID, INVOICEID, CREATEDBY FROM {$TBLName}offer WHERE OFFERID=$offerID" );

// If an error has occurred, display the error message
//
if (! $query)
	print ($db->ErrorMsg ()) ;
else
	foreach ( $query as $f ) {
		$OfferID = $f ['OFFERID'];
		$invoiceID = $f ['INVOICEID'];
		$CreatedBy = $f ['CREATEDBY'];
	}

if (! is_Superuser () && ! is_Admin () && $_SESSION ['Username'] != $CreatedBy) {
	$_SESSION ['LastSite'] = $_SERVER ['PHP_SELF'] . '?' . $_SERVER ['QUERY_STRING'];
	$_SESSION ['logoutid'] = "5";
	Header ( "Location: $web/login/sustart.php?$sessname=$sessid" );
} else {
	// Check if there are any invoices depend on this offer
	//
	$query1 = $db->Execute ( "SELECT INVOICEID FROM {$TBLName}invoice WHERE INVOICEID=$invoiceID" );
	$numrows1 = $query1->RowCount ();
	if (! $numrows1) {
		// Cancel the selected offer
		//
		$query2 = "UPDATE {$TBLName}offer SET CANCELED=1 WHERE OFFERID=$offerID";
		
		if ($db->Execute ( $query2 ) === false) {
			die ( $db->ErrorMsg () );
		}
		
		$query3 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query3 .= "VALUES(NULL, '$CurrentDateTime', 'Offer-No.: $offerID for Customer-No.: $myID was CANCELED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress.', 'admin', '1', '2')";
		if ($db->Execute ( $query3 ) === false) {
			die ( $db->ErrorMsg () );
		}
		
		$_SESSION ['CancelID'] = "1";
		
		if ($infoID == '9')
			Header ( "Location: $web/offer/searchlist.php?page=$page&offerID=$offerID&myID=$myID&$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
		if (empty ( $infoID ))
			Header ( "Location: $web/offer/list.php?page=$page&offerID=$offerID&myID=$myID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
	} else {
		// Display message invoice issued
		//
		$smarty->assign ( "FieldError", "$a[entry_not_deleted] <br />$a[invoice_issued]" );
		$smarty->display ( 'offer/cancelf.tpl' );
	}
}

?>
