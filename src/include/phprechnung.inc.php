<?php

/*
	phprechnung.inc.php

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

ini_set("session.use_trans_sid", "0");

@session_start();
$sessname = session_name();
$sessid = session_id();

// Turn on different linkbars after lines ( default "25" )
//
$MultiBar = "25";

// This is the prefix for all table names in the SQL
// For example: if you wish to expand the name of the table 'invoice' e. g.
// 'phprechnung-invoice' you need to set $TBLName to $TBLName = "phprechnung-";
// WARNING: You must also expand all other table names with the same prefix
//
$TBLName = "";

// Please don't change $root, $admingroup_1, $admingroup_2 and $admingroup_3
//
$root = "admin";

// Root
//
$admingroup_1 = "1";

// Manager
//
$admingroup_2 = "2";

// Bookkeeping
//
$admingroup_3 = "3";

// Language selection
//
require_once("language.inc.php");

// For more information about
// ADOdb and supported databases
// see /include/adodb/docs/ or
// http://adodb.sourceforge.net/#docs
//
require_once("adodb/adodb.inc.php");

require_once("dbconf.php");

// Connect to database ( default mysql )
// The SQL needs adaptions in order to
// work with other databases
//
function DBConnect()
{
	global $db;
	$db = ADONewConnection('mysql');
	$db->autoRollback = true;
	$db->PConnect(_DBHOST, _DBUSER, _DBPASS, _DBNAME) or die($db->ErrorMsg());
}

// Close database connection
//
function DBClose()
{
	global $db;
	$db->Close() or $db->ErrorMsg();
}

// Include data from setting table
//
require_once("company_settings.inc.php");

// Get current date / time
//
$CurrentDateTime = date('Y-m-d H:i:s');

$CurrentDate = date('d.m.Y');

// Date format - htable.tpl
//
$Strftime = strftime('%A, %d. %B %Y %H:%M %Z');

// Change this to "1" if you want to use PEAR Mail::Interface
// Default "" PHP mail() function
//
$PHPSendMail = "1";

// Users IPAddress
//
$IPAddress = getenv('REMOTE_ADDR');

// Users Hostname
//
$Hostname = gethostbyaddr($IPAddress);

// Browser
//
$Browser = getenv('HTTP_USER_AGENT');

// Your own Webserver
//
$web = "http://localhost/phpRechnung";

// Key to encrypt and decrypt data
// Note: If you change this key, thereafter
// a login is no longer possible.
//
$pkey = "e76a669e075b6e034ec5911553a86abb";

// After User Update please replace $pkey with $pkeyOld
//
$pkeyOld = "e76a669e075b6e034ec5911553a86abb";

// Header to send first
//
header("Expires: Sat, 01 Mar 2003 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Important for MSIE on SSL, take a look at http://fpdf.org/
//
header("Pragma: public");

// Set default charset depend on selected language
//
header("Content-Type: text/html; charset=$_SESSION[Charset]");


// Logout user and delete TEMP Entry's
//
function Logout()
{
	global $db, $TBLName;
	DBConnect();
	$db->Execute("DELETE FROM {$TBLName}tmp_invoice WHERE USERNAME='$_SESSION[Username]'");
	$db->Execute("DELETE FROM {$TBLName}tmp_offer WHERE USERNAME='$_SESSION[Username]'");
	DBClose();
}

// Save last visited page by user
//
function UserSite()
{
	global $web;

	if (!empty($_SERVER['QUERY_STRING']))
	{
		$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		$_SESSION['UserSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	}
	else
	{
		$_SESSION['LastSite'] = $_SERVER['PHP_SELF'];
		$_SESSION['UserSite'] = $_SERVER['PHP_SELF'];
	}
}

// Check if any user are logged in
//
function CheckUser()
{
	global $web, $sessname, $sessid;
	if(!isset($_SESSION['Username']))
	{
		die(header("Location: $web/login/login.php?$sessname=$sessid"));
	}
	CheckLicense();
}

// Check if user has accepted the license
//
function CheckLicense()
{
	global $web, $sessname, $sessid;
	if(isset($_SESSION['LicenseAccepted']) && $_SESSION['LicenseAccepted'] != '1')
	{
		die(header("Location: $web/license.php?$sessname=$sessid"));
	}
}

// Are you administrator
//
function CheckAdmin()
{
	global $web, $root, $sessname, $sessid;
	if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root)
	{
		if (!empty($_SERVER['QUERY_STRING']))
		{
			$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		else
		{
			$_SESSION['LastSite'] = $_SERVER['PHP_SELF'];
		}
		$_SESSION['logoutid'] = "5";
		die(header("Location: $web/login/sustart.php?$sessname=$sessid"));
	}
}

// Are you in the administrator group1 ( Root )
//
function CheckAdminGroup1()
{
	global $web, $admingroup_1, $sessname, $sessid;

	if(isset($_SESSION['Usergroup1']) && $_SESSION['Usergroup1'] != $admingroup_1)
	{
		CheckAdminGroup2();
	}
}

// Are you in the administrator group2 ( Manager )
//
function CheckAdminGroup2()
{
	global $web, $admingroup_2, $sessname, $sessid;

	if(isset($_SESSION['Usergroup2']) && $_SESSION['Usergroup2'] != $admingroup_2)
	{
		if (!empty($_SERVER['QUERY_STRING']))
		{
			$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		else
		{
			$_SESSION['LastSite'] = $_SERVER['PHP_SELF'];
		}
		$_SESSION['logoutid'] = "5";
		die(header("Location: $web/login/sustart.php?$sessname=$sessid"));
	}
}

// Are you in the administrator group3 ( Bookkeeping )
// In order to access cashbook/reports as non admin user
// The Usergroup2 must be Bookkeeping
// Example: Usergroup1: User, Usergroup2: Bookkeeping
//
function CheckAdminGroup3()
{
	global $web, $admingroup_3, $sessname, $sessid;

	if(isset($_SESSION['Usergroup2']) && $_SESSION['Usergroup2'] != $admingroup_3)
	{
		CheckAdminGroup2();
	}
}

// Change German date output to MySQL (ISO-Date).
//
function German_Mysql_Date($date)
{
	@list($day, $month, $year) = explode('.', $date);
	return sprintf('%04d-%02d-%02d', $year, $month, $day);
}

// Change Date output for printing in YearMonthDay
//
function Print_Date($date)
{
	@list($day, $month, $year) = explode('.', $date);
	return sprintf('%04d%02d%02d', $year, $month, $day);
}

// Change the output of number_format printing ( default: 1.000,00 )
//
function Format_Number($number)
{
	$decimals = "2";
	$dec_point = ",";
	$thousands_sep = ".";

// 	return number_format($number,$decimals,$dec_point,$thousands_sep);
// 
// 	If your system doesn't support money_format then please change to number_format
// 
	return money_format('%!i',$number);
}

// Formats the number in a valid database format
//
function FormatDBNumber($number)
{
	// Negative numbers are also allowed
	//
	$number = preg_replace("/[^\-0-9\.]/", "", str_replace(',', '.', $number));

	return number_format($number, 2, '.', '');
}

function FormatDBNumberP($number)
{
	// Negative numbers are not allowed here
	//
	$number = preg_replace("/[^0-9\.]/", "", str_replace(',', '.', $number));

	return number_format($number, 2, '.', '');
}

// Limit current session to default time in seconds
// ( $SessionSec ), can be changed under
// Configuration / Settings min. 120 seconds
//
function CheckSession()
{
	global $web, $db, $SessionSec, $sessname, $sessid;
	$access = '1';

	if (isset($_SESSION['LastAccess']))
	{
		$timeout = time() - $_SESSION['LastAccess'];
		if ($timeout < $SessionSec)
		{
			$_SESSION['LastAccess'] = time();
			$access = '0';
		}
	}
	if ($access == '1')
	{
		die(header("Location: $web/login/sessionend.php?$sessname=$sessid"));
	}
	return;
}

// Check array value and escape hmtl special chars if found
//
function CheckArrayValue($arr)
{
	foreach ($arr as $key => $val)
		if (is_array($val))
			CheckArrayValue($arr[$key]);
		else
			$arr[$key] = htmlspecialchars($val, ENT_QUOTES, $_SESSION['Charset']);
	return $arr;
}

// Quotes a string to be sent to the database
//
function QuoteString($string)
{
	global $db;
	return $db->qstr($string,get_magic_quotes_gpc());
}

?>
