<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 06 2012
*/
define('PG_WEBSITE_DOCTYPE_HTML5', '<!DOCTYPE html>');
define('PG_WEBSITE_DOCTYPE_HTML4_STRICT', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">');
define('PG_WEBSITE_DOCTYPE_HTML4_LOOSE', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">');
define('PG_WEBSITE_DOCTYPE_HTML4_FRAMESET', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">');
define('PG_WEBSITE_DOCTYPE_XHTML_STRICT', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
define('PG_WEBSITE_DOCTYPE_XHTML_TRANSITIONAL', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
define('PG_WEBSITE_DOCTYPE_XHTML_FRAMESET', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">');

define('PG_WEBSITE_XMLNS_OPENGRAPH', 'xmlns:og="http://ogp.me/ns#"');
define('PG_WEBSITE_XMLNS_FBML', 'xmlns:fb="http://www.facebook.com/2008/fbml"');

/*
@start class

@description
[en]This class has methods for build complete websites.[/en]
[de]Diese Klasse verfügt über Methoden zum Erstellen von kompletten Webseiten.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Website extends classPG_ClassBasics
{
	// Declarations...
	private $sDoctype = PG_WEBSITE_DOCTYPE_HTML5;
	
	private $sTitle = '';
	
	private $asCssFiles = array();
	// private $asCssFeaturesRequest = array();
	private $asJavaScriptFiles = array();
	private $asApiJavaScriptFiles = array();
	
	private $sJavaScriptPath = 'scripts/';
	private $sApiJavaScriptPath = NULL;
	private $sJavaScriptCode = '';
	
	private $oJsLoader = null;
	private $oCssLoader = null;
	private $oMeta = null;
	private $oOpenGraph = null;
	private $oFacebookMeta = null;
	
	private $bOpenGraph = true;
	private $bFacebookML = false;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGWebsite'));
		$this->initClassBasics();
		$this->initTemplate();
	}
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Set the DOCTYPE for the website.[/en]
	[de]Setzt den DOCTYPE für die Webseite.[/de]
	
	@param sDoctype [needed][type]string[/type]
	[en]
		The DOCTYPE as string, or a define (default = HTML5):
		PG_WEBSITE_DOCTYPE_HTML5
		PG_WEBSITE_DOCTYPE_HTML4_STRICT
		PG_WEBSITE_DOCTYPE_HTML4_LOOSE
		PG_WEBSITE_DOCTYPE_HTML4_FRAMESET
		PG_WEBSITE_DOCTYPE_XHTML_STRICT
		PG_WEBSITE_DOCTYPE_XHTML_TRANSITIONAL
		PG_WEBSITE_DOCTYPE_XHTML_FRAMESET
	[/en]
	[de]
		Der DOCTYPE als String, oder einem Define (Default = HTML5):
		PG_WEBSITE_DOCTYPE_HTML5
		PG_WEBSITE_DOCTYPE_HTML4_STRICT
		PG_WEBSITE_DOCTYPE_HTML4_LOOSE
		PG_WEBSITE_DOCTYPE_HTML4_FRAMESET
		PG_WEBSITE_DOCTYPE_XHTML_STRICT
		PG_WEBSITE_DOCTYPE_XHTML_TRANSITIONAL
		PG_WEBSITE_DOCTYPE_XHTML_FRAMESET
	[/de]
	*/
	public function setDoctype($_sDoctype)
	{
		$_sDoctype = $this->getRealParameter(array('oParameters' => $_sDoctype, 'sName' => 'sDoctype', 'xParameter' => $_sDoctype));
		$this->sDoctype = $_sDoctype;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the DOCTYPE.[/en]
	[de]Gibt den DOCTYPE zurück.[/de]
	
	@return sDoctype [type]string[/type]
	[en]Returns the DOCTYPE as a string.[/en]
	[de]Gibt den DOCTYPE als String zurück.[/de]
	*/
	public function getDoctype() {return $this->sDoctype;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the title of the website.[/en]
	[de]Setzt den Titel der Webseite.[/de]
	
	@param sTitle [needed][type]string[/type]
	[en]The title of the website as a string.[/en]
	[de]Der Titel der Webseite als String.[/de]
	*/
	public function setTitle($_sTitle)
	{
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sTitle, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$this->sTitle = $_sTitle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the title of the website.[/en]
	[de]Gibt den Titel der Webseite zurück.[/de]
	
	@return sTitle [type]string[/type]
	[en]Returns the title of the website as a string.[/en]
	[de]Gibt den Titel der Webseite als String zurück.[/de]
	*/
	public function getTitle() {return $this->sTitle;}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets the JavaScript code that is executed or used in the header of the website.[/en]
	[de]Setzt JavaScript-Code der im Kopf der Webseite ausgeführt bzw. gesetzt werden soll.[/de]
	
	@param sCode [needed][type]string[/type]
	[en]The JavaScript code as a string.[/en]
	[de]Der JavaScript-Code als String.[/de]
	*/
	public function setJavaScriptCode($_sCode)
	{
		$_sCode = $this->getRealParameter(array('oParameters' => $_sCode, 'sName' => 'sCode', 'xParameter' => $_sCode));
		$this->sJavaScriptCode = $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the JavaScript code.[/en]
	[de]Gibt den JavaScript-Code zurück.[/de]
	
	@return sJavaScriptCode [type]string[/type]
	[en]Returns the JavaScript code as a string.[/en]
	[de]Gibt den JavaScript-Code als String zurück.[/de]
	*/
	public function getJavaScriptCode() {return $this->sJavaScriptCode;}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets the base path to JavaScript files.[/en]
	[de]Setzt den Basis-Pfad zu JavaScript Dateien.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path as a string.[/en]
	[de]Der Pfad als String.[/de]
	*/
	public function setJavaScriptPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sJavaScriptPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the base path to JavaScript files.[/en]
	[de]Gibt den Basis-Pfad zu JavaScript Dateien zurück.[/de]
	
	@return sJavaScriptPath [type]string[/type]
	[en]Returns the base path to JavaScript files as a string.[/en]
	[de]Gibt den Basis-Pfad zu JavaScript Dateien als String zurück.[/de]
	*/
	public function getJavaScriptPath() {return $this->sJavaScriptPath;}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets the base path to JavaScript files of the API.[/en]
	[de]Setzt den Basis-Pfad zu JavaScript Dateien der API.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path as a string.[/en]
	[de]Der Pfad als String.[/de]
	*/
	public function setApiJavaScriptPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sApiJavaScriptPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the base path to JavaScript files of the API.[/en]
	[de]Gibt den Basis-Pfad zu JavaScript Dateien der API zurück.[/de]
	
	@return sApiJavaScriptPath [type]string[/type]
	[en]Returns the base path to JavaScript files of the API as a string.[/en]
	[de]Gibt den Basis-Pfad zu JavaScript Dateien der API als String zurück.[/de]
	*/
	public function getApiJavaScriptPath() {return $this->sApiJavaScriptPath;}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@description
	[en]Sets CSS files that should be loaded.[/en]
	[de]Setzt CSS Dateien, die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The file names as a string array.[/en]
	[de]Die Dateinamen als String-Array.[/de]
	*/
	public function setCssFiles($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asCssFiles = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@description
	[en]Adds a CSS file that should be loaded.[/en]
	[de]Fügt eine CSS Datei, die geladen werden soll, hinzu.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file name as a string.[/en]
	[de]Der Dateinamen als String.[/de]
	*/
	public function addCssFile($_sFile) // , $_sFeaturesRequest = NULL)
	{
		// $_sFeaturesRequest = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFeaturesRequest', 'xParameter' => $_sFeaturesRequest));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asCssFiles[] = $_sFile;
		// $this->asCssFeaturesRequest[$_sFile] = $_sFeaturesRequest;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@description
	[en]Returns the CSS files to be loaded.[/en]
	[de]Gibt die CSS Dateien die zu laden sind zurück.[/de]
	
	@return asCssFiles [type]string[][/type]
	[en]Returns the CSS files to be loaded as a string array.[/en]
	[de]Gibt die CSS Dateien die zu laden sind als String-Array zurück.[/de]
	*/
	public function getCssFiles() {return $this->asCssFiles;}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets JavaScript files that should be loaded.[/en]
	[de]Setzt JavaScript Dateien, die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The file names as a string array.[/en]
	[de]Die Dateinamen als String-Array.[/de]
	*/
	public function setJavaScriptFiles($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asJavaScriptFiles = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Adds a JavaScript file that should be loaded.[/en]
	[de]Fügt eine JavaScript Datei, die geladen werden soll, hinzu.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file name as a string.[/en]
	[de]Der Dateinamen als String.[/de]
	*/
	public function addJavaScriptFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asJavaScriptFiles[] = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the JavaScript files to be loaded.[/en]
	[de]Gibt die JavaScript Dateien die zu laden sind zurück.[/de]
	
	@return asJavaScriptFiles [type]string[][/type]
	[en]Returns the JavaScript files to be loaded as a string array.[/en]
	[de]Gibt die JavaScript Dateien die zu laden sind als String-Array zurück.[/de]
	*/
	public function getJavaScriptFiles() {return $this->asJavaScriptFiles;}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets JavaScript API files that should be loaded.[/en]
	[de]Setzt JavaScript API Dateien, die geladen werden sollen.[/de]
	
	@param asFiles [needed][type]string[][/type]
	[en]The file names as a string array.[/en]
	[de]Die Dateinamen als String-Array.[/de]
	*/
	public function setApiJavaScriptFiles($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asApiJavaScriptFiles = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Adds a JavaScript API file that should be loaded.[/en]
	[de]Fügt eine JavaScript API Datei, die geladen werden soll, hinzu.[/de]
	
	@param sFile [needed][type]string[/string]
	[en]The file name as a string.[/en]
	[de]Der Dateinamen als String.[/de]
	*/
	public function addApiJavaScriptFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asApiJavaScriptFiles[] = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the JavaScript API files to be loaded.[/en]
	[de]Gibt die JavaScript API Dateien die zu laden sind zurück.[/de]
	
	@return asApiJavaScriptFiles [type]string[][/type]
	[en]Returns the JavaScript API files to be loaded as a string array.[/en]
	[de]Gibt die JavaScript API Dateien die zu laden sind als String-Array zurück.[/de]
	*/
	public function getApiJavaScriptFiles() {return $this->asApiJavaScriptFiles;}
	/* @end method */

	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Sets the JavaScript loader object.[/en]
	[de]Setzt das JavaScript-Loader-Objekt.[/de]
	
	@param oJsLoader [needed][type]object[/type]
	[en]The JavaScript loader object.[/en]
	[de]Das JavaScript-Loader-Objekt.[/de]
	*/
	public function setJsLoader($_oJsLoader)
	{
		$_oJsLoader = $this->getRealParameter(array('oParameters' => $_oJsLoader, 'sName' => 'oJsLoader', 'xParameter' => $_oJsLoader));
		$this->oJsLoader = $_oJsLoader;
	}
	/* @end method */
	
	/*
	@start method
	
	@group JavaScript
	
	@description
	[en]Returns the JavaScript loader object.[/en]
	[de]Gibt das JavaScript-Loader-Objekt zurück.[/de]
	
	@return oJsLoader [type]object[/type]
	[en]Returns the JavaScript loader object.[/en]
	[de]Gibt das JavaScript-Loader-Objekt zurück.[/de]
	*/
	public function getJsLoader() {return $this->oJsLoader;}
	/* @end method */

	/*
	@start method
	
	@group CSS
	
	@description
	[en]Sets the CSS loader object.[/en]
	[de]Setzt das CSS-Loader-Objekt.[/de]
	
	@param oCssLoader [needed][type]object[/type]
	[en]The CSS loader object.[/en]
	[de]Das CSS-Loader-Objekt.[/de]
	*/
	public function setCssLoader($_oCssLoader)
	{
		$_oCssLoader = $this->getRealParameter(array('oParameters' => $_oCssLoader, 'sName' => 'oCssLoader', 'xParameter' => $_oCssLoader));
		$this->oCssLoader = $_oCssLoader;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@description
	[en]Returns the CSS loader object.[/en]
	[de]Gibt das CSS-Loader-Objekt zurück.[/de]
	
	@return oCssLoader [type]object[/type]
	[en]Returns the CSS loader object.[/en]
	[de]Gibt das CSS-Loader-Objekt zurück.[/de]
	*/
	public function getCssLoader() {return $this->oCssLoader;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the Meta object for the Website.[/en]
	[de]Setzt das Meta Objekt für die Webseite.[/de]
	
	@param oMeta [needed][type]object[/type]
	[en]Specifies the Meta object.[/en]
	[de]Gibt das Meta Objekt an.[/de]
	*/
	public function setMeta($_oMeta)
	{
		$_oMeta = $this->getRealParameter(array('oParameters' => $_oMeta, 'sName' => 'oMeta', 'xParameter' => $_oMeta));
		$this->oMeta = $_oMeta;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the Meta object, where one has been specified.[/en]
	[de]Gibt das Meta Objekt zurück, soweit eins angegeben wurde.[/de]
	
	@return oMeta [type]object[/type]
	[en]Returns the Meta object, where one has been specified.[/en]
	[de]Gibt das Meta Objekt zurück, soweit eins angegeben wurde.[/de]
	*/
	public function getMeta() {return $this->oMeta;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the Open-Graph object for the Website.[/en]
	[de]Setzt das Open-Graph Objekt für die Webseite.[/de]
	
	@param oOpenGraph [needed][type]object[/type]
	[en]Specifies the Open-Graph object.[/en]
	[de]Gibt das Open-Graph Objekt an.[/de]
	*/
	public function setOpenGraph($_oOpenGraph)
	{
		$_oOpenGraph = $this->getRealParameter(array('oParameters' => $_oOpenGraph, 'sName' => 'oOpenGraph', 'xParameter' => $_oOpenGraph));
		$this->oOpenGraph = $_oOpenGraph;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the Open-Graph object, where one has been specified.[/en]
	[de]Gibt das Open-Graph Objekt zurück, soweit eins angegeben wurde.[/de]
	
	@return oOpenGraph [type]object[/type]
	[en]Returns the Open-Graph object, where one has been specified.[/en]
	[de]Gibt das Open-Graph Objekt zurück, soweit eins angegeben wurde.[/de]
	*/
	public function getOpenGraph() {return $this->oOpenGraph;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the Facebook meta object for the Website.[/en]
	[de]Setzt das Facebook-Meta Objekt für die Webseite.[/de]
	
	@param oFacebookMeta [needed][type]object[/type]
	[en]Specifies the Facebook meta object.[/en]
	[de]Gibt das Facebook-Meta Objekt an.[/de]
	*/
	public function setFacebookMeta($_oFacebookMeta)
	{
		$_oFacebookMeta = $this->getRealParameter(array('oParameters' => $_oFacebookMeta, 'sName' => 'oFacebookMeta', 'xParameter' => $_oFacebookMeta));
		$this->oFacebookMeta = $_oFacebookMeta;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the Facebook meta object, where one has been specified.[/en]
	[de]Gibt das Facebook-Meta Objekt zurück, soweit eins angegeben wurde.[/de]
	
	@return oFacebookMeta [type]object[/type]
	[en]Returns the Facebook meta object, where one has been specified.[/en]
	[de]Gibt das Facebook-Meta Objekt zurück, soweit eins angegeben wurde.[/de]
	*/
	public function getFacebookMeta() {return $this->oFacebookMeta;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the status of whether Open-Graph should be used.[/en]
	[de]Setzt den Status ob Open-Graph verwendet werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether Open-Graph is used.[/en]
	[de]Gibt an ob Open-Graph verwendet wird.[/de]
	*/
	public function useOpenGraph($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bOpenGraph = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns whether Open-Graph is used.[/en]
	[de]Gibt zurück ob Open-Graph verwendet wird.[/de]
	
	@return bOpenGraph [type]bool[/type]
	[en]Returns whether Open-Graph is used.[/en]
	[de]Gibt zurück ob Open-Graph verwendet wird.[/de]
	*/
	public function isOpenGraph() {return $this->bOpenGraph;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the status of whether FBML (Facebook) should be used.[/en]
	[de]Setzt den Status ob FBML (Facebook) verwendet werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether FBML is used.[/en]
	[de]Gibt an ob FBML verwendet wird.[/de]
	*/
	public function useFacebookML($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bFacebookML = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns whether FBML (Facebook) is used.[/en]
	[de]Gibt zurück ob FBML (Facebook) verwendet wird.[/de]
	
	@return bFacebookML [type]bool[/type]
	[en]Returns whether FBML (Facebook) is used.[/en]
	[de]Gibt zurück ob FBML (Facebook) verwendet wird.[/de]
	*/
	public function isFacebookML() {return $this->bFacebookML;}
	/* @end method */

	/*
	@start method
	
	@Group Website
	
	@description
	[en]Builds the entire website and returns it as a string.[/en]
	[de]Erstellt die komplette Webseite und gibt sie als String zurück.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns the website as a string.[/en]
	[de]Gibt die Webseite als String zurück.[/de]
	
	@param xTemplate [type]mixed[/type]
	[en]The template that will be used. You can specify a path to a file or the source code of the template.[/en]
	[de]Das Template, dass verwendet werden soll. Angegeben werden kann ein Pfad zu einer Datei oder der Quelltext des Templates.[/de]
	
	@param bTemplateIsCompleteSite [type]bool[/type]
	[en]Specifies whether the template contains a complete HTML file, or just the contents of the body tag.[/en]
	[de]Gibt an ob das Template eine komplette HTML Datei oder nur den Inhalt vom Body-Tag beinhaltet.[/de]
	
	@param bReplaceUrlProtocols [type]bool[/type]
	[en]Specifies whether the url protocol of absolute links is to be replaced automatically. E.g. from http://www.progade.de to https://www.progade.de.[/en]
	[de]Gibt an, ob das Url-Protokoll von absoluten Verlinkungen automatisch ersetzt werden soll. Wie z.B. von http://www.progade.de zu https://www.progade.de.[/de]
	
	@param bReplaceBBCode [type]bool[/type]
	[en]Specifies whether BB-Code will be converted automatically.[/en]
	[de]Gibt an, ob BB-Code automatisch umgesetzt werden soll.[/de]
	
	@param bReplaceDates [type]bool[/type]
	[en]Specifies whether date variables to be implemented automatically.[/en]
	[de]Gibt an, ob Datumsvariablen automatisch umgesetzt werden sollen.[/de]
	
	@param bEncodeMails [type]bool[/type]
	[en]Specifies whether e-mail addresses will be automatically reformatted. E.g. from info@progade.de to info[at]progade[dot]de.[/en]
	[de]Gibt an, ob E-Mail-Adressen automatisch umformatiert werden sollen. Wie z.B. von info@progade.de zu info[at]progade[dot]de.[/de]
	*/
	public function build(
		$_xTemplate = NULL, 
		$_bTemplateIsCompleteSite = NULL, 
		$_bReplaceUrlProtocols = NULL, 
		$_bReplaceBBCode = NULL, 
		$_bReplaceDates = NULL, 
		$_bEncodeMails = NULL
	)
	{
		global $oPGJsLoader, $oPGEvenetManager, $oPGCssLoader, $oPGMeta, $oPGOpenGraph, $oPGFacebookMeta;
		
		if (($this->oJsLoader == null) && (isset($oPGJsLoader))) {$this->oJsLoader = $oPGJsLoader;}
		if (($this->oCssLoader == null) && (isset($oPGCssLoader))) {$this->oCssLoader = $oPGCssLoader;}
		if (($this->oMeta == null) && (isset($oPGMeta))) {$this->oMeta = $oPGMeta;}
		if (($this->oOpenGraph == null) && (isset($oPGOpenGraph))) {$this->oOpenGraph = $oPGOpenGraph;}
		if (($this->oFacebookMeta == null) && (isset($oPGFacebookMeta))) {$this->oFacebookMeta = $oPGFacebookMeta;}

		$_bTemplateIsCompleteSite = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bTemplateIsCompleteSite', 'xParameter' => $_bTemplateIsCompleteSite));
		$_bReplaceUrlProtocols = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceUrlProtocols', 'xParameter' => $_bReplaceUrlProtocols));
		$_bReplaceBBCode = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceBBCode', 'xParameter' => $_bReplaceBBCode));
		$_bReplaceDates = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceDates', 'xParameter' => $_bReplaceDates));
		$_bEncodeMails = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bEncodeMails', 'xParameter' => $_bEncodeMails));
		$_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		
		if ($_xTemplate === NULL) {$_xTemplate = '';}
		if ($_bTemplateIsCompleteSite === NULL) {$_bTemplateIsCompleteSite = false;}
		
		$_sLineBreak = '';
		if ($this->isLineBreak() == true) {$_sLineBreak = $this->getLineBreak();}
		
		$_sHtml = '';
		
		if ($this->sDoctype != '') {$_sHtml .= $this->sDoctype.$_sLineBreak;}
		if (($_xTemplate != '') && ($_bTemplateIsCompleteSite == true))
		{
			$_sHtml .= $this->buildTemplate(array('xTemplate' => $_xTemplate, 'bReplaceUrlProtocols' => $_bReplaceUrlProtocols, 'bReplaceBBCode' => $_bReplaceBBCode, 'bReplaceDates' => $_bReplaceDates, 'bEncodeMails' => $_bEncodeMails));
		}
		else
		{
			$_sHtml .= '<html';
			if ($this->bOpenGraph == true) {$_sHtml .= ' '.PG_WEBSITE_XMLNS_OPENGRAPH;}
			if ($this->bFacebookML == true) {$_sHtml .= ' '.PG_WEBSITE_XMLNS_FBML;}
			$_sHtml .= '>'.$_sLineBreak;
				$_sHtml .= '<head>'.$_sLineBreak;
				
					// Meta-Tags...
					if ($this->oMeta != null)
					{
						$this->oMeta->useLineBreak(array('bUse' => $this->isLineBreak()));
						$this->oMeta->setLineBreak(array('sString' => $this->getLineBreak()));
						
						$_sHtml .= $this->oMeta->build();
					}
					
					if (($this->oOpenGraph != null) && ($this->bOpenGraph == true))
					{
						$this->oOpenGraph->useLineBreak(array('bUse' => $this->isLineBreak()));
						$this->oOpenGraph->setLineBreak(array('sString' => $this->getLineBreak()));
						
						$this->oOpenGraph->setTitle(array('sTitle' => $this->sTitle));
						
						$_sHtml .= $this->oOpenGraph->build();
					}
					
					if (($this->oFacebookMeta != null) && ($this->bFacebookML == true))
					{
						$this->oFacebookMeta->useLineBreak(array('bUse' => $this->isLineBreak()));
						$this->oFacebookMeta->setLineBreak(array('sString' => $this->getLineBreak()));
						
						$_sHtml .= $this->oFacebookMeta->build();
					}
				
					$_sHtml .= '<title>'.$this->sTitle.'</title>';

					// Css includes...
					if ($this->oCssLoader != null)
					{
						$this->oCssLoader->useLineBreak(array('bUse' => $this->isLineBreak()));
						$this->oCssLoader->setLineBreak(array('sString' => $this->getLineBreak()));
						
						$this->oCssLoader->setFilesBasePath(array('sPath' => $this->getGfxBasePathCss()));
						$this->oCssLoader->setFilesPath(array('sPath' => $this->getGfxPathCss()));
						$this->oCssLoader->setFiles(array('asFiles' => $this->asCssFiles)); // , 'asFeaturesRequest' => $this->asCssFeaturesRequest));
						
						$_sHtml .= $this->oCssLoader->build();
					}
					
					// JavaScript includes...
					if ($this->oJsLoader != null)
					{
						$this->oJsLoader->useLineBreak(array('bUse' => $this->isLineBreak()));
						$this->oJsLoader->setLineBreak(array('sString' => $this->getLineBreak()));
	
						if ($this->sApiJavaScriptPath === NULL) {$this->sApiJavaScriptPath = $this->oJsLoader->getFilesPath();}
						$this->oJsLoader->setFilesPath(array('sPath' => $this->sApiJavaScriptPath));
						$this->oJsLoader->addFiles(array('asFiles' => $this->asApiJavaScriptFiles));
						$_sHtml .= $this->oJsLoader->build();
						
						/*
						if (isset($oPGEventManager))
						{
							if ($this->sJavaScriptCode != '') {$this->sJavaScriptCode += "\n";}
							$this->sJavaScriptCode +=
							'
								oPGEventManager.addEvent({"oObject": window, "sEventType": PG_EVENTTYPE_, "fFunction": });
							';
						}
						*/
						
						if ($this->sJavaScriptCode != '') {$this->oJsLoader->setCode(array('sCode' => $this->sJavaScriptCode));}
						$this->oJsLoader->setFilesPath(array('sPath' => $this->sJavaScriptPath));
						$this->oJsLoader->setFiles(array('asFiles' => $this->asJavaScriptFiles));
						$_sHtml .= $this->oJsLoader->build();
					}
				
				$_sHtml .= '</head>'.$_sLineBreak;
				$_sHtml .= '<body>'.$_sLineBreak;
				
					if ($_xTemplate != '')
					{
						$_sHtml .= $this->buildTemplate(array('xTemplate' => $_xTemplate, 'bReplaceUrlProtocols' => $_bReplaceUrlProtocols, 'bReplaceBBCode' => $_bReplaceBBCode, 'bReplaceDates' => $_bReplaceDates, 'bEncodeMails' => $_bEncodeMails));
					}
					
				$_sHtml .= '</body>'.$_sLineBreak;
			$_sHtml .= '</html>'.$_sLineBreak;
		}
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGWebsite = new classPG_Website();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGWebsite', 'xValue' => $oPGWebsite));}
?>