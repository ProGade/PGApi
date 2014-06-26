/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 22 2012
*/
var PG_CONTROLS_SCROLLDIV_DEFAULT_OVERLAY_ZINDEX = 100;

var PG_CONTROLS_TYPE_SCROLLDIV = 0;
var PG_CONTROLS_TYPE_PROGRESSBAR = 1;
var PG_CONTROLS_TYPE_FRAMESET = 2;
var PG_CONTROLS_TYPE_FRAME = 3;
var PG_CONTROLS_TYPE_INPUTFIELD = 4;
var PG_CONTROLS_TYPE_BUTTON = 5;
var PG_CONTROLS_TYPE_CHECKBOX = 6;

/*
@start class

@description
[en]This class contains methods to the manage other controls and for common functionality.[/en]
[de]Diese Klasse enthält Methoden zum verwalten von anderen Controls und für gemeinsame Funktionalitäten.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Controls()
{
	// Declarations...
	this.oKeyUpTimeout = null;

	this.sMouseOverControlID = '';
	this.sMouseDownControlID = '';
	this.sMouseOverDropdownID = '';
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Returns the relative, horizontal mouse cursor position to an HTML element in pixels.[/en]
	[de]Gibt die relative, horizontale Mauszeiger-Position zu einem HTML-Element in Pixeln zurück.[/de]
	
	@return iPosX [type]int[/type]
	[en]Returns the relative, horizontal mouse cursor position as an integer in pixels.[/en]
	[de]Gibt die relative, horizontale Mauszeiger-Position als Integer in Pixeln zurück.[/de]
	
	@param sElementID [needed][type]string[/type]
	[en]The ID of the HTML element to which the relative position is to be determined.[/en]
	[de]Die ID des HTML-Elements zu dem die relative Position ermittelt werden soll.[/de]
	*/
	this.getRelativeMousePosX = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		
		if (typeof(oPGInput) != 'undefined')
		{
			var _oControlsType = this.oDocument.getElementById(_sElementID+'ControlsType');
			if (_oControlsType)
			{
				var _iControlsType = parseInt(_oControlsType.value);
				if (_iControlsType == PG_CONTROLS_TYPE_SCROLLDIV)
				{
					var _oDivContainer = this.oDocument.getElementById(_sElementID+'Container');
					if (_oDivContainer)
					{
						var _iDivContainerPosX = 0;
						if (typeof(oPGBrowser) != 'undefined') {_iDivContainerPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDivContainer});}
						else {_iDivContainerPosX = parseInt(_oDivContainer.offsetLeft);}
						var _iMouseDocPosX = oPGInput.getDocPosX();
						return _iMouseDocPosX-_iDivContainerPosX;
					}
				}
			}
			
			var _oElement = this.oDocument.getElementById(_sElementID);
			if (_oElement)
			{
				var _iElementPosX = 0;
				if (typeof(oPGBrowser) != 'undefined') {_iElementPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oElement});}
				else {_iElementPosX = parseInt(_oDivContainer.offsetLeft);}
				var _iMouseDocPosX = oPGInput.getDocPosX();
				return _iMouseDocPosX-_iElementPosX;
			}
		}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the relative, vertical mouse cursor position to an HTML element in pixels.[/en]
	[de]Gibt die relative, vertikale Mauszeiger-Position zu einem HTML-Element in Pixeln zurück.[/de]
	
	@return iPosY [type]int[/type]
	[en]Returns the relative, vertical mouse cursor position as an integer in pixels.[/en]
	[de]Gibt die relative, vertikale Mauszeiger-Position als Integer in Pixeln zurück.[/de]
	
	@param sElementID [needed][type]string[/type]
	[en]The ID of the HTML element to which the relative position is to be determined.[/en]
	[de]Die ID des HTML-Elements zu dem die relative Position ermittelt werden soll.[/de]
	*/
	this.getRelativeMousePosY = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		
		if (typeof(oPGInput) != 'undefined')
		{
			var _oControlsType = this.oDocument.getElementById(_sElementID+'ControlsType');
			if (_oControlsType)
			{
				var _iControlsType = parseInt(_oControlsType.value);
				if (_iControlsType == PG_CONTROLS_TYPE_SCROLLDIV)
				{
					var _oDivContainer = this.oDocument.getElementById(_sElementID+'Container');
					if (_oDivContainer)
					{
						var _iDivContainerPosY = 0;
						if (typeof(oPGBrowser) != 'undefined') {_iDivContainerPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDivContainer});}
						else {_iDivContainerPosY = parseInt(_oDivContainer.offsetTop);}
						var _iMouseDocPosY = oPGInput.getDocPosY();
						return _iMouseDocPosY-_iDivContainerPosY;
					}
				}
			}

			var _oElement = this.oDocument.getElementById(_sElementID);
			if (_oElement)
			{
				var _iElementPosY = 0;
				if (typeof(oPGBrowser) != 'undefined') {_iElementPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oElement});}
				else {_iElementPosY = parseInt(_oElement.offsetTop);}
				var _iMouseDocPosY = oPGInput.getDocPosY();
				return _iMouseDocPosY-_iElementPosY;
			}
		}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the relative, horizontal mouse cursor position to an HTML element in percent.[/en]
	[de]Gibt die relative, horizontale Mauszeiger-Position zu einem HTML-Element in Prozent zurück.[/de]
	
	@return iPercentX [type]int[/type]
	[en]Returns the relative, horizontal mouse cursor position as an integer in percent.[/en]
	[de]Gibt die relative, horizontale Mauszeiger-Position als Integer in Prozent zurück.[/de]
	
	@param sElementID [needed][type]string[/type]
	[en]The ID of the HTML element to which the relative position is to be determined.[/en]
	[de]Die ID des HTML-Elements zu dem die relative Position ermittelt werden soll.[/de]
	*/
	this.getRelativeMousePercentX = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		
		if (typeof oPGInput != 'undefined')
		{
			var _oControlsType = this.oDocument.getElementById(_sElementID+'ControlsType');
			if (_oControlsType)
			{
				var _iControlsType = parseInt(_oControlsType.value);
				if (_iControlsType == PG_CONTROLS_TYPE_SCROLLDIV)
				{
					var _oDivContainer = this.oDocument.getElementById(_sElementID+'Container');
					if (_oDivContainer)
					{
						if (typeof(oPGBrowser) != 'undefined') {var _iDivContainerPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oDivContainer});}
						else {var _iDivContainerPosX = parseInt(_oDivContainer.offsetLeft);}
						var _iDivContainerSizeX = parseInt(_oDivContainer.offsetWidth);
						var _iMouseDocPosX = oPGInput.getDocPosX();
						return 100/_iDivContainerSizeX*(_iMouseDocPosX-_iDivContainerPosX);
					}
				}
			}

			var _oElement = this.oDocument.getElementById(_sElementID);
			if (_oElement)
			{
				var _iElementPosX = 0;
				if (typeof(oPGBrowser) != 'undefined') {_iElementPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oElement});}
				else {_iElementPosX = parseInt(_oElement.offsetLeft);}
				var _iElementSizeX = parseInt(_oElement.offsetWidth);
				var _iMouseDocPosX = oPGInput.getDocPosX();
				return 100/_iElementSizeX*(_iMouseDocPosX-_iElementPosX);
			}
		}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the relative, vertical mouse cursor position to an HTML element in percent.[/en]
	[de]Gibt die relative, vertikale Mauszeiger-Position zu einem HTML-Element in Prozent zurück.[/de]

	@return iPercentY [type]int[/type]
	[en]Returns the relative, vertical mouse cursor position as an integer in percent.[/en]
	[de]Gibt die relative, vertikale Mauszeiger-Position als Integer in Prozent zurück.[/de]
	
	@param sElementID [needed][type]string[/type]
	[en]The ID of the HTML element to which the relative position is to be determined.[/en]
	[de]Die ID des HTML-Elements zu dem die relative Position ermittelt werden soll.[/de]
	*/
	this.getRelativeMousePercentY = function(_sElementID)
	{
		_sElementID = this.getRealParameter({'oParameters': _sElementID, 'sName': 'sElementID', 'xParameter': _sElementID});
		
		if (typeof oPGInput != 'undefined')
		{
			var _oControlsType = this.oDocument.getElementById(_sElementID+'ControlsType');
			if (_oControlsType)
			{
				var _iControlsType = parseInt(_oControlsType.value);
				if (_iControlsType == PG_CONTROLS_TYPE_SCROLLDIV)
				{
					var _oDivContainer = this.oDocument.getElementById(_sElementID+'Container');
					if (_oDivContainer)
					{
						var _iDivContainerPosY = 0;
						if (typeof(oPGBrowser) != 'undefined') {_iDivContainerPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oDivContainer});}
						else {_iDivContainerPosY = parseInt(_oDivContainer.offsetTop);}
						var _iDivContainerSizeY = parseInt(_oDivContainer.offsetHeight);
						var _iMouseDocPosY = oPGInput.getDocPosY();
						return 100/_iDivContainerSizeY*(_iMouseDocPosY-_iDivContainerPosY);
					}
				}
			}
			
			var _oElement = this.oDocument.getElementById(_sElementID);
			if (_oElement)
			{
				var _iElementPosY = 0;
				if (typeof(oPGBrowser) != 'undefined') {_iElementPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oElement});}
				else {_iElementPosY = parseInt(_oElement.offsetTop);}
				var _iElementSizeY = parseInt(_oElement.offsetHeight);
				var _iMouseDocPosY = oPGInput.getDocPosY();
				return 100/_iElementSizeY*(_iMouseDocPosY-_iElementPosY);
			}
		}
		return null;
	}
	/* @end method */
}
/* @end class */
classPG_Controls.prototype = new classPG_ClassBasics();
var oPGControls = new classPG_Controls();
