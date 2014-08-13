/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_DocuParser()
{
	// Declarations...

	// Construct...
	this.setID({'sID': 'PGDocuParser'});
	this.initClassBasics();
	this.initNetwork();
	
	// Methods...
}
/* @end class */
classPG_DocuParser.prototype = new classPG_ClassBasics();
var oPGDocuParser = new classPG_DocuParser();