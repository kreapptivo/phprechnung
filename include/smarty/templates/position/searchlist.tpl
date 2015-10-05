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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="P" title="{$Position} - {$List}"
href="list.php?{$Session}">{$Position}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Position} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Position} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Position} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
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
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="100%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr><td align="center" colspan="5"><h2>{$Position} - {$Searchresult}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages}
	<tr><td align="center" colspan="5">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
	</td></tr>
{/if}
{if $smarty.session.EditID and ( $smarty.session.EditID eq 1 )}
	<tr><td align="center" colspan="4" class="greentxt">{$EntryChanged} {$EntryNo} {$posID}</td></tr>
{/if}
{if $smarty.session.DeleteID and ( $smarty.session.DeleteID eq 1 )}
	<tr><td align="center" colspan="4" class="greentxt">{$EntryDeleted} {$EntryNo} {$posID}</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$PositionName}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_NAME&amp;Sort=ASC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionName} ASC" alt="{$SortMsg} {$PositionName} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_NAME&amp;Sort=DESC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionName} DESC" alt="{$SortMsg} {$PositionName} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$PositionText}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_TEXT&amp;Sort=ASC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionText} ASC" alt="{$SortMsg} {$PositionText} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_TEXT&amp;Sort=DESC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionText} DESC" alt="{$SortMsg} {$PositionText} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$PositionGroup}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_GROUP&amp;Sort=ASC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionGroup} ASC" alt="{$SortMsg} {$PositionGroup} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_GROUP&amp;Sort=DESC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionGroup} DESC" alt="{$SortMsg} {$PositionGroup} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$PositionPrice} {$Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_PREIS&amp;Sort=ASC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionPrice} ASC" alt="{$SortMsg} {$PositionPrice} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_PREIS&amp;Sort=DESC&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionPrice} DESC" alt="{$SortMsg} {$PositionPrice} DESC" /></a>
</td>
<td nowrap="nowrap" align="center" colspan="2">{$Entrys}:&nbsp;{$MaxRows}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Pos_Active1=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$PositionActive}" alt="{$PositionActive}" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Pos_Active1=2&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$PositionInactive}" alt="{$PositionInactive}" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Pos_Active1=3&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/right.png" title="{$ShowAllPositions}" alt="{$ShowAllPositions}" /></a>
&nbsp;
</td>
</tr>
{* Display entrys from database if $MaxRows > 0 *}
{if $MaxRows == 0}
	<tr><td align="center" colspan="5" class="redtxt">{$NoEntry}</td></tr>
{else}
{foreach from=$Positions item=position}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a name="{$position.POSITIONID}" title="{$AllInformation} {$position.POS_NAME}" class="ninfolink" href="info.php?posID={$position.POSITIONID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}">{$position.POS_NAME}</a></td>
	<td valign="top" align="left">{$position.POS_DESC|nl2br}</td>
	<td valign="top" align="left">{$position.POS_GROUP|nl2br}</td>
	<td valign="top" align="right">{$position.POS_PRICE|number_format}</td>
	{if $smarty.session.Username and ( $smarty.session.Username == $Root or $smarty.session.Usergroup1 == $AdminGroup1 or $smarty.session.Usergroup2 == $AdminGroup2)}
		<td valign="top" align="center"><a href="edit.php?posID={$position.POSITIONID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/edit.png" title="{$Editentry}" alt="{$Editentry}" /></a></td>
		<td valign="top" align="center"><a href="delete.php?posID={$position.POSITIONID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/delete.png" title="{$Deleteentry}" alt="{$Deleteentry}" /></a></td>
	{else}
		<td></td><td></td>
	{/if}
	</tr>
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages and ($PageRows >= $MultiBar)}
	<tr><td align="center" colspan="5">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active1={$Pos_Active1}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
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
