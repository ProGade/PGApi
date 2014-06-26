<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 04 2012
*/
// Activities...
define('PG_OPENGRAPH_TYPE_ACTIVITY', 'activity');
define('PG_OPENGRAPH_TYPE_SPORT', 'sport');

// Businesses...
define('PG_OPENGRAPH_TYPE_BAR', 'bar');
define('PG_OPENGRAPH_TYPE_COMPANY', 'company');
define('PG_OPENGRAPH_TYPE_CAFE', 'cafe');
define('PG_OPENGRAPH_TYPE_HOTEL', 'hotel');
define('PG_OPENGRAPH_TYPE_RESTAURANT', 'restaurant');

// Groups...
define('PG_OPENGRAPH_TYPE_CAUSE', 'cause');
define('PG_OPENGRAPH_TYPE_SPORTS_LEAGUE', 'sports_league');
define('PG_OPENGRAPH_TYPE_SPORTS_TEAM', 'sports_team');

// Organizations...
define('PG_OPENGRAPH_TYPE_BAND', 'band');
define('PG_OPENGRAPH_TYPE_GOVERNMENT', 'government');
define('PG_OPENGRAPH_TYPE_NON_PROFIT', 'non_profit');
define('PG_OPENGRAPH_TYPE_SCHOOL', 'school');
define('PG_OPENGRAPH_TYPE_UNIVERSITY', 'university');

// People...
define('PG_OPENGRAPH_TYPE_ACTOR', 'actor');
define('PG_OPENGRAPH_TYPE_ATHLETE', 'athlete');
define('PG_OPENGRAPH_TYPE_AUTHOR', 'author');
define('PG_OPENGRAPH_TYPE_DIRECTOR', 'director');
define('PG_OPENGRAPH_TYPE_MUSICIAN', 'musician');
define('PG_OPENGRAPH_TYPE_POLITICAN', 'politican');
define('PG_OPENGRAPH_TYPE_PUBLIC_FIGURE', 'public_figure');

// Places...
define('PG_OPENGRAPH_TYPE_CITY', 'city');
define('PG_OPENGRAPH_TYPE_COUNTRY', 'country');
define('PG_OPENGRAPH_TYPE_LANDMARK', 'landmark');
define('PG_OPENGRAPH_TYPE_STATE_PROVINCE', 'state_province');

// Productions and Entertainment...
define('PG_OPENGRAPH_TYPE_ALBUM', 'album');
define('PG_OPENGRAPH_TYPE_BOOK', 'book');
define('PG_OPENGRAPH_TYPE_DRINK', 'drink');
define('PG_OPENGRAPH_TYPE_FOOD', 'food');
define('PG_OPENGRAPH_TYPE_GAME', 'game');
define('PG_OPENGRAPH_TYPE_PRODUCT', 'product');
define('PG_OPENGRAPH_TYPE_SONG', 'song');
define('PG_OPENGRAPH_TYPE_MOVIE', 'movie');
define('PG_OPENGRAPH_TYPE_TV_SHOW', 'tv_show');

// Websites...
define('PG_OPENGRAPH_TYPE_BLOG', 'blog');
define('PG_OPENGRAPH_TYPE_WEBSITE', 'website');
define('PG_OPENGRAPH_TYPE_ARTICLE', 'article');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_OpenGraph extends classPG_ClassBasics
{
	// Declarations...
	private $sTitle = '';
	private $sType = PG_OPENGRAPH_TYPE_WEBSITE;
	private $sUrl = '';
	private $sImage = '';
	private $sSiteName = '';
	private $sDescription = '';

	// Location...
	private $vLocationLatitude = NULL;
	private $vLocationLongitude = NULL;
	private $sLocationStreetAddress = '';
	private $sLocationLocality = '';
	private $sLocationRegion = '';
	private $sLocationPostalCode = '';
	private $sLocationCountryName = '';
	
	// Contact information...
	private $sContactEmail = '';
	private $sContactPhoneNumber = '';
	private $sContactFaxNumber = '';

	// Video...
	private $sVideoFile = '';
	private $iVideoHeight = 0;
	private $iVideoWidth = 0;
	private $sVideoType = '';
	
	// Audio...
	private $sAudioFile = '';
	private $sAudioTitle = '';
	private $sAudioArtist = '';
	private $sAudioAlbum = '';
	private $sAudioType = '';

	// Construct...
	public function __construct() {}
	
	// Methods...
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
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setType($_sType)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sType, 'sName' => 'sType', 'xParameter' => $_sType));
		$this->sType = $_sType;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImage($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImage = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@group General
	
	@param sSiteName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSiteName($_sSiteName)
	{
		$_sSiteName = $this->getRealParameter(array('oParameters' => $_sSiteName, 'sName' => 'sSiteName', 'xParameter' => $_sSiteName));
		$this->sSiteName = $_sSiteName;
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
	
	// Location...
	/*
	@start method
	
	@group Location
	
	@param vLocationLatitude [needed][type]number[/type]
	[en]...[/en]
	*/
	public function setLocationLatitude($_vLocationLatitude)
	{
		$_vLocationLatitude = $this->getRealParameter(array('oParameters' => $_vLocationLatitude, 'sName' => 'vLocationLatitude', 'xParameter' => $_vLocationLatitude));
		$this->vLocationLatitude = $_vLocationLatitude;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Location
	
	@param vLocationLongtitude [needed][type]number[/type]
	[en]...[/en]
	*/
	public function setLocationLongitude($_vLocationLongitude)
	{
		$_sLocationLocality = $this->getRealParameter(array('oParameters' => $_vLocationLongitude, 'sName' => 'vLocationLongitude', 'xParameter' => $_vLocationLongitude));
		$this->vLocationLongitude = $_vLocationLongitude;
	/* @end method */
	}
	
	/*
	@start method
	
	@group Location
	
	@param sLocationStreetAdress [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setLocationStreetAddress($_sLocationStreetAddress)
	{
		$_sLocationLocality = $this->getRealParameter(array('oParameters' => $_sLocationStreetAddress, 'sName' => 'sLocationStreetAddress', 'xParameter' => $_sLocationStreetAddress));
		$this->sLocationStreetAddress = $_sLocationStreetAddress;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Location
	
	@param sLocationLocality [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setLocationLocality($_sLocationLocality)
	{
		$_sLocationLocality = $this->getRealParameter(array('oParameters' => $_sLocationLocality, 'sName' => 'sLocationLocality', 'xParameter' => $_sLocationLocality));
		$this->sLocationLocality = $_sLocationLocality;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Location
	
	@param sLocationRegion [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setLocationRegion($_sLocationRegion)
	{
		$_sContactEmail = $this->getRealParameter(array('oParameters' => $_sLocationRegion, 'sName' => 'sLocationRegion', 'xParameter' => $_sLocationRegion));
		$this->sLocationRegion = $_sLocationRegion;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Location
	
	@param sLocationPostalCode [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setLocationPostalCode($_sLocationPostalCode)
	{
		$_sContactEmail = $this->getRealParameter(array('oParameters' => $_sLocationPostalCode, 'sName' => 'sLocationPostalCode', 'xParameter' => $_sLocationPostalCode));
		$this->sLocationPostalCode = $_sLocationPostalCode;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Location
	
	@param sLocationCountryName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setLocationCountryName($_sLocationCountryName)
	{
		$_sContactEmail = $this->getRealParameter(array('oParameters' => $_sLocationCountryName, 'sName' => 'sLocationCountryName', 'xParameter' => $_sLocationCountryName));
		$this->sLocationCountryName = $_sLocationCountryName;
	}
	/* @end method */
	
	// Contact information...
	/*
	@start method
	
	@group Contact
	
	@param sContactEmail [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContactEmail($_sContactEmail)
	{
		$_sContactEmail = $this->getRealParameter(array('oParameters' => $_sContactEmail, 'sName' => 'sContactEmail', 'xParameter' => $_sContactEmail));
		$this->sContactEmail = $_sContactEmail;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Contact
	
	@param sContactPhoneNumber [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContactPhoneNumber($_sContactPhoneNumber)
	{
		$_sContactPhoneNumber = $this->getRealParameter(array('oParameters' => $_sContactPhoneNumber, 'sName' => 'sContactPhoneNumber', 'xParameter' => $_sContactPhoneNumber));
		$this->sContactPhoneNumber = $_sContactPhoneNumber;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Contact
	
	@param sContactFaxNumber [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContactFaxNumber($_sContactFaxNumber)
	{
		$_sContactFaxNumber = $this->getRealParameter(array('oParameters' => $_sContactFaxNumber, 'sName' => 'sContactFaxNumber', 'xParameter' => $_sContactFaxNumber));
		$this->sContactFaxNumber = $_sContactFaxNumber;
	}
	/* @end method */

	// Video...
	/*
	@start method
	
	@group Video
	
	@param sVideoFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setVideoFile($_sVideoFile)
	{
		$_sVideoFile = $this->getRealParameter(array('oParameters' => $_sVideoFile, 'sName' => 'sVideoFile', 'xParameter' => $_sVideoFile));
		$this->sVideoFile = $_sVideoFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Video
	
	@param iVideoHeight [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setVideoHeight($_iVideoHeight)
	{
		$_iVideoHeight = $this->getRealParameter(array('oParameters' => $_iVideoHeight, 'sName' => 'iVideoHeight', 'xParameter' => $_iVideoHeight));
		$this->iVideoHeight = $_iVideoHeight;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Video
	
	@param iVideoWidth [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setVideoWidth($_iVideoWidth)
	{
		$_iVideoWidth = $this->getRealParameter(array('oParameters' => $_iVideoWidth, 'sName' => 'iVideoWidth', 'xParameter' => $_iVideoWidth));
		$this->iVideoWidth = $_iVideoWidth;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Video
	
	@param sVideoType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setVideoType($_sVideoType)
	{
		$_sVideoType = $this->getRealParameter(array('oParameters' => $_sVideoType, 'sName' => 'sVideoType', 'xParameter' => $_sVideoType));
		$this->sVideoType = $_sVideoType;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Video
	
	@param sVideoFile [type]string[/type]
	[en]...[/en]
	
	@param iVideoWidth [type]int[/type]
	[en]...[/en]
	
	@param iVideoHeight [type]int[/type]
	[en]...[/en]
	
	@param sVideoType [type]string[/type]
	[en]...[/en]
	*/
	public function setVideo($_sVideoFile, $_iVideoWidth = NULL, $_iVideoHeight = NULL, $_sVideoType = NULL)
	{
		$_iVideoWidth = $this->getRealParameter(array('oParameters' => $_sVideoFile, 'sName' => 'iVideoWidth', 'xParameter' => $_iVideoWidth));
		$_iVideoHeight = $this->getRealParameter(array('oParameters' => $_sVideoFile, 'sName' => 'iVideoHeight', 'xParameter' => $_iVideoHeight));
		$_sVideoType = $this->getRealParameter(array('oParameters' => $_sVideoFile, 'sName' => 'sVideoType', 'xParameter' => $_sVideoType));
		$_sVideoFile = $this->getRealParameter(array('oParameters' => $_sVideoFile, 'sName' => 'sVideoFile', 'xParameter' => $_sVideoFile));

		if ($_sVideoFile !== NULL) {$this->sVideoFile = $_sVideoFile;}
		if ($_iVideoWidth !== NULL) {$this->iVideoWidth = $_iVideoWidth;}
		if ($_iVideoHeight !== NULL) {$this->iVideoHeight = $_iVideoHeight;}
		if ($_sVideoType !== NULL) {$this->sVideoType = $_sVideoType;}
	}
	/* @end method */
	
	// Audio...
	/*
	@start method
	
	@group Audio
	
	@param sAudioFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAudioFile($_sAudioFile)
	{
		$_sAudioFile = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioFile', 'xParameter' => $_sAudioFile));
		$this->sAudioFile = $_sAudioFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Audio
	
	@param sAudioTitle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAudioTitle($_sAudioTitle)
	{
		$_sAudioTitle = $this->getRealParameter(array('oParameters' => $_sAudioTitle, 'sName' => 'sAudioTitle', 'xParameter' => $_sAudioTitle));
		$this->sAudioTitle = $_sAudioTitle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Audio
	
	@param sAudioArtist [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAudioArtist($_sAudioArtist)
	{
		$_sAudioArtist = $this->getRealParameter(array('oParameters' => $_sAudioArtist, 'sName' => 'sAudioArtist', 'xParameter' => $_sAudioArtist));
		$this->sAudioArtist = $_sAudioArtist;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Audio
	
	@param sAudioAlbum [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAudioAlbum($_sAudioAlbum)
	{
		$_sAudioAlbum = $this->getRealParameter(array('oParameters' => $_sAudioAlbum, 'sName' => 'sAudioAlbum', 'xParameter' => $_sAudioAlbum));
		$this->sAudioAlbum = $_sAudioAlbum;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Audio
	
	@param AudioType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setAudioType($_sAudioType)
	{
		$_sAudioType = $this->getRealParameter(array('oParameters' => $_sAudioType, 'sName' => 'sAudioType', 'xParameter' => $_sAudioType));
		$this->sAudioType = $_sAudioType;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Audio
	
	@param sAudioFile [type]string[/type]
	[en]...[/en]
	
	@param sAudioTitle [type]string[/type]
	[en]...[/en]
	
	@param sAudioArtist [type]string[/type]
	[en]...[/en]
	
	@param sAudioAlbum [type]string[/type]
	[en]...[/en]
	
	@param sAudioType [type]string[/type]
	[en]...[/en]
	*/
	public function setAudio($_sAudioFile, $_sAudioTitle = NULL, $_sAudioArtist = NULL, $_sAudioAlbum = NULL, $_sAudioType = NULL)
	{
		$_sAudioTitle = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioTitle', 'xParameter' => $_sAudioTitle));
		$_sAudioArtist = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioArtist', 'xParameter' => $_sAudioArtist));
		$_sAudioAlbum = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioAlbum', 'xParameter' => $_sAudioAlbum));
		$_sAudioType = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioType', 'xParameter' => $_sAudioType));
		$_sAudioFile = $this->getRealParameter(array('oParameters' => $_sAudioFile, 'sName' => 'sAudioFile', 'xParameter' => $_sAudioFile));

		if ($_sAudioFile !== NULL) {$this->sAudioFile = $_sAudioFile;}
		if ($_sAudioTitle !== NULL) {$this->sAudioTitle = $_sAudioTitle;}
		if ($_sAudioArtist !== NULL) {$this->sAudioArtist = $_sAudioArtist;}
		if ($_sAudioAlbum !== NULL) {$this->sAudioAlbum = $_sAudioAlbum;}
		if ($_sAudioType !== NULL) {$this->sAudioType = $_sAudioType;}
	}
	/* @end method */

	/*
	@start method
	
	@return sOpenGraph [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		$_sLineBreak = '';
		if ($this->isLineBreak() == true) {$_sLineBreak = $this->getLineBreak();}

		$_sHTML = '';
		
		// Objects, Website...
		if ($this->sTitle != '') {$_sHTML .= '<meta property="og:title" content="'.$this->sTitle.'" />'.$_sLineBreak;}
		if ($this->sType != '') {$_sHTML .= '<meta property="og:type" content="'.$this->sType.'" />'.$_sLineBreak;}
		if ($this->sUrl != '') {$_sHTML .= '<meta property="og:url" content="'.$this->sUrl.'" />'.$_sLineBreak;}
		if ($this->sImage != '')
		{
			$_sHTML .= '<meta property="og:image" content="'.$this->sImage.'" />'.$_sLineBreak;
			$_sHTML .= '<link rel="image_src" href="'.$this->sImage.'" />'.$_sLineBreak;
		}
		if ($this->sSiteName != '') {$_sHTML .= '<meta property="og:site_name" content="'.$this->sSiteName.'" />'.$_sLineBreak;}
		if ($this->sDescription != '') {$_sHTML .= '<meta property="og:description" content="'.$this->sDescription.'" />'.$_sLineBreak;}

		// Location...
		if ($this->vLocationLatitude !== NULL) {$_sHTML .= '<meta property="og:latitude" content="'.$this->vLocationLatitude.'" />'.$_sLineBreak;}
		if ($this->vLocationLongitude !== NULL) {$_sHTML .= '<meta property="og:longitude" content="'.$this->vLocationLongitude.'" />'.$_sLineBreak;}
		if ($this->sLocationStreetAddress != '') {$_sHTML .= '<meta property="og:street-address" content="'.$this->sLocationStreetAddress.'" />'.$_sLineBreak;}
		if ($this->sLocationLocality != '') {$_sHTML .= '<meta property="og:locality" content="'.$this->sLocationLocality.'" />'.$_sLineBreak;}
		if ($this->sLocationRegion != '') {$_sHTML .= '<meta property="og:region" content="'.$this->sLocationRegion.'" />'.$_sLineBreak;}
		if ($this->sLocationPostalCode != '') {$_sHTML .= '<meta property="og:postal-code" content="'.$this->sLocationPostalCode.'" />'.$_sLineBreak;}
		if ($this->sLocationCountryName != '') {$_sHTML .= '<meta property="og:country-name" content="'.$this->sLocationCountryName.'" />'.$_sLineBreak;}
		
		// Contact information...
		if ($this->sContactEmail != '') {$_sHTML .= '<meta property="og:email" content="'.$this->sContactEmail.'" />'.$_sLineBreak;}
		if ($this->sContactPhoneNumber != '') {$_sHTML .= '<meta property="og:phone_number" content="'.$this->sContactPhoneNumber.'" />'.$_sLineBreak;}
		if ($this->sContactFaxNumber != '') {$_sHTML .= '<meta property="og:fax_number" content="'.$this->sContactFaxNumber.'" />'.$_sLineBreak;}
		
		// Video...
		if ($this->sVideoFile != '') {$_sHTML .= '<meta property="og:video" content="'.$this->sVideoFile.'" />'.$_sLineBreak;}
		if ($this->iVideoHeight != 0) {$_sHTML .= '<meta property="og:video:height" content="'.$this->iVideoHeight.'" />'.$_sLineBreak;}
		if ($this->iVideoWidth != 0) {$_sHTML .= '<meta property="og:video:width" content="'.$this->iVideoWidth.'" />'.$_sLineBreak;}
		if ($this->sVideoType != '') {$_sHTML .= '<meta property="og:video:type" content="'.$this->sVideoType.'" />'.$_sLineBreak;}
       
		// Audio...
		if ($this->sAudioFile != '') {$_sHTML .= '<meta property="og:audio" content="'.$this->sAudioFile.'" />'.$_sLineBreak;}
		if ($this->sAudioTitle != '') {$_sHTML .= '<meta property="og:audio:title" content="'.$this->sAudioTitle.'" />'.$_sLineBreak;}
		if ($this->sAudioArtist != '') {$_sHTML .= '<meta property="og:audio:artist" content="'.$this->sAudioArtist.'" />'.$_sLineBreak;}
		if ($this->sAudioAlbum != '') {$_sHTML .= '<meta property="og:audio:album" content="'.$this->sAudioAlbum.'" />'.$_sLineBreak;}
		if ($this->sAudioType != '') {$_sHTML .= '<meta property="og:audio:type" content="'.$this->sAudioType.'" />'.$_sLineBreak;}

		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGOpenGraph = new classPG_OpenGraph();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGOpenGraph', 'xValue' => $oPGOpenGraph));}
?>