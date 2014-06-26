<?php
$sLanguage = 'en';
if (isset($_POST['sLanguage'])) {$sLanguage = strtolower($_POST['sLanguage']);}

$sHtml = '';

// Das Login System...
$sHtml .= '<div>';
	$sHtml .=  '<h1>Das Login System</h1>';
	$sHtml .=  '<p>';
		$sHtml .= 'Die API verf�gt �ber ein eigenes, recht flexibles Login-System. Es bietet sehr viele Optionen, kann aber bereits mit wenig Aufwand schnell und einfach eingebunden werden.<br />';
		$sHtml .= '<br />';
		$sHtml .= 'Folgendes Beispiel zeigt die Grundlage zum Einbinden des Login-Systems:';
	$sHtml .=  '</p>';
$sHtml .=  '</div>';

$sExampleCode = '<?php
	// einbinden der wichtigsten API Dateien �ber die Datei include_basics.php...
	include(PG_API_PATH_PHP."system/classbasics.php");
	include(PG_API_PATH_PHP."php/phploader.php");
	include(PG_API_PATH_PHP."include_basics.php");
	eval($oPGPhpLoader->build());

	// �ber die Datei auto_login.php l�uft die komplette Login-Abfrage automatisch...
	include(PG_API_PATH_PHP."auto_login.php");

	if ($oPGLogin->isGuest()) // ist der Benutzer noch nicht eingeloggt? (ist Gast)
	{
		echo $oPGLogin->build(); // anzeigen des Login-Formulars
	}
	else // Benutzer wurde authentifiziert und ist eingeloggt
	{
		echo $oPGLogin->buildUserControlPanel();
		echo "Welcome ".$oPGLogin->getUserData(array("sProperty" => "Username"));
	}
?>';

$sHtml .= '<div class="pg_docu_example_container">';
	$sHtml .= '<code>'.highlight_string($sExampleCode, true).'</code>';
$sHtml .= '</div>';
$sHtml .= '<br />';


// Authentifizierung und Sicherheit...
// - Aufzeigen wie man in der data.php die Defines definieren muss (Secret Keys und Cookies)
// - Kurz Umschreiben das die Abfragen auf ein sicheres System aufbauen (UserType, Password Cryption, Relogin Password, SecureCode, usw.)
$sHtml .= '<div>';
	$sHtml .= '<h1>Authentifizierung und Sicherheit</h1>';
	$sHtml .= '<p>';
		$sHtml .= 'Authentifizierung und Sicherheit sind wichtige Themen und besonders beim Rechte- und beim Login-System sollte darauf geachtet werden, damit sich kein Unbefugter Zugang zu Bereichen verschaffen kann die ihm unzug�nglich sein sollten.<br />';
		$sHtml .= 'Daher machen wir uns stetig gedanken um neue Verfahren und gegbenenfalls Verbesserungen der vorhandenen Sicherheitsma�nahmen der API. Daher ist es sinnvoll immer die m�glichst aktuellste Version der API zu verwenden und sich zu informieren welche neuen Ma�nahmen hinzu gekommen sind.<br />';
		$sHtml .= 'Da es aber bekannterweise keine absoluten Sicherheitsma�nahmen gegen alle M�glichkeiten f�r Angriffe von Hackern gibt, gilt es stets f�r jeden der die API verwenden m�chte, trotz der eingebauten Ma�nahmen, �ber eigene M�glichkeiten der Sicherheit Ihres Systems nachzudenken und entsprechende Ma�nahmen zu ergreifen.<br />';
		$sHtml .= 'Wir versuchen L�cken in unserem System immer zeitnah zu entfernen und die Sicherheit zu erh�hen, aber da die Nutzung der API freiwillig ist, haften wir nicht f�r diese L�cken oder Schaden der dadurch entstehen k�nnte.<br />';
		$sHtml .= 'Bitte pr�fen Sie selbst, ob Ihnen das System sicher genug ist oder ob Sie �nderungen vornehmen m�chten und melden Sie uns gefundene L�cken, damit wir die API verbessern k�nnen.<br />';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// Benutzertypen...
$sHtml .= '<div>';
	$sHtml .= '<h2>Benutzertypen</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Wie jedes gute Login-System, hat auch unser Login-System verschiedene Benutzertypen um zu unterscheiden ob der Benutzer Administratorenrechte besitzt oder lediglich einfacher Anwender ist.<br />';
		$sHtml .= 'Da die API f�r viele Einsatzm�glichkeiten und Systeme entwickelt wurde, gibt es nicht lediglich die Unterscheidung zwischen Admins und Anwender, sondern auch noch Super-Admins und Moderatoren.<br />';
		$sHtml .= '<br />';
		$sHtml .= 'Ein Beispiel f�r die Abgefragt der Benutzertypen:<br />';
	$sHtml .= '</p>';
$sHtml .= '</div>';

$sExampleCode = '<?php
	// Ist der Benutzer ein Admin oder Super-Admin? ...
	if ($oPGLogin->isUserType(array(\'iUserType\' => PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN)))
	{
		// Wird nur mit Admin-Berechtigung darstellen! ...
		echo \'<a href="admin.php" target="_self">Admin-Panel</a>\';
	}
	// Ist der Benutzer ein Moderator? ...
	else if ($oPGLogin->isUsertype(array(\'iUserType\' =>  PG_LOGIN_USERTYPE_MODERATOR)))
	{
		// Wird nur mit Moderator-Berechtigung darstellen! ...
		echo \'<a href="moderator.php" target="_self">Moderator-Panel</a>\';
	}
?>';

$sHtml .= '<div class="pg_docu_example_container">';
	$sHtml .= '<code>'.highlight_string($sExampleCode, true).'</code>';
$sHtml .= '</div>';
$sHtml .= '<br />';

// - Accept Account ansprechen
$sHtml .= '<div>';
	$sHtml .= '<h2>Benutzerprofil akzeptieren</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// - Multilogin System ansprechen
$sHtml .= '<div>';
	$sHtml .= '<h2>Multilogin - mehrfach gleichzeitig einloggen</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// - Auf das Captcha aufmerksam machen
$sHtml .= '<div>';
	$sHtml .= '<h2>Captcha Codes</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Was ist das denn? Oftmals kennt man etwas vom Sehen her, aber der Name ist relativ unbekannt. So ist es auch bei den Capture Codes.<br />';
		$sHtml .= 'Man muss Sie oft bei Registrationen von Benutzerprofilen und ab und zu auch bei Logins oder anderen Formularen als zus�tzliche Sicherheitsabfrage eingeben.<br />';
		$sHtml .= 'Nur welchen Sinn haben nun diese Capture Codes und wie funktionieren sie?<br />';
		$sHtml .= 'Capture Codes sind Grafiken, die beim Aufruf einer Webseite dynamisch generiert werden und Zahlen sowie Buchstaben enthalten k�nnen.<br />';
		$sHtml .= 'Diese Buchstaben und Zahlen dienen dazu sie in ein daf�r vorgesehenes Eingabefeld einzugeben um dadurch herauszufinden ob das Formular von einem Menschen oder von einem Bot (Script) ausgef�llt wurde.<br />';
		$sHtml .= 'Damit nicht auch diese Bot-Scripte die Buchstaben und Zahlen auf den Bildern erkennen k�nnen, wird versucht das Bild etwas zu verfremden, indem etwas wie ein Gitternetz oder krumme Buchstaben und Zahlen sowie irgendwelche wild drauf los gemalten Striche hinzugef�gt werden.<br />';
		$sHtml .= '<br />';
		$sHtml .= 'Die API bietet vorgefertigte Capture-Code Grafiken (Zahlen), die aber auch leicht durch eigene ersetzt werden k�nnen:<br />';
	$sHtml .= '</p>';
$sHtml .= '</div>';

$sExampleCode = '<?php
	// einbinden der wichtigsten API Dateien �ber die Datei include_basics.php...
	include(PG_API_PATH_PHP."system/classbasics.php");
	include(PG_API_PATH_PHP."php/phploader.php");
	include(PG_API_PATH_PHP."include_basics.php");
	$oPGPhpLoader->addFile(array("sFile" => "graphics/captcha.php")); // binde die Captcha Klasse der API ein
	eval($oPGPhpLoader->build());
	
	// �ber die Datei auto_login.php l�uft die komplette Login-Abfrage automatisch...
	include(PG_API_PATH_PHP."auto_login.php");

	$oPGLogin->enableRegisterWithCaptcha(); // Captcha Code beim Registrieren verwenden
	$oPGLogin->enableLoginWithCaptcha(); // Captcha Code beim Login verwenden
	echo $oPGLogin->build(); // Erstelle das Login bzw. die Registration
?>';

$sHtml .= '<div class="pg_docu_example_container">';
	$sHtml .= '<code>'.highlight_string($sExampleCode, true).'</code>';
$sHtml .= '</div>';
$sHtml .= '<br />';

// - Das Passwort System ansprechen (min Zeichen, Sonderzeichen, Password Cryption, usw.)
$sHtml .= '<div>';
	$sHtml .= '<h2>Passwort System</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// Mail System...
$sHtml .= '<div>';
	$sHtml .= '<h1>System-E-Mails</h1>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// Administration...
$sHtml .= '<div>';
	$sHtml .= '<h1>Administration</h1>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// - Aufzeigen der Accept-Funktionen
$sHtml .= '<div>';
	$sHtml .= '<h2>Benutzer freischalten</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// - Aufzeigen der Ban-Funktionen
$sHtml .= '<div>';
	$sHtml .= '<h2>Benutzer sperren und Sperre wieder aufheben</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// - Aufzeigen der SimulateUserID Funktionalit�t
// - Aufzeigen der ActionLog Funktionen
$sHtml .= '<div>';
	$sHtml .= '<h2>Hilfestellung bei Problemen eines Benutzers</h2>';
	$sHtml .= '<p>';
		$sHtml .= 'Todo...';
	$sHtml .= '</p>';
$sHtml .= '</div>';

// Rechtliches...
// - Aufzeigen von den Funktionen f�r "Privacy Police", "Privacy Terms", "Terms of use" und "Terms and conditions"
$sHtml .= '<div>';
	$sHtml .= '<h1>Rechtliches</h1>';
	$sHtml .= '<p>';
		$sHtml .= 'Es macht immer Sinn, den Benutzer eines Systems �ber seine Rechte, Pflichten, die Verwendung der von ihm gespeicherten Daten und gegebene Verhaltensregeln zu informieren. Das ist in manchen L�ndern sogar (zum Teil) gesetzlich festgelegt und sollte daher unbedingt beachtet werden.<br />';
		$sHtml .= 'Nat�rlich k�nnen wir nicht stetig die aktuellsten Dinge in allen L�ndern abdecken die rechtlich vorgesehen sind. Daher muss jeder der diese API verwenden m�chte sich selbst informieren, welche gesetzlichen Bedingungen bei ihm im Land vorgeschrieben sind. Wir �bernehmen keinerlei Verantwortung oder Haftung f�r die falsche Verwendung oder den falschen Einsatz der API.<br />';
		$sHtml .= 'Dennoch sind wir bem�ht wenigstens die g�nigsten, rechtlichen Funktionen zur Informationsbereitstellung im Login System der API einzubinden. Ebenso bietet die API Best�tigungsm�glichkeiten, dass diese Informationen vom Benutzer zur Kenntniss genommen wurden.<br />';
		$sHtml .= 'Bitte beherzigt bei der Entwicklung Eurer Systeme den Benutzer stets mit den oben genannten, wichtigen Informationen zu versorgen, damit keine rechtlichen Probleme entstehen.<br/>';
		$sHtml .= 'Unserer Ansicht nach sollte der gute Umgang mit den Benutzern eines Systems und deren Daten "immer" im Vordergrund stehen.<br />';
		$sHtml .= '<br />';
		$sHtml .= 'Beispiele zur Bereitstellung der rechtlichen Informationen:';
	$sHtml .= '</p>';
$sHtml .= '</div>';

$sExampleCode = '<?php
	// Verlinkung der Datenschutzerkl�rung...
	$oPGLogin->setPrivacyPolicyUrl(array("sUrl" => "info/privacy_policy.php"));
	
	// Verlinkung der Datenschutzrichtlinien...
	$oPGLogin->setPrivacyTermsUrl(array("sUrl" => "info/privacy_terms.php"));
	
	// Verlinkung der Nutzungsbedingungen...
	$oPGLogin->setTermsOfUseUrl(array("sUrl" => "info/terms_of_use.php"));
	
	// Verlinkung der Gesch�ftsbedingungen (AGB)...
	$oPGLogin->setTermsAndConditionsUrl(array("sUrl" => "info/terms_and_conditions.php"));
?>';

$sHtml .= '<div class="pg_docu_example_container">';
	$sHtml .= '<code>'.highlight_string($sExampleCode, true).'</code>';
$sHtml .= '</div>';
$sHtml .= '<br />';

echo $sHtml;
?>