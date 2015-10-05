<?php

/*
	polish.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	phpRechnung - Prosty program do fakturowania wraz z administracj± ksi±¿ki adresowej
	T³umaczy³: Krzysztof B³¿owski < ciarko at wp dot pl >
	
	ISO-8859-2

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

// Language definition - Polish
//

$a = array (
	"welcome" => "Welcome to",
	"programname" => "phpRechnung 1.6.4",
	"phprechnung" => "phpRechnung 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpRechnung Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. Wszelkie prawa zastrze¿one.",

	"admin" => "Administrator",

	"language" => "Jêzyk",
	"choose_language" => "Wybór jêzyka",


	// Linkbar
	//
	"logout" => "Wyloguj",
	"startpage" => "Strona g³ówna",
	"addressbook" => "Ksi±¿ka adresowa",
	"position" => "Towar lub us³uga",
	"offer" => "Oferta",
	"invoice" => "Faktura VAT",
	"credit_note" => "Credit note",
	"payment" => "P³atno¶ci",
	"cashbook" => "Ksiêga p³atno¶ci",
	"reports" => "Raporty",
	"configuration" => "Konfiguracja",
	"message" => "Wiadomo¶ci",
	"method_of_payment" => "Forma p³atno¶ci",
	"category" => "Category",
	"tax" => "Podatek VAT",
	"tax_short" => "VAT",
	"settings" => "Ustawienia",
	"user_admin" => "Zarz±dzanie u¿ytkownikami",
	"super_user" => "Super User",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "Lista",
	"new" => "Nowa",
	"search" => "Szukaj",
	"detail_search" => "Szukanie szczegó³owe",
	"searchresult" => "Wynik wyszukiwanie",
	"help" => "Pomoc",

	"info" => "Info",
	"all_info" => "Wszystkie informacje",


	// Actions
	//
	"insert" => "Wpisz",
	"save" => "Zapisz",
	"edit" => "Edycja",
	"edit_entry" => "Edycja rekordu",
	"change" => "Zmiana",
	"delete" => "Kasuj",
	"delete_entry" => "Kasownie rekordu",
	"cancel" => "Cancel",
	"cancel_entry" => "Cancel entry",
	"copy" => "Copy",
	"copy_entry" => "Copy entry",

	"print" => "Drukuj",
	"sort" => "Sortowanie wg",
	"choose" => "Wybierz",
	"close" => "Close",
	"close_window" => "Zamknij okno",
	"choose_message" => "Wybór wiadomo¶ci",
	"back" => "Wróæ",
	"next" => "Dalej",
	"accept" => "Accept",


	// Generally
	//
	"date_text" => "Data",
	"number_text" => "Numer",

	"page" => "Page",
	"firstpage" => "First page",
	"prevpage" => "Previous page",
	"nextpage" => "Next page",
	"lastpage" => "Last page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Wpis",
	"no_entry" => "Nie ma ¿adnych rekordów.",
	"entry_no" => "Nr rekordu.",
	"entries" => "Opcje",

	"new_entry" => "Rekord zosta³ pomy¶lnie dodany do bazy danych.",
	"entry_exist" => "Taki rekord istnieje ju¿ w bazie danych.",
	"entry_changed" => "Rekord zosta³ pomy¶lnie zmieniony.",
	"entry_deleted" => "Rekord zosta³ pomy¶lnie skasowany.",
	"entry_not_deleted" => "Rekord nie mo¿e zostaæ skasowany.",
	"entry_canceled" => "Entry was canceled.",
	"entry_not_canceled" => "Entry was not canceled.",

	"field_error" => "Pole zosta³o b³êdnie wype³nione.",

	"invoice_issued" => "Dla tego rekordu zosta³a ju¿ wystawiana faktura.",
	"payment_issued" => "Dla tego rekordu przeprowadzona zosta³a p³atno¶æ.<br />
		Aby zmieniæ fakturê nale¿y najpierw skasowaæ p³atno¶æ.",
	"position_used" => "Ten rekord bêdzie wyko¿ystany w faktura.",
	"offer_used" => "Dla tego rekordu wystawina zosta³a faktura.<br />
		Aby zieniæ ofertê nale¿y najpierw skasowaæ fakturê.",

	"invalid_date" => "Data jest b³êdna. Proszê, sprawd¼ podane dane. np. 01.01.1970",


	// Login
	//
	"login_title" => "Logowanie",
	"login" => "Logowanie",
	"login_to" => "Logowanie w",
	"loggedin" => "Zalogowany jest",
	"user_active" => "U¿ytkownik aktywan",
	"fullname" => "Imiê",
	"username" => "Login",
	"usergroup" => "Grupa",
	"password" => "Has³o",
	"repeat_password" => "Powtórz has³o",
	"password_error" => "Pierwsze i drugie has³o musz± byæ identyczne.",
	"login_error" => "Logowanie nieudane. Spróbuj ponownie.",
	"login_end" => "Koniec pracy. Dziêkujemy za ko¿ystanie z",
	"session_end" => "Sesja zakoñczona z powodu zbyt d³ugiego braku aktywno¶ci.",
	"no_permission" => "Nie masz odpowienich uprawnieñ aby obejrzeæ t± stronê.",


	// Addressbook
	//
	"print_name" => "Drukuj imiê",
	"prefix" => "Prefix",
	"firstname" => "Imiê",
	"lastname" => "Nazwisko",
	"title" => "Tytu³",
	"company" => "Firma",
	"department" => "Dzia³",
	"postalcode" => "Kod pocztowy",
	"city" => "Miejscowo¶æ",
	"country" => "Kraj",
	"stateprov" => "Województwo",
	"address" => "Ulica",
	"position1" => "Pozycja",
	"initials" => "Skrót",
	"salutation" => "Zwrot grzeczno¶ciowy",
	"phonehome" => "Tel. (Prywatny)",
	"phoneoffi" => "Tel. (Bezpo¶redni)",
	"phoneothe" => "Tel. (Inne)",
	"phonework" => "Tel. (Firma)",
	"mobile" => "Tel. (Mobil)",
	"pager" => "Pager",
	"fax" => "Fax",
	"email" => "E-Mail",
	"url" => "Homepage",
	"note" => "Notatnik",
	"url2" => "Homepage 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Pole u¿ytkownika 1",
	"altfield2" => "Pole u¿ytkownika 2",
	"cust_method_of_payment" => "Forma p³atno¶ci",
	"birthday" => "Data urodzenia (np. 01.01.1970)",
	"select_all" => "Wszyscy",
	"envelope" => "Koperta",
	"issue_invoice" => "Wystaw fakturê dla",
	"issue_offer" => "Wystaw ofertê dla",
	"issue_credit_note" => "Issue credit note for",
	"customer" => "Dane klienta",
	"customer_no" => "Nr klienta",
	"customer_no_initials" => "CU",
	"choose_customer" => "Wybór klienta",
	"find_customer" => "Podaj: Imiê, Nazwisko albo firmê wg których bêdziemy szukaæ.",
	"basic_info" => "Info",
	"extended_info" => "Extended information",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Priority",
	"email_from" => "Nadawca",
	"email_to" => "Do",
	"email_cc" => "Kopia (Cc)",
	"email_bcc" => "Bcc",
	"email_subject" => "Dotyczy",
	"email_text" => "Wiadomo¶æ",
	"email_send" => "Wy¶lij e-Mail",
	"email_ok" => "E-Mail zosta³ wys³any do",
	"email_error" => "Error: E-Mail was not send.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Text",
	"email_pdf" => "E-Mail Za³±cznik-PDF",


	// Position
	//
	"pos_active" => "Pozycja aktywna",
	"pos_inactive" => "Position inactive",
	"pos_all" => "Show all positions",
	"pos_name" => "Pozycja / Artykó³",
	"pos_text" => "SWW/PKWiU",
	"pos_quantity" => "Ilo¶æ",
	"pos_price" => "Cena",
	"pos_amount" => "Warto¶æ",
	"pos_choose" => "Wybierz pozycje",
	"pos_new" => "Wpisanie nowej pozycji",
	"pos_print" => "Drukowanie pozycji",
	"pos_group" => "Group",
	"pos_inventory" => "Inventory",
	"pos_search" => "Podaj: Pozycja / Artykó³ albo opis wg których bêdziemy szukaæ.",


	// Tax
	//
	"tax_divide" => "Dzielenie przez",
	"tax_multiply" => "Mno¿yæ przez",
	"tax_description" => "VAT Opis",


	// Settings
	//
	"basic_settings" => "Basic settings",
	"company_settings" => "Company settings",
	"pdf_settings" => "PDF settings",
	"print_company_data" => "Drukowanie danych firmy",
	"print_position_name" => "Drukowanie nazwy pozycji",
	"print_output" => "Print output",
	"company_logo" => "Logo firmy",
	"company_logo_width" => "Szeroko¶æ loga firmy",
	"company_logo_height" => "Wysoko¶æ loga firmy",
	"company_name" => "Adres firmy",
	"company_address" => "Adres",
	"company_postal" => "Kod pocztowy",
	"company_city" => "Miejscowo¶æ",
	"company_country" => "Kraj",
	"company_phone" => "Telefon",
	"company_fax" => "Telefax",
	"company_email" => "E-Mail",
	"company_url" => "Home Page",
	"company_wap" => "WAP",
	"company_currency" => "Waluta",
	"company_tax_free" => "Tax Free",
	"sales_prices" => "Ceny sprzeda¿y s±",
	"company_taxnr" => "NIP",
	"business_taxnr" => "REGON",
	"bank_name" => "Dane bankowe",
	"bank_account" => "Account number",
	"bank_number" => "Kod banku",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail internal",
	"email_use_signature" => "Wyko¿ystaæ podpis",
	"email_signature" => "Podpis",
	"stock_active" => "Stock check active",
	"reminder" => "Przypomnienie",
	"reminder_price" => "Reminder price",
	"reminder_days" => "Remind after day(s)",
	"entries_per_page" => "Wpisów na strone",
	"session_sec" => "Czas sessi Sek.",
	"pdf_font" => "Font",
	"pdf_text1" => "Font size 1",
	"pdf_text2" => "Font size 2",
	"pdf_text3" => "Font size e. g. Invoice",
	"pdf_dir" => "TMP-Directory",
	"pdf_attachment_text" => "PDF-Attachment-Text",


	// Offer
	//
	"save_offer" => "Zapisaæ ofertê",
	"print_offer" => "Drukuj ofertê",
	"print_order" => "Print order",
	"change_offer" => "Edytuj ofertê",
	"copy_offer" => "Copy offer",
	"status" => "Status",
	"order" => "Order",
	"change_status" => "Change status",
	"offer_initials" => "OF",
	"order_initials" => "OR",
	"offer_number" => "Nr oferty.",
	"order_number" => "Order-No.",
	"offer_subtotal" => "Miêdzysuma",
	"offer_tax1" => "Stawka VAT. 1",
	"offer_tax2" => "Stawka VAT. 2",
	"offer_tax3" => "Stawka VAT. 3",
	"offer_amount" => "Razem brutto",
	"email_offer" => "Wy¶lij ofertê przez E-Mail do:",
	"email_order" => "E-Mail order to:",
	"was_send" => "zosta³o wys³ane przez E-Mail do",


	// Invoice
	//
	"save_invoice" => "Zapisaæ fakturê",
	"print_invoice" => "Drukuj fakturê",
	"copy_invoice" => "Copy invoice",
	"change_invoice" => "Edytuj fakturê",
	"open_account" => "Nale¿no¶ci zaleg³e",
	"invoice_initials" => "FA",
	"invoice_number" => "Nr faktury",
	"invoice_subtotal" => "Miêdzysuma",
	"invoice_tax1" => "Stawka VAT 1",
	"invoice_tax2" => "Stawka VAT 2",
	"invoice_tax3" => "Stawka VAT 3",
	"invoice_amount" => "Razem",
	"transaction" => "Wp³yw p³atno¶ci",
	"invoice_transaction" => "Zap³ata za kwit nr",
	"open_invoice" => "Faktury nieuregulowane",
	"email_invoice" => "Fakturê przez E-Mail do:",
	"invoice_was_send" => "Fakturê zosta³o wys³ane przez E-Mail do",
	"open_since" => "Otworzone od Dzieñ(Dni)",
	"invoice_deletion" => "W wyniku skasowanie tej faktury, zmieni³ siê stan<br />
		ksiêgi p³atno¶ci na minus!",
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
	"save_payment" => "Zapisz p³atno¶æ",
	"print_payment" => "Drukuj p³atno¶æ",
	"change_payment" => "Edytuj p³atno¶æ",
	"payment_number" => "Nr p³atno¶æi.",
	"payment_sum" => "Paid",
	"total_payment" => "Razem brutto",
	"card_number" => "Nr kart",
	"valid_thru" => "Wa¿ne do",
	"outstanding_payment" => "Pokazani s± klienci, których faktury nie zosta³y uregulowane.",
	"payment_error" => "Payment is already available.",
	"payment_incorrect" => "Wy¿sza zap³ata nie jest mo¿liwa.<br /><br /> Zap³ata musi odpowiadaæ warto¶ci faktury.",
 	"payment_deletion" => "Poprzez skasowanie tej p³atno¶ci zmieni³ siê stan<br />
		ksiêgi p³atno¶ci na minus!",


	// Reports
	//
	"select_report" => "Wybór raportów",
	"customer_sales" => "Sprzeda¿ do klientów",
	"position_sales" => "Sprzeda¿ pozycji lub artyku³ów",
	"invoice_totals" => "Zestawienie faktur",
	"booking_details" => "Operacje ksiêgowe wg daty",
	"individual_values" => "Zestawienie szczegó³owe",
	"summary" => "Zestawienie",
	"date_from" => "od",
	"date_till" => "do",


	// Cash book
	//
	"cash_in_hand" => "Stan",
	"starting_with" => "Stan pocz±tkowy",
	"takings" => "Przychody",
	"expenditures" => "Wydatki",
	"cashbook_number" => "Nr kwitu",
	"description" => "Opis",
	"takings_expenditures_error" => "Dochody i wydatki nie mog± byæ jednocze¶nie wype³niane.",
	"cashbook_expenditures" => "Nie mo¿esz wydaæ wiêcej pieniêdzy ni¿ masz w kasie.",

	// Syslog
	//
	"syslog_description" => "Description",
	"syslog_created" => "Date / Time",
);


// Reports
//
$reports = array (
	"booking_details.php" => "Operacje ksiêgowe wg daty",
	"invoice_ledger.php" => "Zestawienie faktur",
	"outstanding_accounts.php" => "Faktury nieuregulowane",
	"invoice_ledger_summary.php" => "Zestawienie sprzeda¿y wg klientów",
	"cashbook.php" => "Ksiêga p³atno¶ci",
	"position_sales_summary.php" => "Zestawienie sumaryczne sprzeda¿y wg pozycji",
	"position_sales.php" => "Zestawienie sprzeda¿y wg poszczególnych pozycji",
	"outstanding_offers.php" => "Ofertê nieuregulowane"
);


// Customer reports
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Operacje ksiêgowe wg daty",
	"../reports/customer_invoices.php" => "Zestawienie faktur",
	"../reports/customer_outstanding_accounts.php" => "Faktury nieuregulowane"
);


// Language
//
$language = array (
	1 => "Niemiecki",
	2 => "Angielski",
	3 => "Polski",
	4 => "Chorwacki",
	5 => "Francja",
	6 => "W³oski",
	7 => "Hiszpañski - ES",
	8 => "Holenderski"
);


// Grupa
//
$group = array (
	1 => "Root",
	2 => "Dyrektor",
	3 => "Ksiêgowo¶æ",
	4 => "Pracownik",
	5 => "U¿ytkownik"
);

// Choice Yes / No
//
$choice_yes_no = array (
	1 => "Tak",
	2 => "Nie"
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
	3 => "Normany",
	1 => "Wysoki",
	5 => "Niski"
);


// Offer status
//
$offer_status = array(
	1 => "Not accepted",
	2 => "Confirmation of order",
	3 => "Invoice"
);

?>
