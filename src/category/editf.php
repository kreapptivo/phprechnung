<?php

/*
	editf.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
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

if(!is_numeric($categoryID) || $categoryID <= 0 )
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

if (empty($CCategory))
{
	$smarty->assign("FieldError","$a[category] - $a[field_error]");
	UserInput("CCategory");
	$smarty->display('category/editf.tpl');
}
else
{
	$query1 = $db->Execute("SELECT CATEGORYID, DESCRIPTION FROM {$TBLName}category WHERE DESCRIPTION='$CCategory' AND CATEGORYID != $categoryID");
	$numrows1 = $query1->RowCount();

	if ($numrows1)
	{
		$smarty->assign("FieldError","$a[entry_exist]");
		UserInput("CCategory");
		$smarty->display('category/editf.tpl');
	}
	else
	{
		$query2 = "UPDATE {$TBLName}category SET DESCRIPTION='$CCategory', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE CATEGORYID=$categoryID";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['EditID'] = "1";

		if($infoID == '9')
		{
			Header("Location: $web/category/searchlist.php?categoryID=$categoryID&page=$page&Description_1=$Description_1&Order=$Order&Sort=$Sort&$sessname=$sessid#$categoryID");
		}
		else
		{
			Header("Location: $web/category/list.php?categoryID=$categoryID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$categoryID");
		}
	}
}

?>
