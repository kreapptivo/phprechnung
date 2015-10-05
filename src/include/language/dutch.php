<?php

/*
	dutch.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	Dutch translation by: 2006 Jerry van Kranenburg < jerry at dream-hosting dot net >
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

// Language definition - Dutch
//

$a = array (
	"welcome" => "Welkom bij",
	"programname" => "phpRekening 1.6.4",
	"phprechnung" => "phpRekening 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpRekening Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. All rights reserved.",

	"admin" => "Administratie",

	"language" => "Taal",
	"choose_language" => "Kies uw taal",


	// Linkbar
	//
	"logout" => "Afmelden",
	"startpage" => "Startpagina",
	"addressbook" => "Klanten",
	"position" => "Artikelen",
	"offer" => "Offerte",
	"invoice" => "Facturen",
	"credit_note" => "Credit nota",
	"payment" => "Betalingen",
	"cashbook" => "Kas boek",
	"reports" => "Raportten",
	"configuration" => "Configuratie",
	"message" => "Bericht",
	"method_of_payment" => "Betalings methode",
	"category" => "Categorie",
	"tax" => "Btw",
	"tax_short" => "Tax",
	"settings" => "Instellingen",
	"user_admin" => "Gebruikers administratie",
	"super_user" => "Super gebruiker",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "Lijst",
	"new" => "Nieuw",
	"search" => "Zoeken",
	"detail_search" => "Uitgebreid Zoeken",
	"searchresult" => "Zoek resultaat",
	"help" => "Help",

	"info" => "Info",
	"all_info" => "Alle informatie over",


	// Actions
	//
	"insert" => "Invoegen",
	"save" => "Opslaan",
	"edit" => "Wijzig",
	"edit_entry" => "Wijzig entry",
	"change" => "Wijzigen",
	"delete" => "Verwijderen",
	"delete_entry" => "Verwijder entry",
	"cancel" => "Cancel",
	"cancel_entry" => "Cancel entry",
	"copy" => "Kopieren",
	"copy_entry" => "Kopieren entry",

	"print" => "Afdrukken",
	"sort" => "Sorteren op",
	"choose" => "Kiezen",
	"close" => "Sluiten",
	"close_window" => "Venster sluiten",
	"choose_message" => "Kies bericht",
	"back" => "Terug",
	"next" => "Volgende",
	"accept" => "Accept",


	// Generally
	//
	"date_text" => "Datum",
	"number_text" => "Nummer",

	"page" => "Pagina",
	"firstpage" => "Eerste page",
	"prevpage" => "Vorige page",
	"nextpage" => "Volgende page",
	"lastpage" => "Laatste page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Item",
	"no_entry" => "Geen items gevonden.",
	"entry_no" => "Item-Nr.",
	"entries" => "Item's",

	"new_entry" => "Nieuwe item toegevoegd.",
	"entry_exist" => "Item bestaat al.",
	"entry_changed" => "Item veranderd.",
	"entry_deleted" => "Item verwijderd.",
	"entry_not_deleted" => "Item niet verwijderd.",
	"entry_canceled" => "Entry was canceled.",
	"entry_not_canceled" => "Entry was not canceled.",

	"field_error" => "Een van de ingevulde velden bevat een fout.",

	"invoice_issued" => "Voor dit item is een factuur / offert uitgegeven.",
	"payment_issued" => "Voor deze factuur is een betaling uitgegeven.<br />
		Om de factuur te veranderen moet u de betaling eerst verwijderen.",
	"position_used" => "Dit item word gebruikt in een factuur / offert.",
	"offer_used" => "Voor deze offerte is al een factuur gemaakt.<br />
		Om de offerte te wijzigen dient u eerste de factuur te verwijderen.",

	"invalid_date" => "Datum incorrect. Kijk invoer na. e. g. 01.01.1970",


	// Login
	//
	"login_title" => "Aanmelden",
	"login" => "Aanmelden",
	"login_to" => "Aangemeld bij",
	"loggedin" => "Gebruiker aangemeld",
	"user_active" => "Gebruiker actief",
	"fullname" => "Naam",
	"username" => "Gebruikersnaam",
	"usergroup" => "Groep",
	"password" => "Wachtwoord",
	"repeat_password" => "Herhaal wachtwoord",
	"password_error" => "Het eerste en tweede wachtwoord moeten identiek zijn.",
	"login_error" => "Aanmelden mislukt. Probeer het nogmaals.",
	"login_end" => "Afmelden geslaagt. Bedankt voor het gebruik van",
	"session_end" => "Sessie afgesloten.",
	"no_permission" => "U heeft geen rechten om deze pagina te openen.",


	// Addressbook
	//
	"print_name" => "Naam afdrukken",
	"prefix" => "Voorvoegsel",
	"firstname" => "Voornaam",
	"lastname" => "Achternaam",
	"title" => "Titel",
	"company" => "Bedrijf",
	"department" => "Afdeling",
	"postalcode" => "Postcode",
	"city" => "Plaats",
	"country" => "Land",
	"stateprov" => "Provincie",
	"address" => "Adres",
	"position1" => "Positie",
	"initials" => "Initialen",
	"salutation" => "Begroeting",
	"phonehome" => "Tel. (Prive)",
	"phoneoffi" => "Tel. (Bedrijf)",
	"phoneothe" => "Tel. (Anders)",
	"phonework" => "Tel. (Werk)",
	"mobile" => "Tel. (Mobiel)",
	"pager" => "Pager",
	"fax" => "Fax",
	"email" => "E-Mail",
	"url" => "Home page",
	"note" => "Notitie",
	"url2" => "Home page 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Gebruikers veld 1",
	"altfield2" => "Gebruikers veld 2",
	"cust_method_of_payment" => "Betalings methode",
	"birthday" => "Verjaardag e. g. 01.01.1970",
	"select_all" => "Alle",
	"envelope" => "Envelope",
	"issue_invoice" => "Factuur uitgeven voor",
	"issue_offer" => "Offerte uitgeven voor",
	"issue_credit_note" => "Credit nota uitgeven voor",
	"customer" => "Klant",
	"customer_no" => "Klant-Nr.",
	"customer_no_initials" => "CU",
	"choose_customer" => "Kies een klant",
	"find_customer" => "Invoer: Voornaam, achternaam of bedrijfsnaam om naar te zoeken.",
	"basic_info" => "Info",
	"extended_info" => "Extended information",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Prioriteit",
	"email_from" => "Van",
	"email_to" => "Naar",
	"email_cc" => "Cc",
	"email_bcc" => "Bcc",
	"email_subject" => "Onderwerp",
	"email_text" => "Bericht",
	"email_send" => "Verzend E-Mail",
	"email_ok" => "E-Mail verzonden naar",
	"email_error" => "Fout: E-Mail niet verzonden.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Tekst",
	"email_pdf" => "E-Mail PDF-Attachment",


	// Position
	//
	"pos_active" => "Artikel actief",
	"pos_inactive" => "Artikel inactief",
	"pos_all" => "Alle Artikellen",
	"pos_name" => "Artikel",
	"pos_text" => "Omschrijving",
	"pos_quantity" => "Hoeveelheid",
	"pos_price" => "Prijs",
	"pos_amount" => "Totaal",
	"pos_choose" => "Kies Artikel",
	"pos_new" => "Nieuw Artikel",
	"pos_print" => "Artikel afdrukken",
	"pos_group" => "Group",
	"pos_inventory" => "Voorraad",
	"pos_search" => "Invoer: position/artikel of omschrijving om naar te zoeken.",


	// Tax
	//
	"tax_divide" => "Te delen door",
	"tax_multiply" => "Te vermenigvuldigen met",
	"tax_description" => "Btw. omschrijving",


	// Settings
	//
	"basic_settings" => "Basis instellingen",
	"company_settings" => "Bedrijfs instellingen",
	"pdf_settings" => "PDF instellingen",
	"print_company_data" => "Bedrijfs informatie afdrukken",
	"print_position_name" => "Product namen afdrukken",
	"print_output" => "Afdrukken",
	"company_logo" => "Logo",
	"company_logo_width" => "Logo breedte",
	"company_logo_height" => "Logo hoogte",
	"company_name" => "Bedrijfs naam",
	"company_address" => "Adres",
	"company_postal" => "Postcode",
	"company_city" => "Plaats",
	"company_country" => "Land",
	"company_phone" => "Tel.",
	"company_fax" => "Fax",
	"company_email" => "E-Mail",
	"company_url" => "Home Page",
	"company_wap" => "WAP",
	"company_currency" => "Valuta",
	"company_tax_free" => "Belastingvrij",
	"sales_prices" => "Verkoop prijzen zijn",
	"company_taxnr" => "Btw. Nr.",
	"business_taxnr" => "Btw. Nr.",
	"bank_name" => "Bank",
	"bank_account" => "Rek Nr.",
	"bank_number" => "Bank Code nummer",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail intern",
	"email_use_signature" => "Gebruik signature",
	"email_signature" => "Signature",
	"stock_active" => "Voorraad actief",
	"reminder" => "Herinnering",
	"reminder_price" => "Herinnerings prijs",
	"reminder_days" => "Herinnering na dag(gen)",
	"entries_per_page" => "Items per pagina",
	"session_sec" => "Session Sek.",
	"pdf_font" => "Lettertype",
	"pdf_text1" => "Letter grootte 1",
	"pdf_text2" => "Letter grootte 2",
	"pdf_text3" => "Letter grootte e. g. Invoice",
	"pdf_dir" => "TMP-Directory",
	"pdf_attachment_text" => "PDF-Attachment-Tekst",


	// Offer
	//
	"save_offer" => "Offerte opslaan",
	"print_offer" => "Offerte afdrukken",
	"print_order" => "Order afdrukken",
	"change_offer" => "Offerte veranderen",
	"copy_offer" => "Offerte kopieren",
	"status" => "Status",
	"order" => "Order",
	"change_status" => "Status veranderen",
	"offer_initials" => "OF",
	"order_initials" => "OR",
	"offer_number" => "Offerte-Nr.",
	"order_number" => "Order-Nr.",
	"offer_subtotal" => "Subtotaal",
	"offer_tax1" => "Btw. 1",
	"offer_tax2" => "Btw. 2",
	"offer_tax3" => "Btw. 3",
	"offer_amount" => "Totaal bedrag",
	"email_offer" => "E-Mail Offerte naar:",
	"email_order" => "E-Mail order to:",
	"was_send" => "is verzonden per mail naar",


	// Invoice
	//
	"save_invoice" => "Factuur opslaan",
	"print_invoice" => "Factuur afdrukken",
	"copy_invoice" => "Copy invoice",
	"change_invoice" => "Factuur veranderen",
	"open_account" => "Open account",
	"invoice_initials" => "FA",
	"invoice_number" => "Factuur-Nr.",
	"invoice_subtotal" => "Subtotaal",
	"invoice_tax1" => "Btw. 1",
	"invoice_tax2" => "Btw. 2",
	"invoice_tax3" => "Btw. 3",
	"invoice_amount" => "Totaal bedrag",
	"transaction" => "Transactie",
	"invoice_transaction" => "Transactie voor Factuur-Nr.",
	"open_invoice" => "Open factuur",
	"email_invoice" => "E-Mail factuur naar:",
	"invoice_was_send" => "is verzonden dmv e-mail naar",
	"open_since" => "Open since day(s)",
	"invoice_deletion" => "Bij het verwijderen van deze factuur zal het kasboek nagatief worden<br />
		Dit is niet toegestaan.",
	"delivery_note" => "Delivery note",
	"print_delivery_note" => "Print delivery note",
	"delivery_note_initials" => "DN",
	"delivery_note_number" => "Delivery Note-No.",
	"email_delivery_note" => "E-Mail delivery note to:",


	// Credit note
	//
	"credit_note_number" => "Credit Nota-Nr.",
	"credit_note_redeemed" => "Voldaan",
	"credit_note_initials" => "CN",


	// Payment
	//
	"save_payment" => "Betaling opslaan",
	"print_payment" => "Betaling afdrukken",
	"change_payment" => "Betaling veranderen",
	"payment_number" => "Bet-Nr.",
	"payment_sum" => "Paid",
	"total_payment" => "Totaal",
	"card_number" => "Kaart-Nr.",
	"valid_thru" => "Geslaagd",
	"outstanding_payment" => "Alleen klanten met openstaande facturen.",
	"payment_error" => "Payment is already available.",
	"payment_incorrect" => "Betalig incorrect.",
 	"payment_deletion" => "Bij het verwijderen van deze betaling zal het kasboek<br />
		in de min komen te staan.",


	// Reports
	//
	"select_report" => "Selecteer Rapport",
	"customer_sales" => "Verkopen per klant",
	"position_sales" => "Verkopen per artikel",
	"invoice_totals" => "Facturen",
	"booking_details" => "Boekings details",
	"individual_values" => "Individuele waarden",
	"summary" => "Samenvatting",
	"date_from" => "van",
	"date_till" => "tot",


	// Cash book
	//
	"cash_in_hand" => "Contant in hand",
	"starting_with" => "Contant in hand start met",
	"takings" => "Inkomsten",
	"expenditures" => "Uitgaven",
	"cashbook_number" => "Bon-Nr.",
	"cashbook_description" => "Omschrijving",
	"takings_expenditures_error" => "Ontvangsten en uitgaven kunnen niet op gezelfde tijde verwerkt worden.",
	"cashbook_expenditures" => "Het is niet mogelijk meer geld uit te geven als er contant aanwezig is.",


	// Syslog
	//
	"syslog_description" => "Description",
	"syslog_created" => "Date / Time",
);


// Reports
//
$reports = array (
	"booking_details.php" => "Boekings details op gegeven datum",
	"invoice_ledger.php" => "Sales invoice ledger",
	"outstanding_accounts.php" => "Openstaande facturen",
	"invoice_ledger_summary.php" => "Sales invoice ledger summary",
	"cashbook.php" => "Kas boek",
	"position_sales_summary.php" => "Verkopen per artikel samenvatting",
	"position_sales.php" => "Verkopen per artikel met individuele waarden",
	"outstanding_offers.php" => "Openstaande offertes"
);


// Customer reports
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Boek details vanaf - datum",
	"../reports/customer_invoices.php" => "Sales invoice ledger",
	"../reports/customer_outstanding_accounts.php" => "Openstaande rekeningen"
);


// Language
//
$language = array (
	1 => "Duits",
	2 => "Engels",
	3 => "Pools",
	4 => "Kroatisch",
	5 => "Frans",
	6 => "Italiaans",
	7 => "Spaans - ES",
	8 => "Nederlands"
);


// Groep
//
$group = array (
	1 => "Root",
	2 => "Manager",
	3 => "Boekhouding",
	4 => "Werknemer",
	5 => "Gebruiker"
);


// Choice Yes / No
//
$choice_yes_no = array (
	1 => "Ja",
	2 => "Nee"
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
	1 => "Netto",
	2 => "Bruto"
);


// E-Mail Priority
//
$email_priority = array (
	3 => "Normaal",
	1 => "Hoog",
	5 => "Laag"
);


// Offer status
//
$offer_status = array(
	1 => "Niet geaccepteerd",
	2 => "Bevestig uw bestelling",
	3 => "Factuur"
);

?>
