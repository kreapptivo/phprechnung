<?php

/*
	edit_company.php

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

$smarty->assign("Title","$a[settings] - $a[edit] - $a[company_settings]");
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
		COMPANY_FAX, COMPANY_EMAIL, COMPANY_URL, COMPANY_TAXNR, COMPANY_BUSINESS_TAXNR, COMPANY_BANKNAME, COMPANY_BANKACCOUNT, COMPANY_BANKNUMBER, COMPANY_BANKIBAN, COMPANY_BANKBIC, COMPANY_CURRENCY,
		COMPANY_SALESPRICE, TAX_FREE, SETTINGID FROM {$TBLName}setting WHERE SETTINGID=$settingID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$sp = $f['COMPANY_SALESPRICE'];
		if (empty($D_Company_Date))
		{
			$smarty->assign("D_Company_Date",$f['COMPANY_DATE']);
		}
		else
		{
			$smarty->assign("D_Company_Date","$D_Company_Date");
		}
		if (empty($D_Company_Name))
		{
			$smarty->assign("D_Company_Name",$f['COMPANY_NAME']);
		}
		else
		{
			$smarty->assign("D_Company_Name","$D_Company_Name");
		}
		if (empty($D_Company_Address))
		{
			$smarty->assign("D_Company_Address",$f['COMPANY_ADDRESS']);
		}
		else
		{
			$smarty->assign("D_Company_Address","$D_Company_Address");
		}
		if (empty($D_Company_Postal))
		{
			$smarty->assign("D_Company_Postal",$f['COMPANY_POSTAL']);
		}
		else
		{
			$smarty->assign("D_Company_Postal","$D_Company_Postal");
		}
		if (empty($D_Company_City))
		{
			$smarty->assign("D_Company_City",$f['COMPANY_CITY']);
		}
		else
		{
			$smarty->assign("D_Company_City","$D_Company_City");
		}
		if (empty($D_Company_Country))
		{
			$smarty->assign("D_Company_Country",$f['COMPANY_COUNTRY']);
		}
		else
		{
			$smarty->assign("D_Company_Country","$D_Company_Country");
		}
		if (empty($D_Company_Phone))
		{
			$smarty->assign("D_Company_Phone",$f['COMPANY_PHONE']);
		}
		else
		{
			$smarty->assign("D_Company_Phone","$D_Company_Phone");
		}
		if (empty($D_Company_Fax))
		{
			$smarty->assign("D_Company_Fax",$f['COMPANY_FAX']);
		}
		else
		{
			$smarty->assign("D_Company_Fax","$D_Company_Fax");
		}
		if (empty($D_Company_Email))
		{
			$smarty->assign("D_Company_Email",$f['COMPANY_EMAIL']);
		}
		else
		{
			$smarty->assign("D_Company_Email","$D_Company_Email");
		}
		if (empty($D_Company_URL))
		{
			$smarty->assign("D_Company_URL",$f['COMPANY_URL']);
		}
		else
		{
			$smarty->assign("D_Company_URL","$D_Company_URL");
		}
		if (empty($D_Company_Currency))
		{
			$smarty->assign("D_Company_Currency",$f['COMPANY_CURRENCY']);
		}
		else
		{
			$smarty->assign("D_Company_Currency","$D_Company_Currency");
		}
		if (empty($D_Company_Tax_Free))
		{
			$smarty->assign("D_Company_Tax_Free",$f['TAX_FREE']);
		}
		else
		{
			$smarty->assign("D_Company_Tax_Free","$D_Company_Tax_Free");
		}
		if (empty($D_Sales_Prices))
		{
			$smarty->assign("D_Sales_Prices",$f['COMPANY_SALESPRICE']);
		}
		else
		{
			$smarty->assign("D_Sales_Prices","$D_Sales_Prices");
		}
		if (empty($D_Company_Taxnr))
		{
			$smarty->assign("D_Company_Taxnr",$f['COMPANY_TAXNR']);
		}
		else
		{
			$smarty->assign("D_Company_Taxnr","$D_Company_Taxnr");
		}
		if (empty($D_Business_Taxnr))
		{
			$smarty->assign("D_Business_Taxnr",$f['COMPANY_BUSINESS_TAXNR']);
		}
		else
		{
			$smarty->assign("D_Business_Taxnr","$D_Business_Taxnr");
		}
		if (empty($D_Bank_Name))
		{
			$smarty->assign("D_Bank_Name",$f['COMPANY_BANKNAME']);
		}
		else
		{
			$smarty->assign("D_Bank_Name","$D_Bank_Name");
		}
		if (empty($D_Bank_Account))
		{
			$smarty->assign("D_Bank_Account",$f['COMPANY_BANKACCOUNT']);
		}
		else
		{
			$smarty->assign("D_Bank_Account","$D_Bank_Account");
		}
		if (empty($D_Bank_Number))
		{
			$smarty->assign("D_Bank_Number",$f['COMPANY_BANKNUMBER']);
		}
		else
		{
			$smarty->assign("D_Bank_Number","$D_Bank_Number");
		}
		if (empty($D_Bank_IBAN))
		{
			$smarty->assign("D_Bank_IBAN",$f['COMPANY_BANKIBAN']);
		}
		else
		{
			$smarty->assign("D_Bank_IBAN","$D_Bank_IBAN");
		}
		if (empty($D_Bank_BIC))
		{
			$smarty->assign("D_Bank_BIC",$f['COMPANY_BANKBIC']);
		}
		else
		{
			$smarty->assign("D_Bank_BIC","$D_Bank_BIC");
		}
	}

// Check if there are any saved invoices
//
$query1 = $db->Execute("SELECT INVOICEID FROM {$TBLName}invoice");
$numrows1 = $query1->RowCount();
if ($numrows1)
{
	$smarty->assign("InvoiceAvailable","1");
	$smarty->assign("DisplaySalesPrice","$sales_price[$sp]");
}

// Save options in $net_gross_values
//
$smarty->assign("sales_price_values",array($sales_price));

$smarty->assign("choice_yes_no",array($choice_yes_no));

$smarty->display('config/edit_company.tpl');

?>
