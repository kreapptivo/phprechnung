/*
	README-EN - 31.01.2011

	phpRechnung - is easy-to-use Web-based multilingual accounting software.
	Copyright (C) 2001 - 2011 Edy Corak < edy at loenshotel dot de >

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

To install phpRechnung 1.6.4 you will need:

------
Server
------

Web server:
Apache, Lighttpd oder auch ( Microsoft IIS - not tested )

PHP:
PHP 5 - ( mbstring, PEAR::Mail, Mail_Mime is required )

MySQL: ( Starting from phpRechnung 1.8 also another databases will be supported )
MySQL 5 or 4

MailServer:
e. g. Postfix, Exim, Sendmail ...

------
Client
------

Browser:
e. g. Firefox, Konqueror, Safari, Opera, Google Chrome ...
( Javascript must be enabled )

PDF-Reader

------

Important note:
Under Configuration/Settings please enter a correct E-Mail address,
otherwise you will have problems sending e-mail's.

The configuration file ' mail.inc.php ' can be found in the /include directory.

$Smtp["host"] = "yourmailserver";
$Smtp["port"] = "25";
$Smtp["auth"] = false;
$Smtp["username"] = "";
$Smtp["password"] = "";

If your mail server needs authentication, so please change
$Smtp["auth"] = true; and set $Smtp["username"] and $Smtp["password"]

#####

Important note:

Questions to (open_basedir, safe_mode etc.) have nothing to do
with phpRechnung and will not be answered any more.

#####

Unpack phpRechnung_1_6_4.tar.gz - tar zxvf phpRechnung_1_6_4.tar.gz
Copy the directory ' phpRechnung_1_6_4 ' to your Web server e. g. /var/www
( or change the name phpRechnung to phpInvoice )

####################

!!! IMPORTANT NOTE !!!

Since phpRechnung 1.6 RC1 Smarty Template engine is used.
Still some changes must be made in order to work.

The Webserver must have write access for following directories
'/include/smarty/cache' and '/include/smarty/templates_c'

It is recommended (but not mandatory) to place these directories
outside of the web server's document root.

The same for these directories '/include/smarty/templates' and '/include/smarty/configs'

You must notify phpRechnung about the changes

In '/include/smarty.inc.php' change following variable:

$Templateroot and $Cacheroot from $_SERVER['DOCUMENT_ROOT']."phpRechnung";
	
to something like

$smarty->template_dir = "/var/www/include/smarty/templates";
$smarty->config_dir = "/var/www/include/smarty/configs";
$smarty->compile_dir = "/var/www/include/smarty/templates_c";
$smarty->cache_dir = "/var/www/include/smarty/cache";

More information about Smarty at Link: http://www.smarty.net/

FAQ Link: http://www.loenshotel.de/phpRechnung/FAQ.php#faq1.4


####################

Create Database:

####################

mysqladmin -u 'user name' -p create phpinvoice

Create tables:

mysql -u 'user name' -p phpinvoice < phprechnung_1_6_4.sql

If you have no 'root' access, please use 'phpMyAdmin'

First create database, then select the data base, then select Import,
Location of the text file: select suitable file: phprechnung_1_6_4.sql,
then select Character set of the file: 'latin1' and click on Go.

You will see a message something like this:

Import has been successfully finished, 127 queries executed.

!!! IMPORTANT NOTE !!!

Please don't insert the SQL file into the field Run SQL query/queries on database.
The data will be inserted without any errors, but thereafter, a login is no longer possible.


The following files must be changed
in order to access your new database ' phpinvoice '.

In the directory ' /include '

' dbconf.php ' for the data base connection
_DBHOST z. B. "localhost"
_DBUSER z. B. "username"
_DBPASS z. B. "userpassword"
_DBNAME z. B. "phpinvoice"

_DBUSER must have enough rights on your
Data base server - SELECT, INSERT, UPDATE, DELETE

' phprechnung.inc.php '
(importantly is the variable "$web" please enter your own Web address
where you copy phpRechnung_1_6_4 e.g. http://yourserver/phpInvoice
(without '/' at the end) otherwise the forwarding will not work.

For users who run phpRechnung on a Windows server,
please adapt under Configuration/Settings TMP-Directory

Standard is '/tmp/' in e. g. 'c:\windows\temp\'

Please consider the last backslash. Importantly.
The Web server must have write access for this directory.

On Windows servers please also examine ' session.save_path '

Standard is session.save_path = /tmp
In this case, please change it
in e.g. session.save_path = c:\windows\temp

Login:

Administrator: admin, admin

The user data are stored encrypted in the table 'user'

After the first login you will be prompted to accept
the phpRechnung License ( GPL V2 ).

This is needed only once per user.

The administrator password can be changed
only the user name ' admin ' may not be changed.
Otherwise you will not be able to access many sites.

####################

If you have any comments or suggestions, so please go to the
phpRechnung Forum at Link: http://sourceforge.net/projects/phprechnung/

phpRechnung homepage - http://www.loenshotel.de/phpRechnung/

If you wish to subscribe to new releases please go to
http://freshmeat.net/projects/phprechnung/ and register
or http://lists.sourceforge.net/lists/listinfo/phprechnung-news

Thank you for using phpRechnung

Edy Corak < edy at loenshotel dot de >
