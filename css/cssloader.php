<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Oct 02 2012
*/
/*
@start class

@description
[en]This class has methods for loading of CSS files.[/en]
[de]Diese Klasse verfügt über Methoden zum laden von CSS Dateien.[/de]

@param extends classPG_ClassBasics
*/
class classPG_CssLoader extends classPG_ClassBasics
{
	// Declarations...
	private $sFilesBasePath = '';
	private $sFilesPath = '';
	private $asFiles = array();
	private $asCodes = array();
	private $bUseIncludes = true;
	private $sCode = '';
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCssLoader'));
	}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]
		Sets the fallback base path for all CSS files to be loaded.
		This path is used when the files are not found in normal base path.
	[/en]
	[de]
		Setzt den Rückfall System Basis-Pfad für alle CSS Dateien die geladen werden sollen.
		Dieser Pfad wird verwendet, wenn die Dateien im normalen Basis-Pfad nicht gefunden wurden.
	[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path as the basis of all files when entering the fallback system.[/en]
	[de]Der Pfad als Basis aller Dateien beim eintreten des Rückfall Systems.[/de]
	*/
	public function setFilesBasePath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sFilesBasePath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the fallback base path for all CSS files.[/en]
	[de]Gibt den Rüfall System Basis-Pfad für alle CSS Dateien zurück.[/de]
	
	@return sFilesPath [type]string[/type]
	[en]Returns the path as a string.[/en]
	[de]Gibt den Pfad als String zurück.[/de]
	*/
	public function getFilesBasePath() {return $this->sFilesBasePath;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the base path for all CSS files to be loaded.[/en]
	[de]Setzt den Basis-Pfad für alle CSS Dateien die geladen werden sollen.[/de]
	
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
	[en]Returns base path for all CSS files.[/en]
	[de]Gibt den Basis-Pfad für alle CSS Dateien zurück.[/de]
	
	@return sFilesPath [type]string[/type]
	[en]Returns the path as a string.[/en]
	[de]Gibt den Pfad als String zurück.[/de]
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
	public function setFiles($_asFiles) // , $_asFeaturesRequest = NULL)
	{
		// $_asFeaturesRequest = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFeaturesRequest', 'xParameter' => $_asFeaturesRequest));
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asFiles = $_asFiles;
		/*if ($_asFeaturesRequest != NULL)
		{
			$this->asFeaturesRequest = $_asFeaturesRequest;
		}*/
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds files to the loader to load.[/en]
	[de]Fügt Dateien zum Loader hinzu, die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The files to be loaded as a string array.[/en]
	[de]Die Dateien die geladen werden sollen als String-Array.[/de]
	*/
	public function addFiles($_asFiles) // , $_asFeaturesRequest = NULL)
	{
		// $_asFeaturesRequest = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFeaturesRequest', 'xParameter' => $_asFeaturesRequest));
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asFiles = array_merge($this->asFiles, $_asFiles);
		/*if ($_asFeaturesRequest != NULL)
		{
			$this->asFeaturesRequest = array_merge($this->asFeaturesRequest, $_asFeaturesRequest);
		}*/
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a file to the loader to load.[/en]
	[de]Fügt eine Datei zum Loader hinzu, die geladen werden soll.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file to be loaded as a string.[/en]
	[de]Die Datei die geladen werden soll als String.[/de]
	*/
	public function addFile($_sFile) // , $_sFeaturesRequest = NULL)
	{
		// $_sFeaturesRequest = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFeaturesRequest', 'xParameter' => $_sFeaturesRequest));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asFiles[] = $_sFile;
		// $this->asFeaturesRequest[$_sFile] = $_sFeaturesRequest;
	}
	/* @end method */
	
	/*
	@start method
	
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
	
	@description
	[en]Sets code to be executed in the header tag.[/en]
	[de]Setzt Code der im Header-Tag ausgeführt werden soll.[/de]
	
	@param sCode [needed][type]string[/type]
	[en]The code to be executed as a string.[/en]
	[de]Der auszuführende Code als String.[/de]
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
	[de]Fügt Code hinzu, der nicht aus einer Datei kommt.[/de]
	
	@param sCode [needed][type]string[/type]
	[en]The code to be executed as a string.[/en]
	[de]Der auszuführende Code als String.[/de]
	*/
	public function addCode($_sCode)
	{
		$_sCode = $this->getRealParameter(array('oParameters' => $_sCode, 'sName' => 'sCode', 'xParameter' => $_sCode));
		if ($this->sCode != '')
		{
			if ($this->isLineBreak() == true) {$this->sCode .= $this->getLineBreak();}
			else {$this->sCode .= ' ';}
		}
		$this->sCode .= $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	
	@descriptuion
	[en]Returns the code that does not come from a file.[/en]
	[de]Gibt den Code zurück, der nicht aus einer Datei kommt.[/de]
	
	@return sCode [type]string[/type]
	[en]Returns the code as a string.[/en]
	[de]Gibt den Code als String zurück.[/de]
	*/
	public function getCode() {return $this->sCode;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets whether the code should be include from external files or read and will be returned as a String by build().[/en]
	[de]Setzt ob der Code über externe Dateien eingebunden werden soll oder ausgelesen und als String von build() zurück gegeben wird.[/de]
	
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
	[de]Gibt zurück ob externe Dateien oder eingebetteter Code verwendet werden soll.[/de]
	
	@return bUseIncludes [type]bool[/type]
	[en]Returns a boolean whether external files (true) or embedded code (false) should be used.[/en]
	[de]Gibt als Boolean zurück ob externe Dateien (true) oder eingebetteter Code (false) verwendet werden soll.[/de]
	*/
	public function isIncludes() {return $this->bUseIncludes;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Places a header to let the browser detect the file as a CSS file.[/en]
	[de]Platziert einen Header, damit die Datei vom Browser als CSS Datei erkannt wird.[/de]
	*/
	public function putHeader() {header('Content-Type: text/css');}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the CSS code to load the files and returns it.[/en]
	[de]Erstellt den CSS-Code zum Laden der Dateien und gibt ihn zurück.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns CSS code or HTML script tags as a string. Depending on how useIncludes() has been set.[/en]
	[de]Gibt CSS-Code oder HTML-Script-Tags als String zurück. Je nachdem wie useIncludes() gesetzt wurde.[/de]
	*/
	public function build()
	{
		global $oPGApi;
	
		$_sLineBreak = '';
		if ($this->isLineBreak() == true) {$_sLineBreak = $this->getLineBreak();}
		
		$_sHtml = '';
		
		$_asLoadedFiles = array();
		if (($this->bUseIncludes == true) && ($this->isLineBreak() == true)) {$_sHtml .= $_sLineBreak.$_sLineBreak;}
		for ($i=0; $i<count($this->asFiles); $i++)
		{
			$_bIsLoaded = false;
			$_sFile = '';
			$_sMedia = 'all';
			if (is_array($this->asFiles[$i]))
			{
				if (isset($this->asFiles[$i]['sFile'])) {$_sFile = $this->asFiles[$i]['sFile'];}
				else {$_sFile = $this->asFiles[$i][0];}
				if (isset($this->asFiles[$i]['sMedia'])) {$_sMedia = $this->asFiles[$i]['sMedia'];}
				else {$_sMedia = $this->asFiles[$i][1];}
			}
			else {$_sFile = $this->asFiles[$i];}
			
			for ($t=0; $t<count($_asLoadedFiles); $t++) {if ($_asLoadedFiles[$t] == $_sFile) {$_bIsLoaded = true;}}
			if ($_bIsLoaded == false)
			{
				$_sCompletePath = $this->sFilesPath.$_sFile;
				if (!file_exists($_sCompletePath)) {$_sCompletePath = $this->sFilesBasePath.$_sFile;}

				if ($this->bUseIncludes == true)
				{
					$_sHtml .= '<link id="'.$this->getID().'Link'.$i.'" rel="stylesheet" media="'.$_sMedia.'" type="text/css" href="'.$_sCompletePath.'" />'.$_sLineBreak;
					/*if (isset($this->asFeaturesRequest[$this->asFiles[$i]]))
					{
						$_asFeatures = explode(',', $this->asFeaturesRequest[$_sFile]);
						$_sHtml .= '<script id="'.$this->getID().'Script'.$i.'" type="text/javascript">';
						$_sHtml .= 'var sFeatures = "?sFeatures="; ';
						$_sHtml .= 'document.getElementById("'.$this->getID().'Link'.$i.'").href="'.$this->sFilesPath.$_sFile.'"+';
						$_sHtml .= 'oPGCssLoader.checkFeatures([';
							for ($f=0; $f<$_asFeatures; $f++)
							{
								if ($f>0) {$_sHtml .= ',';}
								$_sHtml .= '"'.$_asFeatures[$f].'"';
							}
						$_sHtml .= ']);';
						$_sHtml .= '</script>';
					}*/
				}
				else
				{
					ob_start();
					include($_sCompletePath);
					$_sHtml .= ob_get_contents();
					if ($this->isLineBreak() == true) {$_sHtml .= $_sLineBreak.$_sLineBreak;} else {$_sHtml .= ' ';}
					ob_end_clean();
				}
			}
		}
		if (($this->bUseIncludes == true) && ($this->isLineBreak() == true)) {$_sHtml .= $_sLineBreak;}
		
		if ($this->sCode != '')
		{
			if ($this->bUseIncludes == false) {$_sHtml .= eval($this->sCode);}
			else
			{
				$_sHtml .= '<style type="text/css" media="all">'.$_sLineBreak;
				$_sHtml .= $this->sCode.$_sLineBreak;
				$_sHtml .= '</style>'.$_sLineBreak.$_sLineBreak;
			}
		}

		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGCssLoader = new classPG_CssLoader();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCssLoader', 'xValue' => $oPGCssLoader));}
?>