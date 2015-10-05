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

require_once('phprechnung.inc.php');

define('FPDF_FONTPATH','font/');

define('EUR',chr(128));

require_once('mc_table.php');

$pdf=new PDF_MC_Table();
$pdf->Open();
$pdf->AddPage();
$pdf->AliasNbPages();

if(isset($METHOD_OF_PAY_DATE) && $METHOD_OF_PAY_DATE != 0)
{
	if ($Type != 'DeliveryNote')
	{
		$pdf->SetY(140);
	}
	else
	{
		$pdf->SetY(135);
	}
}
else
{
	$pdf->SetY(135);
}

$pdf->SetFont($PDFFont,'',$PDFFontsize1);

require_once('pos_pdf.inc.php');

$pdf->Ln(5);

$pdf->SetFont($PDFFont,'',$PDFFontsize2);
$pdf->SetWidths(array(170,25));
$pdf->SetAligns(array('R','R'));

// See if the company currency is set to EUR end print the Euro char
//
if($CompanyCurrency == 'EUR')
{
	$Currency = EUR;
}
else
{
	$Currency = $CompanyCurrency;
}

if (isset($Type) && $Type != 'DeliveryNote')
{
	if($TaxFree == "1")
	{
		// If TaxFree is set to yes than display only total amount
		// otherwise display subtotal..., tax..., amount
		//
		$pdf->SetFont($PDFFont,'B',$PDFFontsize2);

		// Check if we need to calculate temporary or saved positions
		//
		if(isset($tmpPos) && $tmpPos == '1')
		{
			$pdf->Row(array($a['invoice_amount'].' '.$Currency.':',Format_Number($TOTAL_AMOUNT)));
		}
		else
		{
			$pdf->Row(array($a['invoice_amount'].' '.$Currency.':',Format_Number($TOTAL)));
		}
	}
	else
	{
		// Subtotal 1
		//
		if(!empty($Subtotal1))
		{
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax1_Desc.':',Format_Number($Subtotal1)));
		}

		// Subtotal 2
		//
		if(!empty($Subtotal2))
		{
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax2_Desc.':',Format_Number($Subtotal2)));
		}

		// Subtotal 3
		//
		if(!empty($Subtotal3))
		{
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax3_Desc.':',Format_Number($Subtotal3)));
		}

		// Subtotal 4
		//
		if(!empty($Subtotal4))
		{
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax4_Desc.':',Format_Number($Subtotal4)));
		}

		// Tax 1
		//
		if(!empty($Tax1))
		{
			$pdf->Row(array($a['invoice_tax1'].' '.$Tax1_Desc.':',Format_Number($Tax1)));
		}

		// Tax 2
		//
		if(!empty($Tax2))
		{
			$pdf->Row(array($a['invoice_tax2'].' '.$Tax2_Desc.':',Format_Number($Tax2)));
		}

		// Tax 3
		//
		if(!empty($Tax3))
		{
			$pdf->Row(array($a['invoice_tax3'].' '.$Tax3_Desc.':',Format_Number($Tax3)));
		}

		// Total amount
		//
		$pdf->SetFont($PDFFont,'B',$PDFFontsize2);

		// Check if we need to calculate temporary or saved positions
		//
		if(isset($tmpPos) && $tmpPos == '1')
		{
			$pdf->Row(array($a['invoice_amount'].' '.$Currency.':',Format_Number($TOTAL_AMOUNT)));
		}
		else
		{
			$pdf->Row(array($a['invoice_amount'].' '.$Currency.':',Format_Number($TOTAL)));
		}
	}

	// Total sum paid
	//
	if (isset($SUM_PAID) && $SUM_PAID > 0)
	{
		$pdf->SetFont($PDFFont,'',$PDFFontsize2);
		$pdf->SetWidths(array(195));
		$pdf->SetAligns(array('L'));
		$pdf->Row(array($a['transaction'].':'));

		foreach($paid as $paidresult)
		{
			$pdf->Row(array($paidresult['PAYMENT_DATE'].' [ '.$paidresult['METHOD_OF_PAY'].' ]'.' '.Format_Number($paidresult['SUM_PAID']).' '.$Currency));
		}
	}
}

$pdf->Ln(5);

// Message
//
$pdf->SetFont($PDFFont,'',$PDFFontsize1);
$pdf->SetWidths(array(195));
$pdf->SetAligns(array('C'));
if(isset($MESSAGEID))
	$pdf->Row(array($MESSAGEID));

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

	$pdf->Output("$PrintD-$ID.pdf","I");
}

?>
