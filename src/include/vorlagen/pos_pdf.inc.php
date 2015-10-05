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

// If an error has occurred, display the error message
//

$Total1 = 0;
$Total2 = 0;
$Total3 = 0;
$Total4 = 0;

if (!$posquery)
	print($db->ErrorMsg());
else
	// Save all entrys in $PosData array
	//
	foreach($posquery as $posresult)
	{
		$PosData[] = $posresult;

		if ( $posresult['TAX'] == '1' )
		{
			if($SalesPrices == '1')
			{
				$Subtotal1 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_MULTI'] > 0)
				{
					$Tax1 = $Subtotal1 * $posresult['TAX_MULTI'];
				}
				$Total1 = $Subtotal1 + $Tax1;
			}
			else
			{
				$Total1 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_DIVIDE'] > 0)
				{
					$Subtotal1 = $Total1 / $posresult['TAX_DIVIDE'];
					$Tax1 = $Total1 / $posresult['TAX_DIVIDE'] * $posresult['TAX_MULTI'];
				}
				else
				{
					$Subtotal1 = $Total1;
				}
			}
			$Tax1_Desc = $posresult['TAX_DESC'];
		}

		if ( $posresult['TAX'] == '2' )
		{
			if($SalesPrices == '1')
			{
				$Subtotal2 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_MULTI'] > 0)
				{
					$Tax2 = $Subtotal2 * $posresult['TAX_MULTI'];
				}
				$Total2 = $Subtotal2 + $Tax2;
			}
			else
			{
				$Total2 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_DIVIDE'] > 0)
				{
					$Subtotal2 = $Total2 / $posresult['TAX_DIVIDE'];
					$Tax2 = $Total2 / $posresult['TAX_DIVIDE'] * $posresult['TAX_MULTI'];
				}
				else
				{
					$Subtotal2 = $Total2;
				}
			}
			$Tax2_Desc = $posresult['TAX_DESC'];
		}

		if ( $posresult['TAX'] == '3' )
		{
			if($SalesPrices == '1')
			{
				$Subtotal3 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_MULTI'] > 0)
				{
					$Tax3 = $Subtotal3 * $posresult['TAX_MULTI'];
				}
				$Total3 = $Subtotal3 + $Tax3;
			}
			else
			{
				$Total3 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_DIVIDE'] > 0)
				{
					$Subtotal3 = $Total3 / $posresult['TAX_DIVIDE'];
					$Tax3 = $Total3 / $posresult['TAX_DIVIDE'] * $posresult['TAX_MULTI'];
				}
				else
				{
					$Subtotal3 = $Total3;
				}
			}
			$Tax3_Desc = $posresult['TAX_DESC'];
		}

		if ( $posresult['TAX'] == '4' )
		{
			if($SalesPrices == '1')
			{
				$Subtotal4 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_MULTI'] > 0)
				{
					$Tax4 = $Subtotal4 * $posresult['TAX_MULTI'];
				}
				$Total4 = $Subtotal4 + $Tax4;
			}
			else
			{
				$Total4 += $posresult['POS_QUANTITY'] * $posresult['POS_PRICE'];
				if($posresult['TAX_DIVIDE'] > 0)
				{
					$Subtotal4 = $Total4 / $posresult['TAX_DIVIDE'];
					$Tax4 = $Total4 / $posresult['TAX_DIVIDE'] * $posresult['TAX_MULTI'];
				}
				else
				{
					$Subtotal4 = $Total4;
				}
			}
			$Tax4_Desc = $posresult['TAX_DESC'];
		}

		if($posresult['POS_QUANTITY'] != 0)
		{
			$Pos_Quantity = $posresult['POS_QUANTITY'];
		}
		else
		{
			$Pos_Quantity = "";
		}

		if($posresult['POS_PRICE'] != 0)
		{
			$Pos_Price = Format_Number($posresult['POS_PRICE']);
		}
		else
		{
			$Pos_Price = "";
		}

		if($posresult['POS_PRICE'] != 0)
		{
			$Pos_Tax = $posresult['TAX_DESC'];
		}
		else
		{
			$Pos_Tax = "";
		}

		$Pos_Sum = $posresult['POS_PRICE']*$posresult['POS_QUANTITY'];

		if($Pos_Sum != 0)
		{
			$Pos_Sum = Format_Number($Pos_Sum);
		}
		else
		{
			$Pos_Sum = "";
		}

		if ($Type == 'DeliveryNote')
		{
			if($PrintPositionName == "1")
			{
				$pdf->SetWidths(array(25,140,30));
				$pdf->SetAligns(array('L','L','R'));
				$pdf->Row(array($posresult['POS_NAME'],$posresult['POS_DESC'],$Pos_Quantity));
			}
			else
			{
				$pdf->SetWidths(array(165,30));
				$pdf->SetAligns(array('L','R'));
				$pdf->Row(array($posresult['POS_DESC'],$Pos_Quantity));
			}
		}
		else
		{
			if($PrintPositionName == "1")
			{
				if($TaxFree == "1")
				{
					$pdf->SetWidths(array(25,95,20,20,35));
					$pdf->SetAligns(array('L','L','R','R','R'));
					$pdf->Row(array($posresult['POS_NAME'],$posresult['POS_DESC'],$Pos_Quantity,$Pos_Price,$Pos_Sum));
				}
				else
				{
					$pdf->SetWidths(array(25,95,20,20,15,20));
					$pdf->SetAligns(array('L','L','R','R','R','R'));
					$pdf->Row(array($posresult['POS_NAME'],$posresult['POS_DESC'],$Pos_Quantity,$Pos_Price,$Pos_Tax,$Pos_Sum));
				}
			}
			else
			{
				if($TaxFree == "1")
				{
					$pdf->SetWidths(array(120,20,20,35));
					$pdf->SetAligns(array('L','R','R','R'));
					$pdf->Row(array($posresult['POS_DESC'],$Pos_Quantity,$Pos_Price,$Pos_Sum));
				}
				else
				{
					$pdf->SetWidths(array(120,20,20,15,20));
					$pdf->SetAligns(array('L','R','R','R','R'));
					$pdf->Row(array($posresult['POS_DESC'],$Pos_Quantity,$Pos_Price,$Pos_Tax,$Pos_Sum));
				}
			}
		}
	}

	$TOTAL_AMOUNT = $Total1+$Total2+$Total3+$Total4;

?>
