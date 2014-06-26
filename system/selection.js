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
*/
function classPG_Selection()
{
	// Declarations...
	this.axSelection = null;
	this.aoParentNodes = null;
	
	this.bIsText = false;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	*/
	this.checkRange = function(_oElement)
	{
		if (typeof(_oElement) == 'undefined') {var _oElement = null;}
	
		_oElement = this.getRealParameter({'oParameters': _oElement, 'sName': 'oElement', 'xParameter': _oElement});

		this.oRange = null;
		this.sRangeType = '';
		
		this.sSelectionStart = '';
		this.sSelectionEnd = '';
		this.sSelection = '';
		
		if (this.oDocument.focus) {this.oDocument.focus();}
		this.axSelection = this.getSelection({'oElement': _oElement});
		this.aoParentNodes = this.getParentNodes({'oRange': this.axSelection['oRange']});
		return this.aoParentNodes;
	}
	/* @end method */
	
/*
	this.test = function(_axSelection)
	{
		var _sTest = "";

		if (_axSelection['oSelection'])
		{
			_sTest += oPGObjects.getTypeOfInstance({'oObject': _axSelection['oSelection']});
			_sTest += '<br />';
			_sTest += oPGObjects.getStructureString({'oObject': oPGObjects.getTypesOfInstance({'oObject': _axSelection['oSelection']})});
			_sTest += "<br /><br />";
		}
		_sTest += oPGObjects.getStructureString(
			{
				'oObject':_axSelection, 
				'bUseHtml': true, 
				'bShowEmpty': false,
				'bShowFunctions': false,
				'iMaxCount': 500,
				'iMaxDepth': 1
			}
		);
document.getElementById('testArea').innerHTML = _sTest;
	}
*/	
	/*
	@start method
	*/
	this.getSelection = function(_oElement)
	{
		if (typeof(_oElement) == 'undefined') {var _oElement = null;}
	
		_oElement = this.getRealParameter({'oParameters': _oElement, 'sName': 'oElement', 'xParameter': _oElement});

		var _axSelection = {
			'oSelection': null,
			'sSelectionType': '',
			'oRange': null,
			'oParent': null,
			'iStartPos': 0,
			'iEndPos': 0,
			'sStartText': '',
			'sText': '',
			'sEndText': '',
			'bIsText': false,
			'sDebug': ''
		};
		
		var _oSelection = this.getSelectionBase();
		_axSelection['oSelection'] = _oSelection;
		_axSelection['sSelectionType'] = this.getSelectionType({'oSelection': _oSelection});
		
		var _oRange = this.getRange({'oSelection': _oSelection, 'bAllowTextRange': this.bIsText});
		_axSelection['oRange'] = _oRange;
		
		if (_oElement == null)
		{
			if (_oRange)
			{
				if (_oRange.parentNode) {_oRange = _oRange.parentNode;}
				if ((_oElement == null) && (_oRange.parentElement)) {_oElement = _oRange.parentElement();}
				if (_oElement == null)
				{
					if (_oRange.focusNode) {_oElement = _oRange.focusNode;}
				}
			}
		}
		_axSelection['oParent'] = _oElement;

		var _iLength = 0;
		var _sText = '';
		var _sTagName = '';

		if (_oElement)
		{
			if (_oElement.nodeName) {_sTagName = _oElement.nodeName.toLowerCase();}
			else if (_oElement.tagName) {_sTagName = _oElement.tagName.toLowerCase();}
			
			_axSelection['sDebug'] += "Element is defined!\n";
			if (typeof(_oElement.selectionStart) == 'number') {_axSelection['iStartPos'] = _oElement.selectionStart;}
			if (typeof(_oElement.selectionEnd) == 'number') {_axSelection['iEndPos'] = _oElement.selectionEnd;}

			if ((_sTagName == 'input') || (_sTagName == 'textarea'))
			{
				_iLength = _oElement.value.length;
				_sText = _oElement.value.replace(/\r\n/g, "\n");
				_axSelection['bIsText'] = true;
			}
		}
		
		if (_oRange)
		{
			if ((_axSelection['iStartPos'] == 0) || (_axSelection['iEndPos'] == 0))
			{
				if (!_oElement) {_oElement = this.oDocument;}
				if (_oElement)
				{
					// if ((_sTagName == 'input') || (_sTagName == 'textarea'))
					// {
						if (_oElement.createTextRange)
						{
							var _oTextRange = _oElement.createTextRange();
							_oTextRange.moveToBookmark(_oRange.getBookmark());
							
							// _axSelection['oRange'] = _oTextRange;
							// alert(_oTextRange.toString());
							
							var _oEndTextRange = _oElement.createTextRange();
							_oEndTextRange.collapse(false);
							
							if (_axSelection['iStartPos'] == 0)
							{
								if (_oTextRange.compareEndPoints('StartToEnd', _oEndTextRange) > -1) {_axSelection['iStartPos'] = _axSelection['iEndPos'] = _iLength;}
								else
								{
									_axSelection['iStartPos'] = -_oTextRange.moveStart('character', -_iLength);
									_axSelection['iStartPos'] += _sText.slice(0, _axSelection['iStartPos']).split("\n").length - 1;
								}
							}
							
							if (_axSelection['iEndPos'] == 0)
							{
								if (_oTextRange.compareEndPoints('EndToEnd', _oEndTextRange) > -1) {_axSelection['iEndPos'] = _iLength;}
								else
								{
									_axSelection['iEndPos'] = -_oTextRange.moveEnd('character', -_iLength);
									_axSelection['iEndPos'] += _sText.slice(0, _axSelection['iEndPos']).split("\n").length - 1;
								}
							}
						}
					// }
				}
			}
		}
		
		if (_sText != '')
		{
			_axSelection['sStartText'] = _sText.substr(0, _axSelection['iStartPos']);
			_axSelection['sText'] = _sText.substr(_axSelection['iStartPos'], _axSelection['iEndPos']-_axSelection['iStartPos']);
			_axSelection['sEndText'] = _sText.substr(_axSelection['iEndPos'], _iLength-_axSelection['iEndPos']);
		}
		else if (_oRange)
		{
			if (_axSelection['iStartPos'] == 0) {if (_oRange.startOffset) {_axSelection['iStartPos'] = _oRange.startOffset;}}
			if (_axSelection['iEndPos'] == 0) {if (_oRange.endOffset) {_axSelection['iEndPos'] = _oRange.endOffset;}}
			_axSelection['sText'] = this.getRangeText({'oRange': _oRange});
			if (_axSelection['sText'] == '')
			{
				if (_oRange.htmlText) {_axSelection['sText'] = _oRange.htmlText;}
				else if (_oRange.text) {_axSelection['sText'] = _oRange.text;}
				else if (_oElement)
				{
					if (_oElement.value) {_axSelection['sText'] = _oElement.value.substring(_axSelection['iStartPos'], _axSelection['iEndPos']);}
					else if (_oElement.innerHTML) {_axSelection['sText'] = _oElement.innerHTML.substring(_axSelection['iStartPos'], _axSelection['iEndPos']);}
					else if (_oElement.substring) {_axSelection['sText'] = _oElement.substring(_axSelection['iStartPos'], _axSelection['iEndPos']);}
				}
			}
		}
		else
		{
			if (this.oDocument.selectionStart) {_axSelection['iStartPos'] = this.oDocument.selectionStart;}
			if (this.oDocument.selectionEnd) {_axSelection['iEndPos'] = this.oDocument.selectionEnd;}
			if (typeof(this.oDocument.value) != 'undefined')
			{
				_axSelection['sText'] = this.oDocument.value.substring(this.sSelectionBefore, this.sSelectionAfter);
			}
		}
		
		// TEST...
		// http://stackoverflow.com/questions/7186586/how-to-get-the-selected-text-in-textarea-using-jquery-in-internet-explorer-7
		// https://developer.mozilla.org/en-US/docs/Web/API/Selection?redirectlocale=en-US&redirectslug=DOM%2FSelection
		// http://msdn.microsoft.com/en-us/library/ie/ms536394%28v=vs.85%29.aspx
		// http://msdn.microsoft.com/en-us/library/ie/ff975303%28v=vs.85%29.aspx
		if (_axSelection['oParent'] == null) {_axSelection['oParent'] = this.getParentNode(_oRange, _axSelection['sSelectionType']);}
		
		return _axSelection;
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getSelectionBase = function()
	{
		var _oSelection = null;
		if (this.oDocument.selection) {return this.oDocument.selection;}
		if (this.oDocument.getSelection)
		{
			_oSelection = this.oDocument.getSelection();
			if (typeof(_oSelection) == 'object') {return _oSelection;}
		}
		if (typeof(this.oWindow.selection) == 'object') {return this.oWindow.selection;}
		if (this.oWindow.getSelection)
		{
			_oSelection = this.oWindow.getSelection();
			if (typeof(_oSelection) == 'object') {return _oSelection;}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getSelectionType = function(_oSelection)
	{
		if (typeof(_oSelection) == 'undefined') {var _oSelection = null;}
		_oSelection = this.getRealParameter({'oParameters': _oSelection, 'sName': 'oSelection', 'xParameter': _oSelection});
		if (_oSelection)
		{
			if (typeof(_oSelection.type) != 'undefined') {return _oSelection.type;}
		}
		return ''
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getRange = function(_oSelection, _bAllowTextRange)
	{
		if (typeof(_oSelection) == 'undefined') {var _oSelection = null;}
		if (typeof(_bAllowTextRange) == 'undefined') {var _bAllowTextRange = null;}

		_bAllowTextRange = this.getRealParameter({'oParameters': _oSelection, 'sName': 'bAllowTextRange', 'xParameter': _bAllowTextRange});
		_oSelection = this.getRealParameter({'oParameters': _oSelection, 'sName': 'oSelection', 'xParameter': _oSelection});

		var _oRange = null;
		if (!_oSelection) {_oSelection = this.oDocument;}
		if (_oSelection)
		{
			if ((_oSelection.createTextRange) && (_bAllowTextRange == true)) {_oRange = _oSelection.createTextRange();}
			// IE 10 Error beim löschen von Tabellenzeilen im Wysiwyg...
			// SCRIPT606: Der Vorgang konnte aufgrund des folgenden Fehlers nicht fortgesetzt werden: 800a025e. 
			// selection.js, Zeile 260 Zeichen 57 (_oRange = _oSelection.createRange();)
			if ((_oRange == null) && (_oSelection.createRange)) {_oRange = _oSelection.createRange();}
			if (_oRange != null) {return _oRange;}

			if ((_oRange == null) && (_oSelection.getRangeAt))
			{
				if (_oSelection.rangeCount > 0)
				{
					_oRange = _oSelection.getRangeAt(0);
					if (_oRange != null) {return _oRange;}
				}
			}
		}
		
		return _oRange;
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getParentNode = function(_oRange, _sSelectionType)
	{
		if (typeof(_oRange) == 'undefined') {var _oRange = null;}
		if (typeof(_sSelectionType) == 'undefined') {var _sSelectionType = null;}
	
		_sSelectionType = this.getRealParameter({'oParameters': _oRange, 'sName': 'sSelectionType', 'xParameter': _sSelectionType});
		_oRange = this.getRealParameter({'oParameters': _oRange, 'sName': 'oRange', 'xParameter': _oRange});

		if (!_oRange)
		{
			var _oSelection = null;
			if (this.axSelection)
			{
				if (this.axSelection['oSelection']) {_oSelection = this.axSelection['oSelection'];}
				else {_oSelection = this.getSelectionBase();}
			}
			else {_oSelection = this.getSelectionBase();}
			if (_oSelection) {_oRange = this.getRange({'oSelection': _oSelection, 'bAllowTextRange': false});}
			if (!_sSelectionType) {_sSelectionType = this.getSelectionType({'oSelection': _oSelection});}
		}
		if (!_oRange) {return null;}
		
		var _oNode = null;
		if (_oRange.commonAncestorContainer) {_oNode = _oRange.commonAncestorContainer;}
		else if (_oRange.parentNode) {_oNode = _oRange.parentNode;}
		else if (_sSelectionType == 'Control') {_oNode = _oRange[0];}
		else if (_oRange.parentElement) {_oNode = _oRange.parentElement();}
		return _oNode;
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getParentNodes = function(_oRange, _sSelectionType, _xMaxElement)
	{
		if (typeof(_oRange) == 'undefined') {var _oRange = null;}
		if (typeof(_sSelectionType) == 'undefined') {var _sSelectionType = null;}
		if (typeof(_xMaxElement) == 'undefined') {var _xMaxElement = null;}
	
		_sSelectionType = this.getRealParameter({'oParameters': _oRange, 'sName': 'sSelectionType', 'xParameter': _sSelectionType});
		_xMaxElement = this.getRealParameter({'oParameters': _oRange, 'sName': 'xMaxElement', 'xParameter': _xMaxElement});
		_oRange = this.getRealParameter({'oParameters': _oRange, 'sName': 'oRange', 'xParameter': _oRange});

		var _oNode = null;

		if (!_oRange)
		{
			var _oSelection = null;
			if (this.axSelection)
			{
				if (this.axSelection['oSelection']) {_oSelection = this.axSelection['oSelection'];}
				else {_oSelection = this.getSelectionBase();}
			}
			else {_oSelection = this.getSelectionBase();}
			if (_oSelection) {_oRange = this.getRange({'oSelection': _oSelection, 'bAllowTextRange': false});}
			if (!_sSelectionType) {_sSelectionType = this.getSelectionType({'oSelection': _oSelection});}
		}
		if (!_oRange) {return null;}
		_oNode = this.getParentNode({'oRange': _oRange, 'sSelectionType': _sSelectionType});
		return oPGNodes.getParentNodes({'xElement': _oNode, 'xMaxElement': _xMaxElement, 'bIncludeCurrent': true}); // TODO: xMaxElement bei Textarea vom WYSIWYG!
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.isRangeInNode = function(_oRange, _sNodeName, _sSelectionType)
	{
		if (typeof(_oRange) == 'undefined') {var _oRange = null;}
		if (typeof(_sNodeName) == 'undefined') {var _sNodeName = null;}
		if (typeof(_sSelectionType) == 'undefined') {var _sSelectionType = null;}

		_sNodeName = this.getRealParameter({'oParameters': _oRange, 'sName': 'sNodeName', 'xParameter': _sNodeName});
		_sSelectionType = this.getRealParameter({'oParameters': _oRange, 'sName': 'sSelectionType', 'xParameter': _sSelectionType});
		_oRange = this.getRealParameter({'oParameters': _oRange, 'sName': 'oRange', 'xParameter': _oRange});
		
		var _aoNodes = this.getParentNodes({'oRange': _oRange, 'sSelectionType': _sSelectionType, 'xMaxElement': _sNodeName});
		if (_aoNodes)
		{
			if (_aoNodes.length > 0)
			{
				if (_aoNodes[_aoNodes.length-1].nodeName.toUpperCase() == _sNodeName.toUpperCase()) {return _aoNodes[_aoNodes.length-1];}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.getRangeText = function(_oRange)
	{
		_oRange = this.getRealParameter({'oParameters': _oRange, 'sName': 'oRange', 'xParameter': _oRange});

		if (_oRange == null) {_oRange = this.oRange;}

		if (_oRange)
		{
			if (_oRange.text) {return _oRange.text.toString();}
			return _oRange.toString();
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.setAroundContent = function(_sStart, _sEnd)
	{
		if (typeof(_sEnd) == 'undefined') {var _sEnd = null;}
		
		_sEnd = this.getRealParameter({'oParameters': _sStart, 'sName': 'sEnd', 'xParameter': _sEnd});
		_sStart = this.getRealParameter({'oParameters': _sStart, 'sName': 'sStart', 'xParameter': _sStart});
		
		if (_sStart == null) {_sStart = '';}
		if (_sEnd == null) {_sEnd = '';}
		
		this.setContent(_sStart+this.axSelection['sText']+_sEnd);
	}
	/* @end method */
	
	/*
	@start method
	*/
	this.setContent = function(_sContent)
	{
		_sContent = this.getRealParameter({'oParameters': _sContent, 'sName': 'sContent', 'xParameter': _sContent});

		if (this.axSelection)
		{
			if (this.axSelection['bIsText'] == true)
			{
				if (this.axSelection['oParent'])
				{
					this.axSelection['oParent'].value = this.axSelection['sStartText']+_sContent+this.axSelection['sEndText'];
				}
			}
			else
			{
				if (!this.axSelection['oRange']) {this.checkRange();}
				if (this.axSelection['oRange'])
				{
					if (this.axSelection['oRange'].pasteHTML) {this.axSelection['oRange'].pasteHTML(_sContent);}
					else if (this.axSelection['oRange'].insertNode)
					{
						this.axSelection['oRange'].deleteContents();
						var _aoNodes = oPGStrings.toNodes({'sString': _sContent});
						for (var i=_aoNodes.length-1; i>=0; i--)
						{
							this.axSelection['oRange'].insertNode(_aoNodes[i]);
						}
					}
				}
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Selection.prototype = new classPG_ClassBasics();
var oPGSelection = new classPG_Selection();