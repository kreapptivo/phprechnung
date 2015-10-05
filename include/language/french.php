<?php

/*
	french.php

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

// Définition linguistique - Français
//

$a = array (
	"welcome" => "Bienvenu",
	"programname" => "phpRechnung 1.6.4",
	"phprechnung" => "phpRechnung 1.6.4 - Droits d'auteur &copy; 2001 - 2011 <a class='nmenulink' title='phpRechnung Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. Touts droits reservés.",

	"admin" => "Administrateur",

	"language" => "Langue",
	"choose_language" => "Choisir une langue",


	// Bord de lien
	//
	"logout" => "Clore la session",
	"startpage" => "Page de demarrage",
	"addressbook" => "Repertoire",
	"position" => "Position",
	"offer" => "Devis",
	"invoice" => "Facture",
	"credit_note" => "Crédit",
	"payment" => "Reglement",
	"cashbook" => "Livre de caisse",
	"reports" => "Messages",
	"configuration" => "Configuration",
	"message" => "Message",
	"method_of_payment" => "Modalités de paiement",
	"category" => "Catégorie",
	"tax" => "Taxe sur la valeur ajoutée",
	"tax_short" => "Tax",
	"settings" => "Paramétres",
	"user_admin" => "Administration d'utilisateur",
	"super_user" => "Super User",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "Liste",
	"new" => "Nouveau",
	"search" => "Recherche",
	"detail_search" => "Recherche Detaillé",
	"searchresult" => "Résultat de la recherche",
	"help" => "Aide",

	"info" => "Info",
	"all_info" => "Toutes les informations",


	// Actions
	//
	"insert" => "Enregistrer",
	"save" => "Mémoire",
	"edit" => "Travailler",
	"edit_entry" => "Travailler une série de données",
	"change" => "Modifier",
	"delete" => "Supprimer",
	"delete_entry" => "Supprimer une série de données",
	"cancel" => "Cancel",
	"cancel_entry" => "Cancel entry",
	"copy" => "Copie",
	"copy_entry" => "Copiez l'entrée",

	"print" => "Imprimer",
	"sort" => "Trier",
	"choose" => "Choisir",
	"close" => "Fermer",
	"close_window" => "Close window",
	"choose_message" => "Choisir une communication",
	"back" => "Retour",
	"next" => "Suite",
	"accept" => "Accept",


	// Généralités
	//
	"date_text" => "Date",
	"number_text" => "Numéro",

	"page" => "Page",
	"firstpage" => "First page",
	"prevpage" => "Previous page",
	"nextpage" => "Next page",
	"lastpage" => "Last page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Entrée",
	"no_entry" => "Aucune série de données n'existe.",
	"entry_no" => "Numéro de série de données",
	"entries" => "Entrées",

	"new_entry" => "La série de données a été ajoutée avec succès.",
	"entry_exist" => "La série de données existe déjà.",
	"entry_changed" => "La série de données a été modifiée avec succès.",
	"entry_deleted" => "La série de données a été supprimée avec succès.",
	"entry_not_deleted" => "La série de données ne peut pas être supprimée.",
	"entry_canceled" => "Entry was canceled.",
	"entry_not_canceled" => "Entry was not canceled.",

	"field_error" => "Le champ n'a pas été rempli correctement.",

	"invoice_issued" => "Pour cette série de données, la facture a déjà été fournie.",
	"payment_issued" => "Un paiement a déjà été entrepris pour cette série de données.<br />
		Pour modifier la facture , vous devez supprimer d'abord le paiement.",
	"position_used" => "Cette série de données est utilisée dans les facture.",
	"offer_used" => "Pour cette série de données, une facture a déjà été fournie.<br />
		Pour modifier l'offre , vous devez supprimer d'abord la facture.",

	"invalid_date" => "La date n'est pas correcte. Veuillez réexaminer votre entrée. par exemple. 01.01.1970",


	// Annonce
	//
	"login_title" => "Annonce",
	"login" => "Annoncer",
	"login_to" => "Annoncer",
	"loggedin" => "Annoncé",
	"user_active" => "Utilisateur activé",
	"fullname" => "Nom",
	"username" => "Nom de l'utilisateur",
	"usergroup" => "Groupe",
	"password" => "Mot de passe",
	"repeat_password" => "Répéter mot de passe",
	"password_error" => "Le premier et le deuxième mot de passe doivent être mêmes.",
	"login_error" => "Annonce manqué. Veuillez essayer encore.",
	"login_end" => "Déclaration de départ avec succès. Merci beaucoup pour l'utilisation",
	"session_end" => "La réunion termine. Ils n'ont pas entrepris longs d'entrées.",
	"no_permission" => "Ils ne doivent pas indiquer d'autorisation autour de ce côté.",


	// Annuaire
	//
	"print_name" => "Nom imprimer",
	"prefix" => "Prefix",
	"firstname" => "Prénom",
	"lastname" => "Nom de famille",
	"title" => "Titre",
	"company" => "Entreprise",
	"department" => "Département",
	"postalcode" => "Code postal",
	"city" => "Lieu",
	"country" => "Pays",
	"stateprov" => "Province",
	"address" => "Adresse",
	"position1" => "Position",
	"initials" => "Initiales",
	"salutation" => "Salutation",
	"phonehome" => "Téléphone (privé)",
	"phoneoffi" => "Téléphone (bureau)",
	"phoneothe" => "Téléphone (d'autres)",
	"phonework" => "Téléphone (entreprise)",
	"mobile" => "Téléphone (portable)",
	"pager" => "Pager",
	"fax" => "Fax",
	"email" => "Courrier électronique",
	"url" => "Homepage",
	"note" => "Note",
	"url2" => "Homepage 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Champ utilisateur 1",
	"altfield2" => "Champ utilisateur 2",
	"cust_method_of_payment" => "Modalité de paiement",
	"birthday" => "Anniversaire par exemple. 01.01.1970",
	"select_all" => "Tout",
	"envelope" => "Enveloppe",
	"issue_invoice" => "Fournir une facture",
	"issue_offer" => "Faire une offre",
	"issue_credit_note" => "Fournir une crédit",
	"customer" => "Client",
	"customer_no" => "Numéro de client",
	"customer_no_initials" => "CU",
	"choose_customer" => "Choisir client",
	"find_customer" => "Entrée : Prénom, nom de famille ou entreprise.",
	"basic_info" => "Info",
	"extended_info" => "L'information prolongée",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Priorité",
	"email_from" => "Expéditeur",
	"email_to" => "A",
	"email_cc" => "Copie (Cc)",
	"email_bcc" => "Copie aveugle (Bcc)",
	"email_subject" => "Objet",
	"email_text" => "Information",
	"email_send" => "Envoyer un e-mail",
	"email_ok" => "E-mail envoyé dessus",
	"email_error" => "Erreur : Le e-mail n'a pas été envoyé.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Texte",
	"email_pdf" => "E-Mail PDF-Annexe",


	// Position
	//
	"pos_active" => "Position activé",
	"pos_inactive" => "Position inactif",
	"pos_all" => "Indiquer toutes les positions",
	"pos_name" => "Position / Article",
	"pos_text" => "Description",
	"pos_quantity" => "Quantité",
	"pos_price" => "Prix",
	"pos_amount" => "Montant",
	"pos_choose" => "Choisir la position",
	"pos_new" => "La nouvelle position enregistrer",
	"pos_print" => "Position imprimer",
	"pos_group" => "Group",
	"pos_inventory" => "Inventory",
	"pos_search" => "Entrée : La position/article ou la description.",


	// Taxe
	//
	"tax_divide" => "Divisé",
	"tax_multiply" => "Multiplié",
	"tax_description" => " TVA Description",


	// Réglage
	//
	"basic_settings" => "Basic settings",
	"company_settings" => "Company settings",
	"pdf_settings" => "PDF settings",
	"print_company_data" => "Imprimer données de la société",
	"print_position_name" => "Imprimer les noms de position",
	"print_output" => "Impression",
	"company_logo" => "Logo d'entreprise",
	"company_logo_width" => "Logo d'entreprise largeur",
	"company_logo_height" => "Logo d'entreprise hauteur",
	"company_name" => "Raison sociale",
	"company_address" => "Route/numéro",
	"company_postal" => "Code postal",
	"company_city" => "Lieu",
	"company_country" => "Pays",
	"company_phone" => "Téléphone",
	"company_fax" => "Télécopie",
	"company_email" => "E-Mail",
	"company_url" => "Home Page",
	"company_wap" => "WAP",
	"company_currency" => "Monnaie",
	"company_tax_free" => "Impôt librement",
	"sales_prices" => "Prix de vente hors taxe",
	"company_taxnr" => "Numéro d'identification fiscale",
	"business_taxnr" => "Numéro d'impôt sur chiffre d'affaires",
	"bank_name" => "Relation bancaire",
	"bank_account" => "Numéro de compte",
	"bank_number" => "Code de banque",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-mail interne",
	"email_use_signature" => "Signature utilisateur",
	"email_signature" => "Signature",
	"stock_active" => "Stock activement",
	"reminder" => "Rappel",
	"reminder_price" => "Taxes de mise en demeure",
	"reminder_days" => "Remind after day(s)",
	"entries_per_page" => "Entrées par page",
	"session_sec" => "Durée de réunion sec.",
	"pdf_font" => "Font",
	"pdf_text1" => "Font size 1",
	"pdf_text2" => "Font size 2",
	"pdf_text3" => "Font size e. g. Invoice",
	"pdf_dir" => "TMP-Directory",
	"pdf_attachment_text" => "PDF annexe texte",


	// Offre
	//
	"save_offer" => "Enregistrer offre",
	"print_offer" => "Imprimer offre",
	"print_order" => "Imprimer l'ordre",
	"change_offer" => "Modifier offre",
	"copy_offer" => "Copy offer",
	"status" => "Statut",
	"order" => "L'ordre",
	"change_status" => "Modifier un statut",
	"offer_initials" => "OF",
	"order_initials" => "OR",
	"offer_number" => "Numéro d'offre",
	"order_number" => "Numéro d'ordre",
	"offer_subtotal" => "Sous-total",
	"offer_tax1" => "TVA. 1",
	"offer_tax2" => "TVA. 2",
	"offer_tax3" => "TVA. 3",
	"offer_amount" => "Total",
	"email_offer" => "Offre par e-mail:",
	"email_order" => "L'ordre par e-mail:",
	"was_send" => "envoyé par e-mail",


	// Facture
	//
	"save_invoice" => "Enregistrer facture",
	"print_invoice" => "Imprimer facture",
	"copy_invoice" => "Copy invoice",
	"change_invoice" => "Modifier facture",
	"open_account" => "Bilan",
	"invoice_initials" => "FA",
	"invoice_number" => "Numéro de facture",
	"invoice_subtotal" => "Sous-total",
	"invoice_tax1" => "TVA. 1",
	"invoice_tax2" => "TVA. 2",
	"invoice_tax3" => "TVA. 3",
	"invoice_amount" => "Total",
	"transaction" => "Par",
	"invoice_transaction" => "Encaissement numéro de facture",
	"open_invoice" => "Factures non payés",
	"email_invoice" => "Facture par e-mail:",
	"invoice_was_send" => "Facture par e-mail envoyé",
	"open_since" => "Non rêglé de puis (e) de jour",
	"invoice_deletion" => "Par la suppression de cette facture,<br />
		l'existence du livre de caisse glisserait dans au minus!",
	"delivery_note" => "Delivery note",
	"print_delivery_note" => "Print delivery note",
	"delivery_note_initials" => "DN",
	"delivery_note_number" => "Delivery Note-No.",
	"email_delivery_note" => "E-Mail delivery note to:",


	// Crédit
	//
	"credit_note_number" => "Numéro de crédit",
	"credit_note_redeemed" => "Racheté",
	"credit_note_initials" => "CR",


	// Paiement
	//
	"save_payment" => "Enregistrer paiement",
	"print_payment" => "Imprimer paiement",
	"change_payment" => "Modifier paiement",
	"payment_number" => "Numéro de paiement",
	"payment_sum" => "Paid",
	"total_payment" => "Total",
	"card_number" => "Numéro de carte",
	"valid_thru" => "Valable",
	"outstanding_payment" => "Lui seulement clients indiqué ses factures être encore ouvert.",
	"payment_error" => "Payment is already available.",
	"payment_incorrect" => "Un paiement plus élevé n'est pas malheureusement possible.<br />
		Le paiement doit aussi correspondre au total de facture ou vous<br />pouvoir un acompte entreprendre!",
 	"payment_deletion" => "Suppression deréglement resulte ecompte debiteur!",


	// Rapports
	//
	"select_report" => "Choisir le rapport",
	"customer_sales" => "Ventes auprès clients",
	"position_sales" => "Ventes conformément à la position/article",
	"invoice_totals" => "Livre",
	"booking_details" => "Détail de réservation après date",
	"individual_values" => "Valeurs individuelles",
	"summary" => "Résumé",
	"date_from" => "du",
	"date_till" => "au",


	// Livre de caisse
	//
	"cash_in_hand" => "Relevé",
	"starting_with" => "Date relevé",
	"takings" => "Revenus",
	"expenditures" => "Dépenses",
	"cashbook_number" => "Numéro de document",
	"cashbook_description" => "Description",
	"takings_expenditures_error" => "Recettes et des dépenses ne peuvent pas être remplies en même temps.",
	"cashbook_expenditures" => "Reglement impossible!",

	// Syslog
	//
	"syslog_description" => "Description",
	"syslog_created" => "Date / Time",
);


// Rapports
//
$reports = array (
	"booking_details.php" => "Détail de réservation après date",
	"invoice_ledger.php" => "Livre",
	"outstanding_accounts.php" => "Factures non réglès auprés",
	"invoice_ledger_summary.php" => "Ventes clients résumé",
	"cashbook.php" => "Livre de caisse",
	"position_sales_summary.php" => "Ventes conformément à la position/article résumé",
	"position_sales.php" => "Ventes conformément à la position/article de valeurs individuelles",
	"outstanding_offers.php" => "Devis non réglès auprés"
);


// Rapports de client
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Détail de réservation après date",
	"../reports/customer_invoices.php" => "Livre",
	"../reports/customer_outstanding_accounts.php" => "Factures non réglès auprés"
);


// Langue
//
$language = array (
	1 => "Allemand",
	2 => "Anglais",
	3 => "Polonais",
	4 => "Croate",
	5 => "Français",
	6 => "Italien",
	7 => "Espagnol - ES",
	8 => "Hollandais"
);


// Groupe
//
$group = array (
	1 => "Root",
	2 => "Directeur",
	3 => "Comptabilité",
	4 => "Employé",
	5 => "Utilisateur"
);

// Choix oui / non
//
$choice_yes_no = array (
	1 => "Oui",
	2 => "Non"
);

// Listage
//
$print_output = array (
	1 => "HTML",
	2 => "PDF"
);


// Prix nets
//
$sales_price = array (
	1 => "Net",
	2 => "Brut"
);


// E-Mail Priorité
//
$email_priority = array (
	3 => "Normalement",
	1 => "Haut",
	5 => "Faiblement"
);


// Statut d'ordre
//
$offer_status = array(
	1 => "Non accepté",
	2 => "Confirmation de commande",
	3 => "Facture"
);

?>
