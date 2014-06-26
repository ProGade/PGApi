/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 04 2012
*/
var PG_DEBUGCONSOLE_MESSAGE_INDEX_TYPE = 0;

var PG_DEBUGCONSOLE_MESSAGE_INDEX_STRING_DATEOBJECT = 2;
var PG_DEBUGCONSOLE_MESSAGE_INDEX_STRING_MESSAGE = 2;
var PG_DEBUGCONSOLE_MESSAGE_INDEX_STRING_XOBJECT = 3;

var PG_DEBUGCONSOLE_MESSAGE_INDEX_ERROR_DATEOBJECT = 2;
var PG_DEBUGCONSOLE_MESSAGE_INDEX_ERROR_MESSAGE = 2;
var PG_DEBUGCONSOLE_MESSAGE_INDEX_ERROR_FILE = 3;
var PG_DEBUGCONSOLE_MESSAGE_INDEX_ERROR_ROW = 4;

var PG_DEBUGCONSOLE_MESSAGE_TYPE_STRING = 0;
var PG_DEBUGCONSOLE_MESSAGE_TYPE_ERROR = 1;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_DebugConsole()
{
	// Declarations...
	this.oLastDebugObject = null;
	this.oDebugObject = null;
	this.sObjectPropertiesContainerID = null;
	
	this.iCurrentMessageID = 0;
	this.axMessages = new Array();
	
	this.bShowOnError = true;

	this.sCssClassPrefix = 'pg_debug_';
	
	this.sCssClassMassageContainerTable = 'message_container_table';

	this.sCssClassMessageDiv = 'message_div';
	this.sCssClassMessageString = 'message_string';
	this.sCssClassMessageTime = 'message_time';
	this.sCssClassMessageObject = 'message_object';
	
	this.sCssClassErrorDiv = 'error_div';
	this.sCssClassErrorString = 'error_string';
	this.sCssClassErrorTime = 'error_time';
	this.sCssClassErrorRowNumber = 'error_row_number';
	this.sCssClassErrorFilePath = 'error_file_path';
	this.sCssClassErrorMessage = 'error_message';
	
	this.sCssClassObjectTypeString = 'object_type_string';
	this.sCssClassObjectTypeBoolean = 'object_type_boolean';
	this.sCssClassObjectTypeNumber = 'object_type_number';
	this.sCssClassObjectTypeObject = 'object_type_object';
	this.sCssClassObjectTypeArray = 'object_type_array';
	this.sCssClassObjectTypeVariable = 'object_type_variable';
	this.sCssClassObjectTypeFunction = 'object_type_function';
	this.sCssClassObjectTypeUndefined = 'object_type_undefined';
	this.sCssClassObjectTypeOperators = 'object_type_operators';
	
	this.sCssStyleMessageDivActive = 'border-width:3px;';
	this.sCssStyleMessageDivInactive = 'border-width:1px;';
	
	// Construct...
	this.setID({'sID': 'PGDebugConsole'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@param sContainerID [neede][type]string[/type]
	[en]...[/en]
	*/
	this.setObjectPropertiesContainerID = function(_sContainerID)
	{
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		this.sObjectPropertiesContainerID = _sContainerID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sObjectPropertiesContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.getObjectPropertiesContainerID = function() {return this.sObjectPropertiesContainerID;}
	/* @end method */

	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	*/
	this.showLastObjectProperties = function() {return this.showObjectProperties({'oObject': this.oLastDebugObject});}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sContainerID [type]string[/type]
	[en]...[/en]
	
	@param sParent [type]string[/type]
	[en]...[/en]
	
	@param oObject [type]object[/type]
	[en]...[/en]
	*/
	this.showObjectProperties = function(_sContainerID, _sParent, _oObject)
	{
		if (typeof(_sParent) == 'undefined') {var _sParent = null;}
		if (typeof(_bUseHtml) == 'undefined') {var _bUseHtml = null;}

		_sParent = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sParent', 'xParameter': _sParent});
		_oObject = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'oObject', 'xParameter': _oObject});
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});

		if (_sContainerID == null) {_sContainerID = this.sObjectPropertiesContainerID;}
		this.oLastDebugObject = this.oDebugObject;
		this.oDebugObject = _oObject;
		var _sHTML = '';
		if (this.oLastDebugObject != null) {_sHTML += '<a onclick="oPGDebugConsole.showLastObjectProperties();" target="_self">[Parent Object]</a><br />';}
		for (var i in _oObject)
		{
			if (_sParent) {_sHTML += _sParent+'.'+i+'=';}
			else {_sHTML += i+'=';}
			if (typeof(_oObject[i]) == 'object')
			{
				if (_sParent) {_sHTML += '<a onclick="oPGDebugConsole.showObjectProperties({\'oObject\': \''+_sParent+'.'+i+'\'});" target="_self">'+_sParent+'.'+i+'</a>';}
				else {_sHTML += '<a onclick="oPGDebugConsole.showObjectProperties({\'oObject\': \''+i+'\'});" target="_self">'+_oObject[i]+'</a>';}
			}
			else {_sHTML += _oObject[i];}
			_sHTML += ';<br />';
		}
		if (_sContainerID)
		{
			var _oContainer = this.oDocument.getElementById(_sContainerID);
			if (_oContainer) {_oContainer.innerHTML = _sHTML;}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	this.useShowOnError = function(_bUse)
	{
		_bUse = this.getRealParameter({'oParameters': _bUse, 'sName': 'bUse', 'xParameter': _bUse});
		this.bShowOnError = _bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bShowOnError [type]bool[/type]
	[en]...[/en]
	*/
	this.isShowOnError = function() {return this.bShowOnError;}
	/* @end method */
	
	// Message...
	/*
	@start method
	
	@param sCssClassPrefix [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassPrefix = function(_sCssClassPrefix)
	{
		_sCssClassPrefix = this.getRealParameter({'oParameters': _sCssClassPrefix, 'sName': 'sCssClassPrefix', 'xParameter': _sCssClassPrefix});
		this.sCssClassPrefix = _sCssClassPrefix;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassPrefix [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassPrefix = function() {return this.sCssClassPrefix;}
	/* @end method */

	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassMessageDiv = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassMessageDiv = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassMessageDiv [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassMessageDiv = function() {return this.sCssClassMessageDiv;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassMessageString = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassMessageString = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassMessageString [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassMessageString = function() {return this.sCssClassMessageString;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassMessageTime = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassMessageTime = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassMessageTime [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassMessageTime = function() {return this.sCssClassMessageTime;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassMessageObject = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassMessageObject = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassMessageObject [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassMessageObject = function() {return this.sCssClassMessageObject;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorDiv = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorDiv = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorDiv [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorDiv = function() {return this.sCssClassErrorDiv;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorString = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorString = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorString [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorString = function() {return this.sCssClassErrorString;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorTime = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorTime = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorTime [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorTime = function() {return this.sCssClassErrorTime;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorRowNumber = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorRowNumber = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorRowNumber [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorRowNumber = function() {return this.sCssClassErrorRowNumber;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorFilePath = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorFilePath = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorFilePath [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorFilePath = function() {return this.sCssClassErrorFilePath;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssClassErrorMessage = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssClassErrorMessage = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClassErrorMessage [type]string[/type]
	[en]...[/en]
	*/
	this.getCssClassErrorMessage = function() {return this.sCssClassErrorMessage;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleMessageDivActive = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssStyleMessageDivActive = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyleMessageDivActive [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleMessageDivActive = function() {return this.sCssStyleMessageDivActive;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleMessageDivInactive = function(_sCssClass)
	{
		_sCssClass = this.getRealParameter({'oParameters': _sCssClass, 'sName': 'sCssClass', 'xParameter': _sCssClass});
		this.sCssStyleMessageDivInactive = _sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyleMessageDivInactive [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleMessageDivInactive = function() {return this.sCssStyleMessageDivInactive;}
	/* @end method */
	
	/* @start method */
	this.jumpToStart = function() {this.jumpToTop({'bSetAsActive': false});}
	/* @end method */

	/*
	@start method
	
	@param bSetAsActive [type]bool[/type]
	[en]...[/en]
	*/
	this.jumpToTop = function(_bSetAsActive)
	{
		if (typeof(_bSetAsActive) == 'undefined') {var _bSetAsActive = null;}

		_bSetAsActive = this.getRealParameter({'oParameters': _bSetAsActive, 'sName': 'bSetAsActive', 'xParameter': _bSetAsActive});

		if (_bSetAsActive == null) {_bSetAsActive = true;}
		if (_bSetAsActive == true)
		{
			var _iMessageID = this.axMessages.length-1;
			this.jumpToMessage({'iMessageID': _iMessageID, 'bSetAsActive': true});
		}
		else {this.oDocument.location.href = '#'+this.getID()+'Top';}
	}
	/* @end method */

	/* @start method */
	this.jumpToEnd = function() {this.jumpToBottom({'bSetAsActive': false});}
	/* @end method */

	/*
	@start method
	
	@param bSetAsActive [type]bool[/type]
	[en]...[/en]
	*/
	this.jumpToBottom = function(_bSetAsActive)
	{
		if (typeof(_bSetAsActive) == 'undefined') {var _bSetAsActive = null;}

		_bSetAsActive = this.getRealParameter({'oParameters': _bSetAsActive, 'sName': 'bSetAsActive', 'xParameter': _bSetAsActive});

		if (_bSetAsActive == null) {_bSetAsActive = true;}
		if (_bSetAsActive == true)
		{
			var _iMessageID = 0;
			this.jumpToMessage({'iMessageID': _iMessageID, 'bSetAsActive': true});
		}
		else {this.oDocument.location.href = '#'+this.getID()+'Bottom';}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMessageID [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setToActiveMessage = function(_iMessageID)
	{
		_iMessageID = this.getRealParameter({'oParameters': _iMessageID, 'sName': 'iMessageID', 'xParameter': _iMessageID});
		this.unhighlightMessage({'iMessageID': this.iCurrentMessageID});
		this.iCurrentMessageID = _iMessageID;
		this.hightlightMessage({'iMessageID': this.iCurrentMessageID});
	}
	/* @end method */
	
	/* @start method */
	this.jumpToActiveMessage = function() {this.jumpToMessage({'iMessageID': this.iCurrentMessageID, 'bSetAsActive': false});}
	/* @end method */

	/*
	@start method
	
	@param bSetAsActive [type]bool[/type]
	[en]...[/en]
	*/
	this.jumpToPreviousMessage = function(_bSetAsActive)
	{
		if (typeof(_bSetAsActive) == 'undefined') {var _bSetAsActive = null;}

		_bSetAsActive = this.getRealParameter({'oParameters': _bSetAsActive, 'sName': 'bSetAsActive', 'xParameter': _bSetAsActive});

		if (_bSetAsActive == null) {_bSetAsActive = true;}
		if (this.iCurrentMessageID > 0)
		{
			this.jumpToMessage({'iMessageID': this.iCurrentMessageID-1, 'bSetAsActive': _bSetAsActive});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param bSetAsActive [type]bool[/type]
	[en]...[/en]
	*/
	this.jumpToNextMessage = function(_bSetAsActive)
	{
		if (typeof(_bSetAsActive) == 'undefined') {var _bSetAsActive = null;}
		
		_bSetAsActive = this.getRealParameter({'oParameters': _bSetAsActive, 'sName': 'bSetAsActive', 'xParameter': _bSetAsActive});

		if (_bSetAsActive == null) {_bSetAsActive = true;}
		if (this.iCurrentMessageID < this.axMessages.length-1)
		{
			this.jumpToMessage({'iMessageID': this.iCurrentMessageID+1, 'bSetAsActive': _bSetAsActive});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMessageID [needed][type]int[/type]
	[en]...[/en]
	
	@param bSetAsActive [type]bool[/type]
	[en]...[/en]
	*/
	this.jumpToMessage = function(_iMessageID, _bSetAsActive)
	{
		if (typeof(_bSetAsActive) == 'undefined') {var _bSetAsActive = null;}
		
		_bSetAsActive = this.getRealParameter({'oParameters': _iMessageID, 'sName': 'bSetAsActive', 'xParameter': _bSetAsActive});
		_iMessageID = this.getRealParameter({'oParameters': _iMessageID, 'sName': 'iMessageID', 'xParameter': _iMessageID});

		if (_bSetAsActive == null) {_bSetAsActive = true;}
		var _oMessageDiv = null;
		if ((this.iCurrentMessageID >= 0) && (this.iCurrentMessageID < this.axMessages.length))
		{
			if (_bSetAsActive == true) {this.setToActiveMessage({'iMessageID': _iMessageID});}
			this.oDocument.location.href = '#'+this.getID()+'Message'+this.iCurrentMessageID;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMessageID [needed][type]int[/type]
	[en]...[/en]
	*/
	this.hightlightMessage = function(_iMessageID)
	{
		_iMessageID = oPGDebugConsole.getRealParameter({'oParameters': _iMessageID, 'sName': 'iMessageID', 'xParameter': _iMessageID});

		var _oMessageDiv = oPGDebugConsole.oDocument.getElementById(oPGDebugConsole.getID()+'Message'+_iMessageID);
		if ((_oMessageDiv) && (typeof(oPGCss) != 'undefined'))
		{
			oPGDebugConsole.sCssStyleMessageDivInactive = oPGCss.getStyle(_oMessageDiv);
			oPGCss.setStyle({'xElement': _oMessageDiv, 'xStyle': oPGDebugConsole.sCssStyleMessageDivActive});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMessageID [needed][type]int[/type]
	[en]...[/en]
	*/
	this.unhighlightMessage = function(_iMessageID)
	{
		_iMessageID = oPGDebugConsole.getRealParameter({'oParameters': _iMessageID, 'sName': 'iMessageID', 'xParameter': _iMessageID});

		var _oMessageDiv = oPGDebugConsole.oDocument.getElementById(oPGDebugConsole.getID()+'Message'+_iMessageID);
		if ((_oMessageDiv) && (typeof(oPGCss) != 'undefined'))
		{
			oPGCss.setStyle({'xElement': _oMessageDiv, 'xStyle': oPGDebugConsole.sCssStyleMessageDivInactive});
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMessageID [type]int[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param xObject [type]mixed[/type]
	[en]...[/en]
	*/
	this.addMessage = function(_sString, _xObject)
	{
		if (typeof(_xObject) == 'undefined') {var _xObject = null;}
		
		_xObject = oPGDebugConsole.getRealParameter({'oParameters': _sString, 'sName': 'xObject', 'xParameter': _xObject});
		_sString = oPGDebugConsole.getRealParameter({'oParameters': _sString, 'sName': 'sString', 'xParameter': _sString});

		if (_xObject == null) {_xObject = '[message]';}
		
		var _oDate = new Date();
		oPGDebugConsole.axMessages.push(new Array(PG_DEBUGCONSOLE_MESSAGE_TYPE_STRING, _oDate, _sString, _xObject));
		oPGDebugConsole.unhighlightMessage({'iMessageID': oPGDebugConsole.iCurrentMessageID});
		oPGDebugConsole.iCurrentMessageID = oPGDebugConsole.axMessages.length-1;
		if (oPGDebugConsole.getID() != '') {oPGDebugConsole.buildMessage({'oDate': _oDate, 'sString': _sString, 'xObject': _xObject});}
		return oPGDebugConsole.iCurrentMessageID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param oDate [needed][type]object[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param xObject [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.buildMessage = function(_oDate, _sString, _xObject, _sContainerID)
	{
		if (typeof(_sString) == 'undefined') {var _sString = null;}
		if (typeof(_xObject) == 'undefined') {var _xObject = null;}
		if (typeof(_sContainerID) == 'undefined') {var _sContainerID = null;}

		_sString = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'sString', 'xParameter': _sString});
		_xObject = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'xObject', 'xParameter': _xObject});
		_sContainerID = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		_oDate = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'oDate', 'xParameter': _oDate, 'bNotNull': true});
		
		var _iHours = _oDate.getHours();
		var _iMinutes = _oDate.getMinutes();
		if (_iMinutes < 10) {_iMinutes = '0'+_iMinutes;}
		var _iSeconds = _oDate.getSeconds();
		if (_iSeconds < 10) {_iSeconds = '0'+_iSeconds;}
		
		var _sHTML = '';
		_sHTML += '<a name="'+oPGDebugConsole.getID()+'Message'+oPGDebugConsole.iCurrentMessageID+'"></a>';
		_sHTML += '<div id="'+oPGDebugConsole.getID()+'Message'+oPGDebugConsole.iCurrentMessageID+'" ';
		_sHTML += 'onclick="oPGDebugConsole.setToActiveMessage('+oPGDebugConsole.iCurrentMessageID+');" ';
		_sHTML += 'class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassMessageDiv+'">';
		_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassMessageString+'">';
			_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassMessageTime+'">['+_iHours+':'+_iMinutes+':'+_iSeconds+']</span> ';
			_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassMessageObject+'">';
			if (_xObject == '[message]') {_sHTML += _xObject;}
			else {_sHTML += '['+typeof(_xObject)+']';}
			_sHTML += '</span> ';
			if (typeof(_xObject) == 'function') {_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeFunction+'">';}
			if ((_xObject != '[message]') && (typeof(_xObject) != 'function')) {_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeVariable+'">';}
			_sHTML += _sString;
			if ((_xObject != '[message]') && (typeof(_xObject) != 'function')) {_sHTML += '</span>';}
			if (_xObject != '[message]')
			{
				// TODO: syntax highlighting with extra class
				switch(typeof(_xObject))
				{
					case 'string':
					case 'boolean':
					case 'number':
					case 'object':
						_sHTML += ' <span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeOperators+'">=</span> ';
					break;
				}
					
				switch(typeof(_xObject))
				{
					case 'string':
						_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeString+'">"'+_xObject+'"</span>';
					break;
					
					case 'boolean':
						_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeBoolean+'">'+_xObject+'</span>';
					break;
					
					case 'number':
						_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeNumber+'">'+_xObject+'</span>';
					break;
					
					case 'object':
						if (_xObject instanceof Array)
						{
							_sHTML += ' <span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeOperators+'">new</span> ';
							_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeArray+'">Array(</span>';
							for (var i=0; i<_xObject.length; i++)
							{
								if (i > 0) {_sHTML += ', ';}
								_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeNumber+'">'+i+'</span>';
								_sHTML += ' <span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeOperators+'">=&gt;</span> ';
								switch(typeof(_xObject[i]))
								{
									case 'string':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeString+'">"'+_xObject[i]+'"</span>';
									break;
									case 'boolean':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeBoolean+'">'+_xObject[i]+'</span>';
									break;
									case 'number':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeNumber+'">'+_xObject[i]+'</span>';
									break;
									case 'object':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeObject+'">'+_xObject[i]+'</span>';
									break;
									case 'function':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeFunction+'">'+_xObject[i]+'</span>';
									break;
									case 'undefined':
										_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeUndefined+'">'+_xObject[i]+'</span>';
									break;
								}
							}
							_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeArray+'">)</span>';
						}
						else
						{
						}
					break;
					
					case 'function':
						_sHTML += '()</span>';
					break;
					
					case 'undefined':
						_sHTML += ' <span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeUndefined+'">is undefined!</span>';
					break;
				}
					
				switch(typeof(_xObject))
				{
					case 'string':
					case 'boolean':
					case 'number':
					case 'object':
					case 'function':
						_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassObjectTypeOperators+'">;</span> ';
					break;
				}
			}
		_sHTML += '</span>';
		_sHTML += '</div>';

		if (_sContainerID == null) {_sContainerID = oPGDebugConsole.getID();}
		if (_sContainerID != '')
		{
			var _oContainer = oPGDebugConsole.oDocument.getElementById(_sContainerID+'Messages');
			if (_oContainer)
			{
				_oContainer.innerHTML = _sHTML+_oContainer.innerHTML;
				oPGDebugConsole.jumpToTop();
			}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMessageID [type]int[/type]
	[en]...[/en]
	
	@param sErrorMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param sFilePath [needed][type]string[/type]
	[en]...[/en]
	
	@param iRowNumber [needed][type]int[/type]
	[en]...[/en]
	*/
	this.addError = function(_sErrorMessage, _sFilePath, _iRowNumber)
	{
		if (typeof(_sFilePath) == 'undefined') {var _sFilePath = null;}
		if (typeof(_iRowNumber) == 'undefined') {var _iRowNumber = null;}

		_sFilePath = oPGDebugConsole.getRealParameter({'oParameters': _sErrorMessage, 'sName': 'sFilePath', 'xParameter': _sFilePath});
		_iRowNumber = oPGDebugConsole.getRealParameter({'oParameters': _sErrorMessage, 'sName': 'iRowNumber', 'xParameter': _iRowNumber});
		_sErrorMessage = oPGDebugConsole.getRealParameter({'oParameters': _sErrorMessage, 'sName': 'sErrorMessage', 'xParameter': _sErrorMessage});

		var _oDate = new Date();
		oPGDebugConsole.axMessages.push(new Array(PG_DEBUGCONSOLE_MESSAGE_TYPE_ERROR, _oDate, _sErrorMessage, _sFilePath, _iRowNumber));
		oPGDebugConsole.unhighlightMessage({'iMessageID': oPGDebugConsole.iCurrentMessageID});
		oPGDebugConsole.iCurrentMessageID = oPGDebugConsole.axMessages.length-1;
		if (oPGDebugConsole.getID() != '') {oPGDebugConsole.buildError({'oDate': _oDate, 'sErrorMessage': _sErrorMessage, 'sFilePath': _sFilePath, 'iRowNumber': _iRowNumber});}
		return oPGDebugConsole.iCurrentMessageID;
	}
	/* @end method */
	this.onError = this.addError;
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param oDate [needed][type]object[/type]
	[en]...[/en]
	
	@param sErrorMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param sFilePath [needed][type]string[/type]
	[en]...[/en]
	
	@param iRowNumber [needed][type]int[/type]
	[en]...[/en]
	
	@param sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.buildError = function(_oDate, _sErrorMessage, _sFilePath, _iRowNumber, _sContainerID)
	{
		if (typeof(_sErrorMessage) == 'undefined') {var _sErrorMessage = null;}
		if (typeof(_sFilePath) == 'undefined') {var _sFilePath = null;}
		if (typeof(_iRowNumber) == 'undefined') {var _iRowNumber = null;}
		if (typeof(_sContainerID) == 'undefined') {var _sContainerID = null;}

		_sErrorMessage = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'sErrorMessage', 'xParameter': _sErrorMessage});
		_sFilePath = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'sFilePath', 'xParameter': _sFilePath});
		_iRowNumber = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'iRowNumber', 'xParameter': _iRowNumber});
		_sContainerID = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		_oDate = oPGDebugConsole.getRealParameter({'oParameters': _oDate, 'sName': 'oDate', 'xParameter': _oDate, 'bNotNull': true});
		
		var _iHours = _oDate.getHours();
		var _iMinutes = _oDate.getMinutes();
		if (_iMinutes < 10) {_iMinutes = '0'+_iMinutes;}
		var _iSeconds = _oDate.getSeconds();
		if (_iSeconds < 10) {_iSeconds = '0'+_iSeconds;}
		
		var _sHTML = '';
		_sHTML += '<a name="'+oPGDebugConsole.getID()+'Message'+oPGDebugConsole.iCurrentMessageID+'"></a>';
		_sHTML += '<div id="'+oPGDebugConsole.getID()+'Message'+oPGDebugConsole.iCurrentMessageID+'" ';
		_sHTML += 'onclick="oPGDebugConsole.setToActiveMessage('+oPGDebugConsole.iCurrentMessageID+');" ';
		_sHTML += 'class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorDiv+'">';
		_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorString+'">';
			_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorTime+'">['+_iHours+':'+_iMinutes+':'+_iSeconds+']</span> ';
			_sHTML += 'Error at ';
			_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorRowNumber+'">row '+_iRowNumber+'</span> ';
			_sHTML += 'in file ';
			_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorFilePath+'">"'+_sFilePath+'"</span>';
		_sHTML += '</span>';
		_sHTML += '<br />';
		_sHTML += '<span class="'+oPGDebugConsole.sCssClassPrefix+oPGDebugConsole.sCssClassErrorMessage+'">'+_sErrorMessage+'</span>';
		_sHTML += '</div>';
		
		if (_sContainerID == null) {_sContainerID = oPGDebugConsole.getID();}
		if (_sContainerID != '')
		{
			var _oContainer = oPGDebugConsole.oDocument.getElementById(_sContainerID+'Messages');
			if (_oContainer)
			{
				_oContainer.innerHTML = _sHTML+_oContainer.innerHTML;
				if (oPGDebugConsole.bShowOnError == true) {oPGDebugConsole.show();}
				oPGDebugConsole.jumpToTop();
			}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	
	@param sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.setMessageContainerSize = function(_sSizeX, _sSizeY, _sContainerID)
	{
		if (typeof(_sSizeY) == 'undefined') {var _sSizeY = null;}
		if (typeof(_sContainerID) == 'undefined') {var _sContainerID = null;}

		_sSizeY = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sSizeY', 'xParameter': _sSizeY});
		_sContainerID = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		_sSizeX = this.getRealParameter({'oParameters': _sSizeX, 'sName': 'sSizeX', 'xParameter': _sSizeX});
		
		if (_sContainerID == null) {_sContainerID = this.getID();}
		if (_sContainerID != '')
		{
			var _oContainerTable = this.oDocument.getElementById(_sContainerID+'Table');
			var _oContainer = this.oDocument.getElementById(_sContainerID);
			if ((_oContainerTable) && (_oContainer))
			{
				if (_sSizeX != null) {_oContainerTable.style.width = _sSizeX;}
				if (_sSizeY != null)
				{
					_oContainerTable.style.height = _sSizeY;
					_oContainer.style.height = _sSizeY;
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sWidth [type]string[/type]
	[en]...[/en]
	*/
	this.buildCommandBar = function(_sWidth)
	{
		if (typeof(_sWidth) == 'undefined') {var _sWidth = null;}

		_sWidth = this.getRealParameter({'oParameters': _sWidth, 'sName': 'sWidth', 'xParameter': _sWidth});

		if (_sWidth == null) {_sWidth = '100%';}
		
		var _sHTML = '';
		_sHTML += '<table id="'+this.getID()+'CommandBar" style="border-width:0px; width:'+_sWidth+';" cellpadding="0" cellspacing="0">';
		_sHTML += '<tr>';
			_sHTML += '<td>';
			if (typeof(oPGInputField) != 'undefined')
			{
				var _sInputFieldID = this.getID()+'CommandLineString';
				var _iInputFieldMode = PG_INPUTFIELD_MODE_NONE;
				_sHTML += oPGInputField.build({'sInputFieldID': _sInputFieldID, 'iInputFieldMode': _iInputFieldMode});
			}
			else {_sHTML += '<input type="text" id="'+this.getID()+'CommandLineString" style="width:100%;" autocomplete="off" />';}
			_sHTML += '</td>';
			_sHTML += '<td style="width:80px;"><input type="button" value="execute" onclick="oPGDebugConsole.executeCommandLine();" style="width:80px;" /></td>';
		_sHTML += '</tr>';
		_sHTML += '</table>';
		return _sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sWidth [type]string[/type]
	[en]...[/en]

	@param sHeight [/type]
	[en]...[/en]
	
	@param sContainerID [/type]
	[en]...[/en]
	*/
	this.buildMessageContainer = function(_sWidth, _sHeight, _sContainerID)
	{
		if (typeof(_sWidth) == 'undefined') {var _sWidth = null;}
		if (typeof(_sHeight) == 'undefined') {var _sHeight = null;}
		if (typeof(_sContainerID) == 'undefined') {var _sContainerID = null;}

		_sHeight = this.getRealParameter({'oParameters': _sWidth, 'sName': 'sHeight', 'xParameter': _sHeight});
		_sContainerID = this.getRealParameter({'oParameters': _sWidth, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		_sWidth = this.getRealParameter({'oParameters': _sWidth, 'sName': 'sWidth', 'xParameter': _sWidth});
		
		if (_sWidth == null) {_sWidth = '100%';}
		if (_sHeight == null) {_sHeight = '100px';}
		
		if (_sContainerID != null) {this.setID({'sID': _sContainerID});}
		
		var _sHTML = '';
		_sHTML += '<table id="'+this.getID()+'Table" class="'+this.sCssClassPrefix+this.sCssClassMassageContainerTable+'" style="border-width:0px; width:'+_sWidth+'; height:'+_sHeight+';" cellpadding="0" cellspacing="0">';
		_sHTML += '<tr>';
			_sHTML += '<td style="width:20px;">';
			_sHTML += '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_top.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToTop();" />';
			_sHTML += '<br />';
			_sHTML += '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_previous.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToNextMessage();" />';
			_sHTML += '<br />';
			_sHTML += '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_active.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToActiveMessage();" />';
			_sHTML += '<br />';
			_sHTML += '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_next.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToPreviousMessage();" />';
			_sHTML += '<br />';
			_sHTML += '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_bottom.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToBottom();" />';
			_sHTML += '</td>';
			_sHTML += '<td>';
				_sHTML += '<div id="'+this.getID()+'" style="overflow:auto; width:100%; height:'+_sHeight+'; margin:0px; padding:0px;">';
					_sHTML += '<a name="'+this.getID()+'Top"></a>';
					_sHTML += '<div id="'+this.getID()+'Messages">';
					_sHTML += '<a name="'+this.getID()+'Bottom"></a>';
					_sHTML += '</div>';
				_sHTML += '</div>';
			_sHTML += '</td>';
		_sHTML += '</tr>';
		_sHTML += '</table>';
		if (_sContainerID != '')
		{
			var _oContainer = this.oDocument.getElementById(_sContainerID);
			if (_oContainer) {_oContainer.innerHTML = _sHTML;}
		}
		return _sHTML;
	}
	/* @end method */
	
	/* @start method */
	this.executeCommandLine = function()
	{
		var _sCommandLineString = this.getCommandLineText();
		this.setCommandLineText({'sText': ''});
		if (_sCommandLineString != '')
		{
			oPGDebugConsole.addMessage({'sString': _sCommandLineString});
			eval(_sCommandLineString);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCommandLineText = function(_sText)
	{
		_sText = this.getRealParameter({'oParameters': _sText, 'sName': 'sText', 'xParameter': _sText});

		if (typeof(oPGInputField) != 'undefined')
		{
			var _sInputFieldID = this.getID()+'CommandLineString';
			oPGInputField.setDataValue({'sInputFieldID': _sInputFieldID, 'iIndex': 0, 'xData': _sText});
		}
		else
		{
			var _oCommandLineElement = this.oDocument.getElementById(_sInputFieldID);
			if (_oCommandLineElement) {_oCommandLineString.value = _sText;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sText [type]string[/type
	[en]...[/en]
	*/
	this.getCommandLineText = function()
	{
		var _sInputFieldID = this.getID()+'CommandLineString';
		if (typeof(oPGInputField) != 'undefined') {return oPGInputField.getDataValue({'sInputFieldID': _sInputFieldID, 'iIndex': 0});}
		else
		{
			var _oCommandLineElement = this.oDocument.getElementById(_sInputFieldID);
			if (_oCommandLineElement) {return _oCommandLineElement.value;}
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCommandLineOnMouseDown = function(_sJavaScriptToExecute)
	{
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sJavaScriptToExecute, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});

		var _sInputFieldID = this.getID()+'CommandLineString';
		if (typeof(oPGInputField) != 'undefined') {oPGInputField.setFieldOnMouseDown({'sInputFieldID': _sInputFieldID, 'iIndex': 0, 'sJavaScriptToExecute': _sJavaScriptToExecute});}
		else
		{
			var _oCommandLineElement = this.oDocument.getElementById(_sInputFieldID);
			if (_oCommandLineElement) {_oCommandLineElement.onclick = function() {eval(_sJavaScriptToExecute);};}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCommandLineOnBlur = function(_sJavaScriptToExecute)
	{
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sJavaScriptToExecute, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});

		var _sInputFieldID = this.getID()+'CommandLineString';
		if (typeof(oPGInputField) != 'undefined') {oPGInputField.setFieldOnBlur({'sInputFieldID': _sInputFieldID, 'iIndex': 0, 'sJavaScriptToExecute': _sJavaScriptToExecute});}
		else
		{
			var _oCommandLineElement = this.oDocument.getElementById(_sInputFieldID);
			if (_oCommandLineElement) {_oCommandLineElement.onblur = function() {eval(_sJavaScriptToExecute);};}
		}
	}
	/* @end method */
	
	/* @start method */
	this.toggleDisplay = function()
	{
		var _oDebugPanel = this.oDocument.getElementById(this.getID()+'Panel');
		if (_oDebugPanel)
		{
			if (_oDebugPanel.style.display == 'none') {_oDebugPanel.style.display = 'block';}
			else {_oDebugPanel.style.display = 'none';}
		}
	}
	/* @end method */
	
	/* @start method */
	this.show = function()
	{
		var _oDebugPanel = this.oDocument.getElementById(this.getID()+'Panel');
		if (_oDebugPanel) {_oDebugPanel.style.display = 'block';}
	}
	/* @end method */
	
	/* @start method */
	this.hide = function()
	{
		var _oDebugPanel = this.oDocument.getElementById(this.getID()+'Panel');
		if (_oDebugPanel) {_oDebugPanel.style.display = 'none';}
	}
	/* @end method */
}
/* @end class */
classPG_DebugConsole.prototype = new classPG_ClassBasics();
var oPGDebugConsole = new classPG_DebugConsole();
window.onerror = oPGDebugConsole.onError;
