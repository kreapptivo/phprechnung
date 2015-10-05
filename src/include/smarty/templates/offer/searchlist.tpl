{*
	searchlist.tpl

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
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<table width="100%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
<tr><td align="center" colspan="8"><h2>{$Offer} - {$SearchResult}</h2></td></tr>
<tr><td align="center" colspan="7">{$DateMsg} {$DateFrom} {$DateFrom1} {$DateTill} {$DateTill1}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $Rows ( lines per page ) *}
{if $MaxPages}
<tr><td align="center" colspan="8">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
{/if}
{if $smarty.session.NewID and ( $smarty.session.NewID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$NewEntry} {$Offer_No} {$offerID}, {$Customer_No} {$myID}</td></tr>
{/if}
{if $smarty.session.EditID and ( $smarty.session.EditID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$EntryChanged} {$Offer_No} {$offerID}, {$Customer_No} {$myID}</td></tr>
{/if}
{if $smarty.session.CancelID and ( $smarty.session.CancelID eq 1 )}
	<tr><td align="center" colspan="8" class="greentxt">{$EntryCanceled} {$Offer_No} {$offerID}, {$Customer_No} {$myID}</td></tr>
{/if}
{if $smarty.session.emailID and ( $smarty.session.emailID eq "1" )}
	<tr><td align="center" colspan="8" class="greentxt">{$Email_OK} {$FIRSTNAME} {$LASTNAME} {$COMPANY}, {$Offer_No} {$offerID}, {$Customer_No} {$MYID}</td></tr>
{/if}
{if $smarty.session.emailID and ( $smarty.session.emailID eq "2" )}
	<tr><td align="center" colspan="8" class="redtxt">{$Email_Error}</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$Offer_No}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=OFFERID&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Offer_No} ASC" alt="{$SortMsg} {$Offer_No} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=OFFERID&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Offer_No} DESC" alt="{$SortMsg} {$Offer_No} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$Customer}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Customer} ASC" alt="{$SortMsg} {$Customer} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=LASTNAME,FIRSTNAME,COMPANY&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Customer} DESC" alt="{$SortMsg} {$Customer} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$DateMsg}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=O.OFFER_DATE&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$DateMsg} ASC" alt="{$SortMsg} {$DateMsg} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=O.OFFER_DATE&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$DateMsg} DESC" alt="{$SortMsg} {$DateMsg} DESC" /></a>
</td>
<td nowrap="nowrap" align="right">{$Offer_Amount} {$Offer_Currency}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=O.TOTAL_AMOUNT&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Offer_Amount} ASC" alt="{$SortMsg} {$Offer_Amount} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=O.TOTAL_AMOUNT&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Offer_Amount} DESC" alt="{$SortMsg} {$Offer_Amount} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$Offer_Status}
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=STATUS&amp;Sort=ASC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Offer_Status} ASC" alt="{$SortMsg} {$Offer_Status} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?{$AddCurrentPage}Order=STATUS&amp;Sort=DESC&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Offer_Status} DESC" alt="{$SortMsg} {$Offer_Status} DESC" /></a>
</td>
<td nowrap="nowrap" align="center" colspan="3">{$Entrys}:&nbsp;{$MaxRows}
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=2&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$NotCanceledEntries}" alt="{$NotCanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=1&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$CanceledEntries}" alt="{$CanceledEntries}" /></a>
<a href="{$smarty.server.PHP_SELF}?Order={$Order}&amp;Sort={$Sort}&amp;Canceled=3&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/right.png" title="{$AllEntries}" alt="{$AllEntries}" /></a>
&nbsp;
</td>
</tr>
{* Display entrys from database if $MaxRows > 0 *}
{if $MaxRows eq 0}
	<tr><td align="center" colspan="8" class="redtxt">{$NoEntry}</td></tr>
{else}
{foreach from=$OfferData item=offer}
<tr class="{cycle values="grayTD,wTD"}">
<td valign="top" align="left"><a name="{$offer.OFFERID}" title="{$AllInformation} {$Offer_No} {$offer.OFFERID}" class="ninfolink" href="info.php?myID={$offer.MYID}&amp;offerID={$offer.OFFERID}&amp;infoID=9&amp;{$AddCurrentPage}Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}">
{$offer.OFFERID}</a></td>
{if $offer.CANCELED neq 1}
	<td valign="top" align="left">
	{if $offer.FIRSTNAME}
		{$offer.FIRSTNAME}
	{/if}
	{if $offer.LASTNAME}
		{$offer.LASTNAME},
	{/if}
	{if $offer.COMPANY}
		{$offer.COMPANY}
	{/if}
	</td>
	<td valign="top" align="center">{$offer.OFFER_DATE}</td>
	{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $offer.CREATEDBY)}
		<td valign="top" align="right">{$offer.TOTAL_AMOUNT|number_format}</td>
	{else}
		<td valign="top" align="right"></td>
	{/if}
	{if $offer.STATUS eq 0}
		<td valign="top" align="center" class="redtxt">Error - Status '0'</td>
	{/if}
	{foreach item=status from=$active_status}
		{foreach key=key item=item from=$status}
			{if $offer.STATUS and ( $offer.STATUS eq $key)}
				{if $offer.STATUS eq 1}
					<td valign="top" align="center" class="redtxt">{$item}</td>
				{elseif $offer.STATUS eq 2}
					<td valign="top" align="center" class="greentxt">{$item}</td>
				{else}
					<td valign="top" align="center">{$item}</td>
				{/if}
			{/if}
		{/foreach}
	{/foreach}
	{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $offer.CREATEDBY)}
		{if $offer.STATUS neq 3}
			<td valign="top" align="center"><a href="edit.php?offerID={$offer.OFFERID}&amp;{$AddCurrentPage}infoID=9&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/edit.png" title="{$Editentry}" alt="{$Editentry}" /></a></td>
			<td valign="top" align="center"><a href="print_pdf.php?myID={$offer.MYID}&amp;offerID={$offer.OFFERID}&amp;Type=Offer&amp;{$Session}" target="_blank"><img border="0" src="../images/print.png" title="{$Print_Offer} - {$Offer_No} {$offer.OFFERID}" alt="{$Print_Offer} - {$Offer_No} {$offer.OFFERID}" /></a></td>
			<td valign="top" align="center"><a href="../invoice/new.php?myID={$offer.MYID}&amp;offerID={$offer.OFFERID}&amp;tmpID={$offer.OFFERID}&amp;newofferID={$offer.OFFERID}&amp;MethodOfPayment={$offer.METHODOFPAYID}&amp;Note={$offer.NOTE}&amp;messageID={$offer.MESSAGEID}&amp;{$Session}"><img border="0" src="../images/bill.png" title="{$Issue_Invoice}{if $offer.FIRSTNAME} {$offer.FIRSTNAME}{/if}{if $offer.LASTNAME} {$offer.LASTNAME},{/if}{if $offer.COMPANY} {$offer.COMPANY}{/if}" alt="{$Issue_Invoice}{if $offer.FIRSTNAME} {$offer.FIRSTNAME}{/if}{if $offer.LASTNAME} {$offer.LASTNAME},{/if}{if $offer.COMPANY} {$offer.COMPANY}{/if}" /></a></td>
		{else}
			<td valign="top" align="center" colspan="3"></td>
		{/if}
	{else}
		<td valign="top" align="center" colspan="3"></td>
	{/if}
{else}
	<td valign="top" align="left" class="graytxt">
	{if $offer.FIRSTNAME}
		{$offer.FIRSTNAME}
	{/if}
	{if $offer.LASTNAME}
		{$offer.LASTNAME},
	{/if}
	{if $offer.COMPANY}
		{$offer.COMPANY}
	{/if}
	</td>
	<td valign="top" align="center" class="graytxt">{$offer.OFFER_DATE}</td>
	{if $smarty.session.Username and ( $smarty.session.Username eq $Root or $smarty.session.Username eq $offer.CREATEDBY)}
		<td valign="top" align="right" class="graytxt"><del>{$offer.TOTAL_AMOUNT|number_format}</del></td>
	{else}
		<td valign="top" align="right" class="graytxt"></td>
	{/if}
	{if $offer.STATUS eq 0}
		<td valign="top" align="center" class="graytxt">Error - Status '0'</td>
	{/if}
	{foreach item=status from=$active_status}
		{foreach key=key item=item from=$status}
			{if $offer.STATUS and ( $offer.STATUS eq $key)}
				{if $offer.STATUS eq 1}
					<td valign="top" align="center" class="graytxt">{$item}</td>
				{elseif $offer.STATUS eq 2}
					<td valign="top" align="center" class="graytxt">{$item}</td>
				{else}
					<td valign="top" align="center" class="graytxt">{$item}</td>
				{/if}
			{/if}
		{/foreach}
	{/foreach}
	<td valign="top" align="center" colspan="3" class="graytxt"></td>
{/if}
</tr>
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
<tr><td valign="top" align="right" colspan="5" class="redtxt">{$Offer_Not_Accepted} {$Offer_Currency}:</td><td valign="top" align="right" colspan="3" class="redtxt">{$TOTAL_NA|number_format}</td></tr>
<tr><td valign="top" align="right" colspan="5" class="greentxt">{$Offer_Confirmation} {$Offer_Currency}:</td><td valign="top" align="right" colspan="3" class="greentxt">{$TOTAL_C|number_format}</td></tr>
<tr><td valign="top" align="right" colspan="5">{$Offer_Invoice} {$Offer_Currency}:</td><td valign="top" align="right" colspan="3">{$TOTAL_IN|number_format}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" colspan="5">{$Offer_Amount} - {$PageMsg}  {$Offer_Currency}:</td><td valign="top" align="right" colspan="3">{$TOTAL_PAGE|number_format}</td></tr>
<tr><td valign="top" align="right" colspan="5"><b>{$Offer_Amount} - {$Searchresult} {$Offer_Currency}</b>:</td><td valign="top" align="right" colspan="3"><b>{$TOTAL_OFFER|number_format}</b></td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $Rows ( lines per page ) *}
{if $MaxPages and ($PageRows gte $MultiBar)}
<tr><td align="center" colspan="8">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?page=1&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$PrevPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?page={$CurrentPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?page={$NextPage}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?page={$MaxPages}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Canceled={$Canceled}&amp;{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
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
