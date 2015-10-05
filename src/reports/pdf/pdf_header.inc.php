<?php

/*
	pdf_header.inc.php

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

	global $a, $offer_status, $DateFrom, $DateTill, $Type, $CompanyName, $CompanyAddress, $CompanyPostal, $CompanyCity,
		$CompanyCurrency, $Currency, $PDFFont, $PDFFontsize1, $PDFFontsize2, $PDFTypeHeight;

	if(isset($CompanyCurrency) && $CompanyCurrency == 'EUR')
	{
		$Currency = EUR;
	}
	else
	{
		$Currency = $CompanyCurrency;
	}

	$this->SetFont($PDFFont,'',$PDFFontsize2);
	$this->Cell(100,5,$CompanyName.' - '.$CompanyAddress.' - '.$CompanyPostal.' '.$CompanyCity,0,1,'L');
	$this->Line(10,17,205,17);
	$this->Ln();
	$this->SetFont($PDFFont,'',$PDFFontsize1);
	$this->Cell(195,5,$a['date_text'].': '.$DateFrom.' '.$a['date_till'].' '.$DateTill,0,1,'L');
	$this->Ln(2);
	$this->SetFont($PDFFont,'B','14');
	if(isset($Type) && $Type == 'Booking_Details' or $Type == 'Customer_Booking_Details')
	{
		$this->Cell(195,10,$a['booking_details'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['payment_number'],0,0,'L');
		$this->Cell(85,5,$a['customer'],0,0,'L');
		$this->Cell(20,5,$a['date_text'],0,0,'C');
		$this->Cell(30,5,$a['payment_sum'].' '.$Currency,0,0,'R');
		$this->Cell(35,5,$a['method_of_payment'],0,0,'L');
	}
	else if (isset($Type) && $Type == 'Cashbook')
	{
		$this->Cell(195,10,$a['cashbook'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['cashbook_number'],0,0,'L');
		$this->Cell(25,5,$a['takings'].' '.$Currency,0,0,'R');
		$this->Cell(25,5,$a['expenditures'].' '.$Currency,0,0,'R');
		$this->Cell(25,5,$a['cash_in_hand'].' '.$Currency,0,0,'R');
		$this->Cell(25,5,$a['date_text'],0,0,'C');
		$this->Cell(70,5,$a['cashbook_description'],0,0,'L');
	}
	else if (isset($Type) && $Type == 'Invoice_Ledger' or $Type == 'Customer_Invoices')
	{
		$this->Cell(195,10,$a['customer_sales'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['invoice_number'],0,0,'L');
		$this->Cell(75,5,$a['customer'],0,0,'L');
		$this->Cell(25,5,$a['date_text'],0,0,'C');
		$this->Cell(35,5,$a['invoice_amount'].' '.$Currency,0,0,'R');
		$this->Cell(35,5,$a['open_account'].' '.$Currency,0,0,'R');
	}
	else if (isset($Type) && $Type == 'Invoice_Ledger_Summary')
	{
		$this->Cell(195,10,$a['customer_sales'].' - '.$a['summary'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(115,5,$a['customer'],0,0,'L');
		$this->Cell(40,5,$a['invoice_amount'].' '.$Currency,0,0,'R');
		$this->Cell(40,5,$a['open_account'].' '.$Currency,0,0,'R');
	}
	else if (isset($Type) && $Type == 'Outstanding_Accounts' or $Type == 'Customer_Outstanding_Accounts' or $Type == 'User_Outstanding_Accounts')
	{
		$this->Cell(195,10,$a['open_invoice'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['invoice_number'],0,0,'L');
		$this->Cell(75,5,$a['customer'],0,0,'L');
		$this->Cell(25,5,$a['date_text'],0,0,'C');
		$this->Cell(35,5,$a['invoice_amount'].' '.$Currency,0,0,'R');
		$this->Cell(35,5,$a['open_account'].' '.$Currency,0,0,'R');
	}
	else if (isset($Type) && $Type == 'Outstanding_Offers')
	{
		$this->Cell(195,10,$a['offer'].' - '.$offer_status[1],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['offer_number'],0,0,'L');
		$this->Cell(75,5,$a['customer'],0,0,'L');
		$this->Cell(25,5,$a['date_text'],0,0,'C');
		$this->Cell(25,5,$a['offer_amount'].' '.$Currency,0,0,'R');
		$this->Cell(45,5,$a['status'],0,0,'L');
	}
	else if (isset($Type) && $Type == 'Position_Sales')
	{
		$this->Cell(195,10,$a['position_sales'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['position'],0,0,'L');
		$this->Cell(85,5,$a['pos_text'],0,0,'L');
		$this->Cell(25,5,$a['pos_quantity'],0,0,'R');
		$this->Cell(30,5,$a['pos_price'].' '.$Currency,0,0,'R');
		$this->Cell(30,5,$a['pos_amount'].' '.$Currency,0,0,'R');
	}
	else if (isset($Type) && $Type == 'Position_Sales_Summary')
	{
		$this->Cell(195,10,$a['position_sales'].' - '.$a['summary'],0,1,'C');
		$this->Ln(2);
		$this->SetFont($PDFFont,'B',$PDFFontsize2);
		$this->Cell(25,5,$a['position'],0,0,'L');
		$this->Cell(100,5,$a['pos_text'],0,0,'L');
		$this->Cell(25,5,$a['pos_quantity'],0,0,'R');
		$this->Cell(45,5,$a['pos_amount'].' '.$Currency,0,0,'R');
	}
	$this->Line(10,44,205,44);
	$this->Ln(10);

?>
