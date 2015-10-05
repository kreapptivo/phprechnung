<?php

/*	newf.php

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

require_once("../include/phprechnung.inc.php");
require_once("../include/smarty.inc.php");

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($invoiceID) || $invoiceID <= 0 )
{
	die(header("Location: $web"));
}

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if(isset($Sum_Paid))
	$Sum_Paid = FormatDBNumber($Sum_Paid);

$Total_Sum_Paid = FormatDBNumber($Total_Sum_Paid + $Sum_Paid);

if(!empty($PaymentDate))
	list($day, $month, $year) = explode(".", $PaymentDate);

if (empty($myID))
{
	$smarty->assign("FieldError","$a[customer] - $a[field_error]");
	UserInput("CustomerForm.invoiceID");
	$smarty->display('payment/newf.tpl');
}
else if (empty($PaymentDate) || !checkdate($month, $day, $year))
{
	$smarty->assign("FieldError","$a[date_text] - $a[field_error]");
	UserInput("PaymentDateForm.PaymentDate");
	$smarty->display('payment/newf.tpl');
}
else if (empty($Sum_Paid))
{
	$smarty->assign("FieldError","$a[payment] - $a[field_error]");
	UserInput("SumPaidForm.Sum_Paid");
	$smarty->display('payment/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	// Check if this invoice is fully paid
	//
	$query = $db->Execute("SELECT INVOICEID, PAID FROM {$TBLName}invoice WHERE PAID='1' AND INVOICEID=$invoiceID");
	$numrows = $query->RowCount();

	if ($numrows)
	{
		$smarty->assign("FieldError","$a[payment_error]");
		UserInput("");
		$smarty->display('payment/newf.tpl');
	}
	else
	{

		// Convert payment date to mysql ISO standard
		//
		$PaymentDate = German_Mysql_Date($PaymentDate);

		// Get the current method of payment description
		//
		$query1 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE METHODOFPAYID=$MethodOfPayment");

		if (!$query1)
			print($db->ErrorMsg());
		else
			foreach($query1 as $f1)
			{
				$MethodOfPayment_Desc = $f1['DESCRIPTION'];
			}

		// Check if method of payment is cash and $Sum_Paid is negative (credit note)
		//
		if (isset($MethodOfPayment) && $MethodOfPayment === "2" && $Sum_Paid < 0)
		{
			// Calculate cash in hand
			//
			$query7 = $db->Execute("SELECT TAKINGS, EXPENDITURES, CASH_IN_HAND_STARTING_WITH FROM {$TBLName}cashbook WHERE CANCELED=2");

			$ETotalTakings = 0;
			$ETotalExpenditures = 0;
			$ECash_In_Hand_Starting_With = 0;

			// If an error has occurred, display the error message
			//
			if (!$query7)
				print($db->ErrorMsg());
			else
				while (!$query7->EOF)
				{
					$ETotalTakings += $query7->fields['TAKINGS'];
					$ETotalExpenditures += $query7->fields['EXPENDITURES'];
					$ECash_In_Hand_Starting_With += $query7->fields['CASH_IN_HAND_STARTING_WITH'];
					$query7->MoveNext();
				}


			$ECash_In_Hand = $ECash_In_Hand_Starting_With + ( $ETotalTakings - $ETotalExpenditures );

			$ESum_Paid = FormatDBNumberP($Sum_Paid);
			$ECash_In_Hand_Day = $ECash_In_Hand - $ESum_Paid;
			$ECash_In_Hand_Day = FormatDBNumber($ECash_In_Hand_Day);

			if($ECash_In_Hand_Day <= 0)
			{
				$smarty->assign("FieldError","$a[payment] - $a[cashbook_expenditures]");
				UserInput("SumPaidForm.Sum_Paid");
				die($smarty->display('payment/newf.tpl'));
			}
			else
			{
				$query8 = "INSERT INTO {$TBLName}cashbook (CASHBOOKID, MYID, INVOICEID, PAYMENTID, DESCRIPTION, CASHBOOK_DATE, CASH_IN_HAND, EXPENDITURES, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
				$query8 .= "VALUES (NULL, '$myID', '$invoiceID', '$maxPaymentID', '$MethodOfPayment_Desc - $a[invoice_number] $invoiceID', '$PaymentDate', '$ECash_In_Hand_Day', '$ESum_Paid', '2', '$_SESSION[Username]', '$_SESSION[Username]', '1', '2', ".$db->sysTimeStamp.", ".$db->sysTimeStamp.")";
				if ($db->Execute($query8) === false)
				{
					die($db->ErrorMsg());
				}
			}
		}

		// Insert new payment
		//
		$query2 = "INSERT INTO {$TBLName}payment (PAYMENTID, MYID, INVOICEID, PAYMENT_DATE, METHODOFPAYID, METHOD_OF_PAY, CARDNR, VALIDTHRU, SUM_PAID, NOTE, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query2 .= "VALUES (NULL, '$myID', '$invoiceID', '$PaymentDate', '$MethodOfPayment', '$MethodOfPayment_Desc', '$Card_Number', '$Valid_Thru', '$Sum_Paid', '$Note', '2', '$_SESSION[Username]', '$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		// Get the last entry from 'payment'
		//
		$query3 = $db->GetRow("SELECT MAX(PAYMENTID) AS MAX_PAYMENTID FROM {$TBLName}payment");
		if (!$query3)
			print($db->ErrorMsg());
		else
			$maxPaymentID = $query3['MAX_PAYMENTID'];

		// Update invoice payment status
		//
		if ($Total_Sum_Paid === $Total_Amount)
		{
			$query4 = $db->Execute("UPDATE {$TBLName}invoice SET PAID='1', SUM_PAID='$Total_Sum_Paid', MODIFIED='$CurrentDateTime' WHERE INVOICEID=$invoiceID");
		}
		else
		{
			$query4 = $db->Execute("UPDATE {$TBLName}invoice SET SUM_PAID='$Total_Sum_Paid', MODIFIED='$CurrentDateTime' WHERE INVOICEID=$invoiceID");
		}

		if(isset($MethodOfPayment) && $MethodOfPayment === "2"  && $Sum_Paid > 0)
		{

			// Calculate cash in hand
			//
			$query5 = $db->Execute("SELECT TAKINGS, EXPENDITURES, CASH_IN_HAND_STARTING_WITH FROM {$TBLName}cashbook WHERE CANCELED=2");

			$TTotalTakings = 0;
			$TTotalExpenditures = 0;
			$TCash_In_Hand_Starting_With = 0;

			// If an error has occurred, display the error message
			//
			if (!$query5)
				print($db->ErrorMsg());
			else
				foreach($query5 as $result5)
				{
					$TTotalTakings += $result5['TAKINGS'];
					$TTotalExpenditures += $result5['EXPENDITURES'];
					$TCash_In_Hand_Starting_With += $result5['CASH_IN_HAND_STARTING_WITH'];
				}
			$TCash_In_Hand = $TCash_In_Hand_Starting_With + ( $TTotalTakings - $TTotalExpenditures );

			$TCash_In_Hand_Day = $TCash_In_Hand + $Sum_Paid;
		        $TCash_In_Hand_Day = FormatDBNumberP($TCash_In_Hand_Day);

			$query6 = "INSERT INTO {$TBLName}cashbook (CASHBOOKID, MYID, INVOICEID, PAYMENTID, DESCRIPTION, CASHBOOK_DATE, CASH_IN_HAND, TAKINGS, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
			$query6 .= "VALUES (NULL, '$myID', '$invoiceID', '$maxPaymentID', '$MethodOfPayment_Desc - $a[invoice_number] $invoiceID', '$PaymentDate', '$TCash_In_Hand_Day', '$Sum_Paid', '2', '$_SESSION[Username]', '$_SESSION[Username]', '1', '2', '$CurrentDateTime', '$CurrentDateTime')";

			if ($db->Execute($query6) === false)
			{
				die($db->ErrorMsg());
			}
		}

		$_SESSION['NewID'] = "1";

		Header("Location: $web/payment/new.php?$sessname=$sessid");
	}
}

?>
