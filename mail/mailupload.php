<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 14 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_MailUpload extends classPG_ClassBasics
{
	// Declarations...
	private $sUploadEmailAdress = 'upload@yourdomain.de';
	private $sUploadPath = 'uploads/';
	
	private $iPasswordLength = 8;
	private $sPasswordKey = NULL;
	private $sPasswordType = NULL;
	
	private $sAllowedMimeTypes = '';
	private $iMaxBytesPerFile = 0;
	private $iMaxLifeTimeHours = 24;
	
	// Construct...
	public function __construct()
	{
		$this->initClassBasics();
		$this->setText(
			array('xType' => 
				array(
					'UploadNowText' => 'jetzt hochladen'
				)
			)
		);
	}
	
	// Methods...
	/*
	@start method
	
	@param sEmail [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUploadEmailAdress($_sEmail)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		$this->sUploadEmailAdress = $_sEmail;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUploadEmailAdress [type]string[/type]
	[en]...[/en]
	*/
	public function getUploadEmailAdress() {return $this->sUploadEmailAdress;}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUploadPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sUploadPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUploadPath [type]string[/type]
	[en]...[/en]
	*/
	public function getUploadPath() {return $this->sUploadPath;}
	/* @end method */
	
	/*
	@start method
	
	@param iLength [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setPasswordLength($_iLength)
	{
		$_iLength = $this->getRealParameter(array('oParameters' => $_iLength, 'sName' => 'iLength', 'xParameter' => $_iLength));
		$this->iPasswordLength = $_iLength;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iPasswordLength [type]int[/type]
	[en]...[/en]
	*/
	public function getPasswordLength() {return $this->iPasswordLength;}
	/* @end method */
	
	/*
	@start method
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPasswordKey($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sPasswordKey = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sPasswordKey [type]string[/type]
	[en]...[/en]
	*/
	public function getPasswordKey() {return $this->sPasswordKey;}
	/* @end method */
	
	/*
	@start method
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPasswordType($_sType)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sType, 'sName' => 'sType', 'xParameter' => $_sType));
		$this->sPasswordType = $_sType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sPasswordType [type]string[/type]
	[en]...[/en]
	*/
	public function getPasswordType() {return $this->sPasswordType;}
	/* @end method */
	
	/*
	@start method
	
	@param sMimeTypes [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAllowedMimeTypes($_sMimeTypes)
	{
		$_sMimeTypes = $this->getRealParameter(array('oParameters' => $_sMimeTypes, 'sName' => 'sMimeTypes', 'xParameter' => $_sMimeTypes));
		$this->sAllowedMimeTypes = $_sMimeTypes;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sAllowedMimeTypes [type]string[/type]
	[en]...[/en]
	*/
	public function getAllowedMimeTypes() {return $this->sAllowedMimeTypes;}
	/* @end method */
	
	/*
	@start method
	
	@para iBytes [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMaxBytesPerFile($_iBytes)
	{
		$_iBytes = $this->getRealParameter(array('oParameters' => $_iBytes, 'sName' => 'iBytes', 'xParameter' => $_iBytes));
		$this->iMaxBytesPerFile = $_iSize;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMaxBytesPerFile [type]int[/type]
	[en]...[/en]
	*/
	public function getMaxBytesPerFile() {return $this->iMaxBytesPerFile;}
	/* @end method */
	
	/*
	@start method
	
	@param iHours [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMaxLifeTimeHours($_iHours)
	{
		$_iHours = $this->getRealParameter(array('oParameters' => $_iHours, 'sName' => 'iHours', 'xParameter' => $_iHours));
		$this->iMaxLifeTimeHours = $_iHours;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMaxLifeTimeHours [type]int[/type]
	[en]...[/en]
	*/
	public function getMaxLifeTimeHours() {return $this->iMaxLifeTimeHours;}
	/* @end method */
	
	// Database...
	// UploadID = Password
	// SubPath
	// AllowedMimeTypes
	// MaxBytesPerFile
	// MaxLifeTimeHours
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		global $oPGLogin;
		
		$_sSubject = '';
		$_sHtml = '';
		
		if (isset($oPGLogin))
		{
			if ($oPGLogin->isGuest())
			{
				$_sHtml .= 'Sie müssen sich einloggen um Dateien hochladen zu dürfen!<br />';
			}
			else
			{
				$_sSubject = md5(time().'_'.$oPGLogin->buildRandomPassword(array('iLength' => $this->iPasswordLength, 'sKey' => $this->sPasswordKey, 'sType' => $this->sPasswordType)));
				$_sHtml .= '<a href="mailto:'.$this->sUploadEmailAdress.'?subject='.$_sSubject.'">'.$this->getText(array('xType' => 'UploadNowText')).'</a>';
			}
		}
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGMailUpload = new classPG_MailUpload();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMailUpload', 'xValue' => $oPGMailUpload));}
?>