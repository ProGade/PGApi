<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 06 2012
*/
/*
@start class
*/
class classPG_SessionVars extends classPG_ClassBasics
{
	// Declarations...
	private $sName = '';
	private $iLifeTime = 0;
	private $sPath = '/';
	private $sDomain = '';
	private $bUseSecure = false;
	private $bUseHttpOnly = false;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setName($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->sName = (string)$_sName;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@return sName [type]string[/type]
	[en]...[/en]
	*/
	public function getName() {return $this->sName;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return sSession [type]string[/type]
	[en]...[/en]
	*/
	public function getSessionName() {return session_name();}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param iSeconds [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setLifeTime($_iSeconds)
	{
		$_iSeconds = $this->getRealParameter(array('oParameters' => $_iSeconds, 'sName' => 'iSeconds', 'xParameter' => $_iSeconds));
		$this->iLifeTime = (int)$_iSeconds;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return iLifeTime [type]int[/type]
	[en]...[/en]
	*/
	public function getLifeTime() {return (int)$this->iLifeTime;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sPath = (string)$_sPath;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@return sPath [type]string[/type]
	[en]...[/en]
	*/
	public function getPath() {return (string)$this->sPath;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param sDomain [type]string[/type]
	[en]...[/en]
	*/
	public function setDomain($_sDomain)
	{
		$_sDomain = $this->getRealParameter(array('oParameters' => $_sDomain, 'sName' => 'sDomain', 'xParameter' => $_sDomain));
		$this->sDomain = (string)$_sDomain;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@return sDomain [type]string[/type]
	[en]...[/en]
	*/
	public function getDomain() {return (string)$this->sDomain;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSecure($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseSecure = (bool)$_bUse;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@return bUseSecure [type]bool[/type]
	[en]...[/en]
	*/
	public function isSecure() {return $this->bUseSecure;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useHttpOnly($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseHttpOnly = (bool)$_bUse;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@return bUseHttpOnly [type]bool[/type]
	[en]...[/en]
	*/
	public function isHttpOnly() {return $this->bUseHttpOnly;}
	/* @end method */
	
	/*
	@start method
	*/
	public function open()
	{
        // ini_set('session.use_only_cookies', '1');
        // ini_set('session.use_trans_id', '0');
		if ($this->sPath == '') {$this->sPath = '/';}
        if ($this->sDomain != '') {session_set_cookie_params($this->iLifeTime, $this->sPath, $this->sDomain, $this->bUseSecure, $this->bUseHttpOnly);}
		if ($this->sName != '') {session_name($this->sName);}
		session_start();
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSessionDestroyed [type]bool[/type]
	[en]...[/en]

	@param bDestroy [type]bool[/type]
	[en]...[/en]
	*/
	public function close($_bDestroy = NULL)
	{
        $_bDestroy = $this->getRealParameter(array('oParameters' => $_bDestroy, 'sName' => 'bDestroy', 'xParameter' => $_bDestroy));

        $_bSessionDestroyed = false;
        if ($_bDestroy == true)
        {
            foreach ($_SESSION as $_sVarName => $_xValue) {unset($_SESSION[$_sVarName]);}
            session_unset();
            $_SESSION = array();
            $_bSessionDestroyed = session_destroy();
            session_regenerate_id();
        }
		session_write_close();
		return $_bSessionDestroyed;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function set($_sName, $_xValue = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = $_xValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sValue [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setString($_sName, $_sValue = NULL)
	{
		$_sValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sValue', 'xParameter' => $_sValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = (string)$_sValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param iValue [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setInt($_sName, $_iValue = NULL)
	{
		$_iValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'iValue', 'xParameter' => $_iValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->setInteger(array('sName' => $_sName, 'iValue' => $_iValue));
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param iValue [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setInteger($_sName, $_iValue = NULL)
	{
		$_iValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'iValue', 'xParameter' => $_iValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = (int)$_iValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param fValue [needed][type]float[/type]
	[en]...[/en]
	*/
	public function setFloat($_sName, $_fValue = NULL)
	{
		$_fValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'fValue', 'xParameter' => $_fValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = (float)$_fValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param dValue [needed][type]double[/type]
	[en]...[/en]
	*/
	public function setDouble($_sName, $_dValue = NULL)
	{
		$_dValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'dValue', 'xParameter' => $_dValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = (double)$_dValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param bValue [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function setBool($_sName, $_bValue = NULL)
	{
		$_bValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bValue', 'xParameter' => $_bValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->setBoolean(array('sName' => $_sName, 'bValue' => $_bValue));
	}
	/* @end method */

	/*
	@start method
	
	@group Set
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param bValue [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function setBoolean($_sName, $_bValue = NULL)
	{
		$_bValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bValue', 'xParameter' => $_bValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$_SESSION[$_sName] = (bool)$_bValue;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return xValue [type]mixed[][/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function get($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return $_SESSION[$_sName];}
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return sValue [type]string[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getString($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return (string)$_SESSION[$_sName];}
		return '';
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return iValue [type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getInt($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		return $this->getInteger(array('sName' => $_sName));
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return iValue [type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getInteger($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return (int)$_SESSION[$_sName];}
		return 0;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return iValue [type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getFloat($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return (float)$_SESSION[$_sName];}
		return 0;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return dValue [type]double[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getDouble($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return (double)$_SESSION[$_sName];}
		return 0;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return bValue [type]bool[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getBool($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		return $this->getBoolean(array('sName' => $_sName));
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@return bValue [type]bool[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getBoolean($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if (!empty($_SESSION[$_sName])) {return (bool)$_SESSION[$_sName];}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Unset
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function unsetVar($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		unset($_SESSION[$_sName]);
	}
	/* @end method */

	/*
	@start method
	
	@group Unset
	
	@param asName [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function unsetVars($_asName)
	{
		$_asName = $this->getRealParameter(array('oParameters' => $_asName, 'sName' => 'asName', 'xParameter' => $_asName, 'bNotNull' => true));
		for ($i=0; $i<count($_asName); $i++) {unset($_SESSION[$_asName[$i]]);}
	}
	/* @end method */

	/*
	@start method
	
	@group Unset
	*/
	public function unsetAll() {return $this->close(array('bDestroy' => true));}
	/* @end method */

    /*
    @start method

	@return bSessionDestroyed [type]bool[/type]
	[en]...[/en]
    */
    public function destroy() {return $this->close(array('bDestroy' => true));}
    /* @end method */

    /*
    @start method

	@return bSessionDestroyed [type]bool[/type]
	[en]...[/en]
    */
    public function kill() {return $this->close(array('bDestroy' => true));}
    /* @end method */
}
/* @end class */
$oPGSessionVars = new classPG_SessionVars();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSessionVars', 'xValue' => $oPGSessionVars));}
?>