<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 06 2012
*/
define('PG_META_GOOGLEBOT_NOARCHIVE', 'noarchive');
define('PG_META_GOOGLEBOT_NOFOLLOW', 'nofollow');
define('PG_META_GOOGLEBOT_NOINDEX', 'noindex');
define('PG_META_GOOGLEBOT_NODP', 'NOODP');
define('PG_META_GOOGLEBOT_NOSNIPPET', 'nosnippet');

define('PG_META_CONTENT_TYPE_UTF8', 'UTF-8');
define('PG_META_CONTENT_TYPE_ISO', 'ISO-8859-1');

define('PG_META_VIEWPORT_DEVICE_WIDTH', 'device-width');
define('PG_META_VIEWPORT_DEVICE_HEIGHT', 'device-height');

/*
@start class
@param extern classPG_ClassBasics
*/
class classPG_Meta extends classPG_ClassBasics
{
	// Declarations...
	private $sMetaLanguage = '';
	
	private $sRobots = 'index, follow';
	private $sGoogleBot = '';

	private $sTitle = '';
	private $sDescription = '';
	private $sKeywords = '';
	private $sAuthor = '';
	private $sCopyright = '';
	private $sGenerator = '';
	private $sDate = '';
	
	private $bUseViewportConfig = true;
	private $sViewportWidthOption = PG_META_VIEWPORT_DEVICE_WIDTH;
	private $sViewportHeightOption = '';
	private $sViewportInitialScale = ''; // 1.0';
	private $sViewportMinimumScale = '';
	private $sViewportMaximumScale = '';
	private $bViewportUserScalable = true;
	
	private $sShortcutIcon = 'favicon.ico';
	
	private $sAppleTouchDefaultIcon = '';
	private $sAppleTouch57Icon = '';
	private $sAppleTouch72Icon = '';
	private $sAppleTouch114Icon = '';
	private $bAppleFullscreenMode = false;
	
	private $bFormatDetectionTelephone = true;
	
	private $sGoogleSiteVerification = '';

	private $sContentLanguage = 'de';
	private $sContentType = PG_META_CONTENT_TYPE_UTF8;
	private $iRefreshTimeout = -1;
	private $sRefreshUrl = '';
	private $sExpiresDate = '';
	private $sIECompatibleMode = '';
	private $bNoCache = false;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group Other
	*/
	public function resetAll()
	{
		$this->sMetaLanguage = '';
		
		$this->sRobots = 'index, follow';
	
		$this->sTitle = '';
		$this->sDescription = '';
		$this->sKeywords = '';
		$this->sAuthor = '';
		$this->sCopyright = '';
		$this->sGenerator = '';
		$this->sDate = '';
	
		$this->sContentLanguage = 'en-us';
		$this->sContentType = PG_META_CONTENT_TYPE_UTF8;
		$this->iRefreshTimeout = -1;
		$this->sRefreshUrl = '';
		$this->sExpiresDate = '';
		$this->sIECompatibleMode = '';
		$this->bNoCache = false;
	}
	/* @end method */

	/*
	@start method
	
	@group Language
	
	@param sMetaLanguage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMetaLanguage($_sMetaLanguage)
	{
		$_sMetaLanguage = $this->getRealParameter(array('oParameters' => $_sMetaLanguage, 'sName' => 'sMetaLanguage', 'xParameter' => $_sMetaLanguage));
		$this->sMetaLanguage = $_sMetaLanguage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param sRobots [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setRobots($_sRobots)
	{
		$_sRobots = $this->getRealParameter(array('oParameters' => $_sRobots, 'sName' => 'sRobots', 'xParameter' => $_sRobots));
		$this->sRobots = $_sRobots;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sTitle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setTitle($_sTitle)
	{
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sTitle, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$this->sTitle = $_sTitle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sDescription [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDescription($_sDescription)
	{
		$_sDescription = $this->getRealParameter(array('oParameters' => $_sDescription, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$this->sDescription = $_sDescription;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sKeywords [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setKeywords($_sKeywords)
	{
		$_sKeywords = $this->getRealParameter(array('oParameters' => $_sKeywords, 'sName' => 'sKeywords', 'xParameter' => $_sKeywords));
		$this->sKeywords = $_sKeywords;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Creator
	
	@param sAuthor [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAuthor($_sAuthor)
	{
		$_sAuthor = $this->getRealParameter(array('oParameters' => $_sAuthor, 'sName' => 'sAuthor', 'xParameter' => $_sAuthor));
		$this->sAuthor = $_sAuthor;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Creator
	
	@param sCopyright [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCopyright($_sCopyright)
	{
		$_sCopyright = $this->getRealParameter(array('oParameters' => $_sCopyright, 'sName' => 'sCopyright', 'xParameter' => $_sCopyright));
		$this->sCopyright = $_sCopyright;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Creator
	
	@param sGenerator [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setGenerator($_sGenerator)
	{
		$_sGenerator = $this->getRealParameter(array('oParameters' => $_sGenerator, 'sName' => 'sGenerator', 'xParameter' => $_sGenerator));
		$this->sGenerator = $_sGenerator;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sDate [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDate($_sDate)
	{
		$_sDate = $this->getRealParameter(array('oParameters' => $_sDate, 'sName' => 'sDate', 'xParameter' => $_sDate));
		$this->sDate = $_sDate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param iDate [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDateByUnixTimeStamp($_iDate)
	{
		$_iDate = $this->getRealParameter(array('oParameters' => $_iDate, 'sName' => 'iDate', 'xParameter' => $_iDate));
		$this->sDate = date("c", $_iDate); // 2001-12-15T08:49:37+02:00
	}
	/* @end method */

	/*
	@start method
	
	@group Viewport
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useViewportConfig($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseViewportConfig = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return bUseViewportConfig [type]bool[/type]
	[en]...[/en]
	*/
	public function isViewportConfig() {return $this->bUseViewportConfig;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param sOption [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setViewportWidthOption($_sOption)
	{
		$_sOption = $this->getRealParameter(array('oParameters' => $_sOption, 'sName' => 'sOption', 'xParameter' => $_sOption));
		$this->sViewportWidthOption = $_sOption;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return sViewportWidthOption [type]string[/type]
	[en]...[/en]
	*/
	public function getViewportWidthOption() {return $this->sViewportWidthOption;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param sOption [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setViewportHeightOption($_sOption)
	{
		$_sOption = $this->getRealParameter(array('oParameters' => $_sOption, 'sName' => 'sOption', 'xParameter' => $_sOption));
		$this->sViewportHeightOption = $_sOption;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return sViewportheightOption [type]string[/type]
	[en]...[/en]
	*/
	public function getViewportHeightOption() {return $this->sViewportHeightOption;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param sScale [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setViewportInitialScale($_sScale)
	{
		$_sScale = $this->getRealParameter(array('oParameters' => $_sScale, 'sName' => 'sScale', 'xParameter' => $_sScale));
		$this->sViewportInitialScale = $_sScale;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return sViewportInitialScale [type]string[/type]
	[en]...[/en]
	*/
	public function getViewportInitialScale() {return $this->sViewportInitialScale;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param sScale [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setViewportMinimumScale($_sScale)
	{
		$_sScale = $this->getRealParameter(array('oParameters' => $_sScale, 'sName' => 'sScale', 'xParameter' => $_sScale));
		$this->sViewportMinimumScale = $_sScale;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return sViewportMinimumScale [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getViewportMinimumScale() {return $this->sViewportMinimumScale;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param sScale [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setViewportMaximumScale($_sScale)
	{
		$_sScale = $this->getRealParameter(array('oParameters' => $_sScale, 'sName' => 'sScale', 'xParameter' => $_sScale));
		$this->sViewportMaximumScale = $_sScale;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return sViewportMaximumScale [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getViewportMaximumScale() {return $this->sViewportMaximumScale;}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@param bScalable [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useViewportUserScalable($_bScalable)
	{
		$_bScalable = $this->getRealParameter(array('oParameters' => $_bScalable, 'sName' => 'bScalable', 'xParameter' => $_bScalable));
		$this->bViewportUserScalable = $_bScalable;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Viewport
	
	@return bViewportUserScalable [type]bool[/type]
	[en]...[/en]
	*/
	public function isViewportUserScalable() {return $this->bViewportUserScalable;}
	/* @end method */

	/*
	@start method
	
	@group Icon
	
	@param sIconPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setShortcutIcon($_sIconPath)
	{
		$_sIconPath = $this->getRealParameter(array('oParameters' => $_sIconPath, 'sName' => 'sIconPath', 'xParameter' => $_sIconPath));
		$this->sShortcutIcon = $_sIconPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@return sShortcutIcon [type]string[/type]
	[en]...[/en]
	*/
	public function getShortcutIcon() {return $this->sShortcutIcon;}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@param sIconPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAppleTouchDefaultIcon($_sIconPath)
	{
		$_sIconPath = $this->getRealParameter(array('oParameters' => $_sIconPath, 'sName' => 'sIconPath', 'xParameter' => $_sIconPath));
		$this->sAppleTouchDefaultIcon = $_sIconPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@return sAppleTouchDefaultIcon [type]string[/type]
	[en]...[/en]
	*/
	public function getAppleTouchDefaultIcon() {return $this->sAppleTouchDefaultIcon;}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@param sIconPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAppleTouch57Icon($_sIconPath)
	{
		$_sIconPath = $this->getRealParameter(array('oParameters' => $_sIconPath, 'sName' => 'sIconPath', 'xParameter' => $_sIconPath));
		$this->sAppleTouch57Icon = $_sIconPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@return sAppleTouch57Icon [type]string[/type]
	*/
	public function getAppleTouch57Icon() {return $this->sAppleTouch57Icon;}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@param sIconPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAppleTouch72Icon($_sIconPath)
	{
		$_sIconPath = $this->getRealParameter(array('oParameters' => $_sIconPath, 'sName' => 'sIconPath', 'xParameter' => $_sIconPath));
		$this->sAppleTouch72Icon = $_sIconPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@return sAppleTouch72Icon [type]string[/type]
	[en]...[/en]
	*/
	public function getAppleTouch72Icon() {return $this->sAppleTouch72Icon;}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@param sIconPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAppleTouch114Icon($_sIconPath)
	{
		$_sIconPath = $this->getRealParameter(array('oParameters' => $_sIconPath, 'sName' => 'sIconPath', 'xParameter' => $_sIconPath));
		$this->sAppleTouch114Icon = $_sIconPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Icon
	
	@return sAppleTouch114Icon [type]string[/type]
	[en]...[/en]
	*/
	public function getAppleTouch114Icon() {return $this->sAppleTouch114Icon;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useAppleFullscreenMode($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAppleFullscreenMode = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return bAppleFullscreenMode [type]bool[/type]
	[en]...[/en]
	*/
	public function isAppleFullscreenMode() {return $this->bAppleFullscreenMode;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useFormatDetectionTelephone($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bFormatDetectionTelephone = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return bFormatDetectionTelephone [type]bool[/type]
	[en]...[/en]
	*/
	public function isFormatDetectionTelephone() {return $this->bFormatDetectionTelephone;}
	/* @end method */

	/*
	@start method
	
	@group Language
	
	@param sContentLanguage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContentLanguage($_sContentLanguage)
	{
		$_sContentLanguage = $this->getRealParameter(array('oParameters' => $_sContentLanguage, 'sName' => 'sContentLanguage', 'xParameter' => $_sContentLanguage));
		$this->sContentLanguage = $_sContentLanguage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param sContentType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContentType($_sContentType)
	{
		$_sContentType = $this->getRealParameter(array('oParameters' => $_sContentType, 'sName' => 'sContentType', 'xParameter' => $_sContentType));
		$this->sContentType = $_sContentType;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cache
	
	@param sExpiresDate [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setExpiresDate($_sExpiresDate)
	{
		$_sExpiresDate = $this->getRealParameter(array('oParameters' => $_sExpiresDate, 'sName' => 'sExpiresDate', 'xParameter' => $_sExpiresDate));
		$this->sExpiresDate = $_sExpiresDate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cache
	
	@param iExpiresDate [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setExpiresDateByUnixTimeStamp($_iExpiresDate)
	{
		$_iExpiresDate = $this->getRealParameter(array('oParameters' => $_iExpiresDate, 'sName' => 'iExpiresDate', 'xParameter' => $_iExpiresDate));
		$this->sExpiresDate = date("r", $_iExpiresDate); // Sat, 15 Dec 2001 12:00:00 GMT
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param sMode [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setIECompatibleMode($_sMode)
	{
		$_sMode = $this->getRealParameter(array('oParameters' => $_sMode, 'sName' => 'sMode', 'xParameter' => $_sMode));
		$this->sIECompatibleMode = $_sMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Cache
	
	@param bNoCache [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useNoCache($_bNoCache)
	{
		$_bNoCache = $this->getRealParameter(array('oParameters' => $_bNoCache, 'sName' => 'bNoCache', 'xParameter' => $_bNoCache));
		$this->bNoCache = $_bNoCache;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Refresh
	
	@param iRefreshTimeout [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setRefreshTimeout($_iRefreshTimeout)
	{
		$_iRefreshTimeout = $this->getRealParameter(array('oParameters' => $_iRefreshTimeout, 'sName' => 'iRefreshTimeout', 'xParameter' => $_iRefreshTimeout));
		$this->iRefreshTimeout = $_iRefreshTimeout;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Refresh
	
	@param sRefreshUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setRefreshUrl($_sRefreshUrl)
	{
		$_sRefreshUrl = $this->getRealParameter(array('oParameters' => $_sRefreshUrl, 'sName' => 'sRefreshUrl', 'xParameter' => $_sRefreshUrl));
		$this->sRefreshUrl = $_sRefreshUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Refresh
	
	@param iRefreshgTimeout [needed][type]int[/type]
	[en]...[/en]
	
	@param sRefreshUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setRefresh($_iRefreshTimeout, $_sRefreshUrl = NULL)
	{
		$_sRefreshUrl = $this->getRealParameter(array('oParameters' => $_iRefreshTimeout, 'sName' => 'sRefreshUrl', 'xParameter' => $_sRefreshUrl));
		$_iRefreshTimeout = $this->getRealParameter(array('oParameters' => $_iRefreshTimeout, 'sName' => 'iRefreshTimeout', 'xParameter' => $_iRefreshTimeout));

		$this->iRefreshTimeout = $_iRefreshTimeout;
		$this->sRefreshUrl = $_sRefreshUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMeta [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		$_sLineBreak = '';
		if ($this->isLineBreak() == true) {$_sLineBreak = $this->getLineBreak();}

		$_sHTML = '';
		
		if ($this->sContentType != '') {$_sHTML .= '<meta charset="'.$this->sContentType.'" />'.$_sLineBreak;}
		
		// meta http-equiv...
		if ($this->sContentType != '') {$_sHTML .= '<meta http-equiv="Content-Type" content="text/html; charset='.strtolower($this->sContentType).'" />'.$_sLineBreak;}
		if ($this->sContentLanguage != '') {$_sHTML .= '<meta http-equiv="content-language" content="'.$this->sContentLanguage.'" />'.$_sLineBreak;} // http://de.selfhtml.org/diverses/sprachenlaenderkuerzel.htm
		if ($this->sExpiresDate != '') {$_sHTML .= '<meta http-equiv="expires" content="'.$this->sExpiresDate.'" />'.$_sLineBreak;} // expires: Sat, 15 Dec 2001 12:00:00 GMT
		if ($this->bNoCache != '')
		{
			$_sHTML .= '<meta http-equiv="cache-control" content="no-cache" />'.$_sLineBreak;	// Anweisung an den Browser: keinen Cache benutzen, sondern von Originalseite laden.
			$_sHTML .= '<meta http-equiv="pragma" content="no-cache" />'.$_sLineBreak;			// An Proxy-Agenten: Datei bitte nicht auf Proxy-Server speichern!
		}
		if (($this->iRefreshTimeout >= 0) && ($this->sRefreshUrl != '')) {$_sHTML .= '<meta http-equiv="refresh" content="'.$this->iRefreshTimeout.'; URL='.$this->sRefreshUrl.'" />'.$_sLineBreak;}	// refresh
		if ($this->sIECompatibleMode != '') {$_sHTML .= '<meta http-equiv="X-UA-Compatible" content="IE='.$this->sIECompatibleMode.'" />'.$_sLineBreak;}

		// robots (index, noindex, follow, nofollow, noodp [no open directory], noydir [no yahoo dir])...
		if ($this->sRobots != '') {$_sHTML .= '<meta name="robots" content="'.$this->sRobots.'" />'.$_sLineBreak;}
		if ($this->sGoogleBot != '') {$_sHTML .= '<meta name="googlebot" content="'.$this->sGoogleBot.'" />'.$_sLineBreak;}

		// meta name...
		if ($this->sTitle != '')
		{
			$_sHTML .= '<meta name="title" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sTitle.'" />'.$_sLineBreak;
		}
		if ($this->sKeywords != '')
		{
			$_sHTML .= '<meta name="keywords" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sKeywords.'" />'.$_sLineBreak;
		}
		if ($this->sDescription != '')
		{
			$_sHTML .= '<meta name="description" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sDescription.'" />'.$_sLineBreak;
		}
		if ($this->sAuthor != '')
		{
			$_sHTML .= '<meta name="author" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sAuthor.'" />'.$_sLineBreak;
		}
		if ($this->sCopyright != '')
		{
			$_sHTML .= '<meta name="copyright" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sCopyright.'" />'.$_sLineBreak;
		}
		if ($this->sGenerator != '')
		{
			$_sHTML .= '<meta name="generator" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sGenerator.'" />'.$_sLineBreak;
		}
		if ($this->sDate != '') // date: 2001-12-15T08:49:37+02:00
		{
			$_sHTML .= '<meta name="date" ';
			if ($this->sMetaLanguage != '') {$_sHTML .= 'lang="'.$this->sMetaLanguage.'" ';}
			$_sHTML .= 'content="'.$this->sDate.'" />'.$_sLineBreak;
		}

		if ($this->sShortcutIcon != '')
		{
			$_sHTML .= '<link rel="icon" href="'.$this->sShortcutIcon.'" />'.$_sLineBreak;
			$_sHTML .= '<link rel="shortcut icon" href="'.$this->sShortcutIcon.'" />'.$_sLineBreak;
		}

		if ($this->sAppleTouchDefaultIcon != '') {$_sHTML .= '<link rel="apple-touch-icon" href="'.$this->sAppleTouchDefaultIcon.'" />'.$_sLineBreak;}
		if ($this->sAppleTouch57Icon != '') {$_sHTML .= '<link rel="apple-touch-icon" sizes="57x57" href="'.$this->sAppleTouch57Icon.'" />'.$_sLineBreak;}
		if ($this->sAppleTouch72Icon != '') {$_sHTML .= '<link rel="apple-touch-icon" sizes="72x72" href="'.$this->sAppleTouch72Icon.'" />'.$_sLineBreak;}
		if ($this->sAppleTouch114Icon != '') {$_sHTML .= '<link rel="apple-touch-icon" sizes="114x114" href="'.$this->sAppleTouch114Icon.'" />'.$_sLineBreak;}
		// <link rel="apple-touch-startup-image" href="/startup.png"> // 320 x 460 pixels!
		if ($this->bAppleFullscreenMode == true) {$_sHTML .= '<meta name="apple-mobile-web-app-capable" content="yes"/>'.$_sLineBreak;}
		
		if ($this->bFormatDetectionTelephone == false) {$_sHTML .= '<meta name="format-detection" content="telephone=no" />'.$_sLineBreak;}
		
		if ($this->sGoogleSiteVerification != '') {$_sHTML .= '<meta name="google-site-verification" content="'.$this->sGoogleSiteVerification.'" />'.$_sLineBreak;}
		if ($this->bUseViewportConfig == true)
		{
			$_sContent = '';
			if ($this->sViewportWidthOption != '') {$_sContent .= 'width='.$this->sViewportWidthOption;}
			if ($this->sViewportHeightOption != '') {$_sContent .= 'height='.$this->sViewportHeightOption;}
			if ($this->sViewportInitialScale != '') {if ($_sContent != '') {$_sContent .= ', ';} $_sContent .= 'initial-scale='.$this->sViewportInitialScale;}
			if ($this->sViewportMinimumScale != '') {if ($_sContent != '') {$_sContent .= ', ';} $_sContent .= 'minimum-scale='.$this->sViewportMinimumScale;}
			if ($this->sViewportMaximumScale != '') {if ($_sContent != '') {$_sContent .= ', ';} $_sContent .= 'maximum-scale='.$this->sViewportMaximumScale;}
			if ($_sContent != '') {$_sContent .= ', ';}
			if ($this->bViewportUserScalable == true) {$_sContent .= 'user-scalable=yes';}
			else {$_sContent .= 'user-scalable=no';}
			$_sHTML .= '<meta name="viewport" content="'.$_sContent.'" />'.$_sLineBreak;
		}

		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGMeta = new classPG_Meta();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMeta', 'xValue' => $oPGMeta));}
?>