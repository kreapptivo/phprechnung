{*
	info.tpl

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
{* Display Position information *}
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2"><tbody>
<tr><td align="center" colspan="2"><h2>{$Position} - {$Info}</h2></td></tr>
{* Display pager *}
<tr>
	<td align="center" colspan="2">
{if $CurrentPosID > $MinPosID }
	<a href="{$smarty.server.PHP_SELF}?posID={$MinPosID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?posID={$PrevPosID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Position}:&nbsp;<a title="{$Position}: {$CurrentPosID} / {$MaxPosID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?posID={$CurrentPosID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Searchstring}&amp;{$Session}">{$CurrentPosID}</a>&nbsp;/&nbsp;{$MaxPosID}&nbsp;
{if $CurrentPosID < $MaxPosID }
	<a href="{$smarty.server.PHP_SELF}?posID={$NextPosID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?posID={$MaxPosID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
	</td>
</tr>
<tr><td></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
	<tr><td align="center" colspan="2">
	[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit.php?posID={$posID}&amp;infoID={$infoID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active={$Pos_Active}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}">{$Edit}</a>
	&nbsp;|&nbsp;<a title="{$Deleteentry}" class="nmenulink" href="delete.php?posID={$posID}&amp;infoID={$infoID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Pos_Active={$Pos_Active}&amp;Pos_Name1={$Pos_Name1}&amp;Pos_Desc1={$Pos_Desc1}&amp;Pos_Price1={$Pos_Price1}&amp;{$Session}">{$Delete}</a>&nbsp;]
	</td></tr>
{/if}
<tr><td></td></tr>
<tr><td align="center" colspan="2">{$AllInformation} {$EntryNo} {$posID}</td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="right" width="40%">{$PositionName}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$Pos_Name}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PositionText}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$Pos_Desc|nl2br}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PositionPrice} {$Currency}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$Pos_Price|number_format}</td></tr>
<tr><td valign="top" align="right" width="40%">{$Tax}:&nbsp;[&nbsp;<a class="nlink" title="{$Tax} - {$Info}" href="../tax/list.php?{$Session}">&nbsp;i&nbsp;</a>&nbsp;]&nbsp;</td>
<td class="dbTxt" valign="top" align="left" width="60%">{$Pos_Tax}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PositionGroup}:&nbsp;[&nbsp;<a class="nlink" title="{$PositionGroupSub} - {$Info}" href="../posgroup/list.php?{$Session}">&nbsp;i&nbsp;</a>&nbsp;]&nbsp;</td>
<td class="dbTxt" valign="top" align="left" width="60%">{$Pos_Group}</td></tr>
<tr><td valign="top" align="right" width="40%">{$PositionActive}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PosActive}</td></tr>
<tr><td valign="top" align="right" width="40%">{$NoteMsg}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$Note|nl2br}</td></tr>
<tr><td></td></tr>
{* Display back button *}
<tr><td valign="middle" align="center" width="100%" colspan="2">
{if $infoID eq 9}
	<form action="searchlist.php?{$Session}#{$posID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="Pos_Name1" value="{$Pos_Name1}" />
	<input type="hidden" name="Pos_Desc1" value="{$Pos_Desc1}" />
	<input type="hidden" name="Pos_Price1" value="{$Pos_Price1}" />
	<input type="hidden" name="Note1" value="{$Note1}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Pos_Active" value="{$Pos_Active}" />
	<input type="submit" class="button" title="{$BackMsg} - {$Searchresult}" value="{$BackMsg} - {$Searchresult}" /></form></td></tr>
{elseif $infoID eq 30}
	<form action="javascript:window.close()" method="post">
	<input type="submit" class="button" title="{$CloseWindow}" value="{$CloseWindow}" /></form></td></tr>
{else}
	<form action="list.php?{$Session}#{$posID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Pos_Active" value="{$Pos_Active}" />
	<input type="submit" class="button" title="{$BackMsg} - {$List}" value="{$BackMsg} - {$List}" /></form></td></tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
