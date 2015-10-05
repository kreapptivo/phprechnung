{*
	position_sales_summary.tpl

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
<table width="100%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr>
	<td valign="middle" align="left" colspan="5">
	[&nbsp;<a title="{$BackMsg} - {$Reports}" class="ninfolink" href="index.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	[&nbsp;<a title="{$PrintMsg} - {$SearchResult} - {$DateFrom} {$Date_Till} {$DateTill}" class="ninfolink" href="pdf/print_pdf.php?DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Type=Position_Sales_Summary&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}" target="_blank">{$PrintMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="5"><h2>{$Reports} - {$SearchResult}</h2></td></tr>
<tr><td align="center" colspan="5">{$DateMsg} {$Date_From} {$DateFrom} {$Date_Till} {$DateTill}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages}
	<tr><td align="center" colspan="5">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
	</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$Position}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=V.POSITIONID&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Position} ASC" alt="{$SortMsg} {$Position} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=V.POSITIONID&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Position} DESC" alt="{$SortMsg} {$Position} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$PositionText}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_DESC&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionText} ASC" alt="{$SortMsg} {$PositionText} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_DESC&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionText} DESC" alt="{$SortMsg} {$PositionText} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$PositionQuantity}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_QUANTITY&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionQuantity} ASC" alt="{$SortMsg} {$PositionQuantity} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_QUANTITY&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionQuantity} DESC" alt="{$SortMsg} {$PositionQuantity} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$PositionAmount} {$Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_AMOUNT&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$PositionAmount} ASC" alt="{$SortMsg} {$PositionAmount} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=POS_AMOUNT&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$PositionAmount} DESC" alt="{$SortMsg} {$PositionAmount} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$Entrys}:&nbsp;{$MaxRows}
</td>
</tr>
{* Display entrys from database if $MaxRows > 0 *}
{foreach from=$Positions item=position}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a name="{$position.POSITIONID}" title="{$AllInformation} {$PositionName} - {$position.POS_NAME}" class="ninfolink" href="../position/info.php?posID={$position.POSITIONID}&amp;infoID=30&amp;{$Session}" target="_blank">{$position.POS_NAME}</a></td>
	<td valign="top" align="left">{$position.POS_DESC|nl2br}</td>
	<td valign="top" align="right">{$position.POS_QUANTITY}</td>
	<td nowrap="nowrap" valign="top" align="right">{$position.POS_AMOUNT|number_format} ({$position.POS_AMOUNT/$TOTAL_AMOUNT*100|number_format}&#037;)</td>
	<td></td>
	</tr>
{foreachelse}
	<tr><td align="center" colspan="5" class="redtxt">{$NoEntry}</td></tr>
{/foreach}
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" colspan="4">{$PositionAmount} - {$PageMsg} {$Invoice_Currency}:</td><td valign="top" align="right">{$TOTAL_PAGE|number_format}</td></tr>
<tr><td valign="top" align="right" colspan="4"><b>{$PositionAmount} {$Searchresult} {$Invoice_Currency}</b>:</td><td valign="top" align="right"><b>{$TOTAL_AMOUNT|number_format}</b></td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $EntrysPerPage ( lines per page ) *}
{if $MaxPages and ($PageRows >= $MultiBar)}
	<tr><td align="center" colspan="5">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
	</td></tr>
	<tr><td>&nbsp;</td></tr>
	{* Include the linkbar *}
	<tr><td colspan="5">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody>
</table>
</td>
</tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
