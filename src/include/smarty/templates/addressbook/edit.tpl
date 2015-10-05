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
	<body onload="document.Edit.{$mark}.focus();">
{else}
	<body onload="document.Edit.Prefix.focus();">
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
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
<form id="Edit" name="Edit" action="editf.php?{$Session}" method="post">
<table width="80%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1">
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	{if $Type eq "Info"}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Basic_Info}" class="ninfolink" href="info.php?myID={$myID}&amp;infoID={$infoID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 9}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 10}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist_e.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{else}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}#{$myID}">{$BackMsg}</a>&nbsp;]
	{/if}
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Addressbook} - {$Edit}</h2></td></tr>
{* Display pager *}
<tr>
	<td align="center" colspan="2">
{if $CurrentMyID > $MinMyID }
	<a href="{$smarty.server.PHP_SELF}?myID={$MinMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/first.png" title="{$FirstPageMsg}" alt="{$FirstPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?myID={$PrevMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/prev.png" title="{$PrevPageMsg}" alt="{$PrevPageMsg}" /></a>&nbsp;
{/if}
{$Customer_No}:&nbsp;<a title="{$Customer_No}: {$CurrentMyID} / {$MaxMyID}" class="ninfolink" href="{$smarty.server.PHP_SELF}?myID={$CurrentMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$CurrentMyID}</a>&nbsp;/&nbsp;{$MaxMyID}&nbsp;
{if $CurrentMyID < $MaxMyID }
	<a href="{$smarty.server.PHP_SELF}?myID={$NextMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/next.png" title="{$NextPageMsg}" alt="{$NextPageMsg}" /></a>&nbsp;
	<a href="{$smarty.server.PHP_SELF}?myID={$MaxMyID}&amp;page={$page}&amp;infoID={$infoID}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}"><img border="0" src="../images/last.png" title="{$LastPageMsg}" alt="{$LastPageMsg}" /></a>&nbsp;
{/if}
	</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">
[&nbsp;<a title="{$Basic_Info}" class="nmenulink" href="edit.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Basic_Info}</b></a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Extended_Info}" class="nmenulink" href="edit_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Extended_Info}</a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Auth_Info}" class="nmenulink" href="edit_a.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Auth_Info}</a>&nbsp;]
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td valign="middle" align="right" width="30%">{$DateMsg}:
	</td>
	<td class="dbTxt" valign="top" align="left" width="70%">{$CREATED}
	</td>
</tr>
<tr><td valign="middle" align="right" width="30%">{$Print_Name}:</td><td class="dbTxt" valign="top" align="left" width="70%">
<select class="choice200" name="PrintName" title="{$Print_Name}">
<optgroup label="{$Print_Name}" title="{$Print_Name}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $PRINT_NAME and ( $PRINT_NAME == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Prefix}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input title="{$Prefix}" class="form_input" type="text" name="Prefix" size="22" value="{$PREFIX}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$CTitle}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input title="{$CTitle}" class="form_input" type="text" name="Title1" size="22" value="{$TITLE}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Firstname}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input title="{$Firstname}" class="form_input" type="text" name="Firstname" size="22" value="{$FIRSTNAME}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Lastname}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Lastname" size="22" value="{$LASTNAME}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Initials}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input title="{$Initials}" class="form_input" type="text" name="Initials" size="22" value="{$INITIALS}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Company}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Company" size="22" value="{$COMPANY}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Department}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Department" size="22" value="{$DEPARTMENT}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$CPosition}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Position1" size="22" value="{$POSITION}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Salutation}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Salutation" size="22" value="{$SALUTATION}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Address}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Address" size="22" value="{$ADDRESS}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Postalcode}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Postalcode" size="22" value="{$POSTALCODE}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$City}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="City" size="22" value="{$CITY}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Stateprov}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Stateprov" size="22" value="{$STATEPROV}" /></td></tr>
<tr><td valign="middle" align="right" width="30%"><b>{$Country}</b>:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Country" size="22" value="{$COUNTRY}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Category}:</td>
<td class="dbTxt" valign="top" align="left"  width="70%">
<select class="choice200" name="Category" title="{$Category}">
<optgroup label="{$Category}" title="{$Category}">
{foreach from=$CategoryData item=category}
	{if $NR_CATEGORY == $category.CATEGORYID}
		<option label="{$category.DESCRIPTION}" title="{$category.DESCRIPTION}" value="{$category.CATEGORYID}" selected="selected">{$category.DESCRIPTION}</option>
	{else}
		<option label="{$category.DESCRIPTION}" title="{$category.DESCRIPTION}"  value="{$category.CATEGORYID}">{$category.DESCRIPTION}</option>
	{/if}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="30%">{$CustMethodOfPayment}:</td>
<td class="dbTxt" valign="top" align="left" width="70%">
<select class="choice200" name="MethodOfPayment" title="{$CustMethodOfPayment}">
<optgroup label="{$CustMethodOfPayment}" title="{$CustMethodOfPayment}">
{foreach from=$PaymentData item=payment}
	{if $NR_METHOD_OF_PAYMENT == $payment.METHODOFPAYID}
		<option label="{$payment.DESCRIPTION}" title="{$payment.DESCRIPTION}" value="{$payment.METHODOFPAYID}" selected="selected">{$payment.DESCRIPTION}</option>
	{else}
		<option label="{$payment.DESCRIPTION}" title="{$payment.DESCRIPTION}"  value="{$payment.METHODOFPAYID}">{$payment.DESCRIPTION}</option>
	{/if}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="30%">{$CustMessage}:</td>
<td class="dbTxt" valign="top" align="left" width="70%">
<select class="choice200" name="Message" title="{$CustMessage}">
<optgroup label="{$CustMessage}" title="{$CustMessage}">
<option title="{$Choose_Message}" value="">--- {$Choose_Message} ---</option>
{foreach from=$MessageData item=message}
	{if $MESSAGE == $message.MESSAGEID}
		<option label="{$message.DESCRIPTION}" title="{$message.DESCRIPTION}" value="{$message.MESSAGEID}" selected="selected">{$message.DESCRIPTION}</option>
	{else}
		<option label="{$message.DESCRIPTION}" title="{$message.DESCRIPTION}"  value="{$message.MESSAGEID}">{$message.DESCRIPTION}</option>
	{/if}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="top" align="right" width="30%">{$Note}:</td><td class="dbTxt" valign="top" align="left" width="70%"><textarea class="form_textarea" name="Note" rows="5" cols="20">{$NOTE}</textarea></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Birthday}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Birthday" size="22" value="{if $BIRTHDAY neq 0}{$BIRTHDAY}{/if}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="myID" value="{$myID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
{if $infoID eq 10}
	{include file="addressbook/userinput.tpl"}
{/if}
<input type="submit" class="button" title="{$ChangeMsg}" value="{$ChangeMsg}" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
