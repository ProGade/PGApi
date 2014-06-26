/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
var PG_INPUTFIELD_MODE_NONE = 0;
var PG_INPUTFIELD_MODE_AUTOCOMPLETE = 1;	// Default autocomplete from os system
var PG_INPUTFIELD_MODE_DROPDOWN = 2;		// Dropdown button on right of field
var PG_INPUTFIELD_MODE_SEARCH = 4;			// Input is also searching
var PG_INPUTFIELD_MODE_AUTOSAVE = 8;		// Save on select data (and on lost focus if all needed fields are filled)
var PG_INPUTFIELD_MODE_CREATE = 16;			// allow creating data
var PG_INPUTFIELD_MODE_UPDATE = 32;			// allow changing data
var PG_INPUTFIELD_MODE_DELETE = 64;			// allow deleting data
var PG_INPUTFIELD_MODE_READONLY = 128;
var PG_INPUTFIELD_MODE_AUTOCLOSE = 256;
var PG_INPUTFIELD_MODE_RESETONBLUR = 512;
var PG_INPUTFIELD_MODE_RESETONDROPDOWNCLOSE = 1024;
var PG_INPUTFIELD_MODE_AUTOSAVEONCREATE = 2048;
var PG_INPUTFIELD_MODE_STREAMINGDROPDOWN = 4096;

var PG_INPUTFIELD_TYPE_TEXT = 'text';
var PG_INPUTFIELD_TYPE_EMAIL = 'email';
var PG_INPUTFIELD_TYPE_DATE = 'date';
var PG_INPUTFIELD_TYPE_DATETIME = 'datetime';
var PG_INPUTFIELD_TYPE_DATETIMELOCAL = 'datetime-local';
var PG_INPUTFIELD_TYPE_MONTH = 'month';
var PG_INPUTFIELD_TYPE_NUMBER = 'number';
var PG_INPUTFIELD_TYPE_PASSWORD = 'password';
var PG_INPUTFIELD_TYPE_TEL = 'tel';
var PG_INPUTFIELD_TYPE_TIME = 'time';
var PG_INPUTFIELD_TYPE_URL = 'url';
var PG_INPUTFIELD_TYPE_WEEK = 'week';
var PG_INPUTFIELD_TYPE_SEARCH = 'search';

var PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX = 0;
var PG_INPUTFIELD_STRUCTURE_INDEX_NAME = 1;
var PG_INPUTFIELD_STRUCTURE_INDEX_VALUE = 2;
var PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE = 3;
var PG_INPUTFIELD_STRUCTURE_INDEX_ACCESSKEY = 4;
var PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED = 5;
var PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH = 6;
var PG_INPUTFIELD_STRUCTURE_INDEX_TYPE = 7;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR = 8;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS = 9;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN = 10;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP = 11;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK = 12;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN = 13;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP = 14;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER = 15;
var PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT = 16;

var PG_INPUTFIELD_DATASET_INDEX_ID = 0;
var PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD = 1;

var PG_INPUTFIELD_ACTIONSTATUS_FAILED = 0;
var PG_INPUTFIELD_ACTIONSTATUS_SUCCESS = 1;

var PG_INPUTFIELD_EVENT_ONBLUR = 'OnBlur';
var PG_INPUTFIELD_EVENT_ONSEARCH = 'OnSearch';
var PG_INPUTFIELD_EVENT_ONSTREAM = 'OnStream';
var PG_INPUTFIELD_EVENT_ONSELECT_DATASET = 'OnSelectDataset';
var PG_INPUTFIELD_EVENT_ONCREATE_DATASET = 'OnCreateDataset';
var PG_INPUTFIELD_EVENT_ONUPDATE_DATASET = 'OnUpdateDataset';
var PG_INPUTFIELD_EVENT_ONDELETE_DATASET = 'OnDeleteDataset';

var PG_INPUTFIELD_NETWORK_REQUESTTYPE = 'PG_InputFieldNetworkRequestType';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_InputField()
{
	// Declarations...
	this.oKeyUpTimeout = null;

	this.sImageDropdownButtonLeft = 'button_left.gif';
	this.sImageDropdownButtonRight = 'button_right.gif';
	this.sImageDropdownButtonLeftHover = 'button_left_hover.gif';
	this.sImageDropdownButtonRightHover = 'button_right_hover.gif';
	this.sImageDropdownButton = 'button_dropdown.gif';
	this.sImageDropdownButtonHover = 'button_dropdown_hover.gif';
	this.sImageDropdownButtonHide = 'button_dropdown_hide.gif';
	this.sImageDropdownButtonHideHover = 'button_dropdown_hide_hover.gif';

	this.sCssStyleInputFieldDatasetHover = 'background-color:#A1C6F0; color:#000000;';
	this.sCssStyleInputField = 'background-color:#FFFFFF; color:#000000; border:solid 1px #000000;';
	this.sCssStyleInputFieldDataSaved = 'background-color:#CCFFCC; color:#006600; border:solid 1px #006600;';
	this.sCssStyleInputFieldDataWrong = 'background-color:#FFCCCC; color:#660000; border:solid 1px #660000;';
	this.sCssStyleInputFieldDataNotSaved = 'background-color:#FFE99B; color:#654100; border:solid 1px #654100;';
	this.sCssStyleInputFieldNoData = 'background-color:#FFFFFF; color:#CCCCCC; border:solid 1px #707070;';
	
	this.sLastOpenedDropdownID = '';
	this.iKeyResponseWaitToSearch = 800;
	this.oResetOnBlurTimeout = null;
	this.sSendParameters = '';
	
	// Construct...
	this.setID({'sID': 'PGInputField'});
	this.initClassBasics();
	this.setGfxSubPath({'sPath': 'controls/'});
	this.setText(
		{'xType':
			{
				'DeleteQuestion': 'delete?',
				'YesButton': 'yes',
				'NoButton': 'no',
				'SwitchEditModeButton': 'switch edit mode',
				'CreateDatasetButton': 'create dataset',
				'UpdateDatasetButton': 'update dataset',
				'DeleteDatasetButton': 'delete'
			}
		}
	);
	
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
	
	@param iMilliseconds [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setKeyResponseWaitToSearch = function(_iMilliseconds)
	{
		_iMilliseconds = this.getRealParameter({'oParameters': _iMilliseconds, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		this.iKeyResponseWaitToSearch = _iMilliseconds;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMilliseconds [type]int[/type]
	[en]...[/en]
	*/
	this.getKeyResponseWaitToSearch = function() {return this.iKeyResponseWaitToSearch;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputFieldDatasetHover = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputFieldDatasetHover = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputFieldDatasetHover = function() {return this.sCssStyleInputFieldDatasetHover;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputField = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputField = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputField = function() {return this.sCssStyleInputField;}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputFieldDataSaved = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputFieldDataSaved = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputFieldDataSaved = function() {return this.sCssStyleInputFieldDataSaved;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputFieldDataWrong = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputFieldDataWrong = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputFieldDataWrong = function() {return this.sCssStyleInputFieldDataWrong;}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputFieldDataNotSaved = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputFieldDataNotSaved = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputFieldDataNotSaved = function() {return this.sCssStyleInputFieldDataNotSaved;}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssStyleInputFieldNoData = function(_sStyle)
	{
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		this.sCssStyleInputFieldNoData = _sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	this.getCssStyleInputFieldNoData = function() {return this.sCssStyleInputFieldNoData;}
	/* @end method */
	
	/*
	@start method
	
	@return asIDs [type]string[][/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getIDStructure = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _asIDs = new Array();
		_asIDs.push(_sInputFieldID);
		_asIDs.push(_sInputFieldID+'OldFieldValue');
		_asIDs.push(_sInputFieldID+'OldFieldID');
		_asIDs.push(_sInputFieldID+'SelectedIndex');
		_asIDs.push(_sInputFieldID+'DataID');
		_asIDs.push(_sInputFieldID+'Mode');
		_asIDs.push(_sInputFieldID+'FieldCount');
		_asIDs.push(_sInputFieldID+'DatasetCount');
		_asIDs.push(_sInputFieldID+'SendParams');
		
		var i=0;
		var t=0;
		var _iMaxFields = parseInt(this.oDocument.getElementById(_sInputFieldID+'FieldCount'));
		for (i=0; i<_iMaxFields; i++)
		{
			_asIDs.push(_sInputFieldID+'Field'+i);
			_asIDs.push(_sInputFieldID+'Field'+i+'Required');
			_asIDs.push(_sInputFieldID+'Field'+i+'NoData');
			_asIDs.push(_sInputFieldID+'Field'+i+'IsNoData');
		}
		
		var _iMaxDatasetFieldCount = 0;
		var _iMaxDatasets = parseInt(this.oDocument.getElementById(_sInputFieldID+'DatasetCount'));
		for (i=0; i<_iMaxDatasets; i++)
		{
			_iMaxDatasetFieldCount = parseInt(this.oDocument.getElementById(_sInputFieldID+'Dataset'+i+'FieldCount'));
			_asIDs.push(_sInputFieldID+'Dataset'+i+'ID');
			_asIDs.push(_sInputFieldID+'Dataset'+i+'FieldCount');
			for (t=PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE; t<_iMaxDatasetFieldCount+PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE; t++)
			{
				_asIDs.push(_sInputFieldID+'Dataset'+i+'Field'+t);
			}
		}
		
		return _asIDs;
	}
	/* @end method */

	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param xDataID [type]mixed[/type]
	[en]...[/en]
	
	@param axDataFields [type]mixed[][/type]
	[en]...[/en]
	*/
	this.setData = function(_sInputFieldID, _xDataID, _axDataFields)
	{
		if (typeof(_xDataID) == 'undefined') {var _xDataID = null;}
		if (typeof(_axDataFields) == 'undefined') {var _axDataFields = null;}

		_xDataID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xDataID', 'xParameter': _xDataID});
		_axDataFields = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axDataFields', 'xParameter': _axDataFields});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oInputField = null;
		
		if (_xDataID != null)
		{
			_oInputField = this.oDocument.getElementById(_sInputFieldID+"DataID");
			if (_oInputField) {_oInputField.value = _xDataID;}
		}

		if (_axDataFields != null)
		{
			var _oIsNoData = null;
			for (var i=0; i<_axDataFields.length; i++)
			{
				_oIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+i+'IsNoData');
				_oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+i);
				if ((_oInputField) && (_oIsNoData))
				{
					_oInputField.value = _axDataFields[i];
					_oIsNoData.value = 0;
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return axDataFields [type]mixed[][/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDataNames = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _axDataFields = new Array();
		var _oInputFieldCount = this.oDocument.getElementById(_sInputFieldID+"FieldCount");
		if (_oInputFieldCount)
		{
			var _oInputField = null;
			var _iFieldCount = parseInt(_oInputFieldCount.value);
			if (!isNaN(_iFieldCount))
			{
				for (var i=0; i<_iFieldCount; i++)
				{
					_oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+i);
					if (_oInputField) {_axDataFields.push(_oInputField.name);}
				}
			}
		}
		return _axDataFields;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axDataFields [type]mixed[][/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDataValues = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _axDataFields = new Array();
		var _oInputFieldCount = this.oDocument.getElementById(_sInputFieldID+"FieldCount");
		if (_oInputFieldCount)
		{
			var _oInputField = null;
			var _iFieldCount = parseInt(_oInputFieldCount.value);
			if (!isNaN(_iFieldCount))
			{
				for (var i=0; i<_iFieldCount; i++)
				{
					_oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+i);
					if (_oInputField) {_axDataFields.push(_oInputField.value);}
				}
			}
		}
		return _axDataFields;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iIndex [needed][type]int[/type]
	[en]...[/en]
	
	@param xData [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setDataValue = function(_sInputFieldID, _iIndex, _xData)
	{
		if (typeof(_iIndex) == 'undefined') {var _iIndex = null;}
		if (typeof(_xData) == 'undefined') {var _xData = null;}

		_iIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iIndex', 'xParameter': _iIndex});
		_xData = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xData', 'xParameter': _xData});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+_iIndex+'IsNoData');
		var _oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+_iIndex);
		if ((_oInputField) && (_oIsNoData))
		{
			_oInputField.value = _xData;
			_oIsNoData.value = 0;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.getDataValue = function(_sInputFieldID, _iIndex)
	{
		if (typeof(_iIndex) == 'undefined') {var _iIndex = null;}
		
		_iIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iIndex', 'xParameter': _iIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+_iIndex);
		if (_oInputField) {return _oInputField.value;}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@return xDataID [type]mixed[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getDataID = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		if (_oDataID) {return _oDataID.value;}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@return iFieldMode [type]int[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getInputFieldMode = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
		if (_oFieldMode) {return parseInt(_oFieldMode.value);}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.clear = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		if (_oDataID) {_oDataID.value = '';}
		
		var _oInputFieldCount = this.oDocument.getElementById(_sInputFieldID+"FieldCount");
		if (_oInputFieldCount)
		{
			var _oInputField = null;
			var _iFieldCount = parseInt(_oInputFieldCount.value);
			if (!isNaN(_iFieldCount))
			{
				for (var i=0; i<_iFieldCount; i++)
				{
					_oInputField = this.oDocument.getElementById(_sInputFieldID+"Field"+i);
					if (_oInputField) {_oInputField.value = '';}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param xContainer [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param iFieldSizeX [type]int[/type]
	[en]...[/en]
	
	@param sFieldName [type]string[/type]
	[en]...[/en]
	
	@param xFieldValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldNoValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param sFieldAccessKey [type]string[/type]
	[en]...[/en]
	
	@param bFieldRequired [type]bool[/type]
	[en]...[/en]
	
	@param iFieldMaxLength [type]int[/type]
	[en]...[/en]
	
	@param iFieldTabIndex [type]int[/type]
	[en]...[/en]
	
	@param sFieldType [type]string[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnBlur [type]string[/type]
	[en]...[/en]
	
	@param sOnFocus [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyDown [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyUp [type]string[/type]
	[en]...[/en]
	
	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseDown [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseUp [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOver [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOut [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	this.buildInto = function(
		_xContainer,
		_sInputFieldID,
		_iInputFieldMode,
		_iFieldSizeX,

		// Defaults...
		_sFieldName,
		_xFieldValue,
		_xFieldNoValue,
		_xFieldDatasetID,

		_sFieldAccessKey,
		_bFieldRequired,
		_iFieldMaxLength,
		_iFieldTabIndex,
		_sFieldType,
		_iDropdownZIndex,

		// Dropdown...
		_axDatasets,

		// Network...
		_sSendParameters,

		// Events...
		_sOnBlur,
		_sOnFocus,
		_sOnKeyDown,
		_sOnKeyUp,

		_sOnClick,
		_sOnMouseDown,
		_sOnMouseUp,
		_sOnMouseOver,
		_sOnMouseOut,

		_sOnDatasetSelect,
		_sOnSwitchEditMode,
		_sOnDatasetCreate,
		_sOnDatasetUpdate,
		_sOnDatasetDelete
	)
	{
		if (typeof(_xContainer) == 'undefined') {var _xContainer = null;}
		if (typeof(_sInputFieldID) == 'undefined') {var _sInputFieldID = null;}
		if (typeof(_iInputFieldMode) == 'undefined') {var _iInputFieldMode = null;}
		if (typeof(_iFieldSizeX) == 'undefined') {var _iFieldSizeX = null;}
		
		// Defaults...
		if (typeof(_sFieldName) == 'undefined') {var _sFieldName = null;}
		if (typeof(_xFieldValue) == 'undefined') {var _xFieldValue = null;}
		if (typeof(_xFieldNoValue) == 'undefined') {var _xFieldNoValue = null;}
		if (typeof(_xFieldDatasetID) == 'undefined') {var _xFieldDatasetID = null;}
		
		if (typeof(_sFieldAccessKey) == 'undefined') {var _sFieldAccessKey = null;}
		if (typeof(_bFieldRequired) == 'undefined') {var _bFieldRequired = null;}
		if (typeof(_iFieldMaxLength) == 'undefined') {var _iFieldMaxLength = null;}
		if (typeof(_iFieldTabIndex) == 'undefined') {var _iFieldTabIndex = null;}
		if (typeof(_sFieldType) == 'undefined') {var _sFieldType = null;}
		if (typeof(_iDropdownZIndex) == 'undefined') {var _iDropdownZIndex = null;}
		
		// Dropdown...
		if (typeof(_axDatasets) == 'undefined') {var _axDatasets = null;}
		
		// Network...
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		
		// Events...
		if (typeof(_sOnBlur) == 'undefined') {var _sOnBlur = null;}
		if (typeof(_sOnFocus) == 'undefined') {var _sOnFocus = null;}
		if (typeof(_sOnKeyDown) == 'undefined') {var _sOnKeyDown = null;}
		if (typeof(_sOnKeyUp) == 'undefined') {var _sOnKeyUp = null;}
		
		if (typeof(_sOnClick) == 'undefined') {var _sOnClick = null;}
		if (typeof(_sOnMouseDown) == 'undefined') {var _sOnMouseDown = null;}
		if (typeof(_sOnMouseUp) == 'undefined') {var _sOnMouseUp = null;}
		if (typeof(_sOnMouseOver) == 'undefined') {var _sOnMouseOver = null;}
		if (typeof(_sOnMouseOut) == 'undefined') {var _sOnMouseOut = null;}
		
		if (typeof(_sOnDatasetSelect) == 'undefined') {var _sOnDatasetSelect = null;}
		if (typeof(_sOnSwitchEditMode) == 'undefined') {var _sOnSwitchEditMode = null;}
		if (typeof(_sOnDatasetCreate) == 'undefined') {var _sOnDatasetCreate = null;}
		if (typeof(_sOnDatasetUpdate) == 'undefined') {var _sOnDatasetUpdate = null;}
		if (typeof(_sOnDatasetDelete) == 'undefined') {var _sOnDatasetDelete = null;}

		_sInputFieldID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		_iInputFieldMode = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iInputFieldMode', 'xParameter': _iInputFieldMode});
		_iFieldSizeX = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iFieldSizeX', 'xParameter': _iFieldSizeX});

		_sFieldName = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sFieldName', 'xParameter': _sFieldName});
		_xFieldValue = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xFieldValue', 'xParameter': _xFieldValue});
		_xFieldNoValue = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xFieldNoValue', 'xParameter': _xFieldNoValue});
		_xFieldDatasetID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xFieldDatasetID', 'xParameter': _xFieldDatasetID});
		
		_sFieldAccessKey = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sFieldAccessKey', 'xParameter': _sFieldAccessKey});
		_bFieldRequired = this.getRealParameter({'oParameters': _xContainer, 'sName': 'bFieldRequired', 'xParameter': _bFieldRequired});
		_iFieldMaxLength = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iFieldMaxLength', 'xParameter': _iFieldMaxLength});
		_iFieldTabIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		_sFieldType = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sFieldType', 'xParameter': _sFieldType});
		_iDropdownZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iDropdownZIndex', 'xParameter': _iDropdownZIndex});

		_axDatasets = this.getRealParameter({'oParameters': _xContainer, 'sName': 'axDatasets', 'xParameter': _axDatasets});

		_sSendParameters = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});

		_sOnBlur = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnBlur', 'xParameter': _sOnBlur});
		_sOnFocus = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnFocus', 'xParameter': _sOnFocus});
		_sOnKeyDown = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnKeyDown', 'xParameter': _sOnKeyDown});
		_sOnKeyUp = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnKeyUp', 'xParameter': _sOnKeyUp});

		_sOnClick = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnClick', 'xParameter': _sOnClick});
		_sOnMouseDown = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnMouseDown', 'xParameter': _sOnMouseDown});
		_sOnMouseUp = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnMouseUp', 'xParameter': _sOnMouseUp});
		_sOnMouseOver = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnMouseOver', 'xParameter': _sOnMouseOver});
		_sOnMouseOut = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnMouseOut', 'xParameter': _sOnMouseOut});

		_sOnDatasetSelect = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetSelect', 'xParameter': _sOnDatasetSelect});
		_sOnSwitchEditMode = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnSwitchEditMode', 'xParameter': _sOnSwitchEditMode});
		_sOnDatasetCreate = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetCreate', 'xParameter': _sOnDatasetCreate});
		_sOnDatasetUpdate = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetUpdate', 'xParameter': _sOnDatasetUpdate});
		_sOnDatasetDelete = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetDelete', 'xParameter': _sOnDatasetDelete});

		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': '_xContainer', 'xParameter': _xContainer, 'bNotNull': true});

		var _sHtml = this.build(
			{
				'sInputFieldID': _sInputFieldID, 'iInputFieldMode': _iInputFieldMode, 'iFieldSizeX': _iFieldSizeX,
				'sFieldName': _sFieldName, 'xFieldValue': _xFieldValue, 'xFieldNoValue': _xFieldNoValue, 'xFieldDatasetID': _xFieldDatasetID,
				'sFieldAccessKey': _sFieldAccessKey, 'bFieldRequired': _bFieldRequired, 'iFieldMaxLength': _iFieldMaxLength, 'iFieldTabIndex': _iFieldTabIndex, 'sFieldType': _sFieldType, 'iDropdownZIndex': _iDropdownZIndex,
				'axDatasets': _axDatasets,
				'sSendParameters': _sSendParameters,
				'sOnBlur': _sOnBlur, 'sOnFocus': _sOnFocus, 'sOnKeyDown': _sOnKeyDown, 'sOnKeyUp': _sOnKeyUp,
				'sOnClick': _sOnClick, 'sOnMouseDown': _sOnMouseDown, 'sOnMouseUp': _sOnMouseUp, 'sOnMouseOver': _sOnMouseOver, 'sOnMouseOut': _sOnMouseOut,
				'sOnDatasetSelect': _sOnDatasetSelect, 'sOnSwitchEditMode': _sOnSwitchEditMode, 'sOnDatasetCreate': _sOnDatasetCreate, 'sOnDatasetUpdate': _sOnDatasetUpdate, 'sOnDatasetDelete': _sOnDatasetDelete
			}
		);
		
		if (_xContainer != null)
		{
			var _oContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_oContainer) {_oContainer.innerHTML += _sHtml;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sInputFieldHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param iFieldSizeX [type]int[/type]
	[en]...[/en]
	
	@param sFieldName [type]string[/type]
	[en]...[/en]
	
	@param xFieldValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldNoValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param sFieldAccessKey [type]string[/type]
	[en]...[/en]
	
	@param bFieldRequired [type]bool[/type]
	[en]...[/en]
	
	@param iFieldMaxLength [type]int[/type]
	[en]...[/en]
	
	@param iFieldTabIndex [type]int[/type]
	[en]...[/en]
	
	@param sFieldType [type]string[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnBlur [type]string[/type]
	[en]...[/en]
	
	@param sOnFocus [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyDown [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyUp [type]string[/type]
	[en]...[/en]
	
	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseDown [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseUp [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOver [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOut [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	this.build = function(
		_sInputFieldID,
		_iInputFieldMode,
		_iFieldSizeX,

		// Defaults...
		_sFieldName,
		_xFieldValue,
		_xFieldNoValue,
		_xFieldDatasetID,

		_sFieldAccessKey,
		_bFieldRequired,
		_iFieldMaxLength,
		_iFieldTabIndex,
		_sFieldType,
		_iDropdownZIndex,

		// Dropdown...
		_axDatasets,

		// Network...
		_sSendParameters,

		// Events...
		_sOnBlur,
		_sOnFocus,
		_sOnKeyDown,
		_sOnKeyUp,

		_sOnClick,
		_sOnMouseDown,
		_sOnMouseUp,
		_sOnMouseOver,
		_sOnMouseOut,

		_sOnDatasetSelect,
		_sOnSwitchEditMode,
		_sOnDatasetCreate,
		_sOnDatasetUpdate,
		_sOnDatasetDelete
	)
	{
		if (typeof(_sInputFieldID) == 'undefined') {var _sInputFieldID = null;}
		if (typeof(_iInputFieldMode) == 'undefined') {var _iInputFieldMode = null;}
		if (typeof(_iFieldSizeX) == 'undefined') {var _iFieldSizeX = null;}
		
		// Defaults...
		if (typeof(_sFieldName) == 'undefined') {var _sFieldName = null;}
		if (typeof(_xFieldValue) == 'undefined') {var _xFieldValue = null;}
		if (typeof(_xFieldNoValue) == 'undefined') {var _xFieldNoValue = null;}
		if (typeof(_xFieldDatasetID) == 'undefined') {var _xFieldDatasetID = null;}
		
		if (typeof(_sFieldAccessKey) == 'undefined') {var _sFieldAccessKey = null;}
		if (typeof(_bFieldRequired) == 'undefined') {var _bFieldRequired = null;}
		if (typeof(_iFieldMaxLength) == 'undefined') {var _iFieldMaxLength = null;}
		if (typeof(_iFieldTabIndex) == 'undefined') {var _iFieldTabIndex = null;}
		if (typeof(_sFieldType) == 'undefined') {var _sFieldType = null;}
		if (typeof(_iDropdownZIndex) == 'undefined') {var _iDropdownZIndex = null;}
		
		// Dropdown...
		if (typeof(_axDatasets) == 'undefined') {var _axDatasets = null;}
		
		// Network...
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		
		// Events...
		if (typeof(_sOnBlur) == 'undefined') {var _sOnBlur = null;}
		if (typeof(_sOnFocus) == 'undefined') {var _sOnFocus = null;}
		if (typeof(_sOnKeyDown) == 'undefined') {var _sOnKeyDown = null;}
		if (typeof(_sOnKeyUp) == 'undefined') {var _sOnKeyUp = null;}
		
		if (typeof(_sOnClick) == 'undefined') {var _sOnClick = null;}
		if (typeof(_sOnMouseDown) == 'undefined') {var _sOnMouseDown = null;}
		if (typeof(_sOnMouseUp) == 'undefined') {var _sOnMouseUp = null;}
		if (typeof(_sOnMouseOver) == 'undefined') {var _sOnMouseOver = null;}
		if (typeof(_sOnMouseOut) == 'undefined') {var _sOnMouseOut = null;}
		
		if (typeof(_sOnDatasetSelect) == 'undefined') {var _sOnDatasetSelect = null;}
		if (typeof(_sOnSwitchEditMode) == 'undefined') {var _sOnSwitchEditMode = null;}
		if (typeof(_sOnDatasetCreate) == 'undefined') {var _sOnDatasetCreate = null;}
		if (typeof(_sOnDatasetUpdate) == 'undefined') {var _sOnDatasetUpdate = null;}
		if (typeof(_sOnDatasetDelete) == 'undefined') {var _sOnDatasetDelete = null;}

		_iInputFieldMode = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iInputFieldMode', 'xParameter': _iInputFieldMode});
		_iFieldSizeX = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldSizeX', 'xParameter': _iFieldSizeX});

		_sFieldName = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sFieldName', 'xParameter': _sFieldName});
		_xFieldValue = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xFieldValue', 'xParameter': _xFieldValue});
		_xFieldNoValue = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xFieldNoValue', 'xParameter': _xFieldNoValue});
		_xFieldDatasetID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xFieldDatasetID', 'xParameter': _xFieldDatasetID});
		
		_sFieldAccessKey = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sFieldAccessKey', 'xParameter': _sFieldAccessKey});
		_bFieldRequired = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'bFieldRequired', 'xParameter': _bFieldRequired});
		_iFieldMaxLength = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldMaxLength', 'xParameter': _iFieldMaxLength});
		_iFieldTabIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		_sFieldType = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sFieldType', 'xParameter': _sFieldType});
		_iDropdownZIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iDropdownZIndex', 'xParameter': _iDropdownZIndex});

		_axDatasets = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axDatasets', 'xParameter': _axDatasets});

		_sSendParameters = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});

		_sOnBlur = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnBlur', 'xParameter': _sOnBlur});
		_sOnFocus = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnFocus', 'xParameter': _sOnFocus});
		_sOnKeyDown = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnKeyDown', 'xParameter': _sOnKeyDown});
		_sOnKeyUp = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnKeyUp', 'xParameter': _sOnKeyUp});

		_sOnClick = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnClick', 'xParameter': _sOnClick});
		_sOnMouseDown = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnMouseDown', 'xParameter': _sOnMouseDown});
		_sOnMouseUp = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnMouseUp', 'xParameter': _sOnMouseUp});
		_sOnMouseOver = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnMouseOver', 'xParameter': _sOnMouseOver});
		_sOnMouseOut = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnMouseOut', 'xParameter': _sOnMouseOut});

		_sOnDatasetSelect = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetSelect', 'xParameter': _sOnDatasetSelect});
		_sOnSwitchEditMode = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnSwitchEditMode', 'xParameter': _sOnSwitchEditMode});
		_sOnDatasetCreate = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetCreate', 'xParameter': _sOnDatasetCreate});
		_sOnDatasetUpdate = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetUpdate', 'xParameter': _sOnDatasetUpdate});
		_sOnDatasetDelete = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetDelete', 'xParameter': _sOnDatasetDelete});

		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		if ((_sInputFieldID === null) || (_sInputFieldID === '')) {_sInputFieldID = this.getNextID();}
		if ((_iFieldSizeX === null) || (_iFieldSizeX === 0)) {_iFieldSizeX = 150;}
		if (_bFieldRequired === null) {_bFieldRequired = false;}

		var _axFieldStructures = new Array();
		_axFieldStructures.push(
			this.buildFieldStructure(
				{
					'iSizeX': _iFieldSizeX, 'sName': _sInputFieldID, 'xValue': _xFieldValue, '_xNoValue': _xFieldNoValue,
					'sAccessKey': _sFieldAccessKey, 'bRequired': _bFieldRequired, 'iMaxLength': _iFieldMaxLength, '_sType': _sFieldType,
					'sOnBlur': _sOnBlur, 'sOnFocus': _sOnFocus, 'sOnKeyDown': _sOnKeyDown, 'sOnKeyUp': _sOnKeyUp,
					'sOnClick': _sOnClick, 'sOnMouseDown': _sOnMouseDown, 'sOnMouseUp': _sOnMouseUp, 'sOnMouseOver': _sOnMouseOver, 'sOnMouseOut': _sOnMouseOut
				}
			)
		);

		return this.buildMulti(
			{
				'sInputFieldID': _sInputFieldID, 'iInputFieldMode': _iInputFieldMode,
				'axFieldStructures': _axFieldStructures, 'xFieldDatasetID': _xFieldDatasetID,
				'iTabIndex': _iTabIndex, 'iDropdownZIndex': _iDropdownZIndex,
				'axDatasets': _axDatasets,
				'sSendParameters': _sSendParameters,
				'sOnDatasetSelect': _sOnDatasetSelect, 'sOnSwitchEditMode': _sOnSwitchEditMode, 'sOnDatasetCreate': _sOnDatasetCreate, 'sOnDatasetUpdate': _sOnDatasetUpdate, 'sOnDatasetDelete': _sOnDatasetDelete
			}
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@param xContainer [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param axFieldStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param iTabIndex [type]int[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	this.buildMultiInto = function(
		_xContainer,
		_sInputFieldID,
		_iInputFieldMode,

		// Defaults...
		_axFieldStructures,
		_xFieldDatasetID,

		_iTabIndex,
		_iDropdownZIndex,

		// Dropdown...
		_axDatasets,

		// Network...
		_sSendParameters,

		// Events...
		_sOnDatasetSelect,
		_sOnSwitchEditMode,
		_sOnDatasetCreate,
		_sOnDatasetUpdate,
		_sOnDatasetDelete
	)
	{
		if (typeof(_xContainer) == 'undefined') {var _xContainer = null;}
		if (typeof(_sInputFieldID) == 'undefined') {var _sInputFieldID = null;}
		if (typeof(_iInputFieldMode) == 'undefined') {var _iInputFieldMode = null;}
		
		// Defaults...
		if (typeof(_axFieldStructures) == 'undefined') {var _axFieldStructures = null;}
		if (typeof(_xFieldDatasetID) == 'undefined') {var _xFieldDatasetID = null;}
		
		if (typeof(_iTabIndex) == 'undefined') {var _iTabIndex = null;}
		if (typeof(_iDropdownZIndex) == 'undefined') {var _iDropdownZIndex = null;}
		
		// Dropdown...
		if (typeof(_axDatasets) == 'undefined') {var _axDatasets = null;}
		
		// Network...
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		
		// Events...
		if (typeof(_sOnDatasetSelect) == 'undefined') {var _sOnDatasetSelect = null;}
		if (typeof(_sOnSwitchEditMode) == 'undefined') {var _sOnSwitchEditMode = null;}
		if (typeof(_sOnDatasetCreate) == 'undefined') {var _sOnDatasetCreate = null;}
		if (typeof(_sOnDatasetUpdate) == 'undefined') {var _sOnDatasetUpdate = null;}
		if (typeof(_sOnDatasetDelete) == 'undefined') {var _sOnDatasetDelete = null;}

		_sInputFieldID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		_iInputFieldMode = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iInputFieldMode', 'xParameter': _iInputFieldMode});

		_axFieldStructures = this.getRealParameter({'oParameters': _xContainer, 'sName': 'axFieldStructures', 'xParameter': _axFieldStructures});
		_xFieldDatasetID = this.getRealParameter({'oParameters': _xContainer, 'sName': 'xFieldDatasetID', 'xParameter': _xFieldDatasetID});
		
		_iTabIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iTabIndex', 'xParameter': _iTabIndex});
		_iDropdownZIndex = this.getRealParameter({'oParameters': _xContainer, 'sName': 'iDropdownZIndex', 'xParameter': _iDropdownZIndex});

		_axDatasets = this.getRealParameter({'oParameters': _xContainer, 'sName': 'axDatasets', 'xParameter': _axDatasets});

		_sSendParameters = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});

		_sOnDatasetSelect = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetSelect', 'xParameter': _sOnDatasetSelect});
		_sOnSwitchEditMode = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnSwitchEditMode', 'xParameter': _sOnSwitchEditMode});
		_sOnDatasetCreate = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetCreate', 'xParameter': _sOnDatasetCreate});
		_sOnDatasetUpdate = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetUpdate', 'xParameter': _sOnDatasetUpdate});
		_sOnDatasetDelete = this.getRealParameter({'oParameters': _xContainer, 'sName': 'sOnDatasetDelete', 'xParameter': _sOnDatasetDelete});

		_xContainer = this.getRealParameter({'oParameters': _xContainer, 'sName': '_xContainer', 'xParameter': _xContainer, 'bNotNull': true});
		
		var _sHtml = this.buildMulti(
			{
				'sInputFieldID': _sInputFieldID, 'iInputFieldMode': _iInputFieldMode,
				'axFieldStructures': _axFieldStructures, 'xFieldDatasetID': _xFieldDatasetID,
				'iTabIndex': _iTabIndex, 'iDropdownZIndex': _iDropdownZIndex,
				'axDatasets': _axDatasets,
				'sSendParameters': _sSendParameters,
				'sOnDatasetSelect': _sOnDatasetSelect, 'sOnSwitchEditMode': _sOnSwitchEditMode, 'sOnDatasetCreate': _sOnDatasetCreate, 'sOnDatasetUpdate': _sOnDatasetUpdate, 'sOnDatasetDelete': _sOnDatasetDelete
			}
		);
		
		if (_xContainer != null)
		{
			_xContainer = this.getContainerObject({'xContainer': _xContainer});
			if (_xContainer) {_xContainer.innerHTML += _sHtml;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sInputFieldHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param axFieldStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param iTabIndex [type]int[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	this.buildMulti = function(
		_sInputFieldID,
		_iInputFieldMode,

		// Defaults...
		_axFieldStructures,
		_xFieldDatasetID,

		_iTabIndex,
		_iDropdownZIndex,

		// Dropdown...
		_axDatasets,

		// Network...
		_sSendParameters,

		// Events...
		_sOnDatasetSelect,
		_sOnSwitchEditMode,
		_sOnDatasetCreate,
		_sOnDatasetUpdate,
		_sOnDatasetDelete
	)
	{
		if (typeof(_sInputFieldID) == 'undefined') {var _sInputFieldID = null;}
		if (typeof(_iInputFieldMode) == 'undefined') {var _iInputFieldMode = null;}
		
		// Defaults...
		if (typeof(_axFieldStructures) == 'undefined') {var _axFieldStructures = null;}
		if (typeof(_xFieldDatasetID) == 'undefined') {var _xFieldDatasetID = null;}
		
		if (typeof(_iTabIndex) == 'undefined') {var _iTabIndex = null;}
		if (typeof(_iDropdownZIndex) == 'undefined') {var _iDropdownZIndex = null;}
		
		// Dropdown...
		if (typeof(_axDatasets) == 'undefined') {var _axDatasets = null;}
		
		// Network...
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		
		// Events...
		if (typeof(_sOnDatasetSelect) == 'undefined') {var _sOnDatasetSelect = null;}
		if (typeof(_sOnSwitchEditMode) == 'undefined') {var _sOnSwitchEditMode = null;}
		if (typeof(_sOnDatasetCreate) == 'undefined') {var _sOnDatasetCreate = null;}
		if (typeof(_sOnDatasetUpdate) == 'undefined') {var _sOnDatasetUpdate = null;}
		if (typeof(_sOnDatasetDelete) == 'undefined') {var _sOnDatasetDelete = null;}

		if ((_sInputFieldID === null) || (_sInputFieldID === '')) {_sInputFieldID = this.getNextID();}
		if ((_iInputFieldMode === null) || (_iInputFieldMode === 0)) {_iInputFieldMode = PG_INPUTFIELD_MODE_NONE;}
		
		if (_xFieldDatasetID === null) {_xFieldDatasetID = '';}
		if (_iInputFieldMode === null) {_iInputFieldMode = 0;}
		if (_sSendParameters === null) {_sSendParameters = '';}
		if (_axFieldStructures === null) {_axFieldStructures = this.buildFieldStructure(150, _sInputFieldID);}

		_iInputFieldMode = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iInputFieldMode', 'xParameter': _iInputFieldMode});

		_axFieldStructures = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axFieldStructures', 'xParameter': _axFieldStructures});
		_xFieldDatasetID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'xFieldDatasetID', 'xParameter': _xFieldDatasetID});
		
		_iTabIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iTabIndex', 'xParameter': _iTabIndex});
		_iDropdownZIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iDropdownZIndex', 'xParameter': _iDropdownZIndex});

		_axDatasets = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axDatasets', 'xParameter': _axDatasets});

		_sSendParameters = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});

		_sOnDatasetSelect = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetSelect', 'xParameter': _sOnDatasetSelect});
		_sOnSwitchEditMode = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnSwitchEditMode', 'xParameter': _sOnSwitchEditMode});
		_sOnDatasetCreate = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetCreate', 'xParameter': _sOnDatasetCreate});
		_sOnDatasetUpdate = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetUpdate', 'xParameter': _sOnDatasetUpdate});
		_sOnDatasetDelete = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sOnDatasetDelete', 'xParameter': _sOnDatasetDelete});
		
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		
		var i=0;
		var t=0;
		_iFullSizeX = 0;
		_sHtml = '';
		_sHtml += '<div id="'+_sInputFieldID+'" style="float:left; position:relative;" ';
		_sHtml += 'onmouseover="oPGInputField.inputFieldOnMouseOver({\'sInputFieldID\': \''+_sInputFieldID+'\'});" ';
		_sHtml += 'onmouseout="oPGInputField.inputFieldOnMouseOut({\'sInputFieldID\': \''+_sInputFieldID+'\'});" ';
		_sHtml += '>';
		_sHtml += '<table style="border-width:0px;" cellpadding="0" cellspacing="0">';
		_sHtml += '<tr>';
			for (i=0; i<_axFieldStructures.length; i++)
			{
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME] == '') {_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME] = _sInputFieldID+'Field'+i;}
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] < 1) {_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] = 150;}
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] === null) {_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] = '';}
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] === null) {_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] = '';}
				_iFullSizeX += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX]+2;
				
				// Field...
				_sHtml += '<td>';
				_sHtml += '<input type="text" id="'+_sInputFieldID+'Field'+i+'" style="';
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== null)) {_sHtml += this.sCssStyleInputField+' ';}
				else {_sHtml += this.sCssStyleInputFieldNoData+' ';}
				_sHtml += 'padding-left:0px; padding-right:0px; margin-left:0px; margin-right:0px; ';
				_sHtml += 'width:'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX]+'px; ';
				_sHtml += '" name="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME]+'" ';
				if (_iTabIndex > 0) {_sHtml += 'tabindex="'+(_iTabIndex+i)+'" ';}
				if (!this.isMode({'iMode': PG_INPUTFIELD_MODE_AUTOCOMPLETE, 'iCurrentMode': _iInputFieldMode})) {_sHtml += 'autocomplete="off" ';}
				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode': _iInputFieldMode})) {_sHtml += 'readonly ';}
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH] > 0) {_sHtml += 'maxlength="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH]+'" ';}
				
				// KeyDown...
				_sHtml += 'onkeydown="';
					if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] !== null))
					{
						_sJavaScript = _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN];
						_sHtml += _sJavaScript.replace(/"/g, '\"')+' ';
					}
					_sHtml += 'oPGInputField.inputFieldOnKeyDown({\'sInputFieldID\': \''+_sInputFieldID+'\'}); ';
				_sHtml += '" ';
				
				// KeyUp...
				_sHtml += 'onkeyup="';
					if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] !== null))
					{
						_sHtml += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP].replace(/"/g, '\"')+' ';
					}
					_sHtml += 'oPGInputField.inputFieldOnKeyUp({\'sInputFieldID\': \''+_sInputFieldID+'\'}); ';
				_sHtml += '" ';
				
				// OnBlur...
				_sHtml += 'onblur="';
					if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] !== null))
					{
						_sHtml += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR].replace(/"/g, '\"')+' ';
					}
					_sHtml += 'oPGInputField.inputFieldOnBlur({\'sInputFieldID\': \''+_sInputFieldID+'\', \'iFieldIndex\': '+i+'}); ';
				_sHtml += '" ';
				
				// OnFocus...
				_sHtml += 'onfocus="';
					if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] !== null))
					{
						_sHtml += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS].replace(/"/g, '\"')+' ';
					}
					_sHtml += 'oPGInputField.inputFieldOnFocus({\'sInputFieldID\': \''+_sInputFieldID+'\', \'iFieldIndex\': '+i+'\}); ';
				_sHtml += '" ';
				
				// OnClick...
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] !== null))
				{
					_sHtml += 'onclick="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK].replace(/"/g, '\"')+'"';
				}
				
				// OnMouseDown...
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] !== null))
				{
					_sHtml += 'onmousedown="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN].replace(/"/g, '\"')+'"';
				}
				
				// OnMouseUp...
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] !== null))
				{
					_sHtml += 'onmouseup="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP].replace(/"/g, '\"')+'"';
				}
				
				// OnMouseOver...
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] !== null))
				{
					_sHtml += 'onmouseover="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER].replace(/"/g, '\"')+'"';
				}
				
				// OnMouseOut...
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] !== null))
				{
					_sHtml += 'onmouseout="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT].replace(/"/g, '\"')+'"';
				}
				
				// Value...
				_sHtml += 'value="';
					if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== null))
					{
						_sHtml += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE];
					}
					else {_sHtml += _axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE];}
				_sHtml += '" />';
				
				// Required...
				_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Field'+i+'Required" ';
				if (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED] == true) {_sHtml += 'value="1" ';} else {_sHtml += 'value="0" ';}
				_sHtml += ' name="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME]+'Required" />';
				
				// IsNoData/NoValue...
				_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Field'+i+'NoData" value="'+_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE]+'" />';
				_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Field'+i+'IsNoData" value="';
				if ((_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && (_axFieldStructures[i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== null)) {_sHtml += '0';}
				else {_sHtml += '1';}
				_sHtml += '" />';

				_sHtml += '</td>';
			}
			
			// Dropdown...
			if (this.isMode({'iMode': PG_INPUTFIELD_MODE_DROPDOWN, 'iCurrentMode': _iInputFieldMode}))
			{
				// Dropdown button...
				// TODO: austauschen durch controls button
				_sHtml += '<td>';
				_sHtml += '<div ';
				_sHtml += 'onmouseover="oPGInputField.changeDropdownButton({\'sInputFieldID\': \''+_sInputFieldID+'\', \'sToDisplay\': \'Hover\'});" ';
				_sHtml += 'onmouseout="oPGInputField.changeDropdownButton({\'sInputFieldID\': \''+_sInputFieldID+'\', \'sToDisplay\': \'Normal\'});" ';
				_sHtml += 'class="'+this.sCssClassButton+'">';
				_sHtml += '<table id="'+_sInputFieldID+'DropdownButtonNormal" ';
				_sHtml += 'onclick="oPGInputField.showDropdown({\'sInputFieldID\': \''+_sInputFieldID+'\'});" ';
				_sHtml += 'style="display:block; border-width:0px;" cellpadding="0" cellspacing="0">';
				_sHtml += '<tr>';
					if (this.oGFXPack)
					{
						if (this.sImageButtonLeft != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonLeft})+'</td>';}
						_sHtml += '<td>'+this.img({'sImage': this.sImageDropdownButton})+'</td>';
						if (this.sImageButtonRight != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonRight})+'</td>';}
					}
					else
					{
						if (this.sImageButtonLeft != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageButtonLeft})+'" style="border-width:0px;" unselectable="on" /></td>';}
						_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageDropdownButton})+'" style="border-width:0px;" unselectable="on" /></td>';
						if (this.sImageButtonRight != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageButtonRight})+'" style="border-width:0px;" unselectable="on" /></td>';}
					}
				_sHtml += '</tr>';
				_sHtml += '</table>';
				_sHtml += '<table id="'+_sInputFieldID+'DropdownButtonHover" ';
				_sHtml += 'onclick="oPGInputField.showDropdown(\''+_sInputFieldID+'\');" ';
				_sHtml += 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
				_sHtml += '<tr>';
					if (this.oGFXPack)
					{
						if (this.sImageButtonLeftHover != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonLeftHover})+'</td>';}
						_sHtml += '<td>'+this.img({'sImage': this.sImageDropdownButtonHover})+'</td>';
						if (this.sImageButtonRightHover != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonRightHover})+'</td>';}
					}
					else
					{
						if (this.sCssClassButtonLeftHover != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sCssClassButtonLeftHover})+'" style="border-width:0px;" unselectable="on" /></td>';}
						_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageDropdownButtonHover})+'" style="border-width:0px;" unselectable="on" /></td>';
						if (this.sCssClassButtonRightHover != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sCssClassButtonRightHover})+'" style="border-width:0px;" unselectable="on" /></td>';}
					}
				_sHtml += '</tr>';
				_sHtml += '</table>';
				_sHtml += '<table id="'+_sInputFieldID+'DropdownButtonHideNormal" ';
				_sHtml += 'onclick="oPGInputField.hideDropdown(\''+_sInputFieldID+'\');" ';
				_sHtml += 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
				_sHtml += '<tr>';
					if (this.oGFXPack)
					{
						if (this.sImageButtonLeft != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonLeft})+'</td>';}
						_sHtml += '<td>'+this.img({'sImage': this.sImageDropdownButtonHide})+'</td>';
						if (this.sImageButtonRight != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonRight})+'</td>';}
					}
					else
					{
						if (this.sImageButtonLeft != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageButtonLeft})+'" style="border-width:0px;" unselectable="on" /></td>';}
						_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageDropdownButtonHide})+'" style="border-width:0px;" unselectable="on" /></td>';
						if (this.sImageButtonRight != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageButtonRight})+'" style="border-width:0px;" unselectable="on" /></td>';}
					}
				_sHtml += '</tr>';
				_sHtml += '</table>';
				_sHtml += '<table id="'+_sInputFieldID+'DropdownButtonHideHover" ';
				_sHtml += 'onclick="oPGInputField.hideDropdown(\''+_sInputFieldID+'\');" ';
				_sHtml += 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
				_sHtml += '<tr>';
					if (this.oGFXPack)
					{
						if (this.sImageButtonLeftHover != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonLeftHover})+'</td>';}
						_sHtml += '<td>'+this.img({'sImage': this.sImageDropdownButtonHideHover})+'</td>';
						if (this.sImageButtonRightHover != '') {_sHtml += '<td>'+this.img({'sImage': this.sImageButtonRightHover})+'</td>';}
					}
					else
					{
						if (this.sCssClassButtonLeftHover != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sCssClassButtonLeftHover})+'" style="border-width:0px;" unselectable="on" /></td>';}
						_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sImageDropdownButtonHideHover})+'" style="border-width:0px;" unselectable="on" /></td>';
						if (this.sCssClassButtonRightHover != '') {_sHtml += '<td><img src="'+this.getGfxPathImages({'sImage': this.sCssClassButtonRightHover})+'" style="border-width:0px;" unselectable="on" /></td>';}
					}
				_sHtml += '</tr>';
				_sHtml += '</table>';
				_sHtml += '</div>';
				_sHtml += '</td>';
			}
			
		_sHtml += '</tr>';
		_sHtml += '</table>';
		
		// Dropdown...
		if (this.isMode({'iMode': PG_INPUTFIELD_MODE_DROPDOWN, 'iCurrentMode': _iInputFieldMode}))
		{
			// Dropdown div...
			_sHtml += '<div id="'+_sInputFieldID+'DropdownDiv" style="position:absolute; top:0px; left:0px; display:none; ';
			if (_iDropdownZIndex !== null) {_sHtml += 'z-index:'+_iDropdownZIndex+'; ';}
			_sHtml += 'width:'+(_iFullSizeX+22)+'px; border:solid 1px #000000; background-color:#FFFFFF;">';
				_sHtml += '<div id="'+_sInputFieldID+'DropdownDataDiv" style="overflow:auto; width:'+(_iFullSizeX+22)+'px; height:150px;">';
				for (i=0; i<_axDatasets.length; i++)
				{
					_sHighlightArray = 'new Array(\''+_sInputFieldID+'Dataset'+i+'\')';
					
					_sHtml += '<table id="'+_sInputFieldID+'Dataset'+i+'" style="border-collapse:collapse; cursor:default;" ';
					_sHtml += 'onmouseover="if (typeof(oPGHover) != \'undefined\') {oPGHover.showHighlight('+_sHighlightArray+', \'border-collapse:collapse; cursor:default; '+this.sCssStyleInputFieldDatasetHover+'\');}" ';
					_sHtml += 'onmouseout="if (typeof(oPGHover) != \'undefined\') {oPGHover.hideHighlight();}" ';
					_sHtml += 'cellpadding="0" cellspacing="0">';
					_sHtml += '<tr>';
						_sHtml += '<td id="'+_sInputFieldID+'Dataset'+i+'Panel" style="display:none; border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
						// _sHtml += '<span onclick="oPGInputField.showDatasetQuestion(\''+_sInputFieldID+'\', \'delete?\', \'oPGInputField.inputFieldOnDeleteDatasetWithIndex(\\\''+_sInputFieldID+'\\\', '+i+');\', \'\');">[del]</span>';
						_bEditable = true;
						if (_axDatasets[i][PG_INPUTFIELD_DATASET_INDEX_ID] < 0)
						{
							_bEditable = false;
						}
						if (_bEditable == true)
						{
							_iButtonMode = 0;
							_sButtonDisplayValue = this.getText({'sType': 'DeleteDatasetButton'});
							_sButtonOnClick = '';
							_sButtonOnClick += "oPGInputField.showDatasetQuestion({";
							_sButtonOnClick += "'sInputFieldID': '"+_sInputFieldID+"', '";
							_sButtonOnClick += "'sQuestion': "+this.getText({'sType': 'DeleteQuestion'})+"', ";
							_sButtonOnClick += "'sExecuteOnYes': 'oPGInputField.inputFieldOnDeleteDatasetWithIndex({\'sInputFieldID\': \'"+_sInputFieldID+"\', \'iIndex\': "+i+"});', ";
							_sButtonOnClick += "'sExecuteOnNo': '');";
							_sHtml += oPGButton.build(
								{
									'sButtonID': _sInputFieldID+'Dataset'+i+'DeleteButton', 
									'sText': _sButtonDisplayValue, 
									'iButtonMode': _iButtonMode, 
									'sOnClick': _sButtonOnClick, 
								}
							);
						}
						_sHtml += '</td>';
						for (t=PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE; t<_axDatasets[i].length; t++)
						{
							if (_axFieldStructures.length > t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE) {_iSizeX = _axFieldStructures[t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX]+1;}
							else {_iSizeX = 151;}
							_sHtml += '<td onclick="';
							_sHtml += 'oPGInputField.inputFieldOnSelectDataset({\'sInputFieldID\': \''+_sInputFieldID+'\', \'iDatasetIndex\': '+i+'}); ';
							if ((_sOnDatasetSelect !== '') && (_sOnDatasetSelect !== null)) {_sHtml += str_replace('"', '\"', _sOnDatasetSelect);}
							_sHtml += '" ';
							_sHtml += 'style="border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
							_sHtml += '<div style="width:'+_iSizeX+'px; overflow:hidden; cursor:default; background-color:transparent;">';
							_sHtml += _axDatasets[i][t];
							_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+i+'Field'+(t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE)+'" value="'+_axDatasets[i][t]+'" />';
							_sHtml += '</div>';
							_sHtml += '</td>';
						}
					_sHtml += '</tr>';
					_sHtml += '</table>';
					_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+i+'ID" value="'+_axDatasets[i][PG_INPUTFIELD_DATASET_INDEX_ID]+'" />';
					_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+i+'FieldCount" value="'+(_axDatasets[i].length-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE)+'" />';
				}
				_sHtml += '</div>';
				_sHtml += '<div style="text-align:center; overflow:hidden; width:'+(_iFullSizeX+22)+'px;">';
				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_CREATE, 'iCurrentMode': _iInputFieldMode}))
				{
					_iButtonMode = 0;
					_sButtonDisplayValue = this.getText({'sType': 'CreateDatasetButton'});
					_sButtonOnClick = '';
					_sButtonOnClick += 'oPGInputField.inputFieldOnCreateDataset({\'sInputFieldID\': \''+_sInputFieldID+'\'}); ';
					if ((_sOnDatasetCreate !== '') && (_sOnDatasetCreate !== null)) {_sButtonOnClick += _sOnDatasetCreate+' ';}
					_sButtonOnClick += "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'"+_sInputFieldID+"\'})', 100);";
					_sHtml += oPGButton.build(
						{
							'sButtonID': _sInputFieldID+'DatasetCreateButton', 
							'sText': _sButtonDisplayValue, 
							'iButtonMode': _iButtonMode, 
							'sOnClick': _sButtonOnClick, 
							'sSizeX': '100%'
						}
					);
				}

				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_UPDATE, 'iCurrentMode': _iInputFieldMode}))
				{
					_iButtonMode = 0;
					_sButtonDisplayValue = this.getText({'sType': 'UpdateDatasetButton'});
					_sButtonOnClick = '';
					_sButtonOnClick += 'oPGInputField.inputFieldOnUpdateDataset({\'sInputFieldID\': \''+_sInputFieldID+'\'}); ';
					if ((_sOnDatasetUpdate !== '') && (_sOnDatasetUpdate !== null)) {_sButtonOnClick += _sOnDatasetUpdate+' ';}
					_sButtonOnClick += "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'"+_sInputFieldID+"\'})', 100);";
					_sHtml += oPGButton.build(
						{
							'sButtonID': _sInputFieldID+'DatasetUpdateButton', 
							'sText': _sButtonDisplayValue, 
							'iButtonMode': _iButtonMode, 
							'sOnClick': _sButtonOnClick, 
							'sSizeX': '100%'
						}
					);
				}

				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_DELETE, 'iCurrentMode': _iInputFieldMode}))
				{
					_iButtonMode = 0;
					_sButtonDisplayValue = this.getText({'sType': 'SwitchEditModeButton'});
					_sButtonOnClick = '';
					_sButtonOnClick += 'oPGInputField.inputFieldOnSwitchDatasetEditMode({\'sInputFieldID\': \''+_sInputFieldID+'\'}); ';
					if ((_sOnSwitchEditMode !== '') && (_sOnSwitchEditMode !== null)) {_sButtonOnClick += _sOnSwitchEditMode+' ';}
					_sButtonOnClick += "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'"+_sInputFieldID+"\'})', 100);";
					_sHtml += oPGButton.build(
						{
							'sButtonID': _sInputFieldID+'SwitchEditModeButton', 
							'sText': _sButtonDisplayValue, 
							'iButtonMode': _iButtonMode, 
							'sOnClick': _sButtonOnClick, 
							'sSizeX': '100%'
						}
					);
				}
				_sHtml += '</div>';
			_sHtml += '<div id="'+_sInputFieldID+'DropdownOverlay" style="display:none; position:absolute; top:0px; left:0px; width:'+(_iFullSizeX+22)+'px; height:150px; background-color:#000000;">&nbsp;</div>';
			_sHtml += '</div>';
		}
		
		_sHiddenType = 'hidden';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH}))
		{
			_sHiddenType = 'text';
			_sHtml += '<table style="border-width:0px;">';
			_sHtml += _sInputFieldID+'<br />';
		}
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '<tr><td>OldFieldValue:</td><td>';}				_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'OldFieldValue" name="'+_sInputFieldID+'OldFieldValue" value="" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>OldFieldID:</td><td>';}		_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'OldFieldID" name="'+_sInputFieldID+'OldFieldID" value="" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>SelectedIndex:</td><td>';}	_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'SelectedIndex" name="'+_sInputFieldID+'SelectedIndex" value="" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>DataID:</td><td>';}			_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'DataID" name="'+_sInputFieldID+'DataID" value="'+_xFieldDatasetID+'" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>Mode:</td><td>';}			_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'Mode" name="'+_sInputFieldID+'Mode" value="'+_iInputFieldMode+'" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>FieldCount:</td><td>';}		_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'FieldCount" name="'+_sInputFieldID+'FieldCount" value="'+(_axFieldStructures.length)+'" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>DatasetCount:</td><td>';}	_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'DatasetCount" name="'+_sInputFieldID+'DatasetCount" value="'+(_axDatasets.length)+'" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH})) {_sHtml += '</td></tr><tr><td>SendParams:</td><td>';}		_sHtml += '<input type="'+_sHiddenType+'" id="'+_sInputFieldID+'SendParams" name="'+_sInputFieldID+'SendParams" value="'+_sSendParameters+'" />';
		if (this.isDebugMode({'iMode': PG_DEBUG_HIGH}))
		{
			_sHtml += '</td></tr>';
			_sHtml += '</table>';
		}

		_sHtml += '</div>';
		
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param sToDisplay [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeDropdownButton = function(_sInputFieldID, _sToDisplay)
	{
		if (typeof(_sToDisplay) == 'undefined') {var _sToDisplay = null;}

		_sToDisplay = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sToDisplay', 'xParameter': _sToDisplay});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDropdownButtonNormal = this.oDocument.getElementById(_sInputFieldID+'DropdownButtonNormal');
		if (_oDropdownButtonNormal) {_oDropdownButtonNormal.style.display = 'none';}
		
		var _oDropdownButtonHover = this.oDocument.getElementById(_sInputFieldID+'DropdownButtonHover');
		if (_oDropdownButtonHover) {_oDropdownButtonHover.style.display = 'none';}
		
		var _oDropdownButtonHideNormal = this.oDocument.getElementById(_sInputFieldID+'DropdownButtonHideNormal');
		if (_oDropdownButtonHideNormal) {_oDropdownButtonHideNormal.style.display = 'none';}
		
		var _oDropdownButtonHideHover = this.oDocument.getElementById(_sInputFieldID+'DropdownButtonHideHover');
		if (_oDropdownButtonHideHover) {_oDropdownButtonHideHover.style.display = 'none';}
		
		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		if (_oDropdownDiv)
		{
			if (_oDropdownDiv.style.display == 'none')
			{
				var _oDropdownButtonToDisplay = this.oDocument.getElementById(_sInputFieldID+'DropdownButton'+_sToDisplay);
				if (_oDropdownButtonToDisplay) {_oDropdownButtonToDisplay.style.display = 'block';}
			}
			else
			{
				var _oDropdownButtonToDisplay = this.oDocument.getElementById(_sInputFieldID+'DropdownButtonHide'+_sToDisplay);
				if (_oDropdownButtonToDisplay) {_oDropdownButtonToDisplay.style.display = 'block';}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.onInputFieldDropdownButton = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		
		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		if (_oDropdownDiv)
		{
			if (_oDropdownDiv.style.display == 'none')
			{
				// oPGButton.setContent({'sButtonID': _sInputFieldID+'DropdownButton', 'sContent': '&lt;'});
				this.showDropdown({'sInputFieldID': _sInputFieldID});
			}
			else
			{
				// oPGButton.setContent({'sButtonID': _sInputFieldID+'DropdownButton', 'sContent': '&gt;'});
				this.hideDropdown({'sInputFieldID': _sInputFieldID});
			}
		}
	}
	/* @end method */

	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.showDropdown = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		var _oInputField = this.oDocument.getElementById(_sInputFieldID+'Field0');
		if ((_oDropdownDiv) && (_oInputField))
		{
			_oDropdownDiv.style.top = parseInt(_oInputField.offsetHeight)+'px';
			_oDropdownDiv.style.display = 'block';
			oPGButton.setContent({'sButtonID': _sInputFieldID+'DropdownButton', 'sContent': '&lt;'});
			// this.changeDropdownButton({'sInputFieldID': _sInputFieldID, 'sToShow': 'Normal'});
			this.sLastOpenedDropdownID = _sInputFieldID;
			var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
			if (_oFieldMode)
			{
				var _iFieldMode = parseInt(_oFieldMode.value);
				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_STREAMINGDROPDOWN, 'iCurrentMode': _iFieldMode})) {this.startDropdownStreaming({'sInputFieldID': _sInputFieldID});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.hideDropdown = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		if (_oDropdownDiv)
		{
			_oDropdownDiv.style.display = 'none';
			oPGButton.setContent({'sButtonID': _sInputFieldID+'DropdownButton', 'sContent': '&gt;'});
			// this.changeDropdownButton({'sInputFieldID': _sInputFieldID, 'sToShow': 'Normal'});
			if (this.sLastOpenedDropdownID == _sInputFieldID) {this.sLastOpenedDropdownID = '';}
			
			var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
			if (_oFieldMode)
			{
				var _iFieldMode = parseInt(_oFieldMode.value);
				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_RESETONDROPDOWNCLOSE, 'iCurrentMode': _iFieldMode})) {this.reset({'sInputFieldID': _sInputFieldID});}
				if (this.isMode({'iMode': PG_INPUTFIELD_MODE_STREAMINGDROPDOWN, 'iCurrentMode': _iFieldMode})) {this.stopDropdownStreaming({'sInputFieldID': _sInputFieldID});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.switchDropdown = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		if (_oDropdownDiv)
		{
			if (_oDropdownDiv.style.display == 'none') {this.showDropdown({'sInputFieldID': _sInputFieldID});}
			else {this.hideDropdown({'sInputFieldID': _sInputFieldID});}
		}
	}
	/* @end method */

	this.bDropDownStreamingDebug = false;
	this.oDropDownStreamingTimeout = new Object();
	// this.oDropDownStreamingCounts = new Object();
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.startDropdownStreaming = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oFieldMode = oPGInputField.oDocument.getElementById(_sInputFieldID+'Mode');
		if (_oFieldMode)
		{
			_iFieldMode = parseInt(_oFieldMode.value);
			if (oPGInputField.isMode({'iMode': PG_INPUTFIELD_MODE_STREAMINGDROPDOWN, 'iCurrentMode': _iFieldMode}))
			{
				if (this.bDropDownStreamingDebug == true)
				{
					if (typeof(oPGInputField.oDropDownStreamingTimeout[_sInputFieldID]) == 'undefined') {alert('stream startet for '+_sInputFieldID+'...');}
					else if (oPGInputField.oDropDownStreamingTimeout[_sInputFieldID] == null) {alert('stream startet for '+_sInputFieldID+'...');}
				}
				
				var _oDropDownDataDiv = oPGInputField.oDocument.getElementById(_sInputFieldID+'DropdownDataDiv');
				var _oDatasetCount = oPGInputField.oDocument.getElementById(_sInputFieldID+'DatasetCount');
				if ((_oDropDownDataDiv) && (_oDatasetCount))
				{
					var _iDropDownDatasetCount = parseInt(_oDatasetCount.value);
					var _iDropDownScrollSize = parseInt(_oDropDownDataDiv.scrollHeight) - parseInt(_oDropDownDataDiv.offsetHeight);
					if (((_iDropDownScrollSize > 0) && (parseInt(_oDropDownDataDiv.scrollTop) > 0)) || (_iDropDownDatasetCount == 0))
					{
						if (parseInt(_oDropDownDataDiv.scrollTop) >= _iDropDownScrollSize)
						{
							if (this.bDropDownStreamingDebug == true) {alert('streams data for '+_sInputFieldID+'...');}
							// if (typeof(oPGInputField.oDropDownStreamingCounts[_sInputFieldID]) == 'undefined') {oPGInputField.oDropDownStreamingCounts[_sInputFieldID] = 0;}
							// else if (oPGInputField.oDropDownStreamingCounts[_sInputFieldID] == null) {oPGInputField.oDropDownStreamingCounts[_sInputFieldID] = 0;}
							// oPGInputField.send(_sInputFieldID, 'sEvent='+PG_INPUTFIELD_EVENT_ONSTREAM+'&iStreamCount='+oPGInputField.oDropDownStreamingCounts[_sInputFieldID], true);
							oPGInputField.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONSTREAM+'&iStreamCount='+_iDropDownDatasetCount, 'bIgnoreRequired': true});
							oPGInputField.stopDropdownStreaming({'sInputFieldID': _sInputFieldID});
							return true;
						}
					}
				}
				oPGInputField.oDropDownStreamingTimeout[_sInputFieldID] = oPGInputField.oWindow.setTimeout("oPGInputField.startDropdownStreaming({'sInputFieldID': '"+_sInputFieldID+"'})", 1000);
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.stopDropdownStreaming = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		if (typeof(oPGInputField.oDropDownStreamingTimeout[_sInputFieldID]) != 'undefined')
		{
			if (oPGInputField.oDropDownStreamingTimeout[_sInputFieldID] != null)
			{
				oPGInputField.oWindow.clearTimeout(oPGInputField.oDropDownStreamingTimeout[_sInputFieldID]);
				oPGInputField.oDropDownStreamingTimeout[_sInputFieldID] = null;
				if (this.bDropDownStreamingDebug == true) {alert('...stream stopped for '+_sInputFieldID);}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iDatasetIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.inputFieldOnSelectDataset = function(_sInputFieldID, _iDatasetIndex)
	{
		if (typeof(_iDatasetIndex) == 'undefined') {var _iDatasetIndex = null;}

		_iDatasetIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iDatasetIndex', 'xParameter': _iDatasetIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		this.stopReset();
		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
		var _oFieldCount = this.oDocument.getElementById(_sInputFieldID+'FieldCount');
		var _oDatasetID = this.oDocument.getElementById(_sInputFieldID+'Dataset'+_iDatasetIndex+'ID');
		var _oDatasetFieldCount = this.oDocument.getElementById(_sInputFieldID+'Dataset'+_iDatasetIndex+'FieldCount');
		var _oSelectedIndex = this.oDocument.getElementById(_sInputFieldID+'SelectedIndex');
		var _oIsNoData = null;
		if ((_oDataID) && (_oFieldMode) && (_oFieldCount) && (_oDatasetID) && (_oDatasetFieldCount) && (_oSelectedIndex))
		{
			_oSelectedIndex.value = _iDatasetIndex;
			_oDataID.value = _oDatasetID.value;
			var _oField = null;
			var _iFieldMode = parseInt(_oFieldMode.value);
			var _oDatasetField = null;
			var _iFieldCount = parseInt(_oFieldCount.value);
			var _iDatasetFieldCount = parseInt(_oDatasetFieldCount.value);
			if (_iFieldCount > _iDatasetFieldCount) {_iFieldCount = _iDatasetFieldCount;}
			if (!isNaN(_iFieldCount))
			{
				for (var i=0; i<_iFieldCount; i++)
				{
					_oIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+i+'IsNoData');
					_oField = this.oDocument.getElementById(_sInputFieldID+'Field'+i);
					_oDatasetField = this.oDocument.getElementById(_sInputFieldID+'Dataset'+_iDatasetIndex+'Field'+i);
					if ((_oField) && (_oDatasetField) && (_oIsNoData))
					{
						_oField.value = _oDatasetField.value;
						_oIsNoData.value = 0;
						this.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+i, 'sStyle': this.sCssStyleInputFieldDataNotSaved});
					}
				}
			}
			this.hideDropdown({'sInputFieldID': _sInputFieldID});
			if (this.isMode({'iMode': PG_INPUTFIELD_MODE_AUTOSAVE, 'iCurrentMode': _iFieldMode})) {this.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONSELECT_DATASET, 'bIgnoreRequired': false});}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	
	@param bIgnoreRequired [type]bool[/type]
	[en]...[/en]
	*/
	this.send = function(_sInputFieldID, _sParameters, _bIgnoreRequired)
	{
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		if (typeof(_bIgnoreRequired) == 'undefined') {var _bIgnoreRequired = null;}

		_sParameters = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sParameters', 'xParameter': _sParameters});
		_bIgnoreRequired = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'bIgnoreRequired', 'xParameter': _bIgnoreRequired});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		var _oFieldCount = this.oDocument.getElementById(_sInputFieldID+'FieldCount');
		if ((_oDataID) && (_oFieldCount))
		{
			var _oField = null;
			var _oFieldRequired = null;
			var _bRequiredField = true;
			var _sDataID = encodeURIComponent(_oDataID.value);
			var _iFieldCount = parseInt(_oFieldCount.value);
			var _oFieldIsNoData = null;
			
			if (_sParameters != '') {_sParameters += '&';}
			_sParameters += 'sInputFieldID='+_sInputFieldID
			_sParameters += '&sRequestType='+PG_INPUTFIELD_NETWORK_REQUESTTYPE;
			_sParameters += '&sDataID='+_sDataID;
			if (!isNaN(_iFieldCount))
			{
				for (var i=0; i<_iFieldCount; i++)
				{
					_oField = this.oDocument.getElementById(_sInputFieldID+'Field'+i);
					_oFieldRequired = this.oDocument.getElementById(_sInputFieldID+'Field'+i+'Required');
					_oFieldIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+i+'IsNoData');
					if ((_oField) && (_oFieldRequired) && (_oFieldIsNoData))
					{
						if (parseInt(_oFieldIsNoData.value) == 1)
						{
							_sParameters += '&asFieldName['+i+']='+encodeURIComponent(_oField.name);
							_sParameters += '&asFieldValue['+i+']=';
						}
						else
						{
							_sParameters += '&asFieldName['+i+']='+encodeURIComponent(_oField.name);
							_sParameters += '&asFieldValue['+i+']='+encodeURIComponent(_oField.value);
						}
						if ((parseInt(_oFieldRequired.value) == 1) && ((_oField.value == '') || (parseInt(_oFieldIsNoData.value) == 1)))
						{
							_bRequiredField = false;
							if (this.sCssStyleInputFieldDataWrong != '') {this.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+i, 'sStyle': this.sCssStyleInputFieldDataWrong});}
						}
					}
				}
			}
			
			if (this.sSendParameters != '') {_sParameters += '&'+this.sSendParameters;}
			
			var _oSendParams = this.oDocument.getElementById(_sInputFieldID+'SendParams');
			if (_oSendParams) {if (_oSendParams.value != '') {_sParameters += '&'+_oSendParams.value;}}
			
			if ((_bRequiredField == true) || (_bIgnoreRequired == true))
			{
				this.networkSend({'sParameters': _sParameters, 'fOnResponse': oPGInputField.inputFieldOnResponse});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.inputFieldOnResponse = function(_oParameters)
	{
		if (_oParameters['PG_RequestType'] == PG_INPUTFIELD_NETWORK_REQUESTTYPE)
		{
			var _sInputFieldID = _oParameters['PG_InputFieldID'];
			var _sJavaScriptToExecute = _oParameters['PG_InputFieldJavaScriptToExecute'];
			var _sEvent = _oParameters['PG_InputFieldEvent'];
			if ((_sEvent == PG_INPUTFIELD_EVENT_ONSEARCH) || (_sEvent == PG_INPUTFIELD_EVENT_ONSTREAM))
			{
				var _xDatasetDataID = '';
				var _axInputFieldData = new Array();
				var _axDatasetFieldValues = new Array();
				var _iDatasetFieldCount = 0;
				var _iDatasetCount = parseInt(_oParameters['PG_InputFieldDatasetCount']);
				if (!isNaN(_iDatasetCount))
				{
					for (var i=0; i<_iDatasetCount; i++)
					{
						_xDatasetDataID = _oParameters['PG_InputFieldDataset'+i+'DataID'];
						_iDatasetFieldCount = parseInt(_oParameters['PG_InputFieldDataset'+i+'FieldCount']);
						_axDatasetFieldValues = new Array();
						_axDatasetFieldValues.push(_xDatasetDataID);
						for (var t=0; t<_iDatasetFieldCount; t++)
						{
							_axDatasetFieldValues.push(_oParameters['PG_InputFieldDataset'+i+'Field'+t]);
						}
						_axInputFieldData.push(_axDatasetFieldValues);
					}
				}
				
				var _oDropdownDataDiv = oPGInputField.oDocument.getElementById(_sInputFieldID+'DropdownDataDiv');
				if (_oDropdownDataDiv)
				{
					var _oDatasetCount = oPGInputField.oDocument.getElementById(_sInputFieldID+'DatasetCount');
					if (_sEvent == PG_INPUTFIELD_EVENT_ONSTREAM)
					{
						if (_oDatasetCount) {_oDatasetCount.value = parseInt(_oDatasetCount.value)+_iDatasetCount;}
						_oDropdownDataDiv.innerHTML += oPGInputField.buildInputFieldDatasets({'sInputFieldID': _sInputFieldID, 'axDataset': _axInputFieldData});
					}
					else
					{
						if (_oDatasetCount) {_oDatasetCount.value = _iDatasetCount;}
						_oDropdownDataDiv.innerHTML = oPGInputField.buildInputFieldDatasets({'sInputFieldID': _sInputFieldID, 'axDataset': _axInputFieldData});
						oPGInputField.showDropdown({'sInputFieldID': _sInputFieldID});
					}
				}
			}
			else if ((_sEvent == PG_INPUTFIELD_EVENT_ONBLUR) || (_sEvent == PG_INPUTFIELD_EVENT_ONSELECT_DATASET))
			{
				if (oPGInputField.sCssStyleInputFieldDataSaved != '')
				{
					var _iActionStatus = parseInt(_oParameters['PG_InputFieldActionStatus']);
					var _oFieldCount = oPGInputField.oDocument.getElementById(_sInputFieldID+'FieldCount');
					if (_oFieldCount)
					{
						var _iFieldCount = parseInt(_oFieldCount.value);
						if (!isNaN(_iFieldCount))
						{
							for (var i=0; i<_iFieldCount; i++)
							{
								if (_iActionStatus == PG_INPUTFIELD_ACTIONSTATUS_SUCCESS)
								{
									oPGInputField.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+i, 'sStyle': oPGInputField.sCssStyleInputFieldDataSaved});
								}
								else if (_iActionStatus == PG_INPUTFIELD_ACTIONSTATUS_FAILED)
								{
									oPGInputField.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+i, 'sStyle': oPGInputField.sCssStyleInputFieldDataNotSaved});
								}
							}
						}
					}
				}
			}
			else if ((_sEvent == PG_INPUTFIELD_EVENT_ONCREATE_DATASET) || (_sEvent == PG_INPUTFIELD_EVENT_ONUPDATE_DATASET))
			{
				var _iFieldMode = parseInt(oPGInputField.oDocument.getElementById(_sInputFieldID+'Mode').value);
				if (_sEvent == PG_INPUTFIELD_EVENT_ONUPDATE_DATASET)
				{
					var _sDataID = _oParameters['PG_InputFieldDataID'];
					var _oDataID = oPGInputField.oDocument.getElementById(_sInputFieldID+'DataID');
					if (_oDataID) {_oDataID.value = _sDataID;}
				}
				if ((_sEvent == PG_INPUTFIELD_EVENT_ONCREATE_DATASET) && (oPGInputField.isMode({'iMode': PG_INPUTFIELD_MODE_AUTOSAVEONCREATE, 'iCurrentMode': _iFieldMode})))
				{
					var _axDataFields = new Array();
					var _xDataID = _oParameters['PG_InputFieldDataset0DataID'];
					var _iDatasetFieldCount = parseInt(_oParameters['PG_InputFieldDataset0FieldCount']);
					for (var t=0; t<_iDatasetFieldCount; t++)
					{
						_axDataFields.push(_oParameters['PG_InputFieldDataset0Field'+t]);
					}
					
					oPGInputField.setData({'sInputFieldID': _sInputFieldID, 'xDataID': _xDataID, 'axDataFields': _axDataFields});
					oPGInputField.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONBLUR, 'bIgnoreRequired': false});
					oPGInputField.hideDropdown({'sInputFieldID': _sInputFieldID});
				}
				else {oPGInputField.inputFieldOnSearch({'sInputFieldID': _sInputFieldID});}
			}
			else if (_sEvent == PG_INPUTFIELD_EVENT_ONDELETE_DATASET)
			{
				var _iDatasetIndex = parseInt(_oParameters['PG_InputFieldDatasetIndex']);
				var _oDatasetTable = oPGInputField.oDocument.getElementById(_sInputFieldID+'Dataset'+_iDatasetIndex);
				if (_oDatasetTable)
				{
					// var _oDatasetCount = oPGInputField.oDocument.getElementById(_sInputFieldID+'DatasetCount');
					// if (_oDatasetCount)
					// {
						// var _iDatasetCount = parseInt(_oDatasetCount.value);
						// _oDatasetCount.value = _iDatasetCount-1;
					// }
					_oDatasetTable.outerHTML = '';
				}
			}
			if (_sJavaScriptToExecute != '') {eval(_sJavaScriptToExecute);}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.changeStyle = function(_sInputFieldID, _sStyle)
	{
		if (typeof(_sStyle) == 'undefined') {var _sStyle = null;}

		_sStyle = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sStyle', 'xParameter': _sStyle});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _iWidth = 0;
		var _oField = this.oDocument.getElementById(_sInputFieldID);
		var _sDefaultStyle = 'padding-left:0px; padding-right:0px; margin-left:0px; margin-right:0px;';
		if (_oField)
		{
			_iWidth = parseInt(_oField.style.width);
			if (typeof(oPGCss) != 'undefined')
			{
				oPGCss.setStyle({'xElement': _oField, 'xStyle': _sDefaultStyle+' width:'+_iWidth+'px; '+_sStyle});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return axFieldStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xNoValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sAccessKey [needed][type]string[/type]
	[en]...[/en]
	
	@param bRequired [needed][type]bool[/type]
	[en]...[/en]
	
	@param iMaxLength [needed][type]int[/type]
	[en]...[/en]
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnBlur [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnFocus [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnKeyDown [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnKeyUp [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnClick [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnMouseDown [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnMouseUp [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOver [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOut [needed][type]string[/type]
	[en]...[/en]
	*/
	this.buildFieldStructure = function(
		_iSizeX,
		_sName,
		_xValue,
		_xNoValue,

		_sAccessKey,
		_bRequired,
		_iMaxLength,
		_sType,

		_sOnBlur,
		_sOnFocus,
		_sOnKeyDown,
		_sOnKeyUp,

		_sOnClick,
		_sOnMouseDown,
		_sOnMouseUp,
		_sOnMouseOver,
		_sOnMouseOut
	)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		if (typeof(_xNoValue) == 'undefined') {var _xNoValue = null;}

		if (typeof(_sAccessKey) == 'undefined') {var _sAccessKey = null;}
		if (typeof(_bRequired) == 'undefined') {var _bRequired = null;}
		if (typeof(_iMaxLength) == 'undefined') {var _iMaxLength = null;}
		if (typeof(_sType) == 'undefined') {var _sType = null;}

		if (typeof(_sOnBlur) == 'undefined') {var _sOnBlur = null;}
		if (typeof(_sOnFocus) == 'undefined') {var _sOnFocus = null;}
		if (typeof(_sOnKeyDown) == 'undefined') {var _sOnKeyDown = null;}
		if (typeof(_sOnKeyUp) == 'undefined') {var _sOnKeyUp = null;}

		if (typeof(_sOnClick) == 'undefined') {var _sOnClick = null;}
		if (typeof(_sOnMouseDown) == 'undefined') {var _sOnMouseDown = null;}
		if (typeof(_sOnMouseUp) == 'undefined') {var _sOnMouseUp = null;}
		if (typeof(_sOnMouseOver) == 'undefined') {var _sOnMouseOver = null;}
		if (typeof(_sOnMouseOut) == 'undefined') {var _sOnMouseOut = null;}

		_sName = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sName', 'xParameter': _sName});
		_xValue = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'xValue', 'xParameter': _xValue});
		_xNoValue = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'xNoValue', 'xParameter': _xNoValue});

		_sAccessKey = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sAccessKey', 'xParameter': _sAccessKey});
		_bRequired = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'bRequired', 'xParameter': _bRequired});
		_iMaxLength = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iMaxLength', 'xParameter': _iMaxLength});
		_sType = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sType', 'xParameter': _sType});

		_sOnBlur = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnBlur', 'xParameter': _sOnBlur});
		_sOnFocus = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnFocus', 'xParameter': _sOnFocus});
		_sOnKeyDown = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnKeyDown', 'xParameter': _sOnKeyDown});
		_sOnKeyUp = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnKeyUp', 'xParameter': _sOnKeyUp});

		_sOnClick = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnClick', 'xParameter': _sOnClick});
		_sOnMouseDown = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnMouseDown', 'xParameter': _sOnMouseDown});
		_sOnMouseUp = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnMouseUp', 'xParameter': _sOnMouseUp});
		_sOnMouseOver = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnMouseOver', 'xParameter': _sOnMouseOver});
		_sOnMouseOut = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'sOnMouseOut', 'xParameter': _sOnMouseOut});

		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});

		if (_xValue == null) {_xValue = '';}
		if (_xNoValue == null) {_xNoValue = '';}
		if (_bRequired == null) {_bRequired = false;}
		if (_sType == null) {_sType = PG_INPUTFIELD_TYPE_TEXT;}
		
		var _axFieldStructure = new Array();
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] = _iSizeX;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_NAME] = _sName;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] = _xValue;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] = _xNoValue;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ACCESSKEY] = _sAccessKey;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED] = _bRequired;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH] = _iMaxLength;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_TYPE] = _sType;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] = _sOnBlur;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] = _sOnFocus;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] = _sOnKeyDown;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] = _sOnKeyUp;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] = _sOnClick;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] = _sOnMouseDown;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] = _sOnMouseUp;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] = _sOnMouseOver;
		_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] = _sOnMouseOut;
		
		return new _axFieldStructure;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axDataset [type]mixed[][/type]
	[en]...[/en]
	
	@param xDataID [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axFieldsValues [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.buildDataset = function(_xDataID, _axFieldsValues)
	{
		if (typeof(_axFieldsValues) == 'undefined') {var _axFieldsValues = null;}
		_axFieldsValues = this.getRealParameter({'oParameters': _xDataID, 'sName': 'axFieldsValues', 'xParameter': _axFieldsValues});
		_xDataID = this.getRealParameter({'oParameters': _xDataID, 'sName': 'xDataID', 'xParameter': _xDataID});
		return new Array(_xDataID).concat(_axDatasetFieldsValues);
	}
	/* @end method */

	/*
	@start method
	
	@return sDatasetHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param axDataset [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param iDatasetIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.buildInputFieldDataset = function(_sInputFieldID, _axDataset, _iDatasetIndex)
	{
		if (typeof(_axDataset) == 'undefined') {var _axDataset = null;}
		if (typeof(_iDatasetIndex) == 'undefined') {var _iDatasetIndex = null;}

		_axDataset = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axDataset', 'xParameter': _axDataset});
		_iDatasetIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iDatasetIndex', 'xParameter': _iDatasetIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _iWidth = 0;
		
		var _axInputField = new Array();
		var _oFieldWidth = null;
		var _iFieldWidth = 0;
		var _oFieldCount = this.oDocument.getElementById(_sInputFieldID+'FieldCount');
		if (_oFieldCount)
		{
			for (var g=0; g<parseInt(_oFieldCount.value); g++)
			{
				_oFieldWidth = this.oDocument.getElementById(_sInputFieldID+'Field'+g);
				if (_oFieldWidth) {_iFieldWidth = parseInt(_oFieldWidth.style.width);}
				_axInputField.push(_iFieldWidth);
			}
		}
		
		var _sHtml = '';
		var _sHighlightArray = 'new Array(\''+_sInputFieldID+'Dataset'+_iDatasetIndex+'\')';
		_sHtml += '<table id="'+_sInputFieldID+'Dataset'+_iDatasetIndex+'" style="border-collapse:collapse; cursor:default;" ';
		_sHtml += 'onmouseover="if (typeof(oPGHover) != \'undefined\') {oPGHover.showHighlight('+_sHighlightArray+', \'border-collapse:collapse; cursor:default; '+this.sCssStyleInputFieldDatasetHover+'\');}" ';
		_sHtml += 'onmouseout="if (typeof(oPGHover) != \'undefined\') {oPGHover.hideHighlight();}" ';
		_sHtml += 'cellpadding="0" cellspacing="0">';
		_sHtml += '<tr>';
			_sHtml += '<td id="'+_sInputFieldID+'Dataset'+_iDatasetIndex+'Panel" style="display:none; border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
			var _bEditable = true;
			if (!isNaN(parseInt(_axDataset[PG_INPUTFIELD_DATASET_INDEX_ID])))
			{
				if (parseInt(_axDataset[PG_INPUTFIELD_DATASET_INDEX_ID]) < 0)
				{
					_bEditable = false;
				}
			}
			if (_bEditable == true)
			{
				var _iButtonMode = 0;
				// _sHtml += '<span onclick="oPGInputField.showDatasetQuestion(\''+_sInputFieldID+'\', \'delete?\', \'oPGInputField.inputFieldOnDeleteDatasetWithIndex(\\\''+_sInputFieldID+'\\\', '+_iDatasetIndex+');\', \'\');">[del]</span>';
				_sHtml += oPGButton.build(
					{
						'sButtonID': _sInputFieldID+'Dataset'+_iDatasetIndex+'DeleteButton', 
						'sText': this.getText({'sType': 'DeleteDatasetButton'}), 
						'iButtonMode': _iButtonMode, 
						'sOnClick': "oPGInputField.showDatasetQuestion({'sInputFieldID': '"+_sInputFieldID+"', 'sQuestion': '"+this.getText({'sType': 'DeleteQuestion'})+"', 'sExecuteOnYes': 'oPGInputField.inputFieldOnDeleteDatasetWithIndex({\\\'sInputFieldID\\\': \\\'"+_sInputFieldID+"\\\', \\\'iDatasetIndex\\\': "+_iDatasetIndex+"});', 'sExecuteOnNo': ''});"
					}
				);
			}
			_sHtml += '</td>';
			for (var t=PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD; t<_axDataset.length; t++)
			{
				if (_axInputField.length > t-PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD) {_iWidth = _axInputField[t-PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD]+1;}
				else {_iWidth = 151;}
				_sHtml += '<td onclick="';
				_sHtml += 'oPGInputField.inputFieldOnSelectDataset({\'sInputFieldID\': \''+_sInputFieldID+'\', \'iDatasetIndex\': '+_iDatasetIndex+'}); ';
				// if (_sOnDatasetSelect != '') {_sHtml += _sOnDatasetSelect.replace(/"/, '\"');} // TODO
				_sHtml += '" ';
				_sHtml += 'style="border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
				_sHtml += '<div style="width:'+_iWidth+'px; overflow:hidden; cursor:default; background-color:transparent;">';
				_sHtml += _axDataset[t];
				_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+_iDatasetIndex+'Field'+(t-PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD)+'" value="'+_axDataset[t]+'" />';
				_sHtml += '</div>';
				_sHtml += '</td>';
			}
		_sHtml += '</tr>';
		_sHtml += '</table>';
		_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+_iDatasetIndex+'ID" value="'+_axDataset[PG_INPUTFIELD_DATASET_INDEX_ID]+'" />';
		_sHtml += '<input type="hidden" id="'+_sInputFieldID+'Dataset'+_iDatasetIndex+'FieldCount" value="'+(_axDataset.length-PG_INPUTFIELD_DATASET_INDEX_FIRST_FIELD)+'" />';
		return _sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@return sDatasetsHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param axDataset [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.buildInputFieldDatasets = function(_sInputFieldID, _axDataset)
	{
		if (typeof(_axDataset) == 'undefined') {var _axDataset = null;}

		_axDataset = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'axDataset', 'xParameter': _axDataset});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _sHtml = '';
		for (var i=0; i<_axDataset.length; i++)
		{
			_sHtml += this.buildInputFieldDataset({'sInputFieldID': _sInputFieldID, 'axDataset': _axDataset[i], 'iDatasetIndex': i});
		}
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnMouseOver = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		this.sMouseOverDropdownID = _sInputFieldID;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnMouseOut = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});
		if (this.sMouseOverDropdownID == _sInputFieldID) {this.sMouseOverDropdownID = '';}
	}
	/* @end method */
	
	/*
	@start method
	
	@param oEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onMouseUp = function(_oEvent)
	{
		var _oFieldMode = null;
		var _iFieldMode = 0;
		
		if (this.sLastOpenedDropdownID != '')
		{
			if ((this.sMouseOverDropdownID != this.sLastOpenedDropdownID)
			&& (this.sMouseOverControlID != this.sLastOpenedDropdownID+'DatasetCreateButton')
			&& (this.sMouseOverControlID != this.sLastOpenedDropdownID+'DatasetUpdateButton')
			&& (this.sMouseOverControlID != this.sLastOpenedDropdownID+'SwitchEditModeButton'))
			{
				_oFieldMode = this.oDocument.getElementById(this.sLastOpenedDropdownID+'Mode');
				if (_oFieldMode)
				{
					_iFieldMode = parseInt(_oFieldMode.value);
					if (this.isMode({'iMode': PG_INPUTFIELD_MODE_AUTOCLOSE, 'iCurrentMode': _iFieldMode}))
					{
						this.hideDropdown({'sInputFielID': this.sLastOpenedDropdownID});
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnKeyDown = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		if ((this.oKeyUpTimeout == null) && (this.sCssStyleInputFieldDataNotSaved != ''))
		{
			var _oFieldCount = this.oDocument.getElementById(_sInputFieldID+'FieldCount');
			if (_oFieldCount)
			{
				for (var i=0; i<parseInt(_oFieldCount.value); i++)
				{
					this.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+i, 'sStyle': this.sCssStyleInputFieldDataNotSaved});
				}
			}
		}
		if (this.oKeyUpTimeout != null) {this.oWindow.clearInterval(this.oKeyUpTimeout); this.oKeyUpTimeout = null;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnKeyUp = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		if (this.oKeyUpTimeout == null)
		{
			this.oKeyUpTimeout = this.oWindow.setInterval("oPGInputField.inputFieldOnSearch({'sInputFielID': '"+_sInputFieldID+"'})", this.iKeyResponseWaitToSearch);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iFieldIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.inputFieldOnFocus = function(_sInputFieldID, _iFieldIndex)
	{
		if (typeof(_iFieldIndex) == 'undefined') {var _iFieldIndex = null;}

		_iFieldIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldIndex', 'xParameter': _iFieldIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
		var _oFieldNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex+'NoData');
		var _oFieldIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex+'IsNoData');
		var _oField = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex);
		if ((_oFieldMode) && (_oFieldNoData) && (_oFieldIsNoData) && (_oField))
		{
			var _iFieldMode = parseInt(_oFieldMode.value);
			if ((parseInt(_oFieldIsNoData.value) == 1) && (!this.isMode({'iMode': PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode': _iFieldMode})))
			{
				_oField.value = '';
				_oFieldIsNoData.value = 0;
				// _oField.value = _oFieldNoData.value;
				// this.changeStyle(_sInputFieldID+'Field'+_iFieldIndex, this.sCssStyleInputFieldNoData);
				this.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+_iFieldIndex, 'sStyle': this.sCssStyleInputField});
			}

			if (this.isMode({'iMode': PG_INPUTFIELD_MODE_RESETONBLUR, 'iCurrentMode': _iFieldMode}))
			{
				var _oOldFieldValue = this.oDocument.getElementById(_sInputFieldID+'OldFieldValue');
				var _oOldFieldID = this.oDocument.getElementById(_sInputFieldID+'OldFieldID');
				if ((_oOldFieldID) && (_oOldFieldValue))
				{
					if (_oOldFieldID.value != _sInputFieldID+'Field'+_iFieldIndex)
					{
						if (_oField)
						{
							_oOldFieldValue.value = _oField.value;
							_oOldFieldID.value = _sInputFieldID+'Field'+_iFieldIndex;
						}
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.reset = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oOldFieldValue = this.oDocument.getElementById(_sInputFieldID+'OldFieldValue');
		var _oOldFieldID = this.oDocument.getElementById(_sInputFieldID+'OldFieldID');
		if ((_oOldFieldID) && (_oOldFieldValue))
		{
			var _sOldFieldID = _oOldFieldID.value;
			if (_sOldFieldID != '')
			{
				var _oField = this.oDocument.getElementById(_sOldFieldID);
				if (_oField)
				{
					_oField.value = _oOldFieldValue.value;
					_oOldFieldID.value = '';
					_oOldFieldValue.value = '';
				}
			}
		}
		this.stopReset();
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iFieldIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.inputFieldOnBlur = function(_sInputFieldID, _iFieldIndex)
	{
		if (typeof(_iFieldIndex) == 'undefined') {var _iFieldIndex = null;}

		_iFieldIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldIndex', 'xParameter': _iFieldIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
		var _oFieldNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex+'NoData');
		var _oFieldIsNoData = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex+'IsNoData');
		var _oField = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex);
		if ((_oFieldMode) && (_oFieldNoData) && (_oFieldIsNoData) && (_oField))
		{
			var _iFieldMode = parseInt(_oFieldMode.value);
			if ((_oFieldNoData.value != '') && (_oField.value == '') && (!this.isMode({'iMode': PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode': _iFieldMode})))
			{
				_oField.value = _oFieldNoData.value;
				_oFieldIsNoData.value = '1';
				this.changeStyle({'sInputFieldID': _sInputFieldID+'Field'+_iFieldIndex, 'sStyle': this.sCssStyleInputFieldNoData});
			}
			
			if (this.isMode({'iMode': PG_INPUTFIELD_MODE_RESETONBLUR, 'iCurrentMode': _iFieldMode})) {this.oResetOnBlurTimeout = this.oWindow.setInterval('oPGInputField.reset({\'sInputFieldID\': \''+_sInputFieldID+'\'})', 200);}
			else if ((this.isMode({'iMode': PG_INPUTFIELD_MODE_AUTOSAVE, 'iCurrentMode': _iFieldMode}))
			&& (!this.isMode({'iMode': PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode': _iFieldMode})))
			{
				this.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONBLUR, 'bIgnoreRequired': false});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnSearch = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oFieldMode = this.oDocument.getElementById(_sInputFieldID+'Mode');
		if (_oFieldMode)
		{
			var _iFieldMode = parseInt(_oFieldMode.value);
			if ((this.isMode({'iMode': PG_INPUTFIELD_MODE_SEARCH, 'iCurrentMode': _iFieldMode}))
			&& (!this.isMode({'iMode': PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode': _iFieldMode})))
			{
				this.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONSEARCH, 'bIgnoreRequired': true});
			}
		}
		if (this.oKeyUpTimeout != null) {this.oWindow.clearInterval(this.oKeyUpTimeout); this.oKeyUpTimeout = null;}
	}
	/* @end method */
	
	/* @start method */
	this.stopReset = function()
	{
		if (this.oResetOnBlurTimeout != null) {this.oWindow.clearInterval(this.oResetOnBlurTimeout); this.oResetOnBlurTimeout = null;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnCreateDataset = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		this.stopReset();
		this.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONCREATE_DATASET, 'bIgnoreRequired': false});
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnUpdateDataset = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		this.stopReset();
		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		var _oSelectedIndex = this.oDocument.getElementById(_sInputFieldID+'SelectedIndex');
		if ((_oDataID) && (_oSelectedIndex))
		{
			if (_oDataID.value != '')
			{
				var _sParameters = '';
				_sParameters += 'sEvent='+PG_INPUTFIELD_EVENT_ONUPDATE_DATASET;
				_sParameters += '&iDatasetIndex='+_oSelectedIndex.value
				this.send({'sInputFieldID': _sInputFieldID, 'sParameters': _sParameters, 'bIgnoreRequired': false});
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnDeleteDataset = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'DataID');
		if (_oDataID) {if (_oDataID.value != '') {this.send({'sInputFieldID': _sInputFieldID, 'sParameters': 'sEvent='+PG_INPUTFIELD_EVENT_ONDELETE_DATASET, 'bIgnoreRequired': false});}}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.inputFieldOnDeleteDatasetWithIndex = function(_sInputFieldID, _iIndex)
	{
		if (typeof(_iIndex) == 'undefined') {var _iIndex = null;}

		_iIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iIndex', 'xParameter': _iIndex});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _sParameters = '';
		_sParameters += 'sEvent='+PG_INPUTFIELD_EVENT_ONDELETE_DATASET;
		_sParameters += '&sInputFieldID='+_sInputFieldID;
		_sParameters += '&iDatasetIndex='+_iIndex;
		var _oDataID = this.oDocument.getElementById(_sInputFieldID+'Dataset'+_iIndex+'ID');
		if (_oDataID) {_sParameters += '&sDataID='+encodeURIComponent(_oDataID.value);}
		
		var _oSendParams = this.oDocument.getElementById(_sInputFieldID+'SendParams');
		if (_oSendParams) {if (_oSendParams.value != '') {_sParameters += '&'+_oSendParams.value;}}

		this.networkSend({'sParameters': _sParameters, 'fOnResponse': oPGInputField.inputFieldOnResponse});
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.hideDatasetQuestion = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDatasetQuestion = this.oDocument.getElementById(_sInputFieldID+'DatasetQuestion');
		if (_oDatasetQuestion) {_oDatasetQuestion.outerHTML = '';}
		
		var _oDropdownOverlay = this.oDocument.getElementById(_sInputFieldID+'DropdownOverlay');
		if (_oDropdownOverlay) {_oDropdownOverlay.style.display = 'none';}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param sQuestion [needed][type]string[/type]
	[en]...[/en]
	
	@param sExecuteOnYes [needed][type]string[/type]
	[en]...[/en]
	
	@param sExecuteOnNo [needed][type]string[/type]
	[en]...[/en]
	*/
	this.showDatasetQuestion = function(_sInputFieldID, _sQuestion, _sExecuteOnYes, _sExecuteOnNo)
	{
		if (typeof(_sQuestion) == 'undefined') {var _sQuestion = null;}
		if (typeof(_sExecuteOnYes) == 'undefined') {var _sExecuteOnYes = null;}
		if (typeof(_sExecuteOnNo) == 'undefined') {var _sExecuteOnNo = null;}

		_sQuestion = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sQuestion', 'xParameter': _sQuestion});
		_sExecuteOnYes = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sExecuteOnYes', 'xParameter': _sExecuteOnYes});
		_sExecuteOnNo = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sExecuteOnNo', 'xParameter': _sExecuteOnNo});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _sHtml = '';
		var _oDropdownDiv = this.oDocument.getElementById(_sInputFieldID+'DropdownDiv');
		var _oDropdownOverlay = this.oDocument.getElementById(_sInputFieldID+'DropdownOverlay');
		if ((_oDropdownDiv) && (_oDropdownOverlay))
		{
			var _iDropdownDivSizeX = parseInt(_oDropdownDiv.offsetWidth);
			var _iDropdownDivSizeY = parseInt(_oDropdownDiv.offsetHeight);
			
			_oDropdownOverlay.style.width = _iDropdownDivSizeX+'px';
			_oDropdownOverlay.style.height = _iDropdownDivSizeY+'px';
			if (typeof(oPGGFX) != 'undefined') {oPGGFX.setElementOpacity({'xElement': _oDropdownOverlay, 'iPercent': 50});}
			_oDropdownOverlay.style.display = 'block';
			
			_sHtml += '<table id="'+_sInputFieldID+'DatasetQuestion" style="position:absolute; width:100px; height:60px; left:'+(Math.floor(_iDropdownDivSizeX/2)-50)+'px; top:'+(Math.floor(_iDropdownDivSizeY/2)-30)+'px; border-width:0px; background-color:#FFFFFF; cursor:default;">';
			_sHtml += '<tr>';
				_sHtml += '<td colspan="2" style="text-align:center;">'+_sQuestion+'</td>';
			_sHtml += '</tr>';
			_sHtml += '<tr>';
				var _iButtonMode = 0;
				_sHtml += '<td style="text-align:right; width:50%;">';
				_sHtml += oPGButton.build(
					{
						'sButtonID': _sInputFieldID+'QuestionButtonYes', 
						'sText': this.getText({'sType': 'YesButton'}), 
						'iButtonMode': _iButtonMode, 
						'sOnClick': 'oPGInputField.hideDatasetQuestion({\'sInputFieldID\': \''+_sInputFieldID+'\'}); '+_sExecuteOnYes, 
						'sSizeX': '45px'
					}
				);
				_sHtml += '</td>';
				_sHtml += '<td style="text-align:left; width:50%;">';
				_sHtml += oPGButton.build(
					{
						'sButtonID': _sInputFieldID+'QuestionButtonNo', 
						'sText': this.getText({'sType': 'NoButton'}), 
						'iButtonMode': _iButtonMode,
						'sOnClick': 'oPGInputField.hideDatasetQuestion({\'sInputFieldID\': \''+_sInputFieldID+'\'}); '+_sExecuteOnNo, 
						'sSizeX': '45px'
					}
				);
				_sHtml += '</td>';
			_sHtml += '</tr>';
			_sHtml += '</table>';
			_oDropdownDiv.innerHTML += _sHtml;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.inputFieldOnSwitchDatasetEditMode = function(_sInputFieldID)
	{
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oDatasetPanel = null;
		var _oDatasetCount = this.oDocument.getElementById(_sInputFieldID+'DatasetCount');
		if (_oDatasetCount)
		{
			var _iDatasetCount = parseInt(_oDatasetCount.value);
			for (var i=0; i<_iDatasetCount; i++)
			{
				_oDatasetPanel = this.oDocument.getElementById(_sInputFieldID+'Dataset'+i+'Panel');
				if (_oDatasetPanel)
				{
					if (_oDatasetPanel.style.display == 'none') {_oDatasetPanel.style.display = 'block';}
					else {_oDatasetPanel.style.display = 'none';}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iFieldIndex [needed][type]int[/type]
	[en]...[/en]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setFieldOnMouseDown = function(_sInputFieldID, _iFieldIndex, _sJavaScriptToExecute)
	{
		if (typeof(_iFieldIndex) == 'undefined') {var _iFieldIndex = null;}
		if (typeof(_sJavaScriptToExecute) == 'undefined') {var _sJavaScriptToExecute = null;}

		_iFieldIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldIndex', 'xParameter': _iFieldIndex});
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oField = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex);
		if (_oField) {oPGEventManager.addEvent({'oObject': _oField, 'sEventType': PG_EVENTTYPE_ONMOUSEDOWN, 'fFunction': function() {eval(_sJavaScriptToExecute);}});}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sInputFieldID [needed][type]string[/type]
	[en]...[/en]
	
	@param iFieldIndex [needed][type]string[/type]
	[en]...[/en]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setFieldOnBlur = function(_sInputFieldID, _iFieldIndex, _sJavaScriptToExecute)
	{
		if (typeof(_iFieldIndex) == 'undefined') {var _iFieldIndex = null;}
		if (typeof(_sJavaScriptToExecute) == 'undefined') {var _sJavaScriptToExecute = null;}

		_iFieldIndex = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'iFieldIndex', 'xParameter': _iFieldIndex});
		_sJavaScriptToExecute = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sJavaScriptToExecute', 'xParameter': _sJavaScriptToExecute});
		_sInputFieldID = this.getRealParameter({'oParameters': _sInputFieldID, 'sName': 'sInputFieldID', 'xParameter': _sInputFieldID});

		var _oField = this.oDocument.getElementById(_sInputFieldID+'Field'+_iFieldIndex);
		if (_oField) {oPGEventManager.addEvent({'oObject': _oField, 'sEventType': PG_EVENTTYPE_ONBLUR, 'fFunction': function() {eval(_sJavaScriptToExecute);}});}
	}
	/* @end method */
}
/* @end class */
classPG_InputField.prototype = new classPG_ClassBasics();
var oPGInputField = new classPG_InputField();
