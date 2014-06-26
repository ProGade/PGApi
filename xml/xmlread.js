/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
/*
@start class

@description
[en]This class has methods for reading XML structures.[/en]
[de]Diese Klasse verfügt über Methoden zum Lesen von XML Strukturen.[/de]

@param extends classPG_ClassBasics
*/
function classPG_XmlRead()
{
	// Declarations...
	this.oXml = null;
	
	// Construct...

	// Methods...
	/*
	@start method
	
	@description
	[en]Opens an XML object for reading.[/en]
	[de]Öffnet ein XML-Objekt zum Lesen.[/de]
	
	@param oXml [needed][type]string[/type]
	[en]The XML object to be read.[/en]
	[de]Das XML-Objekt, das gelesen werden soll.[/de]
	*/
	this.openXml = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		this.oXml = _oXml.normalize();
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Opens an XML object based on a request object for reading.[/en]
	[de]Öffnet ein XML-Objekt, anhand eines Anfrage-Objekts, zum Lesen.[/de]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]The request object to be read.[/en]
	[de]Das Anfrage-Objekt, das gelesen werden soll.[/de]
	*/
	this.openRequest = function(_oAjaxRequest)
	{
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		var _oXml = _oAjaxRequest.responseXML.documentElement;
		this.oXml = _oXml.normalize();
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Gets the content of a given tag of the XML source code with regard to the path structure.[/en]
	[de]Holt den Inhalt von einem bestimmten Tag, mit Berücksichtigung der Pfadstruktur, aus dem XML Quellcode.[/de]
	
	@return xContent [type]mixed[/type]
	[en]Returns the content of the specified tag.[/en]
	[de]Gibt den Inhalt des angegebenen Tags zurück.[/de]
	
	@param oXml [type]object[/type]
	[en]The XML object from which the content is to be read.[/en]
	[de]Das XML-Objekt, aus dem der Inhalt ausgelesen werden soll.[/de]
	
	@param asTags [needed][type]string[][/type]
	[en]The path structure to the tag. Each tag in the structure is given as an array element.[/en]
	[de]Die Pfadstruktur zum gewünschten Tag. Jedes Tag in der Struktur wird als Array-Element angegeben.[/de]
	*/
	this.getTagPathContent = function(_oXml, _asTags)
	{
		if (typeof(_asTags) == 'undefined') {var _asTags = null;}
		
		_asTags = this.getRealParameter({'oParameters': _oXml, 'sName': 'asTags', 'xParameter': _asTags});
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		
		if (_oXml == null) {_oXml = this.oXml;}
		
		var i=0;
		var t=0;
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName(_asTags[0]);
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if ((_asTags.length <= 1) && (_oNode.nodeName == _asTags[0]))
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
				else if (_asTags.length > 1)
				{
					if (_oNode)
					{
						if (_oNode.childNodes.length > 0)
						{
							for (i=1; i<_asTags.length; i++)
							{
								for (t=0; t<_oNode.childNodes.length; t++)
								{
									if (_oNode.childNode[t].nodeName == _asTags[i]) {_oNode = _oNode.childNode[t]; break;}
								}
							}
							if ((_oNode.nodeName == _asTags[_asTags.length-1]) && (_oNode.childNodes.length > 0)) {return _oNode.childNodes[0].nodeValue;}
						}
					}
				}
			}
		}
		return '';
	}
	/* @end method */

	// TODO:
	// - get names of available tags
	// - get more than one of tag with the same name and the same path
	// - get attributes of the tags
}
/* @end class */
classPG_XmlRead.prototype = new classPG_ClassBasics();
var oPGXmlRead = new classPG_XmlRead();
