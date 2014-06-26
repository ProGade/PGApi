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

define('PG_SHOPWARE_REQUEST_METHOD_SELECT', 'GET');
define('PG_SHOPWARE_REQUEST_METHOD_UPDATE', 'PUT');
define('PG_SHOPWARE_REQUEST_METHOD_INSERT', 'POST');
define('PG_SHOPWARE_REQUEST_METHOD_DELETE', 'DELETE');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_ShopWare extends classPG_ClassBasics
{
	private $sHost = 'http://localhost/';
	private $oCurl = NULL;
	
	/*
	@start method
	*/
	public function init($_sHost = NULL, $_sApiUser = NULL, $_sApiKey = NULL)
	{
		$_sApiUser = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sApiUser', 'xParameter' => $_sApiUser));
		$_sApiKey = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sApiKey', 'xParameter' => $_sApiKey));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));

		if ($_sHost != NULL) {$this->sHost = rtrim($_sHost, '/').'/';}
		
		$this->oCurl = curl_init();
		curl_setopt($this->oCurl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->oCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->oCurl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
		curl_setopt($this->oCurl, CURLOPT_USERPWD, $_sApiUser.':'.$_sApiKey);
		curl_setopt($this->oCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function send($_sCall, $_sMethod = NULL, $_axData = NULL, $_axParameters = NULL)
	{
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$_axData = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axData', 'xParameter' => $_axData));
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		if ($_sMethod === NULL) {$_sMethod = PG_SHOPWARE_REQUEST_METHOD_SELECT;}
		if ($_axData === NULL) {$_axData = array();}
		if ($_axParameters === NULL) {$_axParameters = array();}
		
		$_sQuery = '';
		if (!empty($_axParameters)) {$_sQuery .= http_build_query($_axParameters);}
		$_sCall = rtrim($_sCall, '?').'?';
		$_sUrl = $this->sHost.$_sCall.$_sQuery;
		$_sData = json_encode($_axData);
		
		curl_setopt($this->oCurl, CURLOPT_URL, $_sUrl);
		curl_setopt($this->oCurl, CURLOPT_CUSTOMREQUEST, $_sMethod);
		curl_setopt($this->oCurl, CURLOPT_POSTFIELDS, $_sData);
		
		$_oResult = curl_exec($this->oCurl);
		$_sHttpCode = curl_getinfo($this->oCurl, CURLINFO_HTTP_CODE);
		
		return $this->convertResponse(array('oResult' => $_oResult, 'sHttpCode' => $_sHttpCode));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function convertResponse($_oResult, $_sHttpCode = NULL)
	{
		$_sHttpCode = $this->getRealParameter(array('oParameters' => $_oResult, 'sName' => 'sHttpCode', 'xParameter' => $_sHttpCode));
		$_oResult = $this->getRealParameter(array('oParameters' => $_oResult, 'sName' => 'oResult', 'xParameter' => $_oResult));

		// TODO: Error Handling!
		if (NULL === $_axResult = json_decode($_oResult, true)) {return NULL;}
		if (!isset($_axResult['success'])) {return NULL;}
		if (!$_axResult['success']) {return NULL;}
		if (isset($_axResult['data'])) {}
		
		return $_axResult;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function select($_sCall, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		return $this->send(array('sCall' => $_sCall, 'sMethod' => PG_SHOPWARE_REQUEST_METHOD_SELECT, 'axParameters' => $_axParameters));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function insert($_sCall, $_axData = NULL, $_axParameters = NULL)
	{
		$_axData = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axData', 'xParameter' => $_axData));
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		return $this->send(array('sCall' => $_sCall, 'sMethod' => PG_SHOPWARE_REQUEST_METHOD_INSERT, 'axData' => $_axData, 'axParameters' => $_axParameters));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function update($_sCall, $_axData = NULL, $_axParameters = NULL)
	{
		$_axData = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axData', 'xParameter' => $_axData));
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		return $this->send(array('sCall' => $_sCall, 'sMethod' => PG_SHOPWARE_REQUEST_METHOD_UPDATE, 'axData' => $_axData, 'axParameters' => $_axParameters));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function delete($_sCall, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		return $this->send(array('sCall' => $_sCall, 'sMethod' => PG_SHOPWARE_REQUEST_METHOD_DELETE, 'axParameters' => $_axParameters));
	}
	/* @end method */

	/*
	@start method
	*/
	public function insertProduct(
		$_sProductSku = NULL, 
		$_axCategories = NULL,
		$_sName = NULL,
		$_dPrice = NULL,
		$_sDescription = NULL,
		$_sShortDescription = NULL,
		$_bActive = NULL,
		$_xTax = NULL
	)
	{
		$_axParameters = NULL;
		
		$_axData = array();
		$_axData['name'] = $_sName;
		$_axData['description'] = $_sShortDescription;
		$_axData['descriptionLong'] = $_sDescription;
		if (is_int($_xTax)) {$_axData['taxId'] = $_xTax;}
		else if (is_string($_xTax)) {$_axData['tax'] = str_replace('%', '', $_xTax);}
		$_axData['active'] = $_bActive;
		
		$_axData['mainDetail'] = array();
		$_axData['mainDetail']['number'] = $_sProductSku;
		$_axData['mainDetail']['prices'] = array();
		$_axData['mainDetail']['prices'][] = array('customerGroupKey' => 'EK', 'price' => $_dPrice);
		
		$this->insert(array('sCall' => 'articles', 'axData' => $_axData, 'axParameters' => $_axParameters));
	}
	/* @end  method */
}
/* @end class */
$oPGShopWare = new classPG_ShopWare();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGShopWare', 'xValue' => $oPGShopWare));}
?>