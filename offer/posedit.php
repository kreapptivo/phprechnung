<?php

/*
	posedit.php

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

if(!isset($posID) || !is_numeric($posID) || $posID <= 0 )
{
	$posID = "";
}

if(!isset($tmpPosID) || !is_numeric($tmpPosID) || $tmpPosID <= 0 )
{
	$tmpPosID = "";
}

if(!isset($offerID) || !is_numeric($offerID) || $offerID <= 0 )
{
	$offerID = "";
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

$smarty->assign("PosID",$posID);

if(isset($MethodOfPayment))
	$smarty->assign("NR_METHOD_OF_PAYMENT","$MethodOfPayment");


// Assign needed text from language file
//
$smarty->assign("Title","$a[position] - $a[edit]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionQuantity","$a[pos_quantity]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionChoose","$a[pos_choose]");
$smarty->assign("PositionSearch","$a[pos_search]");

// Database connection
//
DBConnect();

// Get data from company_settings.inc.php
//
$smarty->assign("Offer_Currency",$CompanyCurrency);

if(isset($PosID) && is_numeric($PosID) && !empty($PosID))
{
	$PosID = $PosID;
	$smarty->assign("PosID",$PosID);
	$query1 = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, P.POS_DESC, P.POS_ACTIVE, P.POS_PRICE, P.POS_TAX, P.POS_GROUP, T.TAXID, T.TAX_MULTI, T.TAX_DIVIDE, T.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}tax AS T WHERE P.POS_ACTIVE='1' AND P.POS_TAX=T.TAXID AND P.POSITIONID=$PosID");
}
else
{
	$query1 = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, T.POSITIONID, T.POS_QUANTITY, T.POS_DESC, T.POS_PRICE, T.TAX, T.TAX_MULTI, T.TAX_DIVIDE, T.TAX_DESC, T.POS_GROUP FROM {$TBLName}article AS P, {$TBLName}tmp_offer AS T WHERE T.POSITIONID=P.POSITIONID AND TMP_OFFERID=$tmpPosID");
}

// If an error has occurred, display the error message
//
if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $f)
	{
		$smarty->assign("POSITIONID",$f['POSITIONID']);
		$smarty->assign("POS_NAME",$f['POS_NAME']);
		$smarty->assign("POS_DESC",$f['POS_DESC']);
		$smarty->assign("POS_PRICE",$f['POS_PRICE']);

		if(empty($Pos_Quantity))
		{
			$smarty->assign("POS_QUANTITY",$f['POS_QUANTITY']);
		}
		else
		{
			$smarty->assign("POS_QUANTITY",$Pos_Quantity);
		}
		if(isset($PosID))
		{
			$smarty->assign("POS_TAX",$f['POS_TAX']);
		}
		else
		{
			$smarty->assign("POS_TAX",$f['TAX']);
		}
		$smarty->assign("POS_TAX_MULTI",$f['TAX_MULTI']);
		$smarty->assign("POS_TAX_DIVIDE",$f['TAX_DIVIDE']);
		$smarty->assign("POS_TAX_DESC",$f['TAX_DESC']);
		$smarty->assign("POS_GROUP",$f['POS_GROUP']);
	}

$smarty->display('offer/posedit.tpl');

?>
