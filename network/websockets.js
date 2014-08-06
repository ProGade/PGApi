/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 22 2012
*/
var PG_WEBSOCKETS_CONNECTING = 0;
var PG_WEBSOCKETS_OPEN = 1;
var PG_WEBSOCKETS_CLOSING = 2;
var PG_WEBSOCKETS_CLOSED = 3;

var PG_WEBSOCKETS_MESSAGE_INDEX_SENDTO = 0;
var PG_WEBSOCKETS_MESSAGE_INDEX_ACTION = 1;
var PG_WEBSOCKETS_MESSAGE_INDEX_CONTENTDATA = 2;

/*
@start class
*/
function classPG_WebSockets()
{
	// Declarations...
	this.oWindow = window;
	this.oDocument = document;
	
	this.sWebSocketUrl = 'ws://127.0.0.1';
	this.iWebSocketPort = 4502;
	this.sWebSocketPath = 'server.php';
	this.oConnection = null;
	
	this.sMessageDataSeperator = "**";
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setWebSocketUrl = function(_sUrl) {this.sWebSocketUrl = _sUrl;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return sWebSocketUrl [type]string[/type]
	[en]...[/en]
	*/
	this.getWebSocketUrl = function() {return this.sWebSocketUrl;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param iPort [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setWebSocketPort = function(_iPort) {this.iWebSocketPort = _iPort;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return iWebSocketPort [type]int[/type]
	[en]...[/en]
	*/
	this.getWebSocketPort = function() {return this.iWebSocketPort;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setWebSocketPath = function(_sPath) {this.sWebSocketPath = _sPath;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return sWebSocketPath [type]string[/type]
	[en]...[/en]
	*/
	this.getWebSocketPath = function() {return this.sWebSocketPath;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bIsSupported [type]bool[/type]
	[en]...[/en]
	*/
	this.isSupported = function()
	{
		if (typeof(this.oWindow.WebSocket) != 'undefined') {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	this.output = function(_sMessage)
	{
		_sMessage = this.getRealParameter({'oParameters': _sMessage, 'sName': 'sMessage', 'xParameter': _sMessage});
		var _oOutputContainer = this.oDocument.getElementById('PGOutputBox');
		if (_oOutputContainer) {_oOutputContainer.innerHTML += _sMessage+'<br />';}
	}
	/* @end method */

	/*
	@start method

	@description
	[en]...[/en]
	*/
	this.open = function()
	{
		var _sUrl = this.sWebSocketUrl;
		if (this.iWebSocketPort != null) {_sUrl += ':'+this.iWebSocketPort;}
		if (this.sWebSocketPath != null) {_sUrl += '/'+this.sWebSocketPath;}

		this.close();
		if (this.isSupported())
		{
			this.output({'sMessage': 'supported'});
			this.oConnection = new WebSocket(_sUrl);
			if (this.oConnection)
			{
				this.oConnection.onopen = function(_eEvent)
				{
					if (!_eEvent) {_eEvent = event;}
					oPGWebSockets.output({'sMessage': 'successfully opened ('+this.readyState+')...'});
				};
				
				this.oConnection.onmessage = function(_eEvent)
				{
					if (!_eEvent) {_eEvent = event;}
					var _sMessage = _eEvent.data;
					var _asMessage = _sMessage.split(oPGWebSockets.sMessageDataSeperator);
					// oPGWebSockets.output('Complete Data: '+_sMessage);
					
					switch (_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_ACTION])
					{
						case 'chat':
							oPGWebSockets.output({'sMessage': _asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_CONTENTDATA]});
						break;
					}
				};
				
				this.oConnection.onclose = function(_eEvent)
				{
					if (!_eEvent) {_eEvent = event;}
					/*var _oCloseEvent = new CloseEvent(); */
					oPGWebSockets.output({'sMessage': '...successfully closed ('+this.readyState+').'});
					/*
					var _sWasClean = '';
					var _sCode = '';
					var _sReason = '';
					document.body.innerHTML += "...closed<br />Reason: "+_eEvent.reason+"<br />Code: "+_eEvent.code+"<br />Was Clean: "+_eEvent.wasClean;
					var _oCloseEvent = CloseEvent(_eEvent);
					document.body.innerHTML += "...closed<br />Reason: "+_oCloseEvent.reason+"<br />Code: "+_oCloseEvent.code+"<br />Was Clean: "+_oCloseEvent.wasClean;
					_oCloseEvent.initCloseEvent("close", false, false, _sWasClean, _sCode, _sReason);
					document.body.innerHTML += "...closed<br />Reason: "+_sReason+"<br />Code: "+_sCode+"<br />Was Clean: "+_sWasClean;
					*/
					oPGWebSockets.output({'sMessage': oPGVars.getStructureString({'xVar': _eEvent, 'bUseHtml': true})});
				};
				
				this.oConnection.onerror = function(_eEvent)
				{
					if (!_eEvent) {_eEvent = event;}
					oPGWebSockets.output({'sMessage': '...error ('+this.readyState+')!'});
					oPGWebSockets.output({'sMessage': _eEvent.data});
					/*if ((oPGWebSockets.oConnection.readyState == PG_WEBSOCKETS_OPEN)
					|| (oPGWebSockets.oConnection.readyState == PG_WEBSOCKETS_CLOSING))
					{
						oPGWebSockets.output(oPGWebSockets.oConnection.error);
					}*/
					oPGWebSockets.output({'sMessage': oPGVars.getStructureString({'xVar': _eEvent, 'bUseHtml': true})});
					// oPGWebSockets.output(oPGVars.getStructureString(arguments.callee, true));
					// oPGWebSockets.output(arguments.callee.name);
				};
			}
		}
	}
	/* @end method */
	
	/*
	@start method

	@description
	[en]...[/en]
	*/
	this.close = function()
	{
		if (this.oConnection) {this.oConnection.close();}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param sSendTo [type]string[/type]
	[en]...[/en]
	
	@param sAction [type]string[/type]
	[en]...[/en]
	*/
	this.send = function(_sMessage, _sSendTo, _sAction)
	{
		if (typeof(_sSendTo) == 'undefined') {var _sSendTo = null;}
		if (typeof(_sAction) == 'undefined') {var _sAction = null;}
		
		_sSendTo = this.getRealParameter({'oParameters': _sMessage, 'sName': 'sSendTo', 'xParameter': _sSendTo});
		_sAction = this.getRealParameter({'oParameters': _sMessage, 'sName': 'sAction', 'xParameter': _sAction});
		_sMessage = this.getRealParameter({'oParameters': _sMessage, 'sName': 'sMessage', 'xParameter': _sMessage});
		
		if (this.oConnection)
		{
			if (_sSendTo == null) {_sSendTo = 'other';}
			if (_sAction == null) {_sAction = 'chat';}
			if (this.oConnection.readyState == PG_WEBSOCKETS_OPEN)
			{
				this.oConnection.send(_sSendTo+this.sMessageDataSeperator+_sAction+this.sMessageDataSeperator+_sMessage);
			}
			else {alert('Sockets are not open!\n'+this.oConnection.readyState);}
		}
	}
	/* @end method */
}
/* @end class */
classPG_WebSockets.prototype = new classPG_ClassBasics();
var oPGWebSockets = new classPG_WebSockets();
