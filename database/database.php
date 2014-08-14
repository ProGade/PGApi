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
define('PG_DATABASE_ENGINE_ALL', 'all');
define('PG_DATABASE_ENGINE_MYSQL', 'mysql');
define('PG_DATABASE_ENGINE_MSSQL', 'mssql');
define('PG_DATABASE_ENGINE_MONGO', 'mongo');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Database extends classPG_ClassBasics
{
	// Declarations...
	private $aoEngine = array();
	private $aoResult = array();
	private $aiInsertID = array();
	
	private $sUseDatabaseEngine = PG_DATABASE_ENGINE_MYSQL;
	
	// Construct...
	public function __construct()
	{
		if (class_exists('classPG_MySql')) {global $oPGMySql; if (isset($oPGMySql)) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL] = $oPGMySql;}}
		if (class_exists('classPG_MsSql')) {global $oPGMsSql; if (isset($oPGMsSql)) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL] = $oPGMsSql;}}
		if (class_exists('classPG_Mongo')) {global $oPGMongo; if (isset($oPGMongo)) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO] = $oPGMongo;}}

		if (defined('PG_DATABASE_HOST')) {$this->setHost(array('sHost' => PG_DATABASE_HOST, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
		if (defined('PG_DATABASE_USER')) {$this->setUser(array('sUser' => PG_DATABASE_USER, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
		if (defined('PG_DATABASE_PASSWORD')) {$this->setPassword(array('sPassword' => PG_DATABASE_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_ALL));}
		if (defined('PG_DATABASE_DATABASE')) {$this->setDatabaseName(array('sDatabase' => PG_DATABASE_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_ALL));}

		if (defined('PG_MYSQL_DATA_HOST')) {$this->setHost(array('sHost' => PG_MYSQL_DATA_HOST, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
		if (defined('PG_MYSQL_DATA_USER')) {$this->setUser(array('sUser' => PG_MYSQL_DATA_USER, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
		if (defined('PG_MYSQL_DATA_PASSWORD')) {$this->setPassword(array('sPassword' => PG_MYSQL_DATA_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}
		if (defined('PG_MYSQL_DATA_DATABASE')) {$this->setDatabaseName(array('sDatabase' => PG_MYSQL_DATA_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MYSQL));}

		if (defined('PG_MSSQL_DATA_HOST')) {$this->setHost(array('sHost' => PG_MSSQL_DATA_HOST, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
		if (defined('PG_MSSQL_DATA_USER')) {$this->setUser(array('sUser' => PG_MSSQL_DATA_USER, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
		if (defined('PG_MSSQL_DATA_PASSWORD')) {$this->setPassword(array('sPassword' => PG_MSSQL_DATA_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}
		if (defined('PG_MSSQL_DATA_DATABASE')) {$this->setDatabaseName(array('sDatabase' => PG_MSSQL_DATA_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MSSQL));}

		if (defined('PG_MONGO_DATA_HOST')) {$this->setHost(array('sHost' => PG_MONGO_DATA_HOST, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
		if (defined('PG_MONGO_DATA_USER')) {$this->setUser(array('sUser' => PG_MONGO_DATA_USER, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
		if (defined('PG_MONGO_DATA_PASSWORD')) {$this->setPassword(array('sPassword' => PG_MONGO_DATA_PASSWORD, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
		if (defined('PG_MONGO_DATA_DATABASE')) {$this->setDatabaseName(array('sDatabase' => PG_MONGO_DATA_DATABASE, 'sEngine' => PG_DATABASE_ENGINE_MONGO));}
	}

	// Methods...	
	/*
	@start method
	
	@param sEngine [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDatabaseEngine($_sEngine)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sEngine, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$this->sUseDatabaseEngine = $_sEngine;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDatabaseEngine [type]string[/type]
	[en]...[/en]
	*/
	public function getDatabaseEngine() {return $this->sUseDatabaseEngine;}
	/* @end method */
	
	/*
	@start method
	
	@param oMySql [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setMySql($_oMySql)
	{
		$_oMySql = $this->getRealParameter(array('oParameters' => $_oMySql, 'sName' => 'oMySql', 'xParameter' => $_oMySql));
		$this->aoEngine[PG_DATABASE_ENGINE_MYSQL] = $_oMySql;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oMySql [type]object[/type]
	[en]...[/en]
	*/
	public function getMySql() {if (isset($this->aoEngine[PG_DATABASE_ENGINE_MYSQL])) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL];} return false;}
	/* @end method */
	
	/*
	@start method
	
	@param oMsSql [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setMsSql($_oMsSql)
	{
		$_oMsSql = $this->getRealParameter(array('oParameters' => $_oMsSql, 'sName' => 'oMsSql', 'xParameter' => $_oMsSql));
		$this->aoEngine[PG_DATABASE_ENGINE_MSSQL] = $_oMsSql;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oMsSql [type]object[/type]
	[en]...[/en]
	*/
	public function getMsSql() {if (isset($this->aoEngine[PG_DATABASE_ENGINE_MSSQL])) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL];} return false;}
	/* @end method */
	
	
	/*
	@start method
	
	@param oMongo [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setMongo($_oMongo)
	{
		$_oMongo = $this->getRealParameter(array('oParameters' => $_oMongo, 'sName' => 'oMongo', 'xParameter' => $_oMongo));
		$this->aoEngine[PG_DATABASE_ENGINE_MONGO] = $_oMongo;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oMongo [type]object[/type]
	[en]...[/en]
	*/
	public function getMongo() {if (isset($this->aoEngine[PG_DATABASE_ENGINE_MONGO])) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO];} return false;}
	/* @end method */

	/*
	@start method
	
	@param sHost [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function setHost($_sHost, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setHost(array('sHost' => $_sHost));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setHost(array('sHost' => $_sHost));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setHost(array('sHost' => $_sHost));}
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setHost(array('sHost' => $_sHost));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setHost(array('sHost' => $_sHost));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setHost(array('sHost' => $_sHost));}
            break;
		}
	}
	/* @end method */

    public function getDatabaseHost()
    {
        return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getHost();
    }

    public function useForceAllRights($_bUse, $_sEngine = NULL)
    {
        $_sEngine = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
        $_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));

        if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

        switch($_sEngine)
        {
            case PG_DATABASE_ENGINE_ALL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->useForceAllRights(array('bUse' => $_bUse));}
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->useForceAllRights(array('bUse' => $_bUse));}
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->useForceAllRights(array('bUse' => $_bUse));}
            break;

            case PG_DATABASE_ENGINE_MSSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->useForceAllRights(array('bUse' => $_bUse));}
            break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->useForceAllRights(array('bUse' => $_bUse));}
            break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->useForceAllRights(array('bUse' => $_bUse));}
            break;
        }
    }
	
	/*
	@start method
	
	@param sUser [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function setUser($_sUser, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sUser, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sUser = $this->getRealParameter(array('oParameters' => $_sUser, 'sName' => 'sUser', 'xParameter' => $_sUser));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setUser(array('sUser' => $_sUser));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setUser(array('sUser' => $_sUser));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setUser(array('sUser' => $_sUser));}
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setUser(array('sUser' => $_sUser));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setUser(array('sUser' => $_sUser));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setUser(array('sUser' => $_sUser));}
            break;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sPassword [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function setPassword($_sPassword, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setPassword(array('sPassword' => $_sPassword));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setPassword(array('sPassword' => $_sPassword));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setPassword(array('sPassword' => $_sPassword));}
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setPassword(array('sPassword' => $_sPassword));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setPassword(array('sPassword' => $_sPassword));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setPassword(array('sPassword' => $_sPassword));}
            break;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDatabase [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function setDatabaseName($_sDatabase, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sDatabase = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setDatabaseName(array('sDatabase' => $_sDatabase));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setDatabaseName(array('sDatabase' => $_sDatabase));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setDatabaseName(array('sDatabase' => $_sDatabase));}
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->setDatabaseName(array('sDatabase' => $_sDatabase));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->setDatabaseName(array('sDatabase' => $_sDatabase));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->setDatabaseName(array('sDatabase' => $_sDatabase));}
            break;
		}
	}
	/* @end method */

    public function getDatabaseName() {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getDatabaseName();}
	
	/*
	@start method
	
	@return xConnection [type]object mixed[][/type]
	[en]...[/en]
	
	@param sHost [needed][type]string[/type]
	[en]...[/en]
	
	@param sUser [needed][type]string[/type]
	[en]...[/en]
	
	@param sPassword [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function connect($_sHost = NULL, $_sUser = NULL, $_sPassword = NULL, $_sEngine = NULL)
	{
		$_sUser = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
				return true;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword));}
            break;
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function disconnect($_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sEngine, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->disconnect();}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->disconnect();}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->disconnect();}
				return true;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->disconnect();}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->disconnect();}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->disconnect();}
            break;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sDatabase [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function changeDatabase($_sDatabase = NULL, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sDatabase = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->changeDatabase(array('sDatabase' => $_sDatabase));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->changeDatabase(array('sDatabase' => $_sDatabase));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$this->aoEngine[PG_DATABASE_ENGINE_MONGO]->changeDatabase(array('sDatabase' => $_sDatabase));}
				return true;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->changeDatabase(array('sDatabase' => $_sDatabase));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->changeDatabase(array('sDatabase' => $_sDatabase));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->changeDatabase(array('sDatabase' => $_sDatabase));}
            break;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oResult [type]object[/type]
	[en]...[/en]
	
	@param xStatement [needed][type]string mixed[][/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function sendSql(
		$_xStatement, 
		$_bAllowInfoSchema = NULL, 
		$_bAllowUnion = NULL, 
		$_bAllowVersion = NULL, 
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL,
		$_bAllowAnonymDelete = NULL,
        $_bAllowAnonymChangeStructure = NULL,
		$_sEngine = NULL)
	{
		$_bAllowInfoSchema = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowInfoSchema', 'xParameter' => $_bAllowInfoSchema));
		$_bAllowUnion = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowUnion', 'xParameter' => $_bAllowUnion));
		$_bAllowVersion = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowVersion', 'xParameter' => $_bAllowVersion));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_bAllowAnonymChangeStructure = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymChangeStructure', 'xParameter' => $_bAllowAnonymChangeStructure));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xStatement = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'xStatement', 'xParameter' => $_xStatement, 'bNotNull' => true));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		return $this->sendQuery(
			array(
				'xStatement' => $_xStatement, 
				'bAllowInfoSchema' => $_bAllowInfoSchema, 
				'bAllowUnion' => $_bAllowUnion, 
				'bAllowVersion' => $_bAllowVersion, 
				'bAllowAnonymInsert' => $_bAllowAnonymInsert,
				'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
				'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure,
				'sEngine' => $_sEngine
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@return oResult [type]object object[][/type]
	[en]...[/en]
	
	@param xStatement [needed][type]mixed[/type]
	[en]...[/en]

	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]

	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function sendQuery(
		$_xStatement, 
		$_bAllowInfoSchema = NULL, 
		$_bAllowUnion = NULL, 
		$_bAllowVersion = NULL, 
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL,
		$_bAllowAnonymDelete = NULL,
        $_bAllowAnonymChangeStructure = NULL,
		$_sEngine = NULL)
	{
		$_bAllowInfoSchema = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowInfoSchema', 'xParameter' => $_bAllowInfoSchema));
		$_bAllowUnion = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowUnion', 'xParameter' => $_bAllowUnion));
		$_bAllowVersion = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowVersion', 'xParameter' => $_bAllowVersion));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_bAllowAnonymChangeStructure = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'bAllowAnonymChangeStructure', 'xParameter' => $_bAllowAnonymChangeStructure));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xStatement = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'xStatement', 'xParameter' => $_xStatement, 'bNotNull' => true));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		$_sMsSqlQuery = '';
		$_sMySqlQuery = '';
		if (is_array($_xStatement))
		{
			if ((isset($_xStatement[PG_DATABASE_ENGINE_MSSQL])) && ($_xStatement[PG_DATABASE_ENGINE_MSSQL] != '')) {$_sMsSqlQuery = $_xStatement[PG_DATABASE_ENGINE_MSSQL];}
			if ((isset($_xStatement[PG_DATABASE_ENGINE_MYSQL])) && ($_xStatement[PG_DATABASE_ENGINE_MYSQL] != '')) {$_sMySqlQuery = $_xStatement[PG_DATABASE_ENGINE_MYSQL];}
		}
		else
		{
			$_sMsSqlQuery = $_xStatement;
			$_sMySqlQuery = $_xStatement;
		}
		
		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_aoRes[PG_DATABASE_ENGINE_MYSQL] = null;
				$_aoRes[PG_DATABASE_ENGINE_MSSQL] = null;
				if (($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) && ($_sMsSqlQuery != ''))
				{
					$_aoRes[PG_DATABASE_ENGINE_MSSQL] = $this->aoResult[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->sendSql(
						array(
							'sStatement' => $_sMsSqlQuery, 
							'bAllowInfoSchema' => $_bAllowInfoSchema, 
							'bAllowUnion' => $_bAllowUnion, 
							'bAllowVersion' => $_bAllowVersion,
							'bAllowAnonymInsert' => $_bAllowAnonymInsert,
							'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
							'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                            'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure
						)
					);
				}
				if (($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) && ($_sMySqlQuery != ''))
				{
					$_aoRes[PG_DATABASE_ENGINE_MYSQL] = $this->aoResult[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->sendSql(
						array(
							'sStatement' => $_sMySqlQuery, 
							'bAllowInfoSchema' => $_bAllowInfoSchema, 
							'bAllowUnion' => $_bAllowUnion, 
							'bAllowVersion' => $_bAllowVersion,
							'bAllowAnonymInsert' => $_bAllowAnonymInsert,
							'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
							'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                            'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure
						)
					);
				}
				return $_aoRes;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if (($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) && ($_sMsSqlQuery != ''))
				{
					return $this->aoResult[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->sendSql(
						array(
							'sStatement' => $_sMsSqlQuery, 
							'bAllowInfoSchema' => $_bAllowInfoSchema, 
							'bAllowUnion' => $_bAllowUnion,
							'bAllowVersion' => $_bAllowVersion,
							'bAllowAnonymInsert' => $_bAllowAnonymInsert,
							'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
							'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                            'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure
						)
					);
				}
			break;
			
			case PG_DATABASE_ENGINE_MYSQL:
				if (($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) && ($_sMySqlQuery != ''))
				{
					return $this->aoResult[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->sendSql(
						array(
							'sStatement' => $_sMySqlQuery, 
							'bAllowInfoSchema' => $_bAllowInfoSchema, 
							'bAllowUnion' => $_bAllowUnion, 
							'bAllowVersion' => $_bAllowVersion,
							'bAllowAnonymInsert' => $_bAllowAnonymInsert,
							'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
							'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                            'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure
						)
					);
				}
			break;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xEscapedString [type]mixed[/type]
	[en]...[/en]
	
	@param xString [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function realEscapeString($_xString, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_xString, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xString = $this->getRealParameter(array('oParameters' => $_xString, 'sName' => 'xString', 'xParameter' => $_xString, 'bNotNull' => true));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axData[PG_DATABASE_ENGINE_MYSQL] = array();
				$_axData[PG_DATABASE_ENGINE_MSSQL] = array();
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axData[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->realEscapeString(array('xString' => $_xString));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axData[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->realEscapeString(array('xString' => $_xString));}
				return $_axData;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->realEscapeString(array('xString' => $_xString));}
			break;
			
			case PG_DATABASE_ENGINE_MYSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->realEscapeString(array('xString' => $_xString));}
			break;
		}
		return $_xString;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iRowCount [type]int[/type]
	[en]...[/en]
	
	@param xResult [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function getRowCount($_xResult = NULL, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_xResult, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xResult = $this->getRealParameter(array('oParameters' => $_xResult, 'sName' => 'xResult', 'xParameter' => $_xResult, 'bNotNull' => true));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		
		$_sMsSqlResult = '';
		$_sMySqlResult = '';
		$_sMongoResult = '';
		if (is_array($_xResult))
		{
			if ((isset($_xResult[PG_DATABASE_ENGINE_MSSQL])) && ($_xResult[PG_DATABASE_ENGINE_MSSQL] != '')) {$_sMsSqlResult = $_xResult[PG_DATABASE_ENGINE_MSSQL];}
			if ((isset($_xResult[PG_DATABASE_ENGINE_MYSQL])) && ($_xResult[PG_DATABASE_ENGINE_MYSQL] != '')) {$_sMySqlResult = $_xResult[PG_DATABASE_ENGINE_MYSQL];}
			if ((isset($_xResult[PG_DATABASE_ENGINE_MONGO])) && ($_xResult[PG_DATABASE_ENGINE_MONGO] != '')) {$_sMongoResult = $_xResult[PG_DATABASE_ENGINE_MONGO];}
		}
		else
		{
			$_sMsSqlResult = $_xResult;
			$_sMySqlResult = $_xResult;
            $_sMongoResult = $_xResult;
		}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axData[PG_DATABASE_ENGINE_MYSQL] = array();
				$_axData[PG_DATABASE_ENGINE_MSSQL] = array();
				$_axData[PG_DATABASE_ENGINE_MONGO] = array();
				if ($_sMsSqlResult) {$_axData[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->getRowCount(array('oResult' => $_sMsSqlResult));}
				if ($_sMySqlResult) {$_axData[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->getRowCount(array('oResult' => $_sMySqlResult));}
				if ($_sMongoResult) {$_axData[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getRowCount(array('oResult' => $_sMongoResult));}
				return $_axData;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($_sMsSqlResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->getRowCount(array('oResult' => $_sMsSqlResult));}
			break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($_sMongoResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getRowCount(array('oResult' => $_sMongoResult));}
            break;

			case PG_DATABASE_ENGINE_MYSQL:
				if ($_sMySqlResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->getRowCount(array('oResult' => $_sMySqlResult));}
			break;
		}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axArray [type]mixed[][/type]
	[en]...[/en]
	
	@param xResult [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function fetchArray($_xResult = NULL, $_sEngine = NULL)
	{
		$_sEngine = $this->getRealParameter(array('oParameters' => $_xResult, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xResult = $this->getRealParameter(array('oParameters' => $_xResult, 'sName' => 'xResult', 'xParameter' => $_xResult, 'bNotNull' => true));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		
		$_oMsSqlResult = NULL;
		$_oMySqlResult = NULL;
		$_oMongoResult = NULL;
		if (is_array($_xResult))
		{
			if ((isset($_xResult[PG_DATABASE_ENGINE_MSSQL])) && ($_xResult[PG_DATABASE_ENGINE_MSSQL] != '')) {$_oMsSqlResult = $_xResult[PG_DATABASE_ENGINE_MSSQL];}
			if ((isset($_xResult[PG_DATABASE_ENGINE_MYSQL])) && ($_xResult[PG_DATABASE_ENGINE_MYSQL] != '')) {$_oMySqlResult = $_xResult[PG_DATABASE_ENGINE_MYSQL];}
			if ((isset($_xResult[PG_DATABASE_ENGINE_MONGO])) && ($_xResult[PG_DATABASE_ENGINE_MONGO] != '')) {$_oMongoResult = $_xResult[PG_DATABASE_ENGINE_MONGO];}
		}
		else
		{
			$_oMsSqlResult = $_xResult;
			$_oMySqlResult = $_xResult;
			$_oMongoResult = $_xResult;
		}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axData[PG_DATABASE_ENGINE_MYSQL] = array();
				$_axData[PG_DATABASE_ENGINE_MSSQL] = array();
				$_axData[PG_DATABASE_ENGINE_MONGO] = array();
				if ($_oMsSqlResult) {$_axData[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->fetchArray(array('oResult' => $_oMsSqlResult));}
				if ($_oMySqlResult) {$_axData[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->fetchArray(array('oResult' => $_oMySqlResult));}
				if ($_oMongoResult) {$_axData[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->fetchArray(array('oResult' => $_oMongoResult));}
				return $_axData;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($_oMsSqlResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->fetchArray(array('oResult' => $_oMsSqlResult));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($_oMongoResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->fetchArray(array('oResult' => $_oMongoResult));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($_oMySqlResult) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->fetchArray(array('oResult' => $_oMySqlResult));}
            break;
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xResult [type]mixed[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param asColumns [type]string[/type]
	[en]...[/en]
	
	@param xWhere [type]string[/type]
	[en]...[/en]
	
	@param iStart [type]int[/type]
	[en]...[/en]
	
	@param iCount [type]int[/type]
	[en]...[/en]
	
	@param sOrderBy [type]string[/type]
	[en]...[/en]
	
	@param bOrderReverse [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function select($_sTable, $_asColumns = NULL, $_xWhere = NULL, $_iStart = NULL, $_iCount = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL, $_sEngine = NULL)
	{
		$_asColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asColumns', 'xParameter' => $_asColumns));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_iStart = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iStart', 'xParameter' => $_iStart));
		$_iCount = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$_sOrderBy = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_aoRes[PG_DATABASE_ENGINE_MYSQL] = null;
				$_aoRes[PG_DATABASE_ENGINE_MSSQL] = null;
				$_aoRes[PG_DATABASE_ENGINE_MONGO] = null;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_aoRes[PG_DATABASE_ENGINE_MSSQL] = $this->aoResult[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_aoRes[PG_DATABASE_ENGINE_MYSQL] = $this->aoResult[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_aoRes[PG_DATABASE_ENGINE_MONGO] = $this->aoResult[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
				return $_aoRes;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoResult[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
			break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoResult[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
            break;

			case PG_DATABASE_ENGINE_MYSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoResult[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse));}
			break;
		}
		
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@return iInsertID [type]int int[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [needed][type]mixed[][/type]
	[en]...[/en]

	@param sAutoIDColumn [type]string[/type]
	[en]...[/en]
	
	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function insert($_sTable, $_axColumnsAndValues = NULL, $_sAutoIDColumn = NULL, $_bStripSlashes = NULL, $_bAllowAnonymInsert = NULL, $_sEngine = NULL)
	{
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
        $_sAutoIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_aiInsertID[PG_DATABASE_ENGINE_MYSQL] = 0;
				$_aiInsertID[PG_DATABASE_ENGINE_MSSQL] = 0;
				$_aiInsertID[PG_DATABASE_ENGINE_MONGO] = 0;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_aiInsertID[PG_DATABASE_ENGINE_MSSQL] = $this->aiInsertID[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_aiInsertID[PG_DATABASE_ENGINE_MYSQL] = $this->aiInsertID[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_aiInsertID[PG_DATABASE_ENGINE_MONGO] = $this->aiInsertID[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'sAutoIDColumn' => $_sAutoIDColumn, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
				return $_aiInsertID;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'sAutoIDColumn' => $_sAutoIDColumn, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
            break;
		}
		
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool bool[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axColumnsAndValues [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param xWhere [type]string[/type]
	[en]...[/en]
	
	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function update($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_xWhere = NULL, $_bStripSlashes = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_abSuccess[PG_DATABASE_ENGINE_MYSQL] = false;
				$_abSuccess[PG_DATABASE_ENGINE_MSSQL] = false;
				$_abSuccess[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_abSuccess[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_abSuccess[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_abSuccess[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				return $_abSuccess;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
            break;
		}
		
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iInsertID [type]int int[][/type]
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

	@param sAutoIDColumn [type]string[/type]
	[en]...[/en]

	@param xWhere [type]string[/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymUpdate [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function save($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_axColumnsAndValuesOnInsert = NULL, $_axColumnsAndValuesOnUpdate = NULL, $_sAutoIDColumn = NULL, $_xWhere = NULL, $_bAllowAnonymInsert = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
        $_sAutoIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axReturn[PG_DATABASE_ENGINE_MYSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MSSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axReturn[PG_DATABASE_ENGINE_MSSQL] = $this->aiInsertID[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axReturn[PG_DATABASE_ENGINE_MYSQL] = $this->aiInsertID[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aiInsertID[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'sAutoIDColumn' => $_sAutoIDColumn, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
				return $_axReturn;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'sAutoIDColumn' => $_sAutoIDColumn, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aiInsertID[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
            break;
		}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool bool[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sIDColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param xIDValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xWhere [type]string[/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function delete($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_xWhere = NULL, $_bAllowAnonymDelete = NULL, $_sEngine = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axReturn[PG_DATABASE_ENGINE_MYSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MSSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axReturn[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axReturn[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
				return $_axReturn;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
            break;
		}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axColumnInfo [type]mixed[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function getColumnInfos($_sTable, $_sColumn = NULL, $_sEngine = NULL)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		
		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axReturn[PG_DATABASE_ENGINE_MYSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MSSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axReturn[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axReturn[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				return $_axReturn;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
            break;
		}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool bool[][/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param sColumn [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function removeColumn($_sTable, $_sColumn = NULL, $_sEngine = NULL)
	{
		$_sColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		
		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axReturn[PG_DATABASE_ENGINE_MYSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MSSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axReturn[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axReturn[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
				return $_axReturn;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn));}
            break;
		}
		
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool bool[][/type]
	[en]...[/en]
	
	@param sOldName [needed][type]string[/type]
	[en]...[/en]
	
	@param sNewName [needed][type]string[/type]
	[en]...[/en]
	
	@param sEngine [type]string[/type]
	[en]...[/en]
	*/
	public function changeTableName($_sOldName, $_sNewName = NULL, $_sEngine = NULL)
	{
		$_sNewName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sNewName', 'xParameter' => $_sNewName));
		$_sEngine = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sOldName = $this->getRealParameter(array('oParameters' => $_sOldName, 'sName' => 'sOldName', 'xParameter' => $_sOldName));

		if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}
		
		switch($_sEngine)
		{
			case PG_DATABASE_ENGINE_ALL:
				$_axReturn[PG_DATABASE_ENGINE_MYSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MSSQL] = false;
				$_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {$_axReturn[PG_DATABASE_ENGINE_MSSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {$_axReturn[PG_DATABASE_ENGINE_MYSQL] = $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
				return $_axReturn;
			break;
			
			case PG_DATABASE_ENGINE_MSSQL:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MSSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MSSQL]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
			break;

			case PG_DATABASE_ENGINE_MONGO:
				if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
			break;

            case PG_DATABASE_ENGINE_MYSQL:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MYSQL]) {return $this->aoEngine[PG_DATABASE_ENGINE_MYSQL]->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName));}
            break;
		}
		
		return NULL;
	}
	/* @end method */

    /*
    @start method
    */
    public function selectFiles($_xFileID = NULL, $_asMetadata = NULL, $_xWhere = NULL, $_sEngine = NULL)
    {
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
        $_asMetadata = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'asMetadata', 'xParameter' => $_asMetadata));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));
        return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->selectFiles(array('xFileID' => $_xFileID, 'asMetadata' => $_asMetadata, 'xWhere' => $_xWhere));
    }
    /* @end method */

    /*
    @start method
    */
    public function getFileBytes($_xFile)
    {
        $_xFile = $this->getRealParameter(array('oParameters' => $_xFile, 'sName' => 'xFile', 'xParameter' => $_xFile));
        return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->getFileBytes(array('xFile' => $_xFile));
    }
    /* @end method */

    /*
    @start method
    */
    public function insertFile($_sFile, $_axMetadata = NULL, $_bAllowAnonymInsert = NULL, $_sEngine = NULL)
    {
        $_axMetadata = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
        $_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

        if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

        switch($_sEngine)
        {
            case PG_DATABASE_ENGINE_ALL:
                $_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->insertFile(array('sFile' => $_sFile, 'axMetadata' => $_axMetadata, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
                return $_axReturn;
            break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->insertFile(array('sFile' => $_sFile, 'axMetadata' => $_axMetadata, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));}
            break;
        }
        return NULL;
    }
    /* @end method */

    /*
    @start method
    */
    public function updateFile($_xFileID, $_axMetadata = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
    {
        $_axMetadata = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));

        if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

        switch($_sEngine)
        {
            case PG_DATABASE_ENGINE_ALL:
                $_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->updateFile(array('xFileID' => $_xFileID, 'axMetadata' => $_axMetadata, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
                return $_axReturn;
                break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->updateFile(array('xFileID' => $_xFileID, 'axMetadata' => $_axMetadata, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate));}
                break;
        }
        return NULL;
    }
    /* @end method */

    /*
    @start method
    */
    public function deleteFile($_xFileID, $_bAllowAnonymDelete = NULL, $_sEngine = NULL)
    {
        $_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));

        if ($_sEngine === NULL) {$_sEngine = $this->sUseDatabaseEngine;}

        switch($_sEngine)
        {
            case PG_DATABASE_ENGINE_ALL:
                $_axReturn[PG_DATABASE_ENGINE_MONGO] = false;
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {$_axReturn[PG_DATABASE_ENGINE_MONGO] = $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->deleteFile(array('xFileID' => $_xFileID, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
                return $_axReturn;
                break;

            case PG_DATABASE_ENGINE_MONGO:
                if ($this->aoEngine[PG_DATABASE_ENGINE_MONGO]) {return $this->aoEngine[PG_DATABASE_ENGINE_MONGO]->deleteFile(array('xFileID' => $_xFileID, 'bAllowAnonymDelete' => $_bAllowAnonymDelete));}
                break;
        }
        return NULL;
    }
    /* @end method */
}
/* @end class */
$oPGDatabase = new classPG_Database();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDatabase', 'xValue' => $oPGDatabase));}
?>