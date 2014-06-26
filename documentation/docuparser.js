/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 23 2012
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