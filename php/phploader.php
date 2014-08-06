<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Aug 13 2012
*/
/*
@start class

@description
[en]This class has methods for loading of PHP files.[/en]
[de]Diese Klasse verfügt über Methoden zum laden von PHP Dateien.[/de]

@param extends classPG_ClassBasics
*/
class classPG_PhpLoader extends classPG_ClassBasics
{
	// Declarations...
	private $sFilesPath = '';
	private $asFiles = array();
	private $bRequire = false;

	// Construct...
	public function __construct()
	{
		$this->setLineBreak(array('sString' => "\n"));
		$this->useLineBreak(array('bUse' => true));
	}
	
	// Methods...
	/*
	@start method
	
	@group Set
	
	@description
	[en]Sets the base path for all PHP files to be loaded.[/en]
	[de]Setzt den Basis-Pfad für alle PHP Dateien die geladen werden sollen.[/de]
	
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
	
	@group Get
	
	@description
	[en]Returns base path for all PHP files.[/en]
	[de]Gibt den Basis-Pfad für alle PHP Dateien zurück.[/de]
	
	@return sFilesPath [type]string[/type]
	[en]Returns the path as a string.[/en]
	[de]Gibt den Pfad als String zurück.[/de]
	*/
	public function getFilesPath() {return $this->sFilesPath;}
	/* @end method */
	
	/*
	@start method
	
	@group Set
	
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
	
	@group Add
	
	@description
	[en]Adds files to the loader to load.[/en]
	[de]Fügt Dateien zum Loader hinzu, die geladen werden sollen.[/de]
	
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
	
	@group Add
	
	@description
	[en]Adds a file to the loader to load.[/en]
	[de]Fügt eine Datei zum Loader hinzu, die geladen werden soll.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file to be loaded as a string.[/en]
	[de]Die Datei die geladen werden soll als String.[/de]
	*/
	public function addFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asFiles[] = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns all the files (names) to be loaded as a string array.[/en]
	[de]Gibt alle Dateien (Namen), die geladen werden sollen, als String-Array zurück.[/de]
	
	@return asFiles [type]string[][/type]
	[en]Returns the files as a string array.[/en]
	[de]Gibt die Dateien als String-Array zurück.[/de]
	*/
	public function getFiles() {return $this->asFiles;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets whether to use "requires" or "includes".[/en]
	[de]Setzt ob "requires" oder "includes" verwendet werden sollen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether "require" to load PHP files to be used.[/en]
	[de]Gibt an ob "require" zum Laden von PHP Dateien verwendet werden soll.[/de]
	*/
	public function useRequire($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bRequire = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns a boolean if "require" is to be used.[/en]
	[de]Gibt als Boolean zurück ob "requires" verwendet werden.[/de]
	
	@return bIsRequire [type]bool[/type]
	[en]Returns a boolean if "require" (true) or "include" (false) is to be used.[/en]
	[de]Gibt als Boolean zurück ob "require" (true) oder "include" (false) verwendet wird.[/de]
	*/
	public function isRequire() {return $this->bRequire;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the PHP code to load the files and returns it.[/en]
	[de]Erstellt den PHP-Code zum Laden der Dateien und gibt ihn zurück.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns PHP code as a string. The code can then e.g. be executed by eval() or stored in a PHP file.[/en]
	[de]Gibt PHP-Code als String zurück. Der Code kann dann z.B. per eval() ausgeführt oder in eine PHP-Datei gespeichert werden.[/de]
	*/
	public function build()
	{
		$_sHtml = '';
		for ($i=0; $i<count($this->asFiles); $i++)
		{
			if ($this->bRequire == true) {$_sHtml .= 'require';} else {$_sHtml .= 'include';}
			$_sHtml .= '_once("'.$this->sFilesPath.$this->asFiles[$i].'"); ';
		}
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGPhpLoader = new classPG_PhpLoader();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGPhpLoader', 'xValue' => $oPGPhpLoader));}
?>