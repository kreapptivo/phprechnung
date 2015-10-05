{*
	info_e.tpl

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
<body onload="document.Report.DateFrom.focus();">
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
	[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type=Info&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Edit}</a>
	&nbsp;|&nbsp;<a title="{$Deleteentry}" class="nmenulink" href="delete.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Delete}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Offer} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../offer/new.php?myID={$MYID}&amp;{$Session}">{$Offer}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Invoice} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../invoice/new.php?myID={$MYID}&amp;{$Session}">{$Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Print} {$AllInformation} {$Customer_No} {$myID} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="print_info_pdf.php?myID={$MYID}&amp;{$Session}" target="_blank">{$Print}</a>&nbsp;]
	</td></tr>
{else}
	<tr><td align="center" colspan="2">
	[&nbsp;<a title="{$Editentry}" class="nmenulink" href="edit_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Type=Info&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Edit}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Offer} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../offer/new.php?myID={$MYID}&amp;{$Session}">{$Offer}</a>
	&nbsp;|&nbsp;<a title="{$Issue_Invoice} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="../invoice/new.php?myID={$MYID}&amp;{$Session}">{$Invoice}</a>
	&nbsp;|&nbsp;<a title="{$Print} {$AllInformation} {$Customer_No} {$myID} {$FIRSTNAME} {$LASTNAME} {$COMPANY}" class="nmenulink" href="print_info_pdf.php?myID={$MYID}&amp;{$Session}" target="_blank">{$Print}</a>&nbsp;]
	</td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
<tr><td align="center" colspan="2">
[&nbsp;<a title="{$Basic_Info}" class="nmenulink" href="info.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Basic_Info}</a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Extended_Info}" class="nmenulink" href="info_e.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}"><b>{$Extended_Info}</b></a>&nbsp;]
&nbsp;
[&nbsp;<a title="{$Auth_Info}" class="nmenulink" href="info_a.php?myID={$MYID}&amp;infoID={$infoID}&amp;page={$page}&amp;Customer={$Customer}{$Searchstring}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$Auth_Info}</a>&nbsp;]
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="30%">{$Phonehome}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PHONEHOME}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Mobile}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$MOBILE}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Fax}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$FAX}</td></tr>


<tr><td valign="top" align="right" width="30%">{$Phonework}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PHONEWORK}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Phoneoffi}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PHONEOFFI}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Phoneothe}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PHONEOTHE}</td></tr>
<tr><td valign="top" align="right" width="30%">{$Pager}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$PAGER}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="top" align="right" width="30%">{$Email}:</td>
<td class="dbTxt" valign="top" align="left" width="70%">
{if $EMAIL_INTERNAL eq 1}
	<a title="{$EMAIL}" class="ninfolink" href="email.php?myID={$myID}&amp;e_mailID=1&amp;infoID={$infoID}&amp;Customer={$Customer}{$Searchstring}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$EMAIL}</a>
{else}
	<a title="{$EMAIL}" class="ninfolink" href="mailto:{$EMAIL}">{$EMAIL}</a>
{/if}
</td></tr>
<tr><td valign="top" align="right" width="30%">{$Email2}:</td>
<td class="dbTxt" valign="top" align="left" width="70%">
{if $EMAIL_INTERNAL eq 1}
	<a title="{$EMAIL2}" class="ninfolink" href="email.php?myID={$myID}&amp;e_mailID=2&amp;infoID={$infoID}&amp;Customer={$Customer}{$Searchstring}&amp;page={$page}&amp;Order={$Order}&amp;Sort={$Sort}&amp;{$Session}">{$EMAIL2}</a>
{else}
	<a title="{$EMAIL2}" class="ninfolink" href="mailto:{$EMAIL2}">{$EMAIL2}</a>
{/if}
</td></tr>
<tr><td valign="top" align="right" width="30%">{$Url}:</td><td class="dbTxt" valign="top" align="left" width="70%"><a class="ninfolink" title="{$URL}" href="{$URL}" target="_blank">{$URL}</a></td></tr>
<tr><td valign="top" align="right" width="30%">{$Url2}:</td><td class="dbTxt" valign="top" align="left" width="70%"><a class="ninfolink" title="{$URL2}" href="{$URL2}" target="_blank">{$URL2}</a></td></tr>
<tr><td valign="top" align="right" width="30%">{$AltField1}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$ALTFIELD1}</td></tr>
<tr><td valign="top" align="right" width="30%">{$AltField2}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$ALTFIELD2}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Name}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BANKNAME}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Account}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BANKACCOUNT}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Number}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BANKNUMBER}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Iban}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BANKIBAN}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Bank_Bic}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BANKBIC}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Tax_Free}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$TAX_FREE}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Tax_No}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$TAXNR}</td></tr>
<tr><td valign="middle" align="right" width="30%">{$Business_Tax_No}:</td><td class="dbTxt" valign="top" align="left" width="70%">{$BUSINESS_TAXNR}</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="right" width="30%" valign="top">{$Reports}:</td>
<td nowrap="nowrap" valign="middle" align="left" width="70%">
<form id="FormReport" name="CReport" action="{$smarty.server.PHP_SELF}?{$Session}#Report" method="post">
<input type="hidden" name="page" value="{$page}" />
{include file="addressbook/userinput.tpl"}
<select class="choice250" name="Report" title="{$Select_Report}" onchange="this.form.submit();">
<optgroup label="{$Reports}" title="{$Reports}">
<option label="{$Select_Report}" title="{$Select_Report}"  value="">--- {$Select_Report} ---</option>
{foreach item=reports from=$choose_customer_report}
	{foreach key=key item=item from=$reports}
		{if $Report === $key}
			<option label="{$item}" title="{$item}" value="{$key}" selected="selected">{$item}</option>
		{else}
			<option label="{$item}" title="{$item}" value="{$key}">{$item}</option>
		{/if}
	{/foreach}
{/foreach}
</optgroup></select>
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="DateFrom" value="{$DateFrom}" />
<input type="hidden" name="DateTill" value="{$DateTill}" />
<input type="hidden" name="myID" value="{$myID}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="paymentID" value="{$paymentID}" />
<input type="hidden" name="tmpinvoiceID" value="1" />
<input type="hidden" name="new_offerID" value="{$new_offerID}" />
<input type="hidden" name="messageID" value="{$messageID}" />
<input type="hidden" name="offerID" value="{$offerID}" />
<input type="hidden" name="tmpofferID" value="1" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
{if $infoID eq 10}
	{include file="addressbook/userinput.tpl"}
{/if}
</form>
</td></tr>

{if $Report}
	<form id="Report" name="Report" action="{$Report}?{$Session}" method="post">
	<input type="hidden" name="Report" value="{$Report}" />
	<input type="hidden" name="myID" value="{$myID}" />
	<input type="hidden" name="infoID" value="{$infoID}" />
	<input type="hidden" name="invoiceID" value="{$invoiceID}" />
	<input type="hidden" name="paymentID" value="{$paymentID}" />
	<input type="hidden" name="tmpinvoiceID" value="1" />
	<input type="hidden" name="new_offerID" value="{$new_offerID}" />
	<input type="hidden" name="messageID" value="{$messageID}" />
	<input type="hidden" name="offerID" value="{$offerID}" />
	<input type="hidden" name="tmpofferID" value="1" />
	<input type="hidden" name="Customer" value="{$Customer}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	{if $infoID eq 10}
		{include file="addressbook/userinput.tpl"}
	{/if}
	<tr><td valign="middle" align="right" width="30%">{$DateMsg} {$Date_From}:</td><td align="left" width="70%" valign="middle"><input title="{$DateMsg} {$Date_From}" class="form_input" type="text" name="DateFrom" size="30" value="{if $DateFrom}{$DateFrom}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td></tr>
	<tr><td valign="middle" align="right" width="30%">{$DateMsg} {$Date_Till}:</td><td align="left" width="70%" valign="middle"><input title="{$DateMsg} {$Date_Till}" class="form_input" type="text" name="DateTill" size="30" value="{if $DateTill}{$DateTill}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td></tr>
	<tr><td align="center" colspan="2" width="100%"><input class="button" type="submit" title="{$Search}" value="{$Search}" />
	<a name="Report" id="Report"></a>
	</td></tr>
	</form>
{/if}
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
</tbody></table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
