<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 20 2012
*/
define('PG_DATABASEUPDATE_NETWORK_REQUESTTYPE', 'PGDatabaseUpdateRequest');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_DatabaseUpdate extends classPG_ClassBasics
{
	// Declarations...
	private $iTablesFailed = 0;
	private $iTablesSuccessed = 0;
	
	private $sUpdateScriptPath = 'update_database.php';
	private $axDBChunkStructures = array();
	
	private $bJavaScriptAutoRegister = true;
	private $bUpdateAutorun = false;
	private $bUpdateHistoryInfo = false;
	private $bCurrentActionInfo = true;

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDatabaseUpdate'));
		$this->initClassBasics();
		$this->initDatabase();
	}
	
	// Methods...
	/*
	@start method
	
	@return iFailedCount [type]int[/type]
	[en]...[/en]
	*/
	public function getTablesFailed() {return $this->iTablesFailed;}
	/* @end method */

	/*
	@start method
	
	@return iSuccessedCount [type]int[/type]
	[en]...[/en]
	*/
	public function getTablesSuccessed() {return $this->iTablesSuccessed;}
	/* @end method */
	
	/*
	@start method
	
	@param axStructure [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function setDBChunkStructures($_axStructure)
	{
		$_axStructure = $this->getRealParameter(array('oParameters' => $_axStructure, 'sName' => 'axStructure', 'xParameter' => $_axStructure, 'bNotNull' => true));
		$this->axDBChunkStructures = $_axStructure;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axStructures [type]mixed[][/type]
	[en]...[/en]
	*/
	public function getDBChunkStructures() {return $this->axDBChunkStructures;}
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
	
	@return bAutoRegister [type]bool[/type]
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
	
	@return bAutorun [type]bool[/type]
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
	
	@return bHistoryInfo [type]bool[/type]
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
	
	@return bActionInfo [type]bool[/type]
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
	
	@return sPath [type]string[/type]
	[en]...[/en]
	*/
	public function getUpdateScriptPath() {return $this->sUpdateScriptPath;}
	/* @end method */
	
	// _axAddColumns[Index][Name]				// name of the column
	// _axAddColumns[Index][Type]				// type of the column like INT oder VARCHAR
	// _axAddColumns[Index][Size]				// size of column type
	// _axAddColumns[Index][Default]			// default content of the column
	// _axAddColumns[Index][Options]			// is column a PRIMARY KEY or UNIQUE?
	// _asRemoveColumns[Index]					// columns to remove
	/*
	@start method
	
	@return iUpToDate [type]int[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axAddColumns [type]mixed[][/type]
	[en]...[/en]
	
	@param asRemoveColumns [type]string[][/type]
	[en]...[/en]
	*/
	public function checkIfTableIsUpToDate($_sTable, $_axAddColumns = NULL, $_asRemoveColumns = NULL)
	{
		global $oPGMySql;

		$_axAddColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axAddColumns', 'xParameter' => $_axAddColumns));
		$_asRemoveColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asRemoveColumns', 'xParameter' => $_asRemoveColumns));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		
		$vReturn = 1;
		$_sTable = trim($_sTable);
		if (($_sTable != '') && (trim($_axAddColumns[0]['Name']) != ''))
		{
            $_oResult = $this->sendQueryToDatabase(array('xStatement' => 'SHOW TABLES LIKE "'.$_sTable.'"'));
            if ($_oResult == false)
            {
                if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Tabellen-Fehler: Tabelle '".$_sTable."' existiert nicht!</span>"));}
                return $vReturn = 0;
            }
			else if (mysql_num_rows($_oResult) < 1)
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Tabellen-Fehler: Tabelle '".$_sTable."' existiert nicht!</span>"));}
                return $vReturn = 0;
			}
			else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"success\">Tabelle '".$_sTable."' existiert.</span>"));}

			for ($i=0; $i<count($_axAddColumns); $i++)
			{
				if ($oPGMySql->columnExists(array('sTable' => $_sTable, 'sColumn' => $_axAddColumns[$i]['Name'])) < 1)
				{
					$vReturn = 0;
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Spalten-Fehler: Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' existiert nicht!</span>"));}
				}
				else
				{
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"success\">Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' existiert.</span>"));}
					
					$_asColumn = $this->getDatabaseTableColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_axAddColumns[$i]['Name'], 'sEngine' => NULL));
					if (strtoupper(trim($_asColumn['Type'])) != strtoupper(trim($_axAddColumns[$i]['Type'])))
					{
						$vReturn = 0;
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Spalten-Fehler: Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' ist vom falschen Typ! (".strtoupper(trim($_asColumn['Type']))." =&gt; ".strtoupper(trim($_axAddColumns[$i]['Type'])).")</span>"));}
					}
					else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"success\">Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' hat den richtigen Typ. (".strtoupper(trim($_asColumn['Type']))." =&gt; ".strtoupper(trim($_axAddColumns[$i]['Type'])).")</span>"));}

					if ($_asColumn['Size'] != $_axAddColumns[$i]['Size'])
					{
						$vReturn = 0;
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Spalten-Fehler: Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' hat eine andere L�nge! (".$_asColumn['Size']." =&gt; ".$_axAddColumns[$i]['Size'].")</span>"));}
					}
					else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"success\">Spalte '".$_sTable.".".trim($_axAddColumns[$i]['Name'])."' hat die richtige L�nge. (".$_asColumn['Size']." =&gt; ".$_axAddColumns[$i]['Size'].")</span>"));}

					/*if ($_asColumn["Default"] != $_axAddColumns[$i]["Default"])
					{
						$vReturn = 0;
						if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Spalten-Fehler: Spalte '".$_sTable.".".trim($aAddCols[$i]["Name"])."' hat einen anderen Defaultwert! (".$_asColumn["Default"]." =&gt; ".$aAddCols[$i]["Default"]."))</span><br>";}
					}*/
				}
			}

			// �berpr�fen dass auch alle nicht erw�nschten Spalten gel�scht sind...
			for ($i=0; $i<count($_asRemoveColumns); $i++)
			{
				if ($oPGMySql->columnExists(array('sTable' => $_sTable, 'sColumn' => $_asRemoveColumns[$i])) > 0)
				{
					$vReturn = 0;
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"failed\">Spalten-Fehler: Spalte '".$_sTable.".".trim($_asRemoveColumns[$i])."' sollte gel�scht werden!</span>"));}
				}
				else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => "<span class=\"success\">Spalte '".$_sTable.".".trim($_asRemoveColumns[$i])."' ist gel�scht.</span>"));}
			}
		}
		else {$vReturn = 0;}

		return $vReturn;
	}
	/* @end method */

	// _axAddColumns[Index][Name]			// Wie soll die Spalte heissen?
	// _axAddColumns[Index][Type]			// Typ der Spalte z.B. INT oder VARCHAR
	// _axAddColumns[Index][Size]			// Gr��e des SpaltenTyps
	// _axAddColumns[Index][Default]		// Defaultinhalt der Spalte
	// _axAddColumns[Index][Options]		// ist die Spalte ein PRIMARY KEY oder ein Unique?
	// _asPrimaryKeys[Index]				// Prim�rschl�ssel (f�r Multiprim�rschl�sel)

	// _axChangeColumns[Index][OldName]		// Welche Spalte soll ge�ndert werden?
	// _axChangeColumns[Index][Name]		// Wie soll die Spalte heissen?
	// _axChangeColumns[Index][Type]		// Typ der Spalte z.B. INT oder VARCHAR
	// _axChangeColumns[Index][Size]		// Gr��e des SpaltenTyps
	// _axChangeColumns[Index][Default]		// Defaultinhalt der Spalte
	// _axChangeColumns[Index][Options]		// ist die Spalte ein PRIMARY KEY oder ein Unique?

	// _asRemoveColumns[Index]				// Welche Spalten m�ssen gel�scht werden?
	/*
	@start method
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axAddColumns [type]mixed[][/type]
	[en]...[/en]
	
	@param asRemoveColumns [type]string[][/type]
	[en]...[/en]
	
	@param axChangeColumns [type]mixed[][/type]
	[en]...[/en]
	
	@param asPrimaryKeys [type]string[][/type]
	[en]...[/en]
	
	@param asIndexKeys [type]string[][/type]
	[en]...[/en]
	*/
	public function makeTableUpToDate(
        $_sTable,
        $_axAddColumns = NULL,
        $_asRemoveColumns = NULL,
        $_axChangeColumns = NULL,
        $_asPrimaryKeys = NULL,
        $_asIndexKeys = NULL
    )
	{
		global $oPGMySql;
		
		$_axAddColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axAddColumns', 'xParameter' => $_axAddColumns));
		$_asRemoveColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asRemoveColumns', 'xParameter' => $_asRemoveColumns));
		$_axChangeColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axChangeColumns', 'xParameter' => $_axChangeColumns));
		$_asPrimaryKeys = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asPrimaryKeys', 'xParameter' => $_asPrimaryKeys));
		$_asIndexKeys = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asIndexKeys', 'xParameter' => $_asIndexKeys));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
				
		$_sTable = trim($_sTable);
		if (($_sTable != '') && (trim($_axAddColumns[0]['Name']) != '') && (trim($_axAddColumns[0]['Type']) != ''))
		{
			$_sSql = 'CREATE TABLE IF NOT EXISTS '.$_sTable.' (';
			for ($i=0; $i<count($_axAddColumns); $i++)
			{
				if ($i > 0) {$_sSql .= ', ';}
				$_sSql .= trim($_axAddColumns[$i]['Name']).' '.trim($_axAddColumns[$i]['Type']);
				if ($_axAddColumns[$i]['Size'] > 0) {$_sSql .= '('.$_axAddColumns[$i]['Size'].')';}
				if ((trim($_axAddColumns[$i]['Options']) != '') && (count($_asPrimaryKeys) < 1)) {$_sSql .= ' '.trim($_axAddColumns[$i]['Options']);}
				if (($_axAddColumns[$i]['Default'] !== '') && (strtoupper($_axAddColumns[$i]['Options']) == 'NOT NULL'))
				{
					// $_sSql .= ' DEFAULT \''.$_axAddColumns[$i]['Default'].'\'';
					if (is_string($_axAddColumns[$i]['Default'])) {$_sSql .= ' DEFAULT \''.$_axAddColumns[$i]['Default'].'\'';}
					else {$_sSql .= ' DEFAULT '.$_axAddColumns[$i]['Default'];}
				}
			}
			if (count($_asPrimaryKeys) > 0)
			{
				$t = 0;
				$_sSql .= ', PRIMARY KEY (';
				for ($i=0; $i<count($_asPrimaryKeys); $i++)
				{
					if ($t > 0) {$_sSql .= ', ';}
					if (trim($_asPrimaryKeys[$i]) != '') {$_sSql .= trim($_asPrimaryKeys[$i]); $t++;}
				}
				$_sSql .= ')';
			}
			if (count($_asIndexKeys) > 0)
			{
				for ($i=0; $i<count($_asIndexKeys); $i++)
				{
					if (trim($_asIndexKeys[$i]) != '')
					{
						$_sSql .= ', INDEX '.trim($_asIndexKeys[$i]).' ('.trim($_asIndexKeys[$i]).')';
					}
				}
			}
			$_sSql .= ')';
			if ($this->sendQueryToDatabase(array('xStatement' => $_sSql, 'bAllowAnonymChangeStructure' => true)))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => '<span class="success">Table "'.$_sTable.'" was successfully created.</span>'));}
			}
			else if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => '<span class="failed">Failed to create Table "'.$_sTable.'"!</span>'));}

			// �berpr�fen und �ndern von Spalten...
			for ($i=0; $i<count($_axChangeColumns); $i++)
			{
				if ($oPGMySql->columnExists(array('sTable' => $_sTable, 'sColumn' => $_axChangeColumns[$i]['OldName'])) > 0) {$oPGMySql->changeColumn(array('sTable' => $_sTable, 'axColumn' => $_axChangeColumns[$i]));}
			}
			
			// �berpr�fen und erstellen von Spalten...
			for ($i=0; $i<count($_axAddColumns); $i++)
			{
				if ($oPGMySql->columnExists(array('sTable' => $_sTable, 'sColumn' => $_axAddColumns[$i]['Name'])) < 1) {$oPGMySql->createColumn(array('sTable' => $_sTable, 'axColumn' => $_axAddColumns[$i]));}
				else
				{
					$_axColumn = $this->getDatabaseTableColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_axAddColumns[$i]['Name'], 'sEngine' => NULL));
					if (strtoupper($_axColumn['Type']) != $_axAddColumns[$i]['Type']) {$oPGMySql->modifyColumn(array('sTable' => $_sTable, 'axColumn' => $_axAddColumns[$i]));}
					else if ($_axColumn['Size'] != $_axAddColumns[$i]['Size']) {$oPGMySql->modifyColumn(array('sTable' => $_sTable, 'axColumn' => $_axAddColumns[$i]));}
					else if
					(
						(($_axColumn['Default'] != $_axAddColumns[$i]['Default']) && ($_axAddColumns[$i]['Default'] !== NULL))
						||
						(
						 	(($_axColumn['Default'] === NULL) || ($_axColumn['Default'] === ''))
							&& (trim($_axAddColumns[$i]['Options']) == 'NOT NULL')
						)
					) {$oPGMySql->modifyColumn(array('sTable' => $_sTable, 'axColumn' => $_axAddColumns[$i]));}
				}
			}

			// Überprüfen und löschen von Spalten...
			for ($i=0; $i<count($_asRemoveColumns); $i++)
			{
				if (trim($_asRemoveColumns[$i]) != '')
				{
					if ($oPGMySql->columnExists(array('sTable' => $_sTable, 'sColumn' => $_asRemoveColumns[$i])) > 0) {$this->removeDatabaseTableColumn(array('sTable' => $_sTable, 'sColumn' => $_asRemoveColumns[$i], 'sEngine' => NULL));}
				}
			}
			
			// Überprüfen und erstellen von indices...
			for ($i=0; $i<count($_asIndexKeys); $i++)
			{
				if (trim($_asIndexKeys[$i]) != '')
				{
					$_sSql = 'SHOW INDEX FROM '.$_sTable.' ';
					$_sSql .= 'WHERE COLUMN_NAME = \''.trim($_asIndexKeys[$i]).'\'';
                    if ($_oResult = $this->sendQueryToDatabase(array('xStatement' => $_sSql)))
                    {
                        $_axIndex = $this->fetchDatabaseArray(array('xResult' => $_oResult));
                        if ($_axIndex['Column_name'] != trim($_asIndexKeys[$i]))
                        {
                            $_sSql2 = 'ALTER TABLE '.$_sTable.' ADD INDEX ';
                            $_sSql2 .= trim($_asIndexKeys[$i]).' ';
                            $_sSql2 .= '('.trim($_asIndexKeys[$i]).')';
                            $this->sendQueryToDatabase(array('xStatement' => $_sSql2));
                        }
                    }
				}
			}
		}
		else
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
			{
				$this->addDebugString(array('sString' => '<span class="failure">Table Data not correctly given:</span>'));
				$this->addDebugString(array('sString' => 'Table: "'.$_sTable.'"'));
				$this->addDebugString(array('sString' => 'axAddColumns: '.print_r($_axAddColumns, true)));
			}
			return -1;
		}
	}
	/* @end method */
	
	/*
	public function changeColumnName($_sTable, $_sOldName = NULL, $_sNewName = NULL)
	{
		$_sOldName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sOldName', 'xParameter' => $_sOldName));
		$_sNewName = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sNewName', 'xParameter' => $_sNewName));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sTable = trim($_sTable);
		$_sOldName = trim($_sOldName);
		$_sNewName = trim($_sNewName);
		if (($_sTable != '') && ($_sOldName != '') && ($_sNewName != ''))
		{
			return $this->sendQueryToDatabase(array('xStatement' => 'ALTER TABLE '.$_sTable.' CHANGE '.$_sOldName.' '.$_sNewName));
		}
		else {return -1;}
	}
	*/
	
	/*
	@start method
	
	@return axAddColumnStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	
	@param iSize [needed][type]string[/type]
	[en]...[/en]
	
	@param xDefault [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sOptions [needed][type]string[/type]
	[en]...[/en]
	*/
	public function buildAddColumnStructure($_sName, $_sType = NULL, $_iSize = NULL, $_xDefault = NULL, $_sOptions = NULL)
	{
		$_sType = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_iSize = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'iSize', 'xParameter' => $_iSize));
		$_xDefault = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'xDefault', 'xParameter' => $_xDefault));
		$_sOptions = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sOptions', 'xParameter' => $_sOptions));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		$_axColumnStructure = array(
			'Name' => $_sName,
			'Type' => $_sType,
			'Size' => $_iSize,
			'Default' => $_xDefault,
			'Options' => $_sOptions
		);
		return $_axColumnStructure;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axChangeColumnStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sOldName [needed][type]string[/type]
	[en]...[/en]
	
	@param sNewName [needed][type]string[/type]
	[en]...[/en]
	
	@param sType [needed][type]string[/type]
	[en]...[/en]
	
	@param iSize [needed][type]int[/type]
	[en]...[/en]
	
	@param xDefault [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sOptions [needed][type]string[/type]
	[en]...[/en]
	*/
	public function buildChangeColumnStructure($_sOldName, $_sNewName = NULL, $_sType = NULL, $_iSize = NULL, $_xDefault = NULL, $_sOptions = NULL)
	{
		$_sNewName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sNewName', 'xParameter' => $_sNewName));
		$_sType = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sType', 'xParameter' => $_sType));
		$_iSize = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'iSize', 'xParameter' => $_iSize));
		$_xDefault = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'xDefault', 'xParameter' => $_xDefault));
		$_sOptions = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sOptions', 'xParameter' => $_sOptions));
		$_sOldName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sOldName', 'xParameter' => $_sOldName));

		$_axColumnStructure = array(
			'OldName' => $_sOldName,
			'Name' => $_sNewName,
			'Type' => $_sType,
			'Size' => $_iSize,
			'Default' => $_xDefault,
			'Options' => $_sOptions
		);
		return $_axColumnStructure;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axTableStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axTableStructure [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param axAddColumnStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param axChangeColumnStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param asRemoveColumns [type]string[][/type]
	[en]...[/en]
	
	@param asPrimaryKeyColumns [type]string[][/type]
	[en]...[/en]
	*/
	public function buildTableStructure($_sTable, $_axTableStructure = NULL, $_axAddColumnStructures = NULL, $_axChangeColumnStructures = NULL, $_asRemoveColumns = NULL, $_asPrimaryKeyColumns = NULL)
	{
		$_axTableStructure = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axTableStructure', 'xParameter' => $_axTableStructure));
		$_axAddColumnStructures = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axAddColumnStructures', 'xParameter' => $_axAddColumnStructures));
		$_axChangeColumnStructures = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axChangeColumnStructures', 'xParameter' => $_axChangeColumnStructures));
		$_asRemoveColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asRemoveColumns', 'xParameter' => $_asRemoveColumns));
		$_asPrimaryKeyColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asPrimaryKeyColumns', 'xParameter' => $_asPrimaryKeyColumns));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_axTableStructure[$_sTable]['Add'] = array();
		for ($i=0; $i<count($_axAddColumnStructures); $i++)
		{
			$_axTableStructure[$_sTable]['Add'][$i] = array(
				'Name' => $_axAddColumnStructures[$i]['Name'],
				'Type' => $_axAddColumnStructures[$i]['Type'],
				'Size' => $_axAddColumnStructures[$i]['Size'],
				'Default' => $_axAddColumnStructures[$i]['Default'],
				'Options' => $_axAddColumnStructures[$i]['Options']
			);
		}
		
		$_axTableStructure[$_sTable]['Change'] = array();
		for ($i=0; $i<count($_axChangeColumnStructures); $i++)
		{
			$_axTableStructure[$_sTable]['Change'][$i] = array(
				'OldName' => $_axChangeColumnStructures['OldName'],
				'Name' => $_axChangeColumnStructures['Name'],
				'Type' => $_axChangeColumnStructures['Type'],
				'Size' => $_axChangeColumnStructures['Size'],
				'Default' => $_axChangeColumnStructures['Default'],
				'Options' => $_axChangeColumnStructures['Options']
			);
		}
		
		$_axTableStructure[$_sTable]['Remove'] = $_asRemoveColumns;
		$_axTableStructure[$_sTable]['Primary'] = $_asPrimaryKeyColumns;
		
		return $_axTableStructure;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sDBChunk [needed][type]string[/type]
	[en]...[/en]
	
	@param axDBChunkStructures [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param axTablesStructure [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildDBChunkStructure($_sDBChunk, $_axDBChunkStructures = NULL, $_axTablesStructure = NULL)
	{
		$_axDBChunkStructures = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'axDBChunkStructures', 'xParameter' => $_axDBChunkStructures));
		$_axTablesStructure = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'axTablesStructure', 'xParameter' => $_axTablesStructure));
		$_sDBChunk = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'sDBChunk', 'xParameter' => $_sDBChunk));
		$_axDBChunkStructures[$_sDBChunk] = $_axTablesStructure;
		return $_axDBChunkStructures;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDBChunk [needed][type]string[/type]
	[en]...[/en]
	
	@param axDBChunkStructures [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setNetworkMainData($_sDBChunk = NULL, $_axDBChunkStructures = NULL, $_sTable = NULL)
	{
		global $_POST;

		$_axDBChunkStructures = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'axDBChunkStructures', 'xParameter' => $_axDBChunkStructures));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'sTable', 'xParameter' => $_sTable));
		$_sDBChunk = $this->getRealParameter(array('oParameters' => $_sDBChunk, 'sName' => 'sDBChunk', 'xParameter' => $_sDBChunk));
		
		if ($_sDBChunk === NULL) {$_sDBChunk = $_POST['sDBChunk'];}
		if ($_sTable === NULL) {$_sTable = $_POST['sTableName'];}

		$_axAddColumns = $_axDBChunkStructures[$_sDBChunk][$_sTable]['Add'];
		$_asRemoveColumns = $_axDBChunkStructures[$_sDBChunk][$_sTable]['Remove'];
		$_axChangeColumns = $_axDBChunkStructures[$_sDBChunk][$_sTable]['Change'];
		$_asPrimaryKeys = $_axDBChunkStructures[$_sDBChunk][$_sTable]['Primary'];
		$_asIndexKeys = NULL;
		$_iSuccessState = 0;
		if ($this->makeTableUpToDate(array('sTable' => $_sTable, 'axAddColumns' => $_axAddColumns, 'asRemoveColumns' => $_asRemoveColumns, 'axChangeColumns' => $_axChangeColumns, 'asPrimaryKeys' => $_asPrimaryKeys, 'asIndexKeys' => $_asIndexKeys)) === -1)
		{
			$_iSuccessState = -1;
		}
		
		$this->addNetworkData(array('sName' => 'PG_RequestType', 'xValue' => PG_DATABASEUPDATE_NETWORK_REQUESTTYPE));
		$this->addNetworkData(array('sName' => 'PG_TablesUpdate_Successed', 'xValue' => $_iSuccessState));
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
		{
			$this->addNetworkData(array('sName' => 'PG_TablesUpdate_Debug', 'xValue' => $this->getDebugString()));
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDatabaseUpdateHtml [type]string[/type]
	[en]...[/en]
	
	@param sUpdateScriptPath [type]string[/type]
	[en]...[/en]
	
	@param axDBChunkStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param bUpdateHistoryInfo [type]bool[/type]
	[en]...[/en]
	
	@param bCurrentActionInfo [type]bool[/type]
	[en]...[/en]
	*/
	public function build($_sUpdateScriptPath = NULL, $_axDBChunkStructures = NULL, $_bUpdateHistoryInfo = NULL, $_bCurrentActionInfo = NULL)
	{
		global $oPGProgressBar;

		$_axDBChunkStructures = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'axDBChunkStructures', 'xParameter' => $_axDBChunkStructures));
		$_bUpdateHistoryInfo = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'bUpdateHistoryInfo', 'xParameter' => $_bUpdateHistoryInfo));
		$_bCurrentActionInfo = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'bCurrentActionInfo', 'xParameter' => $_bCurrentActionInfo));
		$_sUpdateScriptPath = $this->getRealParameter(array('oParameters' => $_sUpdateScriptPath, 'sName' => 'sUpdateScriptPath', 'xParameter' => $_sUpdateScriptPath));

		if ($_axDBChunkStructures === NULL) {$_axDBChunkStructures = $this->axDBChunkStructures;}
		if ($_sUpdateScriptPath === NULL) {$_sUpdateScriptPath = $this->sUpdateScriptPath;}
		if ($_bUpdateHistoryInfo === NULL) {$_bUpdateHistoryInfo = $this->bUpdateHistoryInfo;}
		if ($_bCurrentActionInfo === NULL) {$_bCurrentActionInfo = $this->bCurrentActionInfo;}

		$_sHtml = '';
		
		$_asDBChunkNames = array_keys($_axDBChunkStructures);
	
		$_sSizeX = '350px';
		if ($_bCurrentActionInfo == true) {$_sHtml .= '<div id="'.$this->getID().'ActionInfo" style="width:'.$_sSizeX.';">Update database "'.$_asDBChunkNames[0].'"</div>';}
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
		
		if ($this->bJavaScriptAutoRegister == true)
		{
			$_sHtml .= '<script type="text/javascript">';
			if ($_bCurrentActionInfo == true) {$_sHtml .= 'oPGDatabaseUpdate.setCurrentActionContainerID("'.$this->getID().'ActionInfo"); ';}
			if ($_bUpdateHistoryInfo == true) {$_sHtml .= 'oPGDatabaseUpdate.setUpdateHistoryContainerID("'.$this->getID().'HistoryInfo"); ';}
			$_sHtml .= 'oPGDatabaseUpdate.build({';
				
				// Chunks...
				$i=0;
				$_sHtml .= '"asDBChunks": new Array(';
				foreach ($_axDBChunkStructures as $_sChunkName => $_axChunkValues)
				{
					if ($i>0) {$_sHtml .= ', ';}
					$_sHtml .= '"'.$_sChunkName.'"';
					$i++;
				}
				$_sHtml .= '), ';
				
				// Tables...
				$i=0;
				$t=0;
				$_sHtml .= '"asTables": new Array(';
				foreach ($_axDBChunkStructures as $_sChunkName => $_axChunkValues)
				{
					$t=0;
					if ($i>0) {$_sHtml .= ', ';}
					$_sHtml .= 'new Array(';
					foreach ($_axChunkValues as $_sTable => $_axTableValues)
					{
						if ($t>0) {$_sHtml .= ', ';}
						$_sHtml .= '"'.$_sTable.'"';
						$t++;
					}
					$_sHtml .= ')';
					$i++;
				}
				$_sHtml .= ')';
				
			$_sHtml .= ', "sUpdateScriptPath": "'.$_sUpdateScriptPath;
			$_sHtml .= '", "sDatabaseUpdateID": "'.$this->getID();
			$_sHtml .= '", "bRunUpdate": ';
			if ($this->bUpdateAutorun == true) {$_sHtml .= 'true';} else {$_sHtml .= 'false';}
			$_sHtml .= '}); ';
			$_sHtml .= '</script>';
		}
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDatabaseUpdate = new classPG_DatabaseUpdate();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDatabaseUpdate', 'xValue' => $oPGDatabaseUpdate));}
?>