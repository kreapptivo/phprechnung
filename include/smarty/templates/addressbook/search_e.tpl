{*
	search_e.tpl

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
<body onload="document.DSearch.Date_From1.focus();">
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="A" title="{$Addressbook} - {$List}"
href="list.php?{$Session}">{$Addressbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Addressbook} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Addressbook} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="3" title="{$Addressbook} - {$DetailSearch}"
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
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<form id="DSearch" name="DSearch" action="searchlist_e.php?{$Session}" method="post">
<table width="100%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1">
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="4">
	{if $infoID eq 9}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 10}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist_e.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{else}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{/if}
	</td>
</tr>
<tr><td align="center" colspan="4"><h2>{$Addressbook} - {$DetailSearch}</h2></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="left" width="25%">{$DateMsg} {$Date_From}</td><td class="dbTxt" valign="top" align="left" width="25%"><input type="text" name="Date_From1" size="22" value="{$CompanyDate}" /></td><td valign="top" align="left" width="25%">{$Date_Till}</td><td class="dbTxt" valign="top" align="left" width="25%"><input type="text" name="Date_Till1" size="22" value="{$smarty.now|date_format:"%d.%m.%Y"}" /></td></tr>
<tr><td valign="top" align="left" width="25%">{$Print_Name}</td><td class="dbTxt" valign="top" align="left" width="25%">
<select class="choice250" name="PrintName1" title="{$Print_Name}">
<optgroup label="{$Print_Name}" title="{$Print_Name}">
<option title="{$Select_All}" value="">{$Select_All}</option>
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
	{/foreach}
{/foreach}
</optgroup></select></td><td valign="top" align="left" width="25%">{$Customer_No}</td><td valign="top" align="left" width="25%"><input type="text" name="CustomerID" size="22" value="" /></td></tr>
<tr><td valign="top" align="left" width="25%">{$Prefix}&nbsp;</td><td class="dbTxt" valign="top" align="left" width="25%"><input type="text" name="Prefix1" size="22" value="" /></td><td valign="top" align="left" width="25%">{$CTitle}</td><td class="dbTxt" valign="top" align="left" width="25%"><input type="text" name="Title11" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Firstname}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Firstname1" size="22" value="" /></td><td valign="top" align="left">{$Initials}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Initials1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Lastname}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Lastname1" size="22" value="" /></td><td valign="top" align="left">{$Phonehome}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Phonehome1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Salutation}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Salutation1" size="22" value="" /></td><td valign="top" align="left">{$Mobile}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Mobile1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Address}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Address1" size="22" value="" /></td><td valign="top" align="left">{$Fax}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Fax1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Country}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Country1" size="22" value="" /></td><td valign="top" align="left">{$Stateprov}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Stateprov1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Postalcode}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Postalcode1" size="22" value="" /></td><td valign="top" align="left">{$City}&nbsp;</td><td class="dbTxt" valign="top" align="left"><input type="text" name="City1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Email}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Email1" size="22" value="" /></td><td valign="top" align="left">{$Url}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Url1" size="22" value="" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="left">{$Company}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Company1" size="22" value="" /></td><td valign="top" align="left">{$Phonework}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Phonework1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Department}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Department1" size="22" value="" /></td><td valign="top" align="left">{$Phoneoffi}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Phoneoffi1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$CPosition}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Position11" size="22" value="" /></td><td valign="top" align="left">{$Phoneothe}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Phoneothe1" size="22" value="" /></td></tr>
<tr><td valign="top" align="left">{$Birthday}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Birthday1" size="22" value="" /></td><td valign="top" align="left">{$Pager}</td><td class="dbTxt" valign="top" align="left"><input type="text" name="Pager1" size="22" value="" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="left">{$Category}</td>
<td class="dbTxt" valign="top" align="left">
<select class="choice250" name="Category1" title="{$Category}">
<optgroup label="{$Category}" title="{$Category}">
<option value="">{$Select_All}</option>
{foreach from=$CategoryData item=category}
	<option label="{$category.DESCRIPTION}" title="{$category.DESCRIPTION}"  value="{$category.CATEGORYID}">{$category.DESCRIPTION}</option>
{/foreach}
</optgroup></select></td><td colspan="2"></td></tr>
<tr><td valign="top" align="left" width="25%">{$CustMethodOfPayment}</td>
<td class="dbTxt" valign="top" align="left" width="25%">
<select class="choice250" name="MethodOfPayment1" title="{$CustMethodOfPayment}">
<optgroup label="{$CustMethodOfPayment}" title="{$CustMethodOfPayment}">
<option value="">{$Select_All}</option>
{foreach from=$PaymentData item=payment}
	<option label="{$payment.DESCRIPTION}" title="{$payment.DESCRIPTION}"  value="{$payment.METHODOFPAYID}">{$payment.DESCRIPTION}</option>
{/foreach}
</optgroup></select></td><td colspan="2"></td></tr>
<tr><td valign="top" align="left" width="25%">{$Note}</td><td class="dbTxt" valign="top" align="left" width="25%"><textarea name="Note1" rows="5" cols="32"></textarea></td><td colspan="2"></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="center" colspan="4">
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$Search}" value="{$Search}" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
