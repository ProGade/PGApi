<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Date extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return iTime [type]int[/type]
	[en]...[/en]
	
	@param xTime [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getTimeStampOfTime($_xTime)
	{
		$_xTime = $this->getRealParameter(array('oParameters' => $_xTime, 'sName' => 'xTime', 'xParameter' => $_xTime));
		if (is_int($_xTime)) {return $_xTime;}
		return strtotime(preg_replace("!([0-9]{2})\.([0-9]{2})\.([0-9]{4})!i", "\\2/\\1/\\3", $_xTime));
	}
	/* @end method */
	
	/*
	@start method
	
	@return dYears [type]double[/type]
	[en]...[/en]
	
	@param xStartTime [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xEndTime [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getDifferenceYears($_xStartTime, $_xEndTime = NULL)
	{
		$_xEndTime = $this->getRealParameter(array('oParameters' => $_xStartTime, 'sName' => 'xEndTime', 'xParameter' => $_xEndTime));
		$_xStartTime = $this->getRealParameter(array('oParameters' => $_xStartTime, 'sName' => 'xStartTime', 'xParameter' => $_xStartTime));

		$_iStartTimeStamp = $this->getTimeStampOfTime(array('xTime' => $_xStartTime));
		$_iEndTimeStamp = $this->getTimeStampOfTime(array('xTime' => $_xEndTime));
		
		$_iLeapYearDays = $this->getLeapYearsCount(array('xStartTime' => $_iStartTimeStamp, 'xEndTime' => $_iEndTimeStamp));
		$_dSeconds = $_iEndTimeStamp-$_iStartTimeStamp;
		$_dMinutes = $_dSeconds/60;
		$_dHours = $_dMinutes/60;
		$_dDays = $_dHours/24;
		$_dYears = ($_dDays-$_iLeapYearDays)/365;
		
		return $_dYears;
	}
	/* @end method */

	/*
	@start method
	
	@return iYearsCount [type]int[/type]
	[en]...[/en]
	
	@param xStartTime [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xEndTime [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getLeapYearsCount($_xStartTime, $_xEndTime = NULL)
	{
		$_xEndTime = $this->getRealParameter(array('oParameters' => $_xStartTime, 'sName' => 'xEndTime', 'xParameter' => $_xEndTime));
		$_xStartTime = $this->getRealParameter(array('oParameters' => $_xStartTime, 'sName' => 'xStartTime', 'xParameter' => $_xStartTime));

		$_iStartTimeStamp = $this->getTimeStampOfTime($_xStartTime);
		$_iEndTimeStamp = $this->getTimeStampOfTime($_xEndTime);
		
		$_iLeapYears = 0;
		$_iStartYear = date("Y", $_iStartTimeStamp);
		$_iEndYear = date("Y", $_iEndTimeStamp);
		if ($_iStartYear < $_iEndYear)
		{
			for ($i=$_iStartYear; $i<$_iEndYear; $i++)
			{
				if (date("L", mktime(0,0,0,1,1,$i)) == 1) {$_iLeapYears += 1;}
			}
			if(date("m", $_iEndTimeStamp) >= 3) {$_iLeapYears += 1;}
		}
		else
		{
			if
			(
				(
					(date("m", $_iStartTimeStamp) < 2)
					||
					(
						(date("m", $_iStartTimeStamp) == 2)
						&& (date("d", $_iStartTimeStamp) < 29)
					)
				)
				&&
				(date("m", $_iEndTimeStamp) >= 3)
			)
			{
				$_iLeapYears = 1;
			}
		}
		return $_iLeapYears;
	}
	/* @end method */
	
	/*
	// TODO...
	public function checkStringDates($_sStartDate, $_sEndDate)
	{
		var _aiStartDate = _sStartDate.split('.');
		var _aiEndDate = _sEndDate.split('.');
		if ((_aiStartDate.length == 3) && (_aiEndDate.length == 3))
		{
			if ((_aiStartDate[0].length == 2) && (_aiStartDate[1].length == 2) && (_aiStartDate[2].length == 4)
			&& (_aiEndDate[0].length == 2) && (_aiEndDate[1].length == 2) && (_aiEndDate[2].length == 4))
			{
				var _iStartDate = new Date(_aiStartDate[2],_aiStartDate[1],_aiStartDate[0],0,0,0).getTime()/1000;
				var _iEndDate = new Date(_aiEndDate[2],_aiEndDate[1],_aiEndDate[0],0,0,0).getTime()/1000;
				if (_iStartDate > _iEndDate) {alert('Achtung! Das Enddatum ist kleiner als das Startdatum.'); return false;}
				else {return true;}
			}
		}
		alert('Achtung! Start und Enddatum muessen im Format tt.mm.yyyy angegeben werden.');
		return false;
	}
	*/
}
/* @end class */
$oPGDate = new classPG_Date();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDate', 'xValue' => $oPGDate));}
?>