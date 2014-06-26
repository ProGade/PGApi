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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_FacebookFanBox extends classPG_ClassBasics
{
	// Declarations...
	private $sAppID = '';
	private $iConnectionCount = 12;
	private $iSizeX = 250;
	private $iSizeY = 350;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	@param sAppID
	*/
	public function setAppID($_sAppID) {$this->sAppID = $_sAppID;}
	/* @end method */

	/* @start method */
	public function getAppID() {return $this->sAppID;}
	/* @end method */
	
	/*
	@start method
	@param iCount
	*/
	public function setConnectionCount($_iCount) {$this->iConnectionCount = $_iCount;}
	/* @end method */

	/* @start method */
	public function getConnectionCount() {return $this->iConnectionCount;}
	/* @end method */
	
	/*
	@start method
	@param iSizeX
	*/
	public function setSizeX($_iSizeX) {$this->iSizeX = $_iSizeX;}
	/* @end method */

	/* @start method */
	public function getSizeX() {return $this->iSizeX;}
	/* @end method */

	/*
	@start method
	@param iSizeY
	*/
	public function setSizeY($_iSizeY) {$this->iSizeY = $_iSizeY;}
	/* @end method */

	/* @start method */
	public function getSizeY() {return $this->iSizeY;}
	/* @end method */
	
	/*
	@start method
	@param iSizeX
	@param iSizeY
	*/
	public function setSize($_iSizeX = NULL, $_iSizeY = NULL)
	{
		if ($_iSizeX !== NULL) {$this->iSizeX = $_iSizeX;}
		if ($_iSizeY !== NULL) {$this->iSizeY = $_iSizeY;}
	}
	/* @end method */

	/*
	@start method
	@param sAppID
	@param iConnectionCount
	@param iSizeX
	@param iSizeY
	*/
	public function build($_sAppID = NULL, $_iConnectionCount = NULL, $_iSizeX = NULL, $_iSizeY = NULL)
	{
		if ($_sAppID === NULL) {$_sAppID = $this->sAppID;}
		if ($_iSizeX === NULL) {$_iSizeX = $this->iSizeX;}
		if ($_iSizeY === NULL) {$_iSizeY = $this->iSizeY;}
		if ($_iConnectionCount === NULL) {$_iConnectionCount = $this->iConnectionCount;}
		
		$_sHTML = '';
		$_sHTML .= '<iframe frameborder="0" style="width:'.$_iSizeX.'px; height:'.$_iSizeY.'px;" ';
		$_sHTML .= 'src="http://www.facebook.com/plugins/fan.php?id='.$_sAppID;
		$_sHTML .= '&amp;width='.$_iSizeX;
		$_sHTML .= '&amp;height='.$_iSizeY;
		$_sHTML .= '&amp;connections='.$_iConnectionCount;
		$_sHTML .= '&amp;stream=false';
		$_sHTML .= '&amp;header=false"></iframe>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGFacebookFanBox = new classPG_FacebookFanBox();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFacebookFanBox', 'xValue' => $oPGFacebookFanBox));}
?>