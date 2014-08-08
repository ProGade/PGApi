<?php
$sLanguage = 'en';
if (isset($_POST['sLanguage'])) {$sLanguage = strtolower($_POST['sLanguage']);}
?>
<div>
<h1>Including the API</h1>
There are serveral ways to include the API files. One way is to directly include single files as needed, the other way is to include predefined include files.<br /> 
Currently there are 2 predefined include files (more will follow):<br />
<br />
- The optimized way is to include the include_basics.php file. This files includes the most necessary scripts and then you include the rest of the scripts you need to program.<br />
- Alternatively you can start faster if it's not needed to get fastest performance on loading the website with including the include_full.php to include the whole API files.<br />
<br />
Here is a litte example to include the files:<br />
</div>
<br />
<h2>File: data.php</h2>
<?php
$sExampleCode = '<?php
	// Definitions of API pathes (absolute and relative pathes are possible)...
	define("PG_API_PATH_JS", "http://www.mydomain.com/api/"); // Path to the JavaScript files of the API.
	define("PG_API_PATH_PHP", "C:/inetpub/wwwroot/api/");     // Path to the PHP files of the API. On Linux: /srv/www/htdocs/api/
	
	// include the whole API files through the file "include_full.php"...
	include(PG_API_PATH_PHP."system/classbasics.php");  // must be the first include in every project!
	include(PG_API_PATH_PHP."javascript/jsloader.php"); // needed to load JavaScript files.
	include(PG_API_PATH_PHP."php/phploader.php");       // needed to load PHP files.
	include(PG_API_PATH_PHP."include_full.php");        // sets all API files in the PHP Loader.
	eval($oPGPhpLoader->build());                       // the PHP files are included here.
	
	echo "<html>";
		echo "<head>";
			echo $oPGJsLoader->build(); // the JavaScript files are included here.
		echo "</head>";
	echo "</html>";
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />
<div>
The Example shows how to include the whole API with relatively little effort.<br />
<br />
<h1>Website and Templates</h1>
Here I would like to point out that for almost every object / each of the API class a method named "build" exists.<br />
Through this method, usually everything will run and created and it always returns the finished product that can be used directly.<br />
Only a few options or elements can or must be added to some objects / classes to get a suitable result.<br />
Otherwise, this method usually suffices.<br />
<br />
The API also has functions for the basic structure of a web page with template function down to the smallest element of a website or an app all what you need.<br />
<br />
A little example of using the website and template system of the API:<br />
</div>
<br />

<h2>File: index.php</h2>
<?php
$sExampleCode = '<?php
	// in this file is the code of the Example above without the echos...
	include("data.php"); // here is the API included and options as well as pathes are defined.
	
	// Including own CSS files through a GFX-Package* (Default path: "gfx/default/css/")...
	$oPGWebsite->setCssFiles(array("asFiles" => array("main.css", "buttons.css")));

	// Including own JavaScript files...
	$oPGWebsite->setJavaScriptPath(array("sPath" => "scripts/")); // sets the path to own JavaScript files
	$oPGWebsite->setJavaScriptFiles(array("asFiles" => array("main.js", "debug.js")));
	
	// output of the website...
	echo $oPGWebsite->build(array("xTemplate" => "gfx/default/templates/main.php"));
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />

<div>
* At the css files of the example was referenced on a GFX package. There are more details of GFX-Packs in the manual under "Basics-> GFX Packs".<br />
<br />
To get access in a template file to the API objects, they must be get out of the API object.<br />
You can either get all objects at once in an array or set each object separately.<br />
Alternatively, you can include the file "auto_getregistered.php" that restores all registered objects.<br />
<br />
Here is a example:<br />
</div>
<br />

<h2>File: gfx/default/templates/main.php</h2>
<?php
$sExampleCode = '<?php
	// get the API default objects out of the API object...
	$axApi = $oPGApi->getRegistered();                                  // 1. Varaint: set all objects into an array
	$oPGString = $oPGApi->getRegistered(array("sName" => "oPGString")); // 2. Varaint: get oPGString out of the API object only
	include(PG_API_PATH_PHP."auto_getregistered.php");                  // 3. Variant: leave restore all registered objects
	
	// using the objects in a template...
	$oParameters = $axApi["oPGString"]->toObject(array("sString" => "a=1&b=2")); // using one of the API objects through the array
	$oParameters = $oPGString->toObject(array("sString" => "a=1&b=2"));          // using the object directly
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />

<div>
<h1>Data types and Transfer parameters</h1>
Perhaps you have noticed that all parameters were passed through an array and the variables have always a small letter before their names.<br />
The small letters are the types of the variables:<br />
<ul>
	<li>s = String</li>
	<li>i = Integer</li>
	<li>d = Double or Float</li>
	<li>n = Number (Integer, Double or Float)</li>
	<li>b = Boolean</li>
	<li>f = Funktion or Methode</li>
	<li>x = Mixed (indefinite or serveral types are possible)</li>
	<li>o = Object</li>
	<li>a = Array (which may be combined with other types, such as "$asArrayString" corresponds to an array consisting of only strings.)</li>
</ul>
The transfers to the methods here are packed into arrays to be more flexible when passing the optional parameters.<br />
If for example a method has 3 parameters and only the first parameter is a required parameter and the rest are optionally, you must not set all other parameters to null if you want to set the last parameter.<br />
On the other hand, the order of the parameters does not matter. If there are any changes in the order of the parameters at an update of the API then you can leave your own source code as it is.<br />
With the API you can also specify the parameters on normal way without an array. Both spellings are possible. But I recommend the array version for the reasons above.<br />
In JavaScript, the situation is similar, except that there is not used an array but uses JSON to transfer the parameters.<bn />
Which flavor you prefer is your desire.<br />
Here is a litte example:<br />
</div>
<br />
<?php
$sExampleCode = '<?php
	// Transfers of the parameters through the usual way.
	// Here, the second parameter must be passed to comply the ordering sequence....
	$oObject = $oPGString->toObject("a=1&b=2", NULL, "=");  // in PHP
	var oObject = oPGString.toObject("a=1&b=2", null, "="); // in JavaScript
	
	// Transfer of the parameters with arrays in PHP or JSON in JavaScript.
	// Here, the second parameter can be omitted...
	$oParameters = $oPGString->toObject(array("sString" => "a=1&b=2", "sValueSeperator" => "=")); // in PHP with Arrays
	var oParameters = oPGString.toObject({"sString": "a=1&b=2", "sValueSeperator": "="});         // in JavaScript with JSON
?>';
?>
<div class="pg_docu_example_container">
	<code><?php highlight_string($sExampleCode); ?></code>
</div>
<br />
