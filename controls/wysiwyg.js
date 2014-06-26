/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
function classPG_Wysiwyg()
{
	// Declarations...
	this.sColorPickerRichEditCommand = 'foreground';
	this.sHighlightCssFile = 'wysiwyg_highlighting.css';
	this.sTemplate = '<!DOCTYPE html><html><head><title>wysiwyg</title><meta http-equiv="content-type" content="text/html; charset=utf-8"><style type="text/css">body {background-color:#ffffff;}</style></head><body style="margin:0px;">[wysiwyg_content]</body></html>';
	this.oSelection = null;

	this.oSelectionTable = null;
	this.oSelectionTR = null;
	this.oSelectionTD = null;
	this.oSelectionParent = null;
	
	// Construct...
	this.initClassBasics();
	if (typeof(classPG_Selection) != 'undefined')
	{
		this.oSelection = new classPG_Selection();
	}
	
	// Methods...
	this.bindEvents = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		oPGEventManager.addEvent(
			{
				'oObject': this.oDocument, 
				'sEventType': PG_EVENTTYPE_ONRELEASE, 
				'fFunction': function(_oEvent) {oPGWysiwyg.checkSelection({'sWysiwygID': _sWysiwygID, 'bIframe': false, 'oEvent': _oEvent});}
			}
		);
		
		oPGEventManager.addEvent(
			{
				'oObject': this.oDocument, 
				'sEventType': PG_EVENTTYPE_ONKEYUP, 
				'fFunction': function(_oEvent) {oPGWysiwyg.checkSelection({'sWysiwygID': _sWysiwygID, 'bIframe': false, 'oEvent': _oEvent});}
			}
		);
	}

	this.checkSelection = function(_sWysiwygID, _bIframe, _oEvent)
	{
		if (typeof(_bIframe) == 'undefined') {var _bIframe = null;}
	
		_bIframe = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bIframe', 'xParameter': _bIframe});
		_oEvent = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'oEvent', 'xParameter': _oEvent});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (!_oEvent) {_oEvent = this.oWindow.event;}
		
		if (this.oSelection != null)
		{
			// Selection...
			var _oEditor = null;
			if (_bIframe == true)
			{
				var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
				if (_oEditorIframeDocument) {this.oSelection.oDocument = _oEditorIframeDocument;}
				// _oEditor = _oEditorIframeDocument.body;
			}
			else
			{
				this.oSelection.oDocument = this.oDocument;
				_oEditor = this.oDocument.getElementById(_sWysiwygID+'EditorTextarea');
			}

			this.oSelection.bIsText = (!_bIframe);
			var _aoNodes = this.oSelection.checkRange(_oEditor);

			// ContextMenu...
			var _bShowContextMenu = false;
			/*
			if (!_oEvent) {_oEvent = window.event;}
			if (_oEvent)
			{
				if (_oEvent.button) {if (_oEvent.button == 2) {_bShowContextMenu = true}}
				if (_oEvent.type) {if (_oEvent.type == "contextmenu") {_bShowContextMenu = true;}}
				else if (_oEvent.which) {if (_oEvent.which == 3) {_bShowContextMenu = true;}}
			}
			*/
			//if (_bShowContextMenu == true)
			// {
				if (_bIframe == true)
				{
					this.oSelectionParent = this.oSelection.getParentNode({'oRange': this.oSelection['oRange'], 'sSelectionType': this.oSelection['sSelectionType']});
					var _oTD = this.oSelection.isRangeInNode({'oRange': this.oSelection['oRange'], 'sNodeName': 'TD', 'sSelectionType': this.oSelection['sSelectionType']});
					if (_oTD)
					{
						/*
						var _iCategoryID = oPGContextMenu.addCategory({'sName': 'Tabelle - Zelle'});
						// oPGContextMenu.addMenuPoint();
						oPGContextMenu.setID({'sID': _sWysiwygID+'ContextMenu'});
						oPGContextMenu.buildInto({'xContainer': 'testArea', 'sContextMenuID': _sWysiwygID+'ContextMenu', 'iZIndex': null});
						oPGContextMenu.show();
						oPGContextMenu.setPos(oPGMouse.getPosX(), oPGMouse.getPosY());
						*/
						this.oSelectionTD = _oTD;
						
						var _oTR = this.oSelection.isRangeInNode({'oRange': this.oSelection['oRange'], 'sNodeName': 'TR', 'sSelectionType': this.oSelection['sSelectionType']});
						if (_oTR) {this.oSelectionTR = _oTR;}
						
						var _oTable = this.oSelection.isRangeInNode({'oRange': this.oSelection['oRange'], 'sNodeName': 'TABLE', 'sSelectionType': this.oSelection['sSelectionType']});
						if (_oTable) {this.oSelectionTable = _oTable;}
					}
				}
			// }
			
			// StatusBar...
			if (_aoNodes)
			{
				var _sNodes = '';
				for (var i=0; i<_aoNodes.length; i++)
				{
					_sNodes += ' > '+_aoNodes[i].nodeName;
				}
				var _oStatusBar = this.oDocument.getElementById(_sWysiwygID+'EditorStatusBarNodes');
				if (_oStatusBar) {_oStatusBar.innerHTML = _sNodes;}
			}
		}
	}
	
	this.getIframeDocument = function(_xIframe)
	{
		_xIframe = this.getRealParameter({'oParameters': _xIframe, 'sName': 'xIframe', 'xParameter': _xIframe});
		
		if (typeof(_xIframe) == 'string')
		{
			var _oEditorIframe = this.oDocument.getElementById(_xIframe);
			if (_oEditorIframe.contentDocument) {return _oEditorIframe.contentDocument;}
			else
			{
				if (this.oDocument.frames)
				{
					if (typeof(this.oDocument.frames[_xIframe]) != 'undefined')
					{
						var _oFrame = this.oDocument.frames[_xIframe];
						if (_oFrame.contentWindow) {return _oFrame.contentWindow;}
						return _oFrame.document;
					}
				}
			}
		}
		else if (typeof(_xIframe) == 'object')
		{
			if (_xIframe.contentDocument) {return _xIframe.contentDocument;}
			if (_xIframe.contentWindow) {return _xIframe.contentWindow;}
			if (_xIframe.document) {return _xIframe.document;}
			return _xIframe;
		}
		return null;
	}
	
	this.focusIframe = function(_xIframe)
	{
		var _oEditorIframe = null;
		if (typeof(_xIframe) == 'string') {_oEditorIframe = this.oDocument.getElementById(_xIframe);}
		else if (typeof(_xIframe) == 'object') {_oEditorIframe = _xIframe;}
		if (_oEditorIframe)
		{
			if (typeof(_oEditorIframe.contentWindow) != 'undefined') {_oEditorIframe.contentWindow.focus();}
		}
	}

	this.setEditMode = function(_sWysiwygID, _bEditable)
	{
		if (typeof(_bEditable) == 'undefined') {var _bEditable = null;}
	
		_bEditable = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bEditable', 'xParameter': _bEditable});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (_bEditable == null) {_bEditable = true;}

		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			if (_oEditorIframeDocument.contentEditable) {_oEditorIframeDocument.contentEditable = _bEditable;}
			else {if (_bEditable == true) {_oEditorIframeDocument.designMode = 'on';} else {_oEditorIframeDocument.designMode = 'off';}}
		}
		
		var _oEditorTextarea = this.oDocument.getElementById(_sWysiwygID+'EditorTextarea');
		if (_oEditorTextarea) {_oEditorTextarea.disabled = (!_bEditable);}
	}
	
	this.setTemplate = function(_sTemplate)
	{
		_sTemplate = this.getRealParameter({'oParameters': _sTemplate, 'sName': 'sTemplate', 'xParameter': _sTemplate});
		this.sTemplate = _sTemplate;
	}
	
	this.richEdit = function(_sWysiwygID, _sCommand, _sExpression, _bShowUI)
	{
		if (typeof(_sCommand) == 'undefined') {var _sCommand = null;}
		if (typeof(_sExpression) == 'undefined') {var _sExpression = null;}
		if (typeof(_bShowUI) == 'undefined') {var _bShowUI = null;}
		
		_sCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sCommand', 'xParameter': _sCommand});
		_sExpression = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sExpression', 'xParameter': _sExpression});
		_bShowUI = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bShowUI', 'xParameter': _bShowUI});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		if (_bShowUI == null) {_bShowUI = false;}
		
		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			this.focusIframe({'xIframe': _sWysiwygID+'EditorIframe'});
			try
			{
				_oEditorIframeDocument.execCommand(_sCommand, _bShowUI, _sExpression);
			}
			catch(_oError)
			{
				alert(_oError);
			}
		}
	}
	
	this.onInsertImagePress = function(_sWysiwygID, _sRichEditCommand)
	{
		if (typeof(_sRichEditCommand) == 'undefined') {var _sRichEditCommand = null;}

		_sRichEditCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sRichEditCommand', 'xParameter': _sRichEditCommand});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oInsertImage = this.oDocument.getElementById(_sWysiwygID+'InsertImage');
		var _oButton = this.oDocument.getElementById(_sWysiwygID+'Button'+_sRichEditCommand);
		if ((_oInsertImage) && (_oButton))
		{
			_oInsertImage.style.display = 'inline-block';
			_oInsertImage.style.left = oPGBrowser.getDocumentOffsetX({'xElement': _oButton})+'px';
			_oInsertImage.style.top = (oPGBrowser.getDocumentOffsetY({'xElement': _oButton})+_oButton.offsetHeight)+'px';
		}
	}
	
	this.onInsertImageAccept = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _sImage = this.getInsertImageSrc({'sWysiwygID': _sWysiwygID});
		var _oPupupCheckbox = this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupCheckbox');
		if (_oPupupCheckbox)
		{
			if (_oPupupCheckbox.checked == true)
			{
				var _sUrl = this.getInsertImagePopupUrl({'sWysiwygID': _sWysiwygID});
				var _iSizeX = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupSizeX').value);
				var _iSizeY = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupSizeY').value);
				
				if (_sUrl == '') {_sUrl = _sImage;}
				if (_iSizeX < 1) {_iSizeX = 500;}
				if (_iSizeY < 1) {_iSizeY = 350;}
				
				var _sContent = '';
				_sContent += '<a href="javascript:;" target="_self" onclick="';
				_sContent += 'oPGPopup.setSize({\'sPopupID\': \''+_sWysiwygID+'Popup\', \'iSizeX\': '+_iSizeX+', \'iSizeY\': '+_iSizeY+'}); ';
				_sContent += 'oPGPopup.setContent({\'sPopupID\': \''+_sWysiwygID+'Popup\', \'sContent\': \'<img src=\\\''+_sUrl+'\\\' />\'}); ';
				_sContent += 'oPGPopup.show({\'sPopupID\': \''+_sWysiwygID+'Popup\'}); ';
				_sContent += '">';
				_sContent += '<img src="'+_sImage+'" style="border:0;" />';
				_sContent += '</a>';
				
				this.oSelection.setContent({'sContent': _sContent});
				return;
			}
		}
		if (_sImage) {this.richEdit({'sWysiwygID': _sWysiwygID, 'sCommand': 'insertimage', 'sExpression': _sImage});}
	}
	
	this.onInsertImageClose = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oInsertImage = this.oDocument.getElementById(_sWysiwygID+'InsertImage');
		if (_oInsertImage) {_oInsertImage.style.display = 'none';}
	}
	
	this.previewInsertImagePopup = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		var _sImage = this.getInsertImageSrc({'sWysiwygID': _sWysiwygID});
		var _sUrl = this.getInsertImagePopupUrl({'sWysiwygID': _sWysiwygID});
		var _iSizeX = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupSizeX').value);
		var _iSizeY = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupSizeY').value);
		
		if (_sUrl == '') {_sUrl = _sImage;}
		if (_iSizeX < 1) {_iSizeX = 500;}
		if (_iSizeY < 1) {_iSizeY = 350;}
		
		oPGPopup.setSize({'sPopupID': _sWysiwygID+'Popup', 'iSizeX': _iSizeX, 'iSizeY': _iSizeY});
		oPGPopup.setContent({'sPopupID': _sWysiwygID+'Popup', 'sContent': '<img src="'+_sUrl+'" />'});
		oPGPopup.show({'sPopupID': _sWysiwygID+'Popup'});
	}
	
	this.setInsertImageSrc = function(_sWysiwygID, _sImage)
	{
		if (typeof(_sImage) == 'undefined') {var _sImage = null;}
		
		_sImage = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sImage', 'xParameter': _sImage});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (_sImage == null) {_sImage = '';}
		
		var _oInsertImage = this.oDocument.getElementById(_sWysiwygID+'InsertImageSrc');
		if (_oInsertImage) {_oInsertImage.value = _sImage;}
	}
	
	this.getInsertImageSrc = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oInsertImage = this.oDocument.getElementById(_sWysiwygID+'InsertImageSrc');
		if (_oInsertImage) {return _oInsertImage.value;}
		return null;
	}
	
	this.setInsertImagePopupUrl = function(_sWysiwygID, _sUrl)
	{
		if (typeof(_sUrl) == 'undefined') {var _sUrl = null;}
		
		_sUrl = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sUrl', 'xParameter': _sUrl});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (_sUrl == null) {_sUrl = '';}
		
		var _oInsertImagePopupUrl = this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupUrl');
		if (_oInsertImagePopupUrl) {_oInsertImagePopupUrl.value = _sUrl;}
	}
	
	this.getInsertImagePopupUrl = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oInsertImagePopupUrl = this.oDocument.getElementById(_sWysiwygID+'InsertImagePopupUrl');
		if (_oInsertImagePopupUrl) {return _oInsertImagePopupUrl.value;}
		return null;
	}
	
	this.onCreateLinkPress = function(_sWysiwygID, _sRichEditCommand)
	{
		if (typeof(_sRichEditCommand) == 'undefined') {var _sRichEditCommand = null;}

		_sRichEditCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sRichEditCommand', 'xParameter': _sRichEditCommand});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oCreateLink = this.oDocument.getElementById(_sWysiwygID+'CreateLink');
		var _oButton = this.oDocument.getElementById(_sWysiwygID+'Button'+_sRichEditCommand);
		if ((_oCreateLink) && (_oButton))
		{
			_oCreateLink.style.display = 'inline-block';
			_oCreateLink.style.left = oPGBrowser.getDocumentOffsetX({'xElement': _oButton})+'px';
			_oCreateLink.style.top = (oPGBrowser.getDocumentOffsetY({'xElement': _oButton})+_oButton.offsetHeight)+'px';
		}
	}
	
	this.onCreateLinkAccept = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		var _oCreateLinkHref = this.oDocument.getElementById(_sWysiwygID+'CreateLinkHref');
		if (_oCreateLinkHref)
		{
			this.richEdit({'sWysiwygID': _sWysiwygID, 'sCommand': 'createlink', 'sExpression': _oCreateLinkHref.value});
			var _oCreateLinkTarget = this.oDocument.getElementById(_sWysiwygID+'CreateLinkTarget');
			if ((this.oSelectionParent) && (_oCreateLinkTarget))
			{
				var _sTarget = _oCreateLinkTarget.options[_oCreateLinkTarget.selectedIndex].value;
				var _oSelectionParent = this.oSelectionParent;
				if (_oSelectionParent.nodeName.toLowerCase() == '#text') {_oSelectionParent = _oSelectionParent.parentNode;}
				var _aoLinks = _oSelectionParent.getElementsByTagName('a');
				if (_aoLinks.length > 0) {_aoLinks[0].target = _sTarget;}
			}
		}
	}
	
	this.onCreateLinkClose = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oCreateLink = this.oDocument.getElementById(_sWysiwygID+'CreateLink');
		if (_oCreateLink) {_oCreateLink.style.display = 'none';}
	}
	
	this.onFontSizePress = function(_sWysiwygID, _sRichEditCommand)
	{
		if (typeof(_sRichEditCommand) == 'undefined') {var _sRichEditCommand = null;}
	
		_sRichEditCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sRichEditCommand', 'xParameter': _sRichEditCommand});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oFontSizeSelection = this.oDocument.getElementById(_sWysiwygID+'FontSizeSelection');
		var _oButton = this.oDocument.getElementById(_sWysiwygID+'Button'+_sRichEditCommand);
		if ((_oFontSizeSelection) && (_oButton))
		{
			_oFontSizeSelection.style.display = 'inline-block';
			_oFontSizeSelection.style.left = oPGBrowser.getDocumentOffsetX({'xElement': _oButton})+'px';
			_oFontSizeSelection.style.top = (oPGBrowser.getDocumentOffsetY({'xElement': _oButton})+_oButton.offsetHeight)+'px';
		}
	}
	
	this.onFontSizeAccept = function(_sWysiwygID, _iFontSize, _sFontSize)
	{
		if (typeof(_iFontSize) == 'undefined') {var _iFontSize = null;}
		if (typeof(_sFontSize) == 'undefined') {var _sFontSize = null;}
	
		_iFontSize = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'iFontSize', 'xParameter': _iFontSize});
		_sFontSize = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sFontSize', 'xParameter': _sFontSize});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		this.richEdit({'sWysiwygID': _sWysiwygID, 'sCommand': 'fontsize', 'sExpression': _iFontSize});
		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			var _aoFontElements = _oEditorIframeDocument.getElementsByTagName('font');
			for (var i=0; i<_aoFontElements.length; i++)
			{
				if (_aoFontElements[i].size == _iFontSize)
				{
					_aoFontElements[i].removeAttribute('size');
					_aoFontElements[i].style.fontSize = _sFontSize;
				}
			}
		}
		
		var _oFontSizeSelection = this.oDocument.getElementById(_sWysiwygID+'FontSizeSelection');
		if (_oFontSizeSelection) {_oFontSizeSelection.style.display = 'none';}
	}
	
	this.onFontSizeAbort = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oFontSizeSelection = this.oDocument.getElementById(_sWysiwygID+'FontSizeSelection');
		if (_oFontSizeSelection) {_oFontSizeSelection.style.display = 'none';}
	}
	
	this.onColorPress = function(_sWysiwygID, _sRichEditCommand)
	{
		if (typeof(_sRichEditCommand) == 'undefined') {var _sRichEditCommand = null;}
	
		_sRichEditCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sRichEditCommand', 'xParameter': _sRichEditCommand});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		if (_sRichEditCommand == null) {_sRichEditCommand = 'forecolor';}
		
		var _oColorPicker = this.oDocument.getElementById(_sWysiwygID+'ColorPicker');
		var _oButton = this.oDocument.getElementById(_sWysiwygID+'Button'+_sRichEditCommand);
		if ((_oColorPicker) && (_oButton))
		{
			this.sColorPickerRichEditCommand = _sRichEditCommand;
			oPGColorPicker.show({'sPickerID': _sWysiwygID+'ColorPicker'});
			_oColorPicker.style.left = oPGBrowser.getDocumentOffsetX({'xElement': _oButton})+'px';
			_oColorPicker.style.top = (oPGBrowser.getDocumentOffsetY({'xElement': _oButton})+_oButton.offsetHeight)+'px';
		}
	}
	
	this.onColorPickerAccept = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _sColor = oPGColorPicker.getCurrentColorHex({'sPickerID': _sWysiwygID+'ColorPicker'});
		this.richEdit({'sWysiwygID': _sWysiwygID, 'sCommand': this.sColorPickerRichEditCommand, 'sExpression': _sColor});
		oPGColorPicker.hide({'sPickerID': _sWysiwygID+'ColorPicker'});
	}
	
	this.onColorPickerAbort = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		oPGColorPicker.hide({'sPickerID': _sWysiwygID+'ColorPicker'});
	}
	
	this.onInsertTablePress = function(_sWysiwygID, _sRichEditCommand)
	{
		if (typeof(_sRichEditCommand) == 'undefined') {var _sRichEditCommand = null;}

		_sRichEditCommand = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sRichEditCommand', 'xParameter': _sRichEditCommand});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oInsertTable = this.oDocument.getElementById(_sWysiwygID+'InsertTable');
		var _oButton = this.oDocument.getElementById(_sWysiwygID+'Button'+_sRichEditCommand);
		if ((_oInsertTable) && (_oButton))
		{
			_oInsertTable.style.display = 'inline-block';
			_oInsertTable.style.left = oPGBrowser.getDocumentOffsetX({'xElement': _oButton})+'px';
			_oInsertTable.style.top = (oPGBrowser.getDocumentOffsetY({'xElement': _oButton})+_oButton.offsetHeight)+'px';
		}
	}
	
	this.onInsertTableAccept = function(_sWysiwygID, _iCellsCountX, _iCellsCountY)
	{
		_iCellsCountX = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'iCellsCountX', 'xParameter': _iCellsCountX});
		_iCellsCountY = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'iCellsCountY', 'xParameter': _iCellsCountY});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (_iCellsCountX == null) {_iCellsCountX = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertTableCellsCountX').value);}
		if (_iCellsCountY == null) {_iCellsCountY = parseInt(this.oDocument.getElementById(_sWysiwygID+'InsertTableCellsCountY').value);}

		var _sTable = '';
		var _iRow = 0;
		var _iCol = 0;
		
		_sTable += '<table>';
		for (_iRow = 0; _iRow<_iCellsCountY; _iRow++)
		{
			_sTable += '<tr>';
				for (_iCol=0; _iCol<_iCellsCountX; _iCol++)
				{
					_sTable += '<td><br /></td>';
				}
			_sTable += '</tr>';
		}
		_sTable += '</table>';
		this.oSelection.setContent({'sContent': _sTable});
	}
	
	this.onInsertTableClose = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		oPGColorPicker.hide({'sPickerID': _sWysiwygID+'InsertTable'});
	}
	
	this.setContent = function(_sWysiwygID, _sContent)
	{
		_sContent = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sContent', 'xParameter': _sContent});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		_sContent = _sContent.replace('\"', '"');
		
		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			_oEditorIframeDocument.open();
			_oEditorIframeDocument.write(this.sTemplate.replace('[wysiwyg_content]', _sContent));
			_oEditorIframeDocument.close();
			this.oWindow.setTimeout("oPGWysiwyg.bindIframeEvents({'sWysiwygID': '"+_sWysiwygID+"'})", 1500);
		}
		
		var _oEditorTextarea = this.oDocument.getElementById(_sWysiwygID+'EditorTextarea');
		if (_oEditorTextarea) {_oEditorTextarea.value = _sContent;}
	}
	
	this.bindIframeEvents = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			oPGEventManager.addEvent(
				{
					'oObject': _oEditorIframeDocument, 
					'sEventType': PG_EVENTTYPE_ONRELEASE, 
					'fFunction': function(_oEvent)
					{
						oPGWysiwyg.checkSelection({'sWysiwygID': _sWysiwygID, 'bIframe': true, 'oEvent': _oEvent});
						// return oPGContextMenu.onRelease({'oEvent': _oEvent});
					}
				}
			);
			
			/*oPGEventManager.addEvent(
				{
					'oObject': _oEditorIframeDocument, 
					'sEventType': PG_EVENTTYPE_ONCONTEXTMENU, 
					'fFunction': function(_oEvent) {return oPGContextMenu.onContextMenu({'oEvent': _oEvent});}
				}
			);*/
			
			oPGEventManager.addEvent(
				{
					'oObject': _oEditorIframeDocument, 
					'sEventType': PG_EVENTTYPE_ONKEYUP, 
					'fFunction': function(_oEvent)
					{
						oPGWysiwyg.checkSelection({'sWysiwygID': _sWysiwygID, 'bIframe': true, 'oEvent': _oEvent});
					}
				}
			);
		}
	}
	
	this.getContent = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		var _oEditorTextarea = this.oDocument.getElementById(_sWysiwygID+'EditorTextarea');

		var _bHtmlMode = false;
		if (_oEditorTextarea.style.display == 'block') {_bHtmlMode = true;}
		
		if ((_bHtmlMode == false) && (_oEditorIframeDocument)) {if (_oEditorIframeDocument.body) {return _oEditorIframeDocument.body.innerHTML;} return _oEditorIframeDocument.innerHTML;}
		if ((_bHtmlMode == true) && (_oEditorTextarea)) {return _oEditorTextarea.value;}
		return null;
	}

	this.switchDisplayMode = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _sStyle = '';
		var _oEditorIframeDocument = this.getIframeDocument({'xIframe': _sWysiwygID+'EditorIframe'});
		if (_oEditorIframeDocument)
		{
			var _bIsIncluded = false;
			oPGCssLoader.oDocument = _oEditorIframeDocument;
			oPGNodes.oDocument = _oEditorIframeDocument;
			if (!oPGCssLoader.removeIncluded({'sIncludeID': _sWysiwygID+'DisplayModeCss'}))
			{
				oPGCssLoader.include({'sIncludeID': _sWysiwygID+'DisplayModeCss', 'sFile': this.getGfxPathCss({'sFile': this.sHighlightCssFile}), 'bAsync': true});
			}
			oPGCssLoader.oDocument = document;
			oPGNodes.oDocument = document;
		}
	}
	
	this.switchEditMode = function(_sWysiwygID)
	{
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oEditorIframe = this.oDocument.getElementById(_sWysiwygID+'EditorIframe');
		var _oEditorTextarea = this.oDocument.getElementById(_sWysiwygID+'EditorTextarea');
		if ((_oEditorIframe) && (_oEditorTextarea))
		{
			var _bHtmlMode = true;
			if (_oEditorTextarea.style.display == 'block') {_bHtmlMode = false;}
			
			var _sContent = this.getContent({'sWysiwygID': _sWysiwygID});
			
			if (_bHtmlMode == true) {_oEditorTextarea.style.display = 'block';}
			else {_oEditorIframe.style.display = 'block';}
			
			this.setContent({'sWysiwygID': _sWysiwygID, 'sContent': _sContent});
			
			if (_bHtmlMode == true) {_oEditorIframe.style.display = 'none';}
			else {_oEditorTextarea.style.display = 'none';}
		}
	}
	
	this.addSize = function(_sWysiwygID, _iSizeX, _iSizeY)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = null;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}

		_iSizeX = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oEditorContainer = this.oDocument.getElementById(_sWysiwygID+'EditorContainer');
		if (_oEditorContainer)
		{
			if (_iSizeX != null)
			{
				if (parseInt(_oEditorContainer.offsetWidth)+_iSizeX < 0) {_oEditorContainer.style.width = '0px';}
				else {_oEditorContainer.style.width = (parseInt(_oEditorContainer.offsetWidth)+_iSizeX)+'px';}
			}
			if (_iSizeY != null)
			{
				if (parseInt(_oEditorContainer.offsetHeight)+_iSizeY < 0) {_oEditorContainer.style.height = '0px;';}
				else {_oEditorContainer.style.height = (parseInt(_oEditorContainer.offsetHeight)+_iSizeY)+'px';}
			}
		}
	}

	this.buildEditorInto = function(_sWysiwygID, _bEditable, _bHtmlMode, _sSourceFile, _sSourceCode)
	{
		if (typeof(_bEditable) == 'undefined') {var _bEditable = null;}
		if (typeof(_sSourceFile) == 'undefined') {var _sSourceFile = null;}
		if (typeof(_bHtmlMode) == 'undefined') {var _bHtmlMode = null;}
	
		_bEditable = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bEditable', 'xParameter': _bEditable});
		_bHtmlMode = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bHtmlMode', 'xParameter': _bHtmlMode});
		_sSourceFile = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sSourceFile', 'xParameter': _sSourceFile});
		_sSourceCode = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sSourceCode', 'xParameter': _sSourceCode});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		if (_bEditable == null) {_bEditable = true;}
		if (_bHtmlMode == null) {_bHtmlMode = false;}
		
		var _axWysiwygAttributes = {'id': _sWysiwygID+'EditorIframe', 'class': 'wysiwyg_editor_iframe'};
		var _axWysiwygStyles = {
			'width': '100%',
			'height': '100%',
			'padding': '0px',
			'overflow': 'auto'
		};
		
		var _axTextareaAttributes = {'id': _sWysiwygID+'EditorTextarea', 'class': 'wysiwyg_editor_textarea'};
		var _axTextareaStyles = {
			'width': '100%',
			'height': '100%'
		};
		
		if (_sSourceFile != null) {_axWysiwygAttributes['src'] = _sSourceFile;}
		if (_bHtmlMode == true)
		{
			_axWysiwygStyles['display'] = 'none';
			_axTextareaStyles['display'] = 'block';
		}
		else
		{
			_axWysiwygStyles['display'] = 'block';
			_axTextareaStyles['display'] = 'none';
		}

		var _oEditorContainer = this.oDocument.getElementById(_sWysiwygID+'EditorContainer');
		if (_oEditorContainer)
		{
			oPGNodes.buildInto(
				{
					'xIntoParent': _sWysiwygID+'EditorContainer', 
					'sTag': 'iframe', 
					'axAttributes': _axWysiwygAttributes,
					'axStyles': _axWysiwygStyles
				}
			);
			
			oPGNodes.buildInto(
				{
					'xIntoParent': _sWysiwygID+'EditorContainer',
					'sTag': 'textarea',
					'axAttributes': _axTextareaAttributes,
					'axStyles': _axTextareaStyles
				}
			);
			
			if (_sSourceCode != null)
			{
				this.setContent(
					{
						'sWysiwygID': _sWysiwygID,
						'sContent': _sSourceCode
					}
				);
			}
			
			oPGWysiwyg.bindEvents({'sWysiwygID': _sWysiwygID});

			var _sTimeoutFunction = "oPGWysiwyg.setEditMode({'sWysiwygID': '"+_sWysiwygID+"', 'bEditable': ";
			if (_bEditable == true) {_sTimeoutFunction += 'true';} else {_sTimeoutFunction += 'false';}
			_sTimeoutFunction += "})";
			this.oWindow.setTimeout(_sTimeoutFunction, 500);
		}
	}
	
	this.buildInto = function(_xContainer, _sWysiwygID, _bEditable, _bHtmlMode, _sSourceFile, _sSourceCode, _sOnImageOpenClick)
	{
		if (typeof(_bEditable) == 'undefined') {var _bEditable = null;}
		if (typeof(_sSourceFile) == 'undefined') {var _sSourceFile = null;}
		if (typeof(_sOnImageOpenClick) == 'undefined') {var _sOnImageOpenClick = null;}
		if (typeof(_bHtmlMode) == 'undefined') {var _bHtmlMode = null;}
	
		_bEditable = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bEditable', 'xParameter': _bEditable});
		_bHtmlMode = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'bHtmlMode', 'xParameter': _bHtmlMode});
		_sSourceFile = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sSourceFile', 'xParameter': _sSourceFile});
		_sSourceCode = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sSourceCode', 'xParameter': _sSourceCode});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		oPGNodes.buildInto(
			{
				'xIntoParent': _xContainer, 
				'sTag': 'div', 
				'axAttributes': {'id': _sWysiwygID+'ToolbarContainer'},
				'axStyles': null
			}
		);

		oPGNodes.buildInto(
			{
				'xIntoParent': _xContainer, 
				'sTag': 'div', 
				'axAttributes': {'id': _sWysiwygID+'EditorContainer'},
				'axStyles': {'width': '100%', 'height': '500px'}
			}
		);
	}
	
	// Tables...
	this.tableAddRow = function(_sWysiwygID)
	{
		if (!this.oSelectionTR) {return;}
	
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oNewTr = this.oSelectionTR.cloneNode(true);
		if (_oNewTr)
		{
			if ((this.oSelectionTR.nextSibling) && (this.oSelectionTR.parentNode.insertBefore)) {this.oSelectionTR.parentNode.insertBefore(_oNewTr, this.oSelectionTR.nextSibling);}
			else {this.oSelectionTR.parentNode.appendChild(_oNewTr);}
		}
	}
	
	this.tableRemoveRow = function(_sWysiwygID)
	{
		if (!this.oSelectionTR) {return;}
	
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		if (this.oSelectionTR.removeNode) {this.oSelectionTR.removeNode(true);}
		else {this.oSelectionTR.parentNode.removeChild(this.oSelectionTR);}
		this.oSelectionTR = null;
		this.oSelectionTD = null;
		if (this.oSelectionTable)
		{
			if (!this.oSelectionTable.getElementsByTagName("TR").length)
			{
				if (this.oSelectionTable.removeNode) {this.oSelectionTable.removeNode(true);}
				else {this.oSelectionTable.parentNode.removeChild(this.oSelectionTable);}
				this.oSelectionTable = null;
			}
		}
	}
	
	this.tableAddCol = function(_sWysiwygID)
	{
		if (!this.oSelectionTD) {return;}
		
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _iPos;
		var _aoTDs;
		var _oTD = this.oSelectionTD;
		var _iCurrentCol = 0;
		var _sOldBorder = _oTD.style.border;
		for (_iPos = 1; _oTD; _iPos += _oTD.colSpan, _oTD = _oTD.previousSibling);
		var _aoTRs = this.oSelectionTable.getElementsByTagName("TR");
		for (var i = 0; i < _aoTRs.length; ++i)
		{
			_aoTDs = _aoTRs[i].getElementsByTagName("TD");
			_iCurrentCol = 0;
			for (var j = 0; j < _aoTDs.length; ++j)
			{
				_iCurrentCol += _aoTDs[j].colSpan;
				if ((_iCurrentCol + 1) >= _iPos)
				{
					if ((_aoTDs[j].colSpan > 1) && ((_iCurrentCol + 1) != _iPos)) {_aoTDs[j].colSpan += 1;}
					else
					{
						var _oNewTD = _aoTDs[j].cloneNode(true);
						if (_iPos == 1)
						{
							_aoTDs[j].parentNode.insertBefore(_oNewTD, _aoTDs[j]);
						}
						else
						{
							if ((_aoTDs[j].nextSibling) && (_aoTDs[j].parentNode.insertBefore)) {_aoTDs[j].parentNode.insertBefore(_oNewTD, _aoTDs[j].nextSibling);}
							else {_aoTDs[j].parentNode.appendChild(_oNewTD);}
						}
						_oNewTD.style.border = _sOldBorder;
					}
					break;  
				}
			}
		}
	}
	
	this.tableRemoveCol = function(_sWysiwygID)
	{
		if (!this.oSelectionTD) {return;}
		
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _iPos;
		var _iCurrentCol = 0;
		var _oChild;
		var _aoTds;
		var _oTD = this.oSelectionTD;

		if ((!this.oSelectionTD.nextSibling) && (!this.oSelectionTD.previousSibling))
		{
			if (this.oSelectionTable.removeNode) {this.oSelectionTable.removeNode(true);}
			else {this.oSelectionTable.parentNode.removeChild(this.oSelectionTable);}
			this.oSelectionTable = null;
		}
		else
		{
			_oTD = _oTD.previousSibling;
			for (_iPos = 1; _oTD; _iPos += _oTD.colSpan, _oTD = _oTD.previousSibling);
			var _oParent = this.oSelectionTable.getElementsByTagName("TR")[0];
			for (var _oTr = _oParent; _oTr && _oTr.tagName.toUpperCase() == "TR"; _oTr = _oTr.nextSibling)
			{
				_iCurrentCol = 0;
				_oChild = _oTr.getElementsByTagName("TD")[0];
				for (;_oChild && _oChild.tagName.toUpperCase() == "TD"; _oChild = _oChild.nextSibling)
				{
					_iCurrentCol += _oChild.colSpan;
					if (_iCurrentCol >= _iPos)
					{
						if (_oChild.colSpan > 1) {_oChild.colSpan -= 1;}
						else
						{
							if (_oChild.removeNode) {_oChild.removeNode(true);}
							else {_oChild.parentNode.removeChild(_oChild);}
						}
						break;
					}
				}
			}
			for (;_oParent && _oParent.tagName.toUpperCase() == "TR"; _oParent = _oParent.nextSibling)
			{
				_aoTds = _oParent.getElementsByTagName("TD");
				if (_aoTds.length == 0)
				{
					this.oSelectionTR = _oParent;
					this.tableRemoveRow(_sWysiwygID);
				}
			}
		}
		this.oSelectionTD = null;
		this.oSelectionTR = null;
		this.oSelectionTable = null;
	}
	
	this.tableMergeCellsX = function(_sWysiwygID, _sDirection)
	{
		if (!this.oSelectionTD) {return;}

		if (typeof(_sDirection) == 'undefined') {var _sDirection = null;}
	
		_sDirection = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sDirection', 'xParameter': _sDirection});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});
		
		var _oTD = this.oSelectionTD;
		if (_sDirection == 'left')
		{
			if (!_oTD.previousSibling) {return;}
			_oTD = _oTD.previousSibling;
		}
		if (!_oTD.nextSibling) {return;}
		_oTD.innerHTML += _oTD.nextSibling.innerHTML;
		_oTD.colSpan += _oTD.nextSibling.colSpan;
		if (_oTD.nextSibling.removeNode) {_oTD.nextSibling.removeNode(true);}
		else {_oTD.nextSibling.parentNode.removeChild(_oTD.nextSibling);}
		this.oSelectionTD = _oTD;
	}
	
	this.tableMergeCellsY = function(_sWysiwygID, _sDirection)
	{
		if (!this.oSelectionTD) {return;}
		
		if (typeof(_sDirection) == 'undefined') {var _sDirection = null;}
	
		_sDirection = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sDirection', 'xParameter': _sDirection});
		_sWysiwygID = this.getRealParameter({'oParameters': _sWysiwygID, 'sName': 'sWysiwygID', 'xParameter': _sWysiwygID});

		var _oTD = this.oSelectionTD;
		var _oTr = _oTD.parentElement.nextSibling; // Hole ersten TR der Tabelle zu diesem TD
		var _iPos = 0;
		var _oNextTD = null;
		
		// Suche die Zeile unter der untersten Zeile die zu dem aktiven TD gehört...
		for (var i = 1; i < _oTD.rowSpan; i++) {_oTr = _oTr.nextSibling;}
		
		// Suche nach Colspans, die vor dem aktuellen TD existierten...
		for (_iPos = 0; _oTD; _iPos += _oTD.colSpan, _oTD = _oTD.previousSibling);

		if (!_oTr) {return;}
		
		_oTD = this.oSelectionTD;
		var _oTrNext = _oTr;
		var _aoTDs = _oTr.getElementsByTagName("TD"); // Hole die TDs im aktuellen TR
		var _iCurrentCol = 0;
		var _iRowspanAnzahl = 0;
		for (var i = 0; i < _aoTDs.length; ++i)
		{
			_iCurrentCol += _aoTDs[i].colSpan;
			if (_aoTDs[i].rowSpan > 1) {_iRowspanAnzahl++;}
			if (_iCurrentCol == _iPos)
			{
				_oTD.rowSpan = _oTD.rowSpan + _aoTDs[i].rowSpan;
				_oNextTD = _oTrNext.getElementsByTagName("TD")[i-_iRowspanAnzahl];
				if (_oNextTD)
				{
					if (_oNextTD.removeNode) {_oNextTD.removeNode(true);}
					else {_oNextTD.parentNode.removeChild(_oNextTD);}
				}
				break;
			}
		}
		this.oSelectionTD = null;
		this.oSelectionTR = null;
		this.oSelectionTable = null;
	}
}
classPG_Wysiwyg.prototype = new classPG_ClassBasics();
var oPGWysiwyg = new classPG_Wysiwyg();