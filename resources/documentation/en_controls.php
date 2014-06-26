<h1>Controls</h1>
<h2>Input elements</h2>
Input elements for the user interface (called controls) are input fields, text areas, buttons, forms, etc. with enhanced features and flexible usage options.<br />
The API provides the following input elements in the "controls" folder:<br />
<br />
<table class="pg_docu_example_container">
	<tr><th>Class</th><th>File</th><th>Short description</th></tr>
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
<h2>Main class for input elements</h2>
The class "classPG_Controls" is a so-called helper class which provides common methods.<br />
These methods are used for example to determine the exact position of an input element or relative mouse position to the input element in the HTML document.<br />
It is recommended always to include this class, if you want to use input elements (controls) of the API.<br />