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
class classPG_Captcha extends classPG_ClassBasics
{
	// Declarations...
	private $sSecretKey1 = '6558';
	private $sSecretKey2 = '1775';

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCaptcha'));
		$this->setGfxSubPath(array('sPath' => 'captcha/'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param sImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharCount [type]int[/type]
	[en]...[/en]
	*/
	public function setNetworkMainData(&$_oObject, $_sImagePhpPath, $_iCharCount = NULL)
	{
		$_iCharCount = $this->getRealParameter(array('oParameters' => $_sImagePhpPath, 'sName' => 'iCharCount', 'xParameter' => $_iCharCount));
		$_sImagePhpPath = $this->getRealParameter(array('oParameters' => $_sImagePhpPath, 'sName' => 'sImagePhpPath', 'xParameter' => $_sImagePhpPath));

		if ($_iCharCount === NULL) {$_iCharCount = 4;}
		
		$_sCaptchaImage = '';
		$_sCaptcha = $this->getCaptchaCheckCodeKey($_sCaptchaImage, array('iCharCount' => $_iCharCount, 'sImagePhpPath' => $_sImagePhpPath));
		
		$_oObject->addNetworkData(array('sName' => 'PGCaptchaImage', 'xValue' => $_sCaptchaImage));
		$_oObject->addNetworkData(array('sName' => 'PGCaptcha', 'xValue' => $_sCaptcha));
	}
	/* @end method */
		
	/*
	@start method
	
	@return sKey [type]string[/type]
	[en]...[/en]
	
	@param sCodeImage [needed][type]string[/type]
	[en]...[/en]
	
	@param sImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharCount [type]int[/type]
	[en]...[/en]
	*/
	public function getCaptchaCheckCodeKey(&$_sCodeImage, $_sImagePhpPath, $_iCharCount = NULL)
	{
		global $oPGGfx;

		$_iCharCount = $this->getRealParameter(array('oParameters' => $_sImagePhpPath, 'sName' => 'iCharCount', 'xParameter' => $_iCharCount));
		$_sImagePhpPath = $this->getRealParameter(array('oParameters' => $_sImagePhpPath, 'sName' => 'sImagePhpPath', 'xParameter' => $_sImagePhpPath));
		
		if ($_iCharCount < 3) {$_iCharCount = 3;}
		mt_srand((double)microtime()*1000000);

		for ($i=0; $i<$_iCharCount; $i++)
		{
			$temp = floor(mt_rand(0, 9));
			if ($i == 0) {$_sCodeKey = $temp;}
			else {$_sCodeKey .= '*'.$temp;}
		}

		$_aiNumberSize = getimagesize($this->getGfxPathImages('0.jpg'));
		$_sCodeImage = '<img src="'.$_sImagePhpPath.'?x='.$this->encodeCaptchaKey(array('sCodeKey' => $_sCodeKey));
		$_sCodeImage .= '" width="'.($_iCharCount*$_aiNumberSize[0]).'" height="'.$_aiNumberSize[1].'" />';

		return md5(md5($this->sSecretKey1.str_replace('*', '', $_sCodeKey).$this->sSecretKey2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sInputKey [needed][type]string[/type]
	[en]...[/en]
	
	@param sCheckKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function checkCaptchaKey($_sInputKey, $_sCheckKey = NULL)
	{
		$_sCheckKey = $this->getRealParameter(array('oParameters' => $_sInputKey, 'sName' => 'sCheckKey', 'xParameter' => $_sCheckKey));
		$_sInputKey = $this->getRealParameter(array('oParameters' => $_sInputKey, 'sName' => 'sInputKey', 'xParameter' => $_sInputKey));
		if (md5(md5($this->sSecretKey1.$_sInputKey.$this->sSecretKey2)) == $_sCheckKey) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sEncodedKey [type]string[/type]
	[en]...[/en]
	
	@param sCodeKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function encodeCaptchaKey($_sCodeKey)
	{
		$_sCodeKey = $this->getRealParameter(array('oParameters' => $_sCodeKey, 'sName' => 'sCodeKey', 'xParameter' => $_sCodeKey));
		return str_replace('=', '|', base64_encode(base64_encode($_sCodeKey)));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDecodedKey [type]string[/type]
	[en]...[/en]
	
	@param sCodeKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function decodeCaptchaKey($_sCodeKey)
	{
		$_sCodeKey = $this->getRealParameter(array('oParameters' => $_sCodeKey, 'sName' => 'sCodeKey', 'xParameter' => $_sCodeKey));
		return base64_decode(base64_decode(str_replace('|', '=', $_sCodeKey)));
	}
	/* @end method */
	
	/*
	@start method
	
	@param sCodeKey [needed][type]string[/type]
	[en]...[/en]
	
	@param iKompression [type]int[/type]
	[en]...[/en]
	*/
	public function putCaptchaImage($_sCodeKey, $_iKompression = NULL)
	{
		global $oPGGfx;

		$_iKompression = $this->getRealParameter(array('oParameters' => $_sCodeKey, 'sName' => 'iKompression', 'xParameter' => $_iKompression));
		$_sCodeKey = $this->getRealParameter(array('oParameters' => $_sCodeKey, 'sName' => 'sCodeKey', 'xParameter' => $_sCodeKey));
		
		if ($_iKompression === NULL) {$_iKompression = 0;}
		if ($_iKompression <= 0) {$_iKompression = 80;}
		
		header('Content-type: image/jpeg');
	
		$_aiKeyNumber = explode('*', $_sCodeKey);
		if (count($_aiKeyNumber) < 2)
		{
			$_aiKeyNumber = explode('*', $this->decodeCaptchaKey(array('sCodeKey' => $_sCodeKey)));
		}
		$_aiNumberSize = getimagesize($this->getGfxPathImages('0.jpg'));

		if ($_oNewImage = imagecreatetruecolor(($_aiNumberSize[0]*count($_aiKeyNumber)), $_aiNumberSize[1]))
		{
			// generate code image...
			for ($i=0; $i<count($_aiKeyNumber); $i++)
			{
				$_iNewPosX = $_aiNumberSize[0] * $i;
				if ($_oNumberImage = imagecreatefromjpeg($this->getGfxPathImages($_aiKeyNumber[$i].'.jpg')))
				{
					imagecopyresized($_oNewImage, $_oNumberImage, $_iNewPosX, 0, 0, 0, $_aiNumberSize[0], $_aiNumberSize[1], $_aiNumberSize[0], $_aiNumberSize[1]);
				}
			}

			// output code image...
			imagejpeg($_oNewImage, '', $_iKompression);
			imagedestroy($_oNewImage);
		}
		clearstatcache();
	}
	/* @end method */
}
/* @end class */
$oPGCaptcha = new classPG_Captcha();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCaptcha', 'xValue' => $oPGCaptcha));}
?>