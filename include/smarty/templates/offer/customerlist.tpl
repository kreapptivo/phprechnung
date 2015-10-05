{*
	customerlist.tpl

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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="O" title="{$Offer}"
href="list.php?{$Session}">{$Offer} - {$List}</a></td></tr>
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
<tr><td align="center" colspan="5"><h2>{$Addressbook} - {$Searchresult}</h2></td></tr>
<tr><td valign="middle" align="left">
{if $offerID}
	[&nbsp;<a title="{$BackMsg} - {$Offer} - {$Edit}" class="ninfolink" href="edit.php?myID={$myID}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
{else}
	[&nbsp;<a title="{$BackMsg} - {$Offer} - {$New}" class="ninfolink" href="new.php?myID={$myID}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
{/if}
</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display pager if $MaxRows => $Rows ( lines per page ) *}
{if $MaxPages}
<tr><td align="center" colspan="4">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage=1&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$PrevPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$CurrentPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$NextPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$MaxPages}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
{/if}
<tr><td></td></tr>
<tr class="mblueTD"><td nowrap="nowrap" align="left">&nbsp;{$Last_Name}
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=LASTNAME&amp;CustSort=ASC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Last_Name} ASC" alt="{$SortMsg} {$Last_Name} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=LASTNAME&amp;CustSort=DESC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Last_Name} DESC" alt="{$SortMsg} {$Last_Name} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$First_Name}
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=FIRSTNAME&amp;CustSort=ASC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$First_Name} ASC" alt="{$SortMsg} {$First_Name} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=FIRSTNAME&amp;CustSort=DESC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$First_Name} DESC" alt="{$SortMsg} {$First_Name} DESC" /></a>
</td>
<td nowrap="nowrap" align="left">{$Company_Name}
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=COMPANY&amp;CustSort=ASC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/up.png" title="{$SortMsg} {$Company_Name} ASC" alt="{$SortMsg} {$Company_Name} ASC" /></a>
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;Customer={$Customer}&amp;{$AddCurrentPage}CustOrder=COMPANY&amp;CustSort=DESC&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/down.png" title="{$SortMsg} {$Company_Name} DESC" alt="{$SortMsg} {$Company_Name} DESC" /></a>
</td>
<td nowrap="nowrap" align="center">{$Entrys}:&nbsp;{$MaxRows}&nbsp;</td></tr>
{* Display entrys from database if $MaxRows > 0 *}
{if $MaxRows == 0}
	<tr><td align="center" colspan="4" class="grayTD">{$NoEntry} {$Customer}</td></tr>
{else}
{foreach from=$CustomerData item=customer}
<tr class="{cycle values="grayTD,wTD"}">
<td valign="top" align="left"><a name="{$customer.MYID}" title="{$AllInformation} {$customer.FIRSTNAME} {$customer.LASTNAME} {$customer.COMPANY}" class="ninfolink" href="../addressbook/info.php?myID={$customer.MYID}&amp;infoID=30&amp;{$Session}" target="_blank">
{if $customer.LASTNAME}
	{$customer.LASTNAME}
{else}
	&nbsp;i&nbsp;
{/if}</a></td>
<td valign="top" align="left">{$customer.FIRSTNAME}</td>
<td valign="top" align="left">{$customer.COMPANY|nl2br}</td>
{if $offerID}
<td valign="top" align="center"><a href="edit.php?myID={$customer.MYID}&amp;tmpID={$offerID}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/bill.png" title="{$Issue_Offer} {$customer.FIRSTNAME} {$customer.LASTNAME} {$customer.COMPANY}" alt="{$Issue_Offer} {$customer.FIRSTNAME} {$customer.LASTNAME} {$customer.COMPANY}" /></a></td>
{else}
<td valign="top" align="center"><a href="new.php?myID={$customer.MYID}&amp;tmpID={$offerID}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Session}"><img border="0" src="../images/bill.png" title="{$Issue_Offer} {$customer.FIRSTNAME} {$customer.LASTNAME} {$customer.COMPANY}" alt="{$Issue_Offer} {$customer.FIRSTNAME} {$customer.LASTNAME} {$customer.COMPANY}" /></a></td>
{/if}
</tr>
{/foreach}
{/if}
<tr><td>&nbsp;</td></tr>
{* Display pager and linkbar if $PageRows => $Rows ( lines per page ) *}
{if $MaxPages and ($PageRows >= $MultiBar)}
<tr><td align="center" colspan="4">
{if $CurrentPage > 1 }
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage=1&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$PrevPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$PageMsg}&nbsp;<a title="{$PageMsg} {$CurrentPage} / {$MaxPages}" class="ninfolink" href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$CurrentPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$CurrentPage}</a>&nbsp;/&nbsp;{$MaxPages}&nbsp;
{if $CurrentPage < $MaxPages }
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$NextPage}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
<a href="{$smarty.server.PHP_SELF}?myID={$myID}&amp;CustPage={$MaxPages}&amp;Customer={$Customer}&amp;CustOrder={$CustOrder}&amp;CustSort={$CustSort}&amp;page={$page}&amp;offerID={$offerID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;OfferDate={$OfferDate}&amp;OfferStatus={$OfferStatus}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Pos_Quantity={$Pos_Quantity}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
</td></tr>
<tr><td>&nbsp;</td></tr>
{* Include the linkbar *}
<tr><td colspan="4">{include file="linkbar.tpl"}</td></tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}