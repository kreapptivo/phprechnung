<?php
/*
	smarty.inc.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
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

// For more information about
// Smarty see http://smarty.php.net/
//
require_once("smarty/libs/Smarty.class.php");

$smarty = new Smarty;

// Smarty configuration
//

// This setting must be either a relative or absolute path.
// include_path is not used for writing files.
// It is not recommended to put this directory under
// the web server document root.
//
// If you change $Templateroot you need also to change
// template_dir and config_dir in smarty.inc.php
//
$Templateroot = $_SERVER['DOCUMENT_ROOT']."phpRechnung";

$smarty->template_dir = "$Templateroot/include/smarty/templates";
$smarty->config_dir = "$Templateroot/include/smarty/configs";

// IMPORTANT: $Cacheroot needs write access by the webserver
// For more informationen see
// http://smarty.php.net/manual/en/variable.cache.dir.php
//
// This setting must be either a relative or absolute path.
// include_path is not used for writing files.
// It is not recommended to put this directory under
// the web server document root.
//
// If you change $Cacheroot you need also to change
// compile_dir and cache_dir in smarty.inc.php
//
$Cacheroot = $_SERVER['DOCUMENT_ROOT']."phpRechnung";

$smarty->compile_dir = "$Cacheroot/include/smarty/templates_c";
$smarty->cache_dir = "$Cacheroot/include/smarty/cache";

// Is set to true only during development
//
$smarty->compile_check = true;

$smarty->force_compile = false;

// Some arrays from language files which we will need more frequently
// 
$smarty->assign("Programname","$a[programname]");
$smarty->assign("Phprechnung","$a[phprechnung]");

$smarty->assign("Loggedin","$a[loggedin]");

$smarty->assign("Logout","$a[logout]");
$smarty->assign("Startpage","$a[startpage]");
$smarty->assign("Addressbook","$a[addressbook]");
$smarty->assign("Position","$a[position]");
$smarty->assign("Offer","$a[offer]");
$smarty->assign("Invoice","$a[invoice]");
$smarty->assign("Creditnote","$a[credit_note]");
$smarty->assign("Payment","$a[payment]");
$smarty->assign("Cashbook","$a[cashbook]");
$smarty->assign("Reports","$a[reports]");
$smarty->assign("Configuration","$a[configuration]");
$smarty->assign("Message","$a[message]");
$smarty->assign("MethodOfPayment","$a[method_of_payment]");
$smarty->assign("Category","$a[category]");
$smarty->assign("Tax","$a[tax]");
$smarty->assign("Settings","$a[settings]");
$smarty->assign("Useradministration","$a[user_admin]");
$smarty->assign("PositionGroupSub","$a[position] - $a[pos_group]");
$smarty->assign("Superuser","$a[super_user]");
$smarty->assign("Syslog","$a[syslog]");

$smarty->assign("List","$a[list]");
$smarty->assign("New","$a[new]");
$smarty->assign("Search","$a[search]");
$smarty->assign("DetailSearch","$a[detail_search]");
$smarty->assign("Searchresult","$a[searchresult]");
$smarty->assign("Help","$a[help]");
$smarty->assign("Email","$a[email]");

$smarty->assign("Info","$a[info]");
$smarty->assign("AllInformation","$a[all_info]");

$smarty->assign("InsertMsg","$a[insert]");
$smarty->assign("SaveMsg","$a[save]");
$smarty->assign("Edit","$a[edit]");
$smarty->assign("Editentry","$a[edit_entry]");
$smarty->assign("ChangeMsg","$a[change]");
$smarty->assign("Delete","$a[delete]");
$smarty->assign("Deleteentry","$a[delete_entry]");
$smarty->assign("Cancel","$a[cancel]");
$smarty->assign("Cancelentry","$a[cancel_entry]");
$smarty->assign("PrintMsg","$a[print]");
$smarty->assign("SortMsg","$a[sort]");
$smarty->assign("ChooseMsg","$a[choose]");

$smarty->assign("BackMsg","$a[back]");
$smarty->assign("NextMsg","$a[next]");

$smarty->assign("DateMsg","$a[date_text]");
$smarty->assign("NumberMsg","$a[number_text]");

$smarty->assign("PageMsg","$a[page]");
$smarty->assign("FirstPageMsg","$a[firstpage]");
$smarty->assign("PrevPageMsg","$a[prevpage]");
$smarty->assign("NextPageMsg","$a[nextpage]");
$smarty->assign("LastPageMsg","$a[lastpage]");

$smarty->assign("CanceledEntries","$a[canceled_entries]");
$smarty->assign("NotCanceledEntries","$a[not_canceled_entries]");
$smarty->assign("AllEntries","$a[all_entries]");

$smarty->assign("NoEntry","$a[no_entry]");
$smarty->assign("EntryNo","$a[entry_no]");
$smarty->assign("Entrys","$a[entries]");

// Variables from phprechnung.inc.php
//
$smarty->assign("Session","$sessname=$sessid");
$smarty->assign("Web","$web");
$smarty->assign("Root","$root");
$smarty->assign("AdminGroup1","$admingroup_1");
$smarty->assign("AdminGroup2","$admingroup_2");
$smarty->assign("AdminGroup3","$admingroup_3");
$smarty->assign("MultiBar","$MultiBar");
$smarty->assign("Hostname","$Hostname");
$smarty->assign("IPAddress","$IPAddress");
$smarty->assign("Browser","$Browser");
$smarty->assign("Strftime","$Strftime");

?>
