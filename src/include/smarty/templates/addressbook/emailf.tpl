{*
	emailf.tpl

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
<form action="email.php?{$Session}" method="post">
<input type="hidden" name="myID" value="{$myID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="infoID" value="{$infoID}" />
<input type="hidden" name="e_mailID" value="{$e_mailID}" />
<input type="hidden" name="EmailTo" value="{$EmailTo}" />
<input type="hidden" name="EmailCc" value="{$EmailCc}" />
<input type="hidden" name="EmailBcc" value="{$EmailBcc}" />
<input type="hidden" name="EmailSubject" value="{$EmailSubject}" />
<input type="hidden" name="EmailPriority" value="{$EmailPriority}" />
<input type="hidden" name="EmailText" value="{$EmailText}" />
<input type="hidden" name="Customer" value="{$Customer}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="hidden" name="mark" value="{$mark}" />
{if $infoID eq 10}
	{include file="addressbook/userinput.tpl"}
{/if}
<input type="submit" class="button" title="{$BackMsg} - {$Addressbook} - {$Email}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
