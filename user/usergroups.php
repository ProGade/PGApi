<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Mar 15 2013
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_UserGroups extends classPG_ClassBasics
{
	// Declarations...
	private $sOrderBy = NULL;
	private $bOrderReverse = false;
	private $axUserGroupsData = array();
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGUsers'));
		$this->initDatabase();
	}
	
	// Methods...
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
		
		// usergroups...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserGroupID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => NULL, 'sOptions' => 'AUTO_INCREMENT PRIMARY KEY'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'Name', 'sType' => 'VARCHAR', 'iSize' => 64, 'xDefault' => '', 'sOptions' => NULL));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'ChangeTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'CreateTimeStamp', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'usergroups', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL,	'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => NULL));
		
		// user_usergroups...
		$_axAddColumnStructures = array();
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserGroupID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		$_axAddColumnStructures[] = $_oDatabaseUpdate->buildAddColumnStructure(array('sName' => 'UserID', 'sType' => 'INT', 'iSize' => 11, 'xDefault' => 0, 'sOptions' => 'NOT NULL'));
		
		$_asPrimaryKeyColumns = array('UserGroupID', 'UserID');

		$_axTablesStructure = $_oDatabaseUpdate->buildTableStructure(array('sTable' => $this->getDatabaseTablePrefix().'user_usergroups', 'axTableStructure' => $_axTablesStructure, 'axAddColumnStructures' => $_axAddColumnStructures, 'axChangeColumnStructures' => NULL,	'asRemoveColumns' => NULL, 'asPrimaryKeyColumns' => $_asPrimaryKeyColumns));
		
		return $_oDatabaseUpdate->buildDBChunkStructure(array('sDBChunk' => 'UserGroups', 'axDBChunkStructures' => $_axDBChunkStructures, 'axTablesStructure' => $_axTablesStructure));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Database
	
	@description
	[en]Builds the update and installation for the tables in the database and returns the update object.[/en]
	[de]Erstellt das Update und Installation für die Tabellen der Datenbank und gibt das Update-Objekt zurück.[/de]
	
	@return oUpdate [type]object[/type]
	[en]Returns the updated object, which was expanded by the tables of the login.[/en]
	[de]Gibt das Update-Objekt zurück, welches um die Tabellen des Logins erweitert wurde.[/de]
	
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
	
	@group Setup
	
	@description
	[en]Sets the table column to sort the order of the usergroups.[/en]
	[de]Setzt die Tabellenspalte zur Sortierung der Benutzergruppen.[/de]
	
	@param sColumnName [needed][type]string[/type]
	[en]The column name to sort by.[/en]
	[de]Der Spaltenname nach dem sortiert werden soll.[/de]
	*/
	public function setOrderBy($_sColumnName)
	{
		$_sColumnName = $this->getRealParameter(array('oParameters' => $_sColumnName, 'sName' => 'sColumnName', 'xParameter' => $_sColumnName));
		$this->sOrderBy = (string)$_sColumnName;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the column name to sort the order of the usergroups.[/en]
	[de]Gibt den Spaltennamen zur Sortierung der Benutzergruppen zurück.[/de]
	
	@return sOrderBy [type]string[/type]
	[en]Returns the column name to sort the order of the usergroups as a string.[/en]
	[de]Gibt den Spaltennamen zur Sortierung der Benutzergruppen als String zurück.[/de]
	*/
	public function getOrderBy() {return $this->sOrderBy;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether the sort of usergroup should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzergruppe umgedreht werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether the sort of usergroup should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzergruppe umgedreht werden soll.[/de]
	*/
	public function useReverseOrder($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bOrderReverse = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns whether the sort of usergroups is reversed.[/en]
	[de]Gibt zurück, ob die Sortierung der Benutzergruppen umgedreht ist.[/de]
	
	@return bOrderReverse [type]bool[/type]
	[en]Returns an boolean whether the sort of usergroups is reversed.[/en]
	[de]Gibt einen Boolean zurück, ob die Sortierung der Benutzergruppen umgedreht ist.[/de]
	*/
	public function isReverseSortOrder() {return $this->bOrderReverse;}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads a usergroup ID from the database.[/en]
	[de]Lädt eine Benutzergruppen ID aus der Datenbank.[/de]
	
	@return iUserID [type]int[/type]
	[en]Returns the usergroup ID as an integer.[/en]
	[de]Gibt die Benutzergruppen ID als Integer zurück.[/de]
	
	@param xUserGroup [needed][type]mixed[/type]
	[en]The usergroup as usergroup ID (integer) or usergroup name (String), which usergroup ID should be read.[/en]
	[de]Die Benutzergruppe als Benutzergruppen ID (Integer) oder als Benutzergruppenname (String), dessen Benutzergruppen ID ausgelesen werden soll.[/de]
	*/
	public function loadUserGroupID($_xUserGroup)
	{
		$_xUserGroup = $this->getRealParameter(array('oParameters' => $_xUserGroup, 'sName' => 'xUserGroup', 'xParameter' => $_xUserGroup));

		if (is_string($_xUserGroup))
		{
			$_xUserGroup = $this->realEscapeDatabaseString(array('xString' => $_xUserGroup));
		
			$_asColumns = array('UserGroupID');
			$_axWhere = array('Name' => array('LIKE' => $_xUserGroup));
			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'usergroups', 
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
				if ($_axUserGroup = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {return $_axUserGroup['UserGroupID'];}
			}
		}
        else {return $_xUserGroup;}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads user IDs of a usergroup from the database.[/en]
	[de]Lädt Benutzer IDs von einer Benutzergruppe aus der Datenbank.[/de]
	
	@return axUserIDs [type]mixed[][/type]
	[en]Returns user IDs as an integer array.[/en]
	[de]Gibt die Benutzer IDs als Integer-Array zurück.[/de]
	
	@param xUserGroup [needed][type]mixed[/type]
	[en]The usergroup as usergroup ID (integer) or usergroup name (String), which user IDs should be read.[/en]
	[de]Die Benutzergruppe als Benutzergruppen ID (Integer) oder als Benutzergruppenname (String), dessen Benutzer IDs ausgelesen werden sollen.[/de]
	*/
	public function loadUserIDs($_xUserGroup)
	{
		$_xUserGroup = $this->getRealParameter(array('oParameters' => $_xUserGroup, 'sName' => 'xUserGroup', 'xParameter' => $_xUserGroup));

		$_axUserIDs = array();
		$_iUserGroupID = $this->loadUserGroupID(array('xUserGroup' => $_xUserGroup));
		$_asColumns = array('UserID');
		$_axWhere = array('UserGroupID' => $_iUserGroupID);
		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user_usergroups', 
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
			while($_axUserID = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {$_axUserIDs[] = $_axUserID['UserID'];}
		}
		return $_axUserIDs;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads a usergroup from the database.[/en]
	[de]Lädt eine Benutzergruppe aus der Datenbank.[/de]
	
	@return axUserGroup [type]mixed[][/type]
	[en]Returns the usergroup as an mixed array.[/en]
	[de]Gibt die Benutzergruppe als mixed Array zurück.[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]The usergroup ID of the usergroup, which data should be read.[/en]
	[de]Die Benutzergruppen ID von der Benutzergruppe, deren Daten ausgelesen werden sollen.[/de]
	*/
	public function loadUserGroup($_iUserGroupID)
	{
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));

		$this->loadUserGroups(array('aiUserGroupID' => array($_iUserGroupID)));
		return $this->getUserGroupByID(array('iUserGroupID' => $_iUserGroupID));
	}
	/* @end method */

	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads usergroups from the database and keeps them in memory.[/en]
	[de]Lädt Benutzergruppen aus der Datenbank und merkt sie sich.[/de]
	
	@return axUserGroups [type]mixed[][/type]
	[en]Returns the usergroups as an mixed array.[/en]
	[de]Gibt die Benutzergruppen als mixed Array zurück.[/de]
	
	@param xWhere [type]mixed[/type]
	[en]A condition under which the usergroups are to load.[/en]
	[de]Eine Bedingung unter welcher die Benutzergruppen zu laden sind.[/de]
	
	@param aiUserGroupID [type]int[][/type]
	[en]The IDs of the usergroups, which should be loaded.[/en]
	[de]Die IDs der Benutzergruppen, die geladen werden sollen.[/de]
	
	@param iLimitStart [type]int[/type]
	[en]At which count the usergroups should be loaded.[/en]
	[de]Ab welcher Anzahl die Benutzergruppen geladen werden sollen.[/de]
	
	@param iLimitEnd [type]int[/type]
	[en]How many usergroups maximum should be loaded from the database.[/en]
	[de]Wieviele Benutzergruppen maximal aus der Datenbank geladen werden sollen.[/de]
	
	@param sOrderBy [type]string[/type]
	[en]The column name to sort by.[/en]
	[de]Der Spaltenname nach dem sortiert werden soll.[/de]
	
	@param bOrderReverse [type]bool[/type]
	[en]Specifies whether the sort of usergroups should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzergruppen umgedreht werden soll.[/de]
	*/
	public function loadUserGroups($_xWhere = NULL, $_aiUserGroupID = NULL, $_iLimitStart = NULL, $_iLimitEnd = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL)
	{
		$_iLimitStart = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'iLimitStart', 'xParameter' => $_iLimitStart));
		$_iLimitEnd = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'iLimitEnd', 'xParameter' => $_iLimitEnd));
		$_sOrderBy = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_aiUserGroupID = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'aiUserGroupID', 'xParameter' => $_aiUserGroupID));
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'xWhere', 'xParameter' => $_xWhere));

		// if ($_xWhere === NULL) {$_xWhere = '';}
		if ($_sOrderBy === NULL) {$_sOrderBy = $this->sOrderBy;}
		if ($_bOrderReverse === NULL) {$_bOrderReverse = $this->bOrderReverse;}
		
		if ((count($_aiUserGroupID) > 0) && (count($this->axUserGroupsData) > 0))
		{
			for ($i=0; $i<count($this->axUserGroupsData); $i++)
			{
				for ($t=0; $t<count($_aiUserGroupID); $t++)
				{
					if ($this->axUserGroupsData[$i]['UserGroupID'] == $_aiUserGroupID[$t])
					{
						// if (($this->bAdditionalSelectChanged == true) || ($_xWhere != NULL)) {array_splice($this->axUserGroupsData, $i, 1);}
						if ($_xWhere != NULL) {array_splice($this->axUserGroupsData, $i, 1);}
						else {array_splice($_aiUserGroupID, $t, 1);}
						continue;
					}
				}
			}
		}
				
		$_asColumns = array(
			'UserGroupID', 'Name', 'ChangeTimeStamp', 'CreateTimeStamp'
		);
		/*
		if ($this->asAdditionalSelect != NULL)
		{
			if (count($this->asAdditionalSelect) > 0) {$_asColumns = array_merge($_asColumns, $this->asAdditionalSelect);}
		}
		*/
		
		// Where...
        $_axWhere = array();
        if ($_xWhere !== NULL)
        {
            $_axWhere = array(
                'AND' => array(
                    array('UserGroupID' => array('IN' => $_aiUserGroupID))
                )
            );

            if ($_xWhere !== NULL) {$_axWhere['AND'][] = $_xWhere;}
        }
        else if ($_aiUserGroupID !== NULL)
        {
            $_axWhere = array(
                'UserGroupID' => array('IN' => $_aiUserGroupID)
            );
        }

		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'usergroups', 
					'asColumns' => $_asColumns, 
					'xWhere' => $_axWhere,
					'iStart' => $_iLimitStart, 
					'iCount' => $_iLimitEnd,
					'sOrderBy' => $_sOrderBy, 
					'bOrderReverse' => $_bOrderReverse, 
					'sEngine' => NULL
				)
			)
		)
		{
			while ($_axUserGroupData = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {$this->axUserGroupsData[] = $_axUserGroupData;}
		}

		// $this->bAdditionalSelectChanged = false;
		return $this->axUserGroupsData;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Removes the registered usergroups from the temporary cache.[/en]
	[de]Entfernt die gemerkten Benutzergruppen wieder aus dem Temporären Zwischenspeicher.[/de]
	*/
	public function clearUserGroups() {$this->axUserGroupsData = array();}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the usergroups.[/en]
	[de]Gibt die Benutzergruppen zurück.[/de]
	
	@return axUserGroups [type]mixed[][/type]
	[en]Returns the usergroups as an mixed array.[/en]
	[de]Gibt die Benutzergruppen als mixed Array zurück.[/de]
	*/
	public function getUserGroups() {return $this->axUserGroupsData;}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the usergroup from the memory.[/en]
	[de]Gibt eine Benutzergruppe aus dem Zwischenspeicher zurück.[/de]
	
	@return axUserGroup [type]mixed[][/type]
	[en]Returns the usergroup as an mixed array.[/en]
	[de]Gibt eine Benutzergruppe als mixed Array zurück.[/de]
	
	@param iIndex [needed][type]int[/type]
	[en]The index or the position from which a usergroup should be get.[/en]
	[de]Der Index bzw. die Position von der eine Benutzergruppe geholt werden soll.[/de]
	*/
	public function getUserGroupByIndex($_iIndex)
	{
		$_iIndex = $this->getRealParameter(array('oParameters' => $_iIndex, 'sName' => 'iIndex', 'xParameter' => $_iIndex));
		return $this->axUserGroupsData[$_iIndex];
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the usergroup from the memory.[/en]
	[de]Gibt eine Benutzergruppe aus dem Zwischenspeicher zurück.[/de]

	@return axUserGroup [type]mixed[][/type]
	[en]Returns the usergroup as an mixed array.[/en]
	[de]Gibt eine Benutzergruppe als mixed Array zurück.[/de]
	
	@param iUserGroupID [needed][type]int[/type]
	[en]The ID of the usergroup.[/en]
	[de]Die ID der Benutzergruppe.[/de]
	*/
	public function getUserGroupByID($_iUserGroupID)
	{
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		for ($i=0; $i<count($this->axUserGroupsData); $i++)
		{
			if ($this->axUserGroupsData[$i]['UserGroupID'] == $_iUserGroupID) {return $this->axUserGroupsData[$i];}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the usergroup from the memory.[/en]
	[de]Gibt eine Benutzergruppe aus dem Zwischenspeicher zurück.[/de]
	
	@return axUserGroup [type]mixed[][/type]
	[en]Returns the usergroup as an mixed array.[/en]
	[de]Gibt eine Benutzergruppe als mixed Array zurück.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the usergroup.[/en]
	[de]Der Name der Benutzergruppe.[/de]
	*/
	public function getUserGroupByName($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		for ($i=0; $i<count($this->axUserGroupsData); $i++)
		{
			if ($this->axUserGroupsData[$i]['Name'] == $_sName) {return $this->axUserGroupsData[$i];}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Save
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sName [type]string[/type]
	[en]...[/en]
	[de]...[/de]

	@param bUserAssignments [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param aiUserID [type]int[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function saveUserGroup($_iUserGroupID = NULL, $_sName = NULL, $_bUserAssignments = NULL, $_aiUserID = NULL)
	{
		global $_POST;
	
		$_sName = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_bUserAssignments = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'bUserAssignments', 'xParameter' => $_bUserAssignments));
		$_aiUserID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'aiUserID', 'xParameter' => $_aiUserID));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		if ($_iUserGroupID === NULL) {$_iUserGroupID = 0;}
		if ($_sName === NULL)
		{
			$_sName = 'unnamed group';
			if (isset($_POST['s'.$this->getID().'Name'])) {$_sName = $_POST['s'.$this->getID().'Name'];}
		}
		if ($_bUserAssignments === NULL) {$_bUserAssignments = false;}
		if ($_aiUserID === NULL) {if (isset($_POST['ai'.$this->getID().'Users'])) {$_aiUserID = $_POST['ai'.$this->getID().'Users']; $_bUserAssignments = true;}}

		if (
			$_iUserGroupID = $this->saveDataset(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'usergroups',
					'sIDColumn' => 'UserGroupID',
					'xIDValue' => $_iUserGroupID,
                    'sAutoIDColumn' => 'UserGroupID',
					'axColumnsAndValues' => array(
						'Name' => $_sName
					),
					'axColumnsAndValuesOnInsert' => array('CreateTimeStamp' => time()),
					'axColumnsAndValuesOnUpdate' => array('ChangeTimeStamp' => time())
				)
			)
		)
		{
			if ($_bUserAssignments == true)
			{
				$_sTable = $this->getDatabaseTablePrefix().'user_usergroups';
				$this->deleteDatasets(array('sTable' => $_sTable, 'sIDColumn' => 'UserGroupID', 'xIDValue' => $_iUserGroupID));
				if ($_aiUserID !== NULL)
				{
					for ($i=0; $i<count($_aiUserID); $i++)
					{
						$this->insertDataset(
							array(
								'sTable' => $_sTable,
								'axColumnsAndValues' => array('UserID' => $_aiUserID[$i], 'UserGroupID' => $_iUserGroupID)
							)
						);
					}
				}
			}
			return $_iUserGroupID;
		}
		
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sName [type]string[/type]
	[en]...[/en]
	[de]...[/de]

	@param bUserAssignments [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param aiUserID [type]int[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildSaveUserGroup($_iUserGroupID = NULL, $_sName = NULL, $_bUserAssignments = NULL, $_aiUserID = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_bUserAssignments = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'bUserAssignments', 'xParameter' => $_bUserAssignments));
		$_aiUserID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'aiUserID', 'xParameter' => $_aiUserID));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		$_sHtml = '';
		if ($this->saveUserGroup(array('iUserGroupID' => $_iUserGroupID, 'sName' => $_sName, 'bUserAssignments' => $_bUserAssignments, 'aiUserID' => $_aiUserID)) > 0)
		{
			$_sHtml .= '<div class="success">['.date('H:i:s').'] Die Benutzergruppe wurde erfolgreich gespeichert.</div>';
		}
		else {$_sHtml .= '<div class="failure">['.date('H:i:s').'] Die Benutzergruppe konnte nicht gespeichert werden!</div>';}
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@param iUserGroupID [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param bUserAssignments [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param xUserTypes [type]int|int[][/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function buildUserGroupForm($_iUserGroupID = NULL, $_bUserAssignments = NULL, $_xUserTypes = NULL)
	{
		global $oPGUsers;
	
		$_bUserAssignments = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'bUserAssignments', 'xParameter' => $_bUserAssignments));
		$_xUserTypes = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'xUserTypes', 'xParameter' => $_xUserTypes));
		$_iUserGroupID = $this->getRealParameter(array('oParameters' => $_iUserGroupID, 'sName' => 'iUserGroupID', 'xParameter' => $_iUserGroupID));
		
		if ($_iUserGroupID === NULL) {$_iUserGroupID = 0;}
		if ($_bUserAssignments === NULL) {$_bUserAssignments = false;}
		
		$_sHtml = '';
		$_sHtml .= '<form action="'.$this->getUrl().'" method="post" target="'.$this->getUrlTarget().'">';
			$_sHtml .= '<input type="hidden" name="iUserGroupID" value="'.$_iUserGroupID.'" />';
			$_sHtml .= $this->getUrlParametersForm(array('bUseLineBreak' => true));
			
			$_axUserGroup = array();
			$_axUserGroup['Name'] = '';
			
			if ($_iUserGroupID > 0)
			{
				$_axUserGroup = $this->loadUserGroup(array('iUserGroupID' => $_iUserGroupID));
			}
			
			$_sHtml .= '<table>';
			$_sHtml .= '<tr>';
				$_sHtml .= '<td>Name</td>';
				$_sHtml .= '<td><input type="text" name="s'.$this->getID().'Name" value="'.$_axUserGroup['Name'].'" maxlength="255" style="width:200px;" /></td>';
			$_sHtml .= '</tr>';
			$_sHtml .= '</table>';
			$_sHtml .= '<br />';

			if ($_bUserAssignments == true)
			{
				$_aiCheckedUsers = array();
				if ($_iUserGroupID > 0) {$_aiCheckedUsers = $this->loadUserIDs(array('xUserGroup' => $_iUserGroupID));}

				/*$_sWhere = '';
				if ($_xUserTypes !== NULL)
				{
					if (is_array($_xUserTypes))
					{
						for ($i=0; $i<count($_xUserTypes); $i++)
						{
							if ($_sWhere != '') {$_sWhere .= ' OR ';}
							$_sWhere .= 'UserType = "'.$_xUserTypes[$i].'"';
						}
					}
					else {$_sWhere .= 'UserType = "'.$_xUserTypes.'"';}
				}*/

                if ($_xUserTypes !== NULL)
                {
                    if (is_array($_xUserTypes)) {$_axWhere = array('UserType' => array('IN' => $_xUserTypes));}
                    else {$_axWhere = array('UserType' => $_xUserTypes);}
                }

				if (
					$_axUsers = $oPGUsers->loadUsers(
						array(
							'xWhere' => $_axWhere,
							'aiUserID' => NULL, 
							'iLimitStart' => NULL, 
							'iLimitEnd' => NULL,
							'sOrderBy' => 'Username', 
							'bOrderReverse' => false
						)
					)
				)
				{
					$_sHtml .= '<h2>Zuweisungen</h2>';
					$_sHtml .= '<table>';
					$_sHtml .= '<tr>';
						$_sHtml .= '<th>&nbsp;</th>';
						$_sHtml .= '<th>Benutzer</th>';
						$_sHtml .= '<th>E-Mail</th>';
						$_sHtml .= '<th>Vorname</th>';
						$_sHtml .= '<th>Nachname</th>';
					$_sHtml .= '</tr>';
					
					$_sCssClass = 'row_highlight2';
					for ($i=0; $i<count($_axUsers); $i++)
					{
						if ($_sCssClass == 'row_highlight1') {$_sCssClass = 'row_highlight2';} else {$_sCssClass = 'row_highlight1';}
						$_axUser = $_axUsers[$i];
						$_sHtml .= '<tr class="'.$_sCssClass.'">';
							$_sHtml .= '<td>';
								$_sHtml .= '<input type="checkbox" name="ai'.$this->getID().'Users[]" ';
								for ($t=0; $t<count($_aiCheckedUsers); $t++)
								{
									if ($_aiCheckedUsers[$t] == $_axUser['UserID']) {$_sHtml .= 'checked ';}
								}
								$_sHtml .= 'value="'.$_axUser['UserID'].'" />';
							$_sHtml .= '</td>';
							$_sHtml .= '<td>'.$_axUser['Username'].'</td>';
							$_sHtml .= '<td>'.$_axUser['Email'].'</td>';
							$_sHtml .= '<td>'.$_axUser['FirstName'].'</td>';
							$_sHtml .= '<td>'.$_axUser['LastName'].'</td>';
						$_sHtml .= '</tr>';
					}
					
					$_sHtml .= '</table>';
					$_sHtml .= '<br />';
				}
			}
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
	
	@return bSubmitted [type]bool[/type]
	[en]...[/en]
	[de]...[/de]
	*/
	public function isFormSubmitted()
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
$oPGUserGroups = new classPG_UserGroups();

if (defined('PG_LOGIN_DATABASE_TABLE_PREFIX')) {$oPGUserGroups->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_DATABASE_TABLE_PREFIX));}
if (defined('PG_LOGIN_MYSQL_TABLE_PREFIX')) {$oPGUserGroups->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MYSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MSSQL_TABLE_PREFIX')) {$oPGUserGroups->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MSSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MONGO_TABLE_PREFIX')) {$oPGUserGroups->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MONGO_TABLE_PREFIX));}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUserGroups', 'xValue' => $oPGUserGroups));}
?>