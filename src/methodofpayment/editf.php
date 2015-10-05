<?php

/*
	editf.php

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

require_once("../include/phprechnung.inc.php");
require_once("../include/smarty.inc.php");

CheckUser();
CheckAdminGroup2();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($methodpayID) || $methodpayID <= 0 )
{
	die(header("Location: $web"));
}

// Database connection
//
DBConnect();

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($Method_Of_Payment))
{
	$smarty->assign("FieldError","$a[method_of_payment] - $a[field_error]");
	UserInput("Method_Of_Payment");
	$smarty->display('methodofpayment/editf.tpl');
}
else if ($methodpayID == 2)
{
	$smarty->assign("FieldError","$a[method_of_payment] - $a[field_error]");
	UserInput("");
	$smarty->display('methodofpayment/editf.tpl');
}
else
{
	$query1 = $db->Execute("SELECT METHODOFPAYID, DESCRIPTION FROM {$TBLName}methodofpay WHERE DESCRIPTION='$Method_Of_Payment' AND METHODOFPAYID != $methodpayID");
	$numrows1 = $query1->RowCount();

	if ($numrows1)
	{
		$smarty->assign("FieldError","$a[entry_exist]");
		UserInput("Method_Of_Payment");
		$smarty->display('methodofpayment/editf.tpl');
	}
	else
	{
		$query2 = "UPDATE {$TBLName}methodofpay SET DESCRIPTION='$Method_Of_Payment', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE METHODOFPAYID=$methodpayID";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['EditID'] = "1";

		if($infoID == '9')
		{
			Header("Location: $web/methodofpayment/searchlist.php?methodpayID=$methodpayID&page=$page&Description_1=$Description_1&Order=$Order&Sort=$Sort&$sessname=$sessid#$methodpayID");
		}
		else
		{
			Header("Location: $web/methodofpayment/list.php?methodpayID=$methodpayID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$methodpayID");
		}
	}
}

?>
