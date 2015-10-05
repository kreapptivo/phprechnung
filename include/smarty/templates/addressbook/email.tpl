{*
	email.tpl

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
	<body onload="document.Email.{$mark}.focus();">
{else}
	<body onload="document.Email.EmailTo.focus();">
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
<form id="Email" name="Email" action="emailf.php?{$Session}" method="post">
<table width="80%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1">
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	{if $infoID eq 9}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{elseif $infoID eq 10}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Searchresult}" class="ninfolink" href="searchlist_e.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{else}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	{/if}
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Addressbook} - {$Email}</h2></td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$Customer_No} {$myID} - {$FIRSTNAME} {$LASTNAME} {$COMPANY} ]</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="35%">{$Email_From}:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%">{$COMPANYNAME}<br />[ {$COMPANYEMAIL} ]</td></tr>
<tr><td valign="middle" align="right" width="35%"><b>{$Email_To}</b>:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%"><input title="{$Email_To}" class="form_input" type="text" name="EmailTo" size="32" value="{$EMAIL_TO}" /></td></tr>
<tr><td valign="middle" align="right" width="35%">{$Email_Cc}:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%"><input title="{$Email_Cc}" class="form_input" type="text" name="EmailCc" size="32" value="{$EmailCc}" /></td></tr>
<tr><td valign="middle" align="right" width="35%">{$Email_Bcc}:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%"><input title="{$Email_Bcc}" class="form_input" type="text" name="EmailBcc" size="32" value="{$EmailBcc}" /></td></tr>
<tr><td valign="middle" align="right" width="35%"><b>{$Email_Subject}</b>:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%"><input title="{$Email_Subject}" class="form_input" type="text" name="EmailSubject" size="32" value="{$EmailSubject}" /></td></tr>
<tr><td valign="middle" align="right" width="35%">{$Email_Priority}:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="25%">
<select title="{$Email_Priority}" class="choice250" name="EmailPriority">
<optgroup label="{$Email_Priority}" title="{$Email_Priority}">
{foreach item=priority from=$email_priority}
	{foreach key=key item=item from=$priority}
		{if $EmailPriority and ( $EmailPriority == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="top" align="right" width="35%"><b>{$Email_Text}</b>:&nbsp;</td><td class="dbTxt" valign="top" align="left" width="65%"><textarea title="{$Email_Text}" class="form_textarea" name="EmailText" rows="10" cols="46">{$EMAIL_TEXT}</textarea></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="center" colspan="2">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="myID" value="{$myID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="CompanyName" value="{$COMPANYNAME}" />
<input type="hidden" name="EmailFrom" value="{$COMPANYEMAIL}" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
{if $infoID eq 10}
	{include file="addressbook/userinput.tpl"}
{/if}
<input type="submit" class="button" title="{$Email_Send}" value="{$Email_Send}" />
</td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
