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

// See if the company currency is set to EUR end print the Euro char
//
if($CompanyCurrency == 'EUR'){
	$Currency = EUR;
}else{
	$Currency = $CompanyCurrency;
}


require_once('mc_table.php');

$pdf=new PDF_MC_Table();
$pdf->Open();
$pdf->SetLeftMargin($PDFLeftMargin);
$pdf->SetRightMargin($PDFRightMargin);
$pdf->AddPage();
$pdf->AliasNbPages();
/***
if(isset($METHOD_OF_PAY_DATE) && $METHOD_OF_PAY_DATE != 0){
	if ($Type != 'DeliveryNote'){
		$pdf->SetY(140);
	}else{
		$pdf->SetY(135);
	}
}else{
	$pdf->SetY(135);
}
***/
$pdf->SetFont($PDFFont,'',$PDFFontsize1);

require_once('pos_pdf.inc.php');

//Summen-Linie
$pdf->SetLineWidth(0.3);
$pdf->line($PDFLeftMargin,$pdf->GetY(),210-$PDFRightMargin,$pdf->GetY());
$pdf->SetLineWidth(0.1);
$pdf->SetFont($PDFFont,'',$PDFFontsize2);

//Steuerfreier Kunde?
if(isset($myID) && is_numeric($myID))
{
	//Kunde gesetzt
	$c = $db->GetRow("SELECT TAX_FREE FROM {$TBLName}addressbook WHERE MYID=$myID");
	if ($c['TAX_FREE']==1) {
		//Sonderfall: Kunde ist steuerbefreit!
		$TAX_FREE = true;
		//Steuerdetails überschreiben
	}
}

if (isset($Type) && $Type != 'DeliveryNote')
{
/*** ALTERNATIVES LAYOUT
	$pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin-30,30));
	$pdf->SetAligns(array('R','R'));
	if($TaxFree == "1"){
		// If TaxFree is set to yes than display only total amount
		// otherwise display subtotal..., tax..., amount
		//
		$pdf->SetFont($PDFFont,'B',$PDFFontsize2);

		// Check if we need to calculate temporary or saved positions
		//
		if(isset($tmpPos) && $tmpPos == '1'){
			$pdf->Row(array($a['invoice_amount'].': ',Format_Number($TOTAL_AMOUNT).' '.$Currency));
		}else{
			$pdf->Row(array($a['invoice_amount'].': ',Format_Number($TOTAL).' '.$Currency));
		}
	}else{
		//Zwischensummen nach Steuergruppe(n)
		// Subtotal 1
		//
		if(!empty($Subtotal1)){
			$pdf->Row(array($a['invoice_subtotal'].' '.$sales_price[1].' '.$Tax1_Desc.':',Format_Number($Subtotal1).' '.$Currency));
		}
		// Subtotal 2
		//
		if(!empty($Subtotal2)){
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax2_Desc.':',Format_Number($Subtotal2).' '.$Currency));
		}
		// Subtotal 3
		//
		if(!empty($Subtotal3)){
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax3_Desc.':',Format_Number($Subtotal3).' '.$Currency));
		}
		// Subtotal 4
		//
		if(!empty($Subtotal4)){
			$pdf->Row(array($a['invoice_subtotal'].' '.$Tax4_Desc.':',Format_Number($Subtotal4).' '.$Currency));
		}
		//Steuern nach Steuergruppe(n)
		// Tax 1
		//
		if(!empty($Tax1)){
			$pdf->Row(array($a['invoice_tax1'].' '.$Tax1_Desc.':',Format_Number($Tax1).' '.$Currency));
		}
		// Tax 2
		//
		if(!empty($Tax2)){
			$pdf->Row(array($a['invoice_tax2'].' '.$Tax2_Desc.':',Format_Number($Tax2).' '.$Currency));
		}
		// Tax 3
		//
		if(!empty($Tax3)){
			$pdf->Row(array($a['invoice_tax3'].' '.$Tax3_Desc.':',Format_Number($Tax3).' '.$Currency));
		}
		// Total amount
		//
		$pdf->SetFont($PDFFont,'B',$PDFFontsize2);
		
		// Check if we need to calculate temporary or saved positions
		//
		if(isset($tmpPos) && $tmpPos == '1'){
			$pdf->Row(array($a['invoice_amount'].':',Format_Number($TOTAL_AMOUNT).' '.$Currency));
		}else{
			$pdf->Row(array($a['invoice_amount'].':',Format_Number($TOTAL).' '.$Currency));
		}
	}
***/
//Alternatives Layout Rechnung mit fixen Steuergruppen und einer Box (1,2)
    $pdf->ln();
    //Box:
    $pdf->CheckPageBreak(10);
    $pdf->SetFillColor(235);
    $pdf->SetLineWidth(0.3);
    $i=0;
    if ($Subtotal1>0) $i++;
    if ($Subtotal2>0) $i++;
    $qp=(210-$PDFLeftMargin-$PDFRightMargin)/(2+$i);
    //$pdf->SetWidths(array($qp+10,$qp-10,$qp-10,$qp+10));
    //$pdf->SetAligns(array('C','C','C','C'));
    if(isset($tmpPos) && $tmpPos == '1'){
		$summenbetrag=$TOTAL_AMOUNT;
	}else{
		$summenbetrag=$TOTAL;
	}
    //Zellen in der Box (ohne MultiCell für Formatierung!)
    //Titelzeile:
    $pdf->SetFont($PDFFont,'',$PDFFontsize2);
    if (!$TAX_FREE && $TaxFree != "1") {    
        $pdf->Cell($qp,5,$a['invoice_subtotal'].' '.$sales_price[1],'LT',0,'C',1);
	if ($Subtotal1>0) $pdf->Cell($qp,5,$a['invoice_tax1'].' '.$Tax1_Desc,'T',0,'C',1);
        if ($Subtotal2>0) $pdf->Cell($qp,5,$a['invoice_tax2'].' '.$Tax2_Desc,'T',0,'C',1);
    }else{
	//Leere Box
        $pdf->Cell($qp,5,'','LT',0,'C',1);
    }
    $pdf->Cell($qp,5,$a['invoice_amount'],'TR',0,'C',1);
    $pdf->ln();
    //Datenzeile:
    $pdf->SetFont($PDFFont,'B',$PDFFontsize2);
    if (!$TAX_FREE && $TaxFree != "1") {
        $pdf->Cell($qp,5,Format_Number($Subtotal_netto).' '.$Currency,'LB',0,'C',1);
	if ($Subtotal1>0) $pdf->Cell($qp,5,Format_Number($Tax1).' '.$Currency,'B',0,'C',1);
        if ($Subtotal2>0) $pdf->Cell($qp,5,Format_Number($Tax2).' '.$Currency,'B',0,'C',1);
    }else{
	//Leere Box
        $pdf->Cell($qp,5,'','LB',0,'C',1);
    }

    $pdf->Cell($qp,5,Format_Number($summenbetrag).' '.$Currency,'BR',1,'C',1);
    
//END ALTERNATIVES LAYOUT

    $pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin-30,30));
    $pdf->SetAligns(array('R','R'));

	// Total sum paid
	//
	if (isset($SUM_PAID) && $SUM_PAID > 0)
	{
		$pdf->ln();
		$pdf->SetFont($PDFFont,'',$PDFFontsize2);
		//$pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin));
		//$pdf->SetAligns(array('L'));
		//$pdf->Row(array($a['transaction'].':'));
		
		$pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin-30,30));
		$pdf->SetAligns(array('R','R'));

		foreach($paid as $paidresult)
		{
			$pdf->Row(array($a['transaction'].' '.$paidresult['PAYMENT_DATE'].' ('.$paidresult['METHOD_OF_PAY'].'):',Format_Number($paidresult['SUM_PAID']).' '.$Currency));
			$paid_total=$paid_total+$paidresult['SUM_PAID'];
		}
		$pdf->SetFont($PDFFont,'B',$PDFFontsize2);
		$pdf->Row(array($a['open_amount'].':',Format_Number($TOTAL-$paidresult['SUM_PAID']).' '.$Currency));
	}
}

// Zahlungshinweise
// TO DO:
// - Frist berechnen, wenn nicht gesetzt und abhängig von Zahlungsart
// - Hinweistext aus DB anzeigen (OK)
// - Besondere Zahlungsarten (Cash, CoD) kenntlich machen

if(isset($METHOD_OF_PAY)) {
    $pdf->Ln();    
    $pdf->SetFont($PDFFont,'',$PDFFontsize2);
    $pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin));
    $pdf->SetAligns(array('L'));
    if ($TEXT_ONLY) {
	$paynote=$PAYMENT_NOTE;
    }else{
	$paynote=$a['method_of_payment'].': '.$METHOD_OF_PAY;
	if ($METHOD_OF_PAY_DATE!=0) $paynote.=' '.$a['date_till'].' '.$METHOD_OF_PAY_DATE;
    }
    $pdf->Row(array($paynote));
}

// Note
//
if(!empty($NOTE)) {
    $pdf->Ln();    
    $pdf->SetFont($PDFFont,'',$PDFFontsize2);
    $pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin));
    $pdf->SetAligns(array('L'));
    $pdf->Row(array($NOTE));
}


// Message
//
if(!empty($MESSAGEID)) {
    $pdf->Ln();    
    $pdf->SetFont($PDFFont,'',$PDFFontsize2);
    $pdf->SetWidths(array(210-$PDFLeftMargin-$PDFRightMargin));
    $pdf->SetAligns(array('L'));
    $pdf->Row(array($MESSAGEID));
}

// PDF Subject, Creator etc.
//
$pdf->SetTitle($Subject);
$pdf->SetSubject($Subject);
$pdf->SetAuthor($CompanyName);
//$pdf->SetCreator($a['programname']);

// Check where to send the pdf output
//
if((!empty($sendfile)))
{
	// Send output to String
	//
	$sendfile_content = $pdf->Output($sendfile,"S");
}else{
	// Send output to browser. If you choose
	// save as, this is the default file name
	// format: date-id.pdf example 20071113-1.pdf
	// if pdf plugin is used, only the filename
	// will be displayed e.g. print_pdf.php
	//

	$pdf->Output("$a[invoice_initials]-$PrintD-".str_pad($ID, 3 ,'0', STR_PAD_LEFT).".pdf","D");
}

?>
