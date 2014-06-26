/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 07 2012
*/
/*
@start class

@description
[en]This class has methods to the create, check and send forms.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen, prüfen und senden von Formularen.[/de]

@param extends classPG_ClassBasics
*/
function classPG_Form()
{	
	// Declarations...
	this.bConvertParametersBeforeSending = true;
	this.bParseFormOnSubmit = false;
	this.asParsedIDs = new Array();
	
	this.asHiddenFieldID = {};
	this.asInputFieldID = {};
	this.asTextAreaID = {};
	this.asCheckBoxID = {};

	// Construct...
	this.setID({'sID': 'PGForm'});
	this.initClassBasics();
	this.setNetworkResponseFile({'sFile': 'server.php'});

	// Methods...	
	/*
	@start method
	
	@description
	[en]Adds a hidden field ID to the form.[/en]
	[de]Fügt dem Formular eine verstecktes Feld ID hinzu.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sHiddenFieldID [needed][type]string[/type]
	[en]The ID of the hidden field.[/en]
	[de]Die ID des versteckten Feldes.[/de]
	*/
	this.addHiddenFieldID = function(_sFormID, _sHiddenFieldID)
	{
		if (typeof(_sHiddenFieldID) == 'undefined') {var _sHiddenFieldID = null;}

		_sHiddenFieldID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sHiddenFieldID', 'xParameter': _sHiddenFieldID});
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		if (typeof(this.asHiddenFieldID[_sFormID]) == 'undefined') {this.asHiddenFieldID[_sFormID] = new Array();}
		this.asHiddenFieldID[_sFormID].push(_sHiddenFieldID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a input field ID to the form.[/en]
	[de]Fügt dem Formular eine Eingabefeld ID hinzu.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]The ID of the input field.[/en]
	[de]Die ID des Eingabefeldes.[/de]
	*/
	this.addInputFieldID = function(_sFormID, _sInputFieldID)
	{
		if (typeof(_sInputFieldID) == 'undefined') {var _sInputFieldID = null;}

		_sInputFieldID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		if (typeof(this.asInputFieldID[_sFormID]) == 'undefined') {this.asInputFieldID[_sFormID] = new Array();}
		this.asInputFieldID[_sFormID].push(_sInputFieldID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a textarea ID to the form.[/en]
	[de]Fügt dem Formular eine Textfeld ID hinzu.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sTextAreaID [needed][type]string[/type]
	[en]The ID of the textarea.[/en]
	[de]Die ID des Textfeldes.[/de]
	*/
	this.addTextAreaID = function(_sFormID, _sTextAreaID)
	{
		if (typeof(_sTextAreaID) == 'undefined') {var _sTextAreaID = null;}

		_sTextAreaID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sTextAreaID', 'xParameter': _sTextAreaID});
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		if (typeof(this.asTextAreaID[_sFormID]) == 'undefined') {this.asTextAreaID[_sFormID] = new Array();}
		this.asTextAreaID[_sFormID].push(_sTextAreaID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a check-box ID to the form.[/en]
	[de]Fügt dem Formular eine Checkbox ID hinzu.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	
	@param sCheckboxID [needed][type]string[/type]
	[en]The ID of the check-box.[/en]
	[de]Die ID der Checkbox.[/de]
	*/
	this.addCheckBoxID = function(_sFormID, _sCheckBoxID)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}

		_sCheckBoxID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		if (typeof(this.asCheckBoxID[_sFormID]) == 'undefined') {this.asCheckBoxID[_sFormID] = new Array();}
		this.asCheckBoxID[_sFormID].push(_sCheckBoxID);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Hides the submit buttons[/en]
	[de]Versteckt die Submit-Buttons.[/de]
	
	@param xForm [needed][type]mixed[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	*/
	this.disableSubmitButtons = function(_xForm)
	{
		_xForm = this.getRealParameter({'oParameters': _xForm, 'sName': 'xForm', 'xParameter': _xForm, 'bNotNull': true});

		var _sFormID = '';
		if (typeof(_xForm) == 'object') {_sFormID = _xForm.id;} else {_sFormID = _xForm;}
		if (_sFormID != '')
		{
			var _oSubmitButton = this.oDocument.getElementById(_sFormID+'Submit');
			if (_oSubmitButton) {_oSubmitButton.style.display = 'none';}
			
			var _oAbortButton = this.oDocument.getElementById(_sFormID+'Abort');
			if (_oAbortButton) {_oAbortButton.style.display = 'none';}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sends the form.[/en]
	[de]Schickt das Formular ab.[/de]
	
	@param xForm [needed][type]mixed[/type]
	[en]The form as an HTML element object or as an ID string.[/en]
	[de]Das Formular als HTML-Element-Objekt oder als ID-String.[/de]
	
	@param sParameters [type]string[/type]
	[en]Additional parameters which should be sent to.[/en]
	[de]Zusätzliche Parameter die mit geschickt werden sollen.[/de]
	
	@param fOnSubmit [type]function[/type]
	[en]A function that is called before sending. Automatically all parameters of the form are passed as one object parameter ("_oParameters").[/en]
	[de]Eine Funktion die vor dem Senden aufgerufen wird. Es werden der Funktion automatisch alle Parameter des Formulars als ein einzelner object Parameter übergeben ("_oParameters").[/de]
	*/
	this.submit = function(_xForm, _sParameters, _fOnSubmit)
	{
		if (typeof(_xForm) == 'undefined') {var _xForm = null;}
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		if (typeof(_fOnSubmit) == 'undefined') {var _fOnSubmit = null;}
		
		_sParameters = this.getRealParameter({'oParameters': _xForm, 'sName': 'sParameters', 'xParameter': _sParameters});
		_fOnSubmit = this.getRealParameter({'oParameters': _xForm, 'sName': 'fOnSubmit', 'xParameter': _fOnSubmit});
		_xForm = this.getRealParameter({'oParameters': _xForm, 'sName': 'xForm', 'xParameter': _xForm, 'bNotNull': true});

		if ((this.oNetwork == null) && (typeof(oPGNetwork) != 'undefined')) {this.oNetwork = oPGNetwork;}
		if (_xForm == null) {_xForm = this.getID();}
		
		var _sFormID = '';
		if (typeof(_xForm) == 'object') {_sFormID = _xForm.id;} else {_sFormID = _xForm;}
		if (_sFormID != '')
		{
			var i = 0;
			var t = 0;
			
			var _oHiddenField = null;
			
			var _sInputFieldDataID = '';
			var _asInputFieldDataValues = new Array();
			var _asInputFieldDataNames = new Array();
			
			var _sInputFieldDataID = '';
			var _sTextAreaContent = '';
			
			var _iCheckBoxStatusIndex = 0;
			var _sCheckBoxStatus = '';
			var _sCheckBoxValue = '';
			
			var _bAllRequiredAreFilled = true;
			
			var _sParameters2 = '';
			var _oParameters = new Object();
			
			_sParameters2 += 'sForm='+_sFormID;
			_oParameters['sFormID'] = _sFormID;
			
			var _oSubmitButton = this.oDocument.getElementById(_sFormID+'Submit');
			if (_oSubmitButton)
			{
				_sParameters2 += '&'+_sFormID+'Submit='+_oSubmitButton.value;
				_oSubmitButton.disabled = true;
			}
			
			var _oAbortButton = this.oDocument.getElementById(_sFormID+'Abort');
			if (_oAbortButton) {_oAbortButton.disabled = true;}
			
			var _sUrlParameters = this.getUrlParametersString();
			if (_sUrlParameters != '')
			{
				_sParameters2 += '&'+_sParameters;
				_oParameters['sParameters'] = _sParameters;
			}
			
			// HiddenField...
			if (typeof(this.asHiddenFieldID[_sFormID]) != 'undefined')
			{
				for (i=0; i<this.asHiddenFieldID[_sFormID].length; i++)
				{
					_oHiddenField = this.oDocument.getElementById(this.asHiddenFieldID[_sFormID][i]);
					if (_oHiddenField)
					{
						if (this.bConvertParametersBeforeSending == true)
						{
							_sParameters2 += '&'+_oHiddenField.id+'='+encodeURIComponent(_oHiddenField.value);
						}
						else
						{
							_sParameters2 += '&sHiddenFieldID['+i+']='+_oHiddenField.id;
							_sParameters2 += '&sHiddenFieldValue['+i+']='+encodeURIComponent(_oHiddenField.value);
						}
						_oParameters[_oHiddenField.id] = _oHiddenField.value;
		
						if (this.bParseFormOnSubmit == true) {this.asParsedIDs.push(this.asHiddenFieldID[_sFormID][i]);}
					}
				}
			}
			
			// InputField...
			if (typeof(oPGInputField) != 'undefined')
			{
				if (typeof(this.asInputFieldID[_sFormID]) != 'undefined')
				{
					for (i=0; i<this.asInputFieldID[_sFormID].length; i++)
					{
						_sInputFieldDataID = oPGInputField.getDataID({'sInputFieldID': this.asInputFieldID[_sFormID][i]});
						_iInputFieldMode = oPGInputField.getInputFieldMode({'sInputFieldID': this.asInputFieldID[_sFormID][i]});
						_asInputFieldDataNames = oPGInputField.getDataNames({'sInputFieldID': this.asInputFieldID[_sFormID][i]});
						_asInputFieldDataValues = oPGInputField.getDataValues({'sInputFieldID': this.asInputFieldID[_sFormID][i]});
						
						if (oPGInputField.isMode({'iMode': PG_INPUTFIELD_MODE_DROPDOWN, 'iCurrentMode': _iInputFieldMode}))
						{
							if (this.bConvertParametersBeforeSending == true)
							{
								_sParameters2 += '&'+this.asInputFieldID[_sFormID][i]+'ID='+encodeURIComponent(_sInputFieldDataID);
							}
							else
							{
								_sParameters2 += '&sInputFieldID['+i+']='+this.asInputFieldID[_sFormID][i];
								_sParameters2 += '&sInputFieldDataID['+i+']='+encodeURIComponent(_sInputFieldDataID);
							}
							_oParameters[this.asInputFieldID[_sFormID][i]+'ID'] = _sInputFieldDataID;
						}
						
						if (this.bConvertParametersBeforeSending == true)
						{
							for (t=0; t<_asInputFieldDataValues.length; t++)
							{
								if (t==0)
								{
									_sParameters2 += '&'+this.asInputFieldID[_sFormID][i]+'='+encodeURIComponent(_asInputFieldDataValues[t]);
									_oParameters[this.asInputFieldID[_sFormID][i]] = _asInputFieldDataValues[t];
								}
								if (_asInputFieldDataValues.length > 1)
								{
									_sParameters2 += '&'+this.asInputFieldID[_sFormID][i]+'['+t+']='+encodeURIComponent(_asInputFieldDataValues[t]);
									_oParameters[this.asInputFieldID[_sFormID][i]+'_'+t] = _asInputFieldDataValues[t];
								}
							}
						}
						else
						{
							for (t=0; t<_asInputFieldDataValues.length; t++)
							{
								_sParameters2 += '&asInputFieldFieldName['+i+']['+t+']='+encodeURIComponent(_asInputFieldDataNames[t]);
								_sParameters2 += '&asInputFieldFieldValue['+i+']['+t+']='+encodeURIComponent(_asInputFieldDataValues[t]);
								_oParameters[_asInputFieldDataNames[t]] = _asInputFieldDataValues[t];
							}
						}
						
						if (this.bParseFormOnSubmit == true) {this.asParsedIDs = this.asParsedIDs.concat(oPGInputField.getIDStructure({'sInputFieldID': this.asInputFieldID[_sFormID][i]}));}
					}
				}
			}
			
			// TextArea...
			if (typeof(oPGTextArea) != 'undefined')
			{
				if (typeof(this.asTextAreaID[_sFormID]) != 'undefined')
				{
					for (i=0; i<this.asTextAreaID[_sFormID].length; i++)
					{
						_sTextAreaContent = oPGTextArea.getContent({'sTextAreaID': this.asTextAreaID[_sFormID][i]});
						if ((oPGTextArea.isRequired({'sTextAreaID': this.asTextAreaID[_sFormID][i]})) && (_sTextAreaContent == false)) {_bAllRequiredAreFilled = false;}
						
						if (this.bConvertParametersBeforeSending == true)
						{
							_sParameters2 += '&'+this.asTextAreaID[_sFormID][i]+'='+encodeURIComponent(_sTextAreaContent);
						}
						else
						{
							_sParameters2 += '&sTextAreaID['+i+']='+this.asTextAreaID[_sFormID][i];
							_sParameters2 += '&sTextAreaContent['+i+']='+encodeURIComponent(_sTextAreaContent);
						}
						_oParameters[this.asTextAreaID[_sFormID][i]] = _sTextAreaContent;
						
						if (this.bParseFormOnSubmit == true) {this.asParsedIDs = this.asParsedIDs.concat(oPGTextArea.getIDStructure({'sTextAreaID': this.asTextAreaID[_sFormID][i]}));}
					}
				}
			}
			
			// CheckBox...
			if (typeof(oPGCheckBox) != 'undefined')
			{
				if (typeof(this.asCheckBoxID[_sFormID]) != 'undefined')
				{
					for (i=0; i<this.asCheckBoxID[_sFormID].length; i++)
					{
						_iCheckBoxStatusIndex = oPGCheckBox.getStatusIndex({'sCheckBoxID': this.asCheckBoxID[_sFormID][i]});
						_sCheckBoxStatus = oPGCheckBox.getStatus({'sCheckBoxID': this.asCheckBoxID[_sFormID][i], 'iStatusIndex': _iCheckBoxStatusIndex});
						_sCheckBoxValue = oPGCheckBox.getValue({'sCheckBoxID': this.asCheckBoxID[_sFormID][i], 'iStatusIndex': _iCheckBoxStatusIndex});
						
						if (this.bConvertParametersBeforeSending == true)
						{
							_sParameters2 += '&'+this.asCheckBoxID[_sFormID][i]+'='+encodeURIComponent(_sCheckBoxValue);
							_sParameters2 += '&'+this.asCheckBoxID[_sFormID][i]+'StatusIndex='+encodeURIComponent(_iCheckBoxStatusIndex);
							_sParameters2 += '&'+this.asCheckBoxID[_sFormID][i]+'Status='+encodeURIComponent(_sCheckBoxStatus);
						}
						else
						{
							_sParameters2 += '&sCheckBoxID['+i+']='+this.asCheckBoxID[_sFormID][i];
							_sParameters2 += '&iCheckBoxStatus['+i+']='+encodeURIComponent(_iCheckBoxStatusIndex);
							_sParameters2 += '&sCheckBoxStatus['+i+']='+encodeURIComponent(_sCheckBoxStatus);
							_sParameters2 += '&sCheckBoxValue['+i+']='+encodeURIComponent(_sCheckBoxValue);
						}
						_oParameters[this.asCheckBoxID[_sFormID][i]] = _sCheckBoxValue;
						_oParameters[this.asCheckBoxID[_sFormID][i]+'StatusIndex'] = _iCheckBoxStatusIndex;
						_oParameters[this.asCheckBoxID[_sFormID][i]+'Status'] = _sCheckBoxStatus;
						
						if (this.bParseFormOnSubmit == true) {this.asParsedIDs = this.asParsedIDs.concat(oPGCheckBox.getIDStructure({'sCheckBoxID': this.asCheckBoxID[_sFormID][i]}));}
					}
				}
			}
			
			// Parse form...
			if (this.bParseFormOnSubmit == true)
			{
				var _bFound = false;
				var _oForm = this.oDocument.getElementById(_sFormID);
				if (_oForm)
				{
					var _aoFormChilds = _oForm.childNodes;
					for (i=0; i<_aoFormChilds.length; i++)
					{
						_bFound = false;
						if (typeof(_aoFormChilds[i].id) != 'undefined')
						{
							if (_aoFormChilds[i].id != "")
							{
								for (t=0; t<this.asParsedIDs.length; t++)
								{
									if (this.asParsedIDs[t] == _aoFormChilds[i].id) {_bFound = true;}
								}
								
								if (_bFound == false)
								{
									if ((_aoFormChilds[i].tagName == 'input') || (_aoFormChilds[i].tagName == 'textarea'))
									{
										_sParameters2 += '&'+_aoFormChilds[i].id+'='+encodeURIComponent(_aoFormChilds[i].value);
										_oParameters[_aoFormChilds[i].id] = _aoFormChilds[i].value;
									}
								}
							}
						}
					}
				}
			}
			
			if (_bAllRequiredAreFilled == true)
			{
				if (_fOnSubmit != null) {_fOnSubmit(_oParameters);}
				this.networkSend({'sParameters': _sParameters2});
			}
			else {/* todo: message and css changes for needed fields */}
		}
	}
	/* @end method */
	this.send = this.submit;
	
	/*
	@start method
	
	@description
	[en]Resets the form so that it is empty.[/en]
	[de]Setzt das Formular zurück, so dass es leer ist.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	*/
	this.clear = function(_sFormID)
	{
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		var i=0;		
		if (typeof(oPGInputField) != 'undefined')
		{
			if (typeof(this.asInputFieldID[_sFormID]) != 'undefined')
			{
				for (i=0; i<this.asInputFieldID[_sFormID].length; i++)
				{
					oPGInputField.clear(this.asInputFieldID[_sFormID][i]);
				}
			}
		}

		if (typeof(oPGTextArea) != 'undefined')
		{
			if (typeof(this.asTextAreaID[_sFormID]) != 'undefined')
			{
				for (i=0; i<this.asTextAreaID[_sFormID].length; i++)
				{
					oPGTextArea.clear(this.asTextAreaID[_sFormID][i]);
				}
			}
		}
		
		if (typeof(oPGCheckBox) != 'undefined')
		{
			if (typeof(this.asCheckBoxID[_sFormID]) != 'undefined')
			{
				for (i=0; i<this.asCheckBoxID[_sFormID].length; i++)
				{
					oPGCheckBox.clear(this.asCheckBoxID[_sFormID][i]);
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Checks whether the form can use JavaScript.[/en]
	[de]Prüft ob das Formular JavaScript verwenden kann.[/de]
	
	@param sFormID [needed][type]string[/type]
	[en]The ID of the form.[/en]
	[de]Die ID des Formulars.[/de]
	*/
	this.checkForJavaScript = function(_sFormID)
	{
		_sFormID = this.getRealParameter({'oParameters': _sFormID, 'sName': 'sFormID', 'xParameter': _sFormID});

		var _oForm = this.oDocument.getElementById(_sFormID);
		var _oFormSubmit = this.oDocument.getElementById(_sFormID+'Submit');
		if ((_oForm) && (_oFormSubmit))
		{
			_oForm.action = '#';
			_oFormSubmit.type = 'button';
			_oFormSubmit.onmouseup = 'oPGForm.submit({"sFormID": "'+_sFormID+'"});';
		}
	}
	/* @end method */
}
/* @end class */
classPG_Form.prototype = new classPG_ClassBasics();
var oPGForm = new classPG_Form();
