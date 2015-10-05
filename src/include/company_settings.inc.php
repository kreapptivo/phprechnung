<?php

/*
	company_settings.inc.php

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

// require_once('phprechnung.inc.php');

define ('IMAGE_PATH',"../images/");

// Database connection
//
DBConnect();

// Get needed information from setting table
//
$query = $db->Execute("SELECT SETTINGID, DATE_FORMAT(COMPANY_DATE,'%d.%m.%Y') AS COMPANY_DATE, PRINT_COMPANY_DATA, PRINT_POSITION_NAME, TAX_FREE, COMPANY_NAME, COMPANY_ADDRESS, COMPANY_POSTAL,
		COMPANY_CITY, COMPANY_COUNTRY, COMPANY_PHONE, COMPANY_FAX, COMPANY_EMAIL, COMPANY_URL, COMPANY_WAP, COMPANY_CURRENCY, COMPANY_SALESPRICE, COMPANY_TAXNR,
		COMPANY_BUSINESS_TAXNR, COMPANY_BANKNAME, COMPANY_BANKACCOUNT, COMPANY_BANKNUMBER, COMPANY_BANKIBAN, COMPANY_BANKBIC, EMAIL_INTERNAL, EMAIL_USE_SIGNATURE,
		EMAIL_SIGNATURE, INVENTORY_CHECK_ACTIVE, REMINDER, REMINDER_DAYS, REMINDER_PRICE, ENTRYS_PER_PAGE, SESSION_SEC, SALUTATION_GENERAL, COMPANY_LOGO, COMPANY_LOGO_WIDTH, COMPANY_LOGO_HEIGHT,
		PDF_COMPANY_LOGO_HEIGHT, PDF_COMPANY_LOGO_WIDTH, PDF_TEMPLATE_1, PDF_TEMPLATE_2, PDF_TOP_MARGIN_1, PDF_TOP_MARGIN_2, PDF_LEFT_MARGIN, PDF_RIGHT_MARGIN, PDF_FONT, PDF_DIR, PDF_FONT_SIZE1, PDF_FONT_SIZE2, PDF_TYPE_HEIGHT, PDF_ATTACHMENT_TEXT FROM {$TBLName}setting");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$SettingID = $f['SETTINGID'];
		$CompanyDate = $f['COMPANY_DATE'];
		$PrintCompanyData = $f['PRINT_COMPANY_DATA'];
		$PrintPositionName = $f['PRINT_POSITION_NAME'];
		$TaxFree = $f['TAX_FREE'];

		$CompanyName = $f['COMPANY_NAME'];
		$CompanyAddress = $f['COMPANY_ADDRESS'];
		$CompanyPostal = $f['COMPANY_POSTAL'];
		$CompanyCity = $f['COMPANY_CITY'];
		$CompanyCountry = $f['COMPANY_COUNTRY'];
		$CompanyPhone = $f['COMPANY_PHONE'];
		$CompanyFax = $f['COMPANY_FAX'];
		$CompanyEmail = $f['COMPANY_EMAIL'];
		$CompanyURL = $f['COMPANY_URL'];
		$CompanyWAP = $f['COMPANY_WAP'];
		$CompanyCurrency = $f['COMPANY_CURRENCY'];
		$SalesPrices = $f['COMPANY_SALESPRICE'];

		$SalutationGeneral = $f['SALUTATION_GENERAL'];

		$CompanyTaxnr = $f['COMPANY_TAXNR'];
		$BusinessTaxnr = $f['COMPANY_BUSINESS_TAXNR'];
		$BankName = $f['COMPANY_BANKNAME'];
		$BankAccount = $f['COMPANY_BANKACCOUNT'];
		$BankNumber = $f['COMPANY_BANKNUMBER'];
		$BankIBAN = $f['COMPANY_BANKIBAN'];
		$BankBIC = $f['COMPANY_BANKBIC'];

		$EmailInternal = $f['EMAIL_INTERNAL'];
		$EmailUseSignature = $f['EMAIL_USE_SIGNATURE'];
		$EmailSignature = $f['EMAIL_SIGNATURE'];
		$InventoryCheckActive = $f['INVENTORY_CHECK_ACTIVE'];
		
		$Reminder = $f['REMINDER'];
		$ReminderDays = $f['REMINDER_DAYS'];
		$ReminderPrice = $f['REMINDER_PRICE'];
		$EntrysPerPage = $f['ENTRYS_PER_PAGE'];
		$SessionSec = $f['SESSION_SEC'];

		// Company's Logo
		//

		$CompanyLogo = IMAGE_PATH.$f['COMPANY_LOGO'];

		// Company Logo Width
		//
		$CompanyLogoWidth = $f['COMPANY_LOGO_WIDTH'];
		
		// Company Logo Height
		//
		$CompanyLogoHeight = $f['COMPANY_LOGO_HEIGHT'];

		// Company Logo Height PDF
		//
		$PDFCompanyLogoHeight = $f['PDF_COMPANY_LOGO_HEIGHT'];

		// Company Logo Width PDF
		//
		$PDFCompanyLogoWidth = $f['PDF_COMPANY_LOGO_WIDTH'];
		
		// PDF Templates (Briefpapier)
		//
		if(!empty($f['PDF_TEMPLATE_1'])) $PDFTemplate_1=IMAGE_PATH.$f['PDF_TEMPLATE_1'];
		if (!empty($PDFTemplate_1)) { 
			if(!empty($f['PDF_TEMPLATE_2'])) {
			    $PDFTemplate_2=IMAGE_PATH.$f['PDF_TEMPLATE_2'];
			}else{
			    $PDFTemplate_2=$PDFTemplate_1;
			}
		}
		
		// PDF PageMargins
		//
		$PDFLeftMargin = $f['PDF_LEFT_MARGIN'];
		$PDFRightMargin = $f['PDF_RIGHT_MARGIN'];
		$PDFTopMargin_1 = $f['PDF_TOP_MARGIN_1'];
		$PDFTopMargin_2 = $f['PDF_TOP_MARGIN_2'];
		
		// PDF Font
		//
		$PDFFont = $f['PDF_FONT'];

		// TEMP Directory for PDF's
		// The Webserver must have write access
		// for this directory
		//
		$PDFDirectory = $f['PDF_DIR'];

		// PDF Fontsize 1
		//
		$PDFFontsize1 = $f['PDF_FONT_SIZE1'];

		// PDF Fontsize 2
		//
		$PDFFontsize2 = $f['PDF_FONT_SIZE2'];

		// PDF Text Height e. g. Invoice / Offer
		//
		$PDFTypeHeight = $f['PDF_TYPE_HEIGHT'];

		// PDF Attachment Text
		//
		$PDFAttachmentText = $f['PDF_ATTACHMENT_TEXT'];
	}

// Close Database Connection ( optional )
//
DBClose();
?>
