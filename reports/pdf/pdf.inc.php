<?php

/*
	pdf.inc.php

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

require_once('../../include/phprechnung.inc.php');

define('FPDF_FONTPATH','../../include/font/');

define('EUR',chr(128));

require_once('mc_table.php');

$pdf=new PDF_MC_Table();
$pdf->Open();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetY(45);

$pdf->SetFont($PDFFont,'',$PDFFontsize1);

require_once('pos_pdf.inc.php');

$pdf->Ln();
$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->SetWidths(array(50,30));
$pdf->SetAligns(array('L','R'));

// Total amount
//

if(isset($CompanyCurrency) && $CompanyCurrency == 'EUR')
{
	$Currency = EUR;
}
else
{
	$Currency = $CompanyCurrency;
}

if(isset($Type) && $Type == 'Booking_Details' or $Type == 'Customer_Booking_Details')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['invoice_amount'].':',Format_Number($TotalAmount).' '.$Currency));
}
else if(isset($Type) && $Type == 'Cashbook')
{
	$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
	$pdf->Row(array($a['starting_with'].':',Format_Number($StartingWith).' '.$Currency));
	$pdf->SetFont($PDFFont,'',$PDFFontsize2);
	$pdf->Row(array($a['takings'].':',Format_Number($TotalTakings).' '.$Currency));
	$pdf->Row(array($a['expenditures'].':',Format_Number($TotalExpenditures).' '.$Currency));
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['cash_in_hand'].':',Format_Number($CashInHand).' '.$Currency));
}
else if(isset($Type) && $Type == 'Customer_Invoices' or $Type == 'Invoice_Ledger' or $Type == 'Outstanding_Accounts' or $Type == 'Customer_Outstanding_Accounts' or $Type == 'User_Outstanding_Accounts')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['invoice_amount'].':',Format_Number($TotalInvoiceAmount).' '.$Currency));
	$pdf->SetFont($PDFFont,'U');
	$pdf->Row(array($a['open_account'].':',Format_Number($TotalOpenAmount).' '.$Currency));
}
else if(isset($Type) && $Type == 'Outstanding_Offers')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['offer_amount'].':',Format_Number($TotalAmount).' '.$Currency));
}
else if(isset($Type) && $Type == 'Invoice_Ledger_Summary')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['invoice_amount'].':',Format_Number($TotalInvoiceSum).' '.$Currency));
	$pdf->SetFont($PDFFont,'U');
	$pdf->Row(array($a['open_account'].':',Format_Number($TotalInvoiceOpenAmount).' '.$Currency));
}
else if(isset($Type) && $Type == 'Position_Sales')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['invoice_amount'].':',Format_Number($TotalAmount).' '.$Currency));
}
else if(isset($Type) && $Type == 'Position_Sales_Summary')
{
	$pdf->SetFont($PDFFont,'BU');
	$pdf->Row(array($a['invoice_amount'].':',Format_Number($TotalPosAmount).' '.$Currency));
}

$pdf->SetFont($PDFFont,'',$PDFFontsize2);

$pdf->Ln(5);

// PDF Subject, Creator etc.
//
$pdf->SetTitle($Subject);
$pdf->SetSubject($Subject);
$pdf->SetAuthor($CompanyName);
$pdf->SetCreator($a['programname']);

// Check where to send the pdf output
//
if(!empty($sendfile))
{
	// Send output to file
	//
	$pdf->Output("$sendfile","F");
}
else
{
	// Send output to browser. If you choose
	// save as, this is the default file name
	// format: date-id.pdf example 20071113-1.pdf
	// if pdf plugin is used, only the filename
	// will be displayed e.g. print_pdf.php
	//

	$pdf->Output("$Type.pdf","I");
}

?>
