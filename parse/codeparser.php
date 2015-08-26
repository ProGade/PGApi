<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 13 2012
*/
define('PG_CODEPARSER_CONTENT_TYPE_CLASS', 'class');
define('PG_CODEPARSER_CONTENT_TYPE_FUNCTION', 'function');

define('PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT', 'sStartComment');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_LOCATION', 'sLocation');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_NAME', 'sName');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_EXTENDS', 'sExtends');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_DESCRIPTION', 'description');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT', 'axContent');
define('PG_CODEPARSER_PARSE_CLASS_INDEX_END_COMMENT', 'sEndComment');

define('PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT', 'sStartComment');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_LOCATION', 'sLocation');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_PERMISSION', 'sPermission');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_TYPE', 'sType');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_NAME', 'sName');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_PARAMETERS', 'sParameters');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_DESCRIPTION', 'description');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_CONTENT', 'sContent');
define('PG_CODEPARSER_PARSE_METHOD_INDEX_END_COMMENT', 'sEndComment');

define('PG_CODEPARSER_PARSE_METHOD_PARAMETER_NAME', 'sName');

define('PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT', 0);
define('PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT', 1);

// At Words: start, end, var, param, description, details, see, example, return
// Double Tags: en, de, type
// Single Tags: needed
/*
@start class

@param extends classPG_ClassBasics

@description
[en]This class can be parsed code.[/en]
[de]Mit dieser Klasse kann Code geparst werden.[/de]
*/
class classPG_CodeParser extends classPG_ClassBasics
{
	// Declarations...
    private $sFilterPrefix = '<';
    private $sFilterSuffix = '>';
	private $asParsedVars = array();
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sReturn [type]string[/type]
	[en]Returns the appropriate description text to the specified language.[/en]
	[de]Gibt den entsprechenden Beschreibungstext zur angegebenen Sprache zurück.[/de]
	
	@description
	[en]Method for filtering a specific language from a comment. Search for &#091;en&#093; ... &#091;/en&#093;.[/en]
	[de]Methode zum Filtern einer bestimmte Sprache aus einem Kommentar. Sucht nach &#091;en&#093; ... &#091;/en&#093;.[/de]
	
	@param sString [needed][type]string[/type]
	[en]String to be parsed.[/en]
	[de]String der geparst werden soll.[/de]
	
	@param sLanguage [type]string[/type]
	[en]Language that should be found.[/en]
	[de]Sprache die gefunden werden soll.[/de]
	*/
	public function parseCommentsLanguage($_sString, $_sLanguage = NULL)
	{
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sLanguage == NULL) {$_sLanguage = 'en';}
		
		$_sReturn = '';
		$_asComments = array();
		$_sSearch = '/'.$this->sFilterPrefix.$_sLanguage.$this->sFilterSuffix.'(.*?)'.$this->sFilterPrefix.'\/'.$_sLanguage.$this->sFilterSuffix.'/is';
		if ($_iSearchCount = preg_match_all($_sSearch, $_sString, $_asComments))
		{
            for ($i=0; $i<count($_asComments[1]); $i++) {$_asComments[1][$i] = trim(str_replace('*', '', trim($_asComments[1][$i])));}
			$_sReturn = trim(implode("\n", $_asComments[1]));
		}
		if ($_sReturn == '')
		{
			if ($_sLanguage != 'en') {$_sReturn = $this->parseCommentsLanguage(array('sString' => $_sString, 'sLanguage' => 'en'));}
			else {$_sReturn = trim($_sString);}
		}
		return $_sReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]Returns an array containing all the found variable types from a comment.[/en]
	[de]Gibt einen Array mit alle gefundenen Variablentypen aus einem Kommentar zurück.[/de]
	
	@description
	[en]Method used to filter variable types from a comment. Search for &#091;needed&#093;.[/en]
	[de]Methode zum Filtern von Variablentypen aus einem Kommentar. Sucht nach &#091;needed&#093;.[/de]
	
	@param sString [needed][type]string[/type]
	[en]String to be parsed.[/en]
	[de]String der geparst werden soll.[/de]
	*/
	public function parseCommentsTypes($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		$_asReturn = array();
		$_asTypeComments = array();
		$_asTypes = array();
		$_sSearch = '/'.$this->sFilterPrefix.'type'.$this->sFilterSuffix.'(.*?)'.$this->sFilterPrefix.'\/type'.$this->sFilterSuffix.'/is';
		$_sSearch2 = '/\s*([A-Za-z0-9\[\]_-]+)\s*/is';
		if ($_iSearchCount = preg_match_all($_sSearch, $_sString, $_asTypeComments))
		{
			for ($i=0; $i<count($_asTypeComments[1]); $i++)
			{
				if ($_iSearchCount2 = preg_match_all($_sSearch2, strip_tags($_asTypeComments[1][$i]), $_asTypes))
				{
					$_asReturn = array_merge($_asReturn, $_asTypes[1]);
				}
			}
		}
		return $_asReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsNeeded [type]bool[/type]
	[en]Returns true if a variable is required, or false if the variable is optional.[/en]
	[de]Gibt true zurück wenn eine Variable benötigt wird oder false wenn die Variable optional ist.[/de]
	
	@description
	[en]Method used to filter non-optional variables of a comment.[/en]
	[de]Methode zum Filtern von nicht optionalen Variablen aus einem Kommentar.[/de]
	
	@param sString [needed][type]string[/type]
	[en]String to be parsed.[/en]
	[de]String der geparst werden soll.[/de]
	*/
	public function parseCommentsIsNeeded($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		if (preg_match('/'.$this->sFilterPrefix.'needed'.$this->sFilterSuffix.'/is', $_sString) > 0) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param bSimpleParse [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseComments($_sString, $_bSimpleParse = NULL)
	{
		$_bSimpleParse = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bSimpleParse', 'xParameter' => $_bSimpleParse));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		if ($_bSimpleParse === NULL) {$_bSimpleParse = false;}

		$_asReturn = array();
		$_asComments = array();
		
		if ($_bSimpleParse == true)
		{
			$_asComments[] = $_sString;
			$_iSearchCount = 1;
		}
		else
		{
			// $_sSearch = '/\/\*(.*?)\*\/|(^|\s+)\/\/(.*?)(\n|$)|(^|\s+)#(.*?)(\n|$)/is';
			$_sSearch = '/\/\*(.*?)\*\//is';
			$_iSearchCount = preg_match_all($_sSearch, $_sString, $_asComments);
		}
		if ($_iSearchCount > 0)
		{
			for ($i=0; $i<count($_asComments[1]); $i++)
			{
				$_sCommand = '';
				$_asCommands = explode('@', $_asComments[1][$i]);
				for ($l=0; $l<count($_asCommands); $l++)
				{
					if ($l > 0)
					{
						$_asCommands[$l] = trim($_asCommands[$l]);
						$_sComment = strpbrk($_asCommands[$l], " \n");
						$_sCommand = strtolower(trim(substr($_asCommands[$l], 0, -strlen($_sComment))));
						if ($_sCommand != '')
						{
							$_asLines2 = array();
							$_asLines = explode("\n", $_sComment);
							for ($x=0; $x<count($_asLines); $x++) {if (trim($_asLines[$x]) != '') {$_asLines2[$x] = trim($_asLines[$x]);}}
							$_sText = implode("\n", $_asLines2);
							switch($_sCommand)
							{
								case 'var':
								case 'param':
								case 'see':
								case 'return':
								case 'start':
								case 'end':
								case 'object':
								case 'group':
									$_asReturn[$_sCommand][] = preg_split('/\s{1}/is', $_sText, 2);
									$_iLastIndex = count($_asReturn[$_sCommand])-1;
									if (!isset($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT])) {$_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT] = '';}
									if (!isset($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT])) {$_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT] = '';}
									if (($_sCommand == 'var') && (trim($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT]) != ''))
									{
										$this->asParsedVars[trim($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT])] = $_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT];
									}
								break;
								
								default:
									$_asReturn[$_sCommand][] = array(
										PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT => '',
										PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT => $_sText
									);
								break;
							}
							
							// var replacement...
							$_iLastIndex = count($_asReturn[$_sCommand])-1;
							if (trim($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]) != '')
							{
								if (strpos($_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT], '%') !== false)
								{
									foreach ($this->asParsedVars as $_sVarName => $_sVarValue)
									{
										$_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT] = str_replace('%'.$_sVarName.'%', $_sVarValue, $_asReturn[$_sCommand][$_iLastIndex][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT]);
									}
								}
							}
						}
					}
				}
			}
			return $_asReturn;
		}
		return array();
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseMethodParameters($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		$_iIndexParameterName = 1;
		
		// $_sSearchParameterName = '\s*([A-Za-z0-9_-$]+)\s*\,*';
		$_sSearchParameterName = '.*([A-Za-z0-9_-$]+).*';

		$_asReturn = array();
		$_asParameters = array();
		$_sSearch = '/';
		$_sSearch .= $_sSearchParameterName;
		$_sSearch .= '/is';
		if ($_iSearchCount = preg_match_all($_sSearch, $_sString, $_asParameters, PREG_SET_ORDER))
		{
			for ($i=0; $i<count($_asParameters); $i++)
			{
				$_asReturn[$i] = array(
					PG_CODEPARSER_PARSE_METHOD_PARAMETER_NAME => $_asParameters[$i][$_iIndexParameterName]
				);
			}
		}
		
		return $_asReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseMethods($_sString, $_sFile = NULL)
	{
		global $oPGStrings;
	
		$_sFile = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		// (?!a) // kein a darf folgen
		// (?<!a) // kein a darf vorangehen
		// [^a] // a negieren
		// $_sMethodComments = '(\/\*(.(?!\/\*))*?\*\/){0,1}\s*';
		
		$_sFileExtension = $oPGStrings->getFileExtension(array('sString' => $_sFile));
		
		if ($_sFileExtension == 'js')
		{
			$_iIndexMethodStart = 1;
			$_iIndexMethodStartCode = 2;
			$_iIndexMethodStartComment = 3;
			$_iIndexMethodPermission = 4;
			$_iIndexMethodName = 5;
			$_iIndexMethodType = 6;
			$_iIndexMethodParameters = 7;
			$_iIndexMethodContent = 8;
			$_iIndexMethodEnd = 9;
			$_iIndexMethodEndCode = 10;
			$_iIndexMethodEndComment = 11;

			// $_sSearchMethodStartComments = '(\/(\*|\*\*)\s*(\@start\s+method){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchMethodStartComments = '(\/\*+\s*\**\s*(\@start\s+method){1}(.*?)\*\/){1}\s*';
			$_sSearchMethodPermissions = '(this\.|var\s+)';
			$_sSearchMethodName = '([0-9a-zA-Z_]+)\s*';
			$_sSearchMethodType = '=\s*(function)\s*';
			$_sSearchMethodParametersPrefix = '\(';
			$_sSearchMethodParameters = '([\$\sa-zA-Z0-9_=,\&]*)';
			$_sSearchMethodParametersSuffix = '\)\s*';
			$_sSearchMethodContent = '\{(.*?)\}\s*';
			// $_sSearchMethodEndComments = '(\/\*\s*(\@end\s+method){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchMethodEndComments = '(\/\*\s*(\@end\s+method){1}(.*?)\*\/){1}\s*';
			
			$_sSearch = '/';
				$_sSearch .= $_sSearchMethodStartComments;
				$_sSearch .= $_sSearchMethodPermissions;
				$_sSearch .= $_sSearchMethodName;
				$_sSearch .= $_sSearchMethodType;
				$_sSearch .= $_sSearchMethodParametersPrefix.$_sSearchMethodParameters.$_sSearchMethodParametersSuffix;
				$_sSearch .= $_sSearchMethodContent;
				$_sSearch .= $_sSearchMethodEndComments;
			$_sSearch .= '/is';
		}
		else
		{
			$_iIndexMethodStart = 1;
			$_iIndexMethodStartCode = 2;
			$_iIndexMethodStartComment = 3;
			$_iIndexMethodPermission = 4;
			$_iIndexMethodType = 5;
			$_iIndexMethodName = 6;
			$_iIndexMethodParameters = 7;
			$_iIndexMethodContent = 8;
			$_iIndexMethodEnd = 9;
			$_iIndexMethodEndCode = 10;
			$_iIndexMethodEndComment = 11;

			// $_sSearchMethodStartComments = '(\/\*\s*(\@start\s+method){1}(.(?!\/\*))*?\*\/){1}\s*';
			// $_sSearchMethodStartComments = '(\/\*+\s*\**\s*(\@start\s+method){1}(.*?)\*\/){1}\s*';
            $_sSearchMethodStartComments = '(\/\*+\s*.*?\s*\**\s*(\@start\s+method){1}(.*?)\*\/){1}\s*';
			$_sSearchMethodPermissions = '(public|private)\s+';
			$_sSearchMethodType = '(function)\s+';
			$_sSearchMethodName = '([0-9a-zA-Z_]+)\s*';
			$_sSearchMethodParametersPrefix = '\(';
			$_sSearchMethodParameters = '([\$\sa-zA-Z0-9_=,\&]*)';
			$_sSearchMethodParametersSuffix = '\)\s*';
			$_sSearchMethodContent = '\{(.*?)\}\s*';
			// $_sSearchMethodEndComments = '(\/\*\s*(\@end\s+method){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchMethodEndComments = '(\/\*\s*(\@end\s+method){1}(.*?)\*\/){1}\s*';
			
			$_sSearch = '/';
				$_sSearch .= $_sSearchMethodStartComments;
				$_sSearch .= $_sSearchMethodPermissions;
				$_sSearch .= $_sSearchMethodType;
				$_sSearch .= $_sSearchMethodName;
				$_sSearch .= $_sSearchMethodParametersPrefix.$_sSearchMethodParameters.$_sSearchMethodParametersSuffix;
				$_sSearch .= $_sSearchMethodContent;
				$_sSearch .= $_sSearchMethodEndComments;
			$_sSearch .= '/is';
		}
		
		$_asReturn = array();
		$_asMethods = array();
		if ($_iSearchCount = preg_match_all($_sSearch, $_sString, $_asMethods, PREG_SET_ORDER))
		{
			for ($i=0; $i<count($_asMethods); $i++)
			{
				$_asReturn[$i] = array(
					//PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT => $_asMethods[$i][$_iIndexMethodStartComment],
					PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT => $_asMethods[$i][$_iIndexMethodStart],
					PG_CODEPARSER_PARSE_METHOD_INDEX_LOCATION => $_sFile,
					PG_CODEPARSER_PARSE_METHOD_INDEX_PERMISSION => $_asMethods[$i][$_iIndexMethodPermission],
					PG_CODEPARSER_PARSE_METHOD_INDEX_TYPE => $_asMethods[$i][$_iIndexMethodType],
					PG_CODEPARSER_PARSE_METHOD_INDEX_NAME => $_asMethods[$i][$_iIndexMethodName],
					PG_CODEPARSER_PARSE_METHOD_INDEX_PARAMETERS => $_asMethods[$i][$_iIndexMethodParameters],
					PG_CODEPARSER_PARSE_METHOD_INDEX_CONTENT => $_asMethods[$i][$_iIndexMethodContent],
					PG_CODEPARSER_PARSE_METHOD_INDEX_END_COMMENT => $_asMethods[$i][$_iIndexMethodEndComment],
				);
				
				if (trim($_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT]) != '')
				{
					$_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT] = $this->parseComments(
						array(
							'sString' => $_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_START_COMMENT], 
							'bSimpleParse' => false
						)
					);
				}
				
				if (trim($_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_END_COMMENT]) != '')
				{
					$_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_END_COMMENT] = $this->parseComments(
						array(
							'sString' => $_asReturn[$i][PG_CODEPARSER_PARSE_METHOD_INDEX_END_COMMENT], 
							'bSimpleParse' => false
						)
					);
				}
			}
		}
		
		return $_asReturn; 
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseClass($_sString, $_sFile = NULL)
	{
		global $oPGStrings;
	
		$_sFile = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		$_asReturn = array();
		$_asClass = array();
		
		$_sFileExtension = $oPGStrings->getFileExtension(array('sString' => $_sFile));
// echo $_sFileExtension.'; ';
		
		if ($_sFileExtension == 'js')
		{
			$_iIndexClassStart = 1;
			$_iIndexClassStartCode = 2;
			$_iIndexClassStartComment = 3;
			$_iIndexClassNameDefinition = 4;
			$_iIndexClassName = 5;
			$_iIndexClassContent = 6;
			$_iIndexClassEnd = 7;
			$_iIndexClassEndCode = 8;
			$_iIndexClassEndComment = 9;
			$_iIndexClassExtendsDefinition = 10;
			$_iIndexClassExtends = 11;

			// $_sSearchClassStartComments = '(\/\*\s*(\@start\s+class){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchClassStartComments = '(\/\*+\s*\**\s*(\@start\s+class){1}(.*?)\*\/){1}\s*';
			$_sSearchClassName = '(function\s+([0-9a-zA-Z_]+)\s*\(\s*\)){1}\s*';
			$_sSearchClassContent = '\{(.*?)\}\s*';
			// $_sSearchClassEndComments = '(\/\*\s*(\@end\s+class){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchClassEndComments = '(\/\*\s*(\@end\s+class){1}(.*?)\*\/){1}\s*';
			$_sSearchClassExtends = '(extends\s+([0-9a-zA-Z_]+))*\s*'; // TODO!
			
			$_sSearch = '/';
				$_sSearch .= $_sSearchClassStartComments;
				$_sSearch .= $_sSearchClassName;
				$_sSearch .= $_sSearchClassContent;
				$_sSearch .= $_sSearchClassEndComments;
				$_sSearch .= $_sSearchClassExtends;
			$_sSearch .= '/is';
		}
		else
		{
			$_iIndexClassStart = 1;
			$_iIndexClassStartCode = 2;
			$_iIndexClassStartComment = 3;
			$_iIndexClassNameDefinition = 4;
			$_iIndexClassName = 5;
			$_iIndexClassExtendsDefinition = 6;
			$_iIndexClassExtends = 7;
			$_iIndexClassContent = 8;
			$_iIndexClassEnd = 9;
			$_iIndexClassEndCode = 10;
			$_iIndexClassEndComment = 11;

			// $_sSearchClassStartComments = '(\/\*\s*(\@start\s+class){1}(.(?!\/\*))*?\*\/){1}\s*';
			// $_sSearchClassStartComments = '(\/\*+\s*\**\s*(\@start\s+class){1}(.*?)\*\/){1}\s*';
            $_sSearchClassStartComments = '(\/\*+.*(\@start\s+class){1}(.*?)\*\/){1}\s*';
			$_sSearchClassName = '(class\s+([0-9a-zA-Z_]+)){1}\s+';
			$_sSearchClassExtends = '(extends\s+([0-9a-zA-Z_]+))*\s*';
			$_sSearchClassContent = '\{(.*?)\}\s*';
			// $_sSearchClassEndComments = '(\/\*\s*(\@end\s+class){1}(.(?!\/\*))*?\*\/){1}\s*';
			$_sSearchClassEndComments = '(\/\*+\s*(\@end\s+class){1}(.*?)\*\/){1}\s*';
			
			$_sSearch = '/';
				$_sSearch .= $_sSearchClassStartComments;
				$_sSearch .= $_sSearchClassName;
				$_sSearch .= $_sSearchClassExtends;
				$_sSearch .= $_sSearchClassContent;
				$_sSearch .= $_sSearchClassEndComments;
			$_sSearch .= '/is';
		}
		
		if ($_iSearchCount = preg_match_all($_sSearch, $_sString, $_asClass, PREG_SET_ORDER))
		{
			for ($i=0; $i<count($_asClass); $i++)
			{
				$_sExtends = '';
				if (isset($_asClass[$i][$_iIndexClassExtends])) {$_sExtends = $_asClass[$i][$_iIndexClassExtends];}
			
				if (trim($_asClass[$i][$_iIndexClassStart]) != '')
				{
					$_asClass[$i][$_iIndexClassStart] = $this->parseComments(
						array(
							'sString' => $_asClass[$i][$_iIndexClassStart], 
							'bSimpleParse' => false
						)
					);
				}

				$_asReturn[$i] = array(
					// PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT => $_asClass[$i][$_iIndexClassStartComment],
					PG_CODEPARSER_PARSE_CLASS_INDEX_START_COMMENT => $_asClass[$i][$_iIndexClassStart],
					PG_CODEPARSER_PARSE_CLASS_INDEX_LOCATION => $_sFile,
					PG_CODEPARSER_PARSE_CLASS_INDEX_NAME => trim($_asClass[$i][$_iIndexClassName]),
					PG_CODEPARSER_PARSE_CLASS_INDEX_EXTENDS => trim($_sExtends),
					PG_CODEPARSER_PARSE_CLASS_INDEX_CONTENT => $this->parseMethods(array('sString' => $_asClass[$i][$_iIndexClassContent], 'sFile' => $_sFile)),
					PG_CODEPARSER_PARSE_CLASS_INDEX_END_COMMENT => $_asClass[$i][$_iIndexClassEndComment],
				);
				
			}
		}
		
// echo '<pre>'.str_replace('<', '&lt;', print_r($_asReturn, true)).'</pre>';
		return $_asReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseCode($_sString, $_sFile = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		$_asReturn = array();

		/*$_sLastCommand = '';
		$_sClassString = '';
		$_asWords = preg_split('/([\s,\(\)\{\}]{1})/', $_sString, -1, PREG_SPLIT_DELIM_CAPTURE); // , PREG_SPLIT_OFFSET_CAPTURE);
		for ($i=0; $i<count($_asWords); $i++)
		{
			if (trim($_asWords[$i]) != '')
			{
				switch($_asWords[$i])
				{
					case 'class':
						$_sLastCommand = 'class';
						// echo str_replace('<', '&lt;', $_asWords[$i]).' '.$_asWords[$i+1].'<hr />';
					break;
				}
				
				if ($_sLastCommand == 'class')
				{
					switch($_asWords[$i])
					{
						case 'extends':
						case '\n':
						case '{':
							$_sLastCommand = '';
						break;
						
						default:
							$_sClassString .= $_asWords[$i];
					}
				}
			}
		}
		echo $_sClassString.'<hr />';*/
		
		$_asReturn = $this->parseClass(array('sString' => $_sString, 'sFile' => $_sFile));
		
		return $_asReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function parseFile($_sPath, $_sFile = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		$_asComments = array();
		if ($_oFile = fopen($_sPath.$_sFile, 'rb'))
		{
			$_sFileContent = fread($_oFile, filesize($_sPath.$_sFile));
			fclose($_oFile);
			return $this->parseCode(array('sString' => $_sFileContent, 'sFile' => $_sFile));
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return asReturn [type]string[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function build($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		
		$_asParsed = $this->parseFile($_sFile);
		$_sHtml = '';
		
		/*
		for ($_iMethodIndex=0; $_iMethodIndex<count($_asParsed); $_iMethodIndex++)
		{
			for ($i=1; $i<count($_asParsed[$_iMethodIndex]); $i++)
			{
				if ($i==1)
				{
					if (is_array($_asParsed[$_iMethodIndex][0]))
					{
						foreach ($_asParsed[$_iMethodIndex][0] as $_sCommand => $_asComment)
						{
							$_sHtml .= "\n".$_sCommand.': '."\n";
							for ($t=0; $t<count($_asComment); $t++)
							{
								$_sHtml .= 'Object - '.$_asComment[$t][PG_CODEPARSER_PARSE_COMMENT_INDEX_OBJECT]."\n";
								$_sHtml .= 'Text - '.$this->parseCommentsLanguage(array('sString' => $_asComment[$t][PG_CODEPARSER_PARSE_COMMENT_INDEX_TEXT], 'sLanguage' => 'de'))."\n";
							}
						}
					}
					$_sHtml .= "\n";
				}
				$_sHtml .= $i.'. '.$_asParsed[$_iMethodIndex][$i]."\n";
			}
			$_sHtml .= "\n\n";
		}
		*/
		
		return $_sHtml;
	}
	/* @end method */
}
/*
@end class
*/
$oPGCodeParser = new classPG_CodeParser();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCodeParser', 'xValue' => $oPGCodeParser));}
?>