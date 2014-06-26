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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_FacebookLogin extends classPG_ClassBasics
{
	// Declarations...
	private $sAppID = '';
	private $sAppSecret = '';
	private $oFacebook = NULL;
	private $bLoggedIn = false;
	
	// Construct...
	
	// Methods...
	public function init($_sAppID, $_sAppSecret = NULL, $_oFacebook = NULL)
	{
		$_sAppSecret = $this->getRealParameter(array('oParameters' => $_sAppID, 'sName' => 'sAppSecret', 'xParameter' => $_sAppSecret));
		$_oFacebook = $this->getRealParameter(array('oParameters' => $_sAppID, 'sName' => 'oFacebook', 'xParameter' => $_oFacebook));
		$_sAppID = $this->getRealParameter(array('oParameters' => $_sAppID, 'sName' => 'sAppID', 'xParameter' => $_sAppID));
		
		if ($_sAppSecret != NULL) {$this->setAppSecret(array('sSecret' => $_sAppSecret));}
		$this->setAppID(array('sAppID' => $_sAppID));
		if ($_oFacebook != NULL) {$this->setFacebook(array('oFacebook' => $_oFacebook));}
	}
	
	public function setFacebook($_oFacebook = NULL)
	{
		$_oFacebook = $this->getRealParameter(array('oParameters' => $_oFacebook, 'sName' => 'oFacebook', 'xParameter' => $_oFacebook));
		$this->oFacebook = $_oFacebook;
		
		if ($this->oFacebook == NULL)
		{
			global $facebook;
			if (isset($facebook)) {$this->oFacebook = $facebook;}
			else {$this->oFacebook = new Facebook(array('appId' => $this->sAppID, 'secret' => $this->sAppSecret));}
			if ($this->getUserID()) {$this->bLoggedIn = true;}
		}
	}
	
	/*
	@start method
	@param sAppID
	*/
	public function setAppID($_sAppID)
	{
		$_sAppID = $this->getRealParameter(array('oParameters' => $_sAppID, 'sName' => 'sAppID', 'xParameter' => $_sAppID));
		$this->sAppID = $_sAppID;
		$this->setFacebook();
	}
	/* @end method */

	/* @start method */
	public function getAppID() {return $this->sAppID;}
	/* @end method */
	
	/*
	@start method
	@param sSecret
	*/
	public function setAppSecret($_sSecret)
	{
		$_sSecret = $this->getRealParameter(array('oParameters' => $_sSecret, 'sName' => 'sSecret', 'xParameter' => $_sSecret));
		$this->sAppSecret = $_sSecret;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function isLoggedIn()
	{
		return $this->bLoggedIn;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function getUserID()
	{
		if (!$this->oFacebook) {return false;}
		return $this->oFacebook->getUser();
	}
	/* @end method */
	
	/*
	public function getFacebookCookie($_sAppID = NULL, $_sAppSecret = NULL)
	{
		global $_COOKIE;
		
		if ($_sAppID === NULL) {$_sAppID = $this->sAppID;}
		if ($_sAppSecret === NULL) {$_sAppSecret = $this->sAppSecret;}

		if (isset($_COOKIE['fbsr_' . $_sAppID]))
		{
			$_axArgs = array();
			parse_str(trim($_COOKIE['fbsr_' . $_sAppID], '\\"'), $_axArgs);
			ksort($_axArgs);
			$_sPayLoad = '';
			foreach ($_axArgs as $_sKey => $_sValue)
			{
				if ($_sKey != 'sig') {$_sPayLoad .= $_sKey . '=' . $_sValue;}
			}
			if (md5($_sPayLoad . $_sAppSecret) != $_axArgs['sig']) {return NULL;}
			return $_axArgs;
		}
		return NULL;
	}
	*/
	
	/*
	@start method
	*/
	public function getUserData($_sRequest = NULL, $_sUser = NULL)
	{
		$_sUser = $this->getRealParameter(array('oParameters' => $_sRequest, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$_sRequest = $this->getRealParameter(array('oParameters' => $_sRequest, 'sName' => 'sRequest', 'xParameter' => $_sRequest));
		if ($_sUser == NULL) {$_sUser = 'me';}
		
		if ($_sUser != NULL)
		{
			try
			{
				// $_axUser = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$_axCookie['access_token']));
				$_sRequestUrl = '/'.$_sUser.'?access_token='.$this->oFacebook->getAccessToken();
				if ($_sRequest != NULL) {$_sRequestUrl .= '&'.$_sRequest;}
				$_axUser = $this->oFacebook->api($_sRequestUrl, 'GET');
				return $_axUser;
			}
			catch(FacebookApiException $_oException)
			{
				$this->bLoggedIn = false;
			}
		}
		return NULL;
	}
	/* @end method */
	
	public function sendFql($_sFql)
	{
		$_sFql = $this->getRealParameter(array('oParameters' => $_sFql, 'sName' => 'sFql', 'xParameter' => $_sFql));
		try
		{
			return $this->oFacebook->api(array('method' => 'fql.query', 'query' => $_sFql, 'access_token' => $this->oFacebook->getAccessToken()));
		}
		catch (FacebookApiException $_oException)
		{
			$this->bLoggedIn = false;
		}
		return NULL;
	}
	
	/*
	@start method
	@param sRequestPerms
	*/
	public function buildLoginButton($_sPerms = NULL)
	{
		if ($_sPerms === NULL) {$_sPerms = '';}
		
		$_sHTML = '';
		$_sHTML .= '<fb:login-button';
		if ($_sPerms != '') {$_sHTML .= ' perms="'.$_sPerms.'"';}
		$_sHTML .= '>Login with Facebook</fb:login-button>';
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	@param sRedirectUrl
	@param asUserDefinedFields
	*/
	public function buildRegisterForm($_sRedirectUrl = NULL, $_asUserDefinedFields = NULL)
	{
		if ($_sRedirectUrl === NULL) {$_sRedirectUrl = '';}
		if ($_asUserDefinedFields === NULL) {$_asUserDefinedFields = array();}
		
		$_sHTML = '';
		$_sHTML .= '<fb:registration ';
		$_sHTML .= 'fields="[{\'name\':\'name\'}, {\'name\':\'email\'}, ';
			for ($i=0; $i<count($_asUserDefinedFields); $i++)
			{
				if ($_asUserDefinedFields[$i]['type'] == '') {$_asUserDefinedFields[$i]['type'] = 'text';}
				$_sHTML .= '{';
					$_sHTML .= '\'name\':\''.$_asUserDefinedFields[$i]['name'].'\', '; // Variable: favorite_car
					$_sHTML .= '\'description\':\''.$_asUserDefinedFields[$i]['description'].'\', '; // Label: What is your favorite car?
					$_sHTML .= '\'type\':\''.$_asUserDefinedFields[$i]['type'].'\''; // Type: text
				$_sHTML .= '}';
			}
		$_sHTML .= ']"';
		if ($_sRedirectUrl != '') {$_sHTML .= ' redirect-uri="'.$_sRedirectUrl.'"';}
		$_sHTML .= '>';
		$_sHTML .= '</fb:registration>';
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	@param sLoginRequestPerms
	@param sRegisterRedirectUrl
	@param asRegisterUserDefinedFields
	*/
	public function build($_sPerms = NULL, $_sRegisterRedirectUrl = NULL, $_asRegisterUserDefinedFields = NULL)
	{
		$_sHTML = '';
		if (!$this->isLoggedIn()) {$_sHTML .= $this->buildLoginButton($_sPerms);}
		$_sHTML .= '<div id="fb-root"></div>';
		$_sHTML .= '<script>oPGFacebookLogin.init({"sAppID": "'.$this->sAppID.'"});</script>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGFacebookLogin = new classPG_FacebookLogin();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFacebookLogin', 'xValue' => $oPGFacebookLogin));}
?>