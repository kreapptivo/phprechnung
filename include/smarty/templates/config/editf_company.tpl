{*
	editf_company.tpl

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
<form action="edit_company.php?{$Session}" method="post">
<input type="hidden" name="settingID" value="{$settingID}" />
<input type="hidden" name="page" value="{$page}" />
<input type="hidden" name="D_Company_Date" value="{$D_Company_Date}" />
<input type="hidden" name="D_Company_Name" value="{$D_Company_Name}" />
<input type="hidden" name="D_Company_Address" value="{$D_Company_Address}" />
<input type="hidden" name="D_Company_Postal" value="{$D_Company_Postal}" />
<input type="hidden" name="D_Company_City" value="{$D_Company_City}" />
<input type="hidden" name="D_Company_Country" value="{$D_Company_Country}" />
<input type="hidden" name="D_Company_Phone" value="{$D_Company_Phone}" />
<input type="hidden" name="D_Company_Fax" value="{$D_Company_Fax}" />
<input type="hidden" name="D_Company_Email" value="{$D_Company_Email}" />
<input type="hidden" name="D_Company_URL" value="{$D_Company_URL}" />
<input type="hidden" name="D_Company_WAP" value="{$D_Company_WAP}" />
<input type="hidden" name="D_Company_Currency" value="{$D_Company_Currency}" />
<input type="hidden" name="D_Company_Tax_Free" value="{$D_Company_Tax_Free}" />
<input type="hidden" name="D_Sales_Prices" value="{$D_Sales_Prices}" />
<input type="hidden" name="D_Company_Taxnr" value="{$D_Company_Taxnr}" />
<input type="hidden" name="D_Business_Taxnr" value="{$D_Business_Taxnr}" />
<input type="hidden" name="D_Bank_Name" value="{$D_Bank_Name}" />
<input type="hidden" name="D_Bank_Account" value="{$D_Bank_Account}" />
<input type="hidden" name="D_Bank_Number" value="{$D_Bank_Number}" />
<input type="hidden" name="D_Bank_IBAN" value="{$D_Bank_IBAN}" />
<input type="hidden" name="D_Bank_BIC" value="{$D_Bank_BIC}" />
<input type="hidden" name="mark" value="{$mark}" />
<input type="hidden" name="Order" value="{$Order}" />
<input type="hidden" name="Sort" value="{$Sort}" />
<input type="submit" class="button" title="{$BackMsg} - {$Settings} - {$Edit}" value="{$BackMsg}" /></form>
</div>
{include file="footer.tpl"}
