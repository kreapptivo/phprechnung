{*
	info_pdf.tpl

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
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Tabelle 3"><tbody>
<tr><td id="td1_20" width="20%" valign="top">
{* Menubar start *}
<table border="0" width="80%" cellspacing="0" cellpadding="0" summary="Tabelle 4"><tbody>
{if $smarty.session.SuperUser and ( $smarty.session.SuperUser eq $Root )}
	<tr><td align="center" class="phprechnung_menu"><a accesskey="L" title="{$Logout}"
	href="../login/suend.php?{$Session}">{$Logout}</a></td></tr>
{else}
	<tr><td align="center" class="phprechnung_menu"><a accesskey="L" title="{$Logout}"
	href="../login/logout.php?{$Session}">{$Logout}</a></td></tr>
{/if}
<tr><td align="left" class="phprechnung_menu"><a accesskey="W" title="{$Startpage}"
href="../index.php?{$Session}">{$Startpage}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="A" title="{$Addressbook}"
href="../addressbook/list.php?{$Session}">{$Addressbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="P" title="{$Position}"
href="../position/list.php?{$Session}">{$Position}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="O" title="{$Offer}"
href="../offer/list.php?{$Session}">{$Offer}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="I" title="{$Invoice}"
href="../invoice/list.php?{$Session}">{$Invoice}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="M" title="{$Payment}"
href="../payment/list.php?{$Session}">{$Payment}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="C" title="{$Cashbook}"
href="../cashbook/list.php?{$Session}">{$Cashbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="R" title="{$Reports}"
href="../reports/index.php?{$Session}">{$Reports}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
href="../configuration.php?{$Session}">{$Configuration}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Settings} - {$List}"
href="list.php?{$Session}">{$Settings}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Settings} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display Settings information *}
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2"><tbody>
<tr><td align="center" colspan="2"><h2>{$Settings} - {$Info}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">{$AllInformation} {$EntryNo} {$settingID} [&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit_pdf.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Edit}</a>&nbsp;]</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">
<table width="80%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2"><tbody>
<tr><td align="center">
[&nbsp;<a title="{$Basic_Settings} - {$Info}" class="nmenulink" href="info.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Basic_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$Company_Settings} - {$Info}" class="nmenulink" href="info_company.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Company_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$PDF_Settings} - {$Info}" class="nmenulink" href="info_pdf.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$PDF_Settings}</b></a>&nbsp;]
</td></tr>
</tbody></table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%">{$Company_Logo}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CompanyLogo}</td></tr>
<tr><td valign="top" align="right" width="40%">{$Company_Logo_Width}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CompanyLogoWidth}</td></tr>
<tr><td valign="top" align="right" width="40%">{$Company_Logo_Height}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CompanyLogoHeight}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Font}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFFont}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Text1}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFText1}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Text2}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFText2}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Text3}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFText3}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Directory}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFDirectory}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%">{$PDF_Attachment_Text}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PDFAttachmentText|nl2br}</td></tr>
<tr><td></td></tr>
{* Display back button *}
<tr><td valign="top" align="center" width="100%" colspan="2">
<form action="list.php?{$Session}#{$settingID}" method="post">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$BackMsg} - {$List}" value="{$BackMsg} - {$List}" /></form></td></tr>
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
