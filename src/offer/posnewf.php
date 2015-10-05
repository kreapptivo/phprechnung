<?php

/*
	posnewf.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

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

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
}

if(!isset($PosID) || !is_numeric($PosID) || $PosID <= 0 )
{
	$PosID = "";
}

if(!isset($offerID) || !is_numeric($offerID) || $offerID <= 0 )
{
	$offerID = "";
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

if(isset($Pos_Price))
	$Pos_Price = FormatDBNumber($Pos_Price);

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&OfferID1=$OfferID1&CustomerID1=$CustomerID1&DateFrom1=$DateFrom1&DateTill1=$DateTill1&Total1=$Total1&Customer1=$Customer1";
}
else
{
	$Searchstring = "";
}
// Database connection
//
DBConnect();

$query = "INSERT INTO {$TBLName}tmp_offer (TMP_OFFERID, MYID, OFFERID, POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC)";
$query .= "VALUES (NULL, '$myID', '$offerID', '$PosID', '$_SESSION[Username]', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Pos_Tax', '$Pos_Tax_Multi', '$Pos_Tax_Divide', '$Pos_Tax_Desc')";

if ($db->Execute($query) === false)
{
	die($db->ErrorMsg());
}

if(isset($_POST['Next']))
{
	Header("Location: $web/offer/posnew.php?page=$page&myID=$myID&offerID=$offerID&infoID=$infoID&messageID=$messageID&OfferDate=$OfferDate&OfferStatus=$OfferStatus&MethodOfPayment=$MethodOfPayment&MethodOfPaymentDate=$MethodOfPaymentDate&Note=$Note&Canceled=$Canceled&Order=$Order&Sort=$Sort$Searchstring&$sessname=$sessid");
}
else
{
	if(!empty($offerID))
	{
		Header("Location: $web/offer/edit.php?page=$page&myID=$myID&offerID=$offerID&infoID=$infoID&messageID=$messageID&OfferDate=$OfferDate&OfferStatus=$OfferStatus&MethodOfPayment=$MethodOfPayment&MethodOfPaymentDate=$MethodOfPaymentDate&Note=$Note&Canceled=$Canceled&tmpID=1&Order=$Order&Sort=$Sort$Searchstring&$sessname=$sessid");
	}
	else
	{
		Header("Location: $web/offer/new.php?myID=$myID&offerID=$offerID&infoID=$infoID&messageID=$messageID&OfferDate=$OfferDate&OfferStatus=$OfferStatus&MethodOfPayment=$MethodOfPayment&MethodOfPaymentDate=$MethodOfPaymentDate&Note=$Note&Canceled=$Canceled&tmpID=1&$sessname=$sessid");
	}
}

?>
