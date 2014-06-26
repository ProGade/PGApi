<h1>Basics</h1>

<h2>System</h2>
The Basics are a collection of classes (in the folder "system") that simplifies the programming and remove a constantly recurring work.<br />
They form the basic system of the API. Other classes of the API use these base classes, so they are an integral part of the API and should always be involved in the project. (Example: include ("include_basics.php");)<br />
<br />
<table class="pg_docu_example_container">
	<tr><th>Class</th><th>File</th><th>Short description</th></tr>
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
<h2>Inherited base class</h2>
There is also a base class that was inherited by most other classes. It's called "classPG_ClassBasics" and provides many methods that are used often and are faster in access by the inheritance.<br />
When needed you can inherit any (own) class from this base class to get also this fast access to the most important methods.<br />
Here is a small example of how you can inherit from this base class for your own class and use its methods:<br />
<br />
<?php
$sExampleCode = '<?php
	// Include the most important API files via the file include_basics.php...
	include(PG_API_PATH_PHP."system/classbasics.php");
	include(PG_API_PATH_PHP."php/phploader.php");
	include(PG_API_PATH_PHP."include_basics.php");
	eval($oPGPhpLoader->build());
	
	include("data.php"); // Include the required data such as MySQL login and password

	// Your own class that inherits from the base class...
	class MeineKlasse extends classPG_ClassBasics
	{
		public function __construct()
		{
			$this->setID(array("sID" => "MyClassID")); // Set a class ID
			$this->initClassBasics(); // Initialize the frequently used basics
			$this->initDatabase(); // Initializing the database
		}
		
		public function saveData($_axData)
		{
			// saveDataset() is available after inheritance...
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
			// selectDatasets() is available after inheritance...
			return $this->selectDatasets("sTable" => "test");
		}
	}
?>';
echo '<div class="pg_docu_example_container">';
	echo '<code>'.highlight_string($sExampleCode, true).'</code>';
echo '</div>';
?>

