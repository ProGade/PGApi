<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Oct 28 2013
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_SoapMainService extends classPG_ClassBasics
{
	private $oService = NULL;
	private $sLogin = '';
	private $sPassword = '';
	
	public function __construct($_sLogin = NULL, $_sPassword = NULL, $_oService = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sLogin, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_oService = $this->getRealParameter(array('oParameters' => $_sLogin, 'sName' => 'oService', 'xParameter' => $_oService));
		$_sLogin = $this->getRealParameter(array('oParameters' => $_sLogin, 'sName' => 'sLogin', 'xParameter' => $_sLogin));
		
		if (($_sLogin != NULL) && ($_sPassword != NULL)) {$this->setLogin(array('sLogin' => $_sLogin, 'sPassword' => $_sPassword));}
		if ($_oService != NULL) {$this->setService(array('oService' => $_oService));}
	}
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sLogin [needed][type]string[/type]
	[en]...[/en]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	*/
	public function setLogin($_sLogin, $_sPassword = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sLogin, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sLogin = $this->getRealParameter(array('oParameters' => $_sLogin, 'sName' => 'sLogin', 'xParameter' => $_sLogin));
		
		$this->sLogin = $_sLogin;
		$this->sPassword = $_sPassword;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oLogin [needed][type]object[/type]
	[en]...[/en]
	*/
	public function authenticate($_oLogin)
	{
		if (($this->sLogin != '') && ($this->sPassword != ''))
		{
			if ((!empty($_oLogin->sLogin)) && (!empty($_oLogin->sPassword)))
			{
				$_sLogin = (string)$_oLogin->sLogin;
				$_sPassword = (string)$_oLogin->sPassword;
				
				if (($_sLogin == $this->sLogin) && ($_sPassword == $this->sPassword))
				{
					return true;
				}
				else {throw new SoapFault('401', 'incorrect login or password!', 'Server');}
			}
			else {throw new SoapFault('401', 'login or password not set!', 'Server');}
		}
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param oService [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setService($_oService)
	{
		$_oService = $this->getRealParameter(array('oParameters' => $_oService, 'sName' => 'oService', 'xParameter' => $_oService));
		$this->oService = $_oService;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return xResult [type]mixed[/type]
	[en]...[/en]
	
	@param sFunction [needed][type]string[/type]
	[en]...[/en]
	
	@param axParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function call($_sFunction, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sFunction, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sFunction = $this->getRealParameter(array('oParameters' => $_sFunction, 'sName' => 'sFunction', 'xParameter' => $_sFunction));
		
		return $this->__soapCall(array('sFunction' => $_sFunction, 'axParameters' => $_axParameters));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return xResult [type]mixed[/type]
	[en]...[/en]
	
	@param sFunction [needed][type]string[/type]
	[en]...[/en]
	
	@param axParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function __call($_sFunction, $_axParameters = NULL) {return $this->__soapCall($_sFunction, $_axParameters);}
	/* @end method */

	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return xResult [type]mixed[/type]
	[en]...[/en]
	
	@param sFunction [needed][type]string[/type]
	[en]...[/en]
	
	@param axParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function __soapCall($_sFunction, $_axParameters = NULL)
	{
		if ($this->oService === NULL) {global $oPGSoapService; if (isset($oPGSoapService)) {$this->oService = $oPGSoapService;}}
		if (isset($this->oService))
		{
			if (method_exists($this->oService, $_sFunction)) {return call_user_func_array(array($this->oService, $_sFunction), $_axParameters);}
			else {throw new SoapFault('3306', 'call to undefined method: "'.$_sFunction.'".<br />'.print_r($this->oService, true), 'Server');}
		}
		else {throw new SoapFault('3305', 'no service class definded.', 'Server');}
		return NULL;
	}
	/* @end method */
}
/* @end class */
$oPGSoapMainService = new classPG_SoapMainService();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSoapMainService', 'xValue' => $oPGSoapMainService));}
?>