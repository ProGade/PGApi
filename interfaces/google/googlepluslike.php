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
// http://www.google.com/webmasters/+1/button/
define('PG_GOOGLEPLUSLIKE_SIZE_TYPE_NONE', '');
define('PG_GOOGLEPLUSLIKE_SIZE_TYPE_SMALL', 'small');
define('PG_GOOGLEPLUSLIKE_SIZE_TYPE_MEDIUM', 'medium');
define('PG_GOOGLEPLUSLIKE_SIZE_TYPE_TALL', 'tall');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_GooglePlusLike
{
	// Declarations...
	private $sUrl = '';
	private $sJsCallBackFunction = '';
	private $iSizeType = PG_GOOGLEPLUSLIKE_SIZE_TYPE_NONE;
	private $bShowLikesCount = false;
	private $bParseExplicit = false;
	private $sLanguage = 'en-US';
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	@param sUrl
	*/
	public function setUrl($_sUrl) {$this->sUrl = $_sUrl;}
	/* @end method */

	/* @start method */
	public function getUrl() {return $this->sUrl;}
	/* @end method */
	
	/*
	@start method
	@param sCallBackFunction
	*/
	public function setJsCallBackFunction($_sCallBackFunction) {$this->sJsCallBackFunction = $_sCallBackFunction;}
	/* @end method */

	/* @start method */
	public function getJsCallBackFunction() {return $this->sJsCallBackFunction;}
	/* @end method */
	
	/*
	@start method
	@param iSizeType
	*/
	public function setSizeType($_iSizeType) {$this->iSizeType = $_iSizeType;}
	/* @end method */

	/* @start method */
	public function getSizeType() {return $this->iSizeType;}
	/* @end method */
	
	/*
	@start method
	@param bShow
	*/
	public function showLikesCount($_bShow) {$this->bShowLikesCount = $_bShow;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useParseExplicit($_bUse) {$this->bParseExplicit = $_bUse;}
	/* @end method */

	/*
	@start method
	@param bUse
	*/
	public function isParseExplicit($_bUse) {return $this->bParseExplicit;}
	/* @end method */

	/*
	@start method
	@param sLanguage
	*/
	public function setLanguage($_sLanguage) {$this->sLanguage = $_sLanguage;}
	/* @end method */

	/* @start method */
	public function getLanguage() {return $this->sLanguage;}
	/* @end method */
	
	/*
	@start method
	@param bParseExplicit
	@param sLanguage
	*/
	public function buildHead($_bParseExplicit = NULL, $_sLanguage = NULL)
	{
		if ($_bParseExplicit === NULL) {$_bParseExplicit = $this->bParseExplicit;}
		if ($_sLanguage === NULL) {$_sLanguage = $this->sLanguage;}
		
		$_sHTML = '';
		
		$_sHTML .= '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">';
		$_sHTML .= '{';
			$_sHTML .= 'lang:\''.$_sLanguage.'\'';
			if ($_bParseExplicit == true) {$_sHTML .= ', parsetags: \'explicit\'';}
		$_sHTML .= '}';
		$_sHTML .= '</script>';
		
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	@param sUrl
	@param bShowLikesCount
	@param iSizeType
	@param sJsCallBackFunction
	@param bParseExplicit
	*/
	public function build($_sUrl = NULL, $_bShowLikesCount = NULL, $_iSizeType = NULL, $_sJsCallBackFunction = NULL, $_bParseExplicit = NULL) // , $_sLanguage = NULL)
	{
		if ($_sUrl === NULL) {$_sUrl = $this->sUrl;}
		if ($_bShowLikesCount === NULL) {$_bShowLikesCount = $this->bShowLikesCount;}
		if ($_iSizeType == NULL) {$_iSizeType = $this->iSizeType;}
		if ($_sJsCallBackFunction === NULL) {$_sJsCallBackFunction = $this->sJsCallBackFunction;}
		if ($_bParseExplicit === NULL) {$_bParseExplicit = $this->bParseExplicit;}
				
		$_sHTML = '';
		
		$_sHTML .= '<g:plusone ';
		if ($_iSizeType != '') {$_sHTML .= 'size="'.$_iSizeType.'" ';}
		if ($_bShowLikesCount == false) {$_sHTML .= 'count="false" ';}
		if ($_sJsCallBackFunction != '') {$_sHTML .= 'callback="'.$_sJsCallBackFunction.'" ';}
		if ($_sUrl != '') {$_sHTML .= 'href="'.$_sUrl.'" ';}
		$_sHTML .= '>';
		$_sHTML .= '</g:plusone>';
		if ($_bParseExplicit == true) {$_sHTML .= '<script type="text/javascript">document.body.onload = function() {gapi.plusone.go();}</script>';}
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGGooglePlusLike = new classPG_GooglePlusLike();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGGooglePlusLike', 'xValue' => $oPGGooglePlusLike));}
?>