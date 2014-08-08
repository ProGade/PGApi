<h1>Controls</h1>
<h2>Eingabeelemente</h2>
Eingabeelemente für die Benutzeroberfäche (sogenannte Controls) sind Eingabefelder, Textfelder, Buttons, Formulare uvm. mit erweiterten Funktionalitäten und flexiblen Einsatzmöglichkeiten.<br />
Folgende Eingabeelemente stellt die API im Ordner "controls" bereit:<br />
<br />
<table class="pg_docu_example_container">
	<tr><th>Klasse</th><th>Datei</th><th>Kurzbeschreibung</th></tr>
	<tr><td>classPG_BreadCrumb</td><td>breadcrumb.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Button</td><td>button.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_CalendarSheet</td><td>calendarsheet.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_CheckBox</td><td>checkbox.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_CodeEditor</td><td>codeeditor.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_ColorPicker</td><td>colorpicker.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_ContextMenu</td><td>contextmenu.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_DragAndDrop</td><td>draganddrop.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_DragElement</td><td>dragelement.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_DropArea</td><td>droparea.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Form</td><td>form.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Frame</td><td>frame.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Frameset</td><td>frameset.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_InputField</td><td>inputfield.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_PageControl</td><td>pagecontrol.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Popup</td><td>popup.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_ProgressBar</td><td>progressbar.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Slider</td><td>slider.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Tab</td><td>tab.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Tabs</td><td>tabs.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_TextArea</td><td>textarea.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Transform</td><td>transform.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_VideoPlayer</td><td>videoplayer.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Wysiwyg</td><td>wysiwyg.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
</table>
<br />
<h2>Hauptklasse für Eingabeelemente</h2>
Die Klasse "classPG_Controls" ist eine sogenannte Helferklasse, in der allgemeine Methoden bereitgestellt werden.<br />
Diese Methoden dienen zum Beispiel um die genaue Position eines Eingabeelements oder relative Mauspositionen zu diesem Eingabeelement im HTML-Dokument festzustellen.<br />
Es wird empfohlen diese Klasse immer einzubinden, sobald man Eingabeelemente (Controls) der API verwenden möchte.<br />