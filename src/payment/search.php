<?php

/*
	search.php

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

$PaymentDate = date('d.m.Y');
$smarty->assign("PAYMENT_DATE","$PaymentDate");

$smarty->assign("Title","$a[payment] - $a[search]");
$smarty->assign("DateFrom","$a[date_from]");
$smarty->assign("DateTill","$a[date_till]");
$smarty->assign("Payment_No","$a[payment_number]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("Invoice_No","$a[invoice_number]");
$smarty->assign("Customer","$a[customer]");
$smarty->assign("CustMethodOfPayment","$a[cust_method_of_payment]");
$smarty->assign("Card_Number","$a[card_number]");
$smarty->assign("Valid_Thru","$a[valid_thru]");
$smarty->assign("Select_All","$a[select_all]");

// Database connection
//
DBConnect();

$smarty->assign("Currency","$CompanyCurrency");

// Get the method of payment from database
//
$query = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay ORDER BY DESCRIPTION ASC");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $result)
	{
		$MethodOfPayData[] = $result;
	}

	if(isset($MethodOfPayData))
		$smarty->assign("MethodOfPayData",$MethodOfPayData);

$smarty->display('payment/search.tpl');

?>
