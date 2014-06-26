<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 17 2012
*/
/*
	Schritt 1: auslesen der Dateien und Verzeichnisse
	Schritt 2: löschen der Daten in der Datenbank (TRUNCATE)
	Schritt 2: per Netzwerkaufruf (Ajax) jede Datei einzelnd durchgehen und einen Ladebalken anzeigen
	Schritt 3: jede Datei wird geparst mit codeparser.php
	Schritt 4: mit dem geparsten Datei-Content die Datenbank befüllen
*/
define('PG_DOCUPARSER_NETWORK_REQUESTTYPE', 'PGDocuParserNetworkResquestType');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_DocuParser extends classPG_ClassBasics
{
	// Declarations...
	private $sStartPath = '';
	private $asParsed = array();

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDocuParser'));
		$this->initClassBasics();
		$this->initDatabase();
		$this->initNetwork();
	}
	
	// Methods...
	/*
	@start method
	@param oDocumentation
	*/
	public function init($_oDocumentation = NULL)
	{
		$_oDocumentation = $this->getRealParameter(array('oParameters' => $_oDocumentation, 'sName' => 'oDocumentation', 'xParameter' => $_oDocumentation));
		
		if ($_oDocumentation != NULL)
		{
			$this->setDatabase(array('oDatabase' => $_oDocumentation->getDatabase()));
			$this->setDatabaseTablePrefix(array('sPrefix' => $_oDocumentation->getDatabaseTablePrefix()));
		}
	}
	/* @end method */
	
	/*
	@start method
	@param asClass
	@param sLanguage
	*/
	public function getParsedClass($_asClass, $_sLanguage = NULL)
	{
		global $oPGCodeParser;

		$_sLanguage = $this->getRealParameter(array('oParameters' => $_asClass, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_asClass = $this->getRealParameter(array('oParameters' => $_asClass, 'sName' => 'asClass', 'xParameter' => $_asClass, 'bNotNull' => true));

		// Class Description...
		$_sDescription = '';
		if (isset($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['description']))
		{
			$_asDescription = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['description'];
			for ($_iDescriptionIndex = 0; $_iDescriptionIndex<count($_asDescription); $_iDescriptionIndex++)
			{
				if (trim($_asDescription[$_iDescriptionIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
				{
					$_sDescription .= $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asDescription[$_iDescriptionIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					);
				}
			}
		}
		
		// Class Default Object...
		$_sDefaultObject = '';
		$_sDefaultObjectDescription = '';
		if (isset($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['object']))
		{
			$_sDefaultObject = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['object'][0][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT];
			$_sDefaultObjectDescription = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['object'][0][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT];
		}
		
		// TODO: Class ExampleCode...
		// TODO: Class DefaultObject...
		// TODO: Class Permission...
		
		$_axMethods = array();
		if (isset($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT]))
		{
			for ($_iMethodIndex = 0; $_iMethodIndex<count($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT]); $_iMethodIndex++)
			{
				$_asMethod = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT][$_iMethodIndex];
				$_asMethod['sClassName'] = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_NAME];
				$_axMethods[$_iMethodIndex] = $this->getParsedMethod(
					array(
						'iClassID' => NULL,
						'asMethod' => $_asMethod, 
						'sLanguage' => $_sLanguage
					)
				);
			}
		}
	
		return array(
			'iClassID' => NULL, 
			'sName' => $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_NAME], 
			'sExtends' => $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_EXTENDS], 
			'sPermission' => NULL, 
			'sType' => 'class', 
			'sLocation' => $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_LOCATION],
			'sDefaultObject' => $_sDefaultObject,
			'sDefaultObjectDescription' => $_sDefaultObjectDescription,
			'sDescription' => $_sDescription, 
			'sExampleCode' => NULL, 
			'sProgrammingLanguage' => 'php',
			'axMethods' => $_axMethods,
			'sLanguage' => $_sLanguage
		);
	}
	/* @end method */
	
	/*
	@start method
	@param asClass
	@param sLanguage
	*/
	public function saveClass($_asClass, $_sLanguage = NULL)
	{
		global $oPGDocumentation;

		$_sLanguage = $this->getRealParameter(array('oParameters' => $_asClass, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_asClass = $this->getRealParameter(array('oParameters' => $_asClass, 'sName' => 'asClass', 'xParameter' => $_asClass, 'bNotNull' => true));

		if ($_iClassID = $oPGDocumentation->saveClass($this->getParsedClass(array('asClass' => $_asClass, 'sLanguage' => $_sLanguage))))
		{
			if (isset($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT]))
			{
				for ($_iMethodIndex = 0; $_iMethodIndex<count($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT]); $_iMethodIndex++)
				{
					$_asMethod = $_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT][$_iMethodIndex];
					$this->saveMethod(array('iClassID' => $_iClassID, 'asMethod' => $_asMethod));
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	@param asMethod
	@param sLanguage
	*/
	public function getParsedMethod($_iClassID, $_asMethod = NULL, $_sLanguage = NULL)
	{
		global $oPGCodeParser;

		$_asMethod = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'asMethod', 'xParameter' => $_asMethod));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		
		// Method Group...
		$_sGroup = '';
		$_sGroupDescription = '';
		if (isset($_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['group']))
		{
			$_asGroups = $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['group'];
			for ($_iGroupIndex = 0; $_iGroupIndex<count($_asGroups); $_iGroupIndex++)
			{
				$_sGroup = $_asGroups[$_iGroupIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT];
				if (trim($_asGroups[$_iGroupIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
				{
					$_sGroupDescription = $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asGroups[$_iGroupIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					);
				}
			}
		}
		
		// Method Return...
		$_sReturnVariable = '';
		$_sReturnValue = '';
		$_sReturnType = '';
		if (isset($_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['return']))
		{
			$_asReturns = $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['return'];
			for ($_iReturnIndex = 0; $_iReturnIndex<count($_asReturns); $_iReturnIndex++)
			{
				$_sReturnVariable = $_asReturns[$_iReturnIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT];
				if (trim($_asReturns[$_iReturnIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
				{
					$_sReturnValue = $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asReturns[$_iReturnIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					);
					$_sReturnType = implode(' | ', $oPGCodeParser->parseCommentsTypes(array('sString' => $_asReturns[$_iReturnIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT])));
				}
			}
		}
		
		// Method Description...
		$_sDescription = '';
		if (isset($_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['description']))
		{
			$_asDescription = $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['description'];
			for ($_iDescriptionIndex = 0; $_iDescriptionIndex<count($_asDescription); $_iDescriptionIndex++)
			{
				if (trim($_asDescription[$_iDescriptionIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
				{
					$_sDescription .= $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asDescription[$_iDescriptionIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					);
				}
			}
		}
		
		// Method Details...
		$_sDetailDescription = '';
		if (isset($_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['details']))
		{
			$_asDetails = $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['details'];
			for ($_iDetailsIndex = 0; $_iDetailsIndex<count($_asDetails); $_iDetailsIndex++)
			{
				if (trim($_asDetails[$_iDetailsIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
				{
					$_sDetailDescription .= $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asDetails[$_iDetailsIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					);
				}
			}
		}
		
		// Method Parameters...
		$_axParameters = array();
		if (isset($_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['param']))
		{
			$_asParameters = $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]['param'];
			for ($_iParametersIndex=0; $_iParametersIndex<count($_asParameters); $_iParametersIndex++)
			{
				$_axParameters[$_iParametersIndex] = array(
					'iParameterID' => NULL,
					'sName' => $_asParameters[$_iParametersIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT],
					'sType' => implode(' | ', $oPGCodeParser->parseCommentsTypes(array('sString' => $_asParameters[$_iParametersIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]))),
					'sDefaultValue' => '', // TODO
					'sDescription' => $oPGCodeParser->parseCommentsLanguage(
						array(
							'sString' => $_asParameters[$_iParametersIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]."\n", 
							'sLanguage' => $_sLanguage
						)
					),
					'bIsNeeded' => $oPGCodeParser->parseCommentsIsNeeded(array('sString' => $_asParameters[$_iParametersIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]))
				);
			}
		}
		
		return array(
			'iMethodID' => NULL, 
			'iClassID' => $_iClassID, 
			'sClassName' => $_asMethod['sClassName'],
			'sGroup' => $_sGroup,
			'sGroupDescription' => $_sGroupDescription,
			'sPermission' => $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_PERMISSION], 
			'sType' => $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_TYPE], 
			'sName' => $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_NAME], 
		//	'sParameters' => $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_PARAMETERS],
			'axParameters' => $_axParameters,
			'sReturnVariable' => $_sReturnVariable, 
			'sReturnValue' => $_sReturnValue,
			'sReturnType' => $_sReturnType, 
			'sDescription' => $_sDescription, 
			'sDetailDescription' => $_sDetailDescription,
			'sExampleCode' => '', 
			'sProgrammingLanguage' => '', 
			'sLocation' => $_asMethod[PG_CODEPARSER_PARSE_METHOD_INDEX_LOCATION],
			'sLanguage' => $_sLanguage
		);
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	@param asMethod
	@param sLanguage
	*/
	public function saveMethod($_iClassID, $_asMethod = NULL, $_sLanguage = NULL)
	{
		global $oPGDocumentation;

		$_asMethod = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'asMethod', 'xParameter' => $_asMethod));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));

		if ($oPGDocumentation->saveMethod($this->getParsedMethod(array('iClassID' => $_iClassID, 'asMethod' => $_asMethod, 'sLanguage' => $_sLanguage))))
		{
			// TODO: save MethodParameters...
		}
	}
	/* @end method */

	/*
	@start method
	@param sFile
	*/
	public function setNetworkMainData($_sPath, $_sFile = NULL)
	{
		global $oPGCodeParser, $oPGDocumentation;
		
		$_asLanguages = array('en', 'de');

		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		if ($_sFile != '')
		{
			$_asParsedCode = $oPGCodeParser->parseFile(array('sPath' => $_sPath, 'sFile' => $_sFile));
			for ($_iIndex=0; $_iIndex<count($_asParsedCode); $_iIndex++)
			{
				if (isset($_asParsedCode[$_iIndex][PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]))
				{
					if ($_asParsedCode[$_iIndex][PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT]['start'][0][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT] == 'class')
					{
						for ($_iLanguageIndex=0; $_iLanguageIndex<count($_asLanguages); $_iLanguageIndex++)
						{
							$_asClass = $_asParsedCode[$_iIndex];
							$this->saveClass(array('asClass' => $_asClass, 'sLanguage' => $_asLanguages[$_iLanguageIndex]));
						}
					}
				}
			}
		}
		
		$this->addNetworkData(array('sName' => 'PG_RequestType', 'xValue' => PG_DOCUPARSER_NETWORK_REQUESTTYPE));
		$this->addNetworkData(array('sName' => 'PG_FilesParsed_Successed', 'xValue' => $this->iFilesParsedSuccessed));
		$this->addNetworkData(array('sName' => 'PG_FilesParsed_Failed', 'xValue' => $this->iFilesParsedFailed));
	}
	/* @end method */
	
	public function parseFile($_sPath, $_sFile = NULL)
	{
		global $oPGCodeParser;

		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		$this->asParsed = $oPGCodeParser->parseFile(array('sPath' => $_sPath, 'sFile' => $_sFile));
		return $this->asParsed;
	}
	
	public function getClass($_sClass, $_sLanguage = NULL)
	{
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));

		for ($_iClassIndex=0; $_iClassIndex<count($this->asParsed); $_iClassIndex++)
		{
			$_asClass = $this->asParsed[$_iClassIndex];
			if (strtolower($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_NAME]) == strtolower($_sClass)) {return $this->getParsedClass(array('asClass' => $_asClass, 'sLanguage' => $_sLanguage));}
		}
		return NULL;
	}
	
	public function getMethod($_sClass, $_sMethod = NULL, $_sLanguage = NULL)
	{
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));

		for ($_iClassIndex=0; $_iClassIndex<count($this->asParsed); $_iClassIndex++)
		{
			$_asClass = $this->asParsed[$_iClassIndex];
			if (strtolower($_asClass[PG_CODEPARSER_PARSE_CLASS_INDEX_NAME]) == strtolower($_sClass))
			{
				$_axClass = $this->getParsedClass(array('asClass' => $_asClass, 'sLanguage' => $_sLanguage));
				for ($_iMethodIndex=0; $_iMethodIndex<count($_axClass['axMethods']); $_iMethodIndex++)
				{
					if ($_axClass['axMethods'][$_iMethodIndex]['sName'] == $_sMethod)
					{
						return $_axClass['axMethods'][$_iMethodIndex];
					}
				}
			}
		}
		return NULL;
	}
	
	public function getParsedMenuPoints($_sPath, $_axParsedMenuPoints = NULL)
	{
		$_axParsedMenuPoints = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'axParsedMenuPoints', 'xParameter' => $_axParsedMenuPoints));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		$_axMenuPoints = array();
		$_iMenuPointIndex = 0;
		
		if (isset($_axParsedMenuPoints['axFolders']))
		{
			for ($_iFolderIndex=0; $_iFolderIndex<count($_axParsedMenuPoints['axFolders']); $_iFolderIndex++)
			{
				$_axFolder = $_axParsedMenuPoints['axFolders'][$_iFolderIndex];
				
				$_axMenuPoints[$_iMenuPointIndex] = array(
					'iClassID' => NULL,
					'sName' => $_axFolder['sName'],
					'sFile' => str_replace($_sPath, '', $_axFolder['sPath']),
					'sClass' => 'classPG_'.$_axFolder['sName'],
					'sType' => 'folder'
				);
				
				if (isset($_axFolder['axContent']))
				{
					$_axMenuPoints[$_iMenuPointIndex]['axSubMenu'] = $this->getParsedMenuPoints(array('sPath' => $_sPath, 'axParsedMenuPoints' => $_axFolder['axContent']));
				}

				$_iMenuPointIndex++;
			}
		}
		
		if (isset($_axParsedMenuPoints['axFiles']))
		{
			for ($_iFileIndex=0; $_iFileIndex<count($_axParsedMenuPoints['axFiles']); $_iFileIndex++)
			{
				$_axFile = $_axParsedMenuPoints['axFiles'][$_iFileIndex];
				
				$_sName = $_axFile['sName'];
				if ($_iSubStr = strlen(strchr($_axFile['sName'], '.')))
				{
					$_sName = substr($_axFile['sName'], 0, strlen($_axFile['sName'])-$_iSubStr);
				}
				
				$_axMenuPoints[$_iMenuPointIndex] = array(
					'iClassID' => NULL,
					'sName' => $_axFile['sName'],
					'sFile' => str_replace($_sPath, '', $_axFile['sPath']),
					'sClass' => 'classPG_'.$_sName,
					'sType' => 'file'
				);

				$_iMenuPointIndex++;
			}
		}
		
		return $_axMenuPoints;
	}
	
	public function getMenuPoints($_sPath)
	{
		global $oPGFileSystem;
	
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		$_axParsedMenuPoints = $oPGFileSystem->read(array('sPath' => $_sPath, 'bSearchSubFolders' => true, 'asFileExtensions' => array('js', 'php'), 'bIgnoreRootFiles' => true, 'sSearchFor' => 'both'));
		$_axMenu = $this->getParsedMenuPoints(array('sPath' => $_sPath, 'axParsedMenuPoints' => $_axParsedMenuPoints));
		
		return $_axMenu;
	}
	
	/*
	@start method
	*/
	public function buildPreview($_sPath, $_sFile = NULL, $_sLanguage = NULL)
	{
		global $oPGDocumentation, $oPGCodeParser;
		
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		if ($_sLanguage === NULL) {$_sLanguage = 'en';}
		
		$_sHtml = '';
		$_asParsed = $oPGCodeParser->parseFile(array('sPath' => $_sPath, 'sFile' => $_sFile));
		
		$_axMenuPoints = $oPGDocumentation->parseMenuPoints(array('sPath' => $_sPath));
		$_sHtml .= $oPGDocumentation->buildMenuPoints(array('axMenuPoints' => $_axMenuPoints));
		
		// $oPGDocumentation->setUrl('index.php');
		// $oPGDocumentation->setUrlTarget('_self');
		for ($_iClassIndex=0; $_iClassIndex<count($_asParsed); $_iClassIndex++)
		{
			$_asClass = $_asParsed[$_iClassIndex];
			$_asClass['sLocation'] = $_sFile;
			$_asClass['sExampleCode'] = '';
			$_axClass = $this->getParsedClass(array('asClass' => $_asClass, 'sLanguage' => $_sLanguage));
			
			$_sHtml .= $oPGDocumentation->buildClass(array('axClass' => $_axClass, 'xDetailed' => true, 'bUseHtmlFiles' => false));
		}
		
		$_sHtml .= $oPGDocumentation->buildMethod(array('axMethod' => $_axClass['axMethods'][1], 'xDetailed' => true, 'bUseHtmlFiles' => false));
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	@param sUpdateScriptPath
	@param bUpdateHistoryInfo
	*/
	public function build($_sUpdateScriptPath = NULL, $_bUpdateHistoryInfo = NULL)
	{
		global $oPGProgressBar;

		$_bUpdateHistoryInfo = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'bUpdateHistoryInfo', 'xParameter' => $_bUpdateHistoryInfo));
		$_sUpdateScriptPath = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'sUpdateScriptPath', 'xParameter' => $_sUpdateScriptPath));

		$_sHtml = '';
		
		$_sSizeX = '350px';
		if (isset($oPGProgressBar))
		{
			$_sProgressBarID = $this->getID().'ProgressBar';
			$_iType = PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR;
			$_sSizeY = '25px';
			$_sBackgroundCssClass = NULL;
			$_sBackgroundCssStyle = NULL;
			$_sBarCssClass = NULL;
			$_sBarCssStyle = NULL;
			$_sHtml .= $oPGProgressBar->build(
				array(
					'sProgressBarID' => $_sProgressBarID, 
					'iType' => $_iType, 
					'sSizeX' => $_sSizeX, 
					'sSizeY' => $_sSizeY, 
					'sBackgroundCssClass' => $_sBackgroundCssClass, 
					'sBackgroundCssStyle' => $_sBackgroundCssStyle, 
					'sBarCssClass' => $_sBarCssClass, 
					'sBarCssStyle' => $_sBarCssStyle
				)
			);
		}

		if ($_bUpdateHistoryInfo == true) {$_sHtml .= '<div id="'.$this->getID().'HistoryInfo" style="width:'.$_sSizeX.';"></div>';}
		
		$_axFilesAndFolders = $oPGFileSystem->readFolder(
			array(
				'sPath' => $this->sStartPath, 
				'bSearchSubFolders' => true, 
				'asFileExtensions' => NULL
			)
		);
		// TODO...
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDocuParser = new classPG_DocuParser();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDocuParser', 'xValue' => $oPGDocuParser));}
?>