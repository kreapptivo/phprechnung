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
UserSite();

// Assign needed text from language file
//
$smarty->assign("Title","$a[offer] - $a[search]");

$smarty->assign("Offer_No","$a[offer_number]");
$smarty->assign("Customer_No","$a[customer_no]");
$smarty->assign("DateFrom","$a[date_from]");
$smarty->assign("DateTill","$a[date_till]");
$smarty->assign("Offer_Amount","$a[offer_amount]");
$smarty->assign("Customer","$a[customer]");

// Get company data from company_settings.inc.php
//
$smarty->assign("CompanyDate",$CompanyDate);
$smarty->assign("CompanyCurrency",$CompanyCurrency);
$smarty->assign("CurrentDate",date('d.m.Y'));

$smarty->display('offer/search.tpl');

?>
