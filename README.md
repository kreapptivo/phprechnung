# phpRechnung

phpRechnung ist ein einfach-zu-benutzendes Rechnungsprogramm.

Mit phpRechnung können Sie folgende Aufgaben erledigen:
Adressbuch und Positionen / Artikel verwalten, Angebote und Rechnungen erstellen
Zahlungen vornehmen, Kassenbuch und offene Posten verwalten ...
Berichte erstellen: Buchungsdetails, Rechnungsausgangsbuch ...

Sprachen:
Deutsch, Englisch, Französisch, Italienisch, Kroatisch, Niederländisch, Polnisch und Spanisch.


Aus Basis  Edy Corak  "Edy's phpRechnung" unter https://www.loenshotel.de/phpRechnung

Letzter Version von "Edy's phpRechnung" war 1.6.4 (Stand von 2011)

Lizenz: GPLv2


## Requirements


### Server:

* Webserver: Apache, Lighttpd, nginX oder auch ( Microsoft IIS - nicht getestet )

* PHP:
	PHP Version 5 - ( mbstring, PEAR::Mail, Mail_Mime )

* DB: 
	MySQL Version 5 oder 4 (oder MariaDB, zukünftig über PDO auch Postgres)

* MailServer:
	Postfix, Exim, Sendmail...

### Client:

* Browser: z. B. Firefox, Konqueror, Safari, Opera, Google Chrome ... ( Javascript muss eingeschaltet sein )

* PDF-Betrachter

## Installation

### Wichtig:
Unter Einstellung muss eine korrekte E-Mail Adresse eingetragen
werden, da ansonsten der E-Mail Versand nicht funktioniert.
Das selbe gilt auch, wenn ein Relay-Server benutzt wird,
da ansonsten die E-Mail's vom Relay-Server abgewiesen werden.

Wenn Sie keinen eigenen E-Mail Server haben, dann stellen Sie
bitte in der Datei /include/phprechnung.inc.php die Variable
$PHPSendMail = ""; auf $PHPSendMail = "1"; ein.

In der Datei /include/mail.inc.php muessen noch Aenderungen vorgenommen werden Host, Port und falls Anmeldung notwendig ist, $Smtp["auth"] auf true zu stellen und $Smtp["username"] und $Smtp["password"] eintragen.

	$Smtp["host"] = "ihrmailserver";
	$Smtp["port"] = "25";
	$Smtp["auth"] = false;
	$Smtp["username"] = "";
	$Smtp["password"] = "";

### Dateien entpacken, kopieren und Berechtigungen setzen

phpRechnung_1_6_4.tar.gz entpacken 
  tar -zxvf phpRechnung_1_6_4.tar.gz

Das Verzeichnis 'phpRechnung_1_6_4' auf den Webserver kopieren, z. B. /var/www Sie koennen das Verzeichnis auch umbenennen.

Seit phpRechnung 1.6 RC1 wird Smarty Template Engine verwendet. Damit das ganze funktioniert, muessen noch einige Aenderungen vorgenommen werden.
	
Der Webserver muss fuer die Verzeichnise '/include/smarty/cache' und '/include/smarty/templates_c' Schreibrechte bekommen.

*Es wird empfohlen ein Verzeichnis außerhalb des DocumentRoot zu verwenden*

Das gilt auch fuer die Verzeichnise '/include/smarty/templates' und '/include/smarty/configs'

Nach den Änderungen muessen Sie dies auch phpRechnung mitteilen.

In '/include/smarty.inc.php' folgende Variablen anpassen:
	$Templateroot und $Cacheroot von $_SERVER['DOCUMENT_ROOT']."phpRechnung";
	
aendern in z. B.:

	$smarty->template_dir = "/var/www/include/smarty/templates";
	$smarty->config_dir = "/var/www/include/smarty/configs";
	$smarty->compile_dir = "/var/www/include/smarty/templates_c";
	$smarty->cache_dir = "/var/www/include/smarty/cache";

Achten Sie bitte auf eine korrekte Schreibweise!


### Datenbank erstellen (Erstinstallation):

Dieser Schritt ist nur fuer eine Neu-Installation gedacht.
Wenn Sie ein UPDATE von phpRechnung durchfuehren möchten, dann lesen Sie bitte unter UPDATE weiter.

	mysqladmin -u 'benutzername' -p create phprechnung

Tabellen erstellen:

	mysql -u 'benutzername' -p phprechnung < phprechnung_1_6_4.sql

Falls kein 'root' Zugriff vorhanden, dann am besten 'phpMyAdmin' benutzen.

Zuerst Datenbank erstellen, waehlen Sie dann die Datenbank aus, dann Importieren,	Datei dursuchen, passende SQL Datei auswaehlen: phprechnung_1_6_4.sql, Zeichencodierung der Datei 'latin1' waehlen und auf OK klicken.

Sie sollten dann z. B. folgende Meldung sehen:
	Der Import wurde erfolgreich abgeschlossen, 127 Abfragen wurden ausgefuehrt.

Folgende Dateien muessen geändert werden, damit man auf die neu erstellte Datenbank 'phprechnung' zugreifen kann:

Für die Datenbankverbindung 
  'include/dbconf.php'
  
	_DBHOST z. B. "localhost"
	_BBUSER z. B. "benutzername"
	_DBPASS z. B. "benutzerpasswort"
	_DBNAME z. B. "phprechnung"

Der _DBUSER muss ueber ausreichende Rechte auf dem Datenbankserver verfuegen - Erstellen, Aendern, Loeschen etc.

	'phprechnung.inc.php'
	
( wichtig ist die Variable "$web" dort bitte eigene Webadresse zu phpRechnung eintragen ) z. B. http://ihrserver/phpRechnung ( ohne '/' am Ende ) da sonst die Weiterleitung nicht funktioniert.

Fuer die Benutzer die phpRechnung auf einem Windows Server betreiben,	bitte unter Konfiguration/Einstellung den Wert von TMP-Verzeichnis anpassen. Standard ist '/tmp/' in z. B. : 
  'c:\windows\temp\'

Bitte beachten Sie den letzten Backslash. Wichtig. Der Webserver muss Schreibrechte fuer das Verzeichnis haben.
	
Auf einem Windows Server bitte auch 'session.save_path' ueberpruefen.

Standard ist session.save_path = /tmp
Wenn das der Fall ist, dann bitte ändern in z. B. 
  session.save_path = c:\windows\temp

### Login:

Administrator: admin, admin

Die Benutzerdaten sind in der Tabelle 'user' verschlüsselt gespeichert

Nach der Ersten Anmeldung werden Sie aufgefordert die phpRechnung Lizenz ( GPL v2 ) zu akzeptieren.
Dieses Vorgehen ist fuer jeden Benutzer einmalig notwendig.

Das Administrator-Passwort kann geändert werden, nur der Anmeldename 'admin' darf nicht verändert werden. Ansonsten werden die Berechtigungen für den Administrator nicht mehr gesetzt!


Bitte haben Sie Verständnis, dass der ursprüngliche Autor Edy Corak < edy at loenshotel dot de > direkte Anfragen zu phpRechnung aus Zeitgründen leider nicht mehr beantworten kann.

Ursprüngliche phpRechnung Homepage - http://www.loenshotel.de/phpRechnung/

@Edy Corak: Vielen Dank für die Arbeit und diese sehr praktische Anwendung!

Vielen Dank fuer die Nutzung von phpRechnung
