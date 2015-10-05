<?php

/*
	editf_company.php

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
CheckAdminGroup1();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($settingID) || $settingID <= 0 )
{
	die(header("Location: $web"));
}

// Database connection
//
DBConnect();

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark","$mark");
}

if(!empty($D_Company_Date))
	list($day, $month, $year) = explode(".", $D_Company_Date);

if(empty($D_Company_Date) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("D_Company_Date");
}
else if (empty($D_Company_Name))
{
	$smarty->assign("FieldError","$a[company_name] - $a[field_error]");
	UserInput("D_Company_Name");
}
else if (empty($D_Company_Address))
{
	$smarty->assign("FieldError","$a[company_address] - $a[field_error]");
	UserInput("D_Company_Address");
}
else if (empty($D_Company_Postal))
{
	$smarty->assign("FieldError","$a[company_postal] - $a[field_error]");
	UserInput("D_Company_Postal");
}
else if (empty($D_Company_City))
{
	$smarty->assign("FieldError","$a[company_city] - $a[field_error]");
	UserInput("D_Company_City");
}
else if (empty($D_Company_Country))
{
	$smarty->assign("FieldError","$a[company_country] - $a[field_error]");
	UserInput("D_Company_Country");
}
else if (empty($D_Company_Currency))
{
	$smarty->assign("FieldError","$a[company_currency] - $a[field_error]");
	UserInput("D_Company_Currency");
}
else
{
	$D_Company_Date = German_Mysql_Date($D_Company_Date);
	if(empty($D_Sales_Prices))
	{
		$query = $db->Execute("UPDATE {$TBLName}setting SET COMPANY_DATE='$D_Company_Date', COMPANY_NAME='$D_Company_Name', COMPANY_ADDRESS='$D_Company_Address', COMPANY_POSTAL='$D_Company_Postal', COMPANY_CITY='$D_Company_City', COMPANY_COUNTRY='$D_Company_Country', COMPANY_PHONE='$D_Company_Phone', COMPANY_FAX='$D_Company_Fax', COMPANY_EMAIL='$D_Company_Email', COMPANY_URL='$D_Company_URL', COMPANY_CURRENCY='$D_Company_Currency', TAX_FREE='$D_Company_Tax_Free', COMPANY_TAXNR='$D_Company_Taxnr', COMPANY_BUSINESS_TAXNR='$D_Business_Taxnr', COMPANY_BANKNAME='$D_Bank_Name', COMPANY_BANKACCOUNT='$D_Bank_Account', COMPANY_BANKNUMBER='$D_Bank_Number', COMPANY_BANKIBAN='$D_Bank_IBAN', COMPANY_BANKBIC='$D_Bank_BIC', MODIFIEDBY='$_SESSION[Username]' WHERE SETTINGID=$settingID");
	}
	else
	{
		$query = $db->Execute("UPDATE {$TBLName}setting SET COMPANY_DATE='$D_Company_Date', COMPANY_NAME='$D_Company_Name', COMPANY_ADDRESS='$D_Company_Address', COMPANY_POSTAL='$D_Company_Postal', COMPANY_CITY='$D_Company_City', COMPANY_COUNTRY='$D_Company_Country', COMPANY_PHONE='$D_Company_Phone', COMPANY_FAX='$D_Company_Fax', COMPANY_EMAIL='$D_Company_Email', COMPANY_URL='$D_Company_URL', COMPANY_CURRENCY='$D_Company_Currency', COMPANY_SALESPRICE='$D_Sales_Prices', TAX_FREE='$D_Company_Tax_Free', COMPANY_TAXNR='$D_Company_Taxnr', COMPANY_BUSINESS_TAXNR='$D_Business_Taxnr', COMPANY_BANKNAME='$D_Bank_Name', COMPANY_BANKACCOUNT='$D_Bank_Account', COMPANY_BANKNUMBER='$D_Bank_Number', COMPANY_BANKIBAN='$D_Bank_IBAN', COMPANY_BANKBIC='$D_Bank_BIC', MODIFIEDBY='$_SESSION[Username]' WHERE SETTINGID=$settingID");
	}
	Header("Location: $web/config/list.php?page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$settingID");
}

$smarty->display('config/editf_company.tpl');

?>
