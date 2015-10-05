{*
	new.tpl

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

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
	<body onload="document.CustomerForm.invoiceID.focus();">
{/if}
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="I" title="{$Invoice}"
href="../invoice/list.php?{$Session}">{$Invoice}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="M" title="{$Payment} - {$List}"
href="../payment/list.php?{$Session}">{$Payment}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Payment} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Payment} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Payment} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
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
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display input fields to add new positions *}
<table width="60%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
<tr>
	{if $infoID eq 30}
		<td valign="middle" align="left" colspan="2">
		[&nbsp;<a title="{$CloseWindow}" class="ninfolink" href="javascript:window.close()">{$CloseWindow}</a>&nbsp;]
		</td>
	{else}
		<td valign="middle" align="left" colspan="2">
		[&nbsp;<a title="{$BackMsg} - {$Payment} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
		</td>
	{/if}
</tr>
<tr><td align="center" colspan="2"><h2>{$Payment} - {$New}</h2></td></tr>
{if $smarty.session.NewID and ( $smarty.session.NewID eq 1 )}
	<tr><td align="center" colspan="2" class="greentxt">{$NewEntry} {$EntryNo} {$PaymentID}</td></tr>
{/if}
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$EntryNo} {$PaymentID+1} ]</td></tr>
<tr><td></td></tr>
<tr>
<td valign="top" align="right" width="30%">{$Customer}:</td>
<td valign="middle" align="left" width="70%">
<form id="CustomerForm" name="CustomerForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="mark" value="MethodOfPay.MethodOfPayment" />
<input type="hidden" name="myID" value="{$MYID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<select title="{$Outstanding_Payment}" name="invoiceID" class="choice250" onchange="this.form.submit();">
<optgroup title="{$Outstanding_Payment}" label="{$Customer}">
<option title="{$Choose_Customer}" value="">--- {$Choose_Customer} ---</option>
{foreach from=$OpenInvoiceData item=invoice}
	{if $invoiceID and ( $invoiceID == $invoice.INVOICEID)}
		<option title="{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}" label="{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}" value="{$invoice.INVOICEID}" selected="selected">{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}</option>
	{else}
		<option title="{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}" label="{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}" value="{$invoice.INVOICEID}">{$Invoice_No}: {$invoice.INVOICEID} - {if $invoice.FIRSTNAME}{$invoice.FIRSTNAME} {/if}{if $invoice.LASTNAME}{$invoice.LASTNAME}, {/if}{$invoice.COMPANY}</option>
	{/if}
{/foreach}
</optgroup>
</select>
</form>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
{if $invoiceID}
<tr><td valign="middle" align="right" width="40%">{$Customer_No}:</td><td valign="middle" align="left" width="60%"><a title="{$AllInformation} {$Customer_No} {$MYID}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$MYID}</a></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Invoice_No}:</td><td valign="middle" align="left" width="60%"><a title="{$AllInformation} {$Invoice_No} {$invoiceID}" class="nmenulink" href="../invoice/info.php?invoiceID={$invoiceID}&amp;infoID=30&amp;{$Session}" target="_blank">{$invoiceID}</a></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Invoice_Amount} {$Currency}:</td><td valign="middle" align="left" width="60%">{$TOTAL_AMOUNT|number_format}</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Open_Invoice} {$Currency}:</td><td valign="middle" align="left" width="60%" class="redtxt">{$OPEN_INVOICE_SUM|number_format}</td></tr>
<tr><td valign="top" align="right" width="40%">{$CustMethodOfPayment}:</td>
<td valign="middle" align="left" width="60%">
<form name="MethodOfPay" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="mark" value="PaymentDateForm.PaymentDate" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<select title="{$CustMethodOfPayment}" class="choice200" name="MethodOfPayment" onchange="this.form.submit();">
<optgroup title="{$CustMethodOfPayment}" label="{$CustMethodOfPayment}">
<option title="{$CustMethodOfPayment}" value="">--- {$CustMethodOfPayment} ---</option>
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
</td></tr>
<tr><td></td></tr>
{if $NR_METHOD_OF_PAYMENT neq 2}
<tr><td valign="top" align="right" width="40%">{$Card_Number}:</td><td valign="top" align="left" width="60%">
<form id="CardNumberForm" name="CardNumberForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="mark" value="ValidThruForm.Valid_Thru" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input class="form_input" title="{$Card_Number}" name="Card_Number" size="39" value="{$CARD_NUMBER}" onchange="this.form.submit();" />
</form>
</td></tr>
<tr><td valign="top" align="right" width="40%">{$Valid_Thru}:</td><td valign="top" align="left" width="60%">
<form id="ValidThruForm" name="ValidThruForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="mark" value="PaymentDateForm.PaymentDate" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input class="form_input" title="{$Valid_Thru}" name="Valid_Thru" size="39" value="{$VALID_THRU}" onchange="this.form.submit();" />
</form>
</td></tr>
{/if}
<tr><td valign="top" align="right" width="40%">{$DateMsg}:</td><td valign="top" align="left" width="60%">
<form id="PaymentDateForm" name="PaymentDateForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="mark" value="SumPaidForm.Sum_Paid" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input class="form_input" title="{$Payment} - {$DateMsg}" name="PaymentDate" size="39" value="{$PAYMENT_DATE}" onchange="this.form.submit();" />
</form>
</td></tr>
<tr><td valign="top" align="right" width="40%">{$Payment} {$Currency}:</td><td valign="top" align="left" width="60%">
<form id="SumPaidForm" name="SumPaidForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="mark" value="NoteForm.Note" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input class="form_input" title="{$Payment} {$Currency}" name="Sum_Paid" size="39" value="{$SUM_PAID|number_format}" onchange="this.form.submit();" />
</form>
</td></tr>
<tr><td valign="top" align="right" width="40%">{$NoteMsg}:</td><td valign="top" align="left" width="60%">
<form id="NoteForm" name="NoteForm" action="{$smarty.server.PHP_SELF}?{$Session}" method="post">
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="mark" value="New1.SavePayment" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<textarea title="{$NoteMsg}" class="form_textarea" name="Note" rows="5" cols="37" onchange="this.form.submit();">{$NOTE}</textarea>
</form>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="center" colspan="2">
<form id="New1" name="New1" action="newf.php?{$Session}" method="post">
<input type="hidden" name="myID" value="{$MYID}" />
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="Card_Number" value="{$CARD_NUMBER}" />
<input type="hidden" name="Valid_Thru" value="{$VALID_THRU}" />
<input type="hidden" name="PaymentDate" value="{$PAYMENT_DATE}" />
<input type="hidden" name="Total_Amount" value="{$TOTAL_AMOUNT}" />
<input type="hidden" name="Total_Sum_Paid" value="{$TOTAL_SUM_PAID}" />
<input type="hidden" name="Sum_Paid" value="{$SUM_PAID}" />
<input type="hidden" name="Note" value="{$NOTE}" />
<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" name="SavePayment" class="button" title="{$InsertMsg}" value="{$InsertMsg}" />
</form>
</td></tr>
{/if}
</table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
