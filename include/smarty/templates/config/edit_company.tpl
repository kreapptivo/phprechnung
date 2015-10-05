{*
	edit_company.tpl

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
	<body onload="document.Edit.D_Company_Date.focus();">
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
{* Display Company information *}
<form id="Edit" name="Edit" action="editf_company.php?{$Session}" method="post">
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
[&nbsp;<a title="{$Basic_Settings}" class="nmenulink" href="edit.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Basic_Settings}</a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$Company_Settings}" class="nmenulink" href="edit_company.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Company_Settings}</b></a>&nbsp;]
</td>
<td align="center">
[&nbsp;<a title="{$PDF_Settings}" class="nmenulink" href="edit_pdf.php?settingID={$settingID}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$PDF_Settings}</a>&nbsp;]
</td></tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$DateMsg}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$DateMsg}" class="form_input" name="D_Company_Date" size="39" value="{$D_Company_Date}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Name}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Name}" class="form_input" name="D_Company_Name" size="39" value="{$D_Company_Name}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Address}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Address}" class="form_input" name="D_Company_Address" size="39" value="{$D_Company_Address}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Postal}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Postal}" class="form_input" name="D_Company_Postal" size="39" value="{$D_Company_Postal}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_City}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_City}" class="form_input" name="D_Company_City" size="39" value="{$D_Company_City}" /></td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Country}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Country}" class="form_input" name="D_Company_Country" size="39" value="{$D_Company_Country}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Company_Phone}:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Phone}" class="form_input" name="D_Company_Phone" size="39" value="{$D_Company_Phone}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Company_Fax}:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Fax}" class="form_input" name="D_Company_Fax" size="39" value="{$D_Company_Fax}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Company_Email}:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Email}" class="form_input" name="D_Company_Email" size="39" value="{$D_Company_Email}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Company_URL}:</td><td valign="middle" align="left" width="60%"><input title="{$Company_URL}" class="form_input" name="D_Company_URL" size="39" value="{$D_Company_URL}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%"><b>{$Company_Currency}</b>:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Currency}" class="form_input" name="D_Company_Currency" size="39" value="{$D_Company_Currency}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Company_Tax_Free}:</td><td valign="middle" align="left" width="60%"><select title="{$Company_Tax_Free}" class="choice200" name="D_Company_Tax_Free">
<optgroup label="{$Company_Tax_Free}" title="{$Company_Tax_Free}">
{foreach item=yes_no from=$choice_yes_no}
	{foreach key=key item=item from=$yes_no}
		{if $D_Company_Tax_Free and ( $D_Company_Tax_Free == $key)}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Sales_Prices}:</td>
{if $InvoiceAvailable and ($InvoiceAvailable eq 1)}
	<td class="dbTxt" valign="top" align="left" width="60%">{$DisplaySalesPrice}</td>
{else}
	<td valign="middle" align="left" width="60%"><select title="{$Sales_Prices}" name="D_Sales_Prices" class="choice200">
	<optgroup label="{$Sales_Prices}" title="{$Sales_Prices}">
	{foreach item=sales_price from=$sales_price_values}
		{foreach key=key item=item from=$sales_price}
			{if $D_Sales_Prices and ( $D_Sales_Prices == $key)}
				<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
			{else}
				<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
			{/if}
		{/foreach}
	{/foreach}
	</optgroup></select></td>
{/if}
</tr>
<tr><td valign="middle" align="right" width="40%">{$Company_Taxnr}:</td><td valign="middle" align="left" width="60%"><input title="{$Company_Taxnr}" class="form_input" name="D_Company_Taxnr" size="39" value="{$D_Company_Taxnr}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Business_Taxnr}:</td><td valign="middle" align="left" width="60%"><input title="{$Business_Taxnr}" class="form_input" name="D_Business_Taxnr" size="39" value="{$D_Business_Taxnr}" /></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="40%">{$Bank_Name}:</td><td valign="middle" align="left" width="60%"><input title="{$Bank_Name}" class="form_input" name="D_Bank_Name" size="39" value="{$D_Bank_Name}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Bank_Account}:</td><td valign="middle" align="left" width="60%"><input title="{$Bank_Account}" class="form_input" name="D_Bank_Account" size="39" value="{$D_Bank_Account}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Bank_Number}:</td><td valign="middle" align="left" width="60%"><input title="{$Bank_Number}" class="form_input" name="D_Bank_Number" size="39" value="{$D_Bank_Number}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Bank_IBAN}:</td><td valign="middle" align="left" width="60%"><input title="{$Bank_IBAN}" class="form_input" name="D_Bank_IBAN" size="39" value="{$D_Bank_IBAN}" /></td></tr>
<tr><td valign="middle" align="right" width="40%">{$Bank_BIC}:</td><td valign="middle" align="left" width="60%"><input title="{$Bank_BIC}" class="form_input" name="D_Bank_BIC" size="39" value="{$D_Bank_BIC}" /></td></tr>
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
