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
define('PG_FACEBOOKLIKE_LAYOUT_NORMAL', '');
define('PG_FACEBOOKLIKE_LAYOUT_BOXCOUNT', 'box_count');
define('PG_FACEBOOKLIKE_LAYOUT_BUTTONCOUNT', 'button_count');

define('PG_FACEBOOKLIKE_ACTION_NONE', '');
define('PG_FACEBOOKLIKE_ACTION_RECOMMEND', 'recommend');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_FacebookLike extends classPG_ClassBasics
{
	// Declarations...
	private $sUrl = '';
	private $sLayout = PG_FACEBOOKLIKE_LAYOUT_NORMAL;
	private $sAction = PG_FACEBOOKLIKE_ACTION_NONE;
	private $iSizeX = 50;
	private $bSendButton = false;
	private $bShowFaces = false;

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
	@param sLayout
	*/
	public function setLayout($_sLayout) {$this->sLayout = $_sLayout;}
	/* @end method */

	/* @start method */
	public function getLayout() {return $this->sLayout;}
	/* @end method */
	
	/*
	@start method
	@param sAction
	*/
	public function setAction($_sAction) {$this->sAction = $_sAction;}
	/* @end method */

	/* @start method */
	public function getAction() {return $this->sAction;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useSendButton($_bUse) {$this->bSendButton = $_bUse;}
	/* @end method */

	/* @start method */
	public function isSendButton() {return $this->bSendButton;}
	/* @end method */

	/*
	@start method
	@param bShow
	*/
	public function showFaces($_bShow) {$this->bShowFaces = $_bShow;}
	/* @end method */

	/* @start method */
	public function isShowFaces() {return $this->bShowFaces;}
	/* @end method */
	
	/*
	@start method
	@param sUrl
	@param iSizeX
	@param sLayout
	@param sAction
	@param bSendButton
	@param bShowFaces
	*/
	public function build($_sUrl = NULL, $_iSizeX = NULL, $_sLayout = NULL, $_sAction = NULL, $_bSendButton = NULL, $_bShowFaces = NULL)
	{
		if ($_sUrl === NULL) {$_sUrl = $this->sUrl;}
		if ($_iSizeX === NULL) {$_iSizeX = $this->iSizeX;}
		if ($_sLayout === NULL) {$_sLayout = $this->sLayout;}
		if ($_sAction === NULL) {$_sAction = $this->sAction;}
		if ($_bSendButton === NULL) {$_bSendButton = $this->bSendButton;}
		if ($_bShowFaces === NULL) {$_bShowFaces = $this->bShowFaces;}
		
		$_sHTML = '';
		
		$_sHTML .= '<fb:like ';
		if ($_sUrl != '') {$_sHTML .= 'href="'.$_sUrl.'" ';}
		if ($_bSendButton == true) {$_sHTML .= 'send="true" ';}
		if ($_sLayout != '') {$_sHTML .= 'layout="box_count" ';}
		$_sHTML .= 'width="'.$_iSizeX.'" ';
		if ($_bShowFaces == true) {$_sHTML .= 'show_faces="true" ';}
		if ($_sAction != '') {$_sHTML .= 'action="'.$_sAction.'" ';}
		$_sHTML .= '></fb:like>';
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGFacebookLike = new classPG_FacebookLike();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFacebookLike', 'xValue' => $oPGFacebookLike));}
?>