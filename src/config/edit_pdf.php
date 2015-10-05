<?php

/*
	edit_pdf.php

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

$smarty->assign("Title","$a[settings] - $a[edit] - $a[pdf_settings]");
$smarty->assign("Basic_Settings","$a[basic_settings]");
$smarty->assign("Company_Settings","$a[company_settings]");
$smarty->assign("PDF_Settings","$a[pdf_settings]");
$smarty->assign("Company_Logo","$a[company_logo]");
$smarty->assign("Company_Logo_Width","$a[company_logo_width]");
$smarty->assign("Company_Logo_Height","$a[company_logo_height]");
$smarty->assign("PDF_Font","$a[pdf_font]");
$smarty->assign("PDF_Text1","$a[pdf_text1]");
$smarty->assign("PDF_Text2","$a[pdf_text2]");
$smarty->assign("PDF_Text3","$a[pdf_text3]");
$smarty->assign("PDF_Directory","$a[pdf_dir]");
$smarty->assign("PDF_Attachment_Text","$a[pdf_attachment_text]");


// Database connection
//
DBConnect();

// Get entrys from setting table
//
$query = $db->Execute("SELECT COMPANY_LOGO, PDF_COMPANY_LOGO_WIDTH, PDF_COMPANY_LOGO_HEIGHT, PDF_FONT, PDF_DIR, PDF_FONT_SIZE1,
		PDF_FONT_SIZE2, PDF_TYPE_HEIGHT, PDF_ATTACHMENT_TEXT, SETTINGID FROM {$TBLName}setting WHERE SETTINGID=$settingID");

// If an error has occurred, display the error message
//
if (!$query)
	print($db->ErrorMsg());
else
	foreach($query as $f)
	{
		if (empty($D_PDF_Company_Logo))
		{
			$smarty->assign("D_PDF_Company_Logo",$f['COMPANY_LOGO']);
		}
		else
		{
			$smarty->assign("D_PDF_Company_Logo","$D_PDF_Company_Logo");
		}
		if (empty($D_PDF_Company_Logo_Width))
		{
			$smarty->assign("D_PDF_Company_Logo_Width",$f['PDF_COMPANY_LOGO_WIDTH']);
		}
		else
		{
			$smarty->assign("D_PDF_Company_Logo_Width","$D_PDF_Company_Logo_Width");
		}
		if (empty($D_PDF_Company_Logo_Height))
		{
			$smarty->assign("D_PDF_Company_Logo_Height",$f['PDF_COMPANY_LOGO_HEIGHT']);
		}
		else
		{
			$smarty->assign("D_PDF_Company_Logo_Height","$D_PDF_Company_Logo_Height");
		}
		if (empty($D_PDF_Font))
		{
			$smarty->assign("D_PDF_Font",$f['PDF_FONT']);
		}
		else
		{
			$smarty->assign("D_PDF_Font","$D_PDF_Font");
		}
		if (empty($D_PDF_Text1))
		{
			$smarty->assign("D_PDF_Text1",$f['PDF_FONT_SIZE1']);
		}
		else
		{
			$smarty->assign("D_PDF_Text1","$D_PDF_Text1");
		}
		if (empty($D_PDF_Text2))
		{
			$smarty->assign("D_PDF_Text2",$f['PDF_FONT_SIZE2']);
		}
		else
		{
			$smarty->assign("D_PDF_Text2","$D_PDF_Text2");
		}
		if (empty($D_PDF_Text3))
		{
			$smarty->assign("D_PDF_Text3",$f['PDF_TYPE_HEIGHT']);
		}
		else
		{
			$smarty->assign("D_PDF_Text3","$D_PDF_Text3");
		}
		if (empty($D_PDF_Directory))
		{
			$smarty->assign("D_PDF_Directory",$f['PDF_DIR']);
		}
		else
		{
			$smarty->assign("D_PDF_Directory","$D_PDF_Directory");
		}
		if (empty($D_PDF_Attachment_Text))
		{
			$smarty->assign("D_PDF_Attachment_Text",$f['PDF_ATTACHMENT_TEXT']);
		}
		else
		{
			$smarty->assign("D_PDF_Attachment_Text","$D_PDF_Attachment_Text");
		}
	}

$smarty->display('config/edit_pdf.tpl');

?>
