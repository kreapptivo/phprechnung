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
CheckAdminGroup1();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($taxID) || $taxID <= 0 )
{
	die(header("Location: $web"));
}

if($taxID == '4')
{
	$TaxDivide = 0;
	$TaxMultiply = 0;
}

// Database connection
//
DBConnect();

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($TaxDivide) && $taxID != 4)
{
	$smarty->assign("FieldError","$a[tax_divide] - $a[field_error]");
	UserInput("TaxDivide");
	$smarty->display('tax/editf.tpl');
}
else if (empty($TaxMultiply) && $taxID != 4)
{
	$smarty->assign("FieldError","$a[tax_multiply] - $a[field_error]");
	UserInput("TaxMultiply");
	$smarty->display('tax/editf.tpl');
}
else if (empty($TaxDescription))
{
	$smarty->assign("FieldError","$a[tax_description] - $a[field_error]");
	UserInput("TaxDescription");
	$smarty->display('tax/editf.tpl');
}
else
{
	$query1 = $db->Execute("SELECT TAXID, TAX_DESC, TAX_DIVIDE, TAX_MULTI FROM {$TBLName}tax WHERE TAX_DESC='$TaxDescription' AND TAX_DIVIDE='$TaxDivide' AND TAX_MULTI='$TaxMultiply' AND TAXID != $taxID");
	$numrows1 = $query1->RowCount();

	if ($numrows1)
	{
		$smarty->assign("FieldError","$a[entry_exist]");
		UserInput("TaxDivide");
		$smarty->display('tax/editf.tpl');
	}
	else
	{
		$query2 = "UPDATE {$TBLName}tax SET TAX_DESC='$TaxDescription', TAX_DIVIDE='$TaxDivide', TAX_MULTI='$TaxMultiply', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE TAXID=$taxID";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query3 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query3 .= "VALUES(NULL, '$CurrentDateTime', '$TaxDescription - Tax-No.: $taxID was MODIFIED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress', 'admin', '1', '2')";
		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['EditID'] = "1";

		Header("Location: $web/tax/list.php?taxID=$taxID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$taxID");
	}
}

?>
