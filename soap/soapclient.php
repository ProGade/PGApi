<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Oct 28 2013
*/
class classPG_SoapAuth
{
	public $sLogin = '';
	public $sPassword = '';
}

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_SoapClient extends classPG_ClassBasics
{
	private $oClient = NULL;
	private $oSoapHeaders = NULL;
	private $bNoCache = false;
	private $sCacheType = WSDL_CACHE_MEMORY;
	private $bTrace = false;
	private $bExceptions = false;
	private $bCompression = false;
	private $iSoapVersion = SOAP_1_2;
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return oClient [type]object[/type]
	[en]...[/en]
	
	@param sWsdl [type]string[/type]
	[en]...[/en]
	
	@param sLogin [type]string[/type]
	[en]...[/en]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	
	@param axOptions [type]mixed[][/type]
	[en]...[/en]
	*/
	public function init($_sWsdl = NULL, $_sLogin = NULL, $_sPassword = NULL, $_axOptions = NULL)
	{
		$_sLogin = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sLogin', 'xParameter' => $_sLogin));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_axOptions = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'axOptions', 'xParameter' => $_axOptions));
		$_sWsdl = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sWsdl', 'xParameter' => $_sWsdl));
		
		// $_sWsdl = 'http://127.0.0.1/soaptest/wsdl.php';
		// $_sWsdl = 'http://127.0.0.1/soaptest/server.php?wsdl';
		if (($this->bTrace == true) && (!isset($_axOptions['trace']))) {$_axOptions['trace'] = true;}
		if (($this->bExceptions == true) && (!isset($_axOptions['exceptions']))) {$_axOptions['exceptions'] = true;}
		if (($this->bNoCache == true) && (!isset($_axOptions['cache_wsdl']))) {$_axOptions['cache_wsdl'] = WSDL_CACHE_NONE;} else {$_axOptions['cache_wsdl'] = $this->sCacheType;}
		if (($this->bCompression == true) && (!isset($_axOptions['compression']))) {$_axOptions['compression'] = SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP;}
		if (!isset($_axOptions['soap_version'])) {$_axOptions['soap_version'] = $this->iSoapVersion;}
		// $_axOptions['location'] = 'http://127.0.0.1/soaptest/server.php';
		// $_axOptions['uri'] = '127.0.0.1';
		// $_axOptions['keep_alive'] = true;

		try
		{
			$_sNameSpace = 'auth'; // http://127.0.0.1/soaptest/server.php';
			$_sAuthMethod = 'authenticate';
			$_oAuth = new classPG_SoapAuth();
			$_oAuth->sLogin = $_sLogin;
			$_oAuth->sPassword = $_sPassword;
			$_oAuthVars = new SoapVar($_oAuth, SOAP_ENC_OBJECT);
			$this->oSoapHeaders = new SoapHeader($_sNameSpace, $_sAuthMethod, $_oAuthVars, false); // , 'http://schemas.xmlsoap.org/soap/actor/next');

			$this->oClient = @new SoapClient($_sWsdl, $_axOptions);
			$this->oClient->__setSoapHeaders($this->oSoapHeaders);

			return $this->oClient;
		}
		catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return axFunctions [type]mixed[][/type]
	[en]...[/en]
	*/
	public function getFunctions()
	{
		if ($this->oClient)
		{
			try {return $this->oClient->__getFunctions();}
			catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sTypes [type]string[/type]
	[en]...[/en]
	*/
	public function getTypes()
	{
		if ($this->oClient)
		{
			try {return $this->oClient->__getTypes();}
			catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		}
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param oError [needed][type]object[/type]
	[en]...[/en]
	*/
	public function addError($_oError)
	{
		$_oError = $this->getRealParameter(array('oParameters' => $_oError, 'sName' => 'oError', 'xParameter' => $_oError));

		if ($this->isDebugMode(array('iMode' => PG_DEBUG_LOW | PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
		{
			$_sError = 'Soap Client Error: ';
			$_sError .= '['.$_oError->getCode().'] ';
			$_sError .= $_oError->getMessage().'<br />';
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sError .= '<br /><pre>'.print_r($_oError->getTrace(), true).'</pre>';}
			else if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM))) {$_sError .= 'at row '.$_oError->getLine().' in file '.$_oError->getFile();}
			$this->addDebugString(array('sString' => $_sError));
		}
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
		
		if ($_axParameters === NULL) {$_axParameters = array();}
		
		if ($this->oClient)
		{
			try
			{
				return $this->oClient->__soapCall($_sFunction, $_axParameters); //, NULL, $this->oSoapHeaders);
			}
			catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		}
		return false;
	}
	/* @end method */
}
/* @end class */
$oPGSoapClient = new classPG_SoapClient();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSoapClient', 'xValue' => $oPGSoapClient));}
?>