<?php
/*
	loginf.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2008 Edy Corak < phprechnung at ecorak dot net >

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
CheckAdmin();
CheckSession();

// Database connection
//
DBConnect();

$query = $db->GetAll("SELECT DECODE(NAME,'$pkeyOld') AS NAME, DECODE(BENUTZERNAME,'$pkeyOld') AS BENUTZERNAME, DECODE(KENNWORT,'$pkeyOld') AS KENNWORT, DECODE(SPRACHE,'$pkeyOld') AS SPRACHE FROM anmeldung WHERE DECODE(BENUTZERNAME,'$pkeyOld')='admin'");

if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		$AdminName = $f['NAME'];
		$AdminBenutzername = $f['BENUTZERNAME'];
		$AdminKennwort = $f['KENNWORT'];
		$AdminSprache = $f['SPRACHE'];

		if($AdminSprache == "0")
		{
			$Language = "1";
		}
		else if ($AdminSprache = "1")
		{
			$Language = "2";
		}
		else if ($AdminSprache == "2")
		{
			$Language = "3";
		}
		else if ($AdminSprache == "3")
		{
			$Language = "4";
		}
		else if ($AdminSprache == "4")
		{
			$Language = "5";
		}
		else if ($AdminSprache == "5")
		{
			$Language = "6";
		}
		else if ($AdminSprache == "6")
		{
			$Language = "7";
		}
		else
		{
			$Language = "2";
		}

		$query1 = $db->Execute("UPDATE {$TBLName}user SET FULLNAME=ENCODE('$AdminName','$pkeyOld'), USERNAME=ENCODE('$AdminBenutzername','$pkeyOld'), PASSWORD=ENCODE('$AdminKennwort','$pkeyOld'), USERGROUP1=ENCODE('1','$pkeyOld'), USERGROUP2=ENCODE('2','$pkeyOld'), LANGUAGE=$Language, LICENSE_ACCEPTED='2', MODIFIEDBY='admin', MODIFIED='$CurrentDateTime' WHERE USERID=1");
	}

$query2 = $db->GetAll("SELECT DECODE(NAME,'$pkeyOld') AS NAME, DECODE(BENUTZERNAME,'$pkeyOld') AS BENUTZERNAME, DECODE(KENNWORT,'$pkeyOld') AS KENNWORT, DECODE(SPRACHE,'$pkeyOld') AS SPRACHE FROM anmeldung WHERE DECODE(BENUTZERNAME,'$pkeyOld') != 'admin'");

if (!$query2)
	print($db->ErrorMsg());
else
	foreach($query2 as $f2)
	{
		$Name = $f2['NAME'];
		$Benutzername = $f2['BENUTZERNAME'];
		$Kennwort = $f2['KENNWORT'];
		$Sprache = $f2['SPRACHE'];

		if($Sprache == "0")
		{
			$Sprache = "1";
		}
		else if ($Sprache == "1")
		{
			$Sprache = "2";
		}
		else if ($Sprache == "2")
		{
			$Sprache = "3";
		}
		else if ($Sprache == "3")
		{
			$Sprache = "4";
		}
		else if ($Sprache == "4")
		{
			$Sprache = "5";
		}
		else if ($Sprache == "5")
		{
			$Sprache = "6";
		}
		else if ($Sprache == "6")
		{
			$Sprache = "7";
		}
		else
		{
			$Sprache = "2";
		}

		$query3 = "INSERT INTO {$TBLName}user (USERID, FULLNAME, USERNAME, PASSWORD, USERGROUP1, USERGROUP2, LANGUAGE, USER_ACTIVE, LICENSE_ACCEPTED, CREATEDBY, MODIFIEDBY, CREATED, MODIFIED)";
		$query3 .= "VALUES(NULL, ENCODE('$Name','$pkeyOld'), ENCODE('$Benutzername','$pkeyOld'), ENCODE('$Kennwort','$pkeyOld'), ENCODE('5','$pkeyOld'), ENCODE('4','$pkeyOld'), $Sprache, 1, '2','admin','admin','$CurrentDateTime','$CurrentDateTime')";

		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}
		
		$query4 = $db->Execute("UPDATE {$TBLName}updatetable SET LOGINUPDATE='1', CREATED='$CurrentDateTime' WHERE UPDATEID=1");
	}

Header("Location: $web/updatetable/index.php?$sessname=$sessid");

?>
