{*
	posedit.tpl

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
<body onload="document.PosEdit.PosID.focus();">
{include file="htable.tpl"}
<table border="0" width="100%" cellspacing="0" cellpadding="0" summary="Tabelle 3">
<tr><td id="td1_20" width="20%" valign="top">
{* Menubar start *}
<table border="0" width="80%" cellspacing="0" cellpadding="0" summary="Tabelle 4">
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
<tr><td align="left" class="phprechnung_menu_sel"><a accesskey="I" title="{$Invoice} - {$List}"
href="list.php?{$Session}">{$Invoice}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="1" title="{$Invoice} - {$New}"
href="new.php?{$Session}">{$New}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="2" title="{$Invoice} - {$Search}"
href="search.php?{$Session}">{$Search}</a></td></tr>
<tr><td align="left" class="phprechnung_menu_sub"><a accesskey="3" title="{$Invoice} - {$Help}"
href="help.php?{$Session}">{$Help}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="M" title="{$Payment}"
href="../payment/list.php?{$Session}">{$Payment}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="C" title="{$Cashbook}"
href="../cashbook/list.php?{$Session}">{$Cashbook}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="R" title="{$Reports}"
href="../reports/index.php?{$Session}">{$Reports}</a></td></tr>
<tr><td align="left" class="phprechnung_menu"><a accesskey="S" title="{$Configuration}"
href="../configuration.php?{$Session}">{$Configuration}</a></td></tr>
{if $smarty.session.Username and ( $smarty.session.Username neq $Root )}
	<tr><td align="left" class="phprechnung_menu"><a accesskey="U" title="{$Superuser}"
	href="../login/sustart.php?{$Session}">{$Superuser}</a></td></tr>
{/if}
</table></td>
{* Menubar end *}
<td id="td1_2" width="2%"></td><td width="78%" valign="top" align="center">
	<table width="80%" border="0" cellpadding="2" cellspacing="0" summary="Tabelle 1">
	<tr>
		<td class="phprechnung_tabelle">
			<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 2">
			<tr>
				<td valign="middle" align="left" colspan="2">
				{if $invoiceID}
					[&nbsp;<a title="{$BackMsg} - {$Invoice} - {$Edit}" class="ninfolink" href="edit.php?myID={$myID}&amp;page={$page}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;InvoiceDate={$InvoiceDate}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Searchstring}&amp;{$Session}">{$BackMsg}</a>&nbsp;]
				{else}
					[&nbsp;<a title="{$BackMsg} - {$Invoice} - {$New}" class="ninfolink" href="new.php?myID={$myID}&amp;page={$page}&amp;invoiceID={$invoiceID}&amp;infoID={$infoID}&amp;messageID={$messageID}&amp;InvoiceDate={$InvoiceDate}&amp;MethodOfPayment={$MethodOfPayment}&amp;MethodOfPaymentDate={$MethodOfPaymentDate}&amp;Note={$Note}&amp;Order={$Order}&amp;Sort={$Sort}&amp;tmpID=1&amp;Canceled={$Canceled}{$Session}">{$BackMsg}</a>&nbsp;]
				{/if}
				</td>
				</tr>
				<tr>
					<td align="center" colspan="2"><h2>{$Position} - {$Edit}</h2>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top" width="30%">{$PositionName}:
					</td>
					<td align="left" valign="middle" width="70%">
					<form id="PosEdit" name="PosEdit" action="poslist.php?{$Session}" method="post">
					<input type="hidden" name="myID" value="{$myID}" />
					<input type="hidden" name="invoiceID" value="{$invoiceID}" />
					<input type="hidden" name="infoID" value="{$infoID}" />
					<input type="hidden" name="tmpID" value="1" />
					<input type="hidden" name="messageID" value="{$messageID}" />
					<input type="hidden" name="InvoiceDate" value="{$InvoiceDate}" />
					<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
					<input type="hidden" name="MethodOfPaymentDate" value="{$MethodOfPaymentDate}" />
					<input type="hidden" name="Note" value="{$Note}" />
					<input type="hidden" name="Pos_Quantity" value="{$POS_QUANTITY}" />
					<input type="hidden" name="TMP_InvoiceID" value="1" />
					<input type="hidden" name="tmpPosID" value="{$tmpPosID}" />
					{if $infoID eq 9}
						<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
						<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
						<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
						<input type="hidden" name="DateTill1" value="{$DateTill1}" />
						<input type="hidden" name="Total1" value="{$Total1}" />
						<input type="hidden" name="Customer1" value="{$Customer1}" />
					{/if}
					<input type="hidden" name="page" value="{$page}" />
					<input type="hidden" name="Order" value="{$Order}" />
					<input type="hidden" name="Sort" value="{$Sort}" />
					<input type="hidden" name="Canceled" value="{$Canceled}" />
					<input class="form_input" type="text" name="PosID" size="40" title="{$PositionSearch}" value="{$POS_NAME}" />&nbsp;<input class="button" type="submit" title="{$PositionChoose}" value="{$Search}" />
					</form>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 3">
				<tr>
					<td>
					<form action="poseditf.php?{$Session}" method="post">
					<input type="hidden" name="myID" value="{$myID}" />
					<input type="hidden" name="invoiceID" value="{$invoiceID}" />
					<input type="hidden" name="infoID" value="{$infoID}" />
					<input type="hidden" name="tmpID" value="1" />
					<input type="hidden" name="messageID" value="{$messageID}" />
					<input type="hidden" name="InvoiceDate" value="{$InvoiceDate}" />
					<input type="hidden" name="MethodOfPayment" value="{$NR_METHOD_OF_PAYMENT}" />
					<input type="hidden" name="MethodOfPaymentDate" value="{$MethodOfPaymentDate}" />
					<input type="hidden" name="Note" value="{$Note}" />
					<input type="hidden" name="Pos_Quantity" value="{$POS_QUANTITY}" />
					<input type="hidden" name="tmpPosID" value="{$tmpPosID}" />
					{if $infoID eq 9}
						<input type="hidden" name="InvoiceID1" value="{$InvoiceID1}" />
						<input type="hidden" name="CustomerID1" value="{$CustomerID1}" />
						<input type="hidden" name="DateFrom1" value="{$DateFrom1}" />
						<input type="hidden" name="DateTill1" value="{$DateTill1}" />
						<input type="hidden" name="Total1" value="{$Total1}" />
						<input type="hidden" name="Customer1" value="{$Customer1}" />
					{/if}
					<input type="hidden" name="page" value="{$page}" />
					<input type="hidden" name="Order" value="{$Order}" />
					<input type="hidden" name="Sort" value="{$Sort}" />
					<input type="hidden" name="Canceled" value="{$Canceled}" />
					<input type="hidden" name="PosID" value="{$PosID}" />
					<input type="hidden" name="Pos_Group" value="{$POS_GROUP}" />
					<input type="hidden" name="Pos_Tax" value="{$POS_TAX}" />
					<input type="hidden" name="Pos_Tax_Multi" value="{$POS_TAX_MULTI}" />
					<input type="hidden" name="Pos_Tax_Divide" value="{$POS_TAX_DIVIDE}" />
					<input type="hidden" name="Pos_Tax_Desc" value="{$POS_TAX_DESC}" />
					<table width="100%" border="0" cellspacing="3" cellpadding="3" summary="Tabelle 4">
						<tr>
							<td align="right" valign="top" width="30%">{$PositionText}:
							</td>
							<td align="left" valign="middle" width="70%"><textarea title="{$PositionText}" class="form_textarea" name="Pos_Desc" rows="5" cols="37">{$POS_DESC}</textarea>
							</td>
						</tr>
						<tr>
							<td align="right" valign="middle" width="30%">{$PositionQuantity}:
							</td>
							<td align="left" valign="top" width="70%"><input title="{$PositionQuantity}" class="form_input" name="Pos_Quantity" size="30" value="{$POS_QUANTITY}" />
							</td>
						</tr>
						<tr>
							<td align="right" valign="middle" width="30%">{$PositionPrice} {$Currency}:
							</td>
							<td align="left" valign="middle" width="70%"><input title="{$PositionPrice} {$Currency}" class="form_input" name="Pos_Price" size="30" value="{$POS_PRICE}" />
							</td>
						</tr>
						<tr>
							<td align="center" valign="top" colspan="2">
							<input class="button" type="submit" name="OK" title="{$ChangeMsg} - {$Invoice}" value="{$ChangeMsg}" />
							</td>
						</tr>
					</table>
					</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</td></tr>
<tr><td id="td2_20" width="20%"><br /></td><td id="td2_2" width="2%"></td>
<td width="78%" valign="top"><br /></td></tr></table>
{include file="footer.tpl"}
