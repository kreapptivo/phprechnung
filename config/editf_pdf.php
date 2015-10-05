<?php

/*
	editf_pdf.php

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

if(!is_numeric($settingID) || $settingID <= 0 )
{
	die(header("Location: $web"));
}

// Database connection
//
DBConnect();

function UserInput($mark)
{
	global $smarty;

	$smarty->assign("mark","$mark");
}

if (empty($D_PDF_Company_Logo))
{
	$smarty->assign("FieldError","$a[company_logo] - $a[field_error]");
	UserInput("D_PDF_Company_Logo");
}
else if (empty($D_PDF_Company_Logo_Width))
{
	$smarty->assign("FieldError","$a[company_logo_width] - $a[field_error]");
	UserInput("D_PDF_Company_Logo_Width");
}
else if (empty($D_PDF_Company_Logo_Height))
{
	$smarty->assign("FieldError","$a[company_logo_height] - $a[field_error]");
	UserInput("D_PDF_Company_Logo_Height");
}
else if (empty($D_PDF_Font))
{
	$smarty->assign("FieldError","$a[pdf_font] - $a[field_error]");
	UserInput("D_PDF_Font");
}
else if (empty($D_PDF_Text1))
{
	$smarty->assign("FieldError","$a[pdf_text1] - $a[field_error]");
	UserInput("D_PDF_Text1");
}
else if (empty($D_PDF_Text2))
{
	$smarty->assign("FieldError","$a[pdf_text2] - $a[field_error]");
	UserInput("D_PDF_Text2");
}
else if (empty($D_PDF_Text3))
{
	$smarty->assign("FieldError","$a[pdf_text3] - $a[field_error]");
	UserInput("D_PDF_Text3");
}
else if (empty($D_PDF_Directory))
{
	$smarty->assign("FieldError","$a[pdf_dir] - $a[field_error]");
	UserInput("D_PDF_Directory");
}
else if (empty($D_PDF_Attachment_Text))
{
	$smarty->assign("FieldError","$a[pdf_attachment_text] - $a[field_error]");
	UserInput("D_PDF_Attachment_Text");
}
else
{
	$query = $db->Execute("UPDATE {$TBLName}setting SET COMPANY_LOGO='$D_PDF_Company_Logo', PDF_COMPANY_LOGO_WIDTH='$D_PDF_Company_Logo_Width', PDF_COMPANY_LOGO_HEIGHT='$D_PDF_Company_Logo_Height', PDF_FONT='$D_PDF_Font', PDF_FONT_SIZE1='$D_PDF_Text1', PDF_FONT_SIZE2='$D_PDF_Text2', PDF_TYPE_HEIGHT='$D_PDF_Text3', PDF_DIR='$D_PDF_Directory', PDF_ATTACHMENT_TEXT='$D_PDF_Attachment_Text', MODIFIEDBY='$_SESSION[Username]' WHERE SETTINGID=$settingID");
	
	Header("Location: $web/config/list.php?page=$page&Order=$Order&Sort=$Sort&$sessname=$sessid#$settingID");
}

$smarty->display('config/editf_pdf.tpl');

?>
