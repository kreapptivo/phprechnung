<?php

/*
	info_company.php

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

$smarty->assign("Title","$a[settings] - $a[info] - $a[company_settings]");
$smarty->assign("Basic_Settings","$a[basic_settings]");
$smarty->assign("Company_Settings","$a[company_settings]");
$smarty->assign("PDF_Settings","$a[pdf_settings]");
$smarty->assign("Company_Name","$a[company_name]");
$smarty->assign("Company_Address","$a[company_address]");
$smarty->assign("Company_Postal","$a[company_postal]");
$smarty->assign("Company_City","$a[company_city]");
$smarty->assign("Company_Country","$a[company_country]");
$smarty->assign("Company_Phone","$a[company_phone]");
$smarty->assign("Company_Fax","$a[company_fax]");
$smarty->assign("Company_Email","$a[company_email]");
$smarty->assign("Company_URL","$a[company_url]");
$smarty->assign("Company_Currency","$a[company_currency]");
$smarty->assign("Company_Tax_Free","$a[company_tax_free]");
$smarty->assign("Sales_Prices","$a[sales_prices]");
$smarty->assign("Company_Taxnr","$a[company_taxnr]");
$smarty->assign("Business_Taxnr","$a[business_taxnr]");
$smarty->assign("Bank_Name","$a[bank_name]");
$smarty->assign("Bank_Account","$a[bank_account]");
$smarty->assign("Bank_Number","$a[bank_number]");
$smarty->assign("Bank_IBAN","$a[bank_iban]");
$smarty->assign("Bank_BIC","$a[bank_bic]");

// Database connection
//
DBConnect();

// Get company related entrys from setting table
//
$query = $db->Execute("SELECT DATE_FORMAT(COMPANY_DATE,'%d.%m.%Y') AS COMPANY_DATE, COMPANY_NAME, COMPANY_ADDRESS, COMPANY_POSTAL, COMPANY_CITY, COMPANY_COUNTRY, COMPANY_PHONE,
		COMPANY_FAX, COMPANY_EMAIL, COMPANY_URL, COMPANY_TAXNR, COMPANY_BUSINESS_TAXNR, COMPANY_BANKNAME, COMPANY_BANKACCOUNT, COMPANY_BANKNUMBER, COMPANY_BANKIBAN,
		COMPANY_BANKBIC, COMPANY_CURRENCY, COMPANY_SALESPRICE, TAX_FREE, SETTINGID FROM {$TBLName}setting WHERE SETTINGID=$settingID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$sp = $f['COMPANY_SALESPRICE'];
		$ctf = $f['TAX_FREE'];
		$smarty->assign("CompanyDate","$f[COMPANY_DATE]");
		$smarty->assign("CompanyName","$f[COMPANY_NAME]");
		$smarty->assign("CompanyAddress","$f[COMPANY_ADDRESS]");
		$smarty->assign("CompanyPostal","$f[COMPANY_POSTAL]");
		$smarty->assign("CompanyCity","$f[COMPANY_CITY]");
		$smarty->assign("CompanyCountry","$f[COMPANY_COUNTRY]");
		$smarty->assign("CompanyPhone","$f[COMPANY_PHONE]");
		$smarty->assign("CompanyFax","$f[COMPANY_FAX]");
		$smarty->assign("CompanyEmail","$f[COMPANY_EMAIL]");
		$smarty->assign("CompanyURL","$f[COMPANY_URL]");
		$smarty->assign("CompanyCurrency","$f[COMPANY_CURRENCY]");
		$smarty->assign("CompanyTaxFree","$choice_yes_no[$ctf]");
		$smarty->assign("SalesPrices","$sales_price[$sp]");
		$smarty->assign("CompanyTaxnr","$f[COMPANY_TAXNR]");
		$smarty->assign("BusinessTaxnr","$f[COMPANY_BUSINESS_TAXNR]");
		$smarty->assign("BankName","$f[COMPANY_BANKNAME]");
		$smarty->assign("BankAccount","$f[COMPANY_BANKACCOUNT]");
		$smarty->assign("BankNumber","$f[COMPANY_BANKNUMBER]");
		$smarty->assign("BankIBAN","$f[COMPANY_BANKIBAN]");
		$smarty->assign("BankBIC","$f[COMPANY_BANKBIC]");
	}

$smarty->display('config/info_company.tpl');

?>
