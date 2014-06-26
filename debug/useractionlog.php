<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: May 19 2014
*/

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_UserActionLog extends classPG_ClassBasics
{
	// Declarations...
	private $axUserActions = array();
	private $iMaxUserActions = 50;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param iCount [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMaxUserActions($_iCount)
	{
		$_iCount = $this->getRealParameter(array('oParameters' => $_iCount, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$this->iMaxUserActions = $_iCount;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMaxUserActions [type]int[/type]
	[en]...[/en]
	*/
	public function getMaxUserActions() {return $this->iMaxUserActions;}
	/* @end method */
	
	/*
	@start method
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	
	@param iCountToKeep [needed][type]int[/type]
	[en]...[/en]
	*/
	public function deleteOldUserActions($_iUserID, $_iCountToKeep = NULL)
	{
		$_iCountToKeep = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iCountToKeep', 'xParameter' => $_iCountToKeep));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

        /*
		$_sSql = 'DELETE FROM '.$this->sMySqlTablePrefix.'user_actionlog ';
		$_sSql .= 'WHERE TimeStamp < ';
		$_sSql .= '(';
			$_sSql .= 'SELECT MIN(TimeStamp) ';
			$_sSql .= 'FROM '.$this->sMySqlTablePrefix.'user_actionlog ';
			$_sSql .= 'ORDER BY TimeStamp DESC ';
			$_sSql .= 'LIMIT 0,'.$_iCountToKeep;
		$_sSql .= ')';
		$this->oMySqlQuery->sendSql(array('xQuery' => $_sSql));
        */

        $_axWhere = array('UserID' => $_iUserID);
        // TODO...
        /*
        if ($_iCountToKeep !== NULL)
        {
            $_axWhere = array('TimeStamp' => array('>=', ));
        }
        */

        $this->deleteDatasets(
            array(
                'sTable' => $this->getDatabaseTablePrefix().'user_actionlog',
                'xWhere' => $_axWhere
            )
        );
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	
	@param iTimeStamp [needed][type]int[/type]
	[en]...[/en]
	
	@param sAction [needed][type]string[/type]
	[en]...[/en]
	
	@param sStatus [needed][type]string[/type]
	[en]...[/en]
	*/
	public function saveUserAction($_iUserID, $_iTimeStamp = NULL, $_sAction = NULL, $_sStatus = NULL, $_xData = NULL)
	{
		global $oPGBrowser;

		$_iTimeStamp = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iTimeStamp', 'xParameter' => $_iTimeStamp));
		$_sAction = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sAction', 'xParameter' => $_sAction));
		$_sStatus = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'sStatus', 'xParameter' => $_sStatus));
        $_xData = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'xData', 'xParameter' => $_xData));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));
		
		if ($this->iMaxUserActions > 0) {$this->deleteOldUserActions(array('iUserID' => $_iUserID, '_iCountToKeep' => $this->iMaxUserActions+1));}

        $_axColumnsAndValues = array(
            'TimeStamp' => $_iTimeStamp,
            'UserID' => $_iUserID,
            'Action' => $_sAction,
            'Status' => $_sStatus,
            'Data' => $_xData
        );

        if (!empty($oPGBrowser))
        {
            $_axColumnsAndValues['ClientIP'] = $oPGBrowser->getClientIP();
            $_axColumnsAndValues['ServerIP'] = $oPGBrowser->getServerIP();
            $_axColumnsAndValues['Domain'] = $oPGBrowser->getDomain();
            $_axColumnsAndValues['Port'] = $oPGBrowser->getPort();
            $_axColumnsAndValues['BrowserInfo'] = $oPGBrowser->getInfo();
            $_axColumnsAndValues['FileName'] = $oPGBrowser->getFileName();
            $_axColumnsAndValues['UrlParameters'] = $oPGBrowser->getUrlParameters();
            $_axColumnsAndValues['ProviderInfo'] = $oPGBrowser->getProviderInfo();
        }

        if (
            $this->insertDataset(
                array(
                    'sTable' => $this->getDatabaseTablePrefix().'user_actionlog',
                    'axColumnsAndValues' => $_axColumnsAndValues,
                    'bAllowAnonymInsert' => true
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
	
	@return axUserActions [type]mixed[][/type]
	[en]...[/en]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function loadUserActions($_iUserID, $_asActions = NULL)
	{
        $_asActions = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'asActions', 'xParameter' => $_asActions));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

        $_axWhere = NULL;
        if ($_iUserID !== NULL) {$_axWhere = array('UserID' => $_iUserID);}
        if ($_asActions !== NULL)
        {
            if ($_axWhere === NULL) {$_axWhere = array();}
            $_axWhere['Action'] = array('IN' => $_asActions);
        }

        if (
            $_oResult = $this->selectDatasets(
                array(
                    'sTable' => $this->getDatabaseTablePrefix().'user_actionlog',
                    'xWhere' => $_axWhere,
                    'sOrderBy' => 'TimeStamp',
                    'bOrderReverse' => true
                )
            )
        )
        {
            while ($_axUserActionLog = $this->fetchDatabaseArray(array('xResult' => $_oResult)))
            {
                $this->axUserActions[] = $_axUserActionLog;
            }
        } // if _oResult
        return $this->axUserActions;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param iUserID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function buildUserActionsList($_iUserID, $_asActions = NULL)
	{
		global $oPGBrowser;

        $_asActions = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'asActions', 'xParameter' => $_asActions));
		$_iUserID = $this->getRealParameter(array('oParameters' => $_iUserID, 'sName' => 'iUserID', 'xParameter' => $_iUserID));

		$_sHtml = '';

		$this->loadUserActions(array('iUserID' => $_iUserID, 'asActions' => $_asActions));

		$_sHtml .= '<table style="border-width:0px;">';
		$_sHtml .= '<tr>';
			$_sHtml .= '<th>Datum</th>';
			$_sHtml .= '<th>Uhrzeit</th>';
			$_sHtml .= '<th>Benutzer</th>';
			$_sHtml .= '<th>Action</th>';
			$_sHtml .= '<th>Status</th>';
			if (isset($oPGBrowser))
			{
				$_sHtml .= '<th>Browser</th>';
				$_sHtml .= '<th>Filename</th>';
				$_sHtml .= '<th>Url parameters</th>';
				$_sHtml .= '<th>Provider</th>';
			}
			$_sHtml .= '<th>ClientIP</th>';
			$_sHtml .= '<th>ServerIP</th>';
			$_sHtml .= '<th>Domain</th>';
			$_sHtml .= '<th>Port</th>';
            $_sHtml .= '<th>Data</th>';
		$_sHtml .= '</tr>';
		for ($i=0; $i<count($this->axUserActions); $i++)
		{
			$_sHtml .= '<tr>';
				$_sHtml .= '<td>'.date("d.m.Y", $this->axUserActions[$i]['TimeStamp']).'</td>';
				$_sHtml .= '<td>'.date("H:i:s", $this->axUserActions[$i]['TimeStamp']).'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['UserID'].'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['Action'].'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['Status'].'</td>';
				if (isset($oPGBrowser))
				{
					$_sHtml .= '<td title="'.$this->axUserActions[$i]['BrowserInfo'].'">'.$oPGBrowser->getName(array('sBrowserInfo' => $this->axUserActions[$i]['BrowserInfo'])).' '.$oPGBrowser->getVersion(array('sBrowserInfo' => $this->axUserActions[$i]['BrowserInfo'])).'</td>';
					$_sHtml .= '<td>'.$this->axUserActions[$i]['FileName'].'</td>';
					$_sHtml .= '<td>'.$this->axUserActions[$i]['UrlParameters'].'</td>';
					$_sHtml .= '<td title="'.$this->axUserActions[$i]['ProviderInfo'].'">'.$oPGBrowser->getProviderName(array('sBrowserInfo' => $this->axUserActions[$i]['ProviderInfo'])).'</td>';
				}
				$_sHtml .= '<td>'.$this->axUserActions[$i]['ClientIP'].'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['ServerIP'].'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['Domain'].'</td>';
				$_sHtml .= '<td>'.$this->axUserActions[$i]['Port'].'</td>';
                $_sHtml .= '<td><pre>'.print_r($this->axUserActions[$i]['Data'], true).'</pre></td>';
			$_sHtml .= '</tr>';
		}
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGUserActionLog = new classPG_UserActionLog();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUserActionLog', 'xValue' => $oPGUserActionLog));}
?>