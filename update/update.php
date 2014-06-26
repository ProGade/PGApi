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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Update extends classPG_ClassBasics
{
	// Declarations...
	private $oDatabaseUpdate = NULL;
	private $oFolderUpdate = NULL;
	private $bAutorun = false;
	private $bJavaScriptAutoRegister = true;
	private $bDatabaseUpdate = true;
	private $bFolderUpdate = false;
	
	// Construct...
	public function __construct()
	{
		global $oPGFolderUpdate, $oPGDatabaseUpdate;
		$this->setID(array('sID' => 'PGUpdate'));
		
		if (isset($oPGFolderUpdate)) {$this->oFolderUpdate = $oPGFolderUpdate;}
		if (isset($oPGDatabaseUpdate)) {$this->oDatabaseUpdate = $oPGDatabaseUpdate;}
	}
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useAutorun($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAutorun = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return bAutorun [type]bool[/type]
	[en]...[/en]
	*/
	public function isAutorun() {return $this->bAutorun;}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useDatabaseUpdate($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bDatabaseUpdate = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@return bDatabaseUpdate [type]bool[/type]
	[en]...[/en]
	*/
	public function isDatabaseUpdate() {return $this->bDatabaseUpdate;}
	/* @end method */

	/*
	@start method
	
	@group Folder
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useFolderUpdate($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bFolderUpdate = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Folder
	
	@return bFolderUpdate [type]bool[/type]
	[en]...[/en]
	*/
	public function isFolderUpdate() {return $this->bFolderUpdate;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useJavaScriptAutoRegister($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bJavaScriptAutoRegister = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@return bJavaScriptAutoRegister [type]bool[/type]
	[en]...[/en]
	*/
	public function isJavaScriptAutoRegister() {return $this->bJavaScriptAutoRegister;}
	/* @end method */
	
	/*
	@start method
	
	@group Folder
	
	@param oFolderUpdate [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setFolderUpdate($_oFolderUpdate)
	{
		$_oFolderUpdate = $this->getRealParameter(array('oParameters' => $_oFolderUpdate, 'sName' => 'oFolderUpdate', 'xParameter' => $_oFolderUpdate));
		$this->oFolderUpdate = $_oFolderUpdate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Folder
	
	@return oFolderUpdate [type]object[/type]
	[en]...[/en]
	*/
	public function getFolderUpdate() {return $this->oFolderUpdate;}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@param oDatabaseUpdate [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setDatabaseUpdate($_oDatabaseUpdate)
	{
		$_oDatabaseUpdate = $this->getRealParameter(array('oParameters' => $_oDatabaseUpdate, 'sName' => 'oDatabaseUpdate', 'xParameter' => $_oDatabaseUpdate));
		$this->oDatabaseUpdate = $_oDatabaseUpdate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@return oDatabaseUpdate [type]object[/type]
	[en]...[/en]
	*/
	public function getDatabaseUpdate() {return $this->oDatabaseUpdate;}
	/* @end method */
	
	/*
	@start method
	
	@group Folder
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFolderUpdateScriptPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->oFolderUpdate->setUpdateScriptPath(array('sPath' => $_sPath));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Folder
	
	@return sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	*/
	public function getFolderUpdateScriptPath() {return $this->oFolderUpdate->getUpdateScriptPath();}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDatabaseUpdateScriptPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->oDatabaseUpdate->setUpdateScriptPath(array('sPath' => $_sPath));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@return sUpdateScriptPath [type]string[/type
	[en]...[/en]
	*/
	public function getDatabaseUpdateScriptPath() {return $this->oDatabaseUpdate->getUpdateScriptPath();}
	/* @end method */

	/*
	@start method
	
	@group Build

	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildUpdateScript()
	{
		global $_POST;
		if (isset($_POST['sRequestType']))
		{
			if ($this->oDatabaseUpdate != NULL)
			{
				if ($_POST['sRequestType'] == PG_DATABASEUPDATE_NETWORK_REQUESTTYPE)
				{
					// if ($_axDBChunkStructures === NULL) {$_axDBChunkStructures = $this->oDatabaseUpdate->getDBChunkStructures();}
					$_axDBChunkStructures = $this->oDatabaseUpdate->getDBChunkStructures();
					$this->oDatabaseUpdate->setNetworkMainData(array('axDBChunkStructures' => $_axDBChunkStructures));
					return $this->oDatabaseUpdate->networkSend();
				}
			}
			
			if ($this->oFolderUpdate != NULL)
			{
				if ($_POST['sRequestType'] == PG_FOLDERUPDATE_NETWORK_REQUESTTYPE)
				{
					// $this->oFolderUpdate->setNetworkMainData(&$_oObject, $_sStartDir = NULL, $_sFromDir = NULL, $_sToDir = NULL);
					return $this->oFolderUpdate->networkSend();
				}
			}
		}
		return NULL;
	}
	/* @end method */

	// Database: $_sUpdateScriptPath = NULL, $_axDBChunkStructures = NULL, $_bUpdateHistoryInfo = NULL, $_bCurrentActionInfo = NULL
	// Folderupdate: $_sFromPath = NULL, $_sToPath = NULL, $_sNewMainFolder = NULL, $_sUpdateScriptPath = NULL, $_bUpdateHistoryInfo = NULL, $_bCurrentActionInfo = NULL
	/*
	@start method
	
	@group Build
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		$_sHtml = '';

		if (($this->oDatabaseUpdate != NULL) && ($this->bDatabaseUpdate == true)) {$this->oDatabaseUpdate->useUpdateAutorun(array('bUse' => $this->bAutorun));}
		else if ($this->oFolderUpdate != NULL) {$this->oFolderUpdate->useUpdateAutorun(array('bUse' => $this->bAutorun));}
		
		if (($this->oDatabaseUpdate != NULL) && ($this->bDatabaseUpdate == true))
		{
			$this->oDatabaseUpdate->useJavaScriptAutoRegister($this->bJavaScriptAutoRegister);
			$_sHtml .= $this->oDatabaseUpdate->build();
		}
		
		if (($this->oFolderUpdate != NULL) && ($this->bFolderUpdate == true))
		{
			$this->oFolderUpdate->useJavaScriptAutoRegister($this->bJavaScriptAutoRegister);
			$_sHtml .= $this->oFolderUpdate->build();
		}
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGUpdate = new classPG_Update();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUpdate', 'xValue' => $oPGUpdate));}
?>