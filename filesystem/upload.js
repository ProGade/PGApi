/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
var PG_UPLOAD_METHOD_HTML = 0;
var PG_UPLOAD_METHOD_PERLCGI = 1;
var PG_UPLOAD_METHOD_FLASH = 2;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Upload()
{
	// Declarations...
	this.iUploadMethod = PG_UPLOAD_METHOD_HTML;
	this.bUploadIsRunning = false;
	
	this.iBytesMax = 0;
	this.iBytesCurrent = 0;
	this.iUploadPercent = 0;
	this.iStatusRequestTimeout = 2000;
	this.oStatusInterval = null;
	this.sUploadScriptPath = 'ajax/';
	this.sStatusXmlFile = 'upload_status.php';
	this.sProgressBarID = '';
	this.sAbortButtonID = '';
	this.sReloadFormID = '';
	
	this.oAjaxRequestObject = null;
	this.oXmlRead = null;
	this.fOnStatusUpdateResultFunction = null;

	this.dBytesMax = 0;
	this.dBytesCurrent = 0;

	this.sUploadFileID = '';
	this.aiBytesPerInterval = new Array();

	// Construct...
	this.setID({'sID': 'PGUpload'});
	this.initClassBasics();
	
	// Methods...
	/*
	@start method
	
	@param iUploadMethod [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setMethod = function(_iUploadMethod)
	{
		_iUploadMethod = this.getRealParameter({'oParameters': _iUploadMethod, 'sName': 'iUploadMethod', 'xParameter': _iUploadMethod});
		this.iUploadMethod = _iUploadMethod;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iUploadMethod [type]int[/type]
	[en]...[/en]
	*/
	this.getMethod = function() {return this.iUploadMethod;}
	/* @end method */
	
	/*
	@start method
	
	@param sProgressBarID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setProgressBarID = function(_sProgressBarID)
	{
		_sProgressBarID = this.getRealParameter({'oParameters': _sProgressBarID, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		this.sProgressBarID = _sProgressBarID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sProgressBarID [type]string[/type]
	[en]...[/en]
	*/
	this.getProgressBarID = function() {return this.sProgressBarID;}
	/* @end method */
	
	/*
	@start method
	
	@param sAbortButtonID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setAbortButtonID = function(_sAbortButtonID)
	{
		_sAbortButtonID = this.getRealParameter({'oParameters': _sAbortButtonID, 'sName': 'sAbortButtonID', 'xParameter': _sAbortButtonID});
		this.sAbortButtonID = _sAbortButtonID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sAbortButtonID [type]string[/type]
	[en]...[/en]
	*/
	this.getAbortButtonID = function() {return this.sAbortButtonID;}
	/* @end method */
	
	/*
	@start method
	
	@param sReloadFormID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setReloadFormID = function(_sReloadFormID)
	{
		_sReloadFormID = this.getRealParameter({'oParameters': _sReloadFormID, 'sName': 'sReloadFormID', 'xParameter': _sReloadFormID});
		this.sReloadFormID = _sReloadFormID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sReloadFormID [type]string[/type]
	[en]...[/en]
	*/
	this.getReloadFormID = function() {return this.sReloadFormID;}
	/* @end method */
	
	/*
	@start method
	
	@param sUploadID [type]string[/type]
	[en]...[/en]
	*/
	this.start = function(_sUploadID)
	{
		if (typeof(_sUploadID) == 'undefined') {var _sUploadID = null;}
		
		_sUploadID = this.getRealParameter({'oParameters': _sUploadID, 'sName': 'sUploadID', 'xParameter': _sUploadID});
		
		if (_sUploadID == null) {_sUploadID = this.getNextID();}
		
		var _oForm = this.oDocument.getElementById(_sUploadID+'UploadForm');
		var _oFormDiv = this.oDocument.getElementById(_sUploadID+'UploadFormDiv');
		var _oStatusDiv = this.oDocument.getElementById(_sUploadID+'UploadStatusDiv');
		var _oUploadFileID = this.oDocument.getElementById(_sUploadID+'UploadFileID');
		
		this.iBytesMax = 0;
		this.iBytesCurrent = 0;
		this.iStatusPercent = 0;
	
		this.sUploadFileID = _oUploadFileID.value;
		// pu_target_dir = this.oDocument.getElementById("pu_target_dir").value;

		if (_oForm)
		{
			// oForm.action = "http://awstats.progade.de/cgi-bin/prouploader_upload.pl?pu_upload_id=" + pu_upload_id + "&pu_target_dir=" + pu_target_dir;
			//_oUploadFileID.value = '';
			// this.oDocument.getElementById("pu_target_dir").value = '';
			_oForm.submit();
		}

		if (_oFormDiv) {_oFormDiv.style.display = "none";}
		if (_oStatusDiv) {oStatusDiv.style.display = "block";}

		if ((typeof(oPGProgressBar) != 'undefined') && (this.sProgressBarID != ''))
		{
			oPGProgressBar.setPercent({'sBarID': this.sProgressBarID, 'iPercent': 0});
		}

		this.bUploadIsRunning = true;
		this.oStatusInterval = window.setInterval('oPGUpload.sendStatusRequest({"sUploadID": "'+_sUploadID+'"})', this.iStatusRequestTimeout);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sBytes [type]string[/type]
	[en]...[/en]
	
	@param dBytes [type]double[/type]
	[en]...[/en]
	*/
	this.formatBytes = function(_dBytes)
	{
		_dBytes = this.getRealParameter({'oParameters': _dBytes, 'sName': 'dBytes', 'xParameter': _dBytes});

		var _sBytes = "";
		_sBytes = _dBytes + "B";
		if (_dBytes > 1200) {_dBytes = Math.round(_dBytes/10.24)/100; _sBytes = _dBytes + "KB";}
		if (_dBytes > 1200) {_dBytes = Math.round(_dBytes/10.24)/100; _sBytes = _dBytes + "MB";}
		if (_dBytes > 1200) {_dBytes = Math.round(_dBytes/10.24)/100; _sBytes = _dBytes + "GB";}
		return _sBytes;
	}
	/* @end method */
	
	/*
	@start method
	
	@return dSpeed [type]double[/type]
	[en]...[/en]
	*/
	this.getAverageSpeed = function()
	{
		var _dSpeed = 0;
		var _iCount = 0;
		for (var i=Math.max(this.aiBytesPerInterval.length-6, 0); i<this.aiBytesPerInterval.length-1; i++)
		{
			_dSpeed += this.aiBytesPerInterval[i+1]-this.aiBytesPerInterval[i];
			_iCount++;
		}
		// _dSpeed = _dSpeed/_iCount;
		// _dSpeed = _dSpeed/this.iStatusRequestTimeout*1000;
		return _dSpeed;
	}
	/* @end method */
	
	/*
	@start method
	
	@return dReminderTime [type]double[/type]
	[en]...[/en]
	
	@param dSpeed [needed][type]double[/type]
	[en]...[/en]
	
	@param dBytesCurrent [needed][type]double[/type]
	[en]...[/en]
	
	@param dBytesMax [needed][type]double[/type]
	[en]...[/en]
	*/
	this.getReminderTime = function(_dSpeed, _dBytesCurrent, _dBytesMax)
	{
		if (typeof(_dBytesCurrent) == 'undefined') {var _dBytesCurrent = null;}
		if (typeof(_dBytesMax) == 'undefined') {var _dBytesMax = null;}

		_dBytesCurrent = this.getRealParameter({'oParameters': _dSpeed, 'sName': 'dBytesCurrent', 'xParameter': _dBytesCurrent});
		_dBytesMax = this.getRealParameter({'oParameters': _dSpeed, 'sName': 'dBytesMax', 'xParameter': _dBytesMax});
		_dSpeed = this.getRealParameter({'oParameters': _dSpeed, 'sName': 'dSpeed', 'xParameter': _dSpeed});

		var _dReminderTime = 0;
		if (_dSpeed > 0)
		{
			_dReminderTime = (_dBytesMax-_dBytesCurrent)/_dSpeed;
		}
		return _dReminderTime;
	}
	/* @end method */

	/*
	@start method
	
	@return sTime [type]string[/type]
	[en]...[/en]
	
	@param dSeconds [needed][type]double[/type]
	[en]...[/en]
	*/
	this.formatTime = function(_dSeconds)
	{
		_dSeconds = this.getRealParameter({'oParameters': _dSeconds, 'sName': 'dSeconds', 'xParameter': _dSeconds});

		var _iMinutes = 0;
		var _iHours = 0;
		var _iDays = 0;
		var _iWeeks = 0;
		var _sTime = "";
		
		while(_dSeconds > 60) {_dSeconds -= 60; _iMinutes += 1;}
		while(_iMinutes > 60) {_iMinutes -= 60; _iHours += 1;}
		while(_iHours > 24) {_iHours -= 24; _iDays += 1;}
		while(_iDays > 7) {_iDays -= 7; _iWeeks += 1;}
		
		_dSeconds = Math.round(_dSeconds);
		
		if (_iWeeks == 1) {_sTime += _iWeeks + " Woche ";}
		else if (_iWeeks > 0) {_sTime += _iWeeks + " Wochen ";}
		
		if (_iDays == 1) {_sTime += _iDays + " Tag ";}
		else if (_iDays > 0) {_sTime += _iDays + " Tage ";}
		
		if (_iHours > 0) {_sTime += _iHours + " h ";}
		if (_iMinutes > 0) {_sTime += _iMinutes + " Min ";}
		if (_dSeconds > 0) {_sTime += _dSeconds + " Sek ";}
		
		return _sTime;
	}
	/* @end method */

	///////////////////////////// Ajax...
	
	this.setAjaxRequestObject = function(_oAjaxRequestObject) {this.oAjaxRequestObject = _oAjaxRequestObject;}
	this.getAjaxRequestObject = function() {return this.oAjaxRequestObject;}
	
	this.setFunctionOnStatusUpdate = function(_fFunction) {this.fOnStatusUpdateResultFunction = _fFunction;}
	
	this.setXMLReadObject = function(_oXmlRead) {this.oXmlRead = _oXmlRead;}
	this.getXMLReadObject = function() {return this.oXmlRead;}
	
	this.sendStatusRequest = function(_sUploadID)
	{
		if (typeof(oPGAjax) != 'undefined')
		{
			this.oAjaxRequestObject = oPGAjax.openRequest2(this.oAjaxRequestObject, this.sUploadScriptPath+this.sStatusXmlFile, this.fOnStatusUpdateResultFunction);
			if (this.oAjaxRequestObject) {oPGAjax.sendRequest(this.oAjaxRequestObject, 'sPGUploadID='+_sUploadID);}
		}
	}
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onStatusUpdate = function(_oParameters)
	{
		if ((this.oXmlRead == null) && (typeof(classPG_XMLRead) != 'undefined')) {this.oXmlRead = new classPG_XMLRead();}
		if ((typeof(oPGAjax) != 'undefined') && (this.oXmlRead != null))
		{
			var _oXml = oPGAjax.getResultXMLObject(this.oAjaxRequestObject);
			if ((_oXml) && (typeof(_oXml) != 'string'))
			{
				var _sRequestType = oPGAjax.getResultRequestType({'oXml': _oXml});
				if (_sRequestType == 'UploadStatus')
				{
					this.oXmlRead.open({'oXml': _oXml});
					var _dBytesMax = parseInt(_oParameters['PG_FileUploadBytesMax']);
					var _dBytesCurrent = parseInt(_oParameters['PG_FileUploadBytesCurrent']);
					var _sUploadID = _oParameters['PG_FileUploadID'];
					
					if (_dBytesMax > 0) {this.dBytesMax = _dBytesMax;}
					if (_dBytesCurrent > 0) {this.dBytesCurrent = _dBytesCurrent;}
					this.aiBytesPerInterval.push(_dBytesCurrent);

					var _iPercent = 0;
					if ((this.dBytesCurrent > 0) && (this.dBytesMax > 0))
					{
						_iPercent = Math.min(Math.round(this.dBytesCurrent / this.dBytesMax * 100), 100);
						if ((typeof(oPGControls) != 'undefined') && (this.sProgressBarID != ''))
						{
							oPGProgressBar.setPercent({'sBarID': this.sProgressBarID, 'iPercent': Math.max(Math.min(_iPercent, 100), 0)});
						}
					}
					
					/* TODO!
					var oStatusBytes = document.getElementById("pu_upload_bytes");
					if (oStatusBytes)
					{
						var sBytesText = "";
						sBytesText += pu_fnc_format_bytes(pu_var_bytes_current);
						sBytesText += " von ";
						if (pu_var_bytes_max > 0) {sBytesText += pu_fnc_format_bytes(pu_var_bytes_max);} else {sBytesText += "???";}
						var vReminderTime = 0;
						var vAverageSpeed = pu_fnc_get_average_speed();
						if ((vAverageSpeed > 0) && (pu_var_bytes_max > 0))
						{
							sBytesText += " [" + pu_fnc_format_bytes(vAverageSpeed) + "/sek]";
							vReminderTime = pu_fnc_get_reminder_time(vAverageSpeed, pu_var_bytes_current, pu_var_bytes_max);
						}
						sBytesText += "<br />verbleibende Zeit: ";
						if (vReminderTime > 0) {sBytesText += pu_fnc_format_time(vReminderTime);}
						else {sBytesText += "???";}
						oStatusBytes.innerHTML = sBytesText;
					}
					*/
					
					if ((_iPercent < 100) && (this.bUploadIsRunning == true))
					{
						// window.setTimeout("pu_fnc_ajax_status_request(\"upload_get_status.php\", \"pu_upload_id=" + sUploadID + "\")", pu_int_status_request_timeout);
					}
					else
					{
						this.bUploadIsRunning = false;
						// window.clearInterval(this.oStatusInterval);
						oPGUpload.sendStatusRequest(_sUploadID);
						// var oCloseButton = document.getElementById("pu_upload_close_button");
						// if (oCloseButton) {oCloseButton.disabled = false;}
						
						if (this.sAbortButtonID != '')
						{
							var _oAbortButton = document.getElementById(this.sAbortButtonID);
							if (_oAbortButton) {_oAbortButton.style.display = "none";}
						}
						
						if (this.sReloadFormID != '')
						{
							var _oReloadForm = document.getElementById(this.sReloadFormID);
							if (_oReloadForm) {_oReloadForm.style.display = "inline";}
						}
					}
				}
			} // Ready?
		}
	}
	/* @end method */
}
/* @end class */
classPG_Upload.prototype = new classPG_ClassBasics();
var oPGUpload = new classPG_Upload();
