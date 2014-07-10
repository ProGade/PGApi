<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Mongo extends classPG_ClassBasics
{
	// Declarations...
	private $sHost = 'localhost';
	private $sUser = 'root';
	private $sPassword = '';
	private $sDatabase = '';
	private $oClient = NULL;
	private $oConnection = NULL;

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

		if (extension_loaded('mongo'))
		{
			try
			{
				// if ($this->oClient = new MongoClient('mongodb://{'.$_sUser.'}:{'.$_sPassword.'}@{'.$_sHost.'}'))
				if ($this->oClient = new MongoClient('mongodb://'.$this->sUser.':'.$this->sPassword.'@'.$this->sHost))
				{
					if ($this->sDatabase != NULL) {$this->oConnection = $this->oClient->{$this->sDatabase};}
				}
			}
			catch(MongoConnectionException $_oError)
			{
				die('Error: '.$_oError->getMessage().'<br />mongodb://'.$this->sUser.':***@'.$this->sHost);
			}
			catch(MongoException $_oError)
			{
				die('Error: '.$_oError->getMessage().'<br />mongodb://'.$this->sUser.':***@'.$this->sHost);
			}
			return $this->oConnection;
		}
		return NULL;
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
        $_bSuccess = $this->oClient->close($this->oConnection);
        $this->oConnection = NULL;
        return $_bSuccess;
    }
    /* @end method */

    /*
    @start method

    @param sDatabase [type]string[/type]
    [en]...[/en]
    */
    public function changeDatabase($_sDatabase = NULL)
    {
        $_sDatabase = $this->getRealParameter(array('oParameters' => $_sDatabase, 'sName' => 'sDatabase', 'xParameter' => $_sDatabase));

        if ($_sDatabase != NULL) {$this->sDatabase = $_sDatabase;}
        if ($_sDatabase != NULL) {$this->oConnection = $this->oClient->$this->sDatabase;}
    }
    /* @end method */

    /* @start method */
    public function checkConnection()
    {
        $this->connect();
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
		/*$_oConnection = $this->getRealParameter(array('oParameters' => $_oConnection, 'sName' => 'oConnection', 'xParameter' => $_oConnection));
		if ($_oConnection === NULL) {$_oConnection = $this->oConnection;}
		if ((extension_loaded('mysqli')) && ($this->bUseMySqli == true)) {return $_oConnection->insert_id;}
		return mysql_insert_id($_oConnection);*/
		// TODO
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
		return $_oResult->count();
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
		return $_oResult->getNext();
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

        $_axWhere = array();

        if (empty($_xWhere)) {return NULL;}

        foreach ($_xWhere as $_sName => $_xValue)
        {
            if (is_array($_xValue))
            {
                switch(strtolower($_sName))
                {
                    // logical...
                    case 'or':
                    case '||':
                    case '|':
                        $_axOrExpressions = array();
                        for ($i=0; $i<count($_xValue); $i++) {$_axOrExpressions[] = $this->buildWhere(array('xWhere' => $_xValue[$i]));}
                        $_axExpression = array('$or' => $_axOrExpressions);
                    break;

                    case 'and':
                    case '&&':
                    case '&':
                        $_axAndExpressions = array();
                        for ($i=0; $i<count($_xValue); $i++) {$_axAndExpressions[] = $this->buildWhere(array('xWhere' => $_xValue[$i]));}
                        $_axExpression = array('$and' => $_axAndExpressions);
                    break;

                    case 'not':
                    case '!':
                        $_axNotExpressions = array();
                        for ($i=0; $i<count($_xValue); $i++) {$_axNotExpressions[] = $this->buildWhere(array('xWhere' => $_xValue[$i]));}
                        $_axExpression = array('$not' => $_axNotExpressions);
                    break;

                    // TODO: $nor

                    default:
                        $_axExpression = NULL;
                        foreach($_xValue as $_sOperator => $_xValue2)
                        {
                            switch(strtolower($_sOperator))
                            {
                                // comparsion...
                                case '==':
                                case '=':
                                    $_axExpression[$_sName] = $_xValue2;
                                break;

                                case 'not':
                                    $_axExpression[$_sName] = array('$not' => $_xValue2);
                                break;

                                case '!=':
                                    $_axExpression[$_sName] = array('$ne' => $_xValue2);
                                break;

                                case '>':
                                    $_axExpression[$_sName] = array('$gt' => $_xValue2);
                                break;

                                case '>=':
                                    $_axExpression[$_sName] = array('$gte' => $_xValue2);
                                break;

                                case '<':
                                    $_axExpression[$_sName] = array('$lt' => $_xValue2);
                                break;

                                case '<=':
                                    $_axExpression[$_sName] = array('$lte' => $_xValue2);
                                break;

                                case 'in':
                                    $_axExpression[$_sName] = array('$in' => $_xValue2);
                                break;

                                case 'not in':
                                    $_axExpression[$_sName] = array('$nin' => $_xValue2);
                                break;

                                case 'like':
                                    $_axExpression[$_sName] = array('$regex' => $_xValue2, '$options' => 'im');
                                break;

                                case 'regexp':
                                    $_axExpression[$_sName] = array('$regex' => $_xValue2, '$options' => 'im');
                                break;

                                case 'length':
                                case 'size':
                                    $_axExpression[$_sName] = array('$size' => $_xValue2);
                                break;

                                case 'exists':
                                    $_axExpression[$_sName] = array('$exists' => $_xValue2);
                                break;
                            }

                        }
                    break;
                }
                if ($_axExpression != NULL) {$_axWhere = array_merge($_axWhere, $_axExpression);}
            }
            else
            {
                $_axWhere[$_sName] = $_xValue;
            }
        }

        return $_axWhere;
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
	
	@param xWhere [type]mixed[][/type]
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
	public function select(
		$_sTable, 
		$_asColumns = NULL, 
		$_xWhere = NULL,
		$_iStart = NULL, 
		$_iCount = NULL, 
		$_sOrderBy = NULL, 
		$_bOrderReverse = NULL)
	{
		$_asColumns = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'asColumns', 'xParameter' => $_asColumns));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_iStart = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iStart', 'xParameter' => $_iStart));
		$_iCount = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$_sOrderBy = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

        $this->checkConnection();

        $_xWhere = $this->buildWhere(array('xWhere' => $_xWhere));

		$_oResult = NULL;
        if ($_xWhere === NULL) {$_oResult = $this->oConnection->$_sTable->find();}
        else if ($_asColumns === NULL) {$_oResult = $this->oConnection->$_sTable->find($_xWhere);}
        else {$_oResult = $this->oConnection->$_sTable->find($_xWhere);} // TODO: , $_asColumns);}

        if ($_oResult)
        {
            if ($_sOrderBy != NULL)
            {
                $_iOrderReverse = 1;
                if ($_bOrderReverse == true) {$_iOrderReverse = -1;}
                $_oResult = $_oResult->sort(array($_sOrderBy => $_iOrderReverse));
            }

            if ($_iStart !== NULL) {$_oResult->skip($_iStart);}
            if ($_iCount !== NULL) {$_oResult->limit($_iCount);}
        }

		return $_oResult;
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
	
	@param sAutoIDColumn [type]string[/type]
	[en]...[/en]

	@param bStripSlashes [type]bool[/type]
	[en]...[/en]
	
	@param bAllowAnonymInsert [type]bool[/type]
	[en]...[/en]
	*/
	public function insert(
		$_sTable,
		$_axColumnsAndValues = NULL,
        $_sAutoIDColumn = NULL,
		$_bStripSlashes = NULL,
		$_bAllowAnonymInsert = NULL)
	{
        global $oPGLogin;

		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
        $_sAutoIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		
		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_bAllowAnonymInsert === NULL) {$_bAllowAnonymInsert = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymInsert = true;}
        }

		if ($_bAllowAnonymInsert != true) {return false;}

        $this->checkConnection();

		$i=0;
		foreach ($_axColumnsAndValues as $_sColumn => $_xValue)
		{
			if (is_string($_xValue))
			{
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				/*foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearchFor != '') {$_xVale = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}*/
			}
			$i++;
		}
        if ($_sAutoIDColumn != NULL) {$_axColumnsAndValues[$_sAutoIDColumn] = new MongoId();}

        try
        {
            if (
                $_oResult = $this->oConnection->$_sTable->insert($_axColumnsAndValues)
            )
            {
                if (!empty($_oResult['ok']))
                {
                    if ((int)$_oResult['ok'] == 1)
                    {
                        if ($_sAutoIDColumn != NULL) {return $_axColumnsAndValues[$_sAutoIDColumn];}
                        return true;
                    }
                }
            }
        }
        catch(MongoResultException $_oError)
        {
            die('Error: '.$_oError->getMessage());
        }
        catch(MongoException $_oError)
        {
            die('Error: '.$_oError->getMessage());
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
	
	@param xWhere [type]mixed[][/type]
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
        global $oPGLogin;

		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bStripSlashes = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($_bAllowAnonymUpdate === NULL) {$_bAllowAnonymUpdate = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymUpdate = true;}
        }

        if ($_bAllowAnonymUpdate != true) {return false;}

        $this->checkConnection();

		foreach ($_axColumnsAndValues as $_sColumn => $_xValue)
		{
			if (is_string($_xValue))
			{
				if ($_bStripSlashes == true) {$_xValue = stripslashes($_xValue);}
				/*foreach ($this->asReplaceOnWrite as $_sSearchFor => $_sReplaceWith)
				{
					if ($_sSearchFor != '') {$_xVale = str_replace($_sSearchFor, $_sReplaceWith, $_xValue);}
				}*/
			}
		}

        if ($_sIDColumn != NULL) {$_xWhere[$_sIDColumn] = $_xIDValue;}
        $_xWhere = $this->buildWhere(array('xWhere' => $_xWhere));

        // Check for Mongo Update Operators...
        $_bHasOperators = false;
        $_asMongoUpdateOperators = array(
            '$inc', '$mul', '$rename', '$setOnInsert', '$set', '$unset', '$min', '$max', '$currentDate'
        );
        for ($i=0; $i<count($_asMongoUpdateOperators); $i++)
        {
            if (array_key_exists($_asMongoUpdateOperators[$i], $_axColumnsAndValues)) {$_bHasOperators = true;}
        }
        if ($_bHasOperators == false)
        {
            $_axColumnsAndValues = array('$set' => $_axColumnsAndValues);
        }

		if ($_oResult = $this->oConnection->$_sTable->update($_xWhere, $_axColumnsAndValues, array('upsert' => true)))
		{
			if (!empty($_oResult['ok'])) {if ((int)$_oResult['ok'] == 1) {return (!empty($_xIDValue) ? $_xIDValue : true);}}
		}
		
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

	@param sAutoIDColumn [type]string[/type]
	[en]...[/en]

	@param xWhere [type]mixed[][/type]
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
        $_sAutoIDColumn = NULL,
		$_xWhere = NULL,
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
        $_sAutoIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
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
                'sAutoIDColumn' => $_sAutoIDColumn,
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

	@param sAutoIDColumn [type]string[/type]
	[en]...[/en]

	@param xWhere [type]mixed[][/type]
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
        $_sAutoIDColumn = NULL,
		$_xWhere = NULL,
		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL)
	{
		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
        $_sAutoIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		if ((trim($_sIDColumn) != '') && ($_sIDColumn != NULL) && ($_xIDValue != NULL))
		{
			// if (is_string($_xIDValue)) {$_xIDValue = $this->realEscapeString(array('xString' => $_xIDValue, 'oConnection' => $this->oConnection));}
			// if (trim($_sWhere) != '') {$_sWhere .= ' AND ('.$_sIDColumn.' = "'.$_xIDValue.'")';}
			// else {$_sWhere .= $_sIDColumn.' = "'.$_xIDValue.'"';}
			if ($_xWhere != NULL) {$_xWhere[$_sIDColumn] = $_xIDValue;}
			else {$_xWhere = array($_sIDColumn => $_xIDValue);}
			
			// $_asColumns = array_keys($_axColumnsAndValues);
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
				return $this->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'sAutoIDColumn' => $_sAutoIDColumn, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));
			}
		}
		else
		{
			if ($_axColumnsAndValuesOnInsert != NULL) {$_axColumnsAndValues = array_merge($_axColumnsAndValues, $_axColumnsAndValuesOnInsert);}
			return $this->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'sAutoIDColumn' => $_sAutoIDColumn, 'bAllowAnonymInsert' => $_bAllowAnonymInsert));
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
	
	@param xWhere [type]mixed[][/type]
	[en]...[/en]
	
	@param bAllowAnonymDelete [type]bool[/type]
	[en]...[/en]
	*/
	public function delete(
		$_sTable, 
		$_sIDColumn = NULL, 
		$_xIDValue = NULL, 
		$_xWhere = NULL,
		$_bAllowAnonymDelete = NULL)
	{
        global $oPGLogin;

		$_sIDColumn = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_xWhere = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		
		if ($_bAllowAnonymDelete === NULL) {$_bAllowAnonymDelete = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymDelete = true;}
        }

        if ($_bAllowAnonymDelete == false) {return false;}

        $this->checkConnection();

        if ((!empty($_sIDColumn)) && (!empty($_xIDValue)))
        {
            if (empty($_xWhere)) {$_xWhere = array($_sIDColumn => $_xIDValue);}
            else
            {
                $_xWhere['AND'] = array(
                    $_xWhere,
                    array($_sIDColumn => $_xIDValue)
                );
            }
        }

        $_xWhere = $this->buildWhere(array('xWhere' => $_xWhere));

		if ($_oResult = $this->oConnection->$_sTable->remove($_xWhere))
		{
			if (!empty($_oResult['ok'])) {if ((int)$_oResult['ok'] == 1) {return true;}}
		}
		return false;
	}
	/* @end method */

    // FILES...
    /*
    @start method
    */
    public function selectFiles(
        $_xFileID = NULL,
        $_asMetadata = NULL,
        $_xWhere = NULL,
        $_sOrderBy = NULL,
        $_bOrderReverse = NULL,
        $_iStart = NULL,
        $_iCount = NULL)
    {
        $_asMetadata = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'asMetadata', 'xParameter' => $_asMetadata));
        $_xWhere = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xWhere', 'xParameter' => $_xWhere));
        $_iStart = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'iStart', 'xParameter' => $_iStart));
        $_iCount = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'iCount', 'xParameter' => $_iCount));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));

        $this->checkConnection();

        $_xWhere = $this->buildWhere(array('xWhere' => $_xWhere));

        if ($_oGridFs = $this->oConnection->getGridFS())
        {
            $_oResult = NULL;

            try
            {
                if ($_xFileID !== NULL)
                {
                    if ($_xWhere != NULL)
                    {
                        $_xWhere = array(
                            'AND' => array(
                                array($_xWhere),
                                array('_id' => $_xFileID)
                            )
                        );
                    }
                    else {$_xWhere = array('_id' => $_xFileID);}
                    if ($_asMetadata != NULL) {$_oResult = $_oGridFs->find($_xWhere, $_asMetadata);} // findOne macht Probleme!
                    else {$_oResult = $_oGridFs->find($_xWhere);}
                }
                else if ($_asMetadata !== NULL) {$_oResult = $_oGridFs->find($_xWhere, $_asMetadata);}
                else if ($_xWhere !== NULL) {$_oResult = $_oGridFs->find($_xWhere);}
                else {$_oResult = $_oGridFs->find();}
            }
            catch(MongoGridFSException $_oError)
            {
                die('Error: '.$_oError->getMessage());
            }
            catch(MongoException $_oError)
            {
                die('Error: '.$_oError->getMessage());
            }

            if ($_oResult != NULL)
            {
                if (($_sOrderBy != NULL) && (is_array($_oResult)))
                {
                    $_iOrderReverse = 1;
                    if ($_bOrderReverse == true) {$_iOrderReverse = -1;}
                    $_oResult = $_oResult->sort(array($_sOrderBy => $_iOrderReverse));
                }

                if ($_iStart !== NULL) {$_oResult->skip($_iStart);}
                if ($_iCount !== NULL) {$_oResult->limit($_iCount);}

                return $_oResult;
            }
        }
        return NULL;
    }
    /* @end method */

    /*
    @start method
    */
    public function getFileBytes($_xFile)
    {
        $_xFile = $this->getRealParameter(array('oParameters' => $_xFile, 'sName' => 'xFile', 'xParameter' => $_xFile));

        $this->checkConnection();

        if ($_oGridFs = $this->oConnection->getGridFS())
        {
            if (get_class($_xFile) != 'MongoGridFSFile')
            {
                if ($_oResult = $this->selectFiles(array('xFileID' => $_xFile)))
                {
                    $_xFile = $this->fetchArray(array('oResult' => $_oResult));
                }
            }
            if (empty($_xFile)) {return NULL;}
            return $_xFile->getBytes();
        }
        return NULL;
    }
    /* @end method */

    /*
    @start method
    */
    public function insertFile($_sFile, $_axMetadata = NULL, $_bAllowAnonymInsert = NULL)
    {
        global $oPGLogin;

        $_axMetadata = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymInsert = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
        $_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

        if ($_bAllowAnonymInsert === NULL) {$_bAllowAnonymInsert = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymInsert = true;}
        }

        if ($_bAllowAnonymInsert == false) {return false;}

        $this->checkConnection();

        if ($_oGridFs = $this->oConnection->getGridFS())
        {
            if ($_axMetadata !== NULL) {return $_oGridFs->storeFile($_sFile, $_axMetadata);}
            else {return $_oGridFs->storeFile($_sFile);}
        }

        return false;
    }
    /* @end method */

    /*
    @start method
    */
    public function updateFile($_xFileID, $_axMetadata, $_bAllowAnonymUpdate = NULL)
    {
        global $oPGLogin;

        $_axMetadata = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymUpdate = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));

        if ($_bAllowAnonymUpdate === NULL) {$_bAllowAnonymUpdate = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymUpdate = true;}
        }

        if ($_bAllowAnonymUpdate == false) {return false;}

        $this->checkConnection();

        if ($_oGridFs = $this->oConnection->getGridFS())
        {
            // Note: Workaround of Bug in GridFS update...
            if($_oFile = $_oGridFs->findOne(array('_id' => new MongoID($_xFileID))))
            {
                foreach ($_axMetadata AS $_sKey => $_xValue)
                {
                    $_oFile->file[$_sKey] = $_xValue;
                }
                if($_oGridFs->save($_oFile->file)) {return true;}
            }

            // Note: Normal way to update...
            // if ($_oGridFs->update(array('_id' => $_xFileID), $_axMetadata)) {return true;}
        }
        return false;
    }
    /* @end method */

    /*
    @start method
    */
    public function deleteFile($_xFileID, $_bAllowAnonymDelete = NULL)
    {
        global $oPGLogin;

        $_bAllowAnonymDelete = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_xFileID = $this->getRealParameter(array('oParameters' => $_xFileID, 'sName' => 'xFileID', 'xParameter' => $_xFileID));

        if ($_bAllowAnonymDelete === NULL) {$_bAllowAnonymDelete = false;}

        if (isset($oPGLogin))
        {
            if (!$oPGLogin->isGuest()) {$_bAllowAnonymDelete = true;}
        }

        if ($_bAllowAnonymDelete == false) {return false;}

        $this->checkConnection();

        if ($_oGridFs = $this->oConnection->getGridFS())
        {
            if ($_oGridFs->delete($_xFileID)) {return true;}
        }

        return false;
    }
    /* @end method */

    /*
    @start method

    @description
    [en]...[/en]

    @return bSuccess [type]bool[/type]
    [en]...[/en]

    @param sName [needed][type]string[/type]
    [en]...[/en]

    @param sTable [type]string[/type]
    [en]...[/en]

    @param iIncrementID [type]int[/type]
    [en]...[/en]
    */
    public function setInrementID($_sName, $_sTable = NULL, $_iIncrementID = NULL)
    {
        $_sTable = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sTable', 'xParameter' => $_sTable));
        $_iIncrementID = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'iIncrementID', 'xParameter' => $_iIncrementID));
        $_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

        if (empty($_iIncrementID)) {$_iIncrementID = 0;}
        if (empty($_sTable)) {$_sTable = $this->getDatabaseTablePrefix().'counters';}

        if (
            $this->save(
                array(
                    'sTable' => $_sTable,
                    'sIDColumn' => 'Name',
                    'xIDValue' => $_sName,
                    'axColumnsAndValues' => array(
                        'IncrementID' => $_iIncrementID
                    ),
                    'axColumnsAndValuesOnInsert' => array(
                        'Name' => $_sName
                    ),
                    'iCount' => 1
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

    @description
    [en]...[/en]

    @return iIncrementID [type]int[/type]
    [en]...[/en]

    @param sName [needed][type]string[/type]
    [en]...[/en]

    @param sTable [type]string[/type]
    [en]...[/en]

    @param bAutoCreateTable [type]bool[/type]
    [en]...[/en]
    */
    public function getNextIncrementID($_sName, $_sTable = NULL, $_bAutoCreateTable = NULL)
    {
        $_sTable = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sTable', 'xParameter' => $_sTable));
        $_bAutoCreateTable = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bAutoCreateTable', 'xParameter' => $_bAutoCreateTable));
        $_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

        if (empty($_bAutoCreateTable)) {$_bAutoCreateTable = false;}
        if (empty($_sTable)) {$_sTable = $this->getDatabaseTablePrefix().'counters';}

        if (
            $_axIncrement = $this->oConnection->$_sTable->findAndModify(
                array('Name' => $_sName), // query
                array('$inc' => array('IncrementID' => 1)), // update
                NULL, // fields to return
                array(
                    'new' => true,
                    'upsert' => $_bAutoCreateTable // auto insert
                ) // options
            )
        )
        {
            return $_axIncrement['IncrementID'];
        }
        return false;
    }
    /* @end method */
}
/* @end class */

$oPGMongo = new classPG_Mongo();

if (defined('PG_MONGO_DATA_HOST')) {$oPGMongo->setHost(array('sHost' => PG_MONGO_DATA_HOST));}
if (defined('PG_MONGO_DATA_USER')) {$oPGMongo->setUser(array('sUser' => PG_MONGO_DATA_USER));}
if (defined('PG_MONGO_DATA_PASSWORD')) {$oPGMongo->setPassword(array('sPassword' => PG_MONGO_DATA_PASSWORD));}
if (defined('PG_MONGO_DATA_DATABASE')) {$oPGMongo->setDatabaseName(array('sDatabase' => PG_MONGO_DATA_DATABASE));}

if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMongo', 'xValue' => $oPGMongo));}
?>