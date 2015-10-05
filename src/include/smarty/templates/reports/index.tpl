{*
	index.tpl

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
{if $Report}
	<body onload="document.NewReport.DateFrom.focus();">
{else}
	<body onload="document.Report.Report.focus();">
{/if}
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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="R" title="{$Reports}"
href="index.php?{$Session}">{$Reports}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Reports} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
href="../configuration.php?{$Session}">{$Configuration}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="1" title="{$Syslog} - {$List}"
href="../syslog/list.php?{$Session}">{$Syslog}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="80%" border="0" cellpadding="2" cellspacing="0" summary="Tabelle 1">
<tr>
	<td class="phprechnung_tabelle">
	<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
	<tr><td align="center" colspan="2"><h2>{$Reports}</h2></td></tr>
<tr><td align="right" width="40%" valign="top">{$Reports}:</td>
{* Display all available reports *}
<td align="left" width="60%" valign="middle">
<form id="Report" name="Report" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="DateFrom" value="{$DateFrom}" />
<input type="hidden" name="DateTill" value="{$DateTill}" />
<select class="choice250" name="Report" title="{$Select_Report}" onchange="this.form.submit();">
<optgroup label="{$Reports}" title="{$Reports}">
<option label="{$Select_Report}" title="{$Select_Report}"  value="">--- {$Select_Report} ---</option>
{foreach item=report from=$choose_report}
	{foreach key=key item=item from=$report}
		{if $Report eq $key}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}"  value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select>
</form>
</td></tr>
{if $Report}
	<form id="NewReport" name="NewReport" action="{$Report}?{$Session}" method="post">
	<input type="hidden" name="Report" value="{$Report}" />
	<tr><td align="right" width="40%" valign="middle">{$DateMsg} {$Date_From}:</td><td align="left" width="60%" valign="middle"><input title="{$DateMsg} {$Date_From}" class="form_input" type="text" name="DateFrom" size="30" value="{if $DateFrom}{$DateFrom}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td></tr>
	<tr><td align="right" width="40%" valign="middle">{$DateMsg} {$Date_Till}:</td><td align="left" width="60%" valign="middle"><input title="{$DateMsg} {$Date_Till}" class="form_input" type="text" name="DateTill" size="30" value="{if $DateTill}{$DateTill}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td></tr>
	<tr><td align="center" colspan="2"><input class="button" type="submit" title="{$Search}" value="{$Search}" /></td></tr>
</form>
{/if}
</table>
</td></tr>
</table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
