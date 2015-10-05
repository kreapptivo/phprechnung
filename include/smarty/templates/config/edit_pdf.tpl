{*
	edit_pdf.tpl

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
{if $mark}
	<body onload="document.Edit.{$mark}.focus();">
{else}
	<body onload="document.Edit.D_PDF_Company_Logo.focus();">
{/if}
{include file="htable.tpl"}
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Tabelle 3">
<tr><td id="td1_20" width="20%" valign="top">
{* Menubar start *}
<table border="0" width="80%" cellspacing="0" cellpadding="0" summary="Tabelle 4">
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
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display PDF information *}
<form id="Edit" name="Edit" action="editf_pdf.php?{$Session}" method="post">
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
{* Display change button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Settings} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Settings} - {$Edit}</h2></td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2">{$EntryNo} {$settingID}</td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2">
<table width="80%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
<tr><td align="center">
[&nbsp;<a title="{$Basic_Settings}" class="nmenulink" href="edit.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Basic_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$Company_Settings}" class="nmenulink" href="edit_company.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Company_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$PDF_Settings}" class="nmenulink" href="edit_pdf.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$PDF_Settings}</b></a>&nbsp;]
</td></tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Logo}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Logo}" class="form_input" name="D_PDF_Company_Logo" size="39" value="{$D_PDF_Company_Logo}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Logo_Width}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Logo_Width}" class="form_input" name="D_PDF_Company_Logo_Width" size="39" value="{$D_PDF_Company_Logo_Width}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Logo_Height}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Logo_Height}" class="form_input" name="D_PDF_Company_Logo_Height" size="39" value="{$D_PDF_Company_Logo_Height}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PDF_Font}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$PDF_Font}" class="form_input" name="D_PDF_Font" size="39" value="{$D_PDF_Font}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PDF_Text1}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$PDF_Text1}" class="form_input" name="D_PDF_Text1" size="39" value="{$D_PDF_Text1}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PDF_Text2}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$PDF_Text2}" class="form_input" name="D_PDF_Text2" size="39" value="{$D_PDF_Text2}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PDF_Text3}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$PDF_Text3}" class="form_input" name="D_PDF_Text3" size="39" value="{$D_PDF_Text3}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PDF_Directory}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$PDF_Directory}" class="form_input" name="D_PDF_Directory" size="39" value="{$D_PDF_Directory}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%"><b>{$PDF_Attachment_Text}</b>:</td><td valign="top" align="left" width="60%"><textarea title="{$PDF_Attachment_Text}" class="form_textarea" name="D_PDF_Attachment_Text" rows="7" cols="47">{$D_PDF_Attachment_Text}</textarea></td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="settingID" value="{$settingID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$ChangeMsg}" value="{$ChangeMsg}" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
