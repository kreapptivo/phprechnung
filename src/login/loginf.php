<?php

/*
 * loginf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2010 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
require_once ("../include/phprechnung.inc.php");

if (isset ( $_POST ['Username'] )) {
	$Username = htmlspecialchars ( $_POST ['Username'], ENT_QUOTES, $_SESSION ['Charset'] );
}
if (isset ( $_POST ['Password'] )) {
	$Password = htmlspecialchars ( $_POST ['Password'], ENT_QUOTES, $_SESSION ['Charset'] );
	unset ( $_POST ['Password'] );
}

// Database connection
//
DBConnect ();
$pw_hash = hash ( 'sha256', $pkey . $Username . $Password );
unset ( $Password );
// $query = $db->Execute("SELECT USERID, DECODE(FULLNAME,'$pkey') AS FULLNAME, DECODE(USERNAME,'$pkey') AS USERNAME, DECODE(PASSWORD,'$pkey') AS PASSWORD, DECODE(USERGROUP1,'$pkey') AS USERGROUP1, DECODE(USERGROUP2,'$pkey') AS USERGROUP2, LANGUAGE, USER_ACTIVE, LICENSE_ACCEPTED FROM {$TBLName}user WHERE DECODE(USERNAME,'$pkey')='$Username' AND DECODE(PASSWORD,'$pkey')='$Password' AND USER_ACTIVE= '1'");
$query = $db->Execute ( "SELECT USERID, FULLNAME, USERNAME, USERGROUP1 AS USERGROUP1, USERGROUP2, LANGUAGE, USER_ACTIVE, LICENSE_ACCEPTED FROM {$TBLName}user WHERE PASSWORD='$pw_hash' AND USER_ACTIVE= '1'" );
$numrows = $query->RowCount ();

// if (isset($_SESSION['IPAddress']) || !$numrows)
if ($numrows < 1 && !isset($_SESSION['IPAddress'])) {
	//User existiert nicht
	$_SESSION ['logoutid'] = "2";
	
	$query1 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query1 .= "VALUES(NULL, '$CurrentDateTime', 'Login failed for user $Username from $IPAddress','admin','1','2')";
	if ($db->Execute ( $query1 ) === false) {
		die ( $db->ErrorMsg () );
	}
	
	Header ( "Location: $web/login/login.php?$sessname=$sessid" );
} else {	
	//User exists	
	$row = $query->GetRows ();
	
	foreach ( $row as $f ) {
		$UserID = $f ['USERID'];
		$FullName = $f ['FULLNAME'];
		$Usergroup1 = $f ['USERGROUP1'];
		$Usergroup2 = $f ['USERGROUP2'];
		$Language = $f ['LANGUAGE'];
		$LicenseAccepted = $f ['LICENSE_ACCEPTED'];
	}
	
	$_SESSION ['UserID'] = $UserID;
	$_SESSION ['Username'] = $Username;
	$_SESSION ['Usergroup1'] = $Usergroup1;
	$_SESSION ['Usergroup2'] = $Usergroup2;
	$_SESSION ['Language'] = $Language;
	$_SESSION ['LicenseAccepted'] = $LicenseAccepted;
	$_SESSION ['FullName'] = $FullName;
	$_SESSION ['IPAddress'] = $IPAddress;
	$_SESSION ['LastUserID'] = $UserID;
	$_SESSION ['LastUser'] = $Username;
	$_SESSION ['LastUsergroup1'] = $Usergroup1;
	$_SESSION ['LastUsergroup2'] = $Usergroup2;
	$_SESSION ['LastLanguage'] = $Language;
	$_SESSION ['LastLicenseAccepted'] = $LicenseAccepted;
	$_SESSION ['LastFullName'] = $FullName;
	$_SESSION ['LastAccess'] = time ();
	
	$query2 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query2 .= "VALUES(NULL, '$CurrentDateTime', 'Session opened for user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress','admin','1','2')";
	if ($db->Execute ( $query2 ) === false) {
		die ( $db->ErrorMsg () );
	}
	
	if ($LicenseAccepted != 1) {
		Header ( "Location: $web/license.php?$sessname=$sessid" );
	} else {
		Header ( "Location: $web/index.php?$sessname=$sessid" );
	}
}

?>
