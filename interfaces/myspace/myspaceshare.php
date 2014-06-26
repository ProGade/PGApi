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
// http://wiki.developer.myspace.com/index.php?title=How_to_Add_Share_on_MySpace_to_Your_Site
/*
@start class
@param extends classPG_ClassBasics
*/
define('PG_MYSPCAESHARE_BUTTON_TYPE_NONE', '');
define('PG_MYSPCAESHARE_BUTTON_TYPE_16', 'Myspace_16.png');
define('PG_MYSPCAESHARE_BUTTON_TYPE_20', 'Myspace_20.png');
define('PG_MYSPCAESHARE_BUTTON_TYPE_32', 'Myspace_32.png');
define('PG_MYSPCAESHARE_BUTTON_TYPE_36', 'Myspace_36.png');
define('PG_MYSPCAESHARE_BUTTON_TYPE_SHARE', 'Myspace_btn_Share.png');
define('PG_MYSPCAESHARE_BUTTON_TYPE_SHARE_ON_MYSPACE', 'Myspace_btn_ShareOnMyspace.png');

class classPG_MySpaceShare extends classPG_ClassBasics
{
	// Declarations...
	private $sButtonImage = 'myspace_share.png';
	private $bShareLinkText = false;

	// Construct...
	public function __construct()
	{
		$this->initClassBasics();
		$this->setText(array(
			'ShareLinkText' => 'share on myspace'
		));
	}
	/* @end method */
	
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
	@param bUse
	*/
	public function useShareLinkText($_bUse) {$this->bShareLinkText = $_bUse;}
	/* @end method */

	/* @start method */
	public function isShareLinkText() {return $this->bShareLinkText;}
	/* @end method */
	
	/*
	@start method
	@param sUrlToShare
	@param sTitleToShare
	@param sTextToShare
	@param sButtonType
	*/
	public function build($_sUrlToShare = NULL, $_sTitleToShare = NULL, $_sTextToShare = NULL, $_sButtonType = NULL)
	{
		if ($_sUrlToShare === NULL) {$_sUrlToShare = '';}
		if ($_sTitleToShare === NULL) {$_sTitleToShare = '';}
		if ($_sTextToShare === NULL) {$_sTextToShare = '';}
		if ($_sButtonType === NULL) {$_sButtonType = PG_MYSPCAESHARE_BUTTON_TYPE_NONE;}
		
		$_sHTML = '';
		$_sHTML .= '<a href="javascript:;" onclick="';
		$_sHTML .= 'oPGMySpaceShare.share(\''.$_sUrlToShare.'\', \''.$_sTitleToShare.'\', \''.$_sTextToShare.'\');';
		$_sHTML .= '" target="_self">';
		$_sHTML .= '<img src="';
		if ($_sButtonType == PG_MYSPCAESHARE_BUTTON_TYPE_NONE) {$_sHTML .= $this->sButtonImage;}
		else {$_sHTML .= 'http://cms.myspacecdn.com/cms//ShareOnMySpace/'.$_sButtonType;}
		$_sHTML .= '" style="border-width:0px;" />';
		if ($this->bShareLinkText == true) {$_sHTML .= ' '.$this->getText('ShareLinkText');}
		$_sHTML .= '</a>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGMySpaceShare = new classPG_MySpaceShare();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMySpaceShare', 'xValue' => $oPGMySpaceShare));}
?>