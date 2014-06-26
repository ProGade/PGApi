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
class classPG_Curl extends classPG_ClassBasics
{
	// Declarations...
	private $sRequestUrl = '';
	private $sErrorUrl = '';
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setRequestUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sRequestUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	*/
	public function getRequestUrl() {return $this->sRequestUrl;}
	/* @end method */
	
	/*
	@start method
	
	@return axReturnParameters [type]mixed[][/type]
	[en]...[/en]
	
	@param sParameters [needed][type]string[/type]
	[en]...[/en]
	
	@param sRequestUrl [type]string[/type]
	[en]...[/en]
	
	@param sErrorUrl [type]string[/type]
	[en]...[/en]
	*/
	public function send($_sParameters = NULL, $_sRequestUrl = NULL, $_sErrorUrl = NULL)
	{
		$_sRequestUrl = $this->getRealParameter(array('oParameters' => $_sParameters, 'sName' => 'sRequestUrl', 'xParameter' => $_sRequestUrl));
		$_sErrorUrl = $this->getRealParameter(array('oParameters' => $_sParameters, 'sName' => 'sErrorUrl', 'xParameter' => $_sErrorUrl));
		$_sParameters = $this->getRealParameter(array('oParameters' => $_sParameters, 'sName' => 'sParameters', 'xParameter' => $_sParameters));

		if ($_sRequestUrl === NULL) {$_sRequestUrl = $this->sRequestUrl;}
		if ($_sErrorUrl === NULL) {$_sErrorUrl = $this->sErrorUrl;}
		
		$_oCUrl = curl_init();
		
		curl_setopt($_oCUrl, CURLOPT_URL, $_sRequestUrl);
		curl_setopt($_oCUrl, CURLOPT_VERBOSE, 1);
		curl_setopt($_oCUrl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($_oCUrl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($_oCUrl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($_oCUrl, CURLOPT_POST, 1);
		
		curl_setopt($_oCUrl, CURLOPT_POSTFIELDS, $_sParameters);
		
		$_sResponse = curl_exec($_oCUrl);
		$_axReturnParameters = $this->getParametersFromString($_sResponse);
		
		if (curl_errno($_oCUrl))
		{
			// moving to display page to display curl errors
			/*
			$_SESSION['curl_error_no'] = curl_errno($_oCUrl) ;
			$_SESSION['curl_error_msg'] = curl_error($_oCUrl);
			$_SESSION['s'.$this->getID().'TransactionStep'] = PG_PAYPAL_NVP_TRANSACTION_STEP_ERRORHANDLING;
			header('Location: '.$this->sErrorUrl);
			*/
			return false;
		}
		else {curl_close($_oCUrl);}
		
		return $_axReturnParameters;
	}
	/* @end method */

	/*
	@start method
	
	@return axParameters [type]mixed[][/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getParametersFromString($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		$_iIntial = 0;
		$_axParameters = array();

		while (strlen($_sString))
		{
			// postion of Key...
			$_iKeyPos = strpos($_sString, '=');
			
			// position of value...
			$_iValuePos = strpos($_sString, '&') ? strpos($_sString, '&'): strlen($_sString);
			
			// getting the Key and Value values and storing in a Associative Array...
			$_sParameterName = substr($_sString, $_iIntial, $_iKeyPos);
			$_sParameterValue = substr($_sString, $_iKeyPos+1, $_iValuePos-$_iKeyPos-1);
			
			// decoding the respose...
			$_axParameters[urldecode($_sParameterName)] = urldecode($_sParameterValue);
			$_sString = substr($_sString, $_iValuePos+1, strlen($_sString));
		}
		return $_axParameters;
	}
	/* @end method */
}
/* @end class */
$oPGCurl = new classPG_Curl();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCurl', 'xValue' => $oPGCurl));}
?>