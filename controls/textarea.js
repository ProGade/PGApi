/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
var PG_TEXTAREA_MODE_NONE = 0;
var PG_TEXTAREA_MODE_AUTOSAVE = 1;

var PG_TEXTAREA_EVENT_ONBLUR = 'OnBlur';

var PG_TEXTAREA_ACTIONSTATUS_SUCCESS = 1;
var PG_TEXTAREA_ACTIONSTATUS_FAILED = 0;

var PG_TEXTAREA_NETWORK_REQUESTTYPE = 'PG_TextareaNetworkRequestType';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_TextArea()
{
	// Declarations...
	this.sCssStyleNormal = 'background-color:#FFFFFF; color:#000000; border:solid 1px #707070;';
	this.sCssStyleDataSaved = 'background-color:#CCFFCC; color:#006600; border:solid 1px #006600;';
	this.sCssStyleDataWrong = 'background-color:#FFCCCC; color:#660000; border:solid 1px #660000;';
	this.sCssStyleDataNotSaved = 'background-color:#FFE99B; color:#654100; border:solid 1px #654100;';
	this.sCssStyleNoData = 'background-color:#FFFFFF; color:#CCCCCC; border:solid 1px #000000;';
	
	this.sSendParameters = '';

	// Construct...
	this.setID({'sID': 'PGTextArea'});
	this.initClassBasics();

	// Methods...
	/*
	@start method
	
	@param sParameters [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setSendParameters = function(_sParameters)
	{
		_sParameters = this.getRealParameter({'oParameters': _sParameters, 'sName': 'sParameters', 'xParameter': _sParameters});
		this.sSendParameters = _sParameters;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sParameters [needed][type]string[/type]
	[en]...[/en]
	*/
	this.addSendParameters = function(_sParameters)
	{
		_sParameters = this.getRealParameter({'oParameters': _sParameters, 'sName': 'sParameters', 'xParameter': _sParameters});
		if (this.sSendParameters != '') {this.sSendParameters += '&';}
		this.sSendParameters += _sParameters;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleNormal = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleNormal = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleDataSaved = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleDataSaved = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleDataWrong = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleDataWrong = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleDataNotSaved = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleDataNotSaved = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleNoData = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleNoData = _sStyle;
	}
	/* @end method */
		
	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.clear = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		if (_oTextArea) {_oTextArea.value = '';}
	}
	/* @end method */

	/*
	@start method
	
	@return asIDStructure [type]string[][/type]
	[en]...[/en]
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getIDStructure = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});

		var _asIDs = new Array();
		_asIDs.push(_sTextAreaID);
		_asIDs.push(_sTextAreaID+'SendParams');
		_asIDs.push(_sTextAreaID+'Mode');
		_asIDs.push(_sTextAreaID+'Required');
		_asIDs.push(_sTextAreaID+'MaxChars');
		_asIDs.push(_sTextAreaID+'LineBreakCharCount');
		_asIDs.push(_sTextAreaID+'FreeSpaceCharCount');
		_asIDs.push(_sTextAreaID+'NoData');
		_asIDs.push(_sTextAreaID+'IsNoData');
		return _asIDs;
	}
	/* @end method */

	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.textAreaOnKeyDown = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		// if ((this.oKeyUpTimeout == null) && (this.sCssStyleDataNotSaved != ''))
		if (this.sCssStyleDataNotSaved != '')
		{
			this.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': this.sCssStyleDataNotSaved});
		}
		// if (this.oKeyUpTimeout != null) {this.oWindow.clearInterval(this.oKeyUpTimeout); this.oKeyUpTimeout = null;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.textAreaOnKeyUp = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});

		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		var _oTextAreaMaxChars = this.oDocument.getElementById(_sTextAreaID+'MaxChars');
		var _oTextAreaCharCounter = this.oDocument.getElementById(_sTextAreaID+'CharCounter');
		var _oLineBreakCharCount = this.oDocument.getElementById(_sTextAreaID+'LineBreakCharCount');
		var _oFreeSpaceCharCount = this.oDocument.getElementById(_sTextAreaID+'FreeSpaceCharCount');
		if ((_oTextArea) && (_oTextAreaMaxChars) && (_oTextAreaCharCounter))
		{
			var _iTextAreaMaxChars = parseInt(_oTextAreaMaxChars.value);
			var _iTextAreaCurrentChars = _oTextArea.value.length;
			var _iLineBreakCharCount = parseInt(_oLineBreakCharCount.value);
			var _iFreeSpaceCharCount = parseInt(_oFreeSpaceCharCount.value);
			
			var _asFreeSpaces = _oTextArea.value.match(/ /g);
			var _iFreeSpaceCount = 0;
			if (_asFreeSpaces) {_iFreeSpaceCount = _asFreeSpaces.length;}
			
			var _asLineBreaks = _oTextArea.value.match(/\n/g);
			var _iLineBreakCount = 0;
			if (_asLineBreaks) {_iLineBreakCount = _asLineBreaks.length;}

			if (!isNaN(_iTextAreaMaxChars))
			{
				if (_iTextAreaMaxChars > 0)
				{
					if ((!isNaN(_iLineBreakCharCount)) && (!isNaN(_iLineBreakCount)))
					{
						_iTextAreaMaxChars += _iLineBreakCount;
						_iTextAreaMaxChars -= (_iLineBreakCount*_iLineBreakCharCount);
					}
					
					if ((!isNaN(_iFreeSpaceCharCount)) && (!isNaN(_iFreeSpaceCount)))
					{
						_iTextAreaMaxChars += _iFreeSpaceCount;
						_iTextAreaMaxChars -= (_iFreeSpaceCount*_iFreeSpaceCharCount);
					}
					
					if (_iTextAreaCurrentChars > _iTextAreaMaxChars)
					{
						_oTextArea.value = _oTextArea.value.substring(0, _iTextAreaMaxChars);
					}
					_iTextAreaCurrentChars = _oTextArea.value.length;
					_oTextAreaCharCounter.innerHTML = 'noch '+(_iTextAreaMaxChars-_iTextAreaCurrentChars)+' Zeichen';
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.textAreaOnFocus = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});

		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		var _oTextAreaIsNoData = this.oDocument.getElementById(_sTextAreaID+'IsNoData');
		if ((_oTextArea) && (_oTextAreaIsNoData))
		{
			if (_oTextAreaIsNoData.value == '1')
			{
				_oTextArea.value = '';
				_oTextAreaIsNoData.value = '0';
				this.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': this.sCssStyleNormal});
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.textAreaOnBlur = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});

		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		var _oTextAreaNoData = this.oDocument.getElementById(_sTextAreaID+'NoData');
		var _oTextAreaIsNoData = this.oDocument.getElementById(_sTextAreaID+'IsNoData');
		var _oTextAreaMode = this.oDocument.getElementById(_sTextAreaID+'Mode');
		var _oTextAreaRequired = this.oDocument.getElementById(_sTextAreaID+'Required');
		if ((_oTextArea) && (_oTextAreaNoData) && (_oTextAreaIsNoData) && (_oTextAreaMode) && (_oTextAreaRequired))
		{
			var _iTextAreaMode = parseInt(_oTextAreaMode.value);
			if (!isNaN(_iTextAreaMode))
			{
				if ((this.isMode({'iMode': PG_TEXTAREA_MODE_AUTOSAVE, 'iCurrentMode': _iTextAreaMode})) && ((_oTextArea.value != '') || (_oTextAreaRequired.value != '1')))
				{
					this.send({'sTextAreaID': _sTextAreaID, 'sParameters': 'sEvent='+PG_TEXTAREA_EVENT_ONBLUR, 'fOnResponse': oPGTextArea.textAreaOnResponse});
				}
				
				if (_oTextArea.value == '')
				{
					if (_oTextAreaNoData.value != '')
					{
						_oTextArea.value = _oTextAreaNoData.value;
						_oTextAreaIsNoData.value = '1';
						if (_oTextAreaRequired.value != '1') {this.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': this.sCssStyleNoData});}
					}
					if (_oTextAreaRequired.value == '1') {this.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': this.sCssStyleDataWrong});}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sText [type]string[/type]
	[en]...[/en]
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getContent = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		if (_oTextArea) {return encodeURIComponent(_oTextArea.value);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsRequired [type]bool[/type]
	[en]...[/en]
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.isRequired = function(_sTextAreaID)
	{
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		var _oTextAreaRequired = this.oDocument.getElementById(_sTextAreaID+'Required');
		if (_oTextAreaRequired) {if (_oTextAreaRequired.value == '1') {return true;}}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	
	@param fOnResponse [type]function[/type]
	[en]...[/en]
	*/
	this.send = function(_sTextAreaID, _sParameters, _fOnResponse)
	{
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		if (typeof(_fOnResponse) == 'undefined') {var _fOnResponse = null;}

		_sParameters = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sParameters', 'xParameter': _sParameters});
		_fOnResponse = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'fOnResponse', 'xParameter': _fOnResponse});
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		
		var _sParameters2 = 'sTextAreaID='+_sTextAreaID;
		_sParameters2 += '&sRequestType='+PG_TEXTAREA_NETWORK_REQUESTTYPE;
		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		if (_oTextArea)
		{
			_sParameters2 += '&sName='+_oTextArea.name;
			_sParameters2 += '&sText='+encodeURIComponent(_oTextArea.value);
		}
		
		if (this.sSendParameters != '') {_sParameters2 += '&'+this.sSendParameters;}
		if (_sParameters != '') {_sParameters2 += '&'+_sParameters;}

		var _oSendParams = this.oDocument.getElementById(_sTextAreaID+'SendParams');
		if (_oSendParams) {if (_oSendParams.value != '') {_sParameters2 += '&'+_oSendParams.value;}}

		this.networkSend({'sParameters': _sParameters2, 'fOnResponse': _fOnResponse});
	}
	/* @end method */
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.textAreaOnResponse = function(_oParameters)
	{
		if (_oParameters['PG_RequestType'] == PG_TEXTAREA_NETWORK_REQUESTTYPE)
		{
			var _sJavaScriptToExecute = '';
			var _sTextAreaID = _oParameters['PG_TextAreaID'];
			if (_oParameters['PG_TextAreaJavaScriptToExecute'] != '') {_sJavaScriptToExecute = _oParameters['PG_TextAreaJavaScriptToExecute'];}
			var _sEvent = _oParameters['PG_TextAreaEvent'];
			if (_sEvent == PG_TEXTAREA_EVENT_ONBLUR)
			{
				if (oPGTextArea.sCssStyleDataSaved != '')
				{
					var _iActionStatus = parseInt(_oParameters['PG_TextAreaActionStatus']);
					if (_iActionStatus == PG_TEXTAREA_ACTIONSTATUS_SUCCESS)
					{
						oPGTextArea.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': oPGTextArea.sCssStyleDataSaved});
					}
					else if (_iActionStatus == PG_TEXTAREA_ACTIONSTATUS_FAILED)
					{
						oPGTextArea.changeStyle({'sTextAreaID': _sTextAreaID, 'sStyle': oPGTextArea.sCssStyleDataNotSaved});
					}
				}
			}
			if (_sJavaScriptToExecute != '') {eval(_sJavaScriptToExecute);}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sTextAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeStyle = function(_sTextAreaID, _sStyle)
	{
		if (typeof(_sStyle) == 'undefined') {var _sStyle = null;}

		_sStyle = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sStyle', 'xParameter': _sStyle});
		_sTextAreaID = this.getRealParameter({'oParameters': _sTextAreaID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});

		var _iWidth = 0;
		var _oTextArea = this.oDocument.getElementById(_sTextAreaID);
		var _sDefaultStyle = 'padding-left:0px; padding-right:0px; margin-left:0px; margin-right:0px;';
		if (_oTextArea)
		{
			_iWidth = parseInt(_oTextArea.style.width);
			if (typeof(oPGCss) != 'undefined') {oPGCss.setStyle({'xElement': _oTextArea, 'xStyle': _sDefaultStyle+' width:'+_iWidth+'px; '+_sStyle});}
		}
	}
	/* @end method */
}
/* @end class */
classPG_TextArea.prototype = new classPG_ClassBasics();
var oPGTextArea = new classPG_TextArea();
