/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 23 2012
*/
var PG_CHECKBOX_MODE_NONE = 0;
var PG_CHECKBOX_MODE_AUTOSAVE = 1;

var PG_CHECKBOX_STATUS_INDEX_STATUS = 0;
var PG_CHECKBOX_STATUS_INDEX_VALUE = 1;
var PG_CHECKBOX_STATUS_INDEX_IMAGE = 2;

var PG_CHECKBOX_EVENT_ONCHANGE = 'OnChange';

var PG_CHECKBOX_NETWORK_REQUESTTYPE = 'PG_CheckBoxNetworkRequestType';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_CheckBox()
{
	// Declarations...
	this.sSendParameters = '';
	
	// Construct...
	this.setID({'sID': 'PGCheckBox'});
	this.initClassBasics();
	this.setGfxSubPath({'sPath': 'controls/'});
	
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
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.clear = function(_sCheckBoxID)
	{
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});
		this.changeStatus(_sCheckBoxID, 0);
	}
	/* @end method */
	
	/*
	@start method
	
	@return asIDs [type]string[][/type]
	[en]...[/en]
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getIDStructure = function(_sCheckBoxID)
	{
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		var _asIDs = new Array();
		_asIDs.push(_sCheckBoxID);
		_asIDs.push(_sCheckBoxID+'CurrentStatus');
		_asIDs.push(_sCheckBoxID+'MaxStatus');
		_asIDs.push(_sCheckBoxID+'SendParams');
		_asIDs.push(_sCheckBoxID+'Mode');
		
		var _iMaxStatus = parseInt(this.oDocument.getElementById(_sCheckBoxID+'MaxStatus'));
		for (var i=0; i<_iMaxStatus; i++)
		{
			_asIDs.push(_sCheckBoxID+'Symbol'+i);
			_asIDs.push(_sCheckBoxID+'Status'+i);
		}
		
		return _asIDs;
	}
	/* @end method */

	/*
	@start method
	
	@return sCheckBoxHtml [type]string[/type]
	[en]...[/en]
	
	@param sCheckBoxID [type]string[/type]
	[en]...[/en]
	
	@param iCheckBoxMode [type]int[/type]
	[en]...[/en]
	
	@param xSelectedStatus [type]mixed[/type]
	[en]...[/en]
	
	@param axStatusStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
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
	*/
	this.build = function(
		_sCheckBoxID,
		_iCheckBoxMode,

		_xSelectedStatus,
		_axStatusStructure,

		_sSendParameters,

		_sOnClick,
		_sOnMouseDown,
		_sOnMouseUp,
		_sOnMouseOver,
		_sOnMouseOut
	)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_iCheckBoxMode) == 'undefined') {var _iCheckBoxMode = null;}
		if (typeof(_xSelectedStatus) == 'undefined') {var _xSelectedStatus = null;}
		if (typeof(_sSendParameters) == 'undefined') {var _sSendParameters = null;}
		if (typeof(_sOnClick) == 'undefined') {var _sOnClick = null;}
		if (typeof(_sOnMouseDown) == 'undefined') {var _sOnMouseDown = null;}
		if (typeof(_sOnMouseUp) == 'undefined') {var _sOnMouseUp = null;}
		if (typeof(_sOnMouseOver) == 'undefined') {var _sOnMouseOver = null;}
		if (typeof(_sOnMouseOut) == 'undefined') {var _sOnMouseOut = null;}

		_iCheckBoxMode = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'iCheckBoxMode', 'xParameter': _iCheckBoxMode});

		_xSelectedStatus = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'xSelectedStatus', 'xParameter': _xSelectedStatus});
		_axStatusStructure = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'axStatusStructure', 'xParameter': _axStatusStructure});

		_sSendParameters = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sSendParameters', 'xParameter': _sSendParameters});

		_sOnClick = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sOnClick', 'xParameter': _sOnClick});
		_sOnMouseDown = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sOnMouseDown', 'xParameter': _sOnMouseDown});
		_sOnMouseUp = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sOnMouseUp', 'xParameter': _sOnMouseUp});
		_sOnMouseOver = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sOnMouseOver', 'xParameter': _sOnMouseOver});
		_sOnMouseOut = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sOnMouseOut', 'xParameter': _sOnMouseOut});

		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		if ((_sCheckBoxID == null) || (_sCheckBoxID == '')) {_sCheckBoxID = this.getNextID();}
		if (_iCheckBoxMode == null) {_iCheckBoxMode = PG_CHECKBOX_MODE_NONE;}
		
		if (_axStatusStructure == null)
		{
			_axStatusStructure.push(this.buildStatusStructure(0, null, null));
			_axStatusStructure.push(this.buildStatusStructure(1, null, null));
		}
		if (_xSelectedStatus == null) {_xSelectedStatus = _axStatusStructure[0][PG_CHECKBOX_STATUS_INDEX_STATUS];}
		
		if (_sSendParameters == null) {_sSendParameters = '';}

		if (_sOnClick == null) {_sOnClick = '';}
		if (_sOnMouseDown == null) {_sOnMouseDown = '';}
		if (_sOnMouseUp == null) {_sOnMouseUp = '';}
		if (_sOnMouseOver == null) {_sOnMouseOver = '';}
		if (_sOnMouseOut == null) {_sOnMouseOut = '';}

		var i=0;
		var _sHTML = '';
		var _iDefaultStatus = 0;
		
		if (_axStatusStructure.length == 2)
		{
			i=0;
			_sHTML += '<input type="CheckBox" id="'+_sCheckBoxID+'Symbol" ';
			if (_xSelectedStatus == _axStatusStructure[1][PG_CHECKBOX_STATUS_INDEX_STATUS]) {_sHTML += 'checked '; _iDefaultStatus = 1;}
			if (_sOnMouseDown !== '') {_sHTML += 'onmousedown="'+_sOnMouseDown.replace(/"/g, '\"')+'" ';}
			if (_sOnMouseUp !== '') {_sHTML += 'onmouseup="'+_sOnMouseUp.replace(/"/g, '\"')+'" ';}
			if (_sOnMouseOver !== '') {_sHTML += 'onmouseover="'+_sOnMouseOver.replace(/"/g, '\"')+'" ';}
			if (_sOnMouseOut !== '') {_sHTML += 'onmouseout="'+_sOnMouseOut.replace(/"/g, '\"')+'" ';}
			_sHTML += 'onclick="';
			if (_sOnClick !== '') {_sHTML += _sOnClick.replace(/"/g, '\"')+' ';}
			_sHTML += 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''+_sCheckBoxID+'\'}); ';
			_sHTML += '" />';
		}
		
		for (i=0; i<_axStatusStructure.length; i++)
		{
			if ((_axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_IMAGE] != '') && (_axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_IMAGE] != null))
			{
				_sHTML += '<img id="'+_sCheckBoxID+'Symbol'+i+'" ';
				_sHTML += 'src="'+this.getGfxPathImages()+_axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_IMAGE]+'" ';
				_sHTML += 'style="border-width:0px; float:left; ';
				if (_xSelectedStatus == _axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_STATUS])
				{
					_iDefaultStatus = i;
					_sHTML += 'display:block; ';
				}
				else {_sHTML += 'display:none; ';}
				_sHTML += '" ';
				if (_sOnMouseDown != '') {_sHTML += 'onmousedown="'+_sOnMouseDown.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseUp != '') {_sHTML += 'onmouseup="'+_sOnMouseUp.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseOver != '') {_sHTML += 'onmouseover="'+_sOnMouseOver.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseOut != '') {_sHTML += 'onmouseout="'+_sOnMouseOut.replace(/"/g, '\"')+'" ';}
				_sHTML += 'onclick="';
				if (_sOnClick != '') {_sHTML += _sOnClick.replace(/"/g, '\"')+' ';}
				_sHTML += 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''+_sCheckBoxID+'\', \'iStatusIndex\': '+i+'}); ';
				_sHTML += '" />';
			}
			else if (_axStatusStructure.length > 2)
			{
				_sHTML += '<a id="'+_sCheckBoxID+'Symbol'+i+'" href="javascript:;" ';
				_sHTML += 'style="float:left; ';
				if (_xSelectedStatus == _axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_STATUS])
				{
					_iDefaultStatus = i;
					_sHTML += 'display:block; ';
				}
				else {_sHTML += 'display:none; ';}
				_sHTML += '" ';
				if (_sOnMouseDown != '') {_sHTML += 'onmousedown="'+_sOnMouseDown.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseUp != '') {_sHTML += 'onmouseup="'+_sOnMouseUp.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseOver != '') {_sHTML += 'onmouseover="'+_sOnMouseOver.replace(/"/g, '\"')+'" ';}
				if (_sOnMouseOut != '') {_sHTML += 'onmouseout="'+_sOnMouseOut.replace(/"/g, '\"')+'" ';}
				_sHTML += 'onclick="';
				if (_sOnClick != '') {_sHTML += _sOnClick.replace(/"/g, '\"')+' ';}
				_sHTML += 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''+_sCheckBoxID+'\', \'iStatusIndex\': '+i+'}); ';
				_sHTML += '">'+(i+1)+'</a>';
			}
			
			_sHTML += '<a href="javascript:;" onclick="oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''+_sCheckBoxID+'\', \'iStatusIndex\': '+i+'});" target="_self">';
			_sHTML += '<span id="'+_sCheckBoxID+'Value'+i+'" style="';
			if (_xSelectedStatus == _axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_STATUS]) {_sHTML += 'display:block; ';}
			else {_sHTML += 'display:none; ';}
			_sHTML += '">'+_axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_VALUE]+'</span>';
			_sHTML += '</a>';
			_sHTML += '<input type="hidden" id="'+_sCheckBoxID+'Status'+i+'" value="'+_axStatusStructure[i][PG_CHECKBOX_STATUS_INDEX_STATUS]+'" />';
		}
		_sHTML += '<input type="hidden" id="'+_sCheckBoxID+'CurrentStatus" value="'+_iDefaultStatus+'" />';
		_sHTML += '<input type="hidden" id="'+_sCheckBoxID+'MaxStatus" value="'+_axStatusStructure.length+'" />';
		_sHTML += '<input type="hidden" id="'+_sCheckBoxID+'SendParams" value="'+_sSendParameters+'" />';
		_sHTML += '<input type="hidden" id="'+_sCheckBoxID+'Mode" value="'+_iCheckBoxMode+'" />';
		return _sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@return axStatusStructure [type]mixed[/type]
	[en]...[/en]
	
	@param xStatus [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	this.buildStatusStructure = function(_xStatus, _xValue, _sImage)
	{
		if (typeof(_xStatus) == 'undefined') {var _xStatus = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		if (typeof(_sImage) == 'undefined') {var _sImage = null;}

		_xValue = this.getRealParameter({'oParameters': _xStatus, 'sName': 'xValue', 'xParameter': _xValue});
		_sImage = this.getRealParameter({'oParameters': _xStatus, 'sName': 'sImage', 'xParameter': _sImage});
		_xStatus = this.getRealParameter({'oParameters': _xStatus, 'sName': 'xStatus', 'xParameter': _xStatus});
		
		return new Array(_xStatus, _xValue, _sImage);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStatusIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.checkBoxOnClick = function(_sCheckBoxID, _iStatusIndex)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_iStatusIndex) == 'undefined') {var _iStatusIndex = null;}

		_iStatusIndex = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'iStatusIndex', 'xParameter': _iStatusIndex});
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		var _oCheckBoxMode = this.oDocument.getElementById(_sCheckBoxID+'Mode');
		var _oCheckBoxMaxStatus = this.oDocument.getElementById(_sCheckBoxID+'MaxStatus');
		var _oCheckBoxCurrentStatus = this.oDocument.getElementById(_sCheckBoxID+'CurrentStatus');
		if ((_oCheckBoxMode) && (_oCheckBoxMaxStatus) && (_oCheckBoxCurrentStatus))
		{
			var _iCheckBoxMode = parseInt(_oCheckBoxMode.value);
			var _iCheckBoxMaxStatus = parseInt(_oCheckBoxMaxStatus.value);
			if ((!isNaN(_iCheckBoxMode)) && (!isNaN(_iCheckBoxMaxStatus)))
			{
				if (_iStatusIndex == null) {_iStatusIndex = _oCheckBoxCurrentStatus.value;}

				_iStatusIndex++;
				if (_iStatusIndex >= _iCheckBoxMaxStatus) {_iStatusIndex = 0;}

				if (this.isMode({'iMode': PG_CHECKBOX_MODE_AUTOSAVE, 'iCurrentMode': _iCheckBoxMode}))
				{
					var _oCheckBoxStatus = this.oDocument.getElementById(_sCheckBoxID+'Status'+_iStatusIndex);
					var _oCheckBoxValue = this.oDocument.getElementById(_sCheckBoxID+'Value'+_iStatusIndex);
					if ((_oCheckBoxStatus) && (_oCheckBoxValue))
					{
						var _sParameters = '';
						_sParameters += 'sCheckBoxID='+_sCheckBoxID;
						_sParameters += '&iStatus='+_iStatusIndex;
						_sParameters += '&sStatus='+encodeURIComponent(_oCheckBoxStatus.value);
						_sParameters += '&sValue='+encodeURIComponent(_oCheckBoxValue.innerHTML);
						this.send({'sCheckBoxID': _sCheckBoxID, 'sEvent': PG_CHECKBOX_EVENT_ONCHANGE, 'sParameters': _sParameters});
					}
				}
				else {this.changeStatus({'sCheckBoxID': _sCheckBoxID, 'iStatusIndex': _iStatusIndex});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return xStatus [type]mixed[/type]
	[en]...[/en]
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getStatusIndex = function(_sCheckBoxID)
	{
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});
		var _oCheckBoxCurrentStatus = this.oDocument.getElementById(_sCheckBoxID+'CurrentStatus');
		if (_oCheckBoxCurrentStatus) {return _oCheckBoxCurrentStatus.value;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStatusIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.getValue = function(_sCheckBoxID, _iStatusIndex)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_iStatusIndex) == 'undefined') {var _iStatusIndex = null;}

		_iStatusIndex = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'iStatusIndex', 'xParameter': _iStatusIndex});
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		if (_iStatusIndex === null) {_iStatusIndex = this.getStatusIndex({'sCheckBoxID': _sCheckBoxID});}

		var _oCheckBoxValue = this.oDocument.getElementById(_sCheckBoxID+'Value'+_iStatusIndex);
		if (_oCheckBoxValue) {return _oCheckBoxValue.innerHTML;}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatus [type]string[/type]
	[en]...[/en]
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStatusIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.getStatus = function(_sCheckBoxID, _iStatusIndex)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_iStatusIndex) == 'undefined') {var _iStatusIndex = null;}

		_iStatusIndex = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'iStatusIndex', 'xParameter': _iStatusIndex});
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		if (_iStatusIndex === null) {_iStatusIndex = this.getStatusIndex({'sCheckBoxID': _sCheckBoxID});}

		var _oCheckBoxStatus = this.oDocument.getElementById(_sCheckBoxID+'Status'+_iStatusIndex);
		if (_oCheckBoxStatus) {return _oCheckBoxStatus.value;}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStatusIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	this.changeStatus = function(_sCheckBoxID, _iStatusIndex)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_iStatusIndex) == 'undefined') {var _iStatusIndex = null;}

		_iStatusIndex = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'iStatusIndex', 'xParameter': _iStatusIndex});
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		var _oCheckBoxSymbol = null;
		var _oCheckBoxLabel = null;
		
		var _oCheckBoxCurrentStatus = this.oDocument.getElementById(_sCheckBoxID+'CurrentStatus');
		if (_oCheckBoxCurrentStatus)
		{
			_oCheckBoxSymbol = this.oDocument.getElementById(_sCheckBoxID+'Symbol'+_oCheckBoxCurrentStatus.value);
			_oCheckBoxLabel = this.oDocument.getElementById(_sCheckBoxID+'Value'+_oCheckBoxCurrentStatus.value);
			if (_oCheckBoxSymbol) {_oCheckBoxSymbol.style.display = 'none';}
			if (_oCheckBoxLabel) {_oCheckBoxLabel.style.display = 'none';}
	
			_oCheckBoxSymbol = this.oDocument.getElementById(_sCheckBoxID+'Symbol'+_iStatusIndex);
			_oCheckBoxLabel = this.oDocument.getElementById(_sCheckBoxID+'Value'+_iStatusIndex);
			if (_oCheckBoxSymbol) {_oCheckBoxSymbol.style.display = 'inline';}
			if (_oCheckBoxLabel) {_oCheckBoxLabel.style.display = 'inline';}
			
			// real CheckBox?...
			_oCheckBoxSymbol = this.oDocument.getElementById(_sCheckBoxID+'Symbol');
			if (_oCheckBoxSymbol)
			{
				if (_iStatusIndex == 1) {_oCheckBoxSymbol.checked = true;}
				else {_oCheckBoxSymbol.checked = false;}
			}
			
			_oCheckBoxCurrentStatus.value = _iStatusIndex;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sCheckBoxID [needed][type]string[/type]
	[en]...[/en]
	
	@param sEvent [needed][type]string[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	*/
	this.send = function(_sCheckBoxID, _sEvent, _sParameters)
	{
		if (typeof(_sCheckBoxID) == 'undefined') {var _sCheckBoxID = null;}
		if (typeof(_sEvent) == 'undefined') {var _sEvent = null;}
		if (typeof(_sParameters) == 'undefined') {var _sParameters = null;}
		
		_sEvent = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sEvent', 'xParameter': _sEvent});
		_sParameters = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sParameters', 'xParameter': _sParameters});
		_sCheckBoxID = this.getRealParameter({'oParameters': _sCheckBoxID, 'sName': 'sCheckBoxID', 'xParameter': _sCheckBoxID});

		var _sParameters2 = '';
		_sParameters2 += 'sRequestType='+PG_CHECKBOX_NETWORK_REQUESTTYPE;
		_sParameters2 += '&sEvent='+_sEvent;
		if (this.sSendParameters != '') {_sParameters2 += '&'+this.sSendParameters;}
		if ((_sParameters != '') && (_sParameters != null)) {_sParameters2 += '&'+_sParameters;}

		var _oSendParams = this.oDocument.getElementById(_sCheckBoxID+'SendParams');
		if (_oSendParams) {if (_oSendParams.value != '') {_sParameters2 += '&'+_oSendParams.value;}}

		this.networkSend({'sParameters': _sParameters2, 'fOnResponse': oPGCheckBox.CheckBoxOnResponse});
	}
	/* @end method */
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.CheckBoxOnResponse = function(_oParameters)
	{
		if (_oParameters['PG_RequestType'] == PG_CHECKBOX_NETWORK_REQUESTTYPE)
		{
			var _sCheckBoxID = _oParameters['PG_CheckBoxID'];
			var _sJavaScriptToExecute = _oParameters['PG_CheckBoxJavaScriptToExecute'];
			var _sEvent = _oParameters['PG_CheckBoxEvent'];
			if (_sEvent == PG_CHECKBOX_EVENT_ONCHANGE)
			{
				var _iStatusIndex = parseInt(_oParameters['PG_CheckBoxStatus']);
				if (!isNaN(_iStatusIndex)) {oPGCheckBox.changeStatus({'sCheckBoxID': _sCheckBoxID, 'iStatusIndex':_iStatusIndex});}
			}
			if (_sJavaScriptToExecute != '') {eval(_sJavaScriptToExecute);}
		}
	}
	/* @end method */
}
/* @end class */
classPG_CheckBox.prototype = new classPG_ClassBasics();
var oPGCheckBox = new classPG_CheckBox();
