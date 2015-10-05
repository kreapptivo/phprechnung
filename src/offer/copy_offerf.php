<?php

/*
 * copy_offerf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
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

if (! is_Superuser () && ! is_Admin () && ! is_Manager () && $_SESSION ['Username'] != $CreatedBy) {
	$_SESSION ['LastSite'] = $_SERVER ['PHP_SELF'] . '?' . $_SERVER ['QUERY_STRING'];
	$_SESSION ['logoutid'] = "5";
	Header ( "Location: $web/login/sustart.php?$sessname=$sessid" );
} else {
	
	// Get offer data
	//
	$query1 = $db->Execute ( "SELECT MYID, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE,
			TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE FROM {$TBLName}offer WHERE OFFERID=$offerID" );
	
	// If an error has occurred, display the error message
	//
	if (! $query1)
		die ( $db->ErrorMsg () );
	else
		foreach ( $query1 as $f ) {
			$MYID = $f ['MYID'];
			$MESSAGEID = $f ['MESSAGEID'];
			$MESSAGE_DESC = $f ['MESSAGE_DESC'];
			$METHODOFPAYID = $f ['METHODOFPAYID'];
			$METHOD_OF_PAY = $f ['METHOD_OF_PAY'];
			$METHOD_OF_PAY_DATE = $f ['METHOD_OF_PAY_DATE'];
			$TAX1 = $f ['TAX1_TOTAL'];
			$TAX2 = $f ['TAX2_TOTAL'];
			$TAX3 = $f ['TAX3_TOTAL'];
			$TAX4 = $f ['TAX4_TOTAL'];
			$TAX1_DESC = $f ['TAX1_DESC'];
			$TAX2_DESC = $f ['TAX2_DESC'];
			$TAX3_DESC = $f ['TAX3_DESC'];
			$TAX4_DESC = $f ['TAX4_DESC'];
			$SUBTOTAL1 = $f ['SUBTOTAL1'];
			$SUBTOTAL2 = $f ['SUBTOTAL2'];
			$SUBTOTAL3 = $f ['SUBTOTAL3'];
			$SUBTOTAL4 = $f ['SUBTOTAL4'];
			$TOTAL_AMOUNT = $f ['TOTAL_AMOUNT'];
			$NOTE = $f ['NOTE'];
		}
		
		// Create a new offer
		//
	$Date = German_Mysql_Date ( date ( 'd.m.Y' ) );
	
	$query2 = "INSERT INTO {$TBLName}offer (OFFERID, MYID, INVOICEID, OFFER_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, STATUS, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE, ORDER_PRINTED, ORDER_MAILED, OFFER_PRINTED, OFFER_MAILED, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
	$query2 .= "VALUES (NULL, '$MYID', '', '$Date', '$MESSAGEID', '$MESSAGE_DESC', '$METHODOFPAYID', '$METHOD_OF_PAY', '$METHOD_OF_PAY_DATE', '1', '$TAX1', '$TAX2', '$TAX3', '$TAX4', '$TAX1_DESC', '$TAX2_DESC', '$TAX3_DESC', '$TAX4_DESC', '$SUBTOTAL1', '$SUBTOTAL2', '$SUBTOTAL3', '$SUBTOTAL4', '$TOTAL_AMOUNT', '$NOTE', '2', '2', '2', '2', '2', '$_SESSION[Username]','$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";
	
	if ($db->Execute ( $query2 ) === false) {
		die ( $db->ErrorMsg () );
	}
	
	// Get the last entry from table 'offer'
	//
	$query3 = $db->GetRow ( "SELECT MAX(OFFERID) AS MAX_OFFERID FROM {$TBLName}offer" );
	if (! $query3)
		die ( $db->ErrorMsg () );
	else
		$maxOfferID = $query3 ['MAX_OFFERID'];
		
		// Get all positions from table 'offerpos'
		//
	$query4 = $db->GetAll ( "SELECT POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC FROM {$TBLName}offerpos WHERE OFFERID=$offerID" );
	
	if (! $query4)
		die ( $db->ErrorMsg () );
	else
		foreach ( $query4 as $f ) {
			$PosID = $f ['POSITIONID'];
			$Pos_Desc = $f ['POS_DESC'];
			$Pos_Quantity = $f ['POS_QUANTITY'];
			$Pos_Price = $f ['POS_PRICE'];
			$Pos_Group = $f ['POS_GROUP'];
			$Tax = $f ['TAX'];
			$Tax_Multi = $f ['TAX_MULTI'];
			$Tax_Divide = $f ['TAX_DIVIDE'];
			$Tax_Desc = $f ['TAX_DESC'];
			
			// Insert all new positions in table 'offerpos'
			//
			$query5 = "INSERT INTO {$TBLName}offerpos (OFFERPOSID, OFFERID, MYID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)";
			$query5 .= "VALUES (NULL, '$maxOfferID', '$MYID', '$PosID', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Desc', '$Tax_Multi', '$Tax_Divide')";
			
			if ($db->Execute ( $query5 ) === false) {
				die ( $db->ErrorMsg () );
			}
			
			$_SESSION ['NewID'] = "1";
		}
	
	if ($infoID == '9')
		Header ( "Location: $web/offer/searchlist.php?page=$page&offerID=$maxOfferID&myID=$MYID&$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
	if (empty ( $infoID ))
		Header ( "Location: $web/offer/list.php?page=$page&offerID=$maxOfferID&myID=$MYID&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
}

?>
