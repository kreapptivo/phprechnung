<?php

/*
	search.php

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

$smarty->assign("Title","$a[user_admin] - $a[search]");
$smarty->assign("User_Active","$a[user_active]");
$smarty->assign("Full_Name","$a[fullname]");
$smarty->assign("User_Name","$a[username]");
$smarty->assign("User_Group","$a[usergroup]");
$smarty->assign("Language","$a[language]");
$smarty->assign("Select_All","$a[select_all]");

// Put choice yes / no in $choice_yes_no
//
$smarty->assign("choice_yes_no",array($choice_yes_no));

// Put available languages in $choose_language
//
$lang = asort($language);
$smarty->assign("choose_language",array($language));

// Put available groups in $choose_group
//
$usergroup = asort($group);
$smarty->assign("choose_group",array($group));

$smarty->display('user/search.tpl');

?>
