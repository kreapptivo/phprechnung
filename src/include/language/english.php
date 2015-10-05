<?php

/*
	english.php

	phpInvoice - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	ISO-8859-15

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
*/

// Language definition - Englisch
//

$a = array (
	"welcome" => "Welcome to",
	"programname" => "phpRechnung 1.6.4",
	"phprechnung" => "phpRechnung 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpRechnung Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. All rights reserved.",

	"admin" => "Administrator",

	"language" => "Language",
	"choose_language" => "Choose your language",


	// Linkbar
	//
	"logout" => "Logout",
	"startpage" => "Startpage",
	"addressbook" => "Addressbook",
	"position" => "Position",
	"offer" => "Offer",
	"invoice" => "Invoice",
	"credit_note" => "Credit note",
	"payment" => "Payment",
	"cashbook" => "Cash book",
	"reports" => "Reports",
	"configuration" => "Configuration",
	"message" => "Message",
	"method_of_payment" => "Method of payment",
	"category" => "Category",
	"tax" => "Tax",
	"tax_short" => "Tax",
	"settings" => "Settings",
	"user_admin" => "User administration",
	"super_user" => "Super User",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "List",
	"new" => "New",
	"search" => "Search",
	"detail_search" => "Detail search",
	"searchresult" => "Search result",
	"help" => "Help",

	"info" => "Info",
	"all_info" => "All information about",


	// Actions
	//
	"insert" => "Insert",
	"save" => "Save",
	"edit" => "Edit",
	"edit_entry" => "Edit entry",
	"change" => "Change",
	"delete" => "Delete",
	"delete_entry" => "Delete entry",
	"cancel" => "Cancel",
	"cancel_entry" => "Cancel entry",
	"copy" => "Copy",
	"copy_entry" => "Copy entry",

	"print" => "Print",
	"sort" => "Sort by",
	"choose" => "Choose",
	"close" => "Close",
	"close_window" => "Close window",
	"choose_message" => "Choose message",
	"back" => "Back",
	"next" => "Next",
	"accept" => "Accept",


	// Generally
	//
	"date_text" => "Date",
	"number_text" => "Number",

	"page" => "Page",
	"firstpage" => "First page",
	"prevpage" => "Previous page",
	"nextpage" => "Next page",
	"lastpage" => "Last page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Entry",
	"no_entry" => "No Entry.",
	"entry_no" => "Entry-No.",
	"entries" => "Entries",

	"new_entry" => "New entry added.",
	"entry_exist" => "Entry already exists.",
	"entry_changed" => "Entry was changed.",
	"entry_deleted" => "Entry was deleted.",
	"entry_not_deleted" => "Entry was not deleted.",
	"entry_canceled" => "Entry was canceled.",
	"entry_not_canceled" => "Entry was not canceled.",

	"field_error" => "Field filled in is incorrect.",

	"invoice_issued" => "For this entry a invoice / offer was issued.",
	"payment_issued" => "For this invoice a payment was issued.<br />
		To change the invoice, you must delete the payment first.",
	"position_used" => "This position is used in invoices / offers.",
	"offer_used" => "For this offer a invoice was already issued.<br />
		In order to change the offer, you must delete the invoice first.",

	"invalid_date" => "Date incorrect. Please check your entry. e. g. 01.01.1970",


	// Login
	//
	"login_title" => "Login",
	"login" => "Login",
	"login_to" => "Login to",
	"loggedin" => "User logged in",
	"user_active" => "User active",
	"fullname" => "Name",
	"username" => "Username",
	"usergroup" => "Group",
	"password" => "Password",
	"repeat_password" => "Repeat password",
	"password_error" => "The first and the second password must be the same.",
	"login_error" => "Login failed. Please try again.",
	"login_end" => "Logout successful. Thank you for using",
	"session_end" => "Session finished.",
	"no_permission" => "You have no permission to access this page.",


	// Addressbook
	//
	"print_name" => "Print Name",
	"prefix" => "Prefix",
	"firstname" => "Firstname",
	"lastname" => "Lastname",
	"title" => "Title",
	"company" => "Company",
	"department" => "Department",
	"postalcode" => "Postalcode",
	"city" => "City",
	"country" => "Country",
	"stateprov" => "State",
	"address" => "Address",
	"position1" => "Position",
	"initials" => "Initials",
	"salutation" => "Salutation",
	"phonehome" => "Tel. (Private)",
	"phoneoffi" => "Tel. (Office)",
	"phoneothe" => "Tel. (Other)",
	"phonework" => "Tel. (Company)",
	"mobile" => "Tel. (Mobile)",
	"pager" => "Pager",
	"fax" => "Fax",
	"email" => "E-Mail",
	"url" => "Home page",
	"note" => "Note",
	"url2" => "Home page 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Customer field 1",
	"altfield2" => "Customer field 2",
	"cust_method_of_payment" => "Method of payment",
	"birthday" => "Birthday e. g. 01.01.1970",
	"select_all" => "All",
	"envelope" => "Envelope",
	"issue_invoice" => "Issue invoice for",
	"issue_offer" => "Issue offer for",
	"issue_credit_note" => "Issue credit note for",
	"customer" => "Customer",
	"customer_no" => "Customer-No.",
	"customer_no_initials" => "CU",
	"choose_customer" => "Choose customer",
	"find_customer" => "Input: First name, surname or company to be searched for.",
	"basic_info" => "Info",
	"extended_info" => "Extended information",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Priority",
	"email_from" => "From",
	"email_to" => "To",
	"email_cc" => "Cc",
	"email_bcc" => "Bcc",
	"email_subject" => "Subject",
	"email_text" => "Message",
	"email_send" => "Send E-Mail",
	"email_ok" => "E-Mail was send to",
	"email_error" => "Error: E-Mail was not send.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Text",
	"email_pdf" => "E-Mail PDF-Attachment",


	// Position
	//
	"pos_active" => "Position active",
	"pos_inactive" => "Position inactive",
	"pos_all" => "Show all positions",
	"pos_name" => "Position / Article",
	"pos_unit" => "Unit",
	"pos_text" => "Description",
	"pos_quantity" => "Quantity",
	"pos_price" => "Price",
	"pos_amount" => "Amount",
	"pos_choose" => "Choose position",
	"pos_new" => "New position",
	"pos_print" => "Print position",
	"pos_group" => "Group",
	"pos_inventory" => "Inventory",
	"pos_search" => "Input: position/article or description to be searched for.",


	// Tax
	//
	"tax_divide" => "To divide with",
	"tax_multiply" => "To multiply with",
	"tax_description" => "Tax description",


	// Settings
	//
	"basic_settings" => "Basic settings",
	"company_settings" => "Company settings",
	"pdf_settings" => "PDF settings",
	"print_company_data" => "Print company's data",
	"print_position_name" => "Print position names",
	"print_output" => "Print output",
	"company_logo" => "Company's logo",
	"company_logo_width" => "Company's logo width",
	"company_logo_height" => "Company's logo height",
	"company_name" => "Companyname",
	"company_address" => "Address",
	"company_postal" => "Postalcode",
	"company_city" => "City",
	"company_country" => "Country",
	"company_phone" => "Phone",
	"company_fax" => "Fax",
	"company_email" => "E-Mail",
	"company_url" => "Home Page",
	"company_wap" => "WAP",
	"company_currency" => "Currency",
	"company_tax_free" => "Tax Free",
	"sales_prices" => "Sales prices are",
	"company_taxnr" => "Tax number",
	"business_taxnr" => "Business tax number",
	"bank_name" => "Bankname",
	"bank_account" => "Account number",
	"bank_number" => "Bank code number",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail internal",
	"email_use_signature" => "Use signature",
	"email_signature" => "Signature",
	"stock_active" => "Inventory check active",
	"reminder" => "Reminder",
	"reminder_price" => "Reminder price",
	"reminder_days" => "Remind after day(s)",
	"entries_per_page" => "Entries per page",
	"session_sec" => "Session Sec.",
	"pdf_font" => "Font",
	"pdf_text1" => "Font size 1",
	"pdf_text2" => "Font size 2",
	"pdf_text3" => "Font size e. g. Invoice",
	"pdf_dir" => "TMP-Directory",
	"pdf_attachment_text" => "PDF-Attachment-Text",


	// Offer
	//
	"save_offer" => "Save offer",
	"print_offer" => "Print offer",
	"print_order" => "Print order",
	"change_offer" => "Change offer",
	"copy_offer" => "Copy offer",
	"status" => "Status",
	"order" => "Order",
	"change_status" => "Change status",
	"offer_initials" => "OF",
	"order_initials" => "OR",
	"offer_number" => "Offer-No.",
	"order_number" => "Order-No.",
	"offer_subtotal" => "Subtotal Net",
	"offer_tax1" => "Tax. 1",
	"offer_tax2" => "Tax. 2",
	"offer_tax3" => "Tax. 3",
	"offer_amount" => "Total amount",
	"email_offer" => "E-Mail offer to:",
	"email_order" => "E-Mail order to:",
	"was_send" => "was sent by e-mail to",


	// Invoice
	//
	"save_invoice" => "Save invoice",
	"print_invoice" => "Print invoice",
	"copy_invoice" => "Copy invoice",
	"change_invoice" => "Change invoice",
	"open_account" => "Open account",
	"invoice_initials" => "IN",
	"invoice_number" => "Invoice-No.",
	"invoice_subtotal" => "Subtotal Net",
	"invoice_tax1" => "Tax. 1",
	"invoice_tax2" => "Tax. 2",
	"invoice_tax3" => "Tax. 3",
	"invoice_amount" => "Total amount",
	"transaction" => "Transaction",
	"invoice_transaction" => "Transaction for Invoice-No.",
	"open_invoice" => "Open invoice",
	"email_invoice" => "E-Mail invoice to:",
	"invoice_was_send" => "Invoice was sent by e-mail to",
	"open_since" => "Open since day(s)",
	"invoice_deletion" => "By the deletion of this invoice, the existence of the cash book<br />
		would slip in the minus. Cash in hand cannot be negative!",
	"delivery_note" => "Delivery note",
	"print_delivery_note" => "Print delivery note",
	"delivery_note_initials" => "DN",
	"delivery_note_number" => "Delivery Note-No.",
	"email_delivery_note" => "E-Mail delivery note to:",


	// Credit note
	//
	"credit_note_number" => "Credit Note-No.",
	"credit_note_redeemed" => "Redeemed",
	"credit_note_initials" => "CN",


	// Payment
	//
	"save_payment" => "Save payment",
	"print_payment" => "Print payment",
	"change_payment" => "Change payment",
	"payment_number" => "Payment-No.",
	"payment_sum" => "Paid",
	"total_payment" => "Total",
	"card_number" => "Card-No.",
	"valid_thru" => "Good thru",
	"outstanding_payment" => "Only customers with open invoices.",
	"payment_error" => "Payment is already available.",
	"payment_incorrect" => "Payment incorrect. Payment is higher than invoice total.",
 	"payment_deletion" => "By the deletion of this payment, the existence of the cash book<br />
		would slip in the minus. Cash in hand cannot be negative!",


	// Reports
	//
	"select_report" => "Select Report",
	"customer_sales" => "Sales according customers",
	"position_sales" => "Sales according to position/article",
	"invoice_totals" => "Invoices",
	"booking_details" => "Bookingdetails",
	"individual_values" => "Individual values",
	"summary" => "Summary",
	"date_from" => "from",
	"date_till" => "till",


	// Cash book
	//
	"cash_in_hand" => "Cash in hand",
	"starting_with" => "Cash in hand starting with",
	"takings" => "Takings",
	"expenditures" => "Expenditures",
	"cashbook_number" => "Receipt-No.",
	"cashbook_description" => "Description",
	"takings_expenditures_error" => "Takings and expenditures can not be filled out at the same time.",
	"cashbook_expenditures" => "You cannot spend more money than are present in the cash book.",

	// Syslog
	//
	"syslog_description" => "Description",
	"syslog_created" => "Date / Time",
);


// Reports
//
$reports = array (
	"booking_details.php" => "Bookingdetails according date",
	"invoice_ledger.php" => "Sales invoice ledger",
	"outstanding_accounts.php" => "Outstanding accounts",
	"invoice_ledger_summary.php" => "Sales invoice ledger summary",
	"cashbook.php" => "Cash book",
	"position_sales_summary.php" => "Sales according to position/article summary",
	"position_sales.php" => "Sales according to position/article of individual values",
	"outstanding_offers.php" => "Outstanding offers"
);


// Customer reports
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Bookingdetails according date",
	"../reports/customer_invoices.php" => "Sales invoice ledger",
	"../reports/customer_outstanding_accounts.php" => "Outstanding accounts"
);


// Language
//
$language = array (
	1 => "German",
	2 => "English",
	3 => "Polish",
	4 => "Croatian",
	5 => "French",
	6 => "Italian",
	7 => "Spanish - ES",
	8 => "Dutch"
);


// Group
//
// The first 2 entries are in $admingroup_1 and $admingroup_2
//
$group = array (
	1 => "Root",
	2 => "Manager",
	3 => "Bookkeeping",
	4 => "Employee",
	5 => "User"
);


// Choice Yes / No
//
$choice_yes_no = array (
	1 => "Yes",
	2 => "No"
);


// Print output
//
$print_output = array (
	1 => "HTML",
	2 => "PDF"
);


// Sales prices
//
$sales_price = array (
	1 => "Net",
	2 => "Gross"
);


// E-Mail Priority
//
$email_priority = array (
	3 => "Normal",
	1 => "Highest",
	5 => "Lowest"
);


// Offer status
//
$offer_status = array(
	1 => "Not accepted",
	2 => "Confirmation of order",
	3 => "Invoice"
);

?>
