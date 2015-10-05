<?php

/*
	pdf_header.inc.php

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

	global $a, $Type, $PrintCompanyData, $PrintPositionName, $Date, $CompanyLogo, $CompanyName,
		$CompanyAddress, $CompanyPostal, $CompanyCity, $CompanyCountry,
		$BankBIC, $BankIBAN, $BusinessTaxnr, $CompanyTaxnr, $PDFCompanyLogoHeight, $TaxFree,
		$PDFCompanyLogoWidth, $PDFTemplate_1, $PDFTemplate_2, $PDFTopMargin_1, $PDFTopMargin_2, $PDFLeftMargin,$PDFRightMargin, $PDFFont, $PDFFontsize1, $PDFFontsize2, $PDFTypeHeight,
		$Print_Company_Name, $MYID, $TITLE, $PREFIX, $FIRSTNAME, $LASTNAME, $COMPANY,
		$ADDRESS, $POSTALCODE, $CITY, $COUNTRY, $METHOD_OF_PAY, $METHOD_OF_PAY_DATE,
		$status, $OFFER_STATUS, $PrintD, $invoiceID, $offerID, $creditID, $tmpOfferID, $tmpInvoiceID,
		$TOTAL_AMOUNT, $Subtotal_netto, $Subtotal, $Currency;
		

	//Briefpapier
	//$this->Image('../images/Briefpapier.png',0,10,200);
	
	if(file_exists($PDFTemplate_2)) {
		$this->setSourceFile($PDFTemplate_2);
		$tplidx = $this->importPage(1);
		$this->useTemplate($tplidx);
	}else{
	        //Falzmarken
		$this->SetLineWidth(0.1);
		$this->SetDrawColor(120);
		$this->line(1,105,5,105);
		$this->line(1,148.5,7,148.5);
		$this->line(1,210,5,210);
		$this->SetDrawColor(0);
		
		//LOGO
		if ($PrintCompanyData === "1" || $PrintCompanyData === "On"){
		    $this->SetY(10);
		    $this->Image($CompanyLogo,190-$PDFCompanyLogoWidth,10,$PDFCompanyLogoWidth,$PDFCompanyLogoHeight);
		}
		if($this->PageNo()==1) {
			//Adressfeld: Absender DIN 5008
			$this->SetFont($PDFFont,'',$PDFFontsize1);
			$this->SetY(45);
			$this->Cell(85,5,$CompanyName.', '.$CompanyAddress.', '.$CompanyPostal.' '.$CompanyCity,'B',1,'L');
		}
	}
	 
	$this->SetFont($PDFFont,'',$PDFFontsize2);
	
	$this->SetY($PDFTopMargin_2);
	
	//Seitenzahl
	$this->SetX($PDFRightBlock);
	$this->SetFont($PDFFont,'',$PDFFontsize2);
	$this->Cell($blockstop,5,$a['page'].': '.$this->PageNo().' von '.'{nb}',0,1,'R');
	
	$this->Ln();
	
?>