<?php
/*
PHP-Errors verarbeiten:
- http://php.net/manual/de/function.set-error-handler.php

Login
- Konten-Verwaltung (siehe Google -> mehrere Accounts)

- Animation: CSS Animationen; jQuery (Animation); JS
- Network: Client/Server; Websockets; Ajax
- FTP: Client/Server
- File (Upload) Manager

Database
- Dynamisch anlegen und erweitern von Tabellen, falls sie noch nicht vorhanden sind.
- Save und Load Object (Objekte und JSON Strings speichern und laden in mehreren Tabellen)

JS Physic Klasse
JS Animation Klasse (kombiniert mit CSS3 Transform Funktionen: http://leaverou.github.io/animatable/ und http://www.towerfall-game.com/)
CSS Effeckte für Scrollviews: http://lab.hakim.se/scroll-effects/

Kontakte auslesen:
- siehe: http://hybridauth.sourceforge.net/userguide.html

1und1 WebApps:
- http://devpartner.1und1.de/de/was-sind-web-apps/

Registerportal:
- https://www.handelsregister.de/rp_web/mask.do?Typ=e

Validierung in PHP:
- Validieren: http://www.php.net/manual/de/filter.examples.validation.php
- Säubern: http://www.php.net/manual/de/filter.examples.sanitization.php

Kompressionen:
- http://www.php.net/manual/de/refs.compression.php

OGG:
- http://www.php.net/manual/de/book.oggvorbis.php

// index.php...
define("Include", "geheimerKey");

// include.php...
if (!defined("Included"))
{
	if (Include == "geheimerKey")
	{
		header('HTTP/1.0 404 not found');
		exit;
	}
}

Bilder-Sitemaps-XML (Google)

Maps APIs:
- Google Maps: https://developers.google.com/maps/?hl=de
- Bing Maps: http://msdn.microsoft.com/en-us/library/dd877180.aspx
- Nokia Maps: http://developer.here.com/

Google HTML5 Parser in C (OpenSource Apache 2 Lizenz):
- http://www.heise.de/newsticker/meldung/Google-veroeffentlicht-C-Bibliothek-zum-Parsen-von-HTML5-1935902.html

- automatische Mail Ver- und Entschlüsselung mit Passwort

IMAP MAIL (Sende Mails):
http://www.php.net/manual/en/function.imap-mail.php

http://www.html5rocks.com/de/tutorials/workers/basics/

Mac Tastatur-Layout ändern:
http://4pple.de/index.php/mit-dem-deutschen-tastaturlayout-komfortabel-coden/

Alt + 5 = [
Alt + 6 = ]
Alt + 7 = |
Alt + 8 = {
Alt + 9 = }
*/
/*
Android:
- http://www.codeproject.com/Articles/392603/Android-addJavaScriptInterface
- http://www.codeproject.com/Articles/579471/How-to-Write-Your-Own-Siri-Application-Mobile-Assi
- http://www.codeproject.com/Articles/182438/Accepting-In-App-Payments-with-Android
- http://www.codeproject.com/Articles/296495/Android-Push-Notifications
- http://www.codeproject.com/Articles/119293/Using-SQLite-Database-with-Android
- http://www.codeproject.com/Articles/578823/Android-Contact-Operations-Insert-Search-Delete
- http://www.codeproject.com/Articles/511455/Android-Phone-Status-Sample
- http://www.codeproject.com/Articles/524105/Per-pixel-collision-detection-on-Android-devices
- http://www.codeproject.com/Articles/521455/Quick-action-pattern-in-Android-and-simple-impleme
- http://www.codeproject.com/Articles/340714/Android-How-to-communicate-with-NET-application-vi
- http://www.codeproject.com/Articles/490021/One-Touch-Casual-3D-Game-Based-on-OpenGL-ES-2-0-3D
- http://www.codeproject.com/Articles/156402/Android-Generating-an-EAN13-Barcode
- http://www.codeproject.com/Articles/146145/Android-3D-Carousel
- http://www.codeproject.com/Articles/487009/R-O-O-T-S
- http://www.codeproject.com/Articles/295910/Android-Puzzles-Solver
- http://www.codeproject.com/Articles/389071/Create-a-Dynamic-Shelfview-in-Android
- http://www.codeproject.com/Articles/433513/Android-How-to-Receive-Notification-Messages-from
- http://www.codeproject.com/Articles/396027/Integrating-HTTP-and-HTTPS-Connection
- http://www.codeproject.com/Articles/419185/Simple-XML-manipulation-techniques-within-Android
- http://www.codeproject.com/Articles/108390/How-To-Create-Android-Live-Wallpaper
- http://www.codeproject.com/Articles/319401/Simple-Gestures-on-Android
- http://www.codeproject.com/Articles/267023/Send-and-receive-json-between-android-and-php
- http://www.codeproject.com/Articles/258176/Adding-Background-Music-to-Android-App
- http://www.codeproject.com/Articles/248308/Google-App-Inventor
- http://www.codeproject.com/Articles/189515/Androng-a-Pong-clone-for-Android
- http://www.codeproject.com/Articles/188957/Simple-Android-Ball-Game
- http://www.codeproject.com/Articles/162201/Painless-AsyncTask-and-ProgressDialog-Usage
- http://www.codeproject.com/Articles/113831/An-Advanced-Splash-Screen-for-Android-App
- http://www.codeproject.com/Articles/109735/Toast-A-User-Notification
- http://www.codeproject.com/Articles/107693/Tabbed-Applications-in-Android
- http://www.codeproject.com/Articles/107341/Using-Alerts-in-Android
- http://www.codeproject.com/Articles/107270/Recording-and-Playing-Video-on-Android
*/
/*
- Security:
http://www.heise.de/newsticker/meldung/OWASP-Die-zehn-groessten-Risiken-fuer-Webanwendungen-1887487.html

Augmented Reality:
- http://www.mono-software.com/blog/post/Mono/187/Augmented-Reality-on-iPhone/
- http://www.codeproject.com/Articles/19323/Image-Recognition-with-Neural-Networks
*/
/*
Adobe Edge:
http://www.golem.de/news/adobe-edge-neue-generation-von-html5-werkzeugen-1209-94745.html

http://www.webrtc.org/		// Peer-to-Peer Connections über Browser (u.a. für Videochat)
http://www.heise.de/newsticker/meldung/Firefox-Beta-mit-kompletter-WebRTC-Unterstuetzung-1865196.html

NodeJS (ServerApp mit JavaScript Support)
- http://de.wikipedia.org/wiki/NodeJS
- http://nodejs.org/

Developer Umgebung für JavaScript
- JSFiddle: http://jsfiddle.net/S3ctN/
- WebGL Playgrounds: http://webglplayground.net/

https://hacks.mozilla.org/2013/05/firefox-os-simulator-3-0-released/
http://www.eyeos.com/technology/web-engine
http://www.redhat.com/resourcelibrary/articles/rhev-desktops-spice

Namensvorschläge für API:
- ProGen API
- PlatformGen API
- PowerGen API
- PrimeGen API

Forum mit genauer anzeige wer das Thema gestartet hatte
*/

/*
Controls:
- Wysiwyg
- Code Editor

Canvas Malprogramm
- http://www.peterkroener.de/eine-kleine-canvas-einfuehrung/
*/

/*
Projektmanagement:
- Projekte

Projekt:
- Name
- Beschreibung
- Projekt-Kategorien
  - Todo Listen

Projekt-Kategorie:

TODO Liste:
- Todos
  - Todo-Nummer: manuell oder automatisch generiert nach einer Vorlage
  - Optional manueller oder automatischer Status ("New" wenn noch kein Unterpunkt angefangen wurde / "In Progress" wenn Unterpunkte angefangen sind / "Done" wenn alle Unterpunkte erledigt wurden)
  - Bei automatischem Status: Statusprozent anhand der Anzahl der Unterpunkte und deren Status berechnen
  - Startdatum, Startzeit
  - Enddatum, Endzeit
  - Beschreibungstext
*/

/*
Datenbanken:
- MySql		// http://www.mysql.de
- MariaDB	// https://mariadb.org/
- MsSql		// http://www.microsoft.com/sqlserver/en/us/editions/2012-editions/express.aspx
			// http://msdn.microsoft.com/en-us/sqlserver/ff657782.aspx
- Oracle	// http://www.oracle.com/webfolder/technetwork/tutorials/obe/db/oow10/php_webapp/php_webapp.htm

Daten Backup System
- Monatliche Backup Dateien (Jan, Feb, Mär, Apr, Mai, Jun, Jul, Aug, Sep, Okt, Nov, Dez mit Häkchenoption)
- Tägliche Backup Dateien (Mo, Di, Mi, Do, Fr, Sa, So mit Häckchenoption)
- Monatlich nach Datum (alle beibehalten oder nur die neusten: X Anzahl)
- Täglich nach Datum (alle beibehalten oder nur die neusten: X Anzahl)
- Live Datenbank Backups in Dateien und/oder andere Datenbanken
- Prüfung ob alles Übertragen wurde
- Vollbackups, Teilbackups, Inkrementelle Backups
*/
/*
Android JavaScript Interface (Austausch von JavaScript in einer WebView und Java Nativ Code):
- http://developer.android.com/reference/android/webkit/WebView.html#addJavascriptInterface%28java.lang.Object,%20java.lang.String%29

Android Contacts:
- http://developer.android.com/reference/android/provider/Contacts.People.html

Android SQLite:
- http://developer.android.com/reference/android/database/sqlite/SQLiteDatabase.html
- http://www.vogella.com/articles/AndroidSQLite/article.html
database.execSQL(); // Für ausführende Statements
database.query(); oder database.rawQuery(); // Für Selects usw.
Es gibt auch Methoden für insert(), update() und delete()
*/

/*
Google Suchoptimierungen
- Rich Snippets: https://support.google.com/webmasters/bin/answer.py?hl=de&answer=99170

Login Verfahren
- 2 Faktor Auth: http://www.heise.de/newsticker/meldung/Microsoft-fuehrt-2-Faktor-Authentifizierung-ein-1845022.html
*/

/*
Controls
- Datagrid
- InputFields
  - Optional Berechnungen (Formeln) umsetzen vorm Speichern (wie ein Taschenrechner)
  - Optional Berechnungen (Formeln) in JavaScript durch drücken eines Buttons hinterm Feld oder bei onKeyUp
- Frameset
  - Tabs (div)
    - TabNavigation (DropArea?)
      - Tabs (DropElements?)
    - TabContent (div)
      - Frame

Network
- Web Sockets System (optimieren auf Client Server Struktur)
- REST System
- SOAP System (erweitern/verbessern)
	- Anschauen: http://www.easy-coding.de/wiki/php/php-soap-server-mit-wsdl-und-api-schluessel.html

Aufgaben
- Immer wiederkehrende Aufgaben (Aufgaben-Template)	
*/

/*
// ERP Lösungen:
- OpenERP: https://www.openerp.com/de/
- Tryton: http://www.tryton.org/

// Shop Lösungen:
- Shopware: http://wiki.shopware.de/ und http://www.shopware.de/ | Referenz: http://wiki.shopware.de/Shopware-4-API-Beispiele-und-Erweiterungen_detail_1070_869.html
- Magento: 
*/

/*
WebGL:
- http://www.khronos.org/webgl/wiki/Main_Page
- https://developer.mozilla.org/en-US/docs/Web/WebGL
- http://www.html5rocks.com/en/tutorials/webgl/webgl_fundamentals/
- http://learningwebgl.com/blog/?page_id=1217
- http://learningwebgl.com/cookbook/index.php/Main_Page
- http://learningwebgl.com/mediawiki-1.20.3/index.php/Main_Page

- http://www.peter-strohm.de/webgl/
*/

// Free LGPL Video Player (HTML5 and Flash)
// http://videojs.com/

// License:
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Feb 10 2012
*/

/*
Mitbewerber:

Nur JavaScript
- Enyo JS: http://enyojs.com/sampler/
- JQuery: http://jquery.com/
- Ember.js: http://emberjs.com/
*/
// Amazon SDK für PHP: http://www.heise.de/newsticker/meldung/Alles-auf-Anfang-AWS-SDK-fuer-PHP-mit-neuem-Unterbau-1743268.html

/*
Facebook:
- http://developers.facebook.com/tools/explorer

PDF (kostenlos auch für kommerzielle Projekte):
- http://www.fpdf.de/wasist/
*/

/*
Reihenfolge
- API:
	/ - InputField Dropdown Streaming (nach unten)
	/ - Form Security test
	/ - Templatesystem zur ClassBasics hinzufügen
	- DragAndDrop Abwarten bei DragElement ob Mauszeiger nach MouseDown bewegt wird und erst dann das DropElement grabben
	- DragAndDrop OnGrab Event implementieren
	- TabSystem für Controls mit Drag and Drop funktion
	- TabSystem bei Framesets einbauen
	- CodeParser Klasse weiterentwickeln
	- DocuParser Klasse weiterentwickeln
	- Documentation Klasse weiterentwickeln
	- Rechtesystem
	- Bei Database abfragen mit rein ob Rechte abgefragt werden sollen (default? oder lieber nicht?)
	// - Form Templates
	- Mail Templates
	// - SecurityCode umbenennen zu Captcha
	- Captcha zu MailShare hinzufügen
	- Share optional auf 1 Button beschränken und erst beim drüberhovern oder klicken alle Buttons anzeigen
	- Likes Hauptklasse erstellen und optional auf 1 Button beschränken und erst beim drüberhovern oder klicken alle Buttons anzeigen
	- MailUpload
	- InputField korrigieren von CSS-Styles bei NoData usw.
	- ScrollDiv (Frame) Streaming (nach allen Seiten?!?)
		- nachladen von Inhalten
		- vorladen einer bestimmten Reichweite (außerhalb des Sichtbereichs)
		- optional entfernen von Inhalten die weiter aus dem Sichtbereich sind
	- Schwachstellen aufdecken in PHP (securitycheck.php)
	- Schwachstellen aufdecken in eigenen Klassen (securitycheck.php)
	- Form statistik über Hackversuche und allgemeine Darstellung (Frontend) für Hackerangriffe usw.

- DevStudio / DevTools:

- Game API:

- WebOS:

- PG Paint:
*/

/*
API Vergleich zu anderen Entwicklungsumgebungen:
PGApi					MonoDevelop
- Frameset				- HBox und VBox
- Frame					- ScrollWindow
- Tab					- Notebook
*/

/*
http://www.php.net/manual/en/function.parse-str.php // bei auslesen von URL Parametern!
http://php.net/manual/en/function.parse-ini-file.php
http://css.dzone.com/articles/how-i-built-html5-comic-book	// cbz und cbr Dateien auslesen (Comic Books)

Magento: http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-1-introduction-to-magento

Nachrichtendienste
- ICQ Protokoll
- AIM Protokoll
- Skype Protokoll

- Google Talk
- Skype API URIs

NAS
- QNAP (Apps: QPKG) // http://wiki.qnap.com/wiki/QPKG_Development_Guidelines
- Synology // http://www.synology.com/support/developer.php?lang=deu

SAP
- http://scn.sap.com/community/developer-center

PHP Settings usw.

- Speicherverbrauch (RAM): // http://www.php.net/manual/de/function.memory-get-usage.php
- Speicherverbrauch (RAM): // http://www.php.net/manual/de/function.memory-get-peak-usage.php
- Resourcenverbrauch: // http://www.php.net/manual/de/function.getrusage.php
- Extensions: http://www.php.net/manual/de/function.extension-loaded.php
- Included Files: Interessant zum Debuggen! // http://www.php.net/manual/de/function.get-included-files.php
- Uhrzeit der letzten Änderung eines Scripts: // http://www.php.net/manual/de/function.getlastmod.php oder http://www.php.net/manual/de/function.filemtime.php
- SAPI oder CGI?: // http://www.php.net/manual/de/function.php-sapi-name.php
- Operating System: // http://www.php.net/manual/de/function.php-uname.php
- Version: // http://www.php.net/manual/de/function.phpversion.php
- Version Compare: // http://www.php.net/manual/de/function.version-compare.php

- Error LOG: // http://www.php.net/manual/de/function.error-log.php

php.ini: http://de.php.net/manual/en/configuration.changes.modes.php
*/

// http://de.wikipedia.org/wiki/Kategorie:Web-Entwicklung
/*
Oracle:
- http://apex.oracle.com/pls/apex/f?p=44785:1:0:::::

Sprachen:
- PHP: www.php.net
- Perl: www.perl.org / http://www.activestate.com/activeperl/downloads

www.gimp.org
www.blender.org

Browser:
- Internet Explorer
- Mozilla Firefox
- Opera
- Safari
- Google Chrome
- ? Konquerer

Google Captcha:
- http://www.google.com/recaptcha

Monitoring:
- https://www.icinga.org/

Smart-TV:
- Samsung: http://www.samsungdforum.com/ | http://developer.samsung.com/home.do
- LG: http://developer.lgappstv.com/devel/main/main.lge
- Phillips und Sharp (NetTV): http://www.yourappontv.com/home
- Sony: http://www.developer.sony.com/
- Panasonic: http://panasonic.net/pcc/products/pbx/Sdk_index.html
- GoogleTV: https://developers.google.com/tv/
- YahooTV: http://connectedtv.yahoo.com/developer/#frmContact

Sprachen:
- Java
- ? Java Servlets (.do) / Oracle Aplication Server?!?
- Java (Android SDK)
- C# (mono)
- PHP					// http://de.wikipedia.org/wiki/PHP
- JavaScript (JScript .NET)	// http://de.wikipedia.org/wiki/JavaScript
- Perl (.NET)			// http://de.wikipedia.org/wiki/Perl_(Programmiersprache)
- SQL (MySql, MsSql)	// http://de.wikipedia.org/wiki/SQL
- ? C/C++
- ? Objective-C			// http://de.wikipedia.org/wiki/Objective-C
- ? Asp (.NET)			// http://de.wikipedia.org/wiki/Active_Server_Pages
- ? ActionScript		// http://de.wikipedia.org/wiki/ActionScript
- ? Phyton (Boo / .NET)	// http://de.wikipedia.org/wiki/Python_(Programmiersprache)
- ? Boo (.NET)			// http://de.wikipedia.org/wiki/Boo_(Programmiersprache)
- ? Silverlight
- ? Go (Google)			// http://de.wikipedia.org/wiki/Go_(Programmiersprache)
- ? Lua-Script			// http://de.wikipedia.org/wiki/Lua
- ? Lite-C				// http://de.wikipedia.org/wiki/Lite-C

Unterstütze OS
- iOS
- Mac OS X
- Windows Vista, 7, 8
- Linux (Suse, Ubuntu, Debian)
- Android
*/

/*
Überarbeitung der mysql methoden...
- getAllColumnsInfo($_sTable)
- getColumnInfos($_sTable, $_sColumn = NULL)
- getConnectData()
- connect($_sHost = NULL, $_sUser = NULL, $_sPassword = NULL, $_sDatabse = NULL)
- close() / disconnect()
- changeDatabase($_sDatabase = NULL)
- isConnected($_oConnection = NULL)
- checkConnection()
- removeForbiddenStatement($_sStatement, $_sForbidden = NULL)
- sendSql($_sStatement, $_bAllowInfoSchema = NULL, $_bAllowUnion = NULL, $_bAllowVersion = NULL)
- realEscapeString($_xString, $_oConnection = NULL)
- getInsertID($_oConnection = NULL)
- getRowCount($_oResult)
- fetchArray($_oResult)
- select($_sTable, $_asColumns = NULL, $_sWhere = NULL, $_iStart = NULL, $_iEnd = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL)
- insert($_sTable, $_axColumnsAndValues = NULL, $_bStripSlashes = NULL)
- update($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_sWhere = NULL, $_bStripSlashes = NULL)
- save($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_axColumnsAndValuesOnInsert = NULL, $_axColumnsAndValuesOnUpdate = NULL, $_sWhere = NULL)
- insertOrUpdateIfExists($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_axColumnsAndValuesOnInsert = NULL, $_axColumnsAndValuesOnUpdate = NULL, $_sWhere = NULL)
- delete($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_sWhere = NULL)
- TODO: [ChangeIndexes] changeColumn($_sTable, $_axColumn = NULL)
- TODO: [ChangeIndexes] modifyColumn($_sTable, $_axColumn = NULL)
- TODO: [ChangeIndexes] createColumn($_sTable, $_axColumn = NULL)
- removeColumn($_sTable, $_sColumn = NULL)
- changeTableName($_sOldName, $_sNewName)
- TODO: [MySqli] columnExists($_sTable, $_sColumn = NULL)
- sqlStatus()
*/

/*
if (is_array($_sTextAreaID))
{
	foreach($_sTextAreaID as $_sName => $_xValue)
	{
		if ($_xValue != NULL)
		{
			$_sName = '_'.str_replace('_', '', $_sName);
			$$_sName = $_xValue;
		}
	}
}
*/

/*
Bisher überarbeitet wegen flexibler Parameter...

TODO: nächstes Verzeichnis / Dateien...

TODO: gerade in Bearbeitung...
- database/autologin.php

TODO: mysql zu database überarbeiten...
- database/useractionlog.php
- database/databaseupdate.php
- database/rights.php
- database/users.php

TODO: Überarbeiten auf ClassBasics Ajax -> Network...
- filesystem/upload.js

TODO: überarbeiten der Methodenaufrufe...

TODO: überarbeiten der Methodenaufrufe und Parameter...
- modules/...
- interfaces/...

- paypal/paypalexpresscheckout.php

- parser/codeparser.js

*/

/*
Urheberrechtshinweis
 
Alle Inhalte dieses Internetangebotes, insbesondere Texte, Fotografien und Grafiken, sind urheberrechtlich geschützt (Copyright).
Das Urheberrecht liegt, soweit nicht ausdrücklich anders gekennzeichnet, bei [NAME].
Bitte fragen Sie [MICH/UNS] [KONTAKTDATEN, FALLS NICHT ERSICHTLICH], falls Sie die Inhalte dieses Internetangebotes verwenden möchten.
 
Inhalte die unter der [ZB CREATIVECOMMONS]-Lizenz veröffentlicht wurden, dürfen nach den maßgeblichen Lizenzbedingungen [GEGEBENFALLS. LINK] verwendet werden.
 
Wer gegen das Urheberrecht verstößt (z.B. die Inhalte unerlaubt auf die eigene Homepage kopiert), macht sich gem. § 106 ff Urhebergesetz strafbar. 
Er wird zudem kostenpflichtig abgemahnt und muss Schadensersatz leisten.
Kopien von Inhalten können im Internet ohne großen Aufwand verfolgt werden.
 
[DATUM]
*/
/*
http://de.wikipedia.org/wiki/MIT_License
http://de.wikipedia.org/wiki/GNU_General_Public_License
http://developer.android.com/sdk/terms.html
*/

/*
ProGade API Webseite:
- Allgemeine Todos:
	- Thema Sicherheit gegen Hacker in der API
	- Wiederverwendbarer Code
	- Einfach zu verstehen und zu nutzen
	- Stetige Weiterentwicklung und Bugfixing
- API
	- Features
		- Versionsunterschiede
		- Sprachenvergleich
		- Geplante Features
	- Was ist neu?
	- Lizenzen
- Support
	- Dokumentation
		- Erste Schritte (Beschreibung)
	- Tutorials
		- Einsteiger
			- Quickstart
			- Grundlagen
		- Fortgeschrittene
			- ...
	- Frequently Asked Questions
		- Allgemeine Fragen
			- Kann ich eigene Plugins oder Erweiterungen für ProGade API schreiben?
			- Wer entwickelt ProGade API?
		- Fragen zum Store
			- Darf ich eigene Plugins, Erweiterungen, Apps und Spiele in eurem Store verkaufen?
			- Darf ich auch fremde Produkte (die nicht mit ProGade API entwickelt wurden) im Store verkaufen?
			- Was kostet mich der Verkauf meiner Produkte in eurem Store?
			- Ist es erlaubt kostenlose Produkte in eurem Store anzubieten?
		- Fragen zur Web-Version
			- Werden Smartphones, Tablets und andere Mobile Geräte unterstützt?
	- Benutzer-Handbuch
		- ...
		- komplette Verzeichnisstruktur
	- Beispiel-Projekte und andere Resourcen
		- ...
	- API-Referenz
- Firma/Company
	- Kontakt (Kontaktformular)
- Download
- Spenden/Donate

- Header
	- Random Start der Header-Images
	- Auswahl der HeaderImages
*/

/*
- MySql Performance Analyse
	- Analyse der Engines wie z.B. InnoDB und MyISAM usw.
	- Statistik wie schnell Abfragen so im durchschnitt laufen
	- Einzelne Statements x Mal ausführen lassen und die Dauer dann anzeigen

- Programmiersprachen:
	- Silverlight
	- RIA/JavaFX (http://openbook.galileocomputing.de/javainsel/javainsel_01_002.html#dodtp123d5d74-7142-4cd6-bacf-7cae8494b665)
	- Flash
	
- JavaScript Language Interpreter
	- http://www.codeproject.com/Articles/345888/How-to-write-a-simple-interpreter-in-JavaScript

- Uhr mit NTP Time (Network Time Protocol)
	- http://www.codeproject.com/Articles/366004/HTML5-Clock-with-NTP-time-support
	
- Audio Klasse:
	- http://www.beatkeep.net/
	- http://blogs.msdn.com/b/ie/archive/2011/05/13/unlocking-the-power-of-html5-lt-audio-gt.aspx

- Klasse um Code minimieren und umformatieren zu können (z.B. Entfernen von Tabs und Zeilenumbrüchen / Übergabeparameter von _sString, _bTest und _iCount zu _a, _b und _c usw.)
- Netzwerk (optional) zum Austausch von Erfahrungen mit Hacker-Angriffen, teilen von Sicherheitshinweisen und Optimierungsvorschlägen für die API
- Bug-Tracker
- Netzwerk für Abkürzungen (ingame und inapp bzw. auf webseiten einbindbar / abkürzung eingeben und definition wird angezeigt)

- Frage-Antwort-System
	- http://answers.unity3d.com/index.html

- User-Request-System
	- http://feedback.unity3d.com/forums/15792-unity

- Forum
	- http://forum.unity3d.com/

- Wiki
	- http://unifycommunity.com/wiki/index.php?title=Main_Page

- Wissensdatenbank
	- ?
	
- DevTools
	- http://www.anjuta.org/features.html

- AppStore
	- Artikel
		- Quellcode vorhanden
		- Downloadbar oder nur als Service auf (ProGade oder vom Hersteller?) Webspace nutzbar/spielbar.
		- Materialien vorhanden (Assets wie z.B. Bilder, Icons, Texte usw.)
		- Preis(e) oder kostenlos
		- Titel und Beschreibung
		- Icons in mehreren Größen
		- Werbebanner
		- Werbevideos
		- Screenshots
	- Bezahlung per PayPal, Kreditkarte, oder wie?
	
- Webseite
	- Publisher vermerk einfügen, damit es Google erkennen könnte (auch als Link zu progade.de)
*/

/*
Alles auf HTML5 (DOCTYPE) testen und gegebenenfalls überarbeiten!

- Api
	// Examples:
	// echo $oPGApi->query($oPGDiv)->call('build()');
	// echo $oPGApi->query('<div>')->set('id', 'myDiv')->css('color', '#000000')->get();

- Code Converter
	- C#-Mono-Code (siehe: http://www.mono-project.com/Mono_Basics)
	- Java-Code
	- Java-Android-Code
	- PHP-Code
	- JavaScript-Code

- .htaccess (Klasse zum Erstellen von htaccess dateien für Apache)
- web.config (Klasse zum Erstellen von IIS7 Config Dateien)
- securitycheck.php (Klasse um Sicherheitsprobleme aufzuspüren die in z.B. der php.ini existieren)
- securitycheck.js (?)
- securitycheck.cgi oder .pl

- Screenshotfunktion mit Senden des Screenshots als Datei (jpg)

- Klasse um Fehlerseiten HTTP Status Seiten usw. umzuschreiben

- downloader wie bei magento über curl
- ftp

- Database
	/ - MySql auf MySqli überarbeiten
	/ - komplette implementation von MySql in die database Klasse
	/ - komplette implementation von MsSql in die database Klasse
	- überarbeiten aller Module und Klassen auf die database Klasse, die momentan noch die mysql Klasse verwenden
	- Eventuell PDO Klasse (PDO ist Datenbankunabhängig, aber leider braucht man dafür PDO-Treiber zur Datenbank).
	- SQLite und SQLite3 Klassen
	- PostgreSql Klasse
	
- Dropbox
	- https://www.dropbox.com/developers
	
	
/ - Netzwerkklasse erstellen, die automatisch erkennt welche fähigkeiten der Browser hat und dementsprechend das passende Protokoll bzw. die passende Technik verwendet

- Rimage

- MailUpload
	- upload per E-Mail-Anhang, für Mobile Systeme

- Mail
	- Alternativen Namen bei E-Mail-Anhang vergeben
	- Template-System für mails senden
	- Mail senden und Imap in getrennte Klassen umsetzen
	
- Labs-Test
	- Eine Methode ermitteln wie man möglichst auf lange Zeit feststellen kann ob es sich um den gleichen Webseiten-Besucher oder PC handelt, ohne die deutschen Gesetze zu überschreiten (z.B. IP Speicherung)
	- Eine Möglichkeit ermitteln wie man Spammer abwehren kann und über das UserSystem/LoginSystem herausfinden kann welche Einträge und Aktionen in anderen Modulen der API oder des eigenen Systems von dem User gemacht wurden + die Option diese Aktionen rückgängig zu machen bzw. Einträge zu löschen
	
- Login erweitern
	- Login-Button disablen beim einloggen
	- Alle Strings überarbeiten auf Language System (getText)
	- optional Mail vor dem ersten Speichern der Userdaten bestätigen. (Weniger Datenmüll)
	- Login in HTML 5 localStorage und sessionStorage (JS) speichern statt Cookies verwenden. // http://www.w3schools.com/html5/html5_webstorage.asp
	- Prüfung bei Registrierung ob ein Benutzername noch verfügbar ist, bei onBlur mit Ajax
	- Login nur von bestimmten (festen) IPs zulassen
	- Option ob Sessions, Clientseitige Cookies oder HTML5 localStorage und sessionStorage bevorzugt werden sollen bei der Autoerkennung
	- Verschiedene Versionen von einem Account Panel (Einstellungen, logout usw.)

	- User löschen Funktion + anzeigen von gelöschter User als Username bei nicht gefundener UserID aus Datenbank
	- Username vergessen Funktion direkt beim Login (wenns Sinn macht)
	- Updates der AGB, Nutzungsbedingungen und Datenschutz beim Login (Erneut akzeptieren)
	- Zustimmung zu Speicherung von anonymen Daten zu Statistikzwecken (keine IP Adressen werden gespeichert! (default) / Optional aktivierbare Speicherung der IP-Adressen)
	- Hardware-Key auslesen per C# oder so um login nur für bestimmte Hardware zuzulassen
	- Dongle-Key für USB-Stick oder auf Festplatte, der ausgelesen wird bevor man sich einloggen kann.
	- E-Mail-Bestätigungen für einloggen (jedes mal) bzw. auch interessant für einzelne Aktionen wie z.B. einsehen oder ändern von Daten usw.
	
	- Anzeige bei Registrierung wie stark ein Passwort ist
		- Länge des Passworts		(Gewichtung: 1 pro Buchstabe, egal ob klein oder groß, ab 6 Zeichen noch mal 3, ab 8 noch mal 3)
		- Groß- und Kleinbuchstaben (Gewichtung: 2 pro Wechsel von klein zu groß)
		- Sonderzeichen				(Gewichtung: erste 7, je weitere Sonderzeichen 2)
		- Zahlen					(Gewichtung: erste 4, je weitere Zahl 1)
		- Auswertung: 1 = schlecht, 16 = mittel, 20 = gut, 30 = sehr gut
	- Prüfung welcher Mail-Provider die E-Mail-Adresse ist. Bekannte wie GMX, WEB, GOOGLEMAIL, YAHOO als Freemail und andere
	- Geburtsdatum mit optionaler Alterskontrolle (verbot unter XX Jahren)
	- Newsletter anfordern
	- Optionale Zwangspause und Account-Speere (Admin schaltet wieder frei oder per Email-Reaktivierung) nach x Fehl-Logins innerhalb von kurzer Zeit
	- Tan-Listen Funktion für den Login
	- Optional direkter Login nach Registrierung ohne E-Mail-Authentifizierung, wiederum optional mit eingeschränkter Funktionalität des Systems (Mittelding zwischen GUEST und USER)
	- Optionale Verschlüsselung (fast) aller Daten in der Datenbank
	- Erzwingen oder einfach nur Nachfragen von Passwortänderung alle X Tage, optional Erinnerung auch per Mail.
	/ - E-Mail bei Registrierung 
	/ - System Mails akzeptieren
	/ - AGB (als Link oder direkt eingebunden, mit Checkbox zum Bestätigen)
	/ - Datenschutzerklärung (als Link oder direkt eingebunden, mit Checkbox zum Bestätigen)
	/ - Nutzungsbedingungen (als Link oder direkt eingebunden, mit Checkbox zum Bestätigen)
	/ - Password vergessen Funktion direkt beim Login // Muss noch getestet werden! // SecurityCode noch hinzufügen
	/ - Username im Cookie tauschen gegen random generierte ID/Passwort. Wird beim Multilogin nur einmal je User generiert und nie geändert, aber beim normalen Einfachlogin jedes mal beim einloggen neu generiert.
	// - Prüfen bei Registrierung ob E-Mail zwei mal richtig eingegeben wurde
	// - Syntaxprüfung der E-Mail-Adresse
	// - minimum an Zeichen für Benutzernamen (einstellbar)
	// - minimum an Zeichen für Passwort (einstellbar)
	// - Prüfen bei Registrierung ob Passwort zwei mal gleich eingegeben wurde (wenns geht)
	// - Optionaler Captcha-Code bei der Registrierung und beim Login

- Controls
	- TabControl
	- TreeView
	- Form
		- Sicherheitscode und Abfrage
		- Passwortfeld mit optionaler Anzeige wie stark das Passwort ist und Passwortregeln
		- Min und Max Zeichen bei inputfields
	- Sliders (Stufenlos mit Kommastelle, Ganzzahlig, Schrittvorgabe)
	- Scrollbars
	- Radio-Buttons
	- Toggle-Buttons (wie ein On-Off Schalter; vielleicht auch mehrere Status)
	- Lock-Buttons (bleibt gedrückt bis erneuter Klick)
	- Andocksystem
	- dynamisches hinzufügen und entfernen von Tabs (convertierbar zu Frames eines Framesets)
	- dynamisches hinzufügen und entfernen von Frames eines Framesets (per Drag and Drop)
	- InputField
		- Beim Dropdown herausfinden ob nach unten gescrollt wurde und dann nachladen lassen (Ajax Request)

// - Modules
	- share
		- facebook, linkedin, twitter, delicious, googleplus, myspace, vz share implementieren
		- share über E-Mail-Adresse
		
- Webseite
	- Menüs
	- Sitemaps
	- Suche
	- CMS
	- Permalink Funktion
	
- Statistik
	- Useraction Log (sollte User aktivieren)
	- Clickstatistik für ganze Webseite (Links)
	- Zeit Statistik (wieviel Zeit haben Besucher auf einer Site bzw. Unterseite verbracht)
	- Wie oft wurde welcher Browser verwendet?
	- Wie oft wurde welches Betriebssystem verwendet?
	- wie oft wurde mit einem Mobilgerät auf die Seite zugegriffen?
	
- Kompression (Zip, Zlib, usw.) http://www.php.net/manual/de/refs.compression.php
	- compression
		- zip
		- zlib

Perl Datenbanken: http://www.infos24.de/mysqle/handbuch/10_mysql_perl_ansteuern.htm#1
- Mit Perl zu MySql connecten und Verzeichnis zum Uploaden jedes Users auslesen.

- Dokumentation aller Klassen (vorher Developer Documentation Klasse fertigstellen)
- Testumgebung erschaffen (eventuell über Entwicklerumgebung)

- Startseiten-News-Navigation mit großem Vorschaubild wie bei folgenden Webseiten:
	- http://www.gametrailers.com/
	- http://www.giga.de/
	- http://unity3d.com/
	- http://www.apple.com/mac/
	- http://eu.battle.net/wow/de/
	- http://www.alternate.de/html/index.html
	- http://www.microsoft.com/de-de/default.aspx
	- http://www.crytek.com/company
	- http://www.mycrysis.com/
- PayPal überarbeiten von API 1.00.00 zu 2.00.00
- Ebay-Klasse
- Amazon-Marktplace-Klasse (gibt es eine API dafür?)
- Unity3D einbinden (siehe API 1.00.00: interfaces/unity3d.js und interfaces/unity3d.php)
- Hover-Klassen (von API 1.00.00 überarbeiten)
- Smilies-Klasse (von API 1.00.00 überarbeiten)
- (Image) Preloader-Klasse
- Google-Dynamic-Flash Klasse (für Youtube Player)
- YouTube Player JavaScript-Klasse
- Game-Klassen weiterentwickeln
- Webbrowser im Browser (webseiten aufrufen und geparsed anzeigen)
- WebGL weiterentwickeln
- Silverlight + XNA 3D als Alternative zu WebGL für den IE
- Canvas2D weiterentwickeln

- WebOS aufbauen (ProGade online Desktops)
  - umschalten zwischen Canvas2D(+3D) und HTML (sollte sich merken auf dem Rechner wo es eingestellt wurde)
  - multiple Zwischenablage mit App zur Vorschau und Auswahl, sowie Übertragung an andere User der Zwischenablageninhalte (mit Erlaubnissystem)
  - Datei- und Zwischenablagentransfer über einfaches Drag and Drop auf Icon für Fremdrechner bzw. auch Ordnerfreigaben (mit Erlaubnissystem)
  - offene Anwendungen per Drag and Drop (auf Icon für Fremdrechner) und per Menüpunkt übertragen, inklusive dem kompletten Satus der Anwendung (zur kompletten Weiterverarbeitung oder optional nur als Schulung screibgeschützt)
  - Durch ziehen einer Anwendung in eine Ecke bzw. einer Seite (links, rechts, oben und unten) passt sich das Anwendungsfenster der Größe und Position an
  - Gemeinsames gleichzeitiges Arbeiten an einer Datei, indem jeder genau sieht wo die Anderen grade was bearbeiten (durch Markierungen, Blockierungen usw.)

- Animation Editor (per Network zusammen dran arbeiten können)

- Schnittstelle zu C#.Net: http://www.php.net/manual/de/function.dotnet-load.php

- vcard Klasse (.vcf Datei)
- ? Klasse (einzelne Termine)

Google:
- WebFonts:
	http://code.google.com/intl/de/apis/webfonts/
	http://code.google.com/intl/de/apis/webfonts/docs/getting_started.html
- GoogleMaps:
	http://code.google.com/intl/de/apis/maps/documentation/javascript/
	http://code.google.com/intl/de/apis/maps/documentation/staticmaps/
- GoogleAccounts:	http://code.google.com/intl/de/apis/accounts/
- GooglePlus:		https://developers.google.com/+/

MySpace:
- API:
	http://developer.myspace.com/wordpress/

Sharing:
http://www.stumbleupon.com
http://digg.com
http://www.linkedin.com/
http://www.facebook.com
http://twitter.com/

Bookmarks:
https://www.google.com/bookmarks/

---------------------------
Network Class:

// network/network.js
// network/network.php

send one time data over ajax
send one time data over websockets
send and receive polling data over ajax
send and receive polling data over websockts (also not really polling)
remote procedure calls

---------------------------
Dokumentierte Klassen:

- breadcrumb
- button
- calendarsheet
- checkbox
- contextmenu
- controls
- draganddrop
- form				// todo
- frameset
- inputfield
- pagecontrol
- popup
- progressbar
- scrolldiv			// 3 Todos
- textarea

- cryption

// - autologin
- database
- databaseupdate	// überarbeiten und dann Doku abändern!!!
- login				// Überarbeiten von MySql?!?
- mssql
- mysql				// überarbeiten auf MySqli
- mysqlstatements	// überarbeiten auf MySqli

- debugconsole
- logs				// todo
- useractionlog		// überarbeiten von MySql integration
// - vardebug		// was soll damit gschehen? (ersetzen?)

- download
- filesystem
- folderupdate		// überarbeiten auf Network Script und dokumentieren
- upload			// überarbeiten auf Network Script und dokumentieren
- gfx				// Securecode in extra Klasse machen und Dynamic Image creation in eine eigne Klasse machen
- sprite
- sprites

// - html/divs
// - html/imgs

- input
- keyhandler
- mouse
- touchhandler

// interfaces
// mail

- ajax				// Streaming überarbeiten und dokumentieren
- network
- websockets		// php Klasse classPG_WebSocketsUser noch in eine eigene Datei machen und dokumentieren

// prototypes

- arrays
- browser
- checkjs
- classbasics
- css
- cssloader
- curl
- date
- eventmanager
- functions
- jsloader
- meta
- modevars
- nodes				// classPG_NodesHtmlSingleTagBasics und classPG_NodesHtmlDoubleTagBasics in extra Dateien schreiben und dokumentieren
- objects
- phploader
- random
// - registervars
- sessionvars
- strings
// - system
// - unregistervars
- vars

- rss
- xmlread
- xmlwrite

////////////////////////////////////////////////////////////
Noch zu überarbieten:

// API 1.00.00...
- apps/databaseeditor.php
- apps/devstudio.js
- apps/devstudio.php
- apps/fitnesslog.js
- apps/fitnesslog.php
- apps/projectmanager.php

- misc/oauth.php
- misc/gallery.php
- misc/gallery.js
- misc/codeformat.php
- misc/windows.js
- misc/taskbar.js
- misc/hover.js
- misc/user.php

- modules/chat.js
- modules/chat.php
- modules/comments.php
- modules/forums.php

- payment/paypal.js
- payment/paypal.php

- statistic/visitorsstatistic.php

// API 2.00.00...
- string/language.php
- string/smilies.php

- statistic/visitorsstatistic.php

- payment/paypal/paypalnvp.php

- parse/parse.php

- network/websocketssilverlight.js

- database/user.php

- modules/chat/chat.js
- modules/chat/chat.php
- modules/comments/comments.php
- modules/forum/forum.php
- modules/gallery/gallery.js
- modules/gallery/gallery.php
- modules/tasks/taskbar.js
- modules/todolist/todolist.php
- modules/windows/windows.js

- interfaces/facebook/facebookapi.js
- interfaces/facebook/facebookapi.php
- interfaces/facebook/facebookauth.php
- interfaces/facebook/facebookdialog.js
- interfaces/facebook/facebookdialog.php
- interfaces/facebook/facebookgraph.php
- interfaces/facebook/facebookquery.php
- interfaces/oauth/oauth.php
- interfaces/unity3d/unity3d.js
- interfaces/unity3d/unity3d.php
- interfaces/youtube/youtubeplayer.js

- graphics/graph.js
- graphics/graph.php
- graphics/imgpreloader.js
- graphics/vectors.js
- graphics/vectors.php

- gameengine/gameobject.js
- gameengine/isomap.js
- gameengine/isomapeditor.js
- gameengine/isomapeditor.php

- game/logic/failuresearchgame.js
- game/logic/failuresearchgame.php
- game/logic/memorygame.js
- game/logic/memorygame.php
- game/logic/puzzlegame.js
- game/logic/puzzlegame.php
- game/gameclassbasics.js
- game/gameclassbasics.php

- formating/codeformat.php

- filesystem/upload.js
- filesystem/upload.php

- elements/element.js
- elements/hover.js

- debug/tagdebug.js

- controls/menu.js
- controls/menu.php

- controls/tab.js
- controls/tab.php

- canvas/canvas.js
- canvas/canvas.php
- canvas/webgl.js
- canvas/webgl.php
- canvas/webglmatrix.js

- apps/database/databaseeditor.php
- apps/developer/devdocu.js
- apps/developer/devdocu.php
- apps/developer/devstudio.js
- apps/developer/devstudio.php
- apps/facebook/facebookpagebuilder.php
- apps/fitness/fitnesslog.js
- apps/fitness/fitnesslog.php
- apps/project/projectmanager.php
*/
?>