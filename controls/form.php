<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 06 2012
*/
define('PG_FORM_ELEMENTS_INDEX_TYPE', 0);
define('PG_FORM_ELEMENTS_INDEX_LABELNAME', 1);
define('PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX', 2);

// HiddenField...
define('PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX);
define('PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_VALUE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+1);

// InputField...
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MODE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+1);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SIZEX', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+2);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_VALUE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+3);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_NOVALUE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+4);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETID', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+5);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ACCESSKEY', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+6);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_REQUIRED', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+7);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MAXLENGTH', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+8);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_TABINDEX', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+9);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+10);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SENDPARAMETERS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+11);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONBLUR', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+12);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONFOCUS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+13);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYDOWN', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+14);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYUP', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+15);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONCLICK', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+16);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEDOWN', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+17);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEUP', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+18);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOVER', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+19);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOUT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+20);
		
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETSELECT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+21);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONSWITCHEDITMODE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+22);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETCREATE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+23);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETUPATE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+24);
define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETDELETE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+25);

define('PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SAVESTRUCTURE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+26);

// TextArea...
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_MODE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+1);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_SIZEX', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+2);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ROWS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+3);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_TEXT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+4);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_NODATATEXT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+5);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ACCESSKEY', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+6);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_REQUIRED', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+7);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_MAXLENGTH', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+8);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_TABINDEX', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+9);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_LINEBREAKCHARCOUNT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+10);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_FREESPACECHARCOUNT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+11);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_SENDPARAMETERS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+12);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONBLUR', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+13);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONFOCUS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+14);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYDOWN', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+15);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYUP', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+16);

define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONCLICK', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+17);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEDOWN', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+18);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEUP', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+19);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOVER', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+20);
define('PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOUT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+21);

// CheckBox...
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_MODE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+1);

define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_SELECTEDSTATUS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+2);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_STATUSSTRUCTURE', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+3);

define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_SENDPARAMETERS', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+4);

define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONCLICK', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+5);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEDOWN', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+6);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEUP', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+7);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOVER', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+8);
define('PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOUT', PG_FORM_ELEMENTS_INDEX_FIRST_SUBINDEX+9);

// TODO:
// 1. check all Names of Inputs if HIGH and MEDIUM secure (but only for error log?)
// 2. convert to 
//		- PG_FORM_SECURE_LOG_LEVEL_...
//		- PG_FORM_SECURE_ACTION_LEVEL_... // on iSecureActionLevelOnHiddenInputErrors, iSecureActionLevelOnInputFieldErrors and iSecureActionLevelOnCheckBoxErrors
// 		- bSecureBuildWithoutHiddenInputs = false
// 3. Log Hackers UserID and Ban if he tries to many times on bSecureBanUserOnHacking = false, iSecureBanUserOnHackingForHours = 3 (0=forever) and iSecureBanUserOnHackingCounts = 10
// 4. Log Hackers IP (md5) and Ban if he tries to many times on bSecureBanIPOnHacking = false, iSecureBanIPOnHackingForHours = 3 and iSecureBanIPOnHackingCounts = 10

// TODO: Unterscheiden zwischen Hack und Session ist abgelaufen!

define('PG_FORM_SECURE_LOG_LEVEL_NONE', 0);			// ignore secure data (no session)
define('PG_FORM_SECURE_LOG_LEVEL_LOW', 1);			// log errors on wrong form data
define('PG_FORM_SECURE_LOG_LEVEL_MEDIUM', 2);		// TODO: log errors and number of violations
define('PG_FORM_SECURE_LOG_LEVEL_HIGH', 3);			// TODO: log errors and number of violations and send a Mail

define('PG_FORM_SECURE_ACTION_LEVEL_NONE', 0);		// ignore secure data (no session)
define('PG_FORM_SECURE_ACTION_LEVEL_LOW', 1);		// use secure data instead of form data
define('PG_FORM_SECURE_ACTION_LEVEL_MEDIUM', 2);	// use secure data and block content if form data is wrong
define('PG_FORM_SECURE_ACTION_LEVEL_HIGH', 3);		// TODO: use secure data and block content if form data is wrong and use Ban Settings for users an ip adresses

/*
@start class

@var FormSecureLogLevel
PG_FORM_SECURE_LOG_LEVEL_NONE // ignore secure data (no session)
PG_FORM_SECURE_LOG_LEVEL_LOW // log errors on wrong form data
PG_FORM_SECURE_LOG_LEVEL_MEDIUM // TODO: log errors and number of violations
PG_FORM_SECURE_LOG_LEVEL_HIGH // TODO: log errors and number of violations and send a Mail

@var FormSecureActionLevel
PG_FORM_SECURE_ACTION_LEVEL_NONE // ignore secure data (no session)
PG_FORM_SECURE_ACTION_LEVEL_LOW // use secure data instead of form data
PG_FORM_SECURE_ACTION_LEVEL_MEDIUM // use secure data and block content if form data is wrong
PG_FORM_SECURE_ACTION_LEVEL_HIGH // TODO: use secure data and block content if form data is wrong and use Ban Settings for users an ip adresses

@var InputFieldModeDefines
TODO!

@var TextAreaModeDefines
TODO!

@var CheckBoxModeDefines
TODO!

@description
[en]The class has methods to create forms.[/en]
[de]Die Klasse verfügt über Methoden zum erstellen von Formularen.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Form extends classPG_ClassBasics
{
	// Declarations...
	private $axFormElements = array();
	
	private $sFormMethod = 'post';
	private $iSecureLogLevel = PG_FORM_SECURE_LOG_LEVEL_HIGH;
	private $iSecureActionLevel = PG_FORM_SECURE_ACTION_LEVEL_HIGH;
	private $axFormSecureErrors = array();
	
	/*
	TODO...
	private $bSecureBanUserOnHacking = false;
	private $iSecureBanUserOnHackingCounts = 10;
	private $iSecureBanUserOnHackingForHours = 24;

	private $bSecureBanIPOnHacking = false;
	private $iSecureBanIPOnHackingCounts = 10;
	private $iSecureBanIPOnHackingForHours = 24;
	*/
	
	private $bNetworkSend = false;
	private $bJavaScriptAutoRegister = true;
	private $bSecureBuildWithoutHiddenInputs = false;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGForm'));
		$this->initClassBasics();
		$this->initTemplate();
		$this->setText(
			array('xType' => 
				array(
					'SubmitButtonText' => 'send',
					'AbortButtonText' => 'abort',
					'SessionExpired' => 'Your session is expired!',
					'WrongFormToken' => 'Wrong form token!'
				)
			)
		);
		// $this->setUrl(array('sUrl' => 'index.php'));
		// $this->setUrlTarget(array('sTarget' => '_self'));
	}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the method on which the form should be sent.[/en]
	[de]Setzt die Methode über die das Formular gesendet werden soll.[/de]
	
	@param sMethod [needed][type]string[/type]
	[en]The method to the transfer the form data. "post" or "get" are possible. (Default: post)[/en]
	[de]Die Methode zum übertragen der Formulardaten. Möglich sind "post" oder "get". (Standard: post)[/de]
	*/
	public function setFormMethod($_sMethod)
	{
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sMethod, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$this->sFormMethod = $_sMethod;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the method to send the form data.[/en]
	[de]Gibt die Methode zum Senden der Formulardaten zurück.[/de]
	
	@return sFormMethod [type]string[/type]
	[en]Returns the method to send the form data as a string.[/en]
	[de]Gibt die Methode zum Senden der Formulardaten als String zurück.[/de]
	*/
	public function getFormMethod() {return $this->sFormMethod;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns error messages to the security system. With the messages you can see exactly what constitutes a security problem.[/en]
	[de]Gibt Fehlermeldungen zum Sicherheitssystem zurück. Mit den Meldungen kann man erkennen was genau ein Sicherheitsproblem darstellt.[/de]
	
	@return axSecureErrors [type]mixed[][/type]
	[en]Returns error messages to the security system as an mixed array.[/en]
	[de]Gibt Fehlermeldungen zum Sicherheitssystem als gemischter Array zurück.[/de]
	*/
	public function getSecureErrors()
	{
		return $this->axFormSecureErrors;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Specifies whether to send the form data through the network functions of the API.[/en]
	[de]Gibt an ob die Formulardaten über die Network-Funktionen der API gesendet werden sollen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether to send the form data through the network functions of the API. If false, the data is sent in the traditional way using HTML Submit.[/en]
	[de]Gibt an ob die Formulardaten über die Network-Funktionen der API gesendet werden sollen. Bei false werden die Daten auf traditionelle Weise per HTML Submit gesendet.[/de]
	*/
	public function useNetworkSend($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bNetworkSend = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether the form data should be sent over the network functions of the API.[/en]
	[de]Gibt zurück, ob die Formulardaten über die Netzwerk-Funktionen der API gesendet werden sollen.[/de]
	
	@return bNetworkSend [type]bool[/type]
	[en]Returns a boolean whether the form data should be sent over the network functions of the API.[/en]
	[de]Gibt einen Boolean zurück, ob die Formulardaten über die Netzwerk-Funktionen der API gesendet werden sollen.[/de]
	*/
	public function isNetworkSend() {return $this->bNetworkSend;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Specifies whether form fields will automatically be registered in JavaScript. (Default: true)[/en]
	[de]Gibt an ob Formularfelder automatisch in JavaScript registriert werden sollen. (Standard: true)[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether form fields will automatically be registered in JavaScript. (Default: true)[/en]
	[de]Gibt an ob Formularfelder automatisch in JavaScript registriert werden sollen. (Standard: true)[/de]
	*/
	public function useJavaScriptAutoRegister($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bJavaScriptAutoRegister = (bool)$_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether form fields in JavaScript will automatically be registered.[/en]
	[de]Gibt zurück, ob Formularfelder in JavaScript automatisch registriert werden sollen.[/de]
	
	@return bAutoRegister [type]bool[/type]
	[en]Returns a boolean whether form fields in JavaScript will automatically be registered.[/en]
	[de]Gibt einen Boolean zurück, ob Formularfelder in JavaScript automatisch registriert werden sollen.[/de]
	*/
	public function isJavaScriptAutoRegister() {return $this->bJavaScriptAutoRegister;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether the form was already sent.[/en]
	[de]Gibt zurück, ob das Formular bereits abgeschickt wurde.[/de]
	
	@return bIsSend [type]bool[/type]
	[en]Returns a boolean whether the form was already sent.[/en]
	[de]Gibt einen Boolean zurück, ob das Formular bereits abgeschickt wurde.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form, which should be queried.[/en]
	[de]Die ID des Formulars, welches abgefragt werden soll.[/de]
	*/
	public function isSend($_sFormID)
	{
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		return $this->isSubmitted(array('sFormID' => $_sFormID));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether the form was already sent.[/en]
	[de]Gibt zurück, ob das Formular bereits abgeschickt wurde.[/de]
	
	@return bIsSubmitted [type]bool[/type]
	[en]Returns a boolean whether the form was already sent.[/en]
	[de]Gibt einen Boolean zurück, ob das Formular bereits abgeschickt wurde.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form, which should be queried.[/en]
	[de]Die ID des Formulars, welches abgefragt werden soll.[/de]
	*/
	public function isSubmitted($_sFormID)
	{
		global $_POST;
		
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));

		if (isset($_POST[$_sFormID.'Submit'])) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the action that is to be executed after send the form.[/en]
	[de]Gibt die Aktion zurück, die nach dem senden des Formulars ausgeführt werden soll.[/de]
	*/
	public function getSubmittedAction($_sFormID)
	{
		global $_POST, $_GET;
	
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));

		if (isset($_POST[$_sFormID.'Submit'])) {return $_POST[$_sFormID.'Submit'];}
		else if (isset($_GET[$_sFormID.'Submit'])) {return $_GET[$_sFormID.'Submit'];}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the security level to be used for logging in the transmission of the form.[/en]
	[de]Setzt den Sicherheitslevel der für das Loggen beim Übertragung des Formulars verwendet werden soll.[/de]
	
	@param iLevel [needed][type]int[/type]
	[en]
		The security level for the log.
		The following defines are possible:
		%FormSecureLogLevel%
	[/en]
	[de]
		Der Sicherheitslevel für das Loggen.
		Folgende Defines sind möglich:
		%FormSecureLogLevel%
	[/de]
	*/
	public function setSecureLogLevel($_iLevel)
	{
		$_iLevel = $this->getRealParameter(array('oParameters' => $_iLevel, 'sName' => 'iLevel', 'xParameter' => $_iLevel));
		$this->iSecureLogLevel = $_iLevel;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the security level for the Log.[/en]
	[de]Gibt den Sicherheitslevel zum Loggen zurück.[/de]
	
	@return iSecureLogLevel [type]int[/type]
	[en]
		Returns the security level for the Log.
		The following defines are possible:
		%FormSecureLogLevel%
	[/en]
	[de]
		Gibt den Sicherheitslevel zum Loggen zurück.
		Folgende Defines sind möglich:
		%FormSecureLogLevel%
	[/de]
	*/
	public function getSecureLogLevel() {return $this->iSecureLogLevel;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the security level to be used for the transmission of the form data.[/en]
	[de]Setzt den Sicherheitslevel der für die Übertragung der Formulardaten verwendet werden soll.[/de]
	
	@param iLevel [needed][type]int[/type]
	[en]
		The security level for the transfer.
		The following defines are possible
		%FormSecureActionLevel%
	[/en]
	[de]
		Der Sicherheitslevel für die Übertragung.
		Folgende Defines sind möglich:
		%FormSecureActionLevel%
	[/de]
	*/
	public function setSecureActionLevel($_iLevel)
	{
		$_iLevel = $this->getRealParameter(array('oParameters' => $_iLevel, 'sName' => 'iLevel', 'xParameter' => $_iLevel));
		$this->iSecureActionLevel = $_iLevel;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the level of security for the transmission of the form data.[/en]
	[de]Gibt den Sicherheitslevel für die Übertragung der Formulardaten zurück.[/de]
	
	@return iSecureActionLevel [type]int[/type]
	[en]
		Returns the security level for the transmission.
		The following defines are possible:
		%FormSecureActionLevel%
	[/en]
	[de]
		Gibt den Sicherheitslevel für die Übertragung zurück.
		Folgende Defines sind möglich:
		%FormSecureActionLevel%
	[/de]
	*/
	public function getSecureActionLevel() {return $this->iSecureActionLevel;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Specifies whether the hidden fields will be replaced by session variables on building the form.[/en]
	[de]Gibt an ob beim Erstellen des Formulars die versteckten Felder durch Session Variablen ersetzt werden sollen.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether the hidden fields will be replaced by session variables on building the form.[/en]
	[de]Gibt an ob beim Erstellen des Formulars die versteckten Felder durch Session Variablen ersetzt werden sollen.[/de]
	*/
	public function useSecureBuildWithoutHiddenInputs($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSecureBuildWithoutHiddenInputs = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether when you create the form the hidden fields will be replaced with session variables.[/en]
	[de]Gibt zurück, ob beim Erstellen des Formulars die versteckten Felder durch Session Variablen ersetzt werden sollen.[/de]
	
	@return bWithoutHiddenInputs [type]bool[/type]
	[en]Returns a boolean whether when you create the form the hidden fields will be replaced with session variables.[/en]
	[de]Gibt einen Boolean zurück, ob beim Erstellen des Formulars die versteckten Felder durch Session Variablen ersetzt werden sollen.[/de]
	*/
	public function isSecureBuildWithoutHiddenInputs() {return $this->bSecureBuildWithoutHiddenInputs;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a hidden field to the form.[/en]
	[de]Fügt dem Formular ein verstecktes Feld hinzu.[/de]
	
	@return iHiddenFieldIndex [type]int[/type]
	[en]Returns the index of the hidden field as an integer.[/en]
	[de]Gibt den Index des versteckten Feldes als Integer zurück.[/de]
	
	@param sHiddenFieldID [type]string[/type]
	[en]The ID of the hidden field.[/en]
	[de]Die ID des versteckten Feldes.[/de]
	
	@param xFieldValue [type]string[/type]
	[en]The value of the hidden field.[/en]
	[de]Der Wert des versteckten Feldes.[/de]
	*/
	public function addHiddenField($_sHiddenFieldID = NULL, $_xFieldValue = NULL)
	{
		$_xFieldValue = $this->getRealParameter(array('oParameters' => $_sHiddenFieldID, 'sName' => 'xFieldValue', 'xParameter' => $_xFieldValue));
		$_sHiddenFieldID = $this->getRealParameter(array('oParameters' => $_sHiddenFieldID, 'sName' => 'sHiddenFieldID', 'xParameter' => $_sHiddenFieldID));

		if ($_sHiddenFieldID === NULL) {$_sHiddenFieldID = '';}
		if ($_xFieldValue === NULL) {$_xFieldValue = '';}
		
		$_iIndex = count($this->axFormElements);
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] = 'HiddenField';
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID] = $_sHiddenFieldID;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_VALUE] = $_xFieldValue;
		
		return $_iIndex;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a single-line input field or drop-down field to the form.[/en]
	[de]Fügt dem Formular ein einzeiliges Eingabefeld oder Dropdown-Feld hinzu.[/de]
	
	@return iInputFieldIndex [type]int[/type]
	[en]Returns the index of the input field as an integer.[/en]
	[de]Gibt den Index des Eingabefeldes als Integer zurück.[/de]
	
	@param sLabelName [type]string[/type]
	[en]A text that is displayed before the input field.[/en]
	[de]Ein Text der vor dem Eingabefeld dargestellt wird.[/de]
	
	@param sInputFieldID [type]string[/type]
	[en]The ID of the input field.[/en]
	[de]Die ID des Eingabefeldes.[/de]
	
	@param iInputFieldMode [type]int[/type]
	[en]
		The Mode for the input field.
		The following defines are possible:
		%InputFieldModeDefines%
	[/en]
	[de]
		Der Modus für das Eingabefeld.
		Folgende Defines sind möglich:
		%InputFieldModeDefines%
	[/de]
	
	@param iFieldSizeX [type]int[/type]
	[en]The width of the input field.[/en]
	[de]Die Breite des Eingabefeldes.[/de]
	
	@param xFieldValue [type]mixed[/type]
	[en]The value of the input field.[/en]
	[de]Der Wert des Eingabefeldes.[/de]
	
	@param xFieldNoValue [type]mixed[/type]
	[en]The contents of the input field with no value.[/en]
	[de]Der Inhalt des Eingabefeldes bei keinem Wert.[/de]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]The dataset ID of the input field in the background. Used when a drop-down box should transfer data other than that shown in the display.[/en]
	[de]Die Datensatz ID im Hintergrund des Eingabefeldes. Wird verwendet, wenn ein Dropdown-Feld andere Daten als die Angezeigten übergeben soll.[/de]
	
	@param sFieldAccessKey [type]string[/type]
	[en]The shortcut key on, together with the ALT key pressed, you can jump directly into the input field.[/en]
	[de]Die Shortcut Taste über die, zusammen mit gedrückter ALT Taste, direkt in das Eingabefeld gesprungen werden kann.[/de]
	
	@param bFieldRequired [type]bool[/type]
	[en]Specifies whether the field is a required field.[/en]
	[de]Gibt an ob das Eingabefeld ein Pflichtfeld ist.[/de]
	
	@param iFieldMaxLength [type]int[/type]
	[en]The maximum number of characters that are allowed.[/en]
	[de]Die maximale Anzahl an Zeichen die zugelassen sind.[/de]
	
	@param iFieldTabIndex [type]int[/type]
	[en]The tab index. Specifies in what order the form elements are accessed.[/en]
	[de]Der Tabulator Index. Gibt an in welcher Reihenfolge die Formularelemente angesprungen werden.[/de]
	
	@param asSaveStructure [type]string[][/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]The datasets for the drop-down option. These datasets are available in the drop-down list to choose from.[/en]
	[de]Die Datensätze für die Dropdown-Feld option. Diese Datensätze stehen in der Dropdown-Liste zur auswahl.[/de]
	
	@param sSendParameters [type]string[/type]
	[en]Parameters that are also sent on a auto save function.[/en]
	[de]Parameter die bei einer Autosave Funktion zusätzlich gesendet werden.[/de]
	
	@param sOnFieldBlur [type]string[/type]
	[en]JavaScript code to be executed when the input field was abandoned.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Eingabefeld verlassen wurde.[/de]
	
	@param sOnFieldFocus [type]string[/type]
	[en]JavaScript code to be executed when the input field is selected.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Eingabefeld angewählt wird.[/de]
	
	@param sOnFieldKeyDown [type]string[/type]
	[en]JavaScript code to be executed when the input field is selected and a button is pressed.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Eingabefeld angewählt ist und eine Taste gedrückt wird.[/de]
	
	@param sOnFieldKeyUp [type]string[/type]
	[en]JavaScript code to be executed when the input field is selected and a key was released.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Eingabefeld angewählt ist und eine Taste wieder losgelassen wurde.[/de]
	
	@param sOnFieldClick [type]string[/type]
	[en]JavaScript code which will be executed, when the input field was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Eingabefeld geklickt wurde.[/de]
	
	@param sOnFieldMouseDown [type]string[/type]
	[en]JavaScript code which will be executed, when the input field is being clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Eingabefeld gerade geklickt wird.[/de]
	
	@param sOnFieldMouseUp [type]string[/type]
	[en]JavaScript code which will be executed, when the input field was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Eingabefeld geklickt wurde.[/de]
	
	@param sOnFieldMouseOver [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer is moving over the input field.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger über das Eingabefeld bewegt wird.[/de]
	
	@param sOnFieldMouseOut [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer moves away from the input field.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger von dem Eingabefeld weg bewegt wird.[/de]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]JavaScript code to be executed when a dataset from the drop-down list is selected.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn ein Datensatz aus der Dropdown-Liste ausgewählt wird.[/de]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]JavaScript code to be executed when the edit mode for datasets of drop-down list is switched.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Bearbeitungsmodus für Datensätze der Dropdown-Liste gewechselt wird.[/de]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]JavaScript code to be executed when a new dataset for the drop-down list is created.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn ein neuer Datensatz für die Dropdown-Liste erstellt wird.[/de]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]JavaScript code to be executed when a dataset is modified.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn ein Datensatz geändert wird.[/de]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]JavaScript code to be executed when a dataset is deleted.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn ein Datensatz gelöscht wird.[/de]
	*/
	public function addInputField(
		$_sLabelName = NULL,
		$_sInputFieldID = NULL,
		$_iInputFieldMode = NULL,
		$_iFieldSizeX = NULL,

		$_xFieldValue = NULL,
		$_xFieldNoValue = NULL,
		$_xFieldDatasetID = NULL,

		$_sFieldAccessKey = NULL,
		$_bFieldRequired = NULL,
		$_iFieldMaxLength = NULL,
		$_iFieldTabIndex = NULL,

		$_asSaveStructure = NULL,

		$_axDatasets = NULL,
		
		$_sSendParameters = NULL,

		$_sOnFieldBlur = NULL,
		$_sOnFieldFocus = NULL,
		$_sOnFieldKeyDown = NULL,
		$_sOnFieldKeyUp = NULL,

		$_sOnFieldClick = NULL,
		$_sOnFieldMouseDown = NULL,
		$_sOnFieldMouseUp = NULL,
		$_sOnFieldMouseOver = NULL,
		$_sOnFieldMouseOut = NULL,

		$_sOnDatasetSelect = NULL,
		$_sOnSwitchEditMode = NULL,
		$_sOnDatasetCreate = NULL,
		$_sOnDatasetUpdate = NULL,
		$_sOnDatasetDelete = NULL
	)
	{
		$_sInputFieldID = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sInputFieldID', 'xParameter' => $_sInputFieldID));
		$_iInputFieldMode = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iInputFieldMode', 'xParameter' => $_iInputFieldMode));
		$_iFieldSizeX = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iFieldSizeX', 'xParameter' => $_iFieldSizeX));
		
		$_xFieldValue = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'xFieldValue', 'xParameter' => $_xFieldValue));
		$_xFieldNoValue = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'xFieldNoValue', 'xParameter' => $_xFieldNoValue));
		$_xFieldDatasetID = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'xFieldDatasetID', 'xParameter' => $_xFieldDatasetID));
		
		$_sFieldAccessKey = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sFieldAccessKey', 'xParameter' => $_sFieldAccessKey));
		$_bFieldRequired = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'bFieldRequired', 'xParameter' => $_bFieldRequired));
		$_iFieldMaxLength = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iFieldMaxLength', 'xParameter' => $_iFieldMaxLength));
		$_iFieldTabIndex = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iFieldTabIndex', 'xParameter' => $_iFieldTabIndex));
		
		$_asSaveStructure = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'asSaveStructure', 'xParameter' => $_asSaveStructure));
		
		$_axDatasets = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'axDatasets', 'xParameter' => $_axDatasets));
		
		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));
		
		$_sOnFieldBlur = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldBlur', 'xParameter' => $_sOnFieldBlur));
		$_sOnFieldFocus = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldFocus', 'xParameter' => $_sOnFieldFocus));
		$_sOnFieldKeyDown = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldKeyDown', 'xParameter' => $_sOnFieldKeyDown));
		$_sOnFieldKeyUp = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldKeyUp', 'xParameter' => $_sOnFieldKeyUp));
		
		$_sOnFieldClick = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldClick', 'xParameter' => $_sOnFieldClick));
		$_sOnFieldMouseDown = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldMouseDown', 'xParameter' => $_sOnFieldMouseDown));
		$_sOnFieldMouseUp = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldMouseUp', 'xParameter' => $_sOnFieldMouseUp));
		$_sOnFieldMouseOver = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldMouseOver', 'xParameter' => $_sOnFieldMouseOver));
		$_sOnFieldMouseOut = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFieldMouseOut', 'xParameter' => $_sOnFieldMouseOut));
		
		$_sOnDatasetSelect = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnDatasetSelect', 'xParameter' => $_sOnDatasetSelect));
		$_sOnSwitchEditMode = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnSwitchEditMode', 'xParameter' => $_sOnSwitchEditMode));
		$_sOnDatasetCreate = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnDatasetCreate', 'xParameter' => $_sOnDatasetCreate));
		$_sOnDatasetUpdate = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnDatasetUpdate', 'xParameter' => $_sOnDatasetUpdate));
		$_sOnDatasetDelete = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnDatasetDelete', 'xParameter' => $_sOnDatasetDelete));
		
		$_sLabelName = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sLabelName', 'xParameter' => $_sLabelName));

		$_iIndex = count($this->axFormElements);
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] = 'InputField';
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME] = $_sLabelName;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID] = $_sInputFieldID;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MODE] = $_iInputFieldMode;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SIZEX] = $_iFieldSizeX;
		
		// Defaults...
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_VALUE] = $_xFieldValue;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_NOVALUE] = $_xFieldNoValue;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETID] = $_xFieldDatasetID;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ACCESSKEY] = $_sFieldAccessKey;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_REQUIRED] = $_bFieldRequired;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MAXLENGTH] = $_iFieldMaxLength;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_TABINDEX] = $_iFieldTabIndex;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SAVESTRUCTURE] = $_asSaveStructure;
		
		// Dropdown...
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETS] = $_axDatasets;
		
		// Network...
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SENDPARAMETERS] = $_sSendParameters;
		
		// Events...
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONBLUR] = $_sOnFieldBlur;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONFOCUS] = $_sOnFieldFocus;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYDOWN] = $_sOnFieldKeyDown;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYUP] = $_sOnFieldKeyUp;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONCLICK] = $_sOnFieldClick;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEDOWN] = $_sOnFieldMouseDown;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEUP] = $_sOnFieldMouseUp;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOVER] = $_sOnFieldMouseOver;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOUT] = $_sOnFieldMouseOut;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETSELECT] = $_sOnDatasetSelect;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONSWITCHEDITMODE] = $_sOnSwitchEditMode;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETCREATE] = $_sOnDatasetCreate;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETUPATE] = $_sOnDatasetUpdate;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETDELETE] = $_sOnDatasetDelete;
		
		return $_iIndex;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a textarea to the form.[/en]
	[de]Fügt dem Formular ein Textfeld hinzu.[/de]
	
	@return iTextAreaIndex [type]int[/type]
	[en]Returns the index of the textarea as an integer.[/en]
	[de]Gibt den Index des Textfeldes als Integer zurück.[/de]
	
	@param sLabelName [type]string[/type]
	[en]A text that is displayed before the textarea.[/en]
	[de]Ein Text der vor dem Textfeld dargestellt wird.[/de]
	
	@param sTextAreaID [type]string[/type]
	[en]The ID of the textarea.[/en]
	[de]Die ID des Textfeldes.[/de]
	
	@param iTextAreaMode [type]int[/type]
	[en]
		The Mode for the textarea.
		The following defines are possible:
		%TextAreaModeDefines%
	[/en]
	[de]
		Der Modus für das Textfeldes.
		Folgende Defines sind möglich:
		%TextAreaModeDefines%
	[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width of the textarea in pixels.[/en]
	[de]Die Breite des Textfeldes in Pixeln.[/de]
	
	@param iRows [type]int[/type]
	[en]The number of rows that are visible and specify the height of the textarea.[/en]
	[de]Die Anzahl an Zeilen die Sichtbar sind und die Höhe des Textfeldes vorgeben.[/de]
	
	@param sText [type]string[/type]
	[en]The text that is in the textarea.[/en]
	[de]Der Text, der in dem Textfeld steht.[/de]
	
	@param sNoDataText [type]string[/type]
	[en]The contents of the textarea when no text is in the textarea.[/en]
	[de]Der Inhalt des Textfeldes wenn kein Text im Textfeld ist.[/de]
	
	@param sAccessKey [type]string[/type]
	[en]The shortcut key on, together with the ALT key pressed, you can jump directly into the textarea.[/en]
	[de]Die Shortcut Taste über die, zusammen mit gedrückter ALT Taste, direkt in das Textfeld gesprungen werden kann.[/de]
	
	@param bRequired [type]bool[/type]
	[en]Specifies whether the textarea is a required field.[/en]
	[de]Gibt an ob das Textfeld ein Pflichtfeld ist.[/de]
	
	@param iMaxLength [type]int[/type]
	[en]The maximum number of characters that are allowed.[/en]
	[de]Die maximale Anzahl an Zeichen die zugelassen sind.[/de]
	
	@param iTabIndex [type]int[/type]
	[en]The tab index. Specifies in what order the form elements are accessed.[/en]
	[de]Der Tabulator Index. Gibt an in welcher Reihenfolge die Formularelemente angesprungen werden.[/de]
	
	@param iLineBreakCharCount [type]int[/type]
	[en]The number of line breaks that are allowed. At 0, there is no limit of the line breaks.[/en]
	[de]Die Anzahl an Zeilenumbrüche die erlaubt sind. Bei 0 gibt es keine Begrenzung der Zeilenumbrüche.[/de]
	
	@param iFreeSpaceCharCount [type]int[/type]
	[en]The number of free spaces that are allowed. At 0, there is no limit of free spaces. Can be used to limit the number of words.[/en]
	[de]Die Anzahl an Leerzeichen die erlaubt sind. Bei 0 gibt es keine Begrenzung der Leerzeichen. Kann verwendet werden um die Anzahl an Wörtern zu begrenzen.[/de]
	
	@param sSendParameters [type]string[/type]
	[en]Parameters that are also sent on a auto save function.[/en]
	[de]Parameter die bei einer Autosave Funktion zusätzlich gesendet werden.[/de]
	
	@param sOnBlur [type]string[/type]
	[en]JavaScript code to be executed when the textarea was abandoned.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Textfeld verlassen wurde.[/de]
	
	@param sOnFocus [type]string[/type]
	[en]JavaScript code to be executed when the textarea is selected.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Textfeld angewählt wird.[/de]
	
	@param sOnKeyDown [type]string[/type]
	[en]JavaScript code to be executed when the textarea is selected and a button is pressed.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Textfeld angewählt ist und eine Taste gedrückt wird.[/de]
	
	@param sOnKeyUp [type]string[/type]
	[en]JavaScript code to be executed when the textarea is selected and a key was released.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn das Textfeld angewählt ist und eine Taste wieder losgelassen wurde.[/de]
	
	@param sOnClick [type]string[/type]
	[en]JavaScript code which will be executed, when the textarea was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Textfeld geklickt wurde.[/de]
	
	@param sOnMouseDown [type]string[/type]
	[en]JavaScript code which will be executed, when the textarea is being clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Textfeld gerade geklickt wird.[/de]
	
	@param sOnMouseUp [type]string[/type]
	[en]JavaScript code which will be executed, when the textarea was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf das Textfeld geklickt wurde.[/de]
	
	@param sOnMouseOver [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer is moving over the textarea.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger über das Textfeld bewegt wird.[/de]
	
	@param sOnMouseOut [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer moves away from the textarea.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger von dem Textfeld weg bewegt wird.[/de]
	*/
	public function addTextArea(
		$_sLabelName = NULL,
		$_sTextAreaID = NULL, 
		$_iTextAreaMode = NULL, 
		$_iSizeX = NULL, 
		$_iRows = NULL, 

		$_sText = NULL, 
		$_sNoDataText = NULL, 

		$_sAccessKey = NULL,
		$_bRequired = NULL, 
		$_iMaxLength = NULL,
		$_iTabIndex = NULL,

		$_iLineBreakCharCount = NULL,
		$_iFreeSpaceCharCount = NULL,

		$_sSendParameters = NULL,

		$_sOnBlur = NULL,
		$_sOnFocus = NULL,
		$_sOnKeyDown = NULL,
		$_sOnKeyUp = NULL,

		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL
	)
	{
		$_sTextAreaID = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sTextAreaID', 'xParameter' => $_sTextAreaID));
		$_iTextAreaMode = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iTextAreaMode', 'xParameter' => $_iTextAreaMode));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iRows = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iRows', 'xParameter' => $_iRows));
		
		$_sText = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sText', 'xParameter' => $_sText));
		$_sNoDataText = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sNoDataText', 'xParameter' => $_sNoDataText));
		
		$_sAccessKey = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sAccessKey', 'xParameter' => $_sAccessKey));
		$_bRequired = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'bRequired', 'xParameter' => $_bRequired));
		$_iMaxLength = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iMaxLength', 'xParameter' => $_iMaxLength));
		$_iTabIndex = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iTabIndex', 'xParameter' => $_iTabIndex));
		
		$_iLineBreakCharCount = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iLineBreakCharCount', 'xParameter' => $_iLineBreakCharCount));
		$_iFreeSpaceCharCount = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iFreeSpaceCharCount', 'xParameter' => $_iFreeSpaceCharCount));
		
		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));
		
		$_sOnBlur = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnBlur', 'xParameter' => $_sOnBlur));
		$_sOnFocus = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnFocus', 'xParameter' => $_sOnFocus));
		$_sOnKeyDown = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnKeyDown', 'xParameter' => $_sOnKeyDown));
		$_sOnKeyUp = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnKeyUp', 'xParameter' => $_sOnKeyUp));
		
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));
		
		$_sLabelName = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sLabelName', 'xParameter' => $_sLabelName));

		$_iIndex = count($this->axFormElements);
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] = 'TextArea';
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME] = $_sLabelName;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID] = $_sTextAreaID;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_MODE] = $_iTextAreaMode;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_SIZEX] = $_iSizeX;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ROWS] = $_iRows;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_TEXT] = $_sText;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_NODATATEXT] = $_sNoDataText;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ACCESSKEY] = $_sAccessKey;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_REQUIRED] = $_bRequired;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_MAXLENGTH] = $_iMaxLength;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_TABINDEX] = $_iTabIndex;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_LINEBREAKCHARCOUNT] = $_iLineBreakCharCount;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_FREESPACECHARCOUNT] = $_iFreeSpaceCharCount;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_SENDPARAMETERS] = $_sSendParameters;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONBLUR] = $_sOnBlur;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONFOCUS] = $_sOnFocus;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYDOWN] = $_sOnKeyDown;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYUP] = $_sOnKeyUp;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONCLICK] = $_sOnClick;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEDOWN] = $_sOnMouseDown;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEUP] = $_sOnMouseUp;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOVER] = $_sOnMouseOver;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOUT] = $_sOnMouseOut;

		return $_iIndex;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a checkbox to the form.[/en]
	[de]Fügt dem Formular eine Checkbox hinzu.[/de]
	
	@return iCheckBoxIndex [type]int[/type]
	[en]Returns the index of the checkbox as an integer.[/en]
	[de]Gibt den Index der Checkbox als Integer zurück.[/de]
	
	@param sLabelName [type]string[/type]
	[en]A text that is displayed before the checkbox.[/en]
	[de]Ein Text der vor der Checkbox dargestellt wird.[/de]
	
	@param sCheckBoxID [type]string[/type]
	[en]The ID of the checkbox.[/en]
	[de]Die ID der Checkbox.[/de]
	
	@param iCheckboxMode [type]int[/type]
	[en]
		The Mode for the checkbox.
		The following defines are possible:
		%CheckBoxModeDefines%
	[/en]
	[de]
		Der Modus für die Checkbox.
		Folgende Defines sind möglich:
		%CheckBoxModeDefines%
	[/de]
	
	@param xSelectedStatus [type]mixed[/type]
	[en]The currently selected status.[/en]
	[de]Der aktuell selektierte Status.[/de]
	
	@param axStatusStructure [type]mixed[][/type]
	[en]The status structures wich can be created by $oPGCheckBox->buildStatusStructure(...). Specifies which status stages can be set.[/en]
	[de]Die Statusstrukturen die durch $oPGCheckBox->buildStatusStructure(...) erstellt werden. Gibt an welche Status-Stufen eingestellt werden können.[/de]
	
	@param sSendParameters [type]string[/type]
	[en]Parameters that are also sent on a auto save function.[/en]
	[de]Parameter die bei einer Autosave Funktion zusätzlich gesendet werden.[/de]
	
	@param sOnClick [type]string[/type]
	[en]JavaScript code which will be executed, when the checkbox was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf die Checkbox geklickt wurde.[/de]
	
	@param sOnMouseDown [type]string[/type]
	[en]JavaScript code which will be executed, when the checkbox is being clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf die Checkbox gerade geklickt wird.[/de]
	
	@param sOnMouseUp [type]string[/type]
	[en]JavaScript code which will be executed, when the checkbox was clicked.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn auf die Checkbox geklickt wurde.[/de]
	
	@param sOnMouseOver [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer is moving over the checkbox.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger über die Checkbox bewegt wird.[/de]
	
	@param sOnMouseOut [type]string[/type]
	[en]JavaScript code to be executed when the mouse pointer moves away from the checkbox.[/en]
	[de]JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger von der Checkbox weg bewegt wird.[/de]
	*/
	public function addCheckBox(
		$_sLabelName = NULL,
		$_sCheckBoxID = NULL,
		$_iCheckboxMode = NULL,

		$_xSelectedStatus = NULL,
		$_axStatusStructure = NULL,

		$_sSendParameters = NULL,

		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL
	)
	{
		$_sCheckBoxID = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sCheckBoxID', 'xParameter' => $_sCheckBoxID));
		$_iCheckboxMode = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'iCheckboxMode', 'xParameter' => $_iCheckboxMode));

		$_xSelectedStatus = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'xSelectedStatus', 'xParameter' => $_xSelectedStatus));
		$_axStatusStructure = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'axStatusStructure', 'xParameter' => $_axStatusStructure));

		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));

		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));

		$_sLabelName = $this->getRealParameter(array('oParameters' => $_sLabelName, 'sName' => 'sLabelName', 'xParameter' => $_sLabelName));

		$_iIndex = count($this->axFormElements);
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] = 'CheckBox';
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME] = $_sLabelName;
		
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID] = $_sCheckBoxID;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_MODE] = $_iCheckboxMode;
							  
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_SELECTEDSTATUS] = $_xSelectedStatus;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_STATUSSTRUCTURE] = $_axStatusStructure;
								
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_SENDPARAMETERS] = $_sSendParameters;

		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONCLICK] = $_sOnClick;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEDOWN] = $_sOnMouseDown;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEUP] = $_sOnMouseUp;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOVER] = $_sOnMouseOver;
		$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOUT] = $_sOnMouseOut;
		
		return $_iIndex;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sLabelNameID [type]string[/type]
	[en]...[/en]
	
	@param axFormElement [type]mixed[][/type]
	[en]...[/en]
	*/
	public function getLabelNameID($_axFormElement)
	{
		$_axFormElement = $this->getRealParameter(array('oParameters' => $_axFormElement, 'sName' => 'axFormElement', 'xParameter' => $_axFormElement, 'bNotNull' => true));

		$_sLabelNameID = '';
		switch($_axFormElement[PG_FORM_ELEMENTS_INDEX_TYPE])
		{
			case 'InputField':
				$_sLabelNameID = $_axFormElement[PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID].'Field0';
			break;
			
			case 'TextArea':
				$_sLabelNameID = $_axFormElement[PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID];
			break;
			
			case 'CheckBox':
				$_sLabelNameID = $_axFormElement[PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID];
			break;
		}
		return $_sLabelNameID;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the form and returns it as an HTML string.[/en]
	[de]Erstellt das Formular und gibt es als HTML String zurück.[/de]
	
	@return sFormHtml [type]string[/type]
	[en]Returns the form as an HTML string.[/en]
	[de]Gibt das Formular als HTML String zurück.[/de]
	
	@param sFormID [type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sTargetUrl [type]string[/type]
	[en]The target url for the submit of the Form.[/en]
	[de]Das Ziel-URL beim Abschicken des Formulars.[/de]
	
	@param sTargetFrame [type]string[/type]
	[en]The target frame for the submit of the Form.[/en]
	[de]Das Ziel-Frame beim Abschicken des Formulars.[/de]
	
	@param sFormMethod [type]string[/type]
	[en]The method on which to send the form. "Get" and "post" are possible. (Default: post)[/en]
	[de]Die Methode über die das Formular gesendet werden soll. Möglich sind "get" und "post". (Standard: post)[/de]
	
	@param xTemplate [type]mixed[/type]
	[en]...[/en]
	
	@param asIgnoreHiddenInputs [type]string[][/type]
	[en]Hidden fields that should be omitted (ignored) at security checks.[/en]
	[de]Versteckte Felder die bei Sicherheitsprüfungen ausgelassen (ignoriert) werden sollen.[/de]
	
	@param bUseSubmitButton [type]bool[/type]
	[en]Specifies whether a button is used to submit the form. (Default: true)[/en]
	[de]Gibt an ob ein Button zum Abschicken des Formulars verwendet werden soll. (Standard: true)[/de]
	
	@param bUseAbortButton [type]bool[/type]
	[en]Specifies whether a button is used to abort the form. (Default: false)[/en]
	[de]Gibt an ob ein Button zum Abbrechen des Formulars verwendet werden soll. (Standard: false)[/de]
	
	@param sOnSubmit [type]string[/type]
	[en]JavaScript code to be executed when submitting the form.[/en]
	[de]JavaScript Code der beim Abschicken des Formulars ausgeführt werden soll.[/de]
	
	@param sOnAbort [type]string[/type]
	[en]JavaScript code to be executed when aborting the form.[/en]
	[de]JavaScript Code der beim Abbrechen des Formulars ausgeführt werden soll.[/de]
	*/
	public function build(
		$_sFormID = NULL, 
		$_sTargetUrl = NULL, 
		$_sTargetFrame = NULL, 
		$_sFormMethod = NULL, 
		$_xTemplate = NULL, 
		$_asIgnoreHiddenInputs = NULL, 
		$_bUseSubmitButton = NULL, 
		$_bUseAbortButton = NULL, 
		$_sOnSubmit = NULL, 
		$_sOnAbort = NULL
	)
	{
		global $oPGInputField, $oPGTextArea, $oPGCheckBox;

		$_sTargetUrl = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sTargetUrl', 'xParameter' => $_sTargetUrl));
		$_sTargetFrame = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sTargetFrame', 'xParameter' => $_sTargetFrame));
		$_sFormMethod = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormMethod', 'xParameter' => $_sFormMethod));
		$_xTemplate = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_asIgnoreHiddenInputs = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'asIgnoreHiddenInputs', 'xParameter' => $_asIgnoreHiddenInputs));
		$_bUseSubmitButton = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'bUseSubmitButton', 'xParameter' => $_bUseSubmitButton));
		$_bUseAbortButton = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'bUseAbortButton', 'xParameter' => $_bUseAbortButton));
		$_sOnSubmit = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sOnSubmit', 'xParameter' => $_sOnSubmit));
		$_sOnAbort = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sOnAbort', 'xParameter' => $_sOnAbort));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		
		if ($_sFormID === NULL) {$_sFormID = $this->getNextID();}
		if ($_sTargetUrl === NULL) {$_sTargetUrl = $this->getUrl();}
		if ($_sTargetFrame === NULL) {$_sTargetFrame = $this->getUrlTarget();}
		if ($_sFormMethod === NULL) {$_sFormMethod = $this->getFormMethod();}
		if ($_bUseSubmitButton === NULL) {$_bUseSubmitButton = true;}
		if ($_bUseAbortButton === NULL) {$_bUseAbortButton = false;}
		
		if ($_xTemplate === NULL)
		{
			$_xTemplate .= '<table style="border-width:0px;">';
			for ($_iIndex=0; $_iIndex<count($this->axFormElements); $_iIndex++)
			{
				if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] != 'HiddenField')
				{
					$_sLabelNameID = $this->getLabelNameID(array('sFormID' => $_sFormID, 'axFormElement' => $this->axFormElements[$_iIndex]));
				
					$_xTemplate .= '<tr>';
						$_xTemplate .= '<td>';
							$_xTemplate .= '<label for="'.$_sLabelNameID.'">';
							$_xTemplate .= $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME];
							$_xTemplate .= '</label>';
						$_xTemplate .= '</td>';
						$_xTemplate .= '<td>';
							$_xTemplate .= '{{FormElement:'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME].'}}';
						$_xTemplate .= '</td>';
					$_xTemplate .= '</tr>';
				}
			}
			$_xTemplate .= '<tr>';
				$_xTemplate .= '<td colspan="2" style="text-align:center;">';
				$_xTemplate .= '<br />';
				$_xTemplate .= '{{FormAbortButton}} {{FormSubmitButton}}';
				$_xTemplate .= '</td>';
			$_xTemplate .= '</tr>';
			$_xTemplate .= '</table>';
		}
		
		$_sFormMethod = strtolower($_sFormMethod);
		
		$_sToken = '';
		if (($this->iSecureActionLevel != PG_FORM_SECURE_ACTION_LEVEL_NONE) || ($this->iSecureLogLevel != PG_FORM_SECURE_LOG_LEVEL_NONE))
		{
			$_sToken = $this->createTokenSession(array('sFormID' => $_sFormID, 'sToken' => NULL, 'asIgnoreHiddenInputs' => $_asIgnoreHiddenInputs));
		}

		$_sHTML = '';
		$_sHTML .= '<form id="'.$_sFormID.'" action="'.$_sTargetUrl.'" target="'.$_sTargetFrame.'" method="'.$_sFormMethod.'">';
		if ($_sToken != '') {$_sHTML .= '<input type="hidden" name="'.$_sFormID.'SessionTokenID" value="'.$_sToken.'" />';}
		$_sHTML .= $this->getUrlParametersForm();
		for ($_iIndex=0; $_iIndex<count($this->axFormElements); $_iIndex++)
		{
			// $_sLabelNameID = $this->getLabelNameID(array('sFormID' => $_sFormID, 'axFormElement' => $this->axFormElements[$_iIndex]));
			switch($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE])
			{
				case 'InputField':
					if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID] === NULL)
					{
						$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID] = $_sFormID.$oPGInputField->getNextID();
					}
				break;
				
				case 'TextArea':
					if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID] === NULL)
					{
						$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID] = $_sFormID.$oPGTextArea->getNextID();
					}
				break;
				
				case 'CheckBox':
					if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID] === NULL)
					{
						$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID] = $_sFormID.$oPGCheckBox->getNextID();
					}
				break;
			}
			
			if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] == 'HiddenField')
			{
				if ($this->bSecureBuildWithoutHiddenInputs == false) // && ($this->iSecureActionLevel != PG_FORM_SECURE_ACTION_LEVEL_NONE))
				{
					$_sHTML .= '<input type="hidden" ';
					$_sHTML .= 'id="'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID].'" ';
					$_sHTML .= 'name="'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID].'" ';
					$_sHTML .= 'value="'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_VALUE].'" />';
				}
			}
			else
			{
				switch($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE])
				{
					case 'InputField':
						$_sReplaceVar = $oPGInputField->build(
							array(
								'sInputFieldID' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID],
								'iInputFieldMode' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MODE],
								'iFieldSizeX' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SIZEX],
								
								// Defaults...
								'sFieldName' => NULL,
								'xFieldValue' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_VALUE],
								'xFieldNoValue' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_NOVALUE],
								'xFieldDatasetID' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETID],
								
								'sFieldAccessKey' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ACCESSKEY],
								'bFieldRequired' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_REQUIRED],
								'iFieldMaxLength' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_MAXLENGTH],
								'iFieldTabIndex' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_TABINDEX],
								'sFieldType' => NULL,
								'iDropdownZIndex' => NULL,

								// Dropdown...
								'axDatasets' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_DATASETS],

								// Network...
								'sSendParameters' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_SENDPARAMETERS],
								
								// Events...
								'sOnFieldBlur' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONBLUR],
								'sOnFieldFocus' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONFOCUS],
								'sOnFieldKeyDown' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYDOWN],
								'sOnFieldKeyUp' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONKEYUP],
								 
								'sOnFieldClick' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONCLICK],
								'sOnFieldMouseDown' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEDOWN],
								'sOnFieldMouseUp' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEUP],
								'sOnFieldMouseOver' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOVER],
								'sOnFieldMouseOut' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONMOUSEOUT],
								  
								'sOnDatasetSelect' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETSELECT],
								'sOnSwitchEditMode' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONSWITCHEDITMODE],
								'sOnDatasetCreate' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETCREATE],
								'sOnDatasetUpdate' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETUPATE],
								'sOnDatasetDelete' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ONDATASETDELETE]
							)
						);
					break;
					
					case 'TextArea':
						$_sReplaceVar = $oPGTextArea->build(
							array(
								'sTextAreaID' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID], 
								'iTextAreaMode' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_MODE], 
								'iSizeX' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_SIZEX], 
								'iRows' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ROWS], 

								'sName' => NULL,
								'sText' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_TEXT], 
								'sNoDataText' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_NODATATEXT], 

								'sAccessKey' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ACCESSKEY],
								'bRequired' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_REQUIRED], 
								'iMaxLength' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_MAXLENGTH],
								'iTabIndex' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_TABINDEX],

								'iLineBreakCharCount' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_LINEBREAKCHARCOUNT],
								'iFreeSpaceCharCount' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_FREESPACECHARCOUNT],

								'sSendParameters' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_SENDPARAMETERS],

								'sOnBlur' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONBLUR],
								'sOnFocus' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONFOCUS],
								'sOnKeyDown' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYDOWN],
								'sOnKeyUp' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONKEYUP],

								'sOnClick' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONCLICK],
								'sOnMouseDown' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEDOWN],
								'sOnMouseUp' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEUP],
								'sOnMouseOver' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOVER],
								'sOnMouseOut' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ONMOUSEOUT]
							)
						);
					break;
					
					case 'CheckBox':
						$_sReplaceVar = $oPGCheckBox->build(
							array(
								'sCheckBoxID' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID],
								'iCheckboxMode' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_MODE],
								
								'xSelectedStatus' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_SELECTEDSTATUS],
								'axStatusStructure' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_STATUSSTRUCTURE],
								
								'sSendParameters' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_SENDPARAMETERS],
								
								'sOnClick' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONCLICK],
								'sOnMouseDown' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEDOWN],
								'sOnMouseUp' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEUP],
								'sOnMouseOver' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOVER],
								'sOnMouseOut' => $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ONMOUSEOUT]
							)
						);
					break;
				}
				$this->addTemplateReplaceVar(array('sVarname' => 'FormElement:'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_LABELNAME], 'sReplace' => $_sReplaceVar));
			}
		}
		if ($_bUseAbortButton == true)
		{
			$_sReplaceVar = '';
			$_sReplaceVar .= '<input id="'.$_sFormID.'Abort" name="'.$_sFormID.'Submit" ';
			if ($_sOnAbort != NULL) {$_sReplaceVar .= 'type="button" onmouseup="'.$_sOnAbort.'" ';}
			else {$_sReplaceVar .= 'type="submit" onmouseup="oPGForm.disableSubmitButtons({\'xForm\': \''.$_sFormID.'\'});" ';}
			$_sReplaceVar .= 'value="'.$this->getText(array('sType' => 'AbortButtonText')).'"> ';
			$this->addTemplateReplaceVar(array('sVarname' => 'FormAbortButton', 'sReplace' => $_sReplaceVar));
		}
		else {$this->addTemplateReplaceVar(array('sVarname' => 'FormAbortButton', 'sReplace' => ''));}
		if ($_bUseSubmitButton === true)
		{
			$_sReplaceVar = '';
			$_sReplaceVar .= '<input id="'.$_sFormID.'Submit" name="'.$_sFormID.'Submit" ';
			if ($_sOnSubmit != NULL) {$_sReplaceVar .= 'type="button" onmouseup="'.$_sOnSubmit.'" ';}
			else {$_sReplaceVar .= 'type="submit" onmouseup="oPGForm.disableSubmitButtons({\'xForm\': \''.$_sFormID.'\'});" ';}
			$_sReplaceVar .= 'value="'.$this->getText(array('sType' => 'SubmitButtonText')).'">';
			$this->addTemplateReplaceVar(array('sVarname' => 'FormSubmitButton', 'sReplace' => $_sReplaceVar));
		}
		else {$this->addTemplateReplaceVar(array('sVarname' => 'FormSubmitButton', 'sReplace' => ''));}
		$_sHTML .= $this->buildTemplate(array('xTemplate' => $_xTemplate));
		$_sHTML .= '</form>';
		
		if ($this->bNetworkSend == true)
		{
			$_sHTML .= '<script language="JavaScript" type="text/javascript">';
			$_sHTML .= 'oPGForm.checkForJavaScript("'.$_sFormID.'"); ';
			
			if ($this->bJavaScriptAutoRegister == true)
			{
				for ($_iIndex=0; $_iIndex<count($this->axFormElements); $_iIndex++)
				{
					switch($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE])
					{
						case 'HiddenField':
							$_sHTML .= 'oPGForm.addHiddenFieldID({"sFormID": "'.$_sFormID.'", "sHiddenFieldID": "'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID].'"}); ';
						break;
						
						case 'InputField':
							$_sHTML .= 'oPGForm.addInputFieldID({"sFormID": "'.$_sFormID.'", "sInputFieldID": "'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_INPUTFIELD_ID].'"}); ';
						break;
					
						case 'TextArea':
							$_sHTML .= 'oPGForm.addTextAreaID({"sFormID": "'.$_sFormID.'", "sTextAreaID": "'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TEXTAREA_ID].'"}); ';
						break;
						
						case 'CheckBox':
							$_sHTML .= 'oPGForm.addCheckBoxID({"sFormID": "'.$_sFormID.'", "sCheckBoxID": "'.$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_CHECKBOX_ID].'"}); ';
						break;
					}
				}
			}
			$_sHTML .= '</script>';
		}
		
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	*/
	public function save($_sFormID)
	{
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		
		$_axData = $this->getReceivedData(array('sFormID' => $_sFormID));
		
		// TODO
		$_axDatabaseSaveStructure = array();
		for ($_iIndex=0; $_iIndex<count($this->axFormElements); $_iIndex++)
		{
			switch($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE])
			{
				case 'InputField':
				
				break;
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the submitted data of the form.[/en]
	[de]Gibt die abgeschickten Daten des Formulars zurück.[/de]
	
	@return axData [type]mixed[][/type]
	[en]Returns the submitted data of the form as an mixed array.[/en]
	[de]Gibt die abgeschickten Daten des Formulars als gemischten Array zurück.[/de]
	
	@param sFormID [type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sFormMethod [type]string[/type]
	[en]The send method of the form from which the data should be read off. "get" and "post" are possible. (Default: post)[/en]
	[de]Die Sende-Methode des Formulars von der die gesendeten Daten abgegriffen werden sollen. Möglich sind "get" und "post". (Standard: post)[/de]
	
	@param bEscapeForDatabases [type]bool[/type]
	[en]Specifies whether the data will be optimized for database queries. If set to "true" the data will be revised through realEscapeString(...).[/en]
	[de]Gibt an ob die Daten für Datenbankabfragen optimiert werden sollen. Bei "true" werden die Daten mit realEscapeString(...) überarbeitet.[/de]
	*/
	public function getReceivedData($_sFormID = NULL, $_sFormMethod = NULL, $_bEscapeForDatabases = NULL)
	{
		global $_POST, $_GET;

		$_sFormMethod = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormMethod', 'xParameter' => $_sFormMethod));
		$_bEscapeForDatabases = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'bEscapeForDatabases', 'xParameter' => $_bEscapeForDatabases));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		
		if ($_bEscapeForDatabases === NULL) {$_bEscapeForDatabases = false;}
		
		if ($_sFormID === NULL) {$_sFormID = '';}
		if ($_sFormMethod === NULL) {$_sFormMethod = '';}
		$_sFormMethod = strtolower($_sFormMethod);
		
		if ($_sFormMethod == '') {$_sFormMethod = $this->sFormMethod;}
		if ($_sFormID == '') {$_sFormID = $this->getID();}
		
		if ($_sFormMethod == 'post') {$_axData = $_POST;}
		else if ($_sFormMethod == 'get') {$_axData = $_GET;}
		else {$_axData = $_POST;}
		
		if (($this->iSecureActionLevel != PG_FORM_SECURE_ACTION_LEVEL_NONE) || ($this->iSecureLogLevel != PG_FORM_SECURE_LOG_LEVEL_NONE))
		{
			if ($_sToken = $this->checkTokenSession(array('sFormID' => $_sFormID, 'sToken' => $_axData[$_sFormID.'SessionTokenID'], 'sFormMethod' => $_sFormMethod)))
			{
				$_bWrongData = false;
				$this->axFormSecureErrors = array();
				$_axTokenData = $this->getTokenSessionData(array('sFormID' => $_sFormID, 'sToken' => $_sToken, 'sFormMethod' => $_sFormMethod));
				foreach ($_axTokenData as $_sName => $_xValue)
				{
					if (!isset($_axData[$_sName])) {$_bWrongData = true;}
					else {if ($_axData[$_sName] != $_xValue) {$_bWrongData = true;}}
					
					if ($_bWrongData == true)
					{
						if (($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_MEDIUM) || ($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_HIGH))
						{
							echo $this->getText(array('sType' => 'WrongFormToken'));
							exit;
						}
						else if ($this->iSecureLogLevel != PG_FORM_SECURE_LOG_LEVEL_NONE)
						{
							$this->axFormSecureErrors[] = array('sName' => $_sName, 'xWrongValue' => $_axData[$_sName], 'xRightValue' => $_xValue);
						}
					}
					
					if (($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_LOW) || ($this->bSecureBuildWithoutHiddenInputs == true)) {$_axData[$_sName] = $_xValue;}
				}
			}
		}
		
		if ($_bEscapeForDatabases == true)
		{
			if (isset($oPGDatabase)) {$_axData = $oPGDatabase->realEscapeString(array('xString' => $_axData));}
			else if (isset($oPGMySql)) {$_axData = $oPGMySql->realEscapeString(array('xString' => $_axData));}
			else if (isset($oPGMsSql)) {$_axData = $oPGMsSql->realEscapeString(array('xString' => $_axData));}
		}
		
		foreach($_axData as $_sName => $_xValue)
		{
			if (strpos($_sName, 'Field0') !== false)
			{
				$_axData[str_replace('Field0', '', $_sName)] = $_xValue;
			}
		}
		
		return $_axData;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Checks whether the session is still running and is ok.[/en]
	[de]Checkt ob die Session noch läuft und in Ordnung ist.[/de]
	
	@return sTokenID [type]string[/type]
	[en]Returns "false" on a faulty or expired session or cancels the whole script. Returns the token of the session if the session is running and ok.[/en]
	[de]Gibt bei einer fehlerhaften oder abgelaufenen Session "false" zurück oder bricht das ganze Script ab. Bei laufender Session die in Ordnung ist, wird der Token der Session als String zurückgegeben.[/de]
	
	@param sFormID [type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sToken [type]string[/type]
	[en]The token of the session can be specified to verify. Otherwise a token of the current session will be fetched from the form data.[/en]
	[de]Der Token der Session kann zur Überprüfung angegeben werden. Ansonsten wird ein Token der laufenden Session aus den Formulardaten geholt.[/de]
	
	@param sFormMethod [type]string[/type]
	[en]The send method of the form provides to access form data.[/en]
	[de]Die Sende-Methode des Formulars, über die Formulardaten abgegriffen werden sollen.[/de]
	*/
	public function checkTokenSession($_sFormID = NULL, $_sToken = NULL, $_sFormMethod = NULL)
	{
		global $_POST, $_GET;

		$_sToken = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sToken', 'xParameter' => $_sToken));
		$_sFormMethod = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormMethod', 'xParameter' => $_sFormMethod));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		
		if ($_sFormID === NULL) {$_sFormID = '';}
		if ($_sFormMethod === NULL) {$_sFormMethod = $this->getFormMethod();}
		$_sFormMethod = strtolower($_sFormMethod);

		if ($_sFormID == '') {$_sFormID = $this->getID();}
		
		if ($_sFormMethod == 'post') {$_axData = $_POST;}
		else if ($_sFormMethod == 'get') {$_axData = $_GET;}
		
		if ($_sToken == NULL)
		{
			if (isset($_axData[$_sFormID.'SessionTokenID']))
			{
				if (isset($_SESSION[$_sFormID.'Tokens'][$_axData[$_sFormID.'SessionTokenID']]))
				{
					$_sToken = $_axData[$_sFormID.'SessionTokenID'];
				}
				else if (($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_MEDIUM) || ($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_HIGH))
				{
					echo $this->getText(array('sType' => 'SessionExpired'));
					exit;
				}
				else if ($this->iSecureLogLevel != PG_FORM_SECURE_LOG_LEVEL_NONE)
				{
					$this->axFormSecureErrors[] = array('sMessage' => $this->getText(array('sType' => 'SessionExpired')));
				}
			}
		}
		
		if ($_sToken == NULL)
		{
			if (($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_MEDIUM) || ($this->iSecureActionLevel == PG_FORM_SECURE_ACTION_LEVEL_HIGH))
			{
				echo $this->getText(array('sType' => 'WrongFormToken'));
				exit;
			}
			else if ($this->iSecureLogLevel != PG_FORM_SECURE_LOG_LEVEL_NONE)
			{
				$this->axFormSecureErrors[] = array('sMessage' => $this->getText(array('sType' => 'WrongFormToken')));
			}
			return false;
		}
		return $_axData[$_sFormID.'SessionTokenID'];
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the data for a session token.[/en]
	[de]Gibt die Daten zu einem Token der Session zurück.[/de]
	
	@return axData [type]mixed[][/type]
	[en]Returns the data of the session due to the token.[/en]
	[de]Gibt die Daten der Session passend zum Token zurück.[/de]
	
	@param sFormID [type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sToken [type]string[/type]
	[en]The token of the session can be specified to verify. Otherwise a token of the current session will be fetched from the form data.[/en]
	[de]Der Token der Session kann zur Überprüfung angegeben werden. Ansonsten wird ein Token der laufenden Session aus den Formulardaten geholt.[/de]
	
	@param sFormMethod [type]string[/type]
	[en]The send method of the form provides to access form data.[/en]
	[de]Die Sende-Methode des Formulars, über die Formulardaten abgegriffen werden sollen.[/de]
	*/
	public function getTokenSessionData($_sFormID = NULL, $_sToken = NULL, $_sFormMethod = NULL)
	{
		$_sToken = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sToken', 'xParameter' => $_sToken));
		$_sFormMethod = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormMethod', 'xParameter' => $_sFormMethod));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));

		if ($_sFormID === NULL) {$_sFormID = '';}
		if ($_sFormID == '') {$_sFormID = $this->getID();}
		$_sToken = $this->checkTokenSession(array('sFormID' => $_sFormID, 'sToken' => $_sToken, 'sFormMethod' => $_sFormMethod));
		if ($_sToken != NULL) {return $_SESSION[$_sFormID.'Tokens'][$_sToken]['HiddenInputs'];}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Creates a new token and saves the form data in the session.[/en]
	[de]Erstellt einen neuen Token und speichert in der Session die Formulardaten.[/de]
	
	@return sToken [type]string[/type]
	[en]Returns the new token as a string.[/en]
	[de]Gibt den neuen Token als String zurück.[/de]
	
	@param sFormID [type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sToken [type]string[/type]
	[en]A token can be specified if a certain string should be used. At "NULL" a new generated randomly.[/en]
	[de]Ein Token kann angegeben werden, wenn ein bestimmter String dafür verwendet werden soll. Bei "NULL" wird ein neuer zufällig generiert.[/de]
	
	@param asIgnoreHiddenInputs [type]string[][/type]
	[en]Hidden fields that should be omitted (ignored) at security checks.[/en]
	[de]Versteckte Felder die bei Sicherheitsprüfungen ausgelassen (ignoriert) werden sollen.[/de]
	*/
	public function createTokenSession($_sFormID = NULL, $_sToken = NULL, $_asIgnoreHiddenInputs = NULL)
	{
		$_sToken = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sToken', 'xParameter' => $_sToken));
		$_asIgnoreHiddenInputs = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'asIgnoreHiddenInputs', 'xParameter' => $_asIgnoreHiddenInputs));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));

		if ($_sFormID === NULL) {$_sFormID = '';}
		if ($_sFormID == '') {$_sFormID = $this->getID();}

		if (($_sToken === NULL) || ($_sToken === ''))
		{
			do {$_sToken = md5(uniqid(rand(), true));}
			while(isset($_SESSION[$_sFormID.'Tokens'][$_sToken]));
		}
		
		$_axHiddenInputs = array();
		
		for ($_iIndex=0; $_iIndex<count($this->axFormElements); $_iIndex++)
		{
			if ($this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_TYPE] == 'HiddenField')
			{
				$_bIgnore = false;
				if ($_asIgnoreHiddenInputs != NULL)
				{
					for ($t=0; $t<count($_asIgnoreHiddenInputs); $t++)
					{
						if ($_asIgnoreHiddenInputs[$t] == $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID]) {$_bIgnore = true;}
					}
				}
				if ($_bIgnore == false) {$_axHiddenInputs[$this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_ID]] = $this->axFormElements[$_iIndex][PG_FORM_ELEMENTS_INDEX_HIDDENFIELD_VALUE];}
			}
		}
		
		// $_sCheckSum = md5($_sDataString.$_sToken);
		
		$_SESSION[$_sFormID.'Tokens'][$_sToken] = array(
			$_sFormID.'SessionTokenID' => $_sToken,
			// $_sFormID.'SessionTokenCheckSum' => $_sCheckSum,
			'HiddenInputs' => $_axHiddenInputs
		);
		
		return $_sToken;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Removes a token of a session.[/en]
	[de]Entfernt einen Token von einer Session.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sToken [type]string[/type]
	[en]The token that should be removed. At "NULL" the complete session of the form is removed.[/en]
	[de]Der Token der entfernt werden soll. Bei "NULL" wird die komplette Session für das Formular gelöscht.[/de]
	*/
	public function destroyTokenSession($_sFormID = NULL, $_sToken = NULL)
	{
		$_sToken = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sToken', 'xParameter' => $_sToken));
		$_sFormID = $this->getRealParameter(array('oParameters' => $_sFormID, 'sName' => 'sFormID', 'xParameter' => $_sFormID));
		
		if ($_sToken === NULL) {unset($_SESSION[$_sFormID.'Tokens']);}
		else {unset($_SESSION[$_sFormID.'Tokens'][$_sToken]);}
	}
	/* @end method */
}
/* @end class */
$oPGForm = new classPG_Form();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGForm', 'xValue' => $oPGForm));}
?>