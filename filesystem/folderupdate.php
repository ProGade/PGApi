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
define('PG_FOLDERUPDATE_NETWORK_REQUESTTYPE', 'PGFolderUpdateRequest');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_FolderUpdate extends classPG_ClassBasics
{
	// Declarations...
	private $iFoldersFailed = 0;
	private $iFoldersSuccessed = 0;
	private $iFilesFailed = 0;
	private $iFilesSuccessed = 0;
	
	private $asIgnoreFolders = array();
	private $asIgnoreSubFoldersInAllFolders = array();
	private $asIgnoreFiles = array();
	private $asIgnoreFilesInAllFolders = array();
	
	private $sFromPath = '';
	private $sToPath = '';
	private $sNewMainFolder = '';
	private $sUpdateScriptPath = 'update_folders.php';
	
	private $bJavaScriptAutoRegister = true;
	private $bUpdateAutorun = false;
	private $bUpdateHistoryInfo = false;
	private $bCurrentActionInfo = true;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGFolderUpdate'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFromPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sFromPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFromPath [type]string[/type]
	[en]...[/en]
	*/
	public function getFromPath() {return $this->sFromPath;}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setToPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sToPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sToPath [type]string[/type]
	[en]...[/en]
	*/
	public function getToPath() {return $this->sToPath;}
	/* @end method */
	
	/*
	@start method
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setNewMainFolder($_sFolder)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$this->sNewMainFolder = $_sFolder;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sNewMainFolder [type]string[/type]
	[en]...[/en]
	*/
	public function getNewMainFolder() {return $this->sNewMainFolder;}
	/* @end method */
	
	/*
	@start method
	
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
	
	@return bIsAutoRegister [type]bool[/type]
	[en]...[/en]
	*/
	public function isJavaScriptAutoRegister() {return $this->bJavaScriptAutoRegister;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useUpdateAutorun($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUpdateAutorun = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUpdateAutorun [type]bool[/type]
	[en]...[/en]
	*/
	public function isUpdateAutorun() {return $this->bUpdateAutorun;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useUpdateHistoryInfo($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUpdateHistoryInfo = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUpdateHistoryInfo [type]bool[/type]
	[en]...[/en]
	*/
	public function isUpdateHistoryInfo() {return $this->bUpdateHistoryInfo;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useCurrentActionInfo($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bCurrentActionInfo = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bCurrentActionInfo [type]bool[/type]
	[en]...[/en]
	*/
	public function isCurrentActionInfo() {return $this->bCurrentActionInfo;}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUpdateScriptPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sUpdateScriptPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	*/
	public function getUpdateScriptPath() {return $this->sUpdateScriptPath;}
	/* @end method */
	
	/*
	@start method
	
	@param asFolders [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setFoldersToIgnore($_asFolders)
	{
		$_asFolders = $this->getRealParameter(array('oParameters' => $_asFolders, 'sName' => 'asFolders', 'xParameter' => $_asFolders, 'bNotNull' => true));
		$this->asIgnoreFolders = $_asFolders;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asIgnoreFolders [type]string[][/type]
	[en]...[/en]
	*/
	public function getFoldersToIgnore() {return $this->asIgnoreFolders;}
	/* @end method */
	
	/*
	@start method
	
	@param asFolders [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addFoldersToIgnore($_asFolders)
	{
		$_asFolders = $this->getRealParameter(array('oParameters' => $_asFolders, 'sName' => 'asFolders', 'xParameter' => $_asFolders, 'bNotNull' => true));
		$this->asIgnoreFolders = array_merge($this->asIgnoreFolders, $_asFolders);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addFolderToIgnore($_sFolder)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$this->asIgnoreFolders[] = $_sFolder;
	}
	/* @end method */

	/*
	@start method
	
	@param asFiles [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setFilesToIgnore($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asIgnoreFiles = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asIgnoreFiles [type]string[][/type]
	[en]...[/en]
	*/
	public function getFilesToIgnore() {return $this->asIgnoreFiles;}
	/* @end method */
	
	/*
	@start method
	
	@param asFiles [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addFilesToIgnore($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asIgnoreFiles = array_merge($this->asIgnoreFiles, $_asFiles);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addFileToIgnore($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asIgnoreFiles[] = $_sFile;
	}
	/* @end method */

	/*
	@start method
	
	@param asFolders [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setSubFoldersToIgnore($_asFolders)
	{
		$_asFolders = $this->getRealParameter(array('oParameters' => $_asFolders, 'sName' => 'asFolders', 'xParameter' => $_asFolders, 'bNotNull' => true));
		$this->asIgnoreSubFoldersInAllFolders = $_asFolders;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asIgnoreSubFolders [type]string[][/type]
	[en]...[/en]
	*/
	public function getSubFoldersToIgnore() {return $this->asIgnoreSubFoldersInAllFolders;}
	/* @end method */
	
	/*
	@start method
	
	@param asFolders [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addSubFoldersToIgnore($_asFolders)
	{
		$_asFolders = $this->getRealParameter(array('oParameters' => $_asFolders, 'sName' => 'asFolders', 'xParameter' => $_asFolders, 'bNotNull' => true));
		$this->asIgnoreSubFoldersInAllFolders = array_merge($this->asIgnoreSubFoldersInAllFolders, $_asFolders);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addSubFolderToIgnore($_sFolder)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$this->asIgnoreSubFoldersInAllFolders[] = $_sFolder;
	}
	/* @end method */

	/*
	@start method
	
	@param asFiles [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setFilesToIgnoreInAllFolders($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asIgnoreFilesInAllFolders = $_asFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asIgnoreFiles [type]string[][/type]
	[en]...[/en]
	*/
	public function getFilesToIgnoreInAllFolders() {return $this->asIgnoreFilesInAllFolders;}
	/* @end method */
	
	/*
	@start method
	
	@param asFiles [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addFilesToIgnoreInAllFolders($_asFiles)
	{
		$_asFiles = $this->getRealParameter(array('oParameters' => $_asFiles, 'sName' => 'asFiles', 'xParameter' => $_asFiles, 'bNotNull' => true));
		$this->asIgnoreFilesInAllFolders = array_merge($this->asIgnoreFilesInAllFolders, $_asFiles);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addFileToIgnoreInAllFolders($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->asIgnoreFilesInAllFolders[] = $_sFile;
	}
	/* @end method */

	/* @start method */
	public function resetLog()
	{
		$this->iFoldersFailed = 0;
		$this->iFoldersSuccessed = 0;
		$this->iFilesFailed = 0;
		$this->iFilesSuccessed = 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iFoldersFailed [type]int[/type]
	[en]...[/en]
	*/
	public function getFoldersFailed() {return $this->iFoldersFailed;}
	/* @end method */

	/*
	@start method
	
	@return iFoldersSuccessed [type]int[/type]
	[en]...[/en]
	*/
	public function getFoldersSuccessed() {return $this->iFoldersSuccessed;}
	/* @end method */

	/*
	@start method
	
	@return iFilesFailed [type]int[/type]
	[en]...[/en]
	*/
	public function getFilesFailed() {return $this->iFilesFailed;}
	/* @end method */

	/*
	@start method
	
	@return iFilesSuccessed [type]int[/type]
	[en]...[/en]
	*/
	public function getFilesSuccessed() {return $this->iFilesSuccessed;}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param asFolders [type]string[][/type]
	[en]...[/en]
	*/
	public function createFoldersIfNotExists($_sPath, $_asFolders = NULL)
	{
		$_asFolders = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'asFolders', 'xParameter' => $_asFolders));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		$_iFoldersOK = 0;
		for ($i=0; $i<count($_asFolders); $i++)
		{
			if (file_exists($_sPath.$_asFolders[$i]) == false)
			{
				if (mkdir($_sPath.$_asFolders[$i])) {$_iFoldersOK++;}
			}
			else {$_iFoldersOK++;}
		}
		return $_iFoldersOK;
	}
	/* @end method */

	/*
	@start method
	
	@return asFolders [type]string[][/type]
	[en]...[/en]
	
	@param sStartDir [needed][type]string[/type]
	[en]...[/en]
	
	@param sFromDir [needed][type]string[/type]
	[en]...[/en]
	
	@param sToDir [needed][type]string[/type]
	[en]...[/en]
	
	@param bUpdateSubstructure [type]bool[/type]
	[en]...[/en]
	*/
	public function updateFilesAndFolders($_sStartDir, $_sFromDir = NULL, $_sToDir = NULL, $_bUpdateSubstructure = NULL)
	{
		$_sFromDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sFromDir', 'xParameter' => $_sFromDir));
		$_sToDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sToDir', 'xParameter' => $_sToDir));
		$_bUpdateSubstructure = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'bUpdateSubstructure', 'xParameter' => $_bUpdateSubstructure));
		$_sStartDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sStartDir', 'xParameter' => $_sStartDir));

		$_asFolders = array();
		if ($_oDirHandle = opendir($_sFromDir.$_sStartDir))
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => 'Open dir ('.$_sFromDir.$_sStartDir.')<br />'));}
			while ($_sFile = readdir($_oDirHandle))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => 'Found '.$_sStartDir.$_sFile.'<br />'));}
				
				$_sTestString = $_sStartDir.$_sFile;
				$_sTestString = str_replace("\\", "/", $_sTestString);
				
				for ($i=0; $i<count($this->asIgnoreFolders); $i++) {if ($_sTestString == $this->asIgnoreFolders[$i]) {continue;}}
				for ($i=0; $i<count($this->asIgnoreFiles); $i++) {if ($_sTestString == $this->asIgnoreFiles[$i]) {continue;}}
		
				// ignore \. and \..
				if (preg_match("!^\.{1,2}$!", $_sFile)) {continue;}

				$_sTestString = $_sFile;
				$_sTestString = str_replace("\\", "", $_sTestString);
				$_sTestString = str_replace("/", "", $_sTestString);

				for ($i=0; $i<count($this->asIgnoreSubFoldersInAllFolders); $i++) {if ($_sTestString == $this->asIgnoreSubFoldersInAllFolders[$i]) {continue;}}
				for ($i=0; $i<count($this->asIgnoreFilesInAllFolders); $i++) {if ($_sTestString == $this->asIgnoreFilesInAllFolders[$i]) {continue;}}
		
				if (is_dir($_sFromDir.$_sStartDir.$_sFile))
				{
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => '...is directory<br />'));}
					if (file_exists($_sToDir.$_sStartDir.$_sFile) == false)
					{
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => '...dir doesn\'t exists<br />'));}
						if (mkdir($_sToDir.$_sStartDir.$_sFile))
						{
							$this->iFoldersSuccessed++;
							if ($this->isDebugMode(PG_DEBUG_HIGH)) {$this->setDebugString('...dir was created<br />');}
						}
						else
						{
							$this->iFoldersFailed++;
							if ($this->isDebugMode(PG_DEBUG_HIGH)) {$this->setDebugString('...dir couldn\'t be created!<br />');}
						}
					}
					else {$this->iFoldersSuccessed++;}
					
					if (file_exists($_sToDir.$_sStartDir.$_sFile))
					{
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => '...dir exists and added to return<br />'));}
						$_asFolders[] = $_sStartDir.$_sFile.'/';
						if ($_bUpdateSubstructure == true) {$this->updateFilesAndFolders(array('sStartDir' => $_sStartDir.$_sFile.'/', 'sFromDir' => $_sFromDir, 'sToDir' => $_sToDir, 'bUpdateSubstructure' => $_bUpdateSubstructure));}
					}
				}
				else
				{
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->setDebugString(array('sString' => '...is file<br />'));}
					if (copy($_sFromDir.$_sStartDir.$_sFile, $_sToDir.$_sStartDir.$_sFile)) {$this->iFilesSuccessed++;}
					else {$this->iFilesFailed++;}
				}
			}
			closedir($_oDirHandle);
		}
		else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH | PG_DEBUG_MEDIUM))) {$this->setDebugString(array('sString' => 'Error: Can\'t open dir ('.$_sFromDir.$_sStartDir.')<br />'));}
		return $_asFolders;
	}
	/* @end method */
	
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param sStartDir [type]string[/type]
	[en]...[/en]
	
	@param sFromDir [type]string[/type]
	[en]...[/en]
	
	@param sToDir [type]string[/type]
	[en]...[/en]
	*/
	public function setNetworkMainData(&$_oObject, $_sStartDir = NULL, $_sFromDir = NULL, $_sToDir = NULL)
	{
		global $_POST;

		$_sFromDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sFromDir', 'xParameter' => $_sFromDir));
		$_sToDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sToDir', 'xParameter' => $_sToDir));
		$_sStartDir = $this->getRealParameter(array('oParameters' => $_sStartDir, 'sName' => 'sStartDir', 'xParameter' => $_sStartDir));
		
		if ($_sStartDir === NULL) {$_sStartDir = '';}
		if ($_sFromDir === NULL) {$_sFromDir = 'install/'.$_POST['sDir'];}
		if ($_sToDir === NULL) {$_sToDir = $_POST['sDir'];}
		
		$_bUpdateSubstructure = true;
		
		$this->updateFilesAndFolders(array('sStartDir' => $_sStartDir, 'sFromDir' => $_sFromDir, 'sToDir' => $_sToDir, 'bUpdateSubstructure' => $_bUpdateSubstructure));
		
		$_oObject->addNetworkData(array('sName' => 'PG_RequestType', 'xValue' => PG_FOLDERUPDATE_NETWORK_REQUESTTYPE));
		$_oObject->addNetworkData(array('sName' => 'PG_FolderUpdate_Successed', 'xValue' => $this->iFoldersSuccessed));
		$_oObject->addNetworkData(array('sName' => 'PG_FolderUpdate_Failed', 'xValue' => $this->iFoldersFailed));
		$_oObject->addNetworkData(array('sName' => 'PG_FilesUpdate_Successed', 'xValue' => $this->iFilesSuccessed));
		$_oObject->addNetworkData(array('sName' => 'PG_FilesUpdate_Failed', 'xValue' => $this->iFilesFailed));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sFromPath [type]string[/type]
	[en]...[/en]
	
	@param sToPath [type]string[/type]
	[en]...[/en]
	
	@param sNewMainFolder [type]string[/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param bUpdateHistoryInfo [type]bool[/type]
	[en]...[/en]
	
	@param bCurrentActionInfo [type]bool[/type]
	[en]...[/en]
	*/
	public function build($_sFromPath = NULL, $_sToPath = NULL, $_sNewMainFolder = NULL, $_sUpdateScriptPath = NULL, $_bUpdateHistoryInfo = NULL, $_bCurrentActionInfo = NULL)
	{
		global $oPGProgressBar;

		$_sToPath = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'sToPath', 'xParameter' => $_sToPath));
		$_sNewMainFolder = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'sNewMainFolder', 'xParameter' => $_sNewMainFolder));
		$_sUpdateScriptPath = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'sUpdateScriptPath', 'xParameter' => $_sUpdateScriptPath));
		$_bUpdateHistoryInfo = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'bUpdateHistoryInfo', 'xParameter' => $_bUpdateHistoryInfo));
		$_bCurrentActionInfo = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'bCurrentActionInfo', 'xParameter' => $_bCurrentActionInfo));
		$_sFromPath = $this->getRealParameter(array('oParameters' => $_sFromPath, 'sName' => 'sFromPath', 'xParameter' => $_sFromPath));

		if ($_sFromPath === NULL) {$_sFromPath = $this->sFromPath;}
		if ($_sToPath === NULL) {$_sToPath = $this->sToPath;}
		if ($_sNewMainFolder === NULL) {$_sNewMainFolder = $this->sNewMainFolder;}
		if ($_sUpdateScriptPath === NULL) {$_sUpdateScriptPath = $this->sUpdateScriptPath;}
		if ($_bUpdateHistoryInfo === NULL) {$_bUpdateHistoryInfo = $this->bUpdateHistoryInfo;}
		if ($_bCurrentActionInfo === NULL) {$_bCurrentActionInfo = $this->bCurrentActionInfo;}
		
		if ($_sToPath == '') {$_sToPath = $_sFromPath;}
		if (($_sFromPath == $_sToPath) && ($_sNewMainFolder == '')) {$_sNewMainFolder = md5($_sToPath).'/';}
		
		$_sUpdateStartDir = '';
		$_sUpdateFromDir = $_sFromPath;
		$_sUpdateToDir = $_sToPath.$_sNewMainFolder;
		$_bUpdateSubstructure = false;
		
		$_sHtml = '';
		
		$_bDoUpdate = true;
		if ($_sNewMainFolder != '')
		{
			$_bDoUpdate = false;
			$_asFolderMustExists = array($_sNewMainFolder);
			if ($this->createFoldersIfNotExists(array('asFolders' => $_asFolderMustExists, 'sPath' => $_sToPath)) == count($_asFolderMustExists)) {$_bDoUpdate = true;}
		}
		
		if ($_bDoUpdate == true)
		{
			$_sWidth = '350px';
			if ($_bCurrentActionInfo == true) {$_sHtml .= '<div id="'.$this->getID().'ActionInfo" style="width:'.$_sWidth.';">&nbsp;</div>';}
			if (isset($oPGProgressBar))
			{
				$_sBarID = $this->getID().'ProgressBar';
				$_iType = PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR;
				$_sHeight = '25px';
				$_sBackgroundCssClass = NULL;
				$_sBackgroundCssStyle = NULL;
				$_sBarCssClass = NULL;
				$_sBarCssStyle = NULL;
				$_sHtml .= $oPGProgressBar->build(array('sProgressBarID' => $_sBarID, 'iType' => $_iType, 'sWidth' => $_sWidth, 'sHeight' => $_sHeight, 'sBackgroundCssClass' => $_sBackgroundCssClass, 'sBackgroundCssStyle' => $_sBackgroundCssStyle, 'sBarCssClass' => $_sBarCssClass, 'sBarCssStyle' => $_sBarCssStyle));
			}
		
			if ($_bUpdateHistoryInfo == true) {$_sHtml .= '<div id="'.$this->getID().'HistoryInfo" style="width:'.$_sWidth.';"></div>';}
		
			if ($this->bJavaScriptAutoRegister == true)
			{
				$_sHtml .= '<script type="text/javascript">';
				if ($_bCurrentActionInfo == true) {$_sHtml .= 'oPGFolderUpdate.setCurrentActionContainerID({"sContainerID": "'.$this->getID().'ActionInfo"}); ';}
				if ($_bUpdateHistoryInfo == true) {$_sHtml .= 'oPGFolderUpdate.setUpdateHistoryContainerID({"sContainerID": "'.$this->getID().'HistoryInfo"}); ';}
				$_sHtml .= 'oPGFolderUpdate.build({"asFolders": new Array(';
				$_asFolders = $this->updateFilesAndFolders($_sUpdateStartDir, $_sUpdateFromDir, $_sUpdateToDir, $_bUpdateSubstructure);
				for ($i=0; $i<count($_asFolders); $i++)
				{
					if ($i > 0) {$_sHtml .= ', ';}
					$_sHtml .= '"'.$_asFolders[$i].'"';
				}
				$_sHtml .= '), "sUpdateScriptPath": "'.$_sUpdateScriptPath.'", ';
				$_sHtml .= '"sFolderUpdateID": "'.$this->getID().'", ';
				$_sHtml .= '"bRunUpdate": ';
				if ($this->bUpdateAutorun == true) {$_sHtml .= 'true';} else {$_sHtml .= 'false';}
				$_sHtml .= ', "iFoldersSuccessed": '.$this->iFoldersSuccessed;
				$_sHtml .= ', "iFoldersFailed": '.$this->iFoldersFailed;
				$_sHtml .= ', "iFilesSuccessed": '.$this->iFilesSuccessed;
				$_sHtml .= ', "iFilesFailed": '.$this->iFilesFailed;
				$_sHtml .= '}); ';
				$_sHtml .= '</script>';
			}
		}
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGFolderUpdate = new classPG_FolderUpdate();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFolderUpdate', 'xValue' => $oPGFolderUpdate));}
?>