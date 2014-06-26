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
function classPG_Captcha()
{
	// Declarations...
	this.sCaptchaImageContainerID = '';
	this.sCaptchaHiddenInputID = '';

	// Construct...
	this.setID('PGCaptcha');
	this.initClassBasics();

	// Methods...	
	/*
	@start method
	
	@param sContainerID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCaptchaImageContainerID = function(_sContainerID)
	{
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		this.sCaptchaImageContainerID = _sContainerID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.getCaptchaImageContainerID = function() {return this.sCaptchaImageContainerID;}
	/* @end method */
	
	/*
	@start method
	
	@param sHiddenInputID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCaptchaHiddenInputID = function(_sHiddenInputID)
	{
		_sHiddenInputID = this.getRealParameter({'oParameters': _sHiddenInputID, 'sName': 'sHiddenInputID', 'xParameter': _sHiddenInputID});
		this.sCaptchaHiddenInputID = _sHiddenInputID;
	}
	/* @end method */

	/*
	@start method
	
	@return sHiddenInputID [type]string[/type]
	[en]...[/en]
	*/
	this.getCaptchaHiddenInputID = function() {return this.sCaptchaHiddenInputID;}
	/* @end method */
	
	/*
	@start method
	
	@param sResponseFile [needed][type]string[/type]
	[en]...[/en]
	*/
	this.networkRequestSecurityCode = function(_sResponseFile)
	{
		_sParameters = null;
		_fOnResponse = oPGCaptcha.networkResponseCaptcha;
		this.networkSend({'sParameters': _sParameters, 'fOnResponse': _fOnResponse, 'sResponseFile': _sResponseFile});
	}
	/* @end method */
	
	/*
	@start method
	
	@param oResponse [needed][type]object[/type]
	[en]...[/en]
	*/
	this.networkResponseCaptcha = function(_oResponse)
	{
		var _oContainer = oPGCaptcha.oDocument.getElementById(oPGCaptcha.sCaptchaImageContainerID);
		if (_oContainer) {_oContainer.innerHTML = _oResponse['PGCaptchaImage'];}
		
		var _oHiddenInput = oPGCaptcha.oDocument.getElementById(oPGCaptcha.sCaptchaHiddenInputID);
		if (_oHiddenInput) {_oHiddenInput.value = _oResponse['PGCaptcha'];}
	}
	/* @end method */
}
/* @end class */
classPG_Captcha.prototype = new classPG_ClassBasics();
var oPGCaptcha = new classPG_Captcha();
