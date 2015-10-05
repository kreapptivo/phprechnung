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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="A" title="{$Addressbook} - {$List}"
href="list.php?{$Session}">{$Addressbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Addressbook} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Addressbook} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Addressbook} - {$DetailSearch}"
href="search_e.php?{$Session}">{$DetailSearch}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="4" title="{$Addressbook} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="P" title="{$Position}"
href="../position/list.php?{$Session}">{$Position}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="O" title="{$Offer}"
href="../offer/list.php?{$Session}">{$Offer}</a></td></tr>
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
<table width="80%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1"><tbody>
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	{if $infoID eq 9}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 10}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist_e.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 30}
		[&nbsp;<a title="{$CloseWindow}" class="ninfolink" href="javascript:window.close()">{$CloseWindow}</a>&nbsp;]
	{else}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{/if}
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Addressbook} - {$Info}</h2></td></tr>
{* Display pager *}
<tr>
	<td align="center" colspan="2">
{if $CurrentMyID > $MinMyID }
	<a href="{$smarty.server.PHP_SELF}?myID={$MinMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?myID={$PrevMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Customer_No}:&nbsp;<a title="{$AllInformation} {$Customer_No}: {$CurrentMyID} / {$MaxMyID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?myID={$CurrentMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentMyID}</a>&nbsp;/&nbsp;{$MaxMyID}&nbsp;
{if $CurrentMyID < $MaxMyID }
	<a href="{$smarty.server.PHP_SELF}?myID={$NextMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?myID={$MaxMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
	</td>
</tr>
<tr><td></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username eq $Root )}
	<tr><td align="center" colspan="2">
	[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type=Info&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Edit}</a>
	&nbsp;|&nbsp;<a title="{$Deleteentry}" class="nmenulink" href="delete.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Delete}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Offer} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../offer/new.php?myID={$MYID}&amp;{$Session}">{$Offer}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Invoice} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../invoice/new.php?myID={$MYID}&amp;{$Session}">{$Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Print} {$AllInformation} {$Customer_No} {$myID} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="print_info_pdf.php?myID={$MYID}&amp;{$Session}" target="_blank">{$Print}</a>&nbsp;]
	</td></tr>
{else}
	<tr><td align="center" colspan="2">
	[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type=Info&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Edit}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Offer} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../offer/new.php?myID={$MYID}&amp;{$Session}">{$Offer}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Invoice} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../invoice/new.php?myID={$MYID}&amp;{$Session}">{$Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Print} {$AllInformation} {$Customer_No} {$myID} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="print_info_pdf.php?myID={$MYID}&amp;{$Session}" target="_blank">{$Print}</a>&nbsp;]
	</td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
{if $MYID neq 0}
	<tr>
		<td align="center" colspan="2">
		[&nbsp;<a title="{$Basic_Info}" class="nmenulink" href="info.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Basic_Info}</b></a>&nbsp;]
		&nbsp;
		[&nbsp;<a title="{$Extended_Info}" class="nmenulink" href="info_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Extended_Info}</a>&nbsp;]
		&nbsp;
		[&nbsp;<a title="{$Auth_Info}" class="nmenulink" href="info_a.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Auth_Info}</a>&nbsp;]
		&nbsp;
		[&nbsp;<a title="Google Maps" class="nmenulink" href="http://maps.google.de/maps?f=q&amp;q={$ADDRESS},{$POSTALCODE} {$CITY}, {$COUNTRY}&amp;ie={$smarty.session.Charset}" target="_blank">Google Maps</a>&nbsp;]
		</td>
	</tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="30%">{$DateMsg}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$CDATE}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Print_Name}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PRINT_COMPANY_NAME}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="30%">{$Prefix}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PREFIX}</td></tr>
<tr><td valign="top" align="right" width="30%">{$CTitle}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$TITLE}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Firstname}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$FIRSTNAME}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Lastname}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$LASTNAME}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Initials}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$INITIALS}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Company}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$COMPANY}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Department}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$DEPARTMENT}</td></tr>
<tr><td valign="top" align="right" width="30%">{$CPosition}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$POSITION}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Salutation}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$SALUTATION}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Address}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$ADDRESS}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Postalcode}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$POSTALCODE}</td></tr>
<tr><td valign="top" align="right" width="30%">{$City}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$CITY}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Stateprov}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$STATEPROV}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Country}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$COUNTRY}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="30%">{$Category}:</td><td class="dbTxt" valign="top" align="left" width="70%">
{foreach from=$CategoryData item=category}
	{if $CATEGORY == $category.CATEGORYID}
		{$category.DESCRIPTION}
	{/if}
{/foreach}
</td></tr>
<tr><td valign="top" align="right" width="30%">{$MethodOfPayment}:</td><td class="dbTxt" valign="top" align="left" width="70%">
{foreach from=$PaymentData item=payment}
	{if $METHOD_OF_PAYMENT == $payment.METHODOFPAYID}
		{$payment.DESCRIPTION}
	{/if}
{/foreach}
</td></tr>
<tr><td valign="top" align="right" width="30%">{$Message}:</td><td class="dbTxt" valign="top" align="left" width="70%">
{foreach from=$MessageData item=message}
	{if $MESSAGE == $message.MESSAGEID}
		{$message.DESCRIPTION}
	{/if}
{/foreach}
</td></tr>
<tr><td valign="top" align="right" width="30%">{$Note}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$NOTE|nl2br}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Birthday}:</td><td class="dbTxt" valign="top" align="left" width="70%">{if $BIRTHDAY neq 0}{$BIRTHDAY}{/if}</td></tr>
<tr><td>&nbsp;</td></tr>
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	{if $infoID eq 9}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 10}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist_e.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 30}
		[&nbsp;<a title="{$CloseWindow}" class="ninfolink" href="javascript:window.close()">{$CloseWindow}</a>&nbsp;]
	{else}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{/if}
	</td>
</tr>
{else}
	<tr>
		<td align="center" colspan="2" class="redtxt">I'm Sorry, No Information Available.
		</td>
	</tr>
{/if}
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
