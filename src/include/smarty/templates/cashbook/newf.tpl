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
<body>
{include file="htable.tpl"}
<p align="center" class="redtxt"><b>{$FieldError}</b></p>
<div align="center">
<form action="new.php?{$Session}" method="post">
<input type="hidden" name="cashbookID" value="{$cashbookID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="cashbookdate" value="{$cashbookdate}" />
<input type="hidden" name="startingwith" value="{$startingwith}" />
<input type="hidden" name="takings" value="{$takings}" />
<input type="hidden" name="expenditures" value="{$expenditures}" />
<input type="hidden" name="description" value="{$description}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="submit" class="button" title="{$BackMsg} - {$Cashbook} - {$New}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
