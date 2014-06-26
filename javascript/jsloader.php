<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class

@description
[en]This class has methods for loading of JavaScript files.[/en]
[de]Diese Klasse verf�gt �ber Methoden zum laden von JavaScript Dateien.[/de]

@param extends classPG_ClassBasics
*/
class classPG_JsLoader extends classPG_ClassBasics
{
	// Declarations...
	private $sFilesPath = '';
	private $asFiles = array();
	private $bUseIncludes = true;
	private $sCode = '';
	
	// Construct...
	public function __construct()
	{
		$this->setLineBreak(array('sString' => "\n"));
		$this->useLineBreak(array('bUse' => true));
	}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the base path for all JavaScript files to be loaded.[/en]
	[de]Setzt den Basis-Pfad f�r alle JavaScript Dateien die geladen werden sollen.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path as the basis of all the files.[/en]
	[de]Der Pfad als Basis aller Dateien.[/de]
	*/
	public function setFilesPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sFilesPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns base path for all JavaScript files.[/en]
	[de]Gibt den Basis-Pfad f�r alle JavaScript Dateien zur�ck.[/de]
	
	@return sFilesPath [type]string[/type]
	[en]Returns the path as a string.[/en]
	[de]Gibt den Pfad als String zur�ck.[/de]
	*/
	public function getFilesPath() {return $this->sFilesPath;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the files to be loaded.[/en]
	[de]Setzt die Dateien die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The files to be loaded as a string array.[/en]
	[de]Die Dateien die geladen werden sollen als String-Array.[/de]
	*/
	public function setFiles($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asFiles = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds files to the loader to load.[/en]
	[de]F�gt Dateien zum Loader hinzu, die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The files to be loaded as a string array.[/en]
	[de]Die Dateien die geladen werden sollen als String-Array.[/de]
	*/
	public function addFiles($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asFiles = array_merge($this->asFiles, $_asFiles);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a file to the loader to load.[/en]
	[de]F�gt eine Datei zum Loader hinzu, die geladen werden soll.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file to be loaded as a string.[/en]
	[de]Die Datei die geladen werden soll als String.[/de]
	*/
	public function addFile($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->asFiles[] = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns all the files (names) to be loaded as a string array.[/en]
	[de]Gibt alle Dateien (Namen), die geladen werden sollen, als String-Array zur�ck.[/de]
	
	@return asFiles [type]string[][/type]
	[en]Returns the files as a string array.[/en]
	[de]Gibt die Dateien als String-Array zur�ck.[/de]
	*/
	public function getFiles() {return $this->asFiles;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets code to be executed in the header tag.[/en]
	[de]Setzt Code der im Header-Tag ausgef�hrt werden soll.[/de]
	
	@param sCode [needed][type]string[/type]
	[en]The code to be executed as a string.[/en]
	[de]Der auszuf�hrende Code als String.[/de]
	*/
	public function setCode($_sCode)
	{
		$_sCode = $this->getRealParameter(array('oParameters' => $_sCode, 'sName' => 'sCode', 'xParameter' => $_sCode));
		$this->sCode = $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds code to who does not come from a file.[/en]
	[de]F�gt Code hinzu, der nicht aus einer Datei kommt.[/de]
	
	@param sCode [needed][type]string[/type]
	[en]The code to be executed as a string.[/en]
	[de]Der auszuf�hrende Code als String.[/de]
	*/
	public function addCode($_sCode)
	{
		$_sCode = $this->getRealParameter(array('oParameters' => $_sCode, 'sName' => 'sCode', 'xParameter' => $_sCode));
		if ($this->sCode != '')
		{
			if ($this->isLineBreak() == true) {$this->sCode .= $this->getLineBreak().$this->getLineBreak();}
			else {$this->sCode .= ' ';}
		}
		$this->sCode .= $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	
	@descriptuion
	[en]Returns the code that does not come from a file.[/en]
	[de]Gibt den Code zur�ck, der nicht aus einer Datei kommt.[/de]
	
	@return sCode [type]string[/type]
	[en]Returns the code as a string.[/en]
	[de]Gibt den Code als String zur�ck.[/de]
	*/
	public function getCode() {return $this->sCode;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets whether the code should be include from external files or read and will be returned as a String by build().[/en]
	[de]Setzt ob der Code �ber externe Dateien eingebunden werden soll oder ausgelesen und als String von build() zur�ck gegeben wird.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether external files or embedded code should be used.[/en]
	[de]Gibt an ob externe Dateien oder eingebetteter Code verwendet werden soll.[/de]
	*/
	public function useIncludes($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseIncludes = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether external files or embedded code to be used.[/en]
	[de]Gibt zur�ck ob externe Dateien oder eingebetteter Code verwendet werden soll.[/de]
	
	@return bUseIncludes [type]bool[/type]
	[en]Returns a boolean whether external files (true) or embedded code (false) should be used.[/en]
	[de]Gibt als Boolean zur�ck ob externe Dateien (true) oder eingebetteter Code (false) verwendet werden soll.[/de]
	*/
	public function isIncludes() {return $this->bUseIncludes;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Places a header to let the browser detect the file as a JavaScript file.[/en]
	[de]Platziert einen Header, damit die Datei vom Browser als JavaScript Datei erkannt wird.[/de]
	*/
	public function putHeader() {header('Content-Type: text/javascript');}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the JavaScript code to load the files and returns it.[/en]
	[de]Erstellt den JavaScript-Code zum Laden der Dateien und gibt ihn zur�ck.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns JavaScript code or HTML script tags as a string. Depending on how useIncludes() has been set.[/en]
	[de]Gibt JavaScript-Code oder HTML-Script-Tags als String zur�ck. Je nachdem wie useIncludes() gesetzt wurde.[/de]
	*/
	public function build()
	{
		$_sLineBreak = $this->getLineBreak();
		
		$_sHtml = '';
		
		$_asLoadedFiles = array();
		if (($this->bUseIncludes == true) && ($this->isLineBreak() == true)) {$_sHtml .= $_sLineBreak.$_sLineBreak;}
		for ($i=0; $i<count($this->asFiles); $i++)
		{
			$_bIsLoaded = false;
			for ($t=0; $t<count($_asLoadedFiles); $t++) {if ($_asLoadedFiles[$t] == $this->asFiles[$i]) {$_bIsLoaded = true;}}
			if ($_bIsLoaded == false)
			{
				if ($this->bUseIncludes == true)
				{
					$_sHtml .= '<script type="text/javascript" src="'.$this->sFilesPath.$this->asFiles[$i].'"></script>'.$_sLineBreak; // charset="utf-8" charset="ISO-8859-1"
				}
				else
				{
					ob_start();
					include($this->sFilesPath.$this->asFiles[$i]);
					$_sHtml .= ob_get_contents();
					if ($this->isLineBreak() == true) {$_sHtml .= $_sLineBreak.$_sLineBreak;} else {$_sHtml .= ' ';}
					ob_end_clean();
				}
			}
		}
		if (($this->bUseIncludes == true) && ($this->isLineBreak() == true)) {$_sHtml .= $_sLineBreak;}
		
		if ($this->sCode != '')
		{
			if ($this->bUseIncludes == false) {$_sHtml .= $this->sCode.$_sLineBreak;}
			else
			{
				$_sHtml .= '<script type="text/javascript">'.$_sLineBreak; // charset="ISO-8859-1"
				$_sHtml .= $this->sCode.$_sLineBreak;
				$_sHtml .= '</script>'.$_sLineBreak.$_sLineBreak;
			}
		}

		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGJsLoader = new classPG_JsLoader();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGJsLoader', 'xValue' => $oPGJsLoader));}
?>