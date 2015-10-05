<?php

/*
	italian.php

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	Italian translation by: 2005 Alfredo Patti < a dot patti at web dot de >

	(C) 2006-2008 Babel Fish Translated Text

	ISO-8859-1

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

// Definizione di lingua - italiano
//

$a = array (
	"welcome" => "Benvenuto a",
	"programname" => "phpRechnung 1.6.4",
	"phprechnung" => "phpRechnung 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpRechnung Home' href='http://www.loenshotel.de/phpRechnung/' target='_bkank'>&nbsp;Edy Corak&nbsp;</a>. All rights reserved.",

	"admin" => "Amministratore",

	"language" => "Lingua",
	"choose_language" => "Scegliere lingua",


	// Linkbar
	//
	"logout" => "Ritirazione",
	"startpage" => "Pagina inizziale",
	"addressbook" => "Agenda degli indirizzi",
	"position" => "Positione",
	"offer" => "Offerta",
	"invoice" => "Fattura",
	"credit_note" => "Credit note",
	"payment" => "Pagamento",
	"cashbook" => "Libro della cassa",
	"reports" => "Rapporti",
	"configuration" => "Configurazione",
	"message" => "Messaggio",
	"method_of_payment" => "Method of payment",
	"category" => "Categoria",
	"tax" => "IVA",
	"tax_short" => "IVA",
	"settings" => "Regolazione",
	"user_admin" => "Amministrazione dell´utente",
	"super_user" => "Super User",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "Lista",
	"new" => "Nuovo",
	"search" => "Cercare",
	"detail_search" => "Cercare nel dettaglio",
	"searchresult" => "Risultato cerca",
	"help" => "Aiuto",

	"info" => "Info",
	"all_info" => "Tutti informazioni",


	// Actions
	//
	"insert" => "Iscrivere",
	"save" => "Salvare",
	"edit" => "Modificare",
	"edit_entry" => "Edit entry",
	"change" => "Cambiare",
	"delete" => "Cancellare",
	"delete_entry" => "Delete entry",
	"cancel" => "Cancel",
	"cancel_entry" => "Cancel entry",
	"copy" => "Copia",
	"copy_entry" => "Copii l'entrata",

	"print" => "Stampare",
	"sort" => "Assortire secondo",
	"choose" => "Scegliere",
	"close" => "Close",
	"close_window" => "Chiudere finestra",
	"choose_message" => "Scegliere messaggio",
	"back" => "Indietro",
	"next" => "Avanti",
	"accept" => "Accept",


	// Generally
	//
	"date_text" => "Data",
	"number_text" => "Numero",

	"page" => "Pagina",
	"firstpage" => "First page",
	"prevpage" => "Previous page",
	"nextpage" => "Next page",
	"lastpage" => "Last page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Registraione",
	"no_entry" => "Non ci sono registrazini.",
	"entry_no" => "Numero di registraione",
	"entries" => "Registrazini",

	"new_entry" => "Registraione é stato aggiunto con successo.",
	"entry_exist" => "Registraione é gia esistente.",
	"entry_changed" => "Registraione é stato modificato con successo.",
	"entry_deleted" => "Registraione é stato cancellato con successo.",
	"entry_not_deleted" => "Registraione non si puo cancellare.",
	"entry_canceled" => "Entry was canceled.",
	"entry_not_canceled" => "Entry was not canceled.",

	"field_error" => "Casella non compilata giusta.",

	"invoice_issued" => "Questo registraione é stato gia fattura / offerta.",
	"payment_issued" => "For this invoice a payment was issued.<br />
		To change the invoice, you must delete the payment first.",
	"position_used" => "This position is used in invoices / offers.",
	"offer_used" => "For this offer a invoice was already issued.<br />
		In order to change the offer, you must delete the invoice first.",

	"invalid_date" => "Errore: Salvare del file non e possibile. e. g. 01.01.1970",


	// Login
	//
	"login_title" => "Iscrizione",
	"login" => "Iscrizinoe",
	"login_to" => "Iscrizione",
	"loggedin" => "Iscritto è",
	"user_active" => "Utente attiva",
	"fullname" => "Nome",
	"username" => "Nome dell´utente",
	"usergroup" => "Gruppo",
	"password" => "Password",
	"repeat_password" => "Ripetere password",
	"password_error" => "Il primo e il secondo password devono essere uguali.",
	"login_error" => "Iscrizione non posibile. Per favore tentare un´altra volta.",
	"login_end" => "Ritirazione erfolgreich. Grazie per l´uso di",
	"session_end" => "La seduta è tolta. Per lungo tempo non è stata fatta una digitazione.",
	"no_permission" => "Non ha l´autorizzazione di aprire questa pagina.",


	// Addressbook
	//
	"print_name" => "Stampare nome",
	"prefix" => "Titolo (ANREDE)",
	"firstname" => "Nome",
	"lastname" => "Cognome",
	"title" => "Titolo",
	"company" => "Ditta",
	"department" => "Compartimento",
	"postalcode" => "Codice postale",
	"city" => "Ort",
	"country" => "Land",
	"stateprov" => "Provincia",
	"address" => "Strada",
	"position1" => "Posizione",
	"initials" => "Abbreviazione",
	"salutation" => "Intestazione",
	"phonehome" => "Telefono (privato)",
	"phoneoffi" => "Telefono (diretto)",
	"phoneothe" => "Telefono (diverso)",
	"phonework" => "Telefono (ditta)",
	"mobile" => "Telefono (cellulare)",
	"pager" => "Pager",
	"fax" => "Facsimile",
	"email" => "E-Mail",
	"url" => "Sito web",
	"note" => "Notizia",
	"url2" => "Sito web 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Casella dell´utente 1",
	"altfield2" => "Casella dell´utente 2",
	"cust_method_of_payment" => "Modo del pagamento",
	"birthday" => "Data di nascita e. g. 01.01.1970",
	"select_all" => "Tutti",
	"envelope" => "Envelope",
	"issue_invoice" => "Fattura per",
	"issue_offer" => "Offerta per",
	"issue_credit_note" => "Issue credit note for",
	"customer" => "Cliente",
	"customer_no" => "Codice cliente",
	"customer_no_initials" => "CU",
	"choose_customer" => "Scegliere cliente",
	"find_customer" => "Digitazione: Nome, Congnome o ditta di quale si dovrebbe cercare.",
	"basic_info" => "Info",
	"extended_info" => "Extended information",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Prioritá",
	"email_from" => "Mittente",
	"email_to" => "a",
	"email_cc" => "Copia (Cc)",
	"email_bcc" => "Bcc",
	"email_subject" => "Subject",
	"email_text" => "Messagio",
	"email_send" => "Mandare E-Mail",
	"email_ok" => "E-Mail é stata mandata",
	"email_error" => "Errore: E-Mail non é stata mandata.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Testo",
	"email_pdf" => "E-Mail PDF-Attachment",


	// Posizione
	//
	"pos_active" => "Posizione attiva",
	"pos_inactive" => "Position inactive",
	"pos_all" => "Show all positions",
	"pos_name" => "Posizione / Articolo",
	"pos_text" => "Descrizione",
	"pos_quantity" => "Quantitá",
	"pos_price" => "Prezzo",
	"pos_amount" => "Somma",
	"pos_choose" => "Scegliere posizione",
	"pos_new" => "Iscrivere nuova posizione",
	"pos_print" => "Stampare posizione",
	"pos_group" => "Group",
	"pos_inventory" => "Inventory",
	"pos_search" => "Digitazione: posizione/ articolo o descrizione di quale si dovrebbe cercare.",


	// IVA
	//
	"tax_divide" => "Dividere per",
	"tax_multiply" => "Multiplicare per",
	"tax_description" => "IVA Descrizione",


	// Settings
	//
	"basic_settings" => "Regolazioni di base",
	"company_settings" => "Regolazioni dell'azienda",
	"pdf_settings" => "Regolazioni del PDF",
	"print_company_data" => "Stampare dati ditta",
	"print_position_name" => "Stampare nome della posizione",
	"print_output" => "Stampa",
	"company_logo" => "Logo della ditta",
	"company_logo_width" => "Larghezza del logo di ditta",
	"company_logo_height" => "Altezza del logo di ditta",
	"company_name" => "Nome della ditta",
	"company_address" => "Indirizzo",
	"company_postal" => "Codice postale",
	"company_city" => "Luogo ( City )",
	"company_country" => "Paese ( Country )",
	"company_phone" => "Telefono",
	"company_fax" => "Telefax",
	"company_email" => "E-Mail",
	"company_url" => "Sito web",
	"company_wap" => "WAP",
	"company_currency" => "Valuta",
	"company_tax_free" => "Tassa liberamente",
	"sales_prices" => "Prezzi di vendita sono",
	"company_taxnr" => "Tax number",
	"business_taxnr" => "Numero di imposta di affari",
	"bank_name" => "Collegamento bancario",
	"bank_account" => "Conto corrente",
	"bank_number" => "Numero di codice della banca",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail interno",
	"email_use_signature" => "Usi la firma",
	"email_signature" => "Firma",
	"stock_active" => "Controllo di riserva attivo",
	"reminder" => "Ricordo",
	"reminder_price" => "Prezzo di ricordo",
	"reminder_days" => "Ricordi a dopo il giorni",
	"entries_per_page" => "Iscrizione per pagina",
	"session_sec" => "Secondi di sessione",
	"pdf_font" => "Serie completa di caratteri",
	"pdf_text1" => "Dimensione 1",
	"pdf_text2" => "Dimensione 2",
	"pdf_text3" => "Dimensione e. g. Fattura",
	"pdf_dir" => "TMP-Indice",
	"pdf_attachment_text" => "PDF-Collegamento-Testo",


	// Offerta
	//
	"save_offer" => "Salvare offerta",
	"print_offer" => "Stampare offerta",
	"print_order" => "Stampare ordine",
	"change_offer" => "Modificare offerta",
	"copy_offer" => "Copy del Offerta",
	"status" => "Condizione",
	"order" => "Ordine",
	"change_status" => "Cambi la condizione",
	"offer_initials" => "OF",
	"order_initials" => "OR",
	"offer_number" => "Numero di offerta",
	"order_number" => "Numero di ordine",
	"offer_subtotal" => "Somma parziale",
	"offer_tax1" => "IVA. 1",
	"offer_tax2" => "IVA. 2",
	"offer_tax3" => "IVA. 3",
	"offer_amount" => "Totale",
	"email_offer" => "Offerta via E-Mail:",
	"email_order" => "Ordine via E-Mail:",
	"was_send" => "mandato via E-Mail",


	// Fattura
	//
	"save_invoice" => "Salvare fattura",
	"print_invoice" => "Stampare fattura",
	"copy_invoice" => "Copy del fattura",
	"change_invoice" => "Modificare fattura",
	"open_account" => "Saldo aperto",
	"invoice_initials" => "FA",
	"invoice_number" => "Numero di fattura",
	"invoice_subtotal" => "Somma parziale",
	"invoice_tax1" => "IVA. 1",
	"invoice_tax2" => "IVA. 2",
	"invoice_tax3" => "IVA. 3",
	"invoice_amount" => "Totale",
	"transaction" => "Arrivo pagamento",
	"invoice_transaction" => "Pagamento per numero di fattura",
	"open_invoice" => "Fattura aperti",
	"email_invoice" => "Fattura via E-Mail a:",
	"invoice_was_send" => "Fattura mandato via E-Mail",
	"open_since" => "Aperto da giorni",
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
	"save_payment" => "Salvare pagamento",
	"print_payment" => "Stampare pagamento",
	"change_payment" => "Modificare pagamento",
	"payment_number" => "Numero di pagamento",
	"payment_sum" => "Paid",
	"total_payment" => "Totale",
	"card_number" => "Numero di carta",
	"valid_thru" => "Valido fino",
	"outstanding_payment" => "Si mostreranno solo cliente con conti ancora aperti.",
	"payment_error" => "Payment is already available.",
	"payment_incorrect" => "Un versamento piú alto non è possibile.<br /><br />Versamento deve corrispondere alla somma della fattura.",
 	"payment_deletion" => "By the deletion of this payment, the existence of the cash book<br />
		would slip in the minus. Cash in hand cannot be negative!",


	// Reports
	//
	"select_report" => "Scegliere raporto",
	"customer_sales" => "Vendite secondo cliente",
	"position_sales" => "Vendite secondo posizione / articoli",
	"invoice_totals" => "Libro delle uscite dei fatturi",
	"booking_details" => "Bookingdetails",
	"individual_values" => "Valore singolare",
	"summary" => "Riassunto",
	"date_from" => "dal",
	"date_till" => "al",


	// Cash book
	//
	"cash_in_hand" => "Riserva",
	"starting_with" => "Inizzio inventario",
	"takings" => "Entrate incasso",
	"expenditures" => "Spese",
	"cashbook_number" => "Numero di ricevuta",
	"description" => "Descrizione",
	"takings_expenditures_error" => "Entrate incasso e spese non si possono compilare contemporaneo.",
	"cashbook_expenditures" => "Non puo spendere più soldi che esistono in cassa.",

	// Syslog
	//
	"syslog_description" => "Description",
	"syslog_created" => "Date / Time",
);


// Reports
//
$reports = array (
	"booking_details.php" => "Bookingdetails according date",
	"invoice_ledger.php" => "Libro delle uscite di pagamenti",
	"outstanding_accounts.php" => "Fatturi aperti",
	"invoice_ledger_summary.php" => "Vendite secondo cliente - riassunto",
	"cashbook.php" => "Libro della cassa",
	"position_sales_summary.php" => "Vendite secondo posizione / articole - Riassunto",
	"position_sales.php" => "Vendite secondo posizione / articolo",
	"outstanding_offers.php" => "Outstanding offers"
);


// Customer reports
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Bookingdetails according date",
	"../reports/customer_invoices.php" => "Libro delle uscite di pagamento",
	"../reports/customer_outstanding_accounts.php" => "Fattura aperta"
);


// Language
//
$language = array (
	1 => "Tedesco",
	2 => "Inglese",
	3 => "Polaco",
	4 => "Croato",
	5 => "Francese",
	6 => "Italiano",
	7 => "Spagnolo - ES",
	8 => "Olandese"
);


// Gruppo
//
$group = array (
	1 => "Root",
	2 => "Responsabile",
	3 => "Contabilità",
	4 => "Impiegato",
	5 => "Utente"
);

// Choice Yes / No
//
$choice_yes_no = array (
	1 => "Si",
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
	3 => "Normale",
	1 => "Alto",
	5 => "Basso"
);


// Offer status
//
$offer_status = array(
	1 => "Not accepted",
	2 => "Confirmation of order",
	3 => "Invoice"
);

?>
