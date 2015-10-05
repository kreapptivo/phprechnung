{*
	edit.tpl

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
	{if $taxID eq 4}
		<body onload="document.Edit.TaxDescription.focus();">
	{else}
		<body onload="document.Edit.TaxDivide.focus();">
	{/if}
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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Tax} - {$List}"
href="list.php?{$Session}">{$Tax}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Tax} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root && $userID != 1)}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display User information *}
<form id="Edit" name="Edit" action="editf.php?{$Session}#{$userID}" method="post">
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Tax} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Tax} - {$Edit}</h2></td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$EntryNo} {$taxID} ]</td></tr>
<tr><td></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Tax_Divide}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%">
{if $taxID == 4}
	<input title="{$Tax_Divide}" disabled="disabled" type="text" name="TaxDivide" size="30" value="{$TAX_DIVIDE}" />
{else}
	<input title="{$Tax_Divide}" type="text" name="TaxDivide" size="30" value="{$TAX_DIVIDE}" />
{/if}
</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Tax_Multiply}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%">
{if $taxID == 4}
	<input title="{$Tax_Multiply}" disabled="disabled" type="text" name="TaxMultiply" size="30" value="{$TAX_MULTIPLY}" />
{else}
	<input title="{$Tax_Multiply}" type="text" name="TaxMultiply" size="30" value="{$TAX_MULTIPLY}" />
{/if}
</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Tax_Description}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%"><input title="{$Tax_Description}" type="text" name="TaxDescription" size="30" value="{$TAX_DESCRIPTION}" /></td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="taxID" value="{$taxID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$ChangeMsg}" value="{$ChangeMsg}" /></td></tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
