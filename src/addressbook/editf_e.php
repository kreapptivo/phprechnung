<?php

/*
	editf_e.php

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

if(!is_numeric($myID) || $myID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == "10")
{
	$Searchstring = "&CustomerID=$CustomerID&Prefix1=$Prefix1&Title11=$Title11&Firstname1=$Firstname1&Initials1=$Initials1&Lastname1=$Lastname1&Phonehome1=$Phonehome1&Salutation1=$Salutation1&Mobile1=$Mobile1&Address1=$Address1&Fax1=$Fax1&Stateprov1=$Stateprov1&Email1=$Email1&Postalcode1=$Postalcode1&City1=$City1&Url1=$Url1&Company1=$Company1&Phonework1=$Phonework1&Department1=$Department1&Phoneoffi1=$Phoneoffi1&Position11=$Position11&Phoneothe1=$Phoneothe1&Pager1=$Pager1&Note1=$Note1&Country1=$Country1&Date_From1=$Date_From1&Date_Till1=$Date_Till1&Birthday1=$Birthday1&Category1=$Category1&MethodOfPayment1=$MethodOfPayment1&PrintName1=$PrintName1";
}

// Database connection
//
DBConnect();

// Get the creator
//
$query = $db->Execute("SELECT MYID, CREATEDBY FROM {$TBLName}addressbook WHERE MYID=$myID");
$row = $query->GetRows();

// If an error has occurred, display the error message
//
if (!$query)
	print $db->ErrorMsg();
else
	foreach($row as $f)
	{
		$CreatedBy = $f['CREATEDBY'];
	}

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
	$smarty->assign("EditForm","2");
}

if (empty($myID))
{
	$smarty->assign("FieldError","$a[customer_no] - $a[field_error]");
	UserInput("");
	$smarty->display('addressbook/editf.tpl');

}
else if(!is_Superuser() && !is_Admin() && !is_Manager() && $_SESSION['Username'] != $CreatedBy)
{
	$smarty->assign("FieldError","$a[no_permission]");
	UserInput("");
	$smarty->display('addressbook/editf.tpl');
}
else
{
	$query3 = "UPDATE {$TBLName}addressbook SET PHONEHOME='$Phonehome', PHONEOFFI='$Phoneoffi', PHONEOTHE='$Phoneothe', PHONEWORK='$Phonework', MOBILE='$Mobile', PAGER='$Pager', FAX='$Fax', EMAIL='$Email', URL='$Url', URL2='$Url2', EMAIL2='$Email2', ALTFIELD1='$AltField1', ALTFIELD2='$AltField2', MODIFIEDBY='$_SESSION[Username]', MODIFIED='$CurrentDateTime', BANKNAME='$D_Bank_Name', BANKACCOUNT='$D_Bank_Account', BANKNUMBER='$D_Bank_Number', BANKIBAN='$D_Bank_Iban', BANKBIC='$D_Bank_Bic', TAXNR='$D_Taxnr', BUSINESS_TAXNR='$D_Business_Taxnr' WHERE MYID=$myID";

	if ($db->Execute($query3) === false)
	{
		die($db->ErrorMsg());
	}

	$_SESSION['EditID'] = "1";


	if($infoID == '9')
	{
		Header("Location: $web/addressbook/searchlist.php?myID=$myID&page=$page&Customer=$Customer&Order=$Order&Sort=$Sort&$sessname=$sessid#$myID");
	}
	else if($infoID == '10')
	{
		Header("Location: $web/addressbook/searchlist_e.php?myID=$myID&page=$page$Searchstring&Order=$Order&Sort=$Sort&$sessname=$sessid#$myID");
	}
	else
	{
		Header("Location: $web/addressbook/list.php?myID=$myID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$myID");
	}
}

?>
