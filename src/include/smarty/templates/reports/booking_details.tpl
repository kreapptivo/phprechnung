{*
	booking_details.tpl

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
	<td valign="middle" align="left" colspan="7">
	[&nbsp;<a title="{$BackMsg} - {$Reports}" class="ninfolink" href="index.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	[&nbsp;<a title="{$PrintMsg} - {$SearchResult} - {$DateFrom} {$Date_Till} {$DateTill}" class="ninfolink" href="pdf/print_pdf.php?DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Type=Booking_Details&amp;Canceled={$Canceled}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}" target="_blank">{$PrintMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="6"><h2>{$Reports} - {$SearchResult}</h2></td></tr>
<tr><td align="center" colspan="6">{$DateMsg} {$Date_From} {$DateFrom} {$Date_Till} {$DateTill}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $Rows ( lines per page ) *}
{if $MaxPages}
<tr><td align="center" colspan="6">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$Payment_No}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=PAYMENTID&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Payment_No} ASC" alt="{$SortMsg} {$Payment_No} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=PAYMENTID&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Payment_No} DESC" alt="{$SortMsg} {$Payment_No} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$Customer}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Customer} ASC" alt="{$SortMsg} {$Customer} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Customer} DESC" alt="{$SortMsg} {$Customer} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$DateMsg}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=P.PAYMENT_DATE&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$DateMsg} ASC" alt="{$SortMsg} {$DateMsg} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=P.PAYMENT_DATE&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$DateMsg} DESC" alt="{$SortMsg} {$DateMsg} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$Payment_Sum} {$Payment_Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=SUM_PAID&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Payment_Sum} ASC" alt="{$SortMsg} {$Payment_Sum} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=SUM_PAID&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Payment_Sum} DESC" alt="{$SortMsg} {$Payment_Sum} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$Method_Of_Payment}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=METHOD_OF_PAY&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Method_Of_Payment} ASC" alt="{$SortMsg} {$Method_Of_Payment} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=METHOD_OF_PAY&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Method_Of_Payment} DESC" alt="{$SortMsg} {$Method_Of_Payment} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$Entrys}:&nbsp;{$MaxRows}
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=2&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$NotCanceledEntries}" alt="{$NotCanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=1&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$CanceledEntries}" alt="{$CanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=3&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/right.png" title="{$AllEntries}" alt="{$AllEntries}" /></a>
</td></tr>
{* Display entrys from database if $MaxRows > 0 *}
{foreach from=$PaymentData item=payment}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a name="{$payment.PAYMENTID}" title="{$AllInformation} {$Payment_No} {$payment.PAYMENTID}" class="ninfolink" href="../payment/info.php?myID={$payment.MYID}&amp;paymentID={$payment.PAYMENTID}&amp;infoID=30&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}" target="_blank">
	{$payment.PAYMENTID}</a></td>
	{if $payment.CANCELED neq 1}
		<td valign="top" align="left">
		{if $payment.FIRSTNAME}
			{$payment.FIRSTNAME}
		{/if}
		{if $payment.LASTNAME}
			{$payment.LASTNAME},
		{/if}
		{if $payment.COMPANY}
			{$payment.COMPANY}
		{/if}
		</td>
		<td valign="top" align="center">{$payment.PAYMENT_DATE}</td>
		<td valign="top" align="right">{$payment.SUM_PAID|number_format}</td>
		<td valign="top" align="left" colspan="2">{$payment.METHOD_OF_PAY}</td>
	{else}
		<td valign="top" align="left" class="graytxt">
		{if $payment.FIRSTNAME}
			{$payment.FIRSTNAME}
		{/if}
		{if $payment.LASTNAME}
			{$payment.LASTNAME},
		{/if}
		{if $payment.COMPANY}
			{$payment.COMPANY}
		{/if}
		</td>
		<td valign="top" align="center" class="graytxt">{$payment.PAYMENT_DATE}</td>
		<td valign="top" align="right" class="graytxt"><del>{$payment.SUM_PAID|number_format}</del></td>
		<td valign="top" align="left" class="graytxt" colspan="2">{$payment.METHOD_OF_PAY}</td>
	{/if}
	</tr>
{foreachelse}
	<tr><td align="center" colspan="6" class="redtxt">{$NoEntry}</td></tr>
{/foreach}
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" colspan="5">{$Payment_Sum} - {$PageMsg}  {$Payment_Currency}:</td><td valign="top" align="right">{$TOTAL_PAGE|number_format}</td></tr>
<tr><td valign="top" align="right" colspan="5"><b>{$Payment_Sum} - {$Searchresult}  {$Payment_Currency}</b>:</td><td valign="top" align="right">{$TOTAL_SEARCHRESULT|number_format}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $Rows ( lines per page ) *}
{if $MaxPages and ($PageRows gte $MultiBar)}
<tr><td align="center" colspan="6">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;DateFrom={$DateFrom}&amp;DateTill={$DateTill}&amp;Report={$Report}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
<tr><td>&nbsp;</td></tr>
{* Include the linkbar *}
<tr><td colspan="6">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody>
</table>
</td>
</tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
