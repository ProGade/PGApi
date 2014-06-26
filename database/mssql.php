<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 18 2012
*/

// TODO: for php >= 5.3 change to SQLSRV...
// http://www.php.net/manual/de/intro.mssql.php
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_MsSql extends classPG_ClassBasics
{
	// Declarations...
	private $sHost = 'localhost';
	private $sUser = 'root';
	private $sPassword = '';
	private $sDatabase = '';
	private $oConnection = NULL;
	private $bDieOnConnectionError = true;
	private $bUseMsSqlSrv = true;
	private $asReplaceOnWrite = array();
	
	// Construct...
	public function __construct()
	{
		$this->setText(
			array('xType' => 
				array(
					'ConnectionError' => 'MS-SQL connection error',
					'DatabaseConnectionError' => 'Database connection error',
					'QueryError' => 'MS-SQL query error'
				)
			)
		);
	}
	
	// Methods...
	/*
	@start method
	
	@param sHost [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHost($_sHost)
	{
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
		$this->sHost = $_sHost;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHost [type]string[/type]
	[en]...[/en]
	*/
	public function getHost() {return $this->sHost;}
	/* @end method */
	
	/*
	@start method
	
	@param sUser [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUser($_sUser)
	{
		$this->sUser = $_sUser;
	}
	/* @end method */
	
	/*
	@start metho
	
	@return sUser [type]string[/type]
	[en]...[/en]
	*/
	public function getUser() {return $this->sUser;}
	/* @end method */
	
	/*
	@start method
	
	@param sPassword [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPassword($_sPassword)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$this->sPassword = $_sPassword;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sPassword [type]string[/type]
	[en]...[/en]
	*/
	public function getPassword() {return $this->sPassword;}
	/* @end method */
	
	/*
	@start method
	
	@param sDatabase [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDatabaseName($_sDatabase)
	{
		$_sDatabase = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		$this->sDatabase = $_sDatabase;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDatabase [type]string[/type]
	[en]...[/en]
	*/
	public function getDatabaseName() {return $this->sDatabase;}
	/* @end method */
	
	/* @start method */
	public function resetReplaceOnWrite() {$this->asReplaceOnWrite = array();}
	/* @end method */
	
	/*
	@start method
	
	@param sSearchFor [needed][type]string[/type]
	[en]...[/en]
	
	@param sReplaceWith [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addReplaceOnWrite($_sSearchFor, $_sReplaceWith)
	{
		$_sReplaceWith = $this->getRealParameter(array('oParameters' => $_sSearchFor, 'sName' => 'sReplaceWith', 'xParameter' => $_sReplaceWith));
		$_sSearchFor = $this->getRealParameter(array('oParameters' => $_sSearchFor, 'sName' => 'sSearchFor', 'xParameter' => $_sSearchFor));
		$this->asReplaceOnWrite[$_sSearchFor] = $_sReplaceWith;
	}
	/* @end method */
	
	/*
	@start method
	
	@param bDie [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function dieOnConnectionError($_bDie)
	{
		$_bDie = $this->getRealParameter(array('oParameters' => $_bDie, 'sName' => 'bDie', 'xParameter' => $_bDie));
		$this->bDieOnConnectionError = $_bDie;
	}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useMsSqlSrv($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseMsSqlSrv = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUseMsSqlSrv [type]bool[/type]
	[en]...[/en]
	*/
	public function isMsSqlSrv() {return $this->bUseMsSqlSrv;}
	/* @end method */
	
	/*
	@start method
	@param bFormat
	*/
	public function formatWithPlainText($_bFormat) {$this->bFormatWithPlainText = $_bFormat;}
	/* @end method */

	/*
	@start method
	
	@return axColumnsStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getAllColumnsInfo($_sTable) {} // TODO
	/* @end method */

	/*
	@start method
	
	@return axColumnStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sColumn [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getColumnInfos($_sTable, $_sColumn) {} // TODO
	/* @end method */

	/*
	@start method
	
	@return asData [type]string[][/type]
	[en]...[/en]
	*/
	public function getConnectData()
	{
		$asConnectData = array(
			'sHost' => $this->sHost,
			'sUser' => $this->sUser,
			'sPassword' => $this->sPassword,
			'sDatabase' => $this->sDatabase
		);
		return $asConnectData;
	}
	/* @end method */

	/*
	@start method
	
	@return oConnection [type]object[/type]
	[en]...[/en]
	
	@param sHost [type]string[/type]
	[en]...[/en]
	
	@param sUser [type]string[/type]
	[en]...[/en]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	
	@param sDatabase [type]string[/type]
	[en]...[/en]
	*/
	public function connect($_sHost = NULL, $_sUser = NULL, $_sPassword = NULL, $_sDatabase = NULL)
	{
		$_sUser = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sDatabase = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));

		if ($_sHost !== NULL) {$this->sHost = $_sHost;}
		if ($_sUser !== NULL) {$this->sUser = $_sUser;}
		if ($_sPassword !== NULL) {$this->sPassword = $_sPassword;}
		if ($_sDatabase !== NULL) {$this->sDatabase = $_sDatabase;}

		if ((extension_loaded('sqlsrv')) && ($this->bUseMsSqlSrv == true))
		{
			if ($this->isDebugMode(PG_DEBUG_MEDIUM | PG_DEBUG_HIGH))
			{
				if ($this->isDebugMode(PG_DEBUG_HIGH))
				{
					$_sHiddenPassword = '';
					for ($i=0; $i<strlen($this->sPassword); $i++) {$_sHiddenPassword .= '*';}
					$this->sDebugString .= '$this->oConnection = @sqlsrv_connect('.$this->sHost.', '.$this->sUser.', '.$_sHiddenPassword.', false);<br /><br />';
				}
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @sqlsrv_connect($this->sHost, $this->sUser, $this->sPassword, false)
					or die('<div class="warning"><b>'.$this->asText['ConnectionError'].' ['.$this->sHost.'@'.$this->sUser.']:</b><br />'.sqlsrv_errors().'</div><br /><br />'.$this->sDebugString);
				}
				else {$this->oConnection = @sqlsrv_connect($this->sHost, $this->sUser, $this->sPassword, false);}
			}
			else
			{
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @sqlsrv_connect($this->sHost, $this->sUser, $this->sPassword, false)
					or die('<div class="warning">'.$this->asText['ConnectionError'].'</div><br />');
				}
				else {$this->oConnection = @sqlsrv_connect($this->sHost, $this->sUser, $this->sPassword, false);}
			}
		}
		else
		{
			if ($this->isDebugMode(PG_DEBUG_MEDIUM | PG_DEBUG_HIGH))
			{
				if ($this->isDebugMode(PG_DEBUG_HIGH))
				{
					$_sHiddenPassword = '';
					for ($i=0; $i<strlen($this->sPassword); $i++) {$_sHiddenPassword .= '*';}
					$this->sDebugString .= '$this->oConnection = @mssql_connect('.$this->sHost.', '.$this->sUser.', '.$_sHiddenPassword.', false);<br /><br />';
				}
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @mssql_connect($this->sHost, $this->sUser, $this->sPassword, false)
					or die('<div class="warning"><b>'.$this->asText['ConnectionError'].' ['.$this->sHost.'@'.$this->sUser.']:</b><br />'.mssql_get_last_message().'</div><br /><br />'.$this->sDebugString);
				}
				else {$this->oConnection = @mssql_connect($this->sHost, $this->sUser, $this->sPassword, false);}
			}
			else
			{
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @mssql_connect($this->sHost, $this->sUser, $this->sPassword, false)
					or die('<div class="warning">'.$this->asText['ConnectionError'].'</div><br />');
				}
				else {$this->oConnection = @mssql_connect($this->sHost, $this->sUser, $this->sPassword, false);}
			}
		}
		
		return $this->oConnection;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	*/
	public function close() {return $this->disconnect();}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	*/
	public function disconnect()
	{
		return mssql_close($this->oConnection);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDatabase [type]string[/type]
	[en]...[/en]
	*/
	public function changeDatabase($_sDatabase = NULL)
	{
		if ($_sDatabase != NULL) {$this->sDatabase = $_sDatabase;}

		if ($this->isDebugMode(PG_DEBUG_MEDIUM | PG_DEBUG_HIGH))
		{
			if ($this->isDebugMode(PG_DEBUG_HIGH)) {$this->sDebugString .= 'mssql_select_db('.$this->sDatabase.', '.$this->oConnection.');<br /><br />';}
			mssql_select_db($this->sDatabase, $this->oConnection)
			or die('<div class="warning"><b>'.$this->asText['DatabaseConnectionError'].' ['.$this->sDatabase.']:</b><br />'.mssql_get_last_message().'</div><br /><br />'.$this->sDebugString);
		}
		else
		{
			mssql_select_db($this->sDatabase, $this->oConnection)
			or die('<div class="warning">'.$this->asText['DatabaseConnectionError'].'</div><br />');
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return bConnected [type]bool[/type]
	[en]...[/en]
	
	@param oConnection [type]object[/type]
	[en]...[/en]
	*/
	public function isConnected() {return (mssql_connect() !== false);}
	/* @end method */

	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sStatement [needed][type]string[/type]
	[en]...[/en]
	
	@param sForbidden [needed][type]string[/type]
	[en]...[/en]
	*/
	public function removeForbiddenStatement($_sSqlStatement, $_sForbiddenContent)
	{
		$_sNewStatement = stristr($_sSqlStatement, $_sForbiddenContent, true);
		if ($_sNewStatement !== false) {return $_sNewStatement;}
		return $_sSqlStatement;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oResult [type]object[/type]
	[en]...[/en]
	
	@param sStatement [needed][type]string[/type]
	[en]...[/en]
	
	@param bAllowInfoSchema [type]bool[/type]
	[en]...[/en]
	
	@param bAllowUnion [type]bool[/type]
	[en]...[/en]
	
	@param bAllowVersion [type]bool[/type]
	[en]...[/en]
	*/
	public function sendSql($_sSqlStatement, $_bAllowInfoSchema = NULL, $_bAllowUnion = NULL, $_bAllowVersion = NULL)
	{
		global $oPGMsSqlStatements;
		
		if ($_bAllowInfoSchema === NULL) {$_bAllowInfoSchema = false;}
		if ($_bAllowUnion === NULL) {$_bAllowUnion = false;}
		if ($_bAllowVersion === NULL) {$_bAllowVersion = false;}
		
		if ($_bAllowInfoSchema == false) {$_sSqlStatement = $this->removeForbiddenStatement($_sSqlStatement, 'INFORMATION_SCHEMA');}
		if ($_bAllowUnion == false) {$_sSqlStatement = $this->removeForbiddenStatement($_sSqlStatement, 'UNION');}
		if ($_bAllowVersion == false) {$_sSqlStatement = $this->removeForbiddenStatement($_sSqlStatement, 'version()');}

		$this->connect();				// connect to mssql server
		$this->changeDatabase(NULL);	// connect to database
		
		if ($this->isDebugMode(PG_DEBUG_HIGH))
		{
			if (isset($oPGMsSqlStatements)) {$_sSqlStatement = $oPGMsSqlStatements->formatSqlStatement($_sSqlStatement);}
			$this->sDebugString .= '$_oResult = mssql_query($_sSqlStatement, '.$this->oConnection.');<br /><br />';
			$this->sDebugString .= '<b>MS-SQL-Debug:</b> '.$_sSqlStatement.'<br /><br />';
		}
		if (!$_oResult = mssql_query($_sSqlStatement, $this->oConnection))
		{
			if ($this->isDebugMode(PG_DEBUG_LOW)) {$this->sDebugString .= '<div class="warning">'.$this->asText['QueryError'].'</div><br /><br />';}
			else if ($this->isDebugMode(PG_DEBUG_MEDIUM | PG_DEBUG_HIGH))
			{
				if (isset($oPGMsSqlStatements)) {$_sSqlStatement = $oPGMsSqlStatements->formatSqlStatement($_sSqlStatement);}
				if ($this->isDebugMode(PG_DEBUG_MEDIUM)) {$this->sDebugString .= '<b>SQL-Debug:</b> '.$_sSqlStatement.'<br /><br />';}
				$this->sDebugString .= '<div class="warning"><b>'.$this->asText['QueryError'].':</b><br />'.mssql_get_last_message().'</div><br /><br />';
			}
		}
		return $_oResult;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xString [type]mixed[/type]
	[en]...[/en]
	
	@param xString [needed][type]mixed[/type]
	[en]...[/en]
	
	@param oConnection [type]object[/type]
	[en]...[/en]
	*/
	public function realEscapeString($_sString)
	{
		$_sString = str_replace("'", "''", $_sString);
		return preg_replace("/[\000\010\011\012\015\032\042\047\134\140]/is", '', $_sString);
	}
	/* @end method */

	/*
	@start method
	
	@return iInsertID [type]int[/type]
	[en]...[/en]
	
	@param oConnection [type]object[/type]
	[en]...[/en]
	*/
	public function getInsertID()
	{
		$_iInsertID = 0;
		$_oRes = mssql_query("SELECT @@identity AS InsertID", $this->oConnection);
		if ($_axData = mysql_fetch_array($_oRes, MYSQL_ASSOC)) {$_iInsertID = $_axData["InsertID"];}
		return $_iInsertID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iRowCount [type]int[/type]
	[en]...[/en]
	
	@param oResult [needed][type]object[/type]
	[en]...[/en]
	*/
	public function getRowCount($_oResult) {return mssql_num_rows($_oResult);}
	/* @end method */
	
	/*
	@start method
	
	@return axData [type]mixed[][/type]
	[en]...[/en]
	
	@param oResult [needed][type]object[/type]
	[en]...[/en]
	*/
	public function fetchArray($_oResult) {return mssql_fetch_array($_oResult);}
	/* @end method */

	/*
	@start method
	
	@return oResult [type]object[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param asColumns [type]string[][/type]
	[en]...[/en]
	
	@param sWhere [type]string[/type]
	[en]...[/en]
	
	@param iStart [type]int[/type]
	[en]...[/en]
	
	@param iCount [type]int[/type]
	[en]...[/en]
	
	@param sOrderBy [type]string[/type]
	[en]...[/en]
	
	@param bOrderReverse [type]bool[/type]
	[en]l...[/en]
	*/
	public function select($_sTable, $_asColumns, $_sWhere = NULL, $_iStart = NULL, $_iCount = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL)
	{
		$_sSql = 'SELECT ';
		for ($i=0; $i<count($_asColumns); $i++)
		{
			if ($i>0) {$_sSql .= ', ';}
			$_sSql .= $_asColumns[$i];
		}
		$_sSql .= ' FROM '.$_sTable;
		if ($_sWhere != NULL) {$_sSql .= ' WHERE '.$_sWhere;}
		if ($_sOrderBy != NULL)
		{
			$_sSql .= ' ORDER BY '.$_sOrderBy.' ';
			if ($_bOrderReverse == true) {$_sSql .= 'DESC';}
			else {$_sSql .= 'ASC';}
		}
		if (($_iStart != NULL) || ($_iCount != NULL))
		{
			$_sSql .= ' LIMIT ';
			if ($_iStart != NULL) {$_sSql .= $_iStart;}
			if (($_iStart != NULL) && ($_iCount != NULL)) {$_sSql .= ', ';}
			if ($_iCount != NULL) {$_sSql .= $_iCount;}
		}
		return $this->sendSql($_sSql);
	}
	/* @end method */

	/*
	@start method
	
	@return iInsertID [type]int[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	*/
	public function insert($_sTable, $_asColumnsAndValues, $_bStripSlashes = false)
	{
		$_sSql = 'INSERT INTO '.$_sTable.' SET ';
		$i=0;
		foreach ($_asColumnsAndValues as $_sColumn => $_xValue)
		{
			if ($i>0) {$_sSql .= ', ';}
			if (is_string($_xValue))
			{
				$_xValue = $this->realEscapeString($_xValue, $this->oConnection);
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearch != '') {$_xVale = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}
			}
			$_sSql .= $_sColumn.' = \''.$_xValue.'\'';
			$i++;
		}
		if ($this->sendSql($_sSql)) {return $this->getInsertID($this->oConnection);}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return xIDValue [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param sWhere [type]string[/type]
	[en]...[/en]
	
	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	*/
	public function update($_sTable, $_sIDColumn, $_xIDValue, $_asColumnsAndValues, $_sWhere = NULL, $_bStripSlashes = false)
	{
		$_sSql = 'UPDATE '.$_sTable.' SET ';
		$i=0;
		foreach ($_asColumnsAndValues as $_sColumn => $_xValue)
		{
			if ($i>0) {$_sSql .= ', ';}
			if (is_string($_xValue))
			{
				$_xValue = $this->realEscapeString($_xValue, $this->oConnection);
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearch != '') {$_xVale = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}
			}
			$_sSql .= $_sColumn.' = \''.$_xValue.'\'';
			$i++;
		}
		$_sSql .= ' WHERE '.$_sIDColumn.' = \''.$_xIDValue.'\'';
		if ($_sWhere != NULL) {$_sSql .= ' AND ('.$_sWhere.')';}
		if ($this->sendSql($_sSql)) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [type]mixed[][/type]
	[en]...[/en]
	
	@param axColumnsAndValuesOnInsert [type]mixed[][/type]
	[en]...[/en]
	
	@param axColumnsAndValuesOnUpdate [type]mixed[][/type]
	[en]...[/en]
	
	@param sWhere [type]string[/type]
	[en]...[/en]
	*/
	public function save($_sTable, $_sIDColumn, $_xIDValue, $_asColumnsAndValues, $_sWhere = NULL) {return $this->insertOrUpdateIfExists($_sTable, $_sIDColumn, $_xIDValue, $_asColumnsAndValues, $_sWhere);}
	/* @end method */

	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [type]mixed[][/type]
	[en]...[/en]
	
	@param axColumnsAndValuesOnInsert [type]mixed[][/type]
	[en]...[/en]
	
	@param axColumnsAndValuesOnUpdate [type]mixed[][/type]
	[en]...[/en]
	
	@param sWhere [type]string[/type]
	[en]...[/en]
	*/
	public function insertOrUpdateIfExists($_sTable, $_sIDColumn, $_xIDValue, $_asColumnsAndValues, $_sWhere = NULL) {} // TODO
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sWhere [type]string[/type]
	[en]...[/en]
	*/
	public function delete($_sTable, $_sIDColumn, $_xIDValue, $_sWhere = NULL)
	{
		$_sSql = 'DELETE FROM '.$_sTable.' WHERE';
		if (($_sIDColumn != '') && ($_xIDValue !== NULL)) {$_sSql .= ' '.$_sIDColumn.' = "'.$_xIDValue.'"';}
		if ($_sWhere != '') {$_sSql .= ' '.$_sWhere;}
		if ($this->sendSql($_sSql)) {return true;}
		return false;
	}
	/* @end method */

	/*
	@start method
	@param sTableName
	@param sColName
	*/
	public function tableColExists($_sTableName, $_sColName)
	{
		/*
		col exists:
		IF EXISTS(SELECT * FROM sys.columns WHERE Name = N'columnName' AND Object_ID = Object_ID(N'tableName'))
		
		table exists:
		IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[Mapping_APCToFANavigator]') AND type in (N'U'))
		*/
	} // TODO
	/* @end method */
	
	/*
	@start method
	@param sTableName
	@param sColName
	*/
	public function tableGetColInfos($_sTableName, $_sColName) {} // TODO
	/* @end method */

	/* @start method */
	public function sqlStatus() {} // TODO
	/* @end method */
}
/* @end class */
$oPGMsSql = new classPG_MsSql();

if (defined('PG_MSSQL_DATA_HOST')) {$oPGMsSql->setHost(PG_MSSQL_DATA_HOST);}
if (defined('PG_MSSQL_DATA_USER')) {$oPGMsSql->setUser(PG_MSSQL_DATA_USER);}
if (defined('PG_MSSQL_DATA_PASSWORD')) {$oPGMsSql->setPassword(PG_MSSQL_DATA_PASSWORD);}
if (defined('PG_MSSQL_DATA_DATABASE')) {$oPGMsSql->setDatabaseName(PG_MSSQL_DATA_DATABASE);}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMsSql', 'xValue' => $oPGMsSql));}
?>