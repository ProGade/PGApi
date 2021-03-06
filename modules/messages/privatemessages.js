/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_PrivateMessages()
{
	// Declarations...
	
	// Construct...
	this.setID('PGPrivateMessages');
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	@param sPrivateMessageID
	*/
	this.init = function(_sPrivateMessageID)
	{
		if (typeof(_sPrivateMessageID) == 'undefined') {var _sPrivateMessageID = null;}
		if (_sPrivateMessageID == null) {_sPrivateMessageID = this.getNextID();}
	
		oPGForm.addTextAreaID(_sPrivateMessageID+'Form', _sPrivateMessageID+'Message');
		oPGForm.setNetworkResponseFile(this.getNetworkResponseFile());
		oPGForm.addUrlParameters(this.getUrlParameters());
	}
	/* @end method */
	
	/*
	@start method
	@param sPrivateMessageID
	@param iSenderID
	@param sSenderEmail
	@param iReceiverID
	@param iCreateTimeStamp
	*/
	this.subjectOnClick = function(_sPrivateMessageID, _iSenderID, _sSenderEmail, _iReceiverID, _iCreateTimeStamp)
	{
		this.privateMessageRequest(_sPrivateMessageID, _iSenderID, _sSenderEmail, _iReceiverID, _iCreateTimeStamp);
	}
	/* @end method */
	
	/*
	@start method
	@param sPrivateMessageID
	@param iSenderID
	@param sSenderEmail
	@param iReceiverID
	@param iCreateTimeStamp
	*/
	this.privateMessageRequest = function(_sPrivateMessageID, _iSenderID, _sSenderEmail, _iReceiverID, _iCreateTimeStamp)
	{
		var _sParameters = '';
		_sParameters += 'sPrivateMessageID='+_sPrivateMessageID;
		_sParameters += '&iSenderID='+_iSenderID;
		_sParameters += '&sSenderEmail='+encodeURIComponent(_sSenderEmail);
		_sParameters += '&iReceiverID='+_iReceiverID;
		_sParameters += '&iCreateTimeStamp='+_iCreateTimeStamp;
		
		var _fOnResponse = oPGPrivateMessages.privateMessageResponse;
		
		this.networkSend(_sParameters, _fOnResponse);
	}
	/* @end method */
	
	/*
	@start method
	@param oResponse
	*/
	this.privateMessageResponse = function(_oResponse)
	{
		var _sPrivateMessageID = _oResponse['PG_PrivateMessageID'];
		// TODO: add UrlParameters:
		/*
		$this->addUrlParameter('sPrivateMessageID', $_sPrivateMessageID);
		$this->addUrlParameter($_sPrivateMessageID.'SenderID', $_POST['iReceiverID']);
		$this->addUrlParameter($_sPrivateMessageID.'SenderEmail', '');
		$this->addUrlParameter($_sPrivateMessageID.'ReceiverID', $_POST['iSenderID']);
		*/
		var _sHTML = '';
		_sHTML += '<div style="padding:10px;">';
			_sHTML += '<div style="text-align:right; display:block;">';
			_sHTML += '<a href="javascript:;" onclick="oPGPopup.hide(\''+_sPrivateMessageID+'Popup\');" target="_self" style="font-size:18px; text-decoration:none; font-weight:bold;">[x]</a>';
			_sHTML += '</div>';
			_sHTML += '<h2>'+_oResponse['PG_Subject']+'</h2>';
			_sHTML += _oResponse['PG_Message'];
			_sHTML += '<br />';
			_sHTML += '<br />';
			_sHTML += _oResponse['PG_Form'];
		_sHTML += '</div>';
		oPGPopup.setContent(_sPrivateMessageID+'Popup', _sHTML);
		oPGPopup.show(_sPrivateMessageID+'Popup', 80, 80);
		oPGForm.checkForJavaScript(_sPrivateMessageID+'Form');
	}
	/* @end method */
}
/* @end class */
classPG_PrivateMessages.prototype = new classPG_ClassBasics();
var oPGPrivateMessages = new classPG_PrivateMessages();