<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Feb 10 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Network extends classPG_ClassBasics
{
	private $bCheckForWebSockets = false;
	private $bUseWebSockets = false;
	private $oXmlWrite = NULL;
	private $oWebSockets = NULL;
	private $sData = '';
	
	public function __construct()
	{
		$this->setID(array('sID' => 'PGNetwork'));
		$this->initClassBasics();
		$this->init();
	}
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUseWebSockets [type]bool[/type]
	[en]...[/en]
	
	@param oXmlWrite [type]bool[/type]
	[en]...[/en]
	
	@param oWebSockets [type]bool[/type]
	[en]...[/en]
	*/
	public function init($_bUseWebSockets = NULL, $_oXmlWrite = NULL, $_oWebSockets = NULL)
	{
		global $oPGXmlWrite, $oPGWebSockets;

        $this->mps(array('oParameters' => $_bUseWebSockets));
		$_oXmlWrite = $this->mp(array('sName' => 'oXmlWrite', 'xParameter' => $_oXmlWrite));
		$_oWebSockets = $this->mp(array('sName' => 'oWebSockets', 'xParameter' => $_oWebSockets));
		$_bUseWebSockets = $this->mp(array('sName' => 'bUseWebSockets', 'xParameter' => $_bUseWebSockets));
		
		if (($_bUseWebSockets === NULL) && (isset($_REQUEST['iPGNetWebSockets']))) {if ($_REQUEST['iPGNetWebSockets'] == 1) {$_bUseWebSockets = true;} $_bUseWebSockets = false;}
		if (($_oXmlWrite === NULL) && (isset($oPGXmlWrite))) {$_oXmlWrite = $oPGXmlWrite;}
		if (($_oWebSockets === NULL) && (isset($oPGWebSockets))) {$_oWebSockets = $oPGWebSockets;}
		
		if (($_oWebSockets !== NULL) && ($this->bCheckForWebSockets == true)) {$this->bUseWebSockets = true;}
		if ($_oXmlWrite !== NULL) {$this->oXmlWrite = $_oXmlWrite;}
		if ($_oWebSockets !== NULL) {$this->oWebSockets = $_oWebSockets;}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useCheckForWebSockets($_bUse)
	{
        $this->mps(array('oParameters' => $_bUse));
		$_bUse = $this->mp(array('sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bCheckForWebSockets = $_bUse;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bCheckForWebSockets [type]bool[/type]
	[en]...[/en]
	*/
	public function isCheckForWebSockets() {return $this->bCheckForWebSockets;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]string[/type]
	[en]...[/en]
	*/
	public function useWebSockets($_bUse)
	{
        $this->mps(array('oParameters' => $_bUse));
		$_bUse = $this->mp(array('sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseWebSockets = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bUseWebSockets [type]bool[/type]
	[en]...[/en]
	*/
	public function isWebSockets() {return $this->bUseWebSockets;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param oXmlWrite [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setXmlWriteObject($_oXmlWrite)
	{
        $this->mps(array('oParameters' => $_oXmlWrite));
		$_oXmlWrite = $this->mp(array('sName' => 'oXmlWrite', 'xParameter' => $_oXmlWrite));
		$this->oXmlWrite = $_oXmlWrite;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return oXmlWrite [type]object[/type]
	[en]...[/en]
	*/
	public function getXmlWriteObject() {return $this->oXmlWrite;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param xContent [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function addData($_sName, $_xContent = NULL)
	{
        $this->mps(array('oParameters' => $_sName));
		$_xContent = $this->mp(array('sName' => 'xContent', 'xParameter' => $_xContent));
		$_sName = $this->mp(array('sName' => 'sName', 'xParameter' => $_sName));

		if (($this->bUseWebSockets == false) && ($this->oXmlWrite != NULL))
		{
			$this->oXmlWrite->addCDataTag(array('sTag' => $_sName, 'sText' => $_xContent, 'axAttributes' => NULL));
		}
		else
		{
			if ($this->sData != '') {$this->sData .= '&_[';}
			$this->sData .= $_sName.']_='.$_xContent;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sNetworkMessage [type]string[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	
	@param oNetworkUser [type]object[/type]
	[en]...[/en]
	*/
	public function send($_sParameters = NULL, $_oNetworkUser = NULL)
	{
        $this->mps(array('oParameters' => $_sParameters));
		$_oNetworkUser = $this->mp(array('sName' => 'oNetworkUser', 'xParameter' => $_oNetworkUser));
		$_sParameters = $this->mp(array('sName' => 'sParameters', 'xParameter' => $_sParameters));
		return $this->build(array('sParameters' => $_sParameters, 'oNetworkUser' => $_oNetworkUser));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sNetworkMessage [type]string[/type]
	[en]...[/en]
	
	@param sParameters [type]string[/type]
	[en]...[/en]
	
	@param oNetworkUser [type]object[/type]
	[en]...[/en]
	*/
	public function build($_sParameters = NULL, $_oNetworkUser = NULL)
	{
        $this->mps(array('oParameters' => $_sParameters));
		$_oNetworkUser = $this->mp(array('sName' => 'oNetworkUser', 'xParameter' => $_oNetworkUser));
		$_sParameters = $this->mp(array('sName' => 'sParameters', 'xParameter' => $_sParameters));

		if ($_sParameters != NULL)
		{
			$_axParameters = explode('&', $_sParameters);
			for ($i=0; $i<count($_axParameters); $i++)
			{
				$_axData = explode('=', $_axParameters[$i]);
				$this->addData($_axData[0], $_axData[1]);
			}
		}

		if (($this->bUseWebSockets == false) && ($this->oXmlWrite != NULL))
		{
			$this->oXmlWrite->putHeader();
			return $this->oXmlWrite->build();
		}
		else if ($this->oWebSockets != NULL)
		{
			return $this->oWebSockets->send(array('oNetworkUser' => $_oNetworkUser, 'sData' => $this->sData));
		}
	}
	/* @end method */
}
/* @end class */
$oPGNetwork = new classPG_Network();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGNetwork', 'xValue' => $oPGNetwork));}
?>