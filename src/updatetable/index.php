<?php
/*
	index.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2008 Edy Corak < phprechnung at ecorak dot net >

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
CheckAdmin();
CheckSession();

$smarty->assign("Title","$a[startpage]");
$smarty->assign("Welcome","$a[welcome]");
$smarty->assign("License","$a[license]");

// Database connection
//
DBConnect();

// Get Update Status Information
//
$query = $db->GetAll("SELECT LOGINUPDATE, TABLEUPDATE FROM {$TBLName}updatetable WHERE UPDATEID=1");

if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$smarty->assign("LOGINUPDATE",$f['LOGINUPDATE']);
		$smarty->assign("TABLEUPDATE",$f['TABLEUPDATE']);
	}

$smarty->display('updatetable/index.tpl');

?>
