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
define('PG_DEVDOCU_REQUESTTYPE_CLASSDOCU', 'PGDocumentationRequestTypeClass');
define('PG_DEVDOCU_REQUESTTYPE_METHODDOCU', 'PGDocumentationRequestTypeMethod');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Documentation extends classPG_ClassBasics
{
	// Declarations...
	private $axMenuPoints = array();
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDocumentation'));
		$this->initClassBasics();
		$this->initDatabase();
		$this->initNetwork();
	}
	
	// Methods...
	/*
	@start method
	@param oDatabaseUpdate
	*/
	public function buildDatabaseUpdate($_oDatabaseUpdate)
	{
		$_oDatabaseUpdate = $this->getRealParameter(array('oParameters' => $_oDatabaseUpdate, 'sName' => 'oDatabaseUpdate', 'xParameter' => $_oDatabaseUpdate));
		
		$_axDBChunkStructures = $_oDatabaseUpdate->getDBChunkStructures();
		$_axTablesStructure = array();
		
		// Classes...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Extends', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Permission', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Type', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => 'class', 'sOptions' => ''));
		// $_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassName', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Location', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'DefaultObject', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ExampleCode', 'sType' => 'MEDIUMTEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_classes', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// NeededIncludes...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'IncludeID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_includes', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));

		// SeeAlso / OtherFilesLinks...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'FileLinkID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_filelinks', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// GlobalDefines...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'DefineID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_defines', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));

		// Variables...
		/*
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'VariableID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_variables', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		*/
		
		// Properties...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'PropertyID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Permission', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Type', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'DefaultValue', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_properties', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// Methods...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'MethodID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ClassID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Permission', 'sType' => 'VARCHAR', 'iSize' => 32, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Type', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ReturnVariable', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ReturnType', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ExampleCode', 'sType' => 'MEDIUMTEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_methods', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));

		// Method_Parameters...
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ParameterID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'MethodID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Type', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'DefaultValue', 'sType' => 'VARCHAR', 'iSize' => 255, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'PossibleValues', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Description', 'sType' => 'TEXT', 'iSize' => 0, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'IsNeeded', 'sType' => 'INT', 'iSize' => 1, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Position', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ProgrammingLanguage', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Language', 'sType' => 'VARCHAR', 'iSize' => 2, 'xDefault' => 'en', 'sOptions' => ''));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'docu_method_parameters', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL, 'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));

		return $_oDatabaseUpdate->buildDBChunkStructure(array('sDBChunk' => 'User', 'axDBChunkStructures' => $_axDBChunkStructures, 'axTablesStructure' => $_axTablesStructure));
	}
	/* @end method */
	
	/*
	@start method
	@param oUpdate
	*/
	public function buildUpdate($_oUpdate)
	{
		$_oUpdate = $this->getRealParameter(array('oParameters' => $_oUpdate, 'sName' => 'oUpdate', 'xParameter' => $_oUpdate));
		
		$_oDatabaseUpdate = $_oUpdate->getDatabaseUpdate();
		$_axDBChunkStructures = $this->buildDatabaseUpdate(array('oDatabaseUpdate' => $_oDatabaseUpdate));
		$_oDatabaseUpdate->setDBChunkStructures(array('axStructure' => $_axDBChunkStructures));
		$_oUpdate->setDatabaseUpdate(array('oDatabaseUpdate' => $_oDatabaseUpdate));
		
		return $_oUpdate;
	}
	/* @end method */
	
	/*
	@start method
	@param sString
	*/
	public function formatString($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		$_asSearch = array('�', '�', '�', '�', '�', '�');
		$_asReplace = array('&auml;', '&Auml;', '&uuml;', '&Uuml;', '&ouml;', '&Ouml;');
		
		$_sString = str_replace($_asSearch, $_asReplace, $_sString);
		
		return nl2br($_sString);
	}
	/* @end method */
	
	/*
	@start method
	@param iDefineID
	@param iClassID
	@param sName
	@param sDescription
	@param sProgrammingLanguage
	@param sLanguage
	*/
	public function saveDefine($_iDefineID, $_iClassID = NULL, $_sName = NULL, $_sDescription = NULL, $_sProgrammingLanguage = NULL, $_sLanguage = NULL)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		$_sName = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iDefineID = $this->getRealParameter(array('oParameters' => $_iDefineID, 'sName' => 'iDefineID', 'xParameter' => $_iDefineID));
		
		$_axColumnsAndValues = array();
		$_axColumnsAndValues['ClassID'] = $_iClassID;
		$_axColumnsAndValues['Name'] = $_sName;
		$_axColumnsAndValues['Description'] = $_sDescription;
		$_axColumnsAndValues['ProgrammingLanguage'] = $_sProgrammingLanguage;
		$_axColumnsAndValues['Language'] = $_sLanguage;
		
		$_axColumnsAndValuesOnInsert = array();
		$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = time();
		
		$_axColumnsAndValuesOnUpdate = array();
		$_axColumnsAndValuesOnUpdate['UpdateTimeStamp'] = time();

		$_iDefineID = $this->saveDataset(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'docu_defines', 
				'sIDColumn' => 'DefineID', 
				'xIDValue' => $_iDefineID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'sWhere' => NULL, 
				'sEngine' => NULL
			)
		);

		return $_iDefineID;
	}
	/* @end method */
	
	/*
	@start method
	@param iPropertyID
	@param iClassID
	@param sName
	@param sPermission
	@param sType
	@param sDefaultValue
	@param sDescription
	@param sProgrammingLanguage
	@param sLanguage
	*/
	public function saveProperty($_iPropertyID, $_iClassID = NULL, $_sName = NULL, $_sPermission = NULL, $_sType = NULL, $_sDefaultValue = NULL, $_sDescription = NULL, $_sProgrammingLanguage = NULL, $_sLanguage = NULL)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		$_sName = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sPermission = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sPermission', 'xParameter' => $_sPermission));
		$_sType = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sDefaultValue = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sDefaultValue', 'xParameter' => $_sDefaultValue));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iPropertyID = $this->getRealParameter(array('oParameters' => $_iPropertyID, 'sName' => 'iPropertyID', 'xParameter' => $_iPropertyID));
		
		$_axColumnsAndValues = array();
		$_axColumnsAndValues['ClassID'] = $_iClassID;
		$_axColumnsAndValues['Name'] = $_sName;
		$_axColumnsAndValues['Permission'] = $_sPermission;
		$_axColumnsAndValues['Type'] = $_sType;
		$_axColumnsAndValues['DefaultValue'] = $_sDefaultValue;
		$_axColumnsAndValues['Description'] = $_sDescription;
		$_axColumnsAndValues['ProgrammingLanguage'] = $_sProgrammingLanguage;
		$_axColumnsAndValues['Language'] = $_sLanguage;
		
		$_axColumnsAndValuesOnInsert = array();
		$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = time();
		
		$_axColumnsAndValuesOnUpdate = array();
		$_axColumnsAndValuesOnUpdate['UpdateTimeStamp'] = time();

		$_iPropertyID = $this->saveDataset(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'docu_properties', 
				'sIDColumn' => 'PropertyID', 
				'xIDValue' => $_iPropertyID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'sWhere' => NULL, 
				'sEngine' => NULL
			)
		);

		return $_iPropertyID;
	}
	/* @end method */
	
	/*
	@start method
	@param iMethodID
	@param iClassID
	@param sName
	@param sPermission
	@param sType
	@param sReturnVariable
	@param sReturnType
	@param sDescription
	@param sExampleCode
	@param sProgrammingLanguage
	@param sLanguage
	*/
	public function saveMethod($_iMethodID, $_iClassID = NULL, $_sName = NULL, $_sPermission = NULL, $_sType = NULL, $_sReturnVariable = NULL, $_sReturnType = NULL, $_sDescription = NULL, $_sExampleCode = NULL, $_sProgrammingLanguage = NULL, $_sLanguage = NULL)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		$_sName = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sPermission = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sPermission', 'xParameter' => $_sPermission));
		$_sType = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sReturnVariable = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sReturnVariable', 'xParameter' => $_sReturnVariable));
		$_sReturnType = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sReturnType', 'xParameter' => $_sReturnType));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sExampleCode = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sExampleCode', 'xParameter' => $_sExampleCode));
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iMethodID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iMethodID', 'xParameter' => $_iMethodID));
		
		$_axColumnsAndValues = array();
		$_axColumnsAndValues['ClassID'] = $_iClassID;
		$_axColumnsAndValues['Name'] = $_sName;
		$_axColumnsAndValues['Permission'] = $_sPermission;
		$_axColumnsAndValues['Type'] = $_sType;
		$_axColumnsAndValues['ReturnVariable'] = $_sReturnVariable;
		$_axColumnsAndValues['ReturnType'] = $_sReturnType;
		$_axColumnsAndValues['Description'] = $_sDescription;
		$_axColumnsAndValues['ExampleCode'] = $_sExampleCode;
		$_axColumnsAndValues['ProgrammingLanguage'] = $_sProgrammingLanguage;
		$_axColumnsAndValues['Language'] = $_sLanguage;
		
		$_axColumnsAndValuesOnInsert = array();
		$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = time();
		
		$_axColumnsAndValuesOnUpdate = array();
		$_axColumnsAndValuesOnUpdate['UpdateTimeStamp'] = time();

		$_iMethodID = $this->saveDataset(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'docu_methods', 
				'sIDColumn' => 'MethodID', 
				'xIDValue' => $_iMethodID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'sWhere' => NULL, 
				'sEngine' => NULL
			)
		);

		return $_iMethodID;
	}
	/* @end method */
	
	/*
	@start method
	@param iParameterID
	@param iClassID
	@param sName
	@param sType
	@param sDefaultValue
	@param sPossibleValues
	@param sDescription
	@param iIsNeeded
	@param iPosition
	@param sProgrammingLanguage
	@param sLanguage
	*/
	public function saveMethodParameter($_iParameterID, $_iClassID = NULL, $_sName = NULL, $_sType = NULL, $_sDefaultValue = NULL, $_sPossibleValues = NULL, $_sDescription = NULL, $_iIsNeeded = NULL, $_iPosition = NULL, $_sProgrammingLanguage = NULL, $_sLanguage = NULL)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		$_sName = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sType = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sDefaultValue = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sDefaultValue', 'xParameter' => $_sDefaultValue));
		$_sPossibleValues = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sPossibleValues', 'xParameter' => $_sPossibleValues));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_iIsNeeded = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'iIsNeeded', 'xParameter' => $_iIsNeeded));
		$_iPosition = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'Position', 'xParameter' => $_iPosition));
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iParameterID = $this->getRealParameter(array('oParameters' => $_iParameterID, 'sName' => 'ParameterID', 'xParameter' => $_iParameterID));

		$_axColumnsAndValues = array();
		$_axColumnsAndValues['ClassID'] = $_iClassID;
		$_axColumnsAndValues['Name'] = $_sName;
		$_axColumnsAndValues['Type'] = $_sType;
		$_axColumnsAndValues['DefaultValue'] = $_sDefaultValue;
		$_axColumnsAndValues['PossibleValues'] = $_sPossibleValues;
		$_axColumnsAndValues['Description'] = $_sDescription;
		$_axColumnsAndValues['IsNeeded'] = $_iIsNeeded;
		$_axColumnsAndValues['Position'] = $_iPosition;
		$_axColumnsAndValues['ProgrammingLanguage'] = $_sProgrammingLanguage;
		$_axColumnsAndValues['Language'] = $_sLanguage;
		
		$_axColumnsAndValuesOnInsert = array();
		$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = time();
		
		$_axColumnsAndValuesOnUpdate = array();
		$_axColumnsAndValuesOnUpdate['UpdateTimeStamp'] = time();

		$_iParameterID = $this->saveDataset(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'docu_method_parameters', 
				'sIDColumn' => 'ParameterID', 
				'xIDValue' => $_iParameterID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'sWhere' => NULL, 
				'sEngine' => NULL
			)
		);

		return $_iParameterID;
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	@param sName
	@param sExtends
	@param sPermission
	@param sType
	@param sLocation
	@param sDefaultObject
	@param sDescription
	@param sExampleCode
	@param sProgrammingLanguage
	@param sLanguage
	*/
	public function saveClass($_iClassID, $_sName = NULL, $_sExtends = NULL, $_sPermission = NULL, $_sType = NULL, $_sLocation = NULL, $_sDefaultObject = NULL, $_sDescription = NULL, $_sExampleCode = NULL, $_sProgrammingLanguage = NULL, $_sLanguage = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sExtends = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sExtends', 'xParameter' => $_sExtends));
		$_sPermission = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sPermission', 'xParameter' => $_sPermission));
		$_sType = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sLocation = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sLocation', 'xParameter' => $_sLocation));
		$_sDefaultObject = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sDefaultObject', 'xParameter' => $_sDefaultObject));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sExampleCode = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sExampleCode', 'xParameter' => $_sExampleCode));
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));

		$_axColumnsAndValues = array();
		$_axColumnsAndValues['Name'] = $_sName;
		$_axColumnsAndValues['Extends'] = $_sExtends;
		$_axColumnsAndValues['Permission'] = $_sPermission;
		$_axColumnsAndValues['Type'] = $_sType;
		$_axColumnsAndValues['Location'] = $_sLocation;
		$_axColumnsAndValues['DefaultObject'] = $_sDefaultObject;
		$_axColumnsAndValues['Description'] = $_sDescription;
		$_axColumnsAndValues['ExampleCode'] = $_sExampleCode;
		$_axColumnsAndValues['ProgrammingLanguage'] = $_sProgrammingLanguage;
		$_axColumnsAndValues['Language'] = $_sLanguage;
		
		$_axColumnsAndValuesOnInsert = array();
		$_axColumnsAndValuesOnInsert['CreateTimeStamp'] = time();
		
		$_axColumnsAndValuesOnUpdate = array();
		$_axColumnsAndValuesOnUpdate['UpdateTimeStamp'] = time();

		$_iClassID = $this->saveDataset(
			array(
				'sTable' => $this->getDatabaseTablePrefix().'docu_classes', 
				'sIDColumn' => 'ClassID', 
				'xIDValue' => $_iClassID, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'sWhere' => NULL, 
				'sEngine' => NULL
			)
		);

		return $_iClassID;
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	@param iDefineID
	*/
	public function buildDefineEditForm($_iClassID, $_iDefineID = NULL)
	{
		global $oPGForm;

		$_iDefineID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iDefineID', 'xParameter' => $_iDefineID));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		
		$_sHtml = '';
		
		$oPGForm->useNetworkSend(array('bUse' => true));
		
		$_axDefine = array();
		$_axDefine['DefineID'] = $_iDefineID;
		$_axDefine['ClassID'] = $_iClassID;
		$_axDefine['Name'] = '';
		$_axDefine['Description'] = '';
		
		if ($_iDefineID > 0)
		{
			if
			(
				$_oDefineResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'docu_defines', 
						'asColumns' => array('DefineID', 'ClassID', 'Name', 'Description'), 
						'sWhere' => 'DefineID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iDefineID))).'"', 
						'iStart' => NULL, 
						'iEnd' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				$_axDefine = $this->fetchDatabaseArray(array('xResult' => $_oDefineResult));
			} // _oDefineResult
		}
	
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'sEditForm', 'xFieldValue' => 'Define'));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iDefineID', 'xFieldValue' => $_axDefine['DefineID']));

		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Name',
				'sInputFieldID' => $this->getID().'Name',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axDefine['Name']
			)
		);						  
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'Description',
				'sTextAreaID' => $this->getID().'Description', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axDefine['Description']
			)
		);

		/* todo...
		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'JavaScript Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'JavaScript Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InJS', PG_CHECKBOX_MODE_AUTOSAVE, $_axDefine['InJS'], $_axStructure, $_sSendParameters).'<br />';
		
		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'PHP Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'PHP Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InPHP', PG_CHECKBOX_MODE_AUTOSAVE, $_axDefine['InPHP'], $_axStructure, $_sSendParameters).'<br />';

		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'Perl Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'Perl Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InPerl', PG_CHECKBOX_MODE_AUTOSAVE, $_axDefine['InPerl'], $_axStructure, $_sSendParameters).'<br />';
		*/
		
		$_sHtml .= $oPGForm->build(
			array(
				'sFormID' => $this->getID().'DefineForm', 
				'sTargetUrl' => $this->getUrl(), 
				'sTargetFrame' => $this->getUrlTarget(), 
				'sFormMethod' => 'post', 
				'asIgnoreHiddenInputs' => NULL
			)
		);
		
		$_sHtml .= '<br />';
		$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getDocuClassContent(); oPGDevDocu.hidePopup();" target="_self">close</a>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	@param iPropertyID
	*/
	public function buildPropertyEditForm($_iClassID, $_iPropertyID = NULL)
	{
		global $oPGForm;

		$_iPropertyID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iPropertyID', 'xParameter' => $_iPropertyID));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));

		$_sHtml = '';

		$oPGForm->useNetworkSend(array('bUse' => true));
		
		$_axProperty = array();
		$_axProperty['PropertyID'] = $_iPropertyID;
		$_axProperty['ClassID'] = $_iClassID;
		$_axProperty['Name'] = '';
		$_axProperty['Description'] = '';
		$_axProperty['Type'] = '';
		$_axProperty['DefaultValue'] = '';
		
		if ($_iPropertyID > 0)
		{
			if
			(
				$_oPropertyResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'docu_properties', 
						'asColumns' => array('PropertyID', 'ClassID', 'Name', 'Description', 'Type', 'DefaultValue'), 
						'sWhere' => 'PropertyID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iPropertyID))).'"', 
						'iStart' => NULL, 
						'iEnd' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				$_axProperty = $this->fetchDatabaseArray(array('xResult' => $_oPropertyResult));
			} // _oPropertyResult
		}
	
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'sEditForm', 'xFieldValue' => 'Property'));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iPropertyID', 'xFieldValue' => $_axProperty['PropertyID']));
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Typ',
				'sInputFieldID' => $this->getID().'Typ',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axProperty['Typ']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Name',
				'sInputFieldID' => $this->getID().'Name',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axProperty['Name']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'DefaultValue',
				'sInputFieldID' => $this->getID().'DefaultValue',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axProperty['DefaultValue']
			)
		);
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'Description',
				'sTextAreaID' => $this->getID().'Description', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axProperty['Description']
			)
		);
		
		/*
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'JavaScript Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'JavaScript Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InJS', PG_CHECKBOX_MODE_AUTOSAVE, $_axProperty['InJS'], $_axStructure, $_sSendParameters).'<br />';
			
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'PHP Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'PHP Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InPHP', PG_CHECKBOX_MODE_AUTOSAVE, $_axProperty['InPHP'], $_axStructure, $_sSendParameters).'<br />';
	
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'Perl Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'Perl Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InPerl', PG_CHECKBOX_MODE_AUTOSAVE, $_axProperty['InPerl'], $_axStructure, $_sSendParameters).'<br />';
		*/
		
		$_sHtml .= $oPGForm->build(
			array(
				'sFormID' => $this->getID().'PropertyForm', 
				'sTargetUrl' => $this->getUrl(), 
				'sTargetFrame' => $this->getUrlTarget(), 
				'sFormMethod' => 'post', 
				'asIgnoreHiddenInputs' => NULL
			)
		);
		
		$_sHtml .= '<br />';
		$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getDocuClassContent(); oPGDevDocu.hidePopup();" target="_self">close</a>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	*/
	public function buildClassEditForm($_iClassID, $_iPropertyID = NULL)
	{
		global $oPGForm;

		$_iPropertyID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iPropertyID', 'xParameter' => $_iPropertyID));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));

		$_sHtml = '';

		$oPGForm->useNetworkSend(array('bUse' => true));
		
		$_axClass = array();
		$_axClass['ClassID'] = $_iClassID;
		$_axClass['Name'] = '';
		$_axClass['Extends'] = '';
		$_axClass['Location'] = '';
		$_axClass['DefaultObject'] = '';
		$_axClass['Description'] = '';
		$_axClass['ExampleCode'] = '';
		
		if ($_iClassID > 0)
		{
			if
			(
				$_oClassResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'docu_classes', 
						'asColumns' => array('ClassID', 'Name', 'Extends', 'Location', 'DefaultObject', 'Description', 'ExampleCode'), 
						'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iClassID))).'"', 
						'iStart' => NULL, 
						'iEnd' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				$_axClass = $this->fetchDatabaseArray(array('xResult' => $_oClassResult));
			} // _oClassResult
		}
	
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'sEditForm', 'xFieldValue' => 'Class'));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iClassID', 'xFieldValue' => $_axClass['ClassID']));
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Name',
				'sInputFieldID' => $this->getID().'Name',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axClass['Name']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Extends',
				'sInputFieldID' => $this->getID().'Extends',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axClass['Extends']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Location',
				'sInputFieldID' => $this->getID().'Location',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axClass['Location']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'DefaultObject',
				'sInputFieldID' => $this->getID().'DefaultObject',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axClass['DefaultObject']
			)
		);
		
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'Description',
				'sTextAreaID' => $this->getID().'Description', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axClass['Description']
			)
		);
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'ExampleCode',
				'sTextAreaID' => $this->getID().'ExampleCode', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axClass['ExampleCode']
			)
		);
		
		/*
		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'JavaScript Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'JavaScript Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InJS', PG_CHECKBOX_MODE_AUTOSAVE, $_axClass['InJS'], $_axStructure, $_sSendParameters).'<br />';
		
		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'PHP Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'PHP Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InPHP', PG_CHECKBOX_MODE_AUTOSAVE, $_axClass['InPHP'], $_axStructure, $_sSendParameters).'<br />';

		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'Perl Version', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'Perl Version', NULL);
		$_sHtml .= $oPGCheckBox->build('InPerl', PG_CHECKBOX_MODE_AUTOSAVE, $_axClass['InPerl'], $_axStructure, $_sSendParameters).'<br />';
		*/
		
		$_sHtml .= $oPGForm->build(
			array(
				'sFormID' => $this->getID().'ClassForm', 
				'sTargetUrl' => $this->getUrl(), 
				'sTargetFrame' => $this->getUrlTarget(), 
				'sFormMethod' => 'post', 
				'asIgnoreHiddenInputs' => NULL
			)
		);
		
		$_sHtml .= '<br />';
		$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getDocuClassContent('.$_iClassID.'); oPGDevDocu.hidePopup();" target="_self">close</a>';
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	@param iClassID
	@param iMethodID
	*/
	public function buildMethodEditForm($_iClassID, $_iMethodID = NULL)
	{
		global $oPGForm;

		$_iMethodID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iMethodID', 'xParameter' => $_iMethodID));
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));

		$_sHtml = '';

		$oPGForm->useNetworkSend(array('bUse' => true));
		
		$_axMethod = array();
		$_axMethod['ClassID'] = $_iClassID;
		$_axMethod['MethodID'] = $_iMethodID;
		$_axMethod['ReturnType'] = '';
		$_axMethod['ReturnVariable'] = '';
		$_axMethod['Name'] = '';
		$_axMethod['Description'] = '';
		$_axMethod['DetailDescription'] = '';
		$_axMethod['ExampleCode'] = '';
		
		if ($_iMethodID > 0)
		{
			if
			(
				$_oMethodResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'docu_methods', 
						'asColumns' => array('MethodID', 'ReturnType', 'ReturnVariable', 'Name', 'Description', 'DetailDescription', 'ExampleCode'), 
						'sWhere' => 'MethodID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iMethodID))).'"', 
						'iStart' => NULL, 
						'iEnd' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				$_axMethod = $this->fetchDatabaseArray(array('xResult' => $_oMethodResult));
			} // _oMethodResult
		}
		
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'sEditForm', 'xFieldValue' => 'Method'));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iClassID', 'xFieldValue' => $_iClassID));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iMethodID', 'xFieldValue' => $_axMethod['MethodID']));

		$oPGForm->addInputField(
			array(
				'sLabelName' => 'ReturnType',
				'sInputFieldID' => $this->getID().'ReturnType',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethod['ReturnType']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'ReturnVariable',
				'sInputFieldID' => $this->getID().'ReturnVariable',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethod['ReturnVariable']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Name',
				'sInputFieldID' => $this->getID().'Name',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethod['Name']
			)
		);

		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'Description',
				'sTextAreaID' => $this->getID().'Description', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axMethod['Description']
			)
		);
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'DetailDescription',
				'sTextAreaID' => $this->getID().'DetailDescription', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axMethod['DetailDescription']
			)
		);
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'ExampleCode',
				'sTextAreaID' => $this->getID().'ExampleCode', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axMethod['ExampleCode']
			)
		);

		/*
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'JavaScript Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'JavaScript Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InJS', PG_CHECKBOX_MODE_AUTOSAVE, $_axMethod['InJS'], $_axStructure, $_sSendParameters).'<br />';
			
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'PHP Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'PHP Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InPHP', PG_CHECKBOX_MODE_AUTOSAVE, $_axMethod['InPHP'], $_axStructure, $_sSendParameters).'<br />';
	
			$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'Perl Version', NULL);
			$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'Perl Version', NULL);
			$_sHtml .= $oPGCheckBox->build('InPerl', PG_CHECKBOX_MODE_AUTOSAVE, $_axMethod['InPerl'], $_axStructure, $_sSendParameters).'<br />';
		*/
		
		$_sHtml .= $oPGForm->build(
			array(
				'sFormID' => $this->getID().'MethodForm', 
				'sTargetUrl' => $this->getUrl(), 
				'sTargetFrame' => $this->getUrlTarget(), 
				'sFormMethod' => 'post', 
				'asIgnoreHiddenInputs' => NULL
			)
		);
		
		$_sHtml .= '<br />';
		$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getDocuMethodContent('.$_iMethodID.'); oPGDevDocu.hidePopup();" target="_self">close</a>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	@param iMethodID
	@param iParameterID
	*/
	public function buildMethodParameterEditForm($_iMethodID, $_iParameterID = NULL)
	{
		global $oPGForm, $oPGCheckBox;

		$_iParameterID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iParameterID', 'xParameter' => $_iParameterID));
		$_iMethodID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iMethodID', 'xParameter' => $_iMethodID));

		$_sHtml = '';

		$oPGForm->useNetworkSend(array('bUse' => true));
		
		$_axMethod = array();
		$_axMethod['MethodID'] = $_iMethodID;
		$_axMethod['ParameterID'] = $_iParameterID;
		$_axMethod['Name'] = '';
		$_axMethod['Type'] = '';
		$_axMethod['DefaultValue'] = '';
		$_axMethod['PossibleValues'] = '';
		$_axMethod['IsNeeded'] = 0;
		$_axMethod['Position'] = 0;
		$_axMethod['Description'] = '';

		if ($_iParameterID > 0)
		{
			if
			(
				$_oMethodParameterResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'docu_method_parameters', 
						'asColumns' => array('ParameterID', 'Name', 'Type', 'DefaultValue', 'PossibleValues', 'IsNeeded', 'Position', 'Description'), 
						'sWhere' => 'ParameterID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iParameterID))).'"', 
						'iStart' => NULL, 
						'iEnd' => 1, 
						'sOrderBy' => NULL, 
						'bOrderReverse' => NULL
					)
				)
			)
			{
				$_axMethodParameter = $this->fetchDatabaseArray(array('xResult' => $_oMethodParameterResult));
			} // _oMethodParameterResult
		}
			
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'sEditForm', 'xFieldValue' => 'MethodParameter'));
		$oPGForm->addHiddenField(array('sHiddenFieldID' => 'iParameterID', 'xFieldValue' => $_axMethodParameter['ParameterID']));

		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Type',
				'sInputFieldID' => $this->getID().'Type',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethodParameter['Type']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Name',
				'sInputFieldID' => $this->getID().'Name',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethodParameter['Name']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'DefaultValue',
				'sInputFieldID' => $this->getID().'DefaultValue',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethodParameter['DefaultValue']
			)
		);
		
		$oPGForm->addInputField(
			array(
				'sLabelName' => 'Position',
				'sInputFieldID' => $this->getID().'Position',
				'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE,
				'iFieldSizeX' => 400,
				'xFieldValue' => $_axMethodParameter['Position']
			)
		);

		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'PossibleValues',
				'sTextAreaID' => $this->getID().'PossibleValues', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axMethodParameter['PossibleValues']
			)
		);
		
		$oPGForm->addTextArea(
			array(
				'sLabelName' => 'Description',
				'sTextAreaID' => $this->getID().'Description', 
				'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 
				'iSizeX' => 400, 
				'iRows' => 6, 
				'sText' => $_axMethodParameter['Description']
			)
		);
		
		$_axStructure[0] = $oPGCheckBox->buildStatusStructure(0, 'Is Needed', NULL);
		$_axStructure[1] = $oPGCheckBox->buildStatusStructure(1, 'Is Needed', NULL);
		$oPGForm->addCheckBox(
			array(
				'sLabelName' => 'is needed',
				$_sCheckBoxID = $this->getID().'IsNeeded',
				$_iCheckboxMode = PG_CHECKBOX_MODE_NONE,
				$_xSelectedStatus = $_axMethodParameter['IsNeeded'],
				$_axStatusStructure = $_axStructure
			)
		);
		
		$_sHtml .= $oPGForm->build(
			array(
				'sFormID' => $this->getID().'MethodForm', 
				'sTargetUrl' => $this->getUrl(), 
				'sTargetFrame' => $this->getUrlTarget(), 
				'sFormMethod' => 'post', 
				'asIgnoreHiddenInputs' => NULL
			)
		);
		
		$_sHtml .= '<br />';
		$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getDocuMethodContent(); oPGDevDocu.hidePopup();" target="_self">close</a>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	@param iClassID
	*/
	public function loadClass($_iClassID)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		
		$_axClass = NULL;
		
		$_asColumns = array(
			'ClassID', 'ClassName', 'Location', 'DefaultObject',
			'Description', 'ExampleCode' // 'ExampleVisual', 
		);
		
		if
		(
			$_oClassResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_classes', 
					'asColumns' => $_asColumns, 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iClassID))).'"', 
					'iStart' => NULL, 
					'iEnd' => 1, 
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axClass = $this->fetchDatabaseArray(array('xResult' => $_oClassResult)))
			{
				// Methods...
				$_axClass['axMethods'] = $this->loadMethods(array('iClassID' => $_iClassID));	
			} // if _axClass
		} // if _oClassResult
		
		return $_axClass;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function loadMethods($_iClassID)
	{
		$_iClassID = $this->getRealParameter(array('oParameters' => $_iClassID, 'sName' => 'iClassID', 'xParameter' => $_iClassID));
		
		$_axMethods = array();
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_methods', 
					'asColumns' => array('MethodID', 'Name', 'Description', 'ReturnType', 'ReturnValue'), 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_iClassID)).'"',
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			while ($_axMethod = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				// TODO...
				$_axMethod['axParameters'] = $this->loadMethodParameters(array('iMethodID' => $_axMethod['iMethodID']));
				$_axMethods[] = array(
					'sName' => $_axMethod['Name'],
					'sLocation' => '',
					'sPermission' => '',
					'sType' => '',
					'sParameters' => '',
					'description' => ''
				);
			} // while _axMethod
		} // if _oResult
		
		return $_axMethods;
	}
	/* @end method */
	
	/*
	@start method
	@param iMethodID
	*/
	public function loadMethodParameters($_iMethodID)
	{
		$_iMethodID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iMethodID', 'xParameter' => $_iMethodID));
		
		$_axParameters = array();
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_methods', 
					'asColumns' => array('Type', 'Name', 'DefaultValue', 'IsNeeded'), 
					'sWhere' => 'MethodID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iMethodID))).'"',
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Position', 
					'bOrderReverse' => false
				)
			)
		)
		{
			while ($_axParameter = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				// TODO...
				$_axParameters[] = array(
					'sName' => $_axParameter['Name'],
					'sType' => ''
					// ...
				);
			} // while _axParameter
		} // if _oResult
	
		return $_axParameters;
	}
	/* @end method */

	/*
	@start method
	@param iClassID
	@param xDetailed
	*/
	public function buildClass($_axClass, $_xDetailed = NULL, $_bUseHtmlFiles = NULL)
	{
		global $oPGLogin;
		
		$_xDetailed = $this->getRealParameter(array('oParameters' => $_axClass, 'sName' => 'xDetailed', 'xParameter' => $_xDetailed));
		$_bUseHtmlFiles = $this->getRealParameter(array('oParameters' => $_axClass, 'sName' => 'bUseHtmlFiles', 'xParameter' => $_bUseHtmlFiles));
		$_axClass = $this->getRealParameter(array('oParameters' => $_axClass, 'sName' => 'axClass', 'xParameter' => $_axClass, 'bNotNull' => true));
		
		if ($_xDetailed === 1) {$_xDetailed = true;} else if ($_xDetailed === 0) {$_xDetailed = false;}
		
		$_sHtml = '';
		
		// $_sLanguageIcons = $this->buildAvailableLanguagesIcons($_axClass, NULL, NULL, true);
		$_sLanguageIcons = '';

		if (($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))) && ($_axClass['iClassID'] > 0))
		{
			$_sHtml .= '<a href="javascript:;" onclick="oPGDevDocu.getClassEditForm('.$_axClass['iClassID'].');" target="_self">';
			$_sHtml .= '<img src="icons/edit.png" style="border-width:0px;" /> edit class';
			$_sHtml .= '</a>';
			$_sHtml .= '<br />';
		}
		
		if ($_axClass['sName'] != '') {$_sHtml .= '<h1>Class name: '.$_axClass['sName'].' '.$_sLanguageIcons.'</h1>';}
		if ($_axClass['sLocation'] != '') {$_sHtml .= 'Location: '.$_axClass['sLocation'].'<br />';}
		if ($_axClass['sDefaultObject'] != '')
		{
			$_sHtml .= 'Default object: '.$_axClass['sDefaultObject'].'<br />';
			if ($_axClass['sDefaultObjectDescription'] != '') {$_sHtml .= $_axClass['sDefaultObjectDescription'].'<br />';}
		}
		if ($_axClass['sDescription'] != '') {$_sHtml .= '<h2>Description</h2><div class="pg_docu_descriptions_container"><span class="pg_docu_descriptions">'.$this->formatString(array('sString' => $_axClass['sDescription'])).'</span></div><br />';}
		// if ($_axClass['sExampleVisual'] != '') {$_sHtml .= '<h2>Visual example</h2><div id="PG_Docu_Example" class="pg_docu_example">'.$_axClass['sExampleVisual'].'</div><br />';}
		if ($_axClass['sExampleCode'] != '') {$_sHtml .= '<h2>Example code</h2><div class="pg_docu_example">'.$_axClass['sExampleCode'].'</div><br />';}
	
		// see also...
		/*
		if
		(
			$_oFileLinkResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_filelinks', 
					'asColumns' => NULL, 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_axClass['iClassID'])).'"', 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($this->getDatasetsRowCount(array('xResult' => $_oFileLinkResult, 'sEngine' => NULL)) > 0)
			{
				$_sHtml .= '<h2>See also...</h2>';
				while ($_axFileLink = $this->fetchDatabaseArray(array('xResult' => $_oFileLinkResult)))
				{
					$_sHtml .= $_axFileLink['Name'];
				} // while _axFileLink
			}
		} // if _oFileLinkResult
		*/
		
		// Global Defines...
		/*
		if
		(
			$_oDefineResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_defines', 
					'asColumns' => NULL, 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_axClass['iClassID'])).'"', 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($this->getDatasetsRowCount(array('xResult' => $_oDefineResult, 'sEngine' => NULL)) > 0)
			{
				$_sHtml .= '<h2>Global Defines</h2>';
				$_sHtml .= '<table style="border-width:0px;">';
				while ($_axDefine = $this->fetchDatabaseArray(array('xResult' => $_oDefineResult)))
				{
					$_sHtml .= '<tr>';
						$_sHtml .= '<td style="vertical-align:top;">';
							// $_sHtml .= $this->buildAvailableLanguagesIcons(array('' => $_axDefine));
						$_sHtml .= '</td>';
						if ($oPGLogin->isUserType(PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))
						{
							$_sHtml .= '<td style="vertical-align:top;">';
								$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getDefineEditForm('.$_axDefine['DefineID'].');">';
								$_sHtml .= '<img src="icons/edit.png" style="border-width:0px;" />';
								$_sHtml .= '</a> ';
							$_sHtml .= '</td>';
						}
						$_sHtml .= '<td class="pg_docu_defines" style="vertical-align:top;">'.$_axDefine['Name'].'</td>';
						$_sHtml .= '<td class="pg_docu_descriptions" style="vertical-align:top;">'.$this->formatString(array('sString' => $_axDefine['Description'])).'</td>';
					$_sHtml .= '</tr>';
				} // while _axDefine
				$_sHtml .= '</table>';
				$_sHtml .= '<br />';
			}
		} // if _oDefineResult
		
		if ($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN)))
		{
			$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getDefineEditForm(0);">';
			$_sHtml .= '<img src="icons/add.png" style="border-width:0px;" /> new Define';
			$_sHtml .= '</a>';
			$_sHtml .= '<br />';
		}
		*/
		
		// Variables...
		/*
		if
		(
			$_oVariableResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_variables', 
					'asColumns' => NULL, 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_axClass['iClassID'])).'"', 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($this->getDatasetsRowCount(array('xResult' => $_oVariableResult, 'sEngine' => NULL)) > 0)
			{
				$_sHtml .= '<h2>Variables</h2>';
				$_sHtml .= '<table style="border-width:0px;">';
				while ($_axVariable = $this->fetchDatabaseArray(array('xResult' => $_oVariableResult)))
				{
					$_sHtml .= '<tr>';
						$_sHtml .= '<td class="pg_docu_variables" style="vertical-align:top;">'.$_axVariable['Name'].'</td>';
						$_sHtml .= '<td class="pg_docu_descriptions" style="vertical-align:top;">'.$this->formatString(array('sString' => $_axVariable['Description'])).'</td>';
					$_sHtml .= '</tr>';
				} // while _axVariable
				$_sHtml .= '</table>';
				$_sHtml .= '<br />';
			}
		} // if _oVariableResult
		*/
		
		// Properties...
		/*
		if
		(
			$_oPropertyResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_properties', 
					'asColumns' => array('PropertyID', 'Name', 'Type', 'DefaultValue', 'Description'), 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_axClass['iClassID'])).'"', 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($this->getDatasetsRowCount(array('xResult' => $_oPropertyResult, 'sEngine' => NULL)) > 0)
			{
				$_sHtml .= '<h2>Properties</h2>';
				$_sHtml .= '<table style="border-width:0px;">';
				while ($_axProperty = $this->fetchDatabaseArray(array('xResult' => $_oPropertyResult)))
				{
					$_sHtml .= '<tr>';
						$_sHtml .= '<td style="vertical-align:top;">';
							// $_sHtml .= $this->buildAvailableLanguagesIcons(array('' => $_axProperty));
						$_sHtml .= '</td>';
						if ($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN)))
						{
							$_sHtml .= '<td style="vertical-align:top;">';
								$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getPropertyEditForm('.$_axProperty['PropertyID'].');">';
								$_sHtml .= '<img src="icons/edit.png" style="border-width:0px;" />';
								$_sHtml .= '</a> ';
							$_sHtml .= '</td>';
						}
						$_sHtml .= '<td style="vertical-align:top;">';
						$_sHtml .= '<nobr>';
						if ($_xDetailed == true)
						{
							if ($_axProperty['Type'] != '') {$_sHtml .= '<span class="pg_docu_types">'.$_axProperty['Type'].'</span> ';}
						}
						$_sHtml .= '<span class="pg_docu_properties">'.$_axProperty['Name'].'</span>';
						if ($_xDetailed == true)
						{
							if ($_axProperty['DefaultValue'] != '') {$_sHtml .= ' = <span class="pg_docu_defaults">'.$_axProperty['DefaultValue'].'</span>';}
						}
						$_sHtml .= '</nobr>';
						$_sHtml .= '</td>';
						$_sHtml .= '<td class="pg_docu_descriptions" style="vertical-align:top;">'.$this->formatString(array('sString' => $_axProperty['Description'])).'</td>';
					$_sHtml .= '</tr>';
				} // while _axProperty
				$_sHtml .= '</table>';
				$_sHtml .= '<br />';
			}
		} // if _oPropertyResult

		if ($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN)))
		{
			$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getPropertyEditForm(0);">';
			$_sHtml .= '<img src="icons/add.png" style="border-width:0px;" /> new property';
			$_sHtml .= '</a>';
			$_sHtml .= '<br />';
		}
		*/
		
		// Functions...
		/*
		if
		(
			$_oFunctionResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_functions', 
					'asColumns' => NULL, 
					'sWhere' => 'ClassID = "'.$this->realEscapeDatabaseString(array('xString' => $_axClass['iClassID'])).'"', 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($this->getDatasetsRowCount(array('xResult' => $_oFunctionResult, 'sEngine' => NULL)) > 0)
			{
				$_sHtml .= '<h2>Functions</h2>';
				$_sHtml .= '<table style="border-width:0px;">';
				while ($_axFunction = $this->fetchDatabaseArray(array('xResult' => $_oFunctionResult)))
				{
					$_sHtml .= '<tr>';
						$_sHtml .= '<td class="pg_docu_functions" style="vertical-align:top;">'.$_axFunction['Name'].'</td>';
						$_sHtml .= '<td class="pg_docu_descriptions" style="vertical-align:top;">'.$this->formatString(array('sString' => $_axFunction['Description'])).'</td>';
					$_sHtml .= '</tr>';
				} // while _axFunction
				$_sHtml .= '</table>';
				$_sHtml .= '<br />';
			}
		} // if _oFunctionResult
		*/
		
		// Methods...
		if (count($_axClass['axMethods']) > 0)
		{
			$_asGroupsCssClass = array();
			$_asGroups = array();
			// $_sCodeCssClass = 'pg_docu_code_color2';
			
			$_sHtml .= '<h2>Methods</h2>';
			$_sHtml .= '<div class="pg_docu_methods_container">';
			
				$_sHtml .= '<table style="border-width:0px;">';
				for ($_iMethodIndex = 0; $_iMethodIndex<count($_axClass['axMethods']); $_iMethodIndex++)
				{
					$_axMethod = $_axClass['axMethods'][$_iMethodIndex];
					$_sGroup = 'Other';
					if (isset($_axMethod['sGroup'])) {if ($_axMethod['sGroup'] != NULL) {$_sGroup = $_axMethod['sGroup'];}}
					
					if (!isset($_asGroups[$_sGroup]))
					{
						$_asGroupsCssClass[$_sGroup] = 'pg_docu_code_color2';
						$_asGroups[$_sGroup] = '<tr><td><h3>'.$_sGroup.'</h3></td></tr>';
					}
					
					if ($_asGroupsCssClass[$_sGroup] == 'pg_docu_code_color1') {$_asGroupsCssClass[$_sGroup] = 'pg_docu_code_color2';}
					else {$_asGroupsCssClass[$_sGroup] = 'pg_docu_code_color1';}

					$_asGroups[$_sGroup] .= '<tr>';
						$_asGroups[$_sGroup] .= '<td style="vertical-align:top;" class="'.$_asGroupsCssClass[$_sGroup].'">';
						
						$_asGroups[$_sGroup] .= '<table style="border-width:0px;">';
						$_asGroups[$_sGroup] .= '<tr>';
							$_asGroups[$_sGroup] .= '<td style="vertical-align:top;">';
								// $_asGroups[$_sGroup] .= $this->buildAvailableLanguagesIcons(array('' => $_axMethod));
							$_asGroups[$_sGroup] .= '</td>';	

							if (($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))) && ($_axMethod['iMethodID'] > 0))
							{
								$_asGroups[$_sGroup] .= '<td style="vertical-align:top;">';
									$_asGroups[$_sGroup] .= '<a href="javascript:;" target="_self" onclick="oPGDocumentation.getMethodEditForm('.$_axMethod['iMethodID'].');">';
									$_asGroups[$_sGroup] .= '<img src="icons/edit.png" style="border-width:0px;" />';
									$_asGroups[$_sGroup] .= '</a>';
								$_asGroups[$_sGroup] .= '</td>';
							}

							$_asGroups[$_sGroup] .= '<td style="vertical-align:top;" class="pg_docu_code_nowrap">';
								if ($_xDetailed == true)
								{
									if ($_axMethod['sReturnType'] != '') {$_asGroups[$_sGroup] .= '<span class="pg_docu_types">'.$_axMethod['sReturnType'].'</span> ';}
								}
								if ($_axMethod['sReturnVariable'] != '') {$_asGroups[$_sGroup] .= '<span class="pg_docu_returns">'.$_axMethod['sReturnVariable'].'</span> = ';}
								if ($_bUseHtmlFiles == true) {$_asGroups[$_sGroup] .= '<a href="'.$_axClass['sName'].'.'.$_axMethod['sName'].'.html" target="_self" class="pg_docu_methods">';}
								else if ($_axMethod['iMethodID'] > 0) {$_asGroups[$_sGroup] .= '<a href="javascript:;" target="_self" onclick="oPGDocumentation.getDocuMethodContent({\'iMethodID\': '.$_axMethod['iMethodID'].'});" class="pg_docu_methods">';}
								else {$_asGroups[$_sGroup] .= '<a href="javascript:;" target="_self" onclick="oPGDocumentation.getDocuMethodContent({\'sFile\': \''.$_axMethod['sLocation'].'\', \'sClass\': \''.$_axClass['sName'].'\', \'sMethod\': \''.$_axMethod['sName'].'\'});" class="pg_docu_methods">';}
								// else {$_asGroups[$_sGroup] .= '<a href="'.$this->getUrl().'?sFile='.urlencode($_axMethod['sLocation']).'&sMethod='.$_axMethod['sName'].'" target="'.$this->getUrlTarget().'" class="pg_docu_methods">';}
								$_asGroups[$_sGroup] .= $_axMethod['sName'];
								$_asGroups[$_sGroup] .= '</a>';
								$_asGroups[$_sGroup] .= '(';
							$_asGroups[$_sGroup] .= '</td>';
							$_asGroups[$_sGroup] .= '<td style="vertical-align:top;" class="pg_docu_code">';

							// Method Parameters...
							$_iParameterCount=0;
							$_iIsNeeded = 0;
							$_axParameterDescriptions = array();
							for ($_iMethodParametersIndex=0; $_iMethodParametersIndex<count($_axMethod['axParameters']); $_iMethodParametersIndex++)
							{
								$_axMethodParameter = $_axMethod['axParameters'][$_iMethodParametersIndex];
								
								if ($_iParameterCount>0) {$_asGroups[$_sGroup] .= ', ';}
								$_asGroups[$_sGroup] .= '<span class="pg_docu_code_nowrap">';
									if ($_axMethodParameter['bIsNeeded'] != 1) {$_asGroups[$_sGroup] .= '['; $_iIsNeeded++;}
									if ($_xDetailed == true)
									{
										if ($_axMethodParameter['sType'] != '') {$_asGroups[$_sGroup] .= '<span class="pg_docu_types">'.$_axMethodParameter['sType'].'</span> ';}
									}
									$_asGroups[$_sGroup] .= '<span class="pg_docu_variables">'.$_axMethodParameter['sName'].'</span>';
									if ($_xDetailed == true)
									{
										if ($_axMethodParameter['sDefaultValue'] != '') {$_asGroups[$_sGroup] .= ' = <span class="pg_docu_defaults">'.$_axMethodParameter['sDefaultValue'].'</span>';}
									}
								$_asGroups[$_sGroup] .= '</span>';
								$_iParameterCount++;
							}
							$_asGroups[$_sGroup] .= str_repeat(']', $_iIsNeeded);
							
							$_asGroups[$_sGroup] .= ')</td>';
						$_asGroups[$_sGroup] .= '</tr>';
						$_asGroups[$_sGroup] .= '</table>';
							
						$_asGroups[$_sGroup] .= '</td>';
						$_asGroups[$_sGroup] .= '<td class="pg_docu_descriptions '.$_asGroupsCssClass[$_sGroup].'" style="vertical-align:top;">'.$this->formatString(array('sString' => $_axMethod['sDescription'])).'</td>';
					$_asGroups[$_sGroup] .= '</tr>';
				} // while _axMethod
				
				foreach ($_asGroups as $_sGroupName => $_sGroupMethods)
				{
					$_sHtml .= $_sGroupMethods;
				}
				
				$_sHtml .= '</table>';
			$_sHtml .= '</div>';
		}
	
		if (($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))) && ($_axClass['iClassID'] > 0))
		{
			$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getMethodEditForm(0);">';
			$_sHtml .= '<img src="icons/add.png" style="border-width:0px;" /> new method';
			$_sHtml .= '</a>';
			$_sHtml .= '<br />';
		}
		return $_sHtml;
	}
	/* @end method */
	
	// TODO
	public function loadMethod($_iMethodID)
	{
		$_iMethodID = $this->getRealParameter(array('oParameters' => $_iMethodID, 'sName' => 'iMethodID', 'xParameter' => $_iMethodID));
		
		$_axMethods = array();
		
		$_asColumns = array(
			'MethodID', 'ClassID', 'Name', 'Description', 
			'DetailDescription', 'ReturnType',
			'ReturnValue', 'ProgrammingLanguage'
		);
		
		$_sWhere = '';
		$_sWhere .= 'MethodID = "'.$this->realEscapeDatabaseString(array('xString' => trim($_iMethodID))).'"';
		
		if
		(
			$_oMethodResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_methods', 
					'asColumns' => $_asColumns, 
					'sWhere' => $_sWhere, 
					'iStart' => NULL, 
					'iEnd' => 1, 
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL
				)
			)
		)
		{
			if ($_axMethod = $this->fetchDatabaseArray(array('xResult' => $_oMethodResult)))
			{
				// TODO
				
				// Class...
				if
				(
					$_oClassResult = $this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'docu_classes', 
							'asColumns' => array('Name'), 
							'sWhere' => 'ClassID = "'.$_axMethod['ClassID'].'"', 
							'iStart' => NULL, 
							'iEnd' => 1, 
							'sOrderBy' => NULL, 
							'bOrderReverse' => NULL
						)
					)
				)
				{
					if ($_axClass = $this->fetchDatabaseArray(array('xResult' => $_oClassResult)))
					{
						$_axMethod['sClassName'] = $_axClass['Name'];
					}
				}
				
				// TODO: Parameters...
				if
				(
					$_oMethodParameterResult = $this->selectDatasets(
						array(
							'sTable' => $this->getDatabaseTablePrefix().'docu_method_parameters', 
							'asColumns' => array('ParameterID', 'Type', 'Name', 'DefaultValue', 'Description', 'IsNeeded'), 
							'sWhere' => 'MethodID = "'.$_axMethod['MethodID'].'"', 
							'iStart' => NULL, 
							'iEnd' => NULL, 
							'sOrderBy' => 'Position', 
							'bOrderReverse' => false
						)
					)
				)
				{
					while ($_axMethodParameter = $this->fetchDatabaseArray(array('xResult' => $_oMethodParameterResult)))
					{
					} // while _axMethodParameter
				} // if _oMethodParameterResult
			} // if _axMethod
		} // if _oMethodResult
		
		return $_axMethod;
	}

	/*
	@start method
	@param iMethodID
	@param xDetailed
	*/
	public function buildMethod($_axMethod, $_xDetailed = NULL, $_bUseHtmlFiles = NULL)
	{
		global $oPGLogin;

		$_xDetailed = $this->getRealParameter(array('oParameters' => $_axMethod, 'sName' => 'xDetailed', 'xParameter' => $_xDetailed));
		$_bUseHtmlFiles = $this->getRealParameter(array('oParameters' => $_axMethod, 'sName' => 'bUseHtmlFiles', 'xParameter' => $_bUseHtmlFiles));
		$_axMethod = $this->getRealParameter(array('oParameters' => $_axMethod, 'sName' => 'axMethod', 'xParameter' => $_axMethod, 'bNotNull' => true));
		
		if ($_xDetailed === 1) {$_xDetailed = true;} else if ($_xDetailed === 0) {$_xDetailed = false;}
		
		$_sHtml = '';
		
		// Method...
		$_sLanguageIcons = '';
		// $_sLanguageIcons = $this->buildAvailableLanguagesIcons(array('' => $_axMethod, '' => NULL, '' => NULL, '' => true));

		if (($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))) && ($_axMethod['iMethodID'] > 0))
		{
			$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getMethodEditForm('.$_axMethod['iMethodID'].');">';
			$_sHtml .= '<img src="icons/edit.png" style="border-width:0px;" /> edit method';
			$_sHtml .= '</a> ';
		}

		$_sHtml .= '<h1>Method name: '.$_axMethod['sName'].' '.$_sLanguageIcons.'</h1>';

		$_sHtml .= '<h2>';
			$_sHtml .= 'Member of: ';
			if ($_bUseHtmlFiles == true) {$_sHtml .= '<a href="'.$_axMethod['sClassName'].'.html" target="_self">';}
			else if ($_axMethod['iMethodID'] > 0) {$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDocumentation.getDocuClassContent({\'iMethodID\': '.$_axMethod['iMethodID'].'});">';}
			else {$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDocumentation.getDocuClassContent({\'sFile\': \''.$_axMethod['sLocation'].'\', \'sClass\': \''.$_axMethod['sClassName'].'\'});">';}
				$_sHtml .= $_axMethod['sClassName'];
			$_sHtml .= '</a>';
		$_sHtml .= '</h2>';

		if ($_axMethod['sLocation'] != '') {$_sHtml .= 'Location: '.$_axMethod['sLocation'].'<br />';}

		$_sHtml .= '<h2>Definition</h2>';
		$_sHtml .= '<div class="pg_docu_methods_container">';
			$_sHtml .= '<table style="border-width:0px;">';
			$_sHtml .= '</tr>';
				$_sHtml .= '<td style="vertical-align:top;">';
					$_sHtml .= '<nobr>';
					if ($_xDetailed == true)
					{
						if ($_axMethod['sReturnType'] != '') {$_sHtml .= '<span class="pg_docu_types">'.$_axMethod['sReturnType'].'</span> ';}
					}
					if ($_axMethod['sReturnVariable'] != '') {$_sHtml .= '<span class="pg_docu_returns">'.$_axMethod['sReturnVariable'].'</span> = ';}
					$_sHtml .= '<span class="pg_docu_methods">'.$_axMethod['sName'].'</span>(';
					$_sHtml .= '</nobr>';
				$_sHtml .= '</td>';
				$_sHtml .= '<td style="vertical-align:top;">';

				// Method Parameters...
				// $_iParameterCount=0;
				if (count($_axMethod['axParameters']) > 0)
				{
					$_iIsNeeded = 0;
					$_axParameterDescriptions = array();
					for ($_iParameterIndex=0; $_iParameterIndex<count($_axMethod['axParameters']); $_iParameterIndex++)
					{
						$_axMethodParameter = $_axMethod['axParameters'][$_iParameterIndex];
						
						if ($_iParameterIndex > 0) {$_sHtml .= ', ';}
						$_sHtml .= '<span class="pg_docu_code_nowrap">';
							if ($_axMethodParameter['bIsNeeded'] != true) {$_sHtml .= '['; $_iIsNeeded++;}
							if ($_xDetailed == true)
							{
								if ($_axMethodParameter['sType'] != '') {$_sHtml .= '<span class="pg_docu_types">'.$_axMethodParameter['sType'].'</span> ';}
							}
							$_sHtml .= '<span class="pg_docu_variables">'.$_axMethodParameter['sName'].'</span>';
							if ($_xDetailed == true)
							{
								if ($_axMethodParameter['sDefaultValue'] != '') {$_sHtml .= ' = <span class="pg_docu_defaults">'.$_axMethodParameter['sDefaultValue'].'</span>';}
							}
						$_sHtml .= '</span>';
						// $_iParameterCount++;
					}
					$_sHtml .= str_repeat(']', $_iIsNeeded);
				}
				
				$_sHtml .= ')</td>';
			$_sHtml .= '</tr>';
			$_sHtml .= '</table>';
		$_sHtml .= '</div>';
		
		if ($_axMethod['sDescription'] != '')
		{
			$_sHtml .= '<h2>Short Description</h2>';
			$_sHtml .= '<div class="pg_docu_descriptions_container">';
				$_sHtml .= '<span class="pg_docu_descriptions">'.$this->formatString(array('sString' => $_axMethod['sDescription'])).'</span>';
			$_sHtml .= '</div>';
		}
		
		if (count($_axMethod['axParameters']) > 0)
		{
			$_sHtml .= '<h2>Properties</h2>';
			$_sHtml .= '<div class="pg_docu_properties_container">';
			$_iIsNeeded = 0;
			$_axParameterDescriptions = array();
			for ($_iParameterIndex=0; $_iParameterIndex<count($_axMethod['axParameters']); $_iParameterIndex++)
			{
				$_axMethodParameter = $_axMethod['axParameters'][$_iParameterIndex];

				$_sHtml .= '<h3>';
				if ($oPGLogin->isUserType(PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))
				{
					$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getMethodParameterEditForm('.$_axMethodParameter['iParameterID'].');">';
					$_sHtml .= '<img src="icons/edit.png" style="border-width:0px;" />';
					$_sHtml .= '</a> ';
				}
				$_sHtml .= '<span class="pg_docu_properties">'.$_axMethodParameter['sName'].'</span></h3>';
				if ($_axMethodParameter['sType'] != '') {$_sHtml .= 'type: <span class="pg_docu_types">'.$_axMethodParameter['sType'].'</span><br />';}
				if ($_axMethodParameter['sDefaultValue'] != '') {$_sHtml .= 'default value: <span class="pg_docu_defaults">'.$_axMethodParameter['sDefaultValue'].'</span><br />';}
				$_sHtml .= '<span class="pg_docu_descriptions">'.$this->formatString(array('sString' => $_axMethodParameter['sDescription'])).'</span><br />';
				$_sHtml .= '<br />';
			}
			$_sHtml .= '</div>';
		}
	
		if (($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN | PG_LOGIN_USERTYPE_ADMIN))) && ($_axMethod['iMethodID'] > 0))
		{
			$_sHtml .= '<a href="javascript:;" target="_self" onclick="oPGDevDocu.getMethodParameterEditForm(0);">';
			$_sHtml .= '<img src="icons/add.png" style="border-width:0px;" /> new parameter';
			$_sHtml .= '</a>';
			$_sHtml .= '<br />';
		}

		if ($_axMethod['sDetailDescription'] != '')
		{
			$_sHtml .= '<h2>Description</h2>';
			$_sHtml .= '<span class="pg_docu_descriptions">'.$this->formatString(array('sString' => $_axMethod['sDetailDescription'])).'</span>';
			$_sHtml .= '<br />';
		}
		
		if ($_axMethod['sReturnValue'] != '')
		{
			$_sHtml .= '<h2>Returns</h2>';
			$_sHtml .= '<div class="pg_docu_returns_container">';
					if (($_axMethod['sReturnVariable'] != '') || ($_axMethod['sReturnType'] != ''))
					{
						$_sHtml .= '<span class="pg_docu_types">'.$_axMethod['sReturnType'].'</span> <span class="pg_docu_returns">'.$_axMethod['sReturnVariable'].'</span><br />';
					}
					$_sHtml .= '<span class="pg_docu_descriptions">'.$this->formatString(array('sString' => $_axMethod['sReturnValue'])).'</span>';
			$_sHtml .= '</div>';
		}

		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	@param sType
	@param sProgrammingLanguage
	*/
	public function loadMenuPointsClasses($_sType, $_sProgrammingLanguage = NULL)
	{
		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_sType, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sType = $this->getRealParameter(array('oParameters' => $_sType, 'sName' => 'sType', 'xParameter' => $_sType));

		$_iCurrentSubMenuPoint = 0;
		$_axMenuPoints = array();
	
		$_asColumns = array('ClassID', 'Name', 'ProgrammingLanguage');
		
		$_sWhere = '';
		$_sWhere .= 'Type = "'.$this->realEscapeDatabaseString(array('xString' => trim($_sType))).'"';
		if ($_sProgrammingLanguage != NULL) {$_sWhere .= 'ProgrammingLanguage = "'.$_sProgrammingLanguage.'"';}
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'docu_classes', 
					'asColumns' => $_asColumns, 
					'sWhere' => $_sWhere, 
					'iStart' => NULL, 
					'iEnd' => NULL, 
					'sOrderBy' => 'Name', 
					'bOrderReverse' => false
				)
			)
		)
		{
			if ($_axClasses = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				$_axMenuPoints[$_iCurrentSubMenuPoint] = $_axClasses;
				$_iCurrentSubMenuPoint++;
			}
		}
		return $_axMenuPoints;
	}
	/* @end method */
	
	public function parseMenuPoints($_sPath)
	{
		global $oPGDocuParser;
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		return $oPGDocuParser->getMenuPoints(array('sPath' => $_sPath));
	}

	/*
	@start method
	@param axMenuPoints
	@param sMenuID
	*/
	public function buildMenuPoints($_axMenuPoints, $_sMenuID = NULL)
	{
		global $oPGBrowser, $oPGStrings;

		$_sMenuID = $this->getRealParameter(array('oParameters' => $_axMenuPoints, 'sName' => 'sMenuID', 'xParameter' => $_sMenuID));
		$_axMenuPoints = $this->getRealParameter(array('oParameters' => $_axMenuPoints, 'sName' => 'axMenuPoints', 'xParameter' => $_axMenuPoints, 'bNotNull' => true));

		$_bFirstMenu = false;
		if ($_sMenuID === NULL) {$_sMenuID = $this->getID().'Menu'; $_bFirstMenu = true;}
		
		$_bUseHtmlFiles = false;
		
		$_sHtml = '';
		$_sHtml .= '<ul id="'.$_sMenuID.'" class="menu" style="';
			if ($_bFirstMenu == true) {$_sHtml .= 'display:block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= '">';
		for ($i=0; $i<count($_axMenuPoints); $i++)
		{
			$_sHtml .= '<li id="'.$_sMenuID.'_Point'.$i.'" style="';
				if ($_axMenuPoints[$i]['sType'] == 'folder') {$_sHtml .= 'list-style-type:circle; ';} // circle and disc
				else if ($_axMenuPoints[$i]['sType'] == 'file') {$_sHtml .= 'list-style-type:square; ';}
			$_sHtml .= '">';
				$_sHtml .= '<nobr>';
					if (!$oPGBrowser->isMobile()) {$_sHtml .= $this->buildAvailableLanguagesIcons($_axMenuPoints[$i]);}
					if ($_axMenuPoints[$i]['sType'] == 'file')
					{
						if ($_bUseHtmlFiles == true) {$_sHtml .= '<a href="'.$_axMenuPoints[$i]['sName'].'.html" target="_self" onmouseup="';}
						else if ($_axMenuPoints[$i]['iClassID'] > 0) {$_sHtml .= '<a href="javascript:;" target="_self" onmouseup="oPGDocumentation.getDocuFileContent({\'iClassID\': '.$_axMenuPoints[$i]['iClassID'].'}); ';}
						else if ($_axMenuPoints[$i]['sClass'] != NULL) {$_sHtml .= '<a href="javascript:;" target="_self" onmouseup="oPGDocumentation.getDocuFileContent({\'sFile\': \''.$_axMenuPoints[$i]['sFile'].'\', \'sClass\': \''.$_axMenuPoints[$i]['sClass'].'\'}); ';}
						else {$_sHtml .= '<a href="javascript:;" target="_self" onmouseup="oPGDocumentation.getDocuFileContent({\'sFile\': \''.$_axMenuPoints[$i]['sFile'].'\'}); ';}
					}
					else {$_sHtml .= '<a href="javascript:;" onmouseup="';}
					if ($_axMenuPoints[$i]['sType'] == 'folder')
					{
						$_sHtml .= 'oPGDocumentation.onMenuPointMouseUp({\'sMenuID\': \''.$_sMenuID.'\', \'sSubMenu\': \''.$_axMenuPoints[$i]['sName'].'\', \'iMenuPointIndex\': '.$i.'}); ';
						if (isset($_axMenuPoints[$i]['sFile']))
						{
							if ($_axMenuPoints[$i]['sFile'] != '')
							{
								if ($oPGStrings->getFileExtension(array('sString' => $_axMenuPoints[$i]['sFile'])) != '')
								{
									$_sHtml .= 'oPGDocumentation.getDocuFileContent({\'sFile\': \''.$_axMenuPoints[$i]['sFile'].'\'}); ';
								}
							}
						}
					}
					$_sHtml .= '" class="pg_docu_menupoint">';

						$_sHtml .= $_axMenuPoints[$i]['sName'];
					$_sHtml .= '</a>';
				$_sHtml .= '</nobr>';
			$_sHtml .= '</li>';
			if (isset($_axMenuPoints[$i]['axSubMenu']))
			{
				if ($_axMenuPoints[$i]['axSubMenu'] != NULL) {$_sHtml .= $this->buildMenuPoints(array('axMenuPoints' => $_axMenuPoints[$i]['axSubMenu'], 'sMenuID' => $_sMenuID.'_'.$_axMenuPoints[$i]['sName']));}
			}
		}
		$_sHtml .= '</ul>';
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	@param xJavaScript
	@param xPHP
	@param xPerl
	@param bBigIcons
	*/
	public function buildAvailableLanguagesIcons($_xJavaScript = NULL, $_xPHP = NULL, $_xPerl = NULL, $_bBigIcons = NULL)
	{
		// TODO
	}
	/* @end method */
	
	/*
	@start method
	
	@param sName
	@param sType
	@param axSubMenu
	*/
	public function addMenuPoint($_sName, $_sType = NULL, $_sFile = NULL, $_axSubMenu = NULL)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_axSubMenu = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'axSubMenu', 'xParameter' => $_axSubMenu));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		
		$this->axMenuPoints[] = array(
			'iClassID' => NULL,
			'sClass' => NULL,
			'sFile' => $_sFile,
			'sName' => $_sName,
			'sType' => $_sType,
			'axSubMenu' => $_axSubMenu
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sName
	@param sType
	@param sFile
	@param axSubMenu
	*/
	public function buildSubMenuPointStructure($_sName, $_sType = NULL, $_sFile = NULL, $_axSubMenu = NULL)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_axSubMenu = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'axSubMenu', 'xParameter' => $_axSubMenu));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		
		return array(
			'iClassID' => NULL,
			'sClass' => NULL,
			'sFile' => $_sFile,
			'sName' => $_sName,
			'sType' => $_sType,
			'axSubMenu' => $_axSubMenu
		);
	}
	/* @end method */
	
	/*
	@start method
	@param sDocumentationID
	@param sProgrammingLanguage
	@param sPath
	*/
	public function buildBodyContent($_sDocumentationID = NULL, $_sProgrammingLanguage = NULL, $_sPath = NULL)
	{
		global $oPGLogin, $oPGBrowser, $oPGFrameset, $oPGCodeParser;

		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$_sDocumentationID = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sDocumentationID', 'xParameter' => $_sDocumentationID));

		if ($_sDocumentationID === NULL) {$_sDocumentationID = $this->getID();}

		$_sHtml = '';
		
		$_iFramesetWidth = 800;
		$_iFramesetHeight = 650;
		$_iFramesetFrameMenuSize = 250;
		$_iFramesetFrameInfoBarSize = 40;
		if ($oPGBrowser->isMobile()) {$_iFramesetFrameMenuSize = 100;}
		$_iFramesetFrameMainSize = $_iFramesetWidth-5-$_iFramesetFrameMenuSize;

		$_sCssClassFrame = NULL;
		$_sCssClassBorder = NULL;

		// InfoBar...
		$_sFramesetFrameInfoBar = '';
		if ($this->isDatabase())
		{
			if ($oPGLogin->isGuest())
			{
				$_sFramesetFrameInfoBar .= $oPGLogin->build(array('iBuildType' => PG_LOGIN_BUILD_TYPE_LOGIN_BAR_TOP));
			}
			else
			{
				if ($oPGLogin->isUserType(array('iType' => PG_LOGIN_USERTYPE_SUPERADMIN)))
				{
					if (isset($oPGCodeParser))
					{
						$_sFramesetFrameInfoBar .= '<a href="javascript:;" onclick="alert(\'todo\');" target="_self">generate from Files</a>';
					}
				}
			}
		}
		
		$_axSubMenu = array();
		if ($_sPath !== NULL) {$_axSubMenu = $this->parseMenuPoints(array('sPath' => $_sPath));}
		else if ($this->isDatabase()) {$_axSubMenu = $this->loadMenuPointsClasses('class', $_sProgrammingLanguage);}
		
		$this->axMenuPoints[] = array(
			'sName' => 'API Reference',
			'sType' => 'folder',
			'axSubMenu' => $_axSubMenu
		);
		
		// Menu...
		$_sFramesetFrameMenu = '';
		$_sFramesetFrameMenu .= $this->buildMenuPoints(array('axMenuPoints' => $this->axMenuPoints));

		// Main content...
		$_sFramesetFrameMain = '';
		$_sFramesetFrameMain .= '<div id="'.$_sDocumentationID.'DocuContent" style="margin:0px; padding:10px;">';
		// $_sFramesetFrameMain .= '<h1>'.$this->getText(array('sType' => 'IntroPageTitle')).'</h1>';
		// $_sFramesetFrameMain .= $this->getText(array('sType' => 'IntroPageText'));
		$_sFramesetFrameMain .= '</div>';
		
		$_axFrames = array();
		
		$_axFrames[] = $oPGFrameset->buildFrameStructure(
			array(
				'sSize' => $_iFramesetFrameMenuSize.'px', 
				'sContent' => $_sFramesetFrameMenu, 
				// 'iMode' => PG_FRAMESET_FRAMES_MODE_TABBED,
				'iMode' => PG_FRAMESET_FRAMES_MODE_NONE,
				'iScrollMode' => PG_FRAME_MODE_SCROLLBAR, 
				'iBehavior' => PG_FRAMESET_FRAMES_BEHAVIOR_STATIC, 
				'iOverlayZIndex' => NULL
			)
		);
		
		$_axFrames[] = $oPGFrameset->buildFrameStructure(
			array(
				'sSize' => $_iFramesetFrameMainSize.'px', 
				'sContent' => $_sFramesetFrameMain, 
				// 'iMode' => PG_FRAMESET_FRAMES_MODE_TABBED,
				'iMode' => PG_FRAMESET_FRAMES_MODE_NONE,
				'iScrollMode' => PG_FRAME_MODE_SCROLLBAR, 
				'iBehavior' => PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC, 
				'iOverlayZIndex' => NULL
			)
		);
		
		$_sSubFrameset = $oPGFrameset->build(
			array(
				'sFramesetID' => $_sDocumentationID.'SubFrameset', 
				'sSizeX' => $_iFramesetWidth.'px', 
				'sSizeY' => $_iFramesetHeight.'px', 
				'bResizeWithContainer' => true, 
				'axFrames' => $_axFrames, 
				'iFramesetType' => PG_FRAMESET_FRAMES_TYPE_COLS, 
				'iBorderSize' => 5,
				'sCssStyleFrame' => NULL,
				'sCssStyleBorder' => NULL,
				'sCssClassFrame' => $_sCssClassFrame, 
				'sCssClassBorder' => $_sCssClassBorder
			)
		);
		
		$_axFrames = array();
		
		$_axFrames[] = $oPGFrameset->buildFrameStructure(
			array(
				'sSize' => $_iFramesetFrameInfoBarSize.'px', 
				'sContent' => $_sFramesetFrameInfoBar, 
				'iMode' => PG_FRAMESET_FRAMES_MODE_NONE,
				'iScrollMode' => PG_FRAME_MODE_NONE, 
				'iBehavior' => PG_FRAMESET_FRAMES_BEHAVIOR_STRICT, 
				'iOverlayZIndex' => NULL
			)
		);
		
		$_axFrames[] = $oPGFrameset->buildFrameStructure(
			array(
				'sSize' => ($_iFramesetHeight-$_iFramesetFrameInfoBarSize).'px', 
				'sContent' => $_sSubFrameset, 
				'iMode' => PG_FRAMESET_FRAMES_MODE_NONE,
				'iScrollMode' => PG_FRAME_MODE_NONE, 
				'iBehavior' => PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC, 
				'iOverlayZIndex' => NULL
			)
		);
		
		$_sHtml .= $oPGFrameset->build(
			array(
				'sFramesetID' => $_sDocumentationID.'MainFrameset', 
				'sSizeX' => $_iFramesetWidth.'px', 
				'sSizeY' => $_iFramesetHeight.'px', 
				'bResizeWithContainer' => true, 
				'axFrames' => $_axFrames, 
				'iFramesetType' => PG_FRAMESET_FRAMES_TYPE_ROWS, 
				'iBorderSize' => 5,
				'sCssStyleFrame' => NULL,
				'sCssStyleBorder' => NULL,
				'sCssClassFrame' => $_sCssClassFrame, 
				'sCssClassBorder' => $_sCssClassBorder
			)
		);
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	@param sDocumentationID
	@param sProgrammingLanguage
	@param sPath
	*/
	public function build($_sDocumentationID = NULL, $_sProgrammingLanguage = NULL, $_sPath = NULL)
	{
		global $oPGPopup;

		$_sProgrammingLanguage = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sProgrammingLanguage', 'xParameter' => $_sProgrammingLanguage));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$_sDocumentationID = $this->getRealParameter(array('oParameters' => $_sDocumentationID, 'sName' => 'sDocumentationID', 'xParameter' => $_sDocumentationID));
		
		$_sHtml = '';
		$_sHtml .= $this->buildBodyContent(array('sDocumentationID' => $_sDocumentationID, 'sProgrammingLanguage' => $_sProgrammingLanguage, 'sPath' => $_sPath));
		
		$_sHtml .= $oPGPopup->build(
			array(
				'sPopupID' => $_sDocumentationID.'Popup', 
				'sContent' => NULL,
				'iWidth' => 420, 
				'iHeight' => 520, 
				'iZIndex' => 999999,
				'iOverlayAlpha' => 50, 
				'iOverlayAlphaSpeedTimeout' => NULL, 
				'sCssStyle' => 'background-color:#FFFFFF; padding:10px;', 
				'sCssClass' => NULL
			)
		);
		
		return $_sHtml;
	}
	/* @end method */
	
	public function parseClass($_sPath, $_sFile = NULL, $_sClass = NULL, $_sLanguage = NULL)
	{
		global $oPGDocuParser;
		
		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sClass = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		$oPGDocuParser->parseFile(array('sPath' => $_sPath, 'sFile' => $_sFile));
		return $oPGDocuParser->getClass(array('sClass' => $_sClass, 'sLanguage' => $_sLanguage));
	}
	
	public function parseMethod($_sPath, $_sFile = NULL, $_sClass = NULL, $_sMethod = NULL, $_sLanguage = NULL)
	{
		global $oPGDocuParser;

		$_sFile = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sClass = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$_sMethod = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sMethod', 'xParameter' => $_sMethod));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		$oPGDocuParser->parseFile(array('sPath' => $_sPath, 'sFile' => $_sFile));
		return $oPGDocuParser->getMethod(array('sClass' => $_sClass, 'sMethod' => $_sMethod, 'sLanguage' => $_sLanguage));
	}
	
	public function setNetworkMainData($_sPath, $_sSubPathClassFiles = NULL, $_sSubPathManualFiles = NULL, $_sLanguage = NULL)
	{
		global $oPGTemplate, $_POST;
		
		$_sSubPathClassFiles = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sSubPathClassFiles', 'xParameter' => $_sSubPathClassFiles));
		$_sSubPathManualFiles = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sSubPathManualFiles', 'xParameter' => $_sSubPathManualFiles));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		
		if ($_sSubPathClassFiles === NULL) {$_sSubPathClassFiles = '';}
		if ($_sSubPathManualFiles === NULL) {$_sSubPathManualFiles = '';}
		if ($_sLanguage === NULL) {$_sLanguage = 'en';}
		
		$_sLanguage = strtolower($_sLanguage);

		$_sHtml = '';
		$_iDetailed = 1;
		$_bUseHtmlFiles = false;
		
		if (isset($_POST['iDetailed'])) {$_iDetailed = $_POST['iDetailed'];}
		if ((isset($_POST['iMethodID'])) || ((isset($_POST['sMethod'])) && (isset($_POST['sClass'])) && (isset($_POST['sFile']))))
		{
			$_axMethod = NULL;
			if ($this->isDatabase())
			{
				if (isset($_POST['iMethodID'])) {if ($_POST['iMethodID'] > 0) {$_axMethod = $this->loadMethod(array('iMethodID' => $_POST['iMethodID']));}}
			}
			
			if (($_axMethod === NULL) && (isset($_POST['sMethod'])) && (isset($_POST['sClass'])) && (isset($_POST['sFile'])))
			{
				$_axMethod = $this->parseMethod(array('sPath' => $_sPath.$_sSubPathClassFiles, 'sFile' => $_POST['sFile'], 'sClass' => $_POST['sClass'], 'sMethod' => $_POST['sMethod'], 'sLanguage' => $_sLanguage));
			}
			
			$_sHtml .= $this->buildMethod(array('axMethod' => $_axMethod, 'xDetailed' => $_iDetailed, 'bUseHtmlFiles' => $_bUseHtmlFiles));
		}
		else if ((isset($_POST['iClassID'])) || ((isset($_POST['sClass'])) && (isset($_POST['sFile']))))
		{
			$_axClass = NULL;
			if ($this->isDatabase())
			{
				if (isset($_POST['iClassID'])) {if ($_POST['iClassID'] > 0) {$_axClass = $this->loadClass(array('iClassID' => $_POST['iClassID']));}}
			}
			
			if (($_axClass === NULL) && (isset($_POST['sClass'])) && (isset($_POST['sFile'])))
			{
				$_axClass = $this->parseClass(array('sPath' => $_sPath.$_sSubPathClassFiles, 'sFile' => $_POST['sFile'], 'sClass' => $_POST['sClass'], 'sLanguage' => $_sLanguage));
			}
			$_sHtml .= $this->buildClass(array('axClass' => $_axClass, 'xDetailed' => $_iDetailed, 'bUseHtmlFiles' => $_bUseHtmlFiles));
		}
		else if (isset($_POST['sFile']))
		{
			$_sCompletePath = $_sPath.$_sSubPathManualFiles.$_sLanguage.'_'.$_POST['sFile'];
			if (!file_exists($_sCompletePath)) {$_sCompletePath = $_sPath.$_sSubPathManualFiles.'en_'.$_POST['sFile'];}
			if (!file_exists($_sCompletePath)) {$_sCompletePath = $_sPath.$_sSubPathManualFiles.$_POST['sFile'];}
			$_sHtml .= $oPGTemplate->build(array('xTemplate' => $_sCompletePath));
		}
		
		// Debug...
		// $_sHtml = $_sPath."<br />\n".$_POST['sFile']."<br />\n".$_POST['sClass']."<br />\n".$_POST['sMethod']."<br />\n".$_sHtml;
		
		$this->addNetworkData(array('sName' => 'PG_DocuContentHtml', 'xValue' => $_sHtml));
	}
}
/* @end class */
$oPGDocumentation = new classPG_Documentation();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDocumentation', 'xValue' => $oPGDocumentation));}
?>