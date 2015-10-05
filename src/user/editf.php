<?php

/*
 * editf.php phpRechnung - is easy-to-use Web-based multilingual accounting software. Copyright (C) 2001 - 2010 Edy Corak < edy at loenshotel dot de > This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
require_once ("../include/phprechnung.inc.php");
require_once ("../include/smarty.inc.php");

CheckUser ();
CheckSession ();

$ArrayValue = CheckArrayValue ( $_REQUEST );

foreach ( $ArrayValue as $key => $val ) {
	$$key = $val;
	$smarty->assign ( "$key", $val );
}

if (! is_numeric ( $userID ) || $userID <= 0) {
	die ( header ( "Location: $web" ) );
}

// Database connection
//
DBConnect ();

// Get the username
//
// $query = $db->Execute("SELECT USERID, DECODE(USERNAME,'$pkey') AS USERNAME FROM {$TBLName}user WHERE USERID=$userID");
$query = $db->Execute ( "SELECT USERID, USERNAME FROM {$TBLName}user WHERE USERID=$userID" );

// If an error has occurred, display the error message
//
if (! $query)
	print ($db->ErrorMsg ()) ;
else
	foreach ( $query as $f ) {
		$Username = $f ['USERNAME'];
	}
function UserInput($mark) {
	global $smarty;
	
	$smarty->assign ( "mark", $mark );
}

if (empty ( $FullName )) {
	$smarty->assign ( "FieldError", "$a[fullname] - $a[field_error]" );
	UserInput ( "FullName" );
	$smarty->display ( 'user/editf.tpl' );
} elseif (empty ( $Password1 ) && ! empty ( $Password2 )) {
	$smarty->assign ( "FieldError", "$a[password] - $a[field_error]" );
	UserInput ( "Password1" );
	$smarty->display ( 'user/editf.tpl' );
} elseif (empty ( $Password2 ) && ! empty ( $Password1 )) {
	$smarty->assign ( "FieldError", "$a[password] - $a[field_error]" );
	UserInput ( "Password1" );
	$smarty->display ( 'user/editf.tpl' );
} elseif ($Password1 != $Password2) {
	$smarty->assign ( "FieldError", "$a[password_error]" );
	UserInput ( "Password1" );
	$smarty->display ( 'user/editf.tpl' );
} else if (!is_Superuser() && !is_Admin() && $_SESSION ['Username'] != $Username) {
	$smarty->assign ( "FieldError", "$a[no_permission]" );
	UserInput ( "" );
	$smarty->display ( 'user/editf.tpl' );
} else {
	if (! empty ( $Password1 )) {
		$pw_hash = hash ( 'sha256', $pkey . $Username . $Password1 );
	}else{
		$pw_hash = false;
	}
	// Change own data
	if (isset ( $_SESSION ['Username'] ) && $_SESSION ['Username'] == $Username) {
		$query = $db->Execute ( "UPDATE {$TBLName}user SET FULLNAME='$FullName', ". ( $pw_hash ? " PASSWORD='$pw_hash', ":""). "LANGUAGE='$UserLanguage', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE USERID=$userID" );
	} elseif (is_Superuser () || is_Admin ()) {
		// Change other Data only for Superuser and Admins
		$query = $db->Execute ( "UPDATE {$TBLName}user SET FULLNAME='$FullName', ". ( $pw_hash ? " PASSWORD='$pw_hash', ":""). "LANGUAGE='$UserLanguage', USERGROUP1='$UserGroup1', USERGROUP2='$UserGroup2', USER_ACTIVE='$UserActive', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime' WHERE USERID=$userID" );
	}
	
	$query2 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
	$query2 .= "VALUES(NULL, '$CurrentDateTime', 'User: $FullName - User-No.: $userID was MODIFIED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress', 'admin', '1', '2')";
	if ($db->Execute ( $query2 ) === false) {
		die ( $db->ErrorMsg () );
	}
	
	$_SESSION ['EditID'] = "1";
	
	if ($infoID == '9') {
		Header ( "Location: $web/user/searchlist.php?userID=$userID&page=$page&UserActive_1=$UserActive_1&FullName_1=$FullName_1&UserName_1=$UserName_1&UserLanguage_1=$UserLanguage_1&UserGroup_1=$UserGroup_1&Order=$Order&Sort=$Sort&$sessname=$sessid#$userID" );
	} else {
		Header ( "Location: $web/user/list.php?userID=$userID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$userID" );
	}
}

?>
