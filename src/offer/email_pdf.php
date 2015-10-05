<?php

/*
 * email_pdf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de > phpRechnung benutzt die FPDF Bibliothek um PDF Dateien zu generieren. Copyright (C) Olivier PLATHEY, http://fpdf.org/ License: Freeware. This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
require_once ('../include/phprechnung.inc.php');

CheckUser ();
CheckSession ();

$ArrayValue = CheckArrayValue ( $_REQUEST );

foreach ( $ArrayValue as $key => $val ) {
	$$key = $val;
}

if (! is_numeric ( $offerID ) || $offerID <= 0) {
	die ( header ( "Location: $web" ) );
}

if (! isset ( $myID ) || ! is_numeric ( $myID ) || $myID <= 0) {
	$myID = "";
}

if (isset ( $infoID ) && $infoID == '9') {
	$Searchstring = "OfferID1=$OfferID1&CustomerID1=$CustomerID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
}

// Database connection
//
DBConnect ();

// Get Offer Information
//
$query = $db->Execute ( "SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
	A.CITY, A.COUNTRY, A.SALUTATION, A.METHODOFPAY, A.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.OFFERID, O.TOTAL_AMOUNT, O.MYID,
	O.CREATEDBY, O.STATUS, O.MESSAGE_DESC, O.METHOD_OF_PAY, DATE_FORMAT(O.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS PAY_DATE, O.TAX1_TOTAL, O.TAX2_TOTAL, O.TAX3_TOTAL, O.TAX4_TOTAL, O.TAX1_DESC, O.TAX2_DESC, O.TAX3_DESC, O.TAX4_DESC, O.SUBTOTAL1, O.SUBTOTAL2, O.SUBTOTAL3, O.SUBTOTAL4
	FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE A.MYID=O.MYID AND O.OFFERID=$offerID" );

// If an error has occurred, display the error message
//
if (! $query)
	print ($db->ErrorMsg ()) ;
else
	foreach ( $query as $f ) {
		$Print_Company_Name = $f ['PRINT_NAME'];
		$Date = $f ['OFFER_DATE'];
		$ID = $f ['OFFERID'];
		$CreatedBy = $f ['CREATEDBY'];
		$status = $f ['STATUS'];
		$MYID = $f ['MYID'];
		$TITLE = $f ['TITLE'];
		$PREFIX = $f ['PREFIX'];
		$FIRSTNAME = $f ['FIRSTNAME'];
		$LASTNAME = $f ['LASTNAME'];
		$COMPANY = $f ['COMPANY'];
		$ADDRESS = $f ['ADDRESS'];
		$CITY = $f ['CITY'];
		$POSTALCODE = $f ['POSTALCODE'];
		$COUNTRY = $f ['COUNTRY'];
		$SALUTATION = $f ['SALUTATION'];
		$METHOD_OF_PAY = $f ['METHOD_OF_PAY'];
		$METHOD_OF_PAY_DATE = $f ['PAY_DATE'];
		$SUBTOTAL1 = $f ['SUBTOTAL1'];
		$SUBTOTAL2 = $f ['SUBTOTAL2'];
		$SUBTOTAL3 = $f ['SUBTOTAL3'];
		$SUBTOTAL4 = $f ['SUBTOTAL4'];
		$TAX1 = $f ['TAX1_TOTAL'];
		$TAX2 = $f ['TAX2_TOTAL'];
		$TAX3 = $f ['TAX3_TOTAL'];
		$TAX4 = $f ['TAX4_TOTAL'];
		$TAX1_DESC = $f ['TAX1_DESC'];
		$TAX2_DESC = $f ['TAX2_DESC'];
		$TAX3_DESC = $f ['TAX3_DESC'];
		$TAX4_DESC = $f ['TAX4_DESC'];
		$TOTAL = $f ['TOTAL_AMOUNT'];
		$STATUS = $offer_status [$status];
		$MESSAGEID = $f ['MESSAGE_DESC'];
	}

$PrintD = Print_Date ( $Date );

if ($Type == 'Offer') {
	$FileName = "$a[offer_initials]-$PrintD-" . str_pad ( $ID, 3, '0', STR_PAD_LEFT );
	$Subject = "$a[offer] - $a[offer_number]: $FileName, $a[customer_no]: $MYID, $a[date_text]: $Date";
	// $sendfile = $PDFDirectory.$FileName.'.pdf';
} else {
	if ($STATUS != '3') {
		$query3 = "UPDATE {$TBLName}offer SET STATUS='2', MODIFIEDBY='$_SESSION[Username]' WHERE OFFERID=$offerID";
		if ($db->Execute ( $query3 ) === false) {
			die ( $db->ErrorMsg () );
		}
	}
	$FileName = "$a[order_initials]-$PrintD-" . str_pad ( $ID, 3, '0', STR_PAD_LEFT );
	$Subject = "$a[order] - $a[order_number]: $FileName, $a[customer_no]: $MYID, $a[date_text]: $Date";
	// $sendfile = $PDFDirectory.$FileName.'.pdf';
}
$sendfile = $FileName . '.pdf';

$posquery = $db->Execute ( "SELECT P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC,
	V.POS_QUANTITY, V.POS_PRICE, V.OFFERID, V.TAX, V.TAX_DIVIDE, V.TAX_MULTI, V.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}offerpos AS V WHERE P.POSITIONID=V.POSITIONID AND V.OFFERID=$offerID ORDER BY V.POS_GROUP ASC, V.POS_DESC ASC" );

if (! is_Superuser () && ! is_Admin () && ! is_Manager () && $_SESSION ['Username'] != $CreatedBy) {
	$_SESSION ['LastSite'] = $_SERVER ['PHP_SELF'] . '?' . $_SERVER ['QUERY_STRING'];
	$_SESSION ['logoutid'] = "5";
	Header ( "Location: $web/login/sustart.php?$sessname=$sessid" );
} else {
	$PrintCompanyData = "On";
	
	require_once ('../include/pdf.inc.php');
	
	if (! empty ( $EmailTo )) {
		require_once ("../include/mail.inc.php");
		
		Email ( $EmailTo, $EmailCc, $EmailBcc, $EmailPriority, $Subject, $CompanyPdfAttachmentText, $sendfile, $sendfile_content );
		
		// $syslogid = $db->GenID('syslog_syslogid_seq');
		$Description = QuoteString ( "$Subject was send by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress to E-Mail: $EmailTo" );
		$query2 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query2 .= "VALUES(NULL, " . $db->sysTimeStamp . ", $Description, 'admin', '1', '2')";
		
		if ($db->Execute ( $query2 ) === false) {
			die ( $db->ErrorMsg () );
		}
	} else {
		$_SESSION ['emailID'] = '2';
	}
	
	if ($infoID == '9') {
		Header ( "Location: $web/offer/searchlist.php?myID=$myID&offerID=$offerID&page=$page&$Searchstring&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
	} else {
		Header ( "Location: $web/offer/list.php?myID=$myID&offerID=$offerID&page=$page&Order=$Order&Sort=$Sort&Canceled=$Canceled&$sessname=$sessid#$offerID" );
	}
}

?>
