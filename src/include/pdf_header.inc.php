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
		$PDFCompanyLogoWidth, $PDFFont, $PDFFontsize1, $PDFFontsize2, $PDFTypeHeight,
		$Print_Company_Name, $MYID, $TITLE, $PREFIX, $FIRSTNAME, $LASTNAME, $COMPANY,
		$ADDRESS, $POSTALCODE, $CITY, $COUNTRY, $METHOD_OF_PAY, $METHOD_OF_PAY_DATE,
		$status, $OFFER_STATUS, $PrintD, $invoiceID, $offerID, $creditID, $tmpOfferID, $tmpInvoiceID;

	if ($PrintCompanyData === "1" || $PrintCompanyData === "On")
	{
		$this->SetY(5);
		$this->Image($CompanyLogo,15,5,$PDFCompanyLogoWidth,$PDFCompanyLogoHeight);
		$this->SetFont($PDFFont,'',$PDFTypeHeight);
		$this->Cell(130);
		if($Type == 'Invoice')
		{
			$this->Cell(60,15,$a['invoice'],0,1,'R');
		}
		else if ($Type == 'DeliveryNote')
		{
			$this->Cell(60,15,$a['delivery_note'],0,1,'R');
		}
		else if ($Type == 'Offer')
		{
			$this->Cell(60,15,$a['offer'],0,1,'R');
		}
		else if ($Type == 'Order')
		{
			$this->Cell(60,15,$a['order'],0,1,'R');
		}
		else if ($Type == 'CreditNote')
		{
			$this->Cell(60,15,$a['credit_note'],0,1,'R');
		}
		else if ($Type == 'Info')
		{
			$this->Cell(60,15,$a['info'],0,1,'R');
		}
	}

	$this->SetFont($PDFFont,'U',8);
	$this->SetY(50);
	$this->Cell(5);
	$this->Cell(100,5,$CompanyName.', '.$CompanyAddress.', '.$CompanyPostal.' '.$CompanyCity,0,1,'L');
	$this->SetFont($PDFFont,'',$PDFFontsize2);
	if($Print_Company_Name == "1")
	{
		$this->Cell(5);
		$this->Cell(100,4,$PREFIX.' '.$TITLE,0,1,'L');
		$this->Cell(5);
		$this->Cell(100,4,$FIRSTNAME.' '.$LASTNAME,0,1,'L');
	}
	if (!empty($COMPANY))
	{
		$this->Cell(5);
		$this->Cell(100,4,$COMPANY,0,1,'L');
	}
	$this->Cell(5);
	$this->Cell(100,4,$ADDRESS,0,1,'L');
	$this->Cell(100,2,'',0,1,'L');
	$this->Cell(5);
	$this->Cell(100,4,$POSTALCODE.' '.$CITY,0,1,'L');

	if($CompanyCountry != $COUNTRY)
	{
		$this->Cell(5);
		$this->Cell(100,4,$COUNTRY,0,1,'L');
	}

	$this->SetY(90);
	$this->Cell(194,5,$a['page'].': '.$this->PageNo().'/{nb}',0,1,'R');
	$this->Ln(5);

	if(!empty($BankIBAN))
	{
		$this->Cell(5);
		if($Type == 'Invoice')
		{
			$this->Cell(70,5,$a['invoice_number'].': '.$a['invoice_initials'].'-'.$PrintD.'-'.$invoiceID,0,0,'L');
		}
		else if ($Type == 'DeliveryNote')
		{
			$this->Cell(70,5,$a['delivery_note_number'].': '.$a['delivery_note_initials'].'-'.$PrintD.'-'.$invoiceID,0,0,'L');
		}
		else if ($Type == 'Offer')
		{
			$this->Cell(70,5,$a['offer_number'].': '.$a['offer_initials'].'-'.$PrintD.'-'.$offerID,0,0,'L');
		}
		else if ($Type == 'Order')
		{
			$this->Cell(70,5,$a['order_number'].': '.$a['order_initials'].'-'.$PrintD.'-'.$offerID,0,0,'L');
		}
		else if ($Type == 'CreditNote')
		{
			$this->Cell(70,5,$a['credit_note_number'].': '.$a['credit_note_initials'].'-'.$PrintD.'-'.$creditID,0,0,'L');
		}
		$this->Cell(35);
		$this->Cell(80,5,$a['bank_iban'].': '.$BankIBAN,0,1,'R');
	}
	else
	{
		$this->Cell(5);
		if($Type == 'Invoice')
		{
			$this->Cell(70,5,$a['invoice_number'].': '.$a['invoice_initials'].'-'.$PrintD.'-'.$invoiceID,0,0,'L');
		}
		else if ($Type == 'DeliveryNote')
		{
			$this->Cell(70,5,$a['delivery_note_number'].': '.$a['delivery_note_initials'].'-'.$PrintD.'-'.$invoiceID,0,0,'L');
		}
		else if ($Type == 'Offer')
		{
			$this->Cell(70,5,$a['offer_number'].': '.$a['offer_initials'].'-'.$PrintD.'-'.$offerID,0,0,'L');
		}
		else if ($Type == 'Order')
		{
			$this->Cell(70,5,$a['order_number'].': '.$a['order_initials'].'-'.$PrintD.'-'.$offerID,0,0,'L');
		}
		else if ($Type == 'CreditNote')
		{
			$this->Cell(70,5,$a['credit_note_number'].': '.$a['credit_note_initials'].'-'.$PrintD.'-'.$creditID,0,0,'L');
		}
	}

	if(!empty($BankBIC))
	{
		$this->Cell(5);
		$this->Cell(70,5,$a['customer_no'].': '.$a['customer_no_initials'].'-'.$MYID,0,0,'L');
		$this->Cell(35);
		$this->Cell(80,5,$a['bank_bic'].': '.$BankBIC,0,1,'R');
	}
	else
	{
		$this->Cell(5);
		$this->Cell(70,5,$a['customer_no'].': '.$a['customer_no_initials'].'-'.$MYID,0,1,'L');
	}

	if(!empty($BusinessTaxnr))
	{
		$this->Cell(5);
		$this->Cell(70,5,$a['date_text'].': '.$Date,0,0,'L');
		$this->Cell(35);
		$this->Cell(80,5,$a['business_taxnr'].': '.$BusinessTaxnr,0,1,'R');
	}
	else
	{
		$this->Cell(5);
		$this->Cell(70,5,$a['date_text'].': '.$Date,0,1,'L');
	}

	if(!empty($CompanyTaxnr))
	{
		if ($Type == 'DeliveryNote')
		{
			$this->Cell(5);
			$this->Cell(70,5,'',0,0,'L');
		}
		else
		{
			$this->Cell(5);
			$this->Cell(70,5,$a['method_of_payment'].': '.$METHOD_OF_PAY,0,0,'L');
		}
		$this->Cell(35);
		$this->Cell(80,5,$a['company_taxnr'].': '.$CompanyTaxnr,0,1,'R');
	}
	else
	{
		if ($Type != 'DeliveryNote')
		{
			$this->Cell(5);
			$this->Cell(70,5,$a['method_of_payment'].': '.$METHOD_OF_PAY,0,1,'L');
		}
	}

	if ($Type != 'DeliveryNote')
	{
		if($METHOD_OF_PAY_DATE != 0)
		{
			$this->Cell(5);
			$this->Cell(70,5,$a['payment'].' '.$a['date_till'].': '.$METHOD_OF_PAY_DATE,0,1,'L');
		}
	}

	$this->Ln(10);
	$this->SetFont($PDFFont,'B',$PDFFontsize2);

	if ($Type == 'DeliveryNote')
	{
		if($PrintPositionName == "1")
		{
			$this->Cell(25,5,$a['position'],0,0,'L');
			$this->Cell(140,5,$a['pos_text'],0,0,'L');
			$this->Cell(30,5,$a['pos_quantity'],0,0,'R');
		}
		else
		{
			$this->Cell(165,5,$a['pos_text'],0,0,'L');
			$this->Cell(30,5,$a['pos_quantity'],0,0,'R');
		}
	}
	else
	{
		
		if($PrintPositionName == "1")
		{
			$this->Cell(25,5,$a['position'],0,0,'L');
			$this->Cell(95,5,$a['pos_text'],0,0,'L');
		}
		else
		{
			$this->Cell(120,5,$a['pos_text'],0,0,'L');
		}
		$this->Cell(20,5,$a['pos_quantity'],0,0,'R');
		$this->Cell(20,5,$a['pos_price'],0,0,'R');
		if($TaxFree == "1")
		{
			$this->Cell(35,5,$a['pos_amount'],0,0,'R');
		}
		else
		{
			$this->Cell(15,5,$a['tax_short'],0,0,'C');
			$this->Cell(20,5,$a['pos_amount'],0,0,'R');
		}
	}

	$this->Ln();
?>
