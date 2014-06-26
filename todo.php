<?php
/*
UTF-8:
- http://www.gerd-riesselmann.de/softwareentwicklung/php-und-utf-8-eine-anleitung-einleitung

FTP-Funktionen
- http://www.php.net/manual/de/book.ftp.php

Form
- Automatisches Speichern von Formularen nach dem abschicken.

-> Model View Controller (MVC)

oPGStrings:
- convertPhpArrayToJson(...)

Websockets!

Webseite überarbeiten
- ?

Aufbau Forum (phpBB):
- General
	- Announcements / Ankündigungen
	- General Discussions / Generelle Diskussionen
	- Wishlist / Wunschliste
- Support
	- General API Support / - Allgemeiner API Support
	- Developer Preview (Alpha/Beta) / Entwickler Vorschau
	- Scripting
	- Interfaces and Plugins / Schnittstellen und Plugins
	// - Mobile Support
	
Aufbau Bugtracker: (Mantis: http://www.mantisbt.org/)
*/
/*
User
- Login
	- Default Usergruppe + Zuweisung bei Registrierung

Windows Mobile, Pen und Mouse:
http://blogs.windows.com/windows_phone/b/wpdev/archive/2012/11/15/adapting-your-webkit-optimized-site-for-internet-explorer-10.aspx#step4
http://msdn.microsoft.com/en-us/library/windows/apps/hh441238.aspx

http://www1.webplatform.org/	// Wiki von Browserhersteller Apple, Google, Mozilla, Opera und Microsoft gemeinsam mit Adobe, Facebook, HP, Nokia und dem World Wide Web Consortium (W3C)

VCard (Visitenkarte)
- http://de.wikipedia.org/wiki/VCard

Reihenfolge der Dokumentationsbeschreibungen:
// - controls/breadcrumb.php
// - controls/breadcrumb.js
// - controls/form.php
// - controls/form.js
// - css/cssloader.php
// - input/keyhandler.js
// - input/input.js
// - javascript/jsloader.php
// - javascript/jsloader.js
// - php/phploader.php
// - system/classbasics.php
// - system/classbasics.js
// - system/api.php
// - system/eventmanager.js
// - user/login.php
// - user/login.js
// - website/website.php
// - xml/rss.php
// - xml/xmlread.php
// - xml/xmlread.js
// - xml/xmlwrite.php
// - xml/xmlwrite.js
// - controls/popup.php
// - controls/popup.js
// - controls/pagecontrol.php
// - controls/button.php
// - controls/button.js
// - controls/progressbar.php
// - controls/progressbar.js
// - controls/calendarsheet.php
// - controls/calendarsheet.js
// - controls/frameset.php
// - controls/frameset.js
// - controls/frame.php
// - controls/frame.js
// - controls/controls.php
// - controls/controls.js
// - user/users.php
// - user/rights.php
// - graphics/gfx.js
- graphics/gfx.php
- controls/ (alle)
- debug/ (alle)
- update/ (alle)
- css/ (alle)
- graphics/ (alle)
- filesystem/ (alle)
- database/ (alle)
- network/ (alle)
- input/mouse.js
- input/touchhandler.js
- website/template.php
- website/meta.php
- website/opengraph.php
- mail/ (alle)
- html/ (alle)
- parse/ (alle)
- modules/ (alle)
- interfaces/ (alle)
- system/ (alle)
- payment/ (alle)
- php/phpini.php
- prototype/ (alle)

Klappen noch nicht beim Parsen "undefined":
- prototype/
- resources/
- system/unregistervars.php

Noch für die Dokumentation überarbeiten:
modules, interfaces, documentation

http://www.osscc.net/en/licenses.html#compatibility
http://www.heise.de/open/artikel/Open-Source-Lizenzen-221957.html
http://edn.embarcadero.com/article/22958/
http://www.oss.bund.de/node/123

OSI
- http://de.wikipedia.org/wiki/Open_Source_Initiative
- http://opensource.org/licenses/osl-3.0.php

MIT
- http://de.wikipedia.org/wiki/MIT-Lizenz
- http://opensource.org/licenses/mit-license.php

GNU LGPL
- http://www.gnu.org/philosophy/why-not-lgpl.html
- http://www.gnu.org/licenses/lgpl.html

- http://www.gnu.de/documents/gpl-3.0.de.html
- http://www.gnu.de/documents/lgpl.de.html
*/

/*
Reihenfolge:
- Controls/Slider
*/

/*
Controls
- Slider
- Toolbar
- Menu
- Tooltip
- Window
- List		// http://enyojs.com/samples/list/list-contacts.html | http://enyojs.com/sampler/ (siehe Layout -> List)
- Panel		// http://enyojs.com/sampler/ (siehe Layout -> Panels)
- Layout	// http://enyojs.com/sampler/ (siehe Layout -> Fittable Layouts)
- Tree		// http://enyojs.com/sampler/ (siehe Layout Tree)

Modules
- Gallery
- Forums
*/
echo 'Jetzt: '.time().'<br />';
echo 'Morgen: '.(time()+86400).'<br />';
echo 'Nächster Monat: '.(time()+2592000).'<br />';
echo 'Nächstes Jahr: '.(time()+31536000).'<br />';
/*
Interessante Begriffe:
- Landing Page: http://de.wikipedia.org/wiki/Landing_Page
- Deep Link und Surface Link: http://de.wikipedia.org/wiki/Deeplink
*/

/*
Copyright (c) 2012 Hans-Peter Wandura (ProGade)
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

1. The software may not be used to inflict deliberate harm of any kind.

2. The software may not be directly available for download on sites that were not authorized by the copyright owner. A permit requires explicit permission from the copyright owner.

3. The software may either in its original form or modified / altered form be represented as completely own product. It must be always apparent that it is the software of the copyright holder and, where appropriate, modified parts of the software are pointed out. When using the software in their own product / software could, for example, an "About" of the final product / software, a reference to the copyright owner in the context of software as a library or as part of the product / Sortware with a link pointing to the related web page.

4. For questions regarding the license is directed directly to the copyright holder.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

----------------------------------------------
Copyright (c) 2012 Hans-Peter Wandura (ProGade)
Hiermit wird unentgeltlich, jeder Person, die eine Kopie der Software und der zugehörigen Dokumentationen (die "Software") erhält, die Erlaubnis erteilt, sie uneingeschränkt zu benutzen, inklusive und ohne Ausnahme, dem Recht, sie zu verwenden, kopieren, ändern, fusionieren, verlegen, verbreiten, unterlizenzieren und/oder zu verkaufen, und Personen, die diese Software erhalten, diese Rechte zu geben, unter den folgenden Bedingungen:
 
Der obige Urheberrechtsvermerk und dieser Erlaubnisvermerk sind in allen Kopien oder Teilkopien der Software beizulegen.

1. Die Software darf nicht verwendet werden um absichtlich Schaden jeglicher Art anzurichten.

2. Die Software darf nicht direkt als Download auf Webseiten angeboten werden, die nicht vom Copyright Inhaber genemigt wurden. Eine Genehmigung benötigt eine ausdrückliche Erlaubnis vom Copyright Inhaber.

3. Die Software darf weder in Originalform noch in modifizierter / veränderter Form als komplett eigenes Produkt dargestellt werden. Es muss immer erkenntlich werden, dass es sich um die Software vom Copyright Inhaber handelt und gegebenenfalls auf veränderte Teile der Software hingewiesen wird. Bei Verwendung der Software in einem eigenen Produkt/Software könnte zum Beispiel unter einem "About" des endgültigen Produkts/Software ein Hinweis auf den Copyright Inhaber im Zusammenhang mit der Software als Library oder als Teil des Produktes/der Sortware mit Link auf die dazugehörige Webseite hingewisen werden.

4. Bei Fragen zur Lizenz richten Sie sich bitte direkt an den Copyright Inhaber.

DIE SOFTWARE WIRD OHNE JEDE AUSDRÜCKLICHE ODER IMPLIZIERTE GARANTIE BEREITGESTELLT, EINSCHLIESSLICH DER GARANTIE ZUR BENUTZUNG FÜR DEN VORGESEHENEN ODER EINEM BESTIMMTEN ZWECK SOWIE JEGLICHER RECHTSVERLETZUNG, JEDOCH NICHT DARAUF BESCHRÄNKT. IN KEINEM FALL SIND DIE AUTOREN ODER COPYRIGHTINHABER FÜR JEGLICHEN SCHADEN ODER SONSTIGE ANSPRÜCHE HAFTBAR ZU MACHEN, OB INFOLGE DER ERFÜLLUNG EINES VERTRAGES, EINES DELIKTES ODER ANDERS IM ZUSAMMENHANG MIT DER SOFTWARE ODER SONSTIGER VERWENDUNG DER SOFTWARE ENTSTANDEN.

*/
?>