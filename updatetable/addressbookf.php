<?php
/*
	addressbookf.php

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

CheckUser();
CheckAdmin();
CheckSession();

// Database connection
//
DBConnect();

$query = $db->Execute("SELECT * FROM address ORDER BY MYID ASC");

if (!$query)
	print($db->ErrorMsg());
else
	while (!$query->EOF)
	{
		$MYID = $query->fields['MYID'];
		$PrintName = $query->fields['NAME_DRUCKEN'];
		$Prefix = $query->fields['PREFIX'];
		$Firstname = $query->fields['FIRSTNAME'];
		$Lastname = $query->fields['LASTNAME'];
		$Title1 = $query->fields['TITLE'];
		$Company = $query->fields['COMPANY'];
		$Department = $query->fields['DEPARTMENT'];
		$Address = $query->fields['ADDRESS'];
		$City = $query->fields['CITY'];
		$Stateprov = $query->fields['STATEPROV'];
		$Postalcode = $query->fields['POSTALCODE'];
		$Country = $query->fields['COUNTRY'];
		$Position1 = $query->fields['POSITION'];
		$Initials = $query->fields['INITIALS'];
		$Salutation = $query->fields['SALUTATION'];
		$Phonehome= $query->fields['PHONHOME'];
		$Phoneoffi = $query->fields['PHONEOFFI'];
		$Phoneothe = $query->fields['PHONEOTHE'];
		$Phonework = $query->fields['PHONEWORK'];
		$Mobile = $query->fields['MOBILE'];
		$Pager = $query->fields['PAGER'];
		$Fax = $query->fields['FAX'];
		$Email = $query->fields['EMAIL'];
		$Url = $query->fields['URL'];
		$Note = $query->fields['NOTE'];
		$Url2 = $query->fields['ALTFIELD1'];
		$Email2 = $query->fields['ALTFIELD2'];
		$AltField1 = $query->fields['ALTFIELD3'];
		$AltField2 = $query->fields['ALTFIELD4'];
		$Category = $query->fields['KATEGORIE'];
		$MethodOfPayment = $query->fields['ZHLGB'];
		$Date = $query->fields['DATUM'];
		$Birthday = $query->fields['GEBURTSTAG'];
		$CreatedBy = $query->fields['ERSTELLT'];
		$ModifiedBy = $query->fields['GEAENDERT'];

		if($PrintName == "0")
		{
			$PrintName = "1";
		}
		else if($PrintName == "1")
		{
			$PrintName = "2";
		}
		else
		{
			$PrintName = "1";
		}

		if($MethodOfPayment == "0")
		{
			$MethodOfPayment = "10";
		}
		else if ($MethodOfPayment == "1")
		{
			$MethodOfPayment = "11";
		}
		else if ($MethodOfPayment == "2")
		{
			$MethodOfPayment = "12";
		}
		else if ($MethodOfPayment == "3")
		{
			$MethodOfPayment = "8";
		}
		else
		{
			$MethodOfPayment = "12";
		}

		$Prefix = ereg_replace("'", "\'", $Prefix);
		$Firstname = ereg_replace("'", "\'", $Firstname);
		$Lastname = ereg_replace("'", "\'", $Lastname);
		$Title1 = ereg_replace("'", "\'", $Title1);
		$Company = ereg_replace("'", "\'", $Company);
		$Department = ereg_replace("'", "\'", $Department);
		$Address = ereg_replace("'", "\'", $Address);
		$City = ereg_replace("'", "\'", $City);
		$Stateprov = ereg_replace("'", "\'", $Stateprov);
		$Postalcode = ereg_replace("'", "\'", $Postalcode);
		$Country = ereg_replace("'", "\'", $Country);
		$Position1 = ereg_replace("'", "\'", $Position1);
		$Salutation = ereg_replace("'", "\'", $Salutation);
		$Note = ereg_replace("'", "\'", $Note);

		$query3 = "INSERT INTO {$TBLName}addressbook (MYID, PRINT_NAME, PREFIX, FIRSTNAME, LASTNAME, TITLE, COMPANY, DEPARTMENT, ADDRESS, CITY, STATEPROV, POSTALCODE, COUNTRY, POSITION, INITIALS, SALUTATION, PHONEHOME, PHONEOFFI, PHONEOTHE, PHONEWORK, MOBILE, PAGER, FAX, EMAIL, URL, NOTE, CHANGELOG, URL2, EMAIL2, ALTFIELD1, ALTFIELD2, CATEGORY, METHODOFPAY, MESSAGE, BIRTHDAY, BANKNAME, BANKACCOUNT, BANKNUMBER, BANKIBAN, BANKBIC, TAX_FREE, TAXNR, BUSINESS_TAXNR, USERNAME, PASSWORD, USERLANGUAGE, USER_ACTIVE, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query3 .= "VALUES ($MYID, '$PrintName', '$Prefix', '$Firstname', '$Lastname', '$Title1', '$Company', '$Department', '$Address', '$City', '$Stateprov', '$Postalcode', '$Country', '$Position1', '$Initials', '$Salutation', '$Phonehome', '$Phoneoffi', '$Phoneothe', '$Phonework', '$Mobile', '$Pager', '$Fax', '$Email', '$Url', '$Note', '', '$Url2', '$Email2', '$AltField1', '$AltField2', '$Category', '$MethodOfPayment', '1', '$Birthday', '', '', '', '', '', '2', '', '', '', '', '2', '2', '$CreatedBy', '$ModifiedBy', '1', '2', '$Date 00:00:00', '$CurrentDateTime')";

		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}
		$query->MoveNext();

		Header("Location: $web/updatetable/cashbookf.php?$sessname=$sessid");
	}

?>
