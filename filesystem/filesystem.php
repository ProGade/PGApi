<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_FileSystem extends classPG_ClassBasics
{
	// Declarations...
	private $axFiles = array();
	private $bSearchSubFolder = true;
	private $bFoldersAreCategories = false;
	private $asFileExtension = NULL;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param asFileExtensions [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setFileExtensions($_asFileExtensions)
	{
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_asFileExtensions, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions, 'bNotNull' => true));
		$this->asFileExtension = $_asFileExtensions;
	}
	/* @end method */
	
	/*
	@start method
	
	@param asFileExtensions [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function addFileExtensions($_asFileExtensions)
	{
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_asFileExtensions, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions, 'bNotNull' => true));
		$this->asFileExtension = array_merge($this->asFileExtension, $_asFileExtensions);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFileExtension [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addFileExtension($_sFileExtension)
	{
		$_sFileExtension = $this->getRealParameter(array('oParameters' => $_sFileExtension, 'sName' => 'sFileExtension', 'xParameter' => $_sFileExtension));
		$this->asFileExtension[] = $_sFileExtension;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asFileExtension [type]string[][/type]
	[en]...[/en]
	*/
	public function getFileExtensions() {return $this->asFileExtension;}
	/* @end method */
	
	/*
	@start method
	
	@return axFiles [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubFolders [type]bool[/type]
	[en]...[/en]
	
	@param asFileExtensions [type]string[][/type]
	[en]...[/en]
	*/
	public function getFiles($_sPath, $_bSearchSubFolders = NULL, $_asFileExtensions = NULL)
	{
		$_bSearchSubFolders = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubFolders', 'xParameter' => $_bSearchSubFolders));
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		$this->read(array('sPath' => $_sPath, 'bSearchSubFolders' => $_bSearchSubFolders, 'asFileExtensions' => $_asFileExtensions));
		return $this->axFiles['axFiles'];
	}
	/* @end method */
	
	/*
	@start method
	
	@return axFolders [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubDirs [type]bool[/type]
	[en]...[/en]
	*/
	public function getDirs($_sPath, $_bSearchSubDirs = NULL)
	{
		$_bSearchSubDirs = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubDirs', 'xParameter' => $_bSearchSubDirs));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		return $this->getFolders(array('sPath' => $_sPath, 'bSearchSubFolders' => $_bSearchSubDirs));
	}
	/* @end method */
	
	/*
	@start method
	
	@return axFolders [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubDirectories [type]bool[/type]
	[en]...[/en]
	*/
	public function getDirectories($_sPath, $_bSearchSubDirectories = NULL)
	{
		$_bSearchSubDirectories = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubDirectories', 'xParameter' => $_bSearchSubDirectories));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		return $this->getFolders(array('sPath' => $_sPath, 'bSearchSubFolders' => $_bSearchSubDirectories));
	}
	/* @end method */
	
	/*
	@start method
	
	@return axFolders [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubFolders [type]bool[/type]
	[en]...[/en]
	*/
	public function getFolders($_sPath, $_bSearchSubFolders = NULL)
	{
		$_bSearchSubFolders = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubFolders', 'xParameter' => $_bSearchSubFolders));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->read(array('sPath' => $_sPath, 'bSearchSubFolders' => $_bSearchSubFolders, 'asFileExtensions' => NULL));
		return $this->axFiles['axFolders'];
	}
	/* @end method */
	
	/*
	@start method
	
	@return axStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubFolders [type]bool[/type]
	[en]...[/en]
	
	@param asFileExtensions [type]string[][/type]
	[en]...[/en]
	
	@param bIgnoreRootFiles [type]bool[/type]
	[en]...[/en]
	
	@param sSearchFor [type]string[/type]
	[en]...[/en]
	*/
	public function read($_sPath, $_bSearchSubFolders = NULL, $_asFileExtensions = NULL, $_bIgnoreRootFiles = NULL, $_sSearchFor = NULL)
	{
		$_bSearchSubFolders = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubFolders', 'xParameter' => $_bSearchSubFolders));
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions));
		$_bIgnoreRootFiles = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bIgnoreRootFiles', 'xParameter' => $_bIgnoreRootFiles));
		$_sSearchFor = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sSearchFor', 'xParameter' => $_sSearchFor));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		if ($_bSearchSubFolders === NULL) {$_bSearchSubFolders = $this->bSearchSubFolder;}
		if ($_asFileExtensions === NULL) {$_asFileExtensions = $this->asFileExtension;}
		if ($_bIgnoreRootFiles === NULL) {$_bIgnoreRootFiles = false;}
		if ($_sSearchFor === NULL) {$_sSearchFor = 'both';}
		
		$this->axFiles = $this->readFolder(array('sPath' => $_sPath, 'bSearchSubFolders' => $_bSearchSubFolders, 'asFileExtensions' => $_asFileExtensions, 'bIgnoreRootFiles' => $_bIgnoreRootFiles, 'sSearchFor' => $_sSearchFor));
		return $this->axFiles;
	}
	/* @end method */

	/*
	@start method
	
	@return axStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	
	@param bSearchSubFolders [type]bool[/type]
	[en]...[/en]
	
	@param asFileExtensions [type]string[][/type
	[en]...[/en]
	
	@param bIgnoreRootFiles [type]bool[/type]
	[en]...[/en]
	
	@param sSearchFor [type]string[/type]
	[en]...[/en]
	*/
	public function readFolder($_sPath, $_bSearchSubFolders = NULL, $_asFileExtensions = NULL, $_bIgnoreRootFiles = NULL, $_sSearchFor = NULL)
	{
		$_bSearchSubFolders = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bSearchSubFolders', 'xParameter' => $_bSearchSubFolders));
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions));
		$_bIgnoreRootFiles = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'bIgnoreRootFiles', 'xParameter' => $_bIgnoreRootFiles));
		$_sSearchFor = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sSearchFor', 'xParameter' => $_sSearchFor));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		if ($_bSearchSubFolders === NULL) {$_bSearchSubFolders = $this->bSearchSubFolder;}
		if ($_asFileExtensions === NULL) {$_asFileExtensions = $this->asFileExtension;}
		if ($_bIgnoreRootFiles === NULL) {$_bIgnoreRootFiles = false;}
		if ($_sSearchFor === NULL) {$_sSearchFor = 'both';}
		
		$_iCurrentFile = 0;
		$_iCurrentFolder = 0;
		$_axFiles = array();
		if ($_oFilePointer = opendir($_sPath))
		{
			while ($_sFile = readdir($_oFilePointer))
			{
				// ignore \. , \..
				if (preg_match("!^\.{1,2}$!", $_sFile)) {continue;}

				$_sFileName = $_sFile;
				$_sFileName = str_replace("\\", '', $_sFileName);
				$_sFileName = str_replace("/", '', $_sFileName);

				if (is_dir($_sPath.$_sFile))
				{
					if (($_sSearchFor == 'both') || ($_sSearchFor = 'folders'))
					{
						$_axFiles['axFolders'][$_iCurrentFolder]['iFolderID'] = 0;
						$_axFiles['axFolders'][$_iCurrentFolder]['sPath'] = $_sPath.$_sFile;
						$_axFiles['axFolders'][$_iCurrentFolder]['sPreviewPath'] = '';
						$_axFiles['axFolders'][$_iCurrentFolder]['sExtension'] = '';
						$_axFiles['axFolders'][$_iCurrentFolder]['sName'] = $_sFileName;
						$_axFiles['axFolders'][$_iCurrentFolder]['sText'] = '';

						if (($_bSearchSubFolders == true) || ($this->bFoldersAreCategories == true))
						{
							$_axFiles['axFolders'][$_iCurrentFolder]['axContent'] = $this->readFolder(
								array(
									'sPath' => $_sPath.$_sFile.'/', 
									'bSearchSubFolders' => $_bSearchSubFolders, 
									'asFileExtensions' => $_asFileExtensions, 
									'bIgnoreRootFiles' => false, 
									'sSearchFor' => $_sSearchFor
								)
							);
						}
					}
					else
					{
						$_axFiles2 = $this->readFolder(
							array(
								'sPath' => $_sPath.$_sFile.'/', 
								'bSearchSubFolders' => $_bSearchSubFolders, 
								'asFileExtensions' => $_asFileExtensions, 
								'bIgnoreRootFiles' => false, 
								'sSearchFor' => $_sSearchFor
							)
						);
						$_axFiles['axFiles'] = array_merge($_axFiles['axFiles'], $_axFiles2['axFiles']);
					}
					$_iCurrentFolder++;
				}
				else if ((($_sSearchFor == 'both') || ($_sSearchFor = 'files')) && ($_bIgnoreRootFiles == false))
				{
					if ($this->isFileAllowed(array('sFile' => $_sFileName, 'asFileExtensions' => $_asFileExtensions)))
					{
						$_sFileExtension = $this->getFileExtension(array('sFile' => $_sFileName));
						$_axFiles['axFiles'][$_iCurrentFile]['iFolderID'] = 0;
						$_axFiles['axFiles'][$_iCurrentFile]['sPath'] = $_sPath.$_sFile;
						$_axFiles['axFiles'][$_iCurrentFile]['sPreviewPath'] = '';
						$_axFiles['axFiles'][$_iCurrentFile]['sName'] = $_sFileName;
						$_axFiles['axFiles'][$_iCurrentFile]['sText'] = '';
						$_axFiles['axFiles'][$_iCurrentFile]['sExtension'] = $_sFileExtension;
						$_iCurrentFile++;
					}
				}
			}
			closedir($_oFilePointer);
		}
		return $_axFiles;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sExtension [type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getFileExtension($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		return strtolower(str_replace(".", "", strrchr($_sFile, ".")));
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsAllowed [type]bool[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param asFileExtensions [type]string[][/type]
	[en]...[/en]
	*/
	public function isFileAllowed($_sFile, $_asFileExtensions = NULL)
	{
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_asFileExtensions === NULL) {$_asFileExtensions = $this->asFileExtension;}
		if ($_asFileExtensions === NULL) {return true;}
		if (count($_asFileExtensions) < 1) {return true;}
		else
		{
			$_sFileExtension = strtolower($this->getFileExtension(array('sFile' => $_sFile)));
			for ($i=0; $i<count($_asFileExtensions); $i++)
			{
				if (strtolower($_asFileExtensions[$i]) == $_sFileExtension) {return true;}
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iBytes [type]int[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param bBinary [type]bool[/type]
	[en]...[/en]
	*/
	public function appendFile($_sFile, $_sMessage = NULL, $_bBinary = NULL)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_bBinary = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'bBinary', 'xParameter' => $_bBinary));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		
		if ($_bBinary === NULL) {$_bBinary = false;}

		$_sMode = 'a';
		if ($_bBinary == true) {$_sMode = 'ab';}
		if ($_oFilePointer = fopen($_sFile, $_sMode))
		{
			$_iBytes = fwrite($_oFilePointer, $_sMessage);
			fclose($_oFilePointer);
			return $_iBytes;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method

	@return iBytes [type]int[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param bBinary [type]bool[/type]
	[en]...[/en]
	*/
	public function writeFile($_sFile, $_sMessage = NULL, $_bBinary = NULL)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_bBinary = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'bBinary', 'xParameter' => $_bBinary));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_bBinary === NULL) {$_bBinary = false;}
		
		$_sMode = 'w';
		if ($_bBinary == true) {$_sMode = 'wb';}
		if ($_oFilePointer = fopen($_sFile, $_sMode))
		{
			$_iBytes = fwrite($_oFilePointer, $_sMessage);
			fclose($_oFilePointer);
			return $_iBytes;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFileContent [type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param bBinary [type]bool[/type]
	[en]...[/en]
	*/
	public function readFile($_sFile, $_bBinary = NULL)
	{
		$_bBinary = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'bBinary', 'xParameter' => $_bBinary));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_bBinary === NULL) {$_bBinary = false;}
		
		$_sMode = 'r';
		if ($_bBinary == true) {$_sMode = 'rb';}
		if ($_oFilePointer = fopen($_sFile, $_sMode))
		{
			return fread($_oFilePointer, filesize($_sFile));
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function deleteFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		return unlink($_sFile);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sDir [needed][type]string[/type]
	[en]...[/en]
	*/
	public function deleteDir($_sDir)
	{
		$_sDir = $this->getRealParameter(array('oParameters' => $_sDir, 'sName' => 'sDir', 'xParameter' => $_sDir));
		return $this->deleteFolder(array('sFolder' => $_sDir));
	}
	/* @end method */
	
	/*
	@start method

	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sDirectory [needed][type]string[/type]
	[en]...[/en]
	*/
	public function deleteDirectory($_sDirectory)
	{
		$_sDirectory = $this->getRealParameter(array('oParameters' => $_sDirectory, 'sName' => 'sDirectory', 'xParameter' => $_sDirectory));
		return $this->deleteFolder(array('sFolder' => $_sDirectory));
	}
	/* @end method */
	
	/*
	@start method

	@return bSuccess [type]bool[/type]
	[en]...[/en]

	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	*/
	public function deleteFolder($_sFolder)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));

		if (!file_exists($_sFolder)) {return true;}
		if ((!is_dir($_sFolder)) || (is_link($_sFolder))) {return unlink($_sFolder);}
		foreach (scandir($_sFolder) as $_sItem)
		{
			if (($_sItem == '.') || ($_sItem == '..')) {continue;}
			if (!$this->deleteFolder(array('sFolder' => $_sFolder."/".$_sItem)))
			{
				chmod($_sFolder."/".$_sItem, 0777);
				if (!$this->deleteFolder(array('sFolder' => $_sFolder."/".$_sItem))) {return false;}
			}
		} 
		return rmdir($_sFolder);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	
	@param bDeleteFolders [type]bool[/type]
	[en]...[/en]
	
	@param bDeleteFiles [type]bool[/type]
	[en]...[/en]
	
	@param asFileExtensions [type]string[][/type]
	[en]...[/en]
	*/
	public function deleteFolderContent($_sFolder, $_bDeleteFolders = true, $_bDeleteFiles = true, $_asFileExtensions = NULL)
	{
		$_bDeleteFolders = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'bDeleteFolders', 'xParameter' => $_bDeleteFolders));
		$_bDeleteFiles = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'bDeleteFiles', 'xParameter' => $_bDeleteFiles));
		$_asFileExtensions = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'asFileExtensions', 'xParameter' => $_asFileExtensions));
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));

		$_bReturn = false;
		if (!file_exists($_sFolder)) {return true;}
		if (((!is_dir($_sFolder)) || (is_link($_sFolder))) && ($_bDeleteFiles == true))
		{
			$_bReturn = false;
			$_bAllowed = true;
			if ($_asFileExtensions != NULL)
			{
				$_bAllowed = false;
				for($i=0; $i<count($_asFileExtensions); $i++)
				{
					$_sFileExtension = $this->getFileExtension(array('sFile' => $_sFolder));
					if ($_sFileExtension == $_asFileExtensions[$i]) {$_bAllowed = true;}
				}
			}
			if ($_bAllowed == true) {$_bReturn = unlink($_sFolder);}
			return $_bReturn;
		}
		if ($_bDeleteFolders == true)
		{
			$_bReturn = false;
			foreach (scandir($_sFolder) as $_sItem)
			{
				if (($_sItem == '.') || ($_sItem == '..')) {continue;}
				if (!$this->deleteFolder(array('sFolder' => $_sFolder."/".$_sItem)))
				{
					chmod($_sFolder."/".$_sItem, 0777);
					if (!$this->deleteFolder(array('sFolder' => $_sFolder."/".$_sItem))) {return false;}
				}
			}
			$_bReturn = rmdir($_sFolder);
		}
		return $_bReturn;
	}
	/* @end method */
}
/* @end class */
$oPGFileSystem = new classPG_FileSystem();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFileSystem', 'xValue' => $oPGFileSystem));}
?>