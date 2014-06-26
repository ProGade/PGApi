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
// http://www.youtube-nocookie.com/v/...
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_YouTubePlayer extends classPG_ClassBasics
{
	// Declarations...
	private $bDefaultAutoplay = false;
	private $bDefaultLoop = false;
	private $bDefaultAllowFullscreen = true;
	private $iDefaultHD = 1;
	private $bDefaultEnhancedGenieMenu = false;
	private $sDefaultColor1 = '';
	private $sDefaultColor2 = '';
	private $bDefaultBorder = false;
	private $bDefaultShowSearch = false;
	private $bDefaultShowInfo = false;
	private $bDefaultLoadPolicy = false;
	private $bDefaultLoadRelatedVideos = false;
	private $bDefaultDisableKeyboard = false;
	private $bDefaultEnableJsApi = false;
	private $sDefaultPlayerApiID = '';

	// Construct...
	public function __construct()
	{
		$this->setID('PG_YouTubePlayer');
	}
	
	// Methods...
	/*
	@start method
	@param bAutoplay
	*/
	public function setDefaultAutoplay($_bAutoplay) {$this->bDefaultAutoplay = $_bAutoplay;}
	/* @end method */

	/* @start method */
	public function getDefaultAutoplay() {return $this->bDefaultAutoplay;}
	/* @end method */

	/*
	@start method
	@param bLoop
	*/
	public function setDefaultLoop($_bLoop) {$this->bDefaultLoop = $_bLoop;}
	/* @end method */

	/* @start method */
	public function getDefaultLoop() {return $this->bDefaultLoop;}
	/* @end method */

	/*
	@start method
	@param bAllowFullscreen
	*/
	public function setDefaultAllowFullscreen($_bAllowFullscreen) {$this->bDefaultAllowFullscreen = $_bAllowFullscreen;}
	/* @end method */

	/* @start method */
	public function getDefaultAllowFullscreen() {return $this->bDefaultAllowFullscreen;}
	/* @end method */

	/*
	@start method
	@param iDefaultHD
	*/
	public function setDefaultHD($_iDefaultHD) {$this->iDefaultHD = $_iDefaultHD;}
	/* @end method */

	/* @start method */
	public function getDefaultHD() {return $this->iDefaultHD;}
	/* @end method */

	/*
	@start method
	@param bEnhancedGenieMenu
	*/
	public function setDefaultEnhancedGenieMenu($_bEnhancedGenieMenu) {$this->bDefaultEnhancedGenieMenu = $_bEnhancedGenieMenu;}
	/* @end method */

	/* @start method */
	public function getDefaultEnhancedGenieMenu() {return $this->bDefaultEnhancedGenieMenu;}
	/* @end method */

	/*
	@start method
	@param sColor
	*/
	public function setDefaultColor1($_sColor) {$this->sDefaultColor1 = $_sColor;}
	/* @end method */

	/* @start method */
	public function getDefaultColor1() {return $this->sDefaultColor1;}
	/* @end method */

	/*
	@start method
	@param sColor
	*/
	public function setDefaultColor2($_sColor) {$this->sDefaultColor2 = $_sColor;}
	/* @end method */

	/* @start method */
	public function getDefaultColor2() {return $this->sDefaultColor2;}
	/* @end method */

	/*
	@start method
	@param bBorder
	*/
	public function setDefaultBorder($_bBorder) {$this->bDefaultBorder = $_bBorder;}
	/* @end method */

	/* @start method */
	public function getDefaultBorder() {return $this->bDefaultBorder;}
	/* @end method */

	/*
	@start method
	@param bShowSearch
	*/
	public function setDefaultShowSearch($_bShowSearch) {$this->bDefaultShowSearch = $_bShowSearch;}
	/* @end method */

	/* @start method */
	public function getDefaultShowSearch() {return $this->bDefaultShowSearch;}
	/* @end method */

	/*
	@start method
	@param bShowInfo
	*/
	public function setDefaultShowInfo($_bShowInfo) {$this->bDefaultShowInfo = $_bShowInfo;}
	/* @end method */

	/* @start method */
	public function getDefaultShowInfo() {return $this->bDefaultShowInfo;}
	/* @end method */

	/*
	@start method
	@param bLoadPolicy
	*/
	public function setDefaultLoadPolicy($_bLoadPolicy) {$this->bDefaultLoadPolicy = $_bLoadPolicy;}
	/* @end method */

	/* @start method */
	public function getDefaultLoadPolicy() {return $this->bDefaultLoadPolicy;}
	/* @end method */

	/*
	@start method
	@param bLoadRelatedVideos
	*/
	public function setDefaultLoadRelatedVideos($_bLoadRelatedVideos) {$this->bDefaultLoadRelatedVideos = $_bLoadRelatedVideos;}
	/* @end method */

	/* @start method */
	public function getDefaultLoadRelatedVideos() {return $this->bDefaultLoadRelatedVideos;}
	/* @end method */

	/*
	@start method
	@param bDisableKeyboard
	*/
	public function setDefaultDisableKeyboard($_bDisableKeyboard) {$this->bDefaultDisableKeyboard = $_bDisableKeyboard;}
	/* @end method */

	/* @start method */
	public function getDefaultDisableKeyboard() {return $this->bDefaultDisableKeyboard;}
	/* @end method */

	/*
	@start method
	@param bEnableJsApi
	*/
	public function setDefaultEnableJSAPI($_bEnableJsApi) {$this->bDefaultEnableJsApi = $_bEnableJsApi;}
	/* @end method */

	/* @start method */
	public function getDefaultEnableJSAPI() {return $this->bDefaultEnableJsApi;}
	/* @end method */

	/*
	@start method
	@param sPlayerApiID
	*/
	public function setDefaultPlayerAPIID($_sPlayerApiID) {$this->sDefaultPlayerApiID = $_sPlayerApiID;}
	/* @end method */

	/* @start method */
	public function getDefaultPlayerAPIID() {return $this->sDefaultPlayerApiID;}
	/* @end method */

	/*
	@start method
	@param sPlayerID
	@param sSizeX
	@param sSizeY
	@param sVideoUrl
	@param bAutoplay
	@param bLoop
	@param bAllowFullscreen
	@param bBorder
	@param sColor1
	@param sColor2
	@param bEnhancedGenieMenu
	@param iStartAtSeconds
	@param iDefaultHD
	@param bShowSearch
	@param bShowInfo
	@param bLoadPolicy
	@param bLoadRelatedVideos
	@param bDisableKeyboard
	@param bEnableJsApi
	@param sPlayerApiID
	*/
	public function buildPlayer($_sPlayerID = NULL, $_sSizeX = NULL, $_sSizeY = NULL, $_sVideoUrl = NULL, $_bAutoplay = NULL, $_bLoop = NULL, $_bAllowFullscreen = NULL, 
								$_bBorder = NULL, $_sColor1 = NULL, $_sColor2 = NULL, $_bEnhancedGenieMenu = NULL, $_iStartAtSeconds = NULL,
								$_iDefaultHD = NULL, $_bShowSearch = NULL, $_bShowInfo = NULL, $_bLoadPolicy = NULL, $_bLoadRelatedVideos = NULL,
								$_bDisableKeyboard = NULL, $_bEnableJsApi = NULL, $_sPlayerApiID = NULL)
	{
		if ($_sPlayerID == NULL) {$_sPlayerID = $this->getNextID();}
	
		$_bFirstParameter = true;
		
		// Autoplay...
		if ($_bAutoplay !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bAutoplay == true) {$_sVideoUrl .= 'autoplay=1';} else {$_sVideoUrl .= 'autoplay=0';}
			$_bFirstParameter = false;
		}
		
		// RelatedVideos...
		if ($_bLoadRelatedVideos !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bLoadRelatedVideos == true) {$_sVideoUrl .= 'rel=1';} else {$_sVideoUrl .= 'rel=0';}
			$_bFirstParameter = false;
		}

		// Loop...
		if ($_bLoop !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bLoop == true) {$_sVideoUrl .= 'loop=1';} else {$_sVideoUrl .= 'loop=0';}
			$_bFirstParameter = false;
		}

		// Border...
		if ($_bBorder !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bBorder == true) {$_sVideoUrl .= 'border=1';} else {$_sVideoUrl .= 'border=0';}
			$_bFirstParameter = false;
		}
		
		// Color1...
		if (($_sColor1 !== NULL) && ($_sColor1 != ''))
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			$_sVideoUrl .= 'color1='.str_replace("#", "0x", $_sColor1);
			$_bFirstParameter = false;
		}

		// Color2...
		if (($_sColor2 !== NULL) && ($_sColor2 != ''))
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			$_sVideoUrl .= 'color2='.str_replace("#", "0x", $_sColor2);
			$_bFirstParameter = false;
		}
		
		// Start...
		if (($_iStartAtSeconds !== NULL) && ($_iStartAtSeconds != 0))
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			$_sVideoUrl .= 'start='.$_iStartAtSeconds;
			$_bFirstParameter = false;
		}

		// Enhanced Genie Menu...
		if ($_bEnhancedGenieMenu !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bEnhancedGenieMenu == true) {$_sVideoUrl .= 'egm=1';} else {$_sVideoUrl .= 'egm=0';}
			$_bFirstParameter = false;
		}

		// Disable Keyboard...
		if ($_bDisableKeyboard !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bDisableKeyboard == true) {$_sVideoUrl .= 'disablekb=1';} else {$_sVideoUrl .= 'disablekb=0';}
			$_bFirstParameter = false;
		}

		// Enable JS API...
		if ($_bEnableJsApi !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bEnableJsApi == true) {$_sVideoUrl .= 'enablejsapi=1';} else {$_sVideoUrl .= 'enablejsapi=0';}
			$_bFirstParameter = false;
		}

		// Player API ID...
		if (($_sPlayerApiID !== NULL) && ($_sPlayerApiID != ''))
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_sPlayerApiID == true) {$_sVideoUrl .= 'playerapiid=1';} else {$_sVideoUrl .= 'playerapiid=0';}
			$_bFirstParameter = false;
		}
		
		// Default HD Playback...
		if ($_iDefaultHD !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_iDefaultHD > 0) {$_sVideoUrl .= 'hd='.$_iDefaultHD;} else {$_sVideoUrl .= 'hd=0';}
			$_bFirstParameter = false;
		}
		
		// Showsearch..
		if ($_bShowSearch !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bShowSearch == true) {$_sVideoUrl .= 'showsearch=1';} else {$_sVideoUrl .= 'showsearch=0';}
			$_bFirstParameter = false;
		}
		
		// Showinfo...
		if ($_bShowInfo !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bShowInfo == true) {$_sVideoUrl .= 'showinfo=1';} else {$_sVideoUrl .= 'showinfo=0';}
			$_bFirstParameter = false;
		}
		
		// Load Policy...
		if ($_bLoadPolicy !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bLoadPolicy == true) {$_sVideoUrl .= 'iv_load_policy=1';} else {$_sVideoUrl .= 'iv_load_policy=3';}
			$_bFirstParameter = false;
		}
		
		// Fullscreen...
		if ($_bAllowFullscreen !== NULL)
		{
			if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
			if ($_bAllowFullscreen == true) {$_sVideoUrl .= 'fs=1';} else {$_sVideoUrl .= 'fs=0';}
			$_bFirstParameter = false;
		}
		
		if ($_bFirstParameter == true) {$_sVideoUrl .= '?';} else {$_sVideoUrl .= '&';}
		$_sVideoUrl .= 'version=2';

		$_sHTML = '';
		
		// Object...
		$_sHTML .= '<object id="'.$_sPlayerID.'_Object" width="'.$_sSizeX.'" height="'.$_sSizeY.'" border="0" style="border-width:0px;">';
		$_sHTML .= '<param name="movie" value="'.$_sVideoUrl.'" />';
		$_sHTML .= '<param name="border" value="0" />';
		if ($_bEnableJsApi == true) {$_sHTML .= '<param name="allowScriptAccess" value="always" />';}
		
		// Object Fullscreen...
		$_sHTML .= '<param name="allowFullScreen" value="';
		if ($_bAllowFullscreen == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= '" />';
		
		// Embed...
		$_sHTML .= '<embed id="'.$_sPlayerID.'_Embed" src="'.$_sVideoUrl.'" type="application/x-shockwave-flash" width="'.$_sSizeX.'" height="'.$_sSizeY.'" ';
		
		// Embed Fullscreen...
		$_sHTML .= 'allowfullscreen="';
		if ($_bAllowFullscreen == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= '" ';
		
		if ($_bEnableJsApi == true) {$_sHTML .= 'allowScriptAccess="always" ';}
		
		$_sHTML .= ' border="0" style="border-width:0px;"></embed>';
		$_sHTML .= '</object>';
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGYouTubePlayer = new classPG_YouTubePlayer();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGYouTubePlayer', 'xValue' => $oPGYouTubePlayer));}
?>