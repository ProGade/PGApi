<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 16 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Facebook extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct() {}
	
	// Methods...
	/* @start method */
	public function build()
	{
		$_sHTML = '';
		$_sHTML .= '<div id="fb-root">';
		$_sHTML .= '</div>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGFacebook = new classPG_Facebook();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFacebook', 'xValue' => $oPGFacebook));}
?>