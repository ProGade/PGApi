<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Functions extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param sAliasName [needed][type]string[/type]
	[en]...[/en]
	
	@param sFunctionName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function createFunctionAlias($_sAliasName, $_sFunctionName = NULL)
	{
		$_sFunctionName = $this->getRealParameter(array('oParameters' => $_sAliasName, 'sName' => 'sFunctionName', 'xParameter' => $_sFunctionName));
		$_sAliasName = $this->getRealParameter(array('oParameters' => $_sAliasName, 'sName' => 'sAliasName', 'xParameter' => $_sAliasName));

		if (function_exists($_sAliasName)) {return false;}
		$_oReflectionFunction = new ReflectionFunction($_sFunctionName);
		$_sFunctionPrototype = $_sAliasName.'(';
		$_sFunctionCall = $_sFunctionName.'(';
		$_bNeedComma = false;
		
		foreach ($_oReflectionFunction->getParameters() as $_oParameters)
		{
			if ($_bNeedComma)
			{
				$_sFunctionPrototype .= ',';
				$_sFunctionCall .= ',';
			}
		
			$_sFunctionPrototype .= '$'.$_oParameters->getName();
			$_sFunctionCall .= '$'.$_oParameters->getName();
		
			if (($_oParameters->isOptional()) && ($_oParameters->isDefaultValueAvailable()))
			{
				$_xValue = $_oParameters->getDefaultValue();
				if(is_string($_xValue)) {$_xValue = "'".$_xValue."'";}
				$_sFunctionPrototype .= ' = '.$_xValue;
			}
			$_bNeedComma = true;
		}
		$_sFunctionPrototype .= ')';
		$_sFunctionCall .= ')';
		
		eval('function '.$_sFunctionPrototype.' {return '.$_sFunctionCall.';}');
		return true;
	}
	/* @end method */
}
/* @end class */
$oPGFunctions = new classPG_Functions();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFunctions', 'xValue' => $oPGFunctions));}
?>