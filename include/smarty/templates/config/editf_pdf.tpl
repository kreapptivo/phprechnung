{*
	editf_pdf.tpl

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
*}
{include file="header.tpl"}
<body>
{include file="htable.tpl"}
<p align="center" class="redtxt"><b>{$FieldError}</b></p>
<div align="center">
<form action="edit_pdf.php?{$Session}" method="post">
<input type="hidden" name="settingID" value="{$settingID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="D_PDF_Company_Logo" value="{$D_PDF_Company_Logo}" />
<input type="hidden" name="D_PDF_Company_Logo_Width" value="{$D_PDF_Company_Logo_Width}" />
<input type="hidden" name="D_PDF_Company_Logo_Height" value="{$D_PDF_Company_Logo_Height}" />
<input type="hidden" name="D_PDF_Font" value="{$D_PDF_Font}" />
<input type="hidden" name="D_PDF_Text1" value="{$D_PDF_Text1}" />
<input type="hidden" name="D_PDF_Text2" value="{$D_PDF_Text2}" />
<input type="hidden" name="D_PDF_Text3" value="{$D_PDF_Text3}" />
<input type="hidden" name="D_PDF_Directory" value="{$D_PDF_Directory}" />
<input type="hidden" name="D_PDF_Attachment_Text" value="{$D_PDF_Attachment_Text}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$BackMsg} - {$Settings} - {$Edit}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
