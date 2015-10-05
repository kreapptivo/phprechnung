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

if (empty($prefix))
{
	$smarty->assign("FieldError","$a[prefix] - $a[field_error]");
	UserInput("prefix");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($firstname) && (empty($company)))
{
	$smarty->assign("FieldError","$a[firstname] - $a[field_error]");
	UserInput("firstname");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($lastname) && (empty($company)))
{
	$smarty->assign("FieldError","$a[lastname] - $a[field_error]");
	UserInput("lastname");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($address))
{
	$smarty->assign("FieldError","$a[address] - $a[field_error]");
	UserInput("address");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($country))
{
	$smarty->assign("FieldError","$a[country] - $a[field_error]");
	UserInput("country");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($postalcode))
{
	$smarty->assign("FieldError","$a[postalcode] - $a[field_error]");
	UserInput("postalcode");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($city))
{
	$smarty->assign("FieldError","$a[city] - $a[field_error]");
	UserInput("city");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($category))
{
	$smarty->assign("FieldError","$a[category] - $a[field_error]");
	UserInput("category");
	$smarty->display('addressbook/newf.tpl');
}
else if (empty($methodofpayment))
{
	$smarty->assign("FieldError","$a[cust_method_of_payment] - $a[field_error]");
	UserInput("methodofpayment");
	$smarty->display('addressbook/newf.tpl');
}
else if ($useractive == 1 && empty($username))
{
	$smarty->assign("FieldError","$a[username] - $a[field_error]");
	UserInput("username");
	$smarty->display('addressbook/newf.tpl');
}
else if ($useractive == 1 && empty($password1))
{
	$smarty->assign("FieldError","$a[password] - $a[field_error]");
	UserInput("password1");
	$smarty->display('addressbook/newf.tpl');
}
else if ($useractive == 1 && empty($password2))
{
	$smarty->assign("FieldError","$a[password] - $a[field_error]");
	UserInput("password1");
	$smarty->display('addressbook/newf.tpl');
}
else if ($useractive == 1 && $password1 != $password2)
{
	$smarty->assign("FieldError","$a[password_error]");
	UserInput("password1");
	$smarty->display('addressbook/newf.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	$query1 = $db->Execute("SELECT FIRSTNAME, LASTNAME, ADDRESS, POSTALCODE, CITY FROM {$TBLName}addressbook WHERE FIRSTNAME='$firstname' AND LASTNAME='$lastname' AND ADDRESS='$address' AND POSTALCODE='$postalcode' AND CITY='$city'");
	$numrows1 = $query1->RowCount();
	$query2 = $db->Execute("SELECT DECODE(USERNAME,'$pkey') AS USERNAME FROM {$TBLName}addressbook WHERE DECODE(USERNAME,'$pkey')='$username'");
	$numrows2 = $query2->RowCount();

	if ($numrows1)
	{
		$smarty->assign("FieldError","$a[entry_exist]");
		UserInput("");
		$smarty->display('addressbook/newf.tpl');
	}
	else if (!empty($UserName) && $numrows2)
	{
		$smarty->assign("FieldError","$a[entry_exist] -> $a[username]");
		UserInput("username");
		$smarty->display('addressbook/newf.tpl');
	}
	else
	{

		list($day, $month, $year) = explode(".", $birthday);
		$birthday = German_Mysql_Date($birthday);

		$query3 = "INSERT INTO {$TBLName}addressbook (MYID, PRINT_NAME, PREFIX, FIRSTNAME, LASTNAME, TITLE, COMPANY, DEPARTMENT, ADDRESS, CITY, STATEPROV, POSTALCODE, COUNTRY, POSITION, INITIALS, SALUTATION, PHONEHOME, PHONEOFFI, PHONEOTHE, PHONEWORK, MOBILE, PAGER, FAX, EMAIL, URL, NOTE, CHANGELOG, ALTFIELD1, ALTFIELD2, URL2, EMAIL2, CATEGORY, METHODOFPAY, MESSAGE, BIRTHDAY, BANKNAME, BANKACCOUNT, BANKNUMBER, BANKIBAN, BANKBIC, TAX_FREE, TAXNR, BUSINESS_TAXNR, USERNAME, PASSWORD, USERLANGUAGE, USER_ACTIVE, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)";
		$query3 .= "VALUES (NULL, '$printname', '$prefix', '$firstname', '$lastname', '$title', '$company', '$department', '$address', '$city', '$stateprov', '$postalcode', '$country', '$position', '$initials', '$salutation', '$phonehome', '$phoneoffi', '$phoneothe', '$phonework', '$mobile', '$pager', '$fax', '$email', '$url', '$note', '$changelog', '$altfield1', '$altfield2', '$url2', '$email2', '$category', '$methodofpayment', '$message', '$birthday', '$bankname', '$bankaccount', '$banknumber', '$bankiban', '$bankbic', '2', '$taxnr', '$businesstaxnr', ENCODE('$username','$pkey'), ENCODE('$password1','$pkey'), '$userlanguage', '$useractive', '$_SESSION[Username]', '$_SESSION[Username]', '$_SESSION[Usergroup1]', '$_SESSION[Usergroup2]', '$CurrentDateTime', '$CurrentDateTime')";

		if ($db->Execute($query3) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['NewID'] = "1";

		Header("Location: $web/addressbook/new.php?page=$page&infoID=$infoID&Order=$Order&Sort=$Sort&$sessname=$sessid");
	}
}

?>
