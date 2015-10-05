<?php

/*
	edit.php

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

$smarty->assign("Title","$a[tax] - $a[edit]");
$smarty->assign("Tax_Divide","$a[tax_divide]");
$smarty->assign("Tax_Multiply","$a[tax_multiply]");
$smarty->assign("Tax_Description","$a[tax_description]");

// Database connection
//
DBConnect();

// Get entrys from tax table
//
$query = $db->Execute("SELECT TAXID, TAX_DIVIDE, TAX_MULTI, TAX_DESC FROM {$TBLName}tax WHERE TAXID=$taxID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		if (empty($TaxDivide))
		{
			$smarty->assign("TAX_DIVIDE",$f['TAX_DIVIDE']);
		}
		else
		{
			$smarty->assign("TAX_DIVIDE",$TaxDivide);
		}
		if (empty($TaxMultiply))
		{
			$smarty->assign("TAX_MULTIPLY",$f['TAX_MULTI']);
		}
		else
		{
			$smarty->assign("TAX_MULTIPLY",$TaxMultiply);
		}
		if (empty($TaxDescription))
		{
			$smarty->assign("TAX_DESCRIPTION",$f['TAX_DESC']);
		} else {
			$smarty->assign("TAX_DESCRIPTION",$TaxDescription);
		}
	}

$smarty->display('tax/edit.tpl');

?>
