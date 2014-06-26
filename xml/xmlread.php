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
/*
@start class

@description
[en]This class has methods for reading XML structures.[/en]
[de]Diese Klasse verf�gt �ber Methoden zum Lesen von XML Strukturen.[/de]

@param extends classPG_ClassBasics
*/
class classPG_XmlRead extends classPG_ClassBasics
{
	// Declarations...
	private $oXML;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Opens an XML file for reading.[/en]
	[de]�ffnet ein XML-Datei zum Lesen.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The XML file to be read.[/en]
	[de]Die XML-Datei, die gelesen werden soll.[/de]
	*/
	public function openXmlFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->oXML = simplexml_load_file($_sFile);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Gets the content of a given tag of the XML source code with regard to the path structure.[/en]
	[de]Holt den Inhalt von einem bestimmten Tag, mit Ber�cksichtigung der Pfadstruktur, aus dem XML Quellcode.[/de]
	
	@return xContent [type]mixed[/type]
	[en]Returns the content of the specified tag.[/en]
	[de]Gibt den Inhalt des angegebenen Tags zur�ck.[/de]
	
	@param asTags [needed][type]string[][/type]
	[en]The path structure to the tag. Each tag in the structure is given as an array element.[/en]
	[de]Die Pfadstruktur zum gew�nschten Tag. Jedes Tag in der Struktur wird als Array-Element angegeben.[/de]
	*/
	public function getTagPathContent($_asTags)
	{
		$_asTags = $this->getRealParameter(array('oParameters' => $_asTags, 'sName' => 'asTags', 'xParameter' => $_asTags, 'bNotNull' => true));
		if ($this->oXML)
		{
			$_sTagPath = '';
			for ($i=0; $i<count($_asTags); $i++) {$_sTagPath .= '/'.$_asTags[$i];}
			return $this->oXML->xpath($_sTagPath);
		}
		return NULL;
	}
	/* @end method */
	
	// TODO:
	// - get names of available tags
	// - get more than one of tags with the same name and the same path
	// - get attributes of the tags
}
/* @end class */
$oPGXmlRead = new classPG_XmlRead();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGXmlRead', 'xValue' => $oPGXmlRead));}
?>