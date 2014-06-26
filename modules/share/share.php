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
define('PG_SHARE_BUILD_TYPE_HORIZONTAL', 'horizontal');
define('PG_SHARE_BUILD_TYPE_VERTICAL', 'vertical');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Share extends classPG_ClassBasics
{
	// Declarations...
	private $sUrlToShare = '';
	private $sTextToShare = '';
	
	private $sDeliciousShareOnUrl = '';
	private $sFacebookShareOnUrl = '';
	private $sLinkedInShareOnUrl = '';
	private $sMySpaceShareOnUrl = '';
	private $sTwitterShareOnUrl = '';
	private $sVZShareOnUrl = '';
	private $sMailShareOnUrl = '';

	private $bDeliciousShare = true;
	private $bFacebookShare = true;
	private $bLinkedInShare = true;
	private $bMailShare = true;
	private $bMySpaceShare = true;
	private $bTwitterShare = true;
	private $bVZShare = true;
	
	private $bShareLinkText = false;

	private $sBuildType = PG_SHARE_BUILD_TYPE_HORIZONTAL;
	
	// Construct...
	public function __construct()
	{
		$this->setText(array(
			'ShareOnDeliciousLinkText' => 'share on delicious',
			'ShareOnFacebookLinkText' => 'share on facebook',
			'ShareOnLinkedInLinkText' => 'share on linkedin',
			'ShareOnMySpaceLinkText' => 'share on myspace',
			'ShareOnTwitterLinkText' => 'share on twitter',
			'ShareOnVZLinkText' => 'share on vz',
			'ShareOnMailLinkText' => 'share on mail'
		));
	}
	
	// Methods...
	/*
	@start method
	@param sUrl
	*/
	public function setUrlToShare($_sUrl) {$this->sUrlToShare = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getUrlToShare() {return $this->sUrlToShare;}
	/* @end method */
	
	/*
	@start method
	@param sText
	*/
	public function setTextToShare($_sText) {$this->sTextToShare = $_sText;}
	/* @end method */

	/* @start method */
	public function getTextToShare() {return $this->sTextToShare;}
	/* @end method */
	
	/*
	@start method
	@param sUrl
	*/
	public function setDeliciousShareOnUrl($_sUrl) {$this->sDeliciousShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getDeliciousShareOnUrl() {return $this->sDeliciousShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param sUrl
	*/
	public function setFacebookShareOnUrl($_sUrl) {$this->sFacebookShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getFacebookShareOnUrl() {return $this->sFacebookShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param sUrl
	*/
	public function setLinkedInShareOnUrl($_sUrl) {$this->sLinkedInShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getLinkedInShareOnUrl() {return $this->sLinkedInShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param sUrl
	*/
	public function setMySpaceShareOnUrl($_sUrl) {$this->sMySpaceShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getMySpaceShareOnUrl() {return $this->sMySpaceShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param sUrl
	*/
	public function setTwitterShareOnUrl($_sUrl) {$this->sTwitterShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getTwitterShareOnUrl() {return $this->sTwitterShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param sUrl
	*/
	public function setVZShareOnUrl($_sUrl) {$this->sVZShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getVZShareOnUrl() {return $this->sVZShareOnUrl;}
	/* @end method */

	/*
	@start method
	@param bUse
	*/
	public function useDeliciousShare($_bUse) {$this->bDeliciousShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isDeliciousShare() {return $this->bDeliciousShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useFacebookShare($_bUse) {$this->bFacebookShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isFacebookShare() {return $this->bFacebookShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useLinkedInShare($_bUse) {$this->bLinkedInShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isLinkedInShare() {return $this->bLinkedInShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useMailShare($_bUse) {$this->bMailShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isMailShare() {return $this->bMailShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useMySpaceShare($_bUse) {$this->bMySpaceShare = $bUse;}
	/* @end method */

	/* @start method */
	public function isMySpaceShare() {return $this->bMySpaceShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useTwitterShare($_bUse) {$this->bTwitterShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isTwitterShare() {return $this->bTwitterShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useVZShare($_bUse) {$this->bVZShare = $_bUse;}
	/* @end method */

	/* @start method */
	public function isVZShare() {$this->bVZShare;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useShareLinkText($_bUse) {$this->bShareLinkText = $_bUse;}
	/* @end method */

	/* @start method */
	public function isShareLinkText() {return $this->bShareLinkText;}
	/* @end method */
	
	/*
	@start method
	@param sBuildType
	*/
	public function setBuildType($_sBuildType) {$this->sBuildType = $_sBuildType;}
	/* @end method */

	/* @start method */
	public function getBuildType() {return $this->sBuildType;}
	/* @end method */

	/*
	@start method
	@param sUrlToShare
	@param sTextToShare
	*/
	public function build($_sUrlToShare = NULL, $_sTextToShare = NULL)
	{
		global $oPGDeliciousShare, $oPGFacebookShare, $oPGLinkedInShare, $oPGMySpaceShare, $oPGTwitterShare, $oPGVZShare, $oPGMailShare, $oPGMail;

		if ($_sUrlToShare == NULL) {$_sUrlToShare = $this->sUrlToShare;}
		if ($_sTextToShare == NULL) {$_sTextToShare = $this->sTextToShare;}
		
		if (isset($oPGDeliciousShare))
		{
			if ($this->sDeliciousShareOnUrl != '') {$oPGDeliciousShare->setShareOnUrl($this->sDeliciousShareOnUrl);}
			$oPGDeliciousShare->useShareLinkText($this->bShareLinkText);
			$oPGDeliciousShare->setText('ShareLinkText', $this->getText('ShareOnDeliciousLinkText'));
		}
		
		if (isset($oPGFacebookShare))
		{
			if ($this->sFacebookShareOnUrl != '') {$oPGFacebookShare->setShareOnUrl($this->sFacebookShareOnUrl);}
			$oPGFacebookShare->useShareLinkText($this->bShareLinkText);
			$oPGFacebookShare->setText('ShareLinkText', $this->getText('ShareOnFacebookLinkText'));
		}
		
		if (isset($oPGLinkedInShare))
		{
			if ($this->sLinkedInShareOnUrl != '') {$oPGLinkedInShare->setShareOnUrl($this->sLinkedInShareOnUrl);}
			$oPGLinkedInShare->useShareLinkText($this->bShareLinkText);
			$oPGLinkedInShare->setText('ShareLinkText', $this->getText('ShareOnLinkedInLinkText'));
		}
		
		if (isset($oPGMySpaceShare))
		{
			if ($this->sMySpaceShareOnUrl != '') {$oPGMySpaceShare->setShareOnUrl($this->sMySpaceShareOnUrl);}
			$oPGMySpaceShare->useShareLinkText($this->bShareLinkText);
			$oPGMySpaceShare->setText('ShareLinkText', $this->getText('ShareOnMySpaceLinkText'));
		}
		
		if (isset($oPGTwitterShare))
		{
			if ($this->sTwitterShareOnUrl != '') {$oPGTwitterShare->setShareOnUrl($this->sTwitterShareOnUrl);}
			$oPGTwitterShare->useShareLinkText($this->bShareLinkText);
			$oPGTwitterShare->setText('ShareLinkText', $this->getText('ShareOnTwitterLinkText'));
		}
		
		if (isset($oPGVZShare))
		{
			if ($this->sVZShareOnUrl != '') {$oPGVZShare->setShareOnUrl($this->sVZShareOnUrl);}
			$oPGVZShare->useShareLinkText($this->bShareLinkText);
			$oPGVZShare->setText('ShareLinkText', $this->getText('ShareOnVZLinkText'));
		}
		
		if ((isset($oPGMail)) && (isset($oPGMailShare)))
		{
			if ($this->sMailShareOnUrl != '') {$oPGMailShare->setShareOnUrl($this->sMailShareOnUrl);}
			$oPGMailShare->useShareLinkText($this->bShareLinkText);
			$oPGMailShare->setText('ShareLinkText', $this->getText('ShareOnMailLinkText'));
		}
		
		$_sHTML = '';
		
		if ((isset($oPGDeliciousShare)) && ($this->bDeliciousShare == true))
		{
			$_sHTML .= $oPGDeliciousShare->build($_sUrlToShare, $_sTextToShare);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		if ((isset($oPGFacebookShare)) && ($this->bFacebookShare == true))
		{
			$_sHTML .= $oPGFacebookShare->build($_sUrlToShare, $_sTextToShare);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		if ((isset($oPGLinkedInShare)) && ($this->bLinkedInShare == true))
		{
			$_sHTML .= $oPGLinkedInShare->build($_sUrlToShare, $_sTextToShare);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}

		if ((isset($oPGMySpaceShare)) && ($this->bMySpaceShare == true))
		{
			$_sHTML .= $oPGMySpaceShare->build($_sUrlToShare, $_sTitleToShare = NULL, $_sTextToShare, $_sButtonType = NULL);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		if ((isset($oPGTwitterShare)) && ($this->bTwitterShare == true))
		{
			$_sHTML .= $oPGTwitterShare->build($_sUrlToShare, $_sTextToShare, $_sLanguage = NULL);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		if ((isset($oPGVZShare)) && ($this->bVZShare == true))
		{
			$_sHTML .= $oPGVZShare->build($_sUrlToShare, $_sTextToShare);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		if ((isset($oPGMail)) && (isset($oPGMailShare)) && ($this->bMailShare == true))
		{
			$_sHTML .= $oPGMailShare->build($_sUrlToShare, $_sTextToShare);
			if ($this->sBuildType == PG_SHARE_BUILD_TYPE_HORIZONTAL) {$_sHTML .= ' ';} else {$_sHTML .= '<br />';}
		}
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGShare = new classPG_Share();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGShare', 'xValue' => $oPGShare));}
?>