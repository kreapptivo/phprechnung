<?php

/*
	login.php

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

$smarty->assign("Title","$a[login_title]");
$smarty->assign("LoginMsg","$a[login_to] - $a[programname]");
$smarty->assign("SessionEndMsg","$a[session_end]");
$smarty->assign("LoginErrMsg","$a[login_error]");
$smarty->assign("LoginEndMsg","$a[login_end] $a[programname]");
$smarty->assign("Username","$a[username]");
$smarty->assign("Password","$a[password]");
$smarty->assign("Login","$a[login]");
$smarty->assign("Delete","$a[delete]");

$smarty->display('login/login.tpl');

unset($_SESSION['logoutid']);

?>
