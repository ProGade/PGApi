/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
var PG_AJAX_CONTENTTYPE_NONE = '';
var PG_AJAX_CONTENTTYPE_UTF8 = 'application/x-www-form-urlencoded; charset=UTF-8';
var PG_AJAX_CONTENTTYPE_JSON = 'application/json';

var PG_AJAX_RESPONSETYPE_NONE = '';
var PG_AJAX_RESPONSETYPE_XML = '';
var PG_AJAX_RESPONSETYPE_JSON = 'json';

var PG_AJAX_SENDMETHOD_POST = 'POST';
var PG_AJAX_SENDMETHOD_GET = 'GET';

var PG_AJAX_READYSTATE_NONE = 0;
var PG_AJAX_READYSTATE_LOADING = 1;
var PG_AJAX_READYSTATE_LOADED = 2;
var PG_AJAX_READYSTATE_INTERACTIV = 3;
var PG_AJAX_READYSTATE_COMPLETE = 4;

var PG_AJAX_HTTPSTATUS_NOTFOUND = 404;
var PG_AJAX_HTTPSTATUS_OK = 200;

var PG_AJAX_STATUS_NONE = 0;
var PG_AJAX_STATUS_LOADING = 1;
var PG_AJAX_STATUS_PROCESSING = 2;
var PG_AJAX_STATUS_FILENOTFOUND = 3;
var PG_AJAX_STATUS_DONE = 4;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Ajax()
{
	// Declarations...
	this.iHttpStatus = 0;
	this.iReadyState = 0;

    this.sContentType = PG_AJAX_CONTENTTYPE_UTF8;
    this.sResponseType = PG_AJAX_RESPONSETYPE_XML;

	// Construct...
	
	// Methods...
    /*
    @start method

    @param sContentType [needed][type]string[/type]
    [en]...[/en]
    */
    this.setContentType = function(_sContentType)
    {
        _sContentType = this.getRealParameter({'oParameters': _sContentType, 'sName': 'sContentType', 'xParameter': _sContentType});
        this.sContentType = _sContentType;
    }
    /* @end method */

    /*
    @start method

    @return sContentType [type]string[/type]
    [en]...[/en]
    */
    this.getContentType = function() {return this.sContentType;}
    /* @end method */

    /*
    @start method

    @param sResponseType [needed][type]string[/type]
    [en]...[/en]
    */
    this.setResponseType = function(_sResponseType)
    {
        _sResponseType = this.getRealParameter({'oParameters': _sResponseType, 'sName': 'sResponseType', 'xParameter': _sResponseType});
        this.sResponseType = _sResponseType;
    }
    /* @end method */

    /*
    @start method

    @return sResponseType [type]string[/type]
    [en]...[/en]
    */
    this.getResponseType = function() {return this.sResponseType;}
    /* @end method */

	/*
	@start method
	
	@group Status
	
	@description
	[en]...[/en]
	
	@return iStatus [type]int[/type]
	[en]...[/en]
	*/
	this.getStatus = function()
	{
		var _iStatus = 0;
		if (this.iHttpStatus == PG_AJAX_HTTPSTATUS_NOTFOUND) {_iStatus = PG_AJAX_STATUS_FILENOTFOUND;}
		else
		{
			switch(this.iReadyState)
			{
				case PG_AJAX_READYSTATE_NONE: _iStatus = PG_AJAX_STATUS_NONE; break;
				case PG_AJAX_READYSTATE_LOADING: _iStatus = PG_AJAX_STATUS_LOADING; break;
				case PG_AJAX_READYSTATE_LOADED: break;
				case PG_AJAX_READYSTATE_INTERACTIV: _iStatus = PG_AJAX_STATUS_PROCESSING; break;
				case PG_AJAX_READYSTATE_COMPLETE: _iStatus = PG_AJAX_STATUS_DONE; break;
			}
		}
		return _iStatus;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Status
	
	@description
	[en]...[/en]
	
	@param oAjaxRequest [type]object[/type]
	[en]...[/en]
	*/
	this.updateStatus = function(_oAjaxRequest)
	{
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		if (_oAjaxRequest != null)
		{
			this.iReadyState = _oAjaxRequest.readyState;
			this.iHttpStatus = _oAjaxRequest.status;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Request
	
	@description
	[en]...[/en]
	
	@return oAjaxRequest [type]object[/type]
	[en]...[/en]
	*/
	this.createRequestObject = function()
	{
		if (this.oWindow.XMLHttpRequest) {try {return new XMLHttpRequest();} catch(event) {return false;}}
		else if (this.oWindow.ActiveXObject)
		{
			try {return new ActiveXObject("Msxml2.XMLHTTP");}
			catch(event) {try {return new ActiveXObject("Microsoft.XMLHTTP");} catch(event) {return false;}}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Request
	
	@description
	[en]...[/en]
	
	@return oAjaxRequest [type]object[/type]
	[en]...[/en]
	
	@param sResponseFile [needed][type]string[/type]
	[en]...[/en]
	
	@param fResult [type]function[/type]
	[en]...[/en]
	
	@param sSendMethod [type]string[/type]
	[en]...[/en]
	
	@param sResultContentType [type]string[/type]
	[en]...[/en]
	
	@param bRequestPlainText [type]bool[/type]
	[en]...[/en]
	*/
	this.openRequest = function(_sResponseFile, _fResult, _sSendMethod, _sResultContentType, _bRequestPlainText)
	{
		if (typeof(_fResult) == 'undefined') {var _fResult = null;}
		if (typeof(_sSendMethod) == 'undefined') {var _sSendMethod = null;}
		if (typeof(_sResultContentType) == 'undefined') {var _sResultContentType = null;}
		if (typeof(_bRequestPlainText) == 'undefined') {var _bRequestPlainText = null;}

		_fResult = this.getRealParameter({'oParameters': _sResponseFile, 'sName': 'fResult', 'xParameter': _fResult});
		_sSendMethod = this.getRealParameter({'oParameters': _sResponseFile, 'sName': 'sSendMethod', 'xParameter': _sSendMethod});
		_sResultContentType = this.getRealParameter({'oParameters': _sResponseFile, 'sName': 'sResultContentType', 'xParameter': _sResultContentType});
		_bRequestPlainText = this.getRealParameter({'oParameters': _sResponseFile, 'sName': 'bRequestPlainText', 'xParameter': _bRequestPlainText});
		_sResponseFile = this.getRealParameter({'oParameters': _sResponseFile, 'sName': 'sResponseFile', 'xParameter': _sResponseFile});

		if (_sSendMethod == null) {_sSendMethod = PG_AJAX_SENDMETHOD_POST;}
		if (_sResultContentType == null) {_sResultContentType = this.sContentType;}
		
		var _oAjaxRequest = this.createRequestObject();
		if (_oAjaxRequest)
		{
			if ((typeof(_oAjaxRequest.overrideMimeType) != 'undefined') && (_bRequestPlainText == false)) {_oAjaxRequest.overrideMimeType('text/xml');}
			if (_fResult != null) {_oAjaxRequest.onreadystatechange = _fResult;}
			_oAjaxRequest.open(_sSendMethod, _sResponseFile, true);
			if (_sResultContentType != '') {_oAjaxRequest.setRequestHeader('Content-Type', _sResultContentType);}
            if (this.sResponseType != '') {_oAjaxRequest.responseType = this.sResponseType;}
			return _oAjaxRequest;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Streaming
	
	@description
	[en]...[/en]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]...[/en]
	
	@param sResponseFile [needed][type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	
	@param sSendMethod [type]string[/type]
	[en]...[/en]
	
	@param sResultContentType [type]string[/type]
	[en]...[/en]
	
	@param fResult [type]function[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	
	@param iStreamLimit [type]int[/type]
	[en]...[/en]
	*/
	this.streamRequest = function(_oAjaxRequest, _sResponseFile, _oXml, _sSendMethod, _sResultContentType, _fResult, _sParameters, _iStreamLimit)
	{
		if (typeof(_sResponseFile) == 'undefined') {var _sResponseFile = null;}
		if (typeof(_oXml) == 'undefined') {var _oXml = null;}
		if (typeof(_oAjaxRequest) == 'undefined') {var _oAjaxRequest = null;}
		if (typeof(_sSendMethod) == 'undefined') {var _sSendMethod = null;}
		if (typeof(_sResultContentType) == 'undefined') {var _sResultContentType = null;}
		if (typeof(_fResult) == 'undefined') {var _fResult = null;}
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		if (typeof(_sEventType) == 'undefined') {var _sEventType = null;}
		
		_oXml = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oXml', 'xParameter': _oXml});
		_sSendMethod = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'sSendMethod', 'xParameter': _sSendMethod});
		_sResultContentType = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'sResultContentType', 'xParameter': _sResultContentType});
		_fResult = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'fResult', 'xParameter': _fResult});
		_sParameters = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'sParameters', 'xParameter': _sParameters});
		_iStreamLimit = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'iStreamLimit', 'xParameter': _iStreamLimit});
		_sResponseFile = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'sResponseFile', 'xParameter': _sResponseFile});
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		
		if (_oXml)
		{
			if (this.getResultStreamActive({'oXml': _oXml}) == 1)
			{
				if (this.getResultStreamCount({'oXml': _oXml}) > 0)
				{
					if (_iStreamLimit == null) {_iStreamLimit = this.getResultStreamLimit({'oXml': _oXml});}
					_sParameters = "iAjaxStreamActive=1&iAjaxStreamLimit="+_iStreamLimit+"&"+_sParameters;
					this.closeRequest({'oAjaxRequest': _oAjaxRequest});
					this.openRequest({'oAjaxRequest': _oAjaxRequest, 'sResponseFile': _sResponseFile, 'sSendMethod': _sSendMethod, 'sResultContentType': _sResultContentType, 'fResult': _fResult});
					this.sendRequest({'oAjaxRequest': _oAjaxRequest, 'sParameters': _sParameters});
					return;
				}
			}
		}
		this.closeRequest({'oAjaxRequest': _oAjaxRequest});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Streaming
	
	@description
	[en]...[/en]
	
	@return iActive [type]int[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultStreamActive = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_AjaxStreamActive');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_AjaxStreamActive')
				{
					if (_oNode.childNodes.length > 0) {return parseInt(_oNode.childNodes[0].nodeValue);}
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Streaming
	
	@description
	[en]...[/en]
	
	@return sLimit [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultStreamLimit = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_AjaxStreamLimit');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_AjaxStreamLimit')
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Streaming
	
	@description
	[en]...[/en]
	
	@return sCount [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultStreamCount = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_AjaxStreamCount');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_AjaxStreamCount')
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Request
	
	@description
	[en]...[/en]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]...[/en]
	*/
	this.closeRequest = function(_oAjaxRequest)
	{
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		if (_oAjaxRequest) {_oAjaxRequest.abort();}
		_oAjaxRequest = null;
	}
	/* @end method */
	this.stopRequest = this.closeRequest;
	this.abortRequest = this.closeRequest;
	
	/*
	@start method
	
	@group Request
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	*/
	this.sendRequest = function(_oAjaxRequest, _sParameters)
	{
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		
		_sParameters = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'sParameters', 'xParameter': _sParameters});
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		
		if (_oAjaxRequest)
		{
			_oAjaxRequest.send(_sParameters);
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return sXmlText [type]string[/type]
	[en]...[/en]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultDebug = function(_oAjaxRequest)
	{
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		if (_oAjaxRequest)
		{
			if ((_oAjaxRequest.readyState == 4) && (_oAjaxRequest.status == 200)) {return _oAjaxRequest.responseText;}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return oXml [type]object[/type]
	[en]...[/en]
	
	@param oAjaxRequest [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultXmlObject = function(_oAjaxRequest)
	{
		_oAjaxRequest = this.getRealParameter({'oParameters': _oAjaxRequest, 'sName': 'oAjaxRequest', 'xParameter': _oAjaxRequest, 'bNotNull': true});
		if (_oAjaxRequest)
		{
			if ((_oAjaxRequest.readyState == 4) && (_oAjaxRequest.status == 200))
			{
// alert(oPGObjects.getStructureString({'oObject': _oAjaxRequest}));
                if (_oAjaxRequest.responseType == PG_AJAX_RESPONSETYPE_JSON) {return _oAjaxRequest.response;}
				if (_oAjaxRequest.responseXML == null) {return _oAjaxRequest.responseText;}
				var _oXml = _oAjaxRequest.responseXML.documentElement;
				if (_oXml == null) {return _oAjaxRequest.responseText;}
				else {_oXml.normalize();}
				return _oXml;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return sParameters [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultAll = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var i=0;
			var t=0;
			var _oNode = null;
			var _sParameters = '';
			var _oNodeArray = _oXml.childNodes;
			for (i=0; i<_oNodeArray.length; i++)
			{
				if (t>0) {_sParameters += '&_[';}
				_oNode = _oNodeArray[i];
				_sParameters += _oNode.nodeName+']_=';
				if (typeof(_oNode.childNodes) != 'undefined')
				{
					if (_oNode.childNodes.length > 0) {_sParameters += _oNode.childNodes[0].nodeValue;}
				}
				t++;
			}
			return _sParameters;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return oParameters [type]object[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultDataObject = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var i=0;
			var t=0;
			var _oNode = null;
			var _oParameters = {};
			var _oNodeArray = _oXml.childNodes;
			for (i=0; i<_oNodeArray.length; i++)
			{
				_oNode = _oNodeArray[i];
				if (typeof(_oNode.childNodes) != 'undefined')
				{
					if (_oNode.childNodes.length > 0) {_oParameters[_oNode.nodeName] = _oNode.childNodes[0].nodeValue;}
				}
				t++;
			}
			return _oParameters;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return sUserID [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultUserID = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_UserID');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_UserID')
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
			}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return sRequestType [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultRequestType = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_XMLRequestType');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_XMLRequestType')
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
			}
		}
		return '';
	}
	/* @end method */

	/*
	@start method
	
	@group Result
	
	@description
	[en]...[/en]
	
	@return sObjectID [type]string[/type]
	[en]...[/en]
	
	@param oXml [needed][type]object[/type]
	[en]...[/en]
	*/
	this.getResultRequestObjectID = function(_oXml)
	{
		_oXml = this.getRealParameter({'oParameters': _oXml, 'sName': 'oXml', 'xParameter': _oXml, 'bNotNull': true});
		if (_oXml)
		{
			var _oNode = _oXml.getElementsByTagName('PG_XMLRequestObjectID');
			if (_oNode.length > 0)
			{
				_oNode = _oNode[0];
				if (_oNode.nodeName == 'PG_XMLRequestObjectID')
				{
					if (_oNode.childNodes.length > 0) {return _oNode.childNodes[0].nodeValue;}
				}
			}
		}
		return '';
	}
	/* @end method */
}
/* @end class */
classPG_Ajax.prototype = new classPG_ClassBasics();
var oPGAjax = new classPG_Ajax();
