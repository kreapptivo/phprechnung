<?php

/*
	new.php

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

if(empty($OfferDate))
{
	$OfferDate = date('d.m.Y');
}

if(!isset($offerID) || !is_numeric($offerID) || $offerID <= 0 )
{
	$offerID = "";
}

// Assign needed text from language file
//
$smarty->assign("Title","$a[offer] - $a[new]");
$smarty->assign("Print","$a[print]");
$smarty->assign("OfferNo","$a[offer_number]");
$smarty->assign("OfferInitials","$a[offer_initials]");
$smarty->assign("CustomerNoInitials","$a[customer_no_initials]");

$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Issue_Invoice","$a[issue_invoice]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("Find_Customer","$a[find_customer]");
$smarty->assign("Choose_Customer","$a[choose_customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Date_Till","$a[date_till]");
$smarty->assign("Reminder_Days","$a[reminder_days]");

$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("Offer_Amount","$a[offer_amount]");
$smarty->assign("Offer_Status","$a[status]");
$smarty->assign("Print_Offer","$a[print_offer]");
$smarty->assign("Offer_Amount","$a[offer_amount]");
$smarty->assign("Offer_Not_Accepted",$offer_status[1]);
$smarty->assign("Offer_Confirmation",$offer_status[2]);
$smarty->assign("Offer_Invoice",$offer_status[3]);
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
$smarty->assign("Save_Offer","$a[save_offer]");
$smarty->assign("Save","$a[save]");
$smarty->assign("Choose_Message","$a[choose_message]");
$smarty->assign("Choose","$a[choose]");
$smarty->assign("NewEntry","$a[new_entry]");

// Database connection
//
DBConnect();

if(!isset($_REQUEST['tmpID']))
{
	$db->Execute("DELETE FROM {$TBLName}tmp_offer WHERE USERNAME='$_SESSION[Username]'");
}

// Get company data from company_settings.inc.php
//
$smarty->assign("Offer_Currency",$CompanyCurrency);
$smarty->assign("Country",$CompanyCountry);
$smarty->assign("TaxFree",$TaxFree);
$smarty->assign("SALESPRICE",$sales_price[$SalesPrices]);

// Get Customer Information
//
if(!empty($myID) && is_numeric($myID))
{
	$query = $db->Execute("SELECT PREFIX, TITLE, FIRSTNAME, LASTNAME, ADDRESS, COMPANY, POSTALCODE, PRINT_NAME,
		CITY, COUNTRY, METHODOFPAY, MESSAGE, MYID FROM {$TBLName}addressbook WHERE MYID=$myID");

	// If an error has occurred, display the error message
	//
	if (!$query)
		print($db->ErrorMsg());
	else
		foreach($query as $f)
		{
			$smarty->assign("MYID",$f['MYID']);
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
			if(empty($MethodOfPayment))
			{
				$smarty->assign("NR_METHOD_OF_PAYMENT",$f['METHODOFPAY']);
			}
			else
			{
				$smarty->assign("NR_METHOD_OF_PAYMENT",$MethodOfPayment);
			}
			if(empty($messageID))
			{
				$smarty->assign("NR_MESSAGE",$f['MESSAGE']);
			}
			else
			{
				$smarty->assign("NR_MESSAGE",$messageID);
			}
		}
}


// Get the last entry from table 'angebot'
//
$query2 = $db->GetRow("SELECT MAX(OFFERID) AS MAX_OFFERID FROM {$TBLName}offer");
if (!$query2)
	print($db->ErrorMsg());
else
	$OfferID = $query2['MAX_OFFERID'] + 1;

$PrintD = Print_Date($OfferDate);
$smarty->assign("PrintDate",$PrintD.'-'.$OfferID);
$smarty->assign("OfferID","$OfferID");
$smarty->assign("OFFER_DATE",$OfferDate);

$posquery = $db->Execute("SELECT P.POSITIONID, P.POS_NAME, T.USERNAME, T.POSITIONID, T.POS_DESC, T.POS_QUANTITY, T.POS_PRICE, T.TAX, T.TAX_DIVIDE, T.TAX_MULTI, T.TAX_DESC, T.POS_GROUP, T.TMP_OFFERID FROM {$TBLName}article AS P, {$TBLName}tmp_offer AS T WHERE P.POSITIONID=T.POSITIONID ORDER BY T.POS_GROUP ASC, T.POS_DESC ASC");
$numrows = $posquery->RecordCount();

// Calculate positions
//
require_once('../include/pos.inc.php');

// Get the method of payment from database
//
$query5 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");
$query6 = $db->Execute("SELECT MESSAGEID, DESCRIPTION FROM {$TBLName}message ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if (!$query5)
 	print($db->ErrorMsg());
else
	foreach($query5 as $result5)
	{
		$PaymentData[] = $result5;
	}

	if(isset($PaymentData))
		$smarty->assign("PaymentData",$PaymentData);

	foreach($query6 as $result6)
	{
		$MessageData[] = $result6;
	}

	if(isset($MessageData))
		$smarty->assign("MessageData",$MessageData);

$smarty->display('offer/new.tpl');

unset($_SESSION['NewID']);

?>
