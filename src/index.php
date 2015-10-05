<?php

/*
	index.php

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

require_once("include/phprechnung.inc.php");
require_once("include/smarty.inc.php");

CheckUser();
CheckSession();
UserSite();

// Get current date
//
$Today = date('d.m.Y');

// Database connection
//
DBConnect();

// Select all invoices with open accounts
//
$query = $db->Execute("SELECT PAID, DATE_FORMAT(INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DDATE, CREATEDBY FROM {$TBLName}invoice WHERE PAID='2' AND CREATEDBY='$_SESSION[Username]' ORDER BY INVOICE_DATE ASC LIMIT 1");

if (!$query)
{
	$_SESSION['UserReminder'] = "0";
}
else
{
	foreach($query as $f)
	{
		$Date_From = $f['INVOICE_DDATE'];
		$smarty->assign("From_Date","$Date_From");

		$Paid = $f['PAID'];
		$CreatedBy = $f['CREATEDBY'];

		// Explode date and calculate how many days the account is open
		//
		if(!empty($Today))
			list($day1,$month1,$year1)=explode(".",$Today);
		if(!empty($Date_From))
			list($day2,$month2,$year2)=explode(".",$Date_From);

		$date1 = mktime(0,0,0,$month1,$day1,$year1);
		$date2 = mktime(0,0,0,$month2,$day2,$year2);
		$difference = round(($date1-$date2)/86400); // Date today - from / 24h
		$smarty->assign("Difference","$difference");
		$till_date  = date('d.m.Y',mktime(0, 0, 0, date('m'), date('d')-$ReminderDays, date('Y')));
		$smarty->assign("Till_Date","$till_date");

		// Who is logged in ?
		//
		if(isset($_SESSION['Username']) && $_SESSION['Username'] == $CreatedBy && $Reminder == '1' && $difference >= $ReminderDays && $Paid == '2')
		{
			$_SESSION['UserReminder'] = "1";
		}
	}
}

$smarty->assign("Title","$a[startpage]");
$smarty->assign("Welcome","$a[welcome]");
$smarty->assign("License","$a[license]");
$smarty->assign("OpenAccountMsg","$a[open_invoice]");
$smarty->assign("OpenSince","$a[open_since]");

// Get Update Status Information
//
//DEPRECATED!!!
/***
$query1 = $db->Execute("SELECT LOGINUPDATE, TABLEUPDATE FROM {$TBLName}updatetable WHERE UPDATEID=1");

if (!$query1)
	print($db->ErrorMsg());
else
	foreach($query1 as $f1)
	{
		$smarty->assign("LOGINUPDATE",$f1['LOGINUPDATE']);
		$smarty->assign("TABLEUPDATE",$f1['TABLEUPDATE']);
	}

***/
$smarty->assign("LOGINUPDATE",1);
$smarty->assign("TABLEUPDATE",1);

$smarty->display('index.tpl');

// Delete the reminder session
//
unset ($_SESSION['UserReminder']);

?>