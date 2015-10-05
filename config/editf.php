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

if(!is_numeric($settingID) || $settingID <= 0 )
{
	die(header("Location: $web"));
}

// Database connection
//
DBConnect();

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark","$mark");
}

if ($D_Entries_Per_Page < 25)
{
	$smarty->assign("FieldError","$a[entries_per_page] - $a[field_error]");
	UserInput("D_Entries_Per_Page");
	$smarty->display('config/editf.tpl');
}
else if ($D_Session_Sec < 120)
{
	$smarty->assign("FieldError","$a[session_sec] - $a[field_error]");
	UserInput("D_Session_Sec");
	$smarty->display('config/editf.tpl');
}
else
{
	$query = $db->Execute("UPDATE {$TBLName}setting SET PRINT_COMPANY_DATA='$D_Print_Company_Data', PRINT_POSITION_NAME='$D_Print_Position_Name', EMAIL_INTERNAL='$D_Email_Internal', EMAIL_USE_SIGNATURE='$D_Email_Use_Signature', EMAIL_SIGNATURE='$D_Email_Signature', INVENTORY_CHECK_ACTIVE='2', REMINDER='$D_Reminder', REMINDER_DAYS='$D_Reminder_Days', REMINDER_PRICE='0.00', ENTRYS_PER_PAGE='$D_Entries_Per_Page', SESSION_SEC='$D_Session_Sec', MODIFIEDBY='$_SESSION[Username]' WHERE SETTINGID=$settingID");
	
	Header("Location: $web/config/list.php?page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$settingID");
}

?>
