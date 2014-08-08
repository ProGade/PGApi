/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 06 2014
*/
var PG_SPRITES_INDEX_ID = 0;
var PG_SPRITES_INDEX_OBJECT = 1;
var PG_SPRITES_ANIMATE_LOOP = -1;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Sprites()
{
	// Declarations...
	this.axSprites = new Array();
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param oSprite [needed][type]object[/type]
	[en]...[/en]
	*/
	this.registerSprite = function(_sSpriteID, _oSprite)
	{
		if (typeof(_oSprite) == 'undefined') {var _oSprite = null;}

		_oSprite = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'oSprite', 'xParameter': _oSprite});
		_sSpriteID = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'sSpriteID', 'xParameter': _sSpriteID});

		this.axSprites.push(new Array(_sSpriteID, _oSprite));
		return this.axSprites.length-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param iFileSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iFileSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.createSprite = function(_sSpriteID, _sFile, _iFileSizeX, _iFileSizeY)
	{
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_iFileSizeX) == 'undefined') {var _iFileSizeX = null;}
		if (typeof(_iFileSizeY) == 'undefined') {var _iFileSizeY = null;}
		
		_sFile = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'sFile', 'xParameter': _sFile});
		_iFileSizeX = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'iFileSizeX', 'xParameter': _iFileSizeX});
		_iFileSizeY = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'iFileSizeY', 'xParameter': _iFileSizeY});
		_sSpriteID = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'sSpriteID', 'xParameter': _sSpriteID});
		
		var _oSprite = new classPG_Sprite();
		_oSprite.init({'sSpriteID': _sSpriteID, 'sFile': _sFile, 'iFileSizeX': _iFileSizeX, 'iFileSizeY': _iFileSizeY});
		return this.registerSprite({'sSpriteID': _sSpriteID, 'oSprite': _oSprite});
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sNewSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param xCopyOfSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.createSpriteCopy = function(_sNewSpriteID, _xCopyOfSprite)
	{
		if (typeof(_xCopyOfSprite) == 'undefined') {var _xCopyOfSprite = null;}

		_xCopyOfSprite = this.getRealParameter({'oParameters': _sNewSpriteID, 'sName': 'xCopyOfSprite', 'xParameter': _xCopyOfSprite});
		_sNewSpriteID = this.getRealParameter({'oParameters': _sNewSpriteID, 'sName': 'sNewSpriteID', 'xParameter': _sNewSpriteID});

		var _iCopySpriteIndex = this.getSpriteIndex({'xSprite': _xCopyOfSprite});
		if ((_iCopySpriteIndex >= 0) && (_iCopySpriteIndex < this.axSprites.length))
		{
			var _oCopySprite = this.axSprites[_iCopySpriteIndex][PG_SPRITES_INDEX_OBJECT];
			if (_oCopySprite)
			{
				_oSprite = new classPG_Sprite();
				_oSprite.init({'sSpriteID': _sNewSpriteID, 'sFile': _oCopySprite.getFile(), 'iFileSizeX': _oCopySprite.getFileSizeX(), 'iFileSizeY': _oCopySprite.getFileSizeY()});
				return this.registerSprite({'sSpriteID': _sNewSpriteID, 'oSprite': _oSprite});
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oSpriteDiv [type]object[/type]
	[en]...[/en]
	
	@param oContainer [needed][type]object[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.buildSprite = function(_oContainer, _xSprite)
	{
		if (typeof(_xSprite) == 'undefined') {var _xSprite = null;}

		_xSprite = this.getRealParameter({'oParameters': _oContainer, 'sName': 'xSprite', 'xParameter': _xSprite});
		_oContainer = this.getRealParameter({'oParameters': _oContainer, 'sName': 'oContainer', 'xParameter': _oContainer, 'bNotNull': true});

		var _iIndex = this.getSpriteIndex({'xSprite': _xSprite});
		if ((_iIndex >= 0) && (_iIndex < this.axSprites.length))
		{
			var _oSprite = this.axSprites[_iIndex][PG_SPRITES_INDEX_OBJECT];
			if (_oSprite)
			{
				var _oDiv = _oSprite.build();
				if (_oDiv)
				{
					if (_oContainer) {_oContainer.appendChild(_oDiv);}
					return _oDiv;
				}
			}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sSpritesHtml [type]string[/type]
	[en]...[/en]
	*/
	this.buildAllSprites = function()
	{
		var _sHTML = '';
		var _oSprite = null;
		for (var i=0; i<this.axSprites; i++)
		{
			if (this.axSprites[i] != null)
			{
				_oSprite = this.axSprites[i][PG_SPRITES_INDEX_OBJECT];
				if (_oSprite) {_sHTML += _oSprite.build();}
			}
		}
		return _sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getSpriteIndex = function(_xSprite)
	{
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});

		if (typeof(_xSprite) == 'number') {return _xSprite;}
		else if (typeof(_xSprite) == 'string')
		{
			for (var i=0; i<this.axSprites.length; i++)
			{
				if (this.axSprites[i][PG_SPRITES_INDEX_ID] == _xSprite) {return i;}
			}
		}
		else if (typeof(_xSprite) == 'object')
		{
			for (var i=0; i<this.axSprites.length; i++)
			{
				if (this.axSprites[i][PG_SPRITES_INDEX_OBJECT] == _xSprite) {return i;}
			}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oSprite [type]object[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getSprite = function(_xSprite)
	{
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});

		if (typeof(_xSprite) == 'object') {return _xSprite;}
		else if (typeof(_xSprite) == 'string')
		{
			for (var i=0; i<this.axSprites.length; i++)
			{
				if (this.axSprites[i][PG_SPRITES_INDEX_ID] == _xSprite) {return this.axSprites[i][PG_SPRITES_INDEX_OBJECT];}
			}
		}
		else if (typeof(_xSprite) == 'number')
		{
			if ((_xSprite >= 0) && (_xSprite < this.axSprites.length))
			{
				return this.axSprites[_xSprite][PG_SPRITES_INDEX_OBJECT];
			}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iAnimationIndex [type]int[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sAnimationID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStartPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iStartPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepsX [type]int[/type]
	[en]...[/en]
	
	@param iStepsY [type]int[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	*/
	this.addAnimation = function(_xSprite, _sAnimationID, _iStartPosX, _iStartPosY, _iStepSizeX, _iStepSizeY, _iStepsX, _iStepsY, _iSpeedTimeout)
	{
		if (typeof(_sAnimationID) == 'undefined') {var _sAnimationID = null;}
		if (typeof(_iStartPosX) == 'undefined') {var _iStartPosX = null;}
		if (typeof(_iStartPosY) == 'undefined') {var _iStartPosY = null;}
		if (typeof(_iStepSizeX) == 'undefined') {var _iStepSizeX = null;}
		if (typeof(_iStepSizeY) == 'undefined') {var _iStepSizeY = null;}
		if (typeof(_iStepsX) == 'undefined') {var _iStepsX = null;}
		if (typeof(_iStepsY) == 'undefined') {var _iStepsY = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}

		_sAnimationID = this.getRealParameter({'oParameters': _xSprite, 'sName': 'sAnimationID', 'xParameter': _sAnimationID});
		_iStartPosX = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStartPosX', 'xParameter': _iStartPosX});
		_iStartPosY = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStartPosY', 'xParameter': _iStartPosY});
		_iStepSizeX = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStepSizeX', 'xParameter': _iStepSizeX});
		_iStepSizeY = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStepSizeY', 'xParameter': _iStepSizeY});
		_iStepsX = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStepsX', 'xParameter': _iStepsX});
		_iStepsY = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iStepsY', 'xParameter': _iStepsY});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});
		
		if (_iStepsX == null) {_iStepsX = 1;}
		if (_iStepsY == null) {_iStepsY = 1;}
		if (_iSpeedTimeout == null) {_iSpeedTimeout = 200;}
		
		var _oSprite = this.getSprite({'xSprite': _xSprite});
		if (_oSprite) {return _oSprite.addAnimation({'sAnimationID': _sAnimationID, 'iStartPosX': _iStartPosX, 'iStartPosY': _iStartPosY, 'iStepSizeX': _iStepSizeX, 'iStepSizeY': _iStepSizeY, 'iStepsX': _iStepsX, 'iStepsY': _iStepsY, 'iSpeedTimeout': _iSpeedTimeout});}
		return null;
	}
	/* @end method */

	/*
	@start method
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iTimes [type]int[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	*/
	this.animate = function(_xSprite, _xAnimation, _iTimes, _iSpeedTimeout)
	{
		if (typeof(_xAnimation) == 'undefined') {var _xAnimation = null;}
		if (typeof(_iTimes) == 'undefined') {var _iTimes = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}

		_xAnimation = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xAnimation', 'xParameter': _xAnimation});
		_iTimes = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iTimes', 'xParameter': _iTimes});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});
		
		var _oSprite = this.getSprite({'xSprite': _xSprite});
		var _iSpriteIndex = this.getSpriteIndex({'xSprite': _xSprite});
		if (_oSprite)
		{
			if (_iTimes == null) {_iTimes = 1;}
			if (_iSpeedTimeout == null) {_iSpeedTimeout = _oSprite.getAnimationTimeout({'xAnimation': _xAnimation});}
			if (((_iTimes > 0) || (_iTimes < 0)) && (!isNaN(_iSpeedTimeout)))
			{
				if (_oSprite.animate({'xAnimation': _xAnimation})) {if (_iTimes > 0) {_iTimes--;}}
				if (typeof(_xAnimation) == 'string')
				{
					_oSprite.startAnimation({'oTimeout': this.oWindow.setTimeout("oPGSprites.animate({'xSprite': "+_iSpriteIndex+", 'xAnimation': '"+_xAnimation+"', 'iTimes': "+_iTimes+", 'iSpeedTimeout': "+_iSpeedTimeout+"})", _iSpeedTimeout)});
				}
				else if (typeof(_xAnimation) == 'number')
				{
					_oSprite.startAnimation({'oTimeout': this.oWindow.setTimeout("oPGSprites.animate({'xSprite': "+_iSpriteIndex+", 'xAnimation': "+_xAnimation+", 'iTimes': "+_iTimes+", 'iSpeedTimeout': "+_iSpeedTimeout+"})", _iSpeedTimeout)});
				}
			}
			else {_oSprite.stopAnimation();}
		}
	}
	/* @end method */

	/*
	@start method
	
	@param xSprite [needed][type]int[/type]
	[en]...[/en]
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	
	@param iMilliseconds [type]int[/type]
	[en]...[/en]
	*/
	this.setScale = function(_xSprite, _dScale, _iSpeedTimeout, _iMilliseconds)
	{
		if (typeof(_dScale) == 'undefined') {var _dScale = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (typeof(_iMilliseconds) == 'undefined') {var _iMilliseconds = null;}

		_dScale = this.getRealParameter({'oParameters': _xSprite, 'sName': 'dScale', 'xParameter': _dScale});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_iMilliseconds = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});

		if (_iSpeedTimeout == null) {_iSpeedTimeout = 0;}
		if (_iMilliseconds == null) {_iMilliseconds = 0;}
		
		var _oSprite = this.getSprite({'xSprite': _xSprite});
		var _iSpriteIndex = this.getSpriteIndex({'xSprite': _xSprite});
		if (_oSprite)
		{
			_oSprite.stopScaling();
			_oSprite.vScaleTo = _dScale;
			_oSprite.setLastScale({'dScale': _oSprite.getScale()});
			this.setScale2({'xSprite': _xSprite, 'dScale': _dScale, 'dScaleTo': _dScale, 'iSpeedTimeout': _iSpeedTimeout, 'iMilliseconds': _iMilliseconds});
		}
	}
	/* @end method */

	/*
	@start method
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	
	@param dScaleTo [needed][type]double[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	
	@param iMilliseconds [type]int[/type]
	[en]...[/en]
	*/
	this.setScale2 = function(_xSprite, _dScale, _dScaleTo, _iSpeedTimeout, _iMilliseconds)
	{
		if (typeof(_dScale) == 'undefined') {var _dScale = null;}
		if (typeof(_dScaleTo) == 'undefined') {var _dScaleTo = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		if (typeof(_iMilliseconds) == 'undefined') {var _iMilliseconds = null;}

		_dScale = this.getRealParameter({'oParameters': _xSprite, 'sName': 'dScale', 'xParameter': _dScale});
		_dScaleTo = this.getRealParameter({'oParameters': _xSprite, 'sName': 'dScaleTo', 'xParameter': _dScaleTo});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_iMilliseconds = this.getRealParameter({'oParameters': _xSprite, 'sName': 'iMilliseconds', 'xParameter': _iMilliseconds});
		_xSprite = this.getRealParameter({'oParameters': _xSprite, 'sName': 'xSprite', 'xParameter': _xSprite});

		if (_iSpeedTimeout == null) {_iSpeedTimeout = 0;}
		if (_iMilliseconds == null) {_iMilliseconds = 0;}
		
		var _oSprite = this.getSprite({'xSprite': _xSprite});
		var _iSpriteIndex = this.getSpriteIndex({'xSprite': _xSprite});
		if (_oSprite)
		{
			_oSprite.stopScaling({'dScaleTo': _dScaleTo});
			var _vCurrentScale = _oSprite.getScale();
			var _vLastScale = _oSprite.getLastScale();
			var _dScaleDiff = _dScale-_vCurrentScale;
			if (this.isDebugMode(PG_DEBUG_HIGH)) {this.sDebugString += _dScaleDiff+"\n";}
			if (_iSpeedTimeout > 0)
			{
				if (_iMilliseconds > 0)
				{
					var _vLastScaleDiff = _dScale-_vLastScale; //_dScale-_vCurrentScale;
					var _dScaleRelation = _iMilliseconds/_iSpeedTimeout;
					
					if (this.isDebugMode(PG_DEBUG_HIGH)) {this.sDebugString += '_dScaleRelation = '+_dScaleRelation+"\n";}
					
					var _dScaleRelationDiff = Math.ceil(_vLastScaleDiff/_dScaleRelation*10000);
					_dScaleRelationDiff = _dScaleRelationDiff/10000;
					
					if (this.isDebugMode(PG_DEBUG_HIGH)) {this.sDebugString += '_dScaleRelationDiff = '+_dScaleRelationDiff+"\n";}
					
					if (((_dScaleDiff > 0) && (_vCurrentScale + _dScaleRelationDiff < _dScale))
					|| ((_dScaleDiff < 0) && (_vCurrentScale + _dScaleRelationDiff > _dScale)))
					{
						// _dScaleDiff = Math.round(_dScaleRelationDiff*100);
						// _dScaleDiff = _dScaleDiff/100;
						_dScaleDiff = _dScaleRelationDiff;
					}
				}
				else
				{
					if ((_dScaleDiff > 0.2) || (_dScaleDiff < -0.2))
					{
						_dScaleDiff = Math.round((_dScaleDiff*100)/2);
						_dScaleDiff = _dScaleDiff/100;
					}
				}
			}

			if (_dScaleDiff != 0) {_oSprite.setScale(_vCurrentScale+_dScaleDiff, false);}
			if ((_dScaleDiff != 0) && (_iSpeedTimeout > 0))
			{
				if (this.isDebugMode(PG_DEBUG_HIGH)) {this.sDebugString += '_dScaleDiff = '+_dScaleDiff+"\n";}				
				_oSprite.startScaling({'oTimeout': this.oWindow.setTimeout("oPGSprites.setScale2({'xSprite': "+_iSpriteIndex+", 'dScale': "+_dScale+", 'dScaleTo': "+_dScaleTo+", 'iSpeedTimeout': "+_iSpeedTimeout+", 'iMilliseconds': "+_iMilliseconds+"})", _iSpeedTimeout)});
			}
			else
			{
				_oSprite.stopScaling({'dScaleTo': _dScaleTo});
				_oSprite.setLastScale({'dScale': _dScale});
				if (this.isDebugMode(PG_DEBUG_HIGH)) {this.sDebugString += "stop!\n";}
			}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Sprites.prototype = new classPG_ClassBasics();
var oPGSprites = new classPG_Sprites();
