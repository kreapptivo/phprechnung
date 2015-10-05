{*
	htable.tpl

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2008 Edy Corak < phprechnung at ecorak dot net >

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
<table class="phprechnung_sp_oben" border="0" width="100%" cellspacing="0" cellpadding="0" summary="Tabelle 1"><tbody>
<tr><td align="left" width="22%">
<table border="0" width="80%" cellspacing="0" cellpadding="0" summary="Tabelle 2"><tbody>
<tr><td id="td_navi1" align="center"><a accesskey="W" href="{$Web}/index.php?{$Session}">
<img border="0" src="{$Web}/images/phprechnung.png" title="{$Programname}" alt="{$Programname}" width="190" height="40" /></a></td>
<td id="td_navi2" align="center"><a accesskey="V" href="http://validator.w3.org/" target="_blank">
<img border="0" src="{$Web}/images/valid-xhtml10-blue.png" title="Valid XHTML 1.0 Transitional" alt="Valid XHTML 1.0 Transitional" width="88" height="31" /></a>
</td></tr></tbody></table></td>
<td align="right" width="78%">
{if $smarty.session.Username}
	{$Loggedin}:&nbsp;[&nbsp;<a title="{$Loggedin}: {$smarty.session.FullName} ({$smarty.session.Username}) - {$Hostname} ({$IPAddress})" class="ninfolink" href="{$Web}/user/info.php?userID={$smarty.session.UserID}&amp;{$Session}">{$smarty.session.Username}</a>&nbsp;],&nbsp;
{/if}{$Strftime}</td></tr></tbody></table><br />
