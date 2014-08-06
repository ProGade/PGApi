<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 13 2012
*/

// Example: $asPGRegisterVars = array('myVarName1' => 'string', 'myVarName2' => 'int');
// $bPGRegisterSessions can be used to get session vars without to use the session class
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_RegisterVars extends classPG_ClassBasics
{
	// Declarations...
	private $asRegisterVars = array();
	private $bRegisterSessions = false;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useRegisterSessions($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bRegisterSessions = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bRegister [type]bool[/type]
	[en]...[/en]
	*/
	public function isRegisterSessions() {return $this->bRegisterSessions;}
	/* @end method */
	
	/*
	@start method
	
	@param axVars [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function setVars($_axVars)
	{
		$_axVars = $this->getRealParameter(array('oParameters' => $_axVars, 'sName' => 'axVars', 'xParameter' => $_axVars, 'bNotNull' => true));
		$this->asRegisterVars = $_axVars;
	}
	/* @end method */
	
	/*
	@start method
	
	@param axVars [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function addVars($_axVars)
	{
		$_axVars = $this->getRealParameter(array('oParameters' => $_axVars, 'sName' => 'axVars', 'xParameter' => $_axVars, 'bNotNull' => true));
		$this->asRegisterVars = array_merge($this->asRegisterVars, $_axVars);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	
	@param sMethod [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addVar($_sName, $_sType = NULL, $_sMethod = NULL)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->asRegisterVars[] = array('sName' => $_sName, 'sType' => $_sType, 'sMethod' => $_sMethod);
	}
	/* @end method */
	
	/*
	@start method
	
	@param axVars [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function getVars($_axVars = NULL)
	{
		$_axVars = $this->getRealParameter(array('oParameters' => $_axVars, 'sName' => 'axVars', 'xParameter' => $_axVars, 'bNotNull' => true));
		if (isset($_axVars['axVars'])) {if ($_axVars['axVars'] == NULL) {$_axVars = NULL;}}
		
		if ($_axVars === NULL) {$_axVars = $this->asRegisterVars;}
		
		$_axReturnVars = array();
		for ($i=0; $i<count($_axVars); $i++)
		{
			$_axReturnVars[$_axVars[$i]['sName']] = $this->getVar($_axVars[$i]);
		}
		return $_axReturnVars;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sType [type]string[/type]
	[en]...[/en]
	
	@param sMethod [type]string[/type]
	[en]...[/en]
	*/
	public function getVar($_sName, $_sType = NULL, $_sMethod = NULL)
	{
		global $_GET, $_POST, $_SESSION;
	
		$_sType = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		if ($_sType === NULL) {$_sType = 'string';}
		
		$_sMethod = strtolower($_sMethod);
		$_sType = strtolower($_sType);

		if ($_sType == 'integer') {$_sType = 'int';}
		
		if ($_sType == 'int') {$$_sName = 0;}
		else if (($_sType == 'float') || ($_sType == 'double')) {$$_sName = 0.0;}
		else if ($_sType == 'string') {$$_sName = '';}
		else {$$_sName = ''; $_sType = 'string';}

		if ($_sMethod == 'session')
		{
			if ($this->bRegisterSessions == true) {eval('if (isset($_SESSION["'.$_sName.'"])) {$'.$_sName.' = ('.$_sType.')$_SESSION["'.$_sName.'"];}');}
		}
		else if ($_sMethod == 'post')
		{
			if (isset($_POST[$_sName])) {eval('$'.$_sName.' = ('.$_sType.')$_POST["'.$_sName.'"];');}
		}
		else if ($_sMethod == 'get')
		{
			if (isset($_GET[$_sName])) {eval('$'.$_sName.' = ('.$_sType.')$_GET["'.$_sName.'"];');}
		}
		else
		{
			if (isset($_GET[$_sName])) {eval('$'.$_sName.' = ('.$_sType.')$_GET["'.$_sName.'"];');}
			else if (isset($_POST[$_sName])) {eval('$'.$_sName.' = ('.$_sType.')$_POST["'.$_sName.'"];');}
			if ($this->bRegisterSessions == true) {if (isset($_SESSION[$_sName])) {eval('$'.$_sName.' = ('.$_sType.')$_SESSION["'.$_sName.'"];');}}
		}

		if ($_sType == 'int') {$$_sName = intval($$_sName);}
		else if ($_sType == 'float') {$$_sName = floatval($$_sName);}
		else if ($_sType == 'double') {$$_sName = doubleval($$_sName);}
		else {$$_sName = htmlspecialchars($$_sName, ENT_QUOTES);}
		
		return $$_sName;
	}
	/* @end method */
}
/* @end class */
$oPGRegisterVars = new classPG_RegisterVars();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGRegisterVars', 'xValue' => $oPGRegisterVars));}
?>