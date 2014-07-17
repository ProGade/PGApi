/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 23 2012
*/
/*
@start class

@description
[en]This class has methods to authenticate users and their general user status.[/en]
[de]Diese Klasse verfügt über Methoden zur Authentifizierung von Benutzern und dessen allgemeiner Benutzerstatus.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Login()
{
	// Declarations...
	this.sCaptchaFile = 'system/captcha.php';

	// Construct...
	this.setID({'sID': 'PGLogin'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the file path or URL to the captcha file.[/en]
	[de]Setzt den Dateipfad bzw. die URL zur Captcha Datei.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file path or URL.[/en]
	[de]Der Dateipfad bzw. die URL.[/de]
	*/
	this.setCaptchaFile = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		this.sCaptchaFile = _sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the file path or URL to the captcha file.[/en]
	[de]Gibt den Dateipfad bzw. die URL zur Captcha Datei zurück.[/de]
	
	@return sFile [type]string[/type]
	[en]Returns the file path or URL to the captcha file as a string.[/en]
	[de]Gibt den Dateipfad bzw. die URL zur Captcha Datei als String zurück.[/de]
	*/
	this.getCaptchaFile = function() {return this.sCaptchaFile;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Loads a newly generated captcha from the server.[/en]
	[de]Lädt ein neu generiertes Captcha vom Server.[/de]
	*/
	this.loadCaptcha = function()
	{
		if (typeof(oPGSecurityCode) != 'undefined')
		{
			oPGCaptcha.setCaptchaImageContainerID(this.getID()+'CaptchaImage');
			oPGCaptcha.setCaptchaHiddenInputID(this.getID()+'Captcha');
			oPGCaptcha.networkRequestCaptcha(this.sCaptchaFile);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the login button inactive on click, so that the form can't be sent more than once.[/en]
	[de]Setzt den Login Button beim anklicken inaktiv, damit das Formular nicht mehrmals abgeschickt wird.[/de]
	*/
	this.loginButtonOnClick = function()
	{
		var _oLoginButton = this.oDocument.getElementById(this.getID()+'ButtonLogin');
		if (_oLoginButton) {_oLoginButton.disable = true;}
	}
	/* @end method */
}
/* @end class */
classPG_Login.prototype = new classPG_ClassBasics();
var oPGLogin = new classPG_Login();