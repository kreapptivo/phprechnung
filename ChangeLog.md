#ChangeLog


## Changes in phpRechnung 1.6.4, 31.01.2011

* FormatDBNumber has been fixed.


## Changes in phpRechnung 1.6.3, 27.01.2011

* Problem creating initial cashbook entry was fixed.

* Simple credit note function was added. You can create invoices with negative total amount.
  By choosing 'bar/cash' as method of payment, cash book will be also automatically updated.

* If PrintCompanyData was disabled the Company Data was also not included by sending invoice as PDF-Attachment. fixed.

* minor bugs were fixed

## Changes in phpRechnung 1.6.2, 05.01.2011

This is a Bugfix-Only-Release.

* Last Site Redirection missing query was fixed
* syslog_syslogid_seq was disabled
* minor bugs were fixed


## Changes in phpRechnung 1.6.1, 08.12.2010

This is a Security Bugfix-Only-Release.

A security issue affects the following phpRechnung releases:

 **phpRechnung <= 1.6**

* There are security vulnerabilities in phpRechnung 1.6 which allow an unauthorized user to have read access of the data.
It is strongly recommendend to update your phpRechnung <= 1.6 to version 1.6.1 as soon as possible.

## Changes in phpRechnung 1.6, 03.12.2010

This is a Security Bugfix-Only-Release.

A security issue affects the following phpRechnung releases:
  **phpRechnung <= 1.6 RC2**

It is strongly recommendend to update your phpRechnung <= 1.6 RC2 to version 1.6 as soon as possible.

There are multiple security vulnerabilities in phpRechnung 1.6 RC2 which allow an unauthorized user to take control of the software.

Thank's to Brendan Coles for testing and reporting this security issues.

* Several warnings have been fixed
* Improved E-Mail function ( mbstring, PEAR::Mail, Mail_Mime is required )
* Minor bugs have been fixed
* FPDF was updated to version 1.6


##Changes in phpRechnung 1.6 RC2, 12.07.2008

There are no new features in this release.

This is a Bugfix-Only-Release.

* Addressbook
  * Fix Detail Search non existing fields removed
  * Fix customer info error if message was missing

* Reports: Fix out of memory

  Note:
  When creating very large PDF Documents there is a memory limit.
  I have created reports with 457 pages approx. 17130 entries without any problems
  php.ini -> memory_limit = 16M;

* Offer / Invoice: Show only active positions
  * Fix Offer when updating 'OfferStatus'

* Update
 Rename the directory to /updatetable to prevent errors when unpacking the archive on Windows

* phprechnung.inc.php

  Easy change of Number Format ( function Format_Number )
  
* **2001081** - phpRechnung 1.6 RC1 - Update - Offer Status

* **2001200** - phpRechnung 1.6 RC1 - Update - Addressbook - PrintName
  Fix Addressbook when updating 'PositionName'

* **2004968** -  phpRechnung 1.6 RC1 - Useradministration - admin
  Fix Usergroup1, Usergroup2 'admin'

* **2010827** - Position - Group
  Fix wrong table name

* **2012232** - Addressbook Info - Print
  Fix old / non existing fields

## Changes in phpRechnung 1.6 RC1, 16.06.2008

* phpRechnung 1.6 RC1 is a total rewrite.
* phpRechnung is Valid XHTML 1.0 Transitional
* phpRechnung now has Dutch translation => Thank's to Jerry van Kranenburg
* Smarty Template Engine was included ( 2.6.19 )
	Smarty is released under GNU LGPL
	Copyright 2001-2005 New Digital Group, Inc.

* ADOdb library was included ( adodb498 )
	ADOdb is released under both BSD license and
	Lesser GPL library license.
	(c) 2000-2005 John Lim (jlim#natsoft.com.my).
	All rights reserved.

* Many improvements
  * Accesskey's
    * Alt+W - Startpage
    * Alt+A - Addressbook
    * Alt+P - Position
    * Alt+O - Offer
    * Alt+I - Invoice
    * Alt+N - Creditnote
    * Alt+M - Payment
    * Alt+C - Cashbook
    * Alt+R - Reports
    * Alt+S - Configuration
    * Alt+U - Super User
    * Alt+L - Logout

  * Submenu can be reached by pressing Alt+1, for first entry and so on....
    Will not work if you have more than one tab open.

  * phpRechnung Project Home page http://sourceforge.net/projects/phprechnung/

##Changes in phpInvoice 1.6 Test3.01, 09.04.2006

There are no new features in this release; only small corrections.
$pdfdir is now set to "/tmp/" in phprechnung.inc.php to prevent errors
when sending invoices or offers by email.

Format cleaning was done in some files.


##Changes in phpInvoice 1.6 Test3, 02.10.2005

* Now the default language is set to english. You can change the language in /include/sprache.inc.php for the login screen and in the SQL or Configuration part for the users.
* phprechnung.inc.php, $PHPSendMail
	Send email, now you can choose between
	PEAR Mail::Interface -> $PHPSendMail = "1"
	or mail() Function -> $PHPSendMail = "0"
	Default is $PHPSendMail = "0"

* Fixed PDF-Output, so that long lines now can be displayed correctly. ( Print, E-Mail )
		
* Changes can be made in /include pdf.inc.php, pdf_footer.inc.php, pdf_header.inc.php

* small corrections and fixes

## Changes in phpInvoice 1.6 Test2, 	24.06.2005

* /rechnung, /angebot ( invoice, offer )
	You have a choice to choose ( checkbox ) between the fulltext or the old style search method.

* README - is now available also in spanish and english language
* README-ES, README-EN
	thank's to Markus Ehrlich for the spanish translation.
	< phpfactura at gmx dot net >
	< phpfactura at ecorak dot net >

	Other languages are welcome.

*  /position,
	The Lists shows now only active positions as standard view.
	You can use the arrows on the left side from position name to sort the list by inactive, active- or all positions.

*  phpInvoice speaks now also Spanish
	thank's to Markus Ehrlich for the work and help.
	< ecscom dot net at gmx dot net >

*  phpInvoice speaks now also Italian
	thank's to Alfredo Patti for the work and help.
	< a dot patti at web dot de >

*  /adressbuch ( addressbook ),
	1 new field FULLTEXT (FIRSTNAME,LASTNAME,COMPANY)
	phpInvoice addressbook use now fulltext search as standard.
	You must enter the whole Lastname, Firstname or Company, otherwise you will not be able to find anything.
	If you don't want to use the fulltext search, so please use the detail-search.

* /position,
	New fields
	POS_MARKE, POS_TYPE, POS_SERIENNR,
	POS_LAGER, POS_LAGER_AKTUELL, POS_LAGER_EINKAUF
	( This is preparation for the stock management in phpInvoice 1.6 Final ) 
 	angebotpos, tmp_angebot, tmp_angebotpos, tmp_gutschrift, tmp_rechnung, tmp_verkauf, verkauf
	- ( offer position, tmp offer, tmp offer position, tmp credit note,
	  tmp invoice, tmp sales position, tmp sales )
	New fields POS_MARKE, POS_TYPE, POS_SERIENNR, NOTE
	Thank's to Maximilian Csuk and Karl Deutsch for the extensions.

* /rechnung, /zahlung, /kassenbuch, /angebot, /gutschrift, /position
	- ( invoice, payment, cash book, offer, credit note, position )
	Price input was changed
	Walid inputs are: e. g. 1000 1000.00 1000,00

*  /einstellung ( settings ),  1 new field POS_LAGER_AKTIV
	(This is preparation for the stock management in phpInvoice 1.6 Final)

* /angebot ( offer ),
	Modification - confirmation of order, change offer status.
	Thank's to Maximilian Csuk and Karl Deutsch for the work and help.

* /gutschrift ( credit note ), new table
	Now you can create a credit note in phpInvoice, not finished yet
	Thank's to Maximilian Csuk and Karl Deutsch for the work and help.

* /zahlung ( payment ), neu.php, neuf.php,
	Changes so partial payments can be added and deleted correctly in or from the cash book.
	The calculation of the rest of open amount was changed.

* E-Mail function was changed.
	Since phpInvoice-1.6 Test2 the PHP mail() function will not be used any more, because there are problems with some systems using SELinux ( avc denied ).
	phpInvoice uses now the PEAR Mail:: Interface

	The configuration file ' mail.inc.php ' can be found in the /include directory.

  $Smtp["host"] = "yourmailserver";
  $Smtp["port"] = "25";
  $Smtp["auth"] = false;
  $Smtp["username"] = "";
  $Smtp["password"] = "";

	If your mail server needs authentication, so please change
	
  $Smtp["auth"] = true; and set $Smtp["username"] and $Smtp["password"]

* /kassenbuch ( cash book ), 1 new field ZAHLUNGID
	Now partial payments can be deleted from the cash book.

* small corrections and fixes
