{*
	cancel.tpl

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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="M" title="{$Payment} - {$List}"
href="list.php?{$Session}">{$Payment}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Payment} - {$New}"
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
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="60%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr>
{if $infoID eq 9}
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Payment} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
{else}
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Payment} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
{/if}
</tr>
<tr><td align="center" colspan="7"><h2>{$Payment} - {$Cancel}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">{$AllInformation} {$EntryNo} {$paymentID}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%">{$DateMsg}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$PAYMENT_DATE}</td></tr>
<tr>
	<td valign="top" align="right" width="40%">{$Customer_No}:
	</td>
	<td class="dbTxt" valign="top" align="left" width="60%">[&nbsp;<a title="{$AllInformation} {$Customer_No} {$MYID} - {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$MYID} - {$FIRSTNAME} {$LASTNAME} {$COMPANY}</a>&nbsp;]
	</td>
</tr>
<tr>
	<td valign="top" align="right" width="40%">{$Invoice_No}:
	</td>
	<td class="dbTxt" valign="top" align="left" width="60%">[&nbsp;<a title="{$AllInformation} {$Invoice_No} {$INVOICEID}" class="nmenulink" href="../invoice/info.php?invoiceID={$INVOICEID}&amp;infoID=30&amp;{$Session}" target="_blank">{$INVOICEID}</a>&nbsp;]
	</td>
</tr>
{if $CARDNR}
	<tr>
		<td valign="top" align="right" width="40%">{$Card_Number}:
		</td>
		<td class="dbTxt" valign="top" align="left" width="60%">{$CARDNR}
		</td>
	</tr>
{/if}
{if $VALIDTHRU}
	<tr>
		<td valign="top" align="right" width="40%">{$Valid_Thru}:
		</td>
		<td class="dbTxt" valign="top" align="left" width="60%">{$VALIDTHRU}
		</td>
	</tr>
{/if}
<tr>
	<td valign="top" align="right" width="40%">{$Payment} {$Payment_Currency}:
	</td>
	<td class="dbTxt" valign="top" align="left" width="60%">{$SUM_PAID|number_format}
	</td>
</tr>
<tr>
	<td valign="top" align="right" width="40%">{$CustMethodOfPayment}:
	</td>
	<td class="dbTxt" valign="top" align="left" width="60%">{$METHODOFPAY}
	</td>
</tr>

<tr><td>&nbsp;</td></tr>
{* Display cancel button *}
<tr><td valign="middle" align="center" width="100%" colspan="2">
<form action="cancelf.php?{$Session}#{$paymentID}" method="post">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="paymentID" value="{$paymentID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
{if $infoID eq 9}
	<input type="hidden" name="CustomerNo_1" value="{$CustomerNo_1}" />
	<input type="hidden" name="InvoiceNo_1" value="{$InvoiceNo_1}" />
	<input type="hidden" name="PaymentNo_1" value="{$PaymentNo_1}" />
	<input type="hidden" name="SumPaid_1" value="{$SumPaid_1}" />
	<input type="hidden" name="MethodOfPay_1" value="{$MethodOfPay_1}" />
	<input type="hidden" name="DateFrom_1" value="{$DateFrom_1}" />
	<input type="hidden" name="DateTill_1" value="{$DateTill_1}" />
{/if}
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="Canceled" value="{$Canceled}" />
<input type="submit" class="button" title="{$Cancelentry}" value="{$Cancel}" /></form></td></tr>
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
