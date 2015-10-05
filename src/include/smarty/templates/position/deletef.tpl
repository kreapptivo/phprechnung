{*
	deletef.tpl

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
{if $infoID == 9}
	<form action="searchlist.php?{$Session}#{$posID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="infoID" value="{$infoID}" />
	<input type="hidden" name="Pos_Name1" value="{$Pos_Name1}" />
	<input type="hidden" name="Pos_Desc1" value="{$Pos_Desc1}" />
	<input type="hidden" name="Pos_Price1" value="{$Pos_Price1}" />
	<input type="hidden" name="Note1" value="{$Note1}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Pos_Active1" value="{$Pos_Active1}" />
	<input type="submit" class="button" title="{$BackMsg} - {$Position} - {$Searchresult}" value="{$BackMsg} - {$Position} - {$Searchresult}" /></form>
{else}
	<form action="list.php?{$Session}#{$posID}" method="post">
	<input type="hidden" name="page" value="{$page}" />
	<input type="hidden" name="infoID" value="{$infoID}" />
	<input type="hidden" name="Order" value="{$Order}" />
	<input type="hidden" name="Sort" value="{$Sort}" />
	<input type="hidden" name="Pos_Active1" value="{$Pos_Active1}" />
	<input type="submit" class="button" title="{$BackMsg} - {$Position} - {$List}" value="{$BackMsg} - {$Position} - {$List}" /></form>
{/if}
</div>
{include file="footer.tpl"}
