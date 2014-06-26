<?php
$sLanguage = 'en';
if (isset($_POST['sLanguage'])) {$sLanguage = strtolower($_POST['sLanguage']);}
?>
<div>
<h1>Die API Einbinden</h1>
Um die API verwenden zu k�nnen gibt mehrere M�glichkeiten die Dateien der API einzubinden. Zum einen nur als einzelne Scripte direkt �ber Includes oder �ber vorgefertigte Include Dateien.<br /> 
Es gibt momentan 2 vorgefertigte Include Dateien (weitere folgen noch):<br />
<br />
- Der optimierte Weg w�re es die basics.php Datei einzubinden, die nur die n�tigsten Scripte einbindet und die restlichen Scripte die man zum Programmieren braucht bindet man danach selbst ein.<br />
- Alternativ kann man um schneller loslegen zu k�nnen oder wenn es nicht auf Geschwindigkeit beim laden der Webseite ankommt die include_full.php Datei einbinden die alle Dateien der API verwendet.<br />
<br />
Hier ein kleines Beispiel zum Einbinden der Dateien:<br />
</div>
<br />
<h2>Datei: data.php</h2>
<?php
$sExampleCode = '<?php
	// Definitionen der API-Pfade (absolute und relative Pfade sind m�glich)...
	define("PG_API_PATH_JS", "http://www.mydomain.com/api/"); // Pfad zu den JavaScript Dateien der API.
	define("PG_API_PATH_PHP", "C:/inetpub/wwwroot/api/");     // Pfad zu den PHP Dateien der API. Bei Linux: /srv/www/htdocs/api/
	
	// einbinden der gesamten API Dateien �ber die Datei "include_full.php"...
	include(PG_API_PATH_PHP."system/classbasics.php");  // muss in jedem Projekt als erstes included werden!
	include(PG_API_PATH_PHP."javascript/jsloader.php"); // wird ben�tigt um die JavaScript Dateien zu laden.
	include(PG_API_PATH_PHP."php/phploader.php");       // wird ben�tigt um die PHP Dateien zu laden.
	include(PG_API_PATH_PHP."include_full.php");        // setzt alle API Dateien in den PHP Loader.
	eval($oPGPhpLoader->build());                       // hier werden die PHP Dateien eingebunden.
	
	echo "<html>";
		echo "<head>";
			echo $oPGJsLoader->build(); // hier werden die JavaScript Dateien eingebunden.
		echo "</head>";
	echo "</html>";
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />
<div>
Das Beispiel zeigt wie man die komplette API mit relativ wenig Aufwand einbinden kann.<br />
<br />
<h1>Webseite und Templates</h1>
Hier m�chte ich schon einmal darauf hinweisen, dass f�r nahezu jedes Objekt / jede Klasse der API eine Methode namens "build" existiert.<br />
�ber diese Methode wird meist alles ausgef�hrt und erstellt und sie gibt immer das fertige Ergebnis zur�ck, dass direkt verwendet werden kann.<br />
Lediglich ein paar Optionen oder Elemente k�nnen bzw. m�ssen bei manchen Objekten / Klassen hinzugef�gt werden um ein passendes Ergebnis zu erhalten.<br />
Ansonsten reicht meistens diese Methode aus.<br />
<br />
Die API hat auch f�r den Grundaufbau einer Webseite mit Template Funktion bis hin zum kleinsten Element einer Webseite oder einer App alles was man braucht.<br />
<br />
Ein kleines Beispiel zur Verwendung des Webseiten und Template Systems der API:<br />
</div>
<br />

<h2>Datei: index.php</h2>
<?php
$sExampleCode = '<?php
	// In dieser Datei ist der Quellcode des oberen Beispiels, bis auf die Echos...
	include("data.php"); // hier wird die API eingebunden und Optionen sowie Pfade definiert.
	
	// Einbinden eigener CSS Dateien �ber ein GFX-Pack* (Standardpfad: "gfx/default/css/")...
	$oPGWebsite->setCssFiles(array("asFiles" => array("main.css", "buttons.css")));

	// Einbinden eigener JavaScript Dateien...
	$oPGWebsite->setJavaScriptPath(array("sPath" => "scripts/")); // Setzt den Pfad zu eigenen JavaScript Dateien
	$oPGWebsite->setJavaScriptFiles(array("asFiles" => array("main.js", "debug.js")));
	
	// ausgeben der Webseite...
	echo $oPGWebsite->build(array("xTemplate" => "gfx/default/templates/main.php"));
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />

<div>
* Bei den CSS-Dateien wurde auf ein GFX-Pack hingewiesen. Weitere Informationen �ber GFX-Packs gibt es im Manual unter "Grundlagen -> GFX-Packs".<br />
<br />
Um in einer Template Datei auf die API Objekte zugreifen zu k�nnen, m�ssen diese aus dem API-Objekt geholt werden.<br />
Man kann dazu entweder alle Objekte auf einmal in einen Array oder jedes Objekt einzelnd setzen.<br />
Alternativ dazu kann man auch die Datei "auto_getregistered.php" einbinden, die dann alle registrierten Objekte wieder herstellt.<br />
<br />
Hier ist ein Beispiel dazu:<br />
</div>
<br />

<h2>Datei: gfx/default/templates/main.php</h2>
<?php
$sExampleCode = '<?php
	// holen der API Default-Objekte aus dem API-Objekt...
	$axApi = $oPGApi->getRegistered();                                  // 1. Variante: setze alle Objekte in ein Array
	$oPGString = $oPGApi->getRegistered(array("sName" => "oPGString")); // 2. Variante: hole nur oPGString aus dem API-Objekt
	include(PG_API_PATH_PHP."auto_getregistered.php");                  // 3. Variante: lasse alle registrierten Objekte wieder herstellen
	
	// Verwendung der Objekte in einem Template...
	$oParameters = $axApi["oPGString"]->toObject(array("sString" => "a=1&b=2")); // Verwendung eines API-Objekts �ber den Array
	$oParameters = $oPGString->toObject(array("sString" => "a=1&b=2"));          // Direkte Verwendung des Objekts
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />

<div>
<h1>Datentypen und �bergabeparameter</h1>
Vielleicht ist bereits aufgefallen, dass alle Parameter �ber ein Array �bergeben wurden und die Variablen immer einen kleinen Buchstaben vor ihren Namen haben.<br />
Die kleinen Buchstaben stehen f�r den Typ der Variablen:<br />
<ul>
	<li>s = String</li>
	<li>i = Integer</li>
	<li>d = Double oder Float</li>
	<li>n = Number (Integer, Double oder Float)</li>
	<li>b = Boolean</li>
	<li>f = Funktion oder Methode</li>
	<li>x = Mixed (unbestimmt oder mehrere Typen sind m�glich)</li>
	<li>o = Object</li>
	<li>a = Array (kann mit anderen Typen kombiniert werden, wie z.B. "$asArrayString" entspricht einem Array der nur aus Strings besteht.)</li>
</ul>
Die �bergaben an die Methoden werden hier in Arrays gepackt um etwas flexibler bei der �bergabe der optionalen Parameter zu sein.<br />
Wenn z.B. eine Methode 3 Parameter erwartet und nur der Erste ist ein Pflicht-Parameter und die restlichen Parameter sind optional, muss man nicht unbedingt jeden Parameter angeben und auf NULL setzen um den letzten Parameter auf einen Wert setzen zu k�nnen.<br />
Zum Anderen ist die Reihenfolge der Parameter egal. Falls es mal �nderungen der Reihenfolge bei einem Update der API geben sollte kann man seinen eigenen Quelltext unver�ndert bestehen lassen.<br />
Bei der API kann aber auch auf normale Angabe der Parameter ohne Arrays zur�ckgegriffen werden. Beide Schreibweisen sind also m�glich. Doch ich empfehle die Array-Variante aus genannten Gr�nden.<br />
Bei JavaScript sieht es �hnlich aus, nur wird dort kein Array verwendet sondern JSON benutzt.<br />
Welche Variante man bevorzugt bleibt einem selbst �berlassen.<br />
Hier ein kleines Beispiel:<br />
</div>
<br />
<?php
$sExampleCode = '<?php
	// �bergaben der Parameter wie sie �blich sind.
	// Hier muss der zweite Parameter �bergeben werden um die Reihenfolge einzuhalten...
	$oObject = $oPGString->toObject("a=1&b=2", NULL, "=");  // in PHP
	var oObject = oPGString.toObject("a=1&b=2", null, "="); // in JavaScript
	
	// �bergaben der Parameter mit Arrays in PHP bzw. JSON in JavaScript.
	// Hier kann der zweite Parameter ausgelassen werden...
	$oParameters = $oPGString->toObject(array("sString" => "a=1&b=2", "sValueSeperator" => "=")); // in PHP mit Arrays
	var oParameters = oPGString.toObject({"sString": "a=1&b=2", "sValueSeperator": "="});         // in JavaScript mit JSON
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />
