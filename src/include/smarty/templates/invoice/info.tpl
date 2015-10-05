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
{if $smarty.session.Username and ( $smarty.session.Username neq $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="0" summary="Tabelle 1">
<tr><td class="phprechnung_tabelle">
<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}
<h2>{$Invoice} - {$Info}</h2>
</td>
</tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}
{* Display pager *}
{if $CurrentInvoiceID > $MinInvoiceID }
	<a href="{$smarty.server.PHP_SELF}?invoiceID={$MinInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?invoiceID={$PrevInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Invoice_No}:&nbsp;<a title="{$Invoice_No}: {$CurrentInvoiceID} / {$MaxInvoiceID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?invoiceID={$CurrentInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentInvoiceID}</a>&nbsp;/&nbsp;{$MaxInvoiceID}&nbsp;
{if $CurrentInvoiceID < $MaxInvoiceID }
	<a href="{$smarty.server.PHP_SELF}?invoiceID={$NextInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?invoiceID={$MaxInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td>
</tr>
<tr>
{if $MaxRows eq 0}
	{if $TaxFree neq 1}
		<td align="center" colspan="7" class="redtxt">
	{else}
		<td align="center" colspan="6" class="redtxt">
	{/if}
	{$NoEntry}<br /><br />
	{if $smarty.session.Username and ( $smarty.session.Username eq $Root and $CANCELED neq 1)}
		[&nbsp;<a title="{$Cancelentry}" class="nmenulink" href="cancel.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Cancel}</a>&nbsp;]
	{/if}
	{if $CANCELED eq 1}
		{$Entry_Canceled}
	{/if}
{else}
	{if $TaxFree neq 1}
		<td align="center" colspan="7">
	{else}
		<td align="center" colspan="6">
	{/if}
	{if $PAID neq 1 and $CANCELED neq 1}
		[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Edit}</a>
		&nbsp;|&nbsp;<a title="{$Invoice_Transaction}&nbsp;{$invoiceID}" class="nmenulink" href="../payment/new.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;{$Session}">{$Transaction}</a>
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root)}
			&nbsp;|&nbsp;<a title="{$Cancelentry}" class="nmenulink" href="cancel.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Cancel}</a>&nbsp;]</td></tr>
		{else}
			&nbsp;]</td></tr>
		{/if}
	{else}
		</td></tr>
	{/if}
	{if $CANCELED eq 1}
		<tr>
		{if $TaxFree neq 1}
			<td align="center" colspan="7" class="redtxt">
		{else}
			<td align="center" colspan="6" class="redtxt">
		{/if}
		{$Entry_Canceled}
			</td>
		</tr>
	{/if}
	<tr>
	{if $TaxFree neq 1}
		<td align="center" colspan="7">
	{else}
		<td align="center" colspan="6">
	{/if}
	[&nbsp;<a title="{$Print_Delivery_Note}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;Type=DeliveryNote&amp;Pos_Order={$Pos_Order}&amp;Pos_Sort={$Pos_Sort}&amp;{$Session}" target="_blank">{$Print_Delivery_Note}</a>
	&nbsp;|&nbsp;<a title="{$Print_Invoice}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;Type=Invoice&amp;Pos_Order={$Pos_Order}&amp;Pos_Sort={$Pos_Sort}&amp;{$Session}" target="_blank">{$Print_Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Copy_Invoice}" class="nmenulink" href="copy_invoice.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Copy_Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Email_Delivery_Note}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;SendEmail=2&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Email}&nbsp;-&nbsp;{$Delivery_Note}</a>
	&nbsp;|&nbsp;<a title="{$Email_Invoice}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;SendEmail=1&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$Email}&nbsp;-&nbsp;{$Invoice}</a>&nbsp;]</td></tr>
<tr><td>&nbsp;</td></tr>
{if $PRINT_NAME neq 2}
	<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$PREFIX} {$TITLE}</td></tr>
	<tr><td nowrap="nowrap" align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$FIRSTNAME} {$LASTNAME}</td><td align="right" valign="middle">{$Invoice_No}:</td><td align="left" valign="middle">{$InvoiceInitials}-{$PrintDate}</td></tr>
{else}
	<tr><td nowrap="nowrap" align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="right" valign="middle">{$Invoice_No}:</td><td align="left" valign="middle">{$InvoiceInitials}-{$PrintDate}</td></tr>
{/if}
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$COMPANY}</td><td align="right" valign="middle">{$Customer_No}:</td><td align="left" valign="middle"><a title="{$AllInformation} {$Customer_No} {$CustomerNoInitials}-{$MYID}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$CustomerNoInitials}-{$MYID}</a></td></tr>
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$ADDRESS}</td><td align="right" valign="middle">{$CustMethodOfPayment}:</td><td align="left" valign="middle">{$METHOD_OF_PAY}</td></tr>
{if $METHOD_OF_PAY_DATE neq 0}
	<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$POSTALCODE}&nbsp;&nbsp;{$CITY}</td><td align="right" valign="middle">{$Payment} {$Date_Till}:</td><td align="left" valign="middle">{$METHOD_OF_PAY_DATE}</td></tr>
{else}
	<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$POSTALCODE}&nbsp;&nbsp;{$CITY}</td><td align="right" valign="middle">{$DateMsg}:</td><td align="left" valign="middle">{$INVOICE_DATE}</td></tr>
{/if}
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $COUNTRY neq $Country}{$COUNTRY}{/if}</td>
{if $METHOD_OF_PAY_DATE neq 0}
	<td align="right" valign="middle">{$DateMsg}:</td><td align="left" valign="middle">{$INVOICE_DATE}</td>
{else}
	<td align="right" valign="middle"></td><td align="left" valign="middle"></td>
{/if}
</tr>
<tr><td></td></tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3" summary="Tabelle 3">
<tr class="mblueTD"><td nowrap="nowrap" align="left" valign="middle">{$PositionName}</td><td nowrap="nowrap" align="left" valign="middle">{$PositionText}</td><td align="right" nowrap="nowrap" valign="middle">{$PositionQuantity}</td><td align="right" nowrap="nowrap" valign="middle">{$PositionPrice} {$Invoice_Currency}</td>{if $TaxFree neq 1}<td nowrap="nowrap" align="right" valign="middle">{$Tax}</td>{/if}<td nowrap="nowrap" align="right" valign="middle">{$PositionAmount} {$Invoice_Currency}</td><td nowrap="nowrap" align="center">{$Entrys}:&nbsp;{$MaxRows}&nbsp;</td></tr>
{foreach from=$PosData item=invoice}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a title="{$AllInformation} {$invoice.POS_NAME}" class="ninfolink" href="../position/info.php?posID={$invoice.POSITIONID}&amp;infoID=30&amp;{$Session}" target="_blank">{$invoice.POS_NAME}</a></td>
	<td valign="top" align="left">{$invoice.POS_DESC|nl2br}</td>
	<td nowrap="nowrap" valign="top" align="right">{if $invoice.POS_QUANTITY neq 0}{$invoice.POS_QUANTITY}{/if}</td>
	<td nowrap="nowrap" valign="top" align="right">{if $invoice.POS_QUANTITY neq 0}{$invoice.POS_PRICE|number_format}{/if}</td>
{if $TaxFree neq 1}
	<td nowrap="nowrap" valign="top" align="right">{if $invoice.POS_QUANTITY neq 0}{$invoice.TAX_DESC}{/if}</td>
{/if}
<td nowrap="nowrap" valign="top" align="right">{if $invoice.POS_QUANTITY neq 0}{$invoice.POS_PRICE*$invoice.POS_QUANTITY|number_format}{/if}</td><td></td>
</tr>
{/foreach}
<tr><td>&nbsp;</td></tr>
{if $TaxFree neq 1}
	{if $SUBTOTAL1 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX1_DESC}:</td><td valign="top" align="right">{$SUBTOTAL1|number_format}</td></tr>
	{/if}
	{if $SUBTOTAL2 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX2_DESC}:</td><td valign="top" align="right">{$SUBTOTAL2|number_format}</td></tr>
	{/if}
	{if $SUBTOTAL3 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX3_DESC}:</td><td valign="top" align="right">{$SUBTOTAL3|number_format}</td></tr>
	{/if}
	{if $SUBTOTAL4 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX4_DESC}:</td><td valign="top" align="right">{$SUBTOTAL4|number_format}</td></tr>
	{/if}
	{if $TAX1 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Tax1} {$TAX1_DESC}:</td><td valign="top" align="right">{$TAX1|number_format}</td></tr>
	{/if}
	{if $TAX2 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Tax2} {$TAX2_DESC}:</td><td valign="top" align="right">{$TAX2|number_format}</td></tr>
	{/if}
	{if $TAX3 neq 0}
		<tr><td valign="top" align="right" colspan="6">{$Invoice_Tax3} {$TAX3_DESC}:</td><td valign="top" align="right">{$TAX3|number_format}</td></tr>
	{/if}
	{if $CANCELED neq 1}
		<tr>
			<td valign="top" align="right" colspan="6"><b>{$Invoice_Amount} {$Invoice_Currency}</b>:
			</td>
			<td valign="top" align="right"><b>{$TOTAL_AMOUNT|number_format}</b>
			</td>
		</tr>
		{if $OPEN_ACCOUNT gt 0}
			<tr>
				<td valign="top" align="right" colspan="6">{$Open_Account} {$Invoice_Currency}:
				</td>
				<td valign="top" align="right" class="redtxt">{$OPEN_ACCOUNT|number_format}
				</td>
			</tr>
		{/if}
	{else}
		<tr>
			<td valign="top" align="right" colspan="6"><b>{$Invoice_Amount} {$Invoice_Currency}</b>:
			</td>
			<td valign="top" align="right"><del><b>{$TOTAL_AMOUNT|number_format}</b></del>
			</td>
		</tr>
	{/if}
{else}
	{if $CANCELED neq 1}
		<tr>
			<td valign="top" align="right" colspan="5"><b>{$Invoice_Amount} {$Invoice_Currency}</b>:
			</td>
			<td valign="top" align="right"><b>{$TOTAL_AMOUNT|number_format}</b>
			</td>
		</tr>
		{if $OPEN_ACCOUNT gt 0}
			<tr>
				<td valign="top" align="right" colspan="5">{$Open_Account} {$Invoice_Currency}:
				</td>
				<td valign="top" align="right" class="redtxt">{$OPEN_ACCOUNT|number_format}
				</td>
			</tr>
		{/if}
	{else}
		<tr>
			<td valign="top" align="right" colspan="5"><b>{$Invoice_Amount} {$Invoice_Currency}</b>:
			</td>
			<td valign="top" align="right"><del><b>{$TOTAL_AMOUNT|number_format}</b></del>
			</td>
		</tr>
	{/if}
{/if}
<tr><td>&nbsp;</td></tr>
{if $SUM_PAID gt 0}
<tr>
	{if $TaxFree neq 1}
		<td valign="top" align="left" colspan="7">
	{else}
		<td valign="top" align="left" colspan="6">
	{/if}
		{$Transaction}:
		</td>
</tr>
{foreach from=$PaymentData item=payment}
	<tr class="{cycle values="grayTD,wTD"}">
	{if $TaxFree neq 1}
		<td valign="top" align="left" colspan="7">
	{else}
		<td valign="top" align="left" colspan="6">
	{/if}
		{$payment.PAYMENT_DATE} [ {$payment.METHOD_OF_PAY} ] {$payment.SUM_PAID|number_format} {$Invoice_Currency}</td>
	</tr>
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
<tr>
{if $TaxFree neq 1}
	<td colspan="7" align="center" valign="middle" class="justifydbTxt">
{else}
	<td colspan="6" align="center" valign="middle" class="justifydbTxt">
{/if}
{$Invoice_Note}:&nbsp;[&nbsp;---&nbsp;{$NOTE|nl2br}&nbsp;---&nbsp;]
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7" valign="middle" class="justifydbTxt">
{else}
	<td align="center" colspan="6"valign="middle" class="justifydbTxt">
{/if}
{$Message}:&nbsp;[&nbsp;---&nbsp;{$MESSAGEID|nl2br}&nbsp;---&nbsp;]</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}
{if $infoID eq 9}
	<form action="searchlist.php?{$Session}#{$invoiceID}" method="post">
	<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
	<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
	<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
	<input type="hidden" name="DateTill1" value="{$DateTill1}" />
	<input type="hidden" name="Total1" value="{$Total1}" />
	<input type="hidden" name="Customer1" value="{$Customer1}" />
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Canceled" value="{$Canceled}" />
	<input type="submit" class="button" title="{$BackMsg} - {$Searchresult}" value="{$BackMsg} - {$Searchresult}" /></form></td></tr>
{elseif $infoID eq 30}
	<form action="javascript:window.close()" method="post">
	<input type="submit" class="button" title="{$CloseWindow}" value="{$CloseWindow}" /></form></td></tr>
{else}
	<form action="list.php?{$Session}#{$invoiceID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Canceled" value="{$Canceled}" />
	<input type="submit" class="button" title="{$BackMsg} - {$List}" value="{$BackMsg} - {$List}" /></form></td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}
{if $MaxRows > 3}
	{* Display pager *}
	{if $CurrentInvoiceID > $MinInvoiceID }
		<a href="{$smarty.server.PHP_SELF}?invoiceID={$MinInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?invoiceID={$PrevInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
	{/if}
	{$Invoice_No}:&nbsp;<a title="{$Invoice_No}: {$CurrentInvoiceID} / {$MaxInvoiceID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?invoiceID={$CurrentInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentInvoiceID}</a>&nbsp;/&nbsp;{$MaxInvoiceID}&nbsp;
	{if $CurrentInvoiceID < $MaxInvoiceID }
		<a href="{$smarty.server.PHP_SELF}?invoiceID={$NextInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
		<a href="{$smarty.server.PHP_SELF}?invoiceID={$MaxInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
	{/if}
{/if}
{/if}
</td>
</tr>
</table></td></tr></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
