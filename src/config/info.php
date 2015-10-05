<?php

/*
	info.php

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

$smarty->assign("Title","$a[settings] - $a[info]");
$smarty->assign("Basic_Settings","$a[basic_settings]");
$smarty->assign("Company_Settings","$a[company_settings]");
$smarty->assign("PDF_Settings","$a[pdf_settings]");
$smarty->assign("Print_Company_Data","$a[print_company_data]");
$smarty->assign("Print_Position_Name","$a[print_position_name]");
$smarty->assign("Email_Internal","$a[email_internal]");
$smarty->assign("Email_Use_Signature","$a[email_use_signature]");
$smarty->assign("Email_Signature","$a[email_signature]");
$smarty->assign("Use_Reminder","$a[reminder]");
$smarty->assign("Reminder_Days","$a[reminder_days]");
$smarty->assign("Entries_Per_Page","$a[entries_per_page]");
$smarty->assign("Session_Sec","$a[session_sec]");

// Database connection
//
DBConnect();

// Get entrys from setting table
//
$query = $db->Execute("SELECT PRINT_COMPANY_DATA, PRINT_POSITION_NAME, EMAIL_INTERNAL, EMAIL_USE_SIGNATURE, EMAIL_SIGNATURE,
	REMINDER, REMINDER_DAYS, ENTRYS_PER_PAGE, SESSION_SEC, SETTINGID FROM {$TBLName}setting WHERE SETTINGID=$settingID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$pcd = $f['PRINT_COMPANY_DATA'];
		$ppn = $f['PRINT_POSITION_NAME'];
		$ei = $f['EMAIL_INTERNAL'];
		$eus = $f['EMAIL_USE_SIGNATURE'];
		$re = $f['REMINDER'];
		$smarty->assign("PrintCompanyData","$choice_yes_no[$pcd]");
		$smarty->assign("PrintPositionName","$choice_yes_no[$ppn]");
		$smarty->assign("EmailInternal","$choice_yes_no[$ei]");
		$smarty->assign("EmailUseSignature","$choice_yes_no[$eus]");
		$smarty->assign("EmailSignature","$f[EMAIL_SIGNATURE]");
		$smarty->assign("Reminder","$choice_yes_no[$re]");
		$smarty->assign("ReminderDays","$f[REMINDER_DAYS]");
		$smarty->assign("EntrysPerPage","$f[ENTRYS_PER_PAGE]");
		$smarty->assign("SessionSec","$f[SESSION_SEC]");
	}

$smarty->display('config/info.tpl');

?>
