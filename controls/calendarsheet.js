/*
* ProGade API
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* Last changes of this file: Nov 14 2012
*/
/*
@start class

@description
[en]This class has methods to create and manage calendar sheets.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen und verwalten von Kalenderblättern.[/de]

@param extends classPG_ClassBasics
*/
function classPG_CalendarSheet()
{
	// Declarations...
	this.asMonths = new Array("", "Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"); 
	this.asWeekDays = new Array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa", "So");

	this.sCssClassTableSheet = 'table_sheet';
	this.sCssClassTableControls = 'table_controls';
	this.sCssClassControlsLink = 'table_controls_link';
	
	this.sCssClassCellsWeeks = 'cells_weeks';
	this.sCssClassCellsWeeksLinkNormal = 'cells_weeks_link_normal';
	this.sCssClassCellsWeeksLinkPressed = 'cells_weeks_link_pressed';
	this.sCssClassCellsDays = 'cells_days';
	
	this.sCssClassCells1 = 'cells1';
	this.sCssClassCells2 = 'cells2';
	this.sCssClassCells1LinkNormal = 'cells1_link_normal';
	this.sCssClassCells2LinkNormal = 'cells2_link_normal';
	this.sCssClassCells1LinkPressed = 'cells1_link_pressed';
	this.sCssClassCells2LinkPressed = 'cells2_link_pressed';

	this.sCssClassCells1Today = 'cells1_today';
	this.sCssClassCells2Today = 'cells2_today';
	this.sCssClassCells1TodayLinkNormal = 'cells1_today_link_normal';
	this.sCssClassCells2TodayLinkNormal = 'cells2_today_link_normal';
	this.sCssClassCells1TodayLinkPressed = 'cells1_today_link_pressed';
	this.sCssClassCells2TodayLinkPressed = 'cells2_today_link_pressed';

	this.sCssClassCellsSaturday = 'cells_saturday';
	this.sCssClassCellsSaturdayLinkNormal = 'cells_saturday_link_normal';
	this.sCssClassCellsSaturdayLinkPressed = 'cells_saturday_link_pressed';

	this.sCssClassCellsSaturdayToday = 'cells_saturday_today';
	this.sCssClassCellsSaturdayTodayLinkNormal = 'cells_saturday_today_link_normal';
	this.sCssClassCellsSaturdayTodayLinkPressed = 'cells_saturday_today_link_pressed';

	this.sCssClassCellsSunday = 'cells_sunday';
	this.sCssClassCellsSundayLinkNormal = 'cells_sunday_link_normal';
	this.sCssClassCellsSundayLinkPressed = 'cells_sunday_link_pressed';
	
	this.sCssClassCellsSundayToday = 'cells_sunday_today';
	this.sCssClassCellsSundayTodayLinkNormal = 'cells_sunday_today_link_normal';
	this.sCssClassCellsSundayTodayLinkPressed = 'cells_sunday_today_link_pressed';

	this.sJsOnDayClick = '';
	this.sJsOnWeekClick = 'oPGCalendarSheet.refreshSheet();';
	this.sJsOnMonthChange = 'oPGCalendarSheet.refreshSheet();';
	this.sJsOnYearChange = 'oPGCalendarSheet.refreshSheet();';
	this.sJsOnMonthNextClick = 'oPGCalendarSheet.refreshSheet();';
	this.sJsOnMonthPreviousClick = 'oPGCalendarSheet.refreshSheet();';

	this.iDay = 0;
	this.iWeek = 0;
	this.iMonth = 0;
	this.iYear = 0;
	
	this.iYearRangeStart = 1900;
	this.iYearRangeEnd = 2100;
	this.bYearControlReverse = false;
	
	// Construct...
	this.setID({'sID': 'PGCalendarSheet'});
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Returns the selected day.[/en]
	[de]Gibt den ausgewählten Tag zurück.[/de]
	
	@return iDay [type]int[/type]
	[en]Returns the selected day as an integer.[/en]
	[de]Gibt den ausgewählten Tag als Integer zurück.[/de]
	*/
	this.getDay = function() {return this.iDay;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the selected week.[/en]
	[de]Gibt die ausgewählte Woche zurück.[/de]
	
	@return iWeek [type]int[/type]
	[en]Returns the selected week as an integer.[/en]
	[de]Gibt die ausgewählte Woche als Integer zurück.[/de]
	*/
	this.getWeek = function() {return this.iWeek;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the selected month.[/en]
	[de]Gibt den ausgewählten Monat zurück.[/de]
	
	@return iMonth [type]int[/type]
	[en]Returns the selected month as an integer.[/en]
	[de]Gibt den ausgewählten Monat als Integer zurück.[/de]
	*/
	this.getMonth = function() {return this.iMonth;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Returns the selected year.[/en]
	[de]Gibt das ausgewählten Jahr zurück.[/de]
	
	@return iYear [type]int[/type]
	[en]Returns the selected year as an integer.[/en]
	[de]Gibt das ausgewählten Jahr als Integer zurück.[/de]
	*/
	this.getYear = function() {return this.iYear;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the selected day.[/en]
	[de]Setzt den ausgewählten Tag.[/de]
	
	@param iDay [needed][type]int[/type]
	[en]The day that was selected.[/en]
	[de]Der Tag der ausgewählt wurde.[/de]
	*/
	this.setDay = function(_iDay)
	{
		_iDay = this.getRealParameter({'oParameters': _iDay, 'sName': 'iDay', 'xParameter': _iDay});
		this.iDay = _iDay;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected week.[/en]
	[de]Setzt die ausgewählte Woche.[/de]
	
	@param iWeek [needed][type]int[/type]
	[en]The week that was selected.[/en]
	[de]Die Woche die ausgewählt wurde.[/de]
	*/
	this.setWeek = function(_iWeek)
	{
		_iWeek = this.getRealParameter({'oParameters': _iWeek, 'sName': 'iWeek', 'xParameter': _iWeek});
		this.iWeek = _iWeek;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected month.[/en]
	[de]Setzt den ausgewählten Monat.[/de]
	
	@param iMonth [needed][type]int[/type]
	[en]The month that was selected.[/en]
	[de]Der Monat der ausgewählt wurde.[/de]
	*/
	this.setMonth = function(_iMonth)
	{
		_iMonth = this.getRealParameter({'oParameters': _iMonth, 'sName': 'iMonth', 'xParameter': _iMonth});
		this.iMonth = _iMonth;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected year.[/en]
	[de]Setzt das ausgewählte Jahr.[/de]

	@param iYear [needed][type]int[/type]
	[en]The year that was selected.[/en]
	[de]Das Jahr das ausgewählt wurde.[/de]
	*/
	this.setYear = function(_iYear)
	{
		_iYear = this.getRealParameter({'oParameters': _iYear, 'sName': 'iYear', 'xParameter': _iYear});
		this.iYear = _iYear;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Resets all (selected) values.[/en]
	[de]Setzt alle (ausgewählten) Werte zurück.[/de]
	*/
	this.resetAll = function()
	{
		this.iDay = 0;
		this.iWeek = 0;
		this.iMonth = 0;
		this.iYear = 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets all selectable values for the calendar sheet.[/en]
	[de]Setzt alle auswählbaren Werte für das Kalenderblatt.[/de]
	
	@param iDay [type]int[/type]
	[en]The day that was selected.[/en]
	[de]Der Tag der ausgewählt wurde.[/de]
	
	@param iWeek [type]int[/type]
	[en]The week that was selected.[/en]
	[de]Die Woche die ausgewählt wurde.[/de]
	
	@param iMonth [type]int[/type]
	[en]The month that was selected.[/en]
	[de]Der Monat der ausgewählt wurde.[/de]
	
	@param iYear [type]int[/type]
	[en]The year that was selected.[/en]
	[de]Das Jahr das ausgewählt wurde.[/de]
	*/
	this.setAll = function(_iDay, _iWeek, _iMonth, _iYear)
	{
		if (typeof(_iDay) == 'undefined') {var _iDay = null;}
		if (typeof(_iWeek) == 'undefined') {var _iWeek = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}

		_iWeek = this.getRealParameter({'oParameters': _iDay, 'sName': 'iWeek', 'xParameter': _iWeek});
		_iMonth = this.getRealParameter({'oParameters': _iDay, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _iDay, 'sName': 'iYear', 'xParameter': _iYear});
		_iDay = this.getRealParameter({'oParameters': _iDay, 'sName': 'iDay', 'xParameter': _iDay});
		
		if (_iDay != null) {this.iDay = _iDay;}
		if (_iWeek != null) {this.iWeek = _iWeek;}
		if (_iMonth != null) {this.iMonth = _iMonth;}
		if (_iYear != null) {this.iYear = _iYear;}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the date to the selected values.[/en]
	[de]Gibt das Datum zu den ausgewählten Werten zurück.[/de]
	
	@return sDate [type]string[/type]
	[en]Returns the date to the selected values as a string.[/en]
	[de]Gibt das Datum zu den ausgewählten Werten als String zurück.[/de]
	*/
	this.getDate = function()
	{
		var _sDate = '';
		if (this.iDay < 10) {_sDate += '0';}
		_sDate += this.iDay+'.';
		if (this.iMonth < 10) {_sDate += '0';}
		_sDate += this.iMonth+'.'+this.iYear;
		return _sDate;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed on clicking the "next month" link.[/en]
	[de]Methode die beim klicken des "nächsten Monat" Links ausgeführt wird.[/de]
	*/
	this.onMonthNextClick = function()
	{
		this.iMonth++;
		if (this.iMonth > 12)
		{
			this.iMonth = 1;
			this.iYear++;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed on clicking the "previous month" link.[/en]
	[de]Methode die beim klicken des "vorherigen Monat" Links ausgeführt wird.[/de]
	*/
	this.onMonthPreviousClick = function()
	{
		this.iMonth--;
		if (this.iMonth < 1)
		{
			this.iMonth = 12;
			this.iYear--;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed on changing the month.[/en]
	[de]Methode die beim wechseln des Monats ausgeführt wird.[/de]
	
	@param sMonthID [needed][type]string[/type]
	[en]The month to which should be changed.[/en]
	[de]Der Monat auf den gewechselt werden soll.[/de]
	*/
	this.onMonthChange = function(_sMonthID)
	{
		_sMonthID = this.getRealParameter({'oParameters': _sMonthID, 'sName': 'sMonthID', 'xParameter': _sMonthID});

		var _oMonth = this.oDocument.getElementById(_sMonthID);
		if (_oMonth)
		{
			this.iMonth = parseInt(_oMonth.options[_oMonth.selectedIndex].value);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed on changing the year.[/en]
	[de]Methode die beim wechseln des Jahres ausgeführt wird.[/de]
	
	@param sYearID [needed][type]string[/type]
	[en]The year to which should be changed.[/en]
	[de]Das Jahr auf das gewechselt werden soll.[/de]
	*/
	this.onYearChange = function(_sYearID)
	{
		_sYearID = this.getRealParameter({'oParameters': _sYearID, 'sName': 'sYearID', 'xParameter': _sYearID});

		var _oYear = this.oDocument.getElementById(_sYearID);
		if (_oYear)
		{
			this.iYear = parseInt(_oYear.options[_oYear.selectedIndex].value);
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed if a link of a day was klicked.[/en]
	[de]Methode die ausgeführt wird sobald der Link eines Tages geklickt wurde.[/de]
	
	@param iDay [needed][type]int[/type]
	[en]The day that should be selected.[/en]
	[de]Der Tag der ausgewählt werden soll.[/de]
	
	@param iMonth [needed][type]int[/type]
	[en]The month that should be selected.[/en]
	[de]Der Monat der ausgewählt werden soll.[/de]
	
	@param iYear [needed][type]int[/type]
	[en]The year that should be selected.[/en]
	[de]Das Jahr das ausgewählt werden soll.[/de]
	*/
	this.onDayClick = function(_iDay, _iMonth, _iYear)
	{
		if (typeof(_iDay) == 'undefined') {var _iDay = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}

		_iMonth = this.getRealParameter({'oParameters': _iDay, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _iDay, 'sName': 'iYear', 'xParameter': _iYear});
		_iDay = this.getRealParameter({'oParameters': _iDay, 'sName': 'iDay', 'xParameter': _iDay});
		
		this.iDay = _iDay;
		this.iMonth = _iMonth;
		this.iYear = _iYear;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Method that is executed if a link of a week was klicked.[/en]
	[de]Methode die ausgeführt wird sobald der Link einer Woche geklickt wurde.[/de]
	
	@param iWeek [needed][type]int[/type]
	[en]The week that should be selected.[/en]
	[de]Die Woche die ausgewählt werden soll.[/de]
	
	@param iMonth [needed][type]int[/type]
	[en]The month that should be selected.[/en]
	[de]Der Monat der ausgewählt werden soll.[/de]
	
	@param iYear [needed][type]int[/type]
	[en]The year that should be selected.[/en]
	[de]Das Jahr das ausgewählt werden soll.[/de]
	*/
	this.onWeekClick = function(_iWeek, _iMonth, _iYear)
	{
		if (typeof(_iWeek) == 'undefined') {var _iWeek = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}

		_iMonth = this.getRealParameter({'oParameters': _iWeek, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _iWeek, 'sName': 'iYear', 'xParameter': _iYear});
		_iWeek = this.getRealParameter({'oParameters': _iWeek, 'sName': 'iWeek', 'xParameter': _iWeek});
		
		this.iWeek = _iWeek;
		this.iMonth = _iMonth;
		this.iYear = _iYear;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the appropriate CSS class for links to the specified parameters.[/en]
	[de]Gibt die passende CSS Klasse für Links zu den angegebenen Parametern zurück.[/de]
	
	@return sCssClass [type]string[/type]
	[en]Returns the appropriate CSS class to the specified parameters as a string.[/en]
	[de]Gibt die passende CSS Klasse zu den angegebenen Parametern als String zurück.[/de]
	
	@param bClass2 [type]bool[/type]
	[en]Specifies whether the changing cell formatting should use the second class.[/en]
	[de]Gibt an ob die wechselnde Zellenformatierung die zweite Klasse verwenden soll.[/de]
	
	@param sWeekDayName [type]string[/type]
	[en]The name of the day.[/en]
	[de]Der Name des Tages.[/de]
	
	@param iDay [type]int[/type]
	[en]The selected day.[/en]
	[de]Der ausgewählte Tag.[/de]
	
	@param iCalendarDay [type]int[/type]
	[en]The day of the month.[/en]
	[de]Der Tag vom Monat.[/de]
	
	@param iMonth [type]int[/type]
	[en]The month of the year.[/en]
	[de]Der Monat des Jahres.[/de]
	
	@param iYear [type]int[/type]
	[en]The year of the calendar sheet.[/en]
	[de]Das Jahr des Kalenderblatts.[/de]
	*/
	this.getCssClassForCellsLink = function(_bClass2, _sWeekDayName, _iDay, _iCalendarDay, _iMonth, _iYear)
	{
		if (typeof(_sWeekDayName) == 'undefined') {var _sWeekDayName = null;}
		if (typeof(_iDay) == 'undefined') {var _iDay = null;}
		if (typeof(_iCalendarDay) == 'undefined') {var _iCalendarDay = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}
	
		_sWeekDayName = this.getRealParameter({'oParameters': _bClass2, 'sName': 'sWeekDayName', 'xParameter': _sWeekDayName});
		_iDay = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iDay', 'xParameter': _iDay});
		_iCalendarDay = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iCalendarDay', 'xParameter': _iCalendarDay});
		_iMonth = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iYear', 'xParameter': _iYear});
		_bClass2 = this.getRealParameter({'oParameters': _bClass2, 'sName': 'bClass2', 'xParameter': _bClass2});

		if (_bClass2 == null) {_bClass2 = false;}
		
		var _oDateNow = new Date();
		
		var _sHTML = '';
		var _iActualMonth = _oDateNow.getMonth()+1;		// ermitteln des aktuellen Monats 
		var _iActualDay = _oDateNow.getDate();			// ermitteln des aktuellen Tages 
		var _iActualYear = _oDateNow.getFullYear();		// ermitteln des aktuellen Jahres
		
		if (_sWeekDayName == "Sa")
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_iDay == _iCalendarDay) {_sHTML += this.sCssClassCellsSaturdayTodayLinkPressed;}
				else {_sHTML += this.sCssClassCellsSaturdayTodayLinkNormal;}
			}
			else
			{
				if (_iDay == _iCalendarDay) {_sHTML += this.sCssClassCellsSaturdayLinkPressed;}
				else {_sHTML += this.sCssClassCellsSaturdayLinkNormal;}
			}
		}
		else if (_sWeekDayName == "So")
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_iDay == _iCalendarDay) {_sHTML += this.sCssClassCellsSundayTodayLinkPressed;}
				else {_sHTML += this.sCssClassCellsSundayTodayLinkNormal;}
			}
			else
			{
				if (_iDay == _iCalendarDay) {_sHTML += this.sCssClassCellsSundayLinkPressed;}
				else {_sHTML += this.sCssClassCellsSundayLinkNormal;}
			}
		}
		else
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_iDay == _iCalendarDay)
				{
					if (_bClass2 == false) {_sHTML += this.sCssClassCells1TodayLinkPressed;}
					else {_sHTML += this.sCssClassCells2TodayLinkPressed;}
				}
				else
				{
					if (_bClass2 == false) {_sHTML += this.sCssClassCells1TodayLinkNormal;}
					else {_sHTML += this.sCssClassCells2TodayLinkNormal;}
				}
			}
			else
			{
				if (_iDay == _iCalendarDay)
				{
					if (_bClass2 == false) {_sHTML += this.sCssClassCells1LinkPressed;}
					else {_sHTML += this.sCssClassCells2LinkPressed;}
				}
				else
				{
					if (_bClass2 == false) {_sHTML += this.sCssClassCells1LinkNormal;}
					else {_sHTML += this.sCssClassCells2LinkNormal;}
				}
			}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the appropriate CSS class for cells to the specified parameters.[/en]
	[de]Gibt die passende CSS Klasse für Zellen zu den angegebenen Parametern zurück.[/de]
	
	@return sCssClass [type]string[/type]
	[en]Returns the appropriate CSS class for cells to the specified parameters as a string.[/en]
	[de]Gibt die passende CSS Klasse für Zellen zu den angegebenen Parametern als String zurück.[/de]
	
	@param bClass2 [type]bool[/type]
	[en]Specifies whether the changing cell formatting should use the second class.[/en]
	[de]Gibt an ob die wechselnde Zellenformatierung die zweite Klasse verwenden soll.[/de]
	
	@param sWeekDayName [type]string[/type]
	[en]The name of the day.[/en]
	[de]Der Name des Tages.[/de]
	
	@param iCalendarDay [type]int[/type]
	[en]The day of the month.[/en]
	[de]Der Tag vom Monat.[/de]
	
	@param iMonth [type]int[/type]
	[en]The month of the year.[/en]
	[de]Der Monat des Jahres.[/de]
	
	@param iYear [type]int[/type]
	[en]The year of the calendar sheet.[/en]
	[de]Das Jahr des Kalenderblatts.[/de]
	*/
	this.getCssClassForCells = function(_bClass2, _sWeekDayName, _iCalendarDay, _iMonth, _iYear)
	{
		if (typeof(_sWeekDayName) == 'undefined') {var _sWeekDayName = null;}
		if (typeof(_iCalendarDay) == 'undefined') {var _iCalendarDay = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}
	
		_sWeekDayName = this.getRealParameter({'oParameters': _bClass2, 'sName': 'sWeekDayName', 'xParameter': _sWeekDayName});
		_iCalendarDay = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iCalendarDay', 'xParameter': _iCalendarDay});
		_iMonth = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _bClass2, 'sName': 'iYear', 'xParameter': _iYear});
		_bClass2 = this.getRealParameter({'oParameters': _bClass2, 'sName': 'bClass2', 'xParameter': _bClass2});

		if (_bClass2 == null) {_bClass2 = false;}
		
		var _oDateNow = new Date();

		var _sHTML = '';
		var _iActualMonth = _oDateNow.getMonth()+1;		// ermitteln des aktuellen Monats 
		var _iActualDay = _oDateNow.getDate();			// ermitteln des aktuellen Tages 
		var _iActualYear = _oDateNow.getFullYear();		// ermitteln des aktuellen Jahres
		
		if (_sWeekDayName == "Sa")
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCellsSaturdayToday;}
				else {_sHTML += this.sCssClassCellsSaturdayToday;}
			}
			else
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCellsSaturday;}
				else {_sHTML += this.sCssClassCellsSaturday;}
			}
		}
		else if (_sWeekDayName == "So")
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCellsSundayToday;}
				else {_sHTML += this.sCssClassCellsSundayToday;}
			}
			else
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCellsSunday;}
				else {_sHTML += this.sCssClassCellsSunday;}
			}
		}
		else
		{
			if ((_iCalendarDay == _iActualDay) && (_iMonth == _iActualMonth) && (_iYear == _iActualYear))
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCells1Today;}
				else {_sHTML += this.sCssClassCells2Today;}
			}
			else
			{
				if (_bClass2 == false) {_sHTML += this.sCssClassCells1;}
				else {_sHTML += this.sCssClassCells2;}
			}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the calendar sheet and returns it.[/en]
	[de]Erstellt das Kalenderblatt und gibt es zurück.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns the calendar sheet as an HTML string.[/en]
	[de]Gibt das Kalenderblatt als HTML String zurück.[/de]
	
	@param iDay [needed][type]int[/type]
	[en]The selected day.[/en]
	[de]Der ausgewählte Tag.[/de]
	
	@param iWeek [needed][type]int[/type]
	[en]The selected week.[/en]
	[de]Die ausgewählte Woche.[/de]
	
	@param iMonth [needed][type]int[/type]
	[en]The selected month.[/en]
	[de]Der ausgewählte Monat.[/de]
	
	@param iYear [needed][type]int[/type]
	[en]The selected year.[/en]
	[de]Das ausgewählte Jahr.[/de]
	*/
	this.buildSheet = function(_iDay, _iWeek, _iMonth, _iYear)
	{
		if (typeof(_iDay) == 'undefined') {var _iDay = null;}
		if (typeof(_iWeek) == 'undefined') {var _iWeek = null;}
		if (typeof(_iMonth) == 'undefined') {var _iMonth = null;}
		if (typeof(_iYear) == 'undefined') {var _iYear = null;}
	
		_iWeek = this.getRealParameter({'oParameters': _iDay, 'sName': 'iWeek', 'xParameter': _iWeek});
		_iMonth = this.getRealParameter({'oParameters': _iDay, 'sName': 'iMonth', 'xParameter': _iMonth});
		_iYear = this.getRealParameter({'oParameters': _iDay, 'sName': 'iYear', 'xParameter': _iYear});
		_iDay = this.getRealParameter({'oParameters': _iDay, 'sName': 'iDay', 'xParameter': _iDay});

		if (_iYear == null) {_iYear = 0;}
		if (_iMonth == null) {_iMonth = 0;}
		if (_iDay == null) {_iDay = 0;}
		
		var _sHtml = '';
		
		var _oDateNow = new Date();
		var _oDate = new Date(_iYear, _iMonth-1, _iDay);
		
		var _bClass2 = true;
		var _iActualMonth = _oDateNow.getMonth()+1;		// ermitteln des aktuellen Monats 
		var _iActualDay = _oDateNow.getDate();			// ermitteln des aktuellen Tages 
		var _iActualYear = _oDateNow.getFullYear();		// ermitteln des aktuellen Jahres
		
		if (_iYear == 0) {_iYear = _iActualYear;}
		if (_iMonth == 0) {_iMonth = _iActualMonth;}
		if (_iDay == 0) {_iDay = _iActualDay;}
		
		// ermitteln des letzten Tages des Monats...
		var _iLastDay = 31;
		if ((_iMonth == 4) || (_iMonth == 6) || (_iMonth == 9) || (_iMonth == 11)) {_iLastDay--;}
		else if (_iMonth == 2)
		{
			_iLastDay = _iLastDay-3;
			if (_iYear % 4 == 0) {_iLastDay++;}
			if (_iYear % 100 == 0) {_iLastDay--;}
			if (_iYear % 400 == 0) {_iLastDay++;}
		}
		
		// erste Tag im Monat...
		var _iFirstWeekDay = (new Date(_iYear, _iMonth-1, 1)).getDay();
		if (_iFirstWeekDay == 0) {_iFirstWeekDay = 7;}					// Korrektur f�r den Sonntag
		
		_sHtml += '<table class="'+this.sCssClassTableControls+'" style="border-collapse:collapse;" align="center" cellspacing="0" cellpadding="0">';
		_sHtml += '<tr>';
			_sHtml += '<td><a href="javascript:;" class="'+this.sCssClassControlsLink+'" onclick="oPGCalendarSheet.onMonthPreviousClick(); '+this.sJsOnMonthPreviousClick+'" target="_self">&lt;&lt;</a></td>';
			_sHtml += '<td>';
			_sHtml += '<select id="'+this.getID()+'Month" onchange="oPGCalendarSheet.onMonthChange({\'sMonthID\': \''+this.getID()+'Month\'}); '+this.sJsOnMonthChange+'">';
				for (var i=1; i<this.asMonths.length; i++)
				{
					_sHtml += '<option value="'+i+'" ';
					if (_iMonth == i) {_sHtml += 'selected ';}
					_sHtml += '>'+this.asMonths[i]+'</option>';
				}
			_sHtml += '</select>';
			_sHtml += '</td>';
			_sHtml += '<td>';
			_sHtml += '<select id="'+this.getID()+'Year" onchange="oPGCalendarSheet.onYearChange({\'sYearID\': \''+this.getID()+'Year\'}); '+this.sJsOnYearChange+'">';
				if (this.bYearControlReverse == true)
				{
					for (var i=this.iYearRangeEnd; i>=this.iYearRangeStart; i--)
					{
						_sHtml += '<option value="'+i+'" ';
						if (_iYear == i) {_sHtml += 'selected ';}
						_sHtml += '>'+i+'</option>';
					}
				}
				else
				{
					for (i=this.iYearRangeStart; i<=this.iYearRangeEnd; i++)
					{
						_sHtml += '<option value="'+i+'" ';
						if (_iYear == i) {_sHtml += 'selected ';}
						_sHtml += '>'+i+'</option>';
					}
				}
			_sHtml += '</select>';
			_sHtml += '</td>';
			_sHtml += '<td><a href="javascript:;" class="'+this.sCssClassControlsLink+'" onclick="oPGCalendarSheet.onMonthNextClick(); '+this.sJsOnMonthNextClick+'" target="_self">&gt;&gt;</a></td>';
		_sHtml += '</tr>';
		_sHtml += '</table>';
		_sHtml += '<br />';
		
		_sHtml += '<table class="'+this.sCssClassTableSheet+'" style="border-collapse:collapse;" align="center" cellspacing="0" cellpadding="0">';

		// Days (Mo-So)...
		_sHtml += '<tr>';
			_sHtml += '<td class="'+this.sCssClassCellsWeeks+'" style="width:20px; height:20px; text-align:center; vertical-align:center;">KW</td>';
			for (var i=1; i<this.asWeekDays.length; i++)
			{
				_sHtml += '<td style="width:20px; height:20px; text-align:center; vertical-align:middle;" ';
				_sHtml += 'class="'+this.sCssClassCellsDays+'">';
				_sHtml += this.asWeekDays[i]+'</td>';
			}
		_sHtml += '</tr>';
		
		_sHtml += '<tr>';
			// Kalenderwoche...
			var _iCalendarWeek = oPGDate.getCalendarWeek(new Date(_iYear,_iMonth-1,1));
			_sHtml += '<td class="'+this.sCssClassCellsWeeks+'" style="width:20px; height:20px; text-align:center; vertical-align:center;">';
			if (this.sJsOnWeekClick != '')
			{
				_sHtml += '<a href="javascript:;" ';
				_sHtml += ' onclick="oPGCalendarSheet.onWeekClick({\'iWeek\': '+_iCalendarWeek+', \'iMonth\': '+_iMonth+', \'iYear\': '+_iYear+'}); '+this.sJsOnWeekClick+'" ';
				if (_iWeek == _iCalendarWeek) {_sHtml += 'class="'+this.sCssClassCellsWeeksLinkPressed+'" ';}
				else {_sHtml += 'class="'+this.sCssClassCellsWeeksLinkNormal+'" ';}
				_sHtml += 'target="_self">';
			}
			_sHtml += _iCalendarWeek;
			if (this.sJsOnWeekClick != '') {_sHtml += '</a>';}
			_sHtml += '</td>';
	
			// Leere Zellen ausgeben, bis zum ersten Tag des Monats...
			// _bClass2 = true;
			var _iCalendarDay = 0;
			var _iCurrentRowTDCount = 0;
			var _sCurrentClass = this.sCssClassCells1;
			var _sWeekDayName = '';
			for (j=1; j<_iFirstWeekDay; j++)
			{
				if (_bClass2 == false) {_bClass2 = true;} else {_bClass2 = false;}
				_sWeekDayName = '';
				
				_iCalendarDay = j;
				_sHtml += '<td class="'+this.getCssClassForCells({'bClass2': _bClass2, 'sWeekDayName': _sWeekDayName, 'iCalendarDay': _iCalendarDay, 'iMonth': _iMonth, 'iYear': _iYear})+'" ';
				_sHtml += 'style="width:20px; height:20px; text-align:center; vertical-align:center;"></td>';
			}

			// _bClass2 = true;
			var _oTempDate;
			for (_iCalendarDay=1; _iCalendarDay<=_iLastDay; _iCalendarDay++)
			{ 
				if (_bClass2 == false) {_bClass2 = true;} else {_bClass2 = false;}
				_oTempDate = new Date(_iYear, _iMonth-1, _iCalendarDay);
				_sWeekDayName = this.asWeekDays[_oTempDate.getDay()];		// ermitteln des Wochentages

				_sHtml += '<td class="'+this.getCssClassForCells(_bClass2, _sWeekDayName, _iCalendarDay, _iMonth, _iYear)+'" ';
				_sHtml += 'style="width:20px; height:20px; text-align:center; vertical-align:center;">';
				_sHtml += '<a href="javascript:;" class="'+this.getCssClassForCellsLink({'bClass2': _bClass2, 'sWeekDayName': _sWeekDayName, 'iDay': _iDay, 'iCalendarDay': _iCalendarDay, 'iMonth': _iMonth, 'iYear': _iYear})+'" ';
				_sHtml += ' onclick="oPGCalendarSheet.onDayClick({\'iDay\': '+_iCalendarDay+', \'iMonth\': '+_iMonth+', \'iYear\': '+_iYear+'}); '+this.sJsOnDayClick+'" ';
				_sHtml += 'target="_self">'+_iCalendarDay+'</a>';
				_sHtml += '</td>';
				_iCurrentRowTDCount++;
	
				if ((_sWeekDayName == "So") && (_iCalendarDay < _iLastDay))
				{
					_sHtml += '</tr><tr>';
	
					// Kalenderwoche...
					_iCalendarWeek = oPGDate.getCalendarWeek(new Date(_iYear, _iMonth-1, _iCalendarDay+1)); // date("W", mktime(0,0,0,$_iMonth,$_iCalendarDay+1,$_iYear));
					_sHtml += '<td class="'+this.sCssClassCellsWeeks+'" style="width:20px; height:20px; text-align:center; vertical-align:center;">';
					if (this.sJsOnWeekClick != '')
					{
						_sHtml += '<a href="javascript:;" ';
						_sHtml += ' onclick="oPGCalendarSheet.onWeekClick({\'iWeek\': '+_iCalendarWeek+', \'iMonth\': '+_iMonth+', \'iYear\': '+_iYear+'}); '+this.sJsOnWeekClick+'" ';
						if (_iWeek == _iCalendarWeek) {_sHtml += 'class="'+this.sCssClassCellsWeeksLinkPressed+'" ';}
						else {_sHtml += 'class="'+this.sCssClassCellsWeeksLinkNormal+'" ';}
						_sHtml += 'target="_self">';
					}
					_sHtml += _iCalendarWeek;
					if (this.sJsOnWeekClick != '') {_sHtml += '</a>';}
					_sHtml += '</td>';

					_iCurrentRowTDCount = 0;
					_bClass2 = true;
				}
			} 

			// Leere Zellen ausgeben, bis zum ende der Liste 
			// $_bClass2 = true;
			if (_iCurrentRowTDCount > 0)
			{
				for (var o=_iCurrentRowTDCount; o<7; o++)
				{
					if (_bClass2 == false) {_bClass2 = true;} else {_bClass2 = false;}
					_sWeekDayName = '';
					
					_sHtml += '<td class="'+this.getCssClassForCells({'bClass2': _bClass2, 'sWeekDayName': _sWeekDayName, 'iCalendarDay': _iCalendarDay, 'iMonth': _iMonth, 'iYear': _iYear})+'" ';
					_sHtml += ' style="width:20px; height:20px; text-align:center; vertical-align:center;"></td>';
				}
			}
			
		_sHtml += '</tr>';
		_sHtml += '</table>';
		return _sHtml;
	}
	/* @end method */

    /*
    @start method
    */
	this.refreshSheet = function()
	{
		var _oCalendarSheet = this.oDocument.getElementById(this.getID());
		if (_oCalendarSheet) {_oCalendarSheet.innerHTML = this.buildSheet({'iDay': this.iDay, 'iWeek': this.iWeek, 'iMonth': this.iMonth, 'iYear': this.iYear});;}
	}
    /* @end method */
}
/* @end class */
classPG_CalendarSheet.prototype = new classPG_ClassBasics();
var oPGCalendarSheet = new classPG_CalendarSheet();
