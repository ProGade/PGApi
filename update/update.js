/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Update()
{
	// Declarations...
	this.oDatabaseUpdate = null;
	this.oFolderUpdate = null;
	
	// Construct...
	this.setID({'sID': 'PGUpdate'});
	if (typeof(oPGDatabaseUpdate) != 'undefined') {this.oDatabaseUpdate = oPGDatabaseUpdate;}
	if (typeof(oPGFolderUpdate) != 'undefined') {this.oFolderUpdate = oPGFolderUpdate;}
	
	// Methods...
	/*this.build = function()
	{
		if (this.oDatabaseUpdate != null) {this.oDatabaseUpdate.init({'asDBChunks': this.asDBChunks, 'asTables': this.asTables, 'sUpdateScriptPath': , _sProgressBarID)}
		if (this.oFolderUpdate != null) {}
	}*/
}
/* @end class */
classPG_Update.prototype = new classPG_ClassBasics();
var oPGUpdate = new classPG_Update();
