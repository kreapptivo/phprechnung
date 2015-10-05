<?php
/*
	language.inc.php

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

// Language settings
//
if(isset($_SESSION['Language']) && $_SESSION['Language']== '1')
{
	require_once("language/german.php");
	$_SESSION['Help'] = "help/de";
	setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de_DE.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-15";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '2')
{
	require_once("language/english.php");
	$_SESSION['Help'] = "help/en";
	setlocale(LC_ALL, 'en_EN@euro', 'en_EN', 'en_EN.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-15";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '3')
{
	require_once("language/polish.php");
	$_SESSION['Help'] = "help/pl";
	setlocale(LC_ALL, 'pl_PL@euro', 'pl_PL', 'pl_PL.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-2";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '4')
{
	require_once("language/croatian.php");
	$_SESSION['Help'] = "help/hr";
	setlocale(LC_ALL, 'hr_HR@euro', 'hr_HR', 'hr_HR.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-2";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '5')
{
	require_once("language/french.php");
	$_SESSION['Help'] = "help/fr";
	setlocale(LC_ALL, 'fr_FR@euro', 'fr_FR', 'fr_FR.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-15";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '6')
{
	require_once("language/italian.php");
	$_SESSION['Help'] = "help/it";
	setlocale(LC_ALL, 'it_IT@euro', 'it_IT', 'it_IT.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-1";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '7')
{
	require_once("language/spanish.php");
	$_SESSION['Help'] = "help/es";
	setlocale(LC_ALL, 'es_ES@euro', 'es_ES');
	$_SESSION['Charset'] = "ISO-8859-15";
	//$_SESSION['Charset'] = "UTF-8";
}
else if(isset($_SESSION['Language']) && $_SESSION['Language']== '8')
{
	require_once("language/dutch.php");
	$_SESSION['Help'] = "help/nl";
	setlocale(LC_ALL, 'nl_NL@euro', 'nl_NL');
	$_SESSION['Charset'] = "ISO-8859-15";
	//$_SESSION['Charset'] = "UTF-8";
}
else
{
	//	Chooose a language during logon
	//
	//	German
	//
	//require_once("language/german.php");
	//setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de_DE.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-15";
	
	//	English
	//
	require_once("language/english.php");
	setlocale(LC_ALL, 'en_EN@euro', 'en_EN', 'en_EN.UTF-8');
	$_SESSION['Charset'] = "ISO-8859-15";
	
	//	Polish
	//
	//require_once("language/polish.php");
	//setlocale(LC_ALL, 'pl_PL@euro', 'pl_PL', 'pl_PL.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-2";
	
	//	Croatian
	//
	//require_once("language/croatian.php");
	//setlocale(LC_ALL, 'hr_HR@euro', 'hr_HR', 'hr_HR.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-2";
	
	//	French
	//
	//require_once("language/french.php");
	//setlocale(LC_ALL, 'fr_FR@euro', 'fr_FR', 'fr_FR.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-15";
	
	// Italian
	//
	//require_once("language/italian.php");
	//setlocale(LC_ALL, 'it_IT@euro', 'it_IT', 'it_IT.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-1";
	
	// Spanish
	//
	//require_once("language/spanish.php");
	//setlocale(LC_ALL, 'es_ES@euro', 'es_ES', 'es_ES.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-15";

	// Dutch
	//
	//require_once("language/dutch.php");
	//setlocale(LC_ALL, 'nl_NL@euro', 'nl_NL', 'nl_NL.UTF-8');
	//$_SESSION['Charset'] = "ISO-8859-15";
}

?>
