<?php

/*
	german.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
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

// Sprachdefinition - Deutsch
//

$a = array (
	"welcome" => "Willkommen bei",
	"programname" => "phpRechnung 1.6.4",
	"phprechnung" => "phpRechnung 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpRechnung Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. Alle Rechte vorbehalten.",

	"admin" => "Administrator",

	"language" => "Sprache",
	"choose_language" => "Sprache wählen",


	// LinkLeiste
	//
	"logout" => "Abmelden",
	"startpage" => "Startseite",
	"addressbook" => "Adressbuch",
	"position" => "Position",
	"offer" => "Angebot",
	"invoice" => "Rechnung",
	"credit_note" => "Gutschrift",
	"payment" => "Zahlungseingang",
	"cashbook" => "Kassenbuch",
	"reports" => "Berichte",
	"configuration" => "Konfiguration",
	"message" => "Mitteilung",
	"method_of_payment" => "Zahlungsbedingungen",
	"category" => "Kategorie",
	"tax" => "Umsatzsteuer",
	"tax_short" => "MwSt.",
	"settings" => "Einstellung",
	"user_admin" => "Benutzerverwaltung",
	"super_user" => "Super User",
	"syslog" => "Syslog",
	"license" => "Lizenz",

	"list" => "Liste",
	"new" => "Neu",
	"search" => "Suchen",
	"detail_search" => "Detail-Suche",
	"searchresult" => "Suchergebnis",
	"help" => "Hilfe",

	"info" => "Info",
	"all_info" => "Alle Informationen über",


	// Aktionen
	//
	"insert" => "Eintragen",
	"save" => "Speichern",
	"edit" => "Bearbeiten",
	"edit_entry" => "Eintrag bearbeiten",
	"change" => "Ändern",
	"delete" => "Löschen",
	"delete_entry" => "Eintrag löschen",
	"cancel" => "Stornieren",
	"cancel_entry" => "Eintrag stornieren",
	"copy" => "Kopieren",
	"copy_entry" => "Eintrag kopieren",

	"print" => "Drucken",
	"sort" => "Sortieren nach",
	"choose" => "Wählen",
	"close" => "Schließen",
	"close_window" => "Fenster schließen",
	"choose_message" => "Mitteilung wählen",
	"back" => "Zurück",
	"next" => "Weiter",
	"accept" => "Akzeptieren",


	// Allgemein
	//
	"date_text" => "Datum",
	"number_text" => "Nummer",

	"page" => "Seite",
	"firstpage" => "Erste Seite",
	"prevpage" => "Vorherige Seite",
	"nextpage" => "Nächste Seite",
	"lastpage" => "Letzte Seite",

	"canceled_entries" => "Zeige Stornierte Einträge",
	"not_canceled_entries" => "Zeige NICHT-Stornierte Einträge",
	"all_entries" => "Zeige alle Einträge",

	"entry" => "Eintrag",
	"no_entry" => "Es sind keine Datensätze vorhanden.",
	"entry_no" => "Datensatz Nr.",
	"entries" => "Einträge",

	"new_entry" => "Datensatz wurde erfolgreich hinzugefügt.",
	"entry_exist" => "Datensatz ist bereits vorhanden.",
	"entry_changed" => "Datensatz wurde erfolgreich geändert.",
	"entry_deleted" => "Datensatz wurde erfolgreich gelöscht.",
	"entry_not_deleted" => "Datensatz kann nicht gelöscht werden.",
	"entry_canceled" => "Datensatz wurde storniert.",
	"entry_not_canceled" => "Datensatz kann nicht storniert werden.",

	"field_error" => "Feld wurde nicht korrekt ausgefüllt.",

	"invoice_issued" => "Für diesen Datensatz wurde(n) bereits Rechnung(en) / Angebot(e) erstellt.",
	"payment_issued" => "Für diesen Datensatz wurde bereits eine Zahlung vorgenommen.<br />
		Um die Rechnung zu ändern, müssen Sie zuerst die Zahlung löschen.",
	"position_used" => "Diese Position wird in Rechnung(en) / Angebot(en) verwendet.",
	"offer_used" => "Für dieses Angebot wurde bereits eine Rechnung erstellt.<br />
		Um das Angebot zu ändern, müssen Sie zuerst die Rechnung löschen.",

	"invalid_date" => "Das Datum ist nicht korrekt. Bitte überprüfen Sie Ihre Eingabe. z. B. 01.01.1970",


	// Anmeldung
	//
	"login_title" => "Anmeldung",
	"login" => "Anmelden",
	"login_to" => "Anmelden bei",
	"loggedin" => "Angemeldet ist",
	"user_active" => "Benutzer aktiv",
	"fullname" => "Name und Vorname",
	"username" => "Benutzername",
	"usergroup" => "Gruppe",
	"password" => "Kennwort",
	"repeat_password" => "Kennwort wiederholen",
	"password_error" => "Das erste und das zweite Kennwort müssen gleich sein.",
	"login_error" => "Anmeldung fehlgeschlagen. Bitte versuchen Sie es noch einmal.",
	"login_end" => "Abmeldung erfolgreich. Vielen Dank für die Nutzung von",
	"session_end" => "Sitzung beendet. Sie haben zu lange keine Eingaben vorgenommen.",
	"no_permission" => "Sie haben keine Berechtigung um diese Seite anzuzeigen.",


	// Adressbuch
	//
	"print_name" => "Name drucken",
	"prefix" => "Anrede",
	"firstname" => "Vorname",
	"lastname" => "Nachname",
	"title" => "Titel",
	"company" => "Firma",
	"department" => "Abteilung",
	"postalcode" => "PLZ",
	"city" => "Ort",
	"country" => "Land",
	"stateprov" => "Bundesland",
	"address" => "Straße",
	"position1" => "Position",
	"initials" => "Kürzel",
	"salutation" => "Briefanrede",
	"phonehome" => "Tel. (Privat)",
	"phoneoffi" => "Tel. (Durchwahl)",
	"phoneothe" => "Tel. (Andere)",
	"phonework" => "Tel. (Firma)",
	"mobile" => "Tel. (Mobil)",
	"pager" => "Pager",
	"fax" => "Fax",
	"email" => "E-Mail",
	"url" => "Homepage",
	"note" => "Notiz",
	"url2" => "Homepage 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Benutzerfeld 1",
	"altfield2" => "Benutzerfeld 2",
	"cust_method_of_payment" => "Zahlungsweise",
	"birthday" => "Geburtstag z. B. 01.01.1970",
	"select_all" => "Alle",
	"envelope" => "Umschlag",
	"issue_invoice" => "Rechnung erstellen für",
	"issue_offer" => "Angebot erstellen für",
	"issue_credit_note" => "Gutschrift erstellen für",
	"customer" => "Kunde",
	"customer_no" => "Kundennr.",
	"customer_no_initials" => "KD",
	"choose_customer" => "Kunde wählen",
	"find_customer" => "Eingabe: Vorname, Nachname oder Firma nach der gesucht werden soll.",
	"basic_info" => "Info",
	"extended_info" => "Erweiterte Informationen",
	"auth_info" => "Anmeldeinformationen",


	// E-Mail
	//
	"email_priority" => "Priorität",
	"email_from" => "Von",
	"email_to" => "An",
	"email_cc" => "Kopie (Cc)",
	"email_bcc" => "Blinde Kopie (Bcc)",
	"email_subject" => "Betreff",
	"email_text" => "Nachricht",
	"email_send" => "E-Mail senden",
	"email_ok" => "E-Mail wurde gesendet an",
	"email_error" => "Fehler: E-Mail wurde nicht gesendet.",
	"email_html" => "HTML",
	"email_text" => "Text",
	"email_pdf" => "PDF-Anhang",


	// Position Tabelle
	//
	"pos_active" => "Position aktiv",
	"pos_inactive" => "Position inaktiv",
	"pos_all" => "Alle Positionen anzeigen",
	"pos_name" => "Position / Artikel",
	"pos_unit" => "Einheit",
	"pos_text" => "Beschreibung",
	"pos_quantity" => "Menge",
	"pos_price" => "Preis",
	"pos_amount" => "Betrag",
	"pos_amount_carried_forward" => "Übertrag",
	"pos_choose" => "Position wählen",
	"pos_new" => "Neue Position eintragen",
	"pos_print" => "Position drucken",
	"pos_group" => "Gruppe",
	"pos_inventory" => "Lagerbestand",
	"pos_search" => "Eingabe: Position / Artikel oder Beschreibung nach der gesucht werden soll.",


	// Mwst Tabelle
	//
	"tax_divide" => "Dividiert durch",
	"tax_multiply" => "Multipliziert mit",
	"tax_description" => "MwSt.: Beschreibung",


	// Einstellung
	//
	"basic_settings" => "Grundeinstellungen",
	"company_settings" => "Firmen-Einstellungen",
	"pdf_settings" => "PDF-Einstellungen",
	"print_company_data" => "Firmendaten drucken",
	"print_position_name" => "Positionsnamen drucken",
	"print_output" => "Druckausgabe",
	"company_logo" => "Firmenlogo",
	"company_logo_width" => "Firmenlogo Breite",
	"company_logo_height" => "Firmenlogo Höhe",
	"company_name" => "Firmenname",
	"company_address" => "Adresse",
	"company_postal" => "PLZ",
	"company_city" => "Ort",
	"company_country" => "Land",
	"company_phone" => "Telefon",
	"company_fax" => "Telefax",
	"company_email" => "E-Mail",
	"company_url" => "Homepage",
	"company_wap" => "WAP",
	"company_currency" => "Währung",
	"company_tax_free" => "Steuerfrei",
	"sales_prices" => "Verkaufspreise sind",
	"company_taxnr" => "Steuernummer",
	"business_taxnr" => "UStNr",
	"bank_name" => "Bankverbindung",
	"bank_account" => "Konto-Nr.",
	"bank_number" => "BLZ",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail intern",
	"email_use_signature" => "Signatur verwenden",
	"email_signature" => "Signatur",
	"stock_active" => "Lagerverwaltung aktiv",
	"reminder" => "Erinnerung",
	"reminder_price" => "Mahngebühr",
	"reminder_days" => "Erinnerung nach Tag(e)",
	"entries_per_page" => "Einträge pro Seite",
	"session_sec" => "Sitzungsdauer Sek.",
	"pdf_font" => "Schriftart",
	"pdf_text1" => "Schriftgröße 1",
	"pdf_text2" => "Schriftgröße 2",
	"pdf_text3" => "Schriftgröße z. B. Rechnung",
	"pdf_dir" => "TMP-Verzeichnis",
	"pdf_attachment_text" => "PDF-Anhang-Text",


	// Angebot
	//
	"save_offer" => "Angebot speichern",
	"print_offer" => "Angebot drucken",
	"print_order" => "Auftrag drucken",
	"change_offer" => "Angebot ändern",
	"copy_offer" => "Angebot kopieren",
	"status" => "Status",
	"order" => "Auftrag",
	"change_status" => "Status ändern",
	"offer_initials" => "AN",
	"order_initials" => "AU",
	"offer_number" => "Angebot-Nr.",
	"order_number" => "Auftrag-Nr.",
	"offer_subtotal" => "Zwischensumme Netto",
	"offer_tax1" => "MwSt.",
	"offer_tax2" => "MwSt.",
	"offer_tax3" => "MwSt.",
	"offer_amount" => "Gesamt",
	"email_offer" => "Angebot per E-Mail an:",
	"email_order" => "Auftrag per E-Mail an:",
	"was_send" => "wurde per E-Mail gesendet an",


	// Rechnung
	//
	"save_invoice" => "Rechnung speichern",
	"print_invoice" => "Rechnung drucken",
	"copy_invoice" => "Rechnung kopieren",
	"change_invoice" => "Rechnung ändern",
	"open_account" => "Offener Betrag",
	"invoice_initials" => "RE",
	"invoice_number" => "Rechnung-Nr.",
	"invoice_subtotal" => "Zwischensumme",
	"invoice_tax1" => "MwSt.",
	"invoice_tax2" => "MwSt.",
	"invoice_tax3" => "MwSt.",
	"invoice_amount" => "Rechnungsbetrag",
	"transaction" => "Zahlungseingang",
	"invoice_transaction" => "Zahlungseingang für Rechnung-Nr.",
	"open_amount" => "Noch zu bezahlen",
	"open_invoice" => "Offene Rechnungen",
	"email_invoice" => "Rechnung per E-Mail an:",
	"invoice_was_send" => "Rechnung wurde per E-Mail gesendet an",
	"open_since" => "Offen seit Tag(e)",
	"invoice_deletion" => "Durch das Löschen dieser Rechnung, würde der Bestand<br />
		des Kassenbuches ins Minus rutschen!",
	"delivery_note" => "Lieferschein",
	"print_delivery_note" => "Lieferschein drucken",
	"delivery_note_initials" => "LS",
	"delivery_note_number" => "Lieferschein-Nr.",
	"email_delivery_note" => "Lieferschein per E-Mail an:",


	// Gutschrift
	//
	"credit_note_number" => "Gutschrift-Nr.",
	"credit_note_redeemed" => "Eingelöst",
	"credit_note_initials" => "GU",


	// Zahlung
	//
	"save_payment" => "Zahlung speichern",
	"print_payment" => "Zahlung drucken",
	"change_payment" => "Zahlung ändern",
	"payment_number" => "Zahlung-Nr.",
	"payment_sum" => "Bezahlt",
	"total_payment" => "Gesamt",
	"card_number" => "Karten-Nr.",
	"valid_thru" => "Gültig bis",
	"outstanding_payment" => "Es werden nur Kunden angezeigt deren Rechnungen noch offen sind.",
	"payment_error" => "Zahlung ist bereits vorhanden.",
	"payment_incorrect" => "Zahlung ist nicht korrekt. Zahlung muss der Rechnungssumme entsprechen.",
 	"payment_deletion" => "Durch das Löschen dieser Zahlung, würde der Bestand<br />
		des Kassenbuches ins Minus rutschen!",


	// Berichte
	//
	"select_report" => "Bericht wählen",
	"customer_sales" => "Verkäufe nach Kunden",
	"position_sales" => "Verkäufe nach Position/Artikel",
	"invoice_totals" => "Rechnungsausgangsbuch",
	"booking_details" => "Buchungsdetails nach Datum",
	"individual_values" => "Einzelwerte",
	"summary" => "Zusammenfassung",
	"date_from" => "vom",
	"date_till" => "bis",
	"tax_report" => "Umsatzsteuer",


	// Kassenbuch
	//
	"cash_in_hand" => "Bestand",
	"starting_with" => "Anfangsbestand",
	"takings" => "Einnahmen",
	"expenditures" => "Ausgaben",
	"cashbook_number" => "Belegnr.",
	"cashbook_description" => "Beschreibung",
	"takings_expenditures_error" => "Einnahmen und Ausgaben können nicht gleichzeitig ausgefüllt werden.",
	"cashbook_expenditures" => "Sie können nicht mehr Geld ausgeben als in der Kasse vorhanden ist.",

	// Syslog
	//
	"syslog_description" => "Beschreibung",
	"syslog_created" => "Datum / Zeit",
);


// Berichte
//
$reports = array (
	"booking_details.php" => "Buchungsdetails nach - Datum",
	"invoice_ledger.php" => "Rechnungsausgangsbuch",
	"outstanding_accounts.php" => "Offene Rechnungen",
	"invoice_ledger_summary.php" => "Verkäufe nach Kunden - Zusammenfassung",
	"cashbook.php" => "Kassenbuch",
	"position_sales_summary.php" => "Verkäufe nach Position/Artikel - Zusammenfassung",
	"position_sales.php" => "Verkäufe nach Position/Artikel - Einzelwerte",
	"outstanding_offers.php" => "Nicht angenommene Angebote",
	"tax_report.php" => "Umsatzsteuer"
);


// Kunden-Berichte
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Buchungsdetails nach - Datum",
	"../reports/customer_invoices.php" => "Rechnungsausgangsbuch",
	"../reports/customer_outstanding_accounts.php" => "Offene Rechnungen"
);

// Umsatzsteuer-Bericht
$a["year"] 	 = "Jahr";
$a["month"] 	 = "Monat";
$a["quarter"] 	 = "Quartal";
$a["paid_tax"] 	 = "Vorsteuer";
$a["to_pay_tax"] = "Umsatzsteuer";

// Sprache
//
$language = array (
	1 => "Deutsch",
	2 => "English",
	3 => "Polnisch",
	4 => "Kroatisch",
	5 => "Französisch",
	6 => "Italienisch",
	7 => "Spanisch - ES",
	8 => "Niederländisch"
);


// Gruppe
//
$group = array (
	1 => "Administrator",
	2 => "Manager",
	3 => "Buchhaltung",
	4 => "Angestellter",
	5 => "Benutzer"
);

// Auswahl Ja / Nein
//
$choice_yes_no = array (
	1 => "Ja",
	2 => "Nein"
);

// Druckausgabe
//
$print_output = array (
	1 => "HTML",
	2 => "PDF"
);


// Verkaufspreise
//
$sales_price = array (
	1 => "Netto",
	2 => "Brutto"
);


// E-Mail Prioritaet
//
$email_priority = array (
	3 => "Normal",
	1 => "Hoch",
	5 => "Niedrig"
);


// Auftragsstatus
//
$offer_status = array(
	1 => "Nicht angenommen",
	2 => "Auftragsbestätigung",
	3 => "Rechnung"
);

//Monate
$monate = array(1=>"Januar",
                2=>"Februar",
		3=>"M&auml;rz",
                4=>"April",
                5=>"Mai",
                6=>"Juni",
                7=>"Juli",
                8=>"August",
                9=>"September",
                10=>"Oktober",
                11=>"November",
                12=>"Dezember");

?>
