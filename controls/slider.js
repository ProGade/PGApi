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
function classPG_Slider()
{
	// Declarations...

	// Construct...
	this.setID({'sID': 'PGSlider'});
	
	// Methods...
}
/* @end class */
classPG_Slider.prototype = new classPG_ClassBasics();
var oPGSlider = new classPG_Slider();