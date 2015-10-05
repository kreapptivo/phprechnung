{*
	new.tpl

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
	<body onload="document.New.{$mark}.focus();">
{else}
	<body onload="document.New.Pos_Name.focus();">
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="P" title="{$Position} - {$List}"
href="list.php?{$Session}">{$Position}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="1" title="{$Position} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Position} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Position} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
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
{* Display input fields to add new positions *}
<form id="New" name="New" action="newf.php?{$Session}" method="post">
<table width="60%" border="0" class="phprechnung_tabelle" cellspacing="3" cellpadding="3" summary="Tabelle 2">
{if $infoID == 9}
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Position} - {$Searchresult}" class="ninfolink" href="searchlist.php?page={$page}&amp;{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
{else}
<tr>
	<td valign="middle" align="left" colspan="2">
	[&nbsp;<a title="{$BackMsg} - {$Position} - {$List}" class="ninfolink" href="list.php?page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
	</td>
</tr>
{/if}
<tr><td align="center" colspan="2"><h2>{$Position} - {$New}</h2></td></tr>
{if $smarty.session.NewID and ( $smarty.session.NewID eq 1 )}
	<tr><td align="center" colspan="2" class="greentxt">{$NewEntry} {$EntryNo} {$PositionID}</td></tr>
{/if}
<tr><td></td></tr>
<tr><td align="center" colspan="2" class="dbTxt">[ {$EntryNo} {$PositionID+1} ]</td></tr>
<tr><td></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PositionName}</b>:</td><td valign="top" align="left" width="60%"><input title="{$PositionName}" class="form_input" name="Pos_Name" size="39" value="{$Pos_Name}" /></td></tr>
<tr><td valign="top" align="right" width="40%"><b>{$PositionText}</b>:</td><td valign="top" align="left" width="60%"><textarea title="{$PositionText}" class="form_textarea" name="Pos_Desc" rows="3" cols="37">{$Pos_Desc}</textarea></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PositionPrice} {$Currency}</b>:</td><td valign="top" align="left" width="60%"><input title="{$PositionPrice} {$Currency}" class="form_input" name="Pos_Price" size="39" value="{$Pos_Price}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Tax}</b>&nbsp;[&nbsp;<a class="nlink" title="{$Tax} - {$Info}" href="../tax/list.php?{$Session}">&nbsp;i&nbsp;</a>&nbsp;]&nbsp;:</td>
<td valign="top" align="left" width="60%">
<select title="{$Tax}" name="Pos_Tax" class="choice250">
<optgroup title="{$Tax}" label="{$Tax}">
{foreach from=$TaxArray item=tax}
	{if $Pos_Tax and ( $Pos_Tax eq $tax.TAXID)}
		<option title="{$tax.TAX_DESC}" label="{$tax.TAX_DESC}" value="{$tax.TAXID}" selected="selected">{$tax.TAX_DESC}</option>
	{else}
		<option title="{$tax.TAX_DESC}" label="{$tax.TAX_DESC}" value="{$tax.TAXID}">{$tax.TAX_DESC}</option>
	{/if}
{/foreach}
</optgroup>
</select></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PositionGroup}</b>&nbsp;[&nbsp;<a class="nlink" title="{$PositionGroupSub} - {$Info}" href="../posgroup/list.php?{$Session}">&nbsp;i&nbsp;</a>&nbsp;]&nbsp;:</td>
<td valign="top" align="left" width="60%">
<select title="{$PositionGroup}" name="PosGroupID" class="choice250">
<optgroup title="{$PositionGroup}" label="{$PositionGroup}">
{foreach from=$PosGroupArray item=posgroup}
	{if $PosGroupID and ( $PosGroupID eq $posgroup.POSGROUPID)}
		<option title="{$posgroup.DESCRIPTION}" label="{$posgroup.DESCRIPTION}" value="{$posgroup.POSGROUPID}" selected="selected">{$posgroup.DESCRIPTION}</option>
	{else}
		<option title="{$posgroup.DESCRIPTION}" label="{$posgroup.DESCRIPTION}" value="{$posgroup.POSGROUPID}">{$posgroup.DESCRIPTION}</option>
	{/if}
{/foreach}
</optgroup>
</select></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$PositionActive}</b>:</td><td valign="top" align="left" width="60%"><select title="{$PositionActive}" name="Pos_Active" class="choice250">
<optgroup title="{$PositionActive}" label="{$PositionActive}">
{foreach item=pos_active from=$pos_active_values}
	{foreach key=key item=item from=$pos_active}
		{if $Pos_Active and ( $Pos_Active == $key)}
			<option title="{$item}" label="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option title="{$item}" label="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup>
</select></td></tr>
<tr><td valign="top" align="right" width="40%">{$NoteMsg}:</td><td valign="top" align="left" width="60%"><textarea title="{$NoteMsg}" class="form_textarea" name="Note" rows="5" cols="37">{$Note}</textarea></td></tr>
<tr><td></td></tr>
<tr><td valign="top" align="center" colspan="2">
<input type="hidden" name="posID" value="{$posID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
{if $infoID eq 9}
	<input type="hidden" name="Pos_Name1" value="{$Pos_Name1}" />
	<input type="hidden" name="Pos_Desc1" value="{$Pos_Desc1}" />
	<input type="hidden" name="Pos_Price1" value="{$Pos_Price1}" />
	<input type="hidden" name="Note1" value="{$Note1}" />
	<input type="hidden" name="Pos_Active1" value="{$Pos_Active1}" />
{/if}
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$InsertMsg}" value="{$InsertMsg}" /></td></tr>
</table>
</form>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
