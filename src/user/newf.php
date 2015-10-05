<?php

/*
	newf.php

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

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($FullName))
{
	$smarty->assign("FieldError","$a[fullname] - $a[field_error]");
	UserInput("FullName");
	$smarty->display('user/newf.tpl');
}
else if (empty($UserName))
{
	$smarty->assign("FieldError","$a[username] - $a[field_error]");
	UserInput("UserName");
	$smarty->display('user/newf.tpl');
}
else if (empty($Password1))
{
	$smarty->assign("FieldError","$a[password] - $a[field_error]");
	UserInput("Password1");
	$smarty->display('user/newf.tpl');
}
else if (empty($Password2))
{
	$smarty->assign("FieldError","$a[password] - $a[field_error]");
	UserInput("Password1");
	$smarty->display('user/newf.tpl');
}
else if ($Password1 != $Password2)
{
	$smarty->assign("FieldError","$a[password_error]");
	UserInput("Password1");
	$smarty->display('user/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();
	$query1 = $db->Execute("SELECT USERNAME FROM {$TBLName}user WHERE USERNAME='$UserName' LIMIT 1");
	$numrows1 = $query1->RowCount();

	if ($numrows1 > 0)
	{	
		//Username exists already
		$smarty->assign("FieldError","$a[entry_exist]");
		UserInput("UserName");
		$smarty->display('user/newf.tpl');
	}else{
		//Create User
		$pw_hash = hash('sha256',$pkey.$UserName.$Password1);

		$query2 = "INSERT INTO {$TBLName}user (USERID, FULLNAME, USERNAME, PASSWORD, USERGROUP1, USERGROUP2, LANGUAGE, USER_ACTIVE, LICENSE_ACCEPTED, CREATEDBY, MODIFIEDBY, CREATED, MODIFIED)";
		$query2 .= "VALUES(NULL, '$FullName','$UserName', '$pw_hash', '$UserGroup1','$UserGroup2','$UserLanguage', $UserActive, '1','$_SESSION[Username]','$_SESSION[Username]','$CurrentDateTime','$CurrentDateTime')";

		if ($db->Execute($query2) === false)
		{
			die($db->ErrorMsg());
		}

		$query3 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query3 .= "VALUES(NULL, '$CurrentDateTime', 'User: $FullName - $UserName was ADDED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress', 'admin', '1', '2')";
		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['NewID'] = "1";

		Header("Location: $web/user/new.php?$sessname=$sessid");
	}
}

?>
