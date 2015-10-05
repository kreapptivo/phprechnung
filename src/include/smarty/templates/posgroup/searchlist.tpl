{*
	searchlist.tpl

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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$PositionGroupSub} - {$List}"
href="list.php?{$Session}">{$PositionGroupSub}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$PositionGroupSub} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$PositionGroupSub} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="4" title="{$PositionGroupSub} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="100%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr><td align="center" colspan="5"><h2>{$PositionGroupSub} - {$Searchresult}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages}
	<tr><td align="center" colspan="4">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
	</td></tr>
{/if}
{if $smarty.session.EditID and ( $smarty.session.EditID eq 1 )}
	<tr><td align="center" colspan="4" class="greentxt">{$EntryChanged} {$EntryNo} {$posgroupID}</td></tr>
{/if}
{if $smarty.session.DeleteID and ( $smarty.session.DeleteID eq 1 )}
	<tr><td align="center" colspan="4" class="greentxt">{$EntryDeleted} {$EntryNo} {$posgroupID}</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD">
<td nowrap="nowrap" align="left">{$EntryNo}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POSGROUPID&amp;Sort=ASC&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$EntryNo} ASC" alt="{$SortMsg} {$EntryNo} ASC" /></a>&nbsp;<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POSGROUPID&amp;Sort=DESC&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$EntryNo} DESC" alt="{$SortMsg} {$EntryNo} DESC" /></a>&nbsp;</td>
<td nowrap="nowrap" align="left">{$PositionGroupSub}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=DESCRIPTION&amp;Sort=ASC&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionGroupSub} ASC" alt="{$SortMsg} {$PositionGroupSub} ASC" /></a>&nbsp;<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=DESCRIPTION&amp;Sort=DESC&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionGroupSub} DESC" alt="{$SortMsg} {$PositionGroupSub} DESC" /></a>&nbsp;</td>
<td nowrap="nowrap" align="center" colspan="2">{$Entrys}:&nbsp;{$MaxRows}&nbsp;</td></tr>
{* Display entrys from database if $MaxRows > 0 *}
{if $MaxRows == 0}
	<tr><td align="center" colspan="5" class="rextxt">{$NoEntry}</td></tr>
{else}
{foreach from=$PosGroupData item=posgroup}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a name="{$posgroup.POSGROUPID}" title="{$AllInformation} {$EntryNo} {$posgroup.POSGROUPID} - {$posgroup.DESCRIPTION}" class="ninfolink" href="info.php?posgroupID={$posgroup.POSGROUPID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}">
	{$posgroup.POSGROUPID}</a></td><td valign="top" align="left">
	{$posgroup.DESCRIPTION}</td>
	{if $smarty.session.Username and ( $smarty.session.Username == $Root or $smarty.session.Usergroup1 == $AdminGroup1 or $smarty.session.Usergroup2 == $AdminGroup2)}
		<td valign="top" align="center"><a href="edit.php?posgroupID={$posgroup.POSGROUPID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/edit.png" title="{$Editentry}" alt="{$Editentry}" /></a></td></tr>
	{else}
		<td></td></tr>
	{/if}
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages and ($PageRows >= $MultiBar)}
	<tr><td align="center" colspan="4">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Description_1={$Description_1}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
</td></tr>
<tr><td>&nbsp;</td></tr>
{* Include the linkbar *}
<tr><td colspan="5">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
