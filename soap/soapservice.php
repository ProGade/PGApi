<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Oct 28 2013
*/
/*
@start class
*/
class classPG_SoapService
{
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sTest [type]string[/type]
	[en]...[/en]
	
	@param sTest [needed][type]string[/type]
	[en]...[/en]
	*/
	public function test($_sTest)
	{
		return $_sTest;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sHelloWorld [type]string[/type]
	[en]...[/en]
	*/
	public function helloWorld()
	{
		return "Hello World!";
	}
	/* @end method */
}
/* @end class */
$oPGSoapService = new classPG_SoapService();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSoapService', 'xValue' => $oPGSoapService));}
?>