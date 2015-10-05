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
<form id="Cancel" name="Cancel" action="cancelf.php?{$Session}" method="post">
<table width="80%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr><td align="center" colspan="7"><h2>{$Cashbook} - {$Cancel}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2">{$AllInformation} {$EntryNo} {$cashbookID}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="left" width="40%">{$DateMsg}</td><td class="dbTxt" valign="top" align="left" width="60%">{$CASHBOOK_DATE}</td></tr>
{if $TAKINGS neq 0}
	<tr><td valign="top" align="left" width="40%">{$Takings} {$Cashbook_Currency}</td><td class="dbTxt" valign="top" align="left" width="60%">{$TAKINGS|number_format}</td></tr>
{/if}
{if $EXPENDITURES neq 0}
	<tr><td valign="top" align="left" width="40%">{$Expenditures} {$Cashbook_Currency}</td><td class="dbTxt" valign="top" align="left" width="60%">{$EXPENDITURES|number_format}</td></tr>
{/if}
<tr><td valign="top" align="left" width="40%">{$Description}</td><td class="dbTxt" valign="top" align="left" width="60%">{$DESCRIPTION|nl2br}</td></tr>
<tr><td valign="top" align="left" width="40%">{$CashInHand} {$Cashbook_Currency}</td><td class="dbTxt" valign="top" align="left" width="60%">{$CASH_IN_HAND|number_format}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display back button *}
<tr><td valign="top" align="right" width="40%">
<input type="hidden" name="cashbookID" value="{$cashbookID}" />
<input type="hidden" name="CashbookDate" value="{$CASHBOOK_DATE}" />
<input type="hidden" name="invoiceID" value="{$INVOICEID}" />
<input type="hidden" name="paymentID" value="{$PAYMENTID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Takings" value="{$TAKINGS}" />
<input type="hidden" name="Expenditures" value="{$EXPENDITURES}" />
<input type="hidden" name="CCash_In_Hand_Starting_With" value="{$CASH_IN_HAND_STARTING_WITH}" />
<input type="hidden" name="CashbookNo_1" value="{$CashbookNo_1}" />
<input type="hidden" name="DateFrom_1" value="{$DateFrom_1}" />
<input type="hidden" name="DateTill_1" value="{$DateTill_1}" />
<input type="hidden" name="Takings_1" value="{$Takings_1}" />
<input type="hidden" name="Expenditures_1" value="{$Expenditures_}" />
<input type="hidden" name="Description_1" value="{$Description_1}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="Canceled" value="{$Canceled}" />
<input type="submit" class="button" title="{$Cancel}" value="{$Cancel}" /></td></form>
<td valign="top" align="center" width="60%">
{if $infoID eq 9}
	<form action="searchlist.php?{$Session}#{$cashbookID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="CashbookNo_1" value="{$CashbookNo_1}" />
	<input type="hidden" name="DateFrom_1" value="{$DateFrom_1}" />
	<input type="hidden" name="DateTill_1" value="{$DateTill_1}" />
	<input type="hidden" name="Takings_1" value="{$Takings_1}" />
	<input type="hidden" name="Expenditures_1" value="{$Expenditures_1}" />
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
