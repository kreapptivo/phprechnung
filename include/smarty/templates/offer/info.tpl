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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="O" title="{$Offer} - {$List}"
href="list.php?{$Session}">{$Offer}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Offer} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Offer} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Offer} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="I" title="{$Invoice}"
href="../invoice/list.php?{$Session}">{$Invoice}</a></td></tr>
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
<h2>{$Offer} - {$Info}</h2>
</td>
</tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}	
{* Display pager *}
{if $CurrentOfferID > $MinOfferID }
	<a href="{$smarty.server.PHP_SELF}?offerID={$MinOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?offerID={$PrevOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Offer_No}:&nbsp;<a title="{$Offer_No}: {$CurrentOfferID} / {$MaxOfferID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?offerID={$CurrentOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$CurrentOfferID}</a>&nbsp;/&nbsp;{$MaxOfferID}&nbsp;
{if $CurrentOfferID < $MaxOfferID }
	<a href="{$smarty.server.PHP_SELF}?offerID={$NextOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?offerID={$MaxOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
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
	{if $CANCELED eq 1}
		{$Entry_Canceled}
	{/if}
{else}

{if $CANCELED neq 1}
	{if $STATUS neq 3}
		{if $TaxFree neq 1}
			<td align="center" colspan="7">
		{else}
			<td align="center" colspan="6">
		{/if}	
		[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Edit}</a>
		&nbsp;|&nbsp;
		<a title="{$Offer_Status}" class="nmenulink" href="change_status.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Offer_Status}</a>
		&nbsp;|&nbsp;
		<a title="{$Invoice}&nbsp;-&nbsp;{$Offer_No}&nbsp;{$offerID}" class="nmenulink" href="../invoice/new.php?myID={$myID}&amp;offerID={$offerID}&amp;tmpID={$offerID}&amp;newofferID={$offerID}&amp;MethodOfPayment={$METHODOFPAYID}&amp;Note={$NOTE}&amp;messageID={$MESSAGEID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Invoice}</a>
		{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
			&nbsp;|&nbsp;
			<a title="{$Cancelentry}" class="nmenulink" href="cancel.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Cancel}</a>&nbsp;]</td></tr>
		{else}
			&nbsp;]</td></tr>
		{/if}
		<tr>
		{if $TaxFree neq 1}
			<td align="center" colspan="7">
		{else}
			<td align="center" colspan="6">
		{/if}	
		[&nbsp;<a title="{$Print_Offer}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;offerID={$offerID}&amp;Type=Offer&amp;{$Session}" target="_blank">{$Print_Offer}</a>
		&nbsp;|&nbsp;<a title="{$Copy_Offer}" class="nmenulink" href="copy_offer.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Copy_Offer}</a>
		&nbsp;|&nbsp;<a title="{$Email_Offer}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;offerID={$offerID}&amp;SendEmail=1&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Email}&nbsp;-&nbsp;{$Offer}</a>&nbsp;]</td></tr>
		{if $STATUS eq 1}
		<tr>
		{if $TaxFree neq 1}
			<td align="center" colspan="7">
		{else}
			<td align="center" colspan="6">
		{/if}	
			[&nbsp;<a title="{$Print_Order}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;Type=Order&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;{$Session}" target="_blank">{$Print_Order}</a>
			&nbsp;|&nbsp;<a title="{$Email_Order}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;offerID={$offerID}&amp;SendEmail=2&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Email}&nbsp;-&nbsp;{$OOrder}</a>&nbsp;]</td></tr>
		{/if}
	{else}
		{if $TaxFree neq 1}
			<td align="center" colspan="7">
		{else}
			<td align="center" colspan="6">
		{/if}
		[&nbsp;
		<a title="{$Print_Offer}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;offerID={$offerID}&amp;Type=Offer&amp;{$Session}" target="_blank">{$Print_Offer}</a>
		&nbsp;|&nbsp;<a title="{$Copy_Offer}" class="nmenulink" href="copy_offer.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Copy_Offer}</a>
		&nbsp;|&nbsp;<a title="{$Email_Offer}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;offerID={$offerID}&amp;SendEmail=1;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Offer}&nbsp;-&nbsp;{$Email}</a>&nbsp;]</td></tr>
		<tr>
		{if $TaxFree neq 1}
			<td align="center" colspan="7">
		{else}
			<td align="center" colspan="6">
		{/if}
		[&nbsp;<a title="{$Print_Order}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;Type=Order&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;{$Session}" target="_blank">{$Print_Order}</a>
		&nbsp;|&nbsp;<a title="{$Email_Order}&nbsp;{$FIRSTNAME}&nbsp;{$LASTNAME}&nbsp;{$COMPANY}" class="nmenulink" href="email.php?myID={$myID}&amp;offerID={$offerID}&amp;SendEmail=2&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Email}&nbsp;-&nbsp;{$OOrder}</a>&nbsp;]</td></tr>
	{/if}
{else}
	{if $TaxFree neq 1}
		<td align="center" colspan="7">
	{else}
		<td align="center" colspan="6">
	{/if}
	[&nbsp;<a title="{$Print_Offer}" class="nmenulink" href="print_pdf.php?myID={$myID}&amp;offerID={$offerID}&amp;Type=Offer&amp;{$Session}" target="_blank">{$Print_Offer}</a>
	&nbsp;|&nbsp;<a title="{$Copy_Offer}" class="nmenulink" href="copy_offer.php?myID={$myID}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$Copy_Offer}</a>&nbsp;]</td></tr>
{/if}
{if $CANCELED eq 1}
	{if $TaxFree neq 1}
		<tr><td align="center" colspan="7" class="redtxt">
	{else}
		<tr><td align="center" colspan="6" class="redtxt">
	{/if}
	{$Entry_Canceled}
</td></tr>
{/if}
<tr><td>
</td></tr>
{if $PRINT_NAME neq 2}
	<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$PREFIX} {$TITLE}</td></tr>
	<tr><td nowrap="nowrap" align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$FIRSTNAME} {$LASTNAME}</td><td align="right" valign="middle">{$OfferNo}:</td><td align="left" valign="middle">{$OfferInitials}-{$PrintDate}</td></tr>
{else}
	<tr><td nowrap="nowrap" align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="right" valign="middle">{$OfferNo}:</td><td align="left" valign="middle">{$OfferInitials}-{$PrintDate}</td></tr>
{/if}
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$COMPANY}</td><td align="right" valign="middle">{$Customer_No}:</td><td align="left" valign="middle"><a title="{$AllInformation} {$Customer_No} {$CustomerNoInitials}-{$MYID}" class="nmenulink" href="../addressbook/info.php?myID={$MYID}&amp;infoID=30&amp;{$Session}" target="_blank">{$CustomerNoInitials}-{$MYID}</a></td></tr>
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$ADDRESS}</td><td align="right" valign="middle">{$MethodOfPayment}:</td><td align="left" valign="middle">{$METHOD_OF_PAY} {if $METHOD_OF_PAY_DATE neq 0}{$Date_Till} {$METHOD_OF_PAY_DATE}{/if}</td></tr>
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$POSTALCODE}&nbsp;&nbsp;{$CITY}</td><td align="right" valign="middle">{$DateMsg}:</td><td align="left" valign="middle">{$OFFER_DATE}</td></tr>
<tr><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $COUNTRY neq $Country}{$COUNTRY}{/if}</td><td align="right" valign="middle">{$Offer_Status}:</td>
{if $STATUS eq 1}
	<td class="redtxt" align="left" valign="middle">{$OFFER_STATUS}</td>
{elseif $STATUS eq 2}
	<td class="greentxt" align="left" valign="middle">{$OFFER_STATUS}</td>
{else}
	<td align="left" valign="middle">{$OFFER_STATUS}</td>
{/if}
</tr>
<tr><td></td></tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="3" summary="Tabelle 3">
<tr class="mblueTD"><td nowrap="nowrap" align="left" valign="middle">{$PositionName}</td><td nowrap="nowrap" align="left" valign="middle">{$PositionText}</td><td align="right" nowrap="nowrap" valign="middle">{$PositionQuantity}</td><td align="right" nowrap="nowrap" valign="middle">{$PositionPrice} {$Offer_Currency}</td>{if $TaxFree neq 1}<td nowrap="nowrap" align="right" valign="middle">{$Tax}</td>{/if}<td nowrap="nowrap" align="right" valign="middle">{$PositionAmount} {$Offer_Currency}</td><td nowrap="nowrap" align="center">{$Entrys}:&nbsp;{$MaxRows}&nbsp;</td></tr>
{foreach from=$PosData item=offer}
	<tr class="{cycle values="grayTD,wTD"}">
	<td valign="top" align="left"><a title="{$AllInformation} {$offer.POS_NAME}" class="ninfolink" href="../position/info.php?posID={$offer.POSITIONID}&amp;infoID=30&amp;{$Session}" target="_blank">{$offer.POS_NAME}</a></td>
	<td valign="top" align="left">{$offer.POS_DESC|nl2br}</td>
	<td nowrap="nowrap" valign="top" align="right">{if $offer.POS_QUANTITY neq 0}{$offer.POS_QUANTITY}{/if}</td>
	<td nowrap="nowrap" valign="top" align="right">{if $offer.POS_QUANTITY neq 0}{$offer.POS_PRICE|number_format}{/if}</td>
{if $TaxFree neq 1}
	<td nowrap="nowrap" valign="top" align="right">{if $offer.POS_QUANTITY neq 0}{$offer.TAX_DESC}{/if}</td>
{/if}
<td nowrap="nowrap" valign="top" align="right">{if $offer.POS_QUANTITY neq 0}{$offer.POS_PRICE*$offer.POS_QUANTITY|number_format}{/if}</td><td></td>
</tr>
{/foreach}
<tr><td>&nbsp;</td></tr>
{if $TaxFree neq 1}
	{if $SUBTOTAL1 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Subtotal} {$TAX1_DESC}:
			</td>
			<td valign="top" align="right">{$SUBTOTAL1|number_format}
			</td>
		</tr>
	{/if}
	{if $SUBTOTAL2 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Subtotal} {$TAX2_DESC}:
			</td>
			<td valign="top" align="right">{$SUBTOTAL2|number_format}
			</td>
		</tr>
	{/if}
	{if $SUBTOTAL3 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Subtotal} {$TAX3_DESC}:
			</td>
			<td valign="top" align="right">{$SUBTOTAL3|number_format}
			</td>
		</tr>
	{/if}
	{if $SUBTOTAL4 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Subtotal} {$TAX4_DESC}:
			</td>
			<td valign="top" align="right">{$SUBTOTAL4|number_format}
			</td>
		</tr>
	{/if}
	{if $TAX1 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Tax1} {$TAX1_DESC}:
			</td>
			<td valign="top" align="right">{$TAX1|number_format}
			</td>
		</tr>
	{/if}
	{if $TAX2 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Tax2} {$TAX2_DESC}:
			</td>
			<td valign="top" align="right">{$TAX2|number_format}
			</td>
		</tr>
	{/if}
	{if $TAX3 neq 0}
		<tr>
			<td valign="top" align="right" colspan="6">{$Offer_Tax3} {$TAX3_DESC}:
			</td>
			<td valign="top" align="right">{$TAX3|number_format}
			</td>
		</tr>
	{/if}
	<tr>
		<td valign="top" align="right" colspan="6"><b>{$Offer_Amount} {$Offer_Currency}</b>:
		</td>
		<td valign="top" align="right">
		{if $CANCELED eq 1}
			<del><b>{$TOTAL_AMOUNT|number_format}</b></del>
		{else}
			<b>{$TOTAL_AMOUNT|number_format}</b>
		{/if}
		</td>
	</tr>
{else}
	<tr>
		<td valign="top" align="right" colspan="5"><b>{$Offer_Amount} {$Offer_Currency}</b>:
		</td>
		<td valign="top" align="right">
		{if $CANCELED eq 1}
			<del><b>{$TOTAL_AMOUNT|number_format}</b></del>
		{else}
			<b>{$TOTAL_AMOUNT|number_format}</b>
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
	<td colspan="7" align="center" valign="middle" class="justifydbTxt">
{else}
	<td colspan="6" align="center" valign="middle" class="justifydbTxt">
{/if}
	{$Offer_Note}:&nbsp;[&nbsp;---&nbsp;{$NOTE|nl2br}&nbsp;---&nbsp;]
	</td>
</tr>
<tr>
	<td>&nbsp;
	</td>
</tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7" valign="middle" class="justifydbTxt">
{else}
	<td align="center" colspan="6"valign="middle" class="justifydbTxt">
{/if}
	{$Message}:&nbsp;[&nbsp;---&nbsp;{$MESSAGE_DESC|nl2br}&nbsp;---&nbsp;]
	</td>
</tr>
<tr>
	<td>&nbsp;
	</td>
</tr>
<tr>
{if $TaxFree neq 1}
	<td align="center" colspan="7">
{else}
	<td align="center" colspan="6">
{/if}
{if $infoID eq 9}
	<form action="searchlist.php?{$Session}#{$offerID}" method="post">
	<input type="hidden" name="OfferID1" value="{$OfferID1}" />
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
	<form action="list.php?{$Session}#{$offerID}" method="post">
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
{if $CurrentOfferID > $MinOfferID }
	<a href="{$smarty.server.PHP_SELF}?offerID={$MinOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?offerID={$PrevOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Offer_No}:&nbsp;<a title="{$Offer_No}: {$CurrentOfferID} / {$MaxOfferID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?offerID={$CurrentOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$CurrentOfferID}</a>&nbsp;/&nbsp;{$MaxOfferID}&nbsp;
{if $CurrentOfferID < $MaxOfferID }
	<a href="{$smarty.server.PHP_SELF}?offerID={$NextOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?offerID={$MaxOfferID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
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
