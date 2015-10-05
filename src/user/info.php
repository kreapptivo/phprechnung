<?php

/*
	info.php

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

require_once("../include/phprechnung.inc.php");
require_once("../include/smarty.inc.php");

CheckUser();
CheckSession();

$ArrayValue = CheckArrayValue($_REQUEST);

foreach($ArrayValue as $key => $val)
{
	$$key = $val;
	$smarty->assign("$key",$val);
}

if(!is_numeric($userID) || $userID <= 0 )
{
	die(header("Location: $web"));
}

$smarty->assign("Title","$a[user_admin] - $a[info]");
$smarty->assign("User_Active","$a[user_active]");
$smarty->assign("Full_Name","$a[fullname]");
$smarty->assign("User_Name","$a[username]");
$smarty->assign("User_Group","$a[usergroup]");
$smarty->assign("Language","$a[language]");

// Database connection
//
DBConnect();

// Get entrys from user table
//
$query = $db->Execute("SELECT USERID, FULLNAME, USERNAME, USERGROUP1, USERGROUP2, LANGUAGE, USER_ACTIVE FROM {$TBLName}user WHERE USERID=$userID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$UserActive = $f['USER_ACTIVE'];
		$UserLanguage = $f['LANGUAGE'];
		$UserGroup1 = $f['USERGROUP1'];
		$UserGroup2 = $f['USERGROUP2'];
		$UserName = $f['USERNAME'];
		$smarty->assign("FULLNAME",$f['FULLNAME']);
		$smarty->assign("USERNAME",$UserName);
		$smarty->assign("USERACTIVE",$choice_yes_no[$UserActive]);
		$smarty->assign("LANGUAGE",$language[$UserLanguage]);
		$smarty->assign("USERGROUP1",$group[$UserGroup1]);
		$smarty->assign("USERGROUP2",$group[$UserGroup2]);
	}

	if(!is_Superuser() && !is_Admin() &&  $_SESSION['Username'] != $UserName)
	{
		$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		$_SESSION['logoutid'] = "5";
		Header("Location: $web/login/sustart.php?$sessname=$sessid");
	}
	else
	{
		UserSite();
		$smarty->display('user/info.tpl');
	}

?>
