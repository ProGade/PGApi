<?php
/*
* ProGade API
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
*
* Last changes of this file: Nov 14 2012
*/
/*
@start class

@description
[en]This class has methods to create and manage calendar sheets.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen und verwalten von Kalenderblättern.[/de]

@param extends classPG_ClassBasics
*/
class classPG_CalendarSheet extends classPG_ClassBasics
{
	// Declarations...
	private $asMonths = array("", "Januar", "Februar", "M&auml;rz","April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"); 
	private $asWeekDays = array("So", "Mo", "Di", "Mi","Do", "Fr", "Sa", "So");
	
	private $sCssClassTableSheet = 'table_sheet';
	private $sCssClassTableControls = 'table_controls';
	private $sCssClassControlsLink = 'table_controls_link';
	
	private $sCssClassCellsWeeks = 'cells_weeks';
	private $sCssClassCellsWeeksLinkNormal = 'cells_weeks_link_normal';
	private $sCssClassCellsWeeksLinkPressed = 'cells_weeks_link_pressed';
	private $sCssClassCellsDays = 'cells_days';
	
	private $sCssClassCells1 = 'cells1';
	private $sCssClassCells2 = 'cells2';
	private $sCssClassCells1LinkNormal = 'cells1_link_normal';
	private $sCssClassCells2LinkNormal = 'cells2_link_normal';
	private $sCssClassCells1LinkPressed = 'cells1_link_pressed';
	private $sCssClassCells2LinkPressed = 'cells2_link_pressed';

	private $sCssClassCells1Today = 'cells1_today';
	private $sCssClassCells2Today = 'cells2_today';
	private $sCssClassCells1TodayLinkNormal = 'cells1_today_link_normal';
	private $sCssClassCells2TodayLinkNormal = 'cells2_today_link_normal';
	private $sCssClassCells1TodayLinkPressed = 'cells1_today_link_pressed';
	private $sCssClassCells2TodayLinkPressed = 'cells2_today_link_pressed';

	private $sCssClassCellsSaturday = 'cells_saturday';
	private $sCssClassCellsSaturdayLinkNormal = 'cells_saturday_link_normal';
	private $sCssClassCellsSaturdayLinkPressed = 'cells_saturday_link_pressed';

	private $sCssClassCellsSaturdayToday = 'cells_saturday_today';
	private $sCssClassCellsSaturdayTodayLinkNormal = 'cells_saturday_today_link_normal';
	private $sCssClassCellsSaturdayTodayLinkPressed = 'cells_saturday_today_link_pressed';

	private $sCssClassCellsSunday = 'cells_sunday';
	private $sCssClassCellsSundayLinkNormal = 'cells_sunday_link_normal';
	private $sCssClassCellsSundayLinkPressed = 'cells_sunday_link_pressed';
	
	private $sCssClassCellsSundayToday = 'cells_sunday_today';
	private $sCssClassCellsSundayTodayLinkNormal = 'cells_sunday_today_link_normal';
	private $sCssClassCellsSundayTodayLinkPressed = 'cells_sunday_today_link_pressed';

	private $sJsOnDayClick = '';
	private $sJsOnWeekClick = 'oPGCalendarSheet.refreshSheet();';
	private $sJsOnMonthChange = 'oPGCalendarSheet.refreshSheet();';
	private $sJsOnYearChange = 'oPGCalendarSheet.refreshSheet();';
	private $sJsOnMonthNextClick = 'oPGCalendarSheet.refreshSheet();';
	private $sJsOnMonthPreviousClick = 'oPGCalendarSheet.refreshSheet();';

	private $iDay = 0;
	private $iWeek = 0;
	private $iMonth = 0;
	private $iYear = 0;
	
	private $iYearRangeStart = 1900;
	private $iYearRangeEnd = 2100;
	private $bYearControlReverse = false;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCalendarSheet'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_calendarsheet.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_calendarsheet.php',
                'foundation' => 'gfx/default/templates/controls/foundation_calendarsheet.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table of a calendar sheet.[/en]
	[de]Setzt eine CSS Klasse für die Tabelle eines Kalenderblatts.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the table.[/en]
	[de]Die CSS Klasse für die Tabelle.[/de]
	*/
	public function setCssClassTableSheet($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassTableSheet = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table of the controls of a calendar sheet.[/en]
	[de]Setzt eine CSS Klasse für die Tabelle der Bedienelemente eines Kalenderblatts.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the table.[/en]
	[de]Die CSS Klasse für die Tabelle.[/de]
	*/
	public function setCssClassTableControls($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassTableControls = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the links of controls of a calender sheet.[/en]
	[de]Setzt eine CSS Klasse für die Links von Bedienelementen eines Kalenderblatts.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassControlsLink($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassControlsLink = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of weeks.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Wochen.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsWeeks($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsWeeks = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of weeks.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Wochen.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsWeeksLinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsWeeksLinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of weeks.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Wochen.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsWeeksLinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsWeeksLinkPressed = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsDays($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsDays = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCells1($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1 = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCells2($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2 = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells1LinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1LinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells2LinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2LinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells1LinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1LinkPressed = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of days.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Tage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells2LinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2LinkPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cell.[/en]
	[de]Die CSS Klasse für die Zelle.[/de]
	*/
	public function setCssClassCells1Today($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1Today = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cell.[/en]
	[de]Die CSS Klasse für die Zelle.[/de]
	*/
	public function setCssClassCells2Today($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2Today = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells1TodayLinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1TodayLinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells2TodayLinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2TodayLinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells1TodayLinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells1TodayLinkPressed = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cell of today.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zelle vom heutigen Tag.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCells2TodayLinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCells2TodayLinkPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of saturdays.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Samstage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsSaturday($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturday = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of saturdays.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Samstage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSaturdayNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturdayNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of saturdays.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Samstage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSaturdayPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturdayPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of saturday of today.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Samstage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsSaturdayToday($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturdayToday = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of saturday of today.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Samstage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSaturdayTodayNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturdayTodayNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of saturday of today.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Samstage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSaturdayTodayPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSaturdayTodayPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of sundays.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Sonntage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsSunday($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSunday = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of sundays.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Sonntage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSundayLinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSundayLinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of sundays.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Sonntage.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSundayLinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSundayLinkPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets a CSS class for the table cells of sunday of today.[/en]
	[de]Setzt eine CSS Klasse für die Tabellen-Zellen der Sonntage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the cells.[/en]
	[de]Die CSS Klasse für die Zellen.[/de]
	*/
	public function setCssClassCellsSundayToday($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSundayToday = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the normal state of links in the table cells of sunday of today.[/en]
	[de]Setzt eine CSS Klasse für den normalen Zustand von Links in Tabellen-Zellen der Sonntage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSundayTodayLinkNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSundayTodayLinkNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets a CSS class for the pressed state of links in the table cells of sunday of today.[/en]
	[de]Setzt eine CSS Klasse für den gedrückt Zustand von Links in Tabellen-Zellen der Sonntage des heutigen Tages.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the links.[/en]
	[de]Die CSS Klasse für die Links.[/de]
	*/
	public function setCssClassCellsSundayTodayLinkPressed($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassCellsSundayTodayLinkPressed = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the selected day of the calendar sheet.[/en]
	[de]Setzt den ausgewählten Tag des Kalenderblatts.[/de]
	
	@param iDay [needed][type]int[/type]
	[en]The selected day.[/en]
	[de]Der ausgewählte Tag.[/de]
	*/
	public function setDay($_iDay)
	{
		$_iDay = $this->getRealParameter(array('oParameters' => $_iDay, 'sName' => 'iDay', 'xParameter' => $_iDay));
		$this->iDay = $_iDay;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected week of the calendar sheet.[/en]
	[de]Setzt die ausgewählten Woche des Kalenderblatts.[/de]
	
	@param iWeek [needed][type]int[/type]
	[en]The selected week.[/en]
	[de]Die ausgewählte Woche.[/de]
	*/
	public function setWeek($_iWeek)
	{
		$_iWeek = $this->getRealParameter(array('oParameters' => $_iWeek, 'sName' => 'iWeek', 'xParameter' => $_iWeek));
		$this->iWeek = $_iWeek;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected month of the calendar sheet.[/en]
	[de]Setzt den ausgewählten Monat des Kalenderblatts.[/de]
	
	@param iMonth [needed][type]int[/type]
	[en]The selected month.[/en]
	[de]Der ausgewählte Monat.[/de]
	*/
	public function setMonth($_iMonth)
	{
		$_iMonth = $this->getRealParameter(array('oParameters' => $_iMonth, 'sName' => 'iMonth', 'xParameter' => $_iMonth));
		$this->iMonth = $_iMonth;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the selected year of the calendar sheet.[/en]
	[de]Setzt das ausgewählte Jahr des Kalenderblatts.[/de]
	
	@param iYear [needed][type]int[/type]
	[en]The selected year.[/en]
	[de]Das ausgewählte Jahr.[/de]
	*/
	public function setYear($_iYear)
	{
		$_iYear = $this->getRealParameter(array('oParameters' => $_iYear, 'sName' => 'iYear', 'xParameter' => $_iYear));
		$this->iYear = $_iYear;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the period of years which should be available to the selection.[/en]
	[de]Setzt den Zeitraum an Jahren der zur Auswahl zur verfügung stehen soll.[/de]
	
	@param iStart [type]int[/type]
	[en]The start year with 4 digits.[/en]
	[de]Das Startjahr mit 4 Stellen.[/de]
	
	@param iEnd [type]int[/type]
	[en]The end year with 4 digits.[/en]
	[de]Das Endjahr mit 4 Stellen.[/de]
	*/
	public function setYearRange($_iStart, $_iEnd = NULL)
	{
		$_iEnd = $this->getRealParameter(array('oParameters' => $_iStart, 'sName' => 'iEnd', 'xParameter' => $_iEnd));
		$_iStart = $this->getRealParameter(array('oParameters' => $_iStart, 'sName' => 'iStart', 'xParameter' => $_iStart));

		if ($_iStart != NULL) {$this->iYearRangeStart = $_iStart;}
		if ($_iEnd != NULL) {$this->iYearRangeEnd = $_iEnd;}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Specifies whether the order of the selectable available years will be displayed backwards.[/en]
	[de]Gibt an ob die Reihenfolge der zur Auswahl stehenden Jahre rückwärts angezeigt werden soll.[/de]
	
	@param bReverse [needed][type]bool[/type]
	[en]Specifies whether the order of the selectable available years will be displayed backwards.[/en]
	[de]Gibt an ob die Reihenfolge der zur Auswahl stehenden Jahre rückwärts angezeigt werden soll.[/de]
	*/
	public function setYearControlReverse($_bReverse)
	{
		$_bReverse = $this->getRealParameter(array('oParameters' => $_bReverse, 'sName' => 'bReverse', 'xParameter' => $_bReverse));
		$this->bYearControlReverse = $_bReverse;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets JavaScript code on links of days.[/en]
	[de]Setzt JavaScript Code auf Links der Tage.[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnDayClick($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnDayClick = $_sJavaScript;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets JavaScript code on links of weeks.[/en]
	[de]Setzt JavaScript Code auf Links der Wochen.[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnWeekClick($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnWeekClick = $_sJavaScript;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets JavaScript code on changing of months.[/en]
	[de]Setzt JavaScript Code auf das Wechseln der Monate.[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnMonthChange($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnMonthChange = $_sJavaScript;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets JavaScript code on changing of years.[/en]
	[de]Setzt JavaScript Code auf das Wechseln der Jahre.[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnYearChange($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnYearChange = $_sJavaScript;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets JavaScript code on the link of "next month".[/en]
	[de]Setzt JavaScript Code auf den Link des "nächsten Monats".[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnMonthNextClick($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnMonthNextClick = $_sJavaScript;
	}
	/* @end method */
	
	/*
	@start method

	@description
	[en]Sets JavaScript code on the link of "previous month".[/en]
	[de]Setzt JavaScript Code auf den Link des "vorherigen Monats".[/de]
	
	@param sJavaScript [needed][type]string[/type]
	[en]The JavaScript code that should be executed.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll.[/de]
	*/
	public function setJsOnMonthPreviousClick($_sJavaScript)
	{
		$_sJavaScript = $this->getRealParameter(array('oParameters' => $_sJavaScript, 'sName' => 'sJavaScript', 'xParameter' => $_sJavaScript));
		$this->sJsOnMonthPreviousClick = $_sJavaScript;
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
	public function getCssClassForCellsLink($_bClass2, $_sWeekDayName = NULL, $_iDay = NULL, $_iCalendarDay = NULL, $_iMonth = NULL, $_iYear = NULL)
	{
		$_sWeekDayName = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'sWeekDayName', 'xParameter' => $_sWeekDayName));
		$_iDay = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iDay', 'xParameter' => $_iDay));
		$_iCalendarDay = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iCalendarDay', 'xParameter' => $_iCalendarDay));
		$_iMonth = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iMonth', 'xParameter' => $_iMonth));
		$_iYear = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iYear', 'xParameter' => $_iYear));
		$_bClass2 = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'bClass2', 'xParameter' => $_bClass2));

		if ($_bClass2 === NULL) {$_bClass2 = false;}
		
		$_sHTML = '';
		$_iActualMonth = date("n");			// ermitteln des aktuellen Monats 
		$_iActualDay = date("j");			// ermitteln des aktuellen Tages 
		$_iActualYear = date("Y");			// ermitteln des aktuellen Jahres
		
		if ($_sWeekDayName == "Sa")
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_iDay == $_iCalendarDay) {$_sHTML .= $this->sCssClassCellsSaturdayTodayLinkPressed;}
				else {$_sHTML .= $this->sCssClassCellsSaturdayTodayLinkNormal;}
			}
			else
			{
				if ($_iDay == $_iCalendarDay) {$_sHTML .= $this->sCssClassCellsSaturdayLinkPressed;}
				else {$_sHTML .= $this->sCssClassCellsSaturdayLinkNormal;}
			}
		}
		else if ($_sWeekDayName == "So")
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_iDay == $_iCalendarDay) {$_sHTML .= $this->sCssClassCellsSundayTodayLinkPressed;}
				else {$_sHTML .= $this->sCssClassCellsSundayTodayLinkNormal;}
			}
			else
			{
				if ($_iDay == $_iCalendarDay) {$_sHTML .= $this->sCssClassCellsSundayLinkPressed;}
				else {$_sHTML .= $this->sCssClassCellsSundayLinkNormal;}
			}
		}
		else
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_iDay == $_iCalendarDay)
				{
					if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1TodayLinkPressed;}
					else {$_sHTML .= $this->sCssClassCells2TodayLinkPressed;}
				}
				else
				{
					if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1TodayLinkNormal;}
					else {$_sHTML .= $this->sCssClassCells2TodayLinkNormal;}
				}
			}
			else
			{
				if ($_iDay == $_iCalendarDay)
				{
					if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1LinkPressed;}
					else {$_sHTML .= $this->sCssClassCells2LinkPressed;}
				}
				else
				{
					if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1LinkNormal;}
					else {$_sHTML .= $this->sCssClassCells2LinkNormal;}
				}
			}
		}
		return $_sHTML;
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
	public function getCssClassForCells($_bClass2, $_sWeekDayName = NULL, $_iCalendarDay = NULL, $_iMonth = NULL, $_iYear = NULL)
	{
		$_sWeekDayName = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'sWeekDayName', 'xParameter' => $_sWeekDayName));
		$_iCalendarDay = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iCalendarDay', 'xParameter' => $_iCalendarDay));
		$_iMonth = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iMonth', 'xParameter' => $_iMonth));
		$_iYear = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'iYear', 'xParameter' => $_iYear));
		$_bClass2 = $this->getRealParameter(array('oParameters' => $_bClass2, 'sName' => 'bClass2', 'xParameter' => $_bClass2));

		if ($_bClass2 === NULL) {$_bClass2 = false;}
		
		$_sHTML = '';
		$_iActualMonth = date("n");			// ermitteln des aktuellen Monats 
		$_iActualDay = date("d");			// ermitteln des aktuellen Tages 
		$_iActualYear = date("Y");			// ermitteln des aktuellen Jahres
		
		if ($_sWeekDayName == "Sa")
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCellsSaturdayToday;}
				else {$_sHTML .= $this->sCssClassCellsSaturdayToday;}
			}
			else
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCellsSaturday;}
				else {$_sHTML .= $this->sCssClassCellsSaturday;}
			}
		}
		else if ($_sWeekDayName == "So")
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCellsSundayToday;}
				else {$_sHTML .= $this->sCssClassCellsSundayToday;}
			}
			else
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCellsSunday;}
				else {$_sHTML .= $this->sCssClassCellsSunday;}
			}
		}
		else
		{
			if (($_iCalendarDay == $_iActualDay) && ($_iMonth == $_iActualMonth) && ($_iYear == $_iActualYear))
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1Today;}
				else {$_sHTML .= $this->sCssClassCells2Today;}
			}
			else
			{
				if ($_bClass2 == false) {$_sHTML .= $this->sCssClassCells1;}
				else {$_sHTML .= $this->sCssClassCells2;}
			}
		}
		return $_sHTML;
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
	public function buildSheet($_iDay, $_iWeek = NULL, $_iMonth = NULL, $_iYear = NULL)
	{
		$_iWeek = $this->getRealParameter(array('oParameters' => $_iDay, 'sName' => 'iWeek', 'xParameter' => $_iWeek));
		$_iMonth = $this->getRealParameter(array('oParameters' => $_iDay, 'sName' => 'iMonth', 'xParameter' => $_iMonth));
		$_iYear = $this->getRealParameter(array('oParameters' => $_iDay, 'sName' => 'iYear', 'xParameter' => $_iYear));
		$_iDay = $this->getRealParameter(array('oParameters' => $_iDay, 'sName' => 'iDay', 'xParameter' => $_iDay));

		if ($_iYear === NULL) {$_iYear = 0;}
		if ($_iMonth === NULL) {$_iMonth = 0;}
		if ($_iDay === NULL) {$_iDay = 0;}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}


        $_sHTML = '';
		
		$_bClass2 = true;
		$_iActualMonth = date("n");			// ermitteln des aktuellen Monats 
		$_iActualDay = date("d");			// ermitteln des aktuellen Tages 
		$_iActualYear = date("Y");			// ermitteln des aktuellen Jahres
		
		if ($_iYear == 0) {$_iYear = $_iActualYear;}
		if ($_iMonth == 0) {$_iMonth = $_iActualMonth;}
		if ($_iDay == 0) {$_iDay = $_iActualDay;}
		
		$_iLastDay = date("t", mktime(0,0,0,$_iMonth,1,$_iYear));		// ermitteln des letzten Tages des Monats 
		$_iFirstWeekDay = date("w", mktime(0,0,0,$_iMonth,1,$_iYear));	// erste tag im monat
		if ($_iFirstWeekDay==0) {$_iFirstWeekDay = 7;}					// Korrektur für den Sonntag
		
		$_sHTML .= '<table class="'.$this->sCssClassTableControls.'" style="border-collapse:collapse;" align="center" cellspacing="0" cellpadding="0">';
		$_sHTML .= '<tr>';
			$_sHTML .= '<td><a href="javascript:;" class="'.$this->sCssClassControlsLink.'" onclick="oPGCalendarSheet.onMonthPreviousClick(); '.$this->sJsOnMonthPreviousClick.'" target="_self">&lt;&lt;</a></td>';
			$_sHTML .= '<td>';
			$_sHTML .= '<select id="'.$this->getID().'Month" onchange="oPGCalendarSheet.onMonthChange({\'sMonthID\': \''.$this->getID().'Month\'}); '.$this->sJsOnMonthChange.'">';
				for ($i=1; $i<count($this->asMonths); $i++)
				{
					$_sHTML .= '<option value="'.$i.'" ';
					if ($_iMonth == $i) {$_sHTML .= 'selected ';}
					$_sHTML .= '>'.$this->asMonths[$i].'</option>';
				}
			$_sHTML .= '</select>';
			$_sHTML .= '</td>';
			$_sHTML .= '<td>';
			$_sHTML .= '<select id="'.$this->getID().'Year" onchange="oPGCalendarSheet.onYearChange({\'sYearID\': \''.$this->getID().'Year\'}); '.$this->sJsOnYearChange.'">';
				if ($this->bYearControlReverse == true)
				{
					for ($i=$this->iYearRangeEnd; $i>=$this->iYearRangeStart; $i--)
					{
						$_sHTML .= '<option value="'.$i.'" ';
						if ($_iYear == $i) {$_sHTML .= 'selected ';}
						$_sHTML .= '>'.$i.'</option>';
					}
				}
				else
				{
					for ($i=$this->iYearRangeStart; $i<=$this->iYearRangeEnd; $i++)
					{
						$_sHTML .= '<option value="'.$i.'" ';
						if ($_iYear == $i) {$_sHTML .= 'selected ';}
						$_sHTML .= '>'.$i.'</option>';
					}
				}
			$_sHTML .= '</select>';
			$_sHTML .= '</td>';
			$_sHTML .= '<td><a href="javascript:;" class="'.$this->sCssClassControlsLink.'" onclick="oPGCalendarSheet.onMonthNextClick(); '.$this->sJsOnMonthNextClick.'" target="_self">&gt;&gt;</a></td>';
		$_sHTML .= '</tr>';
		$_sHTML .= '</table>';
		$_sHTML .= '<br />';
		
		$_sHTML .= '<table class="'.$this->sCssClassTableSheet.'" style="border-collapse:collapse;" align="center" cellspacing="0" cellpadding="0">';

		// Days (Mo-So)...
		$_sHTML .= '<tr>';
			$_sHTML .= '<td class="'.$this->sCssClassCellsWeeks.'" style="width:20px; height:20px; text-align:center; vertical-align:center;">KW</td>';
			for ($i=1; $i<count($this->asWeekDays); $i++)
			{
				$_sHTML .= '<td style="width:20px; height:20px; text-align:center; vertical-align:center;" ';
				$_sHTML .= 'class="'.$this->sCssClassCellsDays.'">';
				$_sHTML .= $this->asWeekDays[$i].'</td>';
			}
		$_sHTML .= '</tr>';
		
		$_sHTML .= '<tr>';
			// Kalenderwoche...
			$_iCalendarWeek = date("W", mktime(0,0,0,$_iMonth,1,$_iYear));
			$_sHTML .= '<td class="'.$this->sCssClassCellsWeeks.'" style="width:20px; height:20px; text-align:center; vertical-align:center;">';
			if ($this->sJsOnWeekClick != '')
			{
				$_sHTML .= '<a href="javascript:;" ';
				$_sHTML .= ' onclick="oPGCalendarSheet.onWeekClick({\'iWeek\': '.$_iCalendarWeek.', \'iMonth\': '.$_iMonth.', \'iYear\': '.$_iYear.'}); '.$this->sJsOnWeekClick.'" ';
				if ($_iWeek == $_iCalendarWeek) {$_sHTML .= 'class="'.$this->sCssClassCellsWeeksLinkPressed.'" ';}
				else {$_sHTML .= 'class="'.$this->sCssClassCellsWeeksLinkNormal.'" ';}
				$_sHTML .= 'target="_self">';
			}
			$_sHTML .= $_iCalendarWeek;
			if ($this->sJsOnWeekClick != '') {$_sHTML .= '</a>';}
			$_sHTML .= '</td>';
	
			// Leere Zellen ausgeben, bis zum ersten Tag des Monats...
			// $_bClass2 = true;
			$_iCurrentRowTDCount = 0;
			$_sCurrentClass = $this->sCssClassCells1;
			for ($j=1; $j<$_iFirstWeekDay; $j++)
			{
				if ($_bClass2 == false) {$_bClass2 = true;} else {$_bClass2 = false;}
				$_sWeekDayName = '';
				
				$_iCalendarDay = $j;
				$_sHTML .= '<td class="'.$this->getCssClassForCells(array('bClass2' => $_bClass2, 'sWeekDayName' => $_sWeekDayName, 'iCalendarDay' => $_iCalendarDay, 'iMonth' => $_iMonth, 'iYear' => $_iYear)).'" ';
				$_sHTML .= 'style="width:20px; height:20px; text-align:center; vertical-align:center;"></td>';
			}

			// $_bClass2 = true;
			for ($_iCalendarDay=1; $_iCalendarDay<=$_iLastDay; $_iCalendarDay++) 
			{ 
				if ($_bClass2 == false) {$_bClass2 = true;} else {$_bClass2 = false;}
				$_sWeekDayName = $this->asWeekDays[date("w", mktime(0,0,0,$_iMonth,$_iCalendarDay,$_iYear))];		// ermitteln des Wochentages

				$_sHTML .= '<td class="'.$this->getCssClassForCells($_bClass2, $_sWeekDayName, $_iCalendarDay, $_iMonth, $_iYear).'" ';
				$_sHTML .= 'style="width:20px; height:20px; text-align:center; vertical-align:center;">';
				$_sHTML .= '<a href="javascript:;" class="'.$this->getCssClassForCellsLink(array('bClass2' => $_bClass2, 'sWeekDayName' => $_sWeekDayName, 'iDay' => $_iDay, 'iCalendarDay' => $_iCalendarDay, 'iMonth' => $_iMonth, 'iYear' => $_iYear)).'" ';
				$_sHTML .= ' onclick="oPGCalendarSheet.onDayClick({\'iDay\': '.$_iCalendarDay.', \'iMonth\': '.$_iMonth.', \'iYear\': '.$_iYear.'}); '.$this->sJsOnDayClick.'" ';
				$_sHTML .= 'target="_self">'.$_iCalendarDay.'</a>';
				$_sHTML .= '</td>';
				$_iCurrentRowTDCount++;
	
				if (($_sWeekDayName == "So") && ($_iCalendarDay < $_iLastDay))
				{
					$_sHTML .= '</tr><tr>';
	
					// Kalenderwoche...
					$_iCalendarWeek = date("W", mktime(0,0,0,$_iMonth,$_iCalendarDay+1,$_iYear));
					$_sHTML .= '<td class="'.$this->sCssClassCellsWeeks.'" style="width:20px; height:20px; text-align:center; vertical-align:center;">';
					if ($this->sJsOnWeekClick != '')
					{
						$_sHTML .= '<a href="javascript:;" ';
						$_sHTML .= ' onclick="oPGCalendarSheet.onWeekClick({\'iWeek\': '.$_iCalendarWeek.', \'iMonth\': '.$_iMonth.', \'iYear\': '.$_iYear.'}); '.$this->sJsOnWeekClick.'" ';
						if ($_iWeek == $_iCalendarWeek) {$_sHTML .= 'class="'.$this->sCssClassCellsWeeksLinkPressed.'" ';}
						else {$_sHTML .= 'class="'.$this->sCssClassCellsWeeksLinkNormal.'" ';}
						$_sHTML .= 'target="_self">';
					}
					$_sHTML .= $_iCalendarWeek;
					if ($this->sJsOnWeekClick != '') {$_sHTML .= '</a>';}
					$_sHTML .= '</td>';

					$_iCurrentRowTDCount = 0;
					$_bClass2 = true;
				}
			} 

			// Leere Zellen ausgeben, bis zum ende der Liste 
			// $_bClass2 = true;
			if ($_iCurrentRowTDCount > 0)
			{
				for ($o=$_iCurrentRowTDCount; $o<7; $o++)
				{
					if ($_bClass2 == false) {$_bClass2 = true;} else {$_bClass2 = false;}
					$_sWeekDayName = '';
					
					$_sHTML .= '<td class="'.$this->getCssClassForCells(array('bClass2' => $_bClass2, 'sWeekDayName' => $_sWeekDayName, 'iCalendarDay' => $_iCalendarDay, 'iMonth' => $_iMonth, 'iYear' => $_iYear)).'" ';
					$_sHTML .= ' style="width:20px; height:20px; text-align:center; vertical-align:center;"></td>';
				}
			}
			
		$_sHTML .= '</tr>';
		$_sHTML .= '</table>';

		return $_sHTML;
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
	*/
	public function build()
	{
		if ($this->iDay == 0) {$this->iDay = date("j");}
		if ($this->iMonth == 0) {$this->iMonth = date("n");}
		if ($this->iYear == 0) {$this->iYear = date("Y");}
	
		$_sHTML = '';
		$_sHTML .= '<div id="'.$this->getID().'" class="calendarsheet">';
			$_sHTML .= $this->buildSheet(array('iDay' => $this->iDay, 'iWeek' => $this->iWeek, 'iMonth' => $this->iMonth, 'iYear' => $this->iYear));
		$_sHTML .= '</div>';
		$_sHTML .= '<script type="text/javascript">';
			$_sHTML .= 'oPGCalendarSheet.setAll({\'iDay\': '.$this->iDay.', \'iWeek\': '.$this->iWeek.', \'iMonth\': '.$this->iMonth.', \'iYear\': '.$this->iYear.'});';
		$_sHTML .= '</script>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGCalendarSheet = new classPG_CalendarSheet();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCalendarSheet', 'xValue' => $oPGCalendarSheet));}
?>