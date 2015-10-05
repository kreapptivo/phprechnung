{*
	list.tpl

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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="I" title="{$Invoice} - {$List}"
href="list.php?{$Session}">{$Invoice}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Invoice} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Invoice} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Invoice} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
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
<tr><td align="center" colspan="8"><h2>{$Invoice} - {$List}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $Rows ( lines per page ) *}
{if $MaxPages}
<tr><td align="center" colspan="8">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
{/if}
{if $smarty.session.NewID and ( $smarty.session.NewID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$NewEntry} {$Invoice_No} {$invoiceID}</td></tr>
{/if}
{if $smarty.session.EditID and ( $smarty.session.EditID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$EntryChanged} {$Invoice_No} {$invoiceID}, {$Customer_No} {$myID}</td></tr>
{/if}
{if $smarty.session.CancelID and ( $smarty.session.CancelID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$EntryCanceled} {$Invoice_No} {$invoiceID}, {$Customer_No} {$myID}</td></tr>
{/if}
{if $smarty.session.emailID and ( $smarty.session.emailID eq "1" )}
	<tr><td align="center" colspan="8" class="greentxt">{$Email_OK} {$FIRSTNAME} {$LASTNAME} {$COMPANY}, {$smarty.session.Type} {$invoiceID}, {$Customer_No} {$MYID}</td></tr>
{/if}
{if $smarty.session.emailID and ( $smarty.session.emailID eq "2" )}
	<tr><td align="center" colspan="8" class="redtxt">{$Email_Error}</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$Invoice_No}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=INVOICEID&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Invoice_No} ASC" alt="{$SortMsg} {$Invoice_No} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=INVOICEID&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Invoice_No} DESC" alt="{$SortMsg} {$Invoice_No} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$Customer}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Customer} ASC" alt="{$SortMsg} {$Customer} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Customer} DESC" alt="{$SortMsg} {$Customer} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$DateMsg}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=I.INVOICE_DATE&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$DateMsg} ASC" alt="{$SortMsg} {$DateMsg} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=I.INVOICE_DATE&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$DateMsg} DESC" alt="{$SortMsg} {$DateMsg} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$Invoice_Amount} {$Invoice_Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Invoice_Amount} ASC" alt="{$SortMsg} {$Invoice_Amount} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Invoice_Amount} DESC" alt="{$SortMsg} {$Invoice_Amount} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$Open_Account}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT-SUM_PAID&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Open_Account} ASC" alt="{$SortMsg} {$Open_Account} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=TOTAL_AMOUNT-SUM_PAID&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Open_Account} DESC" alt="{$SortMsg} {$Open_Account} DESC" /></a>
</td>
<td nowrap="nowrap" align="center" colspan="3">{$Entrys}:&nbsp;{$MaxRows}
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=2&amp;{$Session}"><img border="0" src="../images/up.png" title="{$NotCanceledEntries}" alt="{$NotCanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=1&amp;{$Session}"><img border="0" src="../images/down.png" title="{$CanceledEntries}" alt="{$CanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=3&amp;{$Session}"><img border="0" src="../images/right.png" title="{$AllEntries}" alt="{$AllEntries}" /></a>
&nbsp;
</td>
</tr>
{* Display entrys from database if $MaxRows > 0 *}
{if $MaxRows eq 0}
	<tr><td align="center" colspan="8" class="redtxt">{$NoEntry}</td></tr>
{else}
{foreach from=$InvoiceData item=invoice}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a name="{$invoice.INVOICEID}" title="{$AllInformation} {$Invoice_No} {$invoice.INVOICEID}" class="ninfolink" href="info.php?myID={$invoice.MYID}&amp;invoiceID={$invoice.INVOICEID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">
	{$invoice.INVOICEID}</a></td>
	{if $invoice.CANCELED neq 1}
		<td valign="top" align="left">
		{if $invoice.FIRSTNAME}
			{$invoice.FIRSTNAME}
		{/if}
		{if $invoice.LASTNAME}
			{$invoice.LASTNAME},
		{/if}
		{if $invoice.COMPANY}
			{$invoice.COMPANY}
		{/if}
		</td>
		<td valign="top" align="center">{$invoice.INVOICE_DATE}</td>
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $invoice.CREATEDBY)}
			<td valign="top" align="right">{$invoice.TOTAL_AMOUNT|number_format}</td>
		{else}
			<td valign="top" align="right"></td>
		{/if}
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $invoice.CREATEDBY)}
			{if $invoice.PAID eq '2'}
				<td valign="top" align="right" class="redtxt">{$invoice.TOTAL_AMOUNT-$invoice.SUM_PAID|number_format}</td>
			{else}
				<td valign="top" align="right"></td>
			{/if}
		{else}
			<td valign="top" align="right"></td>
		{/if}
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $invoice.CREATEDBY)}
			{if $invoice.PAID eq '2'}
				<td valign="top" align="center"><a href="edit.php?invoiceID={$invoice.INVOICEID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/edit.png" title="{$Editentry}" alt="{$Editentry}" /></a></td>
				<td valign="top" align="center"><a href="print_pdf.php?myID={$invoice.MYID}&amp;invoiceID={$invoice.INVOICEID}&amp;Type=Invoice&amp;{$Session}" target="_blank"><img border="0" src="../images/print.png" title="{$Print_Invoice} - {$Invoice_No} {$invoice.INVOICEID}" alt="{$Print_Invoice} - {$Invoice_No} {$invoice.INVOICEID}" /></a></td>
				<td valign="top" align="center"><a href="../payment/new.php?myID={$invoice.MYID}&amp;invoiceID={$invoice.INVOICEID}&amp;{$Session}"><img border="0" src="../images/bill.png" title="{$Invoice_Transaction} {$invoice.INVOICEID}{if $invoice.FIRSTNAME} {$invoice.FIRSTNAME}{/if}{if $invoice.LASTNAME} {$invoice.LASTNAME},{/if}{if $invoice.COMPANY} {$invoice.COMPANY}{/if}" alt="{$Invoice_Transaction} {$invoice.INVOICEID}{if $invoice.FIRSTNAME} {$invoice.FIRSTNAME}{/if}{if $invoice.LASTNAME} {$invoice.LASTNAME},{/if}{if $invoice.COMPANY} {$invoice.COMPANY}{/if}" /></a></td>
			{else}
				<td valign="top" align="center" colspan="3"></td>
			{/if}
		{else}
			<td valign="top" align="center" colspan="3"></td>
		{/if}
	{else}
		<td valign="top" align="left" class="graytxt">
		{if $invoice.FIRSTNAME}
			{$invoice.FIRSTNAME}
		{/if}
		{if $invoice.LASTNAME}
			{$invoice.LASTNAME},
		{/if}
		{if $invoice.COMPANY}
			{$invoice.COMPANY}
		{/if}
		</td>
		<td valign="top" align="center" class="graytxt">{$invoice.INVOICE_DATE}</td>
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $invoice.CREATEDBY)}
			<td valign="top" align="right" class="graytxt"><del>{$invoice.TOTAL_AMOUNT|number_format}</del></td>
		{else}
			<td valign="top" align="right" class="graytxt"></td>
		{/if}
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $invoice.CREATEDBY)}
			{if $invoice.PAID eq '2'}
				<td valign="top" align="right" class="graytxt"><del>{$invoice.TOTAL_AMOUNT-$invoice.SUM_PAID|number_format}</del></td>
			{else}
				<td valign="top" align="right" class="graytxt"></td>
			{/if}
		{else}
			<td valign="top" align="right" class="graytxt"></td>
		{/if}
		<td valign="top" align="center" colspan="3" class="graytxt"></td>
	{/if}
	</tr>
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
	<tr><td>&nbsp;</td></tr>
	{if $OPEN_ACCOUNT gt 0}
		<tr><td valign="top" align="right" colspan="5">{$Open_Account} {$Invoice_Currency}:</td><td valign="top" align="right" colspan="3" class="redtxt">{$OPEN_ACCOUNT|number_format}</td></tr>
	{/if}
	<tr><td valign="top" align="right" colspan="5">{$Invoice_Amount} - {$PageMsg}  {$Invoice_Currency}:</td><td valign="top" align="right" colspan="3">{$TOTAL_PAGE|number_format}</td></tr>
	<tr><td valign="top" align="right" colspan="5"><b>{$Invoice_Amount} {$Invoice_Currency}</b>:</td><td valign="top" align="right" colspan="3"><b>{$TOTAL_AMOUNT|number_format}</b></td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $Rows ( lines per page ) *}
{if $MaxPages and ($PageRows gte $MultiBar)}
<tr><td align="center" colspan="8">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
<tr><td>&nbsp;</td></tr>
{* Include the linkbar *}
<tr><td colspan="8">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
