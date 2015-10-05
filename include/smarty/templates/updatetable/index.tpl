{*
	index.tpl

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
<body>
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="A" title="{$Addressbook}"
href="../addressbook/list.php?{$Session}">{$Addressbook}</a></td></tr>
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
<tr><td align="left" class="phprechnung_menu"><a accesskey="Y" title="{$Syslog}"
href="../syslog/list.php?{$Session}">{$Syslog}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a title="{$Programname} - {$License}"
href="../license.php?{$Session}">{$License}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sel"><a title="Update"
href="index.php?{$Session}">Update</a></td></tr>

</tbody></table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td class="phprechnung_tabelle" width="78%" valign="top" align="center">
<p>&nbsp;</p>
<h2>Update</h2>
<p>&nbsp;</p>

{* Update Login *}
{if $LOGINUPDATE eq 2}
	<p align="center">{$Welcome} {$Programname} - UPDATE</p>
	<p>&nbsp;</p>
	<form action="loginf.php?{$Session}" method="post">
	<p align="center"><input type="submit" class="button" title="Update Login" value="Update Login" /></p>
	</form>
{/if}

{* Update phpRechnung *}
{if $LOGINUPDATE eq 1 and $TABLEUPDATE eq 2}
	<p align="center">{$Welcome} {$Programname} - UPDATE</p>
	<p>&nbsp;</p>
	<form action="settingsf.php?{$Session}" method="post">
	<p align="center">
	<input type="submit" class="button" title="Update phpRechnung" value="Update phpRechnung" onclick="this.form.textfeld.value='{$Programname} UPDATE... Please wait, this can take some time.'" />
	<br />
	<br />
	<input class="form_input" type="text" name="textfeld" /><br />
	</p>
	</form>
{/if}

{* Display Congratulation message *}
{if $LOGINUPDATE eq 1 and $TABLEUPDATE eq 1}
	<p align="center">Congratulation, phpRechnung was succesfully updated.</p>
	<p>&nbsp;</p>
	<p align="center">After you change the Position/Article-Group manually, you can also Update saved article groups.</p>
	<p>&nbsp;</p>
	<form action="article_groupf.php?{$Session}" method="post">
	<p align="center"><input type="submit" class="button" title="Update Position/Article-Group" value="Update Position/Article-Group" /></p>
	</form>

{/if}

</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></tbody></table>
{include file="footer.tpl"}
