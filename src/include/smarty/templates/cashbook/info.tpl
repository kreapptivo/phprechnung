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
<tr><td align="left" class="phprechnung_menu"><a accesskey="P" title="{$Position}"
href="../position/list.php?{$Session}">{$Position}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="O" title="{$Offer}"
href="../offer/list.php?{$Session}">{$Offer}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="I" title="{$Invoice}"
href="../invoice/list.php?{$Session}">{$Invoice}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="M" title="{$Payment}"
href="../payment/list.php?{$Session}">{$Payment}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="C" title="{$Cashbook} - {$List}"
href="list.php?{$Session}">{$Cashbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Cashbook} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Cashbook} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Cashbook} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
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
<tr><td align="center" colspan="2"><h2>{$Cashbook} - {$Info}</h2></td></tr>
{* Display pager *}
<tr>
	<td align="center" colspan="2">
{if $CurrentCashbookID > $MinCashbookID }
	<a href="{$smarty.server.PHP_SELF}?cashbookID={$MinCashbookID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?cashbookID={$PrevCashbookID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$CashbookNo}:&nbsp;<a title="{$CashbookNo}: {$CurrentCashbookID} / {$MaxCashbookID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?cashbookID={$CurrentCashbookID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}">{$CurrentCashbookID}</a>&nbsp;/&nbsp;{$MaxCashbookID}&nbsp;
{if $CurrentCashbookID < $MaxCashbookID }
	<a href="{$smarty.server.PHP_SELF}?cashbookID={$NextCashbookID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?cashbookID={$MaxCashbookID}&amp;page={$pages}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
	</td>
</tr>
<tr><td></td></tr>
{if $PAYMENTID eq 0 and $CANCELED neq 1}
	<tr>
		<td align="center" colspan="2">
		[&nbsp;<a title="{$Cancelentry}" class="nmenulink" href="cancel.php?cashbookID={$cashbookID}&amp;infoID={$infoID}&amp;page={$page}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$Cancel}</a>&nbsp;]
		</td>
	</tr>
{/if}
<tr><td></td></tr>
<tr><td align="center" colspan="2">{$AllInformation} {$EntryNo} {$cashbookID}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="40%">{$DateMsg}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CASHBOOK_DATE}</td></tr>
{if $MYID neq 0}
	<tr>
		<td valign="top" align="right" width="40%">{$CustomerNo}right
		</td>
		<td class="dbTxt" valign="top" align="left" width="60%">[&nbsp;<a title="{$AllInformation} {$CustomerNo} {$MYID}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$MYID}</a>&nbsp;]
		</td>
	</tr>
{/if}
{if $INVOICEID neq 0}
	<tr>
		<td valign="top" align="right" width="40%">{$InvoiceNo}:
		</td>
		<td class="dbTxt" valign="top" align="left" width="60%">[&nbsp;<a title="{$AllInformation} {$InvoiceNo} {$INVOICEID}" class="nmenulink" href="../invoice/info.php?invoiceID={$INVOICEID}&amp;infoID=30&amp;{$Session}" target="_blank">{$INVOICEID}</a>&nbsp;]
		</td>
	</tr>
{/if}
{if $PAYMENTID neq 0}
	<tr>
		<td valign="top" align="right" width="40%">{$PaymentNo}:
		</td>
		<td class="dbTxt" valign="top" align="left" width="60%">[&nbsp;<a title="{$AllInformation} {$PaymentNo} {$PAYMENTID}" class="nmenulink" href="../payment/info.php?paymentID={$PAYMENTID}&amp;infoID=30&amp;{$Session}" target="_blank">{$PAYMENTID}</a>&nbsp;]
		</td>
	</tr>
{/if}
{if $TAKINGS neq 0}
	{if $CANCELED neq 1}
		<tr><td valign="top" align="right" width="40%">{$Takings} {$Cashbook_Currency}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$TAKINGS|number_format}</td></tr>
	{else}
		<tr><td valign="top" align="right" width="40%">{$Takings} {$Cashbook_Currency}:</td><td class="graytxt" valign="top" align="left" width="60%"><del>{$TAKINGS|number_format}</del></td></tr>
	{/if}
{/if}
{if $EXPENDITURES neq 0}
	{if $CANCELED neq 1}
		<tr><td valign="top" align="right" width="40%">{$Expenditures} {$Cashbook_Currency}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$EXPENDITURES|number_format}</td></tr>
	{else}
		<tr><td valign="top" align="right" width="40%">{$Expenditures} {$Cashbook_Currency}:</td><td class="graytxt" valign="top" align="left" width="60%"><del>{$EXPENDITURES|number_format}</del></td></tr>
	{/if}
{/if}
<tr><td valign="top" align="right" width="40%">{$Description}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$DESCRIPTION|nl2br}</td></tr>
{if $CANCELED neq 1}
	<tr><td valign="top" align="right" width="40%">{$CashInHand} {$Cashbook_Currency}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CASH_IN_HAND|number_format}</td></tr>
{else}
	<tr><td valign="top" align="right" width="40%">{$CashInHand} {$Cashbook_Currency}:</td><td class="graytxt" valign="top" align="left" width="60%"><del>{$CASH_IN_HAND|number_format}</del></td></tr>
{/if}
{if $CASH_IN_HAND_STARTING_WITH neq 0}
	{if $CANCELED neq 1}
		<tr><td valign="top" align="right" width="40%">{$Starting_With} {$Cashbook_Currency}:</td><td class="dbTxt" valign="top" align="left" width="60%">{$CASH_IN_HAND_STARTING_WITH|number_format}</td></tr>
	{else}
		<tr><td valign="top" align="right" width="40%">{$Starting_With} {$Cashbook_Currency}:</td><td class="graytxt" valign="top" align="left" width="60%"><del>{$CASH_IN_HAND_STARTING_WITH|number_format}</del></td></tr>
	{/if}
{/if}
<tr><td>&nbsp;</td></tr>
{* Display back button *}
<tr><td valign="middle" align="center" width="100%" colspan="2">
{if $infoID eq 9}
	<form action="searchlist.php?{$Session}#{$cashbookID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="CashbookNo_1" value="{$CashbookNo_1}" />
	<input type="hidden" name="DateFrom_1" value="{$DateFrom_1}" />
	<input type="hidden" name="DateTill_1" value="{$DateTill_1}" />
	<input type="hidden" name="Takings_1" value="{$Takings_1}" />
	<input type="hidden" name="Expenditures_1" value="{$Expenditures_}" />
	<input type="hidden" name="Description_1" value="{$Description_1}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Canceled" value="{$Canceled}" />
	<input type="submit" class="button" title="{$BackMsg} - {$Searchresult}" value="{$BackMsg} - {$Searchresult}" /></form></td></tr>
{elseif $infoID eq 30}
	<form action="javascript:window.close()" method="post">
	<input type="submit" class="button" title="{$CloseWindow}" value="{$CloseWindow}" /></form></td></tr>
{else}
	<form action="list.php?{$Session}#{$cashbookID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Canceled" value="{$Canceled}" />
	<input type="submit" class="button" title="{$BackMsg} - {$List}" value="{$BackMsg} - {$List}" /></form></td></tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
