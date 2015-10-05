<?php

/*
	newf.php

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
require_once("../include/smarty.inc.php");

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

if(!isset($offerID) || !is_numeric($offerID) || $offerID <= 0 )
{
	$offerID = "";
}

if(isset($OfferAmount))
	$OfferAmount = FormatDBNumber($OfferAmount);

if(isset($Tax1Total))
	$Tax1Total = FormatDBNumber($Tax1Total);
if(isset($Tax2Total))
	$Tax2Total = FormatDBNumber($Tax2Total);
if(isset($Tax3Total))
	$Tax3Total = FormatDBNumber($Tax3Total);
if(isset($Tax4Total))
	$Tax4Total = FormatDBNumber($Tax4Total);

if(isset($OfferSubtotal1))
	$OfferSubtotal1 = FormatDBNumber($OfferSubtotal1);
if(isset($OfferSubtotal2))
	$OfferSubtotal2 = FormatDBNumber($OfferSubtotal2);
if(isset($OfferSubtotal3))
	$OfferSubtotal3 = FormatDBNumber($OfferSubtotal3);
if(isset($OfferSubtotal4))
	$OfferSubtotal4 = FormatDBNumber($OfferSubtotal4);

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if(!empty($OfferDate))
	list($day, $month, $year) = explode(".", $OfferDate);
if(!empty($MethodOfPaymentDate))
	list($day1, $month1, $year1) = explode(".", $MethodOfPaymentDate);

if (empty($myID))
{
	$smarty->assign("FieldError","$a[customer] - $a[field_error]");
	UserInput("New.Customer");
	$smarty->display('offer/newf.tpl');
}
else if (empty($OfferDate) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("OfferD.OfferDate");
	$smarty->display('offer/newf.tpl');
}
else if(!empty($MethodOfPaymentDate) && !checkdate($month1, $day1, $year1))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("MethodOfPayD.MethodOfPaymentDate");
	$smarty->display('offer/newf.tpl');
}
else if ($OfferAmount <= 0)
{
	$smarty->assign("FieldError","$a[offer_amount] - $a[field_error]");
	UserInput("");
	$smarty->display('offer/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	$OfferDate = German_Mysql_Date($OfferDate);
	$MethodOfPaymentDate = German_Mysql_Date($MethodOfPaymentDate);

	$query = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message WHERE MESSAGEID=$messageID");

	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$Message_Desc = $f['DESCRIPTION'];
		}

	$query1 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

	if (!$query1)
		print($db->ErrorMsg());
	else
		foreach($query1 as $f1)
		{
			$MethodOfPayment_Desc = $f1['DESCRIPTION'];
		}

	$query2 = "INSERT INTO {$TBLName}offer (OFFERID, MYID, INVOICEID, OFFER_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, STATUS, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX4_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, TAX4_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, SUBTOTAL4, TOTAL_AMOUNT, NOTE, ORDER_PRINTED, ORDER_MAILED, OFFER_PRINTED, OFFER_MAILED, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
	$query2 .= "VALUES (NULL, '$myID', '', '$OfferDate', '$messageID', '$Message_Desc', '$MethodOfPayment', '$MethodOfPayment_Desc', '$MethodOfPaymentDate', '1', '$Tax1Total', '$Tax2Total', '$Tax3Total', '$Tax4Total', '$Tax1Desc', '$Tax2Desc', '$Tax3Desc', '$Tax4Desc', '$OfferSubtotal1', '$OfferSubtotal2', '$OfferSubtotal3', '$OfferSubtotal4', '$OfferAmount', '$Note', '2', '2', '2', '2', '2', '$_SESSION[Username]','$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";

	if ($db->Execute($query2) === false)
	{
		die($db->ErrorMsg());
	}

	// Get the last entry from 'offer'
	//
	$query3 = $db->GetRow("SELECT MAX(OFFERID) AS MAX_OFFERID FROM {$TBLName}offer");
	if (!$query3)
		print($db->ErrorMsg());
	else
		$offerID = $query3['MAX_OFFERID'];

	$query4 = $db->Execute("SELECT POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC FROM {$TBLName}tmp_offer WHERE USERNAME='$_SESSION[Username]' ORDER BY TMP_OFFERID");

	if (!$query4)
		print($db->ErrorMsg());
	else
		foreach($query4 as $f)
		{
			$PosID = $f['POSITIONID'];
			$Pos_Desc = $f['POS_DESC'];
			$Pos_Quantity = $f['POS_QUANTITY'];
			$Pos_Price = $f['POS_PRICE'];
			$Pos_Group = $f['POS_GROUP'];
			$Tax = $f['TAX'];
			$Tax_Multi = $f['TAX_MULTI'];
			$Tax_Divide = $f['TAX_DIVIDE'];
			$Tax_Desc = $f['TAX_DESC'];

			$query5 = "INSERT INTO {$TBLName}offerpos (OFFERPOSID, OFFERID, MYID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)";
			$query5 .= "VALUES (NULL, '$offerID', '$myID', '$PosID', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Desc', '$Tax_Multi', '$Tax_Divide')";

			if ($db->Execute($query5) === false)
			{
				die($db->ErrorMsg());
			}

			$_SESSION['NewID'] = "1";
		}

$db->Execute("DELETE FROM {$TBLName}tmp_offer WHERE USERNAME='$_SESSION[Username]'");
Header("Location: $web/offer/new.php?offerID=$offerID&$sessname=$sessid");
}

?>
