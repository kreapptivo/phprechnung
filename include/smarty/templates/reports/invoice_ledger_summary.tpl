{*
	invoice_ledger_summary.tpl

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
	<td valign="middle" align="left" colspan="4">
	[&nbsp;<a title="{$BackMsg} - {$Reports}" class="ninfolink" href="index.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	[&nbsp;<a title="{$PrintMsg} - {$SearchResult} - {$DateFrom} {$Date_Till} {$DateTill}" class="ninfolink" href="pdf/print_pdf.php?DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Type=Invoice_Ledger_Summary&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}" target="_blank">{$PrintMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="6"><h2>{$Reports} - {$SearchResult}</h2></td></tr>
<tr><td align="center" colspan="6">{$DateMsg} {$Date_From} {$DateFrom} {$Date_Till} {$DateTill}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $Rows ( lines per page ) *}
{if $MaxPages}
	<tr><td align="center" colspan="4">
	{if $CurrentPage > 1 }
		<a href="{$smarty.server.PHP_SELF}?page=1&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
	{if $CurrentPage < $MaxPages }
		<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
	</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD">
<td nowrap="nowrap" align="left" width="50%">&nbsp;{$Customer}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Customer} ASC" alt="{$SortMsg} {$Customer} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Customer} DESC" alt="{$SortMsg} {$Customer} DESC" /></a>
</td>
<td nowrap="nowrap" align="right" width="20%">{$Invoice_Amount} {$Invoice_Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Invoice_Amount} ASC" alt="{$SortMsg} {$Invoice_Amount} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Invoice_Amount} DESC" alt="{$SortMsg} {$Invoice_Amount} DESC" /></a>
</td>
<td nowrap="nowrap" align="right" width="20%">{$Open_Account}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=OPEN_ACCOUNT&amp;Sort=ASC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Open_Account} ASC" alt="{$SortMsg} {$Open_Account} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=OPEN_ACCOUNT&amp;Sort=DESC&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Open_Account} DESC" alt="{$SortMsg} {$Open_Account} DESC" /></a>
</td>
<td nowrap="nowrap" align="center" width="10%">{$Entrys}:&nbsp;{$MaxRows}
</td>
</tr>
{* Display entrys from database if $MaxRows > 0 *}
{foreach from=$InvoiceData item=invoice}
<tr class="{cycle values="grayTD,wTD"}">
<td valign="top" align="left" width="50%"><a title="{$AllInformation} {$Customer_No} {$invoice.MYID} -{if $invoice.FIRSTNAME neq " "} {$invoice.FIRSTNAME}{/if}{if $invoice.LASTNAME neq " "} {$invoice.LASTNAME},{/if}{if $invoice.COMPANY} {$invoice.COMPANY}{/if}" class="ninfolink" href="../addressbook/info.php?myID={$invoice.MYID}&amp;infoID=30&amp;{$Session}" target="_blank">
{$invoice.MYID} -
{if $invoice.FIRSTNAME}
	{$invoice.FIRSTNAME}
{/if}
{if $invoice.LASTNAME}
	{$invoice.LASTNAME},
{/if}
{if $invoice.COMPANY}
	{$invoice.COMPANY}
{/if}</a></td>
	<td nowrap="nowrap" valign="top" align="right" width="20%">{$invoice.TOTAL_AMOUNT|number_format} ({$invoice.TOTAL_AMOUNT/$TOTAL_AMOUNT*100|number_format}&#037;)</td>
	<td nowrap="nowrap" valign="top" align="right" class="redtxt" width="20%">{if $invoice.OPEN_ACCOUNT neq 0}{$invoice.OPEN_ACCOUNT|number_format}{/if}</td>
	<td valign="top" align="center" width="10%"><td>
</tr>
{foreachelse}
	<tr><td align="center" colspan="4" class="redtxt">{$NoEntry}</td></tr>
{/foreach}
<tr><td>&nbsp;</td></tr>
{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
	<tr><td>&nbsp;</td></tr>
	{if $OPEN_ACCOUNT gt 0}
		<tr><td valign="top" align="right" colspan="3">{$Open_Account} {$Invoice_Currency}:</td><td valign="top" align="right" class="redtxt">{$OPEN_ACCOUNT|number_format}</td></tr>
	{/if}
	<tr><td valign="top" align="right" colspan="3">{$Invoice_Amount} - {$PageMsg} {$Invoice_Currency}:</td><td valign="top" align="right">{$TOTAL_PAGE|number_format}</td></tr>
	<tr><td valign="top" align="right" colspan="3"><b>{$Invoice_Amount} {$Searchresult} {$Invoice_Currency}</b>:</td><td valign="top" align="right"><b>{$TOTAL_AMOUNT|number_format}</b></td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $Rows ( lines per page ) *}
{if $MaxPages and ($PageRows gte $MultiBar)}
<tr><td align="center" colspan="4">
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
<tr><td colspan="4">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody>
</table>
</td>
</tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
