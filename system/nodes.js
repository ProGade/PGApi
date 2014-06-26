/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Nodes()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return axInfos [type]mixed[][/type]
	[en]...[/en]
	*/
	this.getInfos = function(_xElement)
	{
		var _oElement = this.getNode(_xElement);
		return oPGObjects.getStructureString({'oObject':_oElement, 'bUseHtml': false});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Properties
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.set = function(_xElement, _sProperty, _xValue)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}

		_xValue = this.getRealParameter({'oParameters': _xElement, 'sName': 'xValue', 'xParameter': _xValue});
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = this.getNode(_xElement);
		if (_oElement)
		{
			if (_xValue === null) {_oElement.removeAttribute(_sProperty, 0);}
			else {_oElement.setAttribute(_sProperty, _xValue, 0);}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Properties
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.unset = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}

		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		this.set({'xElement': _xElement, 'sProperty': _sProperty, 'xValue': null});
	}
	/* @end method */
	
	/*
	@start method
	
	@group Properties
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.get = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}

		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = this.getNode({'xElement': _xElement});
		if (_oElement) {return _oElement.getAttribute(_sProperty, 0);}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@return sStyle [type]string[/type]
	[en]...[/en]
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	this.formatStyle = function(_sStyle)
	{
		if (typeof(_sStyle) == 'undefined') {var _sStyle = null;}
		_sStyle = this.getRealParameter({'oParameters': _sStyle, 'sName': 'sStyle', 'xParameter': _sStyle});
		
		return _sStyle.replace(/-([a-z])/, RegExp.$1.toUpperCase());
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	*/
	this.setStyle = function(_xElement, _sProperty, _xValue)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}

		_xValue = this.getRealParameter({'oParameters': _xElement, 'sName': 'xValue', 'xParameter': _xValue});
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = this.getNode({'xElement': _xElement});
		if (_oElement)
		{
			if (_xValue === null)
			{
				if (typeof(_oElement.style.removeAttribute) != 'undefined') {_oElement.style.removeAttribute(this.formatStyle({'sStyle': _sProperty}));}
				else if (typeof(_oElement.style.removeProperty) != 'undefined') {_oElement.style.removeProperty(_sProperty);}
				else if (typeof(oPGCss) != 'undefined') {oPGCss.unsetStyle(_oElement, _sProperty);}
			}
			else
			{
				if (typeof(_oElement.style.setAttribute) != 'undefined') {_oElement.style.setAttribute(this.formatStyle({'sStyle': _sProperty}), _xValue, 0);}
				else if (typeof(_oElement.style.setProperty) != 'undefined') {_oElement.style.setProperty(_sProperty, _xValue, null);}
				else if (typeof(oPGCss) != 'undefined') {oPGCss.setStyle({'oElement': _oElement, 'sStyle': _sProperty+':'+_xValue+';'});}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axStyle [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	this.setStyles = function(_xElement, _axStyle)
	{
		if (typeof(_axStyle) == 'undefined') {var _axStyle = null;}
		
		_axStyle = this.getRealParameter({'oParameters': _xElement, 'sName': 'axStyle', 'xParameter': _axStyle});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		for (var _sProperty in _axStyle)
		{
			this.setStyle({'xElement': _xElement, 'sProperty': _sProperty, 'xValue': _axStyle[_sProperty]});
		}
	}
	/* @end method */

	/*
	@start method
	
	@group CSS
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.unsetStyle = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}

		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		this.setStyle({'xElement': _xElement, 'sProperty': _sProperty});
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	this.getStyle = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}

		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = this.getNode({'xElement': _xElement});
		if (_oElement)
		{
			if (typeof(_oElement.style.getAttribute) != 'undefined') {return _oElement.style.getAttribute(this.formatStyle({'sStyle': _sProperty}), 0);}
			else if (typeof(_oElement.style.getPropertyValue) != 'undefined') {return _oElement.style.getPropertyValue(_sProperty);}
		}
		return null;
	}
	/* @end method */
		
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		if (typeof(_xElement) == 'string') {return this.oDocument.getElementById(_xElement);}
		else if (typeof(_xElement) == 'object') {return _xElement;}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Manipulation
	
	@return oNodeCopy [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param bWithContent [type]bool[/type]
	[en]...[/en]
	*/
	this.copy = function(_xElement, _bWithContent)
	{
		if (typeof(_bWithContent) == 'undefined') {var _bWithContent = null;}
		
		_bWithContent = this.getRealParameter({'oParameters': _xElement, 'sName': 'bWithContent', 'xParameter': _bWithContent});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement});

		if (_bWithContent == null) {_bWithContent = true;}

		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.cloneNode(true);}
		return null;
	}
	/* @end method */
	this.clone = this.copy;
	
	/*
	@start method
	
	@group Manipulation
	
	@return oReplacedElement [type]object[/type]
	[en]...[/en]
	
	@param xElementToReplace [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xElementReplaceWith [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.replace = function(_xElementToReplace, _xElementReplaceWith)
	{
		if (typeof(_xElementReplaceWith) == 'undefined') {var _xElementReplaceWith = null;}
		
		_xElementReplaceWith = this.getRealParameter({'oParameters': _xElementToReplace, 'sName': 'xElementReplaceWith', 'xParameter': _xElementReplaceWith});
		_xElementToReplace = this.getRealParameter({'oParameters': _xElementToReplace, 'sName': 'xElementToReplace', 'xParameter': _xElementToReplace, 'bNotNull': true});

		var _oNodeToReplace = this.getNode({'xElement': _xElementToReplace});
		var _oNodeToReplaceWith = this.getNode({'xElement': _xElementReplaceWith});
		var _oParentNode = this.getParentNode({'xElement': _xElement});
		if ((_oNodeToReplace) && (_oNodeToReplaceWith) && (_oParentNode))
		{
			return _oParentNode.replaceChild(_oNodeToReplaceWith, _oNodeToReplace);
		}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@group Manipulation
	
	@return oRemovedElement [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.remove = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement});
		var _oNode = this.getNode({'xElement': _xElement});
		var _oParentNode = this.getParentNode({'xElement': _xElement});
		if ((_oNode) && (_oParentNode))
		{
			return _oParentNode.removeChild(_oNode);
		}
		return null;
	}
	/* @end method */
	this.kill = this.remove;
	
	/*
	@start method
	
	@group Manipulation
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	this.insertHtml = function(_xElement, _sHtml)
	{
		if (typeof(_sHtml) == 'undefined') {var _sHtml = null;}

		_sHtml = this.getRealParameter({'oParameters': _xElement, 'sName': 'sHtml', 'xParameter': _sHtml});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {_oNode.innerHTML = _sHtml;}
	}
	/* @end method */
	this.addHtml = this.insertHtml;
	
	/*
	@start method
	
	@group Manipulation
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	*/
	this.insertText = function(_xElement, _sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}

		_sText = this.getRealParameter({'oParameters': _xElement, 'sName': 'sText', 'xParameter': _sText});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {_oNode.innerText = _sText;}
	}
	/* @end method */
	this.addText = this.insertText;
	
	/*
	@start method
	
	@group Manipulation
	
	@return oInsertedNode [type]object[/type]
	[en]...[/en]
	
	@param xIntoParent [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xInsertElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.insertInto = function(_xIntoParent, _xInsertElement)
	{
		if (typeof(_xInsertElement) == 'undefined') {var _xInsertElement = null;}

		_xInsertElement = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xInsertElement', 'xParameter': _xInsertElement});
		_xIntoParent = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xIntoParent', 'xParameter': _xIntoParent, 'bNotNull': true});

		var _oIntoParentNode = this.getNode({'xElement': _xIntoParent});
		var _oInsertElement = this.getNode({'xElement': _xInsertElement});
		if ((_oInsertElement) && (_oIntoParentNode))
		{
			return _oIntoParentNode.appendChild(_oInsertElement);
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Manipulation
	
	@return oInsertedNode [type]object[/type]
	[en]...[/en]
	
	@param xBeforeChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xInsertElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xIntoParent [type]mixed[/type]
	[en]...[/en]
	*/
	this.insertBefore = function(_xBeforeChild, _xInsertElement, _xIntoParent)
	{
		if (typeof(_xBeforeChild) == 'undefined') {var _xBeforeChild = null;}
		if (typeof(_xInsertElement) == 'undefined') {var _xInsertElement = null;}

		_xBeforeChild = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xBeforeChild', 'xParameter': _xBeforeChild});
		_xInsertElement = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xInsertElement', 'xParameter': _xInsertElement});
		_xIntoParent = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xIntoParent', 'xParameter': _xIntoParent, 'bNotNull': true});

		if (_xIntoParent == null) {_xIntoParent = this.getParentNode({'xElement': _oBeforeChildNode});}
		
		var _oIntoParentNode = this.getNode({'xElement': _xIntoParent});
		var _oBeforeChildNode = this.getNode({'xElement': _xBeforeChild});
		var _oInsertElement = this.getNode({'xElement': _xInsertElement});
		if ((_oInsertElement) && (_oBeforeChildNode) && (_oIntoParentNode))
		{
			return _oIntoParentNode.insertBefore(_oInsertElement, _oBeforeChildNode);
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Manipulation
	
	@return oInsertedNode [type]object[/type]
	[en]...[/en]
	
	@param xAfterChild [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xInsertElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xIntoParent [type]mixed[/type]
	[en]...[/en]
	*/
	this.insertAfter = function(_xAfterChild, _xInsertElement, _xIntoParent)
	{
		if (typeof(_xAfterChild) == 'undefined') {var _xAfterChild = null;}
		if (typeof(_xInsertElement) == 'undefined') {var _xInsertElement = null;}

		_xAfterChild = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xAfterChild', 'xParameter': _xAfterChild});
		_xInsertElement = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xInsertElement', 'xParameter': _xInsertElement});
		_xIntoParent = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xIntoParent', 'xParameter': _xIntoParent, 'bNotNull': true});

		if (_xIntoParent == null) {_xIntoParent = this.getParentNode({'xElement': _oBeforeChildNode});}

		var _oIntoParentNode = this.getNode({'xElement': _xIntoParent});
		var _oAfterChildNode = this.getNode({'xElement': _xAfterChild});
		var _oInsertElement = this.getNode({'xElement': _xInsertElement});
		if ((_oInsertElement) && (_oAfterChildNode) && (_oIntoParentNode))
		{
			var _oNextChildNode = null;
			if (_oAfterChildNode.nextSibling)
			{
				_oNextChildNode = _oAfterChildNode.nextSibling;
				return _oIntoParentNode.insertBefore(_oInsertElement, _oNextChildNode);
			}
			else
			{
				return _oIntoParentNode.appendChild(_oInsertElement);
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getNextNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.nextSibling;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getPreviousNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.previousSibling;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getParentNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.parentNode;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return aoNodes [type]object[][/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	/*this.getParentNodes = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode)
		{
			var _aoNodes = [];
			if ((!_oNode) || (_oNode.tagName == 'body')) {return null;}
			while ((_oNode) && (_oNode.tagName != 'body'))
			{
				_aoNodes.push(_oNode);
				_oNode.parentNode;
			}
			return _aoNodes;
		}
		return null;
	}*/
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getFirstChildNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.firstChild;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return oNode [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getLastChildNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oNode = this.getNode({'xElement': _xElement});
		if (_oNode) {return _oNode.lastChild;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Get
	
	@return aoNodes [type]object[][/type]
	[en]...[/en]
	
	@param bIncludeCurrent [type]bool[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xMaxElement [type]mixed[/type]
	[en]...[/en]
	*/
	this.getParentNodes = function(_bIncludeCurrent, _xElement, _xMaxElement)
	{
		if (typeof(_bIncludeCurrent) == 'undefined') {var _bIncludeCurrent = null;}
		if (typeof(_xElement) == 'undefined') {var _xElement = null;}
		if (typeof(_xMaxElement) == 'undefined') {var _xMaxElement = null;}
	
		_xElement = this.getRealParameter({'oParameters': _bIncludeCurrent, 'sName': 'xElement', 'xParameter': _xElement});
		_xMaxElement = this.getRealParameter({'oParameters': _bIncludeCurrent, 'sName': 'xMaxElement', 'xParameter': _xMaxElement});
		_bIncludeCurrent = this.getRealParameter({'oParameters': _bIncludeCurrent, 'sName': 'bIncludeCurrent', 'xParameter': _bIncludeCurrent});
		
		if (_bIncludeCurrent == null) {_bIncludeCurrent = false;}
		
		var _sMaxElementName = '';
		var _oNode = this.getNode({'xElement': _xElement});
		if (_xMaxElement != null)
		{
			var _oMaxNode = null;
			if (typeof(_xMaxElement) == 'string')
			{
				if (_xMaxElement[0] == '#') {_oMaxNode = this.getNode({'xElement': _xMaxElement});}
				else {_sMaxElementName = _xMaxElement.toLowerCase();}
			}
			else if (typeof(_xMaxElement) == 'object') {_oMaxNode = _xMaxElement;}
			if (_oMaxNode) {_sMaxElementName = _oMaxNode.nodeName.toLowerCase();}
		}

		if (_oNode)
		{
			var _aoNodes = new Array();
			if ((_sNodeName == 'body') || (_sNodeName == '#document')) {return _aoNodes;}
			var _sNodeName = _oNode.nodeName.toLowerCase();
			if (_bIncludeCurrent == true) {_aoNodes.push(_oNode);}
			if (_sNodeName == _sMaxElementName) {return _aoNodes;}
			_oNode = _oNode.parentNode;
			if (_oNode)
			{
				_sNodeName = '';
				if (_oNode.nodeName) {_sNodeName = _oNode.nodeName.toLowerCase();}
				while ((_oNode) && (_sNodeName != 'body'))
				{
					if ((_sNodeName == 'body') || (_sNodeName == '#document')) {return _aoNodes;}
					_aoNodes.push(_oNode);
					if (_sNodeName == _sMaxElementName) {return _aoNodes;}
					_oNode = _oNode.parentNode;
					if (_oNode.nodeName) {_sNodeName = _oNode.nodeName.toLowerCase();}
				}
			}
			return _aoNodes;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@return oNode [type]object[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sTag [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axAttributes [type]mixed[][/type]
	[en]...[/en]
	
	@param axStyles [type]mixed[][/type]
	[en]...[/en]
	*/
	this.build = function(_sTag, _axAttributes, _axStyles)
	{
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}
		if (typeof(_axStyles) == 'undefined') {var _axStyles = null;}
	
		_axAttributes = this.getRealParameter({'oParameters': _sTag, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_axStyles = this.getRealParameter({'oParameters': _sTag, 'sName': 'axStyles', 'xParameter': _axStyles});
		_sTag = this.getRealParameter({'oParameters': _sTag, 'sName': 'sTag', 'xParameter': _sTag});
		
		if (_sTag != null)
		{
			var _oNode = this.oDocument.createElement(_sTag);
			if (_oNode)
			{
				var _sProperty = '';
				for (_sProperty in _axAttributes)
				{
					this.set({'xElement': _oNode, 'sProperty': _sProperty, 'xValue': _axAttributes[_sProperty]});
				}
				
				for (_sProperty in _axStyles)
				{
					this.setStyle({'xElement': _oNode, 'sProperty': _sProperty, 'xValue': _axStyles[_sProperty]});
				}
			}
			return _oNode;
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@return oNode [type]object[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param sTag [needed][type]string[/type]
	[en]...[/en]
	[de]...[/de]
	
	@param axAttributes [type]mixed[][/type]
	[en]...[/en]
	
	@param axStyles [type]mixed[][/type]
	[en]...[/en]
	*/
	this.buildInto = function(_xIntoParent, _sTag, _axAttributes, _axStyles)
	{
		if (typeof(_axAttributes) == 'undefined') {var _axAttributes = null;}
		if (typeof(_axStyles) == 'undefined') {var _axStyles = null;}
	
		_sTag = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'sTag', 'xParameter': _sTag});
		_axAttributes = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'axAttributes', 'xParameter': _axAttributes});
		_axStyles = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'axStyles', 'xParameter': _axStyles});
		_xIntoParent = this.getRealParameter({'oParameters': _xIntoParent, 'sName': 'xIntoParent', 'xParameter': _xIntoParent});
		
		if (_xIntoParent)
		{
			var _oNode = this.build({'sTag': _sTag, 'axAttributes': _axAttributes, 'axStyles': _axStyles});
			if (_oNode) {return this.insertInto({'xIntoParent': _xIntoParent, 'xInsertElement': _oNode});}
		}
		
		return null;
	}
	/* @end method */
}
/* @end class */
classPG_Nodes.prototype = new classPG_ClassBasics();
var oPGNodes = new classPG_Nodes();

function classPG_NodesHtmlSingleTagBasics()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	this.set = function(_xElement, _sProperty, _xValue)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xValue = this.getRealParameter({'oParameters': _xElement, 'sName': 'xValue', 'xParameter': _xValue});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.set({'xElement': _xElement, 'sProperty': _sProperty, 'xValue': _xValue});
	}
	
	this.unset = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.unset({'xElement': _xElement, 'sProperty': _sProperty});
	}
	
	this.get = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.get({'xElement': _xElement, 'sProperty': _sProperty});
	}

	this.getNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.getNode({'xElement': _xElement});
	}
	this.getObject = this.getNode;
	
	this.copy = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.copy({'xElement': _xElement});
	}
	this.clone = this.copy;
	
	this.remove = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.remove({'xElement': _xElement});
	}
	this.kill = this.remove;
}

function classPG_NodesHtmlDoubleTagBasics()
{
	// Declarations...
	
	// Construct...
	
	// Methods...
	this.set = function(_xElement, _sProperty, _xValue)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		if (typeof(_xValue) == 'undefined') {var _xValue = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xValue = this.getRealParameter({'oParameters': _xElement, 'sName': 'xValue', 'xParameter': _xValue});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.set({'xElement': _xElement, 'sProperty': _sProperty, 'xValue': _xValue});
	}
	
	this.unset = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.unset({'xElement': _xElement, 'sProperty': _sProperty});
	}
	
	this.get = function(_xElement, _sProperty)
	{
		if (typeof(_sProperty) == 'undefined') {var _sProperty = null;}
		_sProperty = this.getRealParameter({'oParameters': _xElement, 'sName': 'sProperty', 'xParameter': _sProperty});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.get({'xElement': _xElement, 'sProperty': _sProperty});
	}

	this.getNode = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.getNode({'xElement': _xElement});
	}
	this.getObject = this.getNode;
	
	this.copy = function(_xElement, _bWithContent)
	{
		if (typeof(_bWithContent) == 'undefined') {var _bWithContent = null;}
		_bWithContent = this.getRealParameter({'oParameters': _xElement, 'sName': 'bWithContent', 'xParameter': _bWithContent});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		return oPGNodes.copy({'xElement': _xElement, 'bWithContent': _bWithContent});
	}
	this.clone = this.copy;
	
	this.remove = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.remove({'xElement': _xElement});
	}
	this.kill = this.remove;

	this.insertHtml = function(_xElement, _sHtml)
	{
		if (typeof(_sHtml) == 'undefined') {var _sHtml = null;}
		_sHtml = this.getRealParameter({'oParameters': _xElement, 'sName': 'sHtml', 'xParameter': _sHtml});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.insertHtml({'xElement': _xElement, 'sHtml': _sHtml});
	}
	this.addHtml = this.insertHtml;
	
	this.insertText = function(_xElement, _sText)
	{
		if (typeof(_sText) == 'undefined') {var _sText = null;}
		_sText = this.getRealParameter({'oParameters': _xElement, 'sName': 'sText', 'xParameter': _sText});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		oPGNodes.insertText({'xElement': _xElement, 'sText': _sText});
	}
	this.addText = this.insertText;
}
