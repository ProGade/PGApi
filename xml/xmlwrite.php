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
define('PG_XML_TYPE',	'PG_XML');

/*
@start class

@description
[en]This class has methods to create XML structures.[/en]
[de]Diese Klasse verfügt über Methoden zur Erstellung von XML Strukturen.[/de]

@param extends classPG_ClassBasics

@var axAttributesOfTags
[en]The attributes of the tag. An associative array whose indices are the attribute name and its values are the attributes values.[/en]
[de]Die Attribute des Tags. Erwartet einen assoziativen Array dessen Indices die Attribut-Namen und dessen Werte die Attribute-Werte darstellen.[/de]

@var sTagOfTags
[en]The name of the tag.[/en]
[de]Der Name des Tags.[/de]

@var xValueOfTag
[en]The value of the tag.[/en]
[de]Der Wert des Tags.[/de]
*/
class classPG_XmlWrite extends classPG_ClassBasics
{
	// Declarations...
	private $sXML = '';
	private $sLastTag = '';
	private $asTags = array();

	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group General
	
	@description
	[en]Placed the header so that the browser recognizes the document as an XML document.[/en]
	[de]Platziert den Header, damit der Browser das Dokument als XML-Dokument erkennt.[/de]
	*/
	public function putHeader() {header('Content-Type: text/xml');}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@description
	[en]Opens respectively initializes the XML document[/en]
	[de]Öffnet bzw. initialisiert das XML Dokument[/de]
	
	@param sRequestType [type]string[/type]
	[en]Type of a request such as Ajax requests[/en]
	[de]Typ eines Requests wie z.B. bei Ajax Anfragen[/de]
	
	@param sRequestObjectID [type]string[/type]
	[en]Object ID of a request. Could e.g. be the object that sent the request.[/en]
	[de]Objekt ID eines Requests. Könnte z.B. das Objekt sein, welches die Anfrage gesendet hat.[/de]
	
	@param iUserID [type]int[/type]
	[en]ID of user who sent the request.[/en]
	[de]ID vom Benutzer, der den Request gesendet hat.[/de]
	*/
	public function open($_sRequestType = NULL, $_sRequestObjectID = NULL, $_iUserID = NULL)
	{
		$_sRequestObjectID = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'sRequestObjectID', 'xParameter' => $_sRequestObjectID));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_sRequestType = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'sRequestType', 'xParameter' => $_sRequestType));

		if ($_sRequestType === NULL) {$_sRequestType = PG_XML_TYPE;}
		if ($_sRequestObjectID === NULL) {$_sRequestObjectID = 'null';}
		if ($_iUserID === NULL) {$_iUserID = 0;}
		
		$this->sXML = '';
		$this->sXML .= '<?xml version="1.0"?>';
		$this->sXML .= '<PG_XML>';
		$this->sXML .= '<PG_XMLType>'.htmlspecialchars(utf8_encode(PG_XML_TYPE)).'</PG_XMLType>';
		$this->sXML .= '<PG_XMLRequestType>'.htmlspecialchars(utf8_encode($_sRequestType)).'</PG_XMLRequestType>';
		$this->sXML .= '<PG_XMLRequestObjectID>'.htmlspecialchars(utf8_encode($_sRequestObjectID)).'</PG_XMLRequestObjectID>';
		$this->sXML .= '<PG_UserID>'.$_iUserID.'</PG_UserID>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@description
	[en]Closes respectively terminates the XML document.[/en]
	[de]Schließt bzw. beendet das XML Dokument.[/de]
	*/
	public function close() {$this->sXML .= '</PG_XML>';}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@description
	[en]Returns the source of the XML document.[/en]
	[de]Gibt den Quelltext des XML-Dokuments zurück.[/de]
	
	@return sXML [type]string[/type]
	[en]Returns a string with the source of the XML document.[/en]
	[de]Gibt einen String mit dem Quelltext des XML-Dokuments zurück.[/de]
	*/
	public function getXml() {return $this->sXML;}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@description
	[en]Sets the source of the XML document.[/en]
	[de]Setzt den Quelltext des XML-Dokuments.[/de]
	
	@param sXml [needed][type]string[/type]
	[en]The source code of an XML document.[/en]
	[de]Der Quelltext eines XML-Dokuments.[/de]
	*/
	public function setXml($_sXml)
	{
		$_sXml = $this->getRealParameter(array('oParameters' => $_sXml, 'sName' => 'sXml', 'xParameter' => $_sXml));
		$this->sXML = $_sXml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@return sAttributes [type]string[/type]
	[en]Returns the attributes of an XML tag as a string.[/en]
	[de]Gibt die Attribute eines XML-Tags als String zurück.[/de]
	
	@description
	[en]Converts attributes to a string.[/en]
	[de]Wandelt Attribute zu einem String um.[/de]
	
	@param axAttributes [needed][type]mixed[][/type]
	[en]Takes as a parameter an associative array whose indexes are the attribute name and its values are the attributes values.[/en]
	[de]Erwartet als Parameter einen assoziativen Array dessen Indices die Attribut-Namen und dessen Werte die Attribute-Werte darstellen.[/de]
	*/
	public function buildAttributesString($_axAttributes)
	{
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_axAttributes, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes, 'bNotNull' => true));
		
		$_sHTML = '';
		if ($_axAttributes !== NULL)
		{
			foreach ($_axAttributes as $_sAttribute => $_xValue)
			{
				if ($_sAttribute != 'axAttributes')
				{
					$_sAttribute = trim($_sAttribute);
					$_xValue = htmlspecialchars(utf8_encode(trim($_xValue)));
					if ($_sAttribute != '') {$_sHTML .= ' '.$_sAttribute.'="'.$_xValue.'"';}
				}
			}
		}
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CData
	
	@description
	[en]Sets a tag of type CData directly into the source of the XML document.[/en]
	[de]Setzt einen Tag vom Typ CData direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sTag [needed][type]string[/type]
	%sTagOfTags%
	
	@param sText [needed][type]string[/type]
	%xValueOfTag%
	
	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function setCDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildCDataTag(array('sTag' => $_sTag, 'sText' => $_sText, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group CData
	
	@description
	[en]Adds a tag of type CData to the XMLWrite object.[/en]
	[de]Fügt einen Tag vom Typ CData dem XmlWrite Objekt hinzu.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param sText [needed][type]string[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function addCDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->asTags[] = $this->buildCDataTag(array('sTag' => $_sTag, 'sText' => $_sText, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group CData
	
	@description
	[en]Builds a tag of type CData and returns it as a string.[/en]
	[de]Erstellt einen Tag vom Typ CData und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns a tag of type CData as a string.[/en]
	[de]Gibt einen Tag vom Typ CData als String zurück.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param sText [needed][type]string[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function buildCDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		return '<'.trim($_sTag).$this->buildAttributesString(array('axAttributes' => $_axAttributes)).'><![CDATA['.utf8_encode($_sText).']]></'.trim($_sTag).'>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text
	
	@description
	[en]Sets a tag of type Text directly into the source of the XML document.[/en]
	[de]Setzt einen Tag vom Typ Text direkt in den Quelltext des XML-Dokuments.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param sText [needed][type]string[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function setTextDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildTextDataTag(array('sTag' => $_sTag, 'sText' => $_sText, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text

	@description
	[en]Adds a tag of type text to the XMLWrite object.[/en]
	[de]Fügt einen Tag vom Typ Text dem XmlWrite Objekt hinzu.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param sText [needed][type]string[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function addTextDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->asTags[] = $this->buildTextDataTag(array('sTag' => $_sTag, 'sText' => $_sText, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text
	
	@description
	[en]Builds a tag of type text and returns it as a string.[/en]
	[de]Erstellt einen Tag vom Typ Text und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns a tag of type text as a string.[/en]
	[de]Gibt einen Tag vom Typ Text als String zurück.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param sText [needed][type]string[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function buildTextDataTag($_sTag, $_sText = NULL, $_axAttributes = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sText', 'xParameter' => $_sText));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		return '<'.trim($_sTag).$this->buildAttributesString(array('axAttributes' => $_axAttributes)).'>'.htmlspecialchars(utf8_encode($_sText)).'</'.trim($_sTag).'>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Number
	
	@description
	[en]Sets a tag of type number directly into the source of the XML document.[/en]
	[de]Setzt einen Tag vom Typ Number direkt in den Quelltext des XML-Dokuments.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param nNumber [needed][type]number[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function setNumDataTag($_sTag, $_nNumber = NULL, $_axAttributes = NULL)
	{
		$_nNumber = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'nNumber', 'xParameter' => $_nNumber));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildNumDataTag(array('sTag' => $_sTag, 'nNumber' => $_nNumber, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Number
	
	@description
	[en]Adds a tag of type number to the XMLWrite object.[/en]
	[de]Fügt einen Tag vom Typ Number dem XmlWrite Objekt hinzu.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param nNumber [needed][type]number[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function addNumDataTag($_sTag, $_nNumber = NULL, $_axAttributes = NULL)
	{
		$_nNumber = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'nNumber', 'xParameter' => $_nNumber));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->asTags[] = $this->buildNumDataTag(array('sTag' => $_sTag, 'nNumber' => $_nNumber, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Number
	
	@description
	[en]Builds a tag of type number and returns it as a string.[/en]
	[de]Erstellt einen Tag vom Typ Number und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns a tag of type number as a string.[/en]
	[de]Gibt einen Tag vom Typ Number als String zurück.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%
	
	@param nNumber [needed][type]number[/type]
	%xValueOfTag%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function buildNumDataTag($_sTag, $_nNumber = NULL, $_axAttributes = NULL)
	{
		$_nNumber = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'nNumber', 'xParameter' => $_nNumber));
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		return '<'.trim($_sTag).$this->buildAttributesString(array('axAttributes' => $_axAttributes)).'>'.$_nNumber.'</'.trim($_sTag).'>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets an open tag directly into the source of the XML document.[/en]
	[de]Setzt einen offenen Tag direkt in den Quelltext des XML-Dokuments.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function openTag($_sTag, $_axAttributes = NULL)
	{
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildOpenTag(array('sTag' => $_sTag, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets an open tag directly into the source of the XML document.[/en]
	[de]Setzt einen offenen Tag direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function setOpenTag($_sTag, $_axAttributes = NULL)
	{
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildOpenTag(array('sTag' => $_sTag, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags

	@description
	[en]Adds an open tag to the XMLWrite object.[/en]
	[de]Fügt einen offenen Tag dem XmlWrite Objekt hinzu.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function addOpenTag($_sTag, $_axAttributes = NULL)
	{
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->asTags[] = $this->buildOpenTag(array('sTag' => $_sTag, 'axAttributes' => $_axAttributes));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Builds an open tag and returns it as a string.[/en]
	[de]Erstellt einen offenen Tag und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns an open tag as a String.[/en]
	[de]Gibt einen offenen Tag als String zurück.[/de]

	@param sTag [needed][type]string[/type]
	%sTagOfTags%

	@param axAttributes [type]mixed[][/type]
	%axAttributesOfTags%
	*/
	public function buildOpenTag($_sTag, $_axAttributes = NULL)
	{
		$_axAttributes = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'axAttributes', 'xParameter' => $_axAttributes));
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sLastTag = trim($_sTag);
		return '<'.$this->sLastTag.$this->buildAttributesString(array('axAttributes' => $_axAttributes)).'>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets an closed tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sTag [type]string[/type]
	%sTagOfTags%
	*/
	public function closeTag($_sTag = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildCloseTag(array('sTag' => $_sTag));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets an closed tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sTag [type]string[/type]
	%sTagOfTags%
	*/
	public function setCloseTag($_sTag = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->sXML .= $this->buildCloseTag(array('sTag' => $_sTag));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags

	@description
	[en]Adds an closed tag to the XMLWrite object.[/en]
	[de]Fügt einen geschlossenen Tag dem XmlWrite Objekt hinzu.[/de]
	
	@param sTag [type]string[/type]
	%sTagOfTags%
	*/
	public function addCloseTag($_sTag = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$this->asTags[] = $this->buildCloseTag(array('sTag' => $_sTag));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Builds an closed tag and returns it as a string.[/en]
	[de]Erstellt einen geschlossenen Tag und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns an closed tag as a String.[/en]
	[de]Gibt einen geschlossenen Tag als String zurück.[/de]

	@param sTag [type]string[/type]
	%sTagOfTags%
	*/
	public function buildCloseTag($_sTag = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sTag, 'sName' => 'sTag', 'xParameter' => $_sTag));
		if ($_sTag === NULL) {$_sTag = '';}
		$_sHTML = '';
		if (trim($_sTag) == '') {$_sHTML .= $this->closeLastTag();}
		else {$_sHTML .= '</'.trim($_sTag).'>';}
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets a closed tag for the last open tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag zum zuletzt geöffneten Tag direkt in den Quelltext des XML-Dokuments.[/de]
	*/
	public function closeLastTag() {$this->sXML .= $this->buildCloseLastTag();}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets a closed tag for the last open tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag zum zuletzt geöffneten Tag direkt in den Quelltext des XML-Dokuments.[/de]
	*/
	public function setCloseLastTag() {$this->sXML .= $this->buildCloseLastTag();}
	/* @end method */
	
	/*
	@start method
	
	@group Tags

	@description
	[en]Adds an closed tag for the last open tag to the XMLWrite object.[/en]
	[de]Fügt einen geschlossenen Tag zum zuletzt geöffneten Tag dem XmlWrite Objekt hinzu.[/de]
	*/
	public function addCloseLastTag() {$this->asTags[] = $this->buildCloseLastTag();}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Builds an closed tag and returns it as a string.[/en]
	[de]Erstellt einen geschlossenen Tag und gibt es als String zurück.[/de]
	
	@return sTag [type]string[/type]
	[en]Returns an closed tag as a String.[/en]
	[de]Gibt einen geschlossenen Tag als String zurück.[/de]
	*/
	public function buildCloseLastTag() {return '</'.$this->sLastTag.'>';}
	/* @end method */

	/*
	@start method
	
	@group CData
	
	@description
	[en]Sets data of type CData directly into the source of the XML document.[/en]
	[de]Setzt Daten vom Typ CData direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text to be formatted to data of type CData.[/en]
	[de]Der Text, der zu Daten vom Typ CData formatiert werden soll.[/de]
	*/
	public function setCData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		$this->sXML .= $this->buildCData(array('sText' => $_sText));
	}
	/* @end method */
	
	/*
	@start method
	
	@group CData

	@description
	[en]Adds data of type CData to the XMLWrite object.[/en]
	[de]Fügt Daten vom Typ CData dem XmlWrite Objekt hinzu.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text to be formatted to data of type CData.[/en]
	[de]Der Text, der zu Daten vom Typ CData formatiert werden soll.[/de]
	*/
	public function addCData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		$this->asTags[] = $this->buildCData(array('sText' => $_sText));
	}
	/* @end method */
	
	/*
	@start method
	
	@group CData
	
	@description
	[en]Builds data of type CData and returns it as a string.[/en]
	[de]Erstellt Daten vom Typ CData und gibt es als String zurück.[/de]

	@return sCData [type]string[/type]
	[en]Returns data of type CData as a string.[/en]
	[de]Gibt Daten vom Typ CData als String zurück.[/de]

	@param sText [needed][type]string[/type]
	[en]The text to be formatted to data of type CData.[/en]
	[de]Der Text, der zu Daten vom Typ CData formatiert werden soll.[/de]
	*/
	public function buildCData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		return '<![CDATA['.htmlspecialchars(utf8_encode($_sText)).']]>';
	}
	/* @end method */

	/*
	@start method
	
	@group Text
	
	@description
	[en]Sets text directly into the source of the XML document.[/en]
	[de]Setzt Text direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text that will be used.[/en]
	[de]Der Text, der verwendet werden soll.[/de]
	*/
	public function setTextData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		$this->sXML .= $this->buildTextData(array('sText' => $_sText));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text

	@description
	[en]Adds text to the XMLWrite object.[/en]
	[de]Fügt Text dem XmlWrite Objekt hinzu.[/de]
	
	@param sText [needed][type]string[/type]
	[en]The text that will be used.[/en]
	[de]Der Text, der verwendet werden soll.[/de]
	*/
	public function addTextData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		$this->asTags[] = $this->buildTextData(array('sText' => $_sText));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Text
	
	@description
	[en]Builds formatted text and returns it as a string.[/en]
	[de]Erstellt formatierten Text und gibt es als String zurück.[/de]
	
	@return sText [type]string[/type]
	[en]Returns formatted text as a string.[/en]
	[de]Gibt formatierten Text als String zurück.[/de]

	@param sText [needed][type]string[/type]
	[en]The text that will be used.[/en]
	[de]Der Text, der verwendet werden soll.[/de]
	*/
	public function buildTextData($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		return htmlspecialchars(utf8_encode(trim($_sText)));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Raw
	
	@description
	[en]Sets a string directly into the source of the XML document.[/en]
	[de]Setzt einen String direkt in den Quelltext des XML-Dokuments.[/de]
	
	@param sString [needed][type]string[/type]
	[en]The string that will be used.[/en]
	[de]Der String, der verwendet werden soll.[/de]
	*/
	public function setRaw($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$this->sXML .= $this->buildRaw(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Raw

	@description
	[en]Adds a string to the XMLWrite object.[/en]
	[de]Fügt einen String dem XmlWrite Objekt hinzu.[/de]
	
	@param sString [needed][type]string[/type]
	[en]The string that will be used.[/en]
	[de]Der String, der verwendet werden soll.[/de]
	*/
	public function addRaw($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$this->asTags[] = $this->buildRaw(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Raw
	
	@description
	[en]Builds a string and returns it as a string.[/en]
	[de]Erstellt einen String und gibt es als String zurück.[/de]

	@return sString [type]string[/type]
	[en]Returns a string as a string.[/en]
	[de]Gibt einen String als String zurück.[/de]
	
	@param sString [needed][type]string[/type]
	[en]The string that will be used.[/en]
	[de]Der String, der verwendet werden soll.[/de]
	*/
	public function buildRaw($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General

	@description
	[en]Builds the XML document and returns it as a string.[/en]
	[de]Erstellt das XML-Dokument und gibt es als String zurück.[/de]

	@return sXml [type]string[/type]
	[en]Returns the XML document as a string.[/en
	[de]Gibt das XML-Dokument als String zurück.[/de]
	
	@param sRequestType [type]string[/type]
	[en]The request type of a request from the web page, if there is one.[/en]
	[de]Der Typ von einer Anfragen der Webseite, soweit es einen gibt.[/de]

	@param sRequestObjectID [type]string[/type]
	[en]The object that initiated the request, if there is one.[/en]
	[de]Das Objekt, welches die Anfrage ausgelöst hat, soweit es eines gibt.[/de]

	@param iUserID [type]int[/type]
	[en]The user that triggered the request, if there is one.[/en]
	[de]Der Benutzer, der die Anfrage ausgelöst hat, soweit es einen gibt.[/de]
	*/
	public function build($_sRequestType = NULL, $_sRequestObjectID = NULL, $_iUserID = NULL)
	{
		$_sRequestObjectID = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'sRequestObjectID', 'xParameter' => $_sRequestObjectID));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_sRequestType = $this->getRealParameter(array('oParameters' => $_sRequestType, 'sName' => 'sRequestType', 'xParameter' => $_sRequestType));

		$this->open(array('sRequestType' => $_sRequestType, 'sRequestObjectID' => $_sRequestObjectID, 'iUserID' => $_iUserID));
		for ($i=0; $i<count($this->asTags); $i++) {$this->sXML .= $this->asTags[$i];}
		$this->close();
		return $this->sXML;
	}
	/* @end method */
}
/* @end class */
$oPGXmlWrite = new classPG_XmlWrite();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGXmlWrite', 'xValue' => $oPGXmlWrite));}
?>