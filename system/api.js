/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 22 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Api()
{
	// Declarations...
	this.axContext = null;
	this.axRegister = new Object();
	
	// Construct...

	// Methods...
	/*
	@start method
	
	@description
	[en]Sets, or registers an API variable.[/en]
	[de]Setzt bzw. registriert eine API-Variable.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the variable.[/en]
	[de]Der Name der Variablen.[/de]
	
	@param xValue [needed][type]mixed[/type]
	[en]The Value of the variable.[/en]
	[de]Der Wert der Variablen.[/de]
	*/
	this.register = function(_sName, _xValue)
	{
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		_xValue = this.getRealParameter({'oParameters': _sName, 'sName': 'xValue', 'xParameter': _xValue});
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});

		this.axRegister[_sName] = _xValue;
		return this;
	}
	/* @end method */
	this.set = this.register;
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Performs a query that selects objects, elements, or  variables and stores the result in a internally context for further processing.[/en]
	[de]Führt eine Abfrage aus, selektiert Objekte, Elemente oder Variablen und speichert das Ergebnis in einem intern Kontext zur Weiterverarbeitung.[/de]
	
	@return xMixed [type]mixed[/type]
	[en]Returns the API object or the desired query result.[/en]
	[de]Gibt das API-Objekt oder das erwünschte Anfrage-Ergebnis zurück.[/de]
	
	@param xStatement [needed][type]mixed[/type]
	[en]The statement, to be executed as a query.[/en]
	[de]Das Statement, das als Abfrage ausgeführt werden soll.[/de]
	*/
	this.select = function(_xStatement)
	{
		_xStatement = this.getRealParameter({'oParameters': _xStatement, 'sName': 'xStatement', 'xParameter': _xStatement, 'bNotNull': true});
		return this.query({'xStatement': _xStatement});
	}
	/* @end method */

	/*
	@start method
	
	@group Context
	
	@description
	[en]Performs a query that selects objects, elements, or  variables and stores the result in a internally context for further processing.[/en]
	[de]Führt eine Abfrage aus, selektiert Objekte, Elemente oder Variablen und speichert das Ergebnis in einem intern Kontext zur Weiterverarbeitung.[/de]
	
	@return xMixed [type]mixed[/type]
	[en]Returns the API object or the desired query result.[/en]
	[de]Gibt das API-Objekt oder das erwünschte Anfrage-Ergebnis zurück.[/de]
	
	@param xStatement [needed][type]mixed[/type]
	[en]The statement, to be executed as a query.[/en]
	[de]Das Statement, das als Abfrage ausgeführt werden soll.[/de]
	*/
	this.query = function(_xStatement)
	{
		_xStatement = this.getRealParameter({'oParameters': _xStatement, 'sName': 'xStatement', 'xParameter': _xStatement, 'bNotNull': true});

		this.axContext = null;
		if (!_xStatement) {return this;}
		
		if (_xStatement.constructor === Object) {this.axContext = new Array(_xStatement);}
		else if (_xStatement.constructor === Array) {this.axContext = new Array(_xStatement);}
		else if (typeof(_xStatement) == 'function') {this.axContext = new Array(_xStatement);}
		else if (typeof(_xStatement) == 'string')
		{
			if ((_xStatement.charAt(0) === '<') && (_xStatement.charAt(_xStatement.length-1) === '>') && (_xStatement.length >= 3))
			{
				this.axContext = new Array(this.oDocument.createElement(_xStatement.replace(/^</, '').replace(/>$/, '')));
			}
			else if (_xStatement.charAt(0) === '$') {this.axContext = this.oDocument.getElementsByName(_xStatement.replace(/^\$/, ''));}
			else if (_xStatement.charAt(0) === '#') {this.axContext = new Array(this.oDocument.getElementById(_xStatement.replace(/^#/, '')));}
			else {this.axContext = this.oDocument.getElementsByTagName(_xStatement);}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns a previously registered / set variable.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable zurück.[/de]
	
	@return xValue [type]mixed[/type]
	[en]Returns the value of a variable or an associative array with all the variables.[/en]
	[de]Gibt den Wert einer Variablen oder einen assoziativen Array mit allen Variablen zurück.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the variable.[/en]
	[de]Der Name der Variablen.[/de]
	*/
	this.getRegistered = function(_sName)
	{
		if (typeof(_sName) == 'undefined') {var _sName = null;}
		_sName = this.getRealParameter({'oParameters': _sName, 'sName': 'sName', 'xParameter': _sName});
		if (_sName == null) {return this.axRegister;}
		else if (this.axRegister[_sName]) {return this.axRegister[_sName];}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Returns a previously registered / set variable or something from the previously saved context.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable oder etwas aus dem zuvor gespeicherten Context zurück.[/de]
	
	@return xContext [type]mixed[/type]
	[en]Returns the desired item from the internal context or a registered variable.[/en]
	[de]Gibt das gewünschte Element aus dem internen Kontext oder eine registrierte Variable zurück.[/de]
	
	@param xGet [needed][type]string[/type]
	[en]The index as an integer or string name of the desired element.[/en]
	[de]Der Index als Integer bzw. Name als String vom gewünschten Element.[/de]
	*/
	this.get = function(_xGet)
	{
		_xGet = this.getRealParameter({'oParameters': _xGet, 'sName': 'xGet', 'xParameter': _xGet, 'bNotNull': true});
		return this.getContext({'xGet': _xGet});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Returns a previously registered / set variable or something from the previously saved context.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable oder etwas aus dem zuvor gespeicherten Context zurück.[/de]
	
	@return xContext [type]mixed[/type]
	[en]Returns the desired item from the internal context or a registered variable.[/en]
	[de]Gibt das gewünschte Element aus dem internen Kontext oder eine registrierte Variable zurück.[/de]
	
	@param xGet [needed][type]mixed[/type]
	[en]The index as an integer or string name of the desired element.[/en]
	[de]Der Index als Integer bzw. Name als String vom gewünschten Element.[/de]
	*/
	this.getContext = function(_xGet)
	{
		_xGet = this.getRealParameter({'oParameters': _xGet, 'sName': 'xGet', 'xParameter': _xGet});

		if (_xGet == null) {_xGet = 0;}
		
		if (typeof(_xGet) == 'string')
		{
			if (this.axRegister[_xGet]) {return this.axRegister[_xGet];}
			return null;
		}
		return this.axContext[_xGet];
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@return iCount [type]int[/type]
	[en]...[/en]
	*/
	this.getContextCount = function()
	{
		return this.axContext.length;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@return bIsHtmlElement [type]bool[/type]
	[en]...[/en]
	
	@param xContext [needed][type]mixed[/type]
	[en]...[/en]
	
	@param bBodyAllowed [type]bool[/type]
	[en]...[/en]
	*/
	this.isHtmlElement = function(_xContext, _bBodyAllowed)
	{
		if (typeof(_bBodyAllowed) == 'undefined') {var _bBodyAllowed = null;}
		
		_bBodyAllowed = this.getRealParameter({'oParameters': _xContext, 'sName': 'bBodyAllowed', 'xParameter': _bBodyAllowed});
		_xContext = this.getRealParameter({'oParameters': _xContext, 'sName': 'xContext', 'xParameter': _xContext, 'bNotNull': true});

		if (typeof(_xContext) == 'undefined') {return false;}
		if (_bBodyAllowed == null) {_bBodyAllowed = false;}
		if (typeof(_xContext) == 'object')
		{
			if ((_xContext.constructor.toString().match(/\[object HTML(.*)Element\]/))
			&& ((_xContext.constructor.toString() != '[object HTMLBodyElement]') || (_bBodyAllowed == true)))
			{
				return true;
			}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@group Properties
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.property = function(_sProperty, _xValue)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		_xValue = this.getRealParameter({'oParameters': _sProperty, 'sName': 'xValue', 'xParameter': _xValue});
		_sProperty = this.getRealParameter({'oParameters': _sProperty, 'sName': 'sProperty', 'xParameter': _sProperty});
		if (_xValue == null) {return this.setProperty({'sProperty': _sProperty, 'xValue': _xValue});}
		return this.getProperty({'sProperty': _sProperty});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Properties
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.setProperty = function(_sProperty, _xValue)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		_xValue = this.getRealParameter({'oParameters': _sProperty, 'sName': 'xValue', 'xParameter': _xValue});
		_sProperty = this.getRealParameter({'oParameters': _sProperty, 'sName': 'sProperty', 'xParameter': _sProperty});
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.axContext[i] != null) {this.axContext[i][_sProperty] = _xValue;}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Properties
	
	@return xValue [type]string[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getProperty = function(_sProperty)
	{
		if (this.axContext == null) {return this;}
		_sProperty = this.getRealParameter({'oParameters': _sProperty, 'sName': 'sProperty', 'xParameter': _sProperty});
		
		_sHtml = '';
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.axContext[i] != null) {_sHtml += this.axContext[i][_sProperty]+'\n';}
		}
		return _sHtml;
	}
	/* @end method */
	
	// this.class = function(_sClass) {/* todo */ return this;}
	
	/*
	@start method
	
	@group CSS
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param xStyle [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.addCss = function(_xStyle)
	{
		if (this.axContext == null) {return this;}
		_xStyle = this.getRealParameter({'oParameters': _xStyle, 'sName': 'xStyle', 'xParameter': _xStyle, 'bNotNull': true});
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': true}))
			{
				if (typeof(oPGCss) != 'undefined') {oPGCss.addStyle({'xElement':this.axContext[i], 'xStyle': _xStyle});}
			}
		}
		return this;
	}
	/* @end method */

	/*
	@start method
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.setPos = function(_iPosX, _iPosY)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		
		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false}))
			{
				if (_iPosX != null) {this.axContext[i].style.left = _iPosX+'px';}
				if (_iPosY != null) {this.axContext[i].style.top = _iPosY+'px';}
			}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.setSize = function(_iSizeX, _iSizeY)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = null;}
		
		_iSizeY = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false}))
			{
				if (_iSizeX != null) {this.axContext[i].style.width = _iSizeX+'px';}
				if (_iSizeY != null) {this.axContext[i].style.height = _iSizeY+'px';}
			}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param xDisplay [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setDisplay = function(_xDisplay)
	{
		if (this.axContext == null) {return this;}
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false}))
			{
				if (typeof(_xDisplay) == 'string') {this.axContext[i].style.display = _xDisplay;}
				else if (_xDisplay == true) {this.axContext[i].style.display = 'block';}
				else {this.axContext[i].style.display = 'none';}
			}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sHtml [type]string[/type]
	[en]...[/en]
	
	@param bReplace [type]bool[/type]
	[en]...[/en]
	*/
	this.innerHtml = function(_sHtml, _bReplace)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_sHtml) == 'undefined') {var _sHtml = null;}
		if (typeof(_bReplace) == 'undefined') {var _bReplace = null;}
		
		_bReplace = this.getRealParameter({'oParameters': _sHtml, 'sName': 'bReplace', 'xParameter': _bReplace});
		_sHtml = this.getRealParameter({'oParameters': _sHtml, 'sName': 'sHtml', 'xParameter': _sHtml});

		if (_sHtml == null) {return this.getInnerHtml();}
		return this.setInnerHtml({'sHtml': _sHtml, 'bReplace': _bReplace});
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	this.getInnerHtml = function()
	{
		if (this.axContext == null) {return this;}
		var _sHtml = '';
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement(this.axContext[i], true)) {_sHtml += oPGBrowser.getInnerHtml({'xElement': this.axContext[i]});}
		}
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	
	@param bReplace [type]bool[/type]
	[en]...[/en]
	*/
	this.setInnerHtml = function(_sHtml, _bReplace)
	{
		if (this.axContext == null) {return this;}
		if (typeof(_bReplace) == 'undefined') {var _bReplace = null;}
		
		_bReplace = this.getRealParameter({'oParameters': _sHtml, 'sName': 'bReplace', 'xParameter': _bReplace});
		_sHtml = this.getRealParameter({'oParameters': _sHtml, 'sName': 'sHtml', 'xParameter': _sHtml});

		if (_bReplace == null) {_bReplace = true;}
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': true}))
			{
				if (_bReplace == true) {oPGBrowser.setInnerHtml({'xElement': this.axContext[i], 'sHtml': _sHtml});}
				else {oPGBrowser.setInnerHtml({'xElement': this.axContext[i], 'sHtml': oPGBrowser.getInnerHtml({'xElement': this.axContext[i]})+_sHtml});}
			}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return xMixed [type]mixed[/type]
	[en]...[/en]
	
	@param sHtml [type]string[/type]
	[en]...[/en]
	
	@param bReplace [type]bool[/en]
	[en]...[/en]
	*/
	this.outerHtml = function(_sHtml, _bReplace)
	{
		if (this.axContext == null) {return this;}
		if (typeof(oPGPrototypes) == 'undefined') {return this;}
		if (typeof(_sHtml) == 'undefined') {var _sHtml = null;}
		if (typeof(_bReplace) == 'undefined') {var _bReplace = null;}
		
		_bReplace = this.getRealParameter({'oParameters': _sHtml, 'sName': 'bReplace', 'xParameter': _bReplace});
		_sHtml = this.getRealParameter({'oParameters': _sHtml, 'sName': 'sHtml', 'xParameter': _sHtml});

		if (_sHtml == null) {return this.getOuterHtml();}
		return this.setOuterHtml({'sHtml': _sHtml, 'bReplace': _bReplace});
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	this.getOuterHtml = function()
	{
		if (this.axContext == null) {return this;}
		var _sHtml = '';
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false})) {_sHtml += oPGBrowser.getOuterHtml({'xElement': this.axContext[i]});}
		}
		return _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group HTML
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	
	@param bReplace [type]bool[/type]
	[en]...[/en]
	*/
	this.setOuterHtml = function(_sHtml, _bReplace)
	{
		if (this.axContext == null) {return this;}
		if (typeof(oPGPrototypes) == 'undefined') {return this;}
		if (typeof(_bReplace) == 'undefined') {var _bReplace = null;}
		
		_bReplace = this.getRealParameter({'oParameters': _sHtml, 'sName': 'bReplace', 'xParameter': _bReplace});
		_sHtml = this.getRealParameter({'oParameters': _sHtml, 'sName': 'sHtml', 'xParameter': _sHtml});

		if (_bReplace == null) {_bReplace = true;}
		for (var i=0; i<this.axContext.length; i++)
		{
			if (_bReplace == true) {oPGBrowser.setOuterHtml({'sHtml': _sHtml, 'xElement': this.axContext[i]});}
			else {oPGBrowser.setOuterHtml({'sHtml': oPGBrowser.getOuterHtml({'xElement': this.axContext[i]})+_sHtml, 'xElement': this.axContext[i]});}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Nodes
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.insertInto = function(_xElement)
	{
		if (this.axContext == null) {return this;}
		if (typeof(oPGNodes) == 'undefined') {return this;}
		
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false}))
			{
				if (typeof(_xElement) == 'string')
				{
					if (_xElement.charAt(0) == '#') {_xElement = _xElement.replace(/^#/, '');}
				}
				oPGNodes.insertInto({'xIntoParent': _xElement, 'xInsertElement': this.axContext[i]});
			}
		}
		return this;
	}
	/* @end method */
	this.appendTo = this.insertInto;
	
	/*
	@start method
	
	@group Nodes
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param xIntoHtmlElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xBeforeHtmlElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.insertBefore = function(_xIntoHtmlElement, _xBeforeHtmlElement)
	{
		if (this.axContext == null) {return this;}
		if (typeof(oPGNodes) == 'undefined') {return this;}
		if (typeof(_xBeforeHtmlElement) == 'undefined') {var _xBeforeHtmlElement = null;}
		
		_xBeforeHtmlElement = this.getRealParameter({'oParameters': _xIntoHtmlElement, 'sName': 'xBeforeHtmlElement', 'xParameter': _xBeforeHtmlElement, 'bNotNull': true});
		_xIntoHtmlElement = this.getRealParameter({'oParameters': _xIntoHtmlElement, 'sName': 'xIntoHtmlElement', 'xParameter': _xIntoHtmlElement, 'bNotNull': true});
		
		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement({'xContext': this.axContext[i], 'bBodyAllowed': false}))
			{
				if (typeof(_xIntoHtmlElement) == 'string')
				{
					if (_xHtmlElement.charAt(0) == '#') {_xHtmlElement = _xHtmlElement.replace(/^#/, '');}
				}
				oPGNodes.insertBefore({'xIntoParent': _xIntoHtmlElement, 'xBeforeChild': _xBeforeHtmlElement, 'xInsertElement': this.axContext[i]});
			}
		}
		return this;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Nodes
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param xIntoHtmlElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xAfterHtmlElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.insertAfter = function(_xIntoHtmlElement, _xAfterHtmlElement)
	{
		if (this.axContext == null) {return this;}
		if (typeof(oPGNodes) == 'undefined') {return this;}
		if (typeof(_xAfterHtmlElement) == 'undefined') {var _xAfterHtmlElement = null;}

		_xAfterHtmlElement = this.getRealParameter({'oParameters': _xIntoHtmlElement, 'sName': 'xAfterHtmlElement', 'xParameter': _xAfterHtmlElement, 'bNotNull': true});
		_xIntoHtmlElement = this.getRealParameter({'oParameters': _xIntoHtmlElement, 'sName': 'xIntoHtmlElement', 'xParameter': _xIntoHtmlElement, 'bNotNull': true});

		for (var i=0; i<this.axContext.length; i++)
		{
			if (this.isHtmlElement(this.axContext[i], false))
			{
				if (typeof(_xIntoHtmlElement) == 'string')
				{
					if (_xHtmlElement.charAt(0) == '#') {_xHtmlElement = _xHtmlElement.replace(/^#/, '');}
				}
				oPGNodes.insertAfter({'xIntoParent': _xIntoHtmlElement, 'xAfterChild': _xAfterHtmlElement, 'xInsertElement': this.axContext[i]});
			}
		}
		return this;
	}
	/* @end method */

	/*
	@start method
	
	@return oApi [type]object[/type]
	[en]...[/en]
	
	@param sSource [needed][type]string[/type]
	[en]...[/en]
	*/
	this.globalEval = function(_sSource)
	{
		if (typeof(_sSource) == 'undefined') {return this;}
		_sSource = this.getRealParameter({'oParameters': _sSource, 'sName': 'sSource', 'xParameter': _sSource});

		(
			this.oWindow.execScript
			|| function (_sSource)
			{
				this.oWindow.eval.call(this.oWindow, _sSource);
			}
		)(_sSource);
		
		return this;
	}
	/* @end method */
}
/* @end class */
classPG_Api.prototype = new classPG_ClassBasics();
var oPGApi = new classPG_Api();
var oPG = oPGApi;

if (typeof(window.$) == 'undefined') {window.$ = function(_xSelector) {return oPGApi.get(_xSelector);}}
