/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_CodeEditor()
{
	// Declarations...
	this.oLastKeyUpDateTime = null;
	this.oKeyUpTimeout = null;
	this.iUpdateFormatedTextTimeout = 500;
	this.bHighlight = false;
	this.bFocused = false;
	
	this.sCssFormation = 'font-family:\'Courier New\', Fixedsys, Courier, monospace; font-size:10pt; font-weight:bold; color:#000000; ';
	
	this.iCharacterWidth = 10;
	this.iTabWidth = 64;
	
	this.oTextRange = null;
	this.oTextRangeType = null;
	this.iTextStartSelection = 0;
	this.iTextEndSelection = 0;
	this.sTextSelection = '';
	
	this.iUndoMaxCount = 10;
	this.iCurrentUndo = 9;
	this.asUndoText = new Array();

	// Construct...
	this.setID({'sID': 'PGCodeEditor'});

	// Methods...
	/* @start method */
	this.activateDeveloperMode = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea) {_oTextArea.style.display = 'block';}
		
		var _oLineNumbers = this.oDocument.getElementById(this.getID()+'LineNumbers');
		if (_oLineNumbers) {_oLineNumbers.style.display = 'block';}
		
		// this.init();
	}
	/* @end method */
	
	/* @start method */
	this.init = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			this.showFormatedText();
			// this.oLastKeyUpDateTime = new Date();
			this.initKeyBindings();
			for (var i=0; i<this.iUndoMaxCount; i++)
			{
				this.asUndoText.push('');
			}
			this.updateText();
			// this.updateFormatedText();
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.setSize = function(_iSizeX, _iSizeY)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}

		_iSizeY = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		var _oFormatedText = this.oDocument.getElementById(this.getID()+'FormatedText');
		var _oLineNumbers = this.oDocument.getElementById(this.getID()+'LineNumbers');
		if (_iSizeX != null)
		{
			if (_oTextArea) {_oTextArea.style.width = _iSizeX+'px';}
			if (_oFormatedText) {_oFormatedText.style.width = _iSizeX+'px';}
		}
		if (_iSizeY != null)
		{
			if (_oTextArea) {_oTextArea.style.height = _iSizeY+'px';}
			if (_oFormatedText) {_oFormatedText.style.height = _iSizeY+'px';}
			if (_oLineNumbers) {_oLineNumbers.style.height = _iSizeY+'px';}
		}
	}
	/* @end method */
	
	/* @start method */
	this.updateFormatedText = function()
	{
		// this.onTextChange();
		// this.onScroll();
		//this.updateText();
		this.oWindow.setTimeout("oPGCodeEditor.updateFormatedText()", 500);
	}
	/* @end method */
	
	/* @start method */
	this.updateTextRange = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			if (typeof(_oTextArea.selectionStart) != 'undefined')
			{
				this.iTextStartSelection = _oTextArea.selectionStart;
				this.iTextEndSelection = _oTextArea.selectionEnd;
				this.sTextSelection = _oTextArea.value.substring(this.iTextStartSelection, this.iTextEndSelection);
			}
			else if (typeof(this.oDocument.selection) != 'undefined')
			{
				this.oTextRange = this.oDocument.selection.createRange();
				this.oTextRangeType = this.oDocument.selection.type;
			}
			else {alert('this feature is not supported with your browser!');}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	*/
	this.insertText = function(_sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			var _iOldScrollLeft = parseInt(_oTextArea.scrollLeft);
			var _iOldScrollTop = parseInt(_oTextArea.scrollTop);
			if (typeof(_oTextArea.selectionStart) != 'undefined')
			{
				if ((!isNaN(this.iTextStartSelection)) || (this.sTextSelection != '') || (!isNaN(this.iTextEndSelection)))
				{
					var _iNewPos = 0;
					var _sSelectedText = this.sTextSelection;
					var _iStartPos = 0;
					var _iEndPos = 0;
					
					_iStartPos = this.iTextStartSelection;
					_iEndPos = this.iTextEndSelection;
					if (isNaN(_iEndPos)) {_iEndPos = _iStartPos;}
					else if (_iEndPos < _iStartPos) {_iEndPos = _iStartPos;}
					
// this.oDocument.getElementById("debug").innerHTML = this.iTextStartSelection+' - '+this.iTextEndSelection;
					_oTextArea.value = _oTextArea.value.substr(0, _iStartPos)+_sText+_oTextArea.value.substr(_iEndPos);
					_iNewPos = _iStartPos + _sText.length;
					_oTextArea.selectionStart = _iNewPos;
					_oTextArea.selectionEnd = _iNewPos;
					if (_sText == "\t") {_oTextArea.scrollLeft = _iOldScrollLeft + this.iTabWidth;}
					else {_oTextArea.scrollLeft = _iOldScrollLeft + (_sText.length * this.iCharacterWidth);}
					_oTextArea.scrollTop = _iOldScrollTop;
				}
				else {_oTextArea.value += _sText;}
			}
			else if (typeof(this.oDocument.selection) != 'undefined')
			{
				if (this.oTextRange)
				{
					var _sSelectedText = this.oTextRange.text;
					this.oTextRange.text = _sText;
					// if (_sSelectedText.length == 0) {this.oTextRange.moveStart('character', _sText.length-1);}
					if (_sSelectedText.length == 0) {this.oTextRange.moveStart('character', -_sText.length);}
					else {this.oTextRange.moveStart('character', _sText.length + _sSelectedText.length);}
					this.oTextRange.select();
				}
				else {_oTextArea.value += _sText;}
			}
			
			// this.addUndoText(_oTextArea.value);
// 			_oTextArea.focus();
			// this.updateTextRange();
		}
	}
	/* @end method */
	
	// http://aktuell.de.selfhtml.org/artikel/javascript/bbcode/
	/*
	@start method
	
	@param sStartText [needed][type]string[/type]
	[en]...[/en]
	
	@param sEndText [needed][type]string[/type]
	[en]...[/en]
	*/
	this.encloseText = function(_sStartText, _sEndText)
	{
		if (typeof(_sStartText) == 'undefined') {var _sStartText = null;}
		if (typeof(_sEndText) == 'undefined') {var _sEndText = null;}
		
		_sEndText = this.getRealParameter({'oParameters': _sStartText, 'sName': 'sEndText', 'xParameter': _sEndText});
		_sStartText = this.getRealParameter({'oParameters': _sStartText, 'sName': 'sStartText', 'xParameter': _sStartText});
		
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			if (typeof(_oTextArea.selectionStart) != 'undefined')
			{
				if ((!isNaN(this.iTextStartSelection)) || (this.sTextSelection != '') || (!isNaN(this.iTextEndSelection)))
				{
					var _iPos = 0;
					var _sSelectedText = this.sTextSelection;
					_oTextArea.value = _oTextArea.value.substr(0, this.iTextStartSelection)+_sStartText+_sText+_sEndText+_oTextArea.value.substr(this.iTextEndSelection);
					if (_sSelectedText.length == 0) {_iPos = this.iTextStartSelection + _sStartText.length;}
					else {_iPos = this.iTextStartSelection + _sStartText.length + _sText.length + _sEndText.length;}
					_oTextArea.selectionStart = _iPos;
					_oTextArea.selectionEnd = _iPos;
					_oTextArea.focus();
				}
				else {_oTextArea.value += _sText;}
			}
			else if (typeof(this.oDocument.selection) != 'undefined')
			{
				if (this.oTextRange)
				{
					var _sSelectedText = this.oTextRange.text;
					this.oTextRange.text = _sStartText+_sText+_sEndText;
					if (_sSelectedText.length == 0) {this.oTextRange.move('character', -_sStartText.length);}
					else {this.oTextRange.moveStart('character', _sStartText.length + _sSelectedText.length + _sEndText.length);}
					this.oTextRange.select();
					_oTextArea.focus();
				}
				else {_oTextArea.value += _sText;}
			}
			// this.addUndoText(_oTextArea.value);
		}
	}
	/* @end method */
	
	/* @start method */
	this.activateHighlighting = function()
	{
		this.bHighlight = true;
		this.updateText();
	}
	/* @end method */
	
	/* @start method */
	this.deactivateHighlighting = function()
	{
		this.hideFormatedText();
		this.bHighlight = false;
	}
	/* @end method */
	
	/* @start method */
	this.initKeyBindings = function()
	{
		if (typeof(oPGKeyHandler) != 'undefined')
		{
			oPGKeyHandler.bindKeys({'xKey1': PG_KEYCODE_TAB, 'xKey2': null, 'xKey3': null, 'xFunction': 'oPGCodeEditor.insertTab();'});
		}
	}
	/* @end method */

	/*
	@start method
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addUndoText = function(_sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});
		
		if (_sText != this.asUndoText[this.iCurrentUndo])
		{
			if (this.iCurrentUndo >= this.iUndoMaxCount-1)
			{
				for (var i=0; i<this.iUndoMaxCount-1; i++)
				{
					this.asUndoText[i] = this.asUndoText[i+1];
				}
			}
			this.asUndoText[this.iCurrentUndo] = _sText;
			if (this.iCurrentUndo < this.iUndoMaxCount-1) {this.iCurrentUndo++;}
		}
	}
	/* @end method */

	/* @start method */
	this.insertTab = function()
	{
		this.insertText("\t");
		// this.insertText("	");
	}
	/* @end method */
	
	/* @start method */
	this.updateLineNumbers = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if ((_oTextArea) && (_oTextArea))
		{
			var _oLineNumbers = this.oDocument.getElementById(this.getID()+'LineNumbers');
			if (_oLineNumbers) {_oLineNumbers.scrollTop = parseInt(_oTextArea.scrollTop);}
		}
	}
	/* @end method */
	
	/* @start method */
	this.updateText = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			var _oFormatedText = this.oDocument.getElementById(this.getID()+'FormatedText');
			if ((typeof(oPGGFX) != 'undefined') && (_oFormatedText))
			{
				// _oFormatedText.innerHTML = '<code style="margin:0px; padding:0px; '+this.sCssFormation+' color:red;">'+_oTextArea.value.replace(/</ig, '&lt;').replace(/>/ig, '&gt;')+'\n</code>';
				// _oFormatedText.innerHTML = this.highlightCode(_oTextArea.value.replace(/</ig, '&lt;').replace(/>/ig, '&gt;')+'\n');
				
				if (this.bHighlight == true)
				{
					var _sCode = _oTextArea.value.replace(/</ig, '&lt;').replace(/>/ig, '&gt;')+'\n';
					if ((this.bHighlight == true) && (typeof(oPGCodeHighlighter) != 'undefined')) {_sCode = oPGCodeHighlighter.highlight(_sCode);}
					
					var _sFormatedText = '';
					_sFormatedText += '<code style="margin:0px; padding:0px; '+this.sCssFormation+' white-space:pre;">';
					_sFormatedText += _sCode;
					_sFormatedText += '</code>';
					
					_oFormatedText.innerHTML = _sFormatedText;
					this.showFormatedText();
					// _oFormatedText.scrollTop = parseInt(_oTextArea.scrollTop);
					// _oFormatedText.scrollLeft = parseInt(_oTextArea.scrollLeft);
				}
			}
			
			this.updateLineNumbers();
			this.onScroll();
		}
	}
	/* @end method */
	
	/* @start method */
	this.showFormatedText = function()
	{
		if (this.bHighlight == true)
		{
			var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
			var _oFormatedText = this.oDocument.getElementById(this.getID()+'FormatedText');
			if ((typeof(oPGGFX) != 'undefined') && (_oTextArea) && (_oFormatedText))
			{
				oPGGfx.setElementOpacity({'xElement': _oTextArea, 'iPercent': 20});
				_oFormatedText.style.display = 'block';
			}
		}
	}
	/* @end method */
	
	/* @start method */
	this.hideFormatedText = function()
	{
		if (this.bHighlight == true)
		{
			var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
			var _oFormatedText = this.oDocument.getElementById(this.getID()+'FormatedText');
			if ((typeof(oPGGFX) != 'undefined') && (_oTextArea) && (_oFormatedText))
			{
				oPGGfx.setElementOpacity({'xElement': _oTextArea, 'iPercent': 100});
				_oFormatedText.style.display = 'none';
			}
		}
	}
	/* @end method */
	
	/* @start method */
	this.onCodeEditorFocus = function()
	{
		this.bFocused = true;
		// document.getElementById('debug').innerHTML = 'focused = true';
	}
	/* @end method */
	
	/* @start method */
	this.onCodeEditorBlur = function()
	{
		this.bFocused = false;
		// document.getElementById('debug').innerHTML = 'focused = false';
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onTextChange = function(_oEvent)
	{
		// if (this.oKeyUpTimeout) {this.oWindow.clearTimeout(this.oKeyUpTimeout); this.oKeyUpTimeout = null;}
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			if (_oTextArea.value != this.asUndoText[this.iCurrentUndo])
			{
				this.addUndoText(_oTextArea.value);
				this.updateText();
				// _oTextArea.focus();
			}
		}
	}
	/* @end method */
	
	/* @start method */
	this.onScroll = function()
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			if (this.bHighlight == true)
			{
				var _oFormatedText = this.oDocument.getElementById(this.getID()+'FormatedText');
				if (_oFormatedText)
				{
					_oFormatedText.scrollTop = parseInt(_oTextArea.scrollTop);
					_oFormatedText.scrollLeft = parseInt(_oTextArea.scrollLeft);
				}
			}
			
			this.updateLineNumbers();
		}
	}
	/* @end method */
	
	/*
	this.onMouseMove = function(_oEvent)
	{
		if ((oPGMouse.isMouseLeftDown()) && (this.bFocused == true))
		{
			// this.onScroll();
		}
	}
	*/
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseScrollWheel = function(_oEvent)
	{
		// this.onScroll();
		this.hideFormatedText();
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseUp = function(_oEvent)
	{
		if (this.bFocused == true)
		{
			this.updateTextRange();
			this.updateText();
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseDown = function(_oEvent)
	{
		if (this.bFocused == true)
		{
			// if (oPGMouse.isMouseLeftDown()) {this.onScroll();}
			this.hideFormatedText();
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onKeyDown = function(_oEvent)
	{
		if (this.bFocused == true)
		{
			this.hideFormatedText();
			if (this.oKeyUpTimeout) {this.oWindow.clearTimeout(this.oKeyUpTimeout); this.oKeyUpTimeout = null;}
			if (typeof(oPGKeyHandler) != 'undefined') {return oPGKeyHandler.execBinding(_oEvent);}
			return false;
		}
	}
	/* @end method */
	
	/* @start method */
	this.onKeyUpTimeout = function()
	{
		this.updateTextRange();
		this.updateText();
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onKeyUp = function(_oEvent)
	{
		var _oTextArea = this.oDocument.getElementById(this.getID()+'TextArea');
		if (_oTextArea)
		{
			if (this.bFocused == true)
			{
				// if (typeof(this.oDocument.selection) != 'undefined') {alert('test1');}
				if (typeof(_oTextArea.selectionStart) != 'undefined') {this.updateTextRange();}
				if (this.iUpdateFormatedTextTimeout > 0)
				{
					if (this.oKeyUpTimeout == null)
					{
						this.oKeyUpTimeout = this.oWindow.setTimeout("oPGCodeEditor.onKeyUpTimeout()", this.iUpdateFormatedTextTimeout);
					}
				}
				else {this.onKeyUpTimeout();}
				if (typeof(oPGKeyHandler) != 'undefined') {return oPGKeyHandler.onKeyUp(_oEvent);}
				return false;
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_CodeEditor.prototype = new classPG_ClassBasics();
var oPGCodeEditor = new classPG_CodeEditor();
