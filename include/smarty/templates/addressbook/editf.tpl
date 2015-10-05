{*
	editf.tpl

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
<p align="center" class="redtxt"><b>{$FieldError}</b></p>
<div align="center">
{if $EditForm eq 1}
	<form action="edit.php?{$Session}" method="post">
{elseif $EditForm eq 2}
	<form action="edit_e.php?{$Session}" method="post">
{elseif $EditForm eq 3}
	<form action="edit_a.php?{$Session}" method="post">
{else}
	<form action="edit.php?{$Session}" method="post">
{/if}
<input type="hidden" name="myID" value="{$myID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Prefix" value="{$Prefix}" />
<input type="hidden" name="Title1" value="{$Title1}" />
<input type="hidden" name="Firstname" value="{$Firstname}" />
<input type="hidden" name="Initials" value="{$Initials}" />
<input type="hidden" name="Lastname" value="{$Lastname}" />
<input type="hidden" name="Phonehome" value="{$Phonehome}" />
<input type="hidden" name="Salutation" value="{$Salutation}" />
<input type="hidden" name="Mobile" value="{$Mobile}" />
<input type="hidden" name="Address" value="{$Address}" />
<input type="hidden" name="Fax" value="{$Fax}" />
<input type="hidden" name="Stateprov" value="{$Stateprov}" />
<input type="hidden" name="Email" value="{$Email}" />
<input type="hidden" name="Postalcode" value="{$Postalcode}" />
<input type="hidden" name="City" value="{$City}" />
<input type="hidden" name="Url" value="{$Url}" />
<input type="hidden" name="Company" value="{$Company}" />
<input type="hidden" name="Phonework" value="{$Phonework}" />
<input type="hidden" name="Department" value="{$Department}" />
<input type="hidden" name="Phoneoffi" value="{$Phoneoffi}" />
<input type="hidden" name="Position1" value="{$Position1}" />
<input type="hidden" name="Phoneothe" value="{$Phoneothe}" />
<input type="hidden" name="Pager" value="{$Pager}" />
<input type="hidden" name="Note" value="{$Note}" />
<input type="hidden" name="Url2" value="{$Url2}" />
<input type="hidden" name="Email2" value="{$Email2}" />
<input type="hidden" name="AltField1" value="{$AltField1}" />
<input type="hidden" name="AltField2" value="{$AltField2}" />
<input type="hidden" name="Country" value="{$Country}" />
<input type="hidden" name="Birthday" value="{$Birthday}" />
<input type="hidden" name="Category" value="{$Category}" />
<input type="hidden" name="MethodOfPayment" value="{$MethodOfPayment}" />
<input type="hidden" name="Message" value="{$Message}" />
<input type="hidden" name="PrintName" value="{$PrintName}" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="hidden" name="BankName" value="{$BankName}" />
<input type="hidden" name="BankAccount" value="{$BankAccount}" />
<input type="hidden" name="BankNumber" value="{$BankNumber}" />
<input type="hidden" name="BankIban" value="{$BankIban}" />
<input type="hidden" name="BankBic" value="{$BankBic}" />
<input type="hidden" name="TaxFree" value="{$TaxFree}" />
<input type="hidden" name="Taxnr" value="{$Taxnr}" />
<input type="hidden" name="BusinessTaxnr" value="{$BusinessTaxnr}" />
<input type="hidden" name="UserActive" value="{$UserActive}" />
<input type="hidden" name="UserName" value="{$UserName}" />
<input type="hidden" name="UserLanguage" value="{$UserLanguage}" />
{if $infoID eq 10}
	{include file="addressbook/userinput.tpl"}
{/if}
<input type="submit" class="button" title="{$BackMsg} - {$Addressbook} - {$Edit}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
