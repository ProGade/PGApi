<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 16 2012
*/
define('PG_ICALENDAR_EVENT_INDEX_STARTTIMESTAMP', 0);
define('PG_ICALENDAR_EVENT_INDEX_ENDTIMESTAMP', 1);
define('PG_ICALENDAR_EVENT_INDEX_CREATETIMESTAMP', 2);
define('PG_ICALENDAR_EVENT_INDEX_SUBJECT', 3);
define('PG_ICALENDAR_EVENT_INDEX_DESCRIPTION', 4);

// http://tools.ietf.org/html/rfc5545#section-3.7.2
// PRIORITY:
// STATUS:
// COMPLETED:
// TZID:
// CONTACT:
// ORGANIZER;CN="Alice Balder, Example Inc.":MAILTO:alice@example.com
// CLASS:PUBLIC
// $_sHTML .= 'URL:http://www.progade.de/'
// CATEGORIES:
// GEO:
// LOCATION:
// PERCENT-COMPLETE:

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_ICalendar extends classPG_ClassBasics
{
	// Declarations...
	private $sProductName = 'ProGade Calendar';
	private $sFileName = 'calendar.ics';
	private $sCalendarName = 'unnamed';
	private $sCalendarDescription = '';
	// private $sTimeZone = 'Europe/Berlin';
	private $iTimeZoneDifference = 0;
	private $sLineBreak = "\n";
	
	private $axEvents = array();
	
	// Construct...
	public function __construct()
	{
		$this->setID('PG_Calendar');
	}
	
	// Methods...
	/* @start method */
	public function putHeader()
	{
		header('Content-Type: text/calendar; charset=UTF-8');
		header('Content-Disposition: inline; filename="'.$this->sFileName.'"');
	}
	/* @end method */
	
	/*
	@start method
	@param sName
	*/
	public function setProductName($_sName) {$this->sProductName = $_sName;}
	/* @end method */

	/* @start method */
	public function getProductName() {return $this->sProductName;}
	/* @end method */

	/*
	@start method
	@param sName
	*/
	public function setFileName($_sName) {$this->sFileName = $_sName;}
	/* @end method */

	/* @start method */
	public function getFileName() {return $this->sFileName;}
	/* @end method */
	
	/*
	@start method
	@param sName
	*/
	public function setCalendarName($_sName) {$this->sCalendarName = $_sName;}
	/* @end method */

	/* @start method */
	public function getCalendarName() {return $this->sCalendarName;}
	/* @end method */

	/*
	@start method
	@param sDescription
	*/
	public function setCalendarDescription($_sDescription) {$this->sCalendarDescription = $_sDescription;}
	/* @end method */

	/* @start method */
	public function getCalendarDescription() {return $this->sCalendarDescription;}
	/* @end method */
	
	/*
	@start method
	@param iGMTTimeZone
	*/
	public function setGMTTimeZone($_iGMTTimeZone) {$this->iTimeZoneDifference = -$_iGMTTimeZone;}
	/* @end method */

	/* @start method */
	public function getGMTTimeZone() {return $this->iTimeZoneDifference;}
	/* @end method */
	
	/*
	@start method
	@param iTimeStamp
	*/
	public function convertTimeStamp($_iTimeStamp)
	{
		if ($this->iTimeZoneDifference != 0)
		{
			$_iHour = date("H", $_iTimeStamp);
			$_iMinutes = date("i", $_iTimeStamp);
			$_iSeconds = date("s", $_iTimeStamp);
			$_iDay = date("d", $_iTimeStamp);
			$_iMonth = date("m", $_iTimeStamp);
			$_iYear = date("Y", $_iTimeStamp);
			return mktime($_iHour+$this->iTimeZoneDifference, $_iMinutes, $_iSeconds, $_iMonth, $_iDay, $_iYear);
		}
		return $_iTimeStamp;
	}
	/* @end method */
	
	/*
	@start method
	@param iStartDay
	@param iStartMonth
	@param iStartYear
	@param iStartHour
	@param iStartMinutes
	@param iStartSeconds
	@param iEndDay
	@param iEndMonth
	@param iEndYear
	@param iEndHour
	@param iEndMinutes
	@param iEndSeconds
	@param iCreateDay
	@param iCreateMonth
	@param iCreateYear
	@param iCreateHour
	@param iCreateMinutes
	@param iCreateSeconds
	@param sSubject
	@param sDescription
	*/
	public function addEvent2($_iStartDay = NULL, $_iStartMonth = NULL, $_iStartYear = NULL, $_iStartHour = NULL, $_iStartMinutes = NULL, $_iStartSeconds = NULL, 
							  $_iEndDay = NULL, $_iEndMonth = NULL, $_iEndYear = NULL, $_iEndHour = NULL, $_iEndMinutes = NULL, $_iEndSeconds = NULL, 
							  $_iCreateDay = NULL, $_iCreateMonth = NULL, $_iCreateYear = NULL, $_iCreateHour = NULL, $_iCreateMinutes = NULL, $_iCreateSeconds = NULL, 
							  $_sSubject = NULL, $_sDescription = NULL)
	{
		if ($_iStartDay == NULL) {$_iStartDay = date("d");}
		if ($_iStartMonth == NULL) {$_iStartMonth = date("m");}
		if ($_iStartYear == NULL) {$_iStartYear = date("Y");}
		if ($_iStartHour == NULL) {$_iStartHour = 0;}
		if ($_iStartMinutes == NULL) {$_iStartMinutes = 0;}
		if ($_iStartSeconds == NULL) {$_iStartSeconds = 0;}
		
		if ($_iEndDay == NULL) {$_iEndDay = date("d");}
		if ($_iEndMonth == NULL) {$_iEndMonth = date("m");}
		if ($_iEndYear == NULL) {$_iEndYear = date("Y");}
		if ($_iEndHour == NULL) {$_iEndHour = 0;}
		if ($_iEndMinutes == NULL) {$_iEndMinutes = 0;}
		if ($_iEndSeconds == NULL) {$_iEndSeconds = 0;}
		
		if ($_iCreateDay == NULL) {$_iCreateDay = date("d");}
		if ($_iCreateMonth == NULL) {$_iCreateMonth = date("m");}
		if ($_iCreateYear == NULL) {$_iCreateYear = date("Y");}
		if ($_iCreateHour == NULL) {$_iCreateHour = date("H");}
		if ($_iCreateMinutes == NULL) {$_iCreateMinutes = date("i");}
		if ($_iCreateSeconds == NULL) {$_iCreateSeconds = date("s");}

		$_iStartTimeStamp = mktime($_iStartHour, $_iStartMinutes, $_iStartSeconds, $_iStartMonth, $_iStartDay, $_iStartYear);
		$_iEndTimeStamp = mktime($_iEndHour, $_iEndMinutes, $_iEndSeconds, $_iEndMonth, $_iEndDay, $_iEndYear);
		$_iCreateTimeStamp = mktime($_iCreateHour, $_iCreateMinutes, $_iCreateSeconds, $_iCreateMonth, $_iCreateDay, $_iCreateYear);
		
		$this->addEvent($_iStartTimeStamp, $_iEndTimeStamp, $_iCreateTimeStamp, $_sSubject, $_sDescription);
	}
	/* @end method */
	
	/*
	@start method
	@param iStartDay
	@param iStartMonth
	@param iStartYear
	@param iStartHour
	@param iStartMinutes
	@param iStartSeconds
	@param iEndDay
	@param iEndMonth
	@param iEndYear
	@param iEndHour
	@param iEndMinutes
	@param iEndSeconds
	@param iCreateTimeStamp
	@param sSubject
	@param sDescription
	*/
	public function addEvent3($_iStartDay = NULL, $_iStartMonth = NULL, $_iStartYear = NULL, $_iStartHour = NULL, $_iStartMinutes = NULL, $_iStartSeconds = NULL, 
							  $_iEndDay = NULL, $_iEndMonth = NULL, $_iEndYear = NULL, $_iEndHour = NULL, $_iEndMinutes = NULL, $_iEndSeconds = NULL, 
							  $_iCreateTimeStamp = NULL, $_sSubject = NULL, $_sDescription = NULL)
	{
		if ($_iStartDay == NULL) {$_iStartDay = date("d");}
		if ($_iStartMonth == NULL) {$_iStartMonth = date("m");}
		if ($_iStartYear == NULL) {$_iStartYear = date("Y");}
		if ($_iStartHour == NULL) {$_iStartHour = 0;}
		if ($_iStartMinutes == NULL) {$_iStartMinutes = 0;}
		if ($_iStartSeconds == NULL) {$_iStartSeconds = 0;}
		
		if ($_iEndDay == NULL) {$_iEndDay = date("d");}
		if ($_iEndMonth == NULL) {$_iEndMonth = date("m");}
		if ($_iEndYear == NULL) {$_iEndYear = date("Y");}
		if ($_iEndHour == NULL) {$_iEndHour = 0;}
		if ($_iEndMinutes == NULL) {$_iEndMinutes = 0;}
		if ($_iEndSeconds == NULL) {$_iEndSeconds = 0;}
		
		$_iStartTimeStamp = mktime($_iStartHour, $_iStartMinutes, $_iStartSeconds, $_iStartMonth, $_iStartDay, $_iStartYear);
		$_iEndTimeStamp = mktime($_iEndHour, $_iEndMinutes, $_iEndSeconds, $_iEndMonth, $_iEndDay, $_iEndYear);
		
		$this->addEvent($_iStartTimeStamp, $_iEndTimeStamp, $_iCreateTimeStamp, $_sSubject, $_sDescription);
	}
	/* @end method */
	
	/*
	@start method
	@param iStartTimeStamp
	@param iEndTimeStamp
	@param iCreateTimeStamp
	@param sSubject
	@param sDescription
	*/
	public function addEvent($_iStartTimeStamp = NULL, $_iEndTimeStamp = NULL, $_iCreateTimeStamp = NULL, $_sSubject = NULL, $_sDescription = NULL)
	{
		$this->axEvents[] = array($_iStartTimeStamp, $_iEndTimeStamp, $_iCreateTimeStamp, $_sSubject, $_sDescription);
	}
	/* @end method */
	
	/* @start method */
	public function build()
	{
		$_sHTML = '';
		$_sHTML .= 'BEGIN:VCALENDAR'.$this->sLineBreak;
		
			$_sHTML .= 'VERSION:2.0'.$this->sLineBreak;
			$_sHTML .= 'PRODID:-//'.$this->sID.'//'.$this->sProductName.'//'.$this->sLineBreak;
			$_sHTML .= 'METHOD:PUBLISH'.$this->sLineBreak;
			// X-CALSTART:20110317T230000Z
			// X-CALEND:20110318T230000Z
			// X-CLIPSTART:20110317T230000Z
			// X-CLIPEND:20110318T230000Z
			// if ($this->sTimeZone != '') {$_sHTML .= 'X-WR-TIMEZONE:'.$this->sTimeZone.$this->sLineBreak;}
			if ($this->sCalendarName != '') {$_sHTML .= 'X-WR-CALNAME:'.utf8_encode($this->sCalendarName).$this->sLineBreak;}
			if ($this->sCalendarDescription != '') {$_sHTML .= 'X-WR-CALDESC:'.utf8_encode($this->sCalendarDescription).$this->sLineBreak;}
	
			for ($i=0; $i<count($this->axEvents); $i++)
			{
				$_sSubject = $this->axEvents[$i][PG_ICALENDAR_EVENT_INDEX_SUBJECT];
				$_sDescription = $this->axEvents[$i][PG_ICALENDAR_EVENT_INDEX_DESCRIPTION];
				$_iStartTimeStamp = $this->axEvents[$i][PG_ICALENDAR_EVENT_INDEX_STARTTIMESTAMP];
				$_iEndTimeStamp = $this->axEvents[$i][PG_ICALENDAR_EVENT_INDEX_ENDTIMESTAMP];
				$_iCreateTimeStamp = $this->axEvents[$i][PG_ICALENDAR_EVENT_INDEX_CREATETIMESTAMP];
				
				$_sHTML .= 'BEGIN:VEVENT'.$this->sLineBreak;
					$_sHTML .= 'UID:'.date('Ymd', $_iCreateTimeStamp).'T'.date('His', $_iCreateTimeStamp).'-12345@example.com'.$this->sLineBreak;
					// $_sHTML .= 'TZID:'.$this->sTimeZone.$this->sLineBreak;
					if (($_sSubject != '') && ($_sSubject != NULL)) {$_sHTML .= 'SUMMARY:'.utf8_encode($_sSubject).$this->sLineBreak;}
					if (($_sDescription != '') && ($_sDescription != NULL)) {$_sHTML .= 'DESCRIPTION:'.utf8_encode($_sDescription).$this->sLineBreak;}
					$_sHTML .= $this->buildICalDate('DTSTART', $_iStartTimeStamp);
					$_sHTML .= $this->buildICalDate('DTEND', $_iEndTimeStamp);
					$_sHTML .= $this->buildICalDate('DTSTAMP', $_iCreateTimeStamp);
					$_sHTML .= $this->buildICalDate('LAST-MODIFIED', $_iCreateTimeStamp);
				$_sHTML .= 'END:VEVENT'.$this->sLineBreak;
			}
			
		$_sHTML .= 'END:VCALENDAR'.$this->sLineBreak;
		return utf8_decode($_sHTML);
	}
	/* @end method */
	
	/*
	@start method
	@param sParameter
	@param iTimeStamp
	*/
	public function buildICalDate($_sParameter, $_iTimeStamp)
	{
		$_sHTML = '';
		if (($_iTimeStamp !== NULL) && ($_iTimeStamp !== 0))
		{
			// if (date("His", $_iTimeStamp) == '000000') {$_sHTML .= $_sParameter.';VALUE=DATE:'.date('Ymd', $_iTimeStamp).$this->sLineBreak;}
			// else
			// {
				$_iTimeStamp = $this->convertTimeStamp($_iTimeStamp);
				$_sHTML .= $_sParameter.':'.date('Ymd', $_iTimeStamp).'T'.date('His', $_iTimeStamp).'Z'.$this->sLineBreak;
			// }
		}
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	@param sFullPath
	*/
	public function convertPath($_sFullPath) {return preg_replace('!http(s)*\:\/\/!im', 'webcal://', $_sFullPath);}
	/* @end method */
}
/* @end class */
$oPGICalendar = new classPG_ICalendar();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGICalendar', 'xValue' => $oPGICalendar));}
/*
$oPGICalendar->putHeader();
$oPGICalendar->setGMTTimeZone(1);
$oPGICalendar->setProductName('MeinKalenderProdukt');
$oPGICalendar->setCalendarName('ProGade Testkalender');
$oPGICalendar->setCalendarDescription('Das ist die Kalenderbeschreibung');
$oPGICalendar->addEvent3(18, 3, 2011, 12, NULL, NULL, 
						18, 3, 2011, 13, NULL, NULL, 
						mktime(5,2,3,03,18,2011),
						'Das ist ein Test3',
						'ABCD3...');
$oPGICalendar->addEvent3(18, 3, 2011, 11, NULL, NULL, 
						18, 3, 2011, 12, 10, NULL, 
						mktime(2,2,3,03,18,2011), 
						'Das ist ein Test2',
						'ABCD2...');
echo $oPGICalendar->build();
*/
?>