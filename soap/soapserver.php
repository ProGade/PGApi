<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Oct 28 2013
*/
/*
@start class
*/
class classPG_SoapServer extends classPG_ClassBasics
{
	private $oServer = NULL;
	private $bNoCache = false;
	private $sCacheType = WSDL_CACHE_MEMORY;
	private $iSoapVersion = SOAP_1_2;

	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return oServer [type]object[/type]
	[en]...[/en]
	
	@param sWsdl [type]string[/type]
	[en]...[/en]
	
	@param axOptions [type]mixed[][/type]
	[en]...[/en]
	*/
	public function init($_sWsdl = NULL, $_axOptions = NULL)
	{
		$_axOptions = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'axOptions', 'xParameter' => $_axOptions));
		$_sWsdl = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sWsdl', 'xParameter' => $_sWsdl));
		
		// $_sWsdl = 'http://127.0.0.1/soaptest/wsdl.php';
		if ($_sWsdl === NULL) {$_sWsdl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?wsdl';}
		if (($this->bNoCache == true) && (!isset($_axOptions['cache_wsdl']))) {$_axOptions['cache_wsdl'] = WSDL_CACHE_NONE;} else {$_axOptions['cache_wsdl'] = $this->sCacheType;}
		if (!isset($_axOptions['soap_version'])) {$_axOptions['soap_version'] = $this->iSoapVersion;}
		if (!isset($_axOptions['encoding'])) {$_axOptions['encoding'] = 'UTF-8';}
		// $_axOptions['uri'] = '127.0.0.1';
		
		try
		{
			$this->oServer = @new SoapServer($_sWsdl, $_axOptions);
			return $this->oServer;
		}
		catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]...[/en]
	
	@param oError [type]object[/type]
	[en]...[/en]
	*/
	public function addError($_oError)
	{
		$_oError = $this->getRealParameter(array('oParameters' => $_oError, 'sName' => 'oError', 'xParameter' => $_oError));

		if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
		{
			$_sError = 'Soap Server Error: ';
			$_sError .= '['.$_oError->getCode().'] ';
			$_sError .= $_oError->getMessage().'<br />';
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sError .= '<br /><pre>'.print_r($_oError->getTrace(), true).'</pre>';}
			else {$_sError .= 'at row '.$_oError->getLine.' in file '.$this->getFile();}
			$this->addDebugString(array('sString' => $_sError));
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Set
	
	@description
	[en]...[/en]
	
	@param sClass [needed][type]string[/type]
	[en]...[/en]
	
	@param axParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function setSoapClass($_sClass, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		if ($this->oServer) {$this->oServer->setClass($_sClass, $_axParameters); return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Set
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param axParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function setSoapObject($_oObject, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_oObject, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_oObject = $this->getRealParameter(array('oParameters' => $_oObject, 'sName' => 'oObject', 'xParameter' => $_oObject));
		if ($this->oServer) {$this->oServer->setObject($_oObject); return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFunction [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addSoapFunction($_sFunction)
	{
		$_sFunction = $this->getRealParameter(array('oParameters' => $_sFunction, 'sName' => 'sFunction', 'xParameter' => $_sFunction));
		if ($this->oServer) {return $this->oServer->addFunction($_sFunction); return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param asFunctions [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addSoapFunctions($_asFunctions)
	{
		$_asFunctions = $this->getRealParameter(array('oParameters' => $_asFunctions, 'sName' => 'asFunctions', 'xParameter' => $_asFunctions));
		if ($this->oServer) {return $this->oServer->addFunction($_asFunctions); return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sResult [type]string[/type]
	[en]...[/en]
	
	@param sRequest [type]string[/type]
	[en]...[/en]
	*/
	public function execute($_sRequest = NULL)
	{
		$_sRequest = $this->getRealParameter(array('oParameters' => $_sRequest, 'sName' => 'sRequest', 'xParameter' => $_sRequest));
		
		$_sReturn = '';
		ob_start();
		try
		{
			if ($_sRequest != NULL) {$this->oServer->handle($_sRequest);}
			else {$this->oServer->handle();}
		}
		catch(SOAPFault $_oError) {$this->addError(array('oError' => $_oError));}
		$_sReturn .= ob_get_contents();
		ob_end_clean();
		
		return $_sReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sResult [type]string[/type]
	[en]...[/en]
	
	@param sWsdl [type]string[/type]
	[en]...[/en]
	
	@param axOptions [type]mixed[][/type]
	[en]...[/en]
	
	@param sRequest [type]string[/type]
	[en]...[/en]
	
	@param sMainServiceClass [type]string[/type]
	[en]...[/en]
	
	@param oMainServiceObject [type]object[/type]
	[en]...[/en]
	
	@param axMainServiceParams [type]mixed[][/type]
	[en]...[/en]
	
	@param sServiceClass [type]string[/type]
	[en]...[/en]
	
	@param asFunctions [type]string[][/type]
	[en]...[/en]
	
	@param bForceWsdl [type]bool[/type]
	[en]...[/en]
	*/
	public function build(
		$_sWsdl = NULL, 
		$_axOptions = NULL, 
		$_sRequest = NULL, 
		$_sMainServiceClass = NULL, 
		$_oMainServiceObject = NULL,
		$_axMainServiceParams = NULL, 
		$_sServiceClass = NULL, 
		$_asFunctions = NULL, 
		$_bForceWsdl = NULL)
	{
		global $_GET;
	
		$_axOptions = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'axOptions', 'xParameter' => $_axOptions));
		$_sMainServiceClass = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sMainServiceClass', 'xParameter' => $_sMainServiceClass));
		$_oMainServiceObject = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'oMainServiceObject', 'xParameter' => $_oMainServiceObject));
		$_axMainServiceParams = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'axMainServiceParams', 'xParameter' => $_axMainServiceParams));
		$_sServiceClass = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sServiceClass', 'xParameter' => $_sServiceClass));
		$_sRequest = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sRequest', 'xParameter' => $_sRequest));
		$_bForceWsdl = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'bForceWsdl', 'xParameter' => $_bForceWsdl));
		$_sWsdl = $this->getRealParameter(array('oParameters' => $_sWsdl, 'sName' => 'sWsdl', 'xParameter' => $_sWsdl));
		
		if ($_sServiceClass === NULL) {$_sServiceClass = 'classPG_SoapService';}
		if ($_sMainServiceClass === NULL) {$_sMainServiceClass = 'classPG_SoapMainService';}
		if ($_bForceWsdl === NULL) {$_bForceWsdl = false;}
		
		if ((isset($_GET['wsdl'])) || ($_bForceWsdl == true))
		{
			return $this->buildWsdl(array('sServiceClass' => $_sServiceClass, 'sServerUrl' => NULL, 'sNameSpace' => NULL));
		}
		else
		{
			if ($this->oServer == NULL) {$this->init(array('sWsdl' => $_sWsdl, 'axOptions' => $_axOptions));}
			if ($this->oServer)
			{
				if ($_sMainServiceClass != NULL) {$this->setSoapClass(array('sClass' => $_sMainServiceClass, 'axParameters' => $_axMainServiceParams));}
				if ($_oMainServiceObject != NULL) {$this->setSoapObject(array('oObject' => $_oMainServiceObject, 'axParameters' => $_axMainServiceParams));}
				if ($_asFunctions != NULL) {$this->addSoapFunctions(array('asFunctions' => $_asFunctions));}
				return $this->execute(array('sRequest' => $_sRequest));
			}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sXml [type]string[/type]
	[en]...[/en]
	
	@param oMethod [needed][type]object[/type]
	[en]...[/en]
	*/
	public function buildWsdlMethodMessages($_oMethod)
	{
		$_oMethod = $this->getRealParameter(array('oParameters' => $_oMethod, 'sName' => 'oMethod', 'xParameter' => $_oMethod));

		$_sXml = '';
		if ($_oMethod)
		{
			$_sXml .= '<message name="'.$_oMethod->name.'Request">';
				foreach ($_oMethod->getParameters() as $_xParameterKey => $_oParameter)
				{
					$_sXml .= '<part name="'.$_oParameter->name.'" type="xsd:anyType"/>';
				}
			$_sXml .= '</message>';
			$_sXml .= '<message name="'.$_oMethod->name.'Response">';
				$_sXml .= '<part name="Result" type="xsd:anyType"/>';
			$_sXml .= '</message>';
		}
		return $_sXml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sXml [type]string[/type]
	[en]...[/en]
	
	@param oMethod [needed][type]object[/type]
	[en]...[/en]
	*/
	public function buildWsdlMethodPortTypeOperation($_oMethod)
	{
		$_oMethod = $this->getRealParameter(array('oParameters' => $_oMethod, 'sName' => 'oMethod', 'xParameter' => $_oMethod));

		$_sXml = '';
		if ($_oMethod)
		{
			$_sXml .= '<operation name="'.$_oMethod->name.'">';
				$_sXml .= '<input message="tns:'.$_oMethod->name.'Request"/>';
				$_sXml .= '<output message="tns:'.$_oMethod->name.'Response"/>';
			$_sXml .= '</operation>';
		}
		return $_sXml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sXml [type]string[/type]
	[en]...[/en]
	
	@param oMethod [needed][type]object[/type]
	[en]...[/en]
	*/
	public function buildWsdlMethodBindingOperation($_oMethod)
	{
		$_oMethod = $this->getRealParameter(array('oParameters' => $_oMethod, 'sName' => 'oMethod', 'xParameter' => $_oMethod));

		$_sXml = '';
		if ($_oMethod)
		{
			$_sXml .= '<operation name="'.$_oMethod->name.'">';
				$_sXml .= '<soap:operation soapAction="urn:xmethods-delayed-quotes#'.$_oMethod->name.'"/>';
				$_sXml .= '<input>';
					$_sXml .= '<soap:body use="encoded" namespace="urn:xmethods-delayed-quotes" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>';
				$_sXml .= '</input>';
				$_sXml .= '<output>';
					$_sXml .= '<soap:body use="encoded" namespace="urn:xmethods-delayed-quotes" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>';
				$_sXml .= '</output>';
			$_sXml .= '</operation>';
		}
		return $_sXml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sWsdlXml [type]string[/type]
	[en]...[/en]
	
	@param sServiceClass [type]string[/type]
	[en]...[/en]
	
	@param sServerUrl [type]string[/type]
	[en]...[/en]
	
	@param sNameSpace [type]string[/type]
	[en]...[/en]
	*/
	public function buildWsdl($_sServiceClass = NULL, $_sServerUrl = NULL, $_sNameSpace = NULL)
	{
		global $_SERVER;
	
		$_sServerUrl = $this->getRealParameter(array('oParameters' => $_sServiceClass, 'sName' => 'sServerUrl', 'xParameter' => $_sServerUrl));
		$_sNameSpace = $this->getRealParameter(array('oParameters' => $_sServiceClass, 'sName' => 'sNameSpace', 'xParameter' => $_sNameSpace));
		$_sServiceClass = $this->getRealParameter(array('oParameters' => $_sServiceClass, 'sName' => 'sServiceClass', 'xParameter' => $_sServiceClass));

		if ($_sServiceClass === NULL) {$_sServiceClass = 'classPG_SoapService';}
		if ($_sNameSpace === NULL) {$_sNameSpace = $_sServiceClass;} // 'server';}
		// if ($_sServerUrl === NULL) {$_sServerUrl = 'http://127.0.0.1/soaptest/'.$_sNameSpace;} // http://127.0.0.1/soaptest/server.php
		// if ($_sServerUrl === NULL) {$_sServerUrl = 'http://127.0.0.1/soaptest/server.php';}
		if ($_sServerUrl === NULL) {$_sServerUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];}
		
		$_sXmlMethodMessages = '';
		$_sXmlPortTypeOperations = '';
		$_sXmlBindingOperations = '';
		
		$_oClass = new ReflectionClass($_sServiceClass);
		foreach ($_oClass->getMethods() as $_xMethodKey => $_oMethod)
		{
			if (!$_oMethod->isPublic()) {continue;}
			$_sXmlMethodMessages .= $this->buildWsdlMethodMessages(array('oMethod' => $_oMethod));
			$_sXmlPortTypeOperations .= $this->buildWsdlMethodPortTypeOperation(array('oMethod' => $_oMethod));
			$_sXmlBindingOperations .= $this->buildWsdlMethodBindingOperation(array('oMethod' => $_oMethod));
		}

		$_sXml = '';
		$_sXml .= '<?xml version="1.0" encoding="UTF-8" ?>';
		$_sXml .= '<definitions name="'.$_sNameSpace.'"';
			$_sXml .= ' targetNamespace="'.$_sServerUrl.'"';
			$_sXml .= ' xmlns:tns="'.$_sServerUrl.'"';
			$_sXml .= ' xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"';
			$_sXml .= ' xmlns:xsd="http://www.w3.org/2001/XMLSchema"';
			$_sXml .= ' xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"';
			$_sXml .= ' xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"';
			$_sXml .= ' xmlns="http://schemas.xmlsoap.org/wsdl/"';
		$_sXml .= '>';
		
			// Messages...
			$_sXml .= $_sXmlMethodMessages;
			
			// PortType...
			$_sXml .= '<portType name="'.$_sNameSpace.'PortType">';
				$_sXml .= $_sXmlPortTypeOperations;
			$_sXml .= '</portType>';
			
			// Binding...
			$_sXml .= '<binding name="'.$_sNameSpace.'Binding" type="tns:'.$_sNameSpace.'PortType">';
				$_sXml .= '<soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>';
				$_sXml .= $_sXmlBindingOperations;
			$_sXml .= '</binding>';

			// Service...
			$_sXml .= '<service name="'.$_sNameSpace.'Service">';
				$_sXml .= '<port name="'.$_sNameSpace.'Port" binding="tns:'.$_sNameSpace.'Binding">';
					$_sXml .= '<soap:address location="'.$_sServerUrl.'"/>';
				$_sXml .= '</port>';
			$_sXml .= '</service>';
			
		$_sXml .= '</definitions>';

		header('Content-Type: text/xml');
		header('Content-Length: '.strlen($_sXml));
		
		return $_sXml;
	}
	/* @end method */
}
/* @end class */
$oPGSoapServer = new classPG_SoapServer();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSoapServer', 'xValue' => $oPGSoapServer));}
?>