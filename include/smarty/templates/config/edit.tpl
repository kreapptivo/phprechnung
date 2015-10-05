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
	<body onload="document.Edit.D_Print_Company_Data.focus();">
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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Settings} - {$List}"
href="list.php?{$Session}">{$Settings}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Settings} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username != $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
{* Display basic settings information *}
<form id="Edit" name="Edit" action="editf.php?{$Session}" method="post">
<table width="80%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Settings} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
<tr><td align="center" colspan="2"><h2>{$Settings} - {$Edit}</h2></td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2">{$EntryNo} {$settingID}</td></tr>
<tr><td></td></tr>
<tr><td align="center" colspan="2">
<table width="80%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
<tr><td align="center">
[&nbsp;<a title="{$Basic_Settings}" class="nmenulink" href="edit.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Basic_Settings}</b></a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$Company_Settings}" class="nmenulink" href="edit_company.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Company_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$PDF_Settings}" class="nmenulink" href="edit_pdf.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$PDF_Settings}</a>&nbsp;]
</td></tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Print_Company_Data}:</td><td valign="middle" align="left" width="60%"><select title="{$Print_Company_Data}" class="choice200" name="D_Print_Company_Data">
<optgroup label="{$Print_Company_Data}" title="{$Print_Company_Data}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Print_Company_Data and ( $D_Print_Company_Data == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Print_Position_Name}:</td><td valign="middle" align="left" width="60%"><select title="{$Print_Position_Name}" class="choice200" name="D_Print_Position_Name">
<optgroup label="{$Print_Position_Name}" title="{$Print_Position_Name}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Print_Position_Name and ( $D_Print_Position_Name == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Email_Internal}:</td><td valign="middle" align="left" width="60%"><select title="{$Email_Internal}" class="choice200" name="D_Email_Internal">
<optgroup label="{$Email_Internal}" title="{$Email_Internal}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Email_Internal and ( $D_Email_Internal == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Email_Use_Signature}:</td><td valign="middle" align="left" width="60%"><select title="{$Email_Use_Signature}" class="choice200" name="D_Email_Use_Signature">
<optgroup label="{$Email_Use_Signature}" title="{$Email_Use_Signature}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Email_Use_Signature and ( $D_Email_Use_Signature == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="top" align="right" width="40%">{$Email_Signature}:</td><td valign="top" align="left" width="60%"><textarea title="{$Email_Signature}" class="form_textarea" name="D_Email_Signature" rows="7" cols="47">{$D_Email_Signature}</textarea></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Use_Reminder}:</td><td valign="middle" align="left" width="60%"><select title="{$Use_Reminder}" class="choice200" name="D_Reminder">
<optgroup label="{$Use_Reminder}" title="{$Use_Reminder}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Reminder and ( $D_Reminder == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Reminder_Days}:</td><td valign="middle" align="left" width="60%"><input title="{$Reminder_Days}" class="form_input" name="D_Reminder_Days" size="36" value="{$D_Reminder_Days}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Entries_Per_Page}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Entrys_Per_Page}" class="form_input" name="D_Entries_Per_Page" size="36" value="{$D_Entries_Per_Page}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Session_Sec}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Session_Sec}" class="form_input" name="D_Session_Sec" size="36" value="{$D_Session_Sec}" /></td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="settingID" value="{$settingID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$ChangeMsg}" value="{$ChangeMsg}" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
