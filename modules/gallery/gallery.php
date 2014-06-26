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
define('PG_GALLERY_PREVIEW_LAYOUT_SIMPLE_LIST', 0);
define('PG_GALLERY_PREVIEW_LAYOUT_DETAIL_LIST', 1);
define('PG_GALLERY_PREVIEW_LAYOUT_COMPACT', 2);
define('PG_GALLERY_PREVIEW_LAYOUT_DETAIL', 3);
/*
define('PG_GALLERY_PREVIEW_LAYOUT_SCROLLING_HORIZONTAL', 4);	// TODO
define('PG_GALLERY_PREVIEW_LAYOUT_SCROLLING_VERTICAL', 5);		// TODO
define('PG_GALLERY_PREVIEW_LAYOUT_FILMSTRIP_HORIZONTAL', 6);	// TODO
define('PG_GALLERY_PREVIEW_LAYOUT_FILMSTRIP_VERTICAL', 7);		// TODO
*/

define('PG_GALLERY_DETAIL_LAYOUT_POPUP', 0);
define('PG_GALLERY_DETAIL_LAYOUT_SELF', 1);
define('PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE', 2);
define('PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION', 3);
/*
define('PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL', 4);	// TODO
define('PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL', 5);	// TODO
define('PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_3D', 6);			// TODO
*/

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Gallery extends classPG_ClassBasics
{
	// Declarations...
	private $iPreviewLayout = PG_GALLERY_PREVIEW_LAYOUT_COMPACT;
	private $iDetailLayout = PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE;
	private $iPreviewsPerPage = 0;
	private $iCurrentPage = 1;
	private $iPreviewSizeX = 150;
	private $iPreviewSizeY = 150;
	private $iPreviewDescriptionSizeY = 30;
	private $iDetailMaxSizeX = 0;
	private $iDetailMaxSizeY = 0;
	private $sStartPath = '';
	private $sPreviewSubPath = '';
	private $sDetailSubPath = '';
	// private $sPreviewFilePrefix = '';
	// private $sDetailFilePrefix = '';
	private $sFolderImageURL = '';
	private $sFolderURL = '';
	private $sFolderURLParameters = '';
	private $sDetailURL = '';
	private $sFolderCssClass = '';
	private $sFolderCssStyle = '';
	private $sFilePreviewCssClass = '';
	private $sFilePreviewCssStyle = '';
	
	private $bDisplayNames = true;
	private $bDisplayDescriptions = true;
	private $bFoldersAreCategories = false;
	
	// database...
	private $oDatabaseQuery = NULL;
	private $sDatabaseHost = '';
	private $sDatabaseDatabaseName = '';
	private $sDatabaseUsername = '';
	private $sDatabasePassword = '';
	
	private $sDatabaseFolderTableName = '';
	private $sDatabaseFolderIDColumn = '';
	private $sDatabaseFolderLinkIDColumn = '';
	private $sDatabaseFolderNameColumn = '';
	private $sDatabaseFolderTextColumn = '';
	
	private $sDatabaseImageTableName = '';
	private $sDatabaseImageIDColumn = '';
	private $sDatabaseImageFolderIDColumn = '';
	private $sDatabaseImageNameColumn = '';
	private $sDatabaseImagePathColumn = '';
	private $sDatabaseImagePreviewPathColumn = '';
	private $sDatabaseImageTextColumn = '';
	
	private $asFileExtension = NULL;
	private $axFiles = array();
	
	// Construct...
	public function __construct()
	{
		$this->setID('PGGallery');
		$this->initClassBasics();
		$this->setText(array(
		));
	}
	
	// Methods...
	/* @start method */
	public function setFoldersToCategories($_bCategories) {$this->bFoldersAreCategories = $_bCategories;}
	/* @end method */

	/* @start method */
	public function isFoldersToCategories() {return $this->bFoldersAreCategories;}
	/* @end method */
	
	// general set and get....
	/* @start method */
	public function setPreviewLayout($_iPreviewLayout) {$this->iPreviewLayout = (int)$_iPreviewLayout;}
	/* @end method */

	/* @start method */
	public function getPreviewLayout() {return $this->iPreviewLayout;}
	/* @end method */

	/* @start method */
	public function setDetailLayout($_iDetailLayout) {$this->iDetailLayout = (int)$_iDetailLayout;}
	/* @end method */

	/* @start method */
	public function getDetailLayout() {return $this->iDetailLayout;}
	/* @end method */
	
	/* @start method */
	public function setStartPath($_sPath) {$this->sStartPath = (string)$_sPath;}
	/* @end method */

	/* @start method */
	public function getStartPath() {return $this->sStartPath;}
	/* @end method */
	
	/* @start method */
	public function setPreviewSubPath($_sPath) {$this->sPreviewSubPath = $_sPath;}
	/* @end method */

	/* @start method */
	public function getPreviewSubPath() {return $this->sPreviewSubPath;}
	/* @end method */

	/* @start method */
	public function setDetailSubPath($_sPath) {$this->sDetailSubPath = $_sPath;}
	/* @end method */

	/* @start method */
	public function getDetailSubPath() {return $this->sDetailSubPath;}
	/* @end method */

	// public function setPreviewFilePrefix($_sPrefix) {$this->sPreviewFilePrefix = $_sPrefix;}
	// public function getPreviewFilePrefix() {return $this->sPreviewFilePrefix;}
	// public function setDetailFilePrefix($_sPrefix) {$this->sDetailFilePrefix = $_sPrefix;}
	// public function getDetailFilePrefix() {return $this->sDetailFilePrefix;}
	
	/* @start method */
	public function setPreviewsPerPage($_iCount) {$this->iPreviewsPerPage = (int)$_iCount;}
	/* @end method */

	/* @start method */
	public function getPreviewsPerPage() {return $this->iPreviewsPerPage;}
	/* @end method */

	/* @start method */
	public function setPage($_iPage) {$this->iCurrentPage = max((int)$_iPage, 1);}
	/* @end method */

	/* @start method */
	public function getPage() {return $this->iCurrentPage;}
	/* @end method */
	
	/* @start method */
	public function setPreviewSizeX($_iSizeX) {$this->iPreviewSizeX = $_iSizeX;}
	/* @end method */

	/* @start method */
	public function setPreviewSizeY($_iSizeY) {$this->iPreviewSizeY = $_iSizeY;}
	/* @end method */

	/* @start method */
	public function setPreviewSize($_iSizeX = NULL, $_iSizeY = NULL)
	{
		if ($_iSizeX !== NULL) {$this->iPreviewSizeX = $_iSizeX;}
		if ($_iSizeY !== NULL) {$this->iPreviewSizeY = $_iSizeY;}
	}
	/* @end method */
	
	/* @start method */
	public function setPreviewDescriptionSizeY($_iSizeX) {$this->iPreviewDescriptionSizeY = $_iSizeX;}
	/* @end method */

	/* @start method */
	public function setDetailMaxSizeX($_iSizeX) {$this->iDetailMaxSizeX = (int)$_iSizeX;}
	/* @end method */

	/* @start method */
	public function getDetailMaxSizeX() {return $this->iDetailMaxSizeX;}
	/* @end method */

	/* @start method */
	public function setDetailMaxSizeY($_iSizeY) {$this->iDetailMaxHeight = (int)$_iSizeY;}
	/* @end method */

	/* @start method */
	public function getDetailMaxSizeY() {return $this->iDetailMaxSizeY;}
	/* @end method */
	
	/* @start method */
	public function setDetailURL($_sURL) {$this->sDetailURL = (string)$_sURL;}
	/* @end method */

	/* @start method */
	public function getDetailURL() {return $this->sDetailURL;}
	/* @end method */
	
	/* @start method */
	public function setFolderImageURL($_sURL) {$this->sFolderImageURL = (string)$_sURL;}
	/* @end method */

	/* @start method */
	public function getFolderImageURL() {return $this->sFolderImageURL;}
	/* @end method */
	
	/* @start method */
	public function setFolderURL($_sURL) {$this->sFolderURL = (string)$_sURL;}
	/* @end method */

	/* @start method */
	public function getFolderURL() {return $this->sFolderURL;}
	/* @end method */

	/* @start method */
	public function setFolderURLParameters($_sParameters) {$this->sFolderURLParameters = (string)$_sParameters;}
	/* @end method */

	/* @start method */
	public function addFolderURLParamaters($_sParameters)
	{
		if ($this->sFolderURLParameters != '') {$this->sFolderURLParameters .= '&';}
		$this->sFolderURLParameters .= (string)$_sParameters;
	}
	/* @end method */

	/* @start method */
	public function getFolderURLParamaters() {return $this->sFolderURLParameters;}
	/* @end method */

	/* @start method */
	public function setFolderCssClass($_sCssClass) {$this->sFolderCssClass = (string)$_sCssClass;}
	/* @end method */

	/* @start method */
	public function getFolderCssClass() {return $this->sFolderCssClass;}
	/* @end method */

	/* @start method */
	public function setFolderCssStyle($_sCssStyle) {$this->sFolderCssStyle = (string)$_sCssStyle;}
	/* @end method */

	/* @start method */
	public function getFolderCssStyle() {return $this->sFolderCssStyle;}
	/* @end method */
	
	/* @start method */
	public function setFilePreviewCssClass($_sCssClass) {$this->sFilePreviewCssClass = (string)$_sCssClass;}
	/* @end method */

	/* @start method */
	public function getFilePreviewCssClass() {return $this->sFilePreviewCssClass;}
	/* @end method */

	/* @start method */
	public function setFilePreviewCssStyle($_sCssStyle) {$this->sFilePreviewCssStyle = (string)$_sCssStyle;}
	/* @end method */

	/* @start method */
	public function getFilePreviewCssStyle() {return $this->sFilePreviewCssStyle;}
	/* @end method */

	/* @start method */
	public function setFileExtensions($_asFileExtensions) {$this->asFileExtension = $_asFileExtensions;}
	/* @end method */

	/* @start method */
	public function addFileExtensions($_asFileExtensions) {$this->asFileExtension = array_merge($this->asFileExtension, $_asFileExtensions);}
	/* @end method */

	/* @start method */
	public function addFileExtension($_sFileExtension) {$this->asFileExtension[] = $_sFileExtension;}
	/* @end method */

	/* @start method */
	public function getFileExtensions() {return $this->asFileExtension;}
	/* @end method */
	
	// Database set and get...
	/*public function setDatabaseMySqlQuery($_oMySqlQuery) {$this->oDatabaseQuery = $_oMySqlQuery;}
	public function getDatabaseMySqlQuery() {return $this->oDatabaseQuery;}
	public function setDatabaseHost($_sHost) {$this->sDatabaseHost = (string)$_sHost;}
	public function setDatabaseDatabase($_sDatabase) {$this->sDatabaseDatabaseName = (string)$_sDatabase;}
	public function setDatabaseUsername($_sUsername) {$this->sDatabaseUsername = (string)$_sDatabaseUsername;}
	public function setDatabasePassword($_sPassword) {$this->sDatabasePassword = (string)$_sDatabasePassword;}

	public function setDatabaseDefaultHost() {$this->sDatabaseHost = PG_MYSQL_DATA_HOST;}
	public function setDatabaseDefaultDatabase() {$this->sDatabaseDatabaseName = PG_MYSQL_DATA_DATABASE;}
	public function setDatabaseDefaultUsernameAndPassword()
	{
		$this->sDatabaseUsername = PG_MYSQL_DATA_USER;
		$this->sDatabasePassword = PG_MYSQL_DATA_PASSWORD;
	}*/
	
	/* @start method */
	public function setDatabaseFolderTable($_sTable) {$this->sDatabaseFolderTableName = (string)$_sTable;}
	/* @end method */

	/* @start method */
	public function getDatabaseFolderTable() {return $this->sDatabaseFolderTableName;}
	/* @end method */

	/* @start method */
	public function setDatabaseFolderIDColumn($_sIDColumn) {$this->sDatabaseFolderIDColumn = (string)$_sIDColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseFolderIDColumn() {return $this->sDatabaseFolderIDColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseFolderLinkIDColumn($_sLinkIDColumn) {$this->sDatabaseFolderLinkIDColumn = (string)$_sLinkIDColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseFolderLinkIDColumn() {return $this->sDatabaseFolderLinkIDColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseFolderNameColumn($_sNameColumn) {$this->sDatabaseFolderNameColumn = (string)$_sNameColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseFolderNameColumn() {return $this->sDatabaseFolderNameColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseFolderTextColumn($_sTextColumn) {$this->sDatabaseFolderTextColumn = (string)$_sTextColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseFolderTextColumn() {return $this->sDatabaseFolderTextColumn;}
	/* @end method */
	
	/* @start method */
	public function setDatabaseImageTable($_sTable) {$this->sDatabaseImageTableName = (string)$_sTable;}
	/* @end method */

	/* @start method */
	public function getDatabaseImageTable() {return $this->sDatabaseImageTableName;}
	/* @end method */

	/* @start method */
	public function setDatabaseImageIDColumn($_sIDColumn) {$this->sDatabaseImageIDColumn = (string)$_sIDColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImageIDColumn() {return $this->sDatabaseImageIDColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseImageFolderIDColumn($_sFolderColumn) {$this->sDatabaseImageFolderIDColumn = (string)$_sFolderColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImageFolderIDColumn() {return $this->sDatabaseImageFolderIDColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseImageNameColumn($_sNameColumn) {$this->sDatabaseImageNameColumn = (string)$_sNameColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImageNameColumn() {return $this->sDatabaseImageNameColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseImagePathColumn($_sPathColumn) {$this->sDatabaseImagePathColumn = (string)$_sPathColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImagePathColumn() {return $this->sDatabaseImagePathColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseImagePreviewPathColumn($_sPreviewPathColumn) {$this->sDatabaseImagePreviewPathColumn = (string)$_sPreviewPathColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImagePreviewPathColumn() {return $this->sDatabaseImagePreviewPathColumn;}
	/* @end method */

	/* @start method */
	public function setDatabaseImageTextColumn($_sTextColumn) {$this->sDatabaseImageTextColumn = (string)$_sTextColumn;}
	/* @end method */

	/* @start method */
	public function getDatabaseImageTextColumn() {return $this->sDatabaseImageTextColumn;}
	/* @end method */
	
	/* @start method */
	public function displayNames($_bDisplay) {$this->bDisplayNames = $_bDisplay;}
	/* @end method */

	/* @start method */
	public function displayDescriptions($_bDisplay) {$this->bDisplayDescriptions = $_bDisplay;}
	/* @end method */

	// create and build...
	/* @start method */
	public function create() {return $this->create2(NULL, NULL, NULL, true);}
	/* @end method */

	/* @start method */
	public function create2($_iLayout, $_sStartPath, $_iDatabaseFolderID, $_bShowSubFolder) {return $this->create3($_iLayout, $_sStartPath, $_iDatabaseFolderID, $_bShowSubFolder, true);}
	/* @end method */

	/* @start method */
	public function build($_iLayout = NULL, $_sStartPath = NULL, $_iDatabaseFolderID = NULL, $_bShowSubFolder = NULL, $_bUpdateJSFiles = NULL)
	{
		if ($_bUpdateJSFiles === NULL) {$_bUpdateJSFiles = false;}
		
		if ($_iDatabaseFolderID != NULL) {$this->iDatabaseFolderID = (string)$_iDatabaseFolderID;}
		if ($_sStartPath != NULL) {$this->sStartPath = (string)$_sStartPath;}
	
		if ($this->sFolderURL == '') {$this->sFolderURL = $PHP_SELF ? $PHP_SELF : $_SERVER['PHP_SELF'];}
		$_sHTML = '';

		// Folder images and folders...
		if ($this->sStartPath != '') {$_asFile = $this->getFilesFromFolder3($this->sStartPath.$this->sPreviewSubPath, false);}

		// Database images and folders...
		if ($this->sDatabaseDatabaseName != '')
		{
			if (($this->sDatabaseFolderTableName != '') && ($this->sDatabaseImageTableName != '')
			&& ($this->sDatabaseFolderIDColumn != '') && ($this->sDatabaseFolderLinkIDColumn != '')
			&& ($this->sDatabaseFolderNameColumn != '')
			&& ($this->sDatabaseImageIDColumn != '') && ($this->sDatabaseImageFolderIDColumn != '')
			&& ($this->sDatabaseImageNameColumn != '') && ($this->sDatabaseImagePathColumn != ''))
			{
				if (($this->oDatabaseQuery == NULL) && ($oPGQuery != NULL)) {$this->oDatabaseQuery = $oPGQuery;}
				if ($this->oDatabaseQuery != NULL)
				{
					$_asFile = array_merge($_asFile, $this->getFilesFromDatabase3($_iDatabaseFolderID, false));
				}
			}
		}
	
		// $this->axFiles = $_asFile;
		$this->axFiles = $this->sortFiles($_asFile);
		
		if ($_bUpdateJSFiles == true)
		{
			$_sHTML .= '<script language="JavaScript" type="text/javascript">';
			$_sHTML .= 'if (typeof(oPGGallery) != \'undefined\') {';
				$_sHTML .= 'var iPGGalleryCategorieIndex = 0;';
				if ($this->bFoldersAreCategories == true)
				{
					for ($t=0; $t<count($this->axFiles['Folders']['Content']); $t++)
					{
						$_axFiles2 = $this->axFiles['Folders']['Content'][$t];
						$_sHTML .= 'iPGGalleryCategorieIndex = oPGGallery.addDetailFilesKategorie(); ';
						for ($i=0; $i<count($_axFiles2['Files']['Path']); $i++)
						{
							if ($_axFiles2['Files']['Path'][$i] != '')
							{
								$_sHTML .= 'oPGGallery.addDetailFile(iPGGalleryCategorieIndex, \''.$_axFiles2['Files']['Path'][$i].'\'); ';
							}
						}
					}
				}
				else
				{
					$_sHTML .= 'iPGGalleryCategorieIndex = oPGGallery.addDetailFilesKategorie(); ';
					for ($i=0; $i<count($this->axFiles['Files']['Path']); $i++)
					{
						if ($this->axFiles['Files']['Path'][$i] != '')
						{
							$_sHTML .= 'oPGGallery.addDetailFile(iPGGalleryCategorieIndex, \''.$this->axFiles['Files']['Path'][$i].'\'); ';
						}
					}
				}
			$_sHTML .= '} ';
			$_sHTML .= '</script>';
		}

		switch($this->iPreviewLayout)
		{
			case PG_GALLERY_PREVIEW_LAYOUT_SIMPLE_LIST:
				$_sHTML .= $this->buildPreviewSimpleList($this->axFiles, $_bShowSubFolder);
			break;

			case PG_GALLERY_PREVIEW_LAYOUT_DETAIL_LIST:
				$_sHTML .= $this->buildPreviewDetailList($this->axFiles, $_bShowSubFolder);
			break;

			case PG_GALLERY_PREVIEW_LAYOUT_COMPACT:
				$_sHTML .= $this->buildPreviewCompact($this->axFiles, $_bShowSubFolder);
			break;

			case PG_GALLERY_PREVIEW_LAYOUT_DETAIL:
				$_sHTML .= $this->buildPreviewDetail($this->axFiles, $_bShowSubFolder);
			break;
		}
		return $_sHTML;
	}
	/* @end method */
	
	/* @start method */
	public function buildPreviewSimpleList($_asFile, $_bShowSubFolder)
	{
		$_sHTML = '';
		// TODO
		return $_sHTML;
	}
	/* @end method */
	
	/* @start method */
	public function buildPreviewDetailList($_asFile, $_bShowSubFolder)
	{
		$_sHTML = '';
		// TODO
		return $_sHTML;
	}
	/* @end method */
	
	/* @start method */
	public function buildPreviewCompact($_asFile, $_bShowSubFolder)
	{
		global $oPGStringTool;
		
		$_iCurrentPreview = 0;
		$_iContainerSizeX = $this->iPreviewSizeX+8;
		$_iContainerSizeY = $this->iPreviewSizeY+$this->iPreviewDescriptionSizeY+8;
		
		$_sDivForcedStyle = 'float:left; overflow:hidden; display:block; ';
		$_sDivForcedStyle .= 'width:'.$_iContainerSizeX.'px; height:'.$_iContainerSizeY.'px; ';
		
		$_sDivDefaultStyle = 'vertical-align:top; text-align:center; margin:5px; padding:0px; background-color:#ffffff; border:solid 1px #000000; ';
		
		$_sEndGallery = '<div style="clear:both;"></div>';
		
		$_sHTML = '<div style="clear:both;"></div>';
	
		// folders...
		if (($_bUseSubFolder == true) || ($this->bFoldersAreCategories == true))
		{
			for ($i=0; $i<count($_asFile['Folders']['Path']); $i++)
			{
				$_sHTML .= '<div style="'.$_sDivForcedStyle;
				if ($this->sFolderCssStyle != '') {$_sHTML .= $this->sFolderCssStyle;}
				else if ($this->sFolderCssClass == '') {$_sHTML .= $_sDivDefaultStyle;}
				$_sHTML .= '" ';
				if ($this->sFolderCssClass != '') {$_sHTML .= 'class="'.$this->sFolderCssClass.'" ';}
				$_sHTML .= '>';
				if ($this->bFoldersAreCategories == true)
				{
					$_asFile2 = $_asFile['Folders']['Content'][$i];
					$_asFile['Folders']['Path'][$i] = $_asFile2['Files']['Path'][0];
					$_asFile['Folders']['PreviewPath'][$i] = $_asFile2['Files']['PreviewPath'][0];
					$_asFile['Folders']['Extension'][$i] = $_asFile2['Files']['Extension'][0];
					
					$_sTargetURL = '';
					$_sTargetURL .= $this->sDetailSubPath.$_asFile['Folders']['Path'][$i];
					$_sHTML .= '<a href="javascript:;" onclick="';
					$_sHTML .= 'oPGGallery.showDetail('.$i.', 0, \''.$_sTargetURL.'\'); ';
					$_sHTML .= '" target="_self" style="display:inline;">';

					$_iDetailSizeX = 750;
					$_iDetailSizeY = 500;
					$_bIsImage = false;
					
					if (($_asFile['Folders']['Extension'][$i] == 'jpeg')
					|| ($_asFile['Folders']['Extension'][$i] == 'jpg')
					|| ($_asFile['Folders']['Extension'][$i] == 'gif')
					|| ($_asFile['Folders']['Extension'][$i] == 'png'))
					{
						$_aiSize = getimagesize($_asFile['Folders']['Path'][$i]);
						$_iDetailSizeX = $_aiSize[0];
						$_iDetailSizeY = $_aiSize[1];
						$_bIsImage = true;
					}
		
					if (($this->iDetailMaxSizeX > 0) && ($this->iDetailMaxSizeX < $_iDetailSizeX)) {$_iDetailSizeX = $this->iDetailMaxSizeX;}
					if (($this->iDetailMaxSizeY > 0) && ($this->iDetailMaxSizeY < $_iDetailSizeY)) {$_iDetailSizeY = $this->iDetailMaxSizeY;}
				
					if ($_iDetailSizeX > $_iDetailSizeY)
					{
						$_iPreviewSizeX = $this->iPreviewSizeX;
						$_iPreviewSizeY = round($_iDetailSizeY/$_iDetailSizeX*$this->iPreviewSizeX, 0);
					}
					else if ($_iDetailSizeX < $_iDetailSizeY)
					{
						$_iPreviewSizeX = round($_iDetailSizeX/$_iDetailSizeY*$this->iPreviewSizeY, 0);
						$_iPreviewSizeY = $this->iPreviewSizeY;
					}
					else
					{
						$_iPreviewSizeX = $this->iPreviewSizeX;
						$_iPreviewSizeY = $this->iPreviewSizeY;
					}
					
					if ($_asFile['Folders']['PreviewPath'][$i] == '') {$_asFile['Folders']['PreviewPath'][$i] = $_asFile['Folders']['Path'][$i];}
					$_sHTML .= '<img src="'.$_asFile['Folders']['PreviewPath'][$i].'" ';
					$_sHTML .= 'style="width:'.$_iPreviewSizeX.'px; height:'.$_iPreviewSizeY.'px; ';
					$_sHTML .= 'border-width:0px; margin:2px;" />';
				}
				else
				{
					$_sHTML .= '<a href="'.$this->sFolderURL.'?sFolder=';
					$_sHTML .= $oPGStringTool->makeURLSafe($_asFile['Folders']['Path'][$i]);
					if ($this->sFolderURLParameters != '') {$_sHTML .= '&'.$this->sFolderURLParameters;}
					$_sHTML .= '" target="_self" style="display:inline;">';
					$_sHTML .= '<img src="'.$this->sFolderImageURL.'"';
					$_sHTML .= 'style="width:'.$_iPreviewSizeX.'px; height:'.$_iPreviewSizeY.'px; ';
					$_sHTML .= 'border-width:0px; margin:2px;" />';
				}
				$_sHTML .= '<br />';
				$_sHTML .= $_asFile['Folders']['Name'][$i];
				$_sHTML .= '</a>';
				$_sHTML .= '</div>';
				$_iCurrentPreview++;
			}
		}
		
		if (($this->iPreviewsPerPage <= $_iCurrentPreview+10) && ($this->iPreviewsPerPage > 0))
		{
			$this->iPreviewsPerPage = $_iCurrentPreview+10;
		}
		
		if ($this->bFoldersAreCategories == false)
		{
			// files...
			for ($i=0; $i<count($_asFile['Files']['Path']); $i++)
			{
				$_iDetailSizeX = 750;
				$_iDetailSizeY = 500;
				$_bIsImage = false;
				
				if (($_asFile['Files']['Extension'][$i] == 'jpeg')
				|| ($_asFile['Files']['Extension'][$i] == 'jpg')
				|| ($_asFile['Files']['Extension'][$i] == 'gif')
				|| ($_asFile['Files']['Extension'][$i] == 'png'))
				{
					$_aiSize = getimagesize($_asFile['Files']['Path'][$i]);
					$_iDetailSizeX = $_aiSize[0];
					$_iDetailSizeY = $_aiSize[1];
					$_bIsImage = true;
				}
	
				if (($this->iDetailMaxSizeX > 0) && ($this->iDetailMaxSizeX < $_iDetailSizeX)) {$_iDetailSizeX = $this->iDetailMaxSizeX;}
				if (($this->iDetailMaxSizeY > 0) && ($this->iDetailMaxSizeY < $_iDetailSizeY)) {$_iDetailSizeY = $this->iDetailMaxSizeY;}
				
				$_sHTML .= '<div style="'.$_sDivForcedStyle;
				/*
				if (($_iCurrentPreview >= $this->iPreviewsPerPage) && ($this->iPreviewsPerPage > 0)) {$_sHTML .= 'float:none; ';}
				else if ($_iCurrentPreview >= count($_asFile['Files'])-1) {$_sHTML .= 'float:none; ';}
				else {$_sHTML .= 'float:left; ';}
				*/
				if ($this->sFilePreviewCssStyle != '') {$_sHTML .= $this->sFilePreviewCssStyle;}
				else if ($this->sFilePreviewCssClass == '') {$_sHTML .= $_sDivDefaultStyle;}
				$_sHTML .= '" ';
				if ($this->sFilePreviewCssClass != '') {$_sHTML .= 'class="'.$this->sFilePreviewCssClass.'" ';}
				$_sHTML .= '>';
				if ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_POPUP)
				{
					$_sTargetURL = '';
					if ($this->sDetailURL != '') {$_sTargetURL .= $this->sDetailURL.'?sImg=';}
					$_sTargetURL .= $this->sDetailSubPath.$_asFile['Files']['Path'][$i];
					$_sHTML .= '<a href="javascript:;" target="_self" style="display:inline;" ';
					$_sHTML .= 'onclick="oPGBrowser.popup3(\''.$_sTargetURL.'\', '.($_iDetailSizeX+40).', '.($_iDetailSizeY+40).');" ';
					$_sHTML .= '>';
				}
				else if ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_SELF)
				{
					$_sTargetURL = '';
					if ($this->sDetailURL != '') {$_sTargetURL .= $this->sDetailURL.'?sImg=';}
					$_sTargetURL .= $this->sDetailSubPath.$_asFile['Files']['Path'][$i];
					$_sHTML .= '<a href="'.$_sTargetURL.'" target="_self" style="display:inline;">';
				}
				else if (($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE)
				|| ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION)
				|| ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
				|| ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL)
				|| ($this->iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_3D))
				{
					$_sTargetURL = '';
					$_sTargetURL .= $this->sDetailSubPath.$_asFile['Files']['Path'][$i];
					$_sHTML .= '<a href="javascript:;" onclick="';
					$_sHTML .= 'oPGGallery.showDetail(0, '.$i.', \''.$_sTargetURL.'\'); ';
					$_sHTML .= '" target="_self" style="display:inline;">';
				}
				
				if ($_bIsImage == true)
				{
					if ($_iDetailSizeX > $_iDetailSizeY)
					{
						$_iPreviewSizeX = $this->iPreviewSizeX;
						$_iPreviewSizeY = round($_iDetailSizeY/$_iDetailSizeX*$this->iPreviewSizeX, 0);
					}
					else if ($_iDetailSizeX < $_iDetailSizeY)
					{
						$_iPreviewSizeX = round($_iDetailSizeX/$_iDetailSizeY*$this->iPreviewSizeY, 0);
						$_iPreviewSizeY = $this->iPreviewSizeY;
					}
					else
					{
						$_iPreviewSizeX = $this->iPreviewSizeX;
						$_iPreviewSizeY = $this->iPreviewSizeY;
					}
					
					if ($_asFile['Files']['PreviewPath'][$i] == '') {$_asFile['Files']['PreviewPath'][$i] = $_asFile['Files']['Path'][$i];}
					$_sHTML .= '<img src="'.$_asFile['Files']['PreviewPath'][$i].'" ';
					$_sHTML .= 'style="width:'.$_iPreviewSizeX.'px; height:'.$_iPreviewSizeY.'px; ';
					$_sHTML .= 'border-width:0px; margin:2px;" />';
					$_sHTML .= '<br />';
				}
				
				if ($this->bDisplayNames == true)
				{
					if ($_asFile['Files']['Text'][$i] != '') {$_sHTML .= $_asFile['Files']['Text'][$i];}
					else {$_sHTML .= $_asFile['Files']['Name'][$i];}
				}
				$_sHTML .= '</a>';
				if ($this->bDisplayDescriptions == true)
				{
					$_sHTML .= '<div style="font-size:10px; font-family:Verdana, Arial;">';
					$_sHTML .= $_asFile['Files']['Description'][$i];
					$_sHTML .= '</div>';
				}
				$_sHTML .= '</div>';
				
				if (($_iCurrentPreview >= $this->iPreviewsPerPage) && ($this->iPreviewsPerPage > 0)) {return $_sHTML.$_sEndGallery;}
				$_iCurrentPreview++;
			}
		}
		return $_sHTML.$_sEndGallery;
	}
	/* @end method */
	
	/* @start method */
	public function buildPreviewDetail($_asFile, $_bShowSubFolder)
	{
		$_sHTML = '';
		// TODO
		return $_sHTML;
	}
	/* @end method */

	/* @start method */
	public function getFiles() {return $this->getFilesFromFolder2($this->sStartPath);}
	/* @end method */

	/* @start method */
	public function getFilesCount() {return count($this->axFiles);}
	/* @end method */
	
	/* @start method */
	public function getFilesFromDatabase($_iFolderID) {return $this->getFilesFromDatabase2($_iFolderID, false);}
	/* @end method */

	/* @start method */
	public function getFilesFromDatabase2($_iFolderID) {return $this->getFilesFromDatabase2($_iFolderID, true);}
	/* @end method */

	/* @start method */
	public function getFilesFromDatabase3($_iFolderID, $_bShowSubFolder)
	{
		$_iCurrentFile = 0;
		$_iCurrentFolder = 0;
		$_asFile = array();
		
		// connect to folder database...
		if ($this->sDatabaseHost == '')
		{
			$this->sDatabaseHost = PG_MYSQL_DATA_HOST;
			$this->sDatabaseUsername = PG_MYSQL_DATA_USER;
			$this->sDatabasePassword = PG_MYSQL_DATA_PASSWORD;
			if ($this->sDatabaseDatabaseName == '') {$this->sDatabaseDatabaseName = PG_MYSQL_DATA_DATABASE;}
		}
		$this->oDatabaseQuery->connect($this->sDatabaseHost, $this->sDatabaseUsername, $this->sDatabasePassword);
		$this->oDatabaseQuery->changeDatabase($this->sDatabaseDatabaseName);

		$_sSql = 'SELECT '.$this->sDatabaseFolderIDColumn.', ';
		if ($this->sDatabaseFolderTextColumn != '') {$_sSql .= $this->sDatabaseFolderTextColumn.' ';}
		$_sSql .= $this->sDatabaseFolderNameColumn.' ';
		$_sSql .= 'FROM '.$this->sDatabaseFolderTableName.' ';
		$_sSql .= 'WHERE '.$this->sDatabaseFolderLinkIDColumn.' = \''.$_iFolderID.'\' ';
		$_sSql .= 'ORDER BY '.$this->sDatabaseFolderNameColumn.' ASC';
		if ($_oRes = $this->oQuery->sendSql($_sSql))
		{
			while ($_axFolder = mysql_fetch_array($_oRes))
			{
				$_asFile['Folders']['ID'][$_iCurrentFolder] = $_axFolder[$this->sDatabaseFolderIDColumn];
				$_asFile['Folders']['Path'][$_iCurrentFolder] = '';
				$_asFile['Folders']['PreviewPath'][$_iCurrentFolder] = '';
				$_asFile['Folders']['Name'][$_iCurrentFolder] = $_axFolder[$this->sDatabaseFolderNameColumn];
				$_asFile['Folders']['Text'][$_iCurrentFolder] = $_axFolder[$this->sDatabaseFolderTextColumn];
				$_asFile['Folders']['Content'][$_iCurrentFolder] = $this->getFilesFromDatabase2($_axFolder[$this->sDatabaseFolderIDColumn]);
				$_iCurrentFolder++;
			} // while _axFolder
		} // if _oRes

		$_sSql = 'SELECT '.$this->sDatabaseImageIDColumn.', ';
		$_sSql .= $this->sDatabaseImageNameColumn.', ';
		if ($this->sDatabaseImagePreviewPathColumn != '') {$_sSql .= $this->sDatabaseImagePreviewPathColumn.', ';}
		if ($this->sDatabaseImageTextColumn != '') {$_sSql .= $this->sDatabaseImageTextColumn.', ';}
		$_sSql .= $this->sDatabaseImagePathColumn.' ';
		$_sSql .= 'FROM '.$this->sDatabaseImageTableName.' ';
		$_sSql .= 'WHERE '.$this->sDatabaseImageFolderIDColumn.' = \''.$_iFolderID.'\' ';
		$_sSql .= 'ORDER BY '.$this->sDatabaseImageNameColumn.' ASC';
		if ($_oRes = $this->oQuery->sendSql($_sSql))
		{
			while ($_axFile = mysql_fetch_array($_oRes))
			{
				if ($this->isFileAllowed($_axFile[$this->sDatabaseImagePathColumn]))
				{
					$_sFileExtension = $this->getFileExtension($_axFile[$this->sDatabaseImagePathColumn]);
					$_asFile['Files']['ID'][$_iCurrentFile] = $_axFile[$this->sDatabaseImageIDColumn];
					$_asFile['Files']['Path'][$_iCurrentFile] = $_axFile[$this->sDatabaseImagePathColumn];
					$_asFile['Files']['PreviewPath'][$_iCurrentFile] = $_axFile[$this->sDatabaseImagePreviewPathColumn];
					$_asFile['Files']['Name'][$_iCurrentFile] = $_axFile[$this->sDatabaseImageNameColumn];
					$_asFile['Files']['Text'][$_iCurrentFile] = $_axFile[$this->sDatabaseImageTextColumn];
					$_asFile['Files']['Extension'][$_iCurrentFile] = $_sFileExtension;
					$_iCurrentFile++;
				}
			} // while _axFile
		} // if _oRes

		return $_asFile;
	}
	/* @end method */
	
	/* @start method */
	public function getFilesFromFolder($_sPath) {return $this->getFilesFromFolder3($_sPath, false);}
	/* @end method */

	/* @start method */
	public function getFilesFromFolder2($_sPath) {return $this->getFilesFromFolder3($_sPath, true);}
	/* @end method */

	/* @start method */
	public function getFilesFromFolder3($_sPath, $_bSearchSubFolder)
	{
		$_iCurrentFile = 0;
		$_iCurrentFolder = 0;
		$_asFile = array();
		if ($_oFp = opendir($_sPath))
		{
			while ($_sFile = readdir($_oFp))
			{
				// ignore \. , \..
				if (preg_match("!^\.{1,2}$!", $_sFile)) {continue;}

				$_sFileName = $_sFile;
				$_sFileName = str_replace("\\", '', $_sFileName);
				$_sFileName = str_replace("/", '', $_sFileName);

				if(is_dir($_sPath.$_sFile))
				{
					$_asFile['Folders']['ID'][$_iCurrentFolder] = 0;
					$_asFile['Folders']['Path'][$_iCurrentFolder] = $_sPath.$_sFile;
					$_asFile['Folders']['PreviewPath'][$_iCurrentFolder] = '';
					$_asFile['Folders']['Extension'][$_iCurrentFolder] = '';
					/*if ($this->bFoldersAreCategories == true)
					{
						$_sPath2 = $_sPath.$_sFile.'/';
						if ($_oFp2 = opendir($_sPath2))
						{
							while ($_sFile2 = readdir($_oFp2))
							{
								// ignore \. , \..
								if (preg_match("!^\.{1,2}$!", $_sFile2)) {continue;}
				
								$_sFileName2 = $_sFile2;
								$_sFileName2 = str_replace("\\", '', $_sFileName2);
								$_sFileName2 = str_replace("/", '', $_sFileName2);
								
								if (!is_dir($_sPath2.$_sFile2))
								{
									if ($this->isFileAllowed($_sFileName2))
									{
										$_sFileExtension2 = $this->getFileExtension($_sFileName2);
										$_asFile['Folders']['Path'][$_iCurrentFolder] = $_sPath2.$_sFile2;
										$_asFile['Folders']['PreviewPath'][$_iCurrentFolder] = '';
										$_asFile['Folders']['Extension'][$_iCurrentFolder] = $_sFileExtension2;
										break;
									}
								}
							}
						}
					}*/
					$_asFile['Folders']['Name'][$_iCurrentFolder] = $_sFileName;
					$_asFile['Folders']['Text'][$_iCurrentFolder] = '';

					if (($_bSearchSubFolder == true) || ($this->bFoldersAreCategories == true))
					{
						$_asFile['Folders']['Content'][$_iCurrentFolder] = $this->getFilesFromFolder3($_sPath.$_sFile.'/', $_bSearchSubFolder);
					}
					$_iCurrentFolder++;
				}
				else
				{
					if ($this->isFileAllowed($_sFileName))
					{
						$_sFileExtension = $this->getFileExtension($_sFileName);
						$_asFile['Files']['ID'][$_iCurrentFile] = 0;
						$_asFile['Files']['Path'][$_iCurrentFile] = $_sPath.$_sFile;
						$_asFile['Files']['PreviewPath'][$_iCurrentFile] = '';
						$_asFile['Files']['Name'][$_iCurrentFile] = $_sFileName;
						$_asFile['Files']['Text'][$_iCurrentFile] = '';
						$_asFile['Files']['Extension'][$_iCurrentFile] = $_sFileExtension;
						$_iCurrentFile++;
					}
				}
			}
			closedir($_oFp);
		}
		return $_asFile;
	}
	/* @end method */
	
	/* @start method */
	public function sortFiles($_asFile)
	{
		if (($_asFile['Folders']['Name'] != NULL) && (isset($_asFile['Folders']['Name'])))
		{
			array_multisort($_asFile['Folders']['Name'], SORT_ASC, 
							$_asFile['Folders']['ID'], 
							$_asFile['Folders']['Path'], 
							$_asFile['Folders']['PreviewPath'], 
							$_asFile['Folders']['Text'], 
							$_asFile['Folders']['Extension'], 
							$_asFile['Folders']['Content']);
			
			for ($i=0; $i<count($_asFile['Folders']['Content']); $i++)
			{
				if (($_asFile['Folders']['Content'] != NULL) && (isset($_asFile['Folders']['Content'])))
				{
					array_multisort($_asFile['Folders']['Content'][$i]['Files']['Name'], SORT_ASC,
									$_asFile['Folders']['Content'][$i]['Files']['ID'],
									$_asFile['Folders']['Content'][$i]['Files']['Path'],
									$_asFile['Folders']['Content'][$i]['Files']['PreviewPath'],
									$_asFile['Folders']['Content'][$i]['Files']['Text'],
									$_asFile['Folders']['Content'][$i]['Files']['Extension']);
				}
			}
		}
		
		if (($_asFile['Files']['Name'] != NULL) && (isset($_asFile['Files']['Name'])))
		{
			array_multisort($_asFile['Files']['Name'], SORT_ASC,
							$_asFile['Files']['ID'],
							$_asFile['Files']['Path'],
							$_asFile['Files']['PreviewPath'],
							$_asFile['Files']['Text'],
							$_asFile['Files']['Extension']);
		}

		return $_asFile;
	}
	/* @end method */
	
	/* @start method */
	public function getFileExtension($_sFileName)
	{
		return strtolower(str_replace(".", "", strrchr($_sFileName, ".")));
	}
	/* @end method */
	
	/* @start method */
	public function isFileAllowed($_sFileName)
	{
		$_sFileExtension = $this->getFileExtension($_sFileName);
		if (($this->asFileExtension === NULL) || (count($this->asFileExtension) < 1)) {return true;}
		else
		{
			for ($i=0; $i<count($this->asFileExtension); $i++)
			{
				if (strtolower($this->asFileExtension[$i]) == $_sFileExtension) {return true;}
			}
		}
		return false;
	}
	/* @end method */
}
/* @end class */
$oPGGallery = new classPG_Gallery();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGGallery', 'xValue' => $oPGGallery));}
?>