/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 10 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Tab()
{
	// Declarations...
	
	// Construct...
	this.setID({'sID': 'PGTab'});
	this.initClassBasics();
	
	// Methods...
}
/* @end class */
classPG_Tab.prototype = new classPG_ClassBasics();
var oPGTab = new classPG_Tab();