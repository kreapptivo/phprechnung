<?php

/*
	pdf_footer.inc.php

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

	global $a, $PrintCompanyData, $CompanyName, $CompanyAddress, $CompanyPostal, $CompanyCity, $CompanyCountry,
	$CompanyPhone, $CompanyFax, $CompanyEmail, $CompanyURL, $BankName, $BankAccount, $BankNumber, $PDFFont,
	$PDFFontsize1, $PDFFontsize2;

	if ($PrintCompanyData === "1" || $PrintCompanyData === "On")
	{
		$this->SetX(8);
		$this->SetFont($PDFFont,'',$PDFFontsize1);
		$this->SetY(-22);
		$this->Cell(0,5,$CompanyName,0,0,'L');
		$this->SetY(-22);
		$this->Cell(70);
		$this->Cell(0,5,$a['company_phone'].': '.$CompanyPhone,0,0,'L');
		$this->SetY(-22);
		$this->Cell(150);
		$this->Cell(0,5,$a['bank_name'].':',0,0,'L');
		$this->SetY(-18);
		$this->Cell(0,5,$CompanyAddress,0,0,'L');
		$this->SetY(-18);
		$this->Cell(70);
		$this->Cell(0,5,$a['company_fax'].': '.$CompanyFax,0,0,'L');
		$this->SetY(-18);
		$this->Cell(150);
		$this->Cell(0,5,$BankName,0,0,'L');
		$this->SetY(-14);
		$this->Cell(0,5,$CompanyPostal.' '.$CompanyCity,0,0,'L');
		$this->SetY(-14);
		$this->Cell(70);
		$this->Cell(0,5,$a['company_email'].': '.$CompanyEmail,0,0,'L');
		$this->SetY(-14);
		$this->Cell(150);
		$this->Cell(0,5,$a['bank_account'].': '.$BankAccount,0,0,'L');
		$this->SetY(-10);
		$this->Cell(0,5,$CompanyCountry,0,0,'L');
		$this->SetY(-10);
		$this->Cell(70);
		$this->Cell(0,5,$a['company_url'].': '.$CompanyURL,0,0,'L');
		$this->SetY(-10);
		$this->Cell(150);
		$this->Cell(0,5,$a['bank_number'].': '.$BankNumber,0,0,'L');
	}

?>
