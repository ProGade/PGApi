<h1>Basics</h1>

<h2>System</h2>
Die Basics sind eine Ansammlung von Klassen (im Ordner "system") die das programmieren erleichtern und einem ständig wiederkehrende Arbeit abnehmen.<br />
Sie bilden das Grundsystem der API. Anderen Klassen der API verwenden diese Basisklassen, daher sind sie fester Bestandteil der API und sollten immer ins Projekt eingebunden werden. (Beispiel: include("include_basics.php");)<br />
<br />
<table class="pg_docu_example_container">
	<tr><th>Klasse</th><th>Datei</th><th>Kurzbeschreibung</th></tr>
	<tr><td>classPG_Api</td><td>api.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Arrays</td><td>arrays.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Browser</td><td>browser.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Curl</td><td>curl.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Date</td><td>curl.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_EventManager</td><td>eventmanager.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Functions</td><td>function.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Math</td><td>math.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Nodes</td><td>nodes.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Objects</td><td>objects.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Random</td><td>random.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_RegisterVars</td><td>registervars.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Selection</td><td>selection.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_SessionVars</td><td>sessionvars.php</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Strings</td><td>strings.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
	<tr><td>classPG_Vars</td><td>vars.php/.js</td><td class="pg_docu_descriptions">...</td></tr>
</table>
<br />
<h2>Vererbte Basisklasse</h2>
Desweiteren gibt es eine Basisklasse die an die meisten anderen Klassen vererbt wurde. Sie nennt sich "classPG_ClassBasics" und stellt viele Methoden bereit, die oft verwendet werden und durch die Vererbung schneller im Zugriff sind.<br />
Bei bedarf kann man jede (auch eigene) Klasse von dieser Basisklasse erben um dadurch auch schnellen Zugriff auf die wichtigsten Methoden zu bekommen.<br />
Hier ist ein kleines Beispiel wie man diese Basisklasse einer eigenen Klasse vererben und deren Methoden benutzen kann:<br />
<br />
<?php
$sExampleCode = '<?php
	// einbinden der wichtigsten API Dateien über die Datei include_basics.php...
	include(PG_API_PATH_PHP."system/classbasics.php");
	include(PG_API_PATH_PHP."php/phploader.php");
	include(PG_API_PATH_PHP."include_basics.php");
	eval($oPGPhpLoader->build());
	
	include("data.php"); // einbinden der benötigten Daten wie z.B. MySQL Login und Passwort

	// Eigene Klasse, die von der Grundklasse erbt...
	class MeineKlasse extends classPG_ClassBasics
	{
		public function __construct()
		{
			$this->setID(array("sID" => "MeineKlasseID")); // Setzen einer KlassenID
			$this->initClassBasics(); // Initialisieren der häufig verwendeten Basics
			$this->initDatabase(); // Initialisieren der Datenbank(en)
		}
		
		public function saveData($_axData)
		{
			// saveDataset() ist verfügbar nachdem geerbt wurde...
			$this->saveDataset(
				array(
					"sTable" => "test", 
					"axColumnsAndValues" => $_axData, 
					"bAllowAnonymInsert" => true
				)
			);
		}
		
		public function readData()
		{
			// selectDatasets() ist verfügbar nachdem geerbt wurde...
			return $this->selectDatasets("sTable" => "test");
		}
	}
?>';
echo '<div class="pg_docu_example_container">';
	echo '<code>'.highlight_string($sExampleCode, true).'</code>';
echo '</div>';
?>

