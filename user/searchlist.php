<?php

/*
	searchlist.php

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

if(!isset($page) || !is_numeric($page) || $page <= 0 )
{
	$page = 1;
}

if(!isset($Sort) || $Sort !== 'ASC' && $Sort !== 'DESC')
{
	$Sort = "";
}

if(empty($Order) || $Order !== 'LANGUAGE' && $Order !== 'FULLNAME')
{
	$Order = "FULLNAME";
	$Sort = "";
}

if ($UserGroup_1 > 0)
{
	$UserGroup_1 = "AND DECODE(USERGROUP1,'$pkey') = $UserGroup_1";
}
if ($UserLanguage_1 > 0)
{
	$UserLanguage_1 = "AND DECODE(LANGUAGE,'$pkey') = $UserLanguage_1";
}

$smarty->assign("Title","$a[user_admin] - $a[searchresult]");
$smarty->assign("Full_Name","$a[fullname]");
$smarty->assign("Language","$a[language]");
$smarty->assign("EntryChanged","$a[entry_changed]");
$smarty->assign("EntryDeleted","$a[entry_deleted]");

// Database connection
//
DBConnect();

$intCursor = ($page - 1) * $EntrysPerPage;

// Get User Information
//
$query = $db->Execute("SELECT USERID, DECODE(FULLNAME,'$pkey') AS FULLNAME, DECODE(USERNAME,'$pkey') AS USERNAME, LANGUAGE FROM {$TBLName}user WHERE DECODE(FULLNAME,'$pkey') LIKE '%$FullName_1%' AND DECODE(USERNAME,'$pkey') LIKE '%$UserName_1%' $UserGroup_1 $UserLanguage_1 ORDER BY $Order $Sort LIMIT $intCursor, $EntrysPerPage");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	// Count only PageRows depend on active positions
	//
	$pagenumrows = $query->RecordCount();

	// Count MaxRows
	//
	$query1 = $db->Execute("SELECT USERID, DECODE(FULLNAME,'$pkey') AS FULLNAME, DECODE(USERNAME,'$pkey') AS USERNAME, LANGUAGE FROM {$TBLName}user WHERE DECODE(FULLNAME,'$pkey') LIKE '%$FullName_1%' AND DECODE(USERNAME,'$pkey') LIKE '%$UserName_1%' $UserGroup_1 $UserLanguage_1");

	$numrows = $query1->RecordCount();

	// Save MaxPages
	//
	$intPages = ceil($numrows/$EntrysPerPage);

	// Save all entrys in $UserData array
	//
	foreach($query as $result)
	{
		$UserData[] = $result;
	}

	if(isset($UserData))
		$smarty->assign('UserData', $UserData);
	$smarty->assign("PageRows","$pagenumrows");
	$smarty->assign("MaxRows","$numrows");

	// Put available languages in $choose_language array
	//
	$smarty->assign("choose_language",array($language));

// Display pager only if $numrows > $EntrysPerPage ( lines per page )
// from settings menu
//
if ($numrows > $EntrysPerPage)
{
	$smarty->assign('CurrentPage', "$page");
	$smarty->assign('MaxPages', "$intPages");
	$smarty->assign('AddCurrentPage', "page=$page&amp;");

	// If we are not on first page then display
	// first page, previous page link
	//
	if ($page > 1)
	{
		$Page = $page - 1;
		$smarty->assign('PrevPage', "$Page");
	}

	// If we are not on the last page then display
	// next page, last page link
	//
	if ($page < $intPages)
	{
		$Page = $page + 1;
		$smarty->assign('NextPage', "$Page");
	}
}

$smarty->display('user/searchlist.tpl');

unset($_SESSION['EditID']);
unset($_SESSION['DeleteID']);

?>
