<?php
/*
* ProGade API
* Copyright (c) 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Jun 27 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_MySql extends classPG_ClassBasics
{
	// Declarations...
	private $sHost = 'localhost';
	private $sUser = 'root';
	private $sPassword = '';
	private $sDatabase = '';
	private $oConnection = NULL;
	private $bDieOnConnectionError = true;
	private $bUseMySqli = false;
    private $bForceAllRights = false;
	private $asReplaceOnWrite = array();
	// private $asReplaceOnRead = array();
	
	// Construct...
	public function __construct()
	{
		$this->setText(
			array('xType' =>
				array(
					'ConnectionError' => 'MySql connection error',
					'DatabaseConnectionError' => 'Database connection error',
					'QueryError' => 'MySql query error'
				)
			)
		);
	}
	
	// Methods...
    /*
    @start method
    */
    public function useForceAllRights($_bUse)
    {
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bForceAllRights = $_bUse;
    }
    /* @end method */

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
		$_sUser = $this->getRealParameter(array('oParameters' => $_sUser, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$this->sUser = $_sUser;
	}
	/* @end method */
	
	/*
	@start method
	
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
	public function addReplaceOnWrite($_sSearchFor, $_sReplaceWith = NULL)
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
	public function useMySqli($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseMySqli = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUseMySqli [type]bool[/type]
	[en]...[/en]
	*/
	public function isMySqli() {return $this->bUseMySqli;}
	/* @end method */
	
	/*
	@start method
	
	@return axColumnsStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getAllColumnsInfo($_sTable)
	{
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_axColumnStructure = array();
		
		/*$_sSql = 'SELECT COLUMN_TYPE, COLUMN_NAME, COLUMN_DEFAULT, ';
		$_sSql .= 'COLUMN_KEY, EXTRA ';
		$_sSql .= 'FROM INFORMATION_SCHEMA.COLUMNS ';
		$_sSql .= 'WHERE TABLE_NAME = \''.$_sTable.'\'';*/
		$_sSql = 'SHOW COLUMNS FROM '.$_sTable;
		if ($_oResult = $this->sendSql(array('sStatement' => $_sSql)))
		{
			$i=0;
			while ($_axColumn = $this->fetchArray(array('oResult' => $_oResult)))
			{
				/*$_axColumnStructure[$i]['Name'] = $_axColumn['COLUMN_NAME'];
				$_axColumnStructure[$i]['Type'] = preg_replace("!(.*?)(\([0-9]*\))!mi", "\\1", $_axColumn['COLUMN_TYPE']);
				$_axColumnStructure[$i]['Size'] = preg_replace("!(.*?)\(([0-9]*)\)!mi", "\\2", $_axColumn['COLUMN_TYPE']);
				$_axColumnStructure[$i]['Default'] = $_axColumn['COLUMN_DEFAULT'];
				$_axColumnStructure[$i]['Key'] = $_axColumn['COLUMN_KEY']; // PRI, UNI, MUL
				$_axColumnStructure[$i]['Extra'] = $_axColumn['EXTRA'];*/
				$_axColumnStructure[$i] = array('Name' => $_axColumn['Field'],
												'Null' => $_axColumn['Null'],
												'Key' => $_axColumn['Key'],
												'Type' => preg_replace("!(.*?)(\([0-9]*\))!mi", "\\1", $_axColumn['Type']),
												'Size' => preg_replace("!(.*?)\(([0-9]*)\)!mi", "\\2", $_axColumn['Type']),
												'Default' => $_axColumn['Default'],
												'Extra' => $_axColumn['Extra']);
				if ($_axColumnStructure[$i]['Type'] == $_axColumnStructure[$i]['Size']) {$_axColumnStructure[$i]['Size'] = '';}
				$i++;
			} // while _axColumn
		} // if _oRes

		return $_axColumnStructure;		
	}
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
	public function getColumnInfos($_sTable, $_sColumn = NULL)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_axColumnStructure = array(
			'Name' => NULL,
			'Type' => NULL,
			'Size' => NULL,
			'Default' => NULL,
			'Key' => NULL,
			'Extra' => NULL
		);
		
		$_sSql = 'SELECT COLUMN_TYPE, COLUMN_NAME, COLUMN_DEFAULT, ';
		$_sSql .= 'COLUMN_KEY, EXTRA ';
		$_sSql .= 'FROM INFORMATION_SCHEMA.COLUMNS ';
		$_sSql .= 'WHERE TABLE_NAME = "'.$_sTable.'" ';
		$_sSql .= 'AND COLUMN_NAME = "'.$_sColumn.'"';
		if ($_oResult = $this->sendSql(array('sStatement' => $_sSql, 'bAllowInfoSchema' => true)))
		{
			$_axColumn = $this->fetchArray(array('oResult' => $_oResult));

			$_axColumnStructure['Name'] = $_axColumn['COLUMN_NAME'];
			$_axColumnStructure['Type'] = preg_replace("!(.*?)(\([0-9]*\))!mi", "\\1", $_axColumn['COLUMN_TYPE']);
			$_axColumnStructure['Size'] = preg_replace("!(.*?)\(([0-9]*)\)!mi", "\\2", $_axColumn['COLUMN_TYPE']);
			$_axColumnStructure['Default'] = $_axColumn['COLUMN_DEFAULT'];
			$_axColumnStructure['Key'] = $_axColumn['COLUMN_KEY']; // PRI, UNI, MUL
			$_axColumnStructure['Extra'] = $_axColumn['EXTRA'];
			if ($_axColumnStructure['Type'] == $_axColumnStructure['Size']) {$_axColumnStructure['Size'] = '';}
		}
		return $_axColumnStructure;
		/*
		// http://de3.php.net/manual/de/mysqli-result.fetch-fields.php
		// http://de2.php.net/manual/de/function.mysql-fetch-field.php
		if (!mysql_ping($this->oConnection)) {$this->connect();}
		$_oFields = mysql_list_fields($this->sDatabase, $_sTable, $this->oConnection);
		$_vColumns = mysql_num_fields($_oFields);
		for ($i=0; $i<$_vColumns; $i++)
		{
			if (trim($_sColumn) == trim(mysql_field_name($_oFields, $i)))
			{
				return mysql_fetch_field($_oFields, $i);
			}
		}
		return false;
		*/
	}
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
	
	// connect to mysql server...
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

		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true))
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
				{
					$_sHiddenPassword = '';
					for ($i=0; $i<strlen($this->sPassword); $i++) {$_sHiddenPassword .= '*';}
					$this->addDebugString(array('sString' => '$this->oConnection = @new mysqli('.$this->sHost.', '.$this->sUser.', '.$_sHiddenPassword.', '.$this->sDatabase.');<br /><br />'));
				}
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = new mysqli($this->sHost, $this->sUser, $this->sPassword, $this->sDatabase)
					or die('<div class="warning"><b>'.$this->getText(array('sType' => 'ConnectionError')).' ['.$this->sHost.'@'.$this->sUser.']:</b><br />'.mysql_error().'</div><br /><br />'.$this->getDebugString());
				}
				else {$this->oConnection = new mysqli($this->sHost, $this->sUser, $this->sPassword, $this->sDatabase);}
			}
			else
			{
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = new mysqli($this->sHost, $this->sUser, $this->sPassword, $this->sDatabase)
					or die('<div class="warning">'.$this->getText(array('sType' => 'ConnectionError')).'</div><br />');
				}
				else {$this->oConnection = new mysqli($this->sHost, $this->sUser, $this->sPassword, $this->sDatabase);}
			}
			$this->oConnection->set_charset('utf8');
		}
		else
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
				{
					$_sHiddenPassword = '';
					for ($i=0; $i<strlen($this->sPassword); $i++) {$_sHiddenPassword .= '*';}
					$this->addDebugString(array('sString' => '$this->oConnection = @mysql_connect('.$this->sHost.', '.$this->sUser.', '.$_sHiddenPassword.');<br /><br />'));
				}
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @mysql_connect($this->sHost, $this->sUser, $this->sPassword)
					or die('<div class="warning"><b>'.$this->getText(array('sType' => 'ConnectionError')).' ['.$this->sHost.'@'.$this->sUser.']:</b><br />'.mysql_error().'</div><br /><br />'.$this->getDebugString());
				}
				else {$this->oConnection = @mysql_connect($this->sHost, $this->sUser, $this->sPassword);}
			}
			else
			{
				if ($this->bDieOnConnectionError == true)
				{
					$this->oConnection = @mysql_connect($this->sHost, $this->sUser, $this->sPassword)
					or die('<div class="warning">'.$this->getText(array('sType' => 'ConnectionError')).'</div><br />');
				}
				else {$this->oConnection = @mysql_connect($this->sHost, $this->sUser, $this->sPassword);}
			}
			mysql_set_charset('utf8', $this->oConnection);
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
		$_bSuccess = false;
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {$_bSuccess = $this->oConnection->close();}
		$_bSuccess = mysql_close($this->oConnection);
		$this->oConnection = NULL;
		return $_bSuccess;
	}
	/* @end method */
	
	// connect to database...
	/*
	@start method
	
	@param sDatabase [type]string[/type]
	[en]...[/en]
	*/
	public function changeDatabase($_sDatabase = NULL)
	{
		$_sDatabase = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));

		if ($_sDatabase != NULL) {$this->sDatabase = $_sDatabase;}
		
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true))
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => '$this->oConnection->change_user('.$this->sUser.', password, '.$this->sDatabase.');<br /><br />'));}
				$this->oConnection->change_user($this->sUser, $this->sPassword, $this->sDatabase)
				or die('<div class="warning"><b>'.$this->getText(array('sType' => 'DatabaseConnectionError')).' ['.$this->sDatabase.']:</b><br />'.mysql_error().'</div><br /><br />'.$this->getDebugString());
			}
			else
			{
				$this->oConnection->change_user($this->sUser, $this->sPassword, $this->sDatabase)
				or die('<div class="warning">'.$this->getText(array('sType' => 'DatabaseConnectionError')).'</div><br />');
			}
		}
		else
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'mysql_select_db('.$this->sDatabase.', '.$this->oConnection.');<br /><br />'));}
				mysql_select_db($this->sDatabase, $this->oConnection)
				or die('<div class="warning"><b>'.$this->getText(array('sType' => 'DatabaseConnectionError')).' ['.$this->sDatabase.']:</b><br />'.mysql_error().'</div><br /><br />'.$this->getDebugString());
			}
			else
			{
				mysql_select_db($this->sDatabase, $this->oConnection)
				or die('<div class="warning">'.$this->getText(array('sType' => 'DatabaseConnectionError')).'</div><br />');
			}
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
	public function isConnected($_oConnection = NULL)
	{
		$_oConnection = $this->getRealParameter(array('oParameters' => $_oConnection, 'sName' => 'oConnection', 'xParameter' => $_oConnection));
		if ($_oConnection === NULL) {$_oConnection = $this->oConnection;}
		if ($_oConnection == NULL) {return false;}
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return $this->oConnection->ping();}
		return mysql_ping($_oConnection);
	}
	/* @end method */
	
	/* @start method */
	public function checkConnection()
	{
		if ($this->oConnection == NULL) {$this->connect();}
		else {if (!$this->isConnected(array('oConnection' => $this->oConnection))) {$this->connect();}}
		$this->changeDatabase();	// connect to database
	}
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
	public function removeForbiddenStatement($_sStatement, $_sForbidden = NULL)
	{
		$_sForbidden = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sForbidden', 'xParameter' => $_sForbidden));
		$_sStatement = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sStatement', 'xParameter' => $_sStatement));

		$_sNewStatement = strstr($_sStatement, $_sForbidden, true);
		if ($_sNewStatement !== false) {return $_sNewStatement;}
		return $_sStatement;
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
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]
	*/
	public function sendSql(
		$_sStatement, 
		$_bAllowInfoSchema = NULL, 
		$_bAllowUnion = NULL, 
		$_bAllowVersion = NULL, 
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL,
		$_bAllowAnonymDelete = NULL,
        $_bAllowAnonymChangeStructure = NULL
    )
	{
		global $oPGMySqlStatements, $oPGLogin;

		$_bAllowInfoSchema = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowInfoSchema', 'xParameter' => $_bAllowInfoSchema));
		$_bAllowUnion = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowUnion', 'xParameter' => $_bAllowUnion));
		$_bAllowVersion = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowVersion', 'xParameter' => $_bAllowVersion));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_bAllowAnonymChangeStructure = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'bAllowAnonymChangeStructure', 'xParameter' => $_bAllowAnonymChangeStructure));
		$_sStatement = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sStatement', 'xParameter' => $_sStatement));
		
		if ($_bAllowInfoSchema === NULL) {$_bAllowInfoSchema = false;}
		if ($_bAllowUnion === NULL) {$_bAllowUnion = false;}
		if ($_bAllowVersion === NULL) {$_bAllowVersion = false;}
		if ($_bAllowAnonymInsert === NULL) {$_bAllowAnonymInsert = false;}
		if ($_bAllowAnonymUpdate === NULL) {$_bAllowAnonymUpdate = false;}
		if ($_bAllowAnonymDelete === NULL) {$_bAllowAnonymDelete = false;}
        if ($_bAllowAnonymChangeStructure === NULL) {$_bAllowAnonymChangeStructure = false;}
		
		if ($_bAllowInfoSchema == false) {$_sStatement = $this->removeForbiddenStatement(array('sStatement' => $_sStatement, 'sForbidden' => 'INFORMATION_SCHEMA'));}
		if ($_bAllowUnion == false) {$_sStatement = $this->removeForbiddenStatement(array('sStatement' => $_sStatement, 'sForbidden' => 'UNION'));}
		if ($_bAllowVersion == false) {$_sStatement = $this->removeForbiddenStatement(array('sStatement' => $_sStatement, 'sForbidden' => 'version()'));}
		
		if (isset($oPGLogin))
		{
			if (($oPGLogin->isGuest()) && ($this->bForceAllRights == false))
			{
				if ($_bAllowAnonymInsert != true) {if (strpos($_sStatement, 'INSERT') !== false) {return false;}}
				if ($_bAllowAnonymUpdate != true) {if (strpos($_sStatement, 'UPDATE') !== false) {return false;}}
				if ($_bAllowAnonymDelete != true) {if (strpos($_sStatement, 'DELETE') !== false) {return false;}}
                if ($_bAllowAnonymChangeStructure != true)
                {
                    if (strpos($_sStatement, 'ALTER') !== false) {return false;}
                    if (strpos($_sStatement, 'CREATE') !== false) {return false;}
                    if (strpos($_sStatement, 'RENAME') !== false) {return false;}
                    if (strpos($_sStatement, 'DROP') !== false) {return false;}
                }
				if (strpos($_sStatement, 'HANDLER') !== false) {return false;}
				if (strpos($_sStatement, 'TRUNCATE') !== false) {return false;}
			}
		}
		
		$this->checkConnection();
		
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
		{
			if (isset($oPGMySqlStatements)) {$_sStatement2 = $oPGMySqlStatements->formatSqlStatement(array('sStatement' => $_sStatement));}
			else {$_sStatement2 = $_sStatement;}
			$this->addDebugString(array('sString' => '$_oResult = mysql_query($_sStatement, '.$this->oConnection.');<br /><br />'));
			$this->addDebugString(array('sString' => '<b>MySql-Debug:</b> '.$_sStatement2.'<br /><br />'));
		}

		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {$_oResult = $this->oConnection->query($_sStatement);}
		else {$_oResult = mysql_query($_sStatement, $this->oConnection);}
		
		// if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'Result Rows: '.$this->getRowCount(array('oResult' => $_oResult)).'<br />'));}

		if (!$_oResult)
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_LOW))) {$this->addDebugString(array('sString' => '<div class="warning">'.$this->getText(array('sType' => 'QueryError')).'</div><br /><br />'));}
			else if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM | PG_DEBUG_HIGH)))
			{
				if (isset($oPGMySqlStatements)) {$_sStatement2 = $oPGMySqlStatements->formatSqlStatement(array('sStatement' => $_sStatement));}
				else {$_sStatement2 = $_sStatement;}
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_MEDIUM))) {$this->addDebugString(array('sString' => '<b>SQL-Debug:</b> '.$_sStatement2.'<br /><br />'));}
				$this->addDebugString(array('sString' => '<div class="warning"><b>'.$this->getText(array('sType' => 'QueryError')).':</b><br />'.mysql_error($this->oConnection).'</div><br /><br />'));
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
	public function realEscapeString($_xString, $_oConnection = NULL)
	{
		$_oConnection = $this->getRealParameter(array('oParameters' => $_xString, 'sName' => 'oConnection', 'xParameter' => $_oConnection));
		$_xString = $this->getRealParameter(array('oParameters' => $_xString, 'sName' => 'xString', 'xParameter' => $_xString, 'bNotNull' => true));
		
		$this->checkConnection();
		if ($_oConnection === NULL) {$_oConnection = $this->oConnection;}
		
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true))
		{
			if (is_array($_xString))
			{
				foreach ($_xString as $_xIndex => $_sString)
				{
					if (is_string($_sString)) {$_xString[$_xIndex] = $_oConnection->real_escape_string($_sString);}
				}
			}
			else if (is_string($_xString)) {return $_oConnection->real_escape_string($_xString);}
			return $_xString;
		}
		
		if (is_array($_xString))
		{
			foreach ($_xString as $_xIndex => $_sString)
			{
				if (is_string($_sString)) {$_xString[$_xIndex] = mysql_real_escape_string($_sString, $_oConnection);}
			}
		}
		else if (is_string($_xString)) {return mysql_real_escape_string($_xString, $_oConnection);}
		
		return $_xString;
	}
	/* @end method */

	/*
	@start method
	
	@return iInsertID [type]int[/type]
	[en]...[/en]
	
	@param oConnection [type]object[/type]
	[en]...[/en]
	*/
	public function getInsertID($_oConnection = NULL)
	{
		$_oConnection = $this->getRealParameter(array('oParameters' => $_oConnection, 'sName' => 'oConnection', 'xParameter' => $_oConnection));
		if ($_oConnection === NULL) {$_oConnection = $this->oConnection;}
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return $_oConnection->insert_id;}
		return mysql_insert_id($_oConnection);
	}
	/* @end method */

	/*
	@start method
	
	@return iRowCount [type]int[/type]
	[en]...[/en]
	
	@param oResult [needed][type]object[/type]
	[en]...[/en]
	*/
	public function getRowCount($_oResult)
	{
		$_oResult = $this->getRealParameter(array('oParameters' => $_oResult, 'sName' => 'oResult', 'xParameter' => $_oResult));
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return $_oResult->num_rows;}
		return mysql_num_rows($_oResult);
	}
	/* @end method */

	/*
	@start method
	
	@return axData [type]mixed[][/type]
	[en]...[/en]
	
	@param oResult [needed][type]object[/type]
	[en]...[/en]
	*/
	public function fetchArray($_oResult)
	{
		$_oResult = $this->getRealParameter(array('oParameters' => $_oResult, 'sName' => 'oResult', 'xParameter' => $_oResult));
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return $_oResult->fetch_array(MYSQLI_ASSOC);} // MYSQLI_BOTH
		return mysql_fetch_array($_oResult);
	}
	/* @end method */

    /*
    @start method

    @return axWhere [type]mixed[][/type]
    [en]...[/en]

    @param xWhere [needed][type]mixed[/type]
    [ne]...[/en]
    */
    public function buildWhere($_xWhere)
    {
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xWhere, 'sName' => 'xWhere', 'xParameter' => $_xWhere));

        $_sStatement = '';

        if (empty($_xWhere)) {return NULL;}

        foreach ($_xWhere as $_sName => $_xValue)
        {
            if (is_array($_xValue))
            {
                if ($_sStatement != '') {$_sStatement .= ' AND ';}
                switch(strtolower($_sName))
                {
                    // logical...
                    case 'or':
                    case '||':
                    case '|':
                        $_axOrExpressions = array();
                        for ($i=0; $i<count($_xValue); $i++) {$_axOrExpressions[] = $this->buildWhere(array('xWhere' => $_xValue[$i]));}
                        $_sStatement .= '('.implode(' OR ', $_axOrExpressions).')';
                    break;

                    case 'and':
                    case '&&':
                    case '&':
                        $_axAndExpressions = array();
                        for ($i=0; $i<count($_xValue); $i++) {$_axAndExpressions[] = $this->buildWhere(array('xWhere' => $_xValue[$i]));}
                        $_sStatement .= '('.implode(' AND ', $_axAndExpressions).')';
                    break;

                    default:
                        $_axExpression = NULL;
                        foreach($_xValue as $_sOperator => $_xValue2)
                        {
                            switch(strtolower($_sOperator))
                            {
                                // comparsion...
                                case '==':
                                case '=':
                                    $_sStatement .= $_sName.' = "'.$_xValue2.'"';
                                    break;

                                case '!=':
                                    $_sStatement .= $_sName.' != "'.$_xValue2.'"';
                                    break;

                                case '>':
                                    $_sStatement .= $_sName.' > "'.$_xValue2.'"';
                                    break;

                                case '>=':
                                    $_sStatement .= $_sName.' >= "'.$_xValue2.'"';
                                    break;

                                case '<':
                                    $_sStatement .= $_sName.' < "'.$_xValue2.'"';
                                    break;

                                case '<=':
                                    $_sStatement .= $_sName.' <= "'.$_xValue2.'"';
                                    break;

                                case 'in':
                                    $_sStatement .= $_sName.' IN ('.(is_array($_xValue2) ? '"'.implode('","', $_xValue2).'"' : $_xValue2).')';
                                    break;

                                case 'not in':
                                    $_sStatement .= $_sName.' NOT IN ('.(is_array($_xValue2) ? '"'.implode('","', $_xValue2).'"' : $_xValue2).')';
                                    break;

                                case 'like':
                                    $_sStatement .= $_sName.' LIKE "'.$_xValue2.'"';
                                    break;

								case 'is':
									$_sStatement .= $_sName.' IS '.$_xValue2;
									break;

                                /*case 'regexp':
                                    $_axExpression[$_sName] = array('$regex' => $_xValue2, '$options' => 'im');
                                    break;*/
                            }

                        }
                    break;
                }
            }
            else
            {
                if ($_sStatement != '') {$_sStatement .= ' AND ';}
                $_sStatement .= $_sName.' = "'.$_xValue.'"';
            }
        }

        return $_sStatement;
    }
    /* @end method */

    /*
    @start method

    @return oResult [type]object[/type]
    [en]...[/en]

    @param sTable [needed][type]string[/type]
    [en]...[/en]

    @param asColumns [type]string[][/type]
    [en]...[/en]

    @param xWhere [type]mixed[/type]
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
	public function select($_sTable, $_asColumns = NULL, $_xWhere = NULL, $_iStart = NULL, $_iCount = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL)
	{
		$_asColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asColumns', 'xParameter' => $_asColumns));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_iStart = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iStart', 'xParameter' => $_iStart));
		$_iCount = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$_sOrderBy = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sSql = 'SELECT ';
		if ($_asColumns === NULL) {$_sSql .= '*';}
		else
		{
			for ($i=0; $i<count($_asColumns); $i++)
			{
				if ($i>0) {$_sSql .= ', ';}
				$_sSql .= $_asColumns[$i];
			}
		}
		$_sSql .= ' FROM '.$_sTable;
		if ($_xWhere != NULL) {$_sSql .= ' WHERE '.$this->buildWhere(array('xWhere' => $_xWhere));}
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
		return $this->sendSql(array('sStatement' => $_sSql));
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
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	*/
	public function insert(
		$_sTable, 
		$_axColumnsAndValues = NULL, 
		$_bStripSlashes = NULL,
		$_bAllowAnonymInsert = NULL)
	{
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		
		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_bAllowAnonymInsert === NULL) {$_bAllowAnonymInsert = false;}

		$_sSql = 'INSERT INTO '.$_sTable.' SET ';
		$i=0;
		foreach ($_axColumnsAndValues as $_sColumn => $_xValue)
		{
			if ($i>0) {$_sSql .= ', ';}
			if (is_string($_xValue))
			{
				$_xValue = $this->realEscapeString(array('xString' => $_xValue, 'oConnection' => $this->oConnection));
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearchFor != '') {$_xValue = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}
			}
			$_sSql .= $_sColumn.' = "'.$_xValue.'"';
			$i++;
		}
		if (
			$this->sendSql(
				array(
					'sStatement' => $_sSql,
					'bAllowAnonymInsert' => $_bAllowAnonymInsert
				)
			)
		)
		{
			return max($this->getInsertID(array('oConnection' => $this->oConnection)), 1);
		}
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
	
	@param xWhere [type]mixed[/type]
	[en]...[/en]
	
	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	*/
	public function update(
		$_sTable, 
		$_sIDColumn = NULL, 
		$_xIDValue = NULL, 
		$_axColumnsAndValues = NULL, 
		$_xWhere = NULL,
		$_bStripSlashes = NULL,
		$_bAllowAnonymUpdate = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_bAllowAnonymUpdate === NULL) {$_bAllowAnonymUpdate = false;}

		$_sSql = 'UPDATE '.$_sTable.' SET ';
		$i=0;
		foreach ($_axColumnsAndValues as $_sColumn => $_xValue)
		{
			if ($i>0) {$_sSql .= ', ';}
			if (is_string($_xValue))
			{
				$_xValue = $this->realEscapeString(array('xString' => $_xValue, 'oConnection' => $this->oConnection));
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearchFor != '') {$_xValue = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}
			}
			$_sSql .= $_sColumn.' = "'.$_xValue.'"';
			$i++;
		}
		if (!empty($_sIDColumn))
		{
			$_sSql .= ' WHERE '.$_sIDColumn.' = "'.$_xIDValue.'"';
			if ($_xWhere != NULL) {$_sSql .= ' AND ('.$this->buildWhere(array('xWhere' => $_xWhere)).')';}
		}
		else {$_sSql .= ' WHERE '.$this->buildWhere(array('xWhere' => $_xWhere));}
		if ($this->sendSql(array('sStatement' => $_sSql, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate))) {return $_xIDValue;}
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
	
	@param xWhere [type]mixed[/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	*/
	public function save(
		$_sTable, 
		$_sIDColumn = NULL, 
		$_xIDValue = NULL, 
		$_axColumnsAndValues = NULL, 
		$_axColumnsAndValuesOnInsert = NULL, 
		$_axColumnsAndValuesOnUpdate = NULL, 
		$_xWhere = NULL,
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		return $this->insertOrUpdateIfExists(
			array(
				'sTable' => $_sTable, 
				'sIDColumn' => $_sIDColumn, 
				'xIDValue' => $_xIDValue, 
				'axColumnsAndValues' => $_axColumnsAndValues, 
				'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 
				'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 
				'xWhere' => $_xWhere,
				'bAllowAnonymInsert' => $_bAllowAnonymInsert,
				'bAllowAnonymUpdate' => $_bAllowAnonymUpdate
			)
		);
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
	
	@param xWhere [type]mixed[/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	*/
	public function insertOrUpdateIfExists(
		$_sTable, 
		$_sIDColumn = NULL, 
		$_xIDValue = NULL, 
		$_axColumnsAndValues = NULL, 
		$_axColumnsAndValuesOnInsert = NULL, 
		$_axColumnsAndValuesOnUpdate = NULL, 
		$_xWhere = NULL,
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ((trim($_sIDColumn) != '') && ($_sIDColumn != NULL) && ($_xIDValue != NULL))
		{
			if (is_string($_xIDValue)) {$_xIDValue = $this->realEscapeString(array('xString' => $_xIDValue, 'oConnection' => $this->oConnection));}
			// if (trim($_sWhere) != '') {$_sWhere .= ' AND ('.$_sIDColumn.' = "'.$_xIDValue.'")';}
            if (!empty($_xWhere)) {$_xWhere[$_sIDColumn] = $_xIDValue;}
			else {$_xWhere = array($_sIDColumn => $_xIDValue);} // $_sWhere .= $_sIDColumn.' = "'.$_xIDValue.'"';}
			
			$_asColumns = array_keys($_axColumnsAndValues);
			$_axSelect = array($_sIDColumn => NULL);
			if ($_oResult = $this->select(array('sTable' => $_sTable, 'asColumns' => array($_sIDColumn), 'xWhere' => $_xWhere)))
			{
				$_axSelect = $this->fetchArray(array('oResult' => $_oResult));
			}
			
			if ($_axSelect[$_sIDColumn] == $_xIDValue)
			{
				if ($_axColumnsAndValuesOnUpdate != NULL) {$_axColumnsAndValues = array_merge($_axColumnsAndValues, $_axColumnsAndValuesOnUpdate);}
				return $this->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));
			}
			else
			{
				if ($_axColumnsAndValuesOnInsert != NULL) {$_axColumnsAndValues = array_merge($_axColumnsAndValues, $_axColumnsAndValuesOnInsert);}
				return $this->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));
			}
		}
		else
		{
			if ($_axColumnsAndValuesOnInsert != NULL) {$_axColumnsAndValues = array_merge($_axColumnsAndValues, $_axColumnsAndValuesOnInsert);}
			return $this->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));
		}
		return false;
	}
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
	
	@param xWhere [type]mixed[/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]
	*/
	public function delete(
		$_sTable, 
		$_sIDColumn = NULL, 
		$_xIDValue = NULL, 
		$_xWhere = NULL,
		$_bAllowAnonymDelete = NULL
    )
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		
		if ($_bAllowAnonymDelete === NULL) {$_bAllowAnonymDelete = false;}

		$_sSql = 'DELETE FROM '.$_sTable.' WHERE';
		if (($_sIDColumn != '') && (!empty($_xIDValue))) {$_sSql .= ' '.$_sIDColumn.' = "'.$_xIDValue.'"';}
		if (!empty($_xWhere))
        {
            if (($_sIDColumn != '') && (!empty($_xIDValue))) {$_sSql .= ' AND (';} else {$_sSql .= ' ';}
            $_sSql .= $this->buildWhere(array('xWhere' => $_xWhere));
            if (($_sIDColumn != '') && (!empty($_xIDValue))) {$_sSql .= ')';}
        }
		if ($this->sendSql(array('sStatement' => $_sSql, 'bAllowAnonymDelete' => $_bAllowAnonymDelete))) {return true;}
		return false;
	}
	/* @end method */
	
	// Column Operations...

	// _axColumn[OldName]		// Welche Spalte soll geändert werden?
	// _axColumn[Name]			// Wie soll die Spalte heissen?
	// _axColumn[Type]			// Typ der Spalte z.B. INT oder VARCHAR
	// _axColumn[Size]			// Größe des SpaltenTyps
	// _axColumn[Default]		// Defaultinhalt der Spalte
	// _axColumn[Options]		// ist die Spalte ein PRIMARY KEY oder ein Unique?
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumn [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function changeColumn(
        $_sTable,
        $_axColumn = NULL
    )
	{
		$_axColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumn', 'xParameter' => $_axColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sTable = trim($_sTable);
		if (($_sTable != '') && (trim($_axColumn['OldName']) != '')
		&& (trim($_axColumn['Name']) != '') && (trim($_axColumn['Type']) != ''))
		{
			$_sSql = 'ALTER TABLE '.$_sTable.' CHANGE '.trim($_axColumn['OldName']).' '.trim($_axColumn['Name']).' '.trim($_axColumn['Type']);
			if ($_axColumn['Size'] != 0) {$_sSql .= '('.$_axColumn['Size'].')';}
			if (($_axColumn['Default'] != '') || (($_axColumn['Default'] === 0) && (trim($_axColumn['Options']) == 'NOT NULL')))
			{
				// $_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';
				if (is_string($_axColumn['Default'])) {$_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';}
				else {$_sSql .= ' DEFAULT '.$_axColumn['Default'];}
			}
			if (trim($_axColumn['Options']) != '') {$_sSql .= ' '.trim($_axColumn['Options']);}
			return $this->sendSql(array('sStatement' => $_sSql));
		}
		else {return -1;}
	}
	/* @end method */

	// _axColumn[Name]			// Wie soll die Spalte heissen?
	// _axColumn[Type]			// Typ der Spalte z.B. INT oder VARCHAR
	// _axColumn[Size]			// Größe des SpaltenTyps
	// _axColumn[Default]		// Defaultinhalt der Spalte
	// _axColumn[Options]		// ist die Spalte ein PRIMARY KEY oder ein Unique?
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumn [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function modifyColumn($_sTable, $_axColumn = NULL)
	{
		$_axColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumn', 'xParameter' => $_axColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sTable = trim($_sTable);
		if (($_sTable != '') && (trim($_axColumn['Name']) != '') && (trim($_axColumn['Type']) != ''))
		{
			$_sSql = 'ALTER TABLE '.$_sTable.' MODIFY '.trim($_axColumn['Name']).' '.trim($_axColumn['Type']);
			if ($_axColumn["Size"] > 0) {$_sSql .= "(".$_axColumn["Size"].")";}
			if (($_axColumn['Default'] != "") || (($_axColumn['Default'] === 0) && (trim($_axColumn['Options']) == 'NOT NULL')))
			{
				// $_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';
				if (is_string($_axColumn['Default'])) {$_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';}
				else {$_sSql .= ' DEFAULT '.$_axColumn['Default'];}
			}
			if (trim($_axColumn['Options']) != '') {$_sSql .= ' '.trim($_axColumn['Options']);}
			return $this->sendSql(array('sStatement' => $_sSql));
		}
		else {return -1;}
	}
	/* @end method */
	
	// _axColumn[Name]				// Wie soll die Spalte heissen?
	// _axColumn[Type]				// Typ der Spalte z.B. INT oder VARCHAR
	// _axColumn[Size]				// Größe des SpaltenTyps
	// _axColumn[Default]			// Defaultinhalt der Spalte
	// _axColumn[Options]			// ist die Spalte ein PRIMARY KEY oder ein Unique?
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumn [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function createColumn($_sTable, $_axColumn = NULL)
	{
		$_axColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumn', 'xParameter' => $_axColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sTable = trim($_sTable);
		if (($_sTable != '') && (trim($_axColumn['Name']) != '') && (trim($_axColumn['Type']) != ''))
		{
			$_sSql = 'ALTER TABLE '.$_sTable.' ADD '.trim($_axColumn['Name']).' '.trim($_axColumn['Type']);
			if ($_axColumn['Size'] > 0) {$_sSql .= '('.$_axColumn['Size'].')';}
			if (($_axColumn['Default'] != '') || (($_axColumn['Default'] === 0) && (trim($_axColumn['Options']) == 'NOT NULL')))
			{
				// $_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';
				if (is_string($_axColumn['Default'])) {$_sSql .= ' DEFAULT \''.$_axColumn['Default'].'\'';}
				else {$_sSql .= ' DEFAULT '.$_axColumn['Default'];}
			}
			if (trim($_axColumn['Options']) != '') {$_sSql .= ' '.trim($_axColumn['Options']);}
			return $this->sendSql(array('sStatement' => $_sSql));
		}
		else {return -1;}
	}
	/* @end method */

	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sColumn [needed][type]string[/type]
	[en]...[/en]
	*/
	public function removeColumn($_sTable, $_sColumn = NULL)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_sTable = trim($_sTable);
		$_sColumn = trim($_sColumn);
		if (($_sTable != '') && ($_sColumn != ''))
		{
			return $this->sendSql(array('sStatement' => 'ALTER TABLE '.$_sTable.' DROP '.$_sColumn));
		}
		return -1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iExists [type]int[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sColumn [needed][type]string[/type]
	[en]...[/en]
	*/
	public function columnExists($_sTable, $_sColumn = NULL)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if (!mysql_ping($this->oConnection)) {$this->connect();}
		$_bFound = 0;
		
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true))
		{
			/* todo */
		}
		else
		{
			$_oFields = mysql_list_fields($this->sDatabase, $_sTable, $this->oConnection);
			$_iColumns = mysql_num_fields($_oFields);
		}
		
		for ($i=0; $i < $_iColumns; $i++)
		{
			if (trim($_sColumn) == trim(mysql_field_name($_oFields, $i))) {$_bFound = 1;}
		}
		return $_bFound;
	}
	/* @end method */
	
	// Table Operations...
	/*
	@start method
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sOldName [needed][type]string[/type]
	[en]...[/en]
	
	@param sNewName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function changeTableName($_sOldName, $_sNewName)
	{
		$_sNewName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sNewName', 'xParameter' => $_sNewName));
		$_sOldName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sOldName', 'xParameter' => $_sOldName));

		$_sOldName = trim($_sOldName);
		$_sNewName = trim($_sNewName);
		if (($_sOldName != '') && ($_sNewName != ''))
		{
			return $this->sendSql(array('sStatement' => 'ALTER TABLE '.$_sOldName.' RENAME AS '.trim($_sNewName)));
		}
		return -1;
	}
	/* @end method */

	// Sql Operations...
	/*
	@start method
	
	@return asStatus [type]string[][/type]
	[en]...[/en]
	*/
	public function sqlStatus()
	{
		$this->checkConnection();
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return explode("  ", $this->oConnection->stat());}
		return explode("  ", mysql_stat($this->oConnection));
	}	
	/* @end method */
}
/* @end class */
$oPGMySql = new classPG_MySql();

if (defined('PG_MYSQL_DATA_HOST')) {$oPGMySql->setHost(PG_MYSQL_DATA_HOST);}
if (defined('PG_MYSQL_DATA_USER')) {$oPGMySql->setUser(PG_MYSQL_DATA_USER);}
if (defined('PG_MYSQL_DATA_PASSWORD')) {$oPGMySql->setPassword(PG_MYSQL_DATA_PASSWORD);}
if (defined('PG_MYSQL_DATA_DATABASE')) {$oPGMySql->setDatabaseName(PG_MYSQL_DATA_DATABASE);}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMySql', 'xValue' => $oPGMySql));}
?>