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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_MySqlStatements extends classPG_ClassBasics
{
	// Declarations...
	private $sDebugDocuPath = 'http://dev.mysql.com/doc/refman/5.3/en/';
	private $bFormatWithPlainText = false;
	
	private $asMySqlFunctions = array(
		'ABS', 
		'ACOS', 
		'ADDDATE', 
		'ADDTIME', 
		'AES_DECRYPT', 
		'AES_ENCRYPT', 
		'ASCII', 
		'ASIN', 
		'ATAN2', 
		'ATAN', 
		'AVG', 
		'BENCHMARK', 
		'BIN', 
		'BIT_AND', 
		'BIT_COUNT', 
		'BIT_LENGTH', 
		'BIT_OR', 
		'BIT_XOR', 
		'CAST', 
		'CEIL', 
		'CEILING', 
		'CHAR_LENGTH', 
		'CHAR', 
		'CHARACTER_LENGTH', 
		'CHARSET', 
		'COALESCE', 
		'COERCIBILITY', 
		'COLLATION', 
		'COMPRESS', 
		'CONCAT_WS', 
		'CONCAT', 
		'CONNECTION_ID', 
		'CONV', 
		'CONVERT_TZ', 
		'Convert', 
		'COS', 
		'COT', 
		'COUNT', 
		'CRC32', 
		'CURDATE', 
		'CURRENT_DATE', 
		'CURRENT_TIME',  
		'CURRENT_TIMESTAMP', 
		'CURRENT_USER', 
		'CURTIME', 
		'DATABASE', 
		'DATE_ADD', 
		'DATE_FORMAT', 
		'DATE_SUB', 
		'DATE', 
		'DATEDIFF', 
		'DAY', 
		'DAYNAME', 
		'DAYOFMONTH', 
		'DAYOFWEEK', 
		'DAYOFYEAR', 
		'DECODE', 
		'DEFAULT', 
		'DEGREES', 
		'DES_DECRYPT', 
		'DES_ENCRYPT', 
		'ELT', 
		'ENCODE', 
		'ENCRYPT', 
		'EXP', 
		'EXPORT_SET', 
		'EXTRACT', 
		'FIELD', 
		'FIND_IN_SET', 
		'FLOOR', 
		'FORMAT', 
		'FOUND_ROWS', 
		'FROM_DAYS', 
		'FROM_UNIXTIME', 
		'GET_FORMAT', 
		'GET_LOCK', 
		'GREATEST', 
		'GROUP_CONCAT', 
		'HEX', 
		'HOUR', 
		'IF', 
		'IFNULL', 
		'IN', 
		'INET_ATON', 
		'INET_NTOA', 
		'INSERT', 
		'INSTR', 
		'INTERVAL', 
		'IS_FREE_LOCK', 
		'IS_USED_LOCK', 
		'ISNULL', 
		'LAST_INSERT_ID', 
		'LCASE', 
		'LEAST', 
		'LEFT', 
		'LENGTH', 
		'LN', 
		'LOAD_FILE', 
		'LOCALTIME', 
		'LOCALTIMESTAMP', 
		'LOCATE', 
		'LOG10', 
		'LOG2', 
		'LOG', 
		'LOWER', 
		'LPAD', 
		'LTRIM', 
		'MAKE_SET', 
		'MAKEDATE', 
		'MAKETIME', 
		'MASTER_POS_WAIT', 
		'MAX', 
		'MD5', 
		'MICROSECOND', 
		'MID', 
		'MIN', 
		'MINUTE', 
		'MOD', 
		'MONTH', 
		'MONTHNAME', 
		'NAME_CONST', 
		'NOW', 
		'NULLIF', 
		'OCT', 
		'OCTET_LENGTH', 
		'OLD_PASSWORD', 
		'ORD', 
		'PASSWORD', 
		'PERIOD_ADD', 
		'PERIOD_DIFF', 
		'PI', 
		'POSITION', 
		'POW', 
		'POWER', 
		'ANALYSE', 
		'QUARTER', 
		'QUOTE', 
		'RADIANS', 
		'RAND', 
		'RELEASE_LOCK', 
		'REPEAT', 
		'REPLACE', 
		'REVERSE', 
		'RIGHT', 
		'ROUND', 
		'ROW_COUNT', 
		'RPAD', 
		'RTRIM', 
		'SCHEMA', 
		'SEC_TO_TIME', 
		'SECOND', 
		'SESSION_USER', 
		'SHA1', 
		'SHA', 
		'SIGN', 
		'SIN', 
		'SLEEP', 
		'SOUNDEX', 
		'SPACE', 
		'SQRT', 
		'STD', 
		'STDDEV_POP', 
		'STDDEV_SAMP', 
		'STDDEV', 
		'STR_TO_DATE', 
		'STRCMP', 
		'SUBDATE', 
		'SUBSTR', 
		'SUBSTRING_INDEX', 
		'SUBSTRING', 
		'SUBTIME', 
		'SUM', 
		'SYSDATE', 
		'SYSTEM_USER', 
		'TAN', 
		'TIME_FORMAT', 
		'TIME_TO_SEC', 
		'TIME', 
		'TIMEDIFF', 
		'TIMESTAMP', 
		'TIMESTAMPADD', 
		'TIMESTAMPDIFF', 
		'TO_DAYS', 
		'TRIM', 
		'TRUNCATE', 
		'UCASE', 
		'UNCOMPRESS', 
		'UNCOMPRESSED_LENGTH', 
		'UNHEX', 
		'UNIX_TIMESTAMP', 
		'UPPER', 
		'USER', 
		'UTC_DATE', 
		'UTC_TIME', 
		'UTC_TIMESTAMP', 
		'UUID', 
		'VALUES', 
		'VAR_POP', 
		'VAR_SAMP', 
		'VARIANCE', 
		'VERSION', 
		'WEEK', 
		'WEEKDAY', 
		'WEEKOFYEAR', 
		'YEAR', 
		'YEARWEEK'
	);
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sStatement [needed][type]sStatement[/type]
	[en]...[/en]
	*/
	public function format($_sStatement)
	{
		$_sStatement = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sStatement', 'xParameter' => $_sStatement));
		return $this->formatSqlStatement(array('sStatement' => $_sStatement));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sStatement [needed][type]string[/type]
	[en]...[/en]
	*/
	public function formatStatement($_sStatement)
	{
		$_sStatement = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sStatement', 'xParameter' => $_sStatement));
		return $this->formatSqlStatement(array('sStatement' => $_sStatement));
	}
	/* @end method */

	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sStatement [needed][type]string[/type]
	[en]...[/en]
	*/
	public function formatSqlStatement($_sStatement)
	{
		global $oPGStrings;

		$_sStatement = $this->getRealParameter(array('oParameters' => $_sStatement, 'sName' => 'sStatement', 'xParameter' => $_sStatement));
		
		$_bIsInsertOrUpdate = false;
		if (preg_match("!^INSERT\ .*?!is", $_sStatement)) {$_bIsInsertOrUpdate = true;}
		if (preg_match("!^UPDATE\ .*?!is", $_sStatement)) {$_bIsInsertOrUpdate = true;}
		
		if ($this->bFormatWithPlainText == true)
		{
		}
		else
		{
			if (isset($oPGStrings)) {$_sStatement = $oPGStrings->textToHTML(array('sString' => $_sStatement, 'bAllowHtmlTags' => false, 'bConvertUris' => false));}
			
			$_sStatement = str_replace('SELECT ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">SELECT</a> ', $_sStatement);
			$_sStatement = str_replace('INSERT ', '<br /><a href="'.$this->sDebugDocuPath.'insert.html" target="_blank">INSERT</a> ', $_sStatement);
			$_sStatement = str_replace('UPDATE ', '<br /><a href="'.$this->sDebugDocuPath.'update.html" target="_blank">UPDATE</a> ', $_sStatement);
			$_sStatement = str_replace('DELETE ', '<br /><a href="'.$this->sDebugDocuPath.'delete.html" target="_blank">DELETE</a> ', $_sStatement);
			$_sStatement = str_replace(' FROM ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">FROM</a> ', $_sStatement);
			$_sStatement = str_replace(' LEFT OUTER JOIN ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">LEFT OUTER JOIN</a> ', $_sStatement);
			$_sStatement = str_replace(' INNER JOIN ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">INNER JOIN</a> ', $_sStatement);
			$_sStatement = str_replace(' ON ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">ON</a> ', $_sStatement);
			$_sStatement = str_replace(' WHERE ', '<br /><a href="'.$this->sDebugDocuPath.'data-manipulation.html" target="_blank">WHERE</a> ', $_sStatement);
			$_sStatement = str_replace(' AND ', '<br /><a href="'.$this->sDebugDocuPath.'data-manipulation.html" target="_blank">AND</a> ', $_sStatement);
			$_sStatement = str_replace(' OR ', '<br /><a href="'.$this->sDebugDocuPath.'data-manipulation.html" target="_blank">OR</a> ', $_sStatement);
			$_sStatement = str_replace(' GROUP BY ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">GROUP BY</a> ', $_sStatement);
			$_sStatement = str_replace(' ORDER BY ', '<br /><a href="'.$this->sDebugDocuPath.'select.html" target="_blank">ORDER BY</a> ', $_sStatement);
			
			for($i=0; $i<count($this->asMySqlFunctions); $i++)
			{
				$_sStatement = preg_replace("!".$this->asMySqlFunctions[$i]."\(([a-zA-Z0-9\.\_\-]*?)\)!is", $this->asMySqlFunctions[$i]."*[*\\1*]*", $_sStatement);
			}
			
			$_sStatement = str_replace('(', '(<blockquote>', $_sStatement);
			$_sStatement = str_replace(')', '</blockquote>)', $_sStatement);
			
			$_sStatement = str_replace('*[*', '(', $_sStatement);
			$_sStatement = str_replace('*]*', ')', $_sStatement);
			
			if ($_bIsInsertOrUpdate == true)
			{
				$_sStatement = preg_replace("!(=\ *\&quot\;.*?\&quot\;,)\ *!is", "\\1<br />", $_sStatement);
				$_sStatement = preg_replace("!(=\ *\'.*?\',)\ *!is", "\\1<br />", $_sStatement);
				$_sStatement = str_replace('<br /><br />', '<br />', $_sStatement);
			}
		}
		
		return $_sStatement;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumnStructure [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildCreate($_sTable, $_axColumnStructure = NULL)
	{
		$_axColumnStructure = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnStructure', 'xParameter' => $_axColumnStructure));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		return $this->buildCreateStatement($_sTable, $_axColumnStructure);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axColumnStructure [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function buildCreateStatement($_sTable, $_axColumnStructure = NULL)
	{
		$_axColumnStructure = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axColumnStructure', 'xParameter' => $_axColumnStructure));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$_bPrimaries = false;
		$_sSql = '';
		$_sSql = 'CREATE TABLE IF NOT EXISTS '.$_sTable.' (';
		// for ($i=0; $i<count($_axColumnStructure); $i++) {if ($_axColumnStructure[$i]['Key'] == 'PRI') {$_bPrimaries = true;}} // PRI, UNI, MUL
		for ($i=0; $i<count($_axColumnStructure); $i++)
		{
			if ($i > 0) {$_sSql .= ', ';}
			$_sSql .= trim($_axColumnStructure[$i]['Name']).' '.trim($_axColumnStructure[$i]['Type']);
			if ($_axColumnStructure[$i]['Size'] > 0) {$_sSql .= '('.$_axColumnStructure[$i]['Size'].')';}
			if ($_axColumnStructure[$i]['Default'] != '')
			{
				if (is_string($_axColumnStructure[$i]['Default'])) {$_sSql .= ' DEFAULT \''.$_axColumnStructure[$i]['Default'].'\'';}
				else {$_sSql .= ' DEFAULT '.$_axColumnStructure[$i]['Default'];}
			}
			// if ((trim($_axColumnStructure[$i]['Extra']) != '') && (count($_asPrimaryKeys) < 1)) {$_sSql .= ' '.trim($_axColumnStructure[$i]['Extra']);}
			if (trim($_axColumnStructure[$i]['Extra']) != '') {$_sSql .= ' '.trim($_axColumnStructure[$i]['Extra']);}
			if ($_axColumnStructure[$i]['Key'] == 'PRI') {$_bPrimaries = true;} // PRI, UNI, MUL
		}
		if ($_bPrimaries == true)
		{
			$t = 0;
			$_sSql .= ', PRIMARY KEY (';
			for ($i=0; $i<count($_axColumnStructure); $i++)
			{
				if ($_axColumnStructure[$i]['Key'] == 'PRI')
				{
					if ($t > 0) {$_sSql .= ', ';}
					$_sSql .= trim($_axColumnStructure[$i]['Name']);
					$t++;
				}
			}
			$_sSql .= ')';
		}
		$_sSql .= ')';
		return $_sSql;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildInsert($_sTable, $_axData = NULL)
	{
		$_axData = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axData', 'xParameter' => $_axData));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));
		return $this->buildInsertStatement($_sTable, $_axData);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sStatement [type]string[/type]
	[en]...[/en]
	
	@param sTable [needed][type]string[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildInsertStatement($_sTable, $_axData = NULL)
	{
		$_axData = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'axData', 'xParameter' => $_axData));
		$_sTable = $this->getRealParameter(array('oParameters' => $_sTable, 'sName' => 'sTable', 'xParameter' => $_sTable));

		$i=0;
		$_sSql = '';
		$_sSql .= 'INSERT INTO '.$_sTable.' SET ';
		foreach($_axData as $_sName => $_sValue)
		{
			if (!is_int($_sName))
			{
				if ($i>0) {$_sSql .= ', ';}
				$_sSql .= $_sName.' = \''.$_sValue.'\'';
				$i++;
			}
		}
		return $_sSql;
	}
	/* @end method */
}
/* @end class */
$oPGMySqlStatements = new classPG_MySqlStatements();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMySqlStatements', 'xValue' => $oPGMySqlStatements));}
?>