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
<form action="edit.php?{$Session}" method="post">
<input type="hidden" name="settingID" value="{$settingID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="D_Print_Company_Data" value="{$D_Print_Company_Data}" />
<input type="hidden" name="D_Print_Position_Name" value="{$D_Print_Position_Name}" />
<input type="hidden" name="D_Email_Internal" value="{$D_Email_Internal}" />
<input type="hidden" name="D_Email_Use_Signature" value="{$D_Email_Use_Signature}" />
<input type="hidden" name="D_Email_Signature" value="{$D_Email_Signature}" />
<input type="hidden" name="D_Reminder" value="{$D_Reminder}" />
<input type="hidden" name="D_Reminder_Days" value="{$D_Reminder_Days}" />
<input type="hidden" name="D_Entries_Per_Page" value="{$D_Entries_Per_Page}" />
<input type="hidden" name="D_Session_Sec" value="{$D_Session_Sec}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$BackMsg} - {$Settings} - {$Edit}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
