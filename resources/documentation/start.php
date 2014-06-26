<?php
$sLanguage = strtolower($_POST['sLanguage']);

$sApiReferenceDocuComplete = '<ul>
	<li>controls</li>
	<ul>
		<li>breadcrumb.php</li>
		<li>breadcrumb.js</li>
		<li>button.php</li>
		<li>button.js</li>
		<li>calendarsheet.php</li>
		<li>calendarsheet.js</li>
		<li>controls.php</li>
		<li>controls.js</li>
		<li>form.php</li>
		<li>form.js</li>
		<li>frame.php</li>
		<li>frame.js</li>
		<li>frameset.php</li>
		<li>frameset.js</li>
		<li>pagecontrol.php</li>
		<li>popup.php</li>
		<li>popup.js</li>
		<li>progressbar.php</li>
		<li>progressbar.js</li>
	</ul>
	<li>css</li>
	<ul>
		<li>cssloader.php</li>
	</ul>
	<li>graphics</li>
	<ul>
		<li>gfx.js</li>
	</ul>
	<li>input</li>
	<ul>
		<li>keyhandler.js</li>
		<li>input.js</li>
	</ul>
	<li>javascript</li>
	<ul>
		<li>jsloader.php</li>
		<li>jsloader.js</li>
	</ul>
	<li>php</li>
	<ul>
		<li>phploader.php</li>
	</ul>
	<li>system</li>
	<ul>
		<li>classbasics.php</li>
		<li>classbasics.js</li>
		<li>api.php</li>
		<li>eventmanager.js</li>
	</ul>
	<li>user</li>
	<ul>
		<li>login.php</li>
		<li>login.js</li>
		<li>rights.php</li>
		<li>users.php</li>
	</ul>
	<li>website</li>
	<ul>
		<li>website.php</li>
	</ul>
	<li>xml</li>
	<ul>
		<li>rss.php</li>
		<li>xmlread.php</li>
		<li>xmlread.js</li>
		<li>xmlwrite.php</li>
		<li>xmlwrite.js</li>
	</ul>
</ul>';

$sApiRecerenceDocuIncomplete = '<ul>
	<li>controls</li>
	<ul>
		<li>checkbox.php</li>
		<li>checkbox.js</li>
		<li>contextmenu.js</li>
		<li>draganddrop.php</li>
		<li>draganddrop.js</li>
		<li>dragelement.php</li>
		<li>dragelement.js</li>
		<li>droparea.php</li>
		<li>droparea.js</li>
		<li>inputfield.php</li>
		<li>inputfield.js</li>
		<li>textarea.php</li>
		<li>textarea.js</li>
	</ul>
	<li>cryption</li>
	<ul>
		<li>cryption.php</li>
	</ul>
	<li>css</li>
	<ul>
		<li>css.php</li>
		<li>css.js</li>
		<li>cssloader.js</li>
	</ul>
	<li>database</li>
	<ul>
		<li>database.php</li>
		<li>database.js</li>
		<li>databaseupdate.php</li>
		<li>databaseupdate.js</li>
		<li>mysql.php</li>
		<li>mysqlstatements.php</li>
	</ul>
	<li>debug<li>
	<ul>
		<li>debugconsole.php</li>
		<li>debugconsole.js</li>
		<li>logs.php</li>
		<li>useractionlog.php</li>
		<li>vardebug.js</li>
	</ul>
	<li>filesystem</li>
	<ul>
		<li>download.php</li>
		<li>filesystem.php</li>
		<li>folderupdate.php</li>
		<li>folderupdate.js</li>
		<li>upload.php</li>
		<li>upload.js</li>
	</ul>
	<li>graphics</li>
	<ul>
		<li>canvas.php</li>
		<li>canvas.js</li>
		<li>captcha.php</li>
		<li>captcha.js</li>
		<li>gfx.php</li>
		<li>sprite.php</li>
		<li>sprite.js</li>
		<li>sprites.php</li>
		<li>sprites.js</li>
	</ul>
	<li>html</li>
	<ul>
		<li>divs.php</li>
		<li>divs.js</li>
		<li>imgs.php</li>
		<li>imgs.js</li>
	</ul>
	<li>input</li>
	<ul>
		<li>mouse.js</li>
		<li>touchhandler.js</li>
	</ul>
	<li>mail</li>
	<ul>
		<li>imap.php</li>
		<li>mail.php</li>
		<li>mailshare.php</li>
	</ul>
	<li>network</li>
	<ul>
		<li>ajax.js</li>
		<li>network.php</li>
		<li>network.js</li>
	</ul>
	<li>parse</li>
	<ul>
		<li>codeparser.php</li>
		<li>codeparser.js</li>
	</ul>
	<li>system</li>
	<ul>
		<li>api.js</li>
		<li>arrays.php</li>
		<li>arrays.js</li>
		<li>browser.php</li>
		<li>browser.js</li>
		<li>checkjs.php</li>
		<li>curl.php</li>
		<li>date.php</li>
		<li>date.js</li>
		<li>functions.php</li>
		<li>nodes.js</li>
		<li>objects.php</li>
		<li>objects.js</li>
		<li>random.php</li>
		<li>random.js</li>
		<li>registervars.php</li>
		<li>sessionvars.php</li>
		<li>string.php</li>
		<li>string.js</li>
		<li>vars.php</li>
		<li>vars.js</li>
	</ul>
	<li>update</li>
	<ul>
		<li>update.php</li>
		<li>udpate.js</li>
	</ul>
	<li>website</li>
	<ul>
		<li>meta.php</li>
		<li>opengraph.php</li>
		<li>template.php</li>
	</ul>
</ul>';

$asText = array(
	'en' => array(
		'Text' => '<h1>ProGade API Alpha Version</h1>
This documentation is still under construction and is therefore not described fully at any point. <br />
We ask for your patience, we are working on an implementation that will answer all questions.
<br /><br />
<a href="license.txt" target="_blank">You can view the License for the ProGade API here.</a>
<br /><br />
<b>Fully documented so far:</b>
<ul>
	<li>API Reference</li>
	'.$sApiReferenceDocuComplete.'
</ul>
<b>Are yet to be documented:</b>
<ul>
	<li>API Reference</li>
	'.$sApiRecerenceDocuIncomplete.'
</ul>'
	),
	
	'de' => array(
		'Text' => '<h1>ProGade API Alpha Version</h1>
Diese Dokumentation befindet sich noch im Aufbau und ist daher nicht an jeder Stelle vollst&auml;ndig beschrieben.<br />
Wir bitten um etwas geduld, wir arbeiten an einer Umsetzung die alle Fragen beantworten wird.
<br /><br />
<a href="license.txt" target="_blank">Die Lizenz f&uuml;r die ProGade API k&ouml;nnen Sie hier ansehen.</a>
<br /><br />
<b>Komplett dokumentiert ist bisher:</b>
<ul>
	<li>API Reference</li>
	'.$sApiReferenceDocuComplete.'
</ul>
<b>Noch zu dokumentieren sind:</b>
<ul>
	<li>API Reference</li>
	'.$sApiRecerenceDocuIncomplete.'
</ul>'
	)
);

echo trim($asText[$sLanguage]['Text']);
?>