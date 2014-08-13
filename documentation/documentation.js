/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
var PG_DEVDOCU_REQUESTTYPE_CLASSDOCU = 'PGDocumentationRequestTypeClass';
var PG_DEVDOCU_REQUESTTYPE_METHODDOCU = 'PGDocumentationRequestTypeMethod';
var PG_DEVDOCU_REQUESTTYPE_FILECONTENT = 'PGDocumentationRequestTypeFileContent';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Documentation()
{
	// Declarations...
	this.iClassID = 0;
	this.iMethodID = 0;
	this.sLanguage = 'en';
	
	this.bDetailed = false;
	this.bEditable = false;
	
	// Construct...
	this.setID({'sID': 'PGDocumentation'});
	this.initClassBasics();
	this.initNetwork();
	if (typeof(oPGBrowser) != 'undefined') {this.sLanguage = oPGBrowser.getBrowserLanguage();}
	
	// Methods...
	/* @start method */
	this.switchDetails = function()
	{
		if (this.bDetailed == true) {this.bDetailed = false;}
		else {this.bDetailed = true;}
		
		if (this.iMethodID > 0) {this.getDocuMethodContent();}
		else if (this.iClassID > 0) {this.getDocuClassContent();}
	}
	/* @end method */
	
	/* @start method */
	this.hidePopup = function() {oPGPopup.hide(this.getID()+'Popup');}
	/* @end method */
	
	/* @start method */
	this.setLanguage = function(_sLanguage)
	{
		_sLanguage = this.getRealParameter({'oParameters': _sLanguage, 'sName': 'sLanguage', 'xParameter': _sLanguage});
		if (_sLanguage == '') {_sLanguage = 'en';}
		this.sLanguage = _sLanguage;
	}
	/* @end method */
	
	/*
	@start method
	@param iDefineID
	*/
	this.getDefineEditForm = function(_iDefineID)
	{
		_iDefineID = this.getRealParameter({'oParameters': _iDefineID, 'sName': 'iDefineID', 'xParameter': _iDefineID});

		var _sParameters = '';
		_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_CLASSDOCU;
		_sParameters += '&iEditDefineID='+_iDefineID;
		_sParameters += '&iClassID='+this.iClassID;
		this.networkSend(_sParameters, oPGDocumentation.getEditFormResponse, null);
	}
	/* @end method */
	
	/*
	@start method
	@param iPropertyID
	*/
	this.getPropertyEditForm = function(_iPropertyID)
	{
		_iPropertyID = this.getRealParameter({'oParameters': _iPropertyID, 'sName': 'iPropertyID', 'xParameter': _iPropertyID});

		var _sParameters = '';
		_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_CLASSDOCU;
		_sParameters += '&iEditPropertyID='+_iPropertyID;
		_sParameters += '&iClassID='+this.iClassID;
		this.networkSend(_sParameters, oPGDocumentation.getEditFormResponse, null);
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	*/
	this.getClassEditForm = function(_iClassID)
	{
		_iClassID = this.getRealParameter({'oParameters': _iClassID, 'sName': 'iClassID', 'xParameter': _iClassID});

		var _sParameters = '';
		_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_CLASSDOCU;
		_sParameters += '&iEditClassID='+_iClassID;
		this.networkSend(_sParameters, oPGDocumentation.getEditFormResponse, null);
	}
	/* @end method */
	
	/*
	@start method
	@param iParameterID
	*/
	this.getMethodParameterEditForm = function(_iParameterID)
	{
		_iParameterID = this.getRealParameter({'oParameters': _iParameterID, 'sName': 'iParameterID', 'xParameter': _iParameterID});

		var _sParameters = '';
		_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_METHODDOCU;
		_sParameters += '&iEditParameterID='+_iParameterID;
		_sParameters += '&iMethodID='+this.iMethodID;
		_sParameters += '&iClassID='+this.iClassID;
		this.networkSend(_sParameters, oPGDocumentation.getEditFormResponse, null);
	}
	/* @end method */
	
	/*
	@start method
	@param iMethodID
	*/
	this.getMethodEditForm = function(_iMethodID)
	{
		_iMethodID = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'iMethodID', 'xParameter': _iMethodID});

		var _sParameters = '';
		_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_METHODDOCU;
		_sParameters += '&iEditMethodID='+_iMethodID;
		_sParameters += '&iClassID='+this.iClassID;
		this.networkSend(_sParameters, oPGDocumentation.getEditFormResponse, null);
	}
	/* @end method */
	
	/*
	@start method
	@param oParameters
	*/
	this.getEditFormResponse = function(_oParameters)
	{
		if ((_oParameters['PG_RequestType'] == PG_DEVDOCU_REQUESTTYPE_CLASSDOCU)
		|| (_oParameters['PG_RequestType'] == PG_DEVDOCU_REQUESTTYPE_METHODDOCU))
		{
			var _sHtml = '';
			if (_oParameters['PG_HTML'] != '') {_sHtml += _oParameters['PG_HTML'];}
			oPGPopup.setContent(oPGDocumentation.getID()+'Popup', _sHtml);
			oPGPopup.show(oPGDocumentation.getID()+'Popup');
		}
	}
	/* @end method */

	this.getDocuFileContent = function(_iClassID, _sFile, _sClass, _sLanguage, _bDetailed, _sResponseXml, _fAjaxResult)
	{
		if (typeof(_iClassID) == 'undefined') {var _iClassID = null;}
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_sClass) == 'undefined') {var _sClass = null;}
		if (typeof(_bDetailed) == 'undefined') {var _bDetailed = null;}
		if (typeof(_sLanguage) == 'undefined') {var _sLanguage = null;}
		if (typeof(_sResponseXml) == 'undefined') {var _sResponseXml = null;}
		if (typeof(_fAjaxResult) == 'undefined') {var _fAjaxResult = null;}

		_sFile = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sFile', 'xParameter': _sFile});
		_sClass = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sClass', 'xParameter': _sClass});
		_bDetailed = this.getRealParameter({'oParameters': _iClassID, 'sName': 'bDetailed', 'xParameter': _bDetailed});
		_sLanguage = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sLanguage', 'xParameter': _sLanguage});
		_sResponseXml = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sResponseXml', 'xParameter': _sResponseXml});
		_fAjaxResult = this.getRealParameter({'oParameters': _iClassID, 'sName': 'fAjaxResult', 'xParameter': _fAjaxResult});
		_iClassID = this.getRealParameter({'oParameters': _iClassID, 'sName': 'iClassID', 'xParameter': _iClassID});

		this.iMethodID = 0;
		if (_iClassID != null) {this.iClassID = _iClassID;}
		if (_sLanguage != null) {this.sLanguage = _sLanguage;}
		if (_bDetailed != null) {this.bDetailed = _bDetailed;}
		if (_fAjaxResult == null) {_fAjaxResult = oPGDocumentation.onGetDocuContentResponse;}
		
		if (_sClass != null) {this.getDocuClassContent({'iClassID': _iClassID, 'sFile': _sFile, 'sClass': _sClass, 'sLanguage': _sLanguage, 'bDetailed': _bDetailed, 'sResponseXml': _sResponseXml, 'fAjaxResult': _fAjaxResult});}
		else if (_sFile != null)
		{
			var _sParameters = '';
			_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_FILECONTENT;
			_sParameters += '&sFile='+_sFile;
			_sParameters += '&sLanguage='+this.sLanguage;
			if (this.bDetailed == true) {_sParameters += '&iDetailed=1';}
			if (this.bEditable == true) {_sParameters += '&iEditable=1';}

			this.networkSend(_sParameters, _fAjaxResult, _sResponseXml);
		}
	}
	
	/*
	@start method
	@param iClassID
	@param sFile
	@param sClass
	@param bDetailed
	@param sResponseXml
	@param fAjaxResult
	*/
	this.getDocuClassContent = function(_iClassID, _sFile, _sClass, _sLanguage, _bDetailed, _sResponseXml, _fAjaxResult)
	{
		if (typeof(_iClassID) == 'undefined') {var _iClassID = null;}
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_sClass) == 'undefined') {var _sClass = null;}
		if (typeof(_bDetailed) == 'undefined') {var _bDetailed = null;}
		if (typeof(_sLanguage) == 'undefined') {var _sLanguage = null;}
		if (typeof(_sResponseXml) == 'undefined') {var _sResponseXml = null;}
		if (typeof(_fAjaxResult) == 'undefined') {var _fAjaxResult = null;}

		_sFile = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sFile', 'xParameter': _sFile});
		_sClass = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sClass', 'xParameter': _sClass});
		_bDetailed = this.getRealParameter({'oParameters': _iClassID, 'sName': 'bDetailed', 'xParameter': _bDetailed});
		_sLanguage = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sLanguage', 'xParameter': _sLanguage});
		_sResponseXml = this.getRealParameter({'oParameters': _iClassID, 'sName': 'sResponseXml', 'xParameter': _sResponseXml});
		_fAjaxResult = this.getRealParameter({'oParameters': _iClassID, 'sName': 'fAjaxResult', 'xParameter': _fAjaxResult});
		_iClassID = this.getRealParameter({'oParameters': _iClassID, 'sName': 'iClassID', 'xParameter': _iClassID});

		this.iMethodID = 0;
		if (_iClassID != null) {this.iClassID = _iClassID;}
		if (_bDetailed != null) {this.bDetailed = _bDetailed;}
		if (_fAjaxResult == null) {_fAjaxResult = oPGDocumentation.onGetDocuContentResponse;}
		
		if ((this.iClassID != null) || ((_sFile != '') && (_sClass != '')))
		{
			var _sParameters = '';
			_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_CLASSDOCU;
			if (this.iClassID != null) {_sParameters += '&iClassID='+this.iClassID;}
			if (_sFile != null) {_sParameters += '&sFile='+_sFile;}
			_sParameters += '&sLanguage='+this.sLanguage;
			if (_sClass != null) {_sParameters += '&sClass='+_sClass;}
			if (this.bDetailed == true) {_sParameters += '&iDetailed=1';}
			if (this.bEditable == true) {_sParameters += '&iEditable=1';}
			
			this.networkSend(_sParameters, _fAjaxResult, _sResponseXml);
		}
	}
	/* @end method */
	
	/*
	@start method
	@param iMethodID
	@param sFile
	@param sMethod
	@param bDetailed
	@param sResponseXml
	@param fAjaxResult
	*/
	this.getDocuMethodContent = function(_iMethodID, _sFile, _sClass, _sMethod, _bDetailed, _sResponseXml, _fAjaxResult)
	{
		if (typeof(_iMethodID) == 'undefined') {var _iMethodID = null;}
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_sClass) == 'undefined') {var _sClass = null;}
		if (typeof(_sMethod) == 'undefined') {var _sMethod = null;}
		if (typeof(_bDetailed) == 'undefined') {var _bDetailed = null;}
		if (typeof(_sResponseXml) == 'undefined') {var _sResponseXml = null;}
		if (typeof(_fAjaxResult) == 'undefined') {var _fAjaxResult = null;}

		_sFile = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'sFile', 'xParameter': _sFile});
		_sClass = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'sClass', 'xParameter': _sClass});
		_sMethod = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'sMethod', 'xParameter': _sMethod});
		_bDetailed = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'bDetailed', 'xParameter': _bDetailed});
		_sResponseXml = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'sResponseXml', 'xParameter': _sResponseXml});
		_fAjaxResult = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'fAjaxResult', 'xParameter': _fAjaxResult});
		_iMethodID = this.getRealParameter({'oParameters': _iMethodID, 'sName': 'iMethodID', 'xParameter': _iMethodID});

		if (_iMethodID != null) {this.iMethodID = _iMethodID;}
		if (_bDetailed != null) {this.bDetailed = _bDetailed;}
		if (_fAjaxResult == null) {_fAjaxResult = oPGDocumentation.onGetDocuContentResponse;}
		
		if ((this.iMethodID != null) || ((sFile != null) && (_sMethod != null)))
		{
			var _sParameters = '';
			_sParameters += 'sRequestType='+PG_DEVDOCU_REQUESTTYPE_METHODDOCU;
			if (this.iMethodID != null) {_sParameters += '&iMethodID='+this.iMethodID;}
			if (_sFile != null) {_sParameters += '&sFile='+_sFile;}
			_sParameters += '&sLanguage='+this.sLanguage;
			if (_sClass != null) {_sParameters += '&sClass='+_sClass;}
			if (_sMethod != null) {_sParameters += '&sMethod='+_sMethod;}
			if (this.bDetailed == true) {_sParameters += '&iDetailed=1';}
			if (this.bEditable == true) {_sParameters += '&iEditable=1';}
// alert(_sParameters);
			this.networkSend(_sParameters, _fAjaxResult, _sResponseXml);
		}
	}
	/* @end method */
	
	/*
	@start method
	@param oParameters
	*/
	this.onGetDocuContentResponse = function(_oParameters)
	{
		/*if ((_oParameters['PG_RequestType'] == PG_DEVDOCU_REQUESTTYPE_CLASSDOCU)
		|| (_oParameters['PG_RequestType'] == PG_DEVDOCU_REQUESTTYPE_METHODDOCU))
		{*/
			var _sHtml = '';
			if (_oParameters['PG_DocuContentHtml'] != '') {_sHtml += _oParameters['PG_DocuContentHtml'];}
// alert(_sHtml);
			var _oDocuContent = oPGDocumentation.oDocument.getElementById(oPGDocumentation.getID()+'DocuContent');
			if (_oDocuContent)
			{
				_oDocuContent.innerHTML = _sHtml;
				oPGFrame.setScrollPos({'sFrameID': oPGDocumentation.getID()+'SubFramesetFrame1', 'iPosX': 0, 'iPosY': 0});
			}
		// }
	}
	/* @end method */
	
	/*
	@start method
	@return bSuccess
	@param sMenuID
	*/
	this.showMenu = function(_sMenuID)
	{
		_sMenuID = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'sMenuID', 'xParameter': _sMenuID});
		var _oMenu = this.oDocument.getElementById(_sMenuID);
		if (_oMenu) {_oMenu.style.display = 'block'; return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	@return bSuccess
	@param sMenuID
	*/
	this.hideMenu = function(_sMenuID)
	{
		_sMenuID = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'sMenuID', 'xParameter': _sMenuID});
		var _oMenu = this.oDocument.getElementById(_sMenuID);
		if (_oMenu) {_oMenu.style.display = 'none'; return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	@return bDisplay
	@param sMenuID
	*/
	this.switchMenuDisplay = function(_sMenuID)
	{
		_sMenuID = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'sMenuID', 'xParameter': _sMenuID});
		var _oMenu = this.oDocument.getElementById(_sMenuID);
		if (_oMenu)
		{
			if (_oMenu.style.display == 'none') {_oMenu.style.display = 'block'; return true;}
			else {_oMenu.style.display = 'none'; return false;}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	@return bOpen
	@param sMenuPointID
	@param bOpen
	*/
	this.switchMenuPoint = function(_sMenuPointID, _bOpen)
	{
		if (typeof(_bOpen) == 'undefined') {var _bOpen = null;}

		_bOpen = this.getRealParameter({'oParameters': _sMenuPointID, 'sName': 'bOpen', 'xParameter': _bOpen});
		_sMenuPointID = this.getRealParameter({'oParameters': _sMenuPointID, 'sName': 'sMenuPointID', 'xParameter': _sMenuPointID});
		
		var _oMenuPoint = this.oDocument.getElementById(_sMenuPointID);
		if (_oMenuPoint)
		{
			if (_bOpen == true) {_oMenuPoint.style.listStyleType = 'disc'; return true;}
			else {_oMenuPoint.style.listStyleType = 'circle'; return false;}
		}
		return false;
	}
	/* @end method */
	
	/* @start method */
	this.onMenuPointMouseUp = function(_sMenuID, _sSubMenu, _iMenuPointIndex)
	{
		if (typeof(_sSubMenu) == 'undefined') {var _sSubMenu = null;}
		if (typeof(_iMenuPointIndex) == 'undefined') {var _iMenuPointIndex = null;}

		_sSubMenu = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'sSubMenu', 'xParameter': _sSubMenu});
		_iMenuPointIndex = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'iMenuPointIndex', 'xParameter': _iMenuPointIndex});
		_sMenuID = this.getRealParameter({'oParameters': _sMenuID, 'sName': 'sMenuID', 'xParameter': _sMenuID});
		
		this.switchMenuPoint({'sMenuPointID': _sMenuID+'_Point'+_iMenuPointIndex, 'bOpen': this.switchMenuDisplay({'sMenuID': _sMenuID+'_'+_sSubMenu})});
	}
	/* @end method */
}
/* @end class */
classPG_Documentation.prototype = new classPG_ClassBasics();
var oPGDocumentation = new classPG_Documentation();