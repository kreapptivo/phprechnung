<?php

/*
	sustartf.php

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
CheckUser();
CheckSession();

if(isset($_POST['Password']))
{
	$Password = htmlspecialchars($_POST['Password'], ENT_QUOTES, $_SESSION['Charset']);
}

// Database connection
//
DBConnect();

$query = $db->Execute("SELECT DECODE(FULLNAME,'$pkey') AS FULLNAME, DECODE(USERNAME,'$pkey') AS USERNAME, DECODE(PASSWORD,'$pkey') AS PASSWORD, LANGUAGE, DECODE(USERGROUP1,'$pkey') AS USERGROUP1, DECODE(USERGROUP2,'$pkey') AS USERGROUP2, LICENSE_ACCEPTED FROM {$TBLName}user WHERE DECODE(USERNAME,'$pkey')='$root' AND DECODE(PASSWORD,'$pkey')='$Password'");
$numrows = $query->RowCount();
$row = $query->GetRows();

foreach ($row as $f)
{
	$FullName = $f['FULLNAME'];
	$Language = $f['LANGUAGE'];
	$Usergroup1 = $f['USERGROUP1'];
	$Usergroup2 = $f['USERGROUP2'];
	$LicenseAccepted = $f['LICENSE_ACCEPTED'];
}

if (isset($_SESSION['Username']) && $_SESSION['Username'] === $root || !isset($_SESSION['IPAddress']) || !$numrows)
{
	$_SESSION['logoutid'] = "2";
	Header("Location: $web/login/sustart.php?$sessname=$sessid");
}
else
{
	$_SESSION['UserID'] = 1;
	$_SESSION['Username'] = $root;
	$_SESSION['FullName'] = $FullName;
	$_SESSION['Language'] = $Language;
	$_SESSION['Usergroup1'] = $Usergroup1;
	$_SESSION['Usergroup2'] = $Usergroup2;
	$_SESSION['LicenseAccepted'] = $LicenseAccepted;
	$_SESSION['SuperUser'] = $root;
	$_SESSION['LastAccess'] = time();
	$_SESSION['LastUserSite'] = $_SESSION['UserSite'];
	
	$query2 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query2 .= "VALUES(NULL, '$CurrentDateTime', 'Session opened for user $_SESSION[Username] (uid=$_SESSION[UserID]) by $_SESSION[LastUser] (uid=$_SESSION[LastUserID]) from $IPAddress','admin','1','2')";
	if ($db->Execute($query2) === false)
	{
		die($db->ErrorMsg());
	}

	if(isset($_SESSION['LastSite']))
	{
		Header("Location: $_SESSION[LastSite]");
	}
	else
	{
		Header("Location: $web/index.php?$sessname=$sessid");
	}
}

?>
