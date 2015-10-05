<?php

/*
	edit.php

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

if(!is_numeric($offerID) || $offerID <= 0 )
{
	die(header("Location: $web"));
}

if(!isset($myID) || !is_numeric($myID) || $myID <= 0 )
{
	$myID = "";
}

if(isset($infoID) && $infoID == '9')
{
	$Searchstring = "&amp;OfferID1=$OfferID1&amp;CustomerID1=$CustomerID1&amp;DateFrom1=$DateFrom1&amp;DateTill1=$DateTill1&amp;Total1=$Total1&amp;Customer1=$Customer1";
	$smarty->assign("Searchstring","$Searchstring");
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[offer] - $a[edit]");
$smarty->assign("Print","$a[print]");
$smarty->assign("Print_Offer","$a[print_offer]");

$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("Find_Customer","$a[find_customer]");
$smarty->assign("Choose_Customer","$a[choose_customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Date_Till","$a[date_till]");

$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("OfferInitials","$a[offer_initials]");
$smarty->assign("CustomerNoInitials","$a[customer_no_initials]");
$smarty->assign("Offer_Amount","$a[offer_amount]");

$smarty->assign("Offer_Tax1","$a[offer_tax1]");
$smarty->assign("Offer_Tax2","$a[offer_tax2]");
$smarty->assign("Offer_Tax3","$a[offer_tax3]");
$smarty->assign("Offer_Subtotal","$a[offer_subtotal]");
$smarty->assign("PositionNew","$a[pos_new]");
$smarty->assign("PositionName","$a[pos_name]");
$smarty->assign("PositionText","$a[pos_text]");
$smarty->assign("PositionQuantity","$a[pos_quantity]");
$smarty->assign("PositionPrice","$a[pos_price]");
$smarty->assign("PositionAmount","$a[pos_amount]");
$smarty->assign("Offer_Note","$a[offer] - $a[note]");
$smarty->assign("Change_Offer","$a[change_offer]");
$smarty->assign("Change","$a[change]");
$smarty->assign("Choose_Message","$a[choose_message]");
$smarty->assign("Choose","$a[choose]");
$smarty->assign("ChangeEntry","$a[entry_changed]");
$smarty->assign("Entry_Canceled","$a[entry_canceled]");

// Database connection
//
DBConnect();

if(!isset($tmpID))
{
	$db->Execute("DELETE FROM {$TBLName}tmp_offer WHERE USERNAME='$_SESSION[Username]'");

	$query = $db->Execute("SELECT OFFERPOSID, MYID, OFFERID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE FROM {$TBLName}offerpos WHERE OFFERID=$offerID ORDER BY POS_GROUP ASC, OFFERPOSID ASC");

	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
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

			$query1 = "INSERT INTO {$TBLName}tmp_offer (TMP_OFFERID, MYID, OFFERID, POSITIONID, USERNAME, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_MULTI, TAX_DIVIDE, TAX_DESC)";
			$query1 .= "VALUES (NULL, '$myID', '$offerID', '$PosID', '$_SESSION[Username]', '$Pos_Desc', '$Pos_Quantity', '$Pos_Price', '$Pos_Group', '$Tax', '$Tax_Multi', '$Tax_Divide', '$Tax_Desc')";

			if ($db->Execute($query1) === false)
			{
				die($db->ErrorMsg());
			}
		}
}

$query1 = $db->Execute("SELECT MYID, OFFERID FROM {$TBLName}offer WHERE OFFERID=$offerID");

if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $f)
	{
		if(empty($myID))
		{
			$myID = $f['MYID'];
		}
		else
		{
			$myID = $myID;
		}
	}

// Get company data from company_settings.inc.php
//
$smarty->assign("Offer_Currency",$CompanyCurrency);
$smarty->assign("Country",$CompanyCountry);
$smarty->assign("TaxFree",$TaxFree);

// Get Offer Information
//
$query2 = $db->Execute("SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME,
	A.CITY, A.COUNTRY, A.METHODOFPAY, A.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE, O.OFFERID, O.TOTAL_AMOUNT, O.MYID,
	O.CREATEDBY, O.STATUS, O.MESSAGEID, O.METHODOFPAYID, O.METHOD_OF_PAY, DATE_FORMAT(O.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE,
	O.TAX1_TOTAL, O.TAX2_TOTAL, O.TAX3_TOTAL, O.TAX4_TOTAL, O.TAX1_DESC, O.TAX2_DESC, O.TAX3_DESC, O.TAX4_DESC, O.SUBTOTAL1, O.SUBTOTAL2, O.SUBTOTAL3, O.SUBTOTAL4, O.NOTE,
	O.CANCELED FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE A.MYID=$myID AND O.OFFERID=$offerID");

	foreach($query2 as $f)
	{
		if(empty($OfferDate))
		{
			$OfferDate = $f['OFFER_DATE'];
			$smarty->assign("OFFER_DATE",$OfferDate);
		}
		else
		{
			$OfferDate = $OfferDate;
			$smarty->assign("OFFER_DATE",$OfferDate);
		}
		$CreatedBy = $f['CREATEDBY'];
		if(empty($myID))
		{
			$smarty->assign("MYID",$f['MYID']);
		}
		else
		{
			$smarty->assign("MYID",$myID);
		}
		$smarty->assign("TITLE",$f['TITLE']);
		$smarty->assign("PREFIX",$f['PREFIX']);
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("ADDRESS",$f['ADDRESS']);
		$smarty->assign("CITY",$f['CITY']);
		$smarty->assign("POSTALCODE",$f['POSTALCODE']);
		$smarty->assign("COUNTRY",$f['COUNTRY']);
		$smarty->assign("PRINT_NAME",$f['PRINT_NAME']);
		$smarty->assign("CANCELED",$f['CANCELED']);
		$smarty->assign("STATUS",$f['STATUS']);
		if(empty($MethodOfPayment))
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$f['METHODOFPAYID']);
		}
		else
		{
			$smarty->assign("NR_METHOD_OF_PAYMENT",$MethodOfPayment);
		}
		if(empty($MethodOfPaymentDate))
		{
			$smarty->assign("METHOD_OF_PAYMENT_DATE",$f['METHOD_OF_PAY_DATE']);
		}
		else
		{
			$smarty->assign("METHOD_OF_PAYMENT_DATE",$MethodOfPaymentDate);
		}
		if(!isset($messageID))
		{
			$smarty->assign("MESSAGEID",$f['MESSAGEID']);
		}
		else
		{
			$smarty->assign("MESSAGEID",$messageID);
		}
		if(empty($Note))
		{
			$smarty->assign("NOTE",$f['NOTE']);
		}
		else
		{
			$smarty->assign("NOTE",$Note);
		}
	}
$PrintD = Print_Date($OfferDate);
$smarty->assign("PrintDate",$PrintD.'-'.$offerID);
$smarty->assign("CurrentOfferID","$offerID");
$smarty->assign("CreatedBy","$CreatedBy");

$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, T.USERNAME, T.POSITIONID, T.POS_DESC, T.POS_QUANTITY, T.POS_PRICE, T.OFFERID, T.TMP_OFFERID, T.TAX, T.TAX_DIVIDE, T.TAX_MULTI, T.TAX_DESC, T.POS_GROUP FROM {$TBLName}article AS P, {$TBLName}tmp_offer AS T WHERE P.POSITIONID=T.POSITIONID AND T.OFFERID=$offerID ORDER BY T.POS_GROUP ASC, T.POS_DESC ASC");
$numrows = $posquery->RecordCount();

// Calculate positions
//
require_once('../include/pos.inc.php');

// Get the first entry from table 'offer'
//
$query4 = $db->GetRow("SELECT MIN(OFFERID) AS MIN_OFFERID FROM {$TBLName}offer");
if (!$query4)
	print($db->ErrorMsg());
else
	$minOfferID = $query4['MIN_OFFERID'];
	$smarty->assign("MinOfferID","$minOfferID");

// Get the last entry from table 'offer'
//
$query5 = $db->GetRow("SELECT MAX(OFFERID) AS MAX_OFFERID FROM {$TBLName}offer");
if (!$query5)
	print($db->ErrorMsg());
else
	$maxOfferID = $query5['MAX_OFFERID'];

	$smarty->assign("MaxOfferID","$maxOfferID");

// If we are not on first page then display
// first page, previous page link
//
if ($offerID > $minOfferID)
{
	$CurrentOfferID = $offerID - 1;
	$smarty->assign('PrevOfferID', "$CurrentOfferID");
}

// If we are not on the last page then display
// next page, last page link
//
if ($offerID < $maxOfferID)
{
	$CurrentOfferID = $offerID + 1;
	$smarty->assign('NextOfferID', "$CurrentOfferID");
}

// Get the method of payment from database
//
$query6 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

// Get the message from database
//
$query7 = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if (!$query6 && !$query7)
	print $db->ErrorMsg();
else
	foreach($query6 as $result6)
	{
		$PaymentData[] = $result6;
	}

	if(isset($PaymentData))
		$smarty->assign("PaymentData",$PaymentData);

	foreach($query7 as $result7)
	{
		$MessageData[] = $result7;
	}

	if(isset($MessageData))
		$smarty->assign("MessageData",$MessageData);

	if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Usergroup1'] != $admingroup_1 && $_SESSION['Usergroup2'] != $admingroup_2 && $_SESSION['Username'] != $CreatedBy)
	{
		$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		$_SESSION['logoutid'] = "5";
		Header("Location: $web/login/sustart.php?$sessname=$sessid");
	}
	else
	{
		// Save last page visited by user
		//
		UserSite();
		$smarty->display('offer/edit.tpl');
	}

?>
