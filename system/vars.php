<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Aug 06 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Vars extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sStructure [type]string[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	
	@param bUseHtml [type]bool[/type]
	[en]...[/en]
	*/
	public function getStructureString($_xVar, $_bUseHtml = NULL)
	{
		$_bUseHtml = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'bUseHtml', 'xParameter' => $_bUseHtml));
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));

		if ($_bUseHtml === NULL) {$_bUseHtml = true;}
		
		$_sStructure = '';
		if (isset($_xVar))
		{
			if ($_xVar === NULL)
			{
				if (($_bUseHtml == false) && ($_sStructure != '')) {$_sStructure .= ', ';}
				$_sStructure .= 'NULL';
			}
			else if ((is_array($_xVar)) || (is_object($_xVar)))
			{
				if ($_sStructure != '') {$_sStructure .= ', ';}
				/*
				if (is_array($_xVar))
				{
					$_sStructure .= 'array';
					if ($_bUseHtml == true) {$_sStructure .= '<br />';}
					$_sStructure .= '(';
				}
				else  if (is_object($_xVar))
				{
					$_sStructure .= 'object';
					if ($_bUseHtml == true) {$_sStructure .= '<br />';}
					$_sStructure .= '(';
				}
				if ($_bUseHtml == true) {$_sStructure .= '<blockquote style="margin-top:0px; margin-bottom:0px;">';}
				$_bSeperator = false;
				for ($_iIndex in _xVar)
				{
					if (typeof(_xVar[_iIndex]) != 'undefined')
					{
						if ((_bUseHtml == false) && (_bSeperator == true)) {_sStructure += ', ';}
						_sStructure += '['+_iIndex+'] = ';
						_sStructure += this.getStructureString(_xVar[_iIndex], _bUseHtml);
						if (_bUseHtml == true) {_sStructure += '<br />';}
						_bSeperator = true;
					}
				}
				if (_bUseHtml == true) {_sStructure += '</blockquote>';}
				$_sStructure .= ')';
				*/
				$_sStructure .= str_replace("\n", '<br />', print_r($_xVar, true));
			}
			else
			{
				if (($_bUseHtml == false) && ($_sStructure != '')) {$_sStructure .= ', ';}
				if (is_string($_xVar)) {$_sStructure .= '"'.$_xVar.'"';}
				else if ($this->isNumber($_xVar)) {$_sStructure .= $_xVar;}
				else if ($_xVar === false) {$_sStructure .= 'false';}
				else if ($_xVar === true) {$_sStructure .= 'true';}
			}
		}
		return $_sStructure;
	}
	/* @end method */

	/*
	@start method
	
	@return sType [type]string[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getType($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (!isset($_xVar)) {return 'undefined';}
		else
		{
			if (is_object($_xVar)) {return 'object';}
			if (is_array($_xVar)) {return 'array';}
			if (is_string($_xVar)) {return 'string';}
			if ((is_int($_xVar)) || (is_float($_xVar)) || (is_double($_xVar))) {return 'number';}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsObject [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function isObject($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar)) {return is_object($_xVar);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsArray [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function isArray($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar)) {return is_array($_xVar);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsString [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function isString($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar)) {return is_string($_xVar);}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsNumber [type]bool[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function isNumber($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar)) {return ((is_int($_xVar)) || (is_float($_xVar)) || (is_double($_xVar)));}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return nNumber [type]number[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function cssNumber($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar))
		{
			if (is_string($_xVar)) {if ((strpos($_xVar, 'px') === false) && (strpos($_xVar, '%') === false)) {$_xVar .= 'px';}}
			else {$_xVar .= 'px';}
		}
		return $_xVar;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sColor [type]string[/type]
	[en]...[/en]
	
	@param xVar [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function cssColor($_xVar)
	{
		$_xVar = $this->getRealParameter(array('oParameters' => $_xVar, 'sName' => 'xVar', 'xParameter' => $_xVar, 'bNotNull' => true));
		if (isset($_xVar))
		{
			if (is_string($_xVar)) {if ((strpos($_xVar, '#') === false) && (preg_match("![0-9A-Fa-f]{3,6}!is", $_xVar) > 0) && (strpos($_xVar, 'red') === false)) {$_xVar = '#'.$_xVar;}}
		}
		return $_xVar;
	}
	/* @end method */
}
/* @end class */
$oPGVars = new classPG_Vars();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGVars', 'xValue' => $oPGVars));}
?>