/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
var PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NAME = 0;
var PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_START = 1;
var PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_END = 2;
var PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NOSLASHES = 3;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_CodeHighlighter()
{
	// Declarations...
	this.iMaxMappings = 10000;
	this.bHighlightCommands = true;
	this.bHighlightFunctions = true;
	
	this.asCommands = new Array();
	this.asFunctions = new Array();
	this.asDelimiters = new Array();

	this.asCodeMap = new Array();
	
	// Construct...
	
	// Methods...
	this.init = function()
	{
		this.addDelimiter('DoubleQuotes', '"', '"', true);
		this.addDelimiter('SingleQuotes', "'", "'", true);
		this.addDelimiter('MultiLineComments', '/*', '*/', false);
		this.addDelimiter('SingleLineComments', '//', '\n', false);
	}
	
	this.addDelimiter = function(_sName, _xStart, _xEnd, _bNoSlahes)
	{
		this.asDelimiters.push(new Array());
		this.asDelimiters[this.asDelimiters.length-1][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NAME] = _sName;
		this.asDelimiters[this.asDelimiters.length-1][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_START] = _xStart;
		this.asDelimiters[this.asDelimiters.length-1][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_END] = _xEnd;
		this.asDelimiters[this.asDelimiters.length-1][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NOSLASHES] = _bNoSlahes;
	}

	this.highlight = function(_sCode)
	{
		var _oRegExp;
		var _sSearch = '';
		var _asCommands = new Array('function', 'for', 'while', 'if', 'else', 'while', 'foreach', 'each', 'do', 'echo', 'true', 'false', 'null');
		var _asFunctions = new Array('include', 'isset', 'define', 'defined', 'error_reporting', 'unset', 'date', 'mktime', 'time', 'explode', 'implode', 'str_replace', 'preg_match', 'preg_replace', 'replace', 'utf8_decode', 'utf8_encode');
		var _asCode = this.parse(_sCode);
		
		_sCode = '';
		for (var i=0; i<_asCode.length; i++)
		{
			if (_asCode[i][0] != 'Code')
			{
				_sCode += '<span style="';
				switch (_asCode[i][0])
				{
					case 'DoubleQuotes':
					case 'SingleQuotes':
						_sCode += 'color:#CC0000;';
					break;
					case 'MultiLineComments':
					case 'SingleLineComments':
						_sCode += 'color:#ff9900;';
					break;
				}
				_sCode += '">';
			}
			else
			{
				// _asCode[i][1] = _asCode[i][1].replace(/(<\?php)/gi, '<span style="color:#ff0000;">$1</span>');
				// _asCode[i][1] = _asCode[i][1].replace(/(\?>)/g, '<span style="color:#ff0000;">$1</span>');
				_asCode[i][1] = _asCode[i][1].replace(/([\+\-\*\/=\?!]{1,3}|[\-\+\.]{1,2})/g, '<span style="color:#00AA00;">$1</span>');
				_asCode[i][1] = _asCode[i][1].replace(/\b([0-9]+)\b/g, '<span style="color:#ff0000;">$1</span>');
				
				_asCode[i][1] = _asCode[i][1].replace(/(\$_REQUEST|\$_POST|\$_GET|\$_SERVER)/g, '<span style="color:#5588ff;">$1</span>');
				
				var t=0;
				
				if (this.bHighlightCommands == true)
				{
					_sSearch = '(';
					for (t=0; t<_asCommands.length; t++)
					{
						// _sSearch = '(^|\\\s|;|{|}|\\\))('+_asCommands[t]+')(\\\s|$|\\\(|{|})';
						// _sSearch = '(\\b'+_asCommands[t]+'\\b)';
						if (t > 0) {_sSearch += '|';}
						_sSearch += '\\b'+_asCommands[t]+'\\b';
					}
					_sSearch += ')';
					_oRegExp = new RegExp(_sSearch, 'gi');
					_asCode[i][1] = _asCode[i][1].replace(_oRegExp, '<span style="color:#00AA00;">$1</span>');
				}
				
				if (this.bHighlightFunctions == true)
				{
					_sSearch = '(';
					for (t=0; t<_asFunctions.length; t++)
					{
						// _sSearch = '(\\b'+_asFunctions[t]+'\\b)';
						if (t > 0) {_sSearch += '|';}
						_sSearch += '\\b'+_asFunctions[t]+'\\b';
					}
					_sSearch += ')';
					_oRegExp = new RegExp(_sSearch, 'g');
					_asCode[i][1] = _asCode[i][1].replace(_oRegExp, '<span style="color:#0000ff;">$1</span>');
				}
			}
			_sCode += _asCode[i][1];
			if (_asCode[i][0] != 'Code') {_sCode += '</span>';}
		}
		
		return _sCode;
	}
	
	this.isNoSlash = function(_sCode, _iPos)
	{
		if (_iPos < 0) {return false;}
		if (_iPos-1 >= 0)
		{
			if (_sCode.charAt(_iPos-1) == '\\') {return false;}
		}
		return true;
	}
	
	this.indexOfDelimiterWithoutSlash = function(_sCode, _sDelimiterStart, _iPos)
	{
		var _iAbortCounter = 0;
		var _iCurrentPos = _iPos;
		_iPos = -1;
		do
		{
			if (this.isNoSlash(_sCode, _iCurrentPos)) {_iPos = _iCurrentPos;}
			else
			{
				_iCurrentPos = _sCode.indexOf(_sDelimiterStart, _iCurrentPos+1);
			}
			_iAbortCounter++;
			if (_iAbortCounter > 50) {return _sCode.length-1;}
		}
		while ((_iPos === -1) && (_iCurrentPos !== -1))
		return _iPos;
	}

	this.parse = function(_sCode, _iMaxMappings)
	{
		this.init();	// only for testing purpose
		
		this.asCodeMap = new Array();
		if (!_sCode)
		{
			this.asCodeMap.push(new Array('Code', _sCode));
			return this.asCodeMap;
		}
		
		var _iIndex = 0;
		var _sDelimiterName = '';
		var _sDelimiterStart = '';
		var _sDelimiterEnd = '';
		var _iCurrentPos = 0;
		var _iStartPos = 0;
		var _iEndPos = 0;
		
		if (typeof(_iMaxMappings) == 'undefined') {_iMaxMappings = this.iMaxMappings;}
		
		var _iFoundIndex = 0;
		
		while ((_iEndPos < _sCode.length) && (this.asCodeMap.length < _iMaxMappings))
		{
			_iStartPos = -1;
			_iFoundDelimiter = 0;
			
			// find next map delimiter...
			for (_iIndex = 0; _iIndex < this.asDelimiters.length; _iIndex++)
			{
				_sDelimiterStart = this.asDelimiters[_iIndex][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_START];
				_iCurrentPos = _sCode.indexOf(_sDelimiterStart, 0);
				if (this.asDelimiters[_iIndex][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NOSLASHES] == true)
				{
					_iCurrentPos = this.indexOfDelimiterWithoutSlash(_sCode, _sDelimiterStart, _iCurrentPos);
				}
				if (((_iCurrentPos < _iStartPos) || (_iStartPos === -1)) && (_iCurrentPos !== -1))
				{
					_iFoundIndex = _iIndex;
					_iStartPos = _iCurrentPos;
				}
			}
			
			// Map code...
			if (_iStartPos !== -1)
			{
				if (_iStartPos > 0)
				{
					this.asCodeMap.push(new Array('Code', _sCode.substr(0, _iStartPos)));
					_sCode = _sCode.substr(_iStartPos, _sCode.length-_iStartPos);
				}
				
				_iStartPos = 0;
				_sDelimiterName = this.asDelimiters[_iFoundIndex][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NAME];
				_sDelimiterEnd = this.asDelimiters[_iFoundIndex][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_END];
				
				_iEndPos = _sCode.indexOf(_sDelimiterEnd, 1);
				if (this.asDelimiters[_iFoundIndex][PG_CODEHIGHLIGHTER_DELIMITERS_INDEX_NOSLASHES] == true)
				{
					_iEndPos = this.indexOfDelimiterWithoutSlash(_sCode, _sDelimiterEnd, _iEndPos);
				}

				if (_iEndPos !== -1)
				{
					this.asCodeMap.push(new Array(_sDelimiterName, _sCode.substr(_iStartPos, _iEndPos+1)));
					_sCode = _sCode.substr(_iEndPos+1, _sCode.length-_iEndPos);
				}
				else {/* todo: no end delimiter found in code */}
			}
			else
			{
				_iEndPos = _sCode.length;
				this.asCodeMap.push(new Array('Code', _sCode));
				_sCode = '';
			}
		}
		
		if (_sCode.length > 0) {this.asCodeMap.push(new Array('Code', _sCode));}
		
		return this.asCodeMap;
	}
}
/* @end class */
classPG_CodeHighlighter.prototype = new classPG_ClassBasics();
var oPGCodeHighlighter = new classPG_CodeHighlighter();
