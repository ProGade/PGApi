/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
var PG_XML_TYPE = 'PG_XML';

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
function classPG_XmlWrite()
{
	// Declarations...
	this.sXml = '';
	this.sLastTag = '';
	this.asTags = new Array();
	
	// Construct...

	// Methods...
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
	this.open = function(_sRequestType, _sRequestObjectID, _iUserID)
	{
		if (typeof(_sRequestType) == 'undefined') {var _sRequestType = null;}
		if (typeof(_sRequestObjectID) == 'undefined') {var _sRequestObjectID = null;}
		if (typeof(_iUserID) == 'undefined') {var _iUserID = null;}

		_sRequestObjectID = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'sRequestObjectID', 'xParameter': _sRequestObjectID});
		_iUserID = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'iUserID', 'xParameter': _iUserID});
		_sRequestType = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'sRequestType', 'xParameter': _sRequestType});
		
		if (_sRequestType === null) {_sRequestType = PG_XML_TYPE;}
		if (_sRequestObjectID === null) {_sRequestObjectID = 'null';}
		if (_iUserID === null) {_iUserID = 0;}
		
		var _sXmlType = PG_XML_TYPE;
		if (typeof(oPGStrings) != 'undefined')
		{
			_sXmlType = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sXmlType})});
			_sRequestType = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sRequestType})});
			_sRequestObjectID = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sRequestObjectID})});
		}
		
		this.sXml = '<?xml version="1.0"?>';
		this.sXml += '<PG_XML>';
		this.sXml += '<PG_XMLType>'+_sXmlType+'</PG_XMLType>';
		this.sXml += '<PG_XMLRequestType>'+_sRequestType+'</PG_XMLRequestType>';
		this.sXml += '<PG_XMLRequestObjectID>'+_sRequestObjectID+'</PG_XMLRequestObjectID>';
		this.sXml += '<PG_UserID>'+_iUserID+'</PG_UserID>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@description
	[en]Closes respectively terminates the XML document.[/en]
	[de]Schließt bzw. beendet das XML Dokument.[/de]
	*/
	this.close = function() {this.sXml += '</PG_XML>';}
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
	this.getXml = function() {return this.sXml;}
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
	this.setXml = function(_sXml)
	{
		_sXml = this.getRealParameter({'oParameters': _sXml, 'sName': 'sXml', 'xParameter': _sXml});
		this.sXml = _sXml;
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
	this.buildAttributesString = function(_axAttributes)
	{
		_axAttributes = this.getRealParameter({'oParameters': _axAttributes, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		
		var _sHtml = '';
		if (_axAttributes != null)
		{
			for (var _sAttribute in _axAttributes)
			{
				if (typeof(oPGStrings) != 'undefined')
				{
					_sAttribute = oPGStrings.trim({'sString': _sAttribute});
					_axAttributes[_sAttribute] = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': oPGStrings.trim({'sString': _axAttributes[_sAttribute]})})});
				}
				if (_sAttribute != '') {_sHtml += ' '+_sAttribute+'="'+_axAttributes[_sAttribute]+'"';}
			}
		}
		return _sHtml;
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
	this.setCDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}
		
		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		
		this.sXml += this.buildCDataTag({'sTag': _sTag, 'sText': _sText, 'axAttributes': _axAttributes});
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
	this.addCDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.asTags.push(this.buildCDataTag({'sTag': _sTag, 'sText': _sText, 'axAttributes':_axAttributes}));
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
	this.buildCDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		if (typeof(oPGStrings) != 'undefined')
		{
			_sTag = oPGStrings.trim({'sString': _sTag});
			_sText = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sText})});
		}
		
		return '<'+_sTag+this.buildAttributesString({'axAttributes': _axAttributes})+'><![CDATA['+_sText+']]></'+_sTag+'>';
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
	this.setTextDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.sXml += this.buildTextDataTag({'sTag': _sTag, 'sText': _sText, 'axAttributes': _axAttributes});
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
	this.addTextDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.asTags.push(this.buildTextDataTag({'sTag': _sTag, 'sText': _sText, 'axAttributes': _axAttributes}));
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
	this.buildTextDataTag = function(_sTag, _sText, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_sText = this.getRealParameter({'oParameters': _sTag, 'sName': 'sText', 'xParameter': _sText});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		if (typeof(oPGStrings) != 'undefined')
		{
			_sTag = oPGStrings.trim({'sString': _sTag});
			_sText = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sText})});
		}
		
		return '<'+_sTag+this.buildAttributesString({'axAttributes': _axAttributes})+'>'+_sText+'</'+_sTag+'>';
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
	this.setNumDataTag = function(_sTag, _nNumber, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_nNumber) == 'undefined') {var _nNumber = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_nNumber = this.getRealParameter({'oParameters': _sTag, 'sName': 'nNumber', 'xParameter': _nNumber});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.sXml += this.buildNumDataTag({'sTag': _sTag, 'nNumber':_nNumber, 'axAttributes': _axAttributes});
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
	this.addNumDataTag = function(_sTag, _nNumber, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_nNumber) == 'undefined') {var _nNumber = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_nNumber = this.getRealParameter({'oParameters': _sTag, 'sName': 'nNumber', 'xParameter': _nNumber});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.asTags.push(this.buildNumDataTag({'sTag': _sTag, 'nNumber': _nNumber, 'axAttributes': _axAttributes}));
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
	this.buildNumDataTag = function(_sTag, _nNumber, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_nNumber) == 'undefined') {var _nNumber = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_nNumber = this.getRealParameter({'oParameters': _sTag, 'sName': 'nNumber', 'xParameter': _nNumber});
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		if (typeof(oPGStrings) != 'undefined') {_sTag = oPGStrings.trim({'sString': _sTag});}
		this.sXml += '<'+_sTag+this.buildAttributesString({'axAttributes': _axAttributes})+'>'+_vNumber+'</'+_sTag+'>';
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
	this.openTag = function(_sTag, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.sXml += this.buildOpenTag({'sTag': _sTag, 'axAttributes': _axAttributes});
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
	this.setOpenTag = function(_sTag, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.sXml += this.buildOpenTag({'sTag': _sTag, 'axAttributes': _axAttributes});
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
	this.addOpenTag = function(_sTag, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		this.asTags.push(this.buildOpenTag({'sTag': _sTag, 'axAttributes': _axAttributes}));
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
	this.buildOpenTag = function(_sTag, _axAttributes)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}

		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});

		if (typeof(oPGStrings) != 'undefined') {_sTag = oPGStrings.trim({'sString': _sTag});}
		this.sLastTag = _sTag;
		return '<'+this.sLastTag+this.buildAttributesString({'axAttributes': _axAttributes})+'>';
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
	this.closeTag = function(_sTag)
	{
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		this.sXml += this.buildCloseTag({'sTag': _sTag});
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
	this.setCloseTag = function(_sTag)
	{
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		this.sXml += this.buildCloseTag({'sTag': _sTag});
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
	this.addCloseTag = function(_sTag)
	{
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		this.asTags.push(this.buildCloseTag({'sTag': _sTag}));
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
	this.buildCloseTag = function(_sTag)
	{
		if (typeof(_sTag) == 'undefined') {var _sTag = null;}
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		
		if (_sTag == null) {_sTag = '';}
		if (typeof(oPGStrings) != 'undefined') {_sTag = oPGStrings.trim({'sString': _sTag});}
		if (_sTag == '') {return this.buildCloseLastTag();}
		return '</'+_sTag+'>';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets a closed tag for the last open tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag zum zuletzt geöffneten Tag direkt in den Quelltext des XML-Dokuments.[/de]
	*/
	this.closeLastTag = function() {this.sXml += this.buildCloseLastTag();}
	/* @end method */

	/*
	@start method
	
	@group Tags
	
	@description
	[en]Sets a closed tag for the last open tag directly into the source of the XML document.[/en]
	[de]Setzt einen geschlossenen Tag zum zuletzt geöffneten Tag direkt in den Quelltext des XML-Dokuments.[/de]
	*/
	this.setCloseLastTag = function() {this.sXml += this.buildCloseLastTag();}
	/* @end method */

	/*
	@start method
	
	@group Tags

	@description
	[en]Adds an closed tag for the last open tag to the XMLWrite object.[/en]
	[de]Fügt einen geschlossenen Tag zum zuletzt geöffneten Tag dem XmlWrite Objekt hinzu.[/de]
	*/
	this.addCloseLastTag = function() {this.asTags.push(this.buildCloseLastTag());}
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
	this.buildCloseLastTag = function() {return '</'+this.sLastTag+'>';}
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
	this.setCData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		this.sXml += this.buildCData({'sText': _sText});
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
	this.addCData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		this.asTags.push(this.buildCData({'sText': _sText}));
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
	this.buildCData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		if (typeof(oPGStrings) != 'undefined') {_sText = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': _sText})});}
		return '<![CDATA['+_sText+']]>';
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
	this.setTextData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		this.sXml += this.buildText({'sText': _sText});
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
	this.addTextData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		this.asTags.push(this.buildText({'sText': _sText}));
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
	this.buildTextData = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		if (typeof(oPGStrings) != 'undefined') {_sText = oPGStrings.htmlSpecialChars({'sString': oPGStrings.utf8Encode({'sString': oPGStrings.trim(_sText)})});}
		return _sText;
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
	this.setRaw = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		this.sXml += this.buildRaw({'sString': _sString});
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
	this.addRaw = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		this.asTags.push(this.buildRaw({'sString': _sString}));
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
	this.buildRaw = function(_sString)
	{
		_sString = this.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});
		return _sString;
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
	this.build = function(_sRequestType, _sRequestObjectID, _iUserID)
	{
		if (typeof(_sRequestType) == 'undefined') {var _sRequestType = null;}
		if (typeof(_sRequestObjectID) == 'undefined') {var _sRequestObjectID = null;}
		if (typeof(_iUserID) == 'undefined') {var _iUserID = null;}

		_sRequestObjectID = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'sRequestObjectID', 'xParameter': _sRequestObjectID});
		_iUserID = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'iUserID', 'xParameter': _iUserID});
		_sRequestType = this.getRealParameter({'oParameters': _sRequestType, 'sName': 'sRequestType', 'xParameter': _sRequestType});
		
		this.open({'sRequestType': _sRequestType, 'sRequestObjectID': _sRequestObjectID, 'iUserID': _iUserID});
		for (var i=0; i<this.asTags.length; i++) {this.sXml += this.asTags[i];}
		this.close();
		return this.sXml;
	}
	/* @end method */
}
/* @end class */
classPG_XmlWrite.prototype = new classPG_ClassBasics();
var oPGXmlWrite = new classPG_XmlWrite();
