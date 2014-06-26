/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
*/
var PG_DATABASEUPDATE_ACTION_STATUS_STOPPED = 0;
var PG_DATABASEUPDATE_ACTION_STATUS_RUNNING = 1;

var PG_DATABASEUPDATE_NETWORK_REQUESTTYPE = 'PGDatabaseUpdateRequest';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_DatabaseUpdate()
{
	// Declarations...
	this.iUpdatePercent = 0;
	this.iChunkIndex = 0;
	this.iTablesIndex = 0;
	this.iAllTablesIndex = 0;
	this.iAllTablesMax = 0;
	this.iChunkSuccessed = 0;
	this.iChunkFailed = 0;
	this.iTablesSuccessed = 0;
	this.iTablesFailed = 0;
	this.sProgressBarID = '';
	this.sUpdateHistoryContainerID = '';
	this.sCurrentActionContainerID = '';
	this.fOnUpdateRefreshFunction = null;
	this.fOnUpdateDoneFunction = null;
	this.sUpdateScriptPath = 'update_database.php';

	this.asDBChunks = new Array();
	this.asTables = new Array();
	this.iUpdateActionStatus = PG_DATABASEUPDATE_ACTION_STATUS_STOPPED;
	
	// Construct...
	this.setID({'sID': 'PGDatabaseUpdate'});
	this.initClassBasics();
	this.initNetwork();
	
	// Methods...
	/*
	@start method
	
	@param asDBChunks [needed][type]string[][/type]
	[en]...[/en]
	
	@param asTables [needed][type]string[][/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param sProgressBarID [type]string[/type]
	[en]...[/en]
	*/
	this.init = function(_asDBChunks, _asTables, _sUpdateScriptPath, _sProgressBarID)
	{
		if (typeof(_asTables) == 'undefined') {var _asTables = null;}
		if (typeof(_sUpdateScriptPath) == 'undefined') {var _sUpdateScriptPath = null;}
		if (typeof(_sProgressBarID) == 'undefined') {var _sProgressBarID = null;}
	
		_asTables = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'asTables', 'xParameter': _asTables});
		_sUpdateScriptPath = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'sUpdateScriptPath', 'xParameter': _sUpdateScriptPath});
		_sProgressBarID = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'sProgressBarID', 'xParameter': _sProgressBarID});
		_asDBChunks = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'asDBChunks', 'xParameter': _asDBChunks, 'bNotNull': true});

		if (_sUpdateScriptPath != null) {this.sUpdateScriptPath = _sUpdateScriptPath;}
		this.iChunkIndex = 0;
		this.iTablesIndex = 0;
		this.iAllTablesIndex = 0;
		this.iChunkSuccessed = 0;
		this.iChunkFailed = 0;
		this.iTablesSuccessed = 0;
		this.iTablesFailed = 0;
		this.asDBChunks = _asDBChunks;
		this.asTables = _asTables;
		if (this.asTables)
		{
			for (var i=0; i<this.asTables.length; i++)
			{
				if (this.asTables[i])
				{
					this.iAllTablesMax += this.asTables[i].length;
				}
			}
		}
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
		this.sUpdateScriptPath = _sPath;
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
		var _sParameters = 'sRequestType='+PG_DATABASEUPDATE_NETWORK_REQUESTTYPE;
		_sParameters += '&sDBChunk='+oPGDatabaseUpdate.asDBChunks[oPGDatabaseUpdate.iChunkIndex];
		_sParameters += '&iTableIndex='+(oPGDatabaseUpdate.iTablesIndex-1);
		_sParameters += '&sTableName='+oPGDatabaseUpdate.asTables[oPGDatabaseUpdate.iChunkIndex][oPGDatabaseUpdate.iTablesIndex-1];
		this.networkSend({'sParameters': _sParameters, 'fOnResponse': oPGDatabaseUpdate.onResponse, 'sResponseFile': this.sUpdateScriptPath});
	}
	/* @end method */
	
	/* @start method */
	this.run = function()
	{
		if (oPGDatabaseUpdate.iUpdateActionStatus != PG_DATABASEUPDATE_ACTION_STATUS_RUNNING)
		{
			oPGDatabaseUpdate.iUpdateActionStatus = PG_DATABASEUPDATE_ACTION_STATUS_RUNNING;
			oPGDatabaseUpdate.nextChunk();
		}
	}
	/* @end method */
	
	/* @start method */
	this.stop = function() {oPGDatabaseUpdate.iUpdateActionStatus = PG_DATABASEUPDATE_ACTION_STATUS_STOPPED;}
	/* @end method */
	
	/*
	@start method
	
	@return iPercent [type]int[/type]
	[en]...[/en]
	*/
	this.getPercent = function() {return this.getPercentStatus();}
	/* @end method */

	/*
	@start method
	
	@return iPercent [type]int[/type]
	[en]...[/en]
	*/
	this.getPercentStatus = function() {return this.iUpdatePercent;}
	/* @end method */

	/*
	@start method
	
	@return iActionStatus [type]int[/type]
	[en]...[/en]
	*/
	this.getActionStatus = function() {return this.iUpdateActionStatus;}
	/* @end method */
	
	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onResponse = function(_oParameters)
	{
		if (_oParameters['PG_RequestType'] == PG_DATABASEUPDATE_NETWORK_REQUESTTYPE)
		{
			if (parseInt(_oParameters['PG_TablesUpdate_Successed']) == -1) {oPGDatabaseUpdate.iTablesFailed++;}
			else {oPGDatabaseUpdate.iTablesSuccessed++;}
			oPGDatabaseUpdate.nextChunk(_oParameters);
		}
	}
	/* @end method */

	/*
	@start method
	
	@param oParameters [needed][type]object[/type]
	[en]...[/en]
	*/
	this.nextChunk = function(_oParameters)
	{
		if (typeof(_oParameters) == 'undefined') {var _oParameters = null;}
		if (_oParameters == null) {_oParameters = {};}
		if ((oPGDatabaseUpdate.asDBChunks) && (oPGDatabaseUpdate.asTables))
		{
			if (oPGDatabaseUpdate.iUpdateActionStatus == PG_DATABASEUPDATE_ACTION_STATUS_RUNNING)
			{
				oPGDatabaseUpdate.iTablesIndex++;
				oPGDatabaseUpdate.iAllTablesIndex++;
			}

			if (oPGDatabaseUpdate.iChunkIndex <= oPGDatabaseUpdate.asDBChunks.length)
			{
				oPGDatabaseUpdate.iUpdatePercent = Math.ceil(((oPGDatabaseUpdate.iAllTablesIndex-1)*100) / oPGDatabaseUpdate.iAllTablesMax);

				if (oPGDatabaseUpdate.sProgressBarID != '')
				{
					if (typeof(oPGProgressBar) != 'undefined')
					{
						oPGProgressBar.setPercent({'sProgressBarID': oPGDatabaseUpdate.sProgressBarID, 'iPercent': oPGDatabaseUpdate.iUpdatePercent});
					}
				}

				if ((oPGDatabaseUpdate.iChunkIndex == oPGDatabaseUpdate.asDBChunks.length-1) && (oPGDatabaseUpdate.iTablesIndex > oPGDatabaseUpdate.asTables[oPGDatabaseUpdate.iChunkIndex].length))
				{
					if (oPGDatabaseUpdate.sCurrentActionContainerID != '')
					{
						var _oCurrentActionContainerID = oPGDatabaseUpdate.oDocument.getElementById(oPGDatabaseUpdate.sCurrentActionContainerID);
						if (_oCurrentActionContainerID) {_oCurrentActionContainerID.innerHTML = 'Database update done';}
					}
					
					if (oPGDatabaseUpdate.sUpdateHistoryContainerID != '')
					{
						if (oPGDatabaseUpdate.sUpdateHistoryContainerID != '')
						var _oUpdateHistoryContainer = oPGDatabaseUpdate.oDocument.getElementById(oPGDatabaseUpdate.sUpdateHistoryContainerID);
						if (_oUpdateHistoryContainer)
						{							
							_oUpdateHistoryContainer.innerHTML += '<br /><b>Tables:</b><br />';
							_oUpdateHistoryContainer.innerHTML += '<span class="pg_success">'+oPGDatabaseUpdate.iTablesSuccessed+' successed</span><br />';
							_oUpdateHistoryContainer.innerHTML += '<span class="pg_failure">'+oPGDatabaseUpdate.iTablesFailed+' failed</span><br />';
							
							if (oPGDatabaseUpdate.iTablesSuccessed == oPGDatabaseUpdate.iAllTablesMax)
							{
								_oUpdateHistoryContainer.innerHTML += '<br /><span class="pg_success">Database is up to date</span><br />';
							}
							else
							{
								_oUpdateHistoryContainer.innerHTML += '<br /><span class="pg_failure">Database is not up to date</span><br />';
							}
						}
						_oUpdateHistoryContainer.innerHTML += '<span class="pg_success"><b>Database update done</b></span><br />';
					}
					
					if (oPGDatabaseUpdate.fOnUpdateDoneFunction) {oPGDatabaseUpdate.fOnUpdateDoneFunction();}
				}
				else
				{
					if (oPGDatabaseUpdate.iTablesIndex > oPGDatabaseUpdate.asTables[oPGDatabaseUpdate.iChunkIndex].length)
					{
						oPGDatabaseUpdate.iTablesIndex = 1;
						oPGDatabaseUpdate.iChunkIndex++;
						
						if (oPGDatabaseUpdate.sCurrentActionContainerID != '')
						{
							var _oCurrentActionContainerID = oPGDatabaseUpdate.oDocument.getElementById(oPGDatabaseUpdate.sCurrentActionContainerID);
							if (_oCurrentActionContainerID) {_oCurrentActionContainerID.innerHTML = 'Update database "'+oPGDatabaseUpdate.asDBChunks[oPGDatabaseUpdate.iChunkIndex]+'"';}
						}
						
						if (oPGDatabaseUpdate.sUpdateHistoryContainerID != '')
						{	
							var _oUpdateHistoryContainer = oPGDatabaseUpdate.oDocument.getElementById(oPGDatabaseUpdate.sUpdateHistoryContainerID);
							if (_oUpdateHistoryContainer)
							{
								_oUpdateHistoryContainer.innerHTML += '<br />Database chunk "'+oPGDatabaseUpdate.asDBChunks[oPGDatabaseUpdate.iChunkIndex]+'"<br />';
								// _oUpdateHistoryContainer.innerHTML += '<br />Table "'+oPGDatabaseUpdate.asDBChunks[oPGDatabaseUpdate.iChunkIndex-1]+'" done';
								// if (vOk == 1) {oCheckText.innerHTML += "<span class=\"ok\">Ok</span>";}
								// else {oCheckText.innerHTML += "<span class=\"warnung\">veraltet</span>";}
								// if (sMessage != "") {oCheckText.innerHTML += "<br>"+sMessage;}
								// sMessage = "";
							}
						}
					}

					if (oPGDatabaseUpdate.sUpdateHistoryContainerID != '')
					{
						if (oPGDatabaseUpdate.sUpdateHistoryContainerID != '')
						var _oUpdateHistoryContainer = oPGDatabaseUpdate.oDocument.getElementById(oPGDatabaseUpdate.sUpdateHistoryContainerID);
						if (_oUpdateHistoryContainer)
						{
							if (typeof(_oParameters['PG_TablesUpdate_Debug']) != 'undefined') {_oUpdateHistoryContainer.innerHTML += _oParameters['PG_TablesUpdate_Debug'];}
							_oUpdateHistoryContainer.innerHTML += 'Table "'+oPGDatabaseUpdate.asTables[oPGDatabaseUpdate.iChunkIndex][oPGDatabaseUpdate.iTablesIndex-1]+'" done<br />';
						}
					}

					if (oPGDatabaseUpdate.fOnUpdateRefreshFunction) {oPGDatabaseUpdate.fOnUpdateRefreshFunction();}
					if (oPGDatabaseUpdate.iUpdateActionStatus == PG_DATABASEUPDATE_ACTION_STATUS_RUNNING) {oPGDatabaseUpdate.send();}
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
	
	@return sDatabaseUpdateHtml [type]string[/type]
	[en]...[/en]
	
	@param asDBChunks [needed][type]string[][/type]
	[en]...[/en]
	
	@param asTables [needed][type]string[][/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param sDatabaseUpdateID [type]string[/type]
	[en]...[/en]
	
	@param bRunUpdate [type]bool[/type]
	[en]...[/en]
	*/
	this.build = function(_asDBChunks, _asTables, _sUpdateScriptPath, _sDatabaseUpdateID, _bRunUpdate)
	{
		if (typeof(_asTables) == 'undefined') {var _asTables = null;}
		if (typeof(_sUpdateScriptPath) == 'undefined') {var _sUpdateScriptPath = null;}
		if (typeof(_sDatabaseUpdateID) == 'undefined') {var _sDatabaseUpdateID = null;}
		if (typeof(_bRunUpdate) == 'undefined') {var _bRunUpdate = null;}

		_asTables = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'asTables', 'xParameter': _asTables});
		_sUpdateScriptPath = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'sUpdateScriptPath', 'xParameter': _sUpdateScriptPath});
		_sDatabaseUpdateID = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'sDatabaseUpdateID', 'xParameter': _sDatabaseUpdateID});
		_bRunUpdate = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'bRunUpdate', 'xParameter': _bRunUpdate});
		_asDBChunks = this.getRealParameter({'oParameters': _asDBChunks, 'sName': 'asDBChunks', 'xParameter': _asDBChunks, 'bNotNull': true});
		
		if (_sUpdateScriptPath == null) {_sUpdateScriptPath = this.sUpdateScriptPath;}
		if (_sDatabaseUpdateID != null) {this.setID(_sDatabaseUpdateID);}
		if (_bRunUpdate === null) {_bRunUpdate = false;}
		
		var _sProgressBarID = this.getID()+'ProgressBar';
		this.init({'asDBChunks': _asDBChunks, 'asTables': _asTables, 'sUpdateScriptPath': _sUpdateScriptPath, 'sProgressBarID': _sProgressBarID});
		if (_bRunUpdate == true) {this.run();}
	}
	/* @end method */
}
/* @end class */
classPG_DatabaseUpdate.prototype = new classPG_ClassBasics();
var oPGDatabaseUpdate = new classPG_DatabaseUpdate();
