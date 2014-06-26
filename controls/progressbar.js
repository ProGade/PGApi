/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 13 2012
*/
var PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR = 0;
var PG_PROGRESSBAR_TYPE_VERTICAL_BAR = 1;

/*
@start class

@var ProgressBarTypes
PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR
PG_PROGRESSBAR_TYPE_VERTICAL_BAR

@description
[en]This class has methods to the creating progress bars.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen von Fortschrittsanzeigen.[/de]

@param extends classPG_ClassBasics
*/
function classPG_ProgressBar()
{
	// Declarations...
	
	// Construct...
	this.setID({'sID': 'PGProgressBar'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Removes a progress bar.[/en]
	[de]Entfernt eine Fortschrittsanzeige.[/de]
	
	@param sProgressBarID [needed][type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	*/
	this.remove = function(_sProgressBarID)
	{
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		var _oStatusBar = this.oDocument.getElementById(_sProgressBarID+'Container2');
		if (_oStatusBar) {_oStatusBar.outerHTML = '';}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a progress bar and place it into a container HTML element.[/en]
	[de]Erstellt eine Fortschrittsanzeige und platziert sie in einen Kontainer HTML Element.[/de]
	
	@param sProgressBarID [type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	
	@param xContainer [type]mixed[/type]
	[en]The container in which the progress bar should be placed.[/en]
	[de]Der Kontainer in den die Fortschrittsanzeige platziert werden soll.[/de]
	
	@param iType [type]int[/type]
	[en]
		The type of the progress bar.
		Specifies the look and behaviour.
		Follow defines are possible:
		%ProgressBarTypes%
	[/en]
	[de]
		Den Typ der Fortschrittsanzeige.
		Bestimmt das Aussehen und verhalten.
		Forlgende Defines sind möglich:
		%ProgressBarTypes%
	[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the progress bar.[/en]
	[de]Die Breite der Fortschrittsanzeige.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the progress bar.[/en]
	[de]Die Höhe der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssClass [type]string[/type]
	[en]The CSS class for the background of the progress bar.[/en]
	[de]Die CSS Klasse für den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssStyle [type]string[/type]
	[en]The CSS code for the background of the progress bar.[/en]
	[de]Die CSS Code für den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssClass [type]string[/type]
	[en]The CSS class for the foreground of the progress bar.[/en]
	[de]Die CSS Klasse für den Vordergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssStyle [type]string[/type]
	[en]The CSS code for the foreground of the progress bar.[/en]
	[de]Die CSS Code für den Vordergrund der Fortschrittsanzeige.[/de]
	*/
	this.buildInto = function(
		_sProgressBarID,
		_xContainer, 
		_iProgressBarType, 
		_sSizeX, 
		_sSizeY, 
		_sBackgroundCssClass,
		_sBackgroundCssStyle, 
		_sBarCssClass, 
		_sBarCssStyle
	)
	{
		if (typeof(_sProgressBarID) == 'undefined') {var _sProgressBarID = null;}
		if (typeof(_xContainer) == 'undefined') {var _xContainer = null;}
		if (typeof(_iProgressBarType) == 'undefined') {var _iProgressBarType = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sBackgroundCssClass) == 'undefined') {var _sBackgroundCssClass = null;}
		if (typeof(_sBackgroundCssStyle) == 'undefined') {var _sBackgroundCssStyle = null;}
		if (typeof(_sBarCssClass) == 'undefined') {var _sBarCssClass = null;}
		if (typeof(_sBarCssStyle) == 'undefined') {var _sBarCssStyle = null;}

		_xContainer = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'xContainer', 'xParameter': _xContainer});
		_iProgressBarType = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'iProgressBarType', 'xParameter': _iProgressBarType});
		_sSizeX = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sBackgroundCssClass = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBackgroundCssClass', 'xParameter': _sBackgroundCssClass});
		_sBackgroundCssStyle = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBackgroundCssStyle', 'xParameter': _sBackgroundCssStyle});
		_sBarCssClass = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBarCssClass', 'xParameter': _sBarCssClass});
		_sBarCssStyle = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBarCssStyle', 'xParameter': _sBarCssStyle});
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});

		if (_sProgressBarID == null) {_sProgressBarID = this.getNextID();}

		var _sHTML = this.build({'sProgressBarID':_sProgressBarID, 'iProgressBarType':_iProgressBarType, 'sWidth':_sSizeX, 'sHeight':_sSizeY, 'sBackgroundCssClass':_sBackgroundCssClass, 'sBackgroundCssStyle':_sBackgroundCssStyle, 'sBarCssClass':_sBarCssClass, 'sBarCssStyle':_sBarCssStyle});

		if (_xContainer != null)
		{
			var _oContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_oContainer) {_oContainer.innerHTML += _sHTML;}
		}
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds a progress bar.[/en]
	[de]Erstellt eine Fortschrittsanzeige.[/de]
	
	@return sProgressBarHtml [type]string[/type]
	[en]Returns the progress bar as an HTML string.[/en]
	[de]Gibt die Fortschrittsanzeige als HTML String zurück.[/de]
	
	@param sProgressBarID [type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	
	@param iType [type]int[/type]
	[en]
		The type of the progress bar.
		Specifies the look and behaviour.
		Follow defines are possible:
		%ProgressBarTypes%
	[/en]
	[de]
		Den Typ der Fortschrittsanzeige.
		Bestimmt das Aussehen und verhalten.
		Forlgende Defines sind möglich:
		%ProgressBarTypes%
	[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the progress bar.[/en]
	[de]Die Breite der Fortschrittsanzeige.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the progress bar.[/en]
	[de]Die Höhe der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssClass [type]string[/type]
	[en]The CSS class for the background of the progress bar.[/en]
	[de]Die CSS Klasse für den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssStyle [type]string[/type]
	[en]The CSS code for the background of the progress bar.[/en]
	[de]Die CSS Code für den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssClass [type]string[/type]
	[en]The CSS class for the foreground of the progress bar.[/en]
	[de]Die CSS Klasse für den Vordergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssStyle [type]string[/type]
	[en]The CSS code for the foreground of the progress bar.[/en]
	[de]Die CSS Code für den Vordergrund der Fortschrittsanzeige.[/de]
	*/
	this.build = function(
		_sProgressBarID, 
		_iProgressBarType, 
		_sSizeX, 
		_sSizeY, 
		_sBackgroundCssClass, 
		_sBackgroundCssStyle, 
		_sBarCssClass, 
		_sBarCssStyle
	)
	{
		if (typeof(_sProgressBarID) == 'undefined') {var _sProgressBarID = null;}
		if (typeof(_iProgressBarType) == 'undefined') {var _iProgressBarType = null;}
		if (typeof(_sSizeX) == 'undefined') {var _sSizeX = null;}
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sBackgroundCssClass) == 'undefined') {var _sBackgroundCssClass = null;}
		if (typeof(_sBackgroundCssStyle) == 'undefined') {var _sBackgroundCssStyle = null;}
		if (typeof(_sBarCssClass) == 'undefined') {var _sBarCssClass = null;}
		if (typeof(_sBarCssStyle) == 'undefined') {var _sBarCssStyle = null;}
		
		_iProgressBarType = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'iProgressBarType', 'xParameter': _iProgressBarType});
		_sSizeX = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		_sSizeY = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sBackgroundCssClass = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBackgroundCssClass', 'xParameter': _sBackgroundCssClass});
		_sBackgroundCssStyle = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBackgroundCssStyle', 'xParameter': _sBackgroundCssStyle});
		_sBarCssClass = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBarCssClass', 'xParameter': _sBarCssClass});
		_sBarCssStyle = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sBarCssStyle', 'xParameter': _sBarCssStyle});
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});

		if (_sProgressBarID == null) {_sProgressBarID = this.getNextID();}
		
		var _sHTML = '';
		
		if (_iProgressBarType == null) {_iProgressBarType = PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR;}
		if (_iProgressBarType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR)
		{
			if (_sSizeX == null) {_sSizeX = '100%';}
			if (_sSizeY == null) {_sSizeY = '25px';}
		}
		else if (_iProgressBarType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR)
		{
			if (_sSizeX == null) {_sSizeX = '45px';}
			if (_sSizeY == null) {_sSizeY = '100%';}
		}
		
		_sHTML += '<div id="'+_sProgressBarID+'Container2">';
		_sHTML += '<table cellpadding="0" cellspacing="0" style="border-width:0px;">';
		_sHTML += '<tr>';
			_sHTML += '<td id="'+_sProgressBarID+'Container" style="width:'+_sSizeX+'; height:'+_sSizeY+'; ';
			if ((_sBackgroundCssStyle != '') && (_sBackgroundCssStyle != null)) {_sHTML += _sBackgroundCssStyle+' ';}
			if (((_sBackgroundCssStyle == '') || (_sBackgroundCssStyle == null))
			&& ((_sBackgroundCssClass == '') || (_sBackgroundCssClass == null)))
			{
				_sHTML += 'background-color:#808080; ';
				_sHTML += 'color:#000000; ';
				_sHTML += 'font-weight:bold; ';
				_sHTML += 'font-size:12px; ';
				_sHTML += 'font-family:Arial, Verdana; ';
				_sHTML += 'border:solid 1px #000000; ';
				_sHTML += 'padding:0px; ';
				if (_iProgressBarType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR) {_sHTML += 'vertical-align:bottom; ';}
			}
			_sHTML += '" ';
			if ((_sBackgroundCssClass != '') && (_sBackgroundCssClass != null)) {_sHTML += 'class="'+_sBackgroundCssClass+'" ';}
			_sHTML += '>';
			_sHTML += '<table cellpadding="0" cellspacing="0" style="border-width:0px;">';
			_sHTML += '<tr>';
				_sHTML += '<td id="'+_sProgressBarID+'" ';
				if ((_sBarCssClass != '') && (_sBarCssClass != null)) {_sHTML += 'class="'+_sBarCssClass+'" ';}
				_sHTML += 'style="';
				if (_iProgressBarType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR) {_sHTML += 'height:'+_sSizeY+'; width:1px; ';}
				else if (_iProgressBarType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR) {_sHTML += 'width:'+_sSizeX+'; height:1px; ';}
				if ((_sBarCssStyle != '') && (_sBarCssStyle != null)) {_sHTML += _sBarCssStyle+' ';}
				if (((_sBarCssStyle == '') || (_sBarCssStyle == null))
				&& ((_sBarCssClass == '') || (_sBarCssClass == null)))
				{
					_sHTML += 'background-color:#150185; ';
					_sHTML += 'color:#FFFFFF; ';
					_sHTML += 'font-weight:bold; ';
					_sHTML += 'padding:5px; ';
					if (_iProgressBarType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR)
					{
						_sHTML += 'vertical-align:middle; ';
						_sHTML += 'text-align:right; ';
					}
					else if (_iProgressBarType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR)
					{
						_sHTML += 'vertical-align:top; ';
						_sHTML += 'text-align:center; ';
					}
				}
				_sHTML += '"></td>';
			_sHTML += '</tr>';
			_sHTML += '</table>';
			_sHTML += '</td>';
		_sHTML	+= '</tr>';
		_sHTML += '</table>';
		if (typeof(oPGControls) != 'undefined') {_sHTML += '<input type="hidden" id="'+_sProgressBarID+'ControlsType" value="'+PG_CONTROLS_TYPE_PROGRESSBAR+'" />';}
		_sHTML += '<input type="hidden" id="'+_sProgressBarID+'ProgressBarType" value="'+_iProgressBarType+'" />';
		_sHTML += '</div>';
		
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	@param sProgressBarID
	@param iProgressBarType
	@param sSizeX
	@param sSizeY
	@param sBackgroundStrokeStyle
	@param sBackgroundFillStyle
	@param sBarStrokeStyle
	@param sBarFillStyle
	*/
	this.draw = function(
		_sProgressBarID, 
		_iProgressBarType, 
		_sSizeX, 
		_sSizeY, 
		_sBackgroundStrokeStyle,
		_sBackgroundFillStyle, 
		_sBarStrokeStyle,
		_sBarFillStyle
	)
	{
		if (typeof(oPGCanvas) != 'undefined')
		{
			var _bBackgroundStroked = false;
			if (_sBackgroundStrokeStyle != null) {_bBackgroundStroked = true;}
// alert(_sSizeX+'\niSizeY: '+_sSizeY+'\nbStroked: '+_bBackgroundStroked+'\nsStrokeStyle: '+_sBackgroundStrokeStyle+'\nsFillStyle: '+_sBackgroundFillStyle);
			oPGCanvas.drawBatch(
				{'fFunction':oPGCanvas.addRect, 'iPosX':10, 'iPosY':10, 'iSizeX':_sSizeX, 'iSizeY':_sSizeY, 'bStroked':_bBackgroundStroked, 'bFilled':true, 'sStrokeStyle':_sBackgroundStrokeStyle, 'sFillStyle':_sBackgroundFillStyle}
			);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the percent of the progress bar.[/en]
	[de]Setzt die Prozent der Fortschrittsanzeige.[/de]
	
	@param sProgressBarID [needed][type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	
	@param iPercent [needed][type]int[/type]
	[en]The percent to display.[/en]
	[de]Die Prozent die angezeigt werden sollen.[/de]
	*/
	this.setPercent = function(_sProgressBarID, _iPercent)
	{
		if (typeof(_iPercent) == 'undefined') {var _iPercent = null;}
		
		_iPercent = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'iPercent', 'xParameter': _iPercent});
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		
		_iPercent = Math.min(Math.max(_iPercent, 1), 100);
		
		var _oProgressBar = this.oDocument.getElementById(_sProgressBarID);
		var _oProgressBarContainer = this.oDocument.getElementById(_sProgressBarID+'Container');
		var _oProgressBarType = this.oDocument.getElementById(_sProgressBarID+'ProgressBarType');
		if ((_oProgressBar) && (_oProgressBarContainer) && (_oProgressBarType))
		{
			var _iBarMaxSizeX = parseInt(_oProgressBarContainer.offsetWidth);
			var _iBarMaxSizeY = parseInt(_oProgressBarContainer.offsetHeight);
			var _iProgressBarType = parseInt(_oProgressBarType.value);
			if (_iProgressBarType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR)
			{
				var _iNewSizeX = Math.min(Math.round(_iBarMaxSizeX*_iPercent/100), _iBarMaxSizeX-2);
				if (!isNaN(_iNewSizeX)) {if (_iNewSizeX >= 0) {_oProgressBar.style.width = _iNewSizeX+'px';}}
			}
			else if (_iProgressBarType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR)
			{
				var _iNewSizeY = Math.min(Math.round(_iBarMaxSizeY*_iPercent/100), _iBarMaxSizeY-2);
				if (!isNaN(_iNewSizeY)) {if (_iNewSizeY >= 0) {_oProgressBar.style.height = _iNewSizeY+'px';}}
			}
			if (_iBarMaxSizeY >= 25)
			{
				if (!isNaN(_iPercent))
				{
					_iPercent = Math.max(Math.min(Math.round(_iPercent),100), 0);
					_oProgressBar.innerHTML = _iPercent+'%';
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a counter state for the progress bar to calculate the percent.[/en]
	[de]Setzt einen Counterstatus für die Fortschrittsanzeige zum errechnen der Prozente.[/de]
	
	@return iPercent [type]int[/type]
	[en]Returns the percent for the counter state.[/en]
	[de]Gibt die Prozent für den Counterstatus zurück.[/de]
	
	@param sProgressBarID [needed][type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	
	@param iCurrent [needed][type]int[/type]
	[en]The current count of the whole count.[/en]
	[de]Die aktuelle Anzahl von der Gesamtanzahl.[/de]
	
	@param iMax [needed][type]int[/type]
	[en]The whole count.[/en]
	[de]Die Gesamtanzahl.[/de]
	*/
	this.setCounter = function(_sProgressBarID, _iCurrent, _iMax)
	{
		if (typeof(_iCurrent) == 'undefined') {var _iCurrent = null;}
		if (typeof(_iMax) == 'undefined') {var _iMax = null;}
		
		_iCurrent = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'iCurrent', 'xParameter': _iCurrent});
		_iMax = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'iMax', 'xParameter': _iMax});
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		
		var _iPercent = _iMax*100/_iCurrent;
		this.setPercent({'sProgressBarID':_sProgressBarID, 'iPercent':_iPercent});
		return _iPercent;
	}
	/* @end method */
}
/* @end class */
classPG_ProgressBar.prototype = new classPG_ClassBasics();
var oPGProgressBar = new classPG_ProgressBar();
