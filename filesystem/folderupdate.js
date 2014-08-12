/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
var PG_FOLDERUPDATE_ACTION_STATUS_STOPPED = 0;
var PG_FOLDERUPDATE_ACTION_STATUS_RUNNING = 1;

var PG_FOLDERUPDATE_NETWORK_REQUESTTYPE = 'PGFolderUpdateRequest';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_FolderUpdate()
{
	// Declarations...
	this.iFolderIndex = 0;
	this.iUpdatePercent = 0;
	this.iFoldersSuccessed = 0;
	this.iFoldersFailed = 0;
	this.iFilesSuccessed = 0;
	this.iFilesFailed = 0;
	this.sProgressBarID = '';
	this.sUpdateHistoryContainerID = '';
	this.sCurrentActionContainerID = '';
	this.fOnUpdateRefreshFunction = null;
	this.fOnUpdateDoneFunction = null;
	this.sUpdateScriptPath = 'update_folders.php';
	
	this.asFolders = new Array();
	this.iUpdateActionStatus = PG_FOLDERUPDATE_ACTION_STATUS_STOPPED;

	// Construct...
	this.setID({'sID': 'PGFolderUpdate'});
	this.initClassBasics();

	// Methods...
	/*
	@start method
	
	@param asFolders [type]string[][/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param sProgressBarID [type]string[/type]
	[en]...[/en]
	*/
	this.init = function(_asFolders, _sUpdateScriptPath, _sProgressBarID)
	{
		if (typeof(_sUpdateScriptPath) == 'undefined') {var _sUpdateScriptPath = null;}
		if (typeof(_sProgressBarID) == 'undefined') {var _sProgressBarID = null;}

		_sUpdateScriptPath = this.getRealParameter({'oParameters': _asFolders, 'sName': 'sUpdateScriptPath', 'xParameter': _sUpdateScriptPath});
		_sProgressBarID = this.getRealParameter({'oParameters': _asFolders, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		_asFolders = this.getRealParameter({'oParameters': _asFolders, 'sName': 'asFolders', 'xParameter': _asFolders});

		if (_sUpdateScriptPath != null) {this.sUpdateScriptPath = _sUpdateScriptPath;}
		this.iUpdatePercent = 0;
		this.iFolderIndex = 0;
		this.iFoldersSuccessed = 0;
		this.iFoldersFailed = 0;
		this.iFilesSuccessed = 0;
		this.iFilesFailed = 0;
		this.asFolders = _asFolders;
		this.sProgressBarID = _sProgressBarID;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setUpdateScriptPath = function(_sPath)
	{
		_sPath = this.getRealParameter({'oParameters': _sPath, 'sName': 'sPath', 'xParameter': _sPath});
		oPGFolderUpdate.sUpdateScriptPath = _sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sContainerID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCurrentActionContainerID = function(_sContainerID)
	{
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		this.sCurrentActionContainerID = _sContainerID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.getCurrentActionContainerID = function() {return this.sCurrentActionContainerID;}
	/* @end method */

	/*
	@start method
	
	@param sContainerID [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setUpdateHistoryContainerID = function(_sContainerID)
	{
		_sContainerID = this.getRealParameter({'oParameters': _sContainerID, 'sName': 'sContainerID', 'xParameter': _sContainerID});
		this.sUpdateHistoryContainerID = _sContainerID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContainerID [type]string[/type]
	[en]...[/en]
	*/
	this.getUpdateHistoryContainerID = function() {return this.sUpdateHistoryContainerID;}
	/* @end method */
	
	/* @start method */
	this.send = function()
	{
		var _sParameters = 'sRequestType='+PG_FOLDERUPDATE_NETWORK_REQUESTTYPE;
		_sParameters += '&sDir='+oPGFolderUpdate.asFolders[oPGFolderUpdate.iFolderIndex-1];
		this.networkSend({'sParameters': _sParameters, 'fOnResponse': oPGFolderUpdate.onResponse, 'sResponseFile': this.sUpdateScriptPath});
	}
	/* @end method */
	
	/* @start method */
	this.run = function()
	{
		if (oPGFolderUpdate.iUpdateActionStatus != PG_FOLDERUPDATE_ACTION_STATUS_RUNNING)
		{
			oPGFolderUpdate.iUpdateActionStatus = PG_FOLDERUPDATE_ACTION_STATUS_RUNNING;
			oPGFolderUpdate.nextFolder();
		}
	}
	/* @end method */
	
	/* @start method */
	this.stop = function() {oPGFolderUpdate.iUpdateActionStatus = PG_FOLDERUPDATE_ACTION_STATUS_STOPPED;}
	/* @end method */
	
	/*
	@start method
	
	@return iPercent [type]int[/type]
	[en]...[/en]
	*/
	this.getPercent = function() {return oPGFolderUpdate.getPercentStatus();}
	/* @end method */

	/*
	@start method
	
	@return iPercent [type]int[/type]
	[en]...[/en]
	*/
	this.getPercentStatus = function() {return oPGFolderUpdate.iUpdatePercent;}
	/* @end method */

	/*
	@start method
	
	@return iUpdateActionStatus [type]int[/type]
	[en]...[/en]
	*/
	this.getActionStatus = function() {return oPGFolderUpdate.iUpdateActionStatus;}
	/* @end method */
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onResponse = function(_oParameters)
	{
		if (_oParameters['PG_RequestType'] == PG_FOLDERUPDATE_NETWORK_REQUESTTYPE)
		{
			oPGFolderUpdate.iFoldersSuccessed += parseInt(_oParameters['PG_FolderUpdate_Successed']);
			oPGFolderUpdate.iFoldersFailed += parseInt(_oParameters['PG_FolderUpdate_Failed']);
			oPGFolderUpdate.iFilesSuccessed += parseInt(_oParameters['PG_FilesUpdate_Successed']);
			oPGFolderUpdate.iFilesFailed += parseInt(_oParameters['PG_FilesUpdate_Failed']);
			oPGFolderUpdate.nextFolder();
		}
	}
	/* @end method */

	/* @start method */
	this.nextFolder = function()
	{
		if (oPGFolderUpdate.asFolders)
		{
			if (oPGFolderUpdate.iUpdateActionStatus == PG_FOLDERUPDATE_ACTION_STATUS_RUNNING) {oPGFolderUpdate.iFolderIndex++;}
			if (oPGFolderUpdate.iFolderIndex <= oPGFolderUpdate.asFolders.length)
			{
				oPGFolderUpdate.iUpdatePercent = Math.ceil(((oPGFolderUpdate.iFolderIndex)*100) / oPGFolderUpdate.asFolders.length);
		
				if (oPGFolderUpdate.sProgressBarID != '')
				{
					if (typeof(oPGProgressBar) != 'undefined')
					{
						oPGProgressBar.setPercent({'sProgressBarID': oPGFolderUpdate.sProgressBarID, 'iPercent': oPGFolderUpdate.iUpdatePercent});
					}
				}
				
				if (oPGFolderUpdate.iFolderIndex == oPGFolderUpdate.asFolders.length)
				{
					if (oPGFolderUpdate.sCurrentActionContainerID != '')
					{
						var _oCurrentActionContainer = oPGFolderUpdate.oDocument.getElementById(oPGFolderUpdate.sCurrentActionContainerID);
						if (_oCurrentActionContainer)
						{
							_oCurrentActionContainer.innerHTML = 'Folders update done';
						}
					}
						
					if (oPGFolderUpdate.sUpdateHistoryContainerID != '')
					{
						var _oUpdateHistoryContainer = oPGFolderUpdate.oDocument.getElementById(oPGFolderUpdate.sUpdateHistoryContainerID);
						if (_oUpdateHistoryContainer)
						{
							_oUpdateHistoryContainer.innerHTML += 'Folder "'+oPGFolderUpdate.asFolders[oPGFolderUpdate.iFolderIndex-1]+' done<br />';
							
							// if ((oPGFolderUpdate.iFoldersSuccessed > 0) || (oPGFolderUpdate.iFoldersFailed > 0))
							// {
								_oUpdateHistoryContainer.innerHTML += '<br /><b>Folders:</b><br />';
								_oUpdateHistoryContainer.innerHTML += '<span class="pg_failure">'+oPGFolderUpdate.iFoldersSuccessed+' successed</span><br />';
								_oUpdateHistoryContainer.innerHTML += '<span class="warnung">'+oPGFolderUpdate.iFoldersFailed+' failed</span><br />';
							// }
							
							// if ((oPGFolderUpdate.iFilesSuccessed > 0) || (oPGFolderUpdate.iFilesFailed > 0))
							// {
								_oUpdateHistoryContainer.innerHTML += "<br /><b>Files:</b><br />";
								_oUpdateHistoryContainer.innerHTML += '<span class="pg_failure">'+oPGFolderUpdate.iFilesSuccessed+' successed</span><br />';
								_oUpdateHistoryContainer.innerHTML += '<span class="warnung">'+oPGFolderUpdate.iFilesFailed+' failed</span><br />';
							// }
							
							_oUpdateHistoryContainer.innerHTML += '<br /><b>Update done</b><br />';
						}
					}
					
					if (oPGFolderUpdate.fOnUpdateDoneFunction) {oPGFolderUpdate.fOnUpdateDoneFunction();}
				}
				else
				{
					if (oPGFolderUpdate.sCurrentActionContainerID != '')
					{
						var _oCurrentActionContainer = oPGFolderUpdate.oDocument.getElementById(oPGFolderUpdate.sCurrentActionContainerID);
						if (_oCurrentActionContainer)
						{
							_oCurrentActionContainer.innerHTML = 'Update folder: '+oPGFolderUpdate.asFolders[oPGFolderUpdate.iFolderIndex];
						}
					}
					
					if (oPGFolderUpdate.sUpdateHistoryContainerID != '')
					{
						var _oUpdateHistoryContainer = oPGFolderUpdate.oDocument.getElementById(oPGFolderUpdate.sUpdateHistoryContainerID);
						if (_oUpdateHistoryContainer)
						{
							if (oPGFolderUpdate.iFolderIndex > 0) {_oUpdateHistoryContainer.innerHTML += 'Folder "'+oPGFolderUpdate.asFolders[oPGFolderUpdate.iFolderIndex-1]+'" done<br />';}
						}
					}
					
					if (oPGFolderUpdate.fOnUpdateRefreshFunction) {oPGFolderUpdate.fOnUpdateRefreshFunction();}
					if (oPGFolderUpdate.iUpdateActionStatus == PG_FOLDERUPDATE_ACTION_STATUS_RUNNING) {oPGFolderUpdate.send();}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param fFunction [needed][type]function[/type]
	[en]...[/en]
	*/
	this.setOnUpdateRefreshFunction = function(_fFunction)
	{
		_fFunction = this.getRealParameter({'oParameters': _fFunction, 'sName': 'fFunction', 'xParameter': _fFunction});
		this.fOnUpdateRefreshFunction = _fFunction;
	}
	/* @end method */
	
	/*
	@start method
	
	@param fFunction [needed][type]function[/type]
	[en]...[/en]
	*/
	this.setOnUpdateDoneFunction = function(_fFunction)
	{
		_fFunction = this.getRealParameter({'oParameters': _fFunction, 'sName': 'fFunction', 'xParameter': _fFunction});
		this.fOnUpdateDoneFunction = _fFunction;
	}
	/* @end method */
	
	/*
	@start method
	
	@param asFolders [needed][type]string[][/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param sFolderUpdateID [type]string[/type]
	[en]...[/en]
	
	@param bRunUpdate [type]bool[/type]
	[en]...[/en]
	
	@param iFoldersSuccessed [type]int[/type]
	[en]...[/en]
	
	@param iFoldersFailed [type]int[/type]
	[en]...[/en]
	
	@param iFilesSuccessed [type]int[/type]
	[en]...[/en]
	
	@param iFilesFailed [type]int[/type]
	[en]...[/en]
	*/
	this.build = function(_asFolders, _sUpdateScriptPath, _sFolderUpdateID, _bRunUpdate, _iFoldersSuccessed, _iFoldersFailed, _iFilesSuccessed, _iFilesFailed)
	{
		if (typeof(_sUpdateScriptPath) == 'undefined') {var _sUpdateScriptPath = null;}
		if (typeof(_sFolderUpdateID) == 'undefined') {var _sFolderUpdateID = null;}
		if (typeof(_bRunUpdate) == 'undefined') {var _bRunUpdate = null;}
		if (typeof(_iFoldersSuccessed) == 'undefined') {var _iFoldersSuccessed = null;}
		if (typeof(_iFoldersFailed) == 'undefined') {var _iFoldersFailed = null;}
		if (typeof(_iFilesSuccessed) == 'undefined') {var _iFilesSuccessed = null;}
		if (typeof(_iFilesFailed) == 'undefined') {var _iFilesFailed = null;}

		_sUpdateScriptPath = this.getRealParameter({'oParameters': _asFolders, 'sName': 'sUpdateScriptPath', 'xParameter': _sUpdateScriptPath});
		_sFolderUpdateID = this.getRealParameter({'oParameters': _asFolders, 'sName': 'sFolderUpdateID', 'xParameter': _sFolderUpdateID});
		_bRunUpdate = this.getRealParameter({'oParameters': _asFolders, 'sName': 'bRunUpdate', 'xParameter': _bRunUpdate});
		_iFoldersSuccessed = this.getRealParameter({'oParameters': _asFolders, 'sName': 'iFoldersSuccessed', 'xParameter': _iFoldersSuccessed});
		_iFoldersFailed = this.getRealParameter({'oParameters': _asFolders, 'sName': 'iFoldersFailed', 'xParameter': _iFoldersFailed});
		_iFilesSuccessed = this.getRealParameter({'oParameters': _asFolders, 'sName': 'iFilesSuccessed', 'xParameter': _iFilesSuccessed});
		_iFilesFailed = this.getRealParameter({'oParameters': _asFolders, 'sName': 'iFilesFailed', 'xParameter': _iFilesFailed});
		_asFolders = this.getRealParameter({'oParameters': _asFolders, 'sName': 'asFolders', 'xParameter': _asFolders});
		
		if (_sUpdateScriptPath == null) {_sUpdateScriptPath = this.sUpdateScriptPath;}
		if (_sFolderUpdateID != null) {this.setID({'sID': _sFolderUpdateID});}
		if (_bRunUpdate === null) {_bRunUpdate = false;}
		if (_iFoldersSuccessed === null) {_iFoldersSuccessed = 0;}
		if (_iFoldersFailed === null) {_iFoldersFailed = 0;}
		if (_iFilesSuccessed === null) {_iFilesSuccessed = 0;}
		if (_iFilesFailed === null) {_iFilesFailed = 0;}
		
		var _sProgressBarID = this.getID()+'ProgressBar';
		this.init(_asFolders, _sUpdateScriptPath, _sProgressBarID);
		
		this.iFoldersSuccessed = _iFoldersSuccessed;
		this.iFoldersFailed = _iFoldersFailed;
		this.iFilesSuccessed = _iFilesSuccessed;
		this.iFilesFailed = _iFilesFailed;
		
		if (_bRunUpdate == true) {this.run();}
	}
	/* @end method */
}
/* @end class */
classPG_FolderUpdate.prototype = new classPG_ClassBasics();
var oPGFolderUpdate = new classPG_FolderUpdate();
