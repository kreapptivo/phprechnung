<?php

/*
	print_pdf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	phpRechnung benutzt die FPDF Bibliothek um PDF Dateien zu generieren.
	Copyright (C) Olivier PLATHEY, http://fpdf.org/ License: Freeware.

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

require_once('../include/phprechnung.inc.php');

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
}

if(!is_numeric($offerID) || $offerID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($OfferDate))
	$Date = $OfferDate;

// Database connection
//
DBConnect();

// Get Offer Information
//
if(isset($tmpPos) && $tmpPos == '1')
{
	$query = $db->GetRow("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");
	$METHOD_OF_PAY = $query['DESCRIPTION'];

	$query1 = $db->GetRow("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");
	$MESSAGEID = $query1['DESCRIPTION'];
	
	$METHOD_OF_PAY_DATE = $MethodOfPaymentDate;

	$query2 = $db->Execute("SELECT PREFIX, TITLE, FIRSTNAME, LASTNAME, ADDRESS, COMPANY, POSTALCODE, PRINT_NAME,
		CITY, COUNTRY, MYID FROM {$TBLName}addressbook WHERE MYID=$myID");
	
	// If an error has occurred, display the error message
	//
	if (!$query2)
		print($db->ErrorMsg());
	else
		foreach($query2 as $f)
		{
			$Print_Company_Name = $f['PRINT_NAME'];
			$ID = $offerID;
			$CreatedBy = $_SESSION['Username'];
			$MYID = $f['MYID'];
			$TITLE = $f['TITLE'];
			$PREFIX = $f['PREFIX'];
			$FIRSTNAME = $f['FIRSTNAME'];
			$LASTNAME = $f['LASTNAME'];
			$COMPANY = $f['COMPANY'];
			$ADDRESS = $f['ADDRESS'];
			$CITY = $f['CITY'];
			$POSTALCODE = $f['POSTALCODE'];
			$COUNTRY = $f['COUNTRY'];
		}
}
else
{
	$query = $db->Execute("SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
		A.CITY, A.COUNTRY, A.METHODOFPAY, A.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.INVOICEID, O.OFFERID, O.TOTAL_AMOUNT, O.MYID,
		O.CREATEDBY, O.STATUS, O.MESSAGE_DESC, O.METHOD_OF_PAY, DATE_FORMAT(O.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE, O.TAX1_TOTAL, O.TAX2_TOTAL, O.TAX3_TOTAL, O.TAX4_TOTAL,
		O.TAX1_DESC, O.TAX2_DESC, O.TAX3_DESC, O.TAX4_DESC, O.SUBTOTAL1, O.SUBTOTAL2, O.SUBTOTAL3, O.SUBTOTAL4
		FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE A.MYID=O.MYID AND O.OFFERID=$offerID");

	// If an error has occurred, display the error message
	//
	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$Print_Company_Name = $f['PRINT_NAME'];
			$Date = $f['OFFER_DATE'];
			$ID = $f['OFFERID'];
			$CreatedBy = $f['CREATEDBY'];
			$status = $f['STATUS'];
			$MYID = $f['MYID'];
			$TITLE = $f['TITLE'];
			$PREFIX = $f['PREFIX'];
			$FIRSTNAME = $f['FIRSTNAME'];
			$LASTNAME = $f['LASTNAME'];
			$COMPANY = $f['COMPANY'];
			$ADDRESS = $f['ADDRESS'];
			$CITY = $f['CITY'];
			$POSTALCODE = $f['POSTALCODE'];
			$COUNTRY = $f['COUNTRY'];
			$METHOD_OF_PAY = $f['METHOD_OF_PAY'];
			$METHOD_OF_PAY_DATE = $f['METHOD_OF_PAY_DATE'];
			$TOTAL = $f['TOTAL_AMOUNT'];
			$STATUS = $offer_status[$status];
			$MESSAGEID = $f['MESSAGE_DESC'];
		}
}

$PrintD = Print_Date($Date);

if(isset($Type) && $Type == 'Offer')
{
	$Subject = "$a[offer] - $a[offer_number]: $a[offer_initials]-$PrintD-$ID, $a[customer_no]: $MYID, $a[date_text]: $Date";
}
else
{
	if($STATUS != '3')
	{
		$query3 = "UPDATE {$TBLName}offer SET STATUS='2', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE OFFERID=$offerID";
		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}
	}
	$Subject = "$a[order] - $a[order_number]: $a[order_initials]-$PrintD-$ID, $a[customer_no]: $MYID, $a[date_text]: $Date";
}

if(isset($tmpPos) && $tmpPos == '1')
{
	$posquery = $db->GetAll("SELECT P.POSITIONID, P.POS_NAME, T.USERNAME, T.POSITIONID, T.POS_DESC, T.POS_QUANTITY, T.POS_PRICE, T.TAX, T.TAX_DIVIDE, T.TAX_MULTI, T.TAX_DESC, T.POS_GROUP, T.TMP_OFFERID FROM {$TBLName}article AS P, {$TBLName}tmp_offer AS T WHERE P.POSITIONID=T.POSITIONID AND T.USERNAME='$_SESSION[Username]' ORDER BY T.POS_GROUP ASC, T.POS_DESC ASC");
}
else
{
	$posquery = $db->GetAll("SELECT P.POSITIONID, P.POS_NAME, V.POSITIONID, V.POS_DESC,
	V.POS_QUANTITY, V.POS_PRICE, V.OFFERID, V.TAX, V.TAX_DIVIDE, V.TAX_MULTI, V.TAX_DESC, V.POS_GROUP FROM {$TBLName}article AS P, {$TBLName}offerpos AS V WHERE P.POSITIONID=V.POSITIONID AND V.OFFERID=$offerID ORDER BY V.POS_GROUP ASC, V.POS_DESC ASC");
}

if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Username'] != $CreatedBy)
{
	$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['logoutid'] = "5";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	require_once('../include/pdf.inc.php');
}

?>
