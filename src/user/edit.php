<?php

/*
	edit.php

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

$smarty->assign("Title","$a[user_admin] - $a[edit]");
$smarty->assign("User_Active","$a[user_active]");
$smarty->assign("Full_Name","$a[fullname]");
$smarty->assign("User_Name","$a[username]");
$smarty->assign("User_Group","$a[usergroup]");
$smarty->assign("Language","$a[language]");
$smarty->assign("Password","$a[password]");
$smarty->assign("Repeat_Password","$a[repeat_password]");

// Database connection
//
DBConnect();

// Get entrys from anmeldung table
//
$query = $db->Execute("SELECT USERID, DECODE(FULLNAME,'$pkey') AS FULLNAME, DECODE(USERNAME,'$pkey') AS USERNAME, DECODE(USERGROUP1,'$pkey') AS USERGROUP1, DECODE(USERGROUP2,'$pkey') AS USERGROUP2, LANGUAGE, DECODE(PASSWORD,'$pkey') AS PASSWORD, USER_ACTIVE FROM {$TBLName}user WHERE USERID=$userID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$UserName = $f['USERNAME'];
		$ua = $f['USER_ACTIVE'];
		$ug1 = $f['USERGROUP1'];
		$ug2 = $f['USERGROUP2'];

		if (empty($FullName))
		{
			$smarty->assign("FULLNAME",$f['FULLNAME']);
		}
		else
		{
			$smarty->assign("FULLNAME",$FullName);
		}

		$smarty->assign("USERNAME",$UserName);
		$smarty->assign("PASSWORD",$f['PASSWORD']);

		if (empty($UserLanguage))
		{
			$smarty->assign("LANGUAGE",$f['LANGUAGE']);
		} else {
			$smarty->assign("LANGUAGE",$UserLanguage);
		}
		if (empty($UserGroup1))
		{
			$smarty->assign("USERGROUP1",$f['USERGROUP1']);
		}
		else
		{
			$smarty->assign("USERGROUP1",$UserGroup1);
		}
		if (empty($UserGroup2))
		{
			$smarty->assign("USERGROUP2",$f['USERGROUP2']);
		}
		else
		{
			$smarty->assign("USERGROUP2",$UserGroup2);
		}
		if (empty($UserActive))
		{
			$smarty->assign("USERACTIVE",$f['USER_ACTIVE']);
		}
		else
		{
			$smarty->assign("USERACTIVE",$UserActive);
		}
		$smarty->assign("ADMINACTIVE",$choice_yes_no[$ua]);
		$smarty->assign("ADMINGROUP1",$group[$ug1]);
		$smarty->assign("ADMINGROUP2",$group[$ug2]);
	}

	// Put choice yes / no in $choice_yes_no
	//
	$smarty->assign("choice_yes_no",array($choice_yes_no));

	// Put available languages in $choose_language
	//
	$lang = asort($language);
	$smarty->assign("choose_language",array($language));

	// Put available groups in $choose_group
	//
	$usergroup = asort($group);
	$smarty->assign("choose_group",array($group));

	if(isset($_SESSION['Username']) && $_SESSION['Username'] != $root && $_SESSION['Usergroup1'] != $admingroup_1 && $_SESSION['Usergroup2'] != $admingroup_2 && $_SESSION['Username'] != $UserName)
	{
		$_SESSION['LastSite'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		$_SESSION['logoutid'] = "5";
		Header("Location: $web/login/sustart.php?$sessname=$sessid");
	}
	else
	{
		UserSite();
		$smarty->display('user/edit.tpl');
	}

?>
