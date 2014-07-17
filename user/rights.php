<?php
/*
* ProGade API
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* Last changes of this file: Dec 11 2012
*/

define('PG_RIGHTS_TYPE_DEFAULT', 'default');
define('PG_RIGHTS_TYPE_BOOL', 'bool');

define('PG_RIGHT_STATUS_NONE', '');
define('PG_RIGHT_STATUS_DISALLOWED', 'disallowed');
define('PG_RIGHT_STATUS_ALLOWED', 'allowed');
define('PG_RIGHT_STATUS_INHERIT', 'inherit');
define('PG_RIGHT_STATUS_FORBIDDEN', 'forbidden');

/*
@start class

@var RightStatus
PG_RIGHT_STATUS_NONE
PG_RIGHT_STATUS_DISALLOWED
PG_RIGHT_STATUS_ALLOWED
PG_RIGHT_STATUS_INHERIT
PG_RIGHT_STATUS_FORBIDDEN

@description
[en]This class has methods to the manage and check user and group permissions.[/en]
[de]Diese Klasse beinhaltet Methoden zum verwalten und prüfen von Benutzer- und Gruppenrechten.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Rights extends classPG_ClassBasics
{
	// Declarations...	
	private $sUserRightsTable = 'user_rights';
	private $sUserRightsIDName = 'UserID';
	
	private $sUserGroupRightsTable = 'usergroup_rights';
	private $sUserGroupRightsIDName = 'UserGroupID';
	
	private $axRights = array();

	// Construct...
	public function __construct()
	{
		$this->initDatabase();
	}
	
	// Methods...
	/*
	@start method
	
	@group Database
	
	@description
	[en]Sets the table of the database in which to store and read user rights.[/en]
	[de]Setzt die Tabelle der Datenbank in der die Benutzer-Rechte gespeichert und ausgelesen werden sollen.[/de]
	
	@param sTable [needed][type]string[/type]
	[en]The table name for the rights.[/en]
	[de]Der Tabellenname für die Rechte.[/de]
	*/
	public function setUserRightsTable($_sTable) {$this->sUserRightsTable = $_sTable;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Returns the table name in which to store and read user rights.[/en]
	[de]Gibt den Tabellennamen zurück, in dem die Benutzer-Rechte gespeichert und ausgelesen werden.[/de]
	
	@return sTable [type]string[/type]
	[en]Returns the table name in which to store and read user rights.[/en]
	[de]Gibt den Tabellennamen zurück, in dem die Benutzer-Rechte gespeichert und ausgelesen werden.[/de]
	*/
	public function getUserRightsTable() {return $this->sUserRightsTable;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Sets the name for the column to be used as the ID for the user rights.[/en]
	[de]Setzt den Namen für die Spalte die als ID für die Benutzer-Rechte verwendet werden soll.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name for the column of the ID.[/en]
	[de]Der Name für die Spalte der ID.[/de]
	*/
	public function setUserRightsIDName($_sName) {$this->sUserRightsIDName = $_sName;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Returns the name for the column to be used as the ID for the user rights.[/en]
	[de]Gibt den Namen für die Spalte die als IF für die Benutzer-Rechte verwendet werden soll zurück.[/de]
	
	@return sIDName [type]string[/type]
	[en]Returns the name for the column to be used as the ID for the user rights as a string.[/en]
	[de]Gibt den Namen für die Spalte die als IF für die Benutzer-Rechte verwendet werden soll als String zurück.[/de]
	*/
	public function getUserRightsIDName() {return $this->sUserRightsIDName;}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@description
	[en]Sets the table of the database in which to store and read usergroup rights.[/en]
	[de]Setzt die Tabelle der Datenbank in der die Benutzergruppen-Rechte gespeichert und ausgelesen werden sollen.[/de]
	
	@param sTable [needed][type]string[/type]
	[en]The table name for the rights.[/en]
	[de]Der Tabellenname für die Rechte.[/de]
	*/
	public function setUserGroupRightsTable($_sTable) {$this->sUserGroupRightsTable = $_sTable;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Returns the table name in which to store and read usergroup rights.[/en]
	[de]Gibt den Tabellennamen zurück, in dem die Benutzergruppen-Rechte gespeichert und ausgelesen werden.[/de]
	
	@return sTable [type]string[/type]
	[en]Returns the table name in which to store and read usergroup rights.[/en]
	[de]Gibt den Tabellennamen zurück, in dem die Benutzergruppen-Rechte gespeichert und ausgelesen werden.[/de]
	*/
	public function getUserGroupRightsTable() {return $this->sUserGroupRightsTable;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Sets the name for the column to be used as the ID for the usergroup rights.[/en]
	[de]Setzt den Namen für die Spalte die als ID für die Benutzergruppen-Rechte verwendet werden soll.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name for the column of the ID.[/en]
	[de]Der Name für die Spalte der ID.[/de]
	*/
	public function setUserGroupRightsIDName($_sName) {$this->sUserGroupRightsIDName = $_sName;}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Returns the name for the column to be used as the ID for the usergroup rights.[/en]
	[de]Gibt den Namen für die Spalte die als IF für die Benutzergruppen-Rechte verwendet werden soll zurück.[/de]
	
	@return sIDName [type]string[/type]
	[en]Returns the name for the column to be used as the ID for the usergroup rights as a string.[/en]
	[de]Gibt den Namen für die Spalte die als IF für die Benutzergruppen-Rechte verwendet werden soll als String zurück.[/de]
	*/
	public function getUserGroupRightsIDName() {return $this->sUserGroupRightsIDName;}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@description
	[en]Builds the update and installation structure for the tables of the database and returns it.[/en]
	[de]Erstellt die Update- und Installationsstruktur für die Tabellen der Datenbank und gibt es zurück.[/de]
	
	@return axDBChunkStructure [type]mixed[][/type]
	[en]Returns the update structure as a mixed array.[/en]
	[de]Gibt die Updatestruktur als Mixed-Array zurück.[/de]
	
	@param oDatabaseUpdate [needed][type]object[/type]
	[en]The database update object, the update structure is to be expanded.[/en]
	[de]Das Datenbank-Update-Objekt, dessen Updatestruktur erweitert werden soll.[/de]
	*/
	public function buildDatabaseUpdate($_oDatabaseUpdate)
	{
		$_oDatabaseUpdate = $this->getRealParameter(array('oParameters' => $_oDatabaseUpdate, 'sName' => 'oDatabaseUpdate', 'xParameter' => $_oDatabaseUpdate));
		
		$_axDBChunkStructures = $_oDatabaseUpdate->getDBChunkStructures();
		$_axTablesStructure = array();
		
		// userrights...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => $this->sUserRightsIDName, 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'RightName', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'RightStatus', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().$this->sUserRightsTable, 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL,	'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// usergrouprights...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => $this->sUserGroupRightsIDName, 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'RightName', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'RightStatus', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UpdateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().$this->sUserGroupRightsTable, 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL,	'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		return $_oDatabaseUpdate->buildDBChunkStructure(array('sDBChunk' => 'Rights', 'axDBChunkStructures' => $_axDBChunkStructures, 'axTablesStructure' => $_axTablesStructure));
	}
	/* @end method */

	/*
	@start method
	
	@group Database
	
	@description
	[en]Builds the update and installation for the tables in the database and returns the update object.[/en]
	[de]Erstellt das Update und Installation für die Tabellen der Datenbank und gibt das Update-Objekt zurück.[/de]
	
	@return oUpdate [type]object[/type]
	[en]Returns the updated object, which was expanded by the tables of the rights system.[/en]
	[de]Gibt das Update-Objekt zurück, welches um die Tabellen des Rechtesystems erweitert wurde.[/de]
	
	@param oUpdate [needed][type]object[/type]
	[en]Update object, which should be expanded.[/en]
	[de]Das Update-Objekt, welches erweitert werden soll.[/de]
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
	
	@group Get
	
	@description
	[en]Returns the status of a right from the memory.[/en]
	[de]Gibt den Status für ein Recht aus dem Zwischenspeicher zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the status of a right from the memory as a string.[/en]
	[de]Gibt den Status für ein Recht aus dem Zwischenspeicher als String zurück.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function getRight($_sRightName)
	{
		$_sRightName = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		if (isset($this->axRights[$_sRightName])) {return $this->axRights[$_sRightName];}
		return PG_RIGHT_STATUS_NONE;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads all rights with a particular prefix at the beginning of the name.[/en]
	[de]L�dt alle Rechte mit einem bestimmten Prefix am Anfang des Namens.[/de]
	
	@return asRightsStatus [type]mixed[][/type]
	[en]Returns all rights with a particular prefix at the beginnig of the name as an string array.[/en]
	[de]Gibt alle Rechte mit einem bestimmten Prefix am Anfang des Namens als String-Array zurück.[/de]
	
	@param sTable [type]string[/type]
	[en]The name of the rights table.[/en]
	[de]Der Name der Rechtetabelle.[/de]
	
	@param sIDName [type]string[/type]
	[en]The name of the ID column.[/en]
	[de]Der Name der ID Spalte.[/de]
	
	@param iIDValue [type]int[/type]
	[en]The value of the ID.[/en]
	[de]Der Wert der ID.[/de]
	
	@param sRightNamePrefix [type]string[/type]
	[en]A string at the beginning of the rights which should be read.[/en]
	[de]Ein String mit dem die Rechte beginnen, die ausgelesen werden sollen.[/de]
	*/
	public function loadPrefixed($_sTable, $_sIDName = NULL, $_iIDValue = NULL, $_sRightNamePrefix = NULL)
	{
		$_sIDName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDName', 'xParameter' => $_sIDName));
		$_iIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iIDValue', 'xParameter' => $_iIDValue));
		$_sRightNamePrefix = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sRightNamePrefix', 'xParameter' => $_sRightNamePrefix));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sTable === NULL) {$_sTable = $this->sUserRightsTable;}
		if ($_sIDName === NULL) {$_sIDName = $this->sUserRightsIDName;}
		
		$this->checkDatabaseConnection();
		
		$_asRights = array();
		$_asColumns = array('RightStatus', 'RightName');
		$_axWhere = array(
            $_sIDName => $this->realEscapeDatabaseString(array('xString' => $_iIDValue)),
            'RightName' => array('REGEXP' => $this->realEscapeDatabaseString(array('xString' => $_sRightNamePrefix)).'*')
        );

		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().$_sTable, 
					'asColumns' => $_asColumns, 
					'xWhere' => $_axWhere,
					'iStart' => NULL, 
					'iCount' => NULL,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL, 
					'sEngine' => NULL
				)
			)
		)
		{
			while ($_axRight = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
			{
				$_asRights[$_axRight['RightName']] = $_axRight['RightStatus'];
			}
		}
		return $_asRights;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads a right from a rights table.[/en]
	[de]Lädt ein Recht aus einer Rechtetabelle.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of right as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts als String zurück.[/de]
	
	@param sTable [type]string[/type]
	[en]The table in which the right is.[/en]
	[de]Die Tabelle in der das Recht steht.[/de]
	
	@param sIDName [type]string[/type]
	[en]The name of the ID column.[/en]
	[de]Der Name der ID Spalte.[/de]
	
	@param iIDValue [type]int[/type]
	[en]The value of the ID.[/en]
	[de]Der Wert der ID.[/de]
	
	@param sRightName [type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function load($_sTable, $_sIDName = NULL, $_iIDValue = NULL, $_sRightName = NULL)
	{
		$_sIDName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDName', 'xParameter' => $_sIDName));
		$_iIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iIDValue', 'xParameter' => $_iIDValue));
		$_sRightName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sTable === NULL) {$_sTable = $this->sUserRightsTable;}
		if ($_sIDName === NULL) {$_sIDName = $this->sUserRightsIDName;}
		
		$this->checkDatabaseConnection();

		$_axRight = array('RightStatus' => PG_RIGHT_STATUS_NONE);
		$_asColumns = array('RightStatus', 'RightName');
		$_axWhere = array(
            $_sIDName => $this->realEscapeDatabaseString(array('xString' => $_iIDValue)),
            'RightName' => $this->realEscapeDatabaseString(array('xString' => $_sRightName))
        );
		
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().$_sTable, 
					'asColumns' => $_asColumns, 
					'xWhere' => $_axWhere,
					'iStart' => NULL, 
					'iCount' => 1,
					'sOrderBy' => NULL, 
					'bOrderReverse' => NULL, 
					'sEngine' => NULL
				)
			)
		)
		{
			$_axRight = $this->fetchDatabaseArray(array('xResult' => $_oResult));
		}
		return $_axRight['RightStatus'];
	}
	/* @end method */
	
	/*
	@start method
	
	@group Save
	
	@description
	[en]Saves a right.[/en]
	[de]Speichert ein Recht.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the save was successful.[/en]
	[de]Gibt ein Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param sTable [type]string[/type]
	[en]The name of the rights table.[/en]
	[de]Der Name der Rechtetabelle.[/de]
	
	@param sIDName [type]string[/type]
	[en]The name of the ID column.[/en]
	[de]Der Name der ID Spalte.[/de]
	
	@param iIDValue [type]int[/type]
	[en]The value of the ID.[/en]
	[de]Der Wert der ID.[/de]
	
	@param sRightName [type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	
	@param sRightStatus [type]string[/type]
	[en]The rights status of the right.[/en]
	[de]Der Rechtestatus des Rechts.[/de]
	*/
	public function save($_sTable, $_sIDName = NULL, $_iIDValue = NULL, $_sRightName = NULL, $_sRightStatus = NULL)
	{
		$_sIDName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDName', 'xParameter' => $_sIDName));
		$_iIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iIDValue', 'xParameter' => $_iIDValue));
		$_sRightName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_sRightStatus = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sRightStatus', 'xParameter' => $_sRightStatus));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sTable === NULL) {$_sTable = $this->sUserRightsTable;}
		if ($_sIDName === NULL) {$_sIDName = $this->sUserRightsIDName;}
		
		$this->checkDatabaseConnection();
		
		$_axColumnsAndValues = array('RightStatus' => $_sRightStatus);
		$_axColumnsAndValuesOnInsert = array(
			$_sIDName => $this->realEscapeDatabaseString(array('xString' => $_iIDValue)),
			'RightName' => $this->realEscapeDatabaseString(array('xString' => $_sRightName)),
			'CreateTimeStamp' => time()
		);
		$_axColumnsAndValuesOnUpdate = array(
			'UpdateTimeStamp' => time()
		);
		$_axWhere = array('RightName' => $this->realEscapeDatabaseString(array('xString' => $_sRightName)));
		
		if
		(
			$this->saveDataset(
				array(
					'sTable' => $this->getDatabaseTablePrefix().$_sTable, 
					'sIDColumn' => $_sIDName, 
					'xIDValue' => $_iIDValue,
					'axColumnsAndValues' => $_axColumnsAndValues,
					'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
					'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
					'xWhere' => $_axWhere,
					'sEngine' => NULL
				)
			)
		)
		{
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads user rights and group rights of all rights with a particular prefix at the beginning of the name of the rights.[/en]
	[de]Lädt Benutzer- und Gruppenrechte aller Rechte mit einem bestimmten Prefix am Anfang des Rechtenamen.[/de]
	
	@return asRightsStatus [type]mixed[][/type]
	[en]Returns the rights status of the rights as an string array.[/en]
	[de]Gibt den Rechtestatus der Rechte als String-Array zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be loaded.[/en]
	[de]Der Benutzer dessen Rechte geladen werden sollen.[/de]
	
	@param sRightNamePrefix [needed][type]string[/type]
	[en]A string at the beginning of the rights which should be read.[/en]
	[de]Ein String mit dem die Rechte beginnen, die ausgelesen werden sollen.[/de]
	*/
	public function loadRightsPrefixed($_xUser, $_sRightNamePrefix = NULL)
	{
		global $oPGUsers;

		$_sRightNamePrefix = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightNamePrefix', 'xParameter' => $_sRightNamePrefix));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		
		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		
		$this->axRights = $this->loadUserRightsPrefixed(array('xUser' => $_iUserID, 'sRightNamePrefix' => $_sRightNamePrefix));
		$_asUserGroupRight = $this->loadUserGroupsRightsPrefixed(array('xUser' => $_iUserID, 'sRightNamePrefix' => $_sRightNamePrefix));
		
		foreach ($_asUserGroupRight as $_sRightName => $_sUserGroupRight)
		{
			if (!isset($this->axRights[$_sRightName])) {$this->axRights[$_sRightName] = PG_RIGHT_STATUS_NONE;}
		}
		
		foreach ($this->axRights as $_sRightName => $_sUserRight)
		{
			if (!isset($_asUserGroupRight[$_sRightName])) {$_asUserGroupRight[$_sRightName] = PG_RIGHT_STATUS_NONE;}
			$this->axRights[$_sRightName] = $this->getUserRightWithPriority(array('sUserRight' => $_sUserRight, 'sUserGroupRight' => $_asUserGroupRight[$_sRightName]));
		}
		
		return $this->axRights;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads a specific user right and group right of a user.[/en]
	[de]Lädt ein bestimmtes Benutzer- und Gruppenrecht eines Benutzers.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts als String zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be loaded.[/en]
	[de]Der Benutzer dessen Rechte geladen werden sollen.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function loadRight($_xUser, $_sRightName = NULL)
	{
		global $oPGUsers;

		$_sRightName = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));

		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));

		$_sUserRight = $this->loadUserRight(array('xUser' => $_iUserID, 'sRightName' => $_sRightName));
		if ($_sUserRight == PG_RIGHT_STATUS_FORBIDDEN) {return PG_RIGHT_STATUS_FORBIDDEN;}

		$_sUserGroupRight = $this->loadUserGroupsRight(array('xUser' => $_iUserID, 'sRightName' => $_sRightName));
		if ($_sUserGroupRight == PG_RIGHT_STATUS_FORBIDDEN) {return PG_RIGHT_STATUS_FORBIDDEN;}

		$_sUserRight = $this->getUserRightWithPriority(array('sUserRight' => $_sUserRight, 'sUserGroupRight' => $_sUserGroupRight));
		return $_sUserRight;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Loads a specific user right and group right of a user.[/en]
	[de]Lädt ein bestimmtes Benutzer- und Gruppenrecht eines Benutzers.[/de]
	
	@return bHasRight [type]bool[/type]
	[en]Returns true if the user has the right.[/en]
	[de]Gibt true zurück, wenn der Benutzer das Recht hat.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be loaded.[/en]
	[de]Der Benutzer dessen Rechte geladen werden sollen.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function hasRight($_xUser, $_sRightName = NULL)
	{
		$_sRightName = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		$_sRightStatus = $this->loadRight(array('xUser' => $_xUser, 'sRightName' => $_sRightName));
		if ($_sRightStatus == PG_RIGHT_STATUS_ALLOWED) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Checks the priority of the rights status of user and group rights, and returns the rights status with the highest priority.[/en]
	[de]Prüft die Priorität vom Rechtestatus von Benutzer- und Gruppenrechten und gibt den Rechtestatus mit der höchsten Priorität zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right with the highest priority as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts mit der höchsten Proorität als String zurück.[/de]
	
	@param sUserRight [needed][type]string[/type]
	[en]The rights status of the right from a user.[/en]
	[de]Der Rechtestatus des Rechts von einem Benutzer.[/de]
	
	@param sUserGroupRight [needed][type]string[/type]
	[en]The rights status of the right from a user group.[/en]
	[de]Der Rechtestatus des Rechts von einer Benutzergruppe.[/de]
	*/
	public function getUserRightWithPriority($_sUserRight, $_sUserGroupRight = NULL)
	{
		$_sUserGroupRight = $this->getRealParameter(array('oParameters' => $_sUserRight, 'sName' => 'sUserGroupRight', 'xParameter' => $_sUserGroupRight));
		$_sUserRight = $this->getRealParameter(array('oParameters' => $_sUserRight, 'sName' => 'sUserRight', 'xParameter' => $_sUserRight));

		if ($_sUserRight == PG_RIGHT_STATUS_FORBIDDEN) {return PG_RIGHT_STATUS_FORBIDDEN;}
		if ($_sUserGroupRight == PG_RIGHT_STATUS_FORBIDDEN) {return PG_RIGHT_STATUS_FORBIDDEN;}

		if ($_sUserGroupRight != PG_RIGHT_STATUS_NONE)
		{
			if (($_sUserRight == PG_RIGHT_STATUS_INHERIT) || ($_sUserRight == PG_RIGHT_STATUS_NONE))
			{
				$_sUserRight = $_sUserGroupRight;
			}
		}
		return $_sUserRight;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads group rights of all rights with a particular prefix at the beginning of the name of the rights for a user.[/en]
	[de]Lädt Gruppenrechte aller Rechte, mit einem bestimmten Prefix am Anfang des Rechtenamen, für einen Benutzer.[/de]
	
	@return asRightsStatus [type]string[][/type]
	[en]Returns the rights status of the rights as an string array.[/en]
	[de]Gibt den Rechtestatus der Rechte als String-Array zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be loaded.[/en]
	[de]Der Benutzer dessen Rechte geladen werden sollen.[/de]
	
	@param sRightNamePrefix [needed][type]string[/type]
	[en]A string at the beginning of the rights which should be read.[/en]
	[de]Ein String mit dem die Rechte beginnen, die ausgelesen werden sollen.[/de]
	*/
	public function loadUserGroupsRightsPrefixed($_xUser, $_sRightNamePrefix = NULL)
	{
		global $oPGUsers;

		$_sRightNamePrefix = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightNamePrefix', 'xParameter' => $_sRightNamePrefix));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		
		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		
		$_asUserGroupRights = array();
		$_axUserGroupIDs = $oPGUsers->loadUserGroupIDs(array('xUser' => $_iUserID));
		for ($i=0; $i<count($_axUserGroupIDs); $i++)
		{
			$_asUserGroupRights2 = $this->loadUserGroupRightsPrefixed(array('iUserGroupID' => $_axUserGroupIDs[$i], 'sRightNamePrefix' => $_sRightNamePrefix));
			foreach($_asUserGroupRights2 as $_sRightName => $_sUserGroupRight2)
			{
				if (!isset($_asUserGroupRights[$_sRightName])) {$_asUserGroupRights[$_sRightName] = PG_RIGHT_STATUS_NONE;}
				$_asUserGroupRights[$_sRightName] = $this->getUserGroupRightWithPriority(array('sRight' => $_asUserGroupRights[$_sRightName], 'sRight2' => $_sUserGroupRight2));
			}
		}
		return $_asUserGroupRights;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads the rights status of all user groups of a user and returns the rights status with the highest priority.[/en]
	[de]Lädt den Rechtestatus aller Benutzergruppen eines Benutzers und gibt den Rechtestatus mit der höchsten Priorität zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts als String zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose right should be loaded.[/en]
	[de]Der Benutzer dessen Recht geladen werden soll.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function loadUserGroupsRight($_xUser, $_sRightName = NULL)
	{
		global $oPGUsers;

		$_sRightName = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		
		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		
		$_sUserGroupRight = PG_RIGHT_STATUS_NONE;
		$_axUserGroupIDs = $oPGUsers->loadUserGroupIDs(array('xUser' => $_iUserID));

		for ($i=0; $i<count($_axUserGroupIDs); $i++)
		{
			$_sUserGroupRight2 = $this->loadUserGroupRight(array('iUserGroupID' => $_axUserGroupIDs[$i], 'sRightName' => $_sRightName));
			$_sUserGroupRight = $this->getUserGroupRightWithPriority(array('sRight' => $_sUserGroupRight, 'sRight2' => $_sUserGroupRight2));
		}
		return $_sUserGroupRight;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Checks the priority of the rights status of group rights, and returns the rights status with the highest priority.[/en]
	[de]Prüft die Priorität vom Rechtestatus von Gruppenrechten und gibt den Rechtestatus mit der höchsten Priorität zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right with the highest priority as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts mit der höchsten Proorität als String zurück.[/de]
	
	@param sRight [needed][type]string[/type]
	[en]The rights status of a right from a group.[/en]
	[de]Der Rechtestatus eines Rechts von einer Gruppe.[/de]
	
	@param sRight2 [needed][type]string[/type]
	[en]The rights status of a right from a group.[/en]
	[de]Der Rechtestatus eines Rechts von einer Gruppe.[/de]
	*/
	public function getUserGroupRightWithPriority($_sRight, $_sRight2 = NULL)
	{
		$_sRight2 = $this->getRealParameter(array('oParameters' => $_sRight, 'sName' => 'sRight2', 'xParameter' => $_sRight2));
		$_sRight = $this->getRealParameter(array('oParameters' => $_sRight, 'sName' => 'sRight', 'xParameter' => $_sRight));
		
		if ($_sRight2 == PG_RIGHT_STATUS_FORBIDDEN) {return PG_RIGHT_STATUS_FORBIDDEN;}
		if (($_sRight2 == PG_RIGHT_STATUS_ALLOWED)
		|| ($_sRight == PG_RIGHT_STATUS_INHERIT)
		|| ($_sRight == PG_RIGHT_STATUS_NONE))
		{
			$_sRight = $_sRight2;
		}
		return $_sRight;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads all user rights that have a specific prefix at the beginning of the name of the right.[/en]
	[de]Lädt alle Rechte eines Benutzers, die einen bestimmten Prefix am Anfang des Rechtenamens haben.[/de]
	
	@return asRightsStatus [type]string[][/type]
	[en]Returns the rights status of the rights as an string array.[/en]
	[de]Gibt den Rechtestatus der Rechte als String-Array zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be loaded.[/en]
	[de]Der Benutzer dessen Rechte geladen werden sollen.[/de]
	
	@param sRightNamePrefix [needed][type]string[/type]
	[en]A string at the beginning of the rights which should be read.[/en]
	[de]Ein String mit dem die Rechte beginnen, die ausgelesen werden sollen.[/de]
	*/
	public function loadUserRightsPrefixed($_xUser, $_sRightNamePrefix = NULL)
	{
		global $oPGUsers;

		$_sRightNamePrefix = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightNamePrefix', 'xParameter' => $_sRightNamePrefix));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		
		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		return $this->loadPrefixed(array('sTable' => $this->sUserRightsTable, 'sIDName' => $this->sUserRightsIDName, 'iIDValue' => $_iUserID, 'sRightNamePrefix' => $_sRightNamePrefix));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads a right with a specific name of the right for a user and returns it.[/en]
	[de]Lädt ein Recht mit einem bestimmten Rechtenamen für einen Benutzer und gibt es zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts als String zurück.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose right should be loaded.[/en]
	[de]Der Benutzer dessen Recht geladen werden sollen.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function loadUserRight($_xUser, $_sRightName = NULL)
	{
		global $oPGUsers;

		$_sRightName = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));

		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		return $this->load(array('sTable' => $this->sUserRightsTable, 'sIDName' => $this->sUserRightsIDName, 'iIDValue' => $_iUserID, 'sRightName' => $_sRightName));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Save
	
	@description
	[en]Saves a right for a user.[/en]
	[de]Speichert ein Recht für einen Benutzer.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the save was successful.[/en]
	[de]Gibt ein Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user whose rights should be saved.[/en]
	[de]Der Benutzer dessen Rechte gespeichert werden sollen.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	
	@param sRightStatus [needed][type]string[/type]
	[en]The rights status of the right.[/en]
	[de]Der Rechtestatus des Rechts.[/de]
	*/
	public function saveUserRight($_xUser, $_sRightName = NULL, $_sRightStatus = NULL)
	{
		global $oPGUsers;

		$_sRightName = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_sRightStatus = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'sRightStatus', 'xParameter' => $_sRightStatus));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));
		
		$_iUserID = $oPGUsers->loadUserID(array('xUser' => $_xUser));
		return $this->save(array('sTable' => $this->sUserRightsTable, 'sIDName' => $this->sUserRightsIDName, 'iIDValue' => $_iUserID, 'sRightName' => $_sRightName, 'sRightStatus' => $_sRightStatus));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads all user group rights that have a specific prefix at the beginning of the name of the right.[/en]
	[de]Lädt alle Rechte einer Benutzergruppe, die einen bestimmten Prefix am Anfang des Rechtenamens haben.[/de]
	
	@return asRightsStatus [type]string[][/type]
	[en]Returns the rights status of the rights as an string array.[/en]
	[de]Gibt den Rechtestatus der Rechte als String-Array zurück.[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]The ID of the user group.[/en]
	[de]Die ID der Benutzergruppe.[/de]
	
	@param sRightNamePrefix [needed][type]string[/type]
	[en]A string at the beginning of the rights which should be read.[/en]
	[de]Ein String mit dem die Rechte beginnen, die ausgelesen werden sollen.[/de]
	*/
	public function loadUserGroupRightsPrefixed($_iUserGroupID, $_sRightNamePrefix = NULL)
	{
		$_sRightNamePrefix = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sRightNamePrefix', 'xParameter' => $_sRightNamePrefix));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		return $this->loadPrefixed(array('sTable' => $this->sUserGroupRightsTable, 'sIDName' => $this->sUserGroupRightsIDName, 'iIDValue' => $_iUserGroupID, 'sRightNamePrefix' => $_sRightNamePrefix));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads a right with a specific name of the right for a user group and returns it.[/en]
	[de]Lädt ein Recht mit einem bestimmten Rechtenamen für eine Benutzergruppe und gibt es zurück.[/de]
	
	@return sRightStatus [type]string[/type]
	[en]Returns the rights status of the right as a string.[/en]
	[de]Gibt den Rechtestatus des Rechts als String zurück.[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]The ID of the user group.[/en]
	[de]Die ID der Benutzergruppe.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	*/
	public function loadUserGroupRight($_iUserGroupID, $_sRightName = NULL)
	{
		$_sRightName = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		return $this->load(array('sTable' => $this->sUserGroupRightsTable, 'sIDName' => $this->sUserGroupRightsIDName, 'iIDValue' => $_iUserGroupID, 'sRightName' => $_sRightName));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Save
	
	@description
	[en]Saves a right for a user group.[/en]
	[de]Speichert ein Recht für eine Benutzergruppe.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns a boolean whether the save was successful.[/en]
	[de]Gibt ein Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]The ID of the user group.[/en]
	[de]Die ID der Benutzergruppe.[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]The name of the right.[/en]
	[de]Der Name des Rechts.[/de]
	
	@param sRightStatus [needed][type]string[/type]
	[en]The rights status of the right.[/en]
	[de]Der Rechtestatus des Rechts.[/de]
	*/
	public function saveUserGroupRight($_iUserGroupID, $_sRightName = NULL, $_sRightStatus = NULL)
	{
		$_sRightName = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		$_sRightStatus = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sRightStatus', 'xParameter' => $_sRightStatus));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		return $this->save(
			array(
				'sTable' => $this->sUserGroupRightsTable, 
				'sIDName' => $this->sUserGroupRightsIDName, 
				'iIDValue' => $_iUserGroupID, 
				'sRightName' => $_sRightName, 
				'sRightStatus' => $_sRightStatus
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return axRight [type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sRightName [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sIcon [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sDisplayName [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sType [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sDefaultStatus [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildRight($_sRightName, $_sIcon = NULL, $_sDisplayName = NULL, $_sType = NULL, $_sDefaultStatus = NULL)
	{
		$_sIcon = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sIcon', 'xParameter' => $_sIcon));
		$_sDisplayName = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sDisplayName', 'xParameter' => $_sDisplayName));
		$_sType = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_sDefaultStatus = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sDefaultStatus', 'xParameter' => $_sDefaultStatus));
		$_sRightName = $this->getRealParameter(array('oParameters' => $_sRightName, 'sName' => 'sRightName', 'xParameter' => $_sRightName));
		
		if ($_sIcon === NULL) {$_sIcon = '';}
		if ($_sDisplayName === NULL) {$_sDisplayName = $_sRightName;}
		if ($_sType === NULL) {$_sType = PG_RIGHTS_TYPE_DEFAULT;}
		if ($_sDefaultStatus === NULL) {$_sDefaultStatus = PG_RIGHT_STATUS_INHERIT;}
		
		return array('sRightName' => $_sRightName, 'sIcon' => $_sIcon, 'sDisplayName' => $_sDisplayName, 'sType' => $_sType, 'sDefaultStatus' => $_sDefaultStatus);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return axRightsGroup [type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRights [needed][type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sIcon [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildRightsGroup($_sName, $_axRights = NULL, $_sIcon = NULL)
	{
		$_axRights = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'axRights', 'xParameter' => $_axRights));
		$_sIcon = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sIcon', 'xParameter' => $_sIcon));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		
		if ($_sIcon === NULL) {$_sIcon = '';}
		// if ($_sDisplayName === NULL) {$_sDisplayName = $_sRightName;}
	
		return array('sName' => $_sName, 'axRights' => $_axRights, 'sIcon' => $_sIcon);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return sFormInputsHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRightsGroups [type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildRightsFormInputs($_iUserGroupID = NULL, $_iUserID = NULL, $_axRightsGroups = NULL)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		$_axRightsGroups = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'axRightsGroups', 'xParameter' => $_axRightsGroups));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		$_sHtml = '';
		$_sHtml .= '<table>';
		
		$_iFullRightsIndex = 0;
		
		for ($_iRightsGroupIndex=0; $_iRightsGroupIndex<count($_axRightsGroups); $_iRightsGroupIndex++)
		{
			$_axRights = $_axRightsGroups[$_iRightsGroupIndex]['axRights'];
			$_sHtml .= '<tr>';
				$_sHtml .= '<td>';
					if ($_axRightsGroups[$_iRightsGroupIndex]['sIcon'] != '') {$_sHtml .= $this->img(array('sImage' => $_axRightsGroups[$_iRightsGroupIndex]['sIcon']));}
				$_sHtml .= '</td>';
				$_sHtml .= '<td colspan="5"><h2>'.$_axRightsGroups[$_iRightsGroupIndex]['sName'].'</h2></td>';
			$_sHtml .= '</tr>';
			for ($_iRightsIndex=0; $_iRightsIndex<count($_axRights); $_iRightsIndex++)
			{
				$_sRightStatus = PG_RIGHT_STATUS_NONE;
				if (!empty($_iUserGroupID)) {$_sRightStatus = $this->loadUserGroupRight(array('iUserGroupID' => $_iUserGroupID, 'sRightName' => $_axRights[$_iRightsIndex]['sRightName']));}
				else if (!empty($_iUserID)) {$_sRightStatus = $this->loadUserRight(array('iUserID' => $_iUserID, 'sRightName' => $_axRights[$_iRightsIndex]['sRightName']));}
				if ($_sRightStatus == PG_RIGHT_STATUS_NONE) {$_sRightStatus = $_axRights[$_iRightsIndex]['sDefaultStatus'];}
				
				$_sHtml .= '<tr>';
					$_sHtml .= '<td>';
						if ($_axRights[$_iRightsIndex]['sIcon'] != '') {$_sHtml .= $this->img(array('sImage' => $_axRights[$_iRightsIndex]['sIcon']));}
						$_sHtml .= '<input type="hidden" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][0]" value="'.$_axRights[$_iRightsIndex]['sRightName'].'">';
					$_sHtml .= '</td>';
					$_sHtml .= '<td>'.$_axRights[$_iRightsIndex]['sDisplayName'].'</td>';
					switch($_axRights[$_iRightsIndex]['sType'])
					{
                        /*case PG_RIGHTS_TYPE_SINGLE:
                            $_sHtml .= '<td>&nbsp;</td>';
                        break;*/

						case PG_RIGHTS_TYPE_BOOL:
							$_sHtml .= '<td>&nbsp;</td>';
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_ALLOWED) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_ALLOWED.'" /> zulassen';
							$_sHtml .= '</td>';
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_DISALLOWED) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_DISALLOWED.'" /> verweigern';
							$_sHtml .= '</td>';
							$_sHtml .= '<td>&nbsp;</td>';
						break;
						
						case PG_RIGHTS_TYPE_DEFAULT:
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_INHERIT) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_INHERIT.'" /> erben';
							$_sHtml .= '</td>';
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_ALLOWED) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_ALLOWED.'" /> zulassen';
							$_sHtml .= '</td>';
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_DISALLOWED) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_DISALLOWED.'" /> verweigern';
							$_sHtml .= '</td>';
							$_sHtml .= '<td style="white-space:nowrap;">';
								$_sHtml .= '<input type="radio" name="as'.$this->getID().'Right['.$_iFullRightsIndex.'][1]" ';
								if ($_sRightStatus == PG_RIGHT_STATUS_FORBIDDEN) {$_sHtml .= 'checked ';}
								$_sHtml .= 'value="'.PG_RIGHT_STATUS_FORBIDDEN.'" /> verbieten';
							$_sHtml .= '</td>';
						break;
					}
				$_sHtml .= '</tr>';
				$_iFullRightsIndex++;
			}
		}
		
		$_sHtml .= '</table>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return sResultHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRights [type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildUserGroupRightsSave($_iUserGroupID, $_axRights = NULL)
	{
		$_axRights = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'axRights', 'xParameter' => $_axRights));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));

		$_sHtml = '';
		$_bAllOK = true;
		
		if ($_iUserGroupID === NULL) {$_iUserGroupID = 0;}
		if ($_axRights === NULL) {$_axRights = $_POST['as'.$this->getID().'Right'];}
		
		if (isset($_POST['s'.$this->getID().'Name']))
		{
			global $oPGUserGroups;
			$_iUserGroupID = $oPGUserGroups->saveUserGroup(array('iUserGroupID' => $_iUserGroupID, 'sName' => $_POST['s'.$this->getID().'Name']));
		}
		
		if ($_iUserGroupID > 0)
		{
			for ($_iRightsIndex=0; $_iRightsIndex<count($_axRights); $_iRightsIndex++)
			{
				if (
					!$this->saveUserGroupRight(
						array(
							'iUserGroupID' => $_iUserGroupID, 
							'sRightName' => $_axRights[$_iRightsIndex][0], 
							'sRightStatus' => $_axRights[$_iRightsIndex][1],
						)
					)
				)
				{
					$_bAllOK = false;
				}
			}
		}
		else {$_bAllOK = false;}
		
		if ($_bAllOK == true) {$_sHtml .= '<div class="success">['.date('H:i:s').'] Alle Rechte wurden erfolgreich gespeichert.</div>';}
		else {$_sHtml .= '<div class="failure">['.date('H:i:s').'] Es konnten nicht alle Rechte gespeichert werden!</div>';}
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return sFormHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRightsGroups [needed][type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildUserGroupRightsForm($_iUserGroupID, $_axRightsGroups = NULL)
	{
		global $oPGUserGroups;
	
		$_axRightsGroups = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'axRightsGroups', 'xParameter' => $_axRightsGroups));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		$_sHtml = '';
		$_sHtml .= '<form action="'.$this->getUrl().'" method="post" target="'.$this->getUrlTarget().'">';
			$_sHtml .= '<input type="hidden" name="iUserGroupID" value="'.$_iUserGroupID.'" />';
			$_sHtml .= $this->getUrlParametersForm(array('bUseLineBreak' => true));
			
			$_axUserGroup = array();
			$_axUserGroup['Name'] = '';
			
			if ($_iUserGroupID > 0)
			{
				$_axUserGroup = $oPGUserGroups->loadUserGroup(array('iUserGroupID' => $_iUserGroupID));
			}
			
			$_sHtml .= '<table>';
			$_sHtml .= '<tr>';
				$_sHtml .= '<td>Name</td>';
				$_sHtml .= '<td><input type="text" name="s'.$this->getID().'Name" value="'.$_axUserGroup['Name'].'" maxlength="255" style="width:200px;" /></td>';
			$_sHtml .= '</tr>';
			$_sHtml .= '</table>';
			$_sHtml .= '<br /><br />';
			$_sHtml .= $this->buildRightsFormInputs(array('iUserGroupID' => $_iUserGroupID, 'axRightsGroups' => $_axRightsGroups));
			$_sHtml .= '<br />';
			$_sHtml .= '<input type="submit" name="s'.$this->getID().'SubmitButton" value="speichern">';
		$_sHtml .= '</form>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return bIsSubmitted [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function isUserGroupRightsFormSubmitted()
	{
		global $_POST;
		if (isset($_POST['s'.$this->getID().'SubmitButton']))
		{
			if ($_POST['s'.$this->getID().'SubmitButton'] == 'speichern') {return true;}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@return sResultHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRights [type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildUserRightsSave($_iUserID, $_axRights = NULL)
	{
		$_axRights = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'axRights', 'xParameter' => $_axRights));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		$_sHtml = '';
		$_bAllOK = true;
		
		if ($_axRights === NULL) {$_axRights = $_POST['as'.$this->getID().'Right'];}
		
		if ($_iUserID > 0)
		{
			for ($_iRightsIndex=0; $_iRightsIndex<count($_axRights); $_iRightsIndex++)
			{
				if (
					!$this->saveUserRight(
						array(
							'iUserID' => $_iUserID, 
							'sRightName' => $_axRights[$_iRightsIndex][0], 
							'sRightStatus' => $_axRights[$_iRightsIndex][1],
						)
					)
				)
				{
					$_bAllOK = false;
				}
			}
		}
		else {$_bAllOK = false;}
		
		if ($_bAllOK == true) {$_sHtml .= '<div class="success">['.date('H:i:s').'] Alle Rechte wurden erfolgreich gespeichert.</div>';}
		else {$_sHtml .= '<div class="failure">['.date('H:i:s').'] Es konnten nicht alle Rechte gespeichert werden!</div>';}
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return sFormHtml [type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axRightsGroups [needed][type]mixed[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildUserRightsForm($_iUserID, $_axRightsGroups = NULL)
	{
		$_axRightsGroups = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'axRightsGroups', 'xParameter' => $_axRightsGroups));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		$_sHtml = '';
		$_sHtml .= '<form action="'.$this->getUrl().'" method="post" target="'.$this->getUrlTarget().'">';
			$_sHtml .= '<input type="hidden" name="iUserID" value="'.$_iUserID.'" />';
			$_sHtml .= $this->getUrlParametersForm(array('bUseLineBreak' => true));
			
			$_axUser = array();
			$_axUser['Username'] = '';
			
			if (!empty($_iUserID))
			{
                global $oPGUsers;
				$_axUser = $oPGUsers->loadUser(array('iUserID' => $_iUserID));
			}
			
			$_sHtml .= '<table>';
			$_sHtml .= '<tr>';
				$_sHtml .= '<td>Benutzer</td>';
				$_sHtml .= '<td>'.$_axUser['Username'].'</td>';
			$_sHtml .= '</tr>';
			$_sHtml .= '</table>';
			$_sHtml .= '<br /><br />';
			$_sHtml .= $this->buildRightsFormInputs(array('iUserID' => $_iUserID, 'axRightsGroups' => $_axRightsGroups));
			$_sHtml .= '<br />';
			$_sHtml .= '<input type="submit" name="s'.$this->getID().'SubmitButton" value="speichern">';
		$_sHtml .= '</form>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return bIsSubmitted [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function isUserRightsFormSubmitted()
	{
		global $_POST;
		if (isset($_POST['s'.$this->getID().'SubmitButton']))
		{
			if ($_POST['s'.$this->getID().'SubmitButton'] == 'speichern') {return true;}
		}
		return false;
	}
	/* @end method */
}
/* @end class */
$oPGRights = new classPG_Rights();

if (defined('PG_LOGIN_DATABASE_TABLE_PREFIX')) {$oPGRights->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_DATABASE_TABLE_PREFIX));}
if (defined('PG_LOGIN_MYSQL_TABLE_PREFIX')) {$oPGRights->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MYSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MSSQL_TABLE_PREFIX')) {$oPGRights->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MSSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MONGO_TABLE_PREFIX')) {$oPGRights->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MONGO_TABLE_PREFIX));}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGRights', 'xValue' => $oPGRights));}
?>