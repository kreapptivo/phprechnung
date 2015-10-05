<?php

/*
	pos_pdf.inc.php

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

// Booking_Details
//
$TotalAmount = 0;

// Cashbook
//
$TotalTakings = 0;
$TotalExpenditures = 0;
$StartingWith = 0;
$CashInHand = 0;

// Invoice_Ledger & Customer_Invoices
//
$TotalInvoiceAmount = 0;
$TotalSumPaid = 0;
$TotalOpenAmount = 0;

// If an error has occurred, display the error message
//
if (!$posquery)
	print($db->ErrorMsg());
else
	// Save all entrys in $PosData array
	//
	foreach($posquery as $posresult)
	{
		if(isset($Type) && $Type == 'Booking_Details' or $Type == 'Customer_Booking_Details')
		{
			$pdf->SetWidths(array(25,85,20,30,35));
			$pdf->SetAligns(array('L','L','C','R','L'));

			if($posresult['CANCELED'] == 1)
			{
				$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
				$pdf->SetTextColor(128,128,128);
			}
			else
			{
				$pdf->SetFont($PDFFont,'',$PDFFontsize2);
				$pdf->SetTextColor(0,0,0);
			}

			if($posresult['FIRSTNAME'] != "")
			{
				$Firstname = $posresult['FIRSTNAME'].' ';
			}
			else
			{
				$Firstname = "";
			}
			if($posresult['LASTNAME'] != "")
			{
				$Lastname = $posresult['LASTNAME'].', ';
			}
			else
			{
				$Lastname = "";
			}
			
			$pdf->Row(array($posresult['PAYMENTID'],$Firstname.''.$Lastname.''.$posresult['COMPANY'],$posresult['PAYMENT_DATE'],Format_Number($posresult['SUM_PAID']),$posresult['METHOD_OF_PAY']));
			$TotalAmount += $posresult['SUM_PAID'];
		}
		else if(isset($Type) && $Type == 'Cashbook')
		{
			$pdf->SetWidths(array(25,25,25,25,25,70));
			$pdf->SetAligns(array('L','R','R','R','C','L'));

			if($posresult['CANCELED'] == 1)
			{
				$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
				$pdf->SetTextColor(128,128,128);
			}
			else
			{
				$pdf->SetFont($PDFFont,'',$PDFFontsize2);
				$pdf->SetTextColor(0,0,0);
			}

			if($posresult['TAKINGS'] != 0)
			{
				$Takings = Format_Number($posresult['TAKINGS']);
			}
			else
			{
				$Takings = "";
			}

			if($posresult['EXPENDITURES'] != 0)
			{
				$Expenditures = Format_Number($posresult['EXPENDITURES']);
			}
			else
			{
				$Expenditures = "";
			}
			
			$pdf->Row(array($posresult['CASHBOOKID'],$Takings,$Expenditures,Format_Number($posresult['CASH_IN_HAND']),$posresult['CASHBOOK_DDATE'],$posresult['DESCRIPTION']));
			$TotalTakings += $posresult['TAKINGS'];
			$TotalExpenditures += $posresult['EXPENDITURES'];
		}
		else if(isset($Type) && $Type == 'Invoice_Ledger' or $Type == 'Customer_Invoices')
		{
			$pdf->SetWidths(array(25,75,25,35,35));
			$pdf->SetAligns(array('L','L','C','R','R'));

			if($posresult['CANCELED'] == 1)
			{
				$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
				$pdf->SetTextColor(128,128,128);
			}
			else
			{
				$pdf->SetFont($PDFFont,'',$PDFFontsize2);
				$pdf->SetTextColor(0,0,0);
			}

			if($posresult['FIRSTNAME'] != "")
			{
				$Firstname = $posresult['FIRSTNAME'].' ';
			}
			else
			{
				$Firstname = "";
			}
			if($posresult['LASTNAME'] != "")
			{
				$Lastname = $posresult['LASTNAME'].', ';
			}
			else
			{
				$Lastname = "";
			}

			if(($posresult['TOTAL_AMOUNT']-$posresult['SUM_PAID']) != 0)
			{
				$Open_Account = Format_Number($posresult['TOTAL_AMOUNT']-$posresult['SUM_PAID']);
			}
			else
			{
				$Open_Account = "";
			}
			
			$pdf->Row(array($posresult['INVOICEID'],$Firstname.''.$Lastname.''.$posresult['COMPANY'],$posresult['INVOICE_DATE'],Format_Number($posresult['TOTAL_AMOUNT']),$Open_Account));
			$TotalInvoiceAmount += $posresult['TOTAL_AMOUNT'];
			$TotalSumPaid += $posresult['SUM_PAID'];
			$TotalOpenAmount = $TotalInvoiceAmount-$TotalSumPaid;
		}
		else if(isset($Type) && $Type == 'Invoice_Ledger_Summary')
		{
			$pdf->SetWidths(array(115,40,40));
			$pdf->SetAligns(array('L','R','R'));

			if($posresult['CANCELED'] == 1)
			{
				$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
				$pdf->SetTextColor(128,128,128);
			}
			else
			{
				$pdf->SetFont($PDFFont,'',$PDFFontsize2);
				$pdf->SetTextColor(0,0,0);
			}

			if($posresult['FIRSTNAME'] != "")
			{
				$Firstname = $posresult['FIRSTNAME'].' ';
			}
			else
			{
				$Firstname = "";
			}
			if($posresult['LASTNAME'] != "")
			{
				$Lastname = $posresult['LASTNAME'].', ';
			}
			else
			{
				$Lastname = "";
			}

			if(($posresult['TOTAL_AMOUNT']-$posresult['SUM_PAID']) != 0)
			{
				$Open_Account = Format_Number($posresult['TOTAL_AMOUNT']-$posresult['SUM_PAID']);
			}
			else
			{
				$Open_Account = "";
			}

			$Percentage = Format_Number($posresult['TOTAL_AMOUNT']/$TotalInvoiceSum*100);
			$pdf->Row(array($posresult['MYID'].' - '.$Firstname.''.$Lastname.''.$posresult['COMPANY'],Format_Number($posresult['TOTAL_AMOUNT']).' ('.$Percentage.'%)',$Open_Account));
		}
		else if(isset($Type) && $Type == 'Customer_Outstanding_Accounts' or $Type == 'User_Outstanding_Accounts' or $Type == 'Outstanding_Accounts')
		{
			$pdf->SetWidths(array(25,75,25,35,35));
			$pdf->SetAligns(array('L','L','C','R','R'));

			$pdf->SetFont($PDFFont,'',$PDFFontsize2);
			$pdf->SetTextColor(0,0,0);

			if($posresult['FIRSTNAME'] != "")
			{
				$Firstname = $posresult['FIRSTNAME'].' ';
			}
			else
			{
				$Firstname = "";
			}
			if($posresult['LASTNAME'] != "")
			{
				$Lastname = $posresult['LASTNAME'].', ';
			}
			else
			{
				$Lastname = "";
			}
			
			$pdf->Row(array($posresult['INVOICEID'],$Firstname.''.$Lastname.''.$posresult['COMPANY'],$posresult['INVOICE_DATE'],Format_Number($posresult['TOTAL_AMOUNT']),Format_Number($posresult['TOTAL_AMOUNT']-$posresult['SUM_PAID'])));

			$TotalInvoiceAmount += $posresult['TOTAL_AMOUNT'];
			$TotalSumPaid += $posresult['SUM_PAID'];
			$TotalOpenAmount = $TotalInvoiceAmount-$TotalSumPaid;
		}
		else if(isset($Type) && $Type == 'Outstanding_Offers')
		{
			$pdf->SetWidths(array(25,75,25,25,45));
			$pdf->SetAligns(array('L','L','C','R','L'));

			if($posresult['CANCELED'] == 1)
			{
				$pdf->SetFont($PDFFont,'U',$PDFFontsize2);
				$pdf->SetTextColor(128,128,128);
			}
			else
			{
				$pdf->SetFont($PDFFont,'',$PDFFontsize2);
				$pdf->SetTextColor(0,0,0);
			}

			if($posresult['FIRSTNAME'] != "")
			{
				$Firstname = $posresult['FIRSTNAME'].' ';
			}
			else
			{
				$Firstname = "";
			}
			if($posresult['LASTNAME'] != "")
			{
				$Lastname = $posresult['LASTNAME'].', ';
			}
			else
			{
				$Lastname = "";
			}
			
			$pdf->Row(array($posresult['OFFERID'],$Firstname.''.$Lastname.''.$posresult['COMPANY'],$posresult['OFFER_DATE'],Format_Number($posresult['TOTAL_AMOUNT']),$offer_status[$posresult['STATUS']]));
			$TotalAmount += $posresult['TOTAL_AMOUNT'];
		}
		else if(isset($Type) && $Type == 'Position_Sales')
		{
			$pdf->SetWidths(array(25,85,25,30,30));
			$pdf->SetAligns(array('L','L','R','R','R'));

			$pdf->SetFont($PDFFont,'',$PDFFontsize2);
			$pdf->SetTextColor(0,0,0);

			$pdf->Row(array($posresult['POS_NAME'],$posresult['POS_DESC'],$posresult['POS_QUANTITY'],Format_Number($posresult['POS_PRICE']),Format_Number($posresult['POS_QUANTITY']*$posresult['POS_PRICE'])));

			$TotalAmount += $posresult['POS_QUANTITY']*$posresult['POS_PRICE'];
		}
		else if(isset($Type) && $Type == 'Position_Sales_Summary')
		{
			$pdf->SetWidths(array(25,100,25,45));
			$pdf->SetAligns(array('L','L','R','R'));

			$pdf->SetFont($PDFFont,'',$PDFFontsize2);
			$pdf->SetTextColor(0,0,0);

			$Percentage = Format_Number($posresult['POS_AMOUNT']/$TotalPosAmount*100);

			$pdf->Row(array($posresult['POS_NAME'],$posresult['POS_DESC'],$posresult['POS_QUANTITY'],Format_Number($posresult['POS_AMOUNT']).' ('.$Percentage.'%)'));
		}
	
	$pdf->SetFont($PDFFont,'',$PDFFontsize2);
	$pdf->SetTextColor(0,0,0);
	}

	if(isset($Type) && $Type == 'Cashbook')
	{
		$StartingWith2 = 0;
		$TotalTakings2 = 0;
		$TotalExpenditures2 = 0;

		foreach($posquery2 as $posresult2)
		{
			$StartingWith2 += $posresult2['CASH_IN_HAND_STARTING_WITH'];
			$TotalTakings2 += $posresult2['TAKINGS'];
			$TotalExpenditures2 += $posresult2['EXPENDITURES'];
			$StartingWith = $TotalTakings2-$TotalExpenditures2+$StartingWith2;
		}
	}

	if(isset($Type) && $Type == 'Cashbook')
	{
		$StartingWith3 = 0;
		$TotalTakings3 = 0;
		$TotalExpenditures3 = 0;

		foreach($posquery3 as $posresult3)
		{

			$StartingWith3 += $posresult3['CASH_IN_HAND_STARTING_WITH'];
			$TotalTakings3 += $posresult3['TAKINGS'];
			$TotalExpenditures3 += $posresult3['EXPENDITURES'];
			$CashInHand = $TotalTakings3-$TotalExpenditures3+$StartingWith3;
		}
	}

?>
