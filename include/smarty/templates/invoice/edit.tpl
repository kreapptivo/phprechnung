{*
	edit.tpl

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
	<body onload="document.{$mark}.focus();">
{else}
	<body onload="document.Edit.Customer.focus();">
{/if}
{include file="htable.tpl"}
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Tabelle 3">
<tr>
	<td id="td1_20" width="20%" valign="top">
	{* Menubar start *}
		<table border="0" width="80%" cellspacing="0" cellpadding="0" summary="Tabelle 4">
			{if $smarty.session.SuperUser and ( $smarty.session.SuperUser eq $Root )}
				<tr>
					<td align="center" class="phprechnung_menu"><a accesskey="L" title="{$Logout}"
					href="../login/suend.php?{$Session}">{$Logout}</a>
					</td>
				</tr>
			{else}
				<tr>
					<td align="center" class="phprechnung_menu"><a accesskey="L" title="{$Logout}"
					href="../login/logout.php?{$Session}">{$Logout}</a>
					</td>
				</tr>
			{/if}
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="W" title="{$Startpage}"
				href="../index.php?{$Session}">{$Startpage}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="A" title="{$Addressbook}"
				href="../addressbook/list.php?{$Session}">{$Addressbook}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="P" title="{$Position}"
				href="../position/list.php?{$Session}">{$Position}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="O" title="{$Offer}"
				href="../offer/list.php?{$Session}">{$Offer}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu_sel"><a accesskey="I" title="{$Invoice} - {$List}"
				href="list.php?{$Session}">{$Invoice}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Invoice} - {$New}"
				href="new.php?{$Session}">{$New}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Invoice} - {$Search}"
				href="search.php?{$Session}">{$Search}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Invoice} - {$Help}"
				href="help.php?{$Session}">{$Help}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="M" title="{$Payment}"
				href="../payment/list.php?{$Session}">{$Payment}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="C" title="{$Cashbook}"
				href="../cashbook/list.php?{$Session}">{$Cashbook}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="R" title="{$Reports}"
				href="../reports/index.php?{$Session}">{$Reports}</a>
				</td>
			</tr>
			<tr>
				<td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
				href="../configuration.php?{$Session}">{$Configuration}</a>
				</td>
			</tr>
			{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
				<tr>
					<td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
					href="../login/sustart.php?{$Session}">{$Superuser}</a>
					</td>
				</tr>
			{/if}
		</table>
	</td>
	{* Menubar end *}
	<td id="td1_2" width="2%">
	</td>
	<td width="78%" valign="top" align="center">
		<table width="100%" border="0" cellpadding="2" cellspacing="0" summary="Tabelle 1">
			<tr>
				<td class="phprechnung_tabelle">
					<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
						{if $TaxFree neq 1}
							<tr>
								<td align="center" colspan="8"><h2>{$Invoice} - {$Edit}</h2>
							</td>
							</tr>
						{else}
							<tr>
							<td align="center" colspan="7"><h2>{$Invoice} - {$Edit}</h2>
							</td>
							</tr>
						{/if}
						<tr>
						{if $TaxFree neq 1}
							<td align="center" colspan="8">
						{else}
							<td align="center" colspan="7">
						{/if}
						{* Display pager *}
						{if $CurrentInvoiceID > $MinInvoiceID }
							<a href="{$smarty.server.PHP_SELF}?invoiceID={$MinInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
							<a href="{$smarty.server.PHP_SELF}?invoiceID={$PrevInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
						{/if}
						{$Invoice_No}:&nbsp;<a title="{$Invoice_No}: {$CurrentInvoiceID} / {$MaxInvoiceID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?invoiceID={$CurrentInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;myID={$myID}&amp;messageID={$MESSAGEID}&amp;InvoiceDate={$INVOICE_DATE}&amp;MethodOfPayment={$NR_METHOD_OF_PAYMENT}&amp;MethodOfPaymentDate={$METHOD_OF_PAYMENT_DATE}&amp;Note={$NOTE}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentInvoiceID}</a>&nbsp;/&nbsp;{$MaxInvoiceID}&nbsp;
						{if $CurrentInvoiceID < $MaxInvoiceID }
							<a href="{$smarty.server.PHP_SELF}?invoiceID={$NextInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
							<a href="{$smarty.server.PHP_SELF}?invoiceID={$MaxInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
						{/if}
							</td>
						</tr>
						{if $MaxRows eq 0}
							<tr>
							{if $TaxFree neq 1}
								<td align="center" colspan="8" class="redtxt">
							{else}
								<td align="center" colspan="7" class="redtxt">
							{/if}
							{$NoEntry}
								</td>
							</tr>
						{elseif $CANCELED neq 2}
							<tr>
							{if $TaxFree neq 1}
								<td align="center" colspan="8" class="redtxt">
							{else}
								<td align="center" colspan="7" class="redtxt">
							{/if}
							{$Entry_Canceled}
								</td>
							</tr>
						{else}
							<tr>
								<td>&nbsp;
								</td>
							</tr>
						<tr>
							<td align="left" valign="middle" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;
							<form id="Edit" name="Edit" action="customerlist.php?{$Session}" method="post">
								<input type="hidden" name="invoiceID" value="{$invoiceID}" />
								<input type="hidden" name="infoID" value="{$infoID}" />
								<input type="hidden" name="messageID" value="{$MESSAGEID}" />
								<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
								<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
								<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
								<input type="hidden" name="Note" value="{$NOTE}" />
								{if $infoID eq 9}
									<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
									<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
									<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
									<input type="hidden" name="DateTill1" value="{$DateTill1}" />
									<input type="hidden" name="Total1" value="{$Total1}" />
									<input type="hidden" name="Customer1" value="{$Customer1}" />
								{/if}
								<input type="hidden" name="page" value="{$page}" />
								<input type="hidden" name="Order" value="{$Order}" />
								<input type="hidden" name="Sort" value="{$Sort}" />
								<input type="hidden" name="Canceled" value="{$Canceled}" />
								<input type="text" name="Customer" size="40" title="{$Find_Customer}" value="" />
								<input class="button" type="submit" title="{$Choose_Customer}" value="{$Search}" />
							</form>
							</td>
						</tr>
						{if $MYID}
							{if $PRINT_NAME neq 2}
								<tr>
									<td align="left" valign="middle" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$PREFIX} {$TITLE}
									</td>
								</tr>
								<tr>
									<td align="left" valign="middle" nowrap="nowrap" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$FIRSTNAME} {$LASTNAME}
									</td>
									<td align="right" valign="middle" colspan="2">{$Invoice_No}:
									</td>
									<td align="left" valign="middle" colspan="2">{$InvoiceInitials}-{$PrintDate}
									</td>
								</tr>
							{else}
								<tr>
									<td align="left" valign="middle" nowrap="nowrap" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
									<td align="right" valign="middle" colspan="2">{$Invoice_No}:
									</td>
									<td align="left" valign="middle" colspan="2">{$InvoiceInitials}-{$PrintDate}
									</td>
								</tr>
							{/if}
							<tr>
								<td align="left" valign="middle" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$COMPANY}
								</td>
								<td align="right" valign="middle" colspan="2">{$Customer_No}:
								</td>
								<td align="left" valign="middle" colspan="2"><a title="{$AllInformation} {$Customer_No} {$CustomerNoInitials}-{$MYID}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$CustomerNoInitials}-{$MYID}</a>
								</td>
							</tr>
							<tr>
								<td align="left" valign="middle" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$ADDRESS}
								</td>
								<td align="right" valign="top" colspan="2">{$CustMethodOfPayment}:
								</td>
								<td align="left" valign="middle" colspan="2">
								<form name="MethodOfPay" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
									<input type="hidden" name="myID" value="{$MYID}" />
									<input type="hidden" name="invoiceID" value="{$invoiceID}" />
									<input type="hidden" name="infoID" value="{$infoID}" />
									<input type="hidden" name="tmpID" value="{$invoiceID}" />
									<input type="hidden" name="messageID" value="{$MESSAGEID}" />
									<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
									<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
									<input type="hidden" name="Note" value="{$NOTE}" />
									{if $infoID eq 9}
										<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
										<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
										<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
										<input type="hidden" name="DateTill1" value="{$DateTill1}" />
										<input type="hidden" name="Total1" value="{$Total1}" />
										<input type="hidden" name="Customer1" value="{$Customer1}" />
									{/if}
									<input type="hidden" name="mark" value="MethodOfPayD.MethodOfPaymentDate" />
									<input type="hidden" name="page" value="{$page}" />
									<input type="hidden" name="Order" value="{$Order}" />
									<input type="hidden" name="Sort" value="{$Sort}" />
									<input type="hidden" name="Canceled" value="{$Canceled}" />
									<select title="{$CustMethodOfPayment}" class="choice200" name="MethodOfPayment" onchange="this.form.submit();">
										<optgroup title="{$CustMethodOfPayment}" label="{$CustMethodOfPayment}">
										{foreach from=$PaymentData item=payment}
											{if $NR_METHOD_OF_PAYMENT == $payment.METHODOFPAYID}
												<option title="{$payment.DESCRIPTION}" label="{$payment.DESCRIPTION}" value="{$payment.METHODOFPAYID}" selected="selected">{$payment.DESCRIPTION}</option>
											{else}
												<option title="{$payment.DESCRIPTION}" label="{$payment.DESCRIPTION}" value="{$payment.METHODOFPAYID}">{$payment.DESCRIPTION}</option>
											{/if}
										{/foreach}
										</optgroup>
									</select>
								</form>
								</td>
							</tr>
							<tr>
								<td align="left" valign="middle" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$POSTALCODE}&nbsp;&nbsp;{$CITY}
								</td>
								<td align="right" valign="top" colspan="2">{$Payment } {$Date_Till}:
								</td>
								<td align="left" valign="middle" colspan="2">
								<form id="MethodOfPayD" name="MethodOfPayD" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
									<input type="hidden" name="myID" value="{$MYID}" />
									<input type="hidden" name="invoiceID" value="{$invoiceID}" />
									<input type="hidden" name="infoID" value="{$infoID}" />
									<input type="hidden" name="tmpID" value="{$invoiceID}" />
									<input type="hidden" name="messageID" value="{$MESSAGEID}" />
									<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
									<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
									<input type="hidden" name="Note" value="{$NOTE}" />
									{if $infoID eq 9}
										<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
										<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
										<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
										<input type="hidden" name="DateTill1" value="{$DateTill1}" />
										<input type="hidden" name="Total1" value="{$Total1}" />
										<input type="hidden" name="Customer1" value="{$Customer1}" />
									{/if}
									<input type="hidden" name="mark" value="InvoiceD.InvoiceDate" />
									<input type="hidden" name="page" value="{$page}" />
									<input type="hidden" name="Order" value="{$Order}" />
									<input type="hidden" name="Sort" value="{$Sort}" />
									<input type="hidden" name="Canceled" value="{$Canceled}" />
									<input type="text" name="MethodOfPaymentDate" size="20" title="{$Payment } {$Date_Till} {$DateMsg}" value="{if $METHOD_OF_PAYMENT_DATE neq 0}{$METHOD_OF_PAYMENT_DATE}{/if}" onchange="this.form.submit();" />
								</form>
								</td>
							</tr>
							<tr>
								<td align="left" valign="middle" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								{if $COUNTRY neq $Country}
									{$COUNTRY}
								{/if}
								</td>
								<td align="right" valign="top" colspan="2">{$DateMsg}:
								</td>
								<td align="left" valign="middle" colspan="2">
								<form id="InvoiceD" name="InvoiceD" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
									<input type="hidden" name="myID" value="{$MYID}" />
									<input type="hidden" name="invoiceID" value="{$invoiceID}" />
									<input type="hidden" name="infoID" value="{$infoID}" />
									<input type="hidden" name="tmpID" value="{$invoiceID}" />
									<input type="hidden" name="messageID" value="{$MESSAGEID}" />
									<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
									<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
									{if $infoID eq 9}
										<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
										<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
										<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
										<input type="hidden" name="DateTill1" value="{$DateTill1}" />
										<input type="hidden" name="Total1" value="{$Total1}" />
										<input type="hidden" name="Customer1" value="{$Customer1}" />
									{/if}
									<input type="hidden" name="Note" value="{$NOTE}" />
									<input type="hidden" name="mark" value="InvoiceD.InvoiceDate" />
									<input type="hidden" name="page" value="{$page}" />
									<input type="hidden" name="Order" value="{$Order}" />
									<input type="hidden" name="Sort" value="{$Sort}" />
									<input type="hidden" name="Canceled" value="{$Canceled}" />
									<input type="text" name="InvoiceDate" size="20" title="{$Invoice} - {$DateMsg}" value="{$INVOICE_DATE}" onchange="this.form.submit();" />
								</form>
								</td>
							</tr>
						{/if}
						<tr>
							<td>
							</td>
						</tr>
					</table>
					<table width="100%" border="0" cellspacing="1" cellpadding="3" summary="Tabelle 3">
						<tr class="mblueTD">
							<td nowrap="nowrap" align="left" valign="middle">{$PositionName}&nbsp;-&nbsp;[&nbsp;<a title="{$PositionNew}" class="nlink" href="posnew.php?myID={$myID}&amp;invoiceID={$invoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;messageID={$MESSAGEID}&amp;InvoiceDate={$INVOICE_DATE}&amp;MethodOfPayment={$NR_METHOD_OF_PAYMENT}&amp;MethodOfPaymentDate={$METHOD_OF_PAYMENT_DATE}&amp;Note={$NOTE}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">&nbsp;{$New}&nbsp;</a>&nbsp;]
							</td>
							<td nowrap="nowrap" align="left" valign="middle">{$PositionText}
							</td>
							<td nowrap="nowrap" align="right" valign="middle">{$PositionQuantity}
							</td>
							<td  nowrap="nowrap" align="right" valign="middle">{$PositionPrice} {$Invoice_Currency}
							</td>
							{if $TaxFree != 1}
								<td nowrap="nowrap" align="right" valign="middle">{$Tax}
								</td>
							{/if}
							<td nowrap="nowrap" align="right" valign="middle">{$PositionAmount} {$Invoice_Currency}
							</td>
							<td nowrap="nowrap" align="center" colspan="2">{$Entrys}:&nbsp;{$MaxRows}&nbsp;
							</td>
						</tr>
						{foreach from=$PosData item=invoice}
							<tr class="{cycle values="grayTD,wTD"}">
								<td valign="top" align="left"><a title="{$AllInformation} {$invoice.POS_NAME}" class="ninfolink" href="../position/info.php?posID={$invoice.POSITIONID}&amp;infoID=30&amp;{$Session}" target="_blank">{$invoice.POS_NAME}</a>
								</td>
								<td valign="top" align="left">{$invoice.POS_DESC|nl2br}
								</td>
								<td nowrap="nowrap" valign="top" align="right">
								{if $invoice.POS_QUANTITY != 0}
									{$invoice.POS_QUANTITY}
								{/if}
								</td>
								<td nowrap="nowrap" valign="top" align="right">
								{if $invoice.POS_QUANTITY != 0}
									{$invoice.POS_PRICE|number_format}
								{/if}
								</td>
								{if $TaxFree != 1}
									<td nowrap="nowrap" valign="top" align="right">
									{if $invoice.POS_QUANTITY != 0}
										{$invoice.TAX_DESC}
									{/if}
									</td>
								{/if}
								<td nowrap="nowrap" valign="top" align="right">
								{if $invoice.POS_QUANTITY != 0}
									{$invoice.POS_PRICE*$invoice.POS_QUANTITY|number_format}
								{/if}
								</td>
								<td valign="top" align="center"><a href="posedit.php?tmpPosID={$invoice.TMP_INVOICEID}&amp;myID={$MYID}&amp;invoiceID={$invoiceID}&amp;posID={$invoice.POSITIONID}&amp;page={$page}&amp;infoID={$infoID}&amp;messageID={$MESSAGEID}&amp;InvoiceDate={$INVOICE_DATE}&amp;MethodOfPayment={$NR_METHOD_OF_PAYMENT}&amp;MethodOfPaymentDate={$METHOD_OF_PAYMENT_DATE}&amp;Note={$NOTE}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/edit.png" title="{$Position} - {$Edit}" alt="{$Position} - {$Edit}" /></a>
								</td>
								<td valign="top" align="center"><a href="posdelete.php?tmpPosID={$invoice.TMP_INVOICEID}&amp;myID={$MYID}&amp;invoiceID={$invoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;messageID={$MESSAGEID}&amp;InvoiceDate={$INVOICE_DATE}&amp;MethodOfPayment={$NR_METHOD_OF_PAYMENT}&amp;MethodOfPaymentDate={$METHOD_OF_PAYMENT_DATE}&amp;Note={$NOTE}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/delete.png" title="{$Position} - {$Delete}" alt="{$Position} - {$Delete}" /></a>
								</td>
							</tr>
						{/foreach}
						<tr>
							<td>&nbsp;
							</td>
						</tr>
						{if $TaxFree neq 1}
							{if $SUBTOTAL1}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX1_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$SUBTOTAL1|number_format}
									</td>
								</tr>
							{/if}
							{if $SUBTOTAL2}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX2_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$SUBTOTAL2|number_format}
									</td>
								</tr>
							{/if}
							{if $SUBTOTAL3}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX3_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$SUBTOTAL3|number_format}
									</td>
								</tr>
							{/if}
							{if $SUBTOTAL4}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Subtotal} {$TAX4_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$SUBTOTAL4|number_format}
									</td>
								</tr>
							{/if}
							{if $TAX1}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Tax1} {$TAX1_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$TAX1|number_format}
									</td>
								</tr>
							{/if}
							{if $TAX2}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Tax2} {$TAX2_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$TAX2|number_format}
									</td>
								</tr>
							{/if}
							{if $TAX3}
								<tr>
									<td valign="top" align="right" colspan="6">{$Invoice_Tax3} {$TAX3_DESC}:
									</td>
									<td valign="top" align="right" colspan="2">{$TAX3|number_format}
									</td>
								</tr>
							{/if}
							<tr>
								<td valign="top" align="right" colspan="6"><b>{$Invoice_Amount}  {$Invoice_Currency}</b>:
								</td>
								<td valign="top" align="right" colspan="2"><b>
								{if $TOTAL lt 0}
									<span class="redtxt">
										<b>{$TOTAL|number_format}</b>
									</span>
								{else}
									<b>{$TOTAL|number_format}</b>
								{/if}
								</td>
							</tr>
						{else}
							<tr>
								<td valign="top" align="right" colspan="5"><b>{$Invoice_Amount}  {$Invoice_Currency}</b>:
								</td>
								<td valign="top" align="right" colspan="2"><b>
								{if $TOTAL lt 0}
									<span class="redtxt">
										<b>{$TOTAL|number_format}</b>
									</span>
								{else}
									<b>{$TOTAL|number_format}</b>
								{/if}
								</td>
							</tr>
						{/if}
						<tr>
							<td>&nbsp;
							</td>
						</tr>
						<tr>
							{if $TaxFree neq 1}
								<td colspan="8" align="center" valign="middle">
							{else}
								<td colspan="7" align="center" valign="middle">
							{/if}
							<form id="Note" name="Note" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
								<input type="hidden" name="myID" value="{$MYID}" />
								<input type="hidden" name="invoiceID" value="{$invoiceID}" />
								<input type="hidden" name="infoID" value="{$infoID}" />
								<input type="hidden" name="tmpID" value="{$invoiceID}" />
								<input type="hidden" name="messageID" value="{$MESSAGEID}" />
								<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
								<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
								<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
								{if $infoID eq 9}
									<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
									<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
									<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
									<input type="hidden" name="DateTill1" value="{$DateTill1}" />
									<input type="hidden" name="Total1" value="{$Total1}" />
									<input type="hidden" name="Customer1" value="{$Customer1}" />
								{/if}
								<input type="hidden" name="mark" value="Message.messageID" />
								<input type="hidden" name="page" value="{$page}" />
								<input type="hidden" name="Order" value="{$Order}" />
								<input type="hidden" name="Sort" value="{$Sort}" />
								<input type="hidden" name="Canceled" value="{$Canceled}" />
								<textarea title="{$Invoice_Note}" class="form_new_textarea" name="Note" rows="3" cols="40" onchange="this.form.submit();">{$NOTE}</textarea>
							</form>
							</td>
						</tr>
						<tr>
							<td>&nbsp;
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" colspan="2">
							<form id="Message" name="Message" action="{$smarty.server.PHP_SELF}?{$Session}#NewMessage" method="post">
							<input type="hidden" name="myID" value="{$MYID}" />
							<input type="hidden" name="invoiceID" value="{$invoiceID}" />
							<input type="hidden" name="infoID" value="{$infoID}" />
							<input type="hidden" name="tmpID" value="{$invoiceID}" />
							<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
							<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
							<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
							{if $infoID eq 9}
								<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
								<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
								<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
								<input type="hidden" name="DateTill1" value="{$DateTill1}" />
								<input type="hidden" name="Total1" value="{$Total1}" />
								<input type="hidden" name="Customer1" value="{$Customer1}" />
							{/if}
							<input type="hidden" name="Note" value="{$NOTE}" />
							<input type="hidden" name="mark" value="Edit1.ChangeInvoice" />
							<input type="hidden" name="page" value="{$page}" />
							<input type="hidden" name="Order" value="{$Order}" />
							<input type="hidden" name="Sort" value="{$Sort}" />
							<input type="hidden" name="Canceled" value="{$Canceled}" />
							<select title="{$Choose_Message}" class="choice250" name="messageID" onchange="this.form.submit();">
							<optgroup title="{$Choose_Message}" label="{$Choose_Message}">
							<option title="{$Choose_Message}" value="">--- {$Choose_Message} ---</option>
							{foreach from=$MessageData item=message}
								{if $MESSAGEID == $message.MESSAGEID}
									<option title="{$message.DESCRIPTION}" label="{$message.DESCRIPTION}" value="{$message.MESSAGEID}" selected="selected">{$message.DESCRIPTION}</option>
								{else}
									<option title="{$message.DESCRIPTION}" label="{$message.DESCRIPTION}" value="{$message.MESSAGEID}">{$message.DESCRIPTION}</option>
								{/if}
							{/foreach}
							</optgroup></select><a name="NewMessage" id="NewMessage"></a>
							</form>
							</td>
							<td align="center" valign="top" colspan="2">
							<form id="Print" name="Print" action="print_pdf.php?{$Session}" target="_blank" method="post">
								<input type="hidden" name="messageID" value="{$MESSAGEID}" />
								<input type="hidden" name="Type" value="Invoice" />
								<input type="hidden" name="tmpPos" value="1" />
								<input type="hidden" name="invoiceID" value="{$invoiceID}" />
								<input type="hidden" name="myID" value="{$MYID}" />
								<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
								<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
								<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
								<input type="hidden" name="Pos_Order" value="{$Pos_Order}" />
								<input type="hidden" name="Pos_Sort" value="{$Pos_Sort}" />
								<input class="button" type="submit" title="{$Print_Invoice}" value="{$Print}" />
							</form>
							</td>
							{if $TaxFree neq 1}
								<td align="center" colspan="2" valign="top">
							{else}
								<td align="center" valign="top">
							{/if}
							{if $infoID eq 9}
								<form id="Searchlist" name="Searchlist" action="searchlist.php?{$Session}#{$invoiceID}" method="post">
									<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
									<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
									<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
									<input type="hidden" name="DateTill1" value="{$DateTill1}" />
									<input type="hidden" name="Total1" value="{$Total1}" />
									<input type="hidden" name="Customer1" value="{$Customer1}" />
									<input type="hidden" name="Order" value="{$Order}" />
									<input type="hidden" name="Sort" value="{$Sort}" />
									<input type="hidden" name="Canceled" value="{$Canceled}" />
									<input class="button" type="submit" title="{$BackMsg} - {$Searchresult}" value="{$BackMsg} - {$Searchresult}" />
								</form>
								</td>
							{else}
								<form id="List" name="List" action="list.php?{$Session}#{$invoiceID}" method="post">
									<input type="hidden" name="Order" value="{$Order}" />
									<input type="hidden" name="Sort" value="{$Sort}" />
									<input type="hidden" name="Canceled" value="{$Canceled}" />
									<input class="button" type="submit" title="{$BackMsg} - {$List}" value="{$BackMsg} - {$List}" />
								</form>
								</td>
							{/if}
							<td align="center" valign="top" colspan="2">
							<form id="Edit1" name="Edit1" action="editf.php?{$Session}" method="post">
								<input type="hidden" name="myID" value="{$MYID}" />
								<input type="hidden" name="invoiceID" value="{$invoiceID}" />
								<input type="hidden" name="InvoiceDate" value="{$INVOICE_DATE}" />
								<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
								<input type="hidden" name="MethodOfPaymentDate" value="{$METHOD_OF_PAYMENT_DATE}" />
								<input type="hidden" name="infoID" value="{$infoID}" />
								<input type="hidden" name="CreatedBy" value="{$CreatedBy}" />
								<input type="hidden" name="InvoiceSubtotal1" value="{$SUBTOTAL1}" />
								<input type="hidden" name="InvoiceSubtotal2" value="{$SUBTOTAL2}" />
								<input type="hidden" name="InvoiceSubtotal3" value="{$SUBTOTAL3}" />
								<input type="hidden" name="InvoiceSubtotal4" value="{$SUBTOTAL4}" />
								<input type="hidden" name="Tax1Total" value="{$TAX1}" />
								<input type="hidden" name="Tax1Desc" value="{$TAX1_DESC}" />
								<input type="hidden" name="Tax2Total" value="{$TAX2}" />
								<input type="hidden" name="Tax2Desc" value="{$TAX2_DESC}" />
								<input type="hidden" name="Tax3Total" value="{$TAX3}" />
								<input type="hidden" name="Tax3Desc" value="{$TAX3_DESC}" />
								<input type="hidden" name="Tax4Total" value="{$TAX4}" />
								<input type="hidden" name="Tax4Desc" value="{$TAX4_DESC}" />
								<input type="hidden" name="InvoiceAmount" value="{$TOTAL}" />
								<input type="hidden" name="Note" value="{$NOTE}" />
								<input type="hidden" name="messageID" value="{$MESSAGEID}" />
								{if $infoID eq 9}
									<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
									<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
									<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
									<input type="hidden" name="DateTill1" value="{$DateTill1}" />
									<input type="hidden" name="Total1" value="{$Total1}" />
									<input type="hidden" name="Customer1" value="{$Customer1}" />
								{/if}
								<input type="hidden" name="page" value="{$page}" />
								<input type="hidden" name="Order" value="{$Order}" />
								<input type="hidden" name="Sort" value="{$Sort}" />
								<input type="hidden" name="Canceled" value="{$Canceled}" />
								<input type="hidden" name="MaxRows" value="{$MaxRows}" />
								{if $CANCELED eq 1}
									<input disabled="disabled" class="button" name="ChangeInvoice" type="submit" title="{$Change_Invoice}" value="{$Change}" />
								{elseif $PAID eq 1}
									<input disabled="disabled" class="button" name="ChangeInvoice" type="submit" title="{$Change_Invoice}" value="{$Change}" />
								{else}
									<input class="button" name="ChangeInvoice" type="submit" title="{$Change_Invoice}" value="{$Change}" />
								{/if}
							</form>
							</td>
						</tr>
						<tr>
							<td>&nbsp;
							</td>
						</tr>
						<tr>
							{if $TaxFree neq 1}
								<td align="center" colspan="8">
							{else}
								<td align="center" colspan="7">
							{/if}
							{if $MaxRows > 3}
								{* Display pager *}
								{if $CurrentInvoiceID > $MinInvoiceID }
									<a href="{$smarty.server.PHP_SELF}?invoiceID={$MinInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
									<a href="{$smarty.server.PHP_SELF}?invoiceID={$PrevInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
								{/if}
								{$Invoice_No}:&nbsp;<a title="{$Invoice_No}: {$CurrentInvoiceID} / {$MaxInvoiceID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?invoiceID={$CurrentInvoiceID}&amp;tmpID={$invoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;myID={$myID}&amp;messageID={$MESSAGEID}&amp;InvoiceDate={$INVOICE_DATE}&amp;MethodOfPayment={$NR_METHOD_OF_PAYMENT}&amp;MethodOfPaymentDate={$METHOD_OF_PAYMENT_DATE}&amp;Note={$NOTE}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentInvoiceID}</a>&nbsp;/&nbsp;{$MaxInvoiceID}&nbsp;
								{if $CurrentInvoiceID < $MaxInvoiceID }
									<a href="{$smarty.server.PHP_SELF}?invoiceID={$NextInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
									<a href="{$smarty.server.PHP_SELF}?invoiceID={$MaxInvoiceID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
								{/if}
							{/if}
							</td>
						</tr>
						{/if}
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td id="td2_20" width="20%"><br />
	</td>
	<td id="td2_2" width="2%">
	</td>
	<td width="78%" valign="top"><br />
	</td>
</tr>
</table>
{include file="footer.tpl"}
