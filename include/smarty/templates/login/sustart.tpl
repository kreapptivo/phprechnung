{*
	sustart.tpl

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
{include file="header.tpl"}
<body onload="document.Login.Password.focus();">
{include file="htable.tpl"}
<p>&nbsp;</p>
{if $smarty.session.logoutid and ( $smarty.session.logoutid eq "5" )}
	<p align="center">{$AccessDeniedMsg}</p>
{/if}
{if $smarty.session.UserSite}
		<p align="center">[&nbsp;<a class="nmenulink" title="{$BackMsg}" href="{$smarty.session.UserSite}">{$BackMsg}</a>&nbsp;]</p>
{else}
		<p align="center">[&nbsp;<a class="nmenulink" title="{$Startpage}" href="../index.php?{$Session}">{$Startpage}</a>&nbsp;]</p>
{/if}
<form id="anmeldung" name="Login" action="sustartf.php?{$Session}" method="post">
<table width="60%" border="0" class="phprechnung_tabelle_g" cellspacing="3" cellpadding="3" summary="Tabelle 2"><tbody>
<tr class="mblueTD"><td align="center" colspan="2">{$LoginMsg}</td></tr>
{if $smarty.session.logoutid and ( $smarty.session.logoutid eq "2" )}
	<tr><td align="center" colspan="2">{$LoginErrMsg}</td></tr>
{/if}
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td align="right" width="40%">{$Superuser} {$Password}:</td><td  align="left" width="60%"><input type="password" name="Password" size="30" /></td></tr>
<tr><td></td></tr>
<tr><td align="center"><input type="submit" class="button" title="{$Login}" value="{$Login}" /></td>
<td align="center"><input type="reset" class="button" title="{$Delete}" value="{$Delete}" /></td></tr>
<tr><td></td></tr>
</tbody></table></form>
{include file="footer.tpl"}
