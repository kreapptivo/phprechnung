<?php

/*
	spanish.php

	phpFactura - Un simple programa de facturación y administración de direcciónes.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

	Spanish translation by: 2005 - 2008 Markus Ehrlich < metatux at gmx dot net >

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

// Definiciones en - Español
//

$a = array (
	"welcome" => "Bienvenido a",
	"programname" => "phpFactura 1.6.4",
	"phprechnung" => "phpFactura 1.6.4 - Copyright &copy; 2001 - 2011 <a class='nmenulink' title='phpFactura Home' href='http://www.loenshotel.de/phpRechnung/' target='_blank'>&nbsp;Edy Corak&nbsp;</a>. Derechos reservados.",

	"admin" => "Administrador",

	"language" => "Idioma",
	"choose_language" => "Seleccionar Idioma",


	// Navegación
	//
	"logout" => "Salir",
	"startpage" => "Inicio",
	"addressbook" => "Directorio",
	"position" => "Posición",
	"offer" => "Presupuesto",
	"invoice" => "Factura",
	"credit_note" => "Abono",
	"payment" => "Pagos",
	"cashbook" => "Caja",
	"reports" => "Reportes",
	"configuration" => "Configuración",
	"message" => "Mensaje",
	"method_of_payment" => "Forma de Pago",
	"category" => "Categorías",
	"tax" => "IMPUESTO AL VALOR AGREGADO",
	"tax_short" => "Tax",
	"settings" => "Ajustes",
	"user_admin" => "Administración de Usuarios",
	"super_user" => "Administrador",
	"syslog" => "Syslog",
	"license" => "License",

	"list" => "Lista",
	"new" => "Nuevo",
	"search" => "Buscar",
	"detail_search" => "Buscar en detalle",
	"searchresult" => "Resultado de búsqueda",
	"help" => "Ayuda",

	"info" => "Información",
	"all_info" => "Todas las informaciones",


	// Acciones
	//
	"insert" => "Inscribir",
	"save" => "Guardar",
	"edit" => "Modificar",
	"edit_entry" => "Modificar bloque de datos",
	"change" => "Cambiar",
	"delete" => "Eliminar",
	"delete_entry" => "Eliminar bloque de datos",
	"cancel" => "Stornieren",
	"cancel_entry" => "Eintrag stornieren",
	"copy" => "Copiar",
	"copy_entry" => "Copiar bloque de datos",

	"print" => "Imprimir",
	"sort" => "Ordenar por",
	"choose" => "Seleccionar",
	"close" => "Cerrar",
	"close_window" => "Cerrar ventana",
	"choose_message" => "Seleccionar Mensaje",
	"back" => "Atrás",
	"next" => "Adelante",
	"accept" => "Accept",


	// En general
	//
	"date_text" => "Fecha",
	"number_text" => "Número",

	"page" => "Página",
	"firstpage" => "First page",
	"prevpage" => "Previous page",
	"nextpage" => "Next page",
	"lastpage" => "Last page",

	"canceled_entries" => "Show canceled entries",
	"not_canceled_entries" => "Show not canceled entries",
	"all_entries" => "Show all entries",

	"entry" => "Entrada/Inscripción",
	"no_entry" => "No hay bloques de datos.",
	"entry_no" => "Bloque de datos Nro.",
	"entries" => "Entradas",

	"new_entry" => "Bloque de datos ha sido agregado con éxito.",
	"entry_exist" => "Bloque de datos ya existe.",
	"entry_changed" => "Bloque de datos ha sido modificado con éxito.",
	"entry_deleted" => "Bloque de datos ha sido eliminado con éxito.",
	"entry_not_deleted" => "El bloque de datos no se puede eliminar.",
	"entry_canceled" => "Datensatz wurde storniert.",
	"entry_not_canceled" => "Datensatz kann nicht storniert werden.",
	"field_error" => "El campo no ha sido llenado correctamente.",
	"invoice_issued" => "Para este bloque de datos ya existen facturas.",
	"payment_issued" => "Para este bloque de datos ya existen pagos.<br />
		Para modificar esta factura tendrá que eliminar primero el ingreso de pago.",
	"position_used" => "Este bloque de datos se esta usando en facturas.",
	"offer_used" => "Para este bloque de datos ya se han hecho facturas.<br />
		Para modificar este Presupuesto tendrá que eliminar primero la factura.",
	"invalid_date" => "La fecha no es correcta. Favor rectificar y redactar. e. g. 01.01.1970",


	// Ingreso/Entrada
	//
	"login_title" => "Entrada",
	"login" => "Entrar",
	"login_to" => "Entrar a",
	"loggedin" => "Usuario actual",
	"user_active" => "Usuario activa",
	"fullname" => "Nombre",
	"username" => "Nombre Usuario",
	"usergroup" => "Grupo",
	"password" => "Contraseña",
	"repeat_password" => "Repetir contraseña",
	"password_error" => "La primera y la segunda contraseña tienen que ser identicas.",
	"login_error" => "Entrada sin éxito. Por favor intentarlo nuevamente.",
	"login_end" => "Entrada con éxito. Gracias por usar",
	"session_end" => "Sessión cerrada. No hubo acción durante un tiempo.",
	"no_permission" => "Usted no tiene permiso para ver esta Página.",


	// Directorio
	//
	"print_name" => "Imprimir nombre",
	"prefix" => "Sexo/Encabezamiento",
	"firstname" => "Nombre",
	"lastname" => "Apellido",
	"title" => "Título",
	"company" => "Empresa",
	"department" => "Extensión",
	"postalcode" => "Código postal",
	"city" => "Ciudad",
	"country" => "País",
	"stateprov" => "Departamento",
	"address" => "Calle",
	"position1" => "Posición",
	"initials" => "Iniciales",
	"salutation" => "Encabezamiento",
	"phonehome" => "Tel. (Privado)",
	"phoneoffi" => "Tel. (Oficina)",
	"phoneothe" => "Tel. (Otros)",
	"phonework" => "Tel. (Trabajo)",
	"mobile" => "Tel. (Móvil)",
	"pager" => "Beeper",
	"fax" => "Fax",
	"email" => "E-Mail",
	"url" => "Página web",
	"note" => "Nota",
	"url2" => "Página web 2",
	"email2" => "E-Mail 2",
	"altfield1" => "Campo usuario 1",
	"altfield2" => "Campo usuario 2",
	"cust_method_of_payment" => "Forma de Pago",
	"birthday" => "Fecha de Cumpleaños e. g. 01.01.1970",
	"select_all" => "Todos",
	"envelope" => "Calculación",
	"issue_invoice" => "Hacer factura para",
	"issue_offer" => "Hacer presupuesto para",
	"issue_credit_note" => "Hacer abono para",
	"customer" => "Cliente",
	"customer_no" => "Nro. Cliente",
	"customer_no_initials" => "CU",
	"choose_customer" => "Seleccionar Cliente",
	"find_customer" => "Introducir: Nombre, Apellido o Empresa para buscar.",
	"basic_info" => "Info",
	"extended_info" => "Extended information",
	"auth_info" => "Authentification",


	// E-Mail
	//
	"email_priority" => "Prioridad",
	"email_from" => "Remitente",
	"email_to" => "A",
	"email_cc" => "Copia (Cc)",
	"email_bcc" => "Copia ciega (Bcc)",
	"email_subject" => "Asunto",
	"email_text" => "Mensaje",
	"email_send" => "Enviar E-Mail",
	"email_ok" => "E-Mail se ha enviado a",
	"email_error" => "Error: El E-Mail no se ha podido enviar.",
	"email_html" => "E-Mail HTML",
	"email_text" => "E-Mail Texto",
	"email_pdf" => "E-Mail Adjunto-PDF",


	// Tablero posiciones
	//
	"pos_active" => "Posición activa",
	"pos_inactive" => "Posición inactiva",
	"pos_all" => "Mostrar todas las Posiciones",
	"pos_name" => "Posición / Artículo",
	"pos_text" => "Descripción",
	"pos_quantity" => "Cantidad",
	"pos_price" => "Precio",
	"pos_amount" => "Monto",
	"pos_choose" => "Seleccionar posición",
	"pos_new" => "Ingresar nueva Posición",
	"pos_print" => "Imprimir posición",
	"pos_group" => "Gruppe",
	"pos_inventory" => "Existencias",
	"pos_search" => "Introducir: Posición / Artículo o Descripción para buscar.",


	// Tablero impuestos
	//
	"tax_divide" => "Divido por",
	"tax_multiply" => "Multiplicado con",
	"tax_description" => "I.V.A. Descripción",


	// Ajustes
	//
	"basic_settings" => "Basic settings",
	"company_settings" => "Company settings",
	"pdf_settings" => "PDF settings",
	"print_company_data" => "Imprimir datos de empresa",
	"print_position_name" => "Imprimir nombre de posición",
	"print_output" => "Imprimir",
	"company_logo" => "Logotipo empresa",
	"company_logo_width" => "Amplitud logotipo",
	"company_logo_height" => "Altura logotipo",
	"company_name" => "Nombre de empresa",
	"company_address" => "Dirección",
	"company_postal" => "Código postal",
	"company_city" => "Ciudad",
	"company_country" => "País",
	"company_phone" => "Teléfono",
	"company_fax" => "Telefax",
	"company_email" => "E-Mail",
	"company_url" => "Página Web",
	"company_wap" => "WAP",
	"company_currency" => "Moneda",
	"company_tax_free" => "Impuesto libremente",
	"sales_prices" => "Precios de Venta son",
	"company_taxnr" => "RUC/RUS Nro.",
	"business_taxnr" => "Numero registro A.E.A.T.",
	"bank_name" => "Datos de banco",
	"bank_account" => "Nro. de Cuenta.",
	"bank_number" => "Código bancario",
	"bank_iban" => "IBAN",
	"bank_bic" => "BIC",
	"email_internal" => "E-Mail interno",
	"email_use_signature" => "Usar firma",
	"email_signature" => "Firma",
	"stock_active" => "Existencias activas",
	"reminder" => "Recordatorio de pago",
	"reminder_price" => "Multa por amonestación",
	"reminder_days" => "Remind after day(s)",
	"entries_per_page" => "Entradas por página",
	"session_sec" => "Sessión Seg.",
	"pdf_font" => "Font",
	"pdf_text1" => "Font size 1",
	"pdf_text2" => "Font size 2",
	"pdf_text3" => "Font size e. g. Invoice",
	"pdf_dir" => "TMP-Directory",
	"pdf_attachment_text" => "Texto adjunto PDF",


	// Presupuesto
	//
	"save_offer" => "Guardar presupuesto",
	"print_offer" => "Imprimir presupuesto",
	"print_order" => "Imprimir orden",
	"change_offer" => "Modificar presupuesto",
	"copy_offer" => "Copiar presupuesto",
	"status" => "Estado actual",
	"order" => "Orden",
	"change_status" => "Modificar estado actual",
	"offer_initials" => "A",
	"order_initials" => "OR",
	"offer_number" => "Presupuesto Nro.",
	"order_number" => "Orden Nro.",
	"offer_subtotal" => "Monto neto",
	"offer_tax1" => "I.V.A. 1",
	"offer_tax2" => "I.V.A. 2",
	"offer_tax3" => "I.V.A. 3",
	"offer_amount" => "Monto total",
	"email_offer" => "Presupuesto por E-Mail a:",
	"email_order" => "E-Mail order to:",
	"was_send" => "ha sido enviado por E-Mail a",


	// Factura
	//
	"save_invoice" => "Guardar factura",
	"print_invoice" => "Imprimir factura",
	"copy_invoice" => "Rechnung kopieren",
	"change_invoice" => "Modificar factura",
	"open_account" => "Saldo abierto",
	"invoice_initials" => "FA",
	"invoice_number" => "Recibo Nro.",
	"invoice_subtotal" => "Monto neto",
	"invoice_tax1" => "I.V.A. 1",
	"invoice_tax2" => "I.V.A. 2",
	"invoice_tax3" => "I.V.A. 3",
	"invoice_amount" => "Monto total",
	"transaction" => "Ingreso de pago",
	"invoice_transaction" => "Ingreso de pago para Recibo Nro.",
	"open_invoice" => "Factura abierta",
	"email_invoice" => "Factura por E-Mail a:",
	"invoice_was_send" => "Factura ha sido enviado por E-Mail a",
	"open_since" => "Abierta desde dia(s)",
	"invoice_deletion" => "Eliminando esta factura, quedaría<br />
		el estado de la contabilidad en disminución!",
	"delivery_note" => "Lieferschein",
	"print_delivery_note" => "Lieferschein drucken",
	"delivery_note_initials" => "LS",
	"delivery_note_number" => "Lieferschein-Nr.",
	"email_delivery_note" => "Lieferschein per E-Mail an:",


	// Abono
	//
	"credit_note_number" => "Abono Nro.",
	"credit_note_redeemed" => "Hecho efectivo",
	"credit_note_initials" => "Ab",


	// Pago/Ingreso
	//
	"save_payment" => "Guardar ingreso de pago",
	"print_payment" => "Imprimir ingreso de pago",
	"change_payment" => "Modificar ingreso de pago",
	"payment_number" => "Ingreso de Pago Nro.",
	"payment_sum" => "Bezahlt",
	"total_payment" => "Gesamt",
	"card_number" => "Tarjeta de Crédito Nro.",
	"valid_thru" => "Válida hasta",
	"outstanding_payment" => "Solo se muestran Clientes con facturas abiertas.",
	"payment_error" => "Zahlung ist bereits vorhanden.",
	"payment_incorrect" => "Aumento de ingreso de pago imposible.<br /><br /> Ingreso de Pago tiene que ser igual al Monto total.",
 	"payment_deletion" => "Eliminando este ingreso de pago, quedaría<br />
		el estado de la contabilidad en disminución!",


	// Reportes
	//
	"select_report" => "Seleccionar reporte",
	"customer_sales" => "Ventas por cliente",
	"position_sales" => "Ventas por Posición/Artículo",
	"invoice_totals" => "Registro salida de facturas",
	"booking_details" => "Detalles de ingresos por fecha",
	"individual_values" => "Valores detallados",
	"summary" => "Resúmen",
	"date_from" => "del",
	"date_till" => "hasta",


	// Caja
	//
	"cash_in_hand" => "Activo disponible",
	"starting_with" => "Activo disponible al inicio",
	"takings" => "Ingresos",
	"expenditures" => "Egresos",
	"cashbook_number" => "Recibo Nro.",
	"cashbook_description" => "Descripción",
	"takings_expenditures_error" => "Ingresos y Egresos no pueden ser registrados al mismo tiempo.",
	"cashbook_expenditures" => "Usted no puede gastar más de lo que hay en la Caja.",


	// Syslog
	//
	"syslog_description" => "Beschreibung",
	"syslog_created" => "Datum / Zeit",
);


// Reportes
//
$reports = array (
	"booking_details.php" => "Detalles ingresos por - Fecha",
	"invoice_ledger.php" => "Registro Egresos",
	"outstanding_accounts.php" => "Facturas abiertas",
	"invoice_ledger_summary.php" => "Ventas por Clientes - Resúmen",
	"cashbook.php" => "Registro caja",
	"position_sales_summary.php" => "Ventas por Posición/Artículo - Resúmen",
	"position_sales.php" => "Ventas por Posición/Artículo - Valores detallados",
	"outstanding_offers.php" => "Presupuestos no avanzados"
);


// Reportes clientes
//
$customer_reports = array (
	"../reports/customer_booking_details.php" => "Detalles de ingresos por - Fecha",
	"../reports/customer_invoices.php" => "Caja de gastos",
	"../reports/customer_outstanding_accounts.php" => "Facturas no pagadas"
);


// Idioma
//
$language = array (
	1 => "Alemán",
	2 => "Inglés",
	3 => "Polaco",
	4 => "Croata",
	5 => "Francés",
	6 => "Italiano",
	7 => "Español - ES",
	8 => "Holandés"
);


// Grupo
//
$group = array (
	1 => "Root",
	2 => "Encargado",
	3 => "Contabilidad",
	4 => "Empleado",
	5 => "Usuario"
);

// Seleccion
//
$choice_yes_no = array (
	1 => "Si",
	2 => "No"
);


// Formato de impresión
//
$print_output = array (
	1 => "HTML",
	2 => "PDF"
);

// Precios neto
//
$sales_price = array (
	1 => "Neto",
	2 => "Bruto"
);


// Prioridades E-Mail
//
$email_priority = array (
	3 => "Normal",
	1 => "Alta",
	5 => "Baja"
);


// Estado actual de ordenes
//
$offer_status = array(
	1 => "No recibido",
	2 => "Confirmación de orden",
	3 => "Factura"
);

?>
