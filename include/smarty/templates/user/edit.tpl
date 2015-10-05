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
	<body onload="document.Edit.FullName.focus();">
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="C" title="{$Cashbook}"
href="../cashbook/list.php?{$Session}">{$Cashbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="R" title="{$Reports}"
href="../reports/index.php?{$Session}">{$Reports}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
href="../configuration.php?{$Session}">{$Configuration}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Useradministration} - {$List}"
href="list.php?{$Session}">{$Useradministration}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Useradministration} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Useradministration} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="4" title="{$Useradministration} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root && $userID != 1)}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display User information *}
<form id="Edit" name="Edit" action="editf.php?{$Session}#{$userID}" method="post">
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
{if $infoID == 9}
	<tr>
		<td valign="middle" align="left" colspan="2">
		[&nbsp;<a title="{$BackMsg} - {$Useradministration} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;UserActive_1={$UserActive_1}&amp;FullName_1={$FullName_1}&amp;UserName_1={$UserName_1}&amp;UserGroup_1={$UserGroup_1}&amp;UserLanguage_1={$UserLanguage_1}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
		</td>
	</tr>
{else}
	<tr>
		<td valign="middle" align="left" colspan="2">
		[&nbsp;<a title="{$BackMsg} - {$Useradministration} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
		</td>
	</tr>
{/if}
<tr><td align="center" colspan="2"><h2>{$Useradministration} - {$Edit}</h2></td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$EntryNo} {$userID} ]</td></tr>
<tr><td></td></tr>
<tr><td valign="middle" align="right" width="40%">{$User_Active}:</td><td class="dbTxt" valign="middle" align="left" width="60%">
{if $smarty.session.Username and ( $smarty.session.Username != $Root or $userID eq 1)}
	{$ADMINACTIVE}
{else}
	<select class="choice200" name="UserActive" title="{$User_Active}">
	<optgroup label="{$User_Active}" title="{$User_Active}">
	{foreach item=user_active from=$choice_yes_no}
		{foreach key=key item=item from=$user_active}
			{if $USERACTIVE and ( $USERACTIVE eq $key)}
				<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
			{else}
				<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
			{/if}
		{/foreach}
	{/foreach}
	</optgroup></select>
{/if}
</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Full_Name}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%"><input title="{$Full_Name}" type="text" name="FullName" size="30" value="{$FULLNAME}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$User_Name}:</td><td class="dbTxt" valign="middle" align="left" width="60%">{$USERNAME}</td></tr>
<tr><td valign="middle" align="right" width="40%">{$User_Group}&nbsp;1:</td><td class="dbTxt" valign="middle" align="left" width="60%">
{if $smarty.session.Username and ( $smarty.session.Username != $Root or $userID eq 1)}
	{$ADMINGROUP1}
{else}
	<select class="choice200" name="UserGroup1" title="{$User_Group}">
	<optgroup label="{$User_Group}" title="{$User_Group}">
	{foreach item=group from=$choose_group}
		{foreach key=key item=item from=$group}
			{if $USERGROUP1 and ( $USERGROUP1 eq $key)}
				<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
			{else}
				<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
			{/if}
		{/foreach}
	{/foreach}
	</optgroup></select>
{/if}
</td></tr>
<tr><td valign="middle" align="right" width="40%">{$User_Group}&nbsp;2:</td><td class="dbTxt" valign="middle" align="left" width="60%">
{if $smarty.session.Username and ( $smarty.session.Username != $Root or $userID eq 1)}
	{$ADMINGROUP2}
{else}
	<select class="choice200" name="UserGroup2" title="{$User_Group}">
	<optgroup label="{$User_Group}" title="{$User_Group}">
	{foreach item=group from=$choose_group}
		{foreach key=key item=item from=$group}
			{if $USERGROUP2 and ( $USERGROUP2 eq $key)}
				<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
			{else}
				<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
			{/if}
		{/foreach}
	{/foreach}
	</optgroup></select>
{/if}
</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Language}:</td><td class="dbTxt" valign="middle" align="left" width="60%">
<select name="UserLanguage" class="choice200" title="{$Language}">
<optgroup label="{$Language}" title="{$Language}">
{foreach item=lang from=$choose_language}
	{foreach key=key item=item from=$lang}
		{if $LANGUAGE and ( $LANGUAGE eq $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup>
</select>
</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Password}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%"><input title="{$Password}" type="password" name="Password1" size="30" value="{$PASSWORD}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Repeat_Password}</b>:</td><td class="dbTxt" valign="middle" align="left" width="60%"><input title="{$Repeat_Password}" type="password" name="Password2" size="30" value="{$PASSWORD}" /></td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="userID" value="{$userID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
{if $infoID eq 9}
	<input type="hidden" name="UserActive_1" value="{$UserActive_1}" />
	<input type="hidden" name="FullName_1" value="{$FullName_1}" />
	<input type="hidden" name="UserName_1" value="{$UserName_1}" />
	<input type="hidden" name="UserGroup_1" value="{$UserGroup_1}" />
	<input type="hidden" name="UserLanguage_1" value="{$UserLanguage_1}" />
{/if}
<input type="submit" class="button" title="{$ChangeMsg}" value="{$ChangeMsg}" /></td></tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
