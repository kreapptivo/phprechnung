<?php

/*
	deletef.php

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

if(!is_numeric($myID) || $myID <= 0 )
{
	die(header("Location: $web"));
}

if(isset($infoID) && $infoID == "10")
{
	$Searchstring = "&CustomerID=$CustomerID&Prefix1=$Prefix1&Title11=$Title11&Firstname1=$Firstname1&Initials1=$Initials1&Lastname1=$Lastname1&Phonehome1=$Phonehome1&Salutation1=$Salutation1&Mobile1=$Mobile1&Address1=$Address1&Fax1=$Fax1&Stateprov1=$Stateprov1&Email1=$Email1&Postalcode1=$Postalcode1&City1=$City1&Url1=$Url1&Company1=$Company1&Phonework1=$Phonework1&Department1=$Department1&Phoneoffi1=$Phoneoffi1&Position11=$Position11&Phoneothe1=$Phoneothe1&Pager1=$Pager1&Note1=$Note1&Country1=$Country1&Date_From1=$Date_From1&Date_Till1=$Date_Till1&Birthday1=$Birthday1&Category1=$Category1&MethodOfPayment1=$MethodOfPayment1&PrintName1=$PrintName1";
}

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark",$mark);
}

if (empty($myID))
{
	$smarty->assign("FieldError","$a[customer_no] - $a[field_error]");
	UserInput("");
	$smarty->display('addressbook/deletef.tpl');
}
else
{
	// Database connection
	//
	DBConnect();

	$query1 = $db->Execute("SELECT MYID FROM {$TBLName}offer WHERE MYID=$myID");
	$query2 = $db->Execute("SELECT MYID FROM {$TBLName}invoice WHERE MYID=$myID");
	$numrows1 = $query1->RowCount();
	$numrows2 = $query2->RowCount();

	if ($numrows1 || $numrows2)
	{
		$smarty->assign("FieldError","$a[entry_not_deleted] <br />$a[invoice_issued]");
		UserInput("");
		$smarty->display('addressbook/deletef.tpl');
	}
	else
	{

		$query4 = "DELETE FROM {$TBLName}addressbook WHERE MYID=$myID";

		if ($db->Execute($query4) === false)
		{
			die($db->ErrorMsg());
		}

		$query5 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query5 .= "VALUES(NULL, '$CurrentDateTime', 'Customer-No.: $myID was DELETED by user $_SESSION[Username] (uid=$_SESSION[UserID]) from $IPAddress', 'admin', '1', '2')";
		if ($db->Execute($query5) === false)
		{
			die($db->ErrorMsg());
		}

		$_SESSION['DeleteID'] = "1";

		if($infoID == '9')
		{
			Header("Location: $web/addressbook/searchlist.php?myID=$myID&page=$page&Customer=$Customer&Order=$Order&Sort=$Sort&$sessname=$sessid");
		}
		else if($infoID == '10')
		{
			Header("Location: $web/addressbook/searchlist_e.php?myID=$myID&page=$page$Searchstring&Order=$Order&Sort=$Sort&$sessname=$sessid");
		}
		else
		{
			Header("Location: $web/addressbook/list.php?myID=$myID&page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid");
		}
	}
}

?>
