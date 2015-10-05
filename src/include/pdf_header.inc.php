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
	
	if((file_exists($PDFTemplate_1))and ($this->PageNo()==1)) {
		$this->setSourceFile($PDFTemplate_1);
		$tplidx = $this->importPage(1);
		$this->useTemplate($tplidx);
	}elseif((file_exists($PDFTemplate_2))and ($this->PageNo()>1)) {
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
	
	//Empfänger nur auf Titleseite
	if($this->PageNo()==1) {
		//Adressfeld nach ISO/DIN 5008
		
		//Hilfslinien Adressfeld
		//$this->SetDrawColor(120);
		//$this->line(20,45,105,45);
		//$this->line(20,45,20,90);
		//$this->line(20,50,105,50);
		//$this->line(105,45,105,90);
		//$this->line(20,90,105,90);
		//$this->SetDrawColor(0);
		
		//Set Position DIN 5008
		$this->SetY(50);
		
		//Zusatz und Vermerkzone (3 Zeilen)
		$this->MultiCell(80,4,"\n\n\n",0,'L');
		
		//Anschriftzone (6 Zeilen)
		//Firma
		if(!empty($COMPANY)){
		    $this->MultiCell(80,4,$COMPANY,0,'L');
		}
		
		if($Print_Company_Name == "1"){
		    //Anrede/Titel
			if ((!empty($PREFIX)) or (!empty($TITLE))) {
				$this->MultiCell(80,4,$PREFIX.' '.$TITLE,0,'L');
			}
	    		//Name
			if ((!empty($FIRSTNAME)) or (!empty($LASTNAME))) {
				$this->MultiCell(80,4,$FIRSTNAME.' '.$LASTNAME,0,'L');
			}
		}
		//Straße
		$this->MultiCell(80,4,$ADDRESS,0,'L');
		//PLZ und Ort
		$this->MultiCell(80,4,$POSTALCODE.' '.$CITY,0,'L');

		//Zielland
		if($CompanyCountry != $COUNTRY){
			$this->Cell(15);
			$this->MultiCell(80,4,strtoupper($COUNTRY),0,'L');
		}

	}
	if($this->PageNo()==1) {
        	$this->SetY($PDFTopMargin_1);
        }else{
		$this->SetY($PDFTopMargin_2);
        }
	
	//Rechter Block
	$PDFRightBlock=137;
	
	//Strichstärke abziehen und Breite berechnen
	$PDFRightBlock=$PDFRightBlock+0.6;
	$blockstop=210-$PDFRightBlock-$PDFRightMargin;
	$this->SetX($PDFRightBlock);
	
	//Hilfslinie
	//$this->line(20,100,190,100);
	
	$this->SetLineWidth(0.3);
	$this->SetFont($PDFFont,'',$PDFFontsize1);
	
	//Vorgangsnummer erzeugen
	if($Type == 'Invoice'){
		$name=$a['invoice_number'];
		$number=$a['invoice_initials'].'-'.$PrintD.'-'.str_pad($invoiceID,3,'0', STR_PAD_LEFT);
	}else if ($Type == 'DeliveryNote'){
		$name=$a['delivery_note_number'];
		$number=$a['delivery_note_initials'].'-'.$PrintD.'-'.str_pad($invoiceID,3,'0', STR_PAD_LEFT);
	}else if ($Type == 'Offer'){
		$name=$a['offer_number'];
		$number=$a['offer_initials'].'-'.$PrintD.'-'.str_pad($offerID,3,'0', STR_PAD_LEFT);
	}else if ($Type == 'Order'){
		$name=$a['order_number'];
		$number=$a['order_initials'].'-'.$PrintD.'-'.str_pad($offerID,3,'0', STR_PAD_LEFT);
	}else if ($Type == 'CreditNote'){
		$name=$a['credit_note_number'];
		$number=$a['credit_note_initials'].'-'.$PrintD.'-'.str_pad($creditID,3,'0', STR_PAD_LEFT);
	}

	$this->Cell($blockstop/2,5,$name,'TLR',0,'L');
	$this->Cell($blockstop/2,5,$a['date_text'],'TR',1,'L');
	$this->SetX($PDFRightBlock);
	$this->SetFont($PDFFont,'B',$PDFFontsize2);
	$this->Cell($blockstop/2,5,$number,'BLR',0,'R');
	$this->Cell($blockstop/2,5,$Date,'BR',1,'R');
	$this->ln;
	//Seitenzahl
	$this->SetX($PDFRightBlock);
	$this->SetFont($PDFFont,'',$PDFFontsize2);
	$this->Cell($blockstop,5,$a['page'].': '.$this->PageNo().' von '.'{nb}',1,1,'R');
	
	//Titel
	$this->SetFont($PDFFont,'',$PDFTypeHeight);
	if($Type == 'Invoice'){
		$this->Cell(10,15,$a['invoice'],0,1);
	}else if ($Type == 'DeliveryNote'){
		$this->Cell(10,15,$a['delivery_note'],0,1);
	}else if ($Type == 'Offer'){
		$this->Cell(10,15,$a['offer'],0,1);
	}else if ($Type == 'Order'){
		$this->Cell(10,15,$a['order'],0,1);
	}else if ($Type == 'CreditNote'){
		$this->Cell(10,15,$a['credit_note'],0,1);
	}else if ($Type == 'Info'){
		$this->Cell(10,15,$a['info'],0,1);
	}
	
/***
	
	//Kundennummer
	$this->Cell(5);
	$this->Cell(70,5,$a['customer_no'].': '.$a['customer_no_initials'].'-'.$MYID,0,0,'L');

	//Kunden-Steuernummer
	if(!empty($CompanyTaxnr)){
		$this->Cell(35);
		$this->Cell(80,5,$a['company_taxnr'].': '.$CompanyTaxnr,0,1,'R');
	}

	//Internationale Bankverbindung
	//IBAN
	if(!empty($BankIBAN)){
		$this->Cell(35);
		$this->Cell(80,5,$a['bank_iban'].': '.$BankIBAN,0,1,'R');
	}
	//BIC-Nummer
	if(!empty($BankBIC)){
		$this->Cell(35);
		$this->Cell(80,5,$a['bank_bic'].': '.$BankBIC,0,1,'R');
	}
	//Eigene Steuernummer
	if(!empty($BusinessTaxnr)){
		$this->Cell(35);
		$this->Cell(80,5,$a['business_taxnr'].': '.$BusinessTaxnr,0,1,'R');
	}

	//Zahlungsart
	if ($Type == 'DeliveryNote'){
		$this->Cell(5);
		$this->Cell(70,5,'',0,0,'L');
	}else{
		$this->Cell(5);
		$this->Cell(70,5,$a['method_of_payment'].': '.$METHOD_OF_PAY,0,0,'L');
	}
	if ($Type != 'DeliveryNote'){
	    if($METHOD_OF_PAY_DATE != 0){
		$this->Cell(5);
		$this->Cell(70,5,$a['payment'].' '.$a['date_till'].': '.$METHOD_OF_PAY_DATE,0,1,'L');
	    }
	}
***/
	//Anschreiben/Brieftext
	
	if ($TOTAL_AMOUNT==0) {
	//Überschriften nur wenn Rechnungsposition vorhanden sind...
	$this->SetFont($PDFFont,'',$PDFFontsize1);
	$this->SetLineWidth(0.3);
	$this->line($PDFLeftMargin,$this->GetY(),210-$PDFRightMargin,$this->GetY());
	$this->SetLineWidth(0.3);
	$this->line($PDFLeftMargin,$this->GetY()+4,210-$PDFRightMargin,$this->GetY()+4);
	$this->SetLineWidth(0.1);
	if ($Type == 'DeliveryNote'){
		if($PrintPositionName == "1"){
			$this->Cell(10,4,$a['position'],0,0,'C');
			$this->Cell(20,4,$a['pos_quantity'],0,0,'C');
			$this->Cell(210-$this->GetX()-$PDFRightMargin,4,$a['pos_text'],0,0,'L');
		}else{
			$this->Cell(20,5,$a['pos_quantity'],0,0,'C');
			$this->Cell(210-$this->GetX()-$PDFRightMargin,4,$a['pos_text'],0,0,'L');
		}
	}else{
		if($PrintPositionName == "1"){
			$this->Cell(10,4,$a['position'],0,0,'C');
			$this->Cell(20,4,$a['pos_quantity'],0,0,'C');
			$this->Cell(210-$this->GetX()-$PDFRightMargin-25-30,4,$a['pos_text'],0,0,'L');
		}else{
			$this->Cell(20,4,$a['pos_quantity'],0,0,'C');
			$this->Cell(210-$this->GetX()-$PDFRightMargin-25-30,4,$a['pos_text'],0,0,'L');
		}
		$this->Cell(25,4,$a['pos_price'],0,0,'L');
		$this->Cell(30,4,$a['pos_amount'],0,0,'L');
	}
	//Übertrag anzeigen
	if(($this->PageNo()>1)and($Type != 'DeliveryNote')){
		$this->Ln();
		$this->SetFont($PDFFont,'I',$PDFFontsize1);
		$this->line($PDFLeftMargin,$this->GetY()+4,210-$PDFRightMargin,$this->GetY()+4);
		if($PrintPositionName == "1"){
			$this->Cell(10);
		}
		$this->Cell(20);
		$this->Cell(210-$PDFRightMargin-$this->GetX()-30,4,$a['pos_amount_carried_forward'].':',0,0,'R');
		$this->Cell(30,4,Format_Number($Subtotal_netto).' '.$Currency,0,0,'R');
		$this->SetFont($PDFFont,'',$PDFFontsize1);
	}
	}
	$this->Ln();
	
?>