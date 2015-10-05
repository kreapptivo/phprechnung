{*
	newf.tpl

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
<form action="new.php?{$Session}" method="post">
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="prefix" value="{$prefix}" />
<input type="hidden" name="title" value="{$title}" />
<input type="hidden" name="firstname" value="{$firstname}" />
<input type="hidden" name="initials" value="{$initials}" />
<input type="hidden" name="lastname" value="{$lastname}" />
<input type="hidden" name="phonehome" value="{$phonehome}" />
<input type="hidden" name="salutation" value="{$salutation}" />
<input type="hidden" name="mobile" value="{$mobile}" />
<input type="hidden" name="address" value="{$address}" />
<input type="hidden" name="fax" value="{$fax}" />
<input type="hidden" name="stateprov" value="{$stateprov}" />
<input type="hidden" name="email" value="{$email}" />
<input type="hidden" name="postalcode" value="{$postalcode}" />
<input type="hidden" name="city" value="{$city}" />
<input type="hidden" name="url" value="{$url}" />
<input type="hidden" name="company" value="{$company}" />
<input type="hidden" name="phonework" value="{$phonework}" />
<input type="hidden" name="department" value="{$department}" />
<input type="hidden" name="phoneoffi" value="{$phoneoffi}" />
<input type="hidden" name="position" value="{$position}" />
<input type="hidden" name="phoneothe" value="{$phoneothe}" />
<input type="hidden" name="pager" value="{$pager}" />
<input type="hidden" name="note" value="{$note}" />
<input type="hidden" name="altfield1" value="{$altfield1}" />
<input type="hidden" name="altfield2" value="{$altfield2}" />
<input type="hidden" name="url2" value="{$url2}" />
<input type="hidden" name="email2" value="{$email2}" />
<input type="hidden" name="country" value="{$country}" />
<input type="hidden" name="birthday" value="{$birthday}" />
<input type="hidden" name="category" value="{$category}" />
<input type="hidden" name="methodofpayment" value="{$methodofpayment}" />
<input type="hidden" name="message" value="{$message}" />
<input type="hidden" name="printname" value="{$printname}" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="hidden" name="bankname" value="{$bankname}" />
<input type="hidden" name="bankaccount" value="{$bankaccount}" />
<input type="hidden" name="banknumber" value="{$banknumber}" />
<input type="hidden" name="bankiban" value="{$bankiban}" />
<input type="hidden" name="bankbic" value="{$bankbic}" />
<input type="hidden" name="taxfree" value="{$taxfree}" />
<input type="hidden" name="taxnr" value="{$taxnr}" />
<input type="hidden" name="businesstaxnr" value="{$businesstaxnr}" />
<input type="hidden" name="useractive" value="{$useractive}" />
<input type="hidden" name="username" value="{$username}" />
<input type="hidden" name="userlanguage" value="{$userlanguage}" />
<input type="submit" class="button" title="{$BackMsg} - {$Addressbook} - {$New}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
