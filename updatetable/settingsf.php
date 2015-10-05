<?php
/*
	settingsf.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2008 Edy Corak < phprechnung at ecorak dot net >

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

CheckUser();
CheckAdmin();
CheckSession();

// Database connection
//
DBConnect();

$query = $db->Execute("SELECT * FROM einstellung");

if (!$query)
	print($db->ErrorMsg());
else
	foreach ($query as $f)
	{
		$settingID = $f['EINSTELLUNGID'];
		$CompanyDate = $f['BDATUM'];
		$PrintCompanyData = $f['BDRUCKEN'];
		$PrintPositionName = $f['POSNAME_DRUCKEN'];
		$CompanyLogo = $f['FIRMENLOGO'];
		$CompanyLogoWidth = $f['FIRMENLOGO_BREITE'];
		$CompanyLogoHeight = $f['FIRMENLOGO_HOEHE'];
		$CompanyName = $f['BNAME'];
		$CompanyAddress = $f['BADRESSE'];
		$CompanyPostal = $f['BPLZ'];
		$CompanyCity = $f['BORT'];
		$CompanyCountry = $f['BLAND'];
		$CompanyPhone = $f['BTELEFON'];
		$CompanyFax = $f['BTELEFAX'];
		$CompanyEmail = $f['BEMAIL'];
		$CompanyURL = $f['BURL'];
		$CompanyWAP = $f['BWAP'];
		$EmailInternal = $f['EMAIL_INTERN'];
		$EmailUseSignature = $f['BSIGNATUR'];
		$EmailSignature = $f['SIGNATUR'];
		$CompanyCurrency= $f['WAEHRUNG'];
		$SalesPrices = $f['VERKAUFSPREIS'];
		$CompanyTaxnr = $f['BSTEUERNR'];
		$BusinessTaxnr = $f['BUSTNR'];
		$BankName = $f['BBANKNAME'];
		$BankAccount = $f['BBANKKONTO'];
		$BankNumber = $f['BBANKBLZ'];
		$BankIBAN = $f['BBANKIBAN'];
		$BankBIC = $f['BBANKBIC'];
		$StockActive = $f['POS_LAGER_AKTIV'];
		$Reminder = $f['ERINNERUNG'];
		$ReminderDays = $f['ERINNERUNG_TAGE'];
		$ReminderPrice = $f['MAHNGEBUEHR'];
		$EntrysPerPage = $f['ZEILEN'];
		$SessionSec = $f['SITZUNG'];

		$PDFCompanyLogoWidth = $f['FIRMENLOGO_PDF_BREITE'];
		$PDFCompanyLogoHeight = $f['FIRMENLOGO_PDF_HOEHE'];
		$PDFFont = $f['PDF_SCHRIFT'];
		$PDFText1 = $f['PDF_TEXT_GROESSE1'];
		$PDFText2 = $f['PDF_TEXT_GROESSE2'];
		$PDFText3 = $f['PDF_TYPE_HOEHE'];
		$PDFDirectory = $f['PDF_DIR'];
		$PDFAttachmentText = $f['ANHANG_TEXT'];

		if($PrintCompanyData == "0")
		{
			$PrintCompanyData = "2";
		}
		else
		{
			$PrintCompanyData = "1";
		}

		if($PrintPositionName == "0")
		{
			$PrintPositionName = "2";
		}
		else
		{
			$PrintPositionName = "1";
		}

		if($EmailInternal == "0")
		{
			$EmailInternal = "1";
		}
		else if ($EmailInternal == "1")
		{
			$EmailInternal = "2";
		}
		else
		{
			$EmailInternal = "1";
		}

		if($EmailUseSignature == "0")
		{
			$EmailUseSignature = "2";
		}
		else
		{
			$EmailUseSignature = "1";
		}

		if($SalesPrices == "0")
		{
			$SalesPrices = "1";
		}
		else if ($SalesPrices == "1")
		{
			$SalesPrices = "2";
		}
		else
		{
			$SalesPrices = "2";
		}

		if($Reminder == "0")
		{
			$Reminder = "2";
		}
		else
		{
			$Reminder = "1";
		}

		$CompanyName = ereg_replace("'", "\'", $CompanyName);
		$CompanyAddress = ereg_replace("'", "\'", $CompanyAddress);
		$CompanyPostal = ereg_replace("'", "\'", $CompanyPostal);
		$CompanyCity = ereg_replace("'", "\'", $CompanyCity);
		$CompanyCountry = ereg_replace("'", "\'", $CompanyCountry);
		$EmailSignature = ereg_replace("'", "\'", $EmailSignature);
		$PDFAttachmentText = ereg_replace("'", "\'", $PDFAttachmentText);

		$query = $db->Execute("UPDATE {$TBLName}setting SET PRINT_COMPANY_DATA='$PrintCompanyData', PRINT_POSITION_NAME='$PrintPositionName', COMPANY_LOGO='$CompanyLogo', COMPANY_LOGO_WIDTH='$CompanyLogoWidth', COMPANY_LOGO_HEIGHT='$CompanyLogoHeight', EMAIL_INTERNAL='$EmailInternal', EMAIL_USE_SIGNATURE='$EmailUseSignature', EMAIL_SIGNATURE='$EmailSignature', INVENTORY_CHECK_ACTIVE='2', REMINDER='$Reminder', REMINDER_DAYS='$ReminderDays', REMINDER_PRICE='$ReminderPrice', ENTRYS_PER_PAGE='$EntrysPerPage', SESSION_SEC='$SessionSec', COMPANY_DATE='$CompanyDate', COMPANY_NAME='$CompanyName', COMPANY_ADDRESS='$CompanyAddress', COMPANY_POSTAL='$CompanyPostal', COMPANY_CITY='$CompanyCity', COMPANY_COUNTRY='$CompanyCountry', COMPANY_PHONE='$CompanyPhone', COMPANY_FAX='$CompanyFax', COMPANY_EMAIL='$CompanyEmail', COMPANY_URL='$CompanyURL', COMPANY_WAP='$CompanyWAP', COMPANY_CURRENCY='$CompanyCurrency', COMPANY_SALESPRICE='$SalesPrices', TAX_FREE='2', COMPANY_TAXNR='$CompanyTaxnr', COMPANY_BUSINESS_TAXNR='$BusinessTaxnr', COMPANY_BANKNAME='$BankName', COMPANY_BANKACCOUNT='$BankAccount', COMPANY_BANKNUMBER='$BankNumber', COMPANY_BANKIBAN='$BankIBAN', COMPANY_BANKBIC='$BankBIC', PDF_COMPANY_LOGO_WIDTH='$PDFCompanyLogoWidth', PDF_COMPANY_LOGO_HEIGHT='$PDFCompanyLogoHeight', PDF_FONT='$PDFFont', PDF_FONT_SIZE1='$PDFText1', PDF_FONT_SIZE2='$PDFText2', PDF_TYPE_HEIGHT='$PDFText3', PDF_DIR='$PDFDirectory', PDF_ATTACHMENT_TEXT='$PDFAttachmentText', CREATEDBY='admin', MODIFIEDBY='admin' WHERE SETTINGID=$settingID");
		
		Header("Location: $web/updatetable/messagef.php?$sessname=$sessid");
	}

?>
