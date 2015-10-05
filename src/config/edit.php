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

if(!is_numeric($settingID) || $settingID <= 0 )
{
	die(header("Location: $web"));
}

$smarty->assign("Title","$a[settings] - $a[edit]");
$smarty->assign("Basic_Settings","$a[basic_settings]");
$smarty->assign("Company_Settings","$a[company_settings]");
$smarty->assign("PDF_Settings","$a[pdf_settings]");
$smarty->assign("Print_Company_Data","$a[print_company_data]");
$smarty->assign("Print_Position_Name","$a[print_position_name]");
$smarty->assign("Company_Logo","$a[company_logo]");
$smarty->assign("Company_Logo_Width","$a[company_logo_width]");
$smarty->assign("Company_Logo_Height","$a[company_logo_height]");
$smarty->assign("Email_Internal","$a[email_internal]");
$smarty->assign("Email_Use_Signature","$a[email_use_signature]");
$smarty->assign("Email_Signature","$a[email_signature]");
$smarty->assign("Stock_Active","$a[stock_active]");
$smarty->assign("Use_Reminder","$a[reminder]");
$smarty->assign("Reminder_Price","$a[reminder_price]");
$smarty->assign("Reminder_Days","$a[reminder_days]");
$smarty->assign("Entries_Per_Page","$a[entries_per_page]");
$smarty->assign("Session_Sec","$a[session_sec]");

// Get the arrays from language file
//
$smarty->assign("choice_yes_no",array($choice_yes_no));

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
		if (empty($D_Print_Company_Data))
		{
			$smarty->assign("D_Print_Company_Data","$f[PRINT_COMPANY_DATA]");
		}
		else
		{
			$smarty->assign("D_Print_Company_Data","$D_Print_Company_Data");
		}
		if (empty($D_Print_Position_Name))
		{
			$smarty->assign("D_Print_Position_Name","$f[PRINT_POSITION_NAME]");
		}
		else
		{
			$smarty->assign("D_Print_Position_Name","$D_Print_Position_Name");
		}
		if (empty($D_Email_Internal))
		{
			$smarty->assign("D_Email_Internal","$f[EMAIL_INTERNAL]");
		}
		else
		{
			$smarty->assign("D_Email_Internal","$D_Email_Internal");
		}
		if (empty($D_Email_Use_Signature))
		{
			$smarty->assign("D_Email_Use_Signature","$f[EMAIL_USE_SIGNATURE]");
		}
		else
		{
			$smarty->assign("D_Email_Use_Signature","$D_Email_Use_Signature");
		}
		if (empty($D_Email_Signature))
		{
			$smarty->assign("D_Email_Signature","$f[EMAIL_SIGNATURE]");
		}
		else
		{
			$smarty->assign("D_Email_Signature","$D_Email_Signature");
		}
		if (empty($D_Reminder))
		{
			$smarty->assign("D_Reminder","$f[REMINDER]");
		}
		else
		{
			$smarty->assign("D_Reminder","$D_Reminder");
		}
		if (empty($D_Reminder_Days))
		{
			$smarty->assign("D_Reminder_Days","$f[REMINDER_DAYS]");
		}
		else
		{
			$smarty->assign("D_Reminder_Days","$D_Reminder_Days");
		}
		if (empty($D_Entries_Per_Page))
		{
			$smarty->assign("D_Entries_Per_Page","$f[ENTRYS_PER_PAGE]");
		}
		else
		{
			$smarty->assign("D_Entries_Per_Page","$D_Entries_Per_Page");
		}
		if (empty($D_Session_Sec))
		{
			$smarty->assign("D_Session_Sec","$f[SESSION_SEC]");
		}
		else
		{
			$smarty->assign("D_Session_Sec","$D_Session_Sec");
		}
	}

$smarty->display('config/edit.tpl');

?>
