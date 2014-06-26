<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_PayPalExpressCheckout extends classPG_ClassBasics
{
	private $sEnvironment = 'sandbox';			// 'sandbox' or 'beta-sandbox' or 'live'
	
	private $sPayPalApiVersion = '51.0';
	private $sPayPalApiUsername = '';
	private $sPayPalApiPassword = '';
	private $sPayPalApiSignature = '';
	private $sCertificateFile = '';
	
	private $sPaymentAmount = '0.00';
	private $sPaymentType = 'Authorization';	// 'Authorization' (Money available and permission to sale) or 'Sale' (buy and pay it now!) or 'Order' (buy it now and pay later)
	private $sCurrencyID = 'EUR';				// currency code ('USD', 'GBP', 'EUR', 'JPY', 'CAD', 'AUD')
	
	private $sSetCheckoutReturnUrl = '';
	private $sSetCheckoutCancelUrl = '';
	
	private $oProfile = NULL;

	/* @start method */
	public function init()
	{
		$_oHandler = & ProfileHandler_Array::getInstance(array(
					'username' => $this->sPayPalApiUsername,
					'certificateFile' => NULL,
					'subject' => NULL,
					'environment' => $this->sEnvironment));
		
		$_oProfileID = ProfileHandler::generateID();
		
		// $this->oProfile = & new APIProfile($_oProfileID, $_oHandler); // Deprecated!
		$this->oProfile = new APIProfile($_oProfileID, $_oHandler);
		$this->oProfile->setAPIUsername($this->sPayPalApiUsername);
		$this->oProfile->setAPIPassword($this->sPayPalApiPassword);
		$this->oProfile->setSignature($this->sPayPalApiSignature);
		$this->oProfile->setCertificateFile($this->sCertificateFile);
		$this->oProfile->setEnvironment($this->sEnvironment);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildForm()
	{
		$_sHTML = '';
		$_sHTML .= '<form action="index.php" method="post" target="_self">';
		$_sHTML .= '';
		$_sHTML .= '</form>';
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildSetCheckout()
	{
		$_oExpressCheckoutRequest =& PayPal::getType('SetExpressCheckoutRequestType');
		$_oExpressCheckoutRequest->setVersion($this->sPayPalApiVersion);

		$_oExpressCheckoutDetails =& PayPal::getType('SetExpressCheckoutRequestDetailsType');
		$_oExpressCheckoutDetails->setReturnURL($this->sSetCheckoutReturnUrl);
		$_oExpressCheckoutDetails->setCancelURL($this->sSetCheckoutCancelUrl);
		$_oExpressCheckoutDetails->setPaymentAction($this->sPaymentType);

		$_oAmtType =& PayPal::getType('BasicAmountType');
		$_oAmtType->setattr('currencyID', $this->sCurrencyID);
		$_oAmtType->setval($this->sPaymentAmount, 'iso-8859-1');
		
		$_oExpressCheckoutDetails->setOrderTotal($_oAmtType);
		$_oExpressCheckoutRequest->setSetExpressCheckoutRequestDetails($_oExpressCheckoutDetails);
		$_oCaller =& PayPal::getCallerServices($this->oProfile);
		$_oResponse = $_oCaller->SetExpressCheckout($_oExpressCheckoutRequest); // execute!

		switch($_oResponse->getAck())
		{
			case 'Success':
			case 'SuccessWithWarning':
				// Extract the response details.
				// Redirect to paypal.com.
				$_sToken = $_oResponse->getToken();
				$_sPayPalUrl = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$_sToken;
				if (("sandbox" === $this->sEnvironment) || ("beta-sandbox" === $this->sEnvironment))
				{
					$_sPayPalUrl = 'https://www.'.$this->sEnvironment.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$_sToken;
				}
				header('Location: '.$_sPayPalUrl);
			exit;
		
			default:
				$_sHTML .= 'SetExpressCheckout failed: ' . print_r($_oResponse, true);
		}
		return $_sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildGetCheckout()
	{
		$_sHTML = '';
		
		$_oExpressCheckoutRequest =& PayPal::getType('GetExpressCheckoutDetailsRequestType');
		$_oExpressCheckoutRequest->setVersion($this->sPayPalApiVersion);
		
		/**
		* This example assumes that the token is in the return URL in the SetExpressCheckout API call.
		* The PayPal website redirects the user to this page with a token.
		*/
		if(!array_key_exists('token', $_REQUEST)) {$_sHTML .= 'Token is not received.';}
		
		// Set request-specific fields.
		$_sToken = htmlspecialchars($_REQUEST['token']);
		$_oExpressCheckoutRequest->setToken($_sToken);
		
		$_oCaller =& PayPal::getCallerServices($this->oProfile);
		
		// Execute SOAP request.
		$_oResponse = $_oCaller->GetExpressCheckoutDetails($_oExpressCheckoutRequest);
		
		switch($_oResponse->getAck())
		{
			case 'Success':
			case 'SuccessWithWarning':
				// Extract the response details.
				$_oResponseDetails = $_oResponse->getGetExpressCheckoutDetailsResponseDetails();
				
				$_oPayerInfo = $_oResponseDetails->getPayerInfo();
				$_sPayerID = $_oPayerInfo->getPayerID();
				
				$_oAddress = $_oPayerInfo->getAddress();
				$_sStreet1 = $_oAddress->getStreet1();
				$_sStreet2 = $_oAddress->getStreet2();
				$_sCityName = $_oAddress->getCityName();
				$_sStateOrProvince = $_oAddress->getStateOrProvince();
				$_sPostalCode = $_oAddress->getPostalCode();
				$_sCountryCode = $_oAddress->getCountryName();
				
				$_sHTML .= 'Express Checkout Get Details Completed Successfully: ' . print_r($_oResponse, true);
				break;
		
			default:
				$_sHTML .= 'GetExpressCheckoutDetails failed: ' . print_r($_oResponse, true);
		}
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sPayerID [needed][type]string[/type]
	[en]...[/en]
	
	@param sToken [needed][type]string[/type]
	[en]...[/en]
	*/
	public function buildDoCheckout($_sPayerID, $_sToken)
	{
		$_oExpressCheckoutRequest =& PayPal::getType('DoExpressCheckoutPaymentRequestDetailsType');
		$_oExpressCheckoutRequest->setVersion($this->sPayPalApiVersion);

		// $_sPayerID = "payer_id";
		// $_sToken = "token";

		$_sOrderTotal = $this->sCurrencyID.' '.$this->sPaymentAmount;

		$_oExpressCheckoutDetails->setToken($_sToken);
		$_oExpressCheckoutDetails->setPayerID($_sPayerID);
		$_oExpressCheckoutDetails->setPaymentAction($this->sPaymentType);
		
		$_oAmtType =& PayPal::getType('BasicAmountType');
		$_oAmtType->setattr('currencyID', $this->sCurrencyID);
		$_oAmtType->setval($this->sPaymentAmount, 'iso-8859-1');

		$_oPaymentDetails =& PayPal::getType('PaymentDetailsType');
		$_oPaymentDetails->setOrderTotal($amt_type); // amt_type???

		$_oExpressCheckoutDetails->setPaymentDetails($_oPaymentDetails);

		$_oExpressCheckoutRequest =& PayPal::getType('DoExpressCheckoutPaymentRequestType');
		$_oExpressCheckoutRequest->setDoExpressCheckoutPaymentRequestDetails($_oExpressCheckoutDetails);
		
		$_oCaller =& PayPal::getCallerServices($this->oProfile);
		$_oResponse = $caller->DoExpressCheckoutPayment($_oExpressCheckoutRequest); // execute!

		$_sHTML = '';
		switch ($_oResponse->getAck())
		{
			case 'Success':
			case 'SuccessWithWarning':
				// Extract the response details.
				$_oDetails = $response->getDoExpressCheckoutPaymentResponseDetails();
				$_oPaymentInfo = $_oDetails->getPaymentInfo();
				$_sTransactionID = $_oPaymentInfo->getTransactionID();
				
				$_oAmt = $payment_info->getGrossAmount();
				$_sAmt = $_oAmt->_value;
				$_sCurrencyID = $_oAmt->_attributeValues['currencyID'];
				$_sDisplayAmt = $_sCurrencyID.' '.$_sAmt;
				$_sHTML .= 'Express Checkout Payment Completed Successfully: ' . print_r($_oResponse, true);
				break;
			
			default:
				$_sHTML .= 'DoExpressCheckoutPayment failed: ' . print_r($_oResponse, true);
		}
		return $_sHTML;
	}
	/* @end method */
	
	/* @start method */
	public function build()
	{
	}
	/* @end method */
}
/* @end class */
$oPGPayPalExpressCheckout = new classPG_PayPalExpressCheckout();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGPayPalExpressCheckout', 'xValue' => $oPGPayPalExpressCheckout));}
?>