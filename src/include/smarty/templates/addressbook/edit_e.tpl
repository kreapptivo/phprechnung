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
	<body onload="document.Edit.Phonehome.focus();">
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
<form id="Edit" name="Edit" action="editf_e.php?{$Session}" method="post">
<table width="80%" class="phprechnung_tabelle" border="0" cellspacing="0" cellpadding="2" summary="Tabelle 1">
{* Display back button *}
<tr>
	<td valign="middle" align="left" colspan="2">
	{if $Type eq "Info"}
		[&nbsp;<a title="{$BackMsg} - {$Addressbook} - {$Extended_Info}" class="ninfolink" href="info_e.php?myID={$myID}&amp;infoID={$infoID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;Customer={$Customer}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
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
<tr><td></td></tr>
{if $MYID eq 0}
	<tr>
		<td align="center" colspan="2" class="redtxt">I'm Sorry, No Information Available.
		</td>
	</tr>
{/if}
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">
[&nbsp;<a title="{$Basic_Info}" class="nmenulink" href="edit.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Basic_Info}</a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Extended_Info}" class="nmenulink" href="edit_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Extended_Info}</b></a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Auth_Info}" class="nmenulink" href="edit_a.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type={$Type}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Auth_Info}</a>&nbsp;]
</td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td valign="middle" align="right" width="30%">{$Phonehome}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Phonehome" size="22" value="{$PHONEHOME}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Mobile}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Mobile" size="22" value="{$MOBILE}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Fax}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Fax" size="22" value="{$FAX}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Phonework}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Phonework" size="22" value="{$PHONEWORK}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Phoneoffi}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Phoneoffi" size="22" value="{$PHONEOFFI}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Phoneothe}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Phoneothe" size="22" value="{$PHONEOTHE}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Pager}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Pager" size="22" value="{$PAGER}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Email}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Email" size="22" value="{$EMAIL}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Email2}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Email2" size="22" value="{$EMAIL2}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Url}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Url" size="22" value="{$URL}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Url2}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="Url2" size="22" value="{$URL2}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$AltField1}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="AltField1" size="22" value="{$ALTFIELD1}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$AltField2}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="AltField2" size="22" value="{$ALTFIELD2}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Name}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Bank_Name" size="22" value="{$BANKNAME}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Account}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Bank_Account" size="22" value="{$BANKACCOUNT}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Number}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Bank_Number" size="22" value="{$BANKNUMBER}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Iban}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Bank_Iban" size="22" value="{$BANKIBAN}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Bic}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Bank_Bic" size="22" value="{$BANKBIC}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Tax_Free}:</td><td class="dbTxt" valign="top" align="left" width="70%">
<select disabled="disabled" class="choice200" name="D_Tax_Free" title="{$Tax_Free}">
<optgroup label="{$Tax_Free}" title="{$Tax_Free}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $TAX_FREE and ( $TAX_FREE == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select>
</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Tax_No}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Taxnr" size="22" value="{$TAXNR}" /></td></tr>
<tr><td valign="middle" align="right" width="30%">{$Business_Tax_No}:</td><td class="dbTxt" valign="top" align="left" width="70%"><input class="form_input" type="text" name="D_Business_Taxnr" size="22" value="{$BUSINESS_TAXNR}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="center" colspan="4">
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
