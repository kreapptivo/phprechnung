{*
	cancelf.tpl

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
<form action="cancel.php?{$Session}" method="post">
<input type="hidden" name="cashbookID" value="{$cashbookID}" />
<input type="hidden" name="invoiceID" value="{$invoiceID}" />
<input type="hidden" name="paymentID" value="{$paymentID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
{if $infoID eq 9}
	<input type="hidden" name="CashbookNo_1" value="{$CashbookNo_1}" />
	<input type="hidden" name="DateFrom_1" value="{$DateFrom_1}" />
	<input type="hidden" name="DateTill_1" value="{$DateTill_1}" />
	<input type="hidden" name="Takings_1" value="{$Takings_1}" />
	<input type="hidden" name="Expenditures_1" value="{$Expenditures_1}" />
	<input type="hidden" name="Description_1" value="{$Description_1}" />
{/if}
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="Canceled" value="{$Canceled}" />
<input type="submit" class="button" title="{$BackMsg} - {$Cashbook} - {$Cancel}" value="{$BackMsg}" ></form>
</div>
{include file="footer.tpl"}
