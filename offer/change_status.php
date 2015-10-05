<?php

/*
	change_status.php

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

if(!is_numeric($offerID) || $offerID <= 0 )
{
	die(header("Location: $web"));
}

// Assign needed text from selected language file
//
$smarty->assign("Title","$a[offer] - $a[change_status]");
$smarty->assign("Offer_Status","$a[status]");
$smarty->assign("Change_Status","$a[change_status]");
$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("OfferInitials","$a[offer_initials]");
$smarty->assign("First_Name","$a[firstname]");
$smarty->assign("Last_Name","$a[lastname]");
$smarty->assign("Company_Name","$a[company]");
$smarty->assign("Customer_No","$a[customer_no]");

// Database connection
//
DBConnect();

// Get Offer Information
//
$query = $db->Execute("SELECT A.FIRSTNAME, A.LASTNAME, A.COMPANY, A.MYID, O.OFFERID, O.MYID, DATE_FORMAT(O.OFFER_DATE,'%d.%m.%Y') AS OFFER_DATE,
	O.CREATEDBY, O.STATUS FROM {$TBLName}addressbook AS A, {$TBLName}offer AS O WHERE CANCELED=2 AND A.MYID=O.MYID AND O.OFFERID=$offerID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f) {
		$OfferDate = $f['OFFER_DATE'];
		$OfferID = $f['OFFERID'];
		$smarty->assign("MYID",$f['MYID']);
		$smarty->assign("FIRSTNAME",$f['FIRSTNAME']);
		$smarty->assign("LASTNAME",$f['LASTNAME']);
		$smarty->assign("COMPANY",$f['COMPANY']);
		$smarty->assign("OFFERID",$OfferID);
		$smarty->assign("CREATED",$f['CREATEDBY']);
		if(empty($OfferStatus))
		{
			$smarty->assign("STATUS",$f['STATUS']);
		}
		else
		{
			$smarty->assign("STATUS",$OfferStatus);
		}
	}

$PrintD = Print_Date($OfferDate);
$smarty->assign("PrintDate",$PrintD.'-'.$OfferID);

// Put offer status in $change_status
//
$offerstatus = asort($offer_status);
$smarty->assign("change_status",array($offer_status));

$smarty->display('offer/change_status.tpl');

?>
