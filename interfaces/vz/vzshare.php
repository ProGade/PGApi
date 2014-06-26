<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 15 2012
*/
// http://developer.studivz.net/wiki/index.php/Sharing
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_VZShare extends classPG_ClassBasics
{
	// Declarations...
	private $sUrlToShare = '';
	private $sTextToShare = '';
	private $sShareOnUrl = 'http://platform-redirect.vz-modules.net/r/Link/Share/';
	private $sButtonImage = 'vz_share.png';
	private $iPopupWindowSizeX = 550;
	private $iPopupWindowSizeY = 370;
	private $bPopupScrollbars = true;
	private $bPopupResizeable = true;
	private $bShareLinkText = false;
	
	// Construct...
	public function __construct()
	{
		$this->initClassBasics();
		$this->setText(array(
			'ShareLinkText' => 'share on vz'
		));
	}
	
	// Methods...
	/*
	@start method
	@param sImage
	*/
	public function setButtonImage($_sImage) {$this->sButtonImage = $_sImage;}
	/* @end method */

	/* @start method */
	public function getButtonImage() {return $this->sButtonImage;}
	/* @end method */
	
	/*
	@start method
	@param sUrl
	*/
	public function setShareOnUrl($_sUrl) {$this->sShareOnUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getShareOnUrl() {return $this->sShareOnUrl;}
	/* @end method */
	
	/*
	@start method
	@param iSizeX
	*/
	public function setPopupWindowSizeX($_iSizeX) {$this->iPopupWindowSizeX = $_iSizeX;}
	/* @end method */

	/* @start method */
	public function getPopupWindowSizeX() {return $this->iPopupWindowSizeX;}
	/* @end method */
	
	/*
	@start method
	@param iSizeY
	*/
	public function setPopupWindowSizeY($_iSizeY) {$this->iPopupWindowSizeY = $_iSizeY;}
	/* @end method */

	/* @start method */
	public function getPopupWindowSizeY() {return $this->iPopupWindowSizeY;}
	/* @end method */
	
	/*
	@start method
	@param iSizeX
	@param iSizeY
	*/
	public function setPopupWindowSize($_iSizeX = NULL, $_iSizeY = NULL)
	{
		if ($_iSizeX != NULL) {$this->iPopupWindowSizeX = $_iSizeX;}
		if ($_iSizeY != NULL) {$this->iPopupWindowSizeY = $_iSizeY;}
	}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function usePopupScrollbars($_bUse) {$this->bPopupScrollbars = $_bUse;}
	/* @end method */

	/* @start method */
	public function isPopupScrollbars() {return $this->bPopupScrollbars;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function usePopupResizeable($_bUse) {$this->bPopupResizeable = $_bUse;}
	/* @end method */

	/* @start method */
	public function isPopupResizeable() {return $this->bPopupResizeable;}
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
	@param sUrlToShare
	@param sTextToShare
	*/
	public function build($_sUrlToShare = NULL, $_sTextToShare = NULL)
	{
		if ($_sUrlToShare == NULL) {$_sUrlToShare = $this->sUrlToShare;}
		if ($_sTextToShare == NULL) {$_sTextToShare = $this->sTextToShare;}
		
		$_sHTML = '';
		$_sHTML .= '<a href="javascript:;" onclick="oPGBrowser.popup(\'';
		$_sHTML .= $this->sShareOnUrl;
		$_sHTML .= '?url='.htmlentities(urlencode($_sUrlToShare));
		if (($_sTextToShare !== '') && ($_sTextToShare !== NULL)) {$_sHTML .= '&amp;title='.urlencode(utf8_encode($_sTextToShare));}
		// description
		// provider
		$_sHTML .= '\', '.$this->iPopupWindowSizeX.', '.$this->iPopupWindowSizeY.', \'vz_share\', ';
		if ($this->bPopupScrollbars == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= ', ';
		if ($this->bPopupResizeable == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= ');" ';
		$_sHTML .= 'target="_self">';
		$_sHTML .= '<img src="'.$this->getGfxPathImages($this->sButtonImage).'" style="border-width:0px;" />';
		if ($this->bShareLinkText == true) {$_sHTML .= ' '.$this->getText('ShareLinkText');}
		$_sHTML .= '</a>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGVZShare = new classPG_VZShare();
?>