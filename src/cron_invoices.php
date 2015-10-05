<?php

/****
 * Regelmäßige Rechnungen automatisch "kopieren" und verschicken
 */

 require_once ("include/phprechnung.inc.php");

function new_invoice_ID() {
	global $db, $TBLName;
	// FORM new Rechnungs_ID
	// Get the last entry from table 'invoice'
	//
	$res = $db->GetRow ( "SELECT MAX(INVOICEID) AS MAX_INVOICEID FROM {$TBLName}invoice" );
	if ($res === false)
		throw new Exception ( $db->ErrorMsg () );
	
	return $res ['MAX_INVOICEID'];
}
$RE_DATE = time ();
$RE_DATE_STR = date ( 'Y-m-d', $RE_DATE );
$Username = "CRON";
$Usergroup1 = 1;
$Usergroup2 = 2;

// EMail-Settings
$EmailCC = '';
$EmailBCC = '';
$EmailPriority = '3'; // 3 = Normal, 1= High, 5 = Low

$new_invoice_ids = array ();

// Database connection
//
DBConnect ();

//TODO: Neue Rechnungstabellen für Rechnungsvorlagen
//TODO: Neuer Menüpunkt, Smarty-Vorlage, etc...

// 1. alle "Vorlagen" für heutigen Rechnungslauf auslesen
// TODO: SQL-Abfrage für Rechnungen, die heute fällig sind
//Start_Datum
//Intervall (Monat, Jahr, Quartal,...)
//neues Ausführungsdatum berechnen
$invoice_ids = array (
		'39' 
);

// 2. Rechnungen kopieren

// +1 Monat
$RE_DATE_NEXT_MONTH = strtotime ( "+1 MONTH", $RE_DATE );
// +1 Jahr
$RE_DATE_NEXT_YEAR = strtotime ( "+1 YEAR", $RE_DATE );

// Folgende Platzhalter werden dabei ersetzt
$replace = array (
		'%MONTH_NAME%' => strftime ( '%B', $RE_DATE ),
		'%MONTH_NO%' => strftime ( '%m', $RE_DATE ),
		'%YEAR%' => strftime ( '%Y', $RE_DATE ),
		
		'%NEXT_MONTH_NAME%' => strftime ( '%B', $RE_DATE_NEXT_MONTH ),
		'%NEXT_MONTH_NO%' => strftime ( '%m', $RE_DATE_NEXT_MONTH ),
		'%NEXT_MONTH_YEAR%' => strftime ( '%Y', $RE_DATE_NEXT_MONTH ),
		
		'%NEXT_YEAR_MONTH_NAME%' => strftime ( '%B', $RE_DATE_NEXT_YEAR ),
		'%NEXT_YEAR_MONTH_NO%' => strftime ( '%m', $RE_DATE_NEXT_YEAR ),
		'%NEXT_YEAR%' => strftime ( '%Y', $RE_DATE_NEXT_YEAR ) 
);

foreach ( $invoice_ids as $invoiceID ) {
	
	// Copy Invoice
	$sql = "INSERT INTO {$TBLName}invoice (MYID, INVOICE_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, TOTAL_AMOUNT, NOTE, PAID, SUM_PAID, CANCELED, CREATEDBY, MODIFIEDBY, USERGROUP1, USERGROUP2, CREATED, MODIFIED)
			SELECT MYID, '{$RE_DATE_STR}' AS INVOICE_DATE, MESSAGEID, MESSAGE_DESC, METHODOFPAYID, METHOD_OF_PAY, METHOD_OF_PAY_DATE, TAX1_TOTAL, TAX2_TOTAL, TAX3_TOTAL, TAX1_DESC, TAX2_DESC, TAX3_DESC, SUBTOTAL1, SUBTOTAL2, SUBTOTAL3, TOTAL_AMOUNT, NOTE, '2' AS PAID, '' AS SUM_PAID, '2' AS CANCELED, '{$Username}' AS CREATEDBY,  '{$Username}' AS MODIFIEDBY, '{$Usergroup1}' AS USERGROUP1, '{$Usergroup2}' AS USERGROUP2, NOW() AS CREATED, NOW() AS MODIFIED FROM {$TBLName}invoice WHERE INVOICEID=$invoiceID LIMIT 1";
	
	if ($db->Execute ( $sql ) === false)
		throw new Exception ( $db->ErrorMsg () );
		
		// $newInvoiceID = new_invoice_ID();
	$newInvoiceID = $db->PO_Insert_ID (); // Verwende die INVOICEID der letzten Einfüge-Operation!
	                                     
	// Copy Positions
	$sql = "INSERT INTO {$TBLName}invoicepos  (MYID, INVOICEID, POSITIONID, POS_DESC, POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE)
			SELECT MYID, '{$newInvoiceID}' AS INVOICEID, POSITIONID, ";
	$sql .= str_repeat ( "REPLACE(", count ( $replace ) );
	$i = 0;
	foreach ( $replace as $name => $value ) {
		$i ++;
		if ($i <= 1)
			$sql .= "POS_DESC,";
		$sql .= "'{$name}','{$value}'),";
	}
	$sql = substr ( $sql, 0, - 1 ) . " AS POS_DESC, ";
	$sql .= "POS_QUANTITY, POS_PRICE, POS_GROUP, TAX, TAX_DESC, TAX_MULTI, TAX_DIVIDE FROM {$TBLName}invoicepos WHERE INVOICEID=$invoiceID ORDER BY POSITIONID";
	//DEBUG: var_dump ( $sql );
	if ($db->Execute ( $sql ) === false)
		throw new Exception ( $db->ErrorMsg () );
	$new_invoice_ids [] = $newInvoiceID;
}

// 3. Rechnungen per Email verschicken (bcc an ???)

foreach ( $new_invoice_ids as $invoiceID ) {
	// Get Invoice and Receiver Informations
	//
	$sql = "SELECT A.PREFIX, A.TITLE, A.FIRSTNAME, A.LASTNAME, A.EMAIL, A.ADDRESS, A.COMPANY, A.POSTALCODE, A.PRINT_NAME, A.CITY, A.COUNTRY, A.SALUTATION, A.MYID, 
			DATE_FORMAT(I.INVOICE_DATE,'%d.%m.%Y') AS INVOICE_DATE, I.INVOICEID, I.TOTAL_AMOUNT, I.MYID, I.CREATEDBY, I.PAID, I.MESSAGE_DESC,
			I.METHOD_OF_PAY, DATE_FORMAT(I.METHOD_OF_PAY_DATE,'%d.%m.%Y') AS METHOD_OF_PAY_DATE, I.TAX1_TOTAL, I.TAX2_TOTAL, I.TAX3_TOTAL, I.TAX4_TOTAL, I.TAX1_DESC, I.TAX2_DESC, I.TAX3_DESC, I.TAX4_DESC, I.SUBTOTAL1, I.SUBTOTAL2, I.SUBTOTAL3, I.SUBTOTAL4 
			FROM {$TBLName}invoice AS I LEFT JOIN {$TBLName}addressbook AS A USING (MYID) WHERE INVOICEID={$invoiceID} LIMIT 1";
	$query = $db->Execute( $sql );
	if ($query === false)
		throw new Exception ( $db->ErrorMsg () );
	
	$f = $query->GetRowAssoc();
	
	var_dump($f);
	
	$Print_Company_Name = $f ['PRINT_NAME'];
	$Date = $f ['INVOICE_DATE'];
	$ID = $f ['INVOICEID'];
	$EmailTo = $f ['EMAIL'];
	$CreatedBy = $f ['CREATEDBY'];
	$MYID = $f ['MYID'];
	$TITLE = $f ['TITLE'];
	$PREFIX = $f ['PREFIX'];
	$FIRSTNAME = $f ['FIRSTNAME'];
	$LASTNAME = $f ['LASTNAME'];
	$COMPANY = $f ['COMPANY'];
	$ADDRESS = $f ['ADDRESS'];
	$CITY = $f ['CITY'];
	$POSTALCODE = $f ['POSTALCODE'];
	$COUNTRY = $f ['COUNTRY'];
	$SALUTATION = $f ['SALUTATION'];
	$PAID = $f ['PAID'];
	$METHOD_OF_PAY = $f ['METHOD_OF_PAY'];
	$METHOD_OF_PAY_DATE = $f ['METHOD_OF_PAY_DATE'];
	$SUBTOTAL1 = $f ['SUBTOTAL1'];
	$SUBTOTAL2 = $f ['SUBTOTAL2'];
	$SUBTOTAL3 = $f ['SUBTOTAL3'];
	$SUBTOTAL4 = $f ['SUBTOTAL4'];
	$TAX1 = $f ['TAX1_TOTAL'];
	$TAX2 = $f ['TAX2_TOTAL'];
	$TAX3 = $f ['TAX3_TOTAL'];
	$TAX4 = $f ['TAX4_TOTAL'];
	$TAX1_DESC = $f ['TAX1_DESC'];
	$TAX2_DESC = $f ['TAX2_DESC'];
	$TAX3_DESC = $f ['TAX3_DESC'];
	$TAX4_DESC = $f ['TAX4_DESC'];
	$TOTAL = $f ['TOTAL_AMOUNT'];
	$MESSAGEID = $f ['MESSAGE_DESC'];
	
	$PrintD = Print_Date ( $Date );
	
	$FileName = "$a[invoice_initials]-$PrintD-" . str_pad ( $ID, 3, '0', STR_PAD_LEFT );
	$Subject = "$a[invoice] $FileName, $a[customer_no]: $MYID, $a[date_text]: $Date";
	
	// $_SESSION ['Type'] = "$a[invoice_number]"; //No Session for CRON!
	$sendfile = $FileName . '.pdf';
	
	$posquery = $db->Execute ( "SELECT P.POSITIONID, P.POS_NAME, V.INVOICEID, V.POSITIONID, V.POS_DESC,
			V.POS_QUANTITY, V.POS_PRICE, V.TAX, V.TAX_DIVIDE, V.TAX_MULTI, V.TAX_DESC FROM {$TBLName}article AS P, {$TBLName}invoicepos AS V WHERE P.POSITIONID=V.POSITIONID AND V.INVOICEID=$invoiceID ORDER BY V.POS_GROUP ASC, V.INVOICEPOSID ASC" );
	
	// Print text if invoice is paid
	//
	$paid = $db->Execute ( "SELECT METHOD_OF_PAY, INVOICEID, SUM_PAID, DATE_FORMAT(PAYMENT_DATE,'%d.%m.%Y') AS PAYMENT_DATE
			FROM {$TBLName}payment WHERE CANCELED=2 AND INVOICEID=$invoiceID" );
	
	require_once ('include/pdf.inc.php');
	
	if (! empty ( $EmailTo )) {
		require_once ("include/mail.inc.php");
		
		Email ( $EmailTo, $EmailCC, $EmailBcc, $EmailPriority, $Subject, $CompanyPdfAttachmentText, $sendfile, $sendfile_content );
		
		// if(isset($sendfile)) unlink($sendfile);
		
		$Description = QuoteString ( "$Subject was send by user $Username from $IPAddress to E-Mail: $EmailTo" );
		$query2 = "INSERT INTO {$TBLName}syslog (SYSLOGID, CREATED, DESCRIPTION, CREATEDBY, USERGROUP1, USERGROUP2)";
		$query2 .= "VALUES(NULL, " . $db->sysTimeStamp . ", $Description, 'admin', '1', '2')";
		
		if ($db->Execute ( $query2 ) === false)
			throw new Exception ( $db->ErrorMsg () );
	}
}
// ENDE
?>