<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
// Log into file, database or on screen
define('PG_LOG_MODE_NONE', 0);
define('PG_LOG_MODE_SCREEN', 1);
define('PG_LOG_MODE_FILE', 2);
define('PG_LOG_MODE_DATABASE', 3);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Logs extends classPG_ClassBasics
{
	// Declarations...
	private $sLogFolderPath = '';
	private $sLogFileName = ''; // '[time]_[date].log';

	private $axLogs = array();
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sFileName [type]string[/type]
	[en]...[/en]
	*/
	public function generateLogFileName()
	{
		$_sFileName = '';
		$_sFileName .= $this->sLogFolderPath;
		$_sFileName .= $this->sLogFileName;
		$_sFileName = str_replace('[time]', date('H:i:s'), $_sFileName);
		$_sFileName = str_replace('[date]', date('d.m.Y'), $_sFileName);
		return $_sFileName;
	}
	/* @end method */
	
	/*
	@start method
	
	@param iAction [type]int[/type]
	[en]...[/en]
	*/
	public function reset($_iAction = NULL)
	{
		global $oPGFileSystem;

		$_iAction = $this->getRealParameter(array('oParameters' => $_iAction, 'sName' => 'iAction', 'xParameter' => $_iAction));
		
		if ($_iAction === NULL) {$_iAction = $this->getMode();}

		$this->axLogs = array();
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_SCREEN))) {}
		
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_FILE)))
		{
			if ((isset($oPGFileSystem)) && ($this->sLogFileName != ''))
			{
				$oPGFileSystem->deleteFile(array('sFile' => $this->generateLogFileName()));
			}
		}
		
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_DATABASE))) {}
	}
	/* @end method */

	/*
	@start method
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param iAction [type]int[/type]
	[en]...[/en]
	
	@param iTimeStamp [type]int[/type]
	[en]...[/en]
	*/
	public function addMessage($_sMessage, $_iAction = NULL, $_iTimeStamp = NULL)
	{
		global $oPGFileSystem;
		
		$_iAction = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'iAction', 'xParameter' => $_iAction));
		$_iTimeStamp = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'iTimeStamp', 'xParameter' => $_iTimeStamp));
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		
		if ($_iAction === NULL) {$_iAction = $this->getMode();}
		if ($_iTimeStamp == NULL) {$_iTimeStamp = time();}
		
		$this->axLogs[] = array($_iTimeStamp, $_sMessage, $_iAction);
		
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_SCREEN))) {}
		
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_FILE)))
		{
			if ((isset($oPGFileSystem)) && ($this->sLogFileName != ''))
			{
				$oPGFileSystem->appendFile(array('sFile' => $this->generateLogFileName(), 'sMessage' => '['.date("d.m.Y H:i:s", $_iTimeStamp).'] '.$_sMessage, 'bBinary' => false));
			}
		}
		
		if ($this->isMode(array('iCurrentMode' => $_iAction, 'iMode' => PG_LOG_MODE_DATABASE))) {}
	}
	/* @end method */
}
/* @end class */
$oPGLogs = new classPG_Logs();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGLogs', 'xValue' => $oPGLogs));}
?>