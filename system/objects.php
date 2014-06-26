<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 19 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Objects extends classPG_ClassBasics
{
	/*
	@start method
	
	@return sJavaScriptObject [type]string[/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param sStringEscape [type]string[/type]
	[en]...[/en]
	*/
	public function toJavaScriptObject($_oObject, $_sStringEscape = NULL)
	{
		global $oPGArrays;

		$_sStringEscape = $this->getRealParameter(array('oParameters' => $_oObject, 'sName' => 'sStringEscape', 'xParameter' => $_sStringEscape));
		$_oObject = $this->getRealParameter(array('oParameters' => $_oObject, 'sName' => 'oObject', 'xParameter' => $_oObject));
		
		if ($_sStringEscape === NULL) {$_sStringEscape = '"';}
		
		$i=0;
		$_sJavaScriptObject = '{';
			foreach ((array)$_oObject as $_sName => $_xValue)
			{
				if ($i>0) {$_sJavaScriptObject .= ',';}
				$_sJavaScriptObject .= $_sStringEscape.$_sName.$_sStringEscape.': ';
				if (is_string($_xValue)) {$_sJavaScriptObject .= $_sStringEscape.$_xValue.$_sStringEscape;}
				else if (is_array($_xValue)) {$_sJavaScriptObject .= $oPGArrays->toJavaScriptArray(array('axArray' => $_xValue));}
				else if (is_object($_xValue)) {$_sJavaScriptObject .= $this->toJavaScriptObject(array('oObject' => $_xValue));}
				else {$_sJavaScriptObject .= $_xValue;}
				$i++;
			}
		$_sJavaScriptObject .= '}';
		return $_sJavaScriptObject;
	}
	/* @end method */
}
/* @end class */
$oPGObjects = new classPG_Objects();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGObjects', 'xValue' => $oPGObjects));}
?>