<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Dez 05 2012
*/
/*
@start class

@description
[en]This class has methods to read users from database.[/en]
[de]Diese Klasse beinhaltet Methoden zum auslesen von Benutzern aus einer Datenbank.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Users extends classPG_ClassBasics
{
	// Declarations...
	private $asAdditionalSelect = array();
	private $sOrderBy = NULL;
	private $bOrderReverse = false;
	private $axUserData = array();
	private $bIgnoreNotAccepted = false;
	private $bIgnoreAccepted = false;
	private $bIgnoreNotBanned = false;
	private $bIgnoreBanned = true;
	private $bAdditionalSelectChanged = false;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGUsers'));
		$this->initDatabase();
	}
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets the table column to sort the order of the users.[/en]
	[de]Setzt die Tabellenspalte zur Sortierung der Benutzer.[/de]
	
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
	[en]Returns the column name to sort the order of the users.[/en]
	[de]Gibt den Spaltennamen zur Sortierung der Benutzer zur�ck.[/de]
	
	@return sOrderBy [type]string[/type]
	[en]Returns the column name to sort the order of the users as a string.[/en]
	[de]Gibt den Spaltennamen zur Sortierung der Benutzer als String zur�ck.[/de]
	*/
	public function getOrderBy() {return $this->sOrderBy;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether the sort of user should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzer umgedreht werden soll.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether the sort of user should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzer umgedreht werden soll.[/de]
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
	[en]Returns whether the sort of user is reversed.[/en]
	[de]Gibt zur�ck, ob die Sortierung der Benutzer umgedreht ist.[/de]
	
	@return bOrderReverse [type]bool[/type]
	[en]Returns an boolean whether the sort of user is reversed.[/en]
	[de]Gibt einen Boolean zur�ck, ob die Sortierung der Benutzer umgedreht ist.[/de]
	*/
	public function isReverseSortOrder() {return $this->bOrderReverse;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether users who have not yet confirmed their user account should be ignored.[/en]
	[de]Gibt an ob Benutzer, die ihren Benutzeraccount noch nicht best�tigt haben, ignoriert werden sollen.[/de]
	
	@param bIgnore [needed][type]bool[/type]
	[en]Specifies whether users who have not yet confirmed their user account should be ignored.[/en]
	[de]Gibt an ob Benutzer, die ihren Benutzeraccount noch nicht best�tigt haben, ignoriert werden sollen.[/de]
	*/
	public function ignoreNotAccepted($_bIgnore)
	{
		$_bIgnore = $this->getRealParameter(array('oParameters' => $_bIgnore, 'sName' => 'bIgnore', 'xParameter' => $_bIgnore));
		$this->bIgnoreNotAccepted = $_bIgnore;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether users who have confirmed their user account should be ignored.[/en]
	[de]Gibt an ob Benutzer, die ihren Benutzeraccount best�tigt haben, ignoriert werden sollen.[/de]
	
	@param bIgnore [needed][type]bool[/type]
	[en]Specifies whether users who have confirmed their user account should be ignored.[/en]
	[de]Gibt an ob Benutzer, die ihren Benutzeraccount best�tigt haben, ignoriert werden sollen.[/de]
	*/
	public function ignoreAccepted($_bIgnore)
	{
		$_bIgnore = $this->getRealParameter(array('oParameters' => $_bIgnore, 'sName' => 'bIgnore', 'xParameter' => $_bIgnore));
		$this->bIgnoreAccepted = $_bIgnore;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether users who are not banned should be ignored.[/en]
	[de]Gibt an ob Benutzer, die nicht gebannt wurden, ignoriert werden sollen.[/de]
	
	@param bIgnore [needed][type]bool[/type]
	[en]Specifies whether users who are not banned should be ignored.[/en]
	[de]Gibt an ob Benutzer, die nicht gebannt wurden, ignoriert werden sollen.[/de]
	*/
	public function ignoreNotBanned($_bIgnore)
	{
		$_bIgnore = $this->getRealParameter(array('oParameters' => $_bIgnore, 'sName' => 'bIgnore', 'xParameter' => $_bIgnore));
		$this->bIgnoreNotBanned = $_bIgnore;
	}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@description
	[en]Specifies whether users who are banned should be ignored.[/en]
	[de]Gibt an ob Benutzer, die gebannt wurden, ignoriert werden sollen.[/de]
	
	@param bIgnore [needed][type]bool[/type]
	[en]Specifies whether users who are banned should be ignored.[/en]
	[de]Gibt an ob Benutzer, die gebannt wurden, ignoriert werden sollen.[/de]
	*/
	public function ignoreBanned($_bIgnore)
	{
		$_bIgnore = $this->getRealParameter(array('oParameters' => $_bIgnore, 'sName' => 'bIgnore', 'xParameter' => $_bIgnore));
		$this->bIgnoreBanned = $_bIgnore;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Sets more column names to be selected from the users table.[/en]
	[de]Setzt weitere Spaltennamen, die zus�tzlich aus der Benutzer-Tabelle geholt werden sollen.[/de]
	
	@param asColumns [needed][type]string[][/type]
	[en]The column names for which data should be read in addition to the default columns.[/en]
	[de]Die Spaltennamen deren Daten zus�tzlich zu den Standard-Spalten ausgelesen werden sollen.[/de]
	*/
	public function setAdditionalSelectColumns($_asColumns)
	{
		$_asColumns = $this->getRealParameter(array('oParameters' => $_asColumns, 'sName' => 'asColumns', 'xParameter' => $_asColumns));
		$this->asAdditionalSelect = $_asColumns;
		$this->bAdditionalSelectChanged = true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Adds more column names to be selected from the users table.[/en]
	[de]F�gt weitere Spaltennamen hinzu, die zus�tzlich aus der Benutzer-Tabelle geholt werden sollen.[/de]
	
	@param asColumns [needed][type]string[][/type]
	[en]The column names for which data should be read in addition to the default columns.[/en]
	[de]Die Spaltennamen deren Daten zus�tzlich zu den Standard-Spalten ausgelesen werden sollen.[/de]
	*/
	public function addAdditionalSelectColumns($_asColumns)
	{
		$_asColumns = $this->getRealParameter(array('oParameters' => $_asColumns, 'sName' => 'asColumns', 'xParameter' => $_asColumns));
		$this->asAdditionalSelect = array_merge($this->asAdditionalSelect, $_asColumns);
		$this->bAdditionalSelectChanged = true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Adds one more column name to be selected from the users table.[/en]
	[de]F�gt einen weiteren Spaltennamen hinzu, der zus�tzlich aus der Benutzer-Tabelle geholt werden soll.[/de]
	
	@param sColumn [needed][type]string[/type]
	[en]The column name for which data should be read in addition to the default columns.[/en]
	[de]Der Spaltennamen von dem Daten zus�tzlich zu den Standard-Spalten ausgelesen werden sollen.[/de]
	*/
	public function addAdditionalSelectColumn($_sColumn)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sColumn, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$this->asAdditionalSelect[] = $_sColumn;
		$this->bAdditionalSelectChanged = true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]Returns the names of the columns that are read in addition to the default columns.[/en]
	[de]Gibt die Spaltennamen zur�ck, die zus�tzlich zu den Standard-Spalten ausgelesen werden.[/de]
	
	@return asSelect [type]string[][/type]
	[en]Returns the names of the columns that are read in addition to the default columns as an string array.[/en]
	[de]Gibt die Spaltennamen als String-Array zur�ck, die zus�tzlich zu den Standard-Spalten ausgelesen werden.[/de]
	*/
	public function getAdditionalSelectColumns() {return $this->asAdditionalSelect;}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads a user ID from the database.[/en]
	[de]L�dt eine Benutzer ID aus der Datenbank.[/de]
	
	@return iUserID [type]int[/type]
	[en]Returns the user ID as an integer.[/en]
	[de]Gibt die Benutzer ID als Integer zur�ck.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user as user ID (integer) or user name (String), which user ID should be read.[/en]
	[de]Der Benutzer als Benutzer ID (Integer) oder als Benutzername (String), dessen Benutzer ID ausgelesen werden soll.[/de]
	*/
	public function loadUserID($_xUser)
	{
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));

		if (is_string($_xUser))
		{
			$_xUser = $this->realEscapeDatabaseString(array('xString' => $_xUser));
		
			$_asColumns = array('UserID');
			$_axWhere = array(
                'OR' => array(
                    array('Username' => array('LIKE' => $_xUser)),
                    array('Email' => array('LIKE' => $_xUser))
                )
            );

			if
			(
				$_oResult = $this->selectDatasets(
					array(
						'sTable' => $this->getDatabaseTablePrefix().'user', 
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
				if ($_axUser = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {return $_axUser['UserID'];}
			}
		}
        else {return $_xUser;}

		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads usergroup IDs of a user from the database.[/en]
	[de]L�dt Benutzergruppen IDs von einem Benutzer aus der Datenbank.[/de]
	
	@return axUsergroupIDs [type]mixed[][/type]
	[en]Returns usergroup IDs as an integer array.[/en]
	[de]Gibt die Benutzergruppen IDs als Integer-Array zur�ck.[/de]
	
	@param xUser [needed][type]mixed[/type]
	[en]The user as user ID (integer) or user name (String), which usergroup IDs should be read.[/en]
	[de]Der Benutzer als Benutzer ID (Integer) oder als Benutzername (String), dessen Benutzergruppen IDs ausgelesen werden sollen.[/de]
	*/
	public function loadUserGroupIDs($_xUser, $_xWhere = NULL)
	{
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_xUser = $this->getRealParameter(array('oParameters' => $_xUser, 'sName' => 'xUser', 'xParameter' => $_xUser));


		$_axUserGroupIDs = array();
		$_iUserID = $this->loadUserID(array('xUser' => $_xUser));

        $_axWhere = array('AND' => array(array('UserID' => $_iUserID)));
        if (!empty($_xWhere)) {$_axWhere['AND'][] = $_xWhere;}

		$_asColumns = array('UserGroupID');
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
			while($_axUserGroupID = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {$_axUserGroupIDs[] = $_axUserGroupID['UserGroupID'];}
		}
		return $_axUserGroupIDs;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]loads a user from the database.[/en]
	[de]L�dt einen Benutzer aus der Datenbank.[/de]
	
	@return axUser [type]mixed[][/type]
	[en]Returns the user as an mixed array.[/en]
	[de]Gibt den Benutzer als mixed Array zur�ck.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The user ID of the user, which data should be read.[/en]
	[de]Die Benutzer ID vom Benutzer, deren Daten ausgelesen werden sollen.[/de]
	*/
	public function loadUser($_iUserID)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		$this->loadUsers(array('aiUserID' => array($_iUserID)));
		return $this->getUserByID(array('iUserID' => $_iUserID));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Load
	
	@description
	[en]...[/en]
	[de]...[/de]
	
	@return iUserCount [type]int[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param xWhere [type]mixed[/type]
	[en]A condition under which the users count should be loaded.[/en]
	[de]Eine Bedingung unter welcher die Benutzer-Anzahl zu laden ist.[/de]
	
	@param aiUserID [type]int[][/type]
	[en]The IDs of the users, which count should be loaded.[/en]
	[de]Die IDs der Benutzer, dessen Anzahl geladen werden soll.[/de]
	*/
	public function loadUsersCount($_xWhere = NULL, $_aiUserID = NULL)
	{
		$_aiUserID = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'aiUserID', 'xParameter' => $_aiUserID));
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'xWhere', 'xParameter' => $_xWhere));

//TODO: überabreiten auf neue Syntax!...
		$_asColumns = array('COUNT(*) AS UserCount');
		
		// Where...
        $_axWhere = array();
        if (
            ($_xWhere !== NULL)
            || ($this->bIgnoreNotAccepted == true) || ($this->bIgnoreAccepted == true)
            || ($this->bIgnoreBanned == true) || ($this->bIgnoreNotBanned == true)

        )
        {
            $_axWhere['AND'] = array();
            if ((count($_aiUserID) > 0) && ($_aiUserID !== NULL)) {$_axWhere['AND'][] = array('UserID' => array('IN' => $_aiUserID));}

            // Accepted...
            if ($this->bIgnoreNotAccepted == true) {$_axWhere['AND'][] = array('Accepted' => 1);}
            else if ($this->bIgnoreAccepted == true) {$_axWhere['AND'][] = array('Accepted' => array('!=' => 1));}

            // Banned...
            if ($this->bIgnoreBanned == true) {$_axWhere['AND'][] = array('Banned' => array('!=' => 1));}
            else if ($this->bIgnoreNotBanned == true) {$_axWhere['AND'][] = array('Banned' => 1);}

            if ($_xWhere !== NULL) {$_axWhere['AND'][] = $_xWhere;}
        }
        else if ($_aiUserID !== NULL)
        {
            $_axWhere = array(
                'UserID' => array('IN' => $_aiUserID)
            );
        }

        if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
					'asColumns' => $_asColumns, 
					'xWhere' => $_axWhere,
					'sEngine' => NULL
				)
			)
		)
		{
			if ($_axUserData = $this->fetchDatabaseArray(array('xResult' => $_oResult))) {return $_axUserData['UserCount'];}
		}

		return 0;
	}
	/* @end method */

	/*
	@start method
	
	@group Load
	
	@description
	[en]Loads users from the database and keeps them in memory.[/en]
	[de]L�dt Benutzer aus der Datenbank und merkt sie sich.[/de]
	
	@return axUsers [type]mixed[][/type]
	[en]Returns the users as an mixed array.[/en]
	[de]Gibt die Benutzer als mixed Array zur�ck.[/de]
	
	@param xWhere [type]mixed[/type]
	[en]A condition under which the users are to load.[/en]
	[de]Eine Bedingung unter welcher die Benutzer zu laden sind.[/de]
	
	@param aiUserID [type]int[][/type]
	[en]The IDs of the users, which should be loaded.[/en]
	[de]Die IDs der Benutzer, die geladen werden sollen.[/de]
	
	@param iLimitStart [type]int[/type]
	[en]At which count the users should be loaded.[/en]
	[de]Ab welcher Anzahl die Benutzer geladen werden sollen.[/de]
	
	@param iLimitEnd [type]int[/type]
	[en]How many users maximum should be loaded from the database.[/en]
	[de]Wieviele Benutzer maximal aus der Datenbank geladen werden sollen.[/de]
	
	@param sOrderBy [type]string[/type]
	[en]The column name to sort by.[/en]
	[de]Der Spaltenname nach dem sortiert werden soll.[/de]
	
	@param bOrderReverse [type]bool[/type]
	[en]Specifies whether the sort of user should be reversed.[/en]
	[de]Gibt an ob die Sortierung der Benutzer umgedreht werden soll.[/de]
	*/
	public function loadUsers($_xWhere = NULL, $_aiUserID = NULL, $_iLimitStart = NULL, $_iLimitEnd = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL)
	{
		$_iLimitStart = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'iLimitStart', 'xParameter' => $_iLimitStart));
		$_iLimitEnd = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'iLimitEnd', 'xParameter' => $_iLimitEnd));
		$_sOrderBy = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_aiUserID = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'aiUserID', 'xParameter' => $_aiUserID));
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'xWhere', 'xParameter' => $_xWhere));

		// if ($_sWhere === NULL) {$_sWhere = '';}
		if ($_sOrderBy === NULL) {$_sOrderBy = $this->sOrderBy;}
		if ($_bOrderReverse === NULL) {$_bOrderReverse = $this->bOrderReverse;}
		
		if ((count($_aiUserID) > 0) && (count($this->axUserData) > 0))
		{
			for ($i=0; $i<count($this->axUserData); $i++)
			{
				for ($t=0; $t<count($_aiUserID); $t++)
				{
					if ($this->axUserData[$i]['UserID'] == $_aiUserID[$t])
					{
						if (($this->bAdditionalSelectChanged == true) || ($_xWhere != NULL)) {array_splice($this->axUserData, $i, 1);}
						else {array_splice($_aiUserID, $t, 1);}
						continue;
					}
				}
			}
		}
				
		$_asColumns = array(
			'UserID', 'Username', 'Email', 'UserType', 'Gender', 'Accepted',
			'FirstName', 'LastName', 'Language', 'ChangeTimeStamp', 'CreateTimeStamp'
		);

		if ($this->asAdditionalSelect != NULL)
		{
			if (count($this->asAdditionalSelect) > 0)
            {
                if ($this->asAdditionalSelect[0] == '*') {$_asColumns = NULL;}
                else {$_asColumns = array_merge($_asColumns, $this->asAdditionalSelect);}
            }
		}
		
		// Where...
        $_axWhere = array();
        if (
            ($_xWhere !== NULL)
            || ($this->bIgnoreNotAccepted == true) || ($this->bIgnoreAccepted == true)
            || ($this->bIgnoreBanned == true) || ($this->bIgnoreNotBanned == true)

        )
        {
            $_axWhere['AND'] = array();
            if ((count($_aiUserID) > 0) && ($_aiUserID !== NULL)) {$_axWhere['AND'][] = array('UserID' => array('IN' => $_aiUserID));}

            // Accepted...
            if ($this->bIgnoreNotAccepted == true) {$_axWhere['AND'][] = array('Accepted' => 1);}
            else if ($this->bIgnoreAccepted == true) {$_axWhere['AND'][] = array('Accepted' => array('!=' => 1));}

            // Banned...
            if ($this->bIgnoreBanned == true) {$_axWhere['AND'][] = array('Banned' => array('!=' => 1));}
            else if ($this->bIgnoreNotBanned == true) {$_axWhere['AND'][] = array('Banned' => 1);}

            if ($_xWhere !== NULL) {$_axWhere['AND'][] = $_xWhere;}
        }
        else if ($_aiUserID !== NULL)
        {
            $_axWhere = array(
                'UserID' => array('IN' => $_aiUserID)
            );
        }

		if
		(
			$_oResult = $this->selectDatasets(
				array(
					'sTable' => $this->getDatabaseTablePrefix().'user', 
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
			while ($_axUserData = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
            {
                $this->axUserData[] = $_axUserData;
            }
		}

        if (!empty($this->axUserData['Password'])) {$this->axUserData['Password'] = ''; unset($this->axUserData['Password']);}
        if (!empty($this->axUserData['ReloginPassword'])) {$this->axUserData['ReloginPassword'] = ''; unset($this->axUserData['ReloginPassword']);}
        if (!empty($this->axUserData['Access'])) {$this->axUserData['Access'] = ''; unset($this->axUserData['Access']);}

		$this->bAdditionalSelectChanged = false;
		return $this->axUserData;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Removes the registered users from the temporary cache.[/en]
	[de]Entfernt die gemerkten Benutzer wieder aus dem Tempor�ren Zwischenspeicher.[/de]
	*/
	public function clearUsers() {$this->axUserData = array();}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the users.[/en]
	[de]Gibt die Benutzer zur�ck.[/de]
	
	@return axUsers [type]mixed[][/type]
	[en]Returns the users as an mixed array.[/en]
	[de]Gibt die Benutzer als mixed Array zur�ck.[/de]
	*/
	public function getUsers() {return $this->axUserData;}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the user from the memory.[/en]
	[de]Gibt einen Benutzer aus dem Zwischenspeicher zur�ck.[/de]
	
	@return axUser [type]mixed[][/type]
	[en]Returns the user as an mixed array.[/en]
	[de]Gibt einen Benutzer als mixed Array zur�ck.[/de]
	
	@param iIndex [needed][type]int[/type]
	[en]The index or the position from which a user should be get.[/en]
	[de]Der Index bzw. die Position von der ein Benutzer geholt werden soll.[/de]
	*/
	public function getUserByIndex($_iIndex)
	{
		$_iIndex = $this->getRealParameter(array('oParameters' => $_iIndex, 'sName' => 'iIndex', 'xParameter' => $_iIndex));
		return $this->axUserData[$_iIndex];
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the user from the memory.[/en]
	[de]Gibt einen Benutzer aus dem Zwischenspeicher zur�ck.[/de]

	@return axUser [type]mixed[][/type]
	[en]Returns the user as an mixed array.[/en]
	[de]Gibt einen Benutzer als mixed Array zur�ck.[/de]
	
	@param iUserID [needed][type]int[/type]
	[en]The ID of the user.[/en]
	[de]Die ID des Benutzers.[/de]
	*/
	public function getUserByID($_iUserID)
	{
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		for ($i=0; $i<count($this->axUserData); $i++)
		{
			if ($this->axUserData[$i]['UserID'] == $_iUserID) {return $this->axUserData[$i];}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the user from the memory.[/en]
	[de]Gibt einen Benutzer aus dem Zwischenspeicher zur�ck.[/de]
	
	@return axUser [type]mixed[][/type]
	[en]Returns the user as an mixed array.[/en]
	[de]Gibt einen Benutzer als mixed Array zur�ck.[/de]
	
	@param sUsername [needed][type]string[/type]
	[en]The username of the user.[/en]
	[de]Der Benutzername des Benutzers.[/de]
	*/
	public function getUserByUsername($_sUsername)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		for ($i=0; $i<count($this->axUserData); $i++)
		{
			if ($this->axUserData[$i]['Username'] == $_sUsername) {return $this->axUserData[$i];}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the user from the memory.[/en]
	[de]Gibt einen Benutzer aus dem Zwischenspeicher zur�ck.[/de]
	
	@return axUser [type]mixed[][/type]
	[en]Returns the user as an mixed array.[/en]
	[de]Gibt einen Benutzer als mixed Array zur�ck.[/de]
	
	@param sEmail [needed][type]string[/type]
	[en]the email adress of the user.[/en]
	[de]Die E-Mail des Benutzers.[/de]
	*/
	public function getUserByEmail($_sEmail)
	{
		$_sEmail = $this->getRealParameter(array('oParameters' => $_sEmail, 'sName' => 'sEmail', 'xParameter' => $_sEmail));
		for ($i=0; $i<count($this->axUserData); $i++)
		{
			if ($this->axUserData[$i]['Email'] == $_sEmail) {return $this->axUserData[$i];}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the users from the memory.[/en]
	[de]Gibt die Benutzer aus dem Zwischenspeicher zur�ck.[/de]
	
	@return axUsers [type]mixed[][/type]
	[en]Returns the users as an mixed array.[/en]
	[de]Gibt die Benutzer als mixed Array zur�ck.[/de]
	
	@param sGender [needed][type]string[/type]
	[en]The gender of the users.[/en]
	[de]Das Geschlecht der Benutzer.[/de]
	*/
	public function getUsersByGender($_sGender)
	{
		$_sGender = $this->getRealParameter(array('oParameters' => $_sGender, 'sName' => 'sGender', 'xParameter' => $_sGender));
		$_axUserData = array();
		for ($i=0; $i<count($this->axUserData); $i++)
		{
			if ($this->axUserData[$i]['Gender'] == $_sGender) {$_axUserData[] = $this->axUserData[$i];}
		}
		return $_axUserData;
	}
	/* @end method */

	/*
	@start method
	
	@group Get
	
	@description
	[en]Returns the users from the memory.[/en]
	[de]Gibt die Benutzer aus dem Zwischenspeicher zur�ck.[/de]
	
	@return axUsers [type]mixed[][/type]
	[en]Returns the users as an mixed array.[/en]
	[de]Gibt die Benutzer als mixed Array zur�ck.[/de]
	
	@param bAccepted [needed][type]bool[/type]
	[en]Specifies whether users who have accepted their account (true) or have not yet accepted (false) should be returned.[/en]
	[de]Gibt an ob Benutzer die ihren Account akzeptiert haben (true) oder noch nicht akzeptiert haben (false) zur�ckgegeben werden sollen.[/de]
	*/
	public function getUsersByAccepted($_bAccepted)
	{
		$_bAccepted = $this->getRealParameter(array('oParameters' => $_bAccepted, 'sName' => 'bAccepted', 'xParameter' => $_bAccepted));
		$_axUserData = array();
		for ($i=0; $i<count($this->axUserData); $i++)
		{
			if ((($this->axUserData[$i]['Accepted'] == 1) && ($_bAccepted == true))
			|| (($this->axUserData[$i]['Accepted'] == 0) && ($_bAccepted == false)))
			{
				$_axUserData[] = $this->axUserData[$i];
			}
		}
		return $_axUserData;
	}
	/* @end method */
}
/* @end class */
$oPGUsers = new classPG_Users();

if (defined('PG_LOGIN_DATABASE_TABLE_PREFIX')) {$oPGUsers->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_DATABASE_TABLE_PREFIX));}
if (defined('PG_LOGIN_MYSQL_TABLE_PREFIX')) {$oPGUsers->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MYSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MSSQL_TABLE_PREFIX')) {$oPGUsers->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MSSQL_TABLE_PREFIX));}
if (defined('PG_LOGIN_MONGO_TABLE_PREFIX')) {$oPGUsers->setDatabaseTablePrefix(array('sPrefix' => PG_LOGIN_MONGO_TABLE_PREFIX));}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUsers', 'xValue' => $oPGUsers));}
?>