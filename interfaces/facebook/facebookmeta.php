<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 10 2012
*/
// OpenGraph...
define('PG_FACEBOOKMETA_HTMLTAG_OPENGRAPH', 'xmlns:og="http://ogp.me/ns#"');
define('PG_FACEBOOKMETA_HTMLTAG_FACEBOOK', 'xmlns:fb="http://www.facebook.com/2008/fbml"');

// Activities...
define('PG_FACEBOOKMETA_TYPE_ACTIVITY', 'activity');
define('PG_FACEBOOKMETA_TYPE_SPORT', 'sport');

// Businesses...
define('PG_FACEBOOKMETA_TYPE_BAR', 'bar');
define('PG_FACEBOOKMETA_TYPE_COMPANY', 'company');
define('PG_FACEBOOKMETA_TYPE_CAFE', 'cafe');
define('PG_FACEBOOKMETA_TYPE_HOTEL', 'hotel');
define('PG_FACEBOOKMETA_TYPE_RESTAURANT', 'restaurant');

// Groups...
define('PG_FACEBOOKMETA_TYPE_CAUSE', 'cause');
define('PG_FACEBOOKMETA_TYPE_SPORTS_LEAGUE', 'sports_league');
define('PG_FACEBOOKMETA_TYPE_SPORTS_TEAM', 'sports_team');

// Organizations...
define('PG_FACEBOOKMETA_TYPE_BAND', 'band');
define('PG_FACEBOOKMETA_TYPE_GOVERNMENT', 'government');
define('PG_FACEBOOKMETA_TYPE_NON_PROFIT', 'non_profit');
define('PG_FACEBOOKMETA_TYPE_SCHOOL', 'school');
define('PG_FACEBOOKMETA_TYPE_UNIVERSITY', 'university');

// People...
define('PG_FACEBOOKMETA_TYPE_ACTOR', 'actor');
define('PG_FACEBOOKMETA_TYPE_ATHLETE', 'athlete');
define('PG_FACEBOOKMETA_TYPE_AUTHOR', 'author');
define('PG_FACEBOOKMETA_TYPE_DIRECTOR', 'director');
define('PG_FACEBOOKMETA_TYPE_MUSICIAN', 'musician');
define('PG_FACEBOOKMETA_TYPE_POLITICAN', 'politican');
define('PG_FACEBOOKMETA_TYPE_PUBLIC_FIGURE', 'public_figure');

// Places...
define('PG_FACEBOOKMETA_TYPE_CITY', 'city');
define('PG_FACEBOOKMETA_TYPE_COUNTRY', 'country');
define('PG_FACEBOOKMETA_TYPE_LANDMARK', 'landmark');
define('PG_FACEBOOKMETA_TYPE_STATE_PROVINCE', 'state_province');

// Productions and Entertainment...
define('PG_FACEBOOKMETA_TYPE_ALBUM', 'album');
define('PG_FACEBOOKMETA_TYPE_BOOK', 'book');
define('PG_FACEBOOKMETA_TYPE_DRINK', 'drink');
define('PG_FACEBOOKMETA_TYPE_FOOD', 'food');
define('PG_FACEBOOKMETA_TYPE_GAME', 'game');
define('PG_FACEBOOKMETA_TYPE_PRODUCT', 'product');
define('PG_FACEBOOKMETA_TYPE_SONG', 'song');
define('PG_FACEBOOKMETA_TYPE_MOVIE', 'movie');
define('PG_FACEBOOKMETA_TYPE_TV_SHOW', 'tv_show');

// Websites...
define('PG_FACEBOOKMETA_TYPE_BLOG', 'blog');
define('PG_FACEBOOKMETA_TYPE_WEBSITE', 'website');
define('PG_FACEBOOKMETA_TYPE_ARTICLE', 'article');

class classPG_FacebookMeta
{
	// Declarations...
	private $sTitle = '';
	private $sType = PG_FACEBOOKMETA_TYPE_WEBSITE;
	private $sUrl = '';
	private $sImage = '';
	private $sSiteName = '';
	private $sDescription = '';
	private $sFBAdminIDs = '';
	private $sFBAppID = '';

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
	public function setTitle($_sTitle) {$this->sTitle = $_sTitle;}
	public function setType($_sType) {$this->sType = $_sType;}
	public function setUrl($_sUrl) {$this->sUrl = $_sUrl;}
	public function setImage($_sImage) {$this->sImage = $_sImage;}
	public function setSiteName($_sSiteName) {$this->sSiteName = $_sSiteName;}
	public function setDescription($_sDescription) {$this->sDescription = $_sDescription;}
	public function setFBAdminIDs($_sFBAdminIDs) {$this->sFBAdminIDs = $_sFBAdminIDs;}
	public function setFBAppID($_sFBAppID) {$this->sFBAppID = $_sFBAppID;}
	
	// Location...
	public function setLocationLatitude($_vLocationLatitude) {$this->vLocationLatitude = $_vLocationLatitude;}
	public function setLocationLongitude($_vLocationLongitude) {$this->vLocationLongitude = $_vLocationLongitude;}
	public function setLocationStreetAddress($_sLocationStreetAddress) {$this->sLocationStreetAddress = $_sLocationStreetAddress;}
	public function setLocationLocality($_sLocationLocality) {$this->sLocationLocality = $_sLocationLocality;}
	public function setLocationRegion($_sLocationRegion) {$this->sLocationRegion = $_sLocationRegion;}
	public function setLocationPostalCode($_sLocationPostalCode) {$this->sLocationPostalCode = $_sLocationPostalCode;}
	public function setLocationCountryName($_sLocationCountryName) {$this->sLocationCountryName = $_sLocationCountryName;}
	
	// Contact information...
	public function setContactEmail($_sContactEmail) {$this->sContactEmail = $_sContactEmail;}
	public function setContactPhoneNumber($_sContactPhoneNumber) {$this->sContactPhoneNumber = $_sContactPhoneNumber;}
	public function setContactFaxNumber($_sContactFaxNumber) {$this->sContactFaxNumber = $_sContactFaxNumber;}

	// Video...
	public function setVideoFile($_sVideoFile) {$this->sVideoFile = $_sVideoFile;}
	public function setVideoHeight($_iVideoHeight) {$this->iVideoHeight = $_iVideoHeight;}
	public function setVideoWidth($_iVideoWidth) {$this->iVideoWidth = $_iVideoWidth;}
	public function setVideoType($_sVideoType) {$this->sVideoType = $_sVideoType;}
	
	public function setVideo($_sVideoFile, $_iVideoWidth, $_iVideoHeight, $_sVideoType)
	{
		if ($_sVideoFile !== NULL) {$this->sVideoFile = $_sVideoFile;}
		if ($_iVideoWidth !== NULL) {$this->iVideoWidth = $_iVideoWidth;}
		if ($_iVideoHeight !== NULL) {$this->iVideoHeight = $_iVideoHeight;}
		if ($_sVideoType !== NULL) {$this->sVideoType = $_sVideoType;}
	}
	
	// Audio...
	public function setAudioFile($_sAudioFile) {$this->sAudioFile = $_sAudioFile;}
	public function setAudioTitle($_sAudioTitle) {$this->sAudioTitle = $_sAudioTitle;}
	public function setAudioArtist($_sAudioArtist) {$this->sAudioArtist = $_sAudioArtist;}
	public function setAudioAlbum($_sAudioAlbum) {$this->sAudioAlbum = $_sAudioAlbum;}
	public function setAudioType($_sAudioType) {$this->sAudioType = $_sAudioType;}
	
	public function setAudio($_sAudioFile, $_sAudioTitle, $_sAudioArtist, $_sAudioAlbum, $_sAudioType)
	{
		if ($_sAudioFile !== NULL) {$this->sAudioFile = $_sAudioFile;}
		if ($_sAudioTitle !== NULL) {$this->sAudioTitle = $_sAudioTitle;}
		if ($_sAudioArtist !== NULL) {$this->sAudioArtist = $_sAudioArtist;}
		if ($_sAudioAlbum !== NULL) {$this->sAudioAlbum = $_sAudioAlbum;}
		if ($_sAudioType !== NULL) {$this->sAudioType = $_sAudioType;}
	}

	public function buildHTMLTag() {return '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">';}
	
	public function build()
	{
		$_sHTML = '';
		$_sExtended = '';
		if ($this->isLineBreak() == true) {$_sExtended .= $this->getLineBreak();}
		
		// Objects, Website...
		if ($this->sTitle != '') {$_sHTML .= '<meta property="og:title" content="'.$this->sTitle.'" />'.$_sExtended;}
		if ($this->sType != '') {$_sHTML .= '<meta property="og:type" content="'.$this->sType.'" />'.$_sExtended;}
		if ($this->sUrl != '') {$_sHTML .= '<meta property="og:url" content="'.$this->sUrl.'" />'.$_sExtended;}
		if ($this->sImage != '')
		{
			$_sHTML .= '<meta property="og:image" content="'.$this->sImage.'" />'.$_sExtended;
			$_sHTML .= '<link rel="image_src" href="'.$this->sImage.'" />'.$_sExtended;
		}
		if ($this->sSiteName != '') {$_sHTML .= '<meta property="og:site_name" content="'.$this->sSiteName.'" />'.$_sExtended;}
		if ($this->sDescription != '') {$_sHTML .= '<meta property="og:description" content="'.$this->sDescription.'" />'.$_sExtended;}
		if ($this->sFBAdminIDs != '') {$_sHTML .= '<meta property="fb:admins" content="'.$this->sFBAdminIDs.'" />'.$_sExtended;}
		if ($this->sFBAppID != '') {$_sHTML .= '<meta property="fb:app_id" content="'.$this->sFBAppID.'" />'.$_sExtended;}

		// Location...
		if ($this->vLocationLatitude !== NULL) {$_sHTML .= '<meta property="og:latitude" content="'.$this->vLocationLatitude.'" />'.$_sExtended;}
		if ($this->vLocationLongitude !== NULL) {$_sHTML .= '<meta property="og:longitude" content="'.$this->vLocationLongitude.'" />'.$_sExtended;}
		if ($this->sLocationStreetAddress != '') {$_sHTML .= '<meta property="og:street-address" content="'.$this->sLocationStreetAddress.'" />'.$_sExtended;}
		if ($this->sLocationLocality != '') {$_sHTML .= '<meta property="og:locality" content="'.$this->sLocationLocality.'" />'.$_sExtended;}
		if ($this->sLocationRegion != '') {$_sHTML .= '<meta property="og:region" content="'.$this->sLocationRegion.'" />'.$_sExtended;}
		if ($this->sLocationPostalCode != '') {$_sHTML .= '<meta property="og:postal-code" content="'.$this->sLocationPostalCode.'" />'.$_sExtended;}
		if ($this->sLocationCountryName != '') {$_sHTML .= '<meta property="og:country-name" content="'.$this->sLocationCountryName.'" />'.$_sExtended;}
		
		// Contact information...
		if ($this->sContactEmail != '') {$_sHTML .= '<meta property="og:email" content="'.$this->sContactEmail.'" />'.$_sExtended;}
		if ($this->sContactPhoneNumber != '') {$_sHTML .= '<meta property="og:phone_number" content="'.$this->sContactPhoneNumber.'" />'.$_sExtended;}
		if ($this->sContactFaxNumber != '') {$_sHTML .= '<meta property="og:fax_number" content="'.$this->sContactFaxNumber.'" />'.$_sExtended;}
		
		// Video...
		if ($this->sVideoFile != '') {$_sHTML .= '<meta property="og:video" content="'.$this->sVideoFile.'" />'.$_sExtended;}
		if ($this->iVideoHeight != 0) {$_sHTML .= '<meta property="og:video:height" content="'.$this->iVideoHeight.'" />'.$_sExtended;}
		if ($this->iVideoWidth != 0) {$_sHTML .= '<meta property="og:video:width" content="'.$this->iVideoWidth.'" />'.$_sExtended;}
		if ($this->sVideoType != '') {$_sHTML .= '<meta property="og:video:type" content="'.$this->sVideoType.'" />'.$_sExtended;}
       
		// Audio...
		if ($this->sAudioFile != '') {$_sHTML .= '<meta property="og:audio" content="'.$this->sAudioFile.'" />'.$_sExtended;}
		if ($this->sAudioTitle != '') {$_sHTML .= '<meta property="og:audio:title" content="'.$this->sAudioTitle.'" />'.$_sExtended;}
		if ($this->sAudioArtist != '') {$_sHTML .= '<meta property="og:audio:artist" content="'.$this->sAudioArtist.'" />'.$_sExtended;}
		if ($this->sAudioAlbum != '') {$_sHTML .= '<meta property="og:audio:album" content="'.$this->sAudioAlbum.'" />'.$_sExtended;}
		if ($this->sAudioType != '') {$_sHTML .= '<meta property="og:audio:type" content="'.$this->sAudioType.'" />'.$_sExtended;}

		return $_sHTML;
	}
}

$oPGFacebookMeta = new classPG_FacebookMeta();
?>