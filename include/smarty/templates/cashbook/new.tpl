{*
	new.tpl

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
	<body onload="document.New.{$mark}.focus();">
{else}
	<body onload="document.New.cashbookdate.focus();">
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="C" title="{$Cashbook} - {$List}"
href="list.php?{$Session}">{$Cashbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Cashbook} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Cashbook} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Cashbook} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="R" title="{$Reports}"
href="../reports/index.php?{$Session}">{$Reports}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
href="../configuration.php?{$Session}">{$Configuration}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<form id="New" name="New" action="newf.php?{$Session}" method="post">
<table width="60%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1">
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Cashbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="7"><h2>{$Cashbook} - {$New}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
{if $smarty.session.NewID and ( $smarty.session.NewID eq 1 )}
	<tr><td align="center" colspan="2" class="greentxt">{$NewEntry} {$EntryNo} {$CashbookID}</td></tr>
{/if}
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$EntryNo} {$CashbookID+1} ]</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$DateMsg}</b>:</td><td valign="top" align="left" width="60%"><input title="{$DateMsg}" class="form_input" name="cashbookdate" size="39" value="{$cashbookdate}" /></td></tr>
{if $CASH_IN_HAND_STARTING_WITH eq 0}
	<tr><td valign="middle" align="right" width="40%"><b>{$Starting_With} {$Currency}</b>:</td><td valign="top" align="left" width="60%"><input title="{$Starting_With} {$Currency}" class="form_input" name="startingwith" size="39" value="{$startingwith}" /></td></tr>
{else}
	<tr><td valign="middle" align="right" width="40%">{$Takings} {$Currency}:</td><td valign="top" align="left" width="60%"><input title="{$Takings} {$Currency}" class="form_input" name="takings" size="39" value="{$takings}" /></td></tr>
	<tr><td valign="middle" align="right" width="40%">{$Expenditures} {$Currency}:</td><td valign="top" align="left" width="60%"><input title="{$Expenditures} {$Currency}" class="form_input" name="expenditures" size="39" value="{$expenditures}" /></td></tr>
	<tr><td valign="top" align="right" width="40%"><b>{$Cashbook_Description}</b>:</td><td valign="top" align="left" width="60%"><textarea title="{$Cashbook_Description}" class="form_textarea" name="description" rows="3" cols="37">{$description}</textarea></td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="cashbookID" value="{$cashbookID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
{if $CASH_IN_HAND_STARTING_WITH eq 0}
	<input type="hidden" name="description" value="{$Starting_With}" />
{/if}
<input type="submit" class="button" title="{$InsertMsg}" value="{$InsertMsg}" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
