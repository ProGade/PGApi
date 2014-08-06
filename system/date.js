/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Date()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return iCalendarWeek [type]int[/type]
	[en]...[/en]
	
	@param _oDate [type]Date[/type]
	[en]...[/en]
	*/
	this.getCalendarWeek = function(_oDate)
	{
		if (typeof(_oDate) == 'undefined') {var _oDate = new Date();}
		
		var _oDateThursday = new Date();
		_oDateThursday.setTime(_oDate.getTime()+(3-((_oDate.getDay()+6)%7)) * 86400000);
		
		var _iCalendarWeekYear = _oDateThursday.getFullYear();
		
		var _oTempDate = new Date(_iCalendarWeekYear,0,4);
		var _oCalendarWeekDateThursday = new Date();
		_oCalendarWeekDateThursday.setTime(_oTempDate.getTime()+(3-((_oTempDate.getDay()+6)%7)) * 86400000);
		
		return Math.floor(1.5+(_oDateThursday.getTime()-_oCalendarWeekDateThursday.getTime())/86400000/7);
	}
	/* @end method */
	
	/*
	@start method
	
	@return bAllOk [type]bool[/type]
	[en]...[/en]
	
	@param xStartDate [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xEndDate [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.checkElementDates = function(_xStartDate, _xEndDate)
	{
		if (typeof(_xEndDate) == 'undefined') {var _xEndDate = null;}
		
		_xEndDate = this.getRealParameter({'oParameters': _xStartDate, 'sName': 'xEndDate', 'xParameter': _xEndDate});
		_xStartDate = this.getRealParameter({'oParameters': _xStartDate, 'sName': 'xStartDate', 'xParameter': _xStartDate, 'bNotNull': true});

		var _oStartDate = null;
		if (typeof(_xStartDate) == 'string') {_oStartDate = this.oDocument.getElementById(_xStartDate);}
		else if (typeof(_xStartDate) == 'object') {_oStartDate = _xStartDate;}
		
		var _oEndDate = null;
		if (typeof(_xEndDate) == 'string') {_oEndDate = this.oDocument.getElementById(_xEndDate);}
		else if (typeof(_xEndDate) == 'object') {_oEndDate = _xEndDate;}
		
		if ((_oStartDate) && (_oEndDate))
		{
			var _sStartDate = _oStartDate.value;
			var _sEndDate = _oEndDate.value;
			return this.checkStringDates({'sStartDate': _sStartDate, 'sEndDate': _sEndDate});
		}
		alert('Start oder Enddatum konnten nicht gefunden werden!');
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bAllOk [type]bool[/type]
	[en]...[/en]
	
	@param sStartDate [needed][type]string[/type]
	[en]...[/en]
	
	@param sEndDate [needed][type]string[/type]
	[en]...[/en]
	*/
	this.checkStringDates = function(_sStartDate, _sEndDate)
	{
		if (typeof(_sStartDate) == 'undefined') {var _sStartDate = null;}
		if (typeof(_sEndDate) == 'undefined') {var _sEndDate = null;}
		
		_sEndDate = this.getRealParameter({'oParameters': _sStartDate, 'sName': 'sEndDate', 'xParameter': _sEndDate});
		_sStartDate = this.getRealParameter({'oParameters': _sStartDate, 'sName': 'sStartDate', 'xParameter': _sStartDate});

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
	/* @end method */
}
/* @end class */
classPG_Date.prototype = new classPG_ClassBasics();
var oPGDate = new classPG_Date();
